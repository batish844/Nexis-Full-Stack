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
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Users</h1>
        <p class="text-gray-600">Organize and maintain User's information</p>
    </div>
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">

        <div class="flex items-center space-x-4">
            <a href="{{ route('users.create') }}"
                class="text-white bg-blue-600 px-6 py-3 rounded-lg shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Add New Admin
            </a>
            <!-- Reset Filters Button -->
            <button type="button" id="resetFilters"
                class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Reset Filters
            </button>
        </div>
    </div>

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
        <!-- Filter Dropdown -->
        <form id="filtersForm" class="flex flex-wrap sm:flex-nowrap items-center space-y-4 sm:space-y-0 sm:space-x-4">
            <select name="role" id="role" class="px-4 py-2 w-full sm:w-48 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all" {{ $role === 'all' ? 'selected' : '' }}>All Roles</option>
                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admins</option>
                <option value="customer" {{ $role === 'customer' ? 'selected' : '' }}>Customers</option>
            </select>

            <!-- Search Bar -->
            <input type="text" name="search" id="search" value="{{ request()->get('search') }}" placeholder="Search by name, email, phone"
                class="px-4 py-2 w-full sm:w-72 max-w-xs border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />

            <!-- Sort Order Dropdown -->
            <select name="nameOrder" id="nameOrder" class="px-4 py-2 w-full sm:w-48 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="asc" {{ request()->get('nameOrder') === 'asc' ? 'selected' : '' }}>Sort by Name (A-Z)</option>
                <option value="desc" {{ request()->get('nameOrder') === 'desc' ? 'selected' : '' }}>Sort by Name (Z-A)</option>
            </select>

            <!-- Activation Status Dropdown -->
            <select name="status" id="status" class="px-4 py-2 w-full sm:w-48 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="activated" {{ request()->get('status') === 'activated' || !request()->has('status') ? 'selected' : '' }}>Activated</option>
                <option value="deactivated" {{ request()->get('status') === 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                <option value="all" {{ request()->get('status') === 'all' ? 'selected' : '' }}>All Users</option>
            </select>
        </form>
        <button id="download-csv" class="px-4 py-2 w-full sm:w-48 bg-gray-600 text-white font-semibold rounded-lg shadow hover:bg-gray-500">
            Download CSV
        </button>
    </div>


    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-left text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Full Name</th>
                    <th class="px-6 py-3 font-semibold">Email</th>
                    <th class="px-6 py-3 font-semibold">Phone Number</th>
                    <th class="px-6 py-3 font-semibold">Orders Count</th>
                    <th class="px-6 py-3 font-semibold">Total Points</th>
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
        let debounceTimer;
        $('#search, #role, #nameOrder, #status').on('input change', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(performSearch, 300);   
             });
        

        // Reset Filters functionality
        $('#resetFilters').on('click', function() {
            $('#role').val('all');
            $('#search').val('');
            $('#nameOrder').val('asc');
            $('#status').val('all');
            performSearch(); // Trigger the AJAX search
        });

        if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }
        performSearch();
        $('#download-csv').on('click', function() {
            window.location.href = '{{ route("users.export") }}';
        });
        // Perform the AJAX search
        function performSearch() {
            let name = $('#search').val();
            let role = $('#role').val();
            let nameOrder = $('#nameOrder').val();
            let status = $('#status').val();

            $.ajax({
                url: '{{ route("users.index") }}',
                method: 'GET',
                data: {
                    search: name,
                    role: role,
                    nameOrder: nameOrder,
                    status: status
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