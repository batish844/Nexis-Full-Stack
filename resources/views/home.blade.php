@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="relative w-full overflow-hidden aspect-[16/7]">
        <div class="absolute w-full opacity-0 transition-opacity transform slide active">
            <a href="{{ url('men') }}">
                <img src="{{ asset('storage/CommonImg/slide1.webp') }}" alt="Slide 1" class="w-full block">
            </a>
        </div>
        <div class="absolute w-full opacity-0 transition-opacity transform slide">
            <a href="{{ url('women') }}">
                <img src="{{ asset('storage/CommonImg/slide2.webp') }}" alt="Slide 2" class="w-full block">
            </a>
        </div>
        <div class="absolute w-full opacity-0 transition-opacity transform slide">
            <a href="{{ url('men') }}">
                <img src="{{ asset('storage/CommonImg/slide3.webp') }}" alt="Slide 3" class="w-full block">
            </a>
        </div>
    </div>

    <section class="py-10 text-center">
        <h2 class="text-3xl font-bold mb-6">Featured Items</h2>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-6 md:space-y-0 md:space-x-6">
            <a href="{{ url('men') }}" class="text-center no-underline">
                <img src="{{ asset('storage/men/c1.jpg') }}" alt="Item 1"
                    class="w-full max-w-[200px] h-auto rounded-lg shadow-lg">
                <p class="text-base mt-2 text-gray-700">Nexus Original's Men Shirt</p>
            </a>
            <a href="{{ url('women') }}" class="text-center no-underline">
                <img src="{{ asset('storage/women/I3.jpg') }}" alt="Item 2"
                    class="w-full max-w-[200px] h-auto rounded-lg shadow-lg">
                <p class="text-base mt-2 text-gray-700">Nexus Original's Women Shirt</p>
            </a>
            <a href="{{ url('men') }}" class="text-center no-underline">
                <img src="{{ asset('storage/men/c3.jpg') }}" alt="Item 3"
                    class="w-full max-w-[200px] h-auto rounded-lg shadow-lg">
                <p class="text-base mt-2 text-gray-700">Nexus Original's Men Shirt</p>
            </a>
        </div>
    </section>

    <section class="py-10 bg-gray-200 text-center">
        <h2 class="text-3xl font-bold mb-3">Explore More</h2>
        <p class="text-lg mb-5">Discover the latest trends in fashion and style with our exclusive collection.</p>
        <div class="space-x-4">
            <a href="{{ url('men') }}"
                class="inline-block px-6 py-3 bg-black text-white rounded-md m-2 hover:bg-gray-700">
                Shop Now For Men
            </a>
            <a href="{{ url('women') }}"
                class="inline-block px-6 py-3 bg-black text-white rounded-md m-2 hover:bg-gray-700">
                Shop Now For Women
            </a>
        </div>
    </section>
@endsection

@push('styles')
    <!-- @vite('resources/css/Homepage.css') Homepage-specific CSS -->
@endpush

@push('scripts')
@endpush
