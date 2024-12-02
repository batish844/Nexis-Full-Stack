<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class WomenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::whereHas('category', function ($query) {
            $query->where('Gender', 'F');
        })->get();



        $categories = Category::where('Gender', 'F')->get();

        return view('store.women.index', compact('items', 'categories'));
    }
    public function filterProducts(Request $request)
    {
        try {
            $minPrice = $request->input('minPrice', 0);
            $maxPrice = $request->input('maxPrice', 50);
            $categoryId = $request->input('category');
            $searchQuery = $request->input('search');
            $sort = $request->input('sort', 'name:asc'); 

            $itemsQuery = Item::query();

            $itemsQuery->whereBetween('Price', [$minPrice, $maxPrice]);

            $itemsQuery->where('isAvailable', true);

            $itemsQuery->whereHas('category', function ($query) {
                $query->where('Gender', 'F');
            });

            if (!empty($categoryId)) {
                $itemsQuery->where('CategoryID', $categoryId);
            }

            if (!empty($searchQuery)) {
                $itemsQuery->where('Name', 'ILIKE', '%' . $searchQuery . '%');
            }

            if (!empty($sort)) {
                [$column, $direction] = explode(':', $sort);

                $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

                if ($column === 'name') {
                    $itemsQuery->orderBy('Name', $direction);
                } elseif ($column === 'price') {
                    $itemsQuery->orderBy('Price', $direction);
                } elseif ($column === 'popularity') {
                    $itemsQuery->addSelect([
                        'reviews_avg_stars' => Review::selectRaw('COALESCE(AVG(Stars), 0)')
                            ->whereColumn('reviews.ItemID', 'items.ItemID')
                    ])->orderBy('reviews_avg_stars', $direction);
                }
            }

            $items = $itemsQuery->with('category')->get();

            $wishlistItems = Auth::check()
                ? Wishlist::where('UserID', Auth::id())->pluck('ItemID')->toArray()
                : session('wishlist', []); 

            return view('store.cards', compact('items', 'wishlistItems'));
        } catch (\Exception $e) {
            Log::error('Filter Products Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'An error occurred while filtering products. Please try again later.'
            ], 500);
        }
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
