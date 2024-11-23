@forelse ($orders as $order)
<tr class="hover:bg-gray-100">
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $order->user->First_Name }} {{ $order->user->Last_Name }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $order->user->email }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $order->Status == 'Completed' ? 'green' : ($order->Status == 'Pending' ? 'yellow' : 'red') }}-100 text-{{ $order->Status == 'Completed' ? 'green' : ($order->Status == 'Pending' ? 'yellow' : 'red') }}-800">
            {{ $order->Status }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        ${{ number_format($order->TotalPrice, 2) }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        {{ \Carbon\Carbon::parse($order->DateTime)->format('F j, Y') }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <a href="{{ route('orders.show', $order->OrderID) }}" class="text-blue-600 hover:underline">View</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
        No orders found.
    </td>
</tr>
@endforelse
