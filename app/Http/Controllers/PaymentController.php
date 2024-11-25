<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;

class PaymentController extends Controller
{
    /**
     * Show the checkout page.
     */
    public function checkoutForm()
    {
        return view('payment');
    }

    /**
     * Create a Stripe Checkout session.
     */
    public function createCheckoutSession(Request $request)
    {
        if (Auth::check()) {
            // ======= AUTHENTICATED USER LOGIC =======
            $user = Auth::user();

            // Retrieve cart items from the database
            $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();

            // Check if cart is empty
            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Your cart is empty.'], 400);
            }

            // Calculate total price
            $totalPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->Quantity * $cartItem->item->Price;
            });

            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            try {
                // Prepare line items for Stripe
                $lineItems = $cartItems->map(function ($cartItem) {
                    $itemPrice = intval($cartItem->item->Price * 100); // Price in cents
                    return [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $cartItem->item->Name,
                            ],
                            'unit_amount' => $itemPrice,
                        ],
                        'quantity' => $cartItem->Quantity,
                    ];
                })->toArray();

                // Create Stripe Checkout session
                $checkoutSession = $stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'customer_email' => $user->email, // Pre-fill customer email
                    'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('checkout.cancel'),
                ]);

                // Store the session ID
                session(['checkoutSessionId' => $checkoutSession->id]);

                // Return the Stripe Checkout URL
                return response()->json(['url' => $checkoutSession->url]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error creating checkout session: ' . $e->getMessage()], 500);
            }
        } else {
            // ======= GUEST USER LOGIC =======

            // Retrieve cart items from the session
            $sessionCart = session('cart', []);

            // Check if cart is empty
            if (empty($sessionCart)) {
                return response()->json(['error' => 'Your cart is empty.'], 400);
            }

            // Map session cart items to cart items
            $cartItems = collect($sessionCart)->map(function ($cartItem) {
                $item = Item::find($cartItem['ItemID']);
                if (!$item) {
                    throw new \Exception('An item in your cart is no longer available.');
                }
                return (object) [
                    'item' => $item,
                    'Size' => $cartItem['Size'],
                    'Quantity' => $cartItem['Quantity'],
                ];
            });

            // Calculate total price
            $totalPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->Quantity * $cartItem->item->Price;
            });

            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            try {
                // Prepare line items for Stripe
                $lineItems = $cartItems->map(function ($cartItem) {
                    $itemPrice = intval($cartItem->item->Price * 100); // Price in cents
                    return [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $cartItem->item->Name,
                            ],
                            'unit_amount' => $itemPrice,
                        ],
                        'quantity' => $cartItem->Quantity,
                    ];
                })->toArray();

                // Create Stripe Checkout session
                $checkoutSession = $stripe->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    // Do not set 'customer_email' for guests; Stripe will collect it
                    'shipping_address_collection' => [
                        'allowed_countries' => ['US'], // Adjust as needed
                    ],
                    'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('checkout.cancel'),
                ]);

                // Store the session ID
                session(['checkoutSessionId' => $checkoutSession->id]);

                // Return the Stripe Checkout URL
                return response()->json(['url' => $checkoutSession->url]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Error creating checkout session: ' . $e->getMessage()], 500);
            }
        }
    }




    /**
     * Handle successful payment.
     */
    public function checkoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        try {
            // Retrieve the session ID from the query parameter
            $sessionId = $request->query('session_id');

            // Retrieve the checkout session from Stripe
            $session = $stripe->checkout->sessions->retrieve($sessionId, [
                'expand' => ['customer_details', 'shipping'],
            ]);

            $email = $session->customer_details->email ?? null;
            $address = $session->shipping ? $session->shipping->address : null;

            if (Auth::check()) {
                // ======= AUTHENTICATED USER LOGIC =======
                $user = Auth::user();

                // Retrieve cart items from the database
                $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();

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
                return $this->createCheckoutSessionForGuestUser($stripe);
            }

            // Clear the checkout session ID
            session()->forget('checkoutSessionId');

            // Redirect with success message
            return redirect()->route('cart.view')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error during checkoutSuccess:', ['error' => $e->getMessage()]);

            // Redirect with error message
            return redirect()->route('cart.view')->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }
    private function createCheckoutSessionForGuestUser($stripe)
    {    $sessionCart = session('cart', []);
        // Validate session cart
        return response()->json([
            'sessionCart' => $sessionCart,
        ]);
    }
}
