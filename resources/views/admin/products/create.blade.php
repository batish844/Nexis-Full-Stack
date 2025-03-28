@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Add Product
        </h1>
        <a href="{{ route('products.index') }}"
            class="text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back
        </a>
    </div>

    <form id="create-product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-8">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" placeholder="Enter Name Here" id="name" value="{{ old('name') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>Select Gender</option>
                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}>Male</option>
                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-6">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category" name="category_id"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>Select a Category</option>
            </select>
            @error('category_id')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" placeholder="Enter Price Here" id="price" value="{{ old('price') }}" step="0.01"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('price')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" placeholder="Enter Quantity" value="{{ old('quantity') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('quantity')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="points" class="block text-sm font-medium text-gray-700">Points</label>
            <input type="number" placeholder="Enter Points" name="points" id="points" value="{{ old('points') }}"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('points')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" placeholder="Enter Description" id="description" rows="5"
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Sizes</label>
            <div class="flex space-x-4">
                @foreach(['S', 'M', 'L', 'XL'] as $size)
                <label class="relative cursor-pointer">
                    <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}
                        class="size-checkbox hidden">
                    <div class="w-12 h-12 flex items-center justify-center rounded-lg border cursor-pointer 
                        {{ in_array($size, old('sizes', [])) ? 'bg-blue-600 text-white' : 'bg-gray-200' }}">
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
            </div>

            <input type="file" id="new-photos-input" name="new_photos[]" accept="image/*" multiple
                class="block w-full px-4 py-2 border rounded-lg shadow-sm file:bg-blue-500 file:text-white file:border-0 file:py-2 file:px-4 file:rounded-lg hover:file:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-500 transition duration-300">
            @error('new_photos')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" id="image-order-input" name="image_order">

        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-500">
                Add Product
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
        const genderSelect = document.getElementById('gender');
        const categorySelect = document.getElementById('category');

        genderSelect.addEventListener('change', function() {
            const gender = this.value;

            categorySelect.innerHTML = '<option value="" disabled selected>Select a Category</option>';

            fetch(`/gender/${gender}`)
                .then(response => response.json())
                .then(categories => {
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.CategoryID;
                        option.textContent = category.Name;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching categories:', error));
        });
        let sizeButtons = document.querySelectorAll('.size-btn');
        let sizeLabels = document.querySelectorAll('label.relative');

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

        new Sortable(imagesContainer, {
            animation: 150,
            handle: '.handle',
            draggable: '.draggable-item',
            onEnd: function(evt) {
                console.log('Images reordered.');
            },
        });

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
                        <span class="text-sm">${file.name}</span>
                        <button type="button" class="delete-new-image bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                            Delete
                        </button>
                    `;
                    imagesContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        imagesContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-new-image')) {
                let imageDiv = event.target.closest('.draggable-item');
                let index = parseInt(imageDiv.getAttribute('data-file-index'));
                selectedFiles.splice(index, 1);
                updateFileInput();
                imageDiv.remove();
            }
        });

        function updateFileInput() {
            let dataTransfer = new DataTransfer();
            selectedFiles.forEach(function(file) {
                dataTransfer.items.add(file);
            });
            uploadInput.files = dataTransfer.files;
        }

        document.getElementById('create-product-form').addEventListener('submit', function() {
            let imageOrder = [];
            let items = imagesContainer.querySelectorAll('.draggable-item');

            items.forEach(function(item) {
                imageOrder.push('new-' + item.getAttribute('data-file-index'));
            });

            document.getElementById('image-order-input').value = JSON.stringify(imageOrder);
        });
    });
</script>
@endsection