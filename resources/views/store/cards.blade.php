@foreach ($items as $item)

<div class="product-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full relative group">
    <!-- Wishlist Icon -->
    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
        <button class="wishlist-btn text-gray-400 hover:text-red-500 focus:outline-none" data-id="{{ $item->ItemID }}">
            <i class="fas fa-heart text-2xl"></i>
        </button>
    </div>

    <!-- Product Image Carousel -->
    <div class="carousel relative">
    <a href="{{ route('store.show', ['id' => $item->ItemID, 'photos' => json_encode($item->Photo)]) }}">
        @foreach ($item->Photo as $index => $photo)
        <img src="{{ $photo }}" alt="{{ $item->Name }}" class="carousel-img object-cover w-full h-64 {{ $index === 0 ? 'active' : 'hidden' }}" data-index="{{ $index }}">
        @endforeach
    </a>

        <!-- Navigation Arrows -->
        <button class="carousel-btn left">
            <i class="fas fa-chevron-left text-black"></i>
        </button>
        <button class="carousel-btn right">
            <i class="fas fa-chevron-right text-black"></i>
        </button>
    </div>
    <a href="{{ route('store.show', ['id' => $item->ItemID, 'photos' => json_encode($item->Photo)]) }}">
        <!-- Product Details -->
        <div class="p-4 flex flex-col flex-grow">
            <h3 class="font-semibold text-lg text-gray-800">{{ $item->Name }}</h3>
            <p class="text-xl font-medium text-gray-600">${{ number_format($item->Price, 2) }}</p>
        </div>

        <div class="mt-auto">
            <button
                class=" py-2 px-4 w-full bg-blue-700 text-white rounded-lg hover:bg-blue-600 transition-all flex items-center justify-between space-x-2"
                type="button">
                <span class="text-lg font-semibold mx-auto"> View Details </span>
                <div class="flex items-center space-x-1">
                    <i class="fas fa-trophy text-yellow-400"></i>
                    <span class="text-sm font-semibold text-yellow-400">{{ $item->Points }}</span>
                </div>
            </button>
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