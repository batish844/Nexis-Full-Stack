@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Order #{{ $order->OrderID }}</h1>
        <a href="{{ route('orders.index') }}"
            class="text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg border mb-10 p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Order Summary</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Order ID</h3>
                <p class="text-xl font-semibold text-gray-800">{{ $order->OrderID }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Status</h3>
                <p class="text-xl font-semibold text-gray-800">{{ $order->Status }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Total Price</h3>
                <p class="text-xl font-semibold text-gray-800">${{ number_format($order->TotalPrice, 2) }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Date</h3>
                <p class="text-xl font-semibold text-gray-800">{{ \Carbon\Carbon::parse($order->DateTime)->format('d M Y, h:i A') }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg border mb-10 p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Customer Details</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Name</h3>
                <p class="text-xl font-semibold text-gray-800">{{ $order->user->First_Name }} {{ $order->user->Last_Name }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Email</h3>
                <p class="text-xl font-semibold text-gray-800">{{ $order->user->email }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Phone Number</h3>
                <p class="text-xl font-semibold text-gray-800">{{ $order->user->Phone_Number }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg border p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Items Purchased</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 shadow rounded-lg">
                <thead class="bg-gray-100">
                    <tr class="text-sm text-gray-700 uppercase tracking-wider">
                        <th class="px-6 py-3 font-semibold">Item</th>
                        <th class="px-6 py-3 font-semibold">Price</th>
                        <th class="px-6 py-3 font-semibold">Quantity</th>
                        <th class="px-6 py-3 font-semibold">Size</th>
                        <th class="px-6 py-3 font-semibold">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($order->orderItems as $orderItem)
                    <tr>
                        <td class="px-6 py-4 flex items-center">
                            <img src="{{ $orderItem->item->Photo[0] }}" alt="{{ $orderItem->item->Name }}" class="w-12 h-12 object-cover rounded-md mr-4">
                            <span class="text-gray-800">{{ $orderItem->item->Name }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-800">${{ number_format($orderItem->item->Price, 2) }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $orderItem->Quantity }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $orderItem->Size }}</td>
                        <td class="px-6 py-4 text-gray-800">
                            ${{ number_format($orderItem->TotalPrice, 2) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right font-semibold text-gray-800">Total:</td>
                        <td class="px-6 py-4 text-gray-800 font-bold">${{ number_format($order->TotalPrice, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection