@extends('layout')

@section('title', 'Cart')

@section('content')

<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

  <div class="flex flex-col lg:flex-row lg:space-x-6">
    <!-- Cart Table -->
    <div class="w-full lg:w-2/3">
      <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left">Item</th>
            <th class="px-6 py-3 text-center">Preview</th>
            <th class="px-6 py-3 text-center">Price</th>
            <th class="px-6 py-3 text-center">Quantity</th>
            <th class="px-6 py-3 text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cartItems as $cartItem)
          <tr class="border-b last:border-b-0">
            <td class="px-6 py-4 text-gray-800 font-medium">{{ $cartItem->item->Name }}</td>
            <td class="px-6 py-4 text-center">
              <img src="{{ asset($cartItem->item->Photo[0]) }}" alt="{{ $cartItem->item->Name }}" class="w-16 h-16 object-cover rounded-lg shadow-md">
            </td>
            <td class="px-6 py-4 text-center text-gray-600">${{ number_format($cartItem->item->Price, 2) }}</td>
            <td class="px-6 py-4 text-center text-gray-600">{{ $cartItem->Quantity }}</td>
            <td class="px-6 py-4 text-right text-gray-800 font-semibold">
              ${{ number_format($cartItem->Quantity * $cartItem->item->Price, 2) }}
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4" class="px-6 py-4 text-right font-bold text-gray-800">Total Price:</td>
            <td class="px-6 py-4 text-right font-bold text-blue-600">${{ number_format($totalPrice, 2) }}</td>
          </tr>
          <tr>
            <td colspan="4" class="px-6 py-4 text-right font-bold text-gray-800">Total Points:</td>
            <td class="px-6 py-4 text-right font-bold text-green-600">{{ $totalPoints }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Summary Section -->
    <div class="w-full lg:w-1/3 bg-white shadow-md rounded-lg p-6">
      <!-- Address Section -->
      <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4">Delivery Address</h2>
        @if (empty($address))
          <p class="text-red-600">No address found. Please <a href="{{ route('profile.index') }}" class="text-blue-600 underline">update your profile</a>.</p>
        @else
          <p class="text-gray-800">
            {{ $address['street_address'] ?? '' }}, {{ $address['building'] ?? '' }}<br>
            {{ $address['city'] ?? '' }}<br>
            {{ $Phone_Number ?? '' }}
          </p>
        @endif
      </div>

      <h2 class="text-2xl font-bold mb-4">Cart Summary</h2>
      <div class="flex justify-between mb-4">
        <span class="text-gray-600">Total Items:</span>
        <span class="font-bold text-gray-800">{{ $cartItems->count() }}</span>
      </div>
      <div class="flex justify-between mb-4">
        <span class="text-gray-600">Total Price:</span>
        <span class="font-bold text-blue-600">${{ number_format($totalPrice, 2) }}</span>
      </div>
      <div class="flex justify-between mb-6">
        <span class="text-gray-600">Total Points:</span>
        <span class="font-bold text-green-600">{{ $totalPoints }}</span>
      </div>

      <!-- Points Redemption -->
      <div class="mb-6">
        <h3 class="text-xl font-bold mb-2">Redeem Points</h3>
        <div class="flex items-center space-x-2">
          <input type="number" id="points-to-redeem" class="w-full border rounded-lg p-2" placeholder="Enter points to redeem" min="0" max="{{ $availablePoints }}">
          <button id="max-points-btn" class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-500">Max</button>
        </div>
        <p class="text-gray-600 mt-2">Available Points: <span id="available-points">{{ $availablePoints }}</span></p>
        <p class="text-gray-600">Value: $<span id="points-value">0.00</span></p>
      </div>

      <!-- Adjusted Total Price -->
      <div class="flex justify-between mb-6">
        <span class="text-gray-600">Adjusted Total Price:</span>
        <span class="font-bold text-blue-600">$<span id="adjusted-total-price">{{ number_format($totalPrice, 2) }}</span></span>
      </div>

      <a href="#" class="w-full py-3 text-center bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 transition duration-300">
        Proceed to Checkout
      </a>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const pointsToRedeemInput = document.getElementById('points-to-redeem');
    const maxPointsBtn = document.getElementById('max-points-btn');
    const availablePoints = parseInt('{{ $availablePoints }}');
    const totalPrice = parseFloat('{{ $totalPrice }}');
    const pointsValueElement = document.getElementById('points-value');
    const adjustedTotalPriceElement = document.getElementById('adjusted-total-price');

    const updateAdjustedTotalPrice = () => {
      let pointsToRedeem = parseInt(pointsToRedeemInput.value) || 0;

      // Ensure points to redeem are within valid range
      pointsToRedeem = Math.min(pointsToRedeem, availablePoints);
      const maxRedeemablePoints = Math.floor(totalPrice / 0.30);
      pointsToRedeem = Math.min(pointsToRedeem, maxRedeemablePoints);
      pointsToRedeem = Math.max(pointsToRedeem, 0);

      pointsToRedeemInput.value = pointsToRedeem;

      const pointsValue = pointsToRedeem * 0.30;
      pointsValueElement.textContent = pointsValue.toFixed(2);

      const adjustedTotalPrice = totalPrice - pointsValue;
      adjustedTotalPriceElement.textContent = adjustedTotalPrice.toFixed(2);
    };

    pointsToRedeemInput.addEventListener('input', updateAdjustedTotalPrice);

    maxPointsBtn.addEventListener('click', () => {
      const maxRedeemablePoints = Math.min(availablePoints, Math.floor(totalPrice / 0.30));
      pointsToRedeemInput.value = maxRedeemablePoints;
      updateAdjustedTotalPrice();
    });

    // Initialize values
    updateAdjustedTotalPrice();
  });
</script>
@endpush
