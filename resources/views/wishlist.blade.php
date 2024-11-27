@extends('layout')

@section('title', 'Your Wishlist')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Your Wishlist</h1>

    @if ($wishlistItems->isEmpty())
    <div class="flex items-center justify-center flex-col text-center py-20">
        <img src="{{ asset('/storage/img/CommonImg/emptywishlist2.png') }}" alt="Empty Wishlist" class="w-64 h-64 mb-6">
        <p class="text-lg text-gray-500 mb-4">You don't have any items in your wishlist yet.</p>
        <a href="{{ route('store.men') }}" class="text-blue-500 underline text-xl font-semibold">
            Browse our store to add items to your wishlist!
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
        @foreach ($wishlistItems as $wishlist)
        @if ($wishlist['item'])
        <div class="wishlist-card bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105 flex flex-col h-full relative group border border-gray-200">
            <!-- Wishlist Icon -->
            <button 
                class="absolute top-4 right-4 wishlist-btn focus:outline-none bg-white p-2 rounded-full shadow-md hover:shadow-lg transition text-red-500 hover:text-gray-400"
                data-id="{{ $wishlist['ItemID'] }}"
                aria-label="Remove from Wishlist">
                <i class="fas fa-heart text-3xl"></i>
            </button>

            <a href="{{ route('store.show', ['id' => $wishlist['ItemID']]) }}" class="block">
                <img src="{{ asset($wishlist['item']['Photo'][0] ?? 'storage/default.jpg') }}" 
                     alt="{{ $wishlist['item']['Name'] }}" 
                     class="w-full h-72 object-cover rounded-t-xl">
            </a>

            <div class="p-6 flex flex-col justify-between flex-grow">
                <a href="{{ route('store.show', ['id' => $wishlist['ItemID']]) }}" class="block">
                    <h3 class="text-2xl font-semibold text-gray-900 truncate mb-2">{{ $wishlist['item']['Name'] }}</h3>
                    <p class="text-sm text-gray-600 truncate">{{ $wishlist['item']['Description'] }}</p>
                </a>
                <div class="mt-4 flex items-center justify-between">
                    <p class="text-2xl font-bold text-gray-800">${{ number_format($wishlist['item']['Price'], 2) }}</p>
                    <a href="{{ route('store.show', ['id' => $wishlist['ItemID']]) }}" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-full hover:bg-blue-500 transition">View Details</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif
</div>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.addEventListener('click', function(event) {
            const button = event.target.closest('.wishlist-btn');

            if (button) {
                const itemId = button.dataset.id;

                fetch('/wishlist/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            ItemID: itemId
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (data.message.includes('removed')) {
                                const card = button.closest('.wishlist-card');
                                if (card) {
                                    card.remove();
                                }
                            }

                            if (window.updateWishlistCounters) {
                                window.updateWishlistCounters();
                            }
                        } else {
                            console.error(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        window.updateWishlistCounters = function() {
            fetch('/wishlist/count', {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    const desktopCounter = document.getElementById('wishlist-count-desktop');
                    const hamburgerCounter = document.getElementById('wishlist-count-hamburger');

                    if (desktopCounter) {
                        desktopCounter.textContent = data.wishlistCount;
                    }
                    if (hamburgerCounter) {
                        hamburgerCounter.textContent = data.wishlistCount;
                    }
                })
                .catch(error => {
                    console.error('Error updating wishlist counter:', error);
                });
        };

        updateWishlistCounters();
    });
</script>
@endpush
