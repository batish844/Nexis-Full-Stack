@extends('profile.layout')

@section('title', 'My Orders')

@section('content')
    <div class="flex flex-col items-center lg:w-full my-12 px-8 sm:px-8 lg:px-">
        <h1 class="text-4xl font-extrabold text-center text-blue-900 tracking-wide mb-12">
            Your Orders
        </h1>
        <div class="flex flex-col sm:flex-row sm:justify-center space-x-5 items-center mb-6 w-full max-w-screen-lg">
            <label for="statusFilter" class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">
                Filter by Status:
            </label>
            <div class="relative w-full sm:w-64">
                <select id="statusFilter"
                    class="block appearance-none w-full bg-white border border-gray-300 hover:border-blue-500 px-4 py-2 pr-8 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="all">All</option>
                    <option value="Completed">Completed</option>
                    <option value="Processing">Processing</option>
                    <option value="Pending">Pending</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <label for="sortFilter" class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">
                Sort by:
            </label>
            <div class="relative w-full sm:w-64">
                <select id="sortFilter"
                    class="block appearance-none w-full bg-white border border-gray-300 hover:border-blue-500 px-4 py-2 pr-8 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="time_created:asc">Oldest</option>
                    <option value="time_created:desc">Latest</option>
                    <option value="price:asc">Price (Ascending)</option>
                    <option value="price:desc">Price (Descending)</option>
                    <option value="points:asc">Points (Ascending)</option>
                    <option value="points:desc">Points (Descending)</option>
                </select>
            </div>
        </div>


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
            <!-- Orders Flexbox -->
            <div id="ordersContainer" class="flex w-full max-w-screen-lg flex-wrap justify-center gap-12">
                @foreach ($orders as $order)
                    <div
                        class="bg-white flex-grow-0 flex flex-col justify-between flex-shrink-0 w-full sm:w-[90%] md:w-[48%] lg:w-[45%] border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                        <!-- Header Section -->
                        <div class="relative">
                            <!-- Display All Images -->
                            <div class="flex flex-wrap gap-4 py-10 px-12 justify-center">
                                @foreach ($order->orderItems as $orderItem)
                                    @if (!empty($orderItem->item->Photo))
                                        <div class="w-20 h-20">
                                            <img src="{{ asset($orderItem->item->Photo[0]) }}"
                                                class="w-full h-full object-cover rounded-lg shadow">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div
                                class="absolute top-2 left-2 bg-gradient-to-r from-blue-600 to-blue-900 text-white px-4 py-1 text-xs font-bold rounded-lg">
                                Order #{{ $order->OrderID }}
                            </div>
                            <div
                                class="absolute top-2 right-2 px-4 py-1 text-xs font-bold rounded-lg
                                    {{ $order->Status === 'Completed'
                                        ? 'text-white bg-green-600'
                                        : ($order->Status === 'Processing'
                                            ? 'text-white bg-gray-500'
                                            : ($order->Status === 'Pending'
                                                ? 'text-white bg-yellow-400'
                                                : 'text-white bg-red-600')) }}">
                                {{ $order->Status }}
                            </div>
                        </div>

                        <!-- Order card footer -->
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-gray-800 mb-2">Placed on:</h2>
                            <p class="text-gray-500 text-sm mb-4">
                                {{ $order->created_at->format('F j, Y, g:i A') }}
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-md sm:text-lg xl:text-2xl font-extrabold text-gray-900">
                                    ${{ number_format($order->TotalPrice, 2) }}
                                </p>
                                <p class="text-sm sm:text-lg xl:text-2xl text-blue-600 font-bold">
                                    {{ $order->TotalPoints }} Points
                                </p>
                                <button
                                    class="open-modal px-2 sm:px-4 py-2 bg-blue-600 text-white text-xs sm:text-sm font-bold rounded-lg hover:bg-blue-700 transition"
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
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const modal = document.getElementById('order-modal');
        const modalContent = document.getElementById('modal-content');

        // // Close modal
        // document.querySelectorAll('.close-modal').forEach(button => {
        //     button.addEventListener('click', () => {
        //         modal.classList.add('hidden');
        //     });
        // });

        // // Close modal on outside click
        // modal.addEventListener('click', (e) => {
        //     if (e.target === modal) {
        //         modal.classList.add('hidden');
        //     }
        // });

        $(document).ready(function() {
            // Fetch and display orders based on filters and sorting
            function fetchOrders() {
                const statusFilter = $('#statusFilter').val();
                const sortFilter = $('#sortFilter').val();

                $.ajax({
                    url: '{{ route('profile.orders.filter') }}', // Filter orders route
                    method: 'GET',
                    data: {
                        status: statusFilter,
                        sort: sortFilter,
                    },
                    success: function(response) {
                        // Update the orders container with filtered and sorted orders
                        $('#ordersContainer').html(response);

                        // Rebind modal open event for newly loaded orders
                        bindModalOpenEvent();
                    },
                    error: function(xhr) {
                        console.error('Error fetching orders:', xhr.responseText);
                    },
                });
            }

            // Bind modal open events
            function bindModalOpenEvent() {
                $('.open-modal').off('click').on('click', function() {
                    const orderId = $(this).data('order-id');
                    openOrderDetailsModal(orderId);
                });
            }

            // Fetch and display order details in the modal
            function openOrderDetailsModal(orderId) {
                $.ajax({
                    url: `/profile/orders/${orderId}`, // Order details route
                    method: 'GET',
                    success: function(response) {
                        const order = response.order;
                        const items = response.items;

                        const modalContentHtml = `
                    <h2 class="text-lg font-bold">Order #${order.OrderID}</h2>
                    <p class="text-gray-500">Placed on: ${new Date(order.created_at).toLocaleString()}</p>
                    <div class="mt-4">
                        ${items
                            .map(
                                (item) => `
                                    <div class="flex justify-between items-center border-b py-4">
                                        <div class="flex items-center space-x-4">
                                            <img src="${item.photo}" alt="${item.name}" class="w-16 h-16 object-cover rounded-lg">
                                            <div>
                                                <p class="text-gray-900 font-bold">${item.name}</p>
                                                <p class="text-sm text-gray-500">Size: ${item.size}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-700 font-medium">Qty: ${item.quantity}</p>
                                            <p class="text-blue-600 font-bold">Price: $${parseFloat(item.price).toFixed(2)}</p>
                                            <p class="text-yellow-400 font-bold">Points: ${item.points}</p>
                                        </div>
                                    </div>
                                `
                            )
                            .join('')}
                    </div>
                    <div class="mt-6 flex justify-end">
                        <p class="text-gray-900 font-bold text-lg mr-6">Total: $${parseFloat(order.TotalPrice).toFixed(2)}</p>
                        <p class="text-blue-600 font-bold text-lg">Points: ${order.TotalPoints}</p>
                    </div>
                `;

                        $('#modal-content').html(modalContentHtml);
                        $('#order-modal').removeClass('hidden');
                    },
                    error: function(xhr) {
                        console.error('Error fetching order details:', xhr.responseText);
                        $('#modal-content').html(
                            '<p class="text-red-500">Failed to load order details. Please try again later.</p>'
                        );
                        $('#order-modal').removeClass('hidden');
                    },
                });
            }

            // Initialize event bindings
            bindModalOpenEvent();

            // Trigger fetching of orders on filter or sort change
            $('#statusFilter, #sortFilter').on('change', fetchOrders);

            // Close modal
            $('.close-modal').on('click', function() {
                $('#order-modal').addClass('hidden');
            });

            // Close modal on outside click
            $('#order-modal').on('click', function(e) {
                if (e.target === this) {
                    $(this).addClass('hidden');
                }
            });
        });
    </script>
@endsection
