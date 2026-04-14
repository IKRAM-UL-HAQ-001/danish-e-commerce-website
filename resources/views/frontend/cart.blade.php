@extends('frontend.layouts.app')

@section('title', 'Cart')

@section('content')


        <div class="breadcumb">
          <div class="container rr-container-1895">
            <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
              <div class="breadcumb-wrapper__title">My Shopping Cart</div>
              <ul class="breadcumb-wrapper__items">
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <a href="shop.html" class="breadcumb-wrapper__items-list-title">
                    Category
                  </a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <a href="cart.html" class="breadcumb-wrapper__items-list-title2">
                    My Shopping Cart
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <section class="cart-page section-spacing-120">
          <div class="container container-1352">
            <div class="row d-flex align-items-center justify-content-end">

              <div class="col-lg-12 col-md-12">
                <div class="cart-page__items">
                  <div class="cart-page__table">

                    <div class="cart-page__table-header">
                      <div class="row align-items-center">
                        <div class="col-md-5">
                          <div class="cart-page__table-header-text">Product</div>
                        </div>
                        <div class="col-md-2 text-center">
                          <div class="cart-page__table-header-text">Price</div>
                        </div>
                        <div class="col-md-2 text-center">
                          <div class="cart-page__table-header-text">Quantity</div>
                        </div>
                        <div class="col-md-2 text-center">
                          <div class="cart-page__table-header-text">Subtotal</div>
                        </div>
                        <div class="col-md-1 text-center">
                          <div class="cart-page__table-header-text">Remove</div>
                        </div>
                      </div>
                    </div>


                    <div class="cart-page__table-body" id="cart-page__table-body">

                      <div class="cart-page__item">
                        <div class="row align-items-center">
                          <div class="col-md-5">
                            <div class="cart-page__item-product">
                              <div class="cart-page__item-product-image">
                                <img src="{{ asset('frontend-assets/imgs/shop/product-1.jpg') }}" alt="Bond Shelving - Ceiling Mounted">
                              </div>
                              <div class="cart-page__item-product-info">
                                <div class="cart-page__item-product-title">
                                  <a href="product-details.html">Bond Shelving - Ceiling Mounted</a>
                                </div>
                                <p class="cart-page__item-product-sku">SKU: BS-CM-001</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2 text-center">
                            <div class="cart-page__item-price">116.00$</div>
                          </div>
                          <div class="col-md-2 text-center">
                            <div class="cart-page__item-qty">
                              <button type="button" class="cart-page__qty-btn cart-page__qty-btn--minus">−</button>
                              <input type="number" class="cart-page__qty-input" value="1" min="1" max="99">
                              <button type="button" class="cart-page__qty-btn cart-page__qty-btn--plus">+</button>
                            </div>
                          </div>
                          <div class="col-md-2 text-center">
                            <div class="cart-page__item-subtotal">116.00$</div>
                          </div>
                          <div class="col-md-1 text-center">
                            <button type="button" class="cart-page__remove" aria-label="Remove item">
                              <i class="fa-regular fa-trash-can"></i>
                            </button>
                          </div>
                        </div>
                      </div>


                      <div class="cart-page__item">
                        <div class="row align-items-center">
                          <div class="col-md-5">
                            <div class="cart-page__item-product">
                              <div class="cart-page__item-product-image">
                                <img src="{{ asset('frontend-assets/imgs/shop/product-2.jpg') }}" alt="Lush Glow Cream">
                              </div>
                              <div class="cart-page__item-product-info">
                                <div class="cart-page__item-product-title">
                                  <a href="product-details.html">Lush Glow Cream</a>
                                </div>
                                <p class="cart-page__item-product-sku">SKU: LGC-002</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2 text-center">
                            <div class="cart-page__item-price">56.00$</div>
                          </div>
                          <div class="col-md-2 text-center">
                            <div class="cart-page__item-qty">
                              <button type="button" class="cart-page__qty-btn cart-page__qty-btn--minus">−</button>
                              <input type="number" class="cart-page__qty-input" value="2" min="1" max="99">
                              <button type="button" class="cart-page__qty-btn cart-page__qty-btn--plus">+</button>
                            </div>
                          </div>
                          <div class="col-md-2 text-center">
                            <div class="cart-page__item-subtotal">112.00$</div>
                          </div>
                          <div class="col-md-1 text-center">
                            <button type="button" class="cart-page__remove" aria-label="Remove item">
                              <i class="fa-regular fa-trash-can"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="cart-page__actions">
                    <div class="row d-flex align-items-center justify-content-between">
                      <div class="col-md-6">
                        <a href="shop.html" class="cart-page__continue-shopping">
                          <i class="fa-regular fa-arrow-left"></i>
                          Continue Shopping
                        </a>
                      </div>
                      <div class="col-md-6 text-end">
                        <button type="button" class="rr-btn-button" id="cart-update-btn">

                          <span class="text">Update cart</span>
                          <span class="icon">
                            <svg width="16" height="10" viewBox="0 0 16 10" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.600006 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                                stroke="#0C0C0C" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                              </path>
                            </svg>
                          </span>
                        </button>
                      </div>
                    </div>
                  </div>


                  <div class="cart-page__coupon">
                    <h3 class="cart-page__coupon-title">Coupon</h3>
                    <p class="cart-page__coupon-text">Enter your coupon code if you have one.</p>
                    <form class="cart-page__coupon-form">
                      <div class="row">
                        <div class="col-md-8">
                          <input type="text" class="cart-page__coupon-input" placeholder="Enter coupon code">
                        </div>
                        <div class="col-md-4">

                          <button type="submit" class="rr-btn-button" id="cart-coupon-btn">
                            <span class="text">Apply Coupon</span>
                            <span class="icon">
                              <svg width="16" height="10" viewBox="0 0 16 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.599976 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
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


              <div class="col-lg-4 col-md-12">
                <div class="cart-page__totals">
                  <h3 class="cart-page__totals-title">Cart Totals</h3>


                  <div class="cart-page__totals-card">

                    <div class="cart-page__totals-row">
                      <span class="cart-page__totals-label">Subtotal</span>
                      <span class="cart-page__totals-value" id="cart-subtotal">228.00$</span>
                    </div>


                    <div class="cart-page__totals-row">
                      <span class="cart-page__totals-label">Shipping</span>
                      <span class="cart-page__totals-value cart-page__totals-value--muted">
                        Flat rate: $8.00<br>
                        Shipping to Bangladesh<br>
                        Change address
                      </span>
                    </div>


                    <div class="cart-page__totals-row cart-page__totals-row--total">
                      <span class="cart-page__totals-label">Total</span>
                      <span class="cart-page__totals-value cart-page__totals-value--highlight"
                        id="cart-total">228.00$</span>
                    </div>
                  </div>


                  <a href="checkout.html" class="cart-page__checkout-btn">
                    Proceed to Checkout
                    <i class="fa-regular fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>


      
@endsection
