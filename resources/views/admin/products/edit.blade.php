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

        <!-- Product Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->Name) }}" 
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Category -->
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

        <!-- Price -->
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

        <!-- Images -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Images</label>
            <!-- Existing Images -->
            <div id="existing-image-container" class="flex flex-col space-y-4">
                @foreach($product->Photo as $photo)
                <div class="flex items-center space-x-4">
                    <input type="hidden" name="existing_photos[]" value="{{ $photo }}">
                    <img src="/{{ $photo }}" alt="Existing Image" class="w-20 h-20 object-cover rounded-md">
                    <button type="button" class="delete-existing-image bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                        Delete
                    </button>
                </div>
                @endforeach
            </div>
            @error('new_photos.*')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- New Upload -->
            <input type="file" id="new-photos-input" name="new_photos[]" accept="image/*" multiple 
                class="block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-4">
            @error('new_photos')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <!-- Image Previews -->
            <div id="image-preview-container" class="flex flex-col space-y-4 mt-4"></div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Save Changes
            </button>
        </div>
    </form>
</div>

<!-- Inline CSS to properly hide checkboxes -->
<style>
    .size-checkbox {
        position: absolute;
        opacity: 0;
        pointer-events: none;
        width: 0;
        height: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sizeButtons = document.querySelectorAll('.size-btn');
        const sizeLabels = document.querySelectorAll('label.relative');

        // Toggle size selection
        sizeLabels.forEach(label => {
            label.addEventListener('click', (e) => {
                // Prevent label click from affecting other elements
                if (e.target.tagName.toLowerCase() !== 'button') {
                    const checkbox = label.querySelector('.size-checkbox');
                    const sizeDiv = label.querySelector('div');

                    // Toggle checkbox state
                    checkbox.checked = !checkbox.checked;

                    // Update button appearance
                    if (checkbox.checked) {
                        sizeDiv.classList.remove('bg-gray-200');
                        sizeDiv.classList.add('bg-blue-600', 'text-white');
                    } else {
                        sizeDiv.classList.remove('bg-blue-600', 'text-white');
                        sizeDiv.classList.add('bg-gray-200');
                    }

                    // Debugging: Log checkbox state
                    console.log('Checkbox value:', checkbox.value, 'Checked:', checkbox.checked);
                }
            });
        });

        // Handle existing image deletion
        const existingImageContainer = document.getElementById('existing-image-container');

        existingImageContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('delete-existing-image')) {
                event.preventDefault();
                const imageDiv = event.target.closest('.flex.items-center.space-x-4');
                const hiddenInput = imageDiv.querySelector('input[type="hidden"]');
                
                // Remove the hidden input so that the existing photo is not sent in the form
                hiddenInput.remove();
                
                // Remove the image div
                imageDiv.remove();

                // Optional: Additional logging
                console.log('Removed existing photo.');
            }
        });

        // Handle new image previews
        const uploadInput = document.getElementById('new-photos-input');
        const previewContainer = document.getElementById('image-preview-container');

        uploadInput.addEventListener('change', () => {
            const files = uploadInput.files;

            // Clear previous previews
            previewContainer.innerHTML = '';

            // Display previews
            Array.from(files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.classList.add('flex', 'items-center', 'space-x-4');
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="New Image" class="w-20 h-20 object-cover rounded-md">
                        <span class="text-sm">${file.name}</span>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>
@endsection
