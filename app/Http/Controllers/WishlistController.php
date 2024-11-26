<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Add an item to the wishlist.
     */
    public function addToWishlist(Request $request)
    {
        $validatedData = $request->validate([
            'ItemID' => 'required|exists:items,ItemID',
        ]);

        $itemID = $validatedData['ItemID'];

        if (Auth::check()) {
            // Authenticated User Logic
            $user = Auth::user();

            $wishlistEntry = Wishlist::where('UserID', $user->UserID)
                ->where('ItemID', $itemID)
                ->first();

            if ($wishlistEntry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item already exists in your wishlist.',
                ]);
            }

            Wishlist::create([
                'UserID' => $user->UserID,
                'ItemID' => $itemID,
            ]);

            $totalWishlistCount = Wishlist::where('UserID', $user->UserID)->count();

            return response()->json([
                'success' => true,
                'message' => 'Item added to your wishlist.',
                'wishlistCount' => $totalWishlistCount,
            ]);
        } else {
            // Guest User Logic
            $wishlist = session('wishlist', []);

            if (in_array($itemID, $wishlist)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item already exists in your wishlist.',
                ]);
            }

            $wishlist[] = $itemID;
            session(['wishlist' => $wishlist]);

            return response()->json([
                'success' => true,
                'message' => 'Item added to your wishlist.',
                'wishlistCount' => count($wishlist),
            ]);
        }
    }

    /**
     * Remove an item from the wishlist.
     */
    public function toggleWishlist(Request $request)
    {
        $validatedData = $request->validate([
            'ItemID' => 'required|exists:items,ItemID',
        ]);

        $itemID = $validatedData['ItemID'];

        if (Auth::check()) {
            $userID = Auth::id();
            $wishlistEntry = Wishlist::where('UserID', $userID)
                ->where('ItemID', $itemID)
                ->first();

            if ($wishlistEntry) {
                // If the item exists, remove it
                $wishlistEntry->delete();
                $wishlistCount = Wishlist::where('UserID', $userID)->count();
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from wishlist.',
                    'wishlistCount' => $wishlistCount,
                ]);
            } else {
                // Call addToWishlist if item doesn't exist
                return $this->addToWishlist($request);
            }
        } else {
            $wishlist = session('wishlist', []);

            if (in_array($itemID, $wishlist)) {
                // If the item exists in the session, remove it
                $wishlist = array_diff($wishlist, [$itemID]);
                session(['wishlist' => $wishlist]);
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from wishlist.',
                    'wishlistCount' => count($wishlist),
                ]);
            } else {
                // Call addToWishlist for guest users
                return $this->addToWishlist($request);
            }
        }
    }



    /**
     * Get wishlist count.
     */
    public function getWishlistCount()
    {
        if (Auth::check()) {
            // Authenticated user: Count items in the wishlist table
            $wishlistCount = Wishlist::where('UserID', Auth::id())->count();
        } else {
            // Guest user: Count items in the session
            $wishlistCount = count(session('wishlist', []));
        }

        return response()->json(['wishlistCount' => $wishlistCount]);
    }
    public function viewWishlist()
    {
        if (Auth::check()) {
            // Authenticated User: Fetch wishlist from the database
            $wishlistItems = Wishlist::with('item')
                ->where('UserID', Auth::id())
                ->get()
                ->map(function ($wishlist) {
                    return [
                        'ItemID' => $wishlist->ItemID,
                        'item'   => $wishlist->item ? $wishlist->item->toArray() : null,
                    ];
                });
        } else {
            // Guest User: Fetch wishlist from the session
            $wishlist = session('wishlist', []);
            $wishlistItems = collect($wishlist)->map(function ($itemId) {
                $item = Item::find($itemId);
                return [
                    'ItemID' => $itemId,
                    'item'   => $item ? $item->toArray() : null,
                ];
            });
        }

        return view('wishlist', compact('wishlistItems'));
    }
}
