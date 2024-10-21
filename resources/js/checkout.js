$(document).ready(function() {
    // Event handler for the "Place Order" button
    $('#place-order-btn').click(function(event) {
        event.preventDefault();
        if (validateForm()) {
            processOrder();
        }
    });

    // Event handler for the cart icon
    $('#cart-icon').click(function(event) {
        event.preventDefault();
        checkCartBeforeRedirect();
    });
});

// Function to validate the checkout form fields
function validateForm() {
    let isValid = true;
    $('.error-message').remove(); // Remove any existing error messages

        // Add validation for each field
        if ($('#country').val() === '') {
            showError('#country', 'Please select a country');
            isValid = false;
        }
    
        if ($('#phone').val().trim() === '') {
            showError('#phone', 'Please enter your phone number');
            isValid = false;
        }
    
        if ($('#street').val().trim() === '') {
            showError('#street', 'Please enter your street');
            isValid = false;
        }
    
        if ($('#city').val().trim() === '') {
            showError('#city', 'Please enter your city');
            isValid = false;
        }
    
        if ($('#state').val().trim() === '') {
            showError('#state', 'Please enter your state or province');
            isValid = false;
        }
    
        if ($('#building').val().trim() === '') {
            showError('#building', 'Please enter your building');
            isValid = false;
        }
    
        if ($('#floor').val().trim() === '') {
            showError('#floor', 'Please enter your floor');
            isValid = false;
        }
    
        // Validation for card number (16 digits)
        const cardNumber = $('#card-number').val().trim();
        if (cardNumber === '' || !/^\d{16}$/.test(cardNumber)) {
            showError('#card-number', 'Please enter a valid 16-digit card number');
            isValid = false;
        }
    
        // Validation for PIN (4 digits)
        const pin = $('#pin').val().trim();
        if (pin === '' || !/^\d{4}$/.test(pin)) {
            showError('#pin', 'Please enter a valid 4-digit PIN');
            isValid = false;
        }
    
        // Validation for expiration date (MM/YY format)
        const expirationDate = $('#expiration-date').val().trim();
        if (expirationDate === '' || !/^(0[1-9]|1[0-2])\/\d{2}$/.test(expirationDate)) {
            showError('#expiration-date', 'Please enter a valid expiration date in MM/YY format');
            isValid = false;
        }
    
        return isValid;
    }
    

// Function to show error message for a specific field
function showError(selector, message) {
    $('<span class="error-message">' + message + '</span>').insertAfter(selector);
}

// Function to process the order after form validation

function processOrder() {
    // Change the button text to "Processing..."
    $('#place-order-btn').text('Processing...').prop('disabled', true);

    // Simulate order processing delay
    setTimeout(function() {
        // Display order success message and change the button text
        $('#order-message').text('You will be directed to the homepage now!').css('color', 'green').show();
        $('#place-order-btn').text('Order has been placed successfully!');

        // Clear the cart items
        clearCart(); 

        // Hide the button after 3 seconds
        setTimeout(function() {
            $('#place-order-btn').fadeOut();
        }, 3000);

        // Redirect to the homepage after a delay
        setTimeout(function() {
            $('#order-message').fadeOut();
            redirectToHomePage();
        }, 6000); // Wait for 6 seconds before redirecting
    }, 3000); // Wait for 3 seconds to simulate order processing
}


// Function to clear the cart items
function clearCart() {
    localStorage.setItem('cart', JSON.stringify([])); // Set the cart in localStorage to an empty array
}

// Function to redirect to the homepage
function redirectToHomePage() {
    window.location.href = 'homepage.html'; // Replace with the correct path to your homepage
}

// Function to check if the cart is empty before redirecting to the checkout page
function checkCartBeforeRedirect() {
    if (cartIsEmpty()) {
        displayCartEmptyMessage();
    } else {
        window.location.href = 'checkout.html';
    }
}

// Function to check if the cart is empty
function cartIsEmpty() {
    let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    return cartItems.length === 0;
}

// Function to display a message when the cart is empty
function displayCartEmptyMessage() {
    const message = $('<p>').text("It's empty here!").addClass('cart-empty-message');
    $('#cart-icon').after(message);
    setTimeout(function() { 
        message.fadeOut(); 
    }, 10000); // Message will disappear after 10 seconds
}
$(document).ready(function() {

    // Event handler to toggle PIN visibility
    $('#toggle-pin').change(function() {
        if ($(this).is(':checked')) {
            $('#pin').attr('type', 'text');
        } else {
            $('#pin').attr('type', 'password');
        }
    });
});

