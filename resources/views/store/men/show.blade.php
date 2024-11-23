@extends('layout')

@section('title', $item->Name)

@section('content')
    <div class="container mx-auto my-6 ">
        <div class="flex flex-wrap lg:items-stretch justify-center space-x-16 rounded">
            <!-- Product Images Section -->
            <div class="w-full lg:w-1/2 lg:h-3/5 p-4">
                <div class="relative flex flex-col items-center sm:items-start sm:flex-row space-y-4 sm:space-x-4">
                    <!-- Thumbnail Images -->
                    <div
                        class="hidden sm:block flex flex-row sm:flex-col mt-4 items-center space-x-3 sm:space-x-0 sm:space-y-3">
                        @foreach ($item->Photo as $photo)
                            <img src="{{ asset($photo) }}" alt="{{ $item->Name }}"
                                class="w-24 h-24 object-cover border cursor-pointer thumbnail rounded shadow-lg">
                        @endforeach
                    </div>
                    <!-- Main Image -->
                    <img id="mainImage" src="{{ asset($item->Photo[0]) }}" alt="{{ $item->Name }}"
                        class="w-9/12 h-full object-cover cursor-zoom-in rounded shadow-lg"
                        data-large="{{ asset($item->Photo[0]) }}">
                    <!-- Thumbnail Images -->
                    <div class="sm:hidden flex flex-row sm:flex-col items-center space-x-3 sm:space-x-0 sm:space-y-3">
                        @foreach ($item->Photo as $photo)
                            <img src="{{ asset($photo) }}" alt="{{ $item->Name }}"
                                class="w-24 h-24 object-cover border cursor-pointer thumbnail rounded shadow-lg">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div
                class="w-full h-fit flex flex-col sm:items-start mt-8 lg:w-2/5 p-6 border border-blue-700 shadow-lg rounded-lg bg-white">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-4">{{ $item->Name }}</h1>

                <p class="text-2xl font-bold text-blue-600 mt-4">Price: ${{ number_format($item->Price, 2) }}</p>

                <!-- Product Description Section -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-700">Description</h3>
                    <p class="text-gray-600 mt-2 leading-relaxed">{{ $item->Description }}</p>
                </div>
                <!-- Size Options -->
                <div class="mt-6">
                    <label class="block text-sm sm:text-xl font-semibold text-gray-700 mb-2">Sizes</label>
                    <div class="flex space-x-4">
                        @php
                            $productSizes = $product->Size ?? [];
                        @endphp
                        @foreach ($item->Size as $size)
                            <label class="relative cursor-pointer size-label">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}"
                                    {{ in_array($size, $productSizes) ? 'checked' : '' }} class="hidden size-checkbox ">
                                <div
                                    class="size-button w-12 h-12 flex items-center justify-center rounded-lg border transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 
                    {{ in_array($size, $productSizes) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                                    {{ $size }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('sizes')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Add to Cart with Counter -->
                <div class="mt-8 flex items-center space-x-4">
                    <!-- Counter -->
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <button id="decrement"
                            class="px-4 py-2 text-lg font-bold text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-l-lg focus:outline-none">-</button>
                        <input id="quantity" type="number" value="1"
                            class="w-16 text-center border-none focus:ring-0 focus:outline-none">
                        <button id="increment"
                            class="px-4 py-2 text-lg font-bold text-gray-600 bg-gray-200 hover:bg-gray-300 rounded-r-lg focus:outline-none">+</button>
                    </div>

                    <!-- Add to Cart Button -->
                    <button
                        class="w-1/2 bg-blue-600 text-white py-4 px-6 rounded-lg hover:bg-blue-700 transition-all shadow-lg transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300">
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
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Customer Reviews</h2>

            <!-- Star Distribution -->
            <div class="flex flex-col items-center mb-8">
                @foreach ([5, 4, 3, 2, 1] as $stars)
                    <div class="flex items-center space-x-3 w-1/2">
                        <!-- Star Icon with Number -->
                        <div class="flex items-center space-x-1">
                            <span class="text-sm font-medium text-gray-700">{{ $stars }}</span>
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 22 20">
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
            <div class="mt-10 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Add Your Review</h3>
                <form
                    action="{{ $existingReview ? route('reviews.update', [$item->ItemID, auth()->id()]) : route('reviews.store', $item->ItemID) }}"
                    method="POST" class="space-y-6">
                    @csrf
                    @if ($existingReview)
                        @method('PATCH')
                    @endif

                    <!-- Star Rating -->
                    <div>
                        <label class="block text-lg font-semibold text-gray-700 mb-2">Rating</label>
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
                        <input type="hidden" name="Stars" id="selectedStar" value="{{ $existingReview->Stars ?? 0 }}">
                    </div>

                    <!-- Comment -->
                    <label class="block text-lg font-semibold text-gray-700">Comment</label>
                    <div class="flex flex-col items-end w-full space-y-5">
                        <textarea name="Comment" rows="4" class="w-full border-gray-300 rounded-lg">{{ $existingReview->Comment ?? '' }}</textarea>
                        <button type="submit"
                            class="w-1/4 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-all">
                            {{ $existingReview ? 'Edit Review' : 'Submit Review' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Individual Reviews -->
            <div class="mt-10 space-y-8">
                @forelse ($reviews as $review)
                    <div class="flex items-start space-x-4 p-4 border border-gray-300 rounded-lg bg-gray-50">
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
            <div class="relative w-10/12 h-5/6 flex flex-col items-center">
                <!-- Magnified Image -->
                <div id="magnifiedImage" class="w-full h-full bg-center bg-no-repeat bg-cover cursor-crosshair"></div>

                <!-- Navigation Arrows -->
                <div class="absolute top-1/2 transform -translate-y-1/2 flex justify-between w-full px-4">
                    <button id="prevImage" class="text-black text-5xl">&#10094;</button>
                    <button id="nextImage" class="text-black text-5xl">&#10095;</button>
                </div>
            </div>
            <!-- Close Button -->
            <button id="closeZoomModal" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add click event listener to size labels
            $('.size-label').click(function() {
                const $checkbox = $(this).find('.size-checkbox'); // Hidden checkbox
                const $sizeButton = $(this).find('.size-button'); // Visual button

                // Uncheck all other checkboxes
                $('.size-checkbox').prop('checked', false);
                $('.size-button').removeClass('bg-blue-600 text-white border-blue-600')
                    .addClass('bg-gray-200 text-gray-800 border-gray-300');

                // Toggle the clicked checkbox and update its styles
                $checkbox.prop('checked', true);
                $sizeButton.removeClass('bg-gray-200 text-gray-800 border-gray-300')
                    .addClass('bg-blue-600 text-white border-blue-600');
            });
            // Counter Increment button
            $('#increment').click(function() {
                const quantity = $('#quantity');
                const currentVal = parseInt(quantity.val());
                if (currentVal < 5) {
                    quantity.val(currentVal + 1);
                }
            });

            // Counter Decrement button
            $('#decrement').click(function() {
                const quantity = $('#quantity');
                const currentVal = parseInt(quantity.val());
                if (currentVal > 1) {
                    quantity.val(currentVal - 1);
                }
            });

            const $stars = $('#starRating .star');
            const $selectedStarInput = $('#selectedStar');
            const existingRating = parseInt($selectedStarInput.val(), 10);

            // Prefill stars if there's an existing rating
            if (existingRating) {
                $stars.each(function(index) {
                    if (index < existingRating) {
                        $(this).addClass('text-yellow-300').removeClass('text-gray-300');
                    }
                });
            }

            // Add click event listener to stars
            $stars.on('click', function() {
                const rating = $(this).index() + 1; // Get the index of the clicked star and add 1
                $selectedStarInput.val(rating); // Set hidden input value

                // Highlight the selected stars
                $stars.each(function(index) {
                    if (index < rating) {
                        $(this).addClass('text-yellow-300').removeClass('text-gray-300');
                    } else {
                        $(this).addClass('text-gray-300').removeClass('text-yellow-300');
                    }
                });
            });
            // Handle Thumbnail Clicks
            document.querySelectorAll('.thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    document.getElementById('mainImage').src = this.src;
                    document.getElementById('mainImage').dataset.large = this.src;
                });
            });

            // Handle Image Zoom
            document.getElementById('mainImage').addEventListener('click', function() {
                const zoomModal = document.getElementById('zoomModal');
                const zoomedImage = document.getElementById('zoomedImage');
                zoomedImage.src = this.dataset.large;
                zoomModal.classList.remove('hidden');
            });

            // Close Zoom Modal
            document.getElementById('closeZoom').addEventListener('click', function() {
                document.getElementById('zoomModal').classList.add('hidden');
            });
            let isPanning = false;
            let startX, startY, currentX = 0,
                currentY = 0,
                scale = 1;

            const magnifiedImage = document.getElementById('magnifiedImage');
            const zoomModal = document.getElementById('zoomModal');
            const closeZoomModal = document.getElementById('closeZoomModal');

            // Handle Thumbnail Clicks
            document.querySelectorAll('.thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    document.getElementById('mainImage').src = this.src;
                    document.getElementById('mainImage').dataset.large = this.src;
                });
            });

            // Open Zoom Modal
            document.getElementById('mainImage').addEventListener('click', function() {
                magnifiedImage.style.backgroundImage = `url(${this.dataset.large})`;
                magnifiedImage.style.backgroundSize = `${scale * 100}%`;
                zoomModal.classList.remove('hidden');
            });

            // Close Zoom Modal
            closeZoomModal.addEventListener('click', function() {
                zoomModal.classList.add('hidden');
                resetZoom();
            });

            // Handle Touch Start
            magnifiedImage.addEventListener('touchstart', function(e) {
                if (e.touches.length === 1) {
                    isPanning = true;
                    startX = e.touches[0].clientX - currentX;
                    startY = e.touches[0].clientY - currentY;
                }
            });

            // Handle Touch Move (Panning)
            magnifiedImage.addEventListener('touchmove', function(e) {
                if (isPanning && e.touches.length === 1) {
                    currentX = e.touches[0].clientX - startX;
                    currentY = e.touches[0].clientY - startY;
                    magnifiedImage.style.backgroundPosition = `${currentX}px ${currentY}px`;
                }

                // Handle Pinch-to-Zoom
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
                        scale = Math.min(3, Math.max(1, magnifiedImage.dataset.startScale *
                            scaleDiff));
                        magnifiedImage.style.backgroundSize = `${scale * 100}%`;
                    }
                }
            });

            // Handle Touch End
            magnifiedImage.addEventListener('touchend', function(e) {
                if (e.touches.length === 0) {
                    isPanning = false;
                    delete magnifiedImage.dataset.startDist;
                }
            });

            // Reset Zoom
            function resetZoom() {
                scale = 1;
                currentX = 0;
                currentY = 0;
                magnifiedImage.style.backgroundPosition = 'center';
                magnifiedImage.style.backgroundSize = '100%';
            }
        });
        const mainImage = document.getElementById("mainImage");
        const zoomModal = document.getElementById("zoomModal");
        const magnifiedImage = document.getElementById("magnifiedImage");
        const closeZoomModal = document.getElementById("closeZoomModal");
        const thumbnails = document.querySelectorAll(".thumbnail");
        const imageSources = Array.from(thumbnails).map(thumbnail => thumbnail.src);
        let currentIndex = 0;

        // Open Zoom Modal
        mainImage.addEventListener("click", function() {
            currentIndex = 0; // Reset to the first image
            const largeImageSrc = this.dataset.large;

            magnifiedImage.style.backgroundImage = `url(${largeImageSrc})`;
            zoomModal.classList.remove("hidden");
        });

        // Close Zoom Modal
        closeZoomModal.addEventListener("click", function() {
            zoomModal.classList.add("hidden");
        });

        // Handle Mouse Movement for Zoom
        magnifiedImage.addEventListener("mousemove", function(e) {
            const rect = magnifiedImage.getBoundingClientRect();

            const xPercent = ((e.clientX - rect.left) / rect.width) * 100;
            const yPercent = ((e.clientY - rect.top) / rect.height) * 100;

            magnifiedImage.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
        });

        // Handle Thumbnail Clicks
        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener("click", function() {
                mainImage.src = this.src;
                mainImage.dataset.large = this.src;
                currentIndex = index;
            });
        });

        // Navigation Arrows
        document.getElementById("prevImage").addEventListener("click", function() {
            currentIndex = (currentIndex - 1 + imageSources.length) % imageSources.length;
            updateMagnifiedImage();
        });

        document.getElementById("nextImage").addEventListener("click", function() {
            currentIndex = (currentIndex + 1) % imageSources.length;
            updateMagnifiedImage();
        });

        // Update Magnified Image
        function updateMagnifiedImage() {
            const newImageSrc = imageSources[currentIndex];
            magnifiedImage.style.backgroundImage = `url(${newImageSrc})`;
        }
    </script>

@endsection
