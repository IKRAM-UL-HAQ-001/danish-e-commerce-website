@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')


        <div class="breadcumb">
          <div class="container rr-container-1895">
            <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
              <div class="breadcumb-wrapper__title">About Us</div>
              <ul class="breadcumb-wrapper__items">
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <a href="index.html" class="breadcumb-wrapper__items-list-title">
                    Category
                  </a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <a href="index.html" class="breadcumb-wrapper__items-list-title2">
                    About Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <div class="about1 section-spacing-120 rr-ov-hidden">
          <div class="container rr-container-1350">
            <div class="row gy-4 gx-5 d-flex justify-content-center justify-content-between">
              <div class="col-lg-6">
                <div class="about1-thumb">
                  <img src="{{ asset('frontend-assets/imgs/inner/about/about-thumb1_1.jpg') }}" alt="thumb">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="about1-content">
                  <div class="section-heading3 wow fadeInRight" data-wow-delay="0.3s">
                    <span class="section-heading3__subtitle">ABOUT uS</span>
                    <h2 class="section-heading3__title">Beauty Made Simple, Stunning Always</h2>
                  </div>
                  <p class="about1-content__text">At BeauTen, we create high-quality, cruelty-free makeup products
                    designed to enhance your natural
                    glow. From everyday essentials to bold, statement shades, our mission is to empower everyone to
                    express themselves confidently. We combine innovative formulas with skin-friendly ingredients to
                    ensure every product is safe</p>
                  <p class="about1-content__subtext">Whether you’re looking for a subtle, everyday look or a glamorous,
                    head-turning style, our
                    collection makes beauty simple, fun, and inspiring.</p>
                  <div class="about1-content-info">
                    <ul class="about1-content-info__list">
                      <li class="about1-content-info__list-items">High-Quality Products</li>
                      <li class="about1-content-info__list-items">Sustainable & Ethical</li>
                    </ul>
                    <ul class="about1-content-info__list">
                      <li class="about1-content-info__list-items">High-Quality Products</li>
                      <li class="about1-content-info__list-items">Sustainable & Ethical</li>
                    </ul>
                  </div>
                  <div class="about1-content__items">“The highlighter gives such a radiant glow without looking
                    overdone. Makes me feel confident every day.”</div>
                  <div class="about1-content__button">
                    <a href="about.html" class="rr-btn-button">
                      <span class="text">About Us</span>
                      <span class="icon">
                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0.600006 4.59998H14.6M14.6 4.59998L10.6 8.59998M14.6 4.59998L10.6 0.599976"
                            stroke="#FFFFFF" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="about2 section-spacing-120 rr-ov-hidden pt-0">
          <div class="container rr-container-1350">
            <div class="row g-4 d-flex justify-content-center">
              <div class="col-xl-11 col-lg-10">
                <div class="about2-items">
                  <h1 class="about2-items__title">Unleash Your True Beauty <img
                      src="{{ asset('frontend-assets/imgs/inner/about/about-thumb1_2.jpg') }}" alt="img"> and Radiate
                    Confidence <img src="{{ asset('frontend-assets/imgs/inner/about/about-thumb1_3.jpg') }}" alt="img"> Every Day with Makeup
                    That Inspires and Empowers You</h1>
                  <div class="about2-items__hand-right">
                    <img src="{{ asset('frontend-assets/imgs/inner/about/right-hand.png') }}" alt="right-hand">
                  </div>
                  <div class="about2-items__info">
                    <div class="about2-items__info-title"> Leena Priya</div>
                    <p class="about2-items__info-subtitle">Fance,FT</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      
@endsection
