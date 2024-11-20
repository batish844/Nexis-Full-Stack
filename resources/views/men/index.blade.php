@extends('layout')

@section('title', 'Men Store')

@section('content')
    <!-- Image Slider for Men Store -->
    <div class="image-slider">
        <div class="slide active">
            <img src="{{ asset('storage/img/slides/m1.jpg') }}" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m2.webp') }}" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m3.jpg') }}" alt="Slide 3">
        </div>
    </div>
    <div class="container flex">

<<<<<<< HEAD
        <!-- Filter Panel -->
        <div id="filter-panel" class="w-64 p-4 bg-gray-200">
            <h3 class="text-lg font-semibold">Filters</h3>

            <!-- Price Filter -->
            <div class="price-filter mt-4">
                <h4 class="font-medium">Price</h4>
                <input type="range" id="price-range" min="0" max="1000" value="0" step="10" class="w-full mt-2">
                <div class="flex justify-between">
                    <span id="min-price">0</span>
                    <span id="max-price">50</span>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="category-filter mt-4">
                <h4 class="font-medium">Category</h4>
                <div id="category-checkboxes" class="mt-2">
                    <!-- Categories will be dynamically loaded here -->
                </div>
            </div>
        </div>

        <!-- Items Section -->
        <div class="flex-1 px-4 py-10 mx-auto w-full">
            <div id="dynamic-products" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Items will be dynamically loaded here -->
            </div>  

            <!-- Pagination -->
            <div id="pagination" class="mt-4 text-center">
                <!-- Pagination buttons will be dynamically added here -->
            </div>
=======
    <!-- Products Section -->
    <div class="container">
        <div class="products" id="dynamic-products">
            <!-- JavaScript will load products here automatically -->
>>>>>>> 7db139d823a1662a1bc55cfd828a28650b3fc9a8
        </div>
    </div>
@endsection

@push('styles')
<<<<<<< HEAD
    @vite('resources/css/men.css')
@endpush

@push('scripts')
    @vite('resources/js/men.js')
=======
    @vite('resources/css/men.css') <!-- Women Store-specific CSS -->
@endpush

@push('scripts')
    @vite('resources/js/men.js') <!-- Women Store-specific JS -->
>>>>>>> 7db139d823a1662a1bc55cfd828a28650b3fc9a8
@endpush
