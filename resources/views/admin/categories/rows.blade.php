@foreach($categories as $category)
<tr class="hover:bg-gray-100 transition duration-200">
    <td class="px-6 py-4 flex items-center">

        <div class="ml-4">
            <div class="text-sm font-bold text-gray-900">{{$category->Name}}</div>
            <div class="text-sm text-gray-500">{{$category->Description}}</div>
        </div>
    </td>
    <td class="px-6 py-4">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{$category->items_count}}
        </span>
    </td>
    <td class="px-6 py-4">
        <div class="flex space-x-2">
            <a href="{{ route('categories.edit', $category->CategoryID) }}" class="text-blue-600 hover:text-blue-800">
                <img src="/storage/img/icons/list.png" alt="Show" class="w-5 h-5 inline-block">
                View & Edit
            </a>
            <a href="{{ route('categories.destroy', $category->CategoryID) }}" class="text-red-500 hover:text-red-700">
                <img src="/storage/img/icons/trash.png" alt="Show" class="w-5 h-5 inline-block">
                Delete
            </a>
        </div>
    </td>
</tr>
@endforeach

@if ($categories->isEmpty())
<tr>
    <td colspan="3" class="text-center py-4">No Category was found.</td>
</tr>
@endif