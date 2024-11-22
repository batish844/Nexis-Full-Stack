@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Product: <span class="text-blue-600">{{ $product->Name }}</span>
        </h1>
        <a href="{{ route('products.show', $product->ItemID) }}"
            class="text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back
        </a>
    </div>

    <form id="edit-product-form" action="{{ route('products.update', $product->ItemID) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->Name) }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" id="category"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled>Select a Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->CategoryID }}" {{ old('category_id', $product->CategoryID) == $category->CategoryID ? 'selected' : '' }}>
                    {{ $category->Name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->Price) }}" step="0.01"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('price')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->Quantity) }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('quantity')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="points" class="block text-sm font-medium text-gray-700">Points</label>
            <input type="number" name="points" id="points" value="{{ old('points', $product->Points) }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('points')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="5"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->Description) }}</textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Sizes</label>
            <div class="flex space-x-4">
                @php
                $productSizes = $product->Size ?? [];
                @endphp
                @foreach(['S', 'M', 'L', 'XL'] as $size)
                <label class="relative cursor-pointer">
                    <input type="checkbox" name="sizes[]" value="{{ $size }}"
                        {{ in_array($size, $productSizes) ? 'checked' : '' }}
                        class="size-checkbox hidden">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg border cursor-pointer 
                        {{ in_array($size, $productSizes) ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                        {{ $size }}
                    </div>
                </label>
                @endforeach
            </div>
            @error('sizes')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Images</label>
            <div id="images-container" class="flex flex-col space-y-4">
                <!-- Existing Images -->
                @foreach($product->Photo as $photo)
                <div class="flex items-center space-x-4 draggable-item">
                    <span class="handle cursor-move text-gray-500">☰</span>
                    <img src="/{{ $photo }}" alt="Existing Image" class="w-20 h-20 object-cover rounded-md shadow">
                    <input type="hidden" name="existing_photos[]" value="{{ $photo }}">
                    <button type="button" class="delete-existing-image bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                        Delete
                    </button>
                </div>
                @endforeach
            </div>

            <!-- File Input for New Images -->
            <input type="file" id="new-photos-input" name="new_photos[]" accept="image/*" multiple
                class="block w-full px-4 py-2 border rounded-lg shadow-sm file:bg-blue-500 file:text-white file:border-0 file:py-2 file:px-4 file:rounded-lg hover:file:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-500 transition duration-300">
            @error('new_photos')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Hidden input to store the order of images -->
        <input type="hidden" id="image-order-input" name="image_order">

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Save Changes
            </button>
        </div>
    </form>
</div>

<style>
    .size-checkbox {
        position: absolute;
        opacity: 0;
        pointer-events: none;
        width: 0;
        height: 0;
    }

    .handle {
        cursor: move;
        font-size: 1.5rem;
    }

    .draggable-item {
        display: flex;
        align-items: center;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeButtons = document.querySelectorAll('.size-btn');
        const sizeLabels = document.querySelectorAll('label.relative');

        sizeLabels.forEach(label => {
            label.addEventListener('click', (e) => {
                if (e.target.tagName.toLowerCase() !== 'button') {
                    const checkbox = label.querySelector('.size-checkbox');
                    const sizeDiv = label.querySelector('div');

                    checkbox.checked = !checkbox.checked;

                    if (checkbox.checked) {
                        sizeDiv.classList.remove('bg-gray-200');
                        sizeDiv.classList.add('bg-blue-600', 'text-white');
                    } else {
                        sizeDiv.classList.remove('bg-blue-600', 'text-white');
                        sizeDiv.classList.add('bg-gray-200');
                    }
                }
            });
        });
        let imagesContainer = document.getElementById('images-container');
        let uploadInput = document.getElementById('new-photos-input');
        let selectedFiles = [];

        // Initialize Sortable on the combined container
        new Sortable(imagesContainer, {
            animation: 150,
            handle: '.handle',
            draggable: '.draggable-item',
            onEnd: function(evt) {
                console.log('Images reordered.');
            },
        });

        // Add new images to the container
        uploadInput.addEventListener('change', function() {
            let files = uploadInput.files;
            selectedFiles = Array.from(files);

            selectedFiles.forEach(function(file, index) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let div = document.createElement('div');
                    div.classList.add('flex', 'items-center', 'space-x-4', 'draggable-item', 'new-image');
                    div.setAttribute('data-file-index', index);

                    div.innerHTML = `
                        <span class="handle cursor-move text-gray-500">☰</span>
                        <img src="${e.target.result}" alt="New Image" class="w-20 h-20 object-cover rounded-md shadow">
                        <button type="button" class="delete-new-image bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                            Delete
                        </button>
                    `;
                    imagesContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        // Handle deletion of existing images
        imagesContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-existing-image')) {
                event.preventDefault();
                let imageDiv = event.target.closest('.draggable-item');
                imageDiv.remove();
            }

            if (event.target.classList.contains('delete-new-image')) {
                event.preventDefault();
                let imageDiv = event.target.closest('.draggable-item');
                let index = parseInt(imageDiv.getAttribute('data-file-index'));
                selectedFiles.splice(index, 1);
                updateFileInput();
                imageDiv.remove();
            }
        });

        // Update the file input with the current selected files
        function updateFileInput() {
            let dataTransfer = new DataTransfer();
            selectedFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            uploadInput.files = dataTransfer.files;
        }

        // Serialize image order before form submission
        document.getElementById('edit-product-form').addEventListener('submit', function() {
            let imageOrder = [];
            let items = imagesContainer.querySelectorAll('.draggable-item');

            items.forEach(function(item) {
                if (item.classList.contains('new-image')) {
                    imageOrder.push('new-' + item.getAttribute('data-file-index'));
                } else {
                    let existingPhotoInput = item.querySelector('input[name="existing_photos[]"]');
                    if (existingPhotoInput) {
                        imageOrder.push('existing-' + existingPhotoInput.value);
                    }
                }
            });

            document.getElementById('image-order-input').value = JSON.stringify(imageOrder);
        });
    });
</script>
@endsection