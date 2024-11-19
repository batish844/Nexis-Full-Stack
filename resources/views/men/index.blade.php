@extends('layout')

@section('title', 'Men Store')

@section('content')
    <!-- Image Slider for Men Store -->
    <div class="image-slider">
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m1.jpg') }}" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m2.webp') }}" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m3.jpg') }}" alt="Slide 3">
        </div>
    </div>

    <!-- Products Section -->
    <div class="container">
        <div class="products" id="dynamic-products">
            <!-- JavaScript will load products here automatically -->
        </div>
    </div>
@endsection

@push('styles')
    @vite('resources/css/men.css') <!-- Women Store-specific CSS -->
@endpush

@push('scripts')
    @vite('resources/js/men.js') <!-- Women Store-specific JS -->
@endpush
