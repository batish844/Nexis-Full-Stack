@foreach ($items as $item)
    @php
        $isInWishlist = in_array($item->ItemID, $wishlistItems); // Check if item is in wishlist
    @endphp
    <div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full relative group">
        <!-- Wishlist Icon -->
        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
            <button 
                class="wishlist-btn focus:outline-none" 
                data-id="{{ $item->ItemID }}" 
                aria-label="Toggle Wishlist">
                <i class="fas fa-heart text-2xl {{ $isInWishlist ? 'text-red-500' : 'text-gray-400' }}"></i>
            </button>
        </div>

        <!-- Product Image Carousel -->
        <div class="carousel relative">
            <a href="{{ route('store.show', ['id' => $item->ItemID]) }}">
                @foreach ($item->Photo as $index => $photo)
                    <img src="{{ $photo }}" alt="{{ $item->Name }}" class="carousel-img object-cover w-full h-64 {{ $index === 0 ? 'active' : 'hidden' }}" data-index="{{ $index }}">
                @endforeach
            </a>
            @if(count($item->Photo) > 1)
                <button class="carousel-btn left">
                    <i class="fas fa-chevron-left text-black"></i>
                </button>
                <button class="carousel-btn right">
                    <i class="fas fa-chevron-right text-black"></i>
                </button>
            @endif
        </div>
        <a href="{{ route('store.show', ['id' => $item->ItemID]) }}">
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="font-semibold text-lg text-gray-800">{{ $item->Name }}</h3>
                <p class="text-xl font-medium text-gray-600">${{ number_format($item->Price, 2) }}</p>
            </div>
        </a>
    </div>
@endforeach

@if ($items->isEmpty())
    <div class="flex items-center justify-center w-full h-full bg-gray-100">
        <div class="text-center">
            <p class="text-lg text-gray-600 font-medium">
                Unfortunately, no items match your search criteria.
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Please try adjusting your filters or price range to explore more options.
            </p>
        </div>
    </div>
@endif
