<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ config('app.name') }} - Beauty & Cosmetic Store">

  <title>@yield('title') | {{ config('app.name') }}</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('frontend-assets/imgs/logo/favicon-white.png') }}">

  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/fontawesome/fontawesome-pro.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/swiper/swiper-bundle.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/menu/meanmenu.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/popup/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/nice-select/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/wow/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend-assets/vandor/odometer/odometer-theme-default.css') }}">

  <link rel="stylesheet" href="{{ asset('frontend-assets/css/style.css') }}">
  @stack('styles')
</head>

<body>

  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
  </div>
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <!-- Search Area Start (same as header-area-2) -->
      <!-- Side Panel Start -->
      <aside class="fix">
        <div class="side-info">
          <div class="side-info-content">
            <div class="offset-widget offset-header">
              <div class="offset-logo">
                <a href="{{ route('home') }}">
                  <img src="{{ asset('frontend-assets/imgs/logo/logo.png') }}" alt="{{ config('app.name') }} Logo" />
                </a>
              </div>
              <button id="side-info-close" class="side-info-close">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="mobile-menu d-xl-none fix"></div>
            <div class="offset-widget-box">
              <h2 class="title">Social Info</h2>
              <div class="offset-social">
                <a href="#" class="facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="twitter" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="linkedin" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="youtube" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
              </div>
            </div>
          </div>
        </div>
      </aside>
      <div class="offcanvas-overlay"></div>

      <!-- Header start -->
      <header class="header-area header-layoutone header-sticky">
        <div class="header-main">
          <div class="container">
            <div class="row align-items-center justify-content-between">
              <!-- Logo Column -->
              <div class="col-auto">
                <div class="header__logo">
                  <a href="{{ route('home') }}">
                    <img src="{{ asset('frontend-assets/imgs/logo/logo.png') }}" class="normal-logo" alt="Site Logo" />
                  </a>
                </div>
              </div>

              <!-- Navigation Column -->
              <div class="col d-none d-xl-flex justify-content-center">
                <nav class="main-menu">
                  <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <!-- <li class="menu-item-has-children">
                      <a href="#">Shop</a>
                      <ul class="dp-menu">
                        <li><a href="#">Shop Sidebar</a></li>
                        <li><a href="#">Shop List</a></li>
                        <li><a href="#">Product Details</a></li>
                        <li><a href="#">Cart</a></li>
                        <li><a href="#">Checkout</a></li>
                      </ul>
                    </li> -->
                    <!-- <li><a href="#">Blog</a></li> -->
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                  </ul>
                </nav>
              </div>

              <!-- Actions Column -->
              <div class="col-auto">
                <div class="header-right d-flex align-items-center gap-3">

                  <!-- Search Button -->
                  <div class="header__search">
                    <button class="search-open-btn" type="button" aria-expanded="false" aria-controls="site-search">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M23.707 22.293L16.882 15.468C18.204 13.835 19 11.76 19 9.50002C19 4.26202 14.738 0 9.49997 0C4.26197 0 0 4.26197 0 9.49997C0 14.738 4.26202 19 9.50002 19C11.76 19 13.835 18.204 15.468 16.882L22.293 23.707C22.488 23.902 22.744 24 23 24C23.256 24 23.512 23.902 23.707 23.707C24.098 23.316 24.098 22.684 23.707 22.293ZM9.50002 17C5.364 17 2.00002 13.636 2.00002 9.49997C2.00002 5.36395 5.364 1.99997 9.50002 1.99997C13.636 1.99997 17 5.36395 17 9.49997C17 13.636 13.636 17 9.50002 17Z"
                          fill="#070713" />
                      </svg>
                    </button>
                    <div id="site-search" class="search-panel" role="dialog" aria-hidden="true"
                      aria-label="Site search">
                      <div class="search-backdrop"></div>
                      <div class="search-inner" role="document">
                        <button class="search-close" type="button" aria-label="Close search">&times;</button>
                        <form class="search-form" action="/search" method="get" role="search">
                          <input type="search" name="q" class="search-input" placeholder="Search..."
                            autocomplete="off" />
                          <button type="submit" class="search-submit" aria-label="Submit search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- User Icon -->
                  @auth
                    <a href="{{ route('dashboard') }}" class="action-btn" aria-label="Dashboard">
                      <i class="fa-solid fa-gauge"></i>
                    </a>
                  @else
                    <a href="{{ route('login') }}" class="action-btn" aria-label="User">
                      <i class="fa-solid fa-user"></i>
                    </a>
                  @endauth

                  <!-- Wishlist Icon -->
                  <a href="#" class="action-btn d-none d-lg-flex" aria-label="Wishlist">
                    <i class="fa-solid fa-heart"></i>
                  </a>

                  <!-- Cart Icon with Badge -->
                  <a href="#" class="action-btn position-relative" aria-label="Cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span
                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light"
                      style="font-size: 10px; padding: 4px 6px;">
                      0
                    </span>
                  </a>

                  <!-- Mobile Menu Toggle -->
                  <div class="header__navicon d-xl-none">
                    <div class="side-toggle">
                      <a class="bar-icon" href="javascript:void(0)">
                        <span></span>
                        <span></span>
                        <span></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Header area end -->
