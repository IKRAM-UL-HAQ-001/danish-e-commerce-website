@extends('frontend.layouts.app')

@section('title', 'Product-details')

@section('content')

        <!--===== Breadcrumb  Section   S T A R T =====-->
        <div class="breadcumb2 fix">
          <div class="container rr-container-1350">
            <div class="breadcumb2-wrapper">
              <ul class="breadcumb2-wrapper__items">
                <li class="breadcumb2-wrapper__items-list">
                  <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb2-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb2-wrapper__items-list">
                  <a href="shop.html" class="breadcumb2-wrapper__items-list-title">
                    Category
                  </a>
                </li>
                <li class="breadcumb2-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb2-wrapper__items-list">
                  <a href="product-details.html" class="breadcumb2-wrapper__items-list-title2">
                    Product Details
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!--===== Product-Details  Section   S T A R T =====-->
        <section class="product-details section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            <div class="product-details-wrapper">
              <div class="row g-4 d-flex justify-content-center justify-content-between">
                <div class="col-xl-6 col-lg-6">
                  <div class="product-details-items">
                    <div class="tab-content">
                      <div id="thumb-one" class="tab-pane fade show active" role="tabpanel">
                        <div class="product-details-thumb">
                          <div class="thumb">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_1.jpg') }}"
                              alt="shop-details">
                          </div>
                          <div class="content">
                            <span class="sale">In stock</span>
                          </div>
                        </div>
                      </div>
                      <div id="thumb-two" class="tab-pane fade" role="tabpanel">
                        <div class="product-details-thumb">
                          <div class="thumb">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_1.jpg') }}"
                              alt="shop-details">
                          </div>
                          <div class="content">
                            <span class="sale">In stock</span>
                          </div>
                        </div>
                      </div>
                      <div id="thumb-three" class="tab-pane fade" role="tabpanel">
                        <div class="product-details-thumb">
                          <div class="thumb">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_1.jpg') }}"
                              alt="shop-details">
                          </div>
                          <div class="content">
                            <span class="sale">In stock</span>
                          </div>
                        </div>
                      </div>
                      <div id="thumb-four" class="tab-pane fade" role="tabpanel">
                        <div class="product-details-thumb">
                          <div class="thumb">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_1.jpg') }}"
                              alt="shop-details">
                          </div>
                          <div class="content">
                            <span class="sale">In stock</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-header">
                      <!-- Tabs (thumbnails) -->
                      <ul class="nav border-0" role="tablist" aria-label="Product image thumbnails">
                        <li class="item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                          <a class="nav-link1 active" id="thumb-one-tab" href="#thumb-one" data-bs-toggle="tab"
                            role="tab" aria-controls="thumb-one" aria-selected="true">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_2.jpg') }}"
                              alt="Product thumbnail 1">
                          </a>
                        </li>

                        <li class="tab-header-nav-item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                          <a class="nav-link2" id="thumb-two-tab" href="#thumb-two" data-bs-toggle="tab" role="tab"
                            aria-controls="thumb-two" aria-selected="false" tabindex="-1">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_3.jpg') }}"
                              alt="Product thumbnail 2">
                          </a>
                        </li>

                        <li class="tab-header-nav-item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                          <a class="nav-link2" id="thumb-three-tab" href="#thumb-three" data-bs-toggle="tab" role="tab"
                            aria-controls="thumb-three" aria-selected="false" tabindex="-1">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_4.jpg') }}"
                              alt="Product thumbnail 3">
                          </a>
                        </li>

                        <li class="tab-header-nav-item wow fadeInUp" data-wow-delay=".3s" role="presentation">
                          <a class="nav-link2" id="thumb-four-tab" href="#thumb-four" data-bs-toggle="tab" role="tab"
                            aria-controls="thumb-four" aria-selected="false" tabindex="-1">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_5.jpg') }}"
                              alt="Product thumbnail 4">
                          </a>
                        </li>
                      </ul>


                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                  <div class="product-details-content">
                    <p class="product-details-content__text">Pelican</p>
                    <h1 class="product-details-content__title mb-2"> M1xe <span class="title-light">Matte
                        Lipstick</span></h1>
                    <div class="product-details-content-items d-flex flex-wrap align-items-center gap-3">
                      <div class="product-details-content__price d-flex align-items-baseline gap-2">
                        <span class="price-now">$112</span>
                        <span class="price-was">$225</span>
                        <span class="price-currency">USD</span>
                      </div>
                      <span class="product-details-content__badge-pill">60% OFF</span>
                      <div class="product-details-content__rating d-flex align-items-center">
                        <div class="stars">
                          <span class="star"><i class="fa-solid fa-star fa-fw"></i></span>
                          <span class="star"><i class="fa-solid fa-star fa-fw"></i></span>
                          <span class="star"><i class="fa-solid fa-star fa-fw"></i></span>
                          <span class="star"><i class="fa-solid fa-star fa-fw"></i></span>
                          <span class="star5"><i class="fa-solid fa-star fa-fw"></i></span>
                        </div>
                      </div>
                    </div>
                    <p class="product-details-content__desc">
                      There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                      alteration in some form, by injected humour.
                    </p>
                    <div class="product-details-content__color-items mb-4">
                      <div class="d-flex align-items-center gap-2 mb-4">
                        <span class="label">Select Color:</span>
                        <span class="selected-dot"></span>
                        <span class="selected-name">RED</span>
                      </div>
                      <div class="color-row">
                        <button class="color-dot" type="button" aria-label="Blue" style="--dot:#3f51b5"></button>
                        <button class="color-dot" type="button" aria-label="Green" style="--dot:#20c997"></button>
                        <button class="color-dot" type="button" aria-label="Mint" style="--dot:#7ef5d8"></button>
                        <button class="color-dot" type="button" aria-label="Yellow" style="--dot:#ffca28"></button>
                        <button class="color-dot" type="button" aria-label="Orange" style="--dot:#ff9800"></button>
                        <!-- Active -->
                        <button class="color-dot is-active" type="button" aria-label="Red"
                          style="--dot:#FF1212"></button>
                        <button class="color-dot" type="button" aria-label="Purple" style="--dot:#7e57c2"></button>
                        <button class="color-dot" type="button" aria-label="Black" style="--dot:#111"></button>
                        <button class="color-dot" type="button" aria-label="Magenta" style="--dot:#e91e63"></button>
                      </div>
                    </div>
                    <div class="product-details-content__info">
                      <p class="label mb-3">Quantity</p>
                      <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="qty">
                          <button class="qty-btn" type="button" aria-label="Decrease">−</button>
                          <span class="qty-val">01</span>
                          <button class="qty-btn" type="button" aria-label="Increase">+</button>
                        </div>
                        <button class="btn-add" type="button">ADD TO CART
                          <span class="btn-icon" aria-hidden="true"><i
                              class="fa-duotone fa-thin fa-arrow-right-long"></i></span>
                        </button>
                        <button class="btn-heart" type="button" aria-label="Wishlist">
                          <i class="fa-solid fa-heart"></i>
                        </button>
                      </div>
                      <button class="btn-buy mt-5" type="button">
                        BUY NOW
                        <span class="btn-icon" aria-hidden="true"><i
                            class="fa-duotone fa-thin fa-arrow-right-long"></i></span>
                      </button>
                    </div>
                    <div class="product-details-content__meta mb-4">
                      <div class="meta-row"><span class="k">SKU:</span> <span class="v">NTB7SDVX44</span></div>
                      <div class="meta-row"><span class="k">Category:</span> <span class="v">Beauty &amp;
                          Cosmetics</span></div>
                      <div class="meta-row"><span class="k">Tag:</span> <span class="v">Cream</span></div>
                    </div>
                    <div class="product-details-content__checkout">
                      <p class="product-details-content__checkout-text mb-2">Guranted Safe Checkout</p>
                      <div class="pay-row">
                        <span class="pay-badge"><img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-logo1_1.png') }}"
                            alt="logo"></span>
                        <span class="pay-badge"><img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-logo1_2.png') }}"
                            alt="logo"></span>
                        <span class="pay-badge"><img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-logo1_3.png') }}"
                            alt="logo"></span>
                        <span class="pay-badge"><img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-logo1_4.png') }}"
                            alt="logo"></span>
                        <span class="pay-badge"><img src="{{ asset('frontend-assets/imgs/inner/product-details/product-details-logo1_3.png') }}"
                            alt="logo"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


        <!--===== Product Tab  Section    S T A R T =====-->
        <div class="product-tab section-spacing-120 rr-ov-hidden pt-0">
          <div class="container rr-container-1350">
            <ul class="nav nav-tabs tab-buttons" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="one-tab" data-bs-toggle="tab" data-bs-target="#one-tab-pane"
                  type="button" role="tab" aria-controls="one-tab-pane" aria-selected="true">Description
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="two-tab" data-bs-toggle="tab" data-bs-target="#two-tab-pane" type="button"
                  role="tab" aria-controls="two-tab-pane" aria-selected="false">Additional information</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="three-tab" data-bs-toggle="tab" data-bs-target="#three-tab-pane"
                  type="button" role="tab" aria-controls="three-tab-pane" aria-selected="false">Reviews (1)</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="one-tab-pane" role="tabpanel" aria-labelledby="one-tab"
                tabindex="0">
                <div class="product-tab-wrapper">
                  <div class="row d-flex justify-content-between">
                    <div class="col-xl-12">
                      <div class="product-tab-card">
                        <div class="product-tab-card__content">
                          <div class="product-tab-card__content-title">Long Description</div>
                          <p class="product-tab-card__content-dsc">Discover a lipstick that blends luxury, comfort, and
                            bold beauty in every swipe. The Luxe
                            Matte Lipstick is crafted with a creamy, weightless formula that glides effortlessly across
                            your lips, delivering rich, vibrant color with a smooth matte finish. Its high-pigment
                            payoff ensures full coverage instantly, giving you a confident look that lasts from morning
                            to night without fading or smudging.</p>
                          <p class="product-tab-card__content-text">Infused with nourishing oils and softening
                            ingredients, this lipstick keeps your lips
                            feeling moisturized and comfortable—never dry, flaky, or tight. The velvety texture hugs
                            your lips perfectly, offering a plush matte look that feels soft and natural all day long.
                            Whether you’re aiming for an everyday natural vibe or a bold, statement-making glam look,
                            Luxe Matte Lipstick adapts beautifully to every mood and every skin tone.</p>
                          <p class="product-tab-card__content-subtitle">Designed for all-day wear and all-day comfort,
                            this lipstick brings together long-lasting
                            performance, elegant color, and a premium feel—making it a must-have in every makeup
                            routine.</p>
                          <div class="product-tab-card__content-title2">User-friendly</div>
                          <p class="product-tab-card__content-subtitle2">Luxe Matte Lipstick delivers bold, vibrant
                            color with a smooth, velvety matte finish. Its lightweight, creamy formula glides on
                            effortlessly, keeping lips soft, hydrated, and comfortable all day. Perfect for any skin
                            tone, this lipstick is ideal for everyday wear or a glamorous night look, giving you a
                            flawless, confident smile without dryness or fading.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="two-tab-pane" role="tabpanel" aria-labelledby="two-tab" tabindex="0">
                <div class="product-tab-wrapper">
                  <div class="row d-flex justify-content-between">
                    <div class="col-xl-12">
                      <div class="product-tab-card">
                        <div class="product-tab-card__content">
                          <div class="product-tab-card__content-title">Long Description</div>
                          <p class="product-tab-card__content-dsc">Discover a lipstick that blends luxury, comfort, and
                            bold beauty in every swipe. The Luxe
                            Matte Lipstick is crafted with a creamy, weightless formula that glides effortlessly across
                            your lips, delivering rich, vibrant color with a smooth matte finish. Its high-pigment
                            payoff ensures full coverage instantly, giving you a confident look that lasts from morning
                            to night without fading or smudging.</p>
                          <p class="product-tab-card__content-text">Infused with nourishing oils and softening
                            ingredients, this lipstick keeps your lips
                            feeling moisturized and comfortable—never dry, flaky, or tight. The velvety texture hugs
                            your lips perfectly, offering a plush matte look that feels soft and natural all day long.
                            Whether you’re aiming for an everyday natural vibe or a bold, statement-making glam look,
                            Luxe Matte Lipstick adapts beautifully to every mood and every skin tone.</p>
                          <p class="product-tab-card__content-subtitle">Designed for all-day wear and all-day comfort,
                            this lipstick brings together long-lasting
                            performance, elegant color, and a premium feel—making it a must-have in every makeup
                            routine.</p>
                          <div class="product-tab-card__content-title2">User-friendly</div>
                          <p class="product-tab-card__content-subtitle2">Luxe Matte Lipstick delivers bold, vibrant
                            color with a smooth, velvety matte finish. Its lightweight, creamy formula glides on
                            effortlessly, keeping lips soft, hydrated, and comfortable all day. Perfect for any skin
                            tone, this lipstick is ideal for everyday wear or a glamorous night look, giving you a
                            flawless, confident smile without dryness or fading.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="three-tab-pane" role="tabpanel" aria-labelledby="three-tab" tabindex="0">
                <div class="product-tab-wrapper">
                  <div class="row g-4 d-flex justify-content-between">
                    <div class="col-xl-7">
                      <div class="product-tab-items">
                        <p class="product-tab-items__text">05 review for Denim Jean Top Jacket Sleeve Crop Women</p>
                        <div class="product-tab-items__card d-flex align-items-start justify-content-between gap-3">

                          <div
                            class="product-tab-items__card-info d-flex align-items-center justify-content-between gap-3">
                            <div class="product-tab-items__card-thumb">
                              <img src="{{ asset('frontend-assets/imgs/inner/product-details/image-1.png') }}" alt="img">
                            </div>
                            <div class="product-tab-items__card-info-content">
                              <p class="product-tab-items__card-info-content-text">George – October 13, 2023</p>
                              <div class="product-tab-items__card-info-content-name">Amazing Quility 😍</div>
                            </div>
                          </div>

                          <div class="product-tab-items__card-info-star">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/star.png') }}" alt="stat">
                          </div>
                        </div>
                        <div class="product-tab-items__card d-flex align-items-start justify-content-between gap-3">
                          <div
                            class="product-tab-items__card-info d-flex align-items-center justify-content-between gap-3">
                            <div class="product-tab-items__card-thumb">
                              <img src="{{ asset('frontend-assets/imgs/inner/product-details/image-2.png') }}" alt="img">
                            </div>
                            <div class="product-tab-items__card-info-content">
                              <p class="product-tab-items__card-info-content-text">George – October 13, 2023</p>
                              <div class="product-tab-items__card-info-content-name">Amazing Quility 😍</div>
                            </div>
                          </div>
                          <div class="product-tab-items__card-info-star">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/star.png') }}" alt="stat">
                          </div>
                        </div>
                        <div class="product-tab-items__card  d-flex align-items-start justify-content-between gap-3">
                          <div
                            class="product-tab-items__card-info d-flex align-items-center justify-content-between gap-3">
                            <div class="product-tab-items__card-thumb">
                              <img src="{{ asset('frontend-assets/imgs/inner/product-details/image-3.png') }}" alt="img">
                            </div>
                            <div class="product-tab-items__card-info-content">
                              <p class="product-tab-items__card-info-content-text">George – October 13, 2023</p>
                              <div class="product-tab-items__card-info-content-name">Amazing Quility 😍</div>
                            </div>
                          </div>
                          <div class="product-tab-items__card-info-star">
                            <img src="{{ asset('frontend-assets/imgs/inner/product-details/star.png') }}" alt="stat">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-5">
                      <div class="product-tab-contact">
                        <div class="product-tab-contact__title">Add a review</div>
                        <form action="contact.php" id="contact-form" method="POST" class="product-tab-contact__form">
                          <div class="row g-4">
                            <div class="col-lg-12">
                              <div class="product-tab-contact__form_input">
                                <span class="product-tab-contact__form-input-name">Your Name</span>
                                <input type="text" class="product-tab-contact__form-input-field" name="name" id="name"
                                  placeholder="Enter Your Name">
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="product-tab-contact__form_input">
                                <span class="product-tab-contact__form-input-name">Your Email</span>
                                <input type="text" class="product-tab-contact__form-input-field" name="email"
                                  id="email1" placeholder="Email Here">
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="product-tab-contact__form_input">
                                <span class="product-tab-contact__form-input-name">Your Message</span>
                                <textarea name="message" class="product-tab-contact__form-input-field textarea"
                                  id="message" placeholder="Enter Your Message"></textarea>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <button type="submit" class="rr-btn-button">
                                <span class="text">Send Message</span>
                                <span class="icon">
                                  <svg width="16" height="10" viewBox="0 0 16 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                      d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                                      stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                  </svg>
                                </span>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--===== Offertwo Section    S T A R T =====-->
        <section class="featured-products2 section-spacing-120 rr-ov-hidden pt-0">
          <div class="container rr-container-1350">
            <div class="row gy-5 d-flex align-items-center justify-content-between">
              <div class="col-xl-6 d-flex justify-content-start">
                <div class="section-heading">
                  <h2 class="section-heading__title wow fadeInUp" data-wow-delay=".5s"
                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">FEATURED PRODUCTS
                  </h2>
                </div>
              </div>
              <div class="col-xl-6 d-flex justify-content-xl-end">
                <div class="featured-products2-controls wow fadeInUp" data-wow-delay=".5s"
                  style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                  <div class="featured-products2-controls__arrowLeft">
                    <div class="icon"><i class="fa-solid fa-angle-left"></i></div>prev
                  </div>
                  <div class="featured-products2-controls__arrowRight">next
                    <div class="icon"><i class="fa-solid fa-angle-right"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="featured-products2-wrapper">
              <div class="swiper featured-products2-slider">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="featured-products2-card">
                      <div class="featured-products2-card__thumb">
                        <img src="{{ asset('frontend-assets/imgs/inner/featured-products/featured-products-thumb1_1.jpg') }}" alt="thumb">
                      </div>
                      <div class="featured-products2-card__content">
                        <div class="featured-products2-card__content-title"><a href="product-details.html">ClayPurify
                            Detox Mask</a></div>
                        <ul class="featured-products2-card__content-list">
                          <li class="featured-products2-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i>
                          </li>
                          <li class="featured-products2-card__content-list-point">5.0</li>
                          <li class="featured-products2-card__content-list-text">(135 Reviews)</li>
                        </ul>
                        <div class="featured-products2-card__content-dollar">$12.00</div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="featured-products2-card">
                      <div class="featured-products2-card__thumb">
                        <img src="{{ asset('frontend-assets/imgs/inner/featured-products/featured-products-thumb1_2.jpg') }}" alt="thumb">
                      </div>
                      <div class="featured-products2-card__content">
                        <div class="featured-products2-card__content-title"><a href="product-details.html">Hydraluxe
                            Body
                            Lotion</a></div>
                        <ul class="featured-products2-card__content-list">
                          <li class="featured-products2-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i>
                          </li>
                          <li class="featured-products2-card__content-list-point">5.0</li>
                          <li class="featured-products2-card__content-list-text">(135 Reviews)</li>
                        </ul>
                        <div class="featured-products2-card__content-dollar">$12.00</div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="featured-products2-card">
                      <div class="featured-products2-card__thumb">
                        <img src="{{ asset('frontend-assets/imgs/inner/featured-products/featured-products-thumb1_3.jpg') }}" alt="thumb">
                      </div>
                      <div class="featured-products2-card__content">
                        <div class="featured-products2-card__content-title"><a href="product-details.html">Crystal Peel
                            Polish</a></div>
                        <ul class="featured-products2-card__content-list">
                          <li class="featured-products2-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i>
                          </li>
                          <li class="featured-products2-card__content-list-point">5.0</li>
                          <li class="featured-products2-card__content-list-text">(135 Reviews)</li>
                        </ul>
                        <div class="featured-products2-card__content-dollar">$12.00</div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="featured-products2-card">
                      <div class="featured-products2-card__thumb">
                        <img src="{{ asset('frontend-assets/imgs/inner/featured-products/featured-products-thumb1_4.jpg') }}" alt="thumb">
                      </div>
                      <div class="featured-products2-card__content">
                        <div class="featured-products2-card__content-title"><a href="product-details.html">SilkSkin
                            Repair Oil</a></div>
                        <ul class="featured-products2-card__content-list">
                          <li class="featured-products2-card__content-list-start"><i class="fa-solid fa-star fa-fw"></i>
                          </li>
                          <li class="featured-products2-card__content-list-point">5.0</li>
                          <li class="featured-products2-card__content-list-text">(135 Reviews)</li>
                        </ul>
                        <div class="featured-products2-card__content-dollar">$12.00</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      
@endsection
