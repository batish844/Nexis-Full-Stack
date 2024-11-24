@extends('profile.layout')

@section('title', 'My Orders')

@section('content')
    <div class="container mx-auto my-12 px-6 sm:px-8 lg:px-10">
        <h1 class="text-5xl font-extrabold text-center text-gray-900 tracking-wide mb-12">
            Your Orders <span class="text-blue-600">History</span>
        </h1>

        @if ($orders->isEmpty())
            <!-- Empty State -->
            <div class="bg-gradient-to-r from-blue-500 to-pink-500 text-white p-10 rounded-lg shadow-xl text-center">
                <h2 class="text-3xl font-bold">No Orders Yet!</h2>
                <p class="text-lg mt-2">Looks like you haven’t placed an order yet. Let’s get shopping!</p>
                <div class="mt-6 flex justify-center space-x-4">
                    <a href="{{ route('store.men') }}"
                        class="px-6 py-3 bg-white text-blue-600 font-bold rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                        Shop for Men
                    </a>
                    <a href="{{ route('store.women') }}"
                        class="px-6 py-3 bg-white text-pink-500 font-bold rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                        Shop for Women
                    </a>
                </div>
            </div>
        @else
            <!-- Orders Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($orders as $order)
                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                        <!-- Header Section -->
                        <div class="relative">
                            <!-- Main Image -->
                            @if ($order->orderItems->isNotEmpty())
                                <img src="{{ asset($order->orderItems->first()->item->Photo[0]) }}"
                                    alt="{{ $order->orderItems->first()->item->Name }}"
                                    class="w-full h-48 object-cover rounded-t-lg">
                            @else
                                <p class="text-sm text-gray-500 mt-4">No items found in this order.</p>
                            @endif
                            <div
                                class="absolute top-2 left-2 bg-gradient-to-r from-green-400 to-blue-500 text-white px-4 py-1 text-xs font-bold rounded-lg">
                                Order #{{ $order->OrderID }}
                            </div>
                            <div
                                class="absolute top-2 right-2 px-4 py-1 text-xs font-bold rounded-lg
                                {{ $order->Status === 'Completed' ? 'bg-green-600' : ($order->Status === 'Processing' ? 'bg-yellow-500' : 'bg-red-600') }}">
                                {{ $order->Status }}
                            </div>
                        </div>

                        <!-- Order Content -->
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-800 mb-2">Placed on:</h2>
                            <p class="text-gray-500 text-sm mb-4">
                                {{ $order->created_at->format('F j, Y, g:i A') }}
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-2xl font-extrabold text-gray-900">${{ number_format($order->TotalPrice, 2) }}
                                </p>
                                <button
                                    class="open-modal px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition"
                                    data-order-id="{{ $order->OrderID }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="order-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl relative">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Order Details</h3>
                <button class="close-modal text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div id="modal-content" class="space-y-4">
                    <!-- Order details will be dynamically inserted here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-200 text-right">
                <button
                    class="close-modal px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('order-modal');
        const modalContent = document.getElementById('modal-content');

        // Open modal and load data
        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.dataset.orderId;

                // Fetch order details dynamically (you could load content via AJAX)
                const orderDetailsHtml = `
                <p class="text-lg font-semibold">Order #${orderId}</p>
                <p class="text-gray-500 text-sm">Placed on: {{ $order->created_at->format('F j, Y, g:i A') }}</p>
                <div class="mt-4">
                    @foreach ($order->orderItems as $item)
                        <div class="flex justify-between items-center border-b py-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset($item->item->Photo[0]) }}" alt="{{ $item->item->Name }}"
                                    class="w-16 h-16 object-cover rounded-lg">
                                <div>
                                    <p class="text-gray-900 font-bold">{{ $item->item->Name }}</p>
                                    <p class="text-sm text-gray-500">Size: {{ $item->Size }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-700 font-medium">Qty: {{ $item->Quantity }}</p>
                                <p class="text-gray-900 font-bold">${{ number_format($item->TotalPrice, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            `;

                modalContent.innerHTML = orderDetailsHtml;
                modal.classList.remove('hidden');
            });
        });

        // Close modal
        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });

        // Close modal on outside click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
@endsection
