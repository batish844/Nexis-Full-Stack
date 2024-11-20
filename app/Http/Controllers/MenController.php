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
        if (request()->expectsJson()) {
            $menItems = Item::where('Gender', 'Men')
                ->where('isAvailable', true)
                ->get();

            $formattedItems = $menItems->map(function ($item) {
                $category = Category::find($item->CategoryID);
                $categoryName = $category ? $category->Name : 'Unknown';

                return [
                    'ItemID' => $item->ItemID,
                    'Name' => $item->Name,
                    'Price' => $item->Price,
                    'Points' => $item->Points,
                    'Category' => $categoryName,
                    'Photos' => $this->getPhotos($item, $categoryName),
                ];
            });

            return response()->json($formattedItems);
        }

        return view('men.index');
    }

    public function getPhotos($item, $categoryName)
    {
        $photos = [];
        for ($i = 1; $i <= 3; $i++) {
            $photoPath = "storage/img/men/{$categoryName}/{$item->Name}/p{$i}.png";
            $photos[] = $photoPath;
        }
        return $photos;
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
