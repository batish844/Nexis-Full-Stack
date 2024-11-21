@foreach($products as $product)
<tr class="hover:bg-gray-100 transition duration-200">
    <td class="px-6 py-4 text-center">
        <div class="flex items-center justify-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-lg object-cover" src="/{{ $product->Photo[0] }}" alt="{{ $product->Name }}">
            </div>
        </div>
    </td>
    <td class="px-6 py-4 text-left">
        <div class="text-sm font-bold text-gray-800">{{ $product->Name }}</div>
    </td>
    <td class="px-6 py-4 text-center hidden md:table-cell">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
            {{ $product->category->Name ?? 'N/A' }}
        </span>
    </td>
    <td class="px-6 py-4 text-center hidden md:table-cell">
        <span class="text-sm font-semibold text-gray-800">${{ number_format($product->Price, 2) }}</span>
    </td>
    <td class="px-6 py-4 text-center hidden md:table-cell">
        <span class="text-sm font-semibold text-gray-800 {{ $product->Quantity < 10 ? 'text-red-600 font-bold' : '' }}">
            {{ $product->Quantity }}
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
            {{ $product->isAvailable ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $product->isAvailable ? 'Available' : 'Unavailable' }}
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        <div class="flex justify-center space-x-2">
            <a href="{{ route('products.show', $product->ItemID) }}" class="text-blue-600 hover:text-blue-800">
                <img src="/storage/img/icons/list.png" alt="Manage" class="w-5 h-5 inline-block"> Manage
            </a>
        </div>
    </td>
</tr>
@endforeach

@if ($products->isEmpty())
<tr>
    <td colspan="7" class="text-center py-4">No Products Found.</td>
</tr>
@endif
