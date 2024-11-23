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
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Orders</h1>
        <p class="text-gray-600">Monitor and process customer orders efficiently</p>
    </div>

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0 mb-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-2 items-center w-full lg:w-auto">
            <input type="text" id="search" name="email" placeholder="Search by customer or email"
                value="{{ request('email') }}"
                class="w-full sm:w-72 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <label for="statusFilter" class="text-gray-600">Status:</label>
            <select id="statusFilter"
                class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">All</option>
                <option value="Completed">Completed</option>
                <option value="Processing">Processing</option>
                <option value="Pending">Pending</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="w-full lg:w-auto">
            <button id="download-csv"
                class="px-4 py-2 w-full sm:w-48 bg-gray-600 text-white font-semibold rounded-lg shadow hover:bg-gray-500">
                Download CSV
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg text-center">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Customer</th>
                    <th class="px-6 py-3 font-semibold">Email</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 font-semibold">Total Price</th>
                    <th class="px-6 py-3 font-semibold">Date</th>
                    <th class="px-6 py-3 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body-ajax" class="bg-white divide-y divide-gray-200">
                <!-- AJAX Content -->
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search, #statusFilter').on('keyup change', function() {
                performSearch();
            });

            function performSearch() {
                let searchQuery = $('#search').val();
                let statusFilter = $('#statusFilter').val();

                $.ajax({
                    url: '{{ route("orders.search") }}',
                    method: 'GET',
                    data: {
                        search: searchQuery,
                        status: statusFilter
                    },
                    success: function(response) {
                        $('#table-body-ajax').html(response);
                        if (history.pushState) {
                            const newUrl = '{{ route("orders.index") }}';
                            window.history.pushState({
                                path: newUrl
                            }, '', newUrl);
                        }
                    },
                    error: function(xhr) {
                        console.error('AJAX Error:', xhr.responseText);
                    }
                });
            }

            performSearch();

            $('#download-csv').on('click', function() {
                window.location.href = '{{ route("orders.export") }}';
            });
            if ($('#search').val()) {
                performSearch();
            }
            if ($('.flash-message').length) {
                $('.flash-message').delay(3000).fadeOut(500, function() {
                    $(this).remove();
                });
            }
        });
    </script>
</div>
@endsection