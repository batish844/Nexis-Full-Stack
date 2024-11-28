<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $role = $request->get('role', 'all');
        $status = $request->get('status', 'all');
        $search = $request->get('search', '');
        $nameOrder = $request->get('nameOrder', 'asc'); // Default to ascending order for names

        // Start the query
        $users = User::query();

        // Exclude the user with email "guest@guest.com"
        $users = $users->where('email', '!=', 'guest@guest.com');

        // Search filter
        if ($search) {
            $users = $users->where(function ($query) use ($search) {
                $query->where('First_Name', 'like', '%' . $search . '%')
                    ->orWhere('Last_Name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('Phone_Number', 'like', '%' . $search . '%');
            });
        }

        // Role filter
        if ($role !== 'all') {
            $isAdmin = ($role === 'admin') ? 1 : 0;
            $users = $users->where('isAdmin', $isAdmin);
        }

        // Status filter
        if ($status !== 'all') {
            $isActive = ($status === 'activated') ? 1 : 0;
            $users = $users->where('isActive', $isActive);
        }

        // Sorting by name
        if ($nameOrder) {
            $users = $users->orderBy('First_Name', $nameOrder);
        }

        // Eager load order counts with the users
        $users = $users->withCount('orders') // This will add the order count to each user
            ->paginate(10); // Pagination

        // Check if the request is AJAX
        if ($request->ajax()) {
            // Return the updated rows for the AJAX request
            return view('admin.users.rows', compact('users'));
        }

        // Return the full view with the necessary data
        return view('admin.users.index', compact('users', 'role', 'status', 'search', 'nameOrder'));
    }

    public function exportCsv()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['First Name', 'Last Name', 'Email', 'Phone Number', 'Address', 'Status', 'Role', 'Points', 'Item Count', 'Date Registered']);

            $users = User::all();
            foreach ($users as $user) {
                $address = json_decode($user->address);
                $user->Full_Address = $this->concatAddress($address);
            }

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->First_Name,
                    $user->Last_Name,
                    $user->email,
                    $user->Phone_Number,
                    $user->Full_Address,
                    $user->isActive ? 'Activated' : 'Deactivated',
                    $user->isAdmin ? 'Admin' : 'User',
                    $user->Points, // Assuming 'points' is a column in the users table
                    $user->orders_count, // Assuming 'items' is a relationship in the User model
                    $user->created_at->format('Y-m-d'), // Date registered
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
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
        // Fetch the user from the database with orders count
        $user = User::withCount('orders')->findOrFail($UserID);

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
                ($address->street_address ?? '') .
                    ($address->building ?? '') .
                    ($address->city ?? ''),
                ', '
            );
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

    /**
     * Toggle the active status of a user.
     */
    public function toggleStatus($UserID)
    {
        // Fetch the user from the database
        $user = User::findOrFail($UserID);

        // Toggle the isActive field
        $user->isActive = !$user->isActive;
        $user->save();

        // Return with a success message
        return redirect()->route('users.show', $user->UserID)
            ->with('status', $user->isActive ? "{$user->First_Name} Activated" : "{$user->First_Name} Deactivated");
    }
}
