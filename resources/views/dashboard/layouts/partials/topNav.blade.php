      <!-- partial:partials/_navbar.html -->
       <style>
        .navbar-brand-wrapper {
    width: 220px !important;   /* increase container width */
}

.brand-logo img {
    height: 70px !important;   /* main control */
    width: auto !important;}

.brand-logo-mini img {
    height: 50px !important;
    width: auto !important;
}
.navbar-brand-wrapper {
    width: 260px;
}

       </style>
       <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-center flex-row">
      <!-- <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row"> -->
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ asset('frontend-assets/imgs/logo/logo.png') }}" 
            alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img src="{{ asset('frontend-assets/imgs/logo/logo.png') }}" alt="logo" class="logo-img" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              @php
                $hour = date('H');
                $greeting = 'Good Evening';
                if ($hour >= 5 && $hour < 12) {
                    $greeting = 'Good Morning';
                } elseif ($hour >= 12 && $hour < 17) {
                    $greeting = 'Good Afternoon';
                }
              @endphp
              <h1 class="welcome-text">{{ $greeting }}, <span class="text-black fw-bold">{{ Auth::user()->name }}</span></h1>
              <h3 class="welcome-sub-text">Dashboard overview and system insights </h3>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item d-none d-lg-block">
              <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                <span class="input-group-addon input-group-prepend border-right">
                  <span class="icon-calendar input-group-text calendar-icon"></span>
                </span>
                <input type="text" class="form-control">
              </div>
            </li>
            <li class="nav-item">
              <form class="search-form" action="#">
                <i class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
              </form>
            </li>
            <li class="nav-item dropdown">
              @php
                $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
                $recentPendingOrders = \App\Models\Order::with('user')->where('status', 'pending')->latest()->take(5)->get();
              @endphp
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="icon-bell"></i>
                @if($pendingOrdersCount > 0)
                  <span class="count"></span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 fw-medium float-start">You have {{ $pendingOrdersCount }} pending orders </p>
                  <a href="{{ route('orders.index') }}" class="badge badge-pill badge-primary float-end">View all</a>
                </a>
                @forelse($recentPendingOrders as $pOrder)
                <a href="{{ route('orders.index') }}" class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-cart-outline m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">New Order #{{ $pOrder->id }}</h6>
                    <p class="fw-light small-text mb-0"> From {{ $pOrder->user->name ?? 'Guest' }} </p>
                    <p class="fw-light small-text mb-0"> {{ $pOrder->created_at->diffForHumans() }} </p>
                  </div>
                </a>
                @empty
                <div class="dropdown-item preview-item py-3 text-center">
                  <p class="mb-0 fw-light small-text text-muted">No pending orders</p>
                </div>
                @endforelse
              </div>
            </li>
            <li class="nav-item dropdown">
              @php
                $unreadMessagesCount = \App\Models\ContactMessage::where('is_read', false)->count();
                $recentMessages = \App\Models\ContactMessage::latest()->take(5)->get();
              @endphp
              <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon-mail icon-lg"></i>
                @if($unreadMessagesCount > 0)
                  <span class="count"></span>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 fw-medium float-start">You have {{ $unreadMessagesCount }} unread messages </p>
                  <a href="{{ route('messages.index') }}" class="badge badge-pill badge-primary float-end">View all</a>
                </a>
                <div class="dropdown-divider"></div>
                @forelse($recentMessages as $message)
                <a href="{{ route('messages.index') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-email-outline mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">{{ $message->name }} @if(!$message->is_read) <span class="badge badge-xs badge-danger">New</span> @endif</p>
                    <p class="fw-light small-text mb-0"> {{ Str::limit($message->subject ?? $message->message, 30) }} </p>
                    <p class="fw-light small-text mb-0 text-muted">{{ $message->created_at->diffForHumans() }}</p>
                  </div>
                </a>
                @empty
                <div class="dropdown-item preview-item py-3 text-center">
                  <p class="mb-0 fw-light small-text text-muted">No messages yet</p>
                </div>
                @endforelse
              </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                @if(Auth::user()->profile_picture)
                    <img class="img-xs rounded-circle" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile image" style="object-fit: cover;">
                @else
                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="Profile image">
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  @if(Auth::user()->profile_picture)
                      <img class="img-md rounded-circle" src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile image" style="width: 100px; height: 100px; object-fit: cover;">
                  @else
                      <img class="img-md rounded-circle" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="Profile image">
                  @endif
                  <p class="mb-1 mt-3 fw-semibold">{{ Auth::user()->name }}</p>
                  <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('profile.index') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                <a href="{{ route('messages.index') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a href="{{ route('activities.index') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity Log</a>
                <a href="{{ route('faqs.index') }}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> Manage FAQ</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->