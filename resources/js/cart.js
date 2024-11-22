$(document).ready(function() {
  // Load cart and wishlist data initially when the document is ready.
  loadCart();
  loadWishlist();

  // Event handler for the quantity buttons within the cart container.
  $('.cart-container').on('click', '.quantity-btn', function(event) {
    let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const index = $(this).data('index');
    const item = cartItems[index];

    if ($(this).hasClass('increase-quantity')) {
      item.quantity++;
    } else if ($(this).hasClass('decrease-quantity')) {
      item.quantity--;
      if (item.quantity < 1) {
        cartItems.splice(index, 1);
      }
    }

    updateCart(cartItems);
  });

  // Event handler for the checkout button.
  $('#checkout-button').click(function() {
    if (cartIsEmpty()) {
      displayCheckoutEmptyMessage();
    } else {
      window.location.href = 'checkout.html';
    }
  });

  // Event handler for wishlist button (add/remove item from wishlist).
  $('.wishlist-btn').click(function() {
    let itemId = $(this).data('item-id');  // Assume the button has a data attribute with item ID.
    let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

    if ($(this).hasClass('wishlisted')) {
      // If the item is already in the wishlist, remove it.
      wishlist = wishlist.filter(item => item.ItemID !== itemId);
      $(this).removeClass('wishlisted').addClass('not-wishlisted');
    } else {
      // Add item to the wishlist
      wishlist.push({ ItemID: itemId, Name: $(this).data('name'), Price: $(this).data('price') });
      $(this).removeClass('not-wishlisted').addClass('wishlisted');
    }

    // Update the wishlist in local storage and refresh the wishlist preview.
    localStorage.setItem('wishlist', JSON.stringify(wishlist));
    loadWishlist();
  });
});

// Function to update the cart with the given cart items.
function updateCart(cartItems) {
  localStorage.setItem('cart', JSON.stringify(cartItems));
  loadCart();  // Reload the cart to reflect the changes.
}

// Function to load and display the cart items.
function loadCart() {
  let $cartContainer = $('.cart-container');
  $cartContainer.empty();  // Clear the cart container.
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

// Function to load and display the wishlist items in the preview section.
function loadWishlist() {
  let $wishlistContainer = $('#wishlist-items');
  $wishlistContainer.empty();  // Clear the wishlist preview.
  let wishlistItems = JSON.parse(localStorage.getItem('wishlist')) || [];

  // Loop through each item in the wishlist and display it.
  wishlistItems.forEach(item => {
    const $wishlistItem = $('<div>').addClass('wishlist-item').html(`
        <p>${item.Name} - ${item.Price}</p>
        <button class="remove-wishlist-btn" data-item-id="${item.ItemID}">Remove</button>
    `);
    $wishlistContainer.append($wishlistItem);
  });
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

// Event handler to remove items from the wishlist.
$('#wishlist-items').on('click', '.remove-wishlist-btn', function() {
  let itemId = $(this).data('item-id');
  let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

  // Remove item from wishlist
  wishlist = wishlist.filter(item => item.ItemID !== itemId);
  localStorage.setItem('wishlist', JSON.stringify(wishlist));
  loadWishlist();  // Refresh the wishlist view
});
