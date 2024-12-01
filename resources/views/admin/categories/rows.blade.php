@foreach($categories as $category)
<tr class="hover:bg-gray-100 transition duration-200">
    <td class="px-6 py-4 flex items-center justify-center text-center">
        <div class="ml-4">
            <div class="text-sm font-bold text-gray">{{$category->Name}}</div>
        </div>
    </td>
    <td class="px-6 py-4 text-center hidden md:table-cell">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{$category->items_count}}
        </span>
    </td>
    <td class="px-6 py-4 text-center hidden md:table-cell">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{$category->Gender}}
        </span>
    </td>
    <td class="px-6 py-4 text-center">
        <div class="flex justify-center space-x-2">
            <a href="{{ route('categories.edit', $category->CategoryID) }}" class="text-blue-600 hover:text-blue-800">
                <img src="{{ Storage::url('img/icons/list.png') }}" alt="Show" class="w-5 h-5 inline-block">
            Manage
            </a>
            <button type="button" class="text-red-600 hover:text-red-800 delete-button" data-category-id="{{ $category->CategoryID }}" data-action-url="{{ route('categories.destroy', $category->CategoryID) }}">
                <img src="{{ Storage::url('img/icons/trash.png') }}" alt="Delete" class="w-5 h-5 inline-block">
                Delete
            </button>
        </div>
    </td>
</tr>
@endforeach

@if ($categories->isEmpty())
<tr>
    <td colspan="3" class="text-center py-4">No Category was found.</td>
</tr>
@endif
