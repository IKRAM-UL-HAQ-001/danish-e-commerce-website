<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('dashboard.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        Coupon::create($request->all());

        return back()->with('success', 'Coupon created successfully.');
    }

    public function update(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->firstOrFail();
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $coupon->update($request->all());

        return back()->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->firstOrFail();
        $coupon->delete();
        return back()->with('success', 'Coupon deleted successfully.');
    }
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->code)->where('status', true)->first();
        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code'], 404);
        }

        // Determine discount amount based on type
        $discount = 0;
        if ($coupon->type === 'percent') {
            // percentage of subtotal will be calculated client-side, send percent value
            $discount = $coupon->value; // e.g., 10 for 10%
        } else { // fixed
            $discount = $coupon->value; // fixed amount
        }

        return response()->json([
            'success' => true,
            'type' => $coupon->type,
            'value' => $discount,
            'message' => 'Coupon applied',
        ]);
    }
}
