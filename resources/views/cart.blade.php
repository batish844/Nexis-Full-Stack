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
@vite('resources/js/cart.js')

@endpush
