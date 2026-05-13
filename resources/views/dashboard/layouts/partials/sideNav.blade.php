<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-profile-box p-3 border-bottom mb-2 text-center">
    <div class="position-relative d-inline-block">
        @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="rounded-circle mb-2" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #EE2D7A;">
        @else
            <img src="{{ asset('assets/images/faces/face8.jpg') }}" class="rounded-circle mb-2" style="width: 60px; height: 60px;">
        @endif
        <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-1" style="width: 12px; height: 12px;"></span>
    </div>
    <h6 class="mb-0 fw-bold">{{ Auth::user()->name }}</h6>
    <small class="text-muted text-uppercase" style="font-size: 10px;">{{ Auth::user()->role }}</small>
  </div>
  <ul class="nav">
    <!-- Dashboard -->
    <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    @if(Auth::user()->isAdmin())
    <li class="nav-item nav-category">Store Management</li>
    
    <!-- Categories -->
    <li class="nav-item {{ Route::is('categories.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('categories.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#category-menu" aria-expanded="{{ Route::is('categories.*') ? 'true' : 'false' }}" aria-controls="category-menu">
        <i class="menu-icon mdi mdi-view-list"></i>
        <span class="menu-title">Categories</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('categories.*') ? 'show' : '' }}" id="category-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categories List</a></li>
        </ul>
      </div>
    </li>
    
    <!-- Brands -->
    <li class="nav-item {{ Route::is('brands.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('brands.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#brand-menu" aria-expanded="{{ Route::is('brands.*') ? 'true' : 'false' }}" aria-controls="brand-menu">
        <i class="menu-icon mdi mdi-star"></i>
        <span class="menu-title">Brands</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('brands.*') ? 'show' : '' }}" id="brand-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('brands.index') ? 'active' : '' }}" href="{{ route('brands.index') }}">Brands List</a></li>
        </ul>
      </div>
    </li>

    <!-- Products -->
    <li class="nav-item {{ Route::is('products.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('products.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#product-menu" aria-expanded="{{ Route::is('products.*') ? 'true' : 'false' }}" aria-controls="product-menu">
        <i class="menu-icon mdi mdi-package-variant-closed"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('products.*') ? 'show' : '' }}" id="product-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Products List</a></li>
        </ul>
      </div>
    </li>

    <!-- Sliders -->
    <!-- <li class="nav-item {{ Route::is('sliders.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('sliders.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#slider-menu" aria-expanded="{{ Route::is('sliders.*') ? 'true' : 'false' }}" aria-controls="slider-menu">
        <i class="menu-icon mdi mdi-image-multiple"></i>
        <span class="menu-title">Sliders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('sliders.*') ? 'show' : '' }}" id="slider-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('sliders.index') ? 'active' : '' }}" href="{{ route('sliders.index') }}">Sliders List</a></li>
        </ul>
      </div>
    </li> -->

    <!-- Orders -->
    <li class="nav-item {{ Route::is('orders.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('orders.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#order-menu" aria-expanded="{{ Route::is('orders.*') ? 'true' : 'false' }}" aria-controls="order-menu">
        <i class="menu-icon mdi mdi-cart"></i>
        <span class="menu-title">Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('orders.*') ? 'show' : '' }}" id="order-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">Orders List</a></li>
        </ul>
      </div>
    </li>

    <!-- Coupons -->
    <li class="nav-item {{ Route::is('coupons.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('coupons.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#coupon-menu" aria-expanded="{{ Route::is('coupons.*') ? 'true' : 'false' }}" aria-controls="coupon-menu">
        <i class="menu-icon mdi mdi-tag-heart"></i>
        <span class="menu-title">Coupons</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('coupons.*') ? 'show' : '' }}" id="coupon-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('coupons.index') ? 'active' : '' }}" href="{{ route('coupons.index') }}">Promo Codes</a></li>
        </ul>
      </div>
    </li>

    <!-- Contact Messages -->
    <li class="nav-item {{ Route::is('messages.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('messages.index') }}">
        <i class="menu-icon mdi mdi-email-outline"></i>
        <span class="menu-title">Customer Inquiries</span>
      </a>
    </li>

    <!-- Analytics -->
    <li class="nav-item {{ Route::is('analytics.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('analytics.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#chart-menu" aria-expanded="{{ Route::is('analytics.*') ? 'true' : 'false' }}" aria-controls="chart-menu">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Analytics</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('analytics.*') ? 'show' : '' }}" id="chart-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('analytics.index') ? 'active' : '' }}" href="{{ route('analytics.index') }}">Sales Charts</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item nav-category">System</li>

    <!-- User Management -->
    <li class="nav-item {{ Route::is('users.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('users.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#user-menu" aria-expanded="{{ Route::is('users.*') ? 'true' : 'false' }}" aria-controls="user-menu">
        <i class="menu-icon mdi mdi-account-group"></i>
        <span class="menu-title">User Accounts</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('users.*') ? 'show' : '' }}" id="user-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">Users List</a></li>
        </ul>
      </div>
    </li>

    <!-- Pages -->
    <li class="nav-item {{ Route::is('pages.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('pages.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#pages-menu" aria-expanded="{{ Route::is('pages.*') ? 'true' : 'false' }}" aria-controls="pages-menu">
        <i class="menu-icon mdi mdi-file-document-outline"></i>
        <span class="menu-title">Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('pages.*') ? 'show' : '' }}" id="pages-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('pages.about') ? 'active' : '' }}" href="{{ route('pages.about') }}">About Us</a></li>
          <li class="nav-item"><a class="nav-link {{ Route::is('pages.contact') ? 'active' : '' }}" href="{{ route('pages.contact') }}">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link {{ Route::is('pages.terms') ? 'active' : '' }}" href="{{ route('pages.terms') }}">Terms & Conditions</a></li>
          <li class="nav-item"><a class="nav-link {{ Route::is('faqs.index') ? 'active' : '' }}" href="{{ route('faqs.index') }}">Manage FAQs</a></li>
        </ul>
      </div>
    </li>

    <!-- Settings -->
    <li class="nav-item {{ Route::is('settings.*') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('settings.*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#settings-menu" aria-expanded="{{ Route::is('settings.*') ? 'true' : 'false' }}" aria-controls="settings-menu">
        <i class="menu-icon mdi mdi-cog"></i>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('settings.*') ? 'show' : '' }}" id="settings-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('settings.index') ? 'active' : '' }}" href="{{ route('settings.index') }}">Site Settings</a></li>
        </ul>
      </div>
    </li>

    <!-- Backups -->
    <li class="nav-item {{ Route::is('backups.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('backups.index') }}">
        <i class="menu-icon mdi mdi-database"></i>
        <span class="menu-title">Database Backups</span>
      </a>
    </li>

    <!-- Activity Log -->
    <li class="nav-item {{ Route::is('activities.*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('activities.index') }}">
        <i class="menu-icon mdi mdi-history"></i>
        <span class="menu-title">Activity Log</span>
      </a>
    </li>

    @endif

    @if(Auth::user()->isBuyer())
    <li class="nav-item nav-category">Shopping</li>
    <li class="nav-item {{ Route::is('my-orders') ? 'active' : '' }}">
      <a class="nav-link {{ Route::is('my-orders') ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#buyer-order-menu" aria-expanded="{{ Route::is('my-orders') ? 'true' : 'false' }}" aria-controls="buyer-order-menu">
        <i class="menu-icon mdi mdi-shopping"></i>
        <span class="menu-title">My Orders</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{ Route::is('my-orders') ? 'show' : '' }}" id="buyer-order-menu">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link {{ Route::is('my-orders') ? 'active' : '' }}" href="{{ route('my-orders') }}">View Orders</a></li>
        </ul>
      </div>
    </li>
    @endif
  </ul>
</nav>