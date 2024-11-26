@extends('layout')

@section('title', 'Your Wishlist')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Your Wishlist</h1>

    @if ($wishlistItems->isEmpty())
    <p class="text-lg text-gray-500 text-center">Your wishlist is empty.</p>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach ($wishlistItems as $wishlist)
        @if (!empty($wishlist['item']))
        <div class="bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:scale-105 p-4 flex flex-col">
            <img src="{{ asset($wishlist['item']['Photo'][0] ?? 'storage/default.jpg') }}"
                alt="{{ $wishlist['item']['Name'] }}"
                class="w-full h-48 object-cover rounded-md mb-4">

            <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $wishlist['item']['Name'] }}</h2>
            <p class="text-sm text-gray-500 truncate">{{ $wishlist['item']['Description'] }}</p>
            <span class="block text-lg font-bold text-indigo-600 my-2">{{ '$' . number_format($wishlist['item']['Price'], 2) }}</span>

            <div class="mt-auto flex justify-between items-center space-x-2">
                <form action="{{ route('wishlist.toggle') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ItemID" value="{{ $wishlist['ItemID'] }}">
                    <button type="submit" class="bg-red-500 text-white w-28 h-14 px-4 py-2 rounded-md hover:bg-red-600 transition">
                        Delete
                    </button>
                </form>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ItemID" value="{{ $wishlist['ItemID'] }}">
                    <input type="hidden" name="Size" value="M">
                    <input type="hidden" name="Quantity" value="1">
                    <button type="submit" class="bg-green-500 text-white w-28 h-14 px-4 rounded-md hover:bg-green-600 transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="bg-gray-100 text-center py-10 rounded-md">
            <p class="text-gray-500">Item details not available.</p>
        </div>
        @endif
        @endforeach
    </div>
    @endif
</div>
@endsection