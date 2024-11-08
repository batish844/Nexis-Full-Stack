@extends('layout')

@section('title', 'Home')

@section('content')
<!-- Image Slider -->
<div class="relative w-full overflow-hidden aspect-[16/9] md:aspect-[16/7] image-slider" id="imageSlider">
    @foreach ($slides as $slide)
    <div class="absolute inset-0 w-full opacity-0 transition-opacity duration-1000 ease-in-out slide {{ $loop->first ? 'active' : '' }}">
        <a href="{{ url($slide['url']) }}" class="group relative block w-full h-full">
            <img src="{{ asset('storage/CommonImg/'.$slide['image']) }}" alt="Slide {{ $loop->index + 1 }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-70 transition-opacity duration-500"></div>
            <div class="absolute bottom-10 left-10 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                <h3 class="text-4xl md:text-6xl font-extrabold">{{ strtoupper($slide['label']) }}</h3>
                <button class="mt-3 px-8 py-3 bg-white text-black rounded-full text-lg font-semibold shadow-lg hover:shadow-2xl transform hover:scale-105 transition">Shop {{ $slide['label'] === 'Offers' ? 'Now' : 'for '.strtolower($slide['label']) }}</button>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Featured Items Section -->
<section class="py-16 bg-gradient-to-b from-gray-100 to-gray-50 text-center relative">
    <h2 class="text-4xl font-extrabold tracking-tight text-gray-800 mb-12">Featured Items</h2>

    <!-- Subtle, minimal background pattern -->
    <div class="flex flex-wrap justify-center gap-8 mt-10">
        @foreach ($items as $item)
        <a href="{{ url($item['url']) }}" class="relative group w-[85vw] sm:w-[40vw] lg:w-[28vw] overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-500 transform hover:scale-105">
            <!-- Full-Width Image with Smooth Zoom on Hover -->
            <div class="relative overflow-hidden rounded-xl">
                <img src="{{ asset('storage/'.$item['url'].'/'.$item['image']) }}" class="w-full h-[450px] object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                <!-- Subtle border glow effect on hover -->
                <div class="absolute inset-0 border border-transparent rounded-xl transition-all duration-500"></div>
            </div>

            <!-- Text Overlay with Elegant Transition -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4 rounded-xl">
                <div class="text-left">
                    <h3 class="text-2xl font-semibold text-white">{{ $item['label'] }}</h3>
                    <p class="text-xs text-gray-300 mt-2 font-light">Limited Edition</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>





<!-- Explore Section -->
<section class="py-20 bg-gradient-to-b from-white to-gray-100 text-center">
    <h2 class="text-5xl font-bold mb-6 text-gray-900">Explore More</h2>
    <p class="text-lg mb-12 text-gray-700 max-w-3xl mx-auto">Discover the latest trends in fashion with our exclusive collection tailored for every occasion.</p>
    <div class="flex flex-wrap justify-center gap-6">
        <a href="{{ url('Men') }}" class="inline-block px-10 py-4 bg-gray-900 text-white rounded-full shadow-lg hover:bg-gray-700 transform hover:scale-105 transition duration-300">
            Shop Now For Men
        </a>
        <a href="{{ url('Women') }}" class="inline-block px-10 py-4 bg-gray-900 text-white rounded-full shadow-lg hover:bg-gray-700 transform hover:scale-105 transition duration-300">
            Shop Now For Women
        </a>
    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/Homepage.js')
<script>

</script>
@endpush

<style>
    /* Slider Styling */
    .slide {
        opacity: 0;
        position: absolute;
        inset: 0;
        visibility: hidden;
        transition: opacity 1s ease, visibility 1s ease, transform 1s ease;
    }

    .slide.active {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }

    .image-slider {
        height: 300px;
    }



    @media (min-width: 1024px) {
        .image-slider {
            height: 600px;
        }
    }

    @media (max-width: 768px) {
        .image-slider {
            height: 200px;
        }
    }
</style>