@extends('frontend.layouts.app')

@section('title', 'Contact')

@section('content')


        <div class="breadcumb">
          <div class="container rr-container-1895">
            <div class="breadcumb-wrapper section-spacing-120 fix" data-bg-src="{{ asset('frontend-assets/imgs/breadcumbBg.jpg') }}">
              <div class="breadcumb-wrapper__title">Contact Us</div>
              <ul class="breadcumb-wrapper__items">
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-house"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <a href="contact.html" class="breadcumb-wrapper__items-list-title">
                    Category
                  </a>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <i class="fa-regular fa-chevron-right"></i>
                </li>
                <li class="breadcumb-wrapper__items-list">
                  <a href="contact.html" class="breadcumb-wrapper__items-list-title2">
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <section class="contact2 section-spacing-120 rr-ov-hidden">
          <div class="container">
            <div class="row d-flex justify-content-center">
              <div class="col-xl-7">
                <div class="section-heading wow fadeInRight" data-wow-delay="0.3s">
                  <h2 class="section-heading__title">Get In Touch Today!</h2>
                  <p class="section-heading__text">We’d love to hear from you! Reach out today for inquiries, support,
                    or collaborations, and our friendly team will respond promptly with all the help you need.</p>
                </div>
                <form action="contact.php" id="contact-form" method="POST" class="contact2-form">
                  <div class="contact2-form__content">
                    <div class="row g-4">
                      <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="contact2-form__input">
                          <span class="contact2-form__input-name">Your Name</span>
                          <input type="text" class="contact2-form__input-field" name="name" id="name"
                            placeholder="Your name">
                        </div>
                      </div>
                      <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                        <div class="contact2-form__input">
                          <span class="contact2-form__input-name">Your Email</span>
                          <input type="text" class="contact2-form__input-field" name="email" id="email1"
                            placeholder="Email address">
                        </div>
                      </div>
                      <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                        <div class="contact2-form__input">
                          <span class="contact2-form__input-name">Phone Number</span>
                          <input type="text" class="contact2-form__input-field" name="number" id="number"
                            placeholder="Phone number">
                        </div>
                      </div>

                      <div class="col-lg-12 wow fadeInUp" data-wow-delay=".7s">
                        <div class="contact2-form__input">
                          <span class="contact2-form__input-name">Your Message</span>
                          <textarea name="message" class="contact2-form__input-field textarea" id="message"
                            placeholder="Type your message"></textarea>
                        </div>
                      </div>
                      <div class="col-lg-12 wow fadeInUp" data-wow-delay=".9s">
                        <div class="contact2-form__button">
                          <a class="btn-orange" href="contact.html">SENDMESSAGES</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>


        <div class="map fix">
          <iframe
            src="https://www.google.com/maps?q=United+Kingdom&output=embed"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
          </iframe>
        </div>

      
@endsection
