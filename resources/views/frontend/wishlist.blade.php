@extends('frontend.layouts.app')

@section('title', 'My Wishlist')

@section('content')
    <div class="breadcumb">
        <div class="container rr-container-1895">
            <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
                <div class="breadcumb-wrapper__title">My Wishlist</div>
                <ul class="breadcumb-wrapper__items">
                    <li class="breadcumb-wrapper__items-list"><i class="fa-regular fa-house"></i></li>
                    <li class="breadcumb-wrapper__items-list"><i class="fa-regular fa-chevron-right"></i></li>
                    <li class="breadcumb-wrapper__items-list">
                        <a href="{{ route('public.shop') }}" class="breadcumb-wrapper__items-list-title">Shop</a>
                    </li>
                    <li class="breadcumb-wrapper__items-list"><i class="fa-regular fa-chevron-right"></i></li>
                    <li class="breadcumb-wrapper__items-list">
                        <a href="{{ route('wishlist.index') }}" class="breadcumb-wrapper__items-list-title2">Wishlist</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="cart-page section-spacing-120">
        <div class="container container-1352">
            @if(count($wishlist) > 0)
                <div class="cart-page__table">
                    <div class="cart-page__table-header">
                        <div class="row align-items-center">
                            <div class="col-md-6"><div class="cart-page__table-header-text">Product</div></div>
                            <div class="col-md-3 text-center"><div class="cart-page__table-header-text">Price</div></div>
                            <div class="col-md-2 text-center"><div class="cart-page__table-header-text">Action</div></div>
                            <div class="col-md-1 text-center"><div class="cart-page__table-header-text">Remove</div></div>
                        </div>
                    </div>

                    <div id="wishlist-body">
                        @foreach($wishlist as $id => $item)
                            <div class="cart-page__item" data-id="{{ $id }}">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="cart-page__item-product">
                                            <div class="cart-page__item-product-image">
                                                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : asset('frontend-assets/imgs/inner/shop/shop-thumb1_1.jpg') }}" alt="{{ $item['name'] }}">
                                            </div>
                                            <div class="cart-page__item-product-info">
                                                <div class="cart-page__item-product-title">
                                                    <a href="{{ route('public.product.details', $item['slug']) }}">{{ $item['name'] }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="cart-page__item-price">${{ number_format($item['price'], 2) }}</div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <button type="button"
                                            class="rr-btn-button wishlist-add-to-cart"
                                            data-id="{{ $id }}"
                                            style="padding:8px 16px;font-size:13px;">
                                            <span class="text">Add to Cart</span>
                                        </button>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <button type="button" class="cart-page__remove wishlist-remove-btn" data-id="{{ $id }}" aria-label="Remove">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('public.shop') }}" class="cart-page__continue-shopping">
                        <i class="fa-regular fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-heart" style="font-size:48px;color:#ddd;margin-bottom:16px;display:block;"></i>
                    <p>Your wishlist is empty.</p>
                    <a href="{{ route('public.shop') }}" class="cart-page__continue-shopping d-inline-block mt-2">Browse Products</a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.getElementById('wishlist-body')?.addEventListener('click', function (e) {
            const removeBtn = e.target.closest('.wishlist-remove-btn');
            const addToCartBtn = e.target.closest('.wishlist-add-to-cart');

            if (removeBtn) {
                const id = removeBtn.dataset.id;
                fetch('{{ route("wishlist.remove") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ product_id: id }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        removeBtn.closest('.cart-page__item').remove();
                        updateWishlistBadge(data.count);
                        if (data.count === 0) location.reload();
                    }
                });
            }

            if (addToCartBtn) {
                const id = addToCartBtn.dataset.id;
                addToCartBtn.querySelector('.text').textContent = 'Adding...';
                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ product_id: id, quantity: 1 }),
                })
                .then(r => r.json())
                .then(data => {
                    addToCartBtn.querySelector('.text').textContent = 'Added!';
                    const badge = document.getElementById('cart-badge');
                    if (badge && data.cartCount !== undefined) badge.textContent = data.cartCount;
                    setTimeout(() => addToCartBtn.querySelector('.text').textContent = 'Add to Cart', 1500);
                });
            }
        });

        function updateWishlistBadge(count) {
            const badge = document.getElementById('wishlist-badge');
            if (badge) badge.textContent = count;
        }
    });
</script>
@endpush
