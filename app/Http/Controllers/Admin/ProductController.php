<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use PDO;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.products.index', compact('categories'));
    }
    public function search(Request $request)
    {
        $query = Item::query();

        if ($request->filled('name')) {
            $query->where('Name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('genderfilter') && $request->input('genderfilter') !== 'A') {
            $query->where('Gender', $request->input('genderfilter'));
        }
        if ($request->filled('categoryfilter') && $request->input('categoryfilter') !== 'all') {
            $query->where('CategoryID', $request->input('categoryfilter'));
        }
        if ($request->filled('availabilityfilter') && $request->input('availabilityfilter') !== 'all') {
            $query->where('isAvailable', $request->input('availabilityfilter'));
        }

        $products = $query->with('category')->get();

        foreach ($products as $product) {
            $product->Photo = json_decode($product->Photo, true);
        }

        return view('admin.products.rows', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function exportCsv()
    {
        // Set CSV headers
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=products.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        // Define a callback to write the CSV data
        $callback = function () {
            $file = fopen('php://output', 'w');

            // Add the CSV header row
            fputcsv($file, ['Name', 'Category', 'Price', 'Quantity', 'Availability']);

            // Fetch products and write each to the CSV
            $products = Item::with('category')->get();
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->Name,
                    $product->category->Name ?? 'N/A',
                    $product->Price,
                    $product->Quantity,
                    $product->isAvailable ? 'Available' : 'Unavailable',
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
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
        $product = Item::findorfail($id);
        $product->Photo = json_decode($product->Photo, true);
        return view('admin.products.show', compact('product'));
    }
    public function toggleStatus(string $id){
        $product = Item::findorfail($id);
        if ($product->isAvailable) {
            $product->isAvailable = false;
        } else {
            $product->isAvailable = true;
        }
        $product->save();
        return redirect()->back();
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
        $product = Item::findorfail($id);
        $product->delete();
        return redirect()->route('products.index')->with('error', "Product deleted successfully");

    }
}
