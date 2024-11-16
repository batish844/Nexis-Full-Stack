@extends('admin.layouts.sidebar')

@section('content')
<div class="mx-auto">
    <div class="flex justify-between items-center mb-3">
        <h1 class="text-4xl font-extrabold text-gray-900">
            User: <span class="text-blue-600">{{ $user->name }}</span>
        </h1>
        <a href="{{ route('users.index') }}"
            class="text-gray-700 bg-gray-100 px-5 py-2 rounded-lg shadow hover:bg-gray-200 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back to Users
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-lg border mb-10 p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">User Name</h2>
                <p class="text-xl font-bold text-gray-800">{{ $user->name }}</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-blue-700 uppercase mb-2">Email Address</h2>
                <p class="text-gray-700">{{ $user->email }}</p>
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
    <div class="bg-white rounded-xl shadow-lg border p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            @csrf
            @method('PUT')
            <div>
                <label for="userName" class="block text-blue-700 font-semibold mb-2">Name</label>
                <input type="text" id="userName" name="name" placeholder="Enter user name" value="{{ $user->name }}"
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
            </div>
            <div>
                <label for="userEmail" class="block text-blue-700 font-semibold mb-2">Email</label>
                <input type="email" id="userEmail" name="email" placeholder="Enter user email" value="{{ $user->email }}"
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
            </div>
            <div>
                <label for="userPassword" class="block text-blue-700 font-semibold mb-2">Password</label>
                <input type="password" id="userPassword" name="password" placeholder="Enter new password (optional)"
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
            </div>
            <div>
                <label for="userPasswordConfirm" class="block text-blue-700 font-semibold mb-2">Confirm Password</label>
                <input type="password" id="userPasswordConfirm" name="password_confirmation"
                    placeholder="Confirm new password"
                    class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400 shadow">
            </div>
            <div class="col-span-1 sm:col-span-2 flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
