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
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Categories</h1>
        <p class="text-gray-600">Organize and maintain product categories</p>
    </div>

    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0 mb-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-2 items-center">
            <input type="text" id="search" placeholder="Search categories" class="w-full sm:w-72 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <label for="genderfilter" class="text-gray-600">Sort by Gender:</label>
            <select id="genderfilter" class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="A">All</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>

        <form method="POST" action="{{ route('categories.store') }}" class="flex space-x-2 w-full lg:w-auto">
            @csrf
            <input type="text" id="name" name="name" placeholder="Add Category Here" class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select id="gender" name="gender" class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected class="text-gray-500">Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Add
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 shadow-lg rounded-lg overflow-x-auto text-center">
            <thead class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white">

                <tr class="text-sm uppercase tracking-wider">

                    <th class="px-6 py-3 font-semibold">Category</th>

                    <th class="px-6 py-3 font-semibold hidden md:table-cell">Associated Items</th>

                    <th class="px-6 py-3 font-semibold hidden md:table-cell">Gender</th>


                    <th class="px-6 py-3 font-semibold">Actions</th>

                </tr>

            </thead>

            <tbody id="table-body-ajax" class="bg-white divide-y divide-gray-200">

                <!-- Rows will be inserted here via AJAX -->

            </tbody>
        </table>
    </div>
</div>

<div id="delete-confirmation-modal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 {{ $errors->has('password') ? '' : 'hidden' }}">
    <div id="modal-content" class="bg-white rounded shadow-lg p-6 w-96 mx-auto">
        <form id="delete-form" method="POST" action="{{ old('action_url', '') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="action_url" id="action_url" value="{{ old('action_url', '') }}">

            <h2 class="text-lg font-medium text-gray-900 text-center">
                Are you sure you want to delete this category?
            </h2>

            <p class="mt-1 text-sm text-gray-600 text-center">
                Once this category is deleted, all of its resources and data will be permanently deleted.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-button', function() {
            let actionUrl = $(this).data('action-url');
            //this basically sets the form action attribute to the URL of the delete button that was clicked along with its id (check rows.blade.php the delete button)
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

        $('#search, #categoryfilter, #genderfilter').on('keyup change input', function() {
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
            let genderfilter = $('#genderfilter').val();
            $.ajax({
                url: '{{ route("categories.search") }}',
                method: 'GET',
                data: {
                    name: name,
                    genderfilter: genderfilter
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