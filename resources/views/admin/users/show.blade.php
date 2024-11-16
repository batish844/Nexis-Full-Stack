@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">User: <span class="text-blue-600">{{ $user->First_Name }} {{ $user->Last_Name }}</span></h1>
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
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Password (Hashed)</h2>
                <p class="text-gray-700">{{ $user->password }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Created At</h2>
                <p class="text-gray-700">{{ $user->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Last Updated</h2>
                <p class="text-gray-700">{{ $user->updated_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('users.edit', $user->id) }}" 
            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Edit User
        </a>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400"
                onclick="return confirm('Are you sure you want to delete this user?');">
                Delete User
            </button>
        </form>
    </div>
</div>
@endsection
