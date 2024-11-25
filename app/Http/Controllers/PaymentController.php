<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            if (Auth::check()) {
                // ========== AUTHENTICATED USER LOGIC ==========
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
                            'unit_amount' => intval($cartItem->item->Price * 100), // Convert to cents
                        ],
                        'quantity' => $cartItem->Quantity,
                    ];
                })->values()->toArray();

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
                // ========== GUEST USER LOGIC ==========
                return $this->createGuestCheckoutSession($stripe);
            }
        } catch (\Exception $e) {
            Log::error('Error creating checkout session:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error creating checkout session: ' . $e->getMessage()], 500);
        }
    }

    private function createGuestCheckoutSession($stripe)
    {
        try {
            $sessionCart = session('cart', []);

            // Log the session cart for debugging
            Log::info('Session Cart Content:', ['cart' => $sessionCart]);

            if (empty($sessionCart)) {
                throw new \Exception('Your cart is empty.');
            }

            $lineItems = collect($sessionCart)->map(function ($cartItem) {
                // ... validation and mapping code
            })->values()->toArray();

            // Log the generated line_items for debugging
            Log::info('Generated line_items for Stripe:', ['line_items' => $lineItems]);

            $checkoutSession = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
                'shipping_address_collection' => [
                    'allowed_countries' => ['US', 'CA', 'GB'], // Modify as needed
                ],
                'customer_creation' => 'always', // Add this line
            ]);

            session(['checkoutSessionId' => $checkoutSession->id]);
            return response()->json(['url' => $checkoutSession->url]);
        } catch (\Exception $e) {
            Log::error('Error creating checkout session for guest:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error creating checkout session: ' . $e->getMessage()], 500);
        }
    }


    public function checkoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            $sessionId = $request->query('session_id');
            $session = $stripe->checkout->sessions->retrieve($sessionId, [
                'expand' => ['customer_details', 'shipping'],
            ]);

            if (!$session) {
                throw new \Exception('Invalid Stripe session.');
            }

            if (Auth::check()) {
                // ========== AUTHENTICATED USER LOGIC ==========
                $user = Auth::user();
                $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();

                if ($cartItems->isEmpty()) {
                    throw new \Exception('Your cart is empty.');
                }

                // Create order
                $order = Order::create([
                    'OrderedBy' => $user->UserID,
                    'TotalPrice' => $session->amount_total / 100, // Convert from cents to dollars
                    'is_guest' => false,
                    'Status' => 'Pending',
                ]);

                // Create order items and reduce stock
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'OrderID' => $order->OrderID,
                        'ItemID' => $cartItem->item->ItemID,
                        'Size' => $cartItem->Size,
                        'Quantity' => $cartItem->Quantity,
                        'TotalPrice' => $cartItem->Quantity * $cartItem->item->Price,
                    ]);

                    // Reduce stock quantity
                    $cartItem->item->decrement('Quantity', $cartItem->Quantity);
                }

                // Clear cart items from the database
                Cart::where('UserID', $user->UserID)->delete();
            } else {
                // ========== GUEST USER LOGIC ==========
                $email = $session->customer_details->email ?? null;
                $address = $session->shipping ? $session->shipping->address : null;

                if (!$email || !$address) {
                    throw new \Exception('Incomplete guest checkout details.');
                }

                $sessionCart = session('cart', []);

                if (empty($sessionCart)) {
                    throw new \Exception('Your cart is empty.');
                }

                // Create order
                $order = Order::create([
                    'OrderedBy' => 999, // Guest user ID
                    'TotalPrice' => $session->amount_total / 100, // Convert from cents to dollars
                    'guest_email' => $email,
                    'guest_address' => json_encode([
                        'street' => $address->line1,
                        'city' => $address->city,
                        'building' => $address->line2 ?? null,
                    ]),
                    'is_guest' => true,
                    'Status' => 'Pending',
                ]);

                // Create order items and reduce stock
                foreach ($sessionCart as $cartItem) {
                    // Fetch item from database
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

                    // Reduce stock quantity
                    $item->decrement('Quantity', $cartItem['Quantity']);
                }

                // Clear session cart
                session()->forget('cart');
            }

            // Clear the checkout session ID
            session()->forget('checkoutSessionId');

            // Redirect with success message
            return redirect()->route('cart.view')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            Log::error('Error during checkoutSuccess:', ['error' => $e->getMessage()]);
            return redirect()->route('cart.view')->with('error', 'An error occurred during checkout.');
        }
    }

    public function checkoutCancel()
    {
        return redirect()->route('cart.view')->with('error', 'Checkout was cancelled.');
    }
}
