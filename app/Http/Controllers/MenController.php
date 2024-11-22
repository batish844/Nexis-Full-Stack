<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category; 
use Illuminate\Support\Facades\Storage;

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

        $items->each(function ($item) {
            $item->Photo = json_decode($item->Photo, true);
        });

        $categories = Category::where('Gender', 'M')->get();

        return view('store.men.index', compact('items', 'categories'));
    }

    /**
     * Filter products based on price range, category, and search query.
     */
    public function filterProducts(Request $request)
    {
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->input('maxPrice', 150);
        $categoryId = $request->input('category');
        $searchQuery = $request->input('search');

        
        $itemsQuery = Item::whereBetween('Price', [$minPrice, $maxPrice])
        ->whereHas('category', function ($query) {
            $query->where('Gender', 'M');
        });
        if (!empty($categoryId)) {
            $itemsQuery->where('CategoryID', $categoryId);
        }

        if (!empty($searchQuery)) {
            $itemsQuery->where('Name', 'like', '%' . $searchQuery . '%');
        }

        $items = $itemsQuery->with('category')->get();

       
        foreach ($items as $item) {
            $item->Photo = json_decode($item->Photo, true);
        }

        return view('store.cards', compact('items'));
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
