@extends('frontend.layouts.app')

@section('title', 'Special Offers')

@section('content')
<div class="breadcumb">
    <div class="container rr-container-1895">
        <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
            <div class="breadcumb-wrapper__title">
                Special Offers
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
                    <span class="breadcumb-wrapper__items-list-title2">
                        Offers
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>

<section class="offers-list section-spacing-120 rr-ov-hidden">
    <div class="container rr-container-1350">
        <div class="section-heading text-center mb-5">
            <h2 class="section-heading__title">Our Active Offers</h2>
            <p class="mt-2 text-muted">Discover our best deals on premium beauty products.</p>
        </div>

        <div class="row g-4">
            @forelse($offers as $offer)
            <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="offer-card shadow-sm rounded-4 overflow-hidden h-100 bg-white border">
                    <div class="offer-card__thumb position-relative">
                        <img src="{{ $offer->image ? asset('storage/' . $offer->image) : asset('frontend-assets/imgs/offer/offer-banner.jpg') }}" 
                             alt="{{ $offer->product->name ?? 'Offer' }}" 
                             class="w-100" 
                             style="height: 250px; object-fit: cover;">
                        <div class="offer-card__badge position-absolute top-0 end-0 m-3 px-3 py-1 bg-primary text-white rounded-pill fw-bold" style="font-size: 0.75rem;">
                            ACTIVE
                        </div>
                    </div>
                    <div class="offer-card__content p-4">
                        <h4 class="offer-card__title mb-2" style="font-weight: 700;">
                            {{ $offer->title ?? 'Special Offer' }}
                        </h4>
                        <p class="offer-card__desc text-muted mb-4" style="font-size: 0.9rem; line-height: 1.6;">
                            {{ Str::limit($offer->description, 100) }}
                        </p>
                        
                        <div class="offer-card__footer d-flex align-items-center justify-content-between mt-auto">
                            <div class="offer-card__price">
                                <span class="fw-bold text-primary" style="font-size: 1.25rem;">£{{ number_format($offer->price, 2) }}</span>
                                @if($offer->old_price)
                                <span class="text-muted text-decoration-line-through ms-2" style="font-size: 0.9rem;">£{{ number_format($offer->old_price, 2) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('public.offer.details', $offer->id) }}" class="rr-btn-button" style="padding: 10px 20px; font-size: 0.85rem;">
                                <span class="text">View Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h3 class="text-muted">No active offers at the moment.</h3>
                <a href="{{ route('public.shop') }}" class="rr-btn-button mt-4">
                    <span class="text">Back to Shop</span>
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection