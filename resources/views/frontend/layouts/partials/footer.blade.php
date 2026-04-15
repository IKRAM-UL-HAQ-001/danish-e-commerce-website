      <footer class="footer1 rr-ov-hidden" style="background-image: url({{ asset('frontend-assets/imgs/footer/footer-bg1.jpg') }});">
        <div class="container rr-container-1350">
          <div class="footer1-main">
            <div class="row g-5 d-flex justify-content-between">
              <div class="col-xl-2 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                <div class="footer1-widget">
                  <div class="footer1-widget__title">Customer Support</div>
                  <div class="footer1-widget__nav">
                    <a class="footer1-widget__nav-link" href="#">Store List</a>
                    <a class="footer1-widget__nav-link" href="#">Opening Hours</a>
                    <a class="footer1-widget__nav-link" href="{{ route('contact') }}">Contact Us</a>
                    <a class="footer1-widget__nav-link" href="#">Return Policy</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-md-6 wow fadeInUp" data-wow-delay=".5s">
                <div class="footer1-widget">
                  <div class="footer1-widget__title">Custom Care</div>
                  <div class="footer1-widget__nav">
                    <a class="footer1-widget__nav-link" href="#">Search</a>
                    <a class="footer1-widget__nav-link" href="#">Site Map</a>
                    <a class="footer1-widget__nav-link" href="#">Order History</a>
                    <a class="footer1-widget__nav-link" href="#">Gift Vouchers</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-2 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                <div class="footer1-widget">
                  <div class="footer1-widget__title">Get in touch</div>
                  <div class="footer1-widget__contact">
                    <a class="footer1-widget__contact-link" href="tel:89(09)23461894">
                      <i class="fa-solid fa-phone me-2"></i> 89 (09) 2346 1894
                    </a>
                    <a class="footer1-widget__contact-link" href="mailto:exmplor@gmail.com">
                      <i class="fa-solid fa-envelope me-2"></i> exmplor@gmail.com
                    </a>
                    <a class="footer1-widget__contact-link" href="#">
                      <i class="fa-solid fa-location-dot me-2"></i> Holy Rad Park, USA
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6 wow fadeInUp" data-wow-delay=".9s">
                <div class="footer1-widget ps-xl-5 ms-xl-5">
                  <div class="footer1-widget__logo">
                    <img src="{{ asset('frontend-assets/imgs/logo/footer-logo.png') }}" alt="logo">
                  </div>
                  <p class="footer1-widget__text">Leading e-commerce beauty store providing the best-curated skin care and cosmetics products worldwide.</p>
                  <div class="footer1-widget__social-link">
                    <a href="https://www.facebook.com/share/1akN9wgZ8X/"> <span><i class="fa-brands fa-facebook-f"></i></span> </a>
                    <a href="https://www.tiktok.com/@aenum.luxe?_r=1&_t=ZN-95TrGjnkFp0"> <span><i class="fa-brands  fa-tiktok"></i></span> </a>
                    <a href="https://www.instagram.com/aenum_luxe_style?igsh=eGt1aXpkOW1wZG9u&utm_source=qr"> <span><i class="fa-brands fa-instagram"></i></span> </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="footer1-bottom">
          <div class="container rr-container-1350">
            <div class="footer1-bottom__wrapper">
              <div class="footer1-bottom__copyright wow fadeInLeft" data-wow-delay=".9s">© {{ date('Y') }} <a href="{{ route('home') }}">
                  {{ config('app.name') }}</a>. All Rights Reserved.</div>
              <div class="footer1-bottom__navs wow fadeInRight" data-wow-delay=".9s">
                <a href="#">Terms of Services</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Cookie Policy</a>
              </div>
            </div>
          </div>
        </div>
      </footer>

    </div>
  </div>

  <script src="{{ asset('frontend-assets/vandor/jquery/jquery.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/popup/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/gsap/gsap.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/gsap/ScrollSmoother.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/gsap/ScrollTrigger.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/gsap/SplitText.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/gsap/SplitType.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/gsap/customEase.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/odometer/odometer.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/odometer/waypoints.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/menu/jquery.meanmenu.min.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/backtop/backToTop.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/nice-select/nice-select.js') }}"></script>
  <script src="{{ asset('frontend-assets/vandor/wow/wow.min.js') }}"></script>

  <script src="{{ asset('frontend-assets/vandor/common-js/common.js') }}"></script>
  <script src="{{ asset('frontend-assets/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
