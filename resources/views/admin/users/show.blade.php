@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            User: <span class="text-blue-600">{{ $user->Full_Name }}</span>
        </h1>
        <a href="{{ route('users.index') }}"
            class="text-gray-700 bg-gray-100 px-5 py-2 rounded-lg shadow hover:bg-gray-200 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back to Users
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">First Name</h2>
                <p class="text-xl font-bold text-gray-800">{{ $user->First_Name }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Last Name</h2>
                <p class="text-xl font-bold text-gray-800">{{ $user->Last_Name }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Email</h2>
                <p class="text-gray-700">{{ $user->email }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Phone Number</h2>
                <p class="text-gray-700">{{ $user->Phone_Number }}</p>
            </div>
            @if ($user->isAdmin == 0)
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Address</h2>
                <p class="text-gray-700">{{ $user->Full_Address }}</p>
            </div>
            @endif
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Created At</h2>
                <p class="text-gray-700">{{ $user->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Last Updated</h2>
                <p class="text-gray-700">{{ $user->updated_at->format('d M Y, h:i A') }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Role</h2>
                <p class="text-gray-700">
                    @if ($user->isAdmin == 1)
                    Admin
                    @else
                    Customer
                    @endif
                </p>
            </div>
            @if ($user->isAdmin == 0)
            <!-- Order Count and Total Points -->
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Total Orders</h2>
                    <p class="text-gray-700">{{ $user->orders_count }}</p>
                </div>
                <div>
                    <a href="{{ route('orders.index', ['userID' => $user->UserID]) }}"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        See Orders
                    </a>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Total Points</h2>
                <p class="text-gray-700">{{ $user->Points ?? 0 }}</p>
            </div>
            @endif
        </div>
    </div>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('users.edit', $user->UserID) }}"
            class="px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg shadow hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            Edit User
        </a>

        <!-- See Orders Button (already placed beside total orders above) -->
        <!-- Deactivate/Activate Button -->
        @if(Auth::id() !== $user->UserID)
        <form action="{{ route('users.toggleStatus', $user->UserID) }}" method="POST" class="inline">
            @csrf
            @method('PUT')
            <button type="submit"
            class="px-6 py-3 {{ $user->isActive ? 'bg-red-600 hover:bg-red-500' : 'bg-green-600 hover:bg-green-500' }} text-white font-semibold rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
            {{ $user->isActive ? 'Deactivate User' : 'Activate User' }}
            </button>
        </form>
        @endif
    </div>

    <!-- Delete Button placed right below the other buttons -->
    <div class="mt-6 flex justify-end">
        <form action="{{ route('users.destroy', $user->UserID) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="button"
                class="delete-button px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400"
                data-user-id="{{ $user->UserID }}" data-action-url="{{ route('users.destroy', $user->UserID) }}">
                Delete User
            </button>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modal-content" class="bg-white rounded shadow-lg p-6 w-96 mx-auto">
        <form id="delete-form" method="POST" action="{{ old('action_url', '') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="action_url" id="action_url" value="{{ old('action_url', '') }}">
            <h2 class="text-lg font-medium text-gray-900 text-center">
                Are you sure you want to delete {{$user->Full_Name}}?
            </h2>
            <p class="mt-1 text-sm text-gray-600 text-center">
                Once this user is deleted, all of their data will be permanently deleted.
            </p>
            <div class="mt-6 flex justify-center">
                <button type="button" id="cancel-button" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Delete Category
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    });
</script>

@endsection
