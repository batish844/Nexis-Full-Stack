@extends('layout')

@section('title', 'Women Store')

@section('content')
    <!-- Image Slider for Women Store -->
    <div class="image-slider">
        <div class="slide">
            <img src="{{ asset('storage/img/slides/g1.webp') }}" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/g2.webp') }}" alt="Slide 3">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/g3.jpg') }}" alt="Slide 1">
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
    @vite('resources/css/women.css') <!-- Women Store-specific CSS -->
@endpush

@push('scripts')
    @vite('resources/js/women.js') <!-- Women Store-specific JS -->
@endpush
