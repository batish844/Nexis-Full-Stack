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
use App\Models\Order;

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

        $totalPoints = $user->Points;

        return view('profile.profile', compact('user', 'totalPoints'));
    }
    public function order(Request $request)
    {
        $user = auth()->user();

        // Fetch user's orders with their items and sort by the most recent
        $query = $user->orders()->with(['orderItems.item'])->orderBy('created_at', 'desc');

        $orders = $query->get();

        // Dynamically calculate total price and points for each order
        $orders->each(function ($order) {
            $order->TotalPrice = $order->orderItems->sum(function ($orderItem) {
                return $orderItem->Quantity * $orderItem->item->Price;
            });

            $order->TotalPoints = $order->orderItems->sum(function ($orderItem) {
                return $orderItem->Quantity * $orderItem->item->Points;
            });
        });

        $totalPoints = $user->Points;

        // Pass calculated totals to the view
        return view('profile.order', compact('orders', 'totalPoints'));
    }


    public function orderDetails(string $id)
    {
        $user = auth()->user();

        // Fetch the specific order with items, ensuring it belongs to the user
        $order = $user->orders()->with(['orderItems.item'])->where('OrderID', $id)->firstOrFail();

        // Dynamically calculate the total price and points
        $totalPrice = $order->orderItems->sum(function ($orderItem) {
            return $orderItem->Quantity * $orderItem->item->Price;
        });

        $totalPoints = $order->orderItems->sum(function ($orderItem) {
            return $orderItem->Quantity * $orderItem->item->Points;
        });

        // Return order details as JSON for the modal
        return response()->json([
            'order' => [
                'OrderID' => $order->OrderID,
                'created_at' => $order->created_at,
                'TotalPrice' => $totalPrice,
                'TotalPoints' => $totalPoints,
                'TotalQuantity' => $order->orderItems->sum('Quantity'),
            ],
            'items' => $order->orderItems->map(function ($orderItem) {
                return [
                    'name' => $orderItem->item->Name,
                    'photo' => $orderItem->item->Photo[0] ?? null,
                    'price' => $orderItem->item->Price * $orderItem->Quantity,
                    'points' => $orderItem->item->Points * $orderItem->Quantity,
                    'size' => $orderItem->Size,
                    'quantity' => $orderItem->Quantity,
                    'subtotal' => $orderItem->TotalPrice,
                ];
            }),
        ]);
    }
    public function filterOrders(Request $request)
    {
        $user = auth()->user();

        // Fetch orders with their items
        $query = $user->orders()->with(['orderItems.item']);

        // Filter by status if a specific status is selected
        if ($request->status && $request->status !== 'all') {
            $query->where('Status', $request->status);
        }

        $orders = $query->get();

        // Dynamically calculate TotalPoints for each order
        $orders->each(function ($order) {
            $order->TotalPoints = $order->orderItems->sum(function ($orderItem) {
                return $orderItem->Quantity * $orderItem->item->Points;
            });
        });

        // Convert to a collection for sorting purposes
        $orders = $orders->sortBy(function ($order) use ($request) {
            if ($request->sort) {
                [$column, $direction] = explode(':', $request->sort);

                if ($column === 'time_created') {
                    return $direction === 'asc' ? $order->created_at : -$order->created_at->timestamp;
                } elseif ($column === 'price') {
                    return $direction === 'asc' ? $order->TotalPrice : -$order->TotalPrice;
                } elseif ($column === 'points') {
                    return $direction === 'asc' ? $order->TotalPoints : -$order->TotalPoints;
                }
            }
            return $order->created_at; // Default sorting by creation time
        });

        // Render filtered and sorted orders
        return view('profile.ordersFiltered', ['orders' => $orders])->render();
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

        return redirect()->route('profile.index', ['#profile-section'])
            ->with(
                'success',
                'Profile updated successfully.'
            );
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

    public function claimOrders(Request $request)
    {
        $user = Auth::user();

        if ($request->input('reject') === 'true') {
            $request->session()->forget('has_guest_orders');

            return redirect()->back()->with('info', 'You have chosen not to claim the guest orders. Session cleared.');
        }

        $guestOrders = Order::where('guest_email', $user->email)->get();

        if ($guestOrders->isEmpty()) {
            return redirect()->back()->with('error', 'No guest orders found to claim.');
        }

        $totalPointsRewarded = 0;

        foreach ($guestOrders as $order) {
            foreach ($order->orderItems as $orderItem) {
                if ($orderItem->item) {
                    $totalPointsRewarded += $orderItem->Quantity * $orderItem->item->Points;
                }
            }

            $order->update([
                'OrderedBy' => $user->UserID,
                'is_guest' => false,
                'guest_email' => null,
                'guest_address' => null,
            ]);
        }

        $user->increment('Points', $totalPointsRewarded);

        $request->session()->forget('has_guest_orders');

        return redirect()->back()->with('success', "Your guest orders have been successfully claimed, and you earned {$totalPointsRewarded} points!");
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
