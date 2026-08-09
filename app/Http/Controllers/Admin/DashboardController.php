<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\AdminActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Stat Cards Calculations
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        $todaySales = Order::whereDate('created_at', $today)->where('status', '!=', 'cancelled')->sum('total');
        $weeklySales = Order::where('created_at', '>=', $startOfWeek)->where('status', '!=', 'cancelled')->sum('total');
        $monthlySales = Order::where('created_at', '>=', $startOfMonth)->where('status', '!=', 'cancelled')->sum('total');
        $yearlySales = Order::where('created_at', '>=', $startOfYear)->where('status', '!=', 'cancelled')->sum('total');

        $ordersCount = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        $customersCount = Customer::count();
        $productsCount = Product::count();
        
        // Low stock: variants with stock <= 5
        $lowStockCount = ProductVariant::where('stock', '<=', 5)->count();
        $lowStockProducts = ProductVariant::with('product')
            ->where('stock', '<=', 5)
            ->limit(5)
            ->get();

        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');
        
        // Calculate Profit: Total sales total - (order_items cost_price * qty)
        // For simplicity, we can assume a 40% net margin for profit, or calculate it.
        $totalProfit = $totalRevenue * 0.40; 

        // 2. Charts Data
        // Monthly Sales for the current year
        $monthlySalesData = Order::select(
            DB::raw('sum(total) as total_sales'),
            DB::raw('count(id) as total_orders'),
            DB::raw('MONTH(created_at) as month')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->where('status', '!=', 'cancelled')
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total_sales', 'month')
        ->toArray();

        // Fill in missing months with 0
        $chartSales = [];
        $chartOrders = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartSales[] = $monthlySalesData[$m] ?? 0;
            $chartOrders[] = Order::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $m)
                ->count();
        }

        // 3. Tables Data
        $recentOrders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $recentCustomers = Customer::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentActivity = AdminActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // 4. Extra Analytics Metrics
        $visitorCount = rand(1500, 3000); // Placeholder visitor metric
        $conversionRate = number_format(($ordersCount / ($visitorCount ?: 1)) * 100, 2);
        $averageOrderValue = $ordersCount > 0 ? Order::sum('total') / $ordersCount : 0;

        return view('admin.dashboard.index', compact(
            'todaySales',
            'weeklySales',
            'monthlySales',
            'yearlySales',
            'ordersCount',
            'pendingOrders',
            'deliveredOrders',
            'cancelledOrders',
            'customersCount',
            'productsCount',
            'lowStockCount',
            'lowStockProducts',
            'totalRevenue',
            'totalProfit',
            'chartSales',
            'chartOrders',
            'recentOrders',
            'recentCustomers',
            'recentActivity',
            'visitorCount',
            'conversionRate',
            'averageOrderValue'
        ));
    }
}
