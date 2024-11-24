<div class="container mx-auto py-10 px-6">
    <div class="flex flex-wrap justify-between items-center gap-4 mb-10">
        <div class="w-full sm:w-auto">
            <h1 class="text-4xl font-extrabold text-gray-900">Order #{{ $order->OrderID }}</h1>
            <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <a href="{{ route('profile.order') }}"
            class="inline-flex items-center justify-center gap-2 text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-400 sm:ml-auto">
            ← Back to Orders
        </a>
    </div>

    <section class="bg-white rounded-xl shadow-md p-8 mb-10">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Summary</h2>
        <div class="flex flex-wrap gap-6 mb-6">
            <div class="flex-1 min-w-[150px]">
                <h3 class="text-sm font-bold text-blue-700 uppercase">Order ID</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->OrderID }}</p>
            </div>
            <div class="flex-1 min-w-[150px]">
                <h3 class="text-sm font-bold text-blue-700 uppercase">Status</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->Status }}</p>
            </div>
            <div class="flex-1 min-w-[150px]">
                <h3 class="text-sm font-bold text-blue-700 uppercase">Total Price</h3>
                <p class="text-lg font-medium text-gray-800">${{ number_format($order->TotalPrice, 2) }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl shadow-md p-8">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Items Purchased</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse rounded-lg shadow">
                <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                    <tr class="text-left text-white font-semibold">
                        <th class="px-6 py-4 border-b">Item</th>
                        <th class="px-6 py-4 border-b">Price</th>
                        <th class="px-6 py-4 border-b">Quantity</th>
                        <th class="px-6 py-4 border-b">Size</th>
                        <th class="px-6 py-4 border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($order->orderItems as $orderItem)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 border-b flex items-center gap-4">
                                <img src="{{ asset($orderItem->item->Photo[0]) }}" alt="{{ $orderItem->item->Name }}"
                                    class="w-12 h-12 object-cover rounded-md">
                                <span class="text-gray-800 font-medium">{{ $orderItem->item->Name }}</span>
                            </td>
                            <td class="px-6 py-4 border-b">
                                ${{ number_format($orderItem->item->Price, 2) }}
                            </td>
                            <td class="px-6 py-4 border-b">{{ $orderItem->Quantity }}</td>
                            <td class="px-6 py-4 border-b">{{ $orderItem->Size }}</td>
                            <td class="px-6 py-4 border-b font-bold text-gray-900">
                                ${{ number_format($orderItem->TotalPrice, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-semibold bg-gray-50">
                        <td colspan="4" class="px-6 py-4 text-right border-b">Total:</td>
                        <td class="px-6 py-4 border-b font-bold text-lg">
                            ${{ number_format($order->TotalPrice, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
