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
        <button class="carousel-btn right">
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
@if ($items->isEmpty())
<div class="text-center text-blue-500 w-full flex items-center justify-center h-full">
    <p>No items found in this price range.</p>
</div>
@endif