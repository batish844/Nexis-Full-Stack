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

        .order-items ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .order-items ul li {
            font-size: 16px;
            margin-bottom: 8px;
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

            .order-items ul li {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Order Confirmation</h1>
        </div>

        <div class="email-body">
            <h2>Hi {{ $user ? $user->First_Name : 'Customer' }},</h2>
            <p>Thank you for your order! We’re excited to get started processing it.</p>

            <div class="order-details">
                <p><strong>Order ID:</strong> {{ $order->OrderID }}</p>
                <p><strong>Total Price:</strong> ${{ number_format($order->TotalPrice, 2) }}</p>
            </div>

            <!-- Order Items -->
            <!-- <div class="order-items">
                <p><strong>Items:</strong></p>
                <ul>
                    @foreach ($order->orderItems as $orderItem)
                        <li>{{ $orderItem->Quantity }} x {{ $orderItem->item->Name }} ({{ $orderItem->Size }}) - ${{ number_format($orderItem->TotalPrice, 2) }}</li>
                    @endforeach
                </ul>
            </div> -->

            <p>We’ll process your order shortly. You’ll receive a shipping confirmation email when your items are on the way!</p>
        </div>

        <div class="email-footer">
            &copy; {{ date('Y') }} Your Company Name. All rights reserved.
            <br>
            Need help? <a href="mailto:support@yourcompany.com">Contact Us</a>
        </div>
    </div>
</body>

</html>
