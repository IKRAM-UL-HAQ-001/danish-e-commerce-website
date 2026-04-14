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

            // Quick Analysis Chart (Last 7 Days Sales)
            $chartData = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

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
}
