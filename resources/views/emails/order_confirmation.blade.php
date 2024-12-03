<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #1D4289;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
            color: #333;
        }

        .email-body h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .order-details {
            margin: 20px 0;
        }

        .order-details strong {
            color: #1D4289;
        }

        .email-footer {
            background-color: #f1f1f1;
            color: #555;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        .email-footer a {
            color: #1D4289;
            text-decoration: none;
        }

        @media only screen and (max-width: 480px) {
            .email-body p {
                font-size: 14px;
            }

            .email-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <img src="https://batish844.github.io/testingModelViewer/blacklogo.png" alt="Nexis Logo" aria-label="Nexis Logo" style="max-width: 100px; height: auto; margin-bottom: 10px;">
            <h1>Order Confirmation</h1>
        </div>

        <div class="email-body">
            <h2>Hi {{ $user ? $user->First_Name : 'Customer' }},</h2>
            <p>Thank you for your order! We’re excited to get started processing it.</p>

            <div class="order-details">
                <p><strong>Order ID:</strong> {{ $order->OrderID }}</p>
                <p><strong>Total Price:</strong> ${{ number_format($order->TotalPrice, 2) }}</p>
            </div>

            <p>We’ll process your order shortly. You’ll receive a shipping confirmation email when your items are on the way!</p>

            <!-- View Order Button -->
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ url('/profile/orders') }}" style="background-color: #1D4289; color: #ffffff; text-decoration: none; padding: 10px 20px; font-size: 16px; border-radius: 5px; display: inline-block;">
                    View Your Order
                </a>
            </div>
        </div>

        <div class="email-footer">
            &copy; {{ date('Y') }} Nexis. All rights reserved.
            <br>
            Need help? <a href="{{ url('/contact-us') }}">Contact Us</a>
        </div>
    </div>
</body>

</html>
