@extends('layout')

@section('title', 'Men Store')

@section('content')
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



 
<div class="container mx-auto px-4 py-10">
    <div class="flex justify-center items-center mb-6">
        <!-- Search Bar -->
        <div class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            <input type="text" id="search-input" class="w-full p-3 rounded-full border-2 border-gray-300 focus:ring-2 focus:ring-blue-500 text-lg" placeholder="Search for items...">
        </div>
    </div>
    

    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Filter Panel -->
        <div id="filter-panel" class="w-full sm:w-64 p-6 bg-gray-50 rounded-lg shadow-md mb-6 lg:mb-0">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Filters</h3>

            <!-- Price Filter -->
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

            <!-- Category Filter -->
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

        <!-- Items Section -->
        <div class="w-full flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="dynamic-products">
            @foreach ($items as $item)
                <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full">
                    <!-- Product Image Carousel -->
                    <div class="carousel relative group">
                        @foreach ($item->Photo as $index => $photo)
                            <img src="{{ $photo }}" alt="{{ $item->Name }}" class="carousel-img object-cover w-full h-64 {{ $index === 0 ? 'active' : 'hidden' }}" data-index="{{ $index }}">
                        @endforeach
        
                        <!-- Navigation Arrows -->
                        <button class="carousel-btn left">
                            <i class="fas fa-chevron-left text-black"></i>
                        </button>
                        <button class="carousel-btn">
                            <i class="fas fa-chevron-right text-black"></i>
                        </button>
                    </div>
                    <a href="{{ route('items.show', $item->ItemID) }}" class="block">
                    <!-- Product Details -->
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $item->Name }}</h3>
                        <p class="text-xl font-medium text-gray-600">${{ number_format($item->Price, 2) }}</p>
        
                        <!-- Points Display with Trophy Badge -->
                        <div class="flex items-center mt-2 justify-between text-yellow-500">
                            <!-- Trophy and points -->
                            <div class="flex items-center">
                                <i class="fas fa-trophy text-xl"></i>
                                <span class="ml-1 text-sm font-semibold">{{ $item->Points }}</span>
                            </div>
                        </div>
                    </a>
                        <!-- Add to Cart button -->
                        <div class="mt-auto">
                            <button class="py-2 px-4 w-full bg-blue-700 text-white rounded-lg hover:bg-blue-600 transition-all">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        

        <!-- No Items Message -->
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
@vite('resources/js/men.js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script>
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
            updateProducts();
        };

        const fillColor = () => {
            const percent1 = (sliderOne.value / sliderMaxValue) * 100;
            const percent2 = (sliderTwo.value / sliderMaxValue) * 100;
            sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
        };

        const updateProducts = () => {
            const minPrice = sliderOne.value;
            const maxPrice = sliderTwo.value;
            const categoryId = categoryDropdown.value;
            const searchQuery = searchInput.value;

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
                                <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full">
                                    <!-- Product Image Carousel -->
                                    <div class="carousel relative group">
                                        ${product.Photo.map((photo, index) => `
                                            <img src="${photo}" alt="${product.Name}" class="carousel-img w-full h-64 object-cover ${index === 0 ? 'active' : 'hidden'}" data-index="${index}">
                                        `).join('')}
                                        <!-- Updated Carousel Navigation Buttons -->
                                        <button class="carousel-btn left">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="carousel-btn right">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                    <a href="{{ route('items.show', $item->ItemID) }}" class="block">
                                        <!-- Product Details -->
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h3 class="font-semibold text-lg text-gray-800">${product.Name}</h3>
                                            <p class="text-xl font-medium text-gray-600">${product.Price}$</p>
                                            <div class="flex items-center mt-2 justify-between text-yellow-500">
                                                <!-- Trophy and points -->
                                                <div class="flex items-center">
                                                    <i class="fas fa-trophy text-xl"></i>
                                                    <span class="ml-1 text-sm font-semibold">${product.Points}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Add to Cart button -->
                                    <div class="mt-auto">
                                        <button class="py-2 px-4 w-full bg-blue-700 text-white rounded-lg hover:bg-blue-600 transition-all">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            `;
                            productsContainer.insertAdjacentHTML("beforeend", productCard);
                        });
                        initializeCarousel(); // Re-initialize the carousels after adding new products
                    }
                },
                error: function (error) {
                    console.error("Error fetching filtered products:", error);
                }
            });
        };

        // Updated Carousel logic initialization
        const initializeCarousel = () => {
            const carousels = document.querySelectorAll(".carousel");
            carousels.forEach((carousel) => {
                let currentIndex = 0;
                const images = carousel.querySelectorAll(".carousel-img");
                const leftButton = carousel.querySelector(".carousel-btn.left");
                const rightButton = carousel.querySelector(".carousel-btn.right");

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

