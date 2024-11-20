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
                @foreach ($categories as $category)
                <label>
                    <input type="checkbox" class="category-filter" value="${category->nNme}" /> {{$category->Name}}
                </label> <br>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Items Section -->
    <div class="flex-1 px-4 py-10 mx-auto w-full">
        <div id="dynamic-products" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($items as $item)
            <div class="product-card">
                <img src="{{ $item->Photo[0] }}" alt="{{ $item->name }}">
                <div class="product-details">
                    <h3 class="font-semibold">{{ $item->name }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div id="pagination" class="mt-4 text-center">
            <!-- Pagination buttons will be dynamically added here -->
        </div>
    </div>
</div>
@endsection

@push('styles')
@vite('resources/css/men.css')
@endpush

@push('scripts')
@vite('resources/js/men.js')
@endpush