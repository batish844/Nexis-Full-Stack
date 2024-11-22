@extends('admin.layouts.sidebar')

@section('content')
@if(session('success'))
<div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="flash-message fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 ease-in-out">
    {{ session('error') }}
</div>
@endif
<div class="container mx-auto p-2">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-800">
            <span class="text-blue-500">{{ $product->Name }}</span>
        </h1>
        <a href="{{ route('products.index') }}"
            class="text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <div class="bg-white rounded-xl shadow-lg p-4">
            <div class="relative h-[450px] overflow-hidden rounded-lg">
                <img id="carousel-image" src="/{{ $product->Photo[0] }}" alt="{{ $product->Name }}"
                    class="w-[90%] h-[100%] object-cover mx-auto rounded-lg transition-transform duration-200 ease-in-out">
                <button id="carousel-left"
                    class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-900 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-gray-800 transition">
                    &lt;
                </button>
                <button id="carousel-right"
                    class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-900 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-gray-800 transition">
                    &gt;
                </button>
            </div>
        </div>

        <div class="space-y-3 grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach([
            'Category' => $product->category->Name ?? 'N/A',
            'Price' => '$' . number_format($product->Price, 2),
            'Quantity' => "<span class='" . ($product->Quantity < 10 ? ' text-red-600 font-bold' : 'text-gray-800' ) . "'>{$product->Quantity}</span>" , 'Availability'=> "<span class='px-3 mt-2 py-1 inline-flex text-sm font-semibold rounded-full " . ($product->isAvailable ? ' bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ) . "'>" . ($product->isAvailable ? 'Available' : 'Unavailable') . "</span>",
                'Points' => $product->Points ?? 'N/A',
                'Sizes' => is_array($product->Size) ? implode(', ', $product->Size) : $product->Size,
                'Created At' => $product->created_at->format('d M Y, h:i A'),
                'Last Updated' => $product->updated_at->format('d M Y, h:i A'),
                ] as $label => $value)
                <div>
                    <h2 class="text-sm font-bold text-blue-600 uppercase tracking-wide">{{ $label }}</h2>
                    <p class="text-lg font-medium text-gray-800">{!! $value !!}</p>
                </div>
                @endforeach

                <!-- Buttons Section -->
                <div class="flex flex-col sm:flex-row justify-center items-center sm:justify-start gap-4 mt-2 md:col-span-2">
                    <a href="{{ route('products.edit', $product->ItemID) }}"
                        class="w-36 px-4 py-3 text-center bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-400">
                        Edit Product
                    </a>
                    <form action="{{ route('products.toggleStatus', $product->ItemID) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-36 px-4 py-3 text-center {{ $product->isAvailable ? 'bg-yellow-600 hover:bg-yellow-500' : 'bg-green-600 hover:bg-green-500' }} text-white font-semibold rounded-md shadow-md focus:outline-none focus:ring-4 focus:ring-yellow-400">
                            {{ $product->isAvailable ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    <form action="{{ route('products.destroy', $product->ItemID) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                            class="w-36 px-4 py-3 text-center delete-button bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-400"
                            data-item-id="{{ $product->ItemID }}" data-action-url="{{ route('products.destroy', $product->ItemID) }}">
                            Delete Product
                        </button>
                    </form>
                </div>
        </div>
    </div>
</div>
<div id="delete-confirmation-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div id="modal-content" class="bg-white rounded shadow-lg p-6 w-96 mx-auto">
        <form id="delete-form" method="POST" action="{{ old('action_url', '') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="action_url" id="action_url" value="{{ old('action_url', '') }}">
            <h2 class="text-lg font-medium text-gray-900 text-center">
                Are you sure you want to delete this Product?
            </h2>
            <p class="mt-1 text-sm text-gray-600 text-center">
                Once this Product is deleted, all of their data will be permanently deleted.
            </p>
            <div class="mt-6 flex justify-center">
                <button type="button" id="cancel-button" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                    Delete Product
                </button>
            </div>
        </form>
    </div>
</div>
<div id="product-data" data-images="{{ json_encode($product->Photo) }}"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-button', function() {
            let actionUrl = $(this).data('action-url');
            $('#delete-form').attr('action', actionUrl);
            $('#action_url').val(actionUrl);
            $('#delete-confirmation-modal').removeClass('hidden');
        });

        $('#cancel-button').on('click', function() {
            $('#delete-confirmation-modal').addClass('hidden');
        });

        $('#delete-confirmation-modal').on('click', function(e) {
            if ($(e.target).is('#delete-confirmation-modal')) {
                $('#delete-confirmation-modal').addClass('hidden');
            }
        });

        $('#modal-content').on('click', function(e) {
            e.stopPropagation();
        });

        $('#delete-form').on('submit', function() {
            $('button[type="submit"]', this).prop('disabled', true);
        });
        if ($('.flash-message').length) {
            $('.flash-message').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }
        let productDataElement = $('#product-data');
        let images = JSON.parse(productDataElement.attr('data-images'));
        let currentIndex = 0;

        let carouselImage = $('#carousel-image');
        let leftButton = $('#carousel-left');
        let rightButton = $('#carousel-right');

        let updateImage = () => {
            carouselImage.attr('src', `/${images[currentIndex]}`);
        };

        leftButton.on('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateImage();
        });

        rightButton.on('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            updateImage();
        });

        updateImage();
    });
</script>
@endsection