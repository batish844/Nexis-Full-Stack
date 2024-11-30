@extends('layout')

@section('title', 'Men Store')

@section('content')
    <!-- <div class="image-slider">
            <div class="slide active">
                <img src="{{ asset('storage/img/slides/m1.jpg') }}" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="{{ asset('storage/img/slides/m2.webp') }}" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="{{ asset('storage/img/slides/m3.jpg') }}" alt="Slide 3">
            </div>
        </div> -->




    <div class="container mx-auto px-4 py-10">
        <div class="flex justify-center items-center mb-6">
            <!-- Search Bar -->
            <div class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
                <input type="text" id="search-input"
                    class="w-full p-3 rounded-full border-2 border-gray-300 focus:ring-2 focus:ring-blue-500 text-lg"
                    placeholder="Search for items...">
            </div>
        </div>


        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Filter Panel -->
            <div id="filter-panel" class="w-full sm:w-64 p-6 bg-gray-50 rounded-lg shadow-md mb-6 lg:mb-0">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Filters</h3>

                <!-- Price Filter -->
                <div class="price-filter mt-6">
                    <h4 class="font-medium text-gray-700">Price ($)</h4>
                    <div class="flex justify-between mb-2">
                        <span id="min-price-display">0</span>
                        <span>&dash;</span>
                        <span id="max-price-display">50</span>
                    </div>
                    <div class="relative w-full py-4">

                    <div class="slider-track bg-gray-300 h-2 rounded-full relative">
        
        
                 </div>

                        <!-- Range Inputs -->
                    <input type="range" min="0" max="50" value="0" id="slider-1"
                        class="absolute left-0 w-full h-2 appearance-none bg-transparent pointer-events-auto z-10 thumb-slider">
                    <input type="range" min="0" max="50" value="50" id="slider-2"
                        class="absolute left-0 w-full h-2 appearance-none bg-transparent pointer-events-auto z-10 thumb-slider">

                    <!-- Thumb Styling -->
                    
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="category-filter mt-6">
                    <h4 class="font-medium text-gray-700">Category</h4>
                    <select id="category-dropdown"
                    class="w-full sm:w-full text-lg lg:text-md mt-2 p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Items</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Sort Dropdown -->
                <div class="sort-dropdown mt-6 lg:mt-5">
                    <h4 class="font-medium text-gray-700 mb-2">Sort By</h4>
                    <select id="sort-dropdown"
                        class="w-full sm:w-full text-lg lg:text-md mt-2 p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Default</option>
                        <option value="name:asc">Name (A - Z)</option>
                        <option value="name:desc">Name (Z - A)</option>
                        <option value="price:asc">Price (Low to High)</option>
                        <option value="price:desc">Price (High to Low)</option>
                        <option value="popularity:asc">Rating (Low to High)</option>
                        <option value="popularity:desc">Rating (High to Low)</option>
                    </select>
                </div>
            </div>

            <!-- Items Section -->
            <div class="w-full flex-1">
                <div id="dynamic-products" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <!-- Products will be dynamically injected here -->
                </div>
                <div id="no-results" class="hidden flex flex-col items-center justify-center w-full h-full">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="bg-gradient-to-br from-blue-100 to-blue-50 p-6 rounded-full shadow-md">
                            <img src="{{ asset('/storage/img/CommonImg/No Items Found.png') }}" alt="No Items Found" class="w-48 h-48 object-contain">
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-800">
                                No Items Found
                            </p>
                            <p class="text-md text-gray-600 mt-2 leading-relaxed">
                                It seems we couldn’t find what you’re looking for. <br> Adjust your filters or try searching with different keywords.
                            </p>
                        </div>
                    </div>
                </div>
                                
            </div>
        </div>
    </div>
@endsection

@push('styles')
@vite('resources/css/store.css')
@endpush

@push('scripts')

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
                sliderTrack.style.background =
                    `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
            };

            const updateProducts = () => {
            let minPrice = sliderOne.value;
            let maxPrice = sliderTwo.value;
            let categoryId = categoryDropdown.value;
            let searchQuery = searchInput.value;
            let sort = document.getElementById("sort-dropdown").value;

            const url = new URL('{{ route('men.filter.products') }}', window.location.origin);
            url.searchParams.append('minPrice', minPrice);
            url.searchParams.append('maxPrice', maxPrice);
            url.searchParams.append('category', categoryId);
            url.searchParams.append('search', searchQuery);
            if (sort) {
                url.searchParams.append('sort', sort);
            }

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    productsContainer.innerHTML = html;

                    const parentContainer = productsContainer.parentElement;
                    const oldPagination = parentContainer.querySelector(".external-pagination");
                    if (oldPagination) oldPagination.remove();

                    const newPagination = productsContainer.querySelector(".pagination");
                    if (newPagination) {
                        const clonedPagination = newPagination.cloneNode(true);
                        clonedPagination.classList.add("external-pagination", "mt-6", "flex", "justify-center");
                        parentContainer.appendChild(clonedPagination);
                        newPagination.remove();
                    }
                    // Check if any products exist
                    const hasProducts = productsContainer.querySelector('.product-card'); // Corrected class name
                    const noResults = document.getElementById('no-results');

                    if (!hasProducts) {
                        productsContainer.classList.add('hidden');
                        noResults.classList.remove('hidden');
                    } else {
                        productsContainer.classList.remove('hidden');
                        noResults.classList.add('hidden');
                    }
                    
                    initializePagination();
                    initializeCarousel(); // Initialize carousel if applicable
                
                })
                .catch(error => {
                    console.error("Error fetching filtered products:", error);
                    productsContainer.innerHTML = '<p class="text-red-500">Failed to load products. Please try again.</p>';
                });
        };
        const initializePagination = () => {
    document.addEventListener("click", (e) => {
        const paginationLink = e.target.closest(".external-pagination a");
        if (paginationLink) {
            e.preventDefault();
            const url = new URL(paginationLink.href);

            // Append current filters to the pagination URL
            const params = new URLSearchParams(url.search);
            params.set('minPrice', sliderOne.value);
            params.set('maxPrice', sliderTwo.value);
            params.set('category', categoryDropdown.value);
            params.set('search', searchInput.value);
            const sortValue = document.getElementById("sort-dropdown").value;
            if (sortValue) params.set('sort', sortValue);

            fetch(`${url.origin}${url.pathname}?${params.toString()}`)
                .then(response => response.text())
                .then(html => {
                    productsContainer.innerHTML = html;

                    // Update pagination links
                    const parentContainer = productsContainer.parentElement;
                    const oldPagination = parentContainer.querySelector(".external-pagination");
                    if (oldPagination) oldPagination.remove();

                    const newPagination = productsContainer.querySelector(".pagination");
                    if (newPagination) {
                        const clonedPagination = newPagination.cloneNode(true);
                        clonedPagination.classList.add("external-pagination", "mt-6", "flex", "justify-center");
                        parentContainer.appendChild(clonedPagination);
                        newPagination.remove();
                    }

                    initializePagination();
                })
                .catch(error => console.error("Error loading pagination:", error));
        }
    });
};
            



            let debounceTimer;
            searchInput.addEventListener("input", () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(updateProducts, 300);
            });

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

                    updateImage();
                });
            };

            fillColor();
            sliderOne.addEventListener("input", updateSliderValues);
            sliderTwo.addEventListener("input", updateSliderValues);
            categoryDropdown.addEventListener("change", updateProducts);
            document.getElementById("sort-dropdown").addEventListener("change", updateProducts);

            updateProducts();
            initializePagination();
            initializeCarousel();

            // Event delegation for dynamically added products
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            document.addEventListener("click", (e) => {
                if (e.target.closest(".pagination a")) {
                    e.preventDefault();
                    const url = e.target.closest(".pagination a").href;

                    fetch(url)
                        .then((response) => response.text())
                        .then((html) => {
                            document.getElementById("dynamic-products").innerHTML = html;
                        })
                        .catch((error) => console.error("Error loading pagination:", error));
                }
            });


            // Event delegation for wishlist button toggling
            document.getElementById('dynamic-products').addEventListener('click', function(event) {
                const button = event.target.closest('.wishlist-btn');

                if (button) {
                    const itemId = button.dataset.id;

                    fetch('/wishlist/toggle', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                ItemID: itemId
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Toggle heart icon color
                                const heartIcon = button.querySelector('i');
                                if (data.message.includes('removed')) {
                                    heartIcon.classList.remove('text-red-500');
                                    heartIcon.classList.add('text-gray-400');
                                } else if (data.message.includes('added')) {
                                    heartIcon.classList.remove('text-gray-400');
                                    heartIcon.classList.add('text-red-500');
                                }

                                // Update wishlist counter
                                if (window.updateWishlistCounters) {
                                    window.updateWishlistCounters();
                                }
                            } else {
                                console.error(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });

        });
    </script>
@endpush
