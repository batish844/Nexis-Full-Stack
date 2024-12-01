@forelse ($users as $user)
    <tr class="bg-white hover:bg-gray-100">
        <!-- Full Name -->
        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
            {{ $user->First_Name }} {{ $user->Last_Name }}
        </td>

        <!-- Email -->
        <td class="px-6 py-4 text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">
            {{ $user->email }}
        </td>

        <!-- Phone Number -->
        <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
            {{ $user->Phone_Number }}
        </td>

        <!-- Orders Count -->
        <td class="px-6 py-4 text-gray-800 text-center">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{ $user->orders_count ?? 0 }} <!-- Default to 0 if orders_count is null -->
        </span>
        </td>

        <!-- Total Points -->
        <td class="px-6 py-4 text-gray-800 text-center">
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            {{ $user->Points ?? 0 }} <!-- Default to 0 if Points is null -->
        </span>
        </td>

        <!-- Manage -->
        <td class="px-6 py-4">
            <div class="flex space-x-2">
                <!-- View -->
                <a href="{{ route('users.show', $user->UserID) }}" class="text-blue-600 hover:text-blue-800">
                <img src="{{ Storage::url('img/icons/list.png') }}" alt="Show" class="w-5 h-5 inline-block">
            Manage
            </a>
            </div>
        </td>
    </tr>
@empty
    <!-- No records found message -->
    <tr>
        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
            No users found.
        </td>
    </tr>
@endforelse
