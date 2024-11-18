@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Create New Admin</h1>
        <p class="text-gray-600">Add a new admin to the system</p>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('users.store') }}" method="POST" class="grid grid-cols-1 gap-6">
            @csrf
            <div>
                <label for="First_Name" class="block text-blue-700 font-semibold mb-2">First Name</label>
                <input type="text" id="First_Name" name="First_Name" placeholder="Enter first name"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" 
                    value="{{ old('First_Name') }}" required>
                @error('First_Name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Last_Name" class="block text-blue-700 font-semibold mb-2">Last Name</label>
                <input type="text" id="Last_Name" name="Last_Name" placeholder="Enter last name"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" 
                    value="{{ old('Last_Name') }}" required>
                @error('Last_Name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-blue-700 font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter user email"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" 
                    value="{{ old('email') }}" required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Phone_Number" class="block text-blue-700 font-semibold mb-2">Phone Number</label>
                <input type="text" id="Phone_Number" name="Phone_Number" placeholder="Enter phone number"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400"
                    value="{{ old('Phone_Number') }}" required>
                @error('Phone_Number')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>            

            <div>
                <label for="password" class="block text-blue-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" 
                    required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-blue-700 font-semibold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 placeholder-gray-400" 
                    required>
            </div>

            <!-- Add Admin role -->
            <input type="hidden" name="isAdmin" value="1"> <!-- Always create as admin -->

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-400">
                    Create Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
