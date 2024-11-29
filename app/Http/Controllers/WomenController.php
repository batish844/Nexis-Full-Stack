<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WomenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::whereHas('category', function ($query) {
            $query->where('gender', 'F');
        })->get();



        $categories = Category::where('Gender', 'F')->get();

        return view('store.women.index', compact('items', 'categories'));
    }
    public function filterProducts(Request $request)
    {
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->input('maxPrice', 50);
        $categoryId = $request->input('category');
        $searchQuery = $request->input('search');
        $sort = $request->input('sort'); // Sorting parameter

        $itemsQuery = Item::whereBetween('Price', [$minPrice, $maxPrice])
            ->whereHas('category', function ($query) {
                $query->where('Gender', 'F'); // Filtering for women's category
            })
            ->where('isAvailable', true);

        // Apply category filter if provided
        if (!empty($categoryId)) {
            $itemsQuery->where('CategoryID', $categoryId);
        }

        // Apply search query if provided
        if (!empty($searchQuery)) {
            $itemsQuery->where('Name', 'like', '%' . $searchQuery . '%');
        }

        // Apply sorting if provided
        if (!empty($sort)) {
            [$column, $direction] = explode(':', $sort);

            if ($column === 'name') {
                $itemsQuery->orderBy('Name', $direction);
            } elseif ($column === 'price') {
                $itemsQuery->orderBy('Price', $direction);
            } elseif ($column === 'popularity') {
                $itemsQuery->withAvg('reviews', 'Stars')->orderBy('reviews_avg_Stars', $direction);
            }
        }

        // Fetch the filtered items with their categories
        $items = $itemsQuery->with('category')->paginate(8);;

        // Handle wishlist items
        if (Auth::check()) {
            $wishlistItems = Wishlist::where('UserID', Auth::id())
                ->pluck('ItemID') // Fetch only ItemID
                ->toArray();
        } else {
            $wishlistItems = session('wishlist', []);
        }

        // Return the filtered items view
        return view('store.cards', compact('items', 'wishlistItems'));
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
    public function show(string $id)
    {
        //
    }

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
