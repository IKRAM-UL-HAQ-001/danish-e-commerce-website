        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            @if(Auth::user()->isAdmin())
            <li class="nav-item nav-category">Admin Management</li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index') }}">
                <i class="menu-icon mdi mdi-package-variant-closed"></i>
                <span class="menu-title">Products</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="menu-icon mdi mdi-view-list"></i>
                <span class="menu-title">Categories</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('sliders.index') }}">
                <i class="menu-icon mdi mdi-image-multiple"></i>
                <span class="menu-title">Sliders</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('orders.index') }}">
                <i class="menu-icon mdi mdi-cart"></i>
                <span class="menu-title">Manage Orders</span>
              </a>
            </li>
            @endif

            @if(Auth::user()->isBuyer())
            <li class="nav-item nav-category">Shopping</li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-shopping"></i>
                <span class="menu-title">My Orders</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-heart-outline"></i>
                <span class="menu-title">Wishlist</span>
              </a>
            </li>
            @endif

            <li class="nav-item nav-category">Profile Settings</li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">My Profile</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->