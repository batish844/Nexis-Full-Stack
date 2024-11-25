@extends('layout')

@section('title', $item->Name)

@section('content')

<div class="container mx-auto my-6">
    <div class="flex flex-wrap lg:items-stretch justify-center lg:space-x-16 rounded">
        <!-- Product Images Section -->
        <div class="w-full lg:w-1/2 p-4">
            <div class="relative flex flex-col items-center sm:items-start sm:flex-row space-y-4 sm:space-x-4">
                <!-- Thumbnail Images -->
                <div class="hidden sm:flex flex-row sm:flex-col mt-4 items-center space-x-3 sm:space-x-0 sm:space-y-3">
                    @foreach ($item->Photo as $photo)
                    <img src="{{ asset($photo) }}" alt="{{ $item->Name }}"
                        class="w-24 h-24 object-cover border cursor-pointer thumbnail rounded shadow-lg">
                    @endforeach
                </div>
                <!-- Main Image -->
                <img id="mainImage" src="{{ asset($item->Photo[0]) }}" alt="{{ $item->Name }}"
                    class="w-full sm:w-9/12 h-auto object-cover cursor-zoom-in rounded shadow-lg"
                    data-large="{{ asset($item->Photo[0]) }}">
                <!-- Thumbnail Images (Mobile) -->
                <div class="sm:hidden flex flex-row items-center space-x-3 mt-4">
                    @foreach ($item->Photo as $photo)
                    <img src="{{ asset($photo) }}" alt="{{ $item->Name }}"
                        class="w-16 h-16 object-cover border cursor-pointer thumbnail rounded shadow-lg">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="w-full lg:w-2/5 h-fit flex flex-col items-start mt-8 p-6 border border-blue-700 shadow-lg rounded-lg bg-white">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-800 mb-4">{{ $item->Name }}</h1>

            <p class="text-xl sm:text-2xl font-bold text-blue-600 mt-4">Price: ${{ number_format($item->Price, 2) }}</p>
            <div class="w-full flex items-center space-x-2 mt-2">
                <i class="fas fa-trophy text-yellow-400 text-xl"></i>
                <p class="text-xl sm:text-2xl font-bold text-yellow-400">{{ $item->Points }}</p>
            </div>
            <!-- Product Description Section -->
            <div class="mt-8">
                <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Description</h3>
                <p class="text-gray-600 mt-2 leading-relaxed">{{ $item->Description }}</p>
            </div>
            <input type="hidden" id="ItemID" value="{{ $item->ItemID }}">

            <!-- Size Options -->
            <div class="mt-6">
                <label class="block text-sm sm:text-xl font-semibold text-gray-700 mb-2">Sizes</label>
                <div class="flex flex-wrap space-x-2 sm:space-x-4">
                    @foreach ($item->Size as $size)
                    <label class="relative cursor-pointer size-label">
                        <input type="radio" name="size" value="{{ $size }}" class="hidden size-checkbox">
                        <div
                            class="size-button w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-lg border transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 bg-gray-200 text-gray-800">
                            {{ $size }}
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('sizes')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Stock Availability -->
            <div class="mt-8">
                <p id="stock-counter" class="text-lg sm:text-xl font-semibold text-gray-700">
                    <span id="remaining-stock" class="text-blue-600 font-bold">{{ $item->Quantity }}</span> items available in stock
                </p>
                <p id="error-message" class="text-red-500 text-sm hidden"></p>
            </div>
            <!-- Add to Cart with Counter -->
            <div class="mt-4">
                <!-- Notification Area -->
                <div id="response-message" class="hidden rounded-lg text-center text-sm mx-auto font-semibold mb-4"></div>

            </div>
            <div class="mt-4 flex items-center space-x-4">
                <!-- Counter -->
                <div class="flex items-center border border-gray-300 rounded-lg">
                    <button id="decrement"
                        class="px-2 sm:px-4 py-2 text-lg font-bold text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-l-lg focus:outline-none">-</button>
                    <input id="quantity" type="number" value="1" min="1"
                        class="w-12 sm:w-16 text-center border-none focus:ring-0 focus:outline-none">
                    <button id="increment"
                        class="px-2 sm:px-4 py-2 text-lg font-bold text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-r-lg focus:outline-none">+</button>
                </div>

                <!-- Add to Cart Button -->
                <button id="add-to-cart-button"
                    class="w-1/2 bg-blue-600 text-white py-2 sm:py-4 px-4 sm:px-6 rounded-lg hover:bg-blue-700 transition-all shadow-lg transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Add to Cart
                </button>
            </div>

            <style>
                /* Remove default arrows from number input */
                input[type="number"]::-webkit-inner-spin-button,
                input[type="number"]::-webkit-outer-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                input[type="number"] {
                    -moz-appearance: textfield;
                    /* For Firefox */
                    appearance: textfield;
                }
            </style>
        </div>
    </div>
    <!-- Reviews Section -->
    <div class="mt-12 p-3 sm:p-6 px-4 md:px-12 mx-4 sm:mx-5 md:mx-10 border-t border-gray-300 bg-gray-100 rounded-lg">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">Customer Reviews</h2>

        <!-- Star Distribution -->
        <div class="flex flex-col items-center mb-8">
            @foreach ([5, 4, 3, 2, 1] as $stars)
            <div class="flex items-center space-x-3 w-full sm:w-1/2">
                <!-- Star Icon with Number -->
                <div class="flex items-center space-x-1">
                    <span class="text-sm font-medium text-gray-700">{{ $stars }}</span>
                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                </div>

                <!-- Progress Bar -->
                <div class="flex-1 h-3 bg-gray-200 rounded-full overflow-hidden">
                    <div class="bg-blue-600 h-full rounded-full"
                        style="width: {{ $totalReviews > 0 ? ($starDistribution[$stars] / $totalReviews) * 100 : 0 }}%;">
                    </div>
                </div>
                <!-- Count -->
                <span class="w-8 text-sm font-medium text-gray-700">{{ $starDistribution[$stars] }}</span>
            </div>
            @endforeach
        </div>

        <!-- Review Submission Form -->
        <div class="mt-10 bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">Add Your Review</h3>
            <!-- Flash Message -->
            @if (session('success'))
            <div id="flashMessage"
                class="flash-message w-fit mb-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div id="flashMessage"
                class="flash-message w-fit mb-4 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
                {{ session('error') }}
            </div>
            @endif
            @if ($errors->any())
            <div id="validationErrors"
                class="flash-message w-fit mb-4 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form id="reviewForm"
                action="{{ $existingReview ? route('reviews.update', [$item->ItemID, auth()->id()]) : route('reviews.store', $item->ItemID) }}"
                method="POST" class="space-y-6">
                @csrf
                @if ($existingReview)
                @method('PATCH')
                @endif

                <!-- Star Rating -->
                <div>
                    <label class="block text-sm sm:text-lg font-semibold text-gray-700 mb-2">Rating</label>
                    <div class="flex items-center space-x-1" id="starRating">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" data-value="{{ $i }}"
                            class="star w-8 h-8 {{ $i <= ($existingReview->Stars ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            </button>
                            @endfor
                    </div>
                    <input type="hidden" name="Stars" id="selectedStar"
                        value="{{ $existingReview->Stars ?? 0 }}">
                </div>

                <!-- Comment -->
                <label class="block text-sm sm:text-lg font-semibold text-gray-700">Comment</label>
                <div class="flex flex-col items-end w-full space-y-5">
                    <textarea id="commentInput" name="Comment" rows="4" class="w-full border-gray-300 rounded-lg">{{ $existingReview->Comment ?? '' }}</textarea>
                    <span id="commentError" class="text-red-500 text-sm hidden self-start">Please enter a message
                        for
                        your review.</span>
                    <button type="submit"
                        class="w-1/2 sm:w-1/4 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-all">
                        {{ $existingReview ? 'Edit Review' : 'Submit Review' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Individual Reviews -->
        <div class="mt-10 space-y-8">
            @forelse ($reviews as $review)
            <div
                class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-4 p-4 border border-gray-300 rounded-lg bg-gray-50">
                <!-- User Avatar -->
                <img src="{{ $review->user->avatar ? asset('storage/img/avatar/' . $review->user->avatar) : asset('storage/img/icons/Default-Avatar.png') }}"
                    alt="{{ $review->user->name }}" class="w-12 h-12 rounded-full object-cover">

                <!-- Review Details -->
                <div class="flex-1">
                    <!-- User Name -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-md font-bold text-gray-800">{{ $review->user->First_Name }}</h3>
                        <!-- Star Rating -->
                        <div class="flex items-center text-yellow-500">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->Stars ? 'text-yellow-300' : 'text-gray-300' }}"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                @endfor
                        </div>
                    </div>
                    <!-- Comment -->
                    <p class="mt-2 text-gray-600">{{ $review->Comment }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-600">No reviews yet. Be the first to review this product!</p>
            @endforelse
        </div>
    </div>

    <!-- Zoom Modal -->
    <div id="zoomModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="relative w-full max-w-4xl h-5/6 flex flex-col items-center">
            <!-- Magnified Image -->
            <div id="magnifiedImage" class="w-full h-full bg-center bg-no-repeat bg-cover cursor-crosshair">
            </div>

            <!-- Navigation Arrows -->
            <div class="absolute top-1/2 transform -translate-y-1/2 flex justify-between w-full px-4">
                <button id="prevImage" class="text-white text-5xl">&#10094;</button>
                <button id="nextImage" class="text-white text-5xl">&#10095;</button>
            </div>
        </div>
        <!-- Close Button -->
        <button id="closeZoomModal" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
    </div>
</div>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script>
    document.addEventListener('DOMContentLoaded', async function() {
        // Initialize variables
        const flashMessages = document.querySelectorAll('.flash-message');
        const sizeLabels = document.querySelectorAll('.size-label');
        const stars = document.querySelectorAll('#starRating .star');
        const selectedStarInput = document.getElementById('selectedStar');
        const form = document.getElementById('reviewForm');
        const commentInput = document.getElementById('commentInput');
        const commentError = document.getElementById('commentError');
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');
        const zoomModal = document.getElementById('zoomModal');
        const magnifiedImage = document.getElementById('magnifiedImage');
        const closeZoomModal = document.getElementById('closeZoomModal');
        const prevImageBtn = document.getElementById('prevImage');
        const nextImageBtn = document.getElementById('nextImage');
        const itemID = document.getElementById('ItemID').value;
        const quantityInput = document.getElementById('quantity');
        const responseMessageEl = document.getElementById('response-message');
        const incrementBtn = document.getElementById('increment');
        const decrementBtn = document.getElementById('decrement');
        const addToCartBtn = document.getElementById('add-to-cart-button');
        let remainingStock = 0;
        let imageSources = Array.from(thumbnails).map(thumbnail => thumbnail.src);
        let currentIndex = 0;
        let scale = 1;
        let isPanning = false;
        let startX = 0,
            startY = 0;
        let currentX = 0,
            currentY = 0;

        // Flash message fade out
        if (flashMessages.length > 0) {
            flashMessages.forEach(flashMessage => {
                setTimeout(() => {
                    flashMessage.style.transition = 'opacity 0.5s ease';
                    flashMessage.style.opacity = '0';
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 500);
                }, 3000);
            });
        }

        // Handle size label clicks
        sizeLabels.forEach(label => {
            label.addEventListener('click', () => {
                const checkbox = label.querySelector('.size-checkbox');
                const sizeButton = label.querySelector('.size-button');

                // Uncheck all other checkboxes
                document.querySelectorAll('.size-checkbox').forEach(cb => cb.checked = false);

                document.querySelectorAll('.size-button').forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.add('bg-gray-200', 'text-gray-800', 'border-gray-300');
                });

                // Toggle the clicked checkbox and update its styles
                checkbox.checked = true;
                sizeButton.classList.remove('bg-gray-200', 'text-gray-800', 'border-gray-300');
                sizeButton.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
            });
        });

        // Star rating
        function refreshStars() {
            const currentRating = parseInt(selectedStarInput.value, 10) || 0;

            stars.forEach((star, index) => {
                if (index < currentRating) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.add('text-gray-300');
                    star.classList.remove('text-yellow-400');
                }
            });
        }

        // Initial refresh
        refreshStars();

        // Handle star clicks
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const rating = parseInt(star.getAttribute('data-value'));
                selectedStarInput.value = rating;
                refreshStars();
            });
        });

        // Form validation
        form.addEventListener('submit', event => {
            // Reset error message
            commentError.classList.add('hidden');

            // Check if the comment input is empty
            if (!commentInput.value.trim()) {
                event.preventDefault(); // Prevent form submission
                commentError.textContent = "Please enter a message for your review.";
                commentError.classList.remove('hidden');
                commentInput.focus();
            }
        });

        // Thumbnail clicks
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                mainImage.src = thumbnail.src;
                mainImage.dataset.large = thumbnail.src;
                currentIndex = index;
            });
        });

        // Zoom modal
        mainImage.addEventListener('click', () => {
            magnifiedImage.style.backgroundImage = `url(${mainImage.dataset.large})`;
            magnifiedImage.style.backgroundSize = `${scale * 100}%`;
            zoomModal.classList.remove('hidden');
        });

        closeZoomModal.addEventListener('click', () => {
            zoomModal.classList.add('hidden');
            resetZoom();
        });

        // Update Magnified Image
        function updateMagnifiedImage() {
            const newImageSrc = imageSources[currentIndex];
            magnifiedImage.style.backgroundImage = `url(${newImageSrc})`;
        }

        // Navigation Arrows
        prevImageBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + imageSources.length) % imageSources.length;
            updateMagnifiedImage();
        });

        nextImageBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % imageSources.length;
            updateMagnifiedImage();
        });

        // Handle Mouse Movement for Zoom (Desktop)
        magnifiedImage.addEventListener('mousemove', e => {
            const rect = magnifiedImage.getBoundingClientRect();
            const xPercent = ((e.clientX - rect.left) / rect.width) * 100;
            const yPercent = ((e.clientY - rect.top) / rect.height) * 100;
            magnifiedImage.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
        });

        // Handle Touch Events (Mobile)
        magnifiedImage.addEventListener('touchstart', e => {
            if (e.touches.length === 1) {
                isPanning = true;
                startX = e.touches[0].clientX - currentX;
                startY = e.touches[0].clientY - currentY;
            }
        });

        magnifiedImage.addEventListener('touchmove', e => {
            if (isPanning && e.touches.length === 1) {
                currentX = e.touches[0].clientX - startX;
                currentY = e.touches[0].clientY - startY;
                magnifiedImage.style.backgroundPosition = `${currentX}px ${currentY}px`;
            }

            // Pinch-to-Zoom
            if (e.touches.length === 2) {
                e.preventDefault();
                const [touch1, touch2] = e.touches;
                const dist = Math.hypot(
                    touch2.clientX - touch1.clientX,
                    touch2.clientY - touch1.clientY
                );

                if (!magnifiedImage.dataset.startDist) {
                    magnifiedImage.dataset.startDist = dist;
                    magnifiedImage.dataset.startScale = scale;
                } else {
                    const scaleDiff = dist / magnifiedImage.dataset.startDist;
                    scale = Math.min(3, Math.max(1, magnifiedImage.dataset.startScale * scaleDiff));
                    magnifiedImage.style.backgroundSize = `${scale * 100}%`;
                }
            }
        });

        magnifiedImage.addEventListener('touchend', e => {
            if (e.touches.length === 0) {
                isPanning = false;
                delete magnifiedImage.dataset.startDist;
            }
        });

        function resetZoom() {
            scale = 1;
            currentX = 0;
            currentY = 0;
            magnifiedImage.style.backgroundPosition = 'center';
            magnifiedImage.style.backgroundSize = '100%';
        }

        // Fetch remaining stock from the server
        const fetchRemainingStock = async () => {
            try {
                const response = await fetch(`/cart/remaining-stock/${itemID}`);
                const data = await response.json();

                if (data.success) {
                    remainingStock = data.remainingStock;
                    document.getElementById('remaining-stock').textContent = remainingStock;
                } else {
                    console.error('Failed to fetch remaining stock');
                }
            } catch (error) {
                console.error('Error fetching remaining stock:', error);
            }
        };

        // Update stock UI
        const updateStockUI = () => {
            document.getElementById('remaining-stock').textContent = remainingStock;

            if (remainingStock <= 0) {
                responseMessageEl.textContent = "No more stock available for this item.";
                responseMessageEl.classList.remove('hidden', 'text-green-500');
                responseMessageEl.classList.add('text-red-500');
                setTimeout(() => {
                    responseMessageEl.style.transition = 'opacity 0.5s ease';
                    responseMessageEl.style.opacity = '0';
                    setTimeout(() => {
                        responseMessageEl.classList.add('hidden');
                        responseMessageEl.style.opacity = '1'; // Reset opacity for future use
                    }, 500);
                }, 3000);
                return;
            } else {
                responseMessageEl.classList.add('hidden');
            }
        };

        // Update cart count
        const updateCartCount = () => {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartCountEl = document.getElementById('cart-count');
                    cartCountEl.textContent = data.cartCount;
                })
                .catch(error => console.error('Error fetching cart count:', error));
        };

        // Increment and Decrement Buttons
        incrementBtn.addEventListener('click', () => {
            const currentVal = parseInt(quantityInput.value);
            if (currentVal < remainingStock) {
                quantityInput.value = currentVal + 1;
            } else {
                responseMessageEl.textContent = "You cannot add more than the remaining stock.";
                responseMessageEl.classList.remove('hidden', 'text-green-500');
                responseMessageEl.classList.add('text-red-500');
                setTimeout(() => {
                    responseMessageEl.style.transition = 'opacity 0.5s ease';
                    responseMessageEl.style.opacity = '0';
                    setTimeout(() => {
                        responseMessageEl.classList.add('hidden');
                        responseMessageEl.style.opacity = '1';
                    }, 500);
                }, 3000);
                return;
            }
        });

        decrementBtn.addEventListener('click', () => {
            const currentVal = parseInt(quantityInput.value);
            if (currentVal > 1) {
                quantityInput.value = currentVal - 1;
            }
        });

        // Add to Cart Button
        addToCartBtn.addEventListener('click', async () => {
            const selectedSize = document.querySelector('input[name="size"]:checked');
            const quantityToAdd = parseInt(quantityInput.value);

            if (!selectedSize) {
                responseMessageEl.textContent = 'Please select a size before adding to cart.';
                responseMessageEl.classList.remove('hidden', 'text-green-500');
                responseMessageEl.classList.add('text-red-500');
                setTimeout(() => {
                    responseMessageEl.style.transition = 'opacity 0.5s ease';
                    responseMessageEl.style.opacity = '0';
                    setTimeout(() => {
                        responseMessageEl.classList.add('hidden');
                        responseMessageEl.style.opacity = '1'; // Reset opacity for future use
                    }, 500);
                }, 3000);
                return;
            }

            if (quantityToAdd > remainingStock) {
                responseMessageEl.textContent = `Only ${remainingStock} items remaining in stock.`;
                responseMessageEl.classList.remove('hidden', 'text-green-500');
                responseMessageEl.classList.add('text-red-500');
                setTimeout(() => {
                    responseMessageEl.style.transition = 'opacity 0.5s ease';
                    responseMessageEl.style.opacity = '0';
                    setTimeout(() => {
                        responseMessageEl.classList.add('hidden');
                        responseMessageEl.style.opacity = '1'; // Reset opacity for future use
                    }, 500);
                }, 3000);
                return;
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/cart/add`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin', // Include this line to send cookies
                    body: JSON.stringify({
                        ItemID: itemID,
                        Size: selectedSize.value,
                        Quantity: quantityToAdd,
                    }),
                });

                const data = await response.json();

                if (response.ok) {
                    // Handle success (e.g., update UI, display messages)
                    if (window.updateCartCounters) {
                        window.updateCartCounters();
                    }
                    remainingStock = data.remainingStock; // Update remaining stock
                    updateStockUI();

                    responseMessageEl.textContent = data.message;
                    responseMessageEl.classList.remove('hidden', 'text-red-500');
                    responseMessageEl.classList.add('text-green-500');
                    setTimeout(() => {
                        responseMessageEl.style.transition = 'opacity 0.5s ease';
                        responseMessageEl.style.opacity = '0';
                        setTimeout(() => {
                            responseMessageEl.classList.add('hidden');
                            responseMessageEl.style.opacity = '1'; // Reset opacity for future use
                        }, 500);
                    }, 3000);
                } else {
                    // Handle server-side errors
                    console.error('Server error:', data.message);
                    responseMessageEl.textContent = data.message;
                    responseMessageEl.classList.remove('hidden', 'text-green-500');
                    responseMessageEl.classList.add('text-red-500');
                    setTimeout(() => {
                        responseMessageEl.style.transition = 'opacity 0.5s ease';
                        responseMessageEl.style.opacity = '0';
                        setTimeout(() => {
                            responseMessageEl.classList.add('hidden');
                            responseMessageEl.style.opacity = '1'; // Reset opacity for future use
                        }, 500);
                    }, 3000);
                }
            } catch (error) {
                console.error('Fetch error:', error);
                responseMessageEl.textContent = "An error occurred. Please try again.";
                responseMessageEl.classList.remove('hidden', 'text-green-500');
                responseMessageEl.classList.add('text-red-500');
            }
        });

        // Fetch initial remaining stock and cart count
        await fetchRemainingStock();
        updateCartCount();
    });
</script>

@endsection