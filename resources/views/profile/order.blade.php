@extends('profile.layout')

@section('title', 'My Orders')

@section('content')
    <div class="px-3 sm:px-8 md:px-12 lg:px-20 flex items-center">
        <div class="container  my-12 px-6 sm:px-8 lg:px-10">
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
                <!-- Centered Orders Grid -->
                <div class="flex justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach ($orders as $order)
                            <div
                                class="bg-white w-full md:w-auto lg:w-3/4 border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                                <!-- Header Section -->
                                <div class="relative">
                                    <!-- Display All Images -->
                                    <div class="grid grid-cols-3 gap-4 p-4">
                                        @foreach ($order->orderItems as $orderItem)
                                            @if (!empty($orderItem->item->Photo))
                                                @foreach ($orderItem->item->Photo as $photo)
                                                    <div class="relative w-full aspect-square">
                                                        <img src="{{ asset($photo) }}" alt="{{ $orderItem->item->Name }}"
                                                            class="w-full h-full object-cover rounded-lg shadow">
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
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
                                        <p class="text-2xl font-extrabold text-gray-900">
                                            ${{ number_format($order->TotalPrice, 2) }}</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
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
    </div>
    <script>
        const modal = document.getElementById('order-modal');
        const modalContent = document.getElementById('modal-content');

        // Open modal and load data

        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.dataset.orderId;

                // Fetch order details dynamically
                fetch(`/profile/orders/${orderId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch order details.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const order = data.order;
                        const items = data.items;

                        const orderDetailsHtml = `
                    <h2 class="text-lg font-bold">Order #${order.OrderID}</h2>
                    <p class="text-gray-500">Placed on: ${new Date(order.created_at).toLocaleString()}</p>
                    <div class="mt-4">
                        ${items.map(item => `
                                                                                        <div class="flex justify-between items-center border-b py-4">
                                                                                            <div class="flex items-center space-x-4">
                                                                                                <img src="${item.photo}" alt="${item.name}"
                                                                                                    class="w-16 h-16 object-cover rounded-lg">
                                                                                                <div>
                                                                                                    <p class="text-gray-900 font-bold">${item.name}</p>
                                                                                                    <p class="text-sm text-gray-500">Size: ${item.size}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-right">
                                                                                                <p class="text-gray-700 font-medium">Qty: ${item.quantity}</p>
                                                                                                <p class="text-gray-900 font-bold">$${item.subtotal.toFixed(2)}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    `).join('')}
                    </div>
                `;
                        document.getElementById('modal-content').innerHTML = orderDetailsHtml;
                        document.getElementById('order-modal').classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error(error);
                        document.getElementById('modal-content').innerHTML =
                            `<p class="text-red-500">Failed to load order details. Please try again later.</p>`;
                        document.getElementById('order-modal').classList.remove('hidden');
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
        });
    </script>
@endsection
