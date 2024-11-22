@foreach ($messages as $message)
<tr class="hover:bg-gray-100 {{ $message->is_read ? '' : 'bg-yellow-50' }}">
    <td class="px-6 py-4 whitespace-nowrap">{{ $message->Full_Name }}</td>
    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">{{ $message->Email }}</td>
    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">{{ Str::limit($message->Message, 50) }}</td>
    <td class="px-6 py-4 whitespace-nowrap">
        @if($message->is_read)
        <span class="text-green-600 font-semibold">Read</span>
        @else
        <span class="text-red-600 font-semibold">Unread</span>
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap">{{ $message->created_at->format('d M Y, h:i A') }}</td>
    <td class="px-6 py-4 whitespace-nowrap">
        <a href="{{ route('messages.show', $message->ContactID) }}" class="text-blue-600 hover:underline">View</a>
        <button type="button" class="mark-read-button text-indigo-600 hover:underline ml-2" data-message-id="{{ $message->id }}">
            @if($message->is_read)
            Mark Unread
            @else
            Mark Read
            @endif
        </button>
        <button type="button" class="delete-button text-red-600 hover:underline ml-2" data-action-url="{{ route('admin.messages.destroy', $message->id) }}">
            Delete
        </button>
    </td>
</tr>
@endforeach