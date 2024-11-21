<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;  // Import the Category model
use Illuminate\Support\Facades\Storage;

class MenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch items with the category filter for 'M' gender
        $items = Item::whereHas('category', function ($query) {
            $query->where('gender', 'M');
        })->get();

        // Decode the JSON 'Photo' field
        $items->each(function($item) {
            $item->Photo = json_decode($item->Photo, true);
        });

        // Fetch categories for the dropdown
        $categories = Category::where('Gender', 'M')->get();

        return view('men.index', compact('items', 'categories'));
    }

    /**
     * Filter products based on price range, category, and search query.
     */
    public function filterProducts(Request $request)
{
    // Get filter inputs
    $minPrice = $request->input('minPrice', 0);
    $maxPrice = $request->input('maxPrice', 150);
    $categoryId = $request->input('category');
    $searchQuery = $request->input('search');

    // Query items based on filters
    $itemsQuery = Item::whereBetween('Price', [$minPrice, $maxPrice]);

    if (!empty($categoryId)) {
        $itemsQuery->where('CategoryID', $categoryId);
    }

    if (!empty($searchQuery)) {
        $itemsQuery->where('Name', 'like', '%' . $searchQuery . '%');
    }

    $items = $itemsQuery->with('category')->get();

    // Decode Photos
    foreach ($items as $item) {
        $item->Photo = json_decode($item->Photo, true);
    }

    // Return JSON response
    return response()->json($items);
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
