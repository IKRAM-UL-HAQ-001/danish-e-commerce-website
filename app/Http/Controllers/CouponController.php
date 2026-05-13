<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $request->validate(['code' => 'required|string']);

        $coupon = Coupon::where('code', strtoupper(trim($request->code)))->where('status', true)->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid or inactive coupon code.'], 422);
        }

        if ($coupon->expiry_date && now()->gt($coupon->expiry_date)) {
            return response()->json(['success' => false, 'message' => 'This coupon has expired.'], 422);
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return response()->json(['success' => false, 'message' => 'This coupon has reached its usage limit.'], 422);
        }

        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => floatval($item['price']) * intval($item['quantity']));

        if ($coupon->min_order_value > 0 && $subtotal < $coupon->min_order_value) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum order of $' . number_format($coupon->min_order_value, 2) . ' required for this coupon.',
            ], 422);
        }

        $discount = $coupon->type === 'percent'
            ? round($subtotal * ($coupon->value / 100), 2)
            : min(floatval($coupon->value), $subtotal);

        session(['applied_coupon' => [
            'code'            => $coupon->code,
            'type'            => $coupon->type,
            'value'           => $coupon->value,
            'discount_amount' => $discount,
        ]]);

        return response()->json([
            'success'         => true,
            'code'            => $coupon->code,
            'type'            => $coupon->type,
            'value'           => $coupon->value,
            'discount_amount' => $discount,
            'message'         => 'Coupon applied! You save $' . number_format($discount, 2),
        ]);
    }

    public function remove(Request $request)
    {
        session()->forget('applied_coupon');
        return response()->json(['success' => true, 'message' => 'Coupon removed.']);
    }
}
