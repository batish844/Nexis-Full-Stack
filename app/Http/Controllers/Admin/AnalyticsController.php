<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;


class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.analytics.index');
    }

    public function getData(Request $request)
    {
        try {
            $startDateInput = $request->input('startDate');
            $endDateInput = $request->input('endDate');

            $startDate = $startDateInput ? Carbon::parse($startDateInput) : Carbon::now()->subMonth();
            $endDate = $endDateInput ? Carbon::parse($endDateInput) : Carbon::now();

            $orders = Order::with(['orderItems.item', 'user'])
                ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->get();

            $totalOrders = $orders->count();

            $totalRevenue = 0;
            $totalProfit = 0;

            foreach ($orders as $order) {
                foreach ($order->orderItems as $orderItem) {
                    $lineTotal = $orderItem->TotalPrice; 
                    $totalRevenue += $lineTotal;
                    $totalProfit += $lineTotal * 0.2; 
                }
            }

            $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

            $statusCounts = $orders->groupBy('Status')->map(function ($statusGroup) {
                return $statusGroup->count();
            });

            $dailyData = $orders->groupBy(function ($order) {
                return $order->created_at->format('Y-m-d');
            })->map(function ($dailyOrders) {
                $dailyTotalRevenue = 0;
                foreach ($dailyOrders as $order) {
                    foreach ($order->orderItems as $orderItem) {
                        $dailyTotalRevenue += $orderItem->TotalPrice;
                    }
                }
                return [
                    'totalOrders' => $dailyOrders->count(),
                    'totalRevenue' => $dailyTotalRevenue,
                ];
            });

            // Fetch best-selling products
            $bestSellingProducts = OrderItem::with('item')
                ->whereHas('order', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);
                })
                ->select('ItemID', DB::raw('SUM("Quantity") as totalQuantity'))
                ->groupBy('ItemID')
                ->orderByDesc('totalQuantity')
                ->take(5)
                ->get()
                ->map(function ($orderItem) {
                    return [
                        'name' => $orderItem->item->Name,
                        'totalQuantity' => $orderItem->totalQuantity,
                        'photo' => $orderItem->item->Photo[0] ?? null,
                    ];
                });

            $periodDays = $startDate->diffInDays($endDate) + 1;
            $previousStartDate = (clone $startDate)->subDays($periodDays);
            $previousEndDate = (clone $startDate)->subDay();

            $previousOrders = Order::with(['orderItems'])
                ->whereBetween('created_at', [$previousStartDate->startOfDay(), $previousEndDate->endOfDay()])
                ->get();

            $previousTotalRevenue = 0;
            foreach ($previousOrders as $order) {
                foreach ($order->orderItems as $orderItem) {
                    $previousTotalRevenue += $orderItem->TotalPrice;
                }
            }

            if ($previousTotalRevenue > 0) {
                $revenueComparison = (($totalRevenue - $previousTotalRevenue) / $previousTotalRevenue) * 100;
            } else {
                $revenueComparison = null;
            }

            $topCustomers = Order::with('user')
                ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->whereHas('user', function ($query) {
                    $query->where('email', '!=', 'guest@guest.com');
                })
                ->select('OrderedBy', DB::raw('COUNT(*) as orders'), DB::raw('SUM(TotalPrice) as total_spent'))
                ->groupBy('OrderedBy')
                ->orderByDesc('total_spent')
                ->take(5)
                ->get()
                ->map(function ($order) {
                    return [
                        'customer' => $order->user->First_Name . ' ' . $order->user->Last_Name,
                        'orders' => $order->orders,
                        'total_spent' => round($order->total_spent, 2),
                    ];
                });
            return response()->json([
                'totalOrders' => $totalOrders,
                'totalRevenue' => round($totalRevenue, 2),
                'averageOrderValue' => round($averageOrderValue, 2),
                'profit' => round($totalProfit, 2),
                'statusCounts' => $statusCounts,
                'dailyData' => $dailyData,
                'bestSellingProducts' => $bestSellingProducts,
                'revenueComparison' => $revenueComparison,
                'topCustomers' => $topCustomers,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
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
        //
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
        //
    }
}
