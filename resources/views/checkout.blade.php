<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" type="image/png" href="storage/CommonImg/BrandLogo.png">

    @vite('resources/css/checkout.css')
</head>

<body>
    <a href="/cart" id="back-to-cart-button">Back to Cart</a>

    <div class="checkout-container">
        <button id="add-address-btn" class="button">Add Address</button>
        <form id="address-form" class="address-form">
            <div class="form-group">
                <label for="country">Country:</label>
                <select id="country" required>
                    <option value="">Select a country</option>
                    <option value="USA">United States</option>
                    <option value="LEB">Lebanon</option>
                    <option value="CAN">Canada</option>
                    <option value="GBR">United Kingdom</option>
                    <option value="AUS">Australia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" placeholder="Your phone number" required>
            </div>
            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" id="street" placeholder="Street name" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" placeholder="City" required>
            </div>
            <div class="form-group">
                <label for="state">State/Province:</label>
                <input type="text" id="state" placeholder="State or Province" required>
            </div>
            <div class="form-group">
                <label for="building">Building:</label>
                <input type="text" id="building" placeholder="Building" required>
            </div>
            <div class="form-group">
                <label for="floor">Floor:</label>
                <input type="number" id="floor" placeholder="Floor" required>
            </div>
            <div class="form-group">
                <label for="card-number">Card Number:</label>
                <input type="text" id="card-number" placeholder="Card Number" required>
            </div>
            <div class="form-group">
                <label for="pin">PIN:</label>
                <input type="password" id="pin" placeholder="PIN" required>
                <input type="checkbox" id="toggle-pin"> Show PIN
            </div>
            <div class="form-group">
                <label for="expiration-date">Expiration Date:</label>
                <input type="text" id="expiration-date" placeholder="MM/YY" required>
            </div>
        </form>
        <div class="cart-items-container">
        </div>
        <button id="place-order-btn" class="button">Place Order</button>
        <p id="order-message"></p>
    </div>
    @vite('resources/js/checkout.js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>
