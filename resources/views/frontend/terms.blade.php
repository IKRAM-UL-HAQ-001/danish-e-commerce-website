@extends('frontend.layouts.app')

@section('title', 'Terms and Conditions')

@section('content')
<!-- Breadcumb -->
<div class="breadcumb">
    <div class="container rr-container-1895">
        <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
            <div class="breadcumb-wrapper__title">
                Terms & Conditions
            </div>
            <ul class="breadcumb-wrapper__items">
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <a href="{{ route('home') }}" class="breadcumb-wrapper__items-list-title">Home</a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                    <span class="breadcumb-wrapper__items-list-title2">Terms & Conditions</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="terms-area section-spacing-120">
    <div class="container rr-container-1350">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Main Title / Intro -->
                <!-- <div class="terms-intro mb-5 wow fadeInUp" data-wow-delay=".3s">
                    <h2 class="mb-4" style="color: black; font-family: var(--font_Playfair); font-size: 2.8rem; line-height: 1.2;">
                        {!! $term ? $term->content : 'Terms and Conditions' !!}
                    </h2>
                </div> -->

                <!-- Accordion Sections -->
                <div class="accordion custom-terms-accordion" id="termsAccordion">
                    @forelse($sections as $index => $section)
                    <div class="accordion-item mb-4 border-0 wow fadeInUp" data-wow-delay="{{ 0.3 + ($index * 0.1) }}s">
                        <h2 class="accordion-header" id="heading-{{ $section->id }}">
                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $section->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $section->id }}">
                                <span class="arrow-icon"><i class="fa-solid fa-play"></i></span>
                                {{ $section->title }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $section->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $section->id }}" data-bs-parent="#termsAccordion">
                            <div class="accordion-body">
                                {!! $section->content !!}
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted">Please add sections from the admin dashboard.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .custom-terms-accordion .accordion-item {
        background: #3C4858; /* Dark box color from screenshot */
        border-radius: 4px !important;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .custom-terms-accordion .accordion-button {
        background: #3C4858;
        color: whitesmoke; /* Theme primary color */
        font-family: var(--font_Lato);
        font-weight: 700;
        font-size: 1.2rem;
        padding: 30px 40px;
        box-shadow: none !important;
        border: none;
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .custom-terms-accordion .accordion-button:not(.collapsed) {
        background: #3C4858;
        color: whitesmoke;
    }

    .custom-terms-accordion .accordion-button::after {
        display: none; /* Hide default icon */
    }

    .custom-terms-accordion .arrow-icon {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
        color: white;
    }

    .custom-terms-accordion .accordion-button:not(.collapsed) .arrow-icon {
        transform: rotate(90deg);
    }

    .custom-terms-accordion .accordion-body {
        background: #F9F9F9;
        color: #333;
        padding: 40px;
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .custom-terms-accordion .accordion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
</style>
@endpush
@endsection
