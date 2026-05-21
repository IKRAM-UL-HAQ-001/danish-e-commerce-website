<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin Stats
            $totalUsers = User::where('role', 'buyer')->count();
            $totalProducts = Product::count();
            $totalOrders = Order::count();
            $totalRevenue = Order::where('status', 'completed')->sum('total_price');

            // Most Sold Product
            $mostSoldProduct = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'))
                ->groupBy('product_id')
                ->orderBy('total_qty', 'desc')
                ->with('product')
                ->first();

            // Last 7 calendar days (incl. today): one point per day, 0 if no orders.
            // Includes pending/processing so Stripe checkouts show before webhook marks completed.
            $chartData = $this->weeklySalesChartData();

            return view('dashboard.dashboard', compact(
                'totalUsers', 
                'totalProducts', 
                'totalOrders', 
                'totalRevenue', 
                'mostSoldProduct',
                'chartData'
            ));
        } else {
            // Buyer Stats
            $totalMyOrders = Order::where('user_id', $user->id)->count();
            $totalSpent = Order::where('user_id', $user->id)->where('status', 'completed')->sum('total_price');
            $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
            
            $recentOrders = Order::where('user_id', $user->id)->latest()->take(5)->get();

            return view('dashboard.buyer.index', compact('totalMyOrders', 'totalSpent', 'pendingOrders', 'recentOrders'));
        }
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.orders.my_orders', compact('orders'));
    }

    /**
     * Revenue by day for the last 7 days, always 7 rows (missing days = 0).
     */
    private function weeklySalesChartData()
    {
        $start = Carbon::now()->subDays(6)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $rows = Order::query()
            ->selectRaw('DATE(created_at) as sale_date')
            ->selectRaw('SUM(total_price) as total')
            ->whereBetween('created_at', [$start, $end])
            ->whereNotIn('status', ['cancelled'])
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at)')
            ->get();

        $byDay = [];
        foreach ($rows as $row) {
            $key = Carbon::parse($row->sale_date)->toDateString();
            $byDay[$key] = (float) $row->total;
        }

        $chartData = collect();
        for ($i = 0; $i < 7; $i++) {
            $day = $start->copy()->addDays($i);
            $key = $day->toDateString();
            $chartData->push((object) [
                'date' => $day->format('D M j'),
                'total' => round($byDay[$key] ?? 0, 2),
            ]);
        }

        return $chartData;
    }
}
