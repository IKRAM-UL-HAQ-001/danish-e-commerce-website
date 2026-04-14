<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // Daily Sales (Last 7 Days)
        $dailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->where('status', 'completed')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Monthly Sales (This year)
        $monthlySales = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total')
        )
        ->where('created_at', '>=', Carbon::now()->startOfYear())
        ->where('status', 'completed')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Growth metrics
        $currentMonthSales = Order::whereMonth('created_at', Carbon::now()->month)->where('status', 'completed')->sum('total_price');
        $lastMonthSales = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status', 'completed')->sum('total_price');
        
        $monthGrowth = $lastMonthSales > 0 ? (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100 : 0;

        return view('dashboard.charts.index', compact('dailySales', 'monthlySales', 'currentMonthSales', 'monthGrowth'));
    }
}
