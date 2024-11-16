@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    @if(session('success'))
    <div class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Categories</h1>
        <p class="text-gray-600">Organize and maintain product categories</p>
    </div>

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0 mb-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 items-center">
            <input type="text" id="search" placeholder="Search categories" class="w-full sm:w-72 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select id="categoryfilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="desc">Most Items</option>
                <option value="asc">Least Items</option>
            </select>
        </div>

        <form method="POST" action="{{ route('categories.store') }}" class="flex space-x-4 items-center w-full lg:w-auto">
            @csrf
            <input type="text" placeholder="Add Category Here" class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Add
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-left text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Category</th>
                    <th class="px-6 py-3 font-semibold">Items Count</th>
                    <th class="px-6 py-3 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body-ajax" class="bg-white divide-y divide-gray-200">
                <!-- Rows will be inserted here via AJAX -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search, #categoryfilter').on('keyup change input', function() {
            console.log('Search input changed');
            performSearch();
        });

        performSearch();

        if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }

        function performSearch() {
            let name = $('#search').val();
            let categoryfilter = $('#categoryfilter').val();
            $.ajax({
                url: '{{ route("categories.search") }}',
                method: 'GET',
                data: {
                    name: name,
                    categoryfilter: categoryfilter
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