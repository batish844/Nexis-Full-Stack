@extends('layout')

@section('title', 'Cart')

@section('content')

<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Your Cart</h1>

  <div class="flex flex-col lg:flex-row lg:space-x-6">
    <!-- Cart Table -->
<div class="w-full lg:w-2/3">
  <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-blue-300">
      <tr class="text-sm font-semibold text-gray-600 uppercase tracking-wider">
        <th class="px-6 py-3 text-left text-white">Item</th>
        <th class="px-6 py-3 text-center text-white">Price</th>
        <th class="px-6 py-3 text-center text-white">Quantity</th>
        <th class="px-6 py-3 text-right text-white">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cartItems as $cartItem)
      <tr class="border-b hover:bg-gray-50 transition duration-200">
        <td class="px-6 py-4 flex items-center">
   
            <img src="{{ asset($cartItem->item->Photo[0]) }}" alt="{{ $cartItem->item->Name }}" class="w-32 h-32 object-cover rounded-lg shadow-md mr-6">
    
    
            <div class="text-gray-800 font-medium">
        
        
                <div class="text-2xl font-semibold text-gray-800 py-2">
                {{ $cartItem->item->Name }}
                </div>
                <div class="text-sm text-gray-500 py-2">
                <strong>Size: </strong> {{ $cartItem->Size ?? 'M' }}
                </div>
            </div>
        </td>

        <td class="px-6 py-4 text-center text-gray-600">${{ number_format($cartItem->item->Price, 2) }}</td>
        <td class="px-6 py-4 text-center">
          <div class="flex items-center justify-center space-x-2">
            <button class="bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300">-</button>
            <span class="text-gray-800 font-medium">{{ $cartItem->Quantity }}</span>
            <button class="bg-gray-200 px-3 py-1 rounded-lg hover:bg-gray-300">+</button>
          </div>
        </td>
        <td class="px-6 py-4 text-right text-gray-800 font-semibold">
          ${{ number_format($cartItem->Quantity * $cartItem->item->Price, 2) }}
        </td>
      </tr>
      @endforeach
      <tr class="bg-gray-100">
        <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-800">Total Price:</td>
        <td class="px-6 py-4 text-right font-bold text-blue-600">
          ${{ number_format($totalPrice, 2) }}
        </td>
      </tr>
      <tr class="bg-gray-100">
        <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-800">Total Points:</td>
        <td class="px-6 py-4 text-right font-bold text-green-600">
          {{ $totalPoints }}
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Summary Section -->
<div class="w-full lg:w-1/3 bg-white shadow-lg rounded-lg p-6 space-y-8">

  <!-- Delivery Address Section -->
  <div class="">
    <h2 class="text-2xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Delivery Address</h2>
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
  </div>

  <!-- Cart and Redeem Points Section -->
  <div class="bg-blue-50 border border-blue-50 p-6 rounded-lg space-y-8">
    
    <!-- Cart Summary -->
    <div>
      <h2 class="text-2xl font-semibold mb-4 border-b-2 border-gray-200 pb-2">Cart Summary</h2>
      <div class="flex justify-between items-center py-2 text-sm">
        <span class="text-gray-600">Total Items:</span>
        <span class="font-bold text-gray-800">{{ $cartItems->count() }}</span>
      </div>
      <div class="flex justify-between items-center py-2 text-sm">
        <span class="text-gray-600">Total Price:</span>
        <span class="font-bold text-blue-600">${{ number_format($totalPrice, 2) }}</span>
      </div>
      <div class="flex justify-between items-center py-2 text-sm">
        <span class="text-gray-600">Total Points:</span>
        <span class="font-bold text-green-600">{{ $totalPoints }}</span>
      </div>
    </div>

    <!-- Redeem Points -->
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

    <!-- Adjusted Total Price -->
    <div class="flex justify-between items-center text-sm">
      <span class="text-gray-600">Adjusted Total Price:</span>
      <span class="font-bold text-blue-600">$<span id="adjusted-total-price">{{ number_format($totalPrice, 2) }}</span></span>
    </div>
  </div>

  <!-- Checkout Button -->
  <a href="#" 
     class="block w-full py-3 text-center bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-500 transition-all">
    Proceed to Checkout
  </a>

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
