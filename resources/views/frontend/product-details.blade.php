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
                  <a href="{{ route('public.shop') }}" class="breadcumb2-wrapper__items-list-title">
                    Category
                  </a>
                </li>
                <li class="breadcumb2-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb2-wrapper__items-list">
                  <a href="{{ route('public.product.details', $product->slug) }}" class="breadcumb2-wrapper__items-list-title2">
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
                            <img src="{{ $product->image_mobile? asset('storage/' . $product->image_mobile) : asset('frontend-assets/imgs/inner/product-details/product-details-thumb1_1.jpg') }}"
                              alt="{{ $product->name }}">
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
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                  <div class="product-details-content">
                    <h1 class="product-details-content__title mb-2"> {{ $product->name }}</h1>
                    <div class="product-details-content-items d-flex flex-wrap align-items-center gap-3">
                      <div class="product-details-content__price d-flex align-items-baseline gap-2">
                        <span class="price-now">£{{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                        <span class="price-was">£{{ number_format($product->old_price, 2) }}</span>
                        @endif
                        <span class="price-currency">GBP</span>
                      </div>
                      @if($product->discount)
                      <span class="product-details-content__badge-pill">{{ $product->discount }}% OFF</span>
                      @elseif($product->old_price && $product->old_price > $product->price)
                      <span class="product-details-content__badge-pill">{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}% OFF</span>
                      @endif
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
                      {{ Str::limit(strip_tags($product->description ?? ''), 200) ?: 'No description available for this product.' }}
                    </p>
                    <div class="product-details-content__info">
                      <p class="label mb-3">Quantity</p>
                      <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="qty">
                          <button class="qty-btn qty-minus" type="button" aria-label="Decrease">−</button>
                          <span class="qty-val" id="product-qty">1</span>
                          <button class="qty-btn qty-plus" type="button" aria-label="Increase">+</button>
                        </div>
                        <button class="btn-add add-to-cart" type="button" data-id="{{ $product->id }}" data-quantity="1">ADD TO CART
                          <span class="btn-icon" aria-hidden="true"><i
                              class="fa-duotone fa-thin fa-arrow-right-long"></i></span>
                        </button>
                        <button class="btn-heart wishlist-toggle-btn"
                                type="button"
                                aria-label="Wishlist"
                                data-id="{{ $product->id }}"
                                style="{{ collect(session('wishlist', []))->has($product->id) ? 'color:#EE2D7A;' : '' }}">
                          <i class="fa-solid fa-heart"></i>
                        </button>
                      </div>
                    </div>
                    <br>
                    <div class="product-details-content__meta mb-4">
                      <div class="meta-row">
                          <span class="k">SKU:</span>
                          <span class="v">{{ $product->sku ?? 'N/A' }}</span>
                      </div>

                      <div class="meta-row">
                          <span class="k">Category:</span>
                          <span class="v">{{ $product->category->name ?? 'N/A' }}</span>
                      </div>

                      <div class="meta-row">
                          <span class="k">Tag:</span>
                          <span class="v">{{ $product->tags ?? 'N/A' }}</span>
                      </div>

                      <div class="meta-row">
                          <span class="k">Color:</span>
                          <span class="v">

                              @if($product->color_name || $product->color_hex)

                                  <span style="display:inline-flex; align-items:center; gap:8px;">

                                      <span style="
                                          width:14px;
                                          height:14px;
                                          border-radius:4px;
                                          display:inline-block;
                                          border:1px solid #ddd;
                                          background: {{ $product->color_hex ?? '#ffffff' }};
                                      "></span>

                                      <span>
                                          {{ $product->color_name ?? $product->color_hex }}
                                      </span>

                                  </span>

                              @else
                                  N/A
                              @endif

                          </span>
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
                <button class="nav-link" id="three-tab" data-bs-toggle="tab" data-bs-target="#three-tab-pane"
                  type="button" role="tab" aria-controls="three-tab-pane" aria-selected="false">Reviews (<span id="reviews-count-badge">{{ $product->reviews_count ?? 0 }}</span>)</button>
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
                          <div class="product-tab-card__content-dsc">
                            {!! $product->description !!}
                          </div>
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
                        <p class="product-tab-items__text" id="reviews-summary"><span id="reviews-count-number">{{ $product->reviews_count ?? 0 }}</span> reviews for {{ $product->name }}</p>
                        
                        <div id="reviews-list">
                        @if(isset($product->reviews) && $product->reviews->count() > 0)
                          @foreach($product->reviews as $review)
                            <div class="product-tab-items__card d-flex align-items-start justify-content-between gap-3">
                              <div class="product-tab-items__card-info d-flex align-items-center justify-content-between gap-3">
                                <div class="product-tab-items__card-thumb">
                                  <img src="{{ $review->user->profile_photo_url ?? asset('frontend-assets/imgs/inner/product-details/image-1.png') }}" alt="{{ $review->user->name }}">
                                </div>
                                <div class="product-tab-items__card-info-content">
                                  <p class="product-tab-items__card-info-content-text">{{ $review->user->name }} – {{ $review->created_at->format('M d, Y') }}</p>
                                  <div class="product-tab-items__card-info-content-name">{{ $review->comment }}</div>
                                </div>
                              </div>
                              <div class="product-tab-items__card-info-star">
                                <div class="stars">
                                  @for($i = 0; $i < 5; $i++)
                                    <i class="fa-solid fa-star {{ $i < $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                  @endfor
                                </div>
                              </div>
                            </div>
                          @endforeach
                        @else
                          <p id="no-reviews">There are no reviews yet. Be the first to review "{{ $product->name }}"</p>
                        @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-5">
                      <div class="product-tab-contact">
                        <div class="product-tab-contact__title">Add a review</div>
                        <form action="{{ route('product.review', $product->id) }}" id="review-form" method="POST" class="product-tab-contact__form">
                          @csrf
                          <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="product-details-content__rating d-flex align-items-center gap-2 mb-2">
                                    <span class="label">Your Rating:</span>
                                    <div class="stars rating-input">
                                        <input type="hidden" name="rating" id="rating-value" value="5">
                                        <i class="fa-solid fa-star star-select clickable" data-value="1"></i>
                                        <i class="fa-solid fa-star star-select clickable" data-value="2"></i>
                                        <i class="fa-solid fa-star star-select clickable" data-value="3"></i>
                                        <i class="fa-solid fa-star star-select clickable" data-value="4"></i>
                                        <i class="fa-solid fa-star star-select clickable" data-value="5"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="product-tab-contact__form_input">
                                <span class="product-tab-contact__form-input-name">Your Message</span>
                                <textarea name="comment" class="product-tab-contact__form-input-field textarea"
                                  id="review-message" placeholder="Enter Your Message" required></textarea>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <button type="submit" class="rr-btn-button">
                                <span class="text">Submit Review</span>
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


      
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const qtyMinus = document.querySelector('.qty-minus');
        const qtyPlus = document.querySelector('.qty-plus');
        const qtyVal = document.getElementById('product-qty');
        const addToCartBtn = document.querySelector('.btn-add');

        if (qtyMinus && qtyPlus && qtyVal && addToCartBtn) {
            qtyMinus.addEventListener('click', function () {
                let currentQty = parseInt(qtyVal.textContent);
                if (currentQty > 1) {
                    currentQty--;
                    qtyVal.textContent = currentQty;
                    addToCartBtn.dataset.quantity = currentQty;
                }
            });

            qtyPlus.addEventListener('click', function () {
                let currentQty = parseInt(qtyVal.textContent);
                currentQty++;
                qtyVal.textContent = currentQty;
                addToCartBtn.dataset.quantity = currentQty;
            });
        }
        // Star rating selection
        const stars = document.querySelectorAll('.star-select');
        const ratingInput = document.getElementById('rating-value');

        if (stars && ratingInput) {
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const value = this.dataset.value;
                    ratingInput.value = value;

                    // Update UI
                    stars.forEach(s => {
                        if (parseInt(s.dataset.value) <= parseInt(value)) {
                            s.classList.add('text-warning');
                            s.classList.remove('text-muted');
                        } else {
                            s.classList.add('text-muted');
                            s.classList.remove('text-warning');
                        }
                    });
                });
            });

            // Set default (5 stars)
            const defaultValue = ratingInput.value;
            stars.forEach(s => {
                if (parseInt(s.dataset.value) <= parseInt(defaultValue)) {
                    s.classList.add('text-warning');
                } else {
                    s.classList.add('text-muted');
                }
            });
        }
        // Wishlist toggle
        const wishlistBtn = document.querySelector('.wishlist-toggle-btn');
        if (wishlistBtn) {
            wishlistBtn.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch('{{ route("wishlist.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ product_id: id }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        wishlistBtn.style.color = data.added ? '#EE2D7A' : '';
                        const badge = document.getElementById('wishlist-badge');
                        if (badge) badge.textContent = data.count;
                    }
                });
            });
        }

        // Default avatar for reviews (used when response doesn't include a URL)
        const defaultReviewAvatar = "{{ asset('frontend-assets/imgs/inner/product-details/image-1.png') }}";

        // Review form AJAX submission
        const reviewForm = document.getElementById('review-form');
        const reviewsList = document.getElementById('reviews-list');
        const reviewsCountBadge = document.getElementById('reviews-count-badge');
        const reviewsCountNumber = document.getElementById('reviews-count-number');
        const noReviewsP = document.getElementById('no-reviews');

        if (reviewForm && reviewsList) {
            reviewForm.addEventListener('submit', async function (e) {
                e.preventDefault();
                const rating = document.getElementById('rating-value').value;
                const comment = document.getElementById('review-message').value.trim();
                if (!comment) return;

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                try {
                    const res = await fetch(reviewForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ rating: rating, comment: comment })
                    });
                    const data = await res.json();
                    if (data && data.success && data.review) {
                        if (noReviewsP) noReviewsP.remove();
                        const rev = data.review;
                        const avatar = (rev.user && rev.user.profile_photo_url) ? rev.user.profile_photo_url : defaultReviewAvatar;
                        const createdAt = rev.created_at ? new Date(rev.created_at).toLocaleDateString() : new Date().toLocaleDateString();
                        const starsHtml = Array.from({ length: 5 }).map((_, i) => `<i class="fa-solid fa-star ${i < rev.rating ? 'text-warning' : 'text-muted'}"></i>`).join('');

                        const html = `
                            <div class="product-tab-items__card d-flex align-items-start justify-content-between gap-3">
                              <div class="product-tab-items__card-info d-flex align-items-center justify-content-between gap-3">
                                <div class="product-tab-items__card-thumb">
                                  <img src="${avatar}" alt="${rev.user ? rev.user.name : 'User'}">
                                </div>
                                <div class="product-tab-items__card-info-content">
                                  <p class="product-tab-items__card-info-content-text">${rev.user ? rev.user.name : 'User'} – ${createdAt}</p>
                                  <div class="product-tab-items__card-info-content-name">${rev.comment}</div>
                                </div>
                              </div>
                              <div class="product-tab-items__card-info-star">
                                <div class="stars">
                                  ${starsHtml}
                                </div>
                              </div>
                            </div>`;

                        reviewsList.insertAdjacentHTML('afterbegin', html);

                        const current = parseInt((reviewsCountBadge && reviewsCountBadge.textContent) || (reviewsCountNumber && reviewsCountNumber.textContent) || '0');
                        const next = current + 1;
                        if (reviewsCountBadge) reviewsCountBadge.textContent = next;
                        if (reviewsCountNumber) reviewsCountNumber.textContent = next;

                        reviewForm.reset();
                        document.getElementById('rating-value').value = 5;
                        document.querySelectorAll('.star-select').forEach(s => {
                            if (parseInt(s.dataset.value) <= 5) { s.classList.add('text-warning'); s.classList.remove('text-muted'); } else { s.classList.add('text-muted'); s.classList.remove('text-warning'); }
                        });
                    } else {
                        reviewForm.submit(); // fallback to normal submit
                    }
                } catch (err) {
                    reviewForm.submit(); // fallback
                }
            });
        }
    });
</script>
@endpush
@endsection
