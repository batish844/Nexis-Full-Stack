@foreach ($items as $item)
@php
$isInWishlist = in_array($item->ItemID, $wishlistItems);
@endphp
<div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full relative group">
    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
        <button
            class="wishlist-btn focus:outline-none"
            data-id="{{ $item->ItemID }}"
            aria-label="Toggle Wishlist">
            <i class="fas fa-heart text-2xl {{ $isInWishlist ? 'text-red-500' : 'text-gray-400' }}"></i>
        </button>
    </div>

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

    <a href="{{ route('store.show', ['id' => $item->ItemID]) }}" class="flex flex-col flex-grow">
        <div class="p-4 flex-grow">
            <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $item->Name }}</h3>
        </div>

        <div class="p-4 mt-auto">
            <div class="flex items-center justify-between">
                <p class="text-xl font-medium text-gray-600">${{ number_format($item->Price, 2) }}</p>
                <div class="flex items-center space-x-1">
                    <i class="fas fa-trophy text-yellow-400"></i>
                    <span class="text-sm font-semibold text-yellow-400">{{ $item->Points }}</span>
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach