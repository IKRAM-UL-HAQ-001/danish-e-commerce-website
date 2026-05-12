@extends('dashboard.layouts.app')

@section('title', 'Site Settings')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">General Configuration</h4>
                <p class="card-description">Manage your store's public identity and contact details.</p>
                <form action="{{ route('settings.update') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="site_name" value="{{ $settings['site_name'] ?? '' }}" placeholder="My Awesome Store">
                    </div>
                    <div class="form-group mb-3">
                        <label for="site_email">Support Email</label>
                        <input type="email" name="site_email" class="form-control" id="site_email" value="{{ $settings['site_email'] ?? '' }}" placeholder="support@myapp.com">
                    </div>
                    <div class="form-group mb-3">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="+1 234 567 890">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Business Address</label>
                        <textarea name="address" class="form-control" id="address" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                    </div>
                    <hr>
                    <h4 class="card-title mt-4">Social Links</h4>
                    <div class="form-group mb-3">
                        <label for="facebook">Facebook URL</label>
                        <input type="url" name="facebook" class="form-control" id="facebook" value="{{ $settings['facebook'] ?? '' }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="instagram">Instagram URL</label>
                        <input type="url" name="instagram" class="form-control" id="instagram" value="{{ $settings['instagram'] ?? '' }}">
                    </div>

                    <hr>
                    <h4 class="card-title mt-4">Hero Section Configuration</h4>
                    <p class="card-description">Customize the homepage hero banner.</p>
                    <div class="form-group mb-3">
                        <label for="hero_subtext">Hero Subtext (Small text above title)</label>
                        <input type="text" name="hero_subtext" class="form-control" id="hero_subtext" value="{{ $settings['hero_subtext'] ?? 'Glow Beyond Beauty' }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="hero_title">Hero Title</label>
                        <input type="text" name="hero_title" class="form-control" id="hero_title" value="{{ $settings['hero_title'] ?? 'Beauty That Shines Naturally' }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="hero_desc">Hero Description</label>
                        <textarea name="hero_desc" class="form-control" id="hero_desc" rows="3">{{ $settings['hero_desc'] ?? '' }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="hero_image">Hero Image (796x750 recommended)</label>
                        <input type="file" name="hero_image" class="form-control" id="hero_image">
                        @if(isset($settings['hero_image']))
                            <div class="mt-2">
                                <img src="{{ asset($settings['hero_image']) }}" alt="Hero Preview" style="max-width: 200px; border-radius: 8px;">
                            </div>
                        @endif
                    </div>

                    <hr>
                    <h4 class="card-title mt-4">Offer Banner Configuration</h4>
                    <p class="card-description">Customize the middle offer banner.</p>
                    <div class="form-group mb-3">
                        <label for="offer_subtext">Offer Subtext</label>
                        <input type="text" name="offer_subtext" class="form-control" id="offer_subtext" value="{{ $settings['offer_subtext'] ?? '' }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="offer_title">Offer Title (HTML allowed)</label>
                        <input type="text" name="offer_title" class="form-control" id="offer_title" value="{{ $settings['offer_title'] ?? '' }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="offer_desc">Offer Description</label>
                        <textarea name="offer_desc" class="form-control" id="offer_desc" rows="3">{{ $settings['offer_desc'] ?? '' }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="offer_bg">Offer Banner Background (1350x300 recommended)</label>
                        <input type="file" name="offer_bg" class="form-control" id="offer_bg">
                        @if(isset($settings['offer_bg']))
                            <div class="mt-2">
                                <img src="{{ asset($settings['offer_bg']) }}" alt="Offer Preview" style="max-width: 200px; border-radius: 8px;">
                            </div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="offer_link">Offer Redirect Link</label>
                        <input type="text" name="offer_link" class="form-control" id="offer_link" value="{{ $settings['offer_link'] ?? '' }}" placeholder="/shop or https://...">
                    </div>

                    <hr>
                    <h4 class="card-title mt-4">Features / CTA Section</h4>
                    <p class="card-description">Customize the three feature blocks below the offer banner.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Feature 1</h5>
                            <div class="form-group mb-2">
                                <label>Title</label>
                                <input type="text" name="feature1_title" class="form-control" value="{{ $settings['feature1_title'] ?? '' }}">
                            </div>
                            <div class="form-group mb-2">
                                <label>Description</label>
                                <textarea name="feature1_desc" class="form-control" rows="2">{{ $settings['feature1_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Feature 2</h5>
                            <div class="form-group mb-2">
                                <label>Title</label>
                                <input type="text" name="feature2_title" class="form-control" value="{{ $settings['feature2_title'] ?? '' }}">
                            </div>
                            <div class="form-group mb-2">
                                <label>Description</label>
                                <textarea name="feature2_desc" class="form-control" rows="2">{{ $settings['feature2_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5>Feature 3</h5>
                            <div class="form-group mb-2">
                                <label>Title</label>
                                <input type="text" name="feature3_title" class="form-control" value="{{ $settings['feature3_title'] ?? '' }}">
                            </div>
                            <div class="form-group mb-2">
                                <label>Description</label>
                                <textarea name="feature3_desc" class="form-control" rows="2">{{ $settings['feature3_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h4 class="card-title mt-4">Testimonials</h4>
                    <div class="form-group mb-3">
                        <label for="testimonial_title">Testimonial Section Title</label>
                        <input type="text" name="testimonial_title" class="form-control" id="testimonial_title" value="{{ $settings['testimonial_title'] ?? 'WHAT OUR CUSTOMERS SAY' }}">
                    </div>
                    <button type="submit" class="btn btn-primary me-2 text-white">Save All Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
