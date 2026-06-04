@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<style>
  .category-content{
    position:absolute;
    top:30px;
    left:30px;
    z-index:10;
    color:#000;
  }

  .category-title{
      margin:0;
  }

  .category-title a{
      font-size:42px;
      font-weight:700;
      color:#000 !important;
      text-decoration:none;
      position:relative;
      z-index:11;
  }

  .category-tag{
      font-size:18px;
      color:#000;
      margin-bottom:10px;
      position:relative;
      z-index:11;
  }

  .category1-item::before{
      content:'';
      position:absolute;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background:rgba(255,255,255,0.25);
      z-index:1;
  }

  .category1-item__thumb{
      position:relative;
      z-index:0;
  }
  .category-slider{
      position:relative;
      display:flex;
      justify-content:center;
      align-items:center;
      gap:20px;
      overflow:hidden;
      min-height:360px;
  }

  .category-slide{
      display:none;
      transition:width 0.55s ease, flex-basis 0.55s ease, transform 0.55s ease, opacity 0.55s ease, filter 0.55s ease;
      transform-origin:center;
  }

  .category-slide.is-prev,
  .category-slide.is-active,
  .category-slide.is-next{
      display:block;
  }

  .category-slide.is-prev,
  .category-slide.is-next{
      width:306px;
      flex:0 0 306px;
      opacity:0.55;
      filter:blur(2px);
      transform:scale(0.92);
      z-index:1;
  }

  .category-slide.is-active{
      width:644px;
      flex:0 0 644px;
      opacity:1;
      filter:blur(0);
      transform:scale(1);
      z-index:3;
  }

  .category-slide,
  .category1-item{
      height:336px;
  }

  .category1-item{
      position:relative;
      overflow:hidden;
      border-radius:20px;
  }

  .category1-item__thumb{
      height:100%;
  }

  .category1-item__thumb img{
      width:100%;
      height:100%;
      object-fit:cover;
      border-radius:20px;
      display:block;
  }

  .category-slide.is-prev .category1-item,
  .category-slide.is-next .category1-item,
  .category-slide.is-active .category1-item{
      height:336px;
  }

  @media (max-width: 991px){
      .category-slider{
          min-height:336px;
      }

      .category-slide.is-prev,
      .category-slide.is-next{
          display:none;
      }

      .category-slide.is-active{
          width:100%;
          flex:0 0 100%;
      }
  }

  .category-slider-nav{
      display:flex;
      justify-content:center;
      align-items:center;
      gap:14px;
      margin-top:32px;
  }

  .category-slider-nav__btn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      min-width:136px;
      height:48px;
      padding:0 22px;
      border:1px solid #0c0c0c;
      border-radius:6px;
      background:#fff;
      color:#0c0c0c;
      font-size:14px;
      font-weight:700;
      line-height:1;
      text-transform:uppercase;
      letter-spacing:0;
      transition:background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
  }

  .category-slider-nav__btn i,
  .category-slider-nav__btn span{
      color:inherit;
  }

  .category-slider-nav__btn:hover,
  .category-slider-nav__btn:focus{
      background:#0c0c0c;
      border-color:#0c0c0c;
      color:#fff;
      transform:translateY(-2px);
  }

  .category-slider-nav__btn:focus-visible{
      outline:2px solid #0c0c0c;
      outline-offset:3px;
  }

  @media (max-width: 575px){
      .category-slider-nav{
          gap:10px;
          margin-top:24px;
      }

      .category-slider-nav__btn{
          min-width:0;
          flex:1 1 0;
          height:44px;
          padding:0 14px;
          font-size:13px;
      }
  }

  .testimonial1,
  .testimonial1 a,
  .testimonial1 h2,
  .testimonial1 h4,
  .testimonial1 p,
  .testimonial1 span,
  .testimonial1 i{
      color:#fff !important;
  }

  /* Hero Banner Slider Styles */
  .hero-banner-slider {
      width: 100%;
      border-radius: 12px;
      overflow: hidden;
      margin-bottom: 40px;
  }

  .hero-banner-slider .swiper-slide {
      aspect-ratio: 16 / 7;
      min-height: 360px;
      max-height: 620px;
      display: flex;
      align-items: center;
      justify-content: center;
  }

  .hero-banner-slider picture,
  .hero-banner-slider .swiper-slide img {
      width: 100%;
      height: 100%;
      display: block;
  }

  .hero-banner-slider .swiper-slide img {
      object-fit: cover;
  }

  .hero-banner-slider .swiper-button-next,
  .hero-banner-slider .swiper-button-prev {
      color: white;
      background-color: rgba(0, 0, 0, 0.5);
      width: 45px;
      height: 45px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background-color 0.3s ease;
  }

  .hero-banner-slider .swiper-button-next:hover,
  .hero-banner-slider .swiper-button-prev:hover {
      background-color: rgba(238, 45, 122, 0.8);
  }

  .hero-banner-slider .swiper-button-next::after,
  .hero-banner-slider .swiper-button-prev::after {
      font-size: 18px;
  }

  .hero-banner-slider .swiper-pagination-bullet {
      background-color: rgba(255, 255, 255, 0.7);
      opacity: 1;
  }

  .hero-banner-slider .swiper-pagination-bullet-active {
      background-color: #EE2D7A;
  }

  @media (max-width: 991px) {
      .hero-banner-slider {
          margin-bottom: 30px;
      }

      .hero-banner-slider .swiper-slide {
          aspect-ratio: 4 / 3;
          min-height: 320px;
          max-height: 480px;
      }

      .hero-banner-slider .swiper-button-next,
      .hero-banner-slider .swiper-button-prev {
          width: 40px;
          height: 40px;
      }

      .hero-banner-slider .swiper-button-next::after,
      .hero-banner-slider .swiper-button-prev::after {
          font-size: 16px;
      }
  }

  @media (max-width: 575px) {
      .hero-banner-slider {
          margin-bottom: 20px;
          border-radius: 8px;
      }

      .hero-banner-slider .swiper-slide {
        aspect-ratio: 4 / 5;
        min-height: 320px;
        max-height: 520px;
        background-color: #f5f5f5;
        background-position: center;
        background-repeat: no-repeat;
      }

      .hero-banner-slider .swiper-button-next,
      .hero-banner-slider .swiper-button-prev {
          width: 35px;
          height: 35px;
          display: none;
      }

      .hero-banner-slider .swiper-button-next::after,
      .hero-banner-slider .swiper-button-prev::after {
          font-size: 14px;
      }

      .hero-banner-slider .swiper-pagination {
          bottom: 10px;
      }

      .hero-banner-slider .swiper-pagination-bullet {
          width: 8px;
          height: 8px;
          margin: 0 4px;
      }
  }
</style>

@if($sliders && $sliders->count() > 0)
<!-- Hero Banner Slider Start -->
<section class="hero-banner-section rr-ov-hidden">
  <div class="container rr-container-1350">
    <div class="swiper hero-banner-slider">
      <div class="swiper-wrapper">
        @foreach($sliders as $slider)
          @if($slider->status)
          @php
            $desktopImage = $slider->image_desktop ?? $slider->image;
            $mobileImage = $slider->image_mobile ?? $desktopImage;
          @endphp
          <div class="swiper-slide">
            <a href="{{ $slider->url ?? '#' }}" target="_blank" rel="noopener noreferrer" style="display: block; width: 100%; height: 100%;">
              <picture>
                <source media="(max-width: 767px)" srcset="{{ asset('storage/' . $mobileImage) }}">
                <source media="(min-width: 768px)" srcset="{{ asset('storage/' . $desktopImage) }}">
                <img src="{{ asset('storage/' . $desktopImage) }}" alt="{{ $slider->title ?? 'Homepage slider' }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}">
              </picture>
            </a>
          </div>
          @endif
        @endforeach
      </div>
      <!-- Navigation Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <!-- Pagination -->
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<!-- Hero Banner Slider End -->
@endif

        <!-- Intro1 Section Start -->
        <section class="intro1 rr-ov-hidden">
          <div class="intro1__bg-text" style="font-size: 150px;">AenumLuxeStyle</div>
          <div class="container">
            <div class="row align-items-center">
              <!-- Left Column: Content -->
              <div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay=".3s">
                <div class="intro1__content">
                  <span class="intro1__content-subtext">{{ $settings['hero_subtext'] ?? 'Glow Beyond Beauty' }}</span>
                  <h1 class="intro1__content-title">{{ $settings['hero_title'] ?? 'Beauty That Shines Naturally' }}</h1>
                  <p class="intro1__content-desc">{{ $settings['hero_desc'] ?? 'Clean, cruelty-free, and glow-boosting products for every shade of beauty. Clean, boosting products.' }}</p>
                  <div class="intro1__content-button">
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

              <!-- Center: Main Image -->
              <div class="col-lg-6 col-md-12 wow fadeInUp" data-wow-delay=".5s">
                <div class="intro1__thumb text-center">
                  <img src="{{ isset($settings['hero_image']) ? (str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset($settings['hero_image'])) : asset('frontend-assets/imgs/hero/hero-thumb1_1.png') }}" alt="Beauty model" class="main-img intro-hero-img">
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

                    <div class="section-heading text-center mb-5">
                        <h2 class="section-heading__title">OUR CATEGORY</h2>
                    </div>

                    <div class="category-slider">

                        @foreach($categories as $index => $category)

                            <div class="category-slide {{ $index == 1 ? 'active' : 'small' }}">

                                <div class="category1-item">

                                    {{-- IMAGE SECTION --}}
                                    <div class="category1-item__thumb">
                                        <picture>

                                            {{-- Mobile Image --}}
                                            @if(!empty($category->image_mobile))
                                                <source
                                                    media="(max-width: 767px)"
                                                    srcset="{{ asset('storage/' . $category->image_mobile) }}">
                                            @endif

                                            {{-- Desktop Image --}}
                                            <img
                                                src="{{ !empty($category->image_desktop)
                                                        ? asset('storage/' . $category->image_desktop)
                                                        : (!empty($category->image_mobile)
                                                            ? asset('storage/' . $category->image_mobile)
                                                            : asset('frontend-assets/imgs/category/category-thumb1_1.jpg')) }}"
                                                alt="{{ $category->name }}"
                                                loading="lazy">
                                        </picture>
                                    </div>

                                    {{-- CATEGORY CONTENT (OVER IMAGE) --}}
                                    <div class="category-content">
                                      <h2 class="category-title">
                                          <a href="{{ route('public.shop', ['category' => $category->slug]) }}">
                                              {{ $category->name }}
                                          </a>
                                      </h2>
                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    {{-- NAVIGATION BUTTONS --}}
                    <div class="category-slider-nav" role="group" aria-label="Category carousel controls">

                        <button type="button" id="prevCategory" class="category-slider-nav__btn" aria-label="Show previous category">
                            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                            <span>Previous</span>
                        </button>

                        <button type="button" id="nextCategory" class="category-slider-nav__btn" aria-label="Show next category">
                            <span>Next</span>
                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        </button>

                    </div>

                </div>
            </div>
        </section>    

        <section class="trending-product section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            <div class="row gy-5 d-flex align-items-center justify-content-between">
              <div class="col-xl-6 d-flex justify-content-start">
                <div class="section-heading">
                  <h2 class="section-heading__title mb-0 wow fadeInUp" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">TRENDING PRODUCT</h2>
                </div>
              </div>
            </div>
            <div class="trending-product-wrapper">
              <div class="row g-4">
                @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                  <div class="trending-product-card">
                    <div class="trending-product-card__thumb">
                      <img src="{{ $product->image_mobile ? asset('storage/' . $product->image_mobile) : asset('frontend-assets/imgs/inner/shop/shop-thumb1_1.jpg') }}" alt="{{ $product->name }}">
                      @if($product->is_new)
                        <div class="trending-product-card__thumb-offer">New</div>
                      @endif
                      <div class="trending-product-card__thumb-btn-wrapper">
                        <button class="rr-btn-button4 add-to-cart" data-id="{{ $product->id }}">
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
                        </button>
                      </div>
                    </div>
                    <div class="trending-product-card__content">
                      @php
                        $avgRating = $product->reviews()->avg('rating') ?? 0;
                        $avgRatingFormatted = number_format($avgRating, 1);
                        $reviewsCount = $product->reviews()->count();
                      @endphp
                      <h3 class="trending-product-card__content-title">
                        <a href="{{ route('public.product.details', $product->slug) }}">{{ $product->name }}</a>
                      </h3>
                      <ul class="trending-product-card__content-list">
                        @php $filled = floor($avgRating); @endphp
                        @for($i = 1; $i <= 5; $i++)
                          @if($i <= $filled)
                            <li class="trending-product-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                          @else
                            <li class="trending-product-card__content-list-start"><i class="fa-regular fa-star fa-fw"></i></li>
                          @endif
                        @endfor
                        <li class="trending-product-card__content-list-point">{{ $avgRatingFormatted }}</li>
                        <li class="trending-product-card__content-list-text">({{ $reviewsCount }} {{ $reviewsCount == 1 ? 'Review' : 'Reviews' }})</li>
                      </ul>
                      <h4 class="trending-product-card__content-dollar">
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
            </div>
          </div>
        </section>

        @if($activeOffer)
        <section class="offer1 section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            @php
                $offerImage = $activeOffer->image
                    ? asset('storage/' . $activeOffer->image)
                    : asset('frontend-assets/imgs/offer/offer-banner.jpg');
            @endphp

            <div class="offer1-wrapper background-image wow fadeInUp"
                style="background-image: url('{{ $offerImage }}');"
                data-wow-delay=".3s">
              <div class="row">
                <div class="col-xl-12 d-flex justify-content-end">
                  <div class="offer1__content">
                    <span class="offer1__content-text">Special Offer</span>
                    <h2 class="offer1__content-title">{{ $activeOffer->title ?? 'Special Offer' }}</h2>
                    <p class="offer1__content-subtext">{{ Str::limit($activeOffer->description, 150) }}</p>
                    <div class="offer1__content-button">
                      <a href="{{ route('public.offer.details', $activeOffer->id) }}" class="rr-btn-button2">
                        <span class="text">View Offer Details</span>
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
        @endif

        <section class="best-selling-product section-spacing-120 bg-light-pick rr-ov-hidden">
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
                @foreach($categories_with_products as $index => $category)
                @if($category->products->count() > 0)
                <li class="nav-item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                  <a href="#cat-{{ $category->id }}" id="tab-{{ $category->id }}" data-bs-toggle="tab" class="nav-link{{ $index + 2 }}" aria-selected="false" role="tab"
                    tabindex="-1" aria-controls="cat-{{ $category->id }}">
                    {{ $category->name }}
                  </a>
                </li>
                @endif
                @endforeach
              </ul>
            </div>
            <div class="tab-content">
              <!-- All Products Tab -->
              <div id="All-product" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-All-product">
                <div class="best-selling-product-items">
                  <div class="row g-4 d-flex justify-content-center">
                    @if($all_best_selling->count() > 0)
                      <!-- Large Product -->
                      <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-delay=".3s">
                        @php
                          $largeProduct = $all_best_selling->first();
                          $largeAvg = $largeProduct->reviews()->avg('rating') ?? 0;
                          $largeAvgFormatted = number_format($largeAvg, 1);
                          $largeCount = $largeProduct->reviews()->count();
                        @endphp
                        <div class="best-selling-product-card">
                          <div class="best-selling-product-card__thumb1">
                            <img src="{{ $largeProduct->image_mobile ? asset('storage/' . $largeProduct->image_mobile) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="{{ $largeProduct->name }}">
                          </div>
                          <div class="best-selling-product-card__content1">
                            <h3 class="best-selling-product-card__content1-title">
                                <a href="{{ route('public.product.details', $largeProduct->slug) }}">{{ $largeProduct->name }}</a>
                            </h3>
                            <ul class="best-selling-product-card__content1-list">
                              @php $filledLarge = floor($largeAvg); @endphp
                              @for($i = 1; $i <= 5; $i++)
                                @if($i <= $filledLarge)
                                  <li class="best-selling-product-card__content1-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                                @else
                                  <li class="best-selling-product-card__content1-list-start"><i class="fa-regular fa-star fa-fw"></i></li>
                                @endif
                              @endfor
                              <li class="best-selling-product-card__content1-list-point">{{ $largeAvgFormatted }}</li>
                              <li class="best-selling-product-card__content1-list-text">({{ $largeCount }} {{ $largeCount == 1 ? 'Review' : 'Reviews' }})</li>
                            </ul>
                            <h4 class="best-selling-product-card__content1-dollar">£{{ number_format($largeProduct->price, 2) }}</h4>
                          </div>
                        </div>
                      </div>
                      <!-- 4 Small Products -->
                      <div class="col-xl-6 col-lg-7">
                        <div class="row g-4 d-flex justify-content-center">
                          @foreach($all_best_selling->skip(1) as $smallProduct)
                          <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                            <div class="best-selling-product-card">
                              <div class="best-selling-product-card__thumb">
                                <img src="{{ $smallProduct->image_mobile ? asset('storage/' . $smallProduct->image_mobile) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_2.jpg') }}" alt="{{ $smallProduct->name }}">
                              </div>
                              <div class="best-selling-product-card__content2">
                                <h3 class="best-selling-product-card__content2-title">
                                    <a href="{{ route('public.product.details', $smallProduct->slug) }}">{{ $smallProduct->name }}</a>
                                </h3>
                                @php
                                  $smallAvg = $smallProduct->reviews()->avg('rating') ?? 0;
                                  $smallAvgFormatted = number_format($smallAvg, 1);
                                  $smallCount = $smallProduct->reviews()->count();
                                @endphp
                                <ul class="best-selling-product-card__content2-list">
                                  @php $filledSmall = floor($smallAvg); @endphp
                                  @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $filledSmall)
                                      <li class="best-selling-product-card__content2-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                                    @else
                                      <li class="best-selling-product-card__content2-list-start"><i class="fa-regular fa-star fa-fw"></i></li>
                                    @endif
                                  @endfor
                                  <li class="best-selling-product-card__content2-list-point">{{ $smallAvgFormatted }}</li>
                                  <li class="best-selling-product-card__content2-list-text">({{ $smallCount }} {{ $smallCount == 1 ? 'Review' : 'Reviews' }})</li>
                                </ul>
                                <h4 class="best-selling-product-card__content2-dollar">£{{ number_format($smallProduct->price, 2) }}</h4>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
              </div>

              <!-- Category Specific Tabs -->
              @foreach($categories_with_products as $category)
              @if($category->products->count() > 0)
              <div id="cat-{{ $category->id }}" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                <div class="best-selling-product-items">
                  <div class="row g-4 d-flex justify-content-center">
                    <!-- Large Product -->
                    <div class="col-xl-6 col-lg-5 wow fadeInUp" data-wow-delay=".3s">
                      @php
                        $largeProduct = $category->products->first();
                        $largeAvg = $largeProduct->reviews()->avg('rating') ?? 0;
                        $largeAvgFormatted = number_format($largeAvg, 1);
                        $largeCount = $largeProduct->reviews()->count();
                      @endphp
                      <div class="best-selling-product-card">
                        <div class="best-selling-product-card__thumb1">
                          <img src="{{ $largeProduct->image ? asset('storage/' . $largeProduct->image) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="{{ $largeProduct->name }}">
                        </div>
                        <div class="best-selling-product-card__content1">
                          <h3 class="best-selling-product-card__content1-title">
                              <a href="{{ route('public.product.details', $largeProduct->slug) }}">{{ $largeProduct->name }}</a>
                          </h3>
                          <ul class="best-selling-product-card__content1-list">
                            @php $filledLarge = floor($largeAvg); @endphp
                            @for($i = 1; $i <= 5; $i++)
                              @if($i <= $filledLarge)
                                <li class="best-selling-product-card__content1-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                              @else
                                <li class="best-selling-product-card__content1-list-start"><i class="fa-regular fa-star fa-fw"></i></li>
                              @endif
                            @endfor
                            <li class="best-selling-product-card__content1-list-point">{{ $largeAvgFormatted }}</li>
                            <li class="best-selling-product-card__content1-list-text">({{ $largeCount }} {{ $largeCount == 1 ? 'Review' : 'Reviews' }})</li>
                          </ul>
                          <h4 class="best-selling-product-card__content1-dollar">£{{ number_format($largeProduct->price, 2) }}</h4>
                        </div>
                      </div>
                    </div>
                    <!-- 4 Small Products -->
                    <div class="col-xl-6 col-lg-7">
                      <div class="row g-4 d-flex justify-content-center">
                        @foreach($category->products->skip(1) as $smallProduct)
                        <div class="col-xl-6 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                          <div class="best-selling-product-card">
                            <div class="best-selling-product-card__thumb">
                              <img src="{{ $smallProduct->image ? asset('storage/' . $smallProduct->image) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_2.jpg') }}" alt="{{ $smallProduct->name }}">
                            </div>
                            <div class="best-selling-product-card__content2">
                              <h3 class="best-selling-product-card__content2-title">
                                  <a href="{{ route('public.product.details', $smallProduct->slug) }}">{{ $smallProduct->name }}</a>
                              </h3>
                              @php
                                $smallAvg = $smallProduct->reviews()->avg('rating') ?? 0;
                                $smallAvgFormatted = number_format($smallAvg, 1);
                                $smallCount = $smallProduct->reviews()->count();
                              @endphp
                              <ul class="best-selling-product-card__content2-list">
                                @php $filledSmall = floor($smallAvg); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                  @if($i <= $filledSmall)
                                    <li class="best-selling-product-card__content2-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                                  @else
                                    <li class="best-selling-product-card__content2-list-start"><i class="fa-regular fa-star fa-fw"></i></li>
                                  @endif
                                @endfor
                                <li class="best-selling-product-card__content2-list-point">{{ $smallAvgFormatted }}</li>
                                <li class="best-selling-product-card__content2-list-text">({{ $smallCount }} {{ $smallCount == 1 ? 'Review' : 'Reviews' }})</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">£{{ number_format($smallProduct->price, 2) }}</h4>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @endforeach
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
                    <img src="{{ asset($settings['feature1_icon'] ?? 'frontend-assets/imgs/cta/cta-icon1_1.png') }}" alt="icon">
                  </div>
                  <h3 class="cta1-card__title">{{ $settings['feature1_title'] ?? 'Beauty Cosmetic' }}</h3>
                  <p class="cta1-card__subtitle">{{ $settings['feature1_desc'] ?? 'Enhance your natural beauty with our premium cosmetic collection — designed to nourish' }}</p>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="cta1-card">
                  <div class="cta1-card__icon">
                    <img src="{{ asset($settings['feature2_icon'] ?? 'frontend-assets/imgs/cta/cta-icon1_2.png') }}" alt="icon">
                  </div>
                  <h3 class="cta1-card__title">{{ $settings['feature2_title'] ?? 'We love what We do' }}</h3>
                  <p class="cta1-card__subtitle">{{ $settings['feature2_desc'] ?? 'We love what we do — creating beauty products that inspire confidence, celebrate.' }}</p>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="cta1-card">
                  <div class="cta1-card__icon">
                    <img src="{{ asset($settings['feature3_icon'] ?? 'frontend-assets/imgs/cta/cta-icon1_3.png') }}" alt="icon">
                  </div>
                  <h3 class="cta1-card__title">{{ $settings['feature3_title'] ?? 'Professional products' }}</h3>
                  <p class="cta1-card__subtitle">{{ $settings['feature3_desc'] ?? 'Experience salon-quality results with our professional products — expertly crafted to deliver' }}</p>
                </div>
              </div>
            </div>
          </div>
        </section>






        <!-- Testimonial Section Start -->
        <section class="testimonial1 section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            <div class="section-heading wow fadeInUp" data-wow-delay=".3s">
              <h2 class="section-heading__title">{{ $settings['testimonial_title'] ?? 'WHAT OUR CUSTOMERS SAY' }}</h2>
            </div>
            <div class="row g-4">
              @php $testimonials = \App\Models\Testimonial::latest()->take(6)->get(); @endphp
              @foreach($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                  <div class="testimonial1-card {{ $loop->iteration % 2 == 0 ? 'light-card' : 'dark-card' }}"
                    @if($testimonial->image) style="background-image: url('{{ asset('storage/' . $testimonial->image) }}'); background-size:cover; background-position:center;" @endif>
                    @if($testimonial->image && $loop->iteration % 2 == 0)
                      <div class="testimonial1-card__product-img">
                        <img src="{{ asset('storage/' . $testimonial->image) }}" alt="product">
                      </div>
                    @endif
                    <div class="testimonial1-card__content">
                      <div class="testimonial1-card__quote">
                        <i class="fa-solid fa-quote-left"></i>
                      </div>
                      <p class="testimonial1-card__text">{{ $testimonial->text }}</p>
                      <div class="testimonial1-card__author-meta d-flex align-items-center gap-2">
                        @if($testimonial->image && $loop->iteration % 2 == 0)
                          <div class="testimonial1-card__author-thumb">
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="user">
                          </div>
                        @endif
                        <div class="testimonial1-card__author">
                          <h4 class="testimonial1-card__author-name">{{ $testimonial->author }}</h4>
                          @if($testimonial->designation)
                            <span class="testimonial1-card__author-designation">{{ $testimonial->designation }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </section>
        <!-- Testimonial Section End -->

<script>
    // Hero Banner Slider
    @if($sliders && $sliders->count() > 0)
    var heroBannerSwiper = new Swiper('.hero-banner-slider', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 0,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.hero-banner-slider .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.hero-banner-slider .swiper-button-next',
            prevEl: '.hero-banner-slider .swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            1024: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
            1200: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
        }
    });
    @endif

    const categorySlides = Array.from(document.querySelectorAll('.category-slide'));

    if (categorySlides.length > 0) {
        let activeCategoryIndex = categorySlides.findIndex(slide => slide.classList.contains('active'));

        if (activeCategoryIndex < 0) {
            activeCategoryIndex = categorySlides.length > 1 ? 1 : 0;
        }

        let categorySliderLocked = false;
        const categoryAnimationTime = 550;

        function getPrevCategoryIndex() {
            return (activeCategoryIndex - 1 + categorySlides.length) % categorySlides.length;
        }

        function getNextCategoryIndex() {
            return (activeCategoryIndex + 1) % categorySlides.length;
        }

        function updateCategorySlider() {
            const prevIndex = getPrevCategoryIndex();
            const nextIndex = getNextCategoryIndex();

            categorySlides.forEach((slide, index) => {
                slide.classList.remove('active', 'small', 'is-prev', 'is-active', 'is-next');
                slide.style.order = '';
                slide.setAttribute('aria-hidden', 'true');

                if (categorySlides.length === 1) {
                    slide.classList.add('active', 'is-active');
                    slide.style.order = 2;
                    slide.setAttribute('aria-hidden', 'false');
                    return;
                }

                if (index === prevIndex) {
                    slide.classList.add('small', 'is-prev');
                    slide.style.order = 1;
                } else if (index === activeCategoryIndex) {
                    slide.classList.add('active', 'is-active');
                    slide.style.order = 2;
                    slide.setAttribute('aria-hidden', 'false');
                } else if (index === nextIndex) {
                    slide.classList.add('small', 'is-next');
                    slide.style.order = 3;
                }
            });
        }

        function moveCategorySlider(direction) {
            if (categorySliderLocked || categorySlides.length <= 1) return;

            categorySliderLocked = true;

            if (direction === 'next') {
                activeCategoryIndex = getNextCategoryIndex();
            } else {
                activeCategoryIndex = getPrevCategoryIndex();
            }

            updateCategorySlider();

            setTimeout(() => {
                categorySliderLocked = false;
            }, categoryAnimationTime);
        }

        const nextCategoryBtn = document.getElementById('nextCategory');
        const prevCategoryBtn = document.getElementById('prevCategory');

        if (nextCategoryBtn) {
            nextCategoryBtn.addEventListener('click', () => moveCategorySlider('next'));
        }

        if (prevCategoryBtn) {
            prevCategoryBtn.addEventListener('click', () => moveCategorySlider('prev'));
        }

        let categoryResizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(categoryResizeTimer);
            categoryResizeTimer = setTimeout(updateCategorySlider, 100);
        });

        updateCategorySlider();

        setInterval(() => {
            moveCategorySlider('next');
        }, 3000);
    }
</script>
@endsection
