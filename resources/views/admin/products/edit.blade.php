@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Product: <span class="text-blue-600">{{ $product->Name }}</span>
        </h1>
        <a href="{{ route('products.index') }}"
            class="text-gray-700 bg-gray-100 px-5 py-2 rounded-lg shadow hover:bg-gray-200 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back to Products
        </a>
    </div>

    <form action="{{ route('products.update', $product->ItemID) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-8">
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

        <!-- Quantity -->
        <div class="mb-6">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->Quantity) }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('quantity')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Sizes -->
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
                        class="size-checkbox">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg border 
                        {{ in_array($size, $productSizes) ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
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
            <div id="existing-image-container" class="flex flex-col space-y-4">
                @foreach($product->Photo as $photo)
                <div class="flex items-center space-x-4 draggable-item">
                    <span class="handle cursor-move text-gray-500">☰</span>
                    <img src="/{{ $photo }}" alt="Existing Image" class="w-20 h-20 object-cover rounded-md">
                    <input type="hidden" name="existing_photos[]" value="{{ $photo }}">
                    <button type="button" class="delete-existing-image bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                        Delete
                    </button>
                </div>
                @endforeach
            </div>
            @error('new_photos.*')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <input type="file" id="new-photos-input" name="new_photos[]" accept="image/*" multiple
                class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-4">
            @error('new_photos')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <div id="image-preview-container" class="flex flex-col space-y-4 mt-4"></div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Save Changes
            </button>
        </div>
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
        console.log('DOM fully loaded and parsed');
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
        let existingImageContainer = document.getElementById('existing-image-container');
        let previewContainer = document.getElementById('image-preview-container');
        let uploadInput = document.getElementById('new-photos-input');

        console.log('existingImageContainer:', existingImageContainer);
        console.log('previewContainer:', previewContainer);

        if (existingImageContainer) {
            console.log('Initializing Sortable on existingImageContainer');
            new Sortable(existingImageContainer, {
                animation: 150,
                handle: '.handle',
                draggable: '.draggable-item',
                onEnd: function(evt) {
                    console.log('Existing images reordered.');
                },
            });
        } else {
            console.error('existingImageContainer not found');
        }

        if (previewContainer) {
            console.log('Initializing Sortable on previewContainer');
            new Sortable(previewContainer, {
                animation: 150,
                handle: '.handle',
                draggable: '.draggable-item',
                onEnd: function(evt) {
                    console.log('New images reordered.');
                },
            });
        } else {
            console.error('previewContainer not found');
        }

        let selectedFiles = [];

        uploadInput.addEventListener('change', function() {
            let files = uploadInput.files;
            selectedFiles = Array.from(files);

            // Clear previous previews
            previewContainer.innerHTML = '';

            // Display previews
            selectedFiles.forEach(function(file, index) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let div = document.createElement('div');
                    div.classList.add('flex', 'items-center', 'space-x-4', 'image-preview', 'draggable-item');
                    div.setAttribute('data-file-index', index);

                    div.innerHTML = `
                    <span class="handle cursor-move text-gray-500">☰</span>
                    <img src="${e.target.result}" alt="New Image" class="w-20 h-20 object-cover rounded-md">
                    <span class="text-sm">${file.name}</span>
                    <button type="button" class="delete-new-image bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                        Delete
                    </button>
                `;
                    previewContainer.appendChild(div);

                    // Re-initialize SortableJS after adding new content
                    initSortableForNewImages();
                };
                reader.readAsDataURL(file);
            });
        });

        // Function to initialize SortableJS for new images
        function initSortableForNewImages() {
            new Sortable(previewContainer, {
                animation: 150,
                handle: '.handle',
                draggable: '.draggable-item',
                onEnd: function(evt) {
                    console.log('New images reordered.');
                },
            });
        }

        // Handle deletion of new images
        previewContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-new-image')) {
                event.preventDefault();
                let imageDiv = event.target.closest('.draggable-item');
                let index = parseInt(imageDiv.getAttribute('data-file-index'));

                // Remove from selectedFiles
                selectedFiles.splice(index, 1);

                // Update the file input
                updateFileInput();

                // Remove the image div
                imageDiv.remove();

                // Update data-file-index attributes
                updateDataFileIndexes();
            }
        });

        // Update the file input with the current selectedFiles
        function updateFileInput() {
            let dataTransfer = new DataTransfer();
            selectedFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            uploadInput.files = dataTransfer.files;
        }

        // Update data-file-index attributes after deletion
        function updateDataFileIndexes() {
            let previews = previewContainer.querySelectorAll('.image-preview');
            previews.forEach(function(preview, index) {
                preview.setAttribute('data-file-index', index);
            });
        }

        // Handle existing image deletion
        existingImageContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-existing-image')) {
                event.preventDefault();
                let imageDiv = event.target.closest('.draggable-item');
                let hiddenInput = imageDiv.querySelector('input[type="hidden"]');

                // Remove the hidden input
                hiddenInput.remove();

                // Remove the image div
                imageDiv.remove();

                console.log('Removed existing photo.');
            }
        });
    });
</script>
@endsection