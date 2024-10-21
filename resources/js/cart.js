// This code is typically executed when the document is fully loaded and ready.
$(document).ready(function() {
  // Load the cart data initially when the document is ready.
  loadCart();
  // Event handler for the quantity buttons within the cart container.
  $('.cart-container').on('click', '.quantity-btn', function(event) {
    // Retrieve cart items from local storage or initialize an empty array.
    let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const index = $(this).data('index'); // Get the index of the clicked button.
    const item = cartItems[index]; // Retrieve the corresponding item.

    if ($(this).hasClass('increase-quantity')) {
      // If the button is for increasing quantity, increment the item's quantity.
      item.quantity++;
    } else if ($(this).hasClass('decrease-quantity')) {
      // If the button is for decreasing quantity, decrement the item's quantity.
      item.quantity--;
      if (item.quantity < 1) {
        // If the quantity becomes zero or negative, remove the item from the cart.
        cartItems.splice(index, 1);
      }
    }

    // Update the cart with the modified cart items.
    updateCart(cartItems);
  });

  // Event handler for the checkout button.
  $('#checkout-button').click(function() {
    if (cartIsEmpty()) {
      // If the cart is empty, display a message indicating it's empty.
      displayCheckoutEmptyMessage();
    } else {
      // If there are items in the cart, navigate to the checkout page.
      window.location.href = 'checkout.html';
    }
  });
});

// Function to update the cart with the given cart items.
function updateCart(cartItems) {
  localStorage.setItem('cart', JSON.stringify(cartItems));
  loadCart(); // Reload the cart to reflect the changes.
}

// Function to load and display the cart items.
function loadCart() {
  let $cartContainer = $('.cart-container');
  $cartContainer.empty(); // Clear the cart container.
  let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
  let totalPrice = 0;

  // Loop through each item in the cart and display it.
  cartItems.forEach((item, index) => {
    let itemPrice = parseFloat(item.price.replace('$', ''));
    totalPrice += itemPrice * item.quantity;

    const $cartItem = $('<div>').addClass('cart-item').html(`
        <img src="${item.imgSrc}" alt="Product Image" onerror="this.src='placeholder-image.png'">
        <p>${item.price} - Size: ${item.size} (x${item.quantity})</p>
        <button class="quantity-btn decrease-quantity" data-index="${index}">-</button>
        <button class="quantity-btn increase-quantity" data-index="${index}">+</button>
    `);
    $cartContainer.append($cartItem);
  });

  // Display the total price of all items in the cart.
  const $totalPriceElement = $('<p>').addClass('total-price').text(`Total Price: $${totalPrice.toFixed(2)}`);
  $cartContainer.append($totalPriceElement);
}

// Function to check if the cart is empty.
function cartIsEmpty() {
  let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
  return cartItems.length === 0;
}

// Function to display a message when the cart is empty during checkout.
function displayCheckoutEmptyMessage() {
  $('.checkout-empty-message').remove();
  const message = $('<p>').text("It's empty here!").addClass('checkout-empty-message');
  $('#checkout-a').after(message);

  // Automatically fade out the message after 10 seconds.
  setTimeout(function() { 
    message.fadeOut(); 
  }, 10000);
}
