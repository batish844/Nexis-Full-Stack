<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class MenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::whereHas('category', function ($query) {
            $query->where('gender', 'M');
        })->get();


        $categories = Category::where('Gender', 'M')->get();

        return view('store.men.index', compact('items', 'categories'));
    }
    public function filterProducts(Request $request)
    {
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->input('maxPrice', 150);
        $categoryId = $request->input('category');
        $searchQuery = $request->input('search');

        $itemsQuery = Item::whereBetween('Price', [$minPrice, $maxPrice])
            ->whereHas('category', function ($query) {
                $query->where('Gender', 'M');
            })
            ->where('isAvailable', true);

        if (!empty($categoryId)) {
            $itemsQuery->where('CategoryID', $categoryId);
        }

        if (!empty($searchQuery)) {
            $itemsQuery->where('Name', 'like', '%' . $searchQuery . '%');
        }

        $items = $itemsQuery->with('category')->get();

        // Get wishlist items based on auth status
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('UserID', Auth::id())
                ->pluck('ItemID') // Fetch only ItemID
                ->toArray();
        } else {
            $wishlistItems = session('wishlist', []);
        }

        return view('store.cards', compact('items', 'wishlistItems'));
    }

    public function show(string $id)
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
