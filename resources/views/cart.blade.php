@extends('layout')

@section('title', 'Cart')
<link href="/" rel="stylesheet">
@section('content')
<div class="container mx-auto p-4 sm:p-6">
  <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6">Your Cart</h1>

  @if(session('success'))
  <div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
    {{ session('success') }}
  </div>
  @endif

  <div class="flex flex-col lg:flex-row lg:space-x-6">
    <div class="w-full lg:w-2/3">
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
          <thead class="bg-blue-600">
            <tr class="text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wider">
              <th class="px-4 sm:px-6 py-3 text-left text-white">Item</th>
              <th class="px-4 sm:px-6 py-3 text-center text-white">Price</th>
              <th class="px-4 sm:px-6 py-3 text-center text-white">Quantity</th>
              <th class="px-4 sm:px-6 py-3 text-right text-white">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cartItems as $cartItem)
            @php
            $item = isset($cartItem->item) ? $cartItem->item : $cartItem;
            $itemID = $item->ItemID ?? $cartItem['ItemID'] ?? null;
            $itemSize = $cartItem->Size ?? $cartItem['Size'] ?? 'M';
            $itemName = $item->Name ?? $cartItem['Name'] ?? 'Unknown Item';
            $itemPhoto = $item->Photo[0] ?? 'default.jpg';
            $itemPrice = $item->Price ?? $cartItem['Price'] ?? 0;
            $itemPoints = $item->Points ?? 0;
            @endphp
            <tr class="border-b hover:bg-gray-50 transition duration-200 cart-item-row"
              data-item-id="{{ $itemID }}"
              data-size="{{ $itemSize }}"
              data-points="{{ $itemPoints }}">
      <td class="px-4 sm:px-6 py-4 flex flex-col sm:flex-row items-center">
        <a href="{{ $itemID ? route('store.show', ['id' => $itemID]) : '#' }}" class="flex-shrink-0">
            <img src="{{ Storage::url($itemPhoto) }}"
            alt="{{ $itemName }}"
            class="w-16 h-16 sm:w-24 sm:h-24 object-cover rounded-lg shadow-md mb-2 sm:mb-0 mr-0 sm:mr-6">
        </a>
        <div class="text-gray-800 font-medium sm:ml-4">
          <a href="{{ $itemID ? route('store.show', ['id' => $itemID]) : '#' }}">
            <div class="text-sm sm:text-lg font-semibold text-gray-800 py-2">{{ $itemName }}</div>
          </a>
          <div class="text-xs sm:text-sm text-gray-500 py-2">
            <strong>Size:</strong> {{ $itemSize }}
          </div>
        </div>
      </td>
      <td class="px-4 sm:px-6 py-4 text-center text-gray-600">${{ number_format($itemPrice, 2) }}</td>
      <td class="px-4 sm:px-6 py-4 text-center">
        <div class="flex items-center justify-center space-x-2">
          <button class="decrement-button bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300">-</button>
          <span class="cart-quantity text-gray-800 font-medium">{{ $cartItem->Quantity ?? $cartItem['Quantity'] }}</span>
          <button class="increment-button bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300">+</button>
        </div>
      </td>
      <td class="px-4 sm:px-6 py-4 text-right text-gray-800 font-semibold">
        $<span class="cart-subtotal">{{ number_format(($cartItem->Quantity ?? $cartItem['Quantity']) * $itemPrice, 2) }}</span>
      </td>
      </tr>
      @endforeach
      <tr class="bg-gray-100">
        <td colspan="3" class="px-4 sm:px-6 py-4 text-right font-bold text-gray-800">Total Price:</td>
        <td class="px-4 sm:px-6 py-4 text-right font-bold text-blue-600">
          $<span id="total-price">{{ number_format($totalPrice, 2) }}</span>
        </td>
      </tr>
      <tr class="bg-gray-100">
        <td colspan="3" class="px-4 sm:px-6 py-4 text-right font-bold text-gray-800">Total Points:</td>
        <td class="px-4 sm:px-6 py-4 text-right font-bold text-green-600">
          <span id="total-points">{{ $totalPoints }}</span>
        </td>
      </tr>
      </tbody>
      </table>
    </div>
  </div>

  <div class="w-full lg:w-1/3 bg-white shadow-lg rounded-lg p-4 sm:p-6 space-y-6">
    <div>
      <h2 class="text-lg sm:text-2xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Delivery Details</h2>
      <div id="cart-message"
        class="hidden text-center text-sm mx-auto font-semibold bg-red-100 text-red-700 py-2 rounded-lg mb-4 max-w-lg"></div>
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
      <p class="text-gray-800 text-sm">
        Your delivery details will be collected during checkout.
      </p>
      @endif
    </div>

    <div class="border-2 border-blue-500 p-6 rounded-lg space-y-8">
      <div>
        @if(session('error'))
        <div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
          {{ session('error') }}
        </div>
        @endif
        <h2 class="text-2xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Cart Summary</h2>
        <div class="flex justify-between items-center py-2 text-sm">
          <span class="text-gray-600">Total Price:</span>
          <span id="total-price-sum" class="font-bold text-blue-600">${{ number_format($totalPrice, 2) }}</span>
        </div>
        <div class="flex justify-between items-center py-2 text-sm">
          <span class="text-green-600">Points To Earn:</span>
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
        <p class="text-sm text-gray-600">
        1<i class="fas fa-trophy text-yellow-400"></i>  = $0.30
        </p>
      </div>

      <div class="flex justify-between items-center text-sm">
        <span class="text-gray-600">Adjusted Total Price:</span>
        <span class="font-bold text-blue-600">$<span id="adjusted-total-price">{{ number_format($totalPrice, 2) }}</span></span>
      </div>
    </div>

    <a id="proceed-to-checkout-btn"
      href="#"
      class="block w-full py-3 text-center bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 transition-all">
      Proceed to Checkout
    </a>
    <div class="flex justify-center mt-4">
      <img src="{{ Storage::url('img/CommonImg/visa.png') }}" alt="Visa" class="h-6 sm:h-8 mx-2">
      <img src="{{ Storage::url('img/CommonImg/mastercard.webp') }}" alt="Mastercard" class="h-6 sm:h-8 mx-2">
    </div>
  </div>
</div>
</div>
@endsection
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let cartMessage = document.getElementById('cart-message');
    let cartRows = document.querySelectorAll('.cart-item-row');
    let totalPriceEl = document.getElementById('total-price');
    let totalPriceSum = document.getElementById('total-price-sum');
    let totalPointsEl = document.getElementById('total-points');
    let totalPointsSummaryEl = document.getElementById('total-points-summary'); // Added
    let adjustedTotalPriceEl = document.getElementById('adjusted-total-price');
    let pointsToRedeemInput = document.getElementById('points-to-redeem');
    let maxPointsBtn = document.getElementById('max-points-btn');
    let pointsValueElement = document.getElementById('points-value');
    let availablePoints = parseInt('{{ $availablePoints }}');

    let updateSummaryValues = () => {
      let totalPrice = 0;
      let totalPoints = 0;

      cartRows.forEach(row => {
        let quantity = parseInt(row.querySelector('.cart-quantity').textContent);
        let subtotal = parseFloat(row.querySelector('.cart-subtotal').textContent);
        let points = parseFloat(row.dataset.points || 0);

        totalPrice += subtotal;
        totalPoints += quantity * points;
      });

      totalPriceEl.textContent = totalPrice.toFixed(2);
      totalPriceSum.textContent = totalPrice.toFixed(2);
      totalPointsEl.textContent = totalPoints;
      totalPointsSummaryEl.textContent = totalPoints;
      updateAdjustedTotalPrice(totalPrice);
    };

    let updateAdjustedTotalPrice = (totalPrice) => {
      let maxPointsToRedeem = Math.min(
        parseInt(pointsToRedeemInput.value) || 0,
        availablePoints,
        Math.max(0, Math.floor((totalPrice - 0.60) / 0.30))
      );
      let pointsValue = maxPointsToRedeem * 0.30;
      let adjustedPrice = totalPrice - pointsValue;
    
      pointsToRedeemInput.value = maxPointsToRedeem;
      pointsValueElement.textContent = pointsValue.toFixed(2);
      adjustedTotalPriceEl.textContent = adjustedPrice.toFixed(2);
    };

    let updateCart = async (itemID, size, action) => {
      try {
        let response = await fetch('/cart/update', {
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

        let data = await response.json();
        if (!response.ok || !data.success) {
          if (data.message) {
            showCartMessage(data.message);
            updateSummaryValues();
          }
          return null;
        }
        let row = document.querySelector(`.cart-item-row[data-item-id="${itemID}"][data-size="${size}"]`);
        if (data.newQuantity > 0) {
          row.querySelector('.cart-quantity').textContent = data.newQuantity;
          row.querySelector('.cart-subtotal').textContent = (data.newQuantity * data.itemPrice).toFixed(2);

        } else {
          row.remove();
        }

        updateSummaryValues();
      } catch (error) {
        console.error(error);
        showCartMessage('An unexpected error occurred. Please try again.');
      }
    };

    cartRows.forEach(row => {
      let incrementButton = row.querySelector('.increment-button');
      let decrementButton = row.querySelector('.decrement-button');
      let itemID = row.dataset.itemId;
      let size = row.dataset.size;

      incrementButton.addEventListener('click', () => updateCart(itemID, size, 'increment'));
      decrementButton.addEventListener('click', () => updateCart(itemID, size, 'decrement'));
    });

    let checkoutButton = document.getElementById('proceed-to-checkout-btn');
    checkoutButton.addEventListener('click', async (e) => {
      e.preventDefault();

      let adjustedTotalPrice = parseFloat(adjustedTotalPriceEl.textContent);
      let pointsToRedeem = parseInt(pointsToRedeemInput.value) || 0;

      try {
        let response = await fetch('/checkout/session', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({
            adjustedTotalPrice,
            pointsToRedeem,
          }),
        });

        if (!response.ok) {
          let errorData = await response.json();
          throw new Error(errorData.error || 'Failed to create checkout session.');
        }

        let {
          url
        } = await response.json();
        window.location.href = url;
      } catch (error) {
        showCartMessage('No items in cart.');
      }
    });
    let showCartMessage = (message) => {
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

  $(document).ready(function() {
    if ($('.flash-message').length) {
      $('.flash-message').delay(3000).fadeOut(500, function() {
        $(this).remove();
      });
    }
  });
</script>
@endpush