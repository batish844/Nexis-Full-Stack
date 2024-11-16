@foreach($categories as $category)
<tr class="hover:bg-gray-100 transition duration-200">
    <td class="px-6 py-4 flex items-center">

        <div class="ml-4">
            <div class="text-sm font-bold text-gray">{{$category->Name}}</div>
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
            <form action="{{ route('categories.destroy', $category->CategoryID) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">
                    <img src="/storage/img/icons/trash.png" alt="Delete" class="w-5 h-5 inline-block">
                    Delete
                </button>
            </form>
        </div>
    </td>
</tr>
@endforeach

@if ($categories->isEmpty())
<tr>
    <td colspan="3" class="text-center py-4">No Category was found.</td>
</tr>
@endif