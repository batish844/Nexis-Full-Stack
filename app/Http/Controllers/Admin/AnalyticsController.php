<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
            $endDateInput   = $request->input('endDate');

            $startDate = $startDateInput ? Carbon::parse($startDateInput) : Carbon::now()->subMonth();
            $endDate   = $endDateInput ? Carbon::parse($endDateInput) : Carbon::now();

            // Fetch orders within the date range
            $orders = Order::with(['orderItems.item', 'user'])
                ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->get();

            $totalOrders = $orders->count();

            $totalRevenue = 0;
            $totalProfit  = 0;

            // Calculate total revenue and profit
            foreach ($orders as $order) {
                foreach ($order->orderItems as $orderItem) {
                    $lineTotal     = $orderItem->TotalPrice;
                    $totalRevenue += $lineTotal;
                    $totalProfit  += $lineTotal * 0.2; // Assuming 20% profit margin
                }
            }

            $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

            // Count orders by status
            $statusCounts = $orders->groupBy('Status')->map(function ($statusGroup) {
                return $statusGroup->count();
            });

            // Daily data for charts
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
                    'totalOrders'  => $dailyOrders->count(),
                    'totalRevenue' => $dailyTotalRevenue,
                ];
            });

            // Best selling products
            $quantityColumn = DB::getQueryGrammar()->wrap('Quantity');
            $itemIDColumn = DB::getQueryGrammar()->wrap('ItemID');

            $bestSellingProducts = OrderItem::select('ItemID')
                ->selectRaw("SUM($quantityColumn) as total_quantity")
                ->whereHas('order', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('orders.created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);
                })
                ->groupBy('ItemID')
                ->orderByRaw("SUM($quantityColumn) DESC")
                ->take(5)
                ->with(['item' => function ($query) {
                    $query->select('ItemID', 'Name', 'Photo');
                }])
                ->get()
                ->map(function ($orderItem) {
                    $item = $orderItem->item;
                    return [
                        'name'          => optional($item)->Name ?? 'Unknown',
                        'totalQuantity' => $orderItem->total_quantity,
                        'photo'         => optional($item)->Photo[0] ?? null,
                    ];
                });

            // Revenue comparison with previous period
            $periodDays        = $startDate->diffInDays($endDate) + 1;
            $previousStartDate = (clone $startDate)->subDays($periodDays);
            $previousEndDate   = (clone $startDate)->subDay();

            $previousOrders = Order::with(['orderItems'])
                ->whereBetween('created_at', [$previousStartDate->startOfDay(), $previousEndDate->endOfDay()])
                ->get();

            $previousTotalRevenue = 0;
            foreach ($previousOrders as $order) {
                foreach ($order->orderItems as $orderItem) {
                    $previousTotalRevenue += $orderItem->TotalPrice;
                }
            }

            $revenueComparison = $previousTotalRevenue > 0
                ? (($totalRevenue - $previousTotalRevenue) / $previousTotalRevenue) * 100
                : null;

            // Fetch top customers
            $totalPriceColumn = DB::getQueryGrammar()->wrap('TotalPrice');

            $topCustomers = Order::select(
                'OrderedBy',
                DB::raw('COUNT(*) as orders_count'),
                DB::raw("SUM($totalPriceColumn) as total_spent")
            )
                ->with(['user' => function ($query) {
                    $query->select('UserID', 'First_Name', 'Last_Name', 'email');
                }])
                ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                ->whereHas('user', function ($query) {
                    $query->where('email', '!=', 'guest@guest.com');
                })
                ->groupBy('OrderedBy')
                ->orderByRaw("SUM($totalPriceColumn) DESC")
                ->take(5)
                ->get()
                ->map(function ($order) {
                    $customer = $order->user;
                    return [
                        'customer'    => optional($customer)->First_Name . ' ' . optional($customer)->Last_Name,
                        'orders'      => $order->orders_count,
                        'total_spent' => round($order->total_spent, 2),
                    ];
                });

            return response()->json([
                'totalOrders'         => $totalOrders,
                'totalRevenue'        => round($totalRevenue, 2),
                'averageOrderValue'   => round($averageOrderValue, 2),
                'profit'              => round($totalProfit, 2),
                'statusCounts'        => $statusCounts,
                'dailyData'           => $dailyData,
                'bestSellingProducts' => $bestSellingProducts,
                'revenueComparison'   => $revenueComparison,
                'topCustomers'        => $topCustomers,
            ]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Analytics getData error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching analytics data.'], 500);
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
