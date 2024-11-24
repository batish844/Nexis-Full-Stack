<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;

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
        $stripe = new StripeClient(config('services.stripe.secret'));

        try {
            // Create the checkout session
            $checkoutSession = $stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Your Product Name',
                        ],
                        'unit_amount' => 1000, // $10 in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);

            return response()->json(['url' => $checkoutSession->url]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle successful payment.
     */
    public function checkoutSuccess()
    {
        return "Payment successful! Thank you for your purchase.";
    }

    /**
     * Handle canceled payment.
     */
    public function checkoutCancel()
    {
        return "Payment canceled! Please try again.";
    }
}
