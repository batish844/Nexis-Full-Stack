@extends('layout')
@section('content')
<div class="flex items-center justify-center my-10">
    <div class="text-center px-4 sm:px-8">
        <div class="mb-6">
            <img src="{{ asset('/storage/img/CommonImg/404.png') }}" alt="404 Illustration" class="w-64 mx-auto sm:w-64 animate-pulse">
        </div>
        <h2 class="text-3xl sm:text-4xl font-semibold text-gray-800 mb-4">Page Not Found</h2>
        <p class="text-lg text-gray-500 mb-6">
            Oops! It seems like the page you're looking for doesn't exist.
        </p>
        <a href="{{ url('/') }}" class="inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all">
            Return to Home
        </a>
        <p class="mt-4 text-gray-400 text-sm">
            If you think something's broken, <a href="{{ url('/contact-us') }}" class="text-blue-600 underline">let us know</a>.
        </p>
    </div>
</div>
@endsection