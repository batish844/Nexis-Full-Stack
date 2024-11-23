@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">Message Details</h1>
        <a href="{{ route('messages.index') }}"
            class="inline-flex items-center text-white bg-blue-600 px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition-all focus:outline-none focus:ring-4 focus:ring-blue-400 focus:ring-opacity-50">
            ← Back
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 sm:p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-12 mb-8">
            <div class="truncate">
                <h2 class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Full Name</h2>
                <p class="text-2xl font-medium text-gray-900 truncate">{{ $message->Full_Name }}</p>
            </div>
            <div class="truncate">
                <h2 class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Email</h2>
                <p class="text-2xl font-medium text-gray-900 truncate">{{ $message->Email }}</p>
            </div>
            <div>
                <h2 class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Received At</h2>
                <p class="text-2xl font-medium text-gray-900">{{ $message->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div>
                <h2 class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Status</h2>
                <p class="text-2xl font-medium {{ $message->is_read ? 'text-green-600' : 'text-red-600' }}">
                    {{ $message->is_read ? 'Read' : 'Unread' }}
                </p>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-2">Message</h2>
            <p class="text-lg leading-relaxed text-gray-800 bg-gray-50 rounded-lg p-4 border border-gray-200 whitespace-pre-wrap overflow-hidden break-words">
                {{ $message->Message }}
            </p>
        </div>

        <div class="flex flex-wrap gap-4">
            <form action="{{ route('messages.markAsRead', $message->ContactID) }}" method="POST" class="inline-block w-full sm:w-auto">
                @csrf
                @method('PUT')
                @if(!$message->is_read)
                <button type="submit"
                    class="w-full sm:w-auto inline-flex justify-center items-center text-white bg-green-500 px-5 py-3 rounded-lg shadow-lg hover:bg-green-600 transition-all focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-opacity-50">
                    Mark as Read
                </button>
                @else
                <button type="submit"
                    class="w-full sm:w-auto inline-flex justify-center items-center text-white bg-yellow-500 px-5 py-3 rounded-lg shadow-lg hover:bg-yellow-600 transition-all focus:outline-none focus:ring-4 focus:ring-yellow-300 focus:ring-opacity-50">
                    Mark as Unread
                </button>
                @endif
            </form>
            <a href="mailto:{{ $message->Email }}"
            class="w-full sm:w-auto h-full inline-flex justify-center items-center text-white bg-blue-500 px-5 py-3 rounded-lg shadow-lg hover:bg-blue-600 transition-all focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                ✉️ Email {{ $message->Full_Name }}
            </a>
            <form action="{{ route('messages.destroy', $message->ContactID) }}" method="POST" class="inline-block w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="delete-button w-full sm:w-auto inline-flex justify-center items-center text-white bg-red-500 px-5 py-3 rounded-lg shadow-lg hover:bg-red-600 transition-all focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50"
                    data-item-id="{{ $message->ContactID }}" data-action-url="{{ route('messages.destroy', $message->ContactID) }}">
                    Delete Message
                </button>
            </form>
        </div>
    </div>
</div>
<div id="delete-confirmation-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modal-content" class="bg-white rounded shadow-lg p-6 w-96 mx-auto">
        <form id="delete-form" method="POST" action="{{ old('action_url', '') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="action_url" id="action_url" value="{{ old('action_url', '') }}">
            <h2 class="text-lg font-medium text-gray-900 text-center">
                Are you sure you want to delete this message?
            </h2>
            <p class="mt-1 text-sm text-gray-600 text-center">
                Once this message is deleted, all of their data will be permanently deleted.
            </p>
            <div class="mt-6 flex justify-center">
                <button type="button" id="cancel-button" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Delete Message
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-button', function() {
            let actionUrl = $(this).data('action-url');
            $('#delete-form').attr('action', actionUrl);
            $('#action_url').val(actionUrl);
            $('#delete-confirmation-modal').removeClass('hidden');
        });

        $('#cancel-button').on('click', function() {
            $('#delete-confirmation-modal').addClass('hidden');
        });

        $('#delete-confirmation-modal').on('click', function(e) {
            if ($(e.target).is('#delete-confirmation-modal')) {
                $('#delete-confirmation-modal').addClass('hidden');
            }
        });

        $('#modal-content').on('click', function(e) {
            e.stopPropagation();
        });

        $('#delete-form').on('submit', function() {
            $('button[type="submit"]', this).prop('disabled', true);
        });
        if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }
    });
</script>