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
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255|unique:items,Name',
            'category_id' => 'required|exists:categories,CategoryID',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'in:S,M,L,XL',
            'points' => 'required|integer|min:0',
            'new_photos' => 'required|array|min:1',
            'new_photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'image_order' => 'required|string', // Validate the image order input
            'description' => 'nullable|string',
        ]);

        // Create a new product instance
        $product = new Item();

        // Handle uploaded new photos
        $newPhotos = [];

        if ($request->hasFile('new_photos')) {
            $files = $request->file('new_photos');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $category = Category::findOrFail($request->input('category_id'));
                    $gender = strtolower($category->Gender == 'M' ? 'men' : 'women');
                    $categoryName = strtolower(str_replace(' ', '_', $category->Name));
                    $productName = strtolower(str_replace(' ', '_', $request->input('name')));

                    $folderPath = 'storage/img/' . $gender . '/' . $categoryName . '/' . $productName . '/';
                    $fullFolderPath = public_path($folderPath);

                    if (!file_exists($fullFolderPath)) {
                        mkdir($fullFolderPath, 0777, true);
                    }

                    $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($fullFolderPath, $fileName);

                    $newPhotoPath = $folderPath . $fileName;
                    $newPhotos[] = $newPhotoPath;
                }
            }
        }

        // Reorder photos based on `image_order`
        $imageOrder = json_decode($request->input('image_order'), true);
        $orderedPhotos = [];

        foreach ($imageOrder as $key) {
            if (strpos($key, 'new-') === 0) {
                $index = intval(substr($key, strlen('new-')));
                if (isset($newPhotos[$index])) {
                    $orderedPhotos[] = $newPhotos[$index];
                }
            }
        }

        // Assign the ordered photos to the product
        $product->Photo = json_encode($orderedPhotos); // Store as JSON string

        // Assign sizes
        $sizes = $request->input('sizes', []);
        $product->Size = json_encode($sizes); // Store as JSON string

        // Assign other product details
        $product->Name = $request->input('name');
        $product->CategoryID = $request->input('category_id');
        $product->Price = $request->input('price');
        $product->Points = $request->input('points');
        $product->Quantity = $request->input('quantity');
        $product->Description = $request->input('description');

        // Save the product
        $product->save();

        return redirect()->route('products.show', $product->ItemID)->with('success', 'Product created successfully.');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,CategoryID',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'points' => 'required|integer|min:0',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'in:S,M,L,XL',
            'existing_photos' => 'array',
            'existing_photos.*' => 'string',
            'new_photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'image_order' => 'required|string',
        ]);

        $product = Item::findOrFail($id);

        $existingPhotos = $request->input('existing_photos', []);

        $currentPhotos = $product->Photo ? json_decode($product->Photo, true) : [];

        $removedPhotos = array_diff($currentPhotos, $existingPhotos);
        foreach ($removedPhotos as $photo) {
            $photoPath = public_path($photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $newPhotos = [];

        if ($request->hasFile('new_photos')) {
            $files = $request->file('new_photos');
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $category = Category::findOrFail($request->input('category_id'));
                    $gender = strtolower($category->Gender == 'M' ? 'men' : 'women');
                    $categoryName = strtolower(str_replace(' ', '_', $category->Name));
                    $productName = strtolower(str_replace(' ', '_', $request->input('name')));

                    $folderPath = 'storage/img/' . $gender . '/' . $categoryName . '/' . $productName . '/';
                    $fullFolderPath = public_path($folderPath);

                    if (!file_exists($fullFolderPath)) {
                        mkdir($fullFolderPath, 0777, true);
                    }

                    $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($fullFolderPath, $fileName);

                    $newPhotoPath = $folderPath . $fileName;
                    $newPhotos[] = $newPhotoPath;
                }
            }
        }

        $finalPhotos = array_merge($existingPhotos, $newPhotos);

        $imageOrder = json_decode($request->input('image_order'), true);
        $orderedPhotos = [];
        foreach ($imageOrder as $key) {
            if (strpos($key, 'existing-') === 0) {
                $photoPath = substr($key, strlen('existing-'));
                if (in_array($photoPath, $finalPhotos)) {
                    $orderedPhotos[] = $photoPath;
                }
            } elseif (strpos($key, 'new-') === 0) {
                $index = intval(substr($key, strlen('new-')));
                if (isset($newPhotos[$index])) {
                    $orderedPhotos[] = $newPhotos[$index];
                }
            }
        }

        $product->Photo = $orderedPhotos;

        $sizes = $request->input('sizes', []);
        $product->Size = $sizes;

        $product->Name = $request->input('name');
        $product->CategoryID = $request->input('category_id');
        $product->Price = $request->input('price');
        $product->Quantity = $request->input('quantity');
        $product->Points = $request->input('points');
        $product->Description = $request->input('description');


        $product->save();

        return redirect()->route('products.show', $id)->with('success', 'Product updated successfully.');
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
