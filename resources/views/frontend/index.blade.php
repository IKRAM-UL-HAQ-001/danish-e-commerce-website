@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

        <!-- Intro1 Section Start -->
        <section class="intro1 rr-ov-hidden">
          <div class="intro1__bg-text" style="font-size: 150px;">AenumLuxeStyle</div>
          <div class="container">
            <div class="row align-items-center">
              <!-- Left Column: Content -->
              <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay=".3s">
                <div class="intro1__content">
                  <span class="intro1__content-subtext">Glow Beyond Beauty</span>
                  <h1 class="intro1__content-title">Beauty That Shines Naturally</h1>
                  <p class="intro1__content-desc">Clean, cruelty-free, and glow-boosting products for every shade of
                    beauty. Clean, boosting products.</p>
                  <div class="intro1__content-button">
                    <a href="{{ route('public.shop') }}" class="rr-btn-button">
                      <span class="text">Explore Collection</span>
                      <span class="icon">
                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                            stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </span>
                    </a>
                  </div>
                </div>
              </div>

              <!-- Center: Main Image -->
              <div class="col-lg-4 col-md-7 col-sm-12 wow fadeInUp" data-wow-delay=".5s">
                <div class="intro1__thumb">
                  <img src="{{asset('frontend-assets/imgs/hero/hero-thumb1_1.png')}}" alt="Beauty model" class="main-img">
                </div>
              </div>

              <!-- Right: Video/Card -->
              <div class="col-lg-3 col-md-5 col-sm-12 wow fadeInUp" data-wow-delay=".7s">
                <div class="intro1__video">
                  <div class="intro1__video-card">
                    <div class="intro1__video-thumb">
                      <img src="{{ asset('frontend-assets/imgs/hero/hero-thumb1_2.png') }}" alt="Video cover">
                      <a href="https://www.youtube.com/watch?v=kYI9F2XfLRE" class="popup-video video-btn">
                        <i class="fa-solid fa-play"></i>
                      </a>
                    </div>
                    <div class="intro1__video-content">
                      <p>Clean, cruelty-free, and glow-boosting products for every shade of beauty.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Decorators -->
          <div class="intro1__shape1"><img src="{{ asset('frontend-assets/imgs/hero/hero-shape1_1.png') }}" alt="shape"></div>
          <div class="intro1__shape2"><img src="{{ asset('frontend-assets/imgs/hero/hero-shape1_2.png') }}" alt="shape"></div>
          <div class="intro1__shape3"><img src="{{ asset('frontend-assets/imgs/hero/hero-shape1_3.png') }}" alt="shape"></div>
        </section>
        <!-- Intro1 Section End -->





        <section class="category1 section-spacing-120 rr-ov-hidden">
          <div class="category1-wrapper">
            <div class="container rr-container-1350">
              <div class="section-heading wow fadeInRight" data-wow-delay="0.3s">
                <h2 class="section-heading__title">OUR CATEGORY</h2>
              </div>
              <div class="row g-4">
                @if($categories->count() >= 3)
                <div class="col-md-3 col-xl-3">
                  <div class="category1-item wow fadeInRight" data-wow-delay="0.2s">
                    <div class="category1-item__thumb">
                      <img src="{{ asset('frontend-assets/imgs/category/category-thumb1_1.jpg') }}" alt="thumb">
                    </div>
                    <div class="category1-item__content1">
                      <p class="category1-item__content1-decs">Professional</p>
                      <h2 class="category1-item__content1-title"><a href="#">{{ $categories[0]->name }}</a></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-6">
                  <div class="category1-item wow fadeInRight" data-wow-delay="0.3s">
                    <div class="category1-item__thumb">
                      <img src="{{ asset('frontend-assets/imgs/category/category-thumb1_2.jpg') }}" alt="thumb">
                    </div>
                    <div class="category1-item__offer">Up to 20%</div>
                    <div class="category1-item__content2">
                      <p class="category1-item__content2-decs">Makeup</p>
                      <h2 class="category1-item__content2-title"><a href="#">{{ $categories[1]->name }}</a></h2>
                      <div class="category1-item__button">
                        <a href="#" class="rr-btn-button2">
                          <span class="text">Shop now</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-xl-3">
                  <div class="category1-item wow fadeInRight" data-wow-delay="0.5s">
                    <div class="category1-item__thumb">
                      <img src="{{ asset('frontend-assets/imgs/category/category-thumb1_3.jpg') }}" alt="thumb">
                    </div>
                    <div class="category1-item__content3">
                      <p class="category1-item__content3-decs">Trending</p>
                      <h2 class="category1-item__content3-title"><a href="#">{{ $categories[2]->name }}</a></h2>
                    </div>
                  </div>
                </div>
                @else
                <div class="col-md-3 col-xl-3">
                  <div class="category1-item wow fadeInRight" data-wow-delay="0.2s">
                    <div class="category1-item__thumb">
                      <img src="{{ asset('frontend-assets/imgs/category/category-thumb1_1.jpg') }}" alt="thumb">
                    </div>
                    <div class="category1-item__content1">
                      <p class="category1-item__content1-decs">Professional</p>
                      <h2 class="category1-item__content1-title"><a href="#">Eye Lines</a></h2>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-6">
                  <div class="category1-item wow fadeInRight" data-wow-delay="0.3s">
                    <div class="category1-item__thumb">
                      <img src="{{ asset('frontend-assets/imgs/category/category-thumb1_2.jpg') }}" alt="thumb">
                    </div>
                    <div class="category1-item__offer">Up to 20%</div>
                    <div class="category1-item__content2">
                      <p class="category1-item__content2-decs">Makeup</p>
                      <h2 class="category1-item__content2-title"><a href="#">Foundation Collection</a></h2>
                      <div class="category1-item__button">
                        <a href="#" class="rr-btn-button2">
                          <span class="text">Shop now</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 col-xl-3">
                  <div class="category1-item wow fadeInRight" data-wow-delay="0.5s">
                    <div class="category1-item__thumb">
                      <img src="{{ asset('frontend-assets/imgs/category/category-thumb1_3.jpg') }}" alt="thumb">
                    </div>
                    <div class="category1-item__content3">
                      <p class="category1-item__content3-decs">Trending</p>
                      <h2 class="category1-item__content3-title"><a href="#">Blush</a></h2>
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </section>


        <section class="trending-product section-spacing-120 rr-ov-hidden pt-0">
          <div class="container rr-container-1350">
            <div class="row gy-5 d-flex align-items-center justify-content-between">
              <div class="col-xl-6 d-flex justify-content-start">
                <div class="section-heading">
                  <h2 class="section-heading__title mb-0 wow fadeInUp" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">TRENDING PRODUCT</h2>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="trending-product__button d-flex justify-content-xl-end wow fadeInUp" data-wow-delay=".5s"
                  style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                  <a href="{{ route('public.shop') }}" class="rr-btn-button">
                    <span class="text">View All Featured</span>
                    <span class="icon">
                      <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                          stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <div class="trending-product-wrapper">
              <div class="row g-4">
                @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                  <div class="trending-product-card">
                    <div class="trending-product-card__thumb">
                      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                      @if($product->is_new)
                        <div class="trending-product-card__thumb-offer">New</div>
                      @endif
                      <div class="trending-product-card__thumb-btn-wrapper">
                        <a href="#" class="rr-btn-button4">
                          <span class="text">Add to Cart</span>
                          <span class="icon">
                            <svg width="11" height="7" viewBox="0 0 11 7" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M0.419678 3.21674H10.2098M10.2098 3.21674L7.41265 6.01393M10.2098 3.21674L7.41265 0.419556"
                                stroke="#0C0C0C" stroke-width="0.839157" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </svg>
                          </span>
                        </a>
                      </div>
                    </div>
                    <div class="trending-product-card__content">
                      <h3 class="trending-product-card__content-title">
                        <a href="{{ route('public.product.details', $product->slug) }}">{{ $product->name }}</a>
                      </h3>
                      <ul class="trending-product-card__content-list">
                        <li class="trending-product-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                        <li class="trending-product-card__content-list-point">5.0</li>
                        <li class="trending-product-card__content-list-text">(0 Reviews)</li>
                      </ul>
                      <h4 class="trending-product-card__content-dollar">${{ number_format($product->price, 2) }}</h4>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </section>


        <section class="offer1 section-spacing-120 bg-light-pick rr-ov-hidden pb-0">
          <div class="container rr-container-1350">
            <div class="offer1-wrapper background-image wow fadeInUp"
              style="background-image: url({{ asset('frontend-assets/imgs/offer/offer-banner.jpg') }});" data-wow-delay=".3s">
              <div class="row">
                <div class="col-xl-12 d-flex justify-content-end">
                  <div class="offer1__content">
                    <span class="offer1__content-text">A nature`s touch</span>
                    <h2 class="offer1__content-title"><span class="subtitle">Get 25%</span> Off All Cosmetic Creams</h2>
                    <p class="offer1__content-subtext">Pamper your skin with our nourishing cosmetic creams — crafted
                      for radiant, silky-smooth results. Enjoy 25% off today </p>
                    <div class="offer1__content-button">
                      <a href="{{ route('public.shop') }}" class="rr-btn-button2">
                        <span class="text">Browse product</span>
                        <span class="icon">
                          <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M0.419556 3.21674H10.2097M10.2097 3.21674L7.41253 6.01393M10.2097 3.21674L7.41253 0.419556"
                              stroke="#0C0C0C" stroke-width="0.839157" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                          </svg>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <section class="best-selling-product section-spacing-120 bg-light-pick rr-ov-hidden pb-0">
          <div class="container rr-container-1350">
            <div class="row gy-5 d-flex justify-content-between">
              <div class="col-xl-6 d-flex justify-content-start wow fadeInUp" data-wow-delay=".3s">
                <div class="section-heading">
                  <h2 class="section-heading__title wow fadeInUp" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">BEST SELLING PRODUCTS
                  </h2>
                </div>
              </div>
              <div class="col-xl-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="best-selling-product__button d-flex justify-content-xl-end">
                  <a href="{{ route('public.shop') }}" class="rr-btn-button">
                    <span class="text">View All Featured</span>
                    <span class="icon">
                      <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                          stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </span>
                  </a>
                </div>
              </div>
            </div>
            <div class="best-selling-product-tab-header">
              <ul class="nav border-0" role="tablist">
                <li class="nav-item wow fadeInUp" data-wow-delay=".5s" role="presentation">
                  <a href="#All-product" id="tab-All-product" data-bs-toggle="tab" class="nav-link1 active"
                    aria-selected="true" role="tab" aria-controls="All-product">
                    All
                  </a>
                </li>
                <li class="nav-item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                  <a href="#Man" id="tab-Man" data-bs-toggle="tab" class="nav-link2" aria-selected="false" role="tab"
                    tabindex="-1" aria-controls="Man">
                    Man
                  </a>
                </li>
                <li class="nav-item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                  <a href="#Women" id="tab-Women" data-bs-toggle="tab" class="nav-link3" aria-selected="false"
                    role="tab" tabindex="-1" aria-controls="Women">
                    Women
                  </a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div id="All-product" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-All-product">
                <div class="best-selling-product-items">
                  <div class="row g-4 d-flex justify-content-center">
                    <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-delay=".3s">
                      <div class="best-selling-product-card">
                        <div class="best-selling-product-card__thumb1">
                          <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="thumb">
                        </div>
                        <div class="best-selling-product-card__content1">
                          <h3 class="best-selling-product-card__content1-title"><a href="{{ route('public.shop') }}">Velvet
                              Dew Cushion Compact</a></h3>
                          <ul class="best-selling-product-card__content1-list">
                            <li class="best-selling-product-card__content1-list-start"><i
                                class="fa-solid fa-star fa-fw"></i>
                            </li>
                            <li class="best-selling-product-card__content1-list-point">5.0</li>
                            <li class="best-selling-product-card__content1-list-text">(135 Reviews)</li>
                          </ul>
                          <h4 class="best-selling-product-card__content1-dollar">$12.00</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                      <div class="row g-4 d-flex justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_2.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">Radiant Pearl Foundation</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$12.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_3.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">PureBloom Lip Balm</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$12.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_4.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a href="{{ route('public.shop') }}">Brow
                                  setter shaping</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$06.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_5.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">Beauty Bloom Skin Perfector</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$09.00</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="Man" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-Man">
                <div class="best-selling-product-items">
                  <div class="row g-4 d-flex justify-content-center">
                    <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-delay=".3s">
                      <div class="best-selling-product-card">
                        <div class="best-selling-product-card__thumb1">
                          <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="thumb">
                        </div>
                        <div class="best-selling-product-card__content1">
                          <h3 class="best-selling-product-card__content1-title"><a href="{{ route('public.shop') }}">Velvet
                              Dew Cushion Compact</a></h3>
                          <ul class="best-selling-product-card__content1-list">
                            <li class="best-selling-product-card__content1-list-start"><i
                                class="fa-solid fa-star fa-fw"></i>
                            </li>
                            <li class="best-selling-product-card__content1-list-point">5.0</li>
                            <li class="best-selling-product-card__content1-list-text">(135 Reviews)</li>
                          </ul>
                          <h4 class="best-selling-product-card__content1-dollar">$12.00</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                      <div class="row g-4 d-flex justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_2.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">Radiant Pearl Foundation</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$12.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_3.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">PureBloom Lip Balm</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$12.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_4.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a href="{{ route('public.shop') }}">Brow
                                  setter shaping</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$06.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_5.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">Beauty Bloom Skin Perfector</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$09.00</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="Women" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-Women">
                <div class="best-selling-product-items">
                  <div class="row g-4 d-flex justify-content-center">
                    <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-delay=".3s">
                      <div class="best-selling-product-card">
                        <div class="best-selling-product-card__thumb1">
                          <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="thumb">
                        </div>
                        <div class="best-selling-product-card__content1">
                          <h3 class="best-selling-product-card__content1-title"><a href="{{ route('public.shop') }}">Velvet
                              Dew Cushion Compact</a></h3>
                          <ul class="best-selling-product-card__content1-list">
                            <li class="best-selling-product-card__content1-list-start"><i
                                class="fa-solid fa-star fa-fw"></i>
                            </li>
                            <li class="best-selling-product-card__content1-list-point">5.0</li>
                            <li class="best-selling-product-card__content1-list-text">(135 Reviews)</li>
                          </ul>
                          <h4 class="best-selling-product-card__content1-dollar">$12.00</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-7">
                      <div class="row g-4 d-flex justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_2.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">Radiant Pearl Foundation</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$12.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_3.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">PureBloom Lip Balm</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$12.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_4.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a href="{{ route('public.shop') }}">Brow
                                  setter shaping</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$06.00</h4>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_5.jpg') }}" alt="thumb">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title"><a
                                  href="{{ route('public.shop') }}">Beauty Bloom Skin Perfector</a></h3>
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start">
                                  <i class="fa-solid fa-star fa-fw"></i>
                                </li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(135 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">$09.00</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <section class="cta1 section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            <div class="row gy-5 d-flex justify-content-center justify-content-between">
              <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="cta1-card">
                  <div class="cta1-card__icon">
                    <img src="{{ asset('frontend-assets/imgs/cta/cta-icon1_1.png') }}" alt="icon">
                  </div>
                  <h3 class="cta1-card__title">Beauty Cosmetic</h3>
                  <p class="cta1-card__subtitle">Enhance your natural beauty with our premium cosmetic collection —
                    designed to nourish</p>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="cta1-card">
                  <div class="cta1-card__icon">
                    <img src="{{ asset('frontend-assets/imgs/cta/cta-icon1_2.png') }}" alt="icon">
                  </div>
                  <h3 class="cta1-card__title">We love what We do</h3>
                  <p class="cta1-card__subtitle">We love what we do — creating beauty products that inspire confidence,
                    celebrate.</p>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="cta1-card">
                  <div class="cta1-card__icon">
                    <img src="{{ asset('frontend-assets/imgs/cta/cta-icon1_3.png') }}" alt="icon">
                  </div>
                  <h3 class="cta1-card__title">Professional products</h3>
                  <p class="cta1-card__subtitle">Experience salon-quality results with our professional products —
                    expertly crafted to deliver</p>
                </div>
              </div>
            </div>
          </div>
        </section>






        <!-- Testimonial Section Start -->
        <section class="testimonial1 section-spacing-120 rr-ov-hidden pt-0">
          <div class="container rr-container-1350">
            <div class="section-heading wow fadeInUp" data-wow-delay=".3s">
              <h2 class="section-heading__title">WHAT OUR CUSTOMERS SAY</h2>
            </div>
            <div class="row g-4">
              <!-- Card 1 -->
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="testimonial1-card dark-card"
                  style="background-image: url({{ asset('frontend-assets/imgs/testimonials/testimonial-thumb1_1.jpg') }});">
                  <div class="testimonial1-card__content">
                    <div class="testimonial1-card__quote">
                      <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="testimonial1-card__text">“I’m so happy to find a cruelty-free brand that actually works.
                      My skin feels soft and hydrated,”</p>
                    <div class="testimonial1-card__author-meta d-flex align-items-center gap-2">
                      <h3 class="testimonial1-card__author-name">Nusrat Jahan</h3>
                      <span class="testimonial1-card__author-designation">Product designer</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 2 -->
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="testimonial1-card light-card">
                  <div class="testimonial1-card__product-img">
                    <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_3.jpg') }}" alt="product">
                  </div>
                  <div class="testimonial1-card__content">
                    <div class="testimonial1-card__quote">
                      <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="testimonial1-card__text">“I’m so happy to find a cruelty-free brand that actually works.
                      My skin feels soft and hydrated, !”</p>
                    <div class="testimonial1-card__author-meta d-flex align-items-center gap-3">
                      <div class="testimonial1-card__author-thumb">
                        <img src="{{ asset('frontend-assets/imgs/hero/hero-rating-user2_1.png') }}" alt="user">
                      </div>
                      <div class="testimonial1-card__author">
                        <h3 class="testimonial1-card__author-name">Nusrat Jahan</h3>
                        <span class="testimonial1-card__author-designation">Product designer</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 3 -->
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="testimonial1-card dark-card"
                  style="background-image: url({{ asset('frontend-assets/imgs/testimonials/testimonial-thumb1_2.jpg') }});">
                  <div class="testimonial1-card__content">
                    <div class="testimonial1-card__quote">
                      <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="testimonial1-card__text">“I’m so happy to find a cruelty-free brand that actually works.
                      My skin feels soft and hydrated,”</p>
                    <div class="testimonial1-card__author-meta d-flex align-items-center gap-2">
                      <h3 class="testimonial1-card__author-name">Nusrat Jahan</h3>
                      <span class="testimonial1-card__author-designation">Product designer</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 4 -->
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="testimonial1-card light-card">
                  <div class="testimonial1-card__product-img">
                    <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_5.jpg') }}" alt="product">
                  </div>
                  <div class="testimonial1-card__content">
                    <div class="testimonial1-card__quote">
                      <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="testimonial1-card__text">“I feel more confident than ever. The products enhance my natural
                      features without feeling heavy or artificial.!”</p>
                    <div class="testimonial1-card__author-meta d-flex align-items-center gap-3">
                      <div class="testimonial1-card__author-thumb">
                        <img src="{{ asset('frontend-assets/imgs/hero/hero-rating-user2_2.png') }}" alt="user">
                      </div>
                      <div class="testimonial1-card__author">
                        <h4 class="testimonial1-card__author-name">Sofia Rahman</h4>
                        <span class="testimonial1-card__author-designation">Product designer</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 5 -->
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="testimonial1-card dark-card"
                  style="background-image: url({{ asset('frontend-assets/imgs/testimonials/testimonial-thumb1_3.jpg') }});">
                  <div class="testimonial1-card__content">
                    <div class="testimonial1-card__quote">
                      <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="testimonial1-card__text">“I’m so happy to find a cruelty-free brand that actually works.
                      My skin feels soft and hydrated,”</p>
                    <div class="testimonial1-card__author-meta d-flex align-items-center gap-2">
                      <h4 class="testimonial1-card__author-name">Nusrat Jahan</h4>
                      <span class="testimonial1-card__author-designation">Product designer</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Card 6 -->
              <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="testimonial1-card light-card">
                  <div class="testimonial1-card__product-img">
                    <img src="{{ asset('frontend-assets/imgs/best-selling-products/best-selling-products1_3.jpg') }}" alt="product">
                  </div>
                  <div class="testimonial1-card__content">
                    <div class="testimonial1-card__quote">
                      <i class="fa-solid fa-quote-left"></i>
                    </div>
                    <p class="testimonial1-card__text">“I’ve tried countless beauty brands, but nothing compares to
                      this. The texture is silky, lightweight, .”</p>
                    <div class="testimonial1-card__author-meta d-flex align-items-center gap-3">
                      <div class="testimonial1-card__author-thumb">
                        <img src="{{ asset('frontend-assets/imgs/hero/hero-rating-user2_3.png') }}" alt="user">
                      </div>
                      <div class="testimonial1-card__author">
                        <h4 class="testimonial1-card__author-name">Sabrina Alam</h4>
                        <span class="testimonial1-card__author-designation">Product designer</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Testimonial Section End -->

        <section class="blog1 section-spacing-120 rr-ov-hidden pt-0">
          <div class="container rr-container-1350">
            <div class="row gy-5 d-flex align-items-center justify-content-between">
              <div class="col-xl-6 d-flex justify-content-start">
                <div class="section-heading">
                  <h2 class="section-heading__title mb-0 wow fadeInUp" data-wow-delay=".5s">RECENT BLOG & ARTICLES</h2>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="trending-product__button d-flex justify-content-xl-end wow fadeInUp" data-wow-delay=".5s">
                  <a href="blog.html" class="rr-btn-button">
                    <span class="text">View All Articles</span>
                    <span class="icon">
                      <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                          stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </svg>
                    </span>
                  </a>
                </div>
              </div>
            </div>

            <div class="blog1-wrapper">
              <div class="row g-4">
                <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                  <div class="blog1-card">
                    <div class="blog1-card__thumb">
                      <img src="{{ asset('frontend-assets/imgs/blog/blog-thumb1_1.jpg') }}" alt="thumb">
                    </div>
                    <div class="blog1-card__content">
                      <span class="blog1-card__content-tipsitems">MakeupTips</span>
                      <h3 class="blog1-card__content-title"><a href="blog-details.html">Makeup Mistakes You Didn’t Know
                          You Were Making</a>
                      </h3>
                      <div class="blog1-card__content-meta">
                        <div class="blog1-card__content-meta-item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10.0007 1.04688C8.95088 1.04688 7.94406 1.46391 7.20173 2.20624C6.4594 2.94858 6.04236 3.95539 6.04236 5.00521C6.04236 6.05502 6.4594 7.06184 7.20173 7.80417C7.94406 8.5465 8.95088 8.96354 10.0007 8.96354C11.0505 8.96354 12.0573 8.5465 12.7997 7.80417C13.542 7.06184 13.959 6.05502 13.959 5.00521C13.959 3.95539 13.542 2.94858 12.7997 2.20624C12.0573 1.46391 11.0505 1.04688 10.0007 1.04688ZM7.29236 5.00521C7.29236 4.28691 7.57771 3.59804 8.08562 3.09013C8.59353 2.58222 9.2824 2.29688 10.0007 2.29688C10.719 2.29688 11.4079 2.58222 11.9158 3.09013C12.4237 3.59804 12.709 4.28691 12.709 5.00521C12.709 5.7235 12.4237 6.41238 11.9158 6.92029C11.4079 7.4282 10.719 7.71354 10.0007 7.71354C9.2824 7.71354 8.59353 7.4282 8.08562 6.92029C7.57771 6.41238 7.29236 5.7235 7.29236 5.00521ZM10.0007 10.2135C8.0732 10.2135 6.29653 10.6519 4.9807 11.3919C3.68403 12.1219 2.70903 13.2269 2.70903 14.5885V14.6735C2.7082 15.6419 2.70736 16.8569 3.7732 17.7252C4.29736 18.1519 5.03153 18.456 6.0232 18.656C7.01653 18.8577 8.31236 18.9635 10.0007 18.9635C11.689 18.9635 12.984 18.8577 13.979 18.656C14.9707 18.456 15.704 18.1519 16.229 17.7252C17.2949 16.8569 17.2932 15.6419 17.2924 14.6735V14.5885C17.2924 13.2269 16.3174 12.1219 15.0215 11.3919C13.7049 10.6519 11.929 10.2135 10.0007 10.2135ZM3.95903 14.5885C3.95903 13.8794 4.47736 13.1094 5.5932 12.4819C6.68986 11.8652 8.24653 11.4635 10.0015 11.4635C11.7549 11.4635 13.3115 11.8652 14.4082 12.4819C15.5249 13.1094 16.0424 13.8794 16.0424 14.5885C16.0424 15.6785 16.009 16.2919 15.439 16.7552C15.1307 17.0069 14.614 17.2527 13.7307 17.431C12.8499 17.6094 11.6457 17.7135 10.0007 17.7135C8.3557 17.7135 7.1507 17.6094 6.2707 17.431C5.38736 17.2527 4.8707 17.0069 4.56236 16.756C3.99236 16.2919 3.95903 15.6785 3.95903 14.5885Z"
                              fill="#2A514C"></path>
                          </svg>
                          By Benjamin
                        </div>
                        <div class="blog1-card__content-meta-item">
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <g clip-path="url(#clip0_95_78_1)">
                              <path
                                d="M3.33334 5.83317C3.33334 5.39114 3.50894 4.96722 3.8215 4.65466C4.13406 4.3421 4.55798 4.1665 5.00001 4.1665H15C15.442 4.1665 15.866 4.3421 16.1785 4.65466C16.4911 4.96722 16.6667 5.39114 16.6667 5.83317V15.8332C16.6667 16.2752 16.4911 16.6991 16.1785 17.0117C15.866 17.3242 15.442 17.4998 15 17.4998H5.00001C4.55798 17.4998 4.13406 17.3242 3.8215 17.0117C3.50894 16.6991 3.33334 16.2752 3.33334 15.8332V5.83317Z"
                                stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M13.3333 2.5V5.83333" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M6.66666 2.5V5.83333" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M3.33334 9.1665H16.6667" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M9.16666 12.5H9.99999" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M10 12.5V15" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </g>
                            <defs>
                              <clipPath id="clip0_95_78_1">
                                <rect width="20" height="20" fill="white"></rect>
                              </clipPath>
                            </defs>
                          </svg>
                          Sep 20, 2024
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                  <div class="blog1-card">
                    <div class="blog1-card__thumb">
                      <img src="{{ asset('frontend-assets/imgs/blog/blog-thumb1_2.jpg') }}" alt="thumb">
                    </div>
                    <div class="blog1-card__content">
                      <span class="blog1-card__content-tipsitems">Skincare</span>
                      <h3 class="blog1-card__content-title"><a href="blog-details.html">How to Prep Your Skin Before
                          Applying Makeup</a>
                      </h3>
                      <div class="blog1-card__content-meta">
                        <div class="blog1-card__content-meta-item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10.0007 1.04688C8.95088 1.04688 7.94406 1.46391 7.20173 2.20624C6.4594 2.94858 6.04236 3.95539 6.04236 5.00521C6.04236 6.05502 6.4594 7.06184 7.20173 7.80417C7.94406 8.5465 8.95088 8.96354 10.0007 8.96354C11.0505 8.96354 12.0573 8.5465 12.7997 7.80417C13.542 7.06184 13.959 6.05502 13.959 5.00521C13.959 3.95539 13.542 2.94858 12.7997 2.20624C12.0573 1.46391 11.0505 1.04688 10.0007 1.04688ZM7.29236 5.00521C7.29236 4.28691 7.57771 3.59804 8.08562 3.09013C8.59353 2.58222 9.2824 2.29688 10.0007 2.29688C10.719 2.29688 11.4079 2.58222 11.9158 3.09013C12.4237 3.59804 12.709 4.28691 12.709 5.00521C12.709 5.7235 12.4237 6.41238 11.9158 6.92029C11.4079 7.4282 10.719 7.71354 10.0007 7.71354C9.2824 7.71354 8.59353 7.4282 8.08562 6.92029C7.57771 6.41238 7.29236 5.7235 7.29236 5.00521ZM10.0007 10.2135C8.0732 10.2135 6.29653 10.6519 4.9807 11.3919C3.68403 12.1219 2.70903 13.2269 2.70903 14.5885V14.6735C2.7082 15.6419 2.70736 16.8569 3.7732 17.7252C4.29736 18.1519 5.03153 18.456 6.0232 18.656C7.01653 18.8577 8.31236 18.9635 10.0007 18.9635C11.689 18.9635 12.984 18.8577 13.979 18.656C14.9707 18.456 15.704 18.1519 16.229 17.7252C17.2949 16.8569 17.2932 15.6419 17.2924 14.6735V14.5885C17.2924 13.2269 16.3174 12.1219 15.0215 11.3919C13.7049 10.6519 11.929 10.2135 10.0007 10.2135ZM3.95903 14.5885C3.95903 13.8794 4.47736 13.1094 5.5932 12.4819C6.68986 11.8652 8.24653 11.4635 10.0015 11.4635C11.7549 11.4635 13.3115 11.8652 14.4082 12.4819C15.5249 13.1094 16.0424 13.8794 16.0424 14.5885C16.0424 15.6785 16.009 16.2919 15.439 16.7552C15.1307 17.0069 14.614 17.2527 13.7307 17.431C12.8499 17.6094 11.6457 17.7135 10.0007 17.7135C8.3557 17.7135 7.1507 17.6094 6.2707 17.431C5.38736 17.2527 4.8707 17.0069 4.56236 16.756C3.99236 16.2919 3.95903 15.6785 3.95903 14.5885Z"
                              fill="#2A514C"></path>
                          </svg>
                          By Benjamin
                        </div>
                        <div class="blog1-card__content-meta-item">
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <g clip-path="url(#clip0_95_78_2)">
                              <path
                                d="M3.33334 5.83317C3.33334 5.39114 3.50894 4.96722 3.8215 4.65466C4.13406 4.3421 4.55798 4.1665 5.00001 4.1665H15C15.442 4.1665 15.866 4.3421 16.1785 4.65466C16.4911 4.96722 16.6667 5.39114 16.6667 5.83317V15.8332C16.6667 16.2752 16.4911 16.6991 16.1785 17.0117C15.866 17.3242 15.442 17.4998 15 17.4998H5.00001C4.55798 17.4998 4.13406 17.3242 3.8215 17.0117C3.50894 16.6991 3.33334 16.2752 3.33334 15.8332V5.83317Z"
                                stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M13.3333 2.5V5.83333" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M6.66666 2.5V5.83333" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M3.33334 9.1665H16.6667" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M9.16666 12.5H9.99999" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M10 12.5V15" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </g>
                            <defs>
                              <clipPath id="clip0_95_78_2">
                                <rect width="20" height="20" fill="white"></rect>
                              </clipPath>
                            </defs>
                          </svg>
                          Sep 20, 2024
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                  <div class="blog1-card">
                    <div class="blog1-card__thumb">
                      <img src="{{ asset('frontend-assets/imgs/blog/blog-thumb1_3.jpg') }}" alt="thumb">
                    </div>
                    <div class="blog1-card__content">
                      <span class="blog1-card__content-tipsitems">Health</span>
                      <h3 class="blog1-card__content-title"><a href="blog-details.html">Beginner’s Guide to Contouring
                          and Highlighting</a>
                      </h3>
                      <div class="blog1-card__content-meta">
                        <div class="blog1-card__content-meta-item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10.0007 1.04688C8.95088 1.04688 7.94406 1.46391 7.20173 2.20624C6.4594 2.94858 6.04236 3.95539 6.04236 5.00521C6.04236 6.05502 6.4594 7.06184 7.20173 7.80417C7.94406 8.5465 8.95088 8.96354 10.0007 8.96354C11.0505 8.96354 12.0573 8.5465 12.7997 7.80417C13.542 7.06184 13.959 6.05502 13.959 5.00521C13.959 3.95539 13.542 2.94858 12.7997 2.20624C12.0573 1.46391 11.0505 1.04688 10.0007 1.04688ZM7.29236 5.00521C7.29236 4.28691 7.57771 3.59804 8.08562 3.09013C8.59353 2.58222 9.2824 2.29688 10.0007 2.29688C10.719 2.29688 11.4079 2.58222 11.9158 3.09013C12.4237 3.59804 12.709 4.28691 12.709 5.00521C12.709 5.7235 12.4237 6.41238 11.9158 6.92029C11.4079 7.4282 10.719 7.71354 10.0007 7.71354C9.2824 7.71354 8.59353 7.4282 8.08562 6.92029C7.57771 6.41238 7.29236 5.7235 7.29236 5.00521ZM10.0007 10.2135C8.0732 10.2135 6.29653 10.6519 4.9807 11.3919C3.68403 12.1219 2.70903 13.2269 2.70903 14.5885V14.6735C2.7082 15.6419 2.70736 16.8569 3.7732 17.7252C4.29736 18.1519 5.03153 18.456 6.0232 18.656C7.01653 18.8577 8.31236 18.9635 10.0007 18.9635C11.689 18.9635 12.984 18.8577 13.979 18.656C14.9707 18.456 15.704 18.1519 16.229 17.7252C17.2949 16.8569 17.2932 15.6419 17.2924 14.6735V14.5885C17.2924 13.2269 16.3174 12.1219 15.0215 11.3919C13.7049 10.6519 11.929 10.2135 10.0007 10.2135ZM3.95903 14.5885C3.95903 13.8794 4.47736 13.1094 5.5932 12.4819C6.68986 11.8652 8.24653 11.4635 10.0015 11.4635C11.7549 11.4635 13.3115 11.8652 14.4082 12.4819C15.5249 13.1094 16.0424 13.8794 16.0424 14.5885C16.0424 15.6785 16.009 16.2919 15.439 16.7552C15.1307 17.0069 14.614 17.2527 13.7307 17.431C12.8499 17.6094 11.6457 17.7135 10.0007 17.7135C8.3557 17.7135 7.1507 17.6094 6.2707 17.431C5.38736 17.2527 4.8707 17.0069 4.56236 16.756C3.99236 16.2919 3.95903 15.6785 3.95903 14.5885Z"
                              fill="#2A514C"></path>
                          </svg>
                          By Benjamin
                        </div>
                        <div class="blog1-card__content-meta-item">
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                            aria-hidden="true">
                            <g clip-path="url(#clip0_95_78_3)">
                              <path
                                d="M3.33334 5.83317C3.33334 5.39114 3.50894 4.96722 3.8215 4.65466C4.13406 4.3421 4.55798 4.1665 5.00001 4.1665H15C15.442 4.1665 15.866 4.3421 16.1785 4.65466C16.4911 4.96722 16.6667 5.39114 16.6667 5.83317V15.8332C16.6667 16.2752 16.4911 16.6991 16.1785 17.0117C15.866 17.3242 15.442 17.4998 15 17.4998H5.00001C4.55798 17.4998 4.13406 17.3242 3.8215 17.0117C3.50894 16.6991 3.33334 16.2752 3.33334 15.8332V5.83317Z"
                                stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M13.3333 2.5V5.83333" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M6.66666 2.5V5.83333" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M3.33334 9.1665H16.6667" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M9.16666 12.5H9.99999" stroke="#5B5B5B" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                              <path d="M10 12.5V15" stroke="#5B5B5B" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </g>
                            <defs>
                              <clipPath id="clip0_95_78_3">
                                <rect width="20" height="20" fill="white"></rect>
                              </clipPath>
                            </defs>
                          </svg>
                          Sep 20, 2024
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      
@endsection
