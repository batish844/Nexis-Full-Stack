<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('items')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = Category::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
            $query->orderBy('items_count', 'desc');
        
        if ($request->filled('genderfilter') && $request->input('genderfilter') !== 'A') {
            $query->where('gender', $request->input('genderfilter'));
        }
        $categories = $query->withCount('items')->get();

        return view('admin.categories.rows', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|',
        ]);

        if (Category::where('name', $request->name)->exists()) {
            return redirect()->back()->with('error', 'The category name already exists.');
        }
        Category::create([
            'Name' => $request->name,
        ]);
        return redirect()->route('categories.index')->with('success', "{$request->name} created successfully");
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
        $category = Category::withCount('items')->findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'gender' => 'required|in:M,F,A',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'Name' => $request->name,
            'Gender' => $request->gender,
        ]);

        return redirect()->route('categories.index')->with('success', "{$category->Name} updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'The password is incorrect.',
        ]);

        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('error', "{$category->Name} category deleted successfully");
    }
}
