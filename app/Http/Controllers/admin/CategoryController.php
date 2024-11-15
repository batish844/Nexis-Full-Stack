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
        $categoryfilter = $request->input('categoryfilter');

        
        if ($categoryfilter === 'asc') {
            $query->orderBy('items_count', 'asc');
        } elseif ($categoryfilter === 'desc') {
            $query->orderBy('items_count', 'desc');
        }
        $categories = $query->withCount('items')->get();

        return view('admin.categories.rows', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
        $category=Category::findorfail($id);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:50'
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'Name' => $request->name,
            'Description' => $request->description
        ]);
        return redirect()->route('categories.index')->with('success', "{$category->Name} updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
