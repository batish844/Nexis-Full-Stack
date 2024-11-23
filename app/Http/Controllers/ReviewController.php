<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display reviews for a specific item.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'Stars' => 'required|integer|min:1|max:5',
            'Comment' => 'nullable|string|max:500',
        ]);

        // Check if the user has already reviewed this product
        $existingReview = Review::where('ItemID', $id)
            ->where('UserID', auth()->id())
            ->first();

        if ($existingReview) {
            return redirect()->route('men.show', $id)->with('error', 'You have already reviewed this product.');
        }

        // Create a new review
        Review::create([
            'UserID' => auth()->id(),
            'ItemID' => $id,
            'Stars' => $request->Stars,
            'Comment' => $request->Comment,
        ]);

        return redirect()->route('men.show', $id)->with('success', 'Review added successfully.');
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
            return redirect()->route('men.show', $id)->with('success', 'Review updated successfully.');
        }

        // Fallback if update fails
        return redirect()->route('men.show', $id)->with('error', 'Failed to update review.');
    }






}
