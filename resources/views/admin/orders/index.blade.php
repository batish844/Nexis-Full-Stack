@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Orders</h1>
        <p class="text-gray-600">Monitor and process customer orders</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg overflow-x-auto text-center">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Customer</th>
                    <th class="px-6 py-3 font-semibold">Email</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 font-semibold">Total Price</th>
                    <th class="px-6 py-3 font-semibold">Date</th>
                    <th class="px-6 py-3 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($orders as $order)
                <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->First_Name }} {{ $order->user->Last_Name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $order->Status == 'Completed' ? 'green' : ($order->Status == 'Pending' ? 'yellow' : 'red') }}-100 text-{{ $order->Status == 'Completed' ? 'green' : ($order->Status == 'Pending' ? 'yellow' : 'red') }}-800">
                            {{ $order->Status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($order->TotalPrice, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($order->DateTime)->format('d M Y, h:i A') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('orders.show', $order->OrderID) }}" class="text-blue-600 hover:underline">View</a>
                        <!-- Additional actions like Edit Status can be added here -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection