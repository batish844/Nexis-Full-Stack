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
        <p class="text-gray-600">Search, organize, and manage users</p>
    </div>

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0 mb-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 items-center">
            <input type="text" id="search" placeholder="Search users by name"
                class="w-full sm:w-72 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select id="nameOrder" class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="asc">A → Z</option>
                <option value="desc">Z → A</option>
            </select>
        </div>

        <a href="{{ route('users.create') }}"
            class="flex items-center px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
            Add New User
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-left text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">First Name</th>
                    <th class="px-6 py-3 font-semibold">Last Name</th>
                    <th class="px-6 py-3 font-semibold">Email</th>
                    <th class="px-6 py-3 font-semibold">Password</th>
                    <th class="px-6 py-3 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body-ajax" class="bg-white divide-y divide-gray-200">
                @include('admin.users.rows', ['users' => $users])
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Trigger search on input change
        $('#search, #nameOrder').on('keyup change input', function() {
            performSearch();
        });

        // Initial load
        performSearch();

        // Flash message auto-hide
        if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }

        // Function to perform AJAX search
        function performSearch() {
            let name = $('#search').val();
            let nameOrder = $('#nameOrder').val();
            $.ajax({
                url: '{{ route("users.search") }}',
                method: 'GET',
                data: {
                    name: name, // User input for search
                    nameOrder: nameOrder // User-selected sort order
                },
                success: function(response) {
                    $('#table-body-ajax').html(response); // Populate the table with the response
                },
                error: function(xhr) {
                    console.error('AJAX error:', xhr.responseText);
                }
            });

        }
    });
</script>
@endsection