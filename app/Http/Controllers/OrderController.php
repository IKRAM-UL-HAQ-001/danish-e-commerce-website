<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request)
    {
        $order = Order::where('order_number', $request->order_number)->firstOrFail();
        $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', "Order #{$order->order_number} status updated to {$request->status}.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $order = Order::where('order_number', $request->order_number)->firstOrFail();
        $order->delete();
        return back()->with('success', 'Order deleted successfully.');
    }
}
