@extends('layout')

@section('title', 'Cart')

@section('content')

  <!-- Main Content -->
  <main class="container mx-auto py-10 px-4">
    <h1 class="text-4xl font-bold text-center mb-8">Your Shopping Cart</h1>

    <!-- Cart Items Section -->
    <div class="cart-container bg-white shadow-lg rounded-lg p-6">
      <div id="cart-items" class="space-y-6">
        <!-- Dynamically generated cart items will appear here -->
      </div>

      <!-- Cart Summary -->
      <div class="flex justify-between items-center font-semibold text-lg mt-4 border-t pt-4">
        <span>Total:</span>
        <span id="cart-total" class="text-blue-600 text-xl">$0.00</span>
      </div>
    </div>

    <!-- Checkout button -->
    <div class="checkout-container text-center mt-6">
      <a href="{{ url('Checkout') }}" class="checkout-a">
        <button id="checkout-button" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
          Proceed to Checkout
        </button>
      </a>
    </div>

    <!-- Empty Cart Message -->
    <div id="empty-cart-message" class="hidden text-center mt-6">
      <p class="text-gray-500">Your cart is currently empty.</p>
      <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Continue Shopping</a>
    </div>
  </main>
@endsection

@push('scripts')
  <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const cartItemsContainer = document.getElementById('cart-items');
      const emptyCartMessage = document.getElementById('empty-cart-message');
      let cartItems = []; // Initialize an empty cart

      // Function to update the cart total
      function updateCartTotal() {
        let total = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
        document.getElementById('cart-total').innerText = `$${total.toFixed(2)}`;
        emptyCartMessage.classList.toggle('hidden', cartItems.length > 0);
      }

      // Function to render cart items
      function renderCartItems() {
        cartItemsContainer.innerHTML = ''; // Clear existing items
        cartItems.forEach((item, index) => {
          const itemElement = document.createElement('div');
          itemElement.className = 'cart-item flex justify-between items-start border-b pb-4 mb-4';
          itemElement.innerHTML = `
            <div class="flex items-center space-x-4">
              <img src="${item.image}" alt="${item.name}" class="w-28 h-28 object-cover rounded-lg shadow-md transition-transform duration-200 hover:scale-105">
              <div>
                <h3 class="text-lg font-semibold text-gray-800">${item.name}</h3>
                <p class="text-gray-600 text-sm">$${item.price.toFixed(2)}</p>
                <div class="flex items-center mt-2">
                  <label for="quantity${index}" class="mr-2 text-gray-600">Quantity:</label>
                  <input type="number" id="quantity${index}" value="${item.quantity}" min="1" class="border rounded w-16 text-center focus:ring focus:ring-blue-300" onchange="updateQuantity(${index}, this.value)" />
                </div>
              </div>
            </div>
            <button class="text-red-500 hover:text-red-700 font-bold mt-2" onclick="removeItem(${index})">Remove</button>
          `;
          cartItemsContainer.appendChild(itemElement);
        });
        updateCartTotal();
      }

      // Function to update item quantity
      window.updateQuantity = function (index, quantity) {
        cartItems[index].quantity = parseInt(quantity);
        updateCartTotal();
      };

      // Function to remove an item from the cart
      window.removeItem = function (index) {
        cartItems.splice(index, 1);
        renderCartItems();
      };

      // Simulate adding items to the cart for demo
      cartItems = [
        { name: "Product 1", price: 19.99, quantity: 1, image: "https://via.placeholder.com/100" },
        { name: "Product 2", price: 29.99, quantity: 1, image: "https://via.placeholder.com/100" },
      ];
      renderCartItems();
    });
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush
