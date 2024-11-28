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
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Products</h1>
        <p class="text-gray-600">Organize and maintain product inventory</p>
    </div>

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0 mb-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-2 items-center">
            <input type="text" id="search" placeholder="Search products" class="w-full sm:w-72 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <label for="categoryfilter" class="text-gray-600">Category:</label>
            <select id="categoryfilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">All</option>
                @foreach($categories as $category)
                <option value="{{$category->CategoryID }}">{{ $category->Name }} - {{ $category->Gender }} </option>
                @endforeach

            </select>
            <label for="availabilityfilter" class="text-gray-600">Availability:</label>
            <select id="availabilityfilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">All</option>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
            </select>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('products.create') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Add New Product
            </a>
            <button id="download-csv" class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow hover:bg-gray-500">
                Download CSV
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg text-center">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">
                <tr class="text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-semibold">Preview</th>
                    <th class="px-6 py-3 font-semibold">Name</th>
                    <th class="px-6 py-3 font-semibold hidden md:table-cell">Category</th>
                    <th class="px-6 py-3 font-semibold hidden md:table-cell">Price</th>
                    <th class="px-6 py-3 font-semibold hidden md:table-cell">Quantity</th>
                    <th class="px-6 py-3 font-semibold">Availability</th>
                    <th class="px-6 py-3 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body-ajax" class="bg-white divide-y divide-gray-200">
                <!-- Rows will be dynamically populated via AJAX -->
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            let debounceTimer;
            $('#search, #genderfilter, #categoryfilter , #availabilityfilter').on('keyup change input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(performSearch, 300);
            });

            performSearch();

            if ($('.flash-message').length) {
                $('.flash-message').delay(3000).fadeOut(500, function() {
                    $(this).remove();
                });
            }
            $('#download-csv').on('click', function() {
                window.location.href = '{{ route("products.export") }}';
            });

            function performSearch() {
                let name = $('#search').val()
                let categoryfilter = $('#categoryfilter').val();
                let availabilityfilter = $('#availabilityfilter').val();
                let genderfilter = $('#genderfilter').val();
                $.ajax({
                    url: '{{ route("products.search") }}',
                    method: 'GET',
                    data: {
                        name: name,
                        genderfilter: genderfilter,
                        categoryfilter: categoryfilter,
                        availabilityfilter: availabilityfilter
                    },
                    success: function(response) {
                        console.log('yap');
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