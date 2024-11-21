@extends('layout')

@section('title', 'Men Store')

@section('content')
<!-- Image Slider for Men Store -->
<div class="relative">
    <div class="image-slider overflow-hidden">
        <div class="slide active">
            <img src="{{ asset('storage/img/slides/m1.jpg') }}" alt="Slide 1" class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m2.webp') }}" alt="Slide 2" class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
        <div class="slide">
            <img src="{{ asset('storage/img/slides/m3.jpg') }}" alt="Slide 3" class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <!-- Search Bar Above the Products -->
        <div class="w-full md:w-1/2 lg:w-1/3">
            <input type="text" id="search-input" class="w-full p-3 rounded-lg border-2 border-gray-300 focus:ring-2 focus:ring-blue-500 text-lg" placeholder="Search for items...">
        </div>
    </div>

    <div class="flex gap-6">
        <!-- Filter Panel -->
        <div id="filter-panel" class="w-full sm:w-64 p-4 bg-gray-100 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Filters</h3>

            <!-- Price Filter -->
            <div class="price-filter mt-6">
                <h4 class="font-medium text-gray-700">Price</h4>
                <div class="wrapper">
                    <div class="values">
                        <span id="min-price-display">0</span>
                        <span>&dash;</span>
                        <span id="max-price-display">150</span>
                    </div>
                    <div class="container-slider">
                        <div class="slider-track"></div>
                        <input type="range" min="0" max="150" value="0" id="slider-1">
                        <input type="range" min="0" max="150" value="150" id="slider-2">
                    </div>
                </div>
            </div>

            <!-- Category Filter (Dropdown) -->
            <div class="category-filter mt-6">
                <h4 class="font-medium text-gray-700">Category</h4>
                <select id="category-dropdown" class="w-full mt-2 p-2 rounded-lg border-2 border-gray-300">
                    <option value="">All Items</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Items Section -->
        <div class="w-full sm:w-auto flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="dynamic-products">
            @foreach ($items as $item)
            <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105">
                <div class="item-image relative group">
                    <div class="carousel relative">
                        @foreach ($item->Photo as $index => $photo)
                        <img src="{{ $photo }}" 
                             alt="{{ $item->Name }}" 
                             class="carousel-img object-cover w-full h-64 {{ $index === 0 ? 'active' : 'hidden' }}">
                        @endforeach
                    </div>
                    <button class="carousel-btn left absolute top-1/2 -translate-y-1/2 left-2 bg-white rounded-full shadow p-2" onclick="prevImage(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="carousel-btn right absolute top-1/2 -translate-y-1/2 right-2 bg-white rounded-full shadow p-2" onclick="nextImage(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-800">{{ $item->Name }}</h3>
                    <p class="text-xl font-medium text-gray-600">${{ number_format($item->Price, 2) }}</p>
                    <button class="mt-4 py-2 px-4 w-full bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all">Add to Cart</button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No items found message -->
        <div id="no-items-message" class="text-center text-red-500 hidden w-full">
            <p>No items found in this price range.</p>
        </div>
    </div>
</div>
@endsection

@push('styles')
@vite('resources/css/men.css')
@endpush

@push('scripts')
<script>
    function prevImage(button) {
        const $carousel = $(button).closest('.item-image').find('.carousel');
        const $images = $carousel.find('.carousel-img');
        const activeIndex = $images.index($images.filter('.active'));
        $images.eq(activeIndex).removeClass('active').addClass('hidden');
        const newIndex = (activeIndex - 1 + $images.length) % $images.length;
        $images.eq(newIndex).removeClass('hidden').addClass('active');
    }

    function nextImage(button) {
        const $carousel = $(button).closest('.item-image').find('.carousel');
        const $images = $carousel.find('.carousel-img');
        const activeIndex = $images.index($images.filter('.active'));
        $images.eq(activeIndex).removeClass('active').addClass('hidden');
        const newIndex = (activeIndex + 1) % $images.length;
        $images.eq(newIndex).removeClass('hidden').addClass('active');
    }
    document.addEventListener("DOMContentLoaded", () => {
        const sliderOne = document.getElementById("slider-1");
        const sliderTwo = document.getElementById("slider-2");
        const minPriceDisplay = document.getElementById("min-price-display");
        const maxPriceDisplay = document.getElementById("max-price-display");
        const categoryDropdown = document.getElementById("category-dropdown");
        const searchInput = document.getElementById("search-input");
        const noItemsMessage = document.getElementById("no-items-message");
        const sliderTrack = document.querySelector(".slider-track");
        const sliderMaxValue = parseInt(sliderOne.max);
        const minGap = 5;

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

            updateProducts(sliderOne.value, sliderTwo.value, categoryDropdown.value, searchInput.value);
        };

        const fillColor = () => {
            const percent1 = (sliderOne.value / sliderMaxValue) * 100;
            const percent2 = (sliderTwo.value / sliderMaxValue) * 100;
            sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
        };

        const updateProducts = (minPrice, maxPrice, categoryId, searchQuery) => {
            $.ajax({
                url: "{{ route('filter.products') }}",
                method: "GET",
                data: { minPrice, maxPrice, category: categoryId, search: searchQuery },
                success: function (response) {
                    const productsContainer = document.getElementById("dynamic-products");
                    productsContainer.innerHTML = "";
                    if (response.length === 0) {
                        noItemsMessage.classList.remove("hidden");
                    } else {
                        noItemsMessage.classList.add("hidden");
                        response.forEach((product) => {
                            const productCard = `
                                <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105">
                                    <div class="carousel relative group">
                                        ${product.Photo.map((photo, index) => `
                                            <img src="${photo}" alt="${product.Name}" class="carousel-img w-full h-64 object-cover ${index === 0 ? 'active' : 'hidden'}">
                                        `).join('')}
                                        <button class="carousel-btn left"></button>
                                        <button class="carousel-btn right"></button>
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-semibold text-lg text-gray-800">${product.Name}</h3>
                                        <p class="text-xl font-medium text-gray-600">$${product.Price}</p>
                                        <button class="mt-4 py-2 px-4 w-full bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all">Add to Cart</button>
                                    </div>
                                </div>
                            `;
                            productsContainer.insertAdjacentHTML("beforeend", productCard);
                        });
                    }
                },
                error: function (error) {
                    console.error("Error fetching filtered products:", error);
                }
            });
        };

        fillColor();
        sliderOne.addEventListener("input", updateSliderValues);
        sliderTwo.addEventListener("input", updateSliderValues);
        categoryDropdown.addEventListener("change", () => {
            updateProducts(sliderOne.value, sliderTwo.value, categoryDropdown.value, searchInput.value);
        });
        searchInput.addEventListener("input", () => {
            updateProducts(sliderOne.value, sliderTwo.value, categoryDropdown.value, searchInput.value);
        });
        updateProducts(sliderOne.value, sliderTwo.value, categoryDropdown.value, searchInput.value);
    });
</script>
@endpush
