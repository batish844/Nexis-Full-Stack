@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="image-slider">
        <div class="slide">
            <a href="{{ url('men') }}">
                <img src="{{ asset('storage/CommonImg/slide1.webp') }}" alt="Slide 1">
            </a>
        </div>
        <div class="slide">
            <a href="{{ url('women') }}">
                <img src="{{ asset('storage/CommonImg/slide2.webp') }}" alt="Slide 2">
            </a>
        </div>
        <div class="slide">
            <a href="{{ url('men') }}">
                <img src="{{ asset('storage/CommonImg/slide3.webp') }}" alt="Slide 3">
            </a>
        </div>
    </div>

    <section class="featured-items">
        <h2>Featured Items</h2>
        <div class="item-container">
            <a href="{{ url('men') }}" class="item">
                <img src="{{ asset('storage/men/c1.jpg') }}" alt="Item 1">
                <p>Nexus Original's Men Shirt</p>
            </a>
            <a href="{{ url('women') }}" class="item">
                <img src="{{ asset('storage/women/I3.jpg') }}" alt="Item 2">
                <p>Nexus Original's Women Shirt</p>
            </a>
            <a href="{{ url('men') }}" class="item">
                <img src="{{ asset('storage/men/c3.jpg') }}" alt="Item 3">
                <p>Nexus Original's Men Shirt</p>
            </a>
        </div>
    </section>

    <section class="explore">
        <h2>Explore More</h2>
        <p>Discover the latest trends in fashion and style with our exclusive collection.</p>
        <a href="{{ url('men') }}" class="explore-link">Shop Now For Men</a>
        <a href="{{ url('women') }}" class="explore-link">Shop Now For Women</a>
    </section>
@endsection

@push('styles')
    @vite('resources/css/Homepage.css') <!-- Homepage-specific CSS -->
@endpush

@push('scripts')
    @vite('resources/js/Homepage.js') <!-- Homepage-specific JS -->
@endpush
