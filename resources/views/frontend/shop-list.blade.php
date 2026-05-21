@extends('frontend.layouts.app')

@section('title', 'Shop List')

@section('content')
<div class="breadcumb">
    <div class="container rr-container-1895">
        <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ ($selectedCategory && $selectedCategory->image) ? asset('storage/' . $selectedCategory->image) : asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
            <div class="breadcumb-wrapper__title">
                @if($selectedCategory)
                    {{ $selectedCategory->name }}
                @elseif($selectedBrand)
                    {{ $selectedBrand->name }}
                @else
                    Shop List
                @endif
            </div>
            <ul class="breadcumb-wrapper__items">
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <a href="{{ route('home') }}" class="breadcumb-wrapper__items-list-title">Home</a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <a href="{{ route('public.shop.list') }}" class="breadcumb-wrapper__items-list-title2">
                        @if($selectedCategory)
                            {{ $selectedCategory->name }}
                        @elseif($selectedBrand)
                            {{ $selectedBrand->name }}
                        @else
                            Shop List
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<section class="shop-list section-spacing-120 rr-ov-hidden">
    <div class="container rr-container-1350">
        <div class="row g-4 d-flex justify-content-between">
            <div class="col-xl-3 col-lg-3">
                <div class="shop-sidebar" id="shop-sidebar-list">
                    <button type="button" class="shop-sidebar__close-btn d-xl-none" id="shop-sidebar-close-list" aria-label="Close filter sidebar">
                        <i class="fa-solid fa-times"></i>
                    </button>

                    <div class="shop-sidebar__widget">
                        <div class="shop-sidebar__search">
                            <form action="#" class="shop-sidebar__search-form">
                                <input type="text" class="shop-sidebar__search-input" placeholder="Search Items" id="shop-search-input-list">
                                <button type="submit" class="shop-sidebar__search-btn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="shop-sidebar__widget">
                        <div class="shop-sidebar__widget-header">
                            <h3 class="shop-sidebar__widget-title">Price</h3>
                        </div>
                        <div class="shop-sidebar__price">
                            <form action="{{ route('public.shop.list') }}" method="GET" id="price-filter-form-list">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                @if(request('brand'))
                                    <input type="hidden" name="brand" value="{{ request('brand') }}">
                                @endif
                                <div class="shop-sidebar__price-info">
                                    <p class="shop-sidebar__price-info-text">Range: <span>£{{ $minPriceRange }} - £{{ $maxPriceRange }}</span></p>
                                    <a href="{{ route('public.shop.list', request()->only(['category', 'brand'])) }}" class="shop-sidebar__price-reset">Reset</a>
                                </div>
                                <div class="shop-sidebar__price-slider">
                                    <input type="range" id="shop-price-range-list" class="shop-sidebar__price-range" 
                                           min="{{ $minPriceRange }}" max="{{ $maxPriceRange }}" 
                                           value="{{ request('max_price', $maxPriceRange) }}">
                                </div>
                                <div class="shop-sidebar__price-inputs">
                                    <div class="shop-sidebar__price-input-group">
                                        <label class="shop-sidebar__price-input-label">From:</label>
                                        <input type="number" name="min_price" class="shop-sidebar__price-input" id="shop-price-from-list" 
                                               value="{{ request('min_price', $minPriceRange) }}" min="{{ $minPriceRange }}" max="{{ $maxPriceRange }}">
                                    </div>
                                    <span class="shop-sidebar__price-input-separator">-</span>
                                    <div class="shop-sidebar__price-input-group">
                                        <label class="shop-sidebar__price-input-label">To:</label>
                                        <input type="number" name="max_price" class="shop-sidebar__price-input" id="shop-price-to-list" 
                                               value="{{ request('max_price', $maxPriceRange) }}" min="{{ $minPriceRange }}" max="{{ $maxPriceRange }}">
                                    </div>
                                </div>
                                <button type="submit" class="rr-btn-button mt-3 w-100" style="padding: 10px;">
                                    <span class="text">Apply Filter</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="shop-sidebar__widget">
                        <div class="shop-sidebar__widget-header">
                            <h3 class="shop-sidebar__widget-title">Categories</h3>
                        </div>
                        <div class="shop-sidebar__categories">
                            <ul class="shop-sidebar__categories-list">
                                @foreach($categories as $category)
                                <li class="shop-sidebar__categories-item">
                                    <a href="{{ route('public.shop.list', ['category' => $category->slug]) }}" class="shop-sidebar__categories-link {{ request('category') == $category->slug ? 'active' : '' }} d-flex align-items-center">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 20px; height: 20px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                                        @else
                                            <i class="fa-solid fa-chevron-right" style="margin-right: 10px;"></i>
                                        @endif
                                        {{ $category->name }}
                                    </a>
                                    @if($category->subcategories->isNotEmpty())
                                    <ul class="shop-sidebar__categories-list" style="margin-left: 28px; margin-top: 8px;">
                                        @foreach($category->subcategories as $subcategory)
                                        <li class="shop-sidebar__categories-item">
                                            <a href="{{ route('public.shop.list', ['category' => $subcategory->slug]) }}" class="shop-sidebar__categories-link {{ request('category') == $subcategory->slug ? 'active' : '' }} d-flex align-items-center">
                                                @if($subcategory->image)
                                                    <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" style="width: 18px; height: 18px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                                                @else
                                                    <i class="fa-solid fa-angle-right" style="margin-right: 10px;"></i>
                                                @endif
                                                {{ $subcategory->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="shop-sidebar__widget">
                        <div class="shop-sidebar__widget-header">
                            <h3 class="shop-sidebar__widget-title">Brand</h3>
                        </div>
                        <div class="shop-sidebar__brand">
                            <ul class="shop-sidebar__brand-list">
                                @foreach($brands as $brand)
                                <li class="shop-sidebar__brand-item">
                                    <a href="{{ route('public.shop.list', ['brand' => $brand->slug]) }}" class="shop-sidebar__brand-link {{ request('brand') == $brand->slug ? 'active' : '' }}">
                                        <i class="fa-solid fa-chevron-right"></i>{{ $brand->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9">
                <div class="shop-list-wrapper">
                    <div class="shop-wrapper__items">
                        <p class="shop-wrapper__items-text">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products</p>
                        <button type="button" class="shop-wrapper__filter-btn" id="shop-filter-toggle-list" aria-label="Toggle filter sidebar">
                            <span class="shop-wrapper__filter-btn-text">Filter</span>
                            <svg class="shop-wrapper__filter-btn-icon" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.75 4.75H8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.75 13.75H3.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="4.75" cy="4.75" r="4" stroke="white" stroke-width="1.5" />
                                <circle cx="16.75" cy="13.75" r="4" stroke="white" stroke-width="1.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="row g-4 d-flex justify-content-between">
                        @foreach($products as $product)
                        <div class="col-xl-12 col-lg-12 col-md-12 wow fadeInUp" data-wow-delay=".3s">
                            <div class="shop-list-card">
                                <div class="shop-list-card__thumb">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('frontend-assets/imgs/inner/shop-list/shop-list-thumb1_1.jpg') }}" alt="{{ $product->name }}">
                                    @if($product->old_price && $product->old_price > $product->price)
                                    <div class="shop-list-card__thumb-offer">-{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</div>
                                    @endif
                                </div>
                                <div class="shop-list-card__content">
                                    <div class="shop-list-card__content-star">
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                        <i class="fa-solid fa-star fa-fw"></i>
                                    </div>
                                    <h4 class="shop-list-card__content-title"><a href="{{ route('public.product.details', $product->slug) }}">{{ $product->name }}</a></h4>
                                    <p class="shop-list-card__content-subtitle">{{ Str::limit(strip_tags($product->description), 150) }}</p>
                                    <div class="shop-list-card__content-price">
                                        <span class="offer-price">£{{ number_format($product->price, 2) }}</span>
                                        @if($product->old_price)
                                        <span class="original-price" style="text-decoration: line-through; color: #888; margin-left: 10px;">£{{ number_format($product->old_price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="shop-list-card__content-social">
                                        <div class="shop-list-card__content-social-link">
                                            <a href="#" class="wishlist-btn wishlist-toggle-btn {{ collect(session('wishlist', []))->has($product->id) ? 'wishlist-active' : '' }}"
                                               data-id="{{ $product->id }}">
                                               <span><i class="fa-solid fa-heart"></i></span></a>
                                            <a href="#" class="add-to-cart" data-id="{{ $product->id }}"><span><i class="fa-solid fa-cart-shopping"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="pagination mt-5">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.wishlist-toggle-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const id = this.dataset.id;
                const self = this;
                fetch('{{ route("wishlist.toggle") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ product_id: id }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        self.style.color = data.added ? '#EE2D7A' : '';
                        const badge = document.getElementById('wishlist-badge');
                        if (badge) badge.textContent = data.count;
                    }
                });
            });
        });
    });
</script>
@endpush
