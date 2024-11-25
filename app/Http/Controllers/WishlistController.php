<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        // Fetch wishlist items for the authenticated user
        $wishlistItems = Wishlist::where('user_id', auth()->id())
            ->with('item') // Fetch related items for each wishlist entry
            ->get();

        // Return the view with the wishlist items
        return view('wishlist', compact('wishlistItems'));
    }
    public function showWishlist()
{
    $user = Auth::user(); // Get the authenticated user

    if ($user) {
        // Fetch wishlist items for the authenticated user
        $wishlistItems = Wishlist::with('item') // Assuming you have an item relationship in the Wishlist model
            ->where('UserID', $user->UserID)
            ->get();

        // Pass the data to the view
        return view('wishlist', compact('wishlistItems'));
    }

    // For guest users, check if the wishlist exists in localStorage (using JS)
    // If guest, the wishlist will be handled client-side and passed to view in the form of a JS variable
    return view('wishlist', [
        'guestWishlist' => json_encode(request()->cookie('guest_wishlist') ?? []) // Retrieve from cookies (can be stored in session/localStorage on the client side)
    ]);
}


public function addToWishlist(Request $request)
{
    Log::info('Adding item to wishlist', ['data' => $request->all()]);

    $user = auth()->user();
    if (!$user) {
        return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
    }

    $itemId = $request->input('ItemID');

    try {
        $existingItem = Wishlist::where('UserID', $user->UserID)->where('ItemID', $itemId)->first();

        if ($existingItem) {
            return response()->json(['success' => false, 'message' => 'Item already in wishlist']);
        }

        $wishlistItem = new Wishlist([
            'UserID' => $user->UserID,
            'ItemID' => $itemId
        ]);
        $wishlistItem->save();

        return response()->json(['success' => true, 'message' => 'Item added to wishlist']);
    } catch (\Exception $e) {
        Log::error('Error adding item to wishlist', ['error' => $e->getMessage()]);
        return response()->json(['success' => false, 'message' => 'Error adding item to wishlist: ' . $e->getMessage()], 500);
    }
}
    
// public function add(Request $request)
// {
//     $itemId = $request->input('ItemID');
//     // Add item to the wishlist logic here
//     // For example:
//     $wishlist = auth()->user()->wishlist; // Assuming authenticated user has a wishlist relation
//     $wishlist->items()->attach($itemId);
    
//     return response()->json(['success' => true]);
// }

public function add(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'ItemID' => 'required|integer|exists:items,id',  // Ensure the item exists in the items table
    ]);

    try {
        // For authenticated users, we store the wishlist in the database
        if (auth()->check()) {
            $user = auth()->user();
            $itemId = $validated['ItemID'];

            // Check if the item is already in the wishlist
            if ($user->wishlist->contains($itemId)) {
                return response()->json(['success' => false, 'message' => 'Item already in wishlist.']);
            }

            // Add the item to the wishlist (assuming a pivot table)
            $user->wishlist()->attach($itemId);
            return response()->json(['success' => true]);
        } else {
            // Handle the case for guests (optional)
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }
    } catch (\Exception $e) {
        // Log the error and return a generic message
        \Log::error("Error adding item to wishlist: " . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Something went wrong.']);
    }
}



    // For guest users to store items in local storage (on front end)
    public function storeGuestWishlist(Request $request)
    {
        if ($request->has('wishlist')) {
            session(['guest_wishlist' => $request->wishlist]);
        }

        return response()->json(['message' => 'Wishlist data saved']);
    }

    // Transfer guest wishlist to database after registration
    public function transferGuestWishlistToDatabase()
    {
        $user = Auth::user();
        $guestWishlist = session('guest_wishlist', []);

        foreach ($guestWishlist as $itemID) {
            Wishlist::create([
                'UserID' => $user->UserID,
                'ItemID' => $itemID,
                'DateTime' => now(),
            ]);
        }

        // Clear the session after transferring the wishlist
        session()->forget('guest_wishlist');

        return response()->json(['message' => 'Wishlist transferred to database']);
    }
}