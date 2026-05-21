@extends('frontend.layouts.app')

@section('title', 'Shop')

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
                    Shop
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
                    <a href="{{ route('home') }}" class="breadcumb-wrapper__items-list-title">
                        Home
                    </a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <a href="{{ route('public.shop') }}" class="breadcumb-wrapper__items-list-title2">
                        @if($selectedCategory)
                            {{ $selectedCategory->name }}
                        @elseif($selectedBrand)
                            {{ $selectedBrand->name }}
                        @else
                            Shop
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<section class="shop section-spacing-120 rr-ov-hidden">
    <div class="container rr-container-1350">
        <div class="row g-4 d-flex justify-content-between">
            <div class="col-xl-3">
                <div class="shop-sidebar" id="shop-sidebar">
                    <button type="button" class="shop-sidebar__close-btn d-xl-none" id="shop-sidebar-close" aria-label="Close filter sidebar">
                        <i class="fa-solid fa-times"></i>
                    </button>

                    <div class="shop-sidebar__widget">
                        <div class="shop-sidebar__search">
                            <form action="#" class="shop-sidebar__search-form">
                                <input type="text" class="shop-sidebar__search-input" placeholder="Search Items" id="shop-search-input">
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
                            <form action="{{ route('public.shop') }}" method="GET" id="price-filter-form">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                @if(request('brand'))
                                    <input type="hidden" name="brand" value="{{ request('brand') }}">
                                @endif
                                <div class="shop-sidebar__price-info">
                                    <p class="shop-sidebar__price-info-text">Range: <span>£{{ $minPriceRange }} - £{{ $maxPriceRange }}</span></p>
                                    <a href="{{ route('public.shop', request()->only(['category', 'brand'])) }}" class="shop-sidebar__price-reset">Reset</a>
                                </div>
                                <div class="shop-sidebar__price-slider">
                                    <input type="range" id="shop-price-range" class="shop-sidebar__price-range" 
                                           min="{{ $minPriceRange }}" max="{{ $maxPriceRange }}" 
                                           value="{{ request('max_price', $maxPriceRange) }}">
                                </div>
                                <div class="shop-sidebar__price-inputs">
                                    <div class="shop-sidebar__price-input-group">
                                        <label class="shop-sidebar__price-input-label">From:</label>
                                        <input type="number" name="min_price" class="shop-sidebar__price-input" id="shop-price-from" 
                                               value="{{ request('min_price', $minPriceRange) }}" min="{{ $minPriceRange }}" max="{{ $maxPriceRange }}">
                                    </div>
                                    <span class="shop-sidebar__price-input-separator">-</span>
                                    <div class="shop-sidebar__price-input-group">
                                        <label class="shop-sidebar__price-input-label">To:</label>
                                        <input type="number" name="max_price" class="shop-sidebar__price-input" id="shop-price-to" 
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
                                <li class="shop-sidebar__categories-item {{ $category->subcategories->isNotEmpty() ? 'has-subcategories' : '' }}">
                                    <a href="{{ route('public.shop', ['category' => $category->slug]) }}" class="shop-sidebar__categories-link {{ request('category') == $category->slug ? 'active' : '' }} d-flex align-items-center">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 20px; height: 20px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                                        @else
                                            <i class="fa-solid fa-chevron-right"></i>
                                        @endif
                                        {{ $category->name }}
                                    </a>
                                    @if($category->subcategories->isNotEmpty())
                                        <ul class="shop-sidebar__subcategories-list">
                                            @foreach($category->subcategories as $subcategory)
                                                <li class="shop-sidebar__subcategories-item">
                                                    <a href="{{ route('public.shop', ['category' => $subcategory->slug]) }}" class="shop-sidebar__categories-link shop-sidebar__categories-link--child {{ request('category') == $subcategory->slug ? 'active' : '' }}">
                                                        <i class="fa-solid fa-chevron-right"></i>{{ $subcategory->name }}
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
                                    <a href="{{ route('public.shop', ['brand' => $brand->slug]) }}" class="shop-sidebar__brand-link {{ request('brand') == $brand->slug ? 'active' : '' }}">
                                        <i class="fa-solid fa-chevron-right"></i>{{ $brand->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="shop-wrapper">
                    <div class="shop-wrapper__items">
                        <p class="shop-wrapper__items-text">Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products</p>
                        <div class="shop-wrapper__filter-dropdown" id="shop-filter-dropdown">
                            <button type="button" class="shop-wrapper__filter-btn" id="shop-filter-toggle" aria-label="Sort options" aria-expanded="false" aria-haspopup="true">
                                <span class="shop-wrapper__filter-btn-text">Filter</span>
                                <svg class="shop-wrapper__filter-btn-icon" width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.75 4.75H8.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.75 13.75H3.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <circle cx="4.75" cy="4.75" r="4" stroke="white" stroke-width="1.5" />
                                    <circle cx="16.75" cy="13.75" r="4" stroke="white" stroke-width="1.5" />
                                </svg>
                                <i class="fa-solid fa-chevron-down shop-wrapper__filter-chevron"></i>
                            </button>
                            <div class="shop-wrapper__sort-dropdown" id="shop-sort-dropdown" role="menu" aria-hidden="true">
                                <button type="button" role="menuitem" class="shop-wrapper__sort-option" data-sort="alphabetical">Sort A–Z</button>
                                <button type="button" role="menuitem" class="shop-wrapper__sort-option" data-sort="price-low">Price: Low to High</button>
                                <button type="button" role="menuitem" class="shop-wrapper__sort-option" data-sort="price-high">Price: High to Low</button>
                                <button type="button" role="menuitem" class="shop-wrapper__sort-option" data-sort="rating">By Rating</button>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4" id="shop-product-grid">
                        @foreach($products as $product)
                        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s" data-price="{{ $product->price }}" data-rating="5">
                            <div class="shop-card">
                                <div class="shop-card__thumb">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('frontend-assets/imgs/inner/shop/shop-thumb1_1.jpg') }}" alt="{{ $product->name }}">
                                    @if($product->created_at->diffInDays() < 7)
                                    <div class="shop-card__thumb-offer">New</div>
                                    @endif
                                    <div class="shop-card__thumb-btn-wrapper">
                                        <button class="rr-btn-button4 add-to-cart" data-id="{{ $product->id }}">
                                            <span class="text">Add to Cart</span>
                                            <span class="icon">
                                                <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.419678 3.21674H10.2098M10.2098 3.21674L7.41265 6.01393M10.2098 3.21674L7.41265 0.419556" stroke="#0C0C0C" stroke-width="0.839157" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="shop-card__content">
                                    <div class="shop-card__content-title"><a href="{{ route('public.product.details', $product->slug) }}">{{ $product->name }}</a></div>
                                    <ul class="shop-card__content-list">
                                        <li class="shop-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                                        <li class="shop-card__content-list-point">5.0</li>
                                        <li class="shop-card__content-list-text">(135 Reviews)</li>
                                    </ul>
                                    <h4 class="shop-card__content-dollar">
                                        £{{ number_format($product->price, 2) }}
                                        @if($product->old_price)
                                        <span style="text-decoration: line-through; color: #888; font-size: 0.8em; margin-left: 5px;">£{{ number_format($product->old_price, 2) }}</span>
                                        @endif
                                    </h4>
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
      const filterToggle = document.getElementById('shop-filter-toggle');
      const sortDropdown = document.getElementById('shop-sort-dropdown');
      const filterDropdown = document.getElementById('shop-filter-dropdown');
      const productGrid = document.getElementById('shop-product-grid');
      const sortOptions = document.querySelectorAll('.shop-wrapper__sort-option');

      function openDropdown() {
        if (sortDropdown) {
          sortDropdown.classList.add('shop-wrapper__sort-dropdown--open');
          sortDropdown.setAttribute('aria-hidden', 'false');
        }
        if (filterToggle) filterToggle.setAttribute('aria-expanded', 'true');
      }

      function closeDropdown() {
        if (sortDropdown) {
          sortDropdown.classList.remove('shop-wrapper__sort-dropdown--open');
          sortDropdown.setAttribute('aria-hidden', 'true');
        }
        if (filterToggle) filterToggle.setAttribute('aria-expanded', 'false');
      }

      if (filterToggle && sortDropdown) {
        filterToggle.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          const isOpen = sortDropdown.classList.contains('shop-wrapper__sort-dropdown--open');
          if (isOpen) closeDropdown();
          else openDropdown();
        });
      }

      document.addEventListener('click', function (e) {
        if (filterDropdown && !filterDropdown.contains(e.target)) {
          closeDropdown();
        }
      });

      function sortProducts(sortType) {
        if (!productGrid) return;
        const cols = Array.from(productGrid.querySelectorAll('.col-xl-4.col-lg-4.col-md-6'));
        const items = cols.map(col => {
            const titleEl = col.querySelector('.shop-card__content-title a');
            return {
                col,
                title: titleEl ? (titleEl.textContent || '').trim() : '',
                price: parseFloat(col.getAttribute('data-price')) || 0,
                rating: parseFloat(col.getAttribute('data-rating')) || 0
            };
        });

        if (sortType === 'alphabetical') {
          items.sort((a, b) => a.title.localeCompare(b.title));
        } else if (sortType === 'price-low') {
          items.sort((a, b) => a.price - b.price);
        } else if (sortType === 'price-high') {
          items.sort((a, b) => b.price - a.price);
        } else if (sortType === 'rating') {
          items.sort((a, b) => b.rating - a.rating);
        }

        items.forEach(({ col }) => productGrid.appendChild(col));
        closeDropdown();
      }

      sortOptions.forEach(btn => {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          const sortType = this.getAttribute('data-sort');
          if (sortType) sortProducts(sortType);
        });
      });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const priceRange = document.getElementById('shop-price-range');
      const priceFrom = document.getElementById('shop-price-from');
      const priceTo = document.getElementById('shop-price-to');
      const priceReset = document.getElementById('shop-price-reset');
      const maxPriceDisplay = document.getElementById('shop-max-price-display');

      if (priceRange && priceFrom && priceTo) {
        const maxPrice = parseInt(priceRange.max);
        const minPrice = parseInt(priceRange.min);

        priceRange.addEventListener('input', function () {
          priceTo.value = this.value;
          updatePriceRange();
        });

        priceFrom.addEventListener('input', function () {
          updatePriceRange();
        });

        priceTo.addEventListener('input', function () {
          priceRange.value = this.value;
          updatePriceRange();
        });

        if (priceReset) {
          priceReset.addEventListener('click', function (e) {
            e.preventDefault();
            priceRange.value = maxPrice;
            priceFrom.value = minPrice;
            priceTo.value = maxPrice;
            updatePriceRange();
          });
        }

        function updatePriceRange() {
          const toValue = parseInt(priceTo.value) || minPrice;
          const percentage = ((toValue - minPrice) / (maxPrice - minPrice)) * 100;
          priceRange.style.background = `linear-gradient(to right, #EE2D7A 0%, #EE2D7A ${percentage}%, #FFFFFF ${percentage}%, #FFFFFF 100%)`;
        }
        updatePriceRange();
      }
    });
</script>
@endpush
