@extends('frontend.layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="breadcumb">
        <div class="container rr-container-1895">
            <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
                <div class="breadcumb-wrapper__title">My Shopping Cart</div>
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
                        <a href="{{ route('public.cart') }}" class="breadcumb-wrapper__items-list-title2">
                            My Shopping Cart
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="cart-page section-spacing-120">
        <div class="container container-1352">
            <div class="row d-flex align-items-center justify-content-end">
                <div class="col-lg-12 col-md-12">
                    <div class="cart-page__items">
                        <div class="cart-page__table">
                            <div class="cart-page__table-header">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <div class="cart-page__table-header-text">Product</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="cart-page__table-header-text">Price</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="cart-page__table-header-text">Quantity</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="cart-page__table-header-text">Subtotal</div>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <div class="cart-page__table-header-text">Remove</div>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-page__table-body" id="cart-page__table-body">
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        <div class="cart-page__item" data-id="{{ $id }}">
                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <div class="cart-page__item-product">
                                                        <div class="cart-page__item-product-image">
                                                            <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : asset('frontend-assets/imgs/inner/shop/shop-thumb1_1.jpg') }}" alt="{{ $details['name'] }}">
                                                        </div>
                                                        <div class="cart-page__item-product-info">
                                                            <div class="cart-page__item-product-title">
                                                                <a href="#">{{ $details['name'] }}</a>
                                                            </div>
                                                            <p class="cart-page__item-product-sku">SKU: {{ $details['sku'] ?? 'N/A' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <div class="cart-page__item-price">${{ number_format($details['price'], 2) }}</div>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <div class="cart-page__item-qty">
                                                        <button type="button" class="cart-page__qty-btn cart-page__qty-btn--minus">−</button>
                                                        <input type="number" class="cart-page__qty-input" value="{{ $details['quantity'] }}" min="1" max="99">
                                                        <button type="button" class="cart-page__qty-btn cart-page__qty-btn--plus">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <div class="cart-page__item-subtotal">${{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <button type="button" class="cart-page__remove remove-from-cart" aria-label="Remove item">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <p>Your cart is empty.</p>
                                        <a href="{{ route('public.shop') }}" class="cart-page__continue-shopping d-inline-block">Continue Shopping</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="cart-page__actions">
                            <div class="row d-flex align-items-center justify-content-between">
                                <div class="col-md-6">
                                    <a href="{{ route('public.shop') }}" class="cart-page__continue-shopping">
                                        <i class="fa-regular fa-arrow-left"></i>
                                        Continue Shopping
                                    </a>
                                </div>
                                
                            </div>
                        </div>

                        @php
                            $appliedCoupon = session('applied_coupon');
                            $couponApplied = is_array($appliedCoupon) && !empty($appliedCoupon['code'] ?? null);
                        @endphp
                        <div class="cart-page__coupon">
                            <h3 class="cart-page__coupon-title">Coupon</h3>
                            <p class="cart-page__coupon-text">Enter your coupon code if you have one.</p>

                            {{-- Banner: use d-none/d-flex (not inline display) — Bootstrap d-flex uses !important and overrides display:none --}}
                            <div id="coupon-applied-banner"
                                 class="alert alert-success align-items-center justify-content-between py-2 px-3 mb-3 {{ $couponApplied ? 'd-flex' : 'd-none' }}">
                                <span>Coupon <strong id="coupon-applied-code">{{ $appliedCoupon['code'] ?? '' }}</strong> applied — you save <strong id="coupon-applied-saving">{{ $couponApplied ? '$' . number_format((float) ($appliedCoupon['discount_amount'] ?? 0), 2) : '' }}</strong></span>
                                <button type="button" id="cart-coupon-remove-btn" class="btn btn-sm btn-outline-danger ms-3">Remove</button>
                            </div>

                            {{-- Form: hidden when coupon is already applied --}}
                            <div id="coupon-form-wrapper" class="{{ $couponApplied ? 'd-none' : '' }}">
                                <form class="cart-page__coupon-form" id="cart-coupon-form">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" class="cart-page__coupon-input" id="cart-coupon-input" placeholder="Enter coupon code">
                                            <div id="coupon-error" style="color:#dc3545;font-size:13px;margin-top:4px;display:none;"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="rr-btn-button" id="cart-coupon-btn">
                                                <span class="text">Apply Coupon</span>
                                                <span class="icon">
                                                    <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="cart-page__totals">
                        <h3 class="cart-page__totals-title">Cart Totals</h3>
                        <div class="cart-page__totals-card">
                            <div class="cart-page__totals-row">
                                <span class="cart-page__totals-label">Subtotal</span>
                                @php $subtotal = 0; @endphp
                                @if(session('cart'))
                                    @foreach(session('cart') as $details)
                                        @php $subtotal += $details['price'] * $details['quantity']; @endphp
                                    @endforeach
                                @endif
                                <span class="cart-page__totals-value" id="cart-subtotal">${{ number_format($subtotal, 2) }}</span>
                            </div>
                             <div class="cart-page__totals-row">
                                <span class="cart-page__totals-label">Shipping</span>
                                @php $shipping = floatval($settings['shipping_cost'] ?? 8.00); @endphp
                                <span class="cart-page__totals-value cart-page__totals-value--muted text-end"
                                      id="cart-shipping-value"
                                      data-value="{{ $shipping }}">
                                    Flat rate: ${{ number_format($shipping, 2) }}
                                </span>
                            </div>
                            @php
                                $couponDiscount = $couponApplied ? floatval($appliedCoupon['discount_amount'] ?? 0) : 0;
                                $cartTotal      = max(0, $subtotal + $shipping - $couponDiscount);
                            @endphp
                            <div class="cart-page__totals-row" id="coupon-discount-row"
                                 style="{{ $couponDiscount > 0 ? '' : 'display:none;' }}">
                                <span class="cart-page__totals-label">Discount</span>
                                <span class="cart-page__totals-value text-end"
                                      id="coupon-discount-value"
                                      data-value="{{ $couponDiscount }}"
                                      data-coupon-type="{{ $appliedCoupon['type'] ?? '' }}"
                                      data-coupon-value="{{ $appliedCoupon['value'] ?? 0 }}"
                                      style="color:#28a745;">
                                    {{ $couponDiscount > 0 ? '-$' . number_format($couponDiscount, 2) : '' }}
                                </span>
                            </div>
                            <div class="cart-page__totals-row cart-page__totals-row--total">
                                <span class="cart-page__totals-label">Total</span>
                                <span class="cart-page__totals-value cart-page__totals-value--highlight" id="cart-total">${{ number_format($cartTotal, 2) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('public.checkout') }}" class="cart-page__checkout-btn">
                            Proceed to Checkout
                            <i class="fa-regular fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Cart functionality
    document.addEventListener('DOMContentLoaded', function () {
      const cartBody = document.getElementById('cart-page__table-body');
      const updateBtn = document.getElementById('cart-update-btn');
      const couponBtn = document.getElementById('cart-coupon-btn');

      function calculateCartTotals() {
        let subtotal = 0;
        const items = cartBody ? cartBody.querySelectorAll('.cart-page__item') : [];

        items.forEach(item => {
          const priceText = item.querySelector('.cart-page__item-price').textContent;
          const price = parseFloat(priceText.replace(/[$,]/g, ''));
          const quantity = parseInt(item.querySelector('.cart-page__qty-input').value) || 1;
          const itemSubtotal = price * quantity;
          item.querySelector('.cart-page__item-subtotal').textContent = '$' + itemSubtotal.toFixed(2);
          subtotal += itemSubtotal;
        });

        const subtotalEl  = document.getElementById('cart-subtotal');
        const totalEl     = document.getElementById('cart-total');
        const discountEl  = document.getElementById('coupon-discount-value');
        const shippingEl  = document.getElementById('cart-shipping-value');
        const shipping    = parseFloat(shippingEl ? shippingEl.dataset.value : '8') || 0;

        if (subtotalEl) subtotalEl.textContent = '$' + subtotal.toFixed(2);

        // Calculate discount and update all display elements
        let discount = 0;
        if (discountEl) {
          if (discountEl.dataset.couponType === 'percent') {
            const pct = parseFloat(discountEl.dataset.couponValue || '0');
            discount = Math.round(subtotal * (pct / 100) * 100) / 100;
            discountEl.dataset.value = discount.toFixed(2);
          } else {
            discount = parseFloat(discountEl.dataset.value || '0');
          }

          if (discount > 0) {
            discountEl.textContent = '-$' + discount.toFixed(2);
            const savingEl = document.getElementById('coupon-applied-saving');
            if (savingEl) savingEl.textContent = '$' + discount.toFixed(2);
          }
        }

        if (totalEl) {
          totalEl.textContent = '$' + Math.max(0, subtotal + shipping - discount).toFixed(2);
        }
      }

      // Quantity button handlers
      if (cartBody) {
        cartBody.addEventListener('click', function (e) {
          const target = e.target.closest('.cart-page__qty-btn');
          if (!target) return;

          const item = target.closest('.cart-page__item');
          const input = item.querySelector('.cart-page__qty-input');
          let value = parseInt(input.value) || 1;

          if (target.classList.contains('cart-page__qty-btn--minus')) {
            value = Math.max(1, value - 1);
          } else if (target.classList.contains('cart-page__qty-btn--plus')) {
            value = Math.min(99, value + 1);
          }

          input.value = value;
          calculateCartTotals();
          updateCartSession(item.dataset.id, value);
        });

        // Input change handler
        cartBody.addEventListener('input', function (e) {
          if (e.target.classList.contains('cart-page__qty-input')) {
            let value = parseInt(e.target.value) || 1;
            value = Math.max(1, Math.min(99, value));
            e.target.value = value;
            calculateCartTotals();
            const item = e.target.closest('.cart-page__item');
            updateCartSession(item.dataset.id, value);
          }
        });

        // Remove item handler
        cartBody.addEventListener('click', function (e) {
          const removeBtn = e.target.closest('.cart-page__remove');
          if (!removeBtn) return;

          const item = removeBtn.closest('.cart-page__item');
          const id = item.dataset.id;
          if (confirm('Are you sure you want to remove this item from your cart?')) {
            removeFromCartSession(id, item);
          }
        });
      }

      function updateCartSession(id, quantity) {
        fetch('{{ route("cart.update") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ id, quantity })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Cart updated');
        });
      }

      function removeFromCartSession(id, itemElement) {
        fetch('{{ route("cart.remove") }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ id })
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            itemElement.remove();
            calculateCartTotals();
            
            // Update badge
            const badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = parseInt(badge.textContent) - 1;
            }

            if (cartBody.querySelectorAll('.cart-page__item').length === 0) {
              cartBody.innerHTML = '<div class="text-center py-5"><p>Your cart is empty.</p><a href="{{ route('public.shop') }}" class="cart-page__continue-shopping d-inline-block">Continue Shopping</a></div>';
            }
          }
        });
      }

      // Update cart button
      if (updateBtn) {
        updateBtn.addEventListener('click', function () {
          this.querySelector('.text').textContent = 'Updating...';
          setTimeout(() => {
              location.reload();
          }, 500);
        });
      }

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      function applyCouponUI(code, discountAmount, type, couponValue) {
        const amount       = parseFloat(discountAmount) || 0;
        const discountRow  = document.getElementById('coupon-discount-row');
        const discountValEl = document.getElementById('coupon-discount-value');
        const banner       = document.getElementById('coupon-applied-banner');
        const formWrapper  = document.getElementById('coupon-form-wrapper');

        discountValEl.dataset.couponType  = type || 'fixed';
        discountValEl.dataset.couponValue = parseFloat(couponValue) || amount;
        discountValEl.dataset.value       = amount.toFixed(2);

        discountRow.style.display = 'flex';
        banner.classList.remove('d-none');
        banner.classList.add('d-flex');
        formWrapper.classList.add('d-none');

        document.getElementById('coupon-applied-code').textContent = code;
        calculateCartTotals();
      }

      function removeCouponUI() {
        const discountRow   = document.getElementById('coupon-discount-row');
        const discountValEl = document.getElementById('coupon-discount-value');
        const banner        = document.getElementById('coupon-applied-banner');
        const formWrapper   = document.getElementById('coupon-form-wrapper');

        discountValEl.dataset.value       = '0';
        discountValEl.dataset.couponType  = '';
        discountValEl.dataset.couponValue = '0';
        discountValEl.textContent = '';

        discountRow.style.display = 'none';
        banner.classList.add('d-none');
        banner.classList.remove('d-flex');
        formWrapper.classList.remove('d-none');
        document.getElementById('cart-coupon-input').value = '';
        calculateCartTotals();
      }

      // Apply coupon form submit
      const couponForm = document.getElementById('cart-coupon-form');
      if (couponForm) {
        couponForm.addEventListener('submit', function (e) {
          e.preventDefault();
          const input = document.getElementById('cart-coupon-input');
          const errorEl = document.getElementById('coupon-error');
          const code = input.value.trim().toUpperCase();
          const btn = document.getElementById('cart-coupon-btn');

          if (!code) return;

          errorEl.style.display = 'none';
          btn.querySelector('.text').textContent = 'Applying...';
          btn.disabled = true;

          fetch('{{ route("coupon.apply") }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ code }),
          })
          .then(r => r.json())
          .then(data => {
            if (data.success) {
              applyCouponUI(data.code, data.discount_amount, data.type, data.value);
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
            btn.querySelector('.text').textContent = 'Apply Coupon';
            btn.disabled = false;
          });
        });
      }

      // Remove coupon button
      const removeCouponBtn = document.getElementById('cart-coupon-remove-btn');
      if (removeCouponBtn) {
        removeCouponBtn.addEventListener('click', function () {
          fetch('{{ route("coupon.remove") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
          })
          .then(() => removeCouponUI());
        });
      }

      // Initial calculation
      calculateCartTotals();
    });
</script>
@endpush
