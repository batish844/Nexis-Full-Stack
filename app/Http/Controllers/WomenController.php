<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

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
        return view('store.women.index');
    }
    public function filterProducts(Request $request)
    {
        $minPrice = $request->input('minPrice', 0);
        $maxPrice = $request->input('maxPrice', 150);
        $categoryId = $request->input('category');
        $searchQuery = $request->input('search');

        $itemsQuery = Item::whereBetween('Price', [$minPrice, $maxPrice])
            ->whereHas('category', function ($query) {
                $query->where('Gender', 'F');
            });

        if (!empty($categoryId)) {
            $itemsQuery->where('CategoryID', $categoryId);
        }

        if (!empty($searchQuery)) {
            $itemsQuery->where('Name', 'like', '%' . $searchQuery . '%');
        }

        $items = $itemsQuery->with('category')->get();

      

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
