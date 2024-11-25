@extends('layout')

@section('title', 'Cart')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

  <!-- Cart Message -->
  <div id="cart-message"
    class="hidden text-center text-sm mx-auto font-semibold bg-red-100 text-red-700 py-2 rounded-lg mb-4 max-w-lg">
  </div>

  <div class="flex flex-col lg:flex-row lg:space-x-6">
    <!-- Cart Table -->
    <div class="w-full lg:w-2/3">
      <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-blue-600">
          <tr class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
            <th class="px-6 py-3 text-left text-white">Item</th>
            <th class="px-6 py-3 text-center text-white">Price</th>
            <th class="px-6 py-3 text-center text-white">Quantity</th>
            <th class="px-6 py-3 text-right text-white">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cartItems as $cartItem)
          @php
          // Handle authenticated user (Eloquent Model) and guest (Session Data)
          $item = isset($cartItem->item) ? $cartItem->item : $cartItem; // Eloquent model or session object
          $itemID = $item->ItemID ?? $cartItem->ItemID ?? null; // Retrieve from either case
          $itemSize = $cartItem->Size ?? 'M'; // Default size fallback
          $itemName = $item->Name ?? 'Unknown Item'; // Fallback for missing name
          $itemPhoto = $item->Photo[0] ?? 'default.jpg'; // Default photo fallback
          $itemPrice = $item->Price ?? 0; // Default price
          $itemPoints = $item->Points ?? 0; // Default points
          @endphp
          <tr class="border-b hover:bg-gray-50 transition duration-200 cart-item-row"
            data-item-id="{{ $itemID }}"
            data-size="{{ $itemSize }}"
            data-points="{{ $itemPoints }}">
            <td class="px-6 py-4 flex items-center">
              <a href="{{ $itemID ? route('store.show', ['id' => $itemID]) : '#' }}">
                <img src="{{ asset($itemPhoto) }}"
                  alt="{{ $itemName }}"
                  class="w-32 h-32 object-cover rounded-lg shadow-md mr-6">
                <div class="text-gray-800 font-medium">
                  <div class="text-2xl font-semibold text-gray-800 py-2">{{ $itemName }}</div>
              </a>
              <div class="text-sm text-gray-500 py-2">
                <strong>Size:</strong> {{ $itemSize }}
              </div>
    </div>
    </td>
    <td class="px-6 py-4 text-center text-gray-600">${{ number_format($itemPrice, 2) }}</td>
    <td class="px-6 py-4 text-center">
      <div class="flex items-center justify-center space-x-2">
        <button class="decrement-button bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300">-</button>
        <span class="cart-quantity text-gray-800 font-medium">{{ $cartItem->Quantity }}</span>
        <button class="increment-button bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300">+</button>
      </div>
    </td>
    <td class="px-6 py-4 text-right text-gray-800 font-semibold">
      $<span class="cart-subtotal">{{ number_format($cartItem->Quantity * $itemPrice, 2) }}</span>
    </td>
    </tr>
    @endforeach
    <tr class="bg-gray-100">
      <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-800">Total Price:</td>
      <td class="px-6 py-4 text-right font-bold text-blue-600">
        $<span id="total-price">{{ number_format($totalPrice, 2) }}</span>
      </td>
    </tr>
    <tr class="bg-gray-100">
      <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-800">Total Points:</td>
      <td class="px-6 py-4 text-right font-bold text-green-600">
        <span id="total-points">{{ $totalPoints }}</span>
      </td>
    </tr>
    </tbody>
    </table>
  </div>

  <div class="w-full lg:w-1/3 bg-white shadow-lg rounded-lg p-6 space-y-8">
    <div>
      <h2 class="text-2xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Delivery Details</h2>

      @if (Auth::check())
      @if (empty($address))
      <p class="text-red-600 text-sm">
        No address found. Please <a href="{{ route('profile.index') }}" class="text-blue-600 underline">update your profile</a>.
      </p>
      @else
      <p class="text-gray-800 text-sm leading-6">
        <span class="font-medium">Street Address:</span> {{ $address['street_address'] ?? '' }}<br>
        <span class="font-medium">Building:</span> {{ $address['building'] ?? '' }}<br>
        <span class="font-medium">City:</span> {{ $address['city'] ?? '' }}<br>
        <span class="font-medium">Phone:</span> {{ $Phone_Number ?? '' }}
      </p>
      @endif
      @else
      <form id="guest-address-form" class="space-y-4">
        <div>
          <label for="guest-name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" id="guest-name" name="guest_name" class="w-full border border-gray-300 rounded-lg p-2 text-sm" placeholder="Enter your name" required>
        </div>
        <div>
          <label for="guest-street-address" class="block text-sm font-medium text-gray-700">Street Address</label>
          <input type="text" id="guest-street-address" name="street_address" class="w-full border border-gray-300 rounded-lg p-2 text-sm" placeholder="Enter your street address" required>
        </div>
        <div>
          <label for="guest-building" class="block text-sm font-medium text-gray-700">Building</label>
          <input type="text" id="guest-building" name="building" class="w-full border border-gray-300 rounded-lg p-2 text-sm" placeholder="Enter your building number" required>
        </div>
        <div>
          <label for="guest-city" class="block text-sm font-medium text-gray-700">City</label>
          <input type="text" id="guest-city" name="city" class="w-full border border-gray-300 rounded-lg p-2 text-sm" placeholder="Enter your city" required>
        </div>
        <div>
          <label for="guest-phone" class="block text-sm font-medium text-gray-700">Phone</label>
          <input type="text" id="guest-phone" name="phone_number" class="w-full border border-gray-300 rounded-lg p-2 text-sm" placeholder="Enter your phone number" required>
        </div>
      </form>
      @endif
    </div>

    <div class="border-2 border-blue-500 p-6 rounded-lg space-y-8">
      <div>
        <h2 class="text-2xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Cart Summary</h2>
        <div class="flex justify-between items-center py-2 text-sm">
          <span class="text-gray-600">Total Items:</span>
          <span class="font-bold text-gray-800">{{ $cartItems->count() }}</span>
        </div>
        <div class="flex justify-between items-center py-2 text-sm">
          <span class="text-gray-600">Total Price:</span>
          <span id="total-price-sum" class="font-bold text-blue-600">${{ number_format($totalPrice, 2) }}</span>
        </div>
        <div class="flex justify-between items-center py-2 text-sm">
          <span class="text-gray-600">Total Points:</span>
          <span id="total-points-summary" class="font-bold text-green-600">{{ $totalPoints }}</span>
        </div>
      </div>

      <div>
        <h3 class="text-xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Redeem Points</h3>
        <div class="flex items-center space-x-3 mb-3">
          <input type="number" id="points-to-redeem"
            class="flex-1 border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:ring focus:ring-blue-100"
            placeholder="Enter points to redeem"
            min="0"
            max="{{ $availablePoints }}">
          <button id="max-points-btn"
            class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-500 transition">
            Max
          </button>
        </div>
        <p class="text-sm text-gray-600">
          <span class="font-medium">Available Points:</span> <span id="available-points">{{ $availablePoints }}</span>
        </p>
        <p class="text-sm text-gray-600">
          <span class="font-medium">Value:</span> $<span id="points-value">0.00</span>
        </p>
      </div>

      <div class="flex justify-between items-center text-sm">
        <span class="text-gray-600">Adjusted Total Price:</span>
        <span class="font-bold text-blue-600">$<span id="adjusted-total-price">{{ number_format($totalPrice, 2) }}</span></span>
      </div>
    </div>

    <a href="#"
      class="block w-full py-3 text-center bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 transition-all">
      Proceed to Checkout
    </a>
  </div>
</div>
</div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const cartMessage = document.getElementById('cart-message');
    const cartRows = document.querySelectorAll('.cart-item-row');
    const totalPriceEl = document.getElementById('total-price');
    const totalPriceSum = document.getElementById('total-price-sum');
    const totalPointsEl = document.getElementById('total-points');
    const adjustedTotalPriceEl = document.getElementById('adjusted-total-price');
    const pointsToRedeemInput = document.getElementById('points-to-redeem');
    const maxPointsBtn = document.getElementById('max-points-btn');
    const pointsValueElement = document.getElementById('points-value');

    const availablePoints = parseInt('{{ $availablePoints }}');

    const updateSummaryValues = () => {
      let totalPrice = 0;
      let totalPoints = 0;

      cartRows.forEach(row => {
        const quantity = parseInt(row.querySelector('.cart-quantity').textContent);
        const subtotal = parseFloat(row.querySelector('.cart-subtotal').textContent);
        const points = parseFloat(row.dataset.points || 0);

        totalPrice += subtotal;
        totalPoints += quantity * points;
      });

      totalPriceEl.textContent = totalPrice.toFixed(2);
      totalPointsEl.textContent = totalPoints;
      totalPriceSum.textContent = totalPrice.toFixed(2);
      updateAdjustedTotalPrice(totalPrice);
    };

    const updateAdjustedTotalPrice = (totalPrice) => {
      const pointsToRedeem = Math.min(
        parseInt(pointsToRedeemInput.value) || 0,
        availablePoints,
        Math.floor(totalPrice / 0.30)
      );
      const pointsValue = pointsToRedeem * 0.30;
      const adjustedPrice = totalPrice - pointsValue;

      pointsToRedeemInput.value = pointsToRedeem;
      pointsValueElement.textContent = pointsValue.toFixed(2);
      adjustedTotalPriceEl.textContent = adjustedPrice.toFixed(2);

    };

    const updateCart = async (itemID, size, action) => {
      try {
        const response = await fetch('/cart/update', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({
            itemID,
            size,
            action
          }),
        });

        const data = await response.json();
        if (!response.ok || !data.success) {
          if (data.message) {
            showCartMessage(data.message);
          }
          return null;
        }
        const row = document.querySelector(`.cart-item-row[data-item-id="${itemID}"][data-size="${size}"]`);
        if (data.newQuantity > 0) {
          row.querySelector('.cart-quantity').textContent = data.newQuantity;
          row.querySelector('.cart-subtotal').textContent = (data.newQuantity * data.itemPrice).toFixed(2);
        } else {
          row.remove();
        }
        if (window.updateCartCounters) {
          window.updateCartCounters();
        }

        updateSummaryValues();
      } catch (error) {
        console.error(error);
        showCartMessage('An unexpected error occurred. Please try again.');
        alert('An error occurred while updating the cart.');
      }
    };
    const showCartMessage = (message) => {
      if (cartMessage) {
        cartMessage.textContent = message;
        cartMessage.classList.remove('hidden');
        cartMessage.classList.add('block');

        setTimeout(() => {
          cartMessage.classList.add('hidden');
          cartMessage.classList.remove('block');
        }, 3000);
      }
    };
    cartRows.forEach(row => {
      const incrementButton = row.querySelector('.increment-button');
      const decrementButton = row.querySelector('.decrement-button');
      const itemID = row.dataset.itemId;
      const size = row.dataset.size;

      incrementButton.addEventListener('click', () => updateCart(itemID, size, 'increment'));
      decrementButton.addEventListener('click', () => updateCart(itemID, size, 'decrement'));
    });

    pointsToRedeemInput.addEventListener('input', () => updateAdjustedTotalPrice(parseFloat(totalPriceEl.textContent)));
    maxPointsBtn.addEventListener('click', () => {
      pointsToRedeemInput.value = Math.min(
        availablePoints,
        Math.floor(parseFloat(totalPriceEl.textContent) / 0.30)
      );
      updateAdjustedTotalPrice(parseFloat(totalPriceEl.textContent));
    });

    updateSummaryValues();
  });
</script>