@extends('layout')

@section('title', 'Wishlist')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Your Wishlist</h1>

    @if(auth()->check())
        {{-- For authenticated users --}}
        @if($wishlistItems && $wishlistItems->isEmpty())
            <p class="text-lg text-gray-500 text-center">Your wishlist is empty.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlistItems as $wishlist)
                    <div class="bg-white border border-gray-300 rounded-lg shadow-lg hover:shadow-xl transition p-4 relative">
                        <img src="{{ asset('storage/img/' . $wishlist->item->image) }}" alt="{{ $wishlist->item->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                        <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $wishlist->item->name }}</h2>
                        <p class="text-gray-500 truncate">{{ $wishlist->item->description }}</p>
                        <span class="block text-lg font-bold text-indigo-600 my-2">{{ '$' . number_format($wishlist->item->price, 2) }}</span>
                        
                        <div class="flex justify-between items-center space-x-2">
                            <button onclick="removeFromWishlist({{ $wishlist->id }})" 
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                Delete
                            </button>
                            <button onclick="addToCart({{ $wishlist->item->id }})" 
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        {{-- For guest users --}}
        <div id="guest-wishlist" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
        <p id="empty-guest-wishlist" class="text-lg text-gray-500 text-center hidden">Your wishlist is empty.</p>
    @endif
</div>



<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (!@json(Auth::check())) {
            const guestWishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            const wishlistContainer = document.getElementById('guest-wishlist');
            const emptyMessage = document.getElementById('empty-guest-wishlist');

            if (guestWishlist.length === 0) {
                emptyMessage.classList.remove('hidden');
            } else {
                // Fetch item details for guest users
                fetch('/api/get-wishlist-items', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ itemIds: guestWishlist })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        data.items.forEach(item => {
                            const wishlistItem = document.createElement('div');
                            wishlistItem.className = 'bg-white border border-gray-300 rounded-lg shadow-lg hover:shadow-xl transition p-4 relative';
                            wishlistItem.innerHTML = `
                                <img src="{{ asset('storage/img/') }}/${item.image}" alt="${item.name}" class="w-full h-48 object-cover rounded-md mb-4">
                                <h2 class="text-lg font-semibold text-gray-800">${item.name}</h2>
                                <p class="text-gray-500 truncate">${item.description}</p>
                                <span class="block text-lg font-bold text-indigo-600 my-2">${'$' + item.price.toFixed(2)}</span>
                                <div class="flex justify-between items-center space-x-2 mt-4">
                                    <button onclick="removeFromLocalWishlist(${item.id})" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                                    <button onclick="addToCart(${item.id})" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Add to Cart</button>
                                </div>
                            `;
                            wishlistContainer.appendChild(wishlistItem);
                        });
                    }
                });
            }
        }
    });

    function removeFromLocalWishlist(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
            wishlist = wishlist.filter(id => id !== itemId);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            alert('Item removed from wishlist.');
            location.reload();
        }
    }

    function addToCart(itemId) {
        fetch(`{{ url('/cart/add') }}/${itemId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Item added to cart.');
            } else {
                alert('Failed to add item to cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
