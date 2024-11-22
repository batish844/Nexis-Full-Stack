@extends('layout')

@section('title', $item->Name)

@section('content')
<div class="container mx-auto my-8">
    <div class="flex flex-wrap">
        <!-- Product Images Section -->
        <div class="w-full lg:w-1/2 p-4">
            <div class="relative">
                <!-- Main Image -->
                <img id="mainImage" src="{{ asset($item->Photo[0]) }}" alt="{{ $item->Name }}" class="w-full h-auto object-cover cursor-zoom-in" data-large="{{ asset($item->Photo[0]) }}">

                <!-- Thumbnail Images -->
                <div class="flex mt-4 space-x-2">
                    @foreach ($item->Photo as $photo)
                    <img src="{{ asset($photo) }}" alt="{{ $item->Name }}" class="w-12 h-12 object-cover border cursor-pointer thumbnail">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="w-full lg:w-1/2 p-4">
            <h1 class="text-3xl font-bold">{{ $item->Name }}</h1>
            <p class="text-lg text-gray-700 mt-2">Product Code: {{ $item->ItemID }}</p>
            <p class="text-2xl font-bold text-blue-600 mt-4">Price: ${{ number_format($item->Price, 2) }}</p>
            <!-- Product Description Section -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold">Description</h3>
                <p class="text-gray-600 mt-2">{{ $item->Description }}</p>
            </div>

            <!-- Size Options -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold">Size</h3>
                <div class="flex space-x-2 mt-2">
                    @foreach ($item->Size as $size)
                    <button class="border px-4 py-2 rounded hover:bg-gray-200">{{ $size }}</button>
                    @endforeach
                </div>
            </div>

            <!-- Add to Cart -->
            <button class="mt-8 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700">
                Add to Cart
            </button>
        </div>
    </div>
</div>

<!-- Zoom Modal -->
<div id="zoomModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
    <img id="zoomedImage" src="" alt="Zoomed Image" class="w-auto h-auto max-w-full max-h-full">
    <button id="closeZoom" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
</div>

<script>
    // Handle Thumbnail Clicks
    document.querySelectorAll('.thumbnail').forEach(thumbnail => {
        thumbnail.addEventListener('click', function () {
            document.getElementById('mainImage').src = this.src;
            document.getElementById('mainImage').dataset.large = this.src;
        });
    });

    // Handle Image Zoom
    document.getElementById('mainImage').addEventListener('click', function () {
        const zoomModal = document.getElementById('zoomModal');
        const zoomedImage = document.getElementById('zoomedImage');
        zoomedImage.src = this.dataset.large;
        zoomModal.classList.remove('hidden');
    });

    // Close Zoom Modal
    document.getElementById('closeZoom').addEventListener('click', function () {
        document.getElementById('zoomModal').classList.add('hidden');
    });
</script>
@endsection
