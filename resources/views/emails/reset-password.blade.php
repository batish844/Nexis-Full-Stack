<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #1D4289;
            padding: 20px;
            text-align: center;
        }

        .email-header img {
            max-width: 180px;
            height: auto;
        }

        .email-body {
            padding: 20px;
            color: #333;
        }

        .email-body h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        .cta-button {
            display: inline-block;
            background-color: #1D4289;
            color: #fff !important; /* Ensure the text color is white */
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }

        .cta-button:hover {
            background-color: #16326e;
            color: #fff !important; /* Keep text white on hover as well */
        }

        .email-footer {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        @media only screen and (max-width: 480px) {
            .email-body h2 {
                font-size: 18px;
            }

            .email-body p {
                font-size: 14px;
            }

            .cta-button {
                padding: 10px 20px;
                font-size: 14px;
            }

            .email-header img {
                max-width: 150px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <img src="https://batish844.github.io/testingModelViewer/blacklogo.png" alt="Nexis Logo" aria-label="Nexis Logo">
        </div>

        <div class="email-body">
            <h2>Hello, {{ $name }}</h2>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Click the button below to reset your password:</p>

            <div style="text-align: center;">
                <a href="{{ $url }}" class="cta-button" aria-label="Reset your password" style="
                    display: inline-block;
                    background-color: #1D4289;
                    color: #fff !important; /* Text is always white */
                    padding: 12px 24px;
                    font-size: 16px;
                    font-weight: bold;
                    text-decoration: none;
                    border-radius: 5px;
                ">
                    Reset Password
                </a>
            </div>

            <p>This password reset link will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>

        <div class="email-footer">
            &copy; {{ date('Y') }} Nexis. All rights reserved.
        </div>
    </div>
</body>

</html>
