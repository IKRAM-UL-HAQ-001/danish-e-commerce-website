@extends('frontend.layouts.app')
@section('title', 'Checkout')
@section('content')
    @php
        $appliedCoupon = session('applied_coupon');
        $couponApplied = is_array($appliedCoupon) && !empty($appliedCoupon['code'] ?? null);
    @endphp
    <div class="breadcumb">
        <div class="container rr-container-1895">
            <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
                <div class="breadcumb-wrapper__title">Check Out</div>
                <ul class="breadcumb-wrapper__items">
                    <li class="breadcumb-wrapper__items-list">
                        <i class="fa-regular fa-house"></i>
                    </li>
                    <li class="breadcumb-wrapper__items-list">
                        <i class="fa-regular fa-chevron-right"></i>
                    </li>
                    <li class="breadcumb-wrapper__items-list">
                        <a href="{{ route('public.shop') }}" class="breadcumb-wrapper__items-list-title">
                            Category
                        </a>
                    </li>
                    <li class="breadcumb-wrapper__items-list">
                        <i class="fa-regular fa-chevron-right"></i>
                    </li>
                    <li class="breadcumb-wrapper__items-list">
                        <a href="{{ route('public.checkout') }}" class="breadcumb-wrapper__items-list-title2">
                            Check Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="checkout-page section-spacing-120">
        <div class="container container-1352">
            @if ($errors->any())
                <div class="alert alert-danger mb-4" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-4" role="alert">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success mb-4" role="alert">{{ session('success') }}</div>
            @endif

            <form action="{{ route('stripe.checkout') }}" method="POST" class="checkout-page__billing-form" id="checkout-form">
                @csrf
                <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="checkout-page__billing">
                        <h2 class="checkout-page__billing-title">Billing details</h2>

                        <div class="checkout-page__banner">
                            <p class="checkout-page__banner-text">
                                Returning customer? <a href="{{ route('login') }}" class="checkout-page__banner-link" id="returning-customer-toggle">Click here to login</a>
                                <i class="fa-regular fa-chevron-down checkout-page__banner-icon"></i>
                            </p>
                        </div>

                        <div class="checkout-page__banner">
                            <p class="checkout-page__banner-text">
                                Have a coupon? <a href="#" class="checkout-page__banner-link" id="coupon-toggle">Click here to enter your code</a>
                                <i class="fa-regular fa-chevron-down checkout-page__banner-icon"></i>
                            </p>
                        </div>

                        <div id="checkout-coupon-section" style="display:none; margin-bottom:20px;">
                            @if($couponApplied)
                                <div class="alert alert-success d-flex align-items-center justify-content-between py-2 px-3">
                                    <span>Coupon <strong>{{ $appliedCoupon['code'] }}</strong> applied — you save <strong>${{ number_format((float) ($appliedCoupon['discount_amount'] ?? 0), 2) }}</strong></span>
                                    <button type="button" id="checkout-coupon-remove-btn" class="btn btn-sm btn-outline-danger ms-3">Remove</button>
                                </div>
                            @else
                                <div class="row g-2">
                                    <div class="col-md-8">
                                        <input type="text" id="checkout-coupon-input" class="checkout-page__billing-form-input" placeholder="Coupon code">
                                        <div id="checkout-coupon-error" style="color:#dc3545;font-size:13px;margin-top:4px;display:none;"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="checkout-coupon-apply-btn" class="rr-btn-button w-100">
                                            <span class="text">Apply</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout-page__billing-form-group">
                                        <label class="checkout-page__billing-form-label">
                                            First Name <span class="checkout-page__billing-form-required">*</span>
                                        </label>
                                        <input type="text" name="first_name" class="checkout-page__billing-form-input" placeholder="Enter Your Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-page__billing-form-group">
                                        <label class="checkout-page__billing-form-label">
                                            Last Name <span class="checkout-page__billing-form-required">*</span>
                                        </label>
                                        <input type="text" name="last_name" class="checkout-page__billing-form-input" placeholder="Enter Your Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">Company Name (Optional)</label>
                                <input type="text" name="company" class="checkout-page__billing-form-input" placeholder="Enter Company">
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Country / Region <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <select name="country" class="checkout-page__billing-form-select">
                                    <option value="bangladesh">Bangladesh</option>
                                    <option value="usa">United States</option>
                                    <option value="uk">United Kingdom</option>
                                    <option value="canada">Canada</option>
                                </select>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Street Address <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="text" name="address_line_1" class="checkout-page__billing-form-input" placeholder="House number and street name" required>
                                <input type="text" name="address_line_2" class="checkout-page__billing-form-input checkout-page__billing-form-input--optional" placeholder="Apartment, suite, unit, etc. (optional)">
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Town / City <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <select name="city" class="checkout-page__billing-form-select">
                                    <option value="kota">Kota</option>
                                    <option value="dhaka">Dhaka</option>
                                    <option value="chittagong">Chittagong</option>
                                </select>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    State <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <select name="state" class="checkout-page__billing-form-select">
                                    <option value="uk">Uk</option>
                                    <option value="california">California</option>
                                    <option value="texas">Texas</option>
                                </select>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Zip Code <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="text" name="zip_code" class="checkout-page__billing-form-input" value="304256" required>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Phone <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="tel" name="phone" class="checkout-page__billing-form-input" placeholder="Enter Your Phone" required>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Email Address <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="email" name="email" class="checkout-page__billing-form-input" placeholder="Enter Your Email" required>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-checkbox">
                                    <input type="checkbox" class="checkout-page__billing-form-checkbox-input">
                                    <span class="checkout-page__billing-form-checkbox-label">Create an account?</span>
                                </label>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-checkbox">
                                    <input type="checkbox" class="checkout-page__billing-form-checkbox-input">
                                    <span class="checkout-page__billing-form-checkbox-label">Ship to a different address?</span>
                                </label>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">Order Notes (Optional)</label>
                                <textarea name="order_notes" class="checkout-page__billing-form-textarea" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="checkout-page__order">
                        <h2 class="checkout-page__order-title">Your Order</h2>

                        <div class="checkout-page__order-summary">
                            @php $subtotal = 0; @endphp
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    @php $subtotal += $details['price'] * $details['quantity']; @endphp
                                    <div class="checkout-page__order-summary-item">
                                        <div class="checkout-page__order-summary-item-image">
                                            <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : asset('frontend-assets/imgs/inner/shop/shop-thumb1_1.jpg') }}" alt="{{ $details['name'] }}">
                                        </div>
                                        <div class="checkout-page__order-summary-item-content">
                                            <div class="checkout-page__order-summary-item-title">{{ $details['name'] }}</div>
                                            <p class="checkout-page__order-summary-item-quantity">QTY: {{ $details['quantity'] }}</p>
                                        </div>
                                        <div class="checkout-page__order-summary-item-price">£{{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="checkout-page__order-summary-totals">
                                <div class="checkout-page__order-summary-totals-row">
                                    <span class="checkout-page__order-summary-totals-label">Subtotal</span>
                                    <span class="checkout-page__order-summary-totals-value">£{{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="checkout-page__order-summary-totals-row">
                                    <span class="checkout-page__order-summary-totals-label">Shipping</span>
                                    @php $shipping = floatval($settings['shipping_cost'] ?? 8.00); @endphp
                                    <span class="checkout-page__order-summary-totals-value checkout-page__order-summary-totals-value--muted">Flat rate: £{{ number_format($shipping, 2) }} ({{ $settings['shipping_location'] ?? 'N/A' }})</span>
                                </div>
                                @if($couponApplied)
                                    @php $couponDiscount = floatval($appliedCoupon['discount_amount'] ?? 0); @endphp
                                    <div class="checkout-page__order-summary-totals-row" id="checkout-discount-row">
                                        <span class="checkout-page__order-summary-totals-label">Discount ({{ $appliedCoupon['code'] }})</span>
                                        <span class="checkout-page__order-summary-totals-value" style="color:#28a745;">-${{ number_format($couponDiscount, 2) }}</span>
                                    </div>
                                @else
                                    @php $couponDiscount = 0; @endphp
                                @endif
                                <div class="checkout-page__order-summary-totals-row checkout-page__order-summary-totals-row--total">
                                    <span class="checkout-page__order-summary-totals-label">Total</span>
                                    <span class="checkout-page__order-summary-totals-value checkout-page__order-summary-totals-value--highlight">${{ number_format($subtotal + $shipping, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-page__payment">
                            <div class="checkout-page__payment-option">
                                <label class="checkout-page__payment-option-label">
                                    <input type="radio" name="payment" value="stripe" class="checkout-page__payment-option-input" checked>
                                    <span class="checkout-page__payment-option-text d-flex justify-content-between align-items-center w-100">
                                        <strong>Credit Card (Stripe)</strong>
                                        <span class="checkout-page__payment-option-icons">
                                            <i class="fa-brands fa-cc-stripe" style="font-size: 24px; color: #6772e5;"></i>
                                            <i class="fa-brands fa-cc-visa"></i>
                                            <i class="fa-brands fa-cc-mastercard"></i>
                                        </span>
                                    </span>
                                </label>
                                <div class="checkout-page__payment-option-description mt-2">
                                    Pay securely using your credit or debit card via Stripe.
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="checkout-page__place-order-btn">Place Order</button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Coupon section toggle
        const couponToggle = document.getElementById('coupon-toggle');
        const couponSection = document.getElementById('checkout-coupon-section');
        if (couponToggle && couponSection) {
            @if($couponApplied)
                couponSection.style.display = 'block';
            @endif
            couponToggle.addEventListener('click', function (e) {
                e.preventDefault();
                couponSection.style.display = couponSection.style.display === 'none' ? 'block' : 'none';
                const icon = this.nextElementSibling;
                if (icon) icon.classList.toggle('active');
            });
        }

        // Apply coupon on checkout page
        const applyBtn = document.getElementById('checkout-coupon-apply-btn');
        if (applyBtn) {
            applyBtn.addEventListener('click', function () {
                const code = document.getElementById('checkout-coupon-input').value.trim().toUpperCase();
                const errorEl = document.getElementById('checkout-coupon-error');
                if (!code) return;
                errorEl.style.display = 'none';
                applyBtn.querySelector('.text').textContent = 'Applying...';
                applyBtn.disabled = true;

                fetch('{{ route("coupon.apply") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ code }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        errorEl.textContent = data.message;
                        errorEl.style.display = 'block';
                    }
                })
                .catch(() => {
                    errorEl.textContent = 'Something went wrong. Please try again.';
                    errorEl.style.display = 'block';
                })
                .finally(() => {
                    applyBtn.querySelector('.text').textContent = 'Apply';
                    applyBtn.disabled = false;
                });
            });
        }

        // Remove coupon on checkout page
        const removeCouponBtn = document.getElementById('checkout-coupon-remove-btn');
        if (removeCouponBtn) {
            removeCouponBtn.addEventListener('click', function () {
                fetch('{{ route("coupon.remove") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                })
                .then(() => location.reload());
            });
        }
    });
</script>
@endpush
