@extends('auth.layout')

@section('content')
<div class="text-center">
    <h1 class="text-3xl font-bold text-gray-900">Forgot Password</h1>
    <p class="mt-2 text-gray-600">Enter your email to receive a reset link.</p>
</div>

<form method="POST" action="{{ route('password.email') }}" class="space-y-4">
    @csrf

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input id="email" type="email" name="email" required autocomplete="username"
            class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    </div>

    <!-- Submit -->
    <div>
        <button type="submit"
            class="w-full py-3 px-6 bg-blue-600 text-white font-bold rounded-lg shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Send Reset Link
        </button>
    </div>
</form>
@endsection
