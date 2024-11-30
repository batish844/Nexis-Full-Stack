<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.item'])->orderBy('created_at', 'desc');

        if ($request->has('email') && $request->email) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('Email', $request->email);
            });
        }
        $orders = $query->get();
        $orders->each(function ($order) {
            $totalPrice = $order->orderItems->sum(function ($orderItem) {
                return $orderItem->Quantity * $orderItem->item->Price;
            });
            $order->TotalPrice = $totalPrice;
            $order->save();
        });


        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function exportCsv()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=orders.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Order ID', 'Customer Name', 'Email', 'Status', 'Total Price', 'Order Date', 'Items']);

            $orders = Order::with(['user', 'orderItems.item'])
                ->orderByRaw("FIELD(Status, 'Pending', 'Processing', 'Completed')")
                ->get();

            foreach ($orders as $order) {
                $items = $order->orderItems->map(function ($orderItem) {
                    return $orderItem->item->Name . ' (' . $orderItem->Size . ') x ' . $orderItem->Quantity;
                })->join('; ');

                fputcsv($file, [
                    $order->OrderID,
                    $order->user->First_Name . ' ' . $order->user->Last_Name,
                    $order->user->email,
                    $order->Status,
                    number_format($order->TotalPrice, 2),
                    $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : '####',
                    $items,
                ]);
            }

            fclose($file);
        };

        return new \Symfony\Component\HttpFoundation\StreamedResponse($callback, 200, $headers);
    }


    public function search(Request $request)
    {
        $query = Order::query();

        $query->with(['user', 'orderItems']);

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('First_Name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('Last_Name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('Email', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('Status', $request->input('status'));
        }

        if ($request->filled('userfilter') && $request->input('userfilter') !== 'all') {
            $userFilter = $request->input('userfilter');
            if ($userFilter === 'User') {
            $query->whereHas('user', function ($q) {
                $q->where('Email', '!=', 'guest@guest.com');
            });
            } elseif ($userFilter === 'Guest') {
            $query->whereHas('user', function ($q) {
                $q->where('Email', 'guest@guest.com');
            });
            }
        }
        
        $query->orderBy('created_at', 'desc');

        $orders = $query->get();

        return view('admin.orders.rows', compact('orders'));
    }

    public function create()
    {
        //
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
        $order = Order::with(['user', 'orderItems.item'])->findOrFail($id);
        $totalPrice = $order->orderItems->sum(function ($orderItem) {
            return $orderItem->Quantity * $orderItem->item->Price;
        });
        $order->TotalPrice = $totalPrice;
        foreach ($order->orderItems as $orderItem) {
            $orderItem->TotalPrice = $orderItem->item->Price * $orderItem->Quantity;
            $orderItem->save();
        }
        $order->save();
        return view('admin.orders.show', compact('order'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Completed,Cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->Status = $request->status;
        $order->save();

        return redirect()->route('orders.show', $id)->with('success', 'Order status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
