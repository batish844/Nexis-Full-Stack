<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.messages.index');
    }

    public function exportCsv()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=messages.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Name', 'Email', 'Message', 'Status', 'Received At']);

            $messages = Contact::all();
            foreach ($messages as $message) {
                fputcsv($file, [
                    $message->Full_Name,
                    $message->Email,
                    $message->Message,
                    $message->is_read ? 'Read' : 'Unread',
                    $message->created_at ? $message->created_at->format('Y-m-d') : '####',
                ]);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    public function search(Request $request)
    {
        $query = Contact::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('Full_Name', 'like', "%{$search}%")
                    ->orWhere('Email', 'like', "%{$search}%");
            });
        }

        if ($request->has('statusfilter') && $request->input('statusfilter') !== 'A') {
            $status = $request->input('statusfilter') === 'Read' ? 1 : 0;
            $query->where('is_read', $status);
        }

        $messages = $query->orderBy('created_at', 'desc')->get();

        return view('admin.messages.rows', compact('messages'));
    }
    public function markAsRead(Request $request)
    {
        $message = Contact::findOrFail($request->id);
        $message->is_read = !$message->is_read;
        $message->save();

        return redirect()->back()->with('success', 'Message status updated successfully.');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Contact::findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
    }
}
