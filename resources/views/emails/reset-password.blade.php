<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <!-- Logo -->
        <div style="background-color: #1D4289; padding: 20px; text-align: center;">
            <img src="https://batish844.github.io/testingModelViewer/blacklogo.png" alt="Nexis Logo" style="max-width: 200px;">
        </div>

        <!-- Email Content -->
        <div style="padding: 20px;">
            <h2>Hello, {{ $name }}</h2>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Click the button below to reset your password:</p>

            <!-- Reset Button -->
            <div style="text-align: center; margin: 20px 0;">
                <a href="{{ $url }}" style="
                    display: inline-block;
                    background-color: #1D4289;
                    color: white;
                    padding: 10px 20px;
                    font-size: 16px;
                    font-weight: bold;
                    text-decoration: none;
                    border-radius: 5px;
                ">Reset Password</a>
            </div>

            <p style="margin-top: 20px;">
                This password reset link will expire in 60 minutes.
            </p>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>

        <!-- Footer -->
        <div style="background-color: #f1f1f1; padding: 10px; text-align: center; font-size: 12px; color: #555;">
            &copy; {{ date('Y') }} Nexis. All rights reserved.
        </div>
    </div>
</body>

</html>