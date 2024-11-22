@extends('layout')

@section('title', 'Women Store')

@section('content')
<!-- Image Slider for Women Store -->
<!-- <div class="image-slider">
    <div class="slide">
        <img src="{{ asset('storage/img/slides/g1.webp') }}" alt="Slide 1">
    </div>
    <div class="slide">
        <img src="{{ asset('storage/img/slides/g2.webp') }}" alt="Slide 3">
    </div>
    <div class="slide">
        <img src="{{ asset('storage/img/slides/g3.jpg') }}" alt="Slide 1">
    </div>
</div> -->
<div class="container mx-auto px-4 py-10">
    <div class="flex justify-center items-center mb-6">
        <div class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            <input type="text" id="search-input" class="w-full p-3 rounded-full border-2 border-gray-300 focus:ring-2 focus:ring-blue-500 text-lg" placeholder="Search for items...">
        </div>
    </div>


    <div class="flex flex-col lg:flex-row gap-6">
        <div id="filter-panel" class="w-full sm:w-64 p-6 bg-gray-50 rounded-lg shadow-md mb-6 lg:mb-0">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Filters</h3>
            <div class="price-filter mt-6">
                <h4 class="font-medium text-gray-700">Price</h4>
                <div class="flex justify-between mb-2">
                    <span id="min-price-display">0</span>
                    <span>&dash;</span>
                    <span id="max-price-display">150</span>
                </div>
                <div class="relative">
                    <div class="slider-track bg-gray-200 h-2 rounded-full"></div>
                    <input type="range" min="0" max="150" value="0" id="slider-1" class="absolute left-0 w-full cursor-pointer opacity-0">
                    <input type="range" min="0" max="150" value="150" id="slider-2" class="absolute right-0 w-full cursor-pointer opacity-0">
                </div>
            </div>

            <div class="category-filter mt-6">
                <h4 class="font-medium text-gray-700">Category</h4>
                <select id="category-dropdown" class="w-full mt-2 p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Items</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="w-full flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="dynamic-products">

        </div>




    </div>
</div>
@endsection

@push('styles')
@vite('resources/css/men.css')
@endpush

@push('scripts')
@vite('resources/js/men.js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let sliderOne = document.getElementById("slider-1");
        let sliderTwo = document.getElementById("slider-2");
        let minPriceDisplay = document.getElementById("min-price-display");
        let maxPriceDisplay = document.getElementById("max-price-display");
        let categoryDropdown = document.getElementById("category-dropdown");
        let searchInput = document.getElementById("search-input");
        let sliderTrack = document.querySelector(".slider-track");
        let sliderMaxValue = parseInt(sliderOne.max);
        let minGap = 5;
        let productsContainer = document.getElementById("dynamic-products");
        const updateSliderValues = () => {
            if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
                if (sliderOne === document.activeElement) {
                    sliderOne.value = parseInt(sliderTwo.value) - minGap;
                } else {
                    sliderTwo.value = parseInt(sliderOne.value) + minGap;
                }
            }
            minPriceDisplay.textContent = sliderOne.value;
            maxPriceDisplay.textContent = sliderTwo.value;
            fillColor();
            updateProducts();
        };

        const fillColor = () => {
            let percent1 = (sliderOne.value / sliderMaxValue) * 100;
            let percent2 = (sliderTwo.value / sliderMaxValue) * 100;
            sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
        };
        const updateProducts = () => {
            let minPrice = sliderOne.value;
            let maxPrice = sliderTwo.value;
            let categoryId = categoryDropdown.value;
            let searchQuery = searchInput.value;

            $.ajax({
                url: "{{ route('women.filter.products') }}",
                method: "GET",
                data: {
                    minPrice,
                    maxPrice,
                    category: categoryId,
                    search: searchQuery
                },
                success: function(response) {
                    $('#dynamic-products').html(response);
                    initializeCarousel();

                },
                error: function(error) {
                    console.error("Error fetching filtered products:", error);
                }
            });
        };

        // Updated Carousel logic initialization
        const initializeCarousel = () => {
            const carousels = document.querySelectorAll(".carousel");
            carousels.forEach((carousel) => {
                let currentIndex = 0;
                let images = carousel.querySelectorAll(".carousel-img");
                let leftButton = carousel.querySelector(".carousel-btn.left");
                let rightButton = carousel.querySelector(".carousel-btn.right");

                const updateImage = () => {
                    images.forEach((img, idx) => {
                        if (idx === currentIndex) {
                            img.classList.remove("hidden");
                            img.classList.add("active");
                        } else {
                            img.classList.remove("active");
                            img.classList.add("hidden");
                        }
                    });
                };

                // Add event listeners only if buttons exist
                if (leftButton) {
                    leftButton.addEventListener("click", () => {
                        currentIndex = (currentIndex - 1 + images.length) % images.length;
                        updateImage();
                    });
                }
                if (rightButton) {
                    rightButton.addEventListener("click", () => {
                        currentIndex = (currentIndex + 1) % images.length;
                        updateImage();
                    });
                }

                updateImage(); // Initialize the carousel with the first image
            });
        };

        fillColor();
        sliderOne.addEventListener("input", updateSliderValues);
        sliderTwo.addEventListener("input", updateSliderValues);
        categoryDropdown.addEventListener("change", updateProducts);
        searchInput.addEventListener("input", updateProducts);

        updateProducts();
        initializeCarousel(); // Initialize carousels when page loads
    });
</script>
@endpush