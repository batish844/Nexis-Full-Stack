@foreach ($messages as $message)
<tr class="hover:bg-gray-100 text-center">
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="block text-gray-800 font-medium">{{ $message->Full_Name }}</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
        <span class="block text-gray-600">{{ $message->Email }}</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
        <span class="block text-gray-600">{{ Str::limit($message->Message, 10) }}</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        @if($message->is_read)
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            Read
        </span>
        @else
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
            Unread
        </span>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="block text-gray-600">{{ $message->created_at->format('d M Y, h:i A') }}</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex justify-center">
            <a href="{{ route('messages.show', $message->ContactID) }}"
                class="text-blue-600 hover:text-blue-800 flex items-center space-x-1">
                <img src="/storage/img/icons/list.png" alt="Manage" class="w-5 h-5">
                <span>Manage</span>
            </a>
        </div>
    </td>
</tr>
@endforeach
@if ($messages->isEmpty())
<tr>
    <td colspan="7" class="text-center py-4">No Messages Found.</td>
</tr>
@endif