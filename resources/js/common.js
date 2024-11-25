$(document).ready(function () {
    $("button").click(function (event) {
        var email = $("#email").val();
        var tel = $("#tel").val();
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var isValid = true;

        $(".error-message, .thank-you-message").hide(); // Hide previous messages

        if (!email.match(emailRegex)) {
            $("#email-error").text("Invalid email").show();
            isValid = false;
        }

        if (tel.length < 8) {
            $("#tel-error").text("Invalid phone number").show();
            isValid = false;
        }

        if (isValid) {
            $(".thank-you-message").text("Thank you!").show();
            // Clear the input fields
            $("#email").val("");
            $("#tel").val("");
        }

        setTimeout(function () {
            $(".error-message, .thank-you-message").fadeOut();
        }, 10000);
    });
});
function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let count = cart.length;
    document.getElementById("cart-count").innerText = count;
}

// Function to reset the cart count and cart in localStorage
function resetCartCount() {
    document.getElementById("cart-count").innerText = "0";
    localStorage.removeItem("cart");
}

