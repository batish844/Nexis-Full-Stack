<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Your index logic if needed
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'ItemID'   => 'required|exists:items,ItemID',
            'Size'     => 'required|string|in:S,M,L,XL',
            'Quantity' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($validatedData['ItemID']);
        if (Auth::check()) {
            $user = Auth::user();

            $totalQuantityInCart = Cart::where('UserID', $user->UserID)
                ->where('ItemID', $validatedData['ItemID'])
                ->sum('Quantity');

            $newTotalQuantity = $totalQuantityInCart + $validatedData['Quantity'];

            if ($newTotalQuantity > $item->Quantity) {
                $remainingStock = $item->Quantity - $totalQuantityInCart;
                return response()->json([
                    'success' => false,
                    'message' => "Only $remainingStock items remaining in stock.",
                ]);
            }

            $cartEntry = Cart::where('UserID', $user->UserID)
                ->where('ItemID', $validatedData['ItemID'])
                ->where('Size', $validatedData['Size'])
                ->first();

            if ($cartEntry) {
                $cartEntry->Quantity += $validatedData['Quantity'];
                $cartEntry->save();
            } else {
                Cart::create([
                    'UserID'   => $user->UserID,
                    'ItemID'   => $validatedData['ItemID'],
                    'Size'     => $validatedData['Size'],
                    'Quantity' => $validatedData['Quantity'],
                ]);
            }

            $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

            $remainingStock = $item->Quantity - $newTotalQuantity;

            return response()->json([
                'success'        => true,
                'message'        => "Successfully added {$validatedData['Quantity']} items of size {$validatedData['Size']} to the cart.",
                'remainingStock' => $remainingStock,
                'cartCount'      => $totalCartCount,
            ]);
        }
        $cart = session('cart', []);
        $itemKey = "{$validatedData['ItemID']}_{$validatedData['Size']}";

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['Quantity'] += $validatedData['Quantity'];
        } else {
            $cart[$itemKey] = [
                'ItemID'   => $validatedData['ItemID'],
                'Size'     => $validatedData['Size'],
                'Quantity' => $validatedData['Quantity'],
                'Price'    => $item->Price,
            ];
        }
        $totalQuantityInCart = array_reduce($cart, function ($carry, $cartItem) use ($validatedData) {
            return $carry + ($cartItem['ItemID'] == $validatedData['ItemID'] ? $cartItem['Quantity'] : 0);
        }, 0);

        if ($totalQuantityInCart > $item->Quantity) {
            $remainingStock = $item->Quantity - ($totalQuantityInCart - $validatedData['Quantity']);
            return response()->json([
                'success' => false,
                'message' => "Only $remainingStock items remaining in stock.",
            ]);
        }

        session(['cart' => $cart]);
        $totalCartCount = array_sum(array_column($cart, 'Quantity'));

        $remainingStock = $item->Quantity - $totalQuantityInCart;

        return response()->json([
            'success'        => true,
            'message'        => "Successfully added {$validatedData['Quantity']} items of size {$validatedData['Size']} to the cart.",
            'remainingStock' => $remainingStock,
            'cartCount'      => $totalCartCount,
        ]);
    }

    public function viewCart()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $cartItems = Cart::with('item')->where('UserID', $user->UserID)->get();

            $totalPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->Quantity * $cartItem->item->Price;
            });

            $totalPoints = $cartItems->sum(function ($cartItem) {
                return $cartItem->Quantity * $cartItem->item->Points;
            });

            $addressJson = $user->address;
            $address = json_decode($addressJson, true);
            $Phone_Number = $user->Phone_Number;

            $availablePoints = $user->Points;

            return view('cart', compact(
                'cartItems',
                'Phone_Number',
                'totalPrice',
                'totalPoints',
                'address',
                'availablePoints'
            ));
        } else {
            $cart = session('cart', []);

            $cartItems = collect($cart)->map(function ($cartItem) {
                $item = Item::find($cartItem['ItemID']);

                return (object) [
                    'item' => $item,
                    'Size' => $cartItem['Size'],
                    'Quantity' => $cartItem['Quantity'],
                    'Price' => $item ? $item->Price : 0,
                    'Points' => $item ? $item->Points : 0,
                ];
            });

            $totalPrice = $cartItems->sum(function ($cartItem) {
                return $cartItem->Quantity * $cartItem->item->Price;
            });

            $totalPoints = $cartItems->sum(function ($cartItem) {
                return $cartItem->Quantity * $cartItem->item->Points;
            });

            $address = null;
            $Phone_Number = null;

            $availablePoints = 0;

            return view('cart', compact(
                'cartItems',
                'Phone_Number',
                'totalPrice',
                'totalPoints',
                'address',
                'availablePoints'
            ));
        }
    }

    public function getRemainingStock($itemID)
    {
        $item = Item::findOrFail($itemID);

        if (Auth::check()) {
            $user = Auth::user();

            $totalQuantityInCart = Cart::where('UserID', $user->UserID)
                ->where('ItemID', $itemID)
                ->sum('Quantity');
        } else {
            $cart = session('cart', []);

            $totalQuantityInCart = collect($cart)
                ->where('ItemID', $itemID)
                ->sum('Quantity');
        }

        $remainingStock = $item->Quantity - $totalQuantityInCart;

        return response()->json([
            'success'        => true,
            'remainingStock' => max($remainingStock, 0),
        ]);
    }


    public function updateCart(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'itemID' => 'required|integer|exists:items,ItemID',
                'size'   => 'required|string|in:S,M,L,XL',
                'action' => 'required|in:increment,decrement',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors'  => $e->errors(),
            ], 422);
        }

        $item = Item::findOrFail($validatedData['itemID']);

        if (Auth::check()) {
            $user = Auth::user();

            $cartEntry = Cart::where('UserID', $user->UserID)
                ->where('ItemID', $validatedData['itemID'])
                ->where('Size', $validatedData['size'])
                ->first();

            if (!$cartEntry) {
                return response()->json(['success' => false, 'message' => 'Cart item not found.'], 404);
            }

            $totalQuantityInCart = Cart::where('UserID', $user->UserID)
                ->where('ItemID', $item->ItemID)
                ->sum('Quantity');

            if ($validatedData['action'] === 'increment') {
                if ($totalQuantityInCart < $item->Quantity) {
                    $cartEntry->Quantity++;
                    $cartEntry->save();

                    $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

                    return response()->json([
                        'success'       => true,
                        'newQuantity'   => $cartEntry->Quantity,
                        'itemPrice'     => $item->Price,
                        'cartCount'     => $totalCartCount,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot add more items. Stock limit reached.',
                    ]);
                }
            }

            if ($validatedData['action'] === 'decrement') {
                if ($cartEntry->Quantity > 1) {
                    $cartEntry->Quantity--;
                    $cartEntry->save();

                    $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

                    return response()->json([
                        'success'       => true,
                        'newQuantity'   => $cartEntry->Quantity,
                        'itemPrice'     => $item->Price,
                        'cartCount'     => $totalCartCount,
                    ]);
                } else {
                    $cartEntry->delete();

                    $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

                    return response()->json([
                        'success'       => true,
                        'newQuantity'   => 0,
                        'itemPrice'     => $item->Price,
                        'cartCount'     => $totalCartCount,
                    ]);
                }
            }
        } else {
            $cart = session('cart', []);

            $cartKey = "{$validatedData['itemID']}_{$validatedData['size']}";
            $cartItem = $cart[$cartKey] ?? null;

            $totalQuantityInCart = collect($cart)->where('ItemID', $validatedData['itemID'])->sum('Quantity');

            if ($validatedData['action'] === 'increment') {
                if ($totalQuantityInCart < $item->Quantity) {
                    if ($cartItem) {
                        $cart[$cartKey]['Quantity']++;
                    } else {
                        $cart[$cartKey] = [
                            'ItemID'   => $validatedData['itemID'],
                            'Size'     => $validatedData['size'],
                            'Quantity' => 1,
                            'Price'    => $item->Price,
                        ];
                    }

                    session(['cart' => $cart]);

                    return response()->json([
                        'success'       => true,
                        'newQuantity'   => $cart[$cartKey]['Quantity'],
                        'itemPrice'     => $item->Price,
                        'cartCount'     => collect($cart)->sum('Quantity'),
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot add more items. Stock limit reached.',
                    ]);
                }
            }

            if ($validatedData['action'] === 'decrement') {
                if ($cartItem && $cartItem['Quantity'] > 1) {
                    $cart[$cartKey]['Quantity']--;
                } else {
                    unset($cart[$cartKey]);
                }

                session(['cart' => $cart]);

                return response()->json([
                    'success'       => true,
                    'newQuantity'   => $cart[$cartKey]['Quantity'] ?? 0,
                    'itemPrice'     => $item->Price,
                    'cartCount'     => collect($cart)->sum('Quantity'),
                ]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid action.'], 400);
    }


    public function getCartCount()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $totalCartCount = Cart::where('UserID', $user->UserID)->sum('Quantity');

            return response()->json(['cartCount' => $totalCartCount]);
        } else {
            $cart = session('cart', []);

            $totalCartCount = collect($cart)->sum('Quantity');

            return response()->json(['cartCount' => $totalCartCount]);
        }
    }
}
