@foreach ($orders as $order)
    <div
        class="bg-white flex-grow-0 flex flex-col justify-between flex-shrink-0 w-full sm:w-[90%] md:w-[48%] lg:w-[45%] border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105">
        <div class="relative">
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
                    class="open-modal px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition"
                    data-order-id="{{ $order->OrderID }}">
                    View Details
                </button>
            </div>
        </div>
    </div>
@endforeach
