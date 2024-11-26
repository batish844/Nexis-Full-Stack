<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order; // Add this line to use the Order model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB; // Add this line to use database transactions
use Illuminate\Support\Facades\Log; // For logging errors
use App\Models\Wishlist;
use App\Models\Cart;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'First_Name' => ['required', 'string', 'max:50'],
            'Last_Name' => ['required', 'string', 'max:50'],
            'Phone_Number' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'First_Name'   => $request->First_Name,
                'Last_Name'    => $request->Last_Name,
                'Phone_Number' => $request->Phone_Number,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
            ]);

            $guestOrders = Order::where('guest_email', $user->email)->get();

            if ($guestOrders->isNotEmpty()) {
                foreach ($guestOrders as $order) {
                    $order->update([
                        'OrderedBy'     => $user->UserID,
                        'is_guest'      => false,
                        'guest_email'   => null,
                        'guest_address' => null,
                    ]);
                }
            }
            $guestWishlist = session('wishlist', []);
            if (!empty($guestWishlist)) {
                foreach ($guestWishlist as $itemID) {
                    $wishlistExists = Wishlist::where('UserID', $user->UserID)
                        ->where('ItemID', $itemID)
                        ->exists();

                    if (!$wishlistExists) {
                        Wishlist::create([
                            'UserID' => $user->UserID,
                            'ItemID' => $itemID,
                        ]);
                    }
                }

                session()->forget('wishlist');
            }

            $guestCart = session('cart', []);
            if (!empty($guestCart)) {
                foreach ($guestCart as $key => $cartItem) {
                    [$itemID, $size] = explode('_', $key);

                    Cart::create([
                        'UserID'   => $user->UserID,
                        'ItemID'   => $itemID,
                        'Size'     => $size,
                        'Quantity' => $cartItem['Quantity'],
                    ]);
                }

                session()->forget('cart');
            }

            event(new Registered($user));

            Auth::login($user);

            DB::commit();

            return redirect(route('profile.index'))
                ->with('success', 'Registration successful! Your previous orders, wishlist, and cart items have been linked to your account.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error during registration:', ['error' => $e->getMessage()]);

            return redirect()->back()
                ->with('error', 'An error occurred during registration. Please try again.');
        }
    }
}
