@extends('auth.layout')

@section('content')
<div class="text-center">
    <h1 class="text-3xl font-bold text-gray-900">Reset Password</h1>
    <p class="mt-2 text-gray-600">Enter your details to reset your password.</p>
</div>

<form method="POST" action="{{ route('password.store') }}" class="space-y-4">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email', request()->email) }}" required autofocus autocomplete="username"
            class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password"
            class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
            class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Submit -->
    <div>
        <button type="submit"
            class="w-full py-3 px-6 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Reset Password
        </button>
    </div>
</form>
@endsection