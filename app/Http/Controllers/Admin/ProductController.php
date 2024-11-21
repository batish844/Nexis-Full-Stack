<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use PDO;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;

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
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=products.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Name', 'Category', 'Price', 'Quantity', 'Availability']);

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
    public function toggleStatus(string $id)
    {
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
        $product = Item::findorfail($id);
        $product->Photo = json_decode($product->Photo, true);
        $product->Size = json_decode($product->Size, true);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  Product ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,CategoryID',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'sizes' => 'array',
            'sizes.*' => 'in:S,M,L,XL',
            'existing_photos' => 'array',
            'existing_photos.*' => 'string', // Ensure photo paths are strings
            'new_photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust max size as needed
        ]);

        // Retrieve the product
        $product = Item::findOrFail($id);

        Log::info("Full request data:", $request->all());

        // Handle existing photos
        $existingPhotos = $request->input('existing_photos', []);
        Log::info("Existing Photos:", ['photos' => $existingPhotos]);

        // Decode current photos from DB (handled by model casting)
        $currentPhotos = $product->Photo ?? [];
        Log::info("Current Photos in DB:", ['current_photos' => $currentPhotos]);

        // Photos to remove
        $currentPhotos = json_decode($product->Photo, true) ?? [];
        $removedPhotos = array_diff($currentPhotos, $existingPhotos);
        foreach ($removedPhotos as $photo) {
            $photoPath = public_path($photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
                Log::info("Deleted Photo: $photoPath");
            } else {
                Log::warning("Photo not found for deletion: $photoPath");
            }
        }

        // Prepare new photos array
        $newPhotos = [];

        // Handle new photos
        if ($request->hasFile('new_photos')) {
            $files = $request->file('new_photos');
            Log::info('Files in request:', ['files' => $files]);

            foreach ($files as $file) {
                if ($file->isValid()) {
                    // Generate folder and filename
                    $category = Category::findOrFail($request->input('category_id'));
                    $gender = strtolower($category->Gender == 'M' ? 'men' : 'women');
                    $categoryName = strtolower(str_replace(' ', '_', $category->Name));
                    $productName = strtolower(str_replace(' ', '_', $request->input('name')));

                    $folderPath = 'storage/img/' . $gender . '/' . $categoryName . '/' . $productName . '/';
                    $fullFolderPath = public_path($folderPath);

                    if (!file_exists($fullFolderPath)) {
                        mkdir($fullFolderPath, 0777, true);
                        Log::info("Created directory: $fullFolderPath");
                    }

                    $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($fullFolderPath, $fileName);

                    $newPhotoPath = $folderPath . $fileName;
                    $newPhotos[] = $newPhotoPath;
                    Log::info("Uploaded file: {$newPhotoPath}");
                } else {
                    Log::error("File upload error for file: " . $file->getClientOriginalName());
                }
            }
        } else {
            Log::info("No new photos uploaded");
        }

        // Update the photos in the DB
        $finalPhotos = array_merge($existingPhotos, $newPhotos);
        Log::info("Final Photos Array:", ['final_photos' => $finalPhotos]);
        $product->Photo = $finalPhotos;

        // Handle sizes
        $sizes = $request->input('sizes', []);
        Log::info("Sizes in request:", ['sizes' => $sizes]);
        $product->Size = $sizes;
        Log::info("Updated Sizes:", ['sizes' => $sizes]);

        // Update other fields
        $product->Name = $request->input('name');
        $product->CategoryID = $request->input('category_id');
        $product->Price = $request->input('price');
        $product->Quantity = $request->input('quantity');

        // Save the product
        $product->save();

        Log::info("Product updated successfully.", ['Product ID' => $product->ItemID]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
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
