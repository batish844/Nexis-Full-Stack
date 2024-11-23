@extends('admin.layouts.sidebar')

@section('content')
<div class="container mx-auto py-10 px-6">
    <div class="flex flex-wrap justify-between items-center gap-4 mb-10">
        <div class="w-full sm:w-auto">
            <h1 class="text-4xl font-extrabold text-gray-900">Order #{{ $order->OrderID }}</h1>
            <p class="text-sm text-gray-500">Placed on {{ \Carbon\Carbon::parse($order->DateTime)->format('d M Y, h:i A') }}</p>
        </div>
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center justify-center gap-2 text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-400 sm:ml-auto">
            ← Back
        </a>
    </div>

    <section class="bg-white rounded-xl shadow-md p-8 mb-10">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Order Summary</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Order ID</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->OrderID }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Status</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->Status }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Total Price</h3>
                <p class="text-lg font-medium text-gray-800">${{ number_format($order->TotalPrice, 2) }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl shadow-md p-8 mb-10">
        <div class="flex flex-wrap justify-between items-center gap-4">
            <h2 class="text-3xl font-semibold text-gray-900">Customer Details</h2>
            <a href="{{ route('users.show', $order->OrderedBy) }}"
                class="inline-flex items-center justify-center gap-2 text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12.34A9 9 0 1115.34 3.46 9.05 9.05 0 0121 12.34z" />
                </svg>
                View User's Profile
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Name</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->user->First_Name }} {{ $order->user->Last_Name }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Email</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->user->email }}</p>
            </div>
            <div>
                <h3 class="text-sm font-bold text-blue-700 uppercase mb-2">Phone</h3>
                <p class="text-lg font-medium text-gray-800">{{ $order->user->Phone_Number }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-xl shadow-md p-8">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">Items Purchased</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse rounded-lg shadow">
                <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                    <tr class=" text-left text-white font-semibold">
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
                            <img src="{{ $orderItem->item->Photo[0] }}" alt="{{ $orderItem->item->Name }}" class="w-12 h-12 object-cover rounded-md">
                            <span class="text-gray-800 font-medium">{{ $orderItem->item->Name }}</span>
                        </td>
                        <td class="px-6 py-4 border-b">${{ number_format($orderItem->item->Price, 2) }}</td>
                        <td class="px-6 py-4 border-b">{{ $orderItem->Quantity }}</td>
                        <td class="px-6 py-4 border-b">{{ $orderItem->Size }}</td>
                        <td class="px-6 py-4 border-b font-bold text-gray-900">${{ number_format($orderItem->TotalPrice, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="font-semibold bg-gray-50">
                        <td colspan="4" class="px-6 py-4 text-right border-b">Total:</td>
                        <td class="px-6 py-4 border-b font-bold text-lg">${{ number_format($order->TotalPrice, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection