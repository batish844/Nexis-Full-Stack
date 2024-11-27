<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Stripe Checkout</h1>
    <button id="checkout-button">Pay Now</button>

    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");

        document.getElementById('checkout-button').addEventListener('click', async () => {
            try {
                const response = await fetch("{{ route('checkout.session') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const { url } = await response.json();
                window.location.href = url;
            } catch (error) {
                console.error("Error during checkout session creation:", error);
                alert("Something went wrong. Please try again.");
            }
        });
    </script>
</body>
</html>
