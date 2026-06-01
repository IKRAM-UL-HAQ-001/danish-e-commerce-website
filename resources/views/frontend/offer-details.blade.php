@extends('frontend.layouts.app')

@section('title', $offer->title ?? 'Offer Details')

@section('content')
<div class="breadcumb">
    <div class="container rr-container-1895">
        <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
            <div class="breadcumb-wrapper__title">
                Offer Details
            </div>
            <ul class="breadcumb-wrapper__items">
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <a href="{{ route('home') }}" class="breadcumb-wrapper__items-list-title">
                        Home
                    </a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <a href="{{ route('public.offer') }}" class="breadcumb-wrapper__items-list-title">
                        Offers
                    </a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <span class="breadcumb-wrapper__items-list-title2">
                        Details
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>

<section class="offer-details section-spacing-120 rr-ov-hidden">
    <div class="container rr-container-1350">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="offer-image-wrapper wow fadeInLeft" data-wow-delay=".3s">
                    <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('frontend-assets/imgs/offer/offer-banner.jpg') }}" 
                         alt="Special Offer" 
                         class="img-fluid rounded-4 shadow-lg w-100" 
                         style="object-fit: cover; max-height: 500px;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="offer-content wow fadeInRight" data-wow-delay=".3s">
                    <span class="offer-label mb-3 d-inline-block px-3 py-1 bg-primary text-white rounded-pill text-uppercase fw-bold" style="font-size: 0.8rem;">Exclusive Offer</span>
                    <h2 class="offer-title mb-4" style="font-size: 2.5rem; font-weight: 700; color: #0C0C0C;">
                        {{ $offer->title ?? 'Special Offer' }}
                    </h2>
                    
                    <div class="offer-description mb-4 text-muted" style="line-height: 1.8; font-size: 1.1rem;">
                        {!! nl2br(e($offer->description)) !!}
                    </div>

                    <div class="offer-pricing mb-5 d-flex align-items-center gap-3">
                        <span class="current-price" style="font-size: 2rem; font-weight: 700; color: #EE2D7A;">£{{ number_format($offer->price, 2) }}</span>
                        @if($offer->old_price)
                            <span class="old-price text-muted" style="text-decoration: line-through; font-size: 1.2rem;">£{{ number_format($offer->old_price, 2) }}</span>
                            <span class="discount-badge px-2 py-1 bg-danger-subtle text-danger rounded small fw-bold">
                                {{ round((($offer->old_price - $offer->price) / $offer->old_price) * 100) }}% OFF
                            </span>
                        @endif
                    </div>

                    <div class="offer-actions">
                        <button class="rr-btn-button add-to-cart" data-offer_id="{{ $offer->id }}" data-quantity="1" style="padding: 15px 40px; font-size: 1.1rem;">
                            <span class="text">Add to Cart Now</span>
                            <span class="icon">
                                <svg width="11" height="7" viewBox="0 0 11 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.419678 3.21674H10.2098M10.2098 3.21674L7.41265 6.01393M10.2098 3.21674L7.41265 0.419556" stroke="white" stroke-width="0.839157" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
