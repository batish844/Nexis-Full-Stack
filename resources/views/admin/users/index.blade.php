@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    @if(session('success'))
    <div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
        {{ session('error') }}
    </div>
    @endif
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Users</h1>
        <a href="{{ route('users.create') }}"
            class="text-white bg-blue-600 px-6 py-3 rounded-lg shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Add New Admin
        </a>
    </div>

    <div class="mb-6 flex justify-between items-center">
        <!-- Filter Dropdown -->
        <form id="filtersForm" class="flex items-center space-x-6">
            <select name="role" id="role" class="px-4 py-2 w-48 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all" {{ $role === 'all' ? 'selected' : '' }}>All Users</option>
                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admins</option>
                <option value="customer" {{ $role === 'customer' ? 'selected' : '' }}>Customers</option>
            </select>

            <!-- Search Bar -->
            <input type="text" name="search" id="search" value="{{ request()->get('search') }}" placeholder="Search by name, email, phone"
                class="px-4 py-2 w-72 max-w-xs border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />

            <!-- Sort Order Dropdown -->
            <select name="nameOrder" id="nameOrder" class="px-4 py-2 w-48 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="asc" {{ request()->get('nameOrder') === 'asc' ? 'selected' : '' }}>Sort by Name (A-Z)</option>
                <option value="desc" {{ request()->get('nameOrder') === 'desc' ? 'selected' : '' }}>Sort by Name (Z-A)</option>
            </select>

            <!-- Reset Button -->
            <button type="button" id="resetFilters"
                class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Reset Filters
            </button>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-left text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Full Name</th>
                    <th class="px-6 py-3 font-semibold">Email</th>
                    <th class="px-6 py-3 font-semibold">Phone Number</th>
                    <th class="px-6 py-3 font-semibold">Manage</th>
                </tr>
            </thead>
            <tbody id="table-body-ajax">
                @include('admin.users.rows', ['users' => $users]) <!-- Initial rows -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Automatically submit the form on input change or select change
        $('#search, #role, #nameOrder').on('input change', function() {
            performSearch();
        });

        // Reset Filters functionality
        $('#resetFilters').on('click', function() {
            $('#role').val('all');
            $('#search').val('');
            $('#nameOrder').val('asc');
            performSearch(); // Trigger the AJAX search
        });
        if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }
        // Perform the AJAX search
        function performSearch() {
            let name = $('#search').val();
            let role = $('#role').val();
            let nameOrder = $('#nameOrder').val();

            $.ajax({
                url: '{{ route("users.index") }}',
                method: 'GET',
                data: {
                    search: name,
                    role: role,
                    nameOrder: nameOrder
                },
                success: function(response) {
                    $('#table-body-ajax').html(response);
                },
                error: function(xhr) {
                    console.error('AJAX error:', xhr.responseText);
                }
            });
        }
    });
</script>

@endsection