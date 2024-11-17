@foreach ($users as $user)
    <tr class="bg-white hover:bg-gray-100">
        <td class="px-6 py-4 text-gray-800">
            {{ $user->First_Name }} {{ $user->Last_Name }}
        </td>
        <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
        <td class="px-6 py-4 text-gray-800">{{ $user->Phone_Number }}</td>
        <td class="px-6 py-4">
            <div class="flex space-x-2">
                @if($user->isAdmin == 1)
                <!-- Show View, Edit, and Delete for Admin -->
                <a href="{{ route('users.show', $user->UserID) }}" 
                    class="text-blue-600 hover:text-blue-800">View</a>
                @else
                <!-- Show only View for Customer -->
                <a href="{{ route('users.show', $user->UserID) }}" 
                    class="text-blue-600 hover:text-blue-800">View</a>
                @endif
            </div>
        </td>
    </tr>
@endforeach
