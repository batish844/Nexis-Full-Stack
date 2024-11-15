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
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-gray-700 font-semibold text-sm tracking-wider border-b">
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Items Count</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-800 text-sm">
                <!-- Example -->
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">Category 1</td>
                    <td class="px-6 py-4">12</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-600 font-medium hover:underline flex items-center">
                                <span class="mr-1">📃</span> Show
                            </a>
                            <a href="#" class="text-green-600 font-medium hover:underline flex items-center">
                                <span class="mr-1">✏️</span> Edit
                            </a>
                            <a href="#" class="text-red-600 font-medium hover:underline flex items-center">
                                <span class="mr-1">🗑️</span> Delete
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection