<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Item;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            if (Auth::check()) {
                // ======= AUTHENTICATED USER LOGIC =======
                $user = Auth::user();
                $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();

                if ($cartItems->isEmpty()) {
                    throw new \Exception('Your cart is empty.');
                }

                $lineItems = $cartItems->map(function ($cartItem) {
                    return [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $cartItem->item->Name . ' (' . $cartItem->Size . ')',
                            ],
                            'unit_amount' => $cartItem->item->Price * 100, // Convert to cents
                        ],
                        'quantity' => $cartItem->Quantity,
                    ];
                })->toArray();

                $checkoutSession = $stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('checkout.cancel'),
                    'customer_email' => $user->email,
                ]);

                session(['checkoutSessionId' => $checkoutSession->id]);
                return response()->json(['url' => $checkoutSession->url]);
            } else {
                // ======= GUEST USER LOGIC =======
                $sessionCart = session('cart', []);

                if (empty($sessionCart)) {
                    throw new \Exception('Your cart is empty.');
                }

                $lineItems = collect($sessionCart)->map(function ($cartItem) {
                    return [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Item #' . $cartItem['ItemID'] . ' (' . $cartItem['Size'] . ')',
                            ],
                            'unit_amount' => $cartItem['Price'] * 100, // Convert to cents
                        ],
                        'quantity' => $cartItem['Quantity'],
                    ];
                })->values()->toArray();

                $checkoutSession = $stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('checkout.cancel'),
                    'shipping_address_collection' => [
                        'allowed_countries' => ['US', 'CA', 'GB'], // Modify as needed
                    ],
                ]);

                session(['checkoutSessionId' => $checkoutSession->id]);
                return response()->json(['url' => $checkoutSession->url]);
            }
        } catch (\Exception $e) {
            Log::error('Error creating checkout session:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error creating checkout session: ' . $e->getMessage()], 500);
        }
    }

    public function checkoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            $sessionId = $request->query('session_id');
            Log::info('Received session_id from Stripe:', ['session_id' => $sessionId]);

            $session = $stripe->checkout->sessions->retrieve($sessionId, [
                'expand' => ['customer_details', 'shipping_details'],
            ]);

            Log::info('Stripe session retrieved:', ['session' => $session]);

            if (Auth::check()) {
                // Authenticated user logic
                $user = Auth::user();
                Log::info('Authenticated user checkout:', ['user' => $user]);

                $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();
                Log::info('Cart items for authenticated user:', ['cartItems' => $cartItems]);

                if ($cartItems->isEmpty()) {
                    throw new \Exception('Your cart is empty.');
                }

                $order = Order::create([
                    'OrderedBy' => $user->UserID,
                    'TotalPrice' => $session->amount_total / 100, // Convert from cents to dollars
                    'is_guest' => false,
                    'Status' => 'Pending',
                ]);

                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'OrderID' => $order->OrderID,
                        'ItemID' => $cartItem->item->ItemID,
                        'Size' => $cartItem->Size,
                        'Quantity' => $cartItem->Quantity,
                        'TotalPrice' => $cartItem->Quantity * $cartItem->item->Price,
                    ]);

                    $cartItem->item->decrement('Quantity', $cartItem->Quantity);
                }

                Cart::where('UserID', $user->UserID)->delete();
                Log::info('Cart cleared for authenticated user:', ['userID' => $user->UserID]);
            } else {
                // Guest user logic
                $email = $session->customer_details->email ?? null;
                $shipping = $session->shipping_details->address ?? null;

                Log::info('Guest user checkout details:', [
                    'email' => $email,
                    'address' => $shipping,
                ]);

                if (!$email || !$shipping) {
                    throw new \Exception('Incomplete guest checkout details.');
                }

                $sessionCart = session('cart', []);
                Log::info('Session cart for guest user:', ['sessionCart' => $sessionCart]);

                if (empty($sessionCart)) {
                    throw new \Exception('Your cart is empty.');
                }

                // Create guest order
                $order = Order::create([
                    'OrderedBy' => 999, // Guest user ID placeholder
                    'TotalPrice' => $session->amount_total / 100, // Convert from cents to dollars
                    'guest_email' => $email,
                    'guest_address' => json_encode([
                        'street_address' => $shipping->line1,
                        'building' => $shipping->line2 ?? null,
                        'city' => $shipping->city,
                    ]),
                    'is_guest' => true,
                    'Status' => 'Pending',
                ]);

                foreach ($sessionCart as $cartItem) {
                    $item = Item::find($cartItem['ItemID']);

                    if (!$item) {
                        throw new \Exception('Item not found: ID ' . $cartItem['ItemID']);
                    }

                    OrderItem::create([
                        'OrderID' => $order->OrderID,
                        'ItemID' => $item->ItemID,
                        'Size' => $cartItem['Size'],
                        'Quantity' => $cartItem['Quantity'],
                        'TotalPrice' => $cartItem['Quantity'] * $item->Price,
                    ]);

                    $item->decrement('Quantity', $cartItem['Quantity']);
                }

                session()->forget('cart');
                Log::info('Cart session cleared for guest user.');
            }

            session()->forget('checkoutSessionId');
            Log::info('Checkout session cleared.');

            return redirect()->route('cart.view')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            Log::error('Error during checkoutSuccess:', ['error' => $e->getMessage()]);
            return redirect()->route('cart.view')->with('error', 'An error occurred during checkout. Please try again.');
        }
    }


    public function checkoutCancel()
    {
        return redirect()->route('cart.view')->with('error', 'Checkout was canceled.');
    }
}
