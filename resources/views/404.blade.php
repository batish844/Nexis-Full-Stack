@extends('layout')
@section('content')
<div class="flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-600 mb-2">Page Not Found</h2>
        <p class="text-gray-500 mb-6">Sorry, the page you are looking for could not be found.</p>
        <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">Return to Home</a>
    </div>
</div>
@endsection