@extends('admin.layouts.sidebar')

@section('content')
<div class="container p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Message Details</h1>
        <a href="{{ route('messages.index') }}"
            class="text-white bg-blue-600 px-5 py-3 rounded-lg shadow hover:bg-blue-700 transition-all focus:outline-none focus:ring-2 focus:ring-blue-400">
            ← Back
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-lg border mb-10 p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10">
            <div>
                <h2 class="text-sm font-bold text-blue-700 uppercase mb-2">Full Name</h2>
                <p class="text-xl font-semibold text-gray-800">{{ $message->Full_Name }}</p>
            </div>
            <div>
                <h2 class="text-sm font-bold text-blue-700 uppercase mb-2">Email</h2>
                <p class="text-xl font-semibold text-gray-800">{{ $message->Email }}</p>
            </div>
            <div class="sm:col-span-2">
                <h2 class="text-sm font-bold text-blue-700 uppercase mb-2">Message</h2>
                <p class="text-lg text-gray-800 whitespace-pre-wrap">{{ $message->Message }}</p>
            </div>
            <div>
                <h2 class="text-sm font-bold text-blue-700 uppercase mb-2">Received At</h2>
                <p class="text-xl font-semibold text-gray-800">{{ $message->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div>
                <h2 class="text-sm font-bold text-blue-700 uppercase mb-2">Status</h2>
                <p class="text-xl font-semibold text-gray-800">
                    {{ $message->is_read ? 'Read' : 'Unread' }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection