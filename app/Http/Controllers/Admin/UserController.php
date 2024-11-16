<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all users with first and last names
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Search users by first name or last name with alphabetical ordering.
     */
    public function search(Request $request)
{
    $query = User::query();

    // Search by first name or last name
    if ($request->filled('name')) {
        $query->where(function($query) use ($request) {
            $query->where('first_name', 'like', '%' . $request->name . '%')
                  ->orWhere('last_name', 'like', '%' . $request->name . '%');
        });
    }

    // Sort by name in ascending or descending order
    $sortOrder = $request->input('nameOrder', 'asc');
    $query->orderBy('first_name', $sortOrder);

    $users = $query->get();

    // Return the rows view with the search results
    return view('admin.users.rows', compact('users'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'First_Name' => 'required|string|max:50',
            'Last_Name'  => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'First_Name' => $request->First_Name,
            'Last_Name'  => $request->Last_Name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'First_Name' => 'required|string|max:50',
            'Last_Name'  => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email,' . $id,
            'password'   => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'First_Name' => $request->First_Name,
            'Last_Name'  => $request->Last_Name,
            'email'      => $request->email,
            'password'   => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', "{$user->First_Name} {$user->Last_Name} updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', "{$user->First_Name} {$user->Last_Name} deleted successfully");
    }
}
