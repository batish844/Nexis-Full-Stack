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
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        $categoryId = $request->category;
        $search = $request->search;

        // Start the query
        $query = Item::query();

        // Apply price range filter
        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('Price', [$minPrice, $maxPrice]);
        }

        // Apply category filter if selected
        if (!empty($categoryId)) {
            $query->where('CategoryID', $categoryId);
        }

        // Apply search filter if search query is provided
        if (!empty($search)) {
            $query->where('Name', 'like', '%' . $search . '%');
        }

        // Fetch filtered products
        $items = $query->get();

        // Decode the JSON 'Photo' field
        $items->each(function($item) {
            $item->Photo = json_decode($item->Photo, true);
        });

        // Return the filtered products as JSON
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
