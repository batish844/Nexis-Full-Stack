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
        // Get filter parameters with defaults
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->input('maxPrice', 150);
        $categoryId = $request->input('category');
        $searchQuery = $request->input('search');
        $sort = $request->input('sort');

        // Start building the query
        $itemsQuery = Item::whereBetween('Price', [$minPrice, $maxPrice])
            ->where('isAvailable', true)
            ->whereHas('category', function ($query) {
                $query->where('Gender', 'M');
            });

        // Apply category filter
        if (!empty($categoryId)) {
            $itemsQuery->where('CategoryID', $categoryId);
        }

        // Apply search query filter
        if (!empty($searchQuery)) {
            $itemsQuery->where('Name', 'like', '%' . $searchQuery . '%');
        }

        // Apply sorting logic
        if (!empty($sort)) {
            [$column, $direction] = explode(':', $sort);

            if ($column === 'name') {
                $itemsQuery->orderBy('Name', $direction);
            } elseif ($column === 'price') {
                $itemsQuery->orderBy('Price', $direction);
            } elseif ($column === 'popularity') {
                // Ensure relationship and sorting on reviews' average rating
                $itemsQuery->withAvg('reviews', 'Stars')->orderBy('reviews_avg_Stars', $direction);
            }
        }

        // Fetch filtered items with related category
        $items = $itemsQuery->with('category')->get();

        // Check if user is authenticated to fetch their wishlist
        $wishlistItems = Auth::check()
            ? Wishlist::where('UserID', Auth::id())->pluck('ItemID')->toArray()
            : session('wishlist', []); // Use session-based wishlist for guests

        // Return a view with the filtered products and wishlist
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
