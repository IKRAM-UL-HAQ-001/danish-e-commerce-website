@extends('frontend.layouts.app')
@section('title', 'Checkout')
@section('content')
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
                                Have a coupon? <a href="#coupon" class="checkout-page__banner-link" id="coupon-toggle">Click here to enter your code</a>
                                <i class="fa-regular fa-chevron-down checkout-page__banner-icon"></i>
                            </p>
                        </div>

                        <form action="{{ route('stripe.checkout') }}" method="POST" class="checkout-page__billing-form" id="checkout-form">
                            @csrf
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
                                        <input type="text" class="checkout-page__billing-form-input" placeholder="Enter Your Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">Company Name (Optional)</label>
                                <input type="text" class="checkout-page__billing-form-input" placeholder="Enter Company">
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Country / Region <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <select class="checkout-page__billing-form-select">
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
                                <input type="text" class="checkout-page__billing-form-input" placeholder="House number and street name" required>
                                <input type="text" class="checkout-page__billing-form-input checkout-page__billing-form-input--optional" placeholder="Apartment, suite, unit, etc. (optional)">
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Town / City <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <select class="checkout-page__billing-form-select">
                                    <option value="kota">Kota</option>
                                    <option value="dhaka">Dhaka</option>
                                    <option value="chittagong">Chittagong</option>
                                </select>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    State <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <select class="checkout-page__billing-form-select">
                                    <option value="uk">Uk</option>
                                    <option value="california">California</option>
                                    <option value="texas">Texas</option>
                                </select>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Zip Code <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="text" class="checkout-page__billing-form-input" value="304256" required>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Phone <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="tel" class="checkout-page__billing-form-input" placeholder="Enter Your Name" required>
                            </div>

                            <div class="checkout-page__billing-form-group">
                                <label class="checkout-page__billing-form-label">
                                    Email Address <span class="checkout-page__billing-form-required">*</span>
                                </label>
                                <input type="email" class="checkout-page__billing-form-input" placeholder="Enter Your Email" required>
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
                                <textarea class="checkout-page__billing-form-textarea" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </form>
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
                                <div class="checkout-page__order-summary-totals-row checkout-page__order-summary-totals-row--total">
                                    <span class="checkout-page__order-summary-totals-label">Total</span>
                                    <span class="checkout-page__order-summary-totals-value checkout-page__order-summary-totals-value--highlight">£{{ number_format($subtotal + $shipping, 2) }}</span>
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
                                <div id="stripe-card-element" class="mt-3 p-3 border rounded bg-light" style="display: block;">
                                    <!-- Stripe Card Element will be inserted here -->
                                    <div id="card-element"></div>
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="checkout-page__place-order-btn">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Banner toggle functionality
    document.addEventListener('DOMContentLoaded', function () {
      const returningCustomerToggle = document.getElementById('returning-customer-toggle');
      const couponToggle = document.getElementById('coupon-toggle');

      if (returningCustomerToggle) {
        returningCustomerToggle.addEventListener('click', function (e) {
          // e.preventDefault(); // Commented out to allow link to work if it's a real link
          const icon = this.nextElementSibling;
          if (icon) {
            icon.classList.toggle('active');
          }
        });
      }

      if (couponToggle) {
        couponToggle.addEventListener('click', function (e) {
          e.preventDefault();
          const icon = this.nextElementSibling;
          if (icon) {
            icon.classList.toggle('active');
          }
        });
      }
    });
</script>
@endpush
