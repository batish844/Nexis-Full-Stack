<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    /**
     * Display the user's profile.
     */
    public function index(): View
    {
        $user = Auth::user();

        $decodedAddress = $user->address ? json_decode($user->address, true) : [];

        $user->street_address = $decodedAddress['street_address'] ?? null;
        $user->building = $decodedAddress['building'] ?? null;
        $user->city = $decodedAddress['city'] ?? null;

        return view('profile.profile', compact('user'));
    }
    public function order()
    {
        $user = auth()->user();

        // Fetch the orders with their items and calculate TotalPrice dynamically
        $orders = $user->orders()->with(['orderItems.item'])->get();

        $orders->each(function ($order) {
            // Calculate the total price for the order
            $totalPrice = $order->orderItems->sum(function ($orderItem) {
                return $orderItem->Quantity * $orderItem->item->Price;
            });

            $order->TotalPrice = $totalPrice;

            // Include all images for each item in the order
            $order->itemImages = $order->orderItems->flatMap(function ($orderItem) {
                return $orderItem->item->Photo ?? [];
            })->toArray(); // Collect all images in a flat array
        });

        return view('profile.order', compact('orders'));
    }

    public function orderDetails(string $id)
    {
        $user = auth()->user();

        // Fetch the order with items and ensure it belongs to the logged-in user
        $order = $user->orders()->with(['orderItems.item'])->where('OrderID', $id)->firstOrFail();

        // Calculate the total price dynamically
        $totalPrice = $order->orderItems->sum(function ($orderItem) {
            return $orderItem->Quantity * $orderItem->item->Price;
        });

        $order->TotalPrice = $totalPrice;

        // Update the total price for each order item
        foreach ($order->orderItems as $orderItem) {
            $orderItem->TotalPrice = $orderItem->item->Price * $orderItem->Quantity;
            $orderItem->save();
        }

        // Save the updated total price of the order
        $order->save();

        // Return the order details as a JSON response for the modal
        return response()->json([
            'order' => $order,
            'items' => $order->orderItems->map(function ($orderItem) {
                return [
                    'name' => $orderItem->item->Name,
                    'photo' => $orderItem->item->Photo[0] ?? null,
                    'price' => $orderItem->item->Price,
                    'size' => $orderItem->Size,
                    'quantity' => $orderItem->Quantity,
                    'subtotal' => $orderItem->TotalPrice,
                ];
            }),
        ]);
    }




    public function edit(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user = request()->user();
        $primaryKey = 'UserID'; // Replace 'UserID' with your actual primary key column name

        $validatedData = $request->validate([
            'First_Name' => 'required|string|max:255',
            'Last_Name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users', 'email')->ignore($user->$primaryKey, $primaryKey),
            ],
            'Phone_Number' => 'required|string|max:20',
            'city' => 'nullable|string|max:255',
            'street_address' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
        ]);

        $user->First_Name = $validatedData['First_Name'];
        $user->Last_Name = $validatedData['Last_Name'];
        $user->email = $validatedData['email'];
        $user->Phone_Number = $validatedData['Phone_Number'];

        $addressFields = [
            'street_address' => $validatedData['street_address'] ?? null,
            'building' => $validatedData['building'] ?? null,
            'city' => $validatedData['city'] ?? null,
        ];

        foreach ($addressFields as $key => $value) {
            if ($value === null || $value === '') {
                unset($addressFields[$key]);
            }
        }

        $user->address = empty($addressFields) ? null : json_encode($addressFields);

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    //upload avatar function
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = Auth::user();
        $user = request()->user();
        if ($request->file('avatar')->isValid()) {
            $fileName = time() . '.' . $request->file('avatar')->extension();

            $filePath = public_path('storage/img/avatar');

            if (!file_exists($filePath)) {
                mkdir($filePath, 0777, true);
            }

            $request->file('avatar')->move($filePath, $fileName);


            if ($user->avatar && file_exists(public_path('storage/img/avatar/' . $user->avatar))) {
                unlink(public_path('storage/img/avatar/' . $user->avatar));
            }

            $user->avatar = $fileName;
            $user->save();
        }

        return redirect()->back()->with('status', 'avatar-updated');
    }

    //Delete avatar
    public function deleteAvatar()
    {
        $user = Auth::user();
        $user = request()->user();
        if ($user->avatar) {

            $filePath = public_path('storage/img/avatar/' . $user->avatar);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $user->avatar = null;
            $user->save();
        }

        return redirect()->back()->with('status', 'avatar-deleted');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {

        if (is_null($request->user()->google_id)) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}