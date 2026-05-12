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
      display:flex;
      justify-content:center;
      align-items:center;
      gap:20px;
      overflow:hidden;
  }

  .category-slide{
      transition:all 0.5s ease;
  }

  .category-slide.small{
      width:306px;
      flex:0 0 306px;
  }

  .category-slide.active{
      width:644px;
      flex:0 0 644px;
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
  }

  .category-slide.small .category1-item,
  .category-slide.active .category1-item{
      height:336px;
  }
</style>
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
                  <img src="{{ isset($settings['hero_image']) ? (str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset($settings['hero_image'])) : asset('frontend-assets/imgs/hero/hero-thumb1_1.png') }}" alt="Beauty model" class="main-img" style="width: 550px; height: 500px; object-fit: cover;">
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

                        <div class="category1-item__thumb">
                            <img
                                src="{{ $category->image ? asset('storage/' . $category->image) : asset('frontend-assets/imgs/category/category-thumb1_1.jpg') }}"
                                alt="{{ $category->name }}">
                        </div>

                        <!-- @if($index == 1)
                        <div class="category1-item__offer">
                            Up to 20%
                        </div>
                        @endif -->

                        <div class="category-content">

                            <p class="category-tag">
                                {{ $index == 1 ? 'Trending' : 'Professional' }}
                            </p>
                          {{$category->name }}
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

            <div class="slider-btns text-center mt-4">
                <button id="prevCategory" class="btn btn-dark">Prev</button>
                <button id="nextCategory" class="btn btn-dark">Next</button>
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
                      <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('frontend-assets/imgs/inner/shop/shop-thumb1_1.jpg') }}" alt="{{ $product->name }}">
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
                      <h3 class="trending-product-card__content-title">
                        <a href="{{ route('public.product.details', $product->slug) }}">{{ $product->name }}</a>
                      </h3>
                      <ul class="trending-product-card__content-list">
                        <li class="trending-product-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                        <li class="trending-product-card__content-list-point">5.0</li>
                        <li class="trending-product-card__content-list-text">(0 Reviews)</li>
                      </ul>
                      <h4 class="trending-product-card__content-dollar">
                        ${{ number_format($product->price, 2) }}
                        @if($product->old_price)
                        <span style="text-decoration: line-through; color: #888; font-size: 0.8em; margin-left: 5px;">${{ number_format($product->old_price, 2) }}</span>
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


        <section class="offer1 section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            <div class="offer1-wrapper background-image wow fadeInUp"
              style="background-image: url({{ asset($settings['offer_bg'] ?? 'frontend-assets/imgs/offer/offer-banner.jpg') }});" data-wow-delay=".3s">
              <div class="row">
                <div class="col-xl-12 d-flex justify-content-end">
                  <div class="offer1__content">
                    <span class="offer1__content-text">{{ $settings['offer_subtext'] ?? 'A nature`s touch' }}</span>
                    <h2 class="offer1__content-title">{!! $settings['offer_title'] ?? '<span class="subtitle">Get 25%</span> Off All Cosmetic Creams' !!}</h2>
                    <p class="offer1__content-subtext">{{ $settings['offer_desc'] ?? 'Pamper your skin with our nourishing cosmetic creams — crafted for radiant, silky-smooth results. Enjoy 25% off today' }}</p>
                    <div class="offer1__content-button">
                      <a href="{{ $settings['offer_link'] ?? route('public.shop') }}" class="rr-btn-button2">
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
                        @php $largeProduct = $all_best_selling->first(); @endphp
                        <div class="best-selling-product-card">
                          <div class="best-selling-product-card__thumb1">
                            <img src="{{ $largeProduct->image ? asset('storage/' . $largeProduct->image) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="{{ $largeProduct->name }}">
                          </div>
                          <div class="best-selling-product-card__content1">
                            <h3 class="best-selling-product-card__content1-title">
                                <a href="{{ route('public.product.details', $largeProduct->slug) }}">{{ $largeProduct->name }}</a>
                            </h3>
                            <ul class="best-selling-product-card__content1-list">
                              <li class="best-selling-product-card__content1-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                              <li class="best-selling-product-card__content1-list-point">5.0</li>
                              <li class="best-selling-product-card__content1-list-text">(0 Reviews)</li>
                            </ul>
                            <h4 class="best-selling-product-card__content1-dollar">${{ number_format($largeProduct->price, 2) }}</h4>
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
                                <img src="{{ $smallProduct->image ? asset('storage/' . $smallProduct->image) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_2.jpg') }}" alt="{{ $smallProduct->name }}">
                              </div>
                              <div class="best-selling-product-card__content2">
                                <h3 class="best-selling-product-card__content2-title">
                                    <a href="{{ route('public.product.details', $smallProduct->slug) }}">{{ $smallProduct->name }}</a>
                                </h3>
                                <ul class="best-selling-product-card__content2-list">
                                  <li class="best-selling-product-card__content2-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                                  <li class="best-selling-product-card__content2-list-point">5.0</li>
                                  <li class="best-selling-product-card__content2-list-text">(0 Reviews)</li>
                                </ul>
                                <h4 class="best-selling-product-card__content2-dollar">${{ number_format($smallProduct->price, 2) }}</h4>
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
                      @php $largeProduct = $category->products->first(); @endphp
                      <div class="best-selling-product-card">
                        <div class="best-selling-product-card__thumb1">
                          <img src="{{ $largeProduct->image ? asset('storage/' . $largeProduct->image) : asset('frontend-assets/imgs/best-selling-products/best-selling-products1_1.jpg') }}" alt="{{ $largeProduct->name }}">
                        </div>
                        <div class="best-selling-product-card__content1">
                          <h3 class="best-selling-product-card__content1-title">
                              <a href="{{ route('public.product.details', $largeProduct->slug) }}">{{ $largeProduct->name }}</a>
                          </h3>
                          <ul class="best-selling-product-card__content1-list">
                            <li class="best-selling-product-card__content1-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                            <li class="best-selling-product-card__content1-list-point">5.0</li>
                            <li class="best-selling-product-card__content1-list-text">(0 Reviews)</li>
                          </ul>
                          <h4 class="best-selling-product-card__content1-dollar">${{ number_format($largeProduct->price, 2) }}</h4>
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
                              <ul class="best-selling-product-card__content2-list">
                                <li class="best-selling-product-card__content2-list-start"><i class="fa-solid fa-star fa-fw"></i></li>
                                <li class="best-selling-product-card__content2-list-point">5.0</li>
                                <li class="best-selling-product-card__content2-list-text">(0 Reviews)</li>
                              </ul>
                              <h4 class="best-selling-product-card__content2-dollar">${{ number_format($smallProduct->price, 2) }}</h4>
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

<script>
    const slides = document.querySelectorAll('.category-slide');
    if (slides.length > 0) {
        let activeIndex = 0;

        function updateSlider() {
            slides.forEach((slide) => {
                slide.style.display = 'none';
                slide.classList.remove('active', 'small');
            });

            if (slides.length >= 3) {
                let prevIndex = (activeIndex - 1 + slides.length) % slides.length;
                let nextIndex = (activeIndex + 1) % slides.length;

                slides[prevIndex].style.display = 'block';
                slides[prevIndex].classList.add('small');

                slides[activeIndex].style.display = 'block';
                slides[activeIndex].classList.add('active');

                slides[nextIndex].style.display = 'block';
                slides[nextIndex].classList.add('small');
            } else {
                // Handle cases with 1 or 2 slides
                slides.forEach((slide, idx) => {
                    slide.style.display = 'block';
                    if (idx === activeIndex) {
                        slide.classList.add('active');
                    } else {
                        slide.classList.add('small');
                    }
                });
            }
        }

        function nextSlide() {
            activeIndex = (activeIndex + 1) % slides.length;
            updateSlider();
        }

        function prevSlide() {
            activeIndex = (activeIndex - 1 + slides.length) % slides.length;
            updateSlider();
        }

        const nextBtn = document.getElementById('nextCategory');
        const prevBtn = document.getElementById('prevCategory');

        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        // Auto Slide
        setInterval(nextSlide, 3000);

        updateSlider();
    }
</script>
@endsection
