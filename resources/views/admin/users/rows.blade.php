@foreach($users as $user)
<tr class="hover:bg-gray-100 transition duration-200">
    <td class="px-6 py-4 flex items-center">
        <div class="ml-4">
            <div class="text-sm font-bold text-gray-800">{{ $user->first_name }}</div>
            <div class="text-sm text-gray-600">{{ $user->last_name }}</div>
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="text-sm text-gray-600">{{ $user->email }}</div>
    </td>
    {{-- <td class="px-6 py-4">
        <div class="text-sm text-gray-600">{{ $user->password }}</div> <!-- Hashed password -->
    </td> --}}
    <td class="px-6 py-4">
        <div class="flex space-x-2">
            <!-- Edit Link -->
            <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-800">
                View & Edit
            </a>
            <!-- Delete Form -->
            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">
                    Delete
                </button>
            </form>
        </div>
    </td>
</tr>
@endforeach

@if ($users->isEmpty())
<tr>
    <td colspan="4" class="text-center py-4">No users found.</td>
</tr>
@endif
