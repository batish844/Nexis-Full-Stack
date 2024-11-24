<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display reviews for a specific item.
     */
    
    public function show($id)
    {
        $item = Item::findOrFail($id);


        // Fetch all reviews for the item
        $reviews = $item->reviews()->with('user')->get();

        // Find the existing review for the authenticated user
        $existingReview = $item->reviews()->where('UserID', auth()->id())->first();

        // Calculate star distribution
        $starDistribution = [
            5 => $reviews->where('Stars', 5)->count(),
            4 => $reviews->where('Stars', 4)->count(),
            3 => $reviews->where('Stars', 3)->count(),
            2 => $reviews->where('Stars', 2)->count(),
            1 => $reviews->where('Stars', 1)->count(),
        ];

        $totalReviews = $reviews->count();

        return view('store.show', compact('item', 'reviews', 'starDistribution', 'totalReviews', 'existingReview'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'Stars' => 'required|integer|min:1|max:5',
            'Comment' => 'nullable|string|max:500',
        ]);

        // Check if the user has already reviewed this product
        $existingReview = Review::where('ItemID', $id)
            ->where('UserID', auth()->user()->id)
            ->first();

        if ($existingReview) {
            return redirect()->route('store.show', $id)->with('error', 'You have already reviewed this product.');
        }

        // Create a new review
        Review::create([
            'UserID' => auth()->user()->id,
            'ItemID' => $id,
            'Stars' => $request->Stars,
            'Comment' => $request->Comment,
        ]);

        return redirect()->route('store.show', $id)->with('success', 'Review added successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'Stars' => 'required|integer|min:1|max:5',
            'Comment' => 'nullable|string|max:500',
        ]);

        // Use the authenticated user's ID and the ItemID to locate the review
        $updated = Review::where('ItemID', $id)
            ->where('UserID', auth()->id()) // Fetch UserID directly
            ->update([
                'Stars' => $request->Stars,
                'Comment' => $request->Comment,
                'updated_at' => now(),
            ]);

        // Redirect back with success message
        if ($updated) {
            return redirect()->route('store.show', $id)->with('success', 'Review updated successfully.');
        }

        // Fallback if update fails
        return redirect()->route('store.show', $id)->with('error', 'Failed to update review.');
    }
}
