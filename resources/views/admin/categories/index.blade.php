@extends('admin.layouts.sidebar')
@section('content')
<div class="container mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Categories</h1>
        <p class="text-gray-600">Organize and maintain product categories</p>
    </div>
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center space-y-4 lg:space-y-0 mb-8">
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 items-center">
            <input type="text" placeholder="Search categories" class="w-full sm:w-72 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

            <select class="w-full sm:w-40 px-4 py-2 border rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <!-- dynamically -->
                <option value="all">All Categories</option>
            </select>
        </div>

        <form class="flex space-x-4 items-center w-full lg:w-auto">
            <input type="text" placeholder="Add or Edit Category" class="flex-grow px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Save
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
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Example -->
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="px-6 py-4 flex items-center">

                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900">Category 1</div>
                            <div class="text-sm text-gray-500">Additional info</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            12
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="#" class="text-blue-500 hover:text-blue-700">
                                <img src="path/to/icon.png" alt="Show" class="w-5 h-5 inline-block">
                                Show
                            </a>
                            <a href="#" class="text-green-500 hover:text-green-700">
                                <img src="/storage/img/icons/edit.png" alt="Show" class="w-5 h-5 inline-block">

                                Edit
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5 inline-block" fill="currentColor" viewBox="0 0 20 20">
                                    <!-- SVG content -->
                                </svg>
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
                <!-- More rows -->
            </tbody>
        </table>
    </div>
</div>


@endsection