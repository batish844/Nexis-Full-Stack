<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $role = $request->get('role', 'all');
        $users = User::query();

        
        // Search filter
        if ($request->has('search') && $request->search != '') {
            $users = $users->where('First_Name', 'like', '%' . $request->search . '%')
                ->orWhere('Last_Name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('Phone_Number', 'like', '%' . $request->search . '%');
        }

        // Role filter
        if ($role != 'all') {
            if ($role === 'admin') {
                $users = $users->where('isAdmin', 1); // Only Admins
            } elseif ($role === 'customer') {
                $users = $users->where('isAdmin', 0); // Only Customers
            }
        }

        // Sorting: sort by name (ascending or descending)
        if ($request->has('nameOrder')) {
            $users = $users->orderBy('First_Name', $request->nameOrder);
        }

        // Fetch users
        $users = $users->get();

        // Check if AJAX request is made
        if ($request->ajax()) {
            return view('admin.users.rows', compact('users')); // Return the partial view for AJAX
        }

        return view('admin.users.index', compact('users', 'role'));
    }



    /**
     * Search users by first name or last name with alphabetical ordering.
     */
    public function search(Request $request)
    {
        $query = User::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $query->where('First_Name', 'like', '%' . $request->search . '%')
                ->orWhere('Last_Name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Role filter
        if ($request->role && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        // Sort order
        if ($request->has('nameOrder')) {
            $query->orderBy('First_Name', $request->nameOrder);
        }

        // Fetch users and return rows
        $users = $query->get();
        return view('admin.users.rows', compact('users')); // Return the updated rows
    }




    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'First_Name' => 'required|string|max:50',
            'Last_Name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'Phone_Number' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user as admin
        $user = User::create([
            'First_Name' => $request->First_Name,
            'Last_Name' => $request->Last_Name,
            'email' => $request->email,
            'Phone_Number' => $request->Phone_Number,
            'password' => bcrypt($request->password),
            'isAdmin' => 1, // Always admin
        ]);

        return redirect()->route('users.index')->with('success', 'Admin created successfully');
    }




    /**
     * Display the specified user.
     */
    public function show(string $UserID)
    {
        // Fetch the user from the database
        $user = User::findOrFail($UserID);
    
        // Decode the address JSON
        $address = json_decode($user->address);
    
        // Concatenate the address fields
        $user->Full_Address = $this->concatAddress($address);
    
        // Concatenate the full name
        $user->Full_Name = "{$user->First_Name} {$user->Last_Name}";
    
        return view('admin.users.show', compact('user'));
    }
    
    private function concatAddress($address)
    {
        // Check if the address object is valid and then concatenate
        if (is_object($address)) {
            return trim(
                ($address->street_address ? $address->street_address . ', ' : '') .
                ($address->building ? $address->building . ', ' : '') .
                ($address->city ?? '')
            , ', ');
        }
        return '';
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($UserID)
    {
        $user = User::findOrFail($UserID);
        return view('admin.users.edit', compact('user'));
    }


    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $UserID)
    {
        $request->validate([
            'First_Name' => 'required|string|max:50',
            'Last_Name' => 'required|string|max:50',
            'Phone_Number' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $UserID . ',UserID',
        ]);

        $user = User::findOrFail($UserID);
        $user->update([
            'First_Name' => $request->First_Name,
            'Last_Name' => $request->Last_Name,
            'Phone_Number' => $request->Phone_Number,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', "{$user->First_Name} {$user->Last_Name} updated successfully");
    }


    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $UserID)
    {
        $user = User::findOrFail($UserID);
        $user->delete();
        return redirect()->route('users.index')->with('error', "{$user->First_Name} {$user->Last_Name} deleted successfully");
    }
}
