/***************************************************
==================== JS INDEX ======================
01. Data Background Set
02. Sticky Header
03. GSAP Plugins Register
04. Smooth Scroll
05. Fade Animation
06. Preloader
07. Side Info Toggle
08. Mean Menu Init
09. Video Popup
10. Text Invert Scroll Effect
11. Smooth Anchor Scroll
12. Nice Select Init
****************************************************/

(function ($) {
    "use strict";

    var windowOn = $(window);
    let mm = gsap.matchMedia();

    /* === Data Css Js (index 01) === */
    $("[data-background]").each(function () {
        $(this).css(
            "background-image",
            "url( " + $(this).attr("data-background") + "  )"
        );
    });

    /* === sticky header Js (index 02) === */
    function pinned_header() {
        var lastScrollTop = 0;

        windowOn.on('scroll', function () {
            var currentScrollTop = $(this).scrollTop();
            if (currentScrollTop > lastScrollTop) {
                $('.header-sticky').removeClass('sticky');
                $('.header-sticky').addClass('transformed');
            } else if ($(this).scrollTop() <= 500) {
                $('.header-sticky').removeClass('sticky');
                $('.header-sticky').removeClass('transformed');
            } else {
                // Scrolling up, remove the class
                $('.header-sticky').addClass('sticky');
                $('.header-sticky').removeClass('transformed');
            }
            lastScrollTop = currentScrollTop;
        });
    }
    pinned_header();

    /* === Register GSAP Plugins Js (index 02) === */
    gsap.registerPlugin(ScrollTrigger, ScrollSmoother, CustomEase);

    /* === Smooth active Js (index 03) === */
    var device_width = window.screen.width;

    if (device_width > 767) {
        const smoothElement = document.querySelector("#has_smooth");
        if (smoothElement && smoothElement.classList.contains("has-smooth")) {
            const smoother = ScrollSmoother.create({
                smooth: 0.9,
                effects: device_width < 1025 ? false : true,
                smoothTouch: 0.1,
                // normalizeScroll: false,
                normalizeScroll: {
                    allowNestedScroll: true,
                },
                ignoreMobileResize: true,
            });
        }

    }

    /* === GSAP Fade Animation Js (index 04) === */
    let fadeArray_items = document.querySelectorAll(".fade-anim");
    if (fadeArray_items.length > 0) {
        const fadeArray = gsap.utils.toArray(".fade-anim")
        fadeArray.forEach((item, i) => {
            var fade_direction = "bottom"
            var onscroll_value = 1
            var duration_value = 1.15
            var fade_offset = 50
            var delay_value = 0.15
            var ease_value = "power2.out"
            if (item.getAttribute("data-offset")) {
                fade_offset = item.getAttribute("data-offset");
            }
            if (item.getAttribute("data-duration")) {
                duration_value = item.getAttribute("data-duration");
            }
            if (item.getAttribute("data-direction")) {
                fade_direction = item.getAttribute("data-direction");
            }
            if (item.getAttribute("data-on-scroll")) {
                onscroll_value = item.getAttribute("data-on-scroll");
            }
            if (item.getAttribute("data-delay")) {
                delay_value = item.getAttribute("data-delay");
            }
            if (item.getAttribute("data-ease")) {
                ease_value = item.getAttribute("data-ease");
            }
            let animation_settings = {
                opacity: 0,
                ease: ease_value,
                duration: duration_value,
                delay: delay_value,
            }
            if (fade_direction == "top") {
                animation_settings['y'] = -fade_offset
            }
            if (fade_direction == "left") {
                animation_settings['x'] = -fade_offset;
            }
            if (fade_direction == "bottom") {
                animation_settings['y'] = fade_offset;
            }
            if (fade_direction == "right") {
                animation_settings['x'] = fade_offset;
            }
            if (onscroll_value == 1) {
                animation_settings['scrollTrigger'] = {
                    trigger: item,
                    start: 'top 85%',
                }
            }
            gsap.from(item, animation_settings);
        })
    }

    /* === Preloader Animation  Js (index 05) === */
    if (document.querySelectorAll(".loader-wrap").length > 0) {
        $(document).ready(function () {

            // Preloader timing + fadeout
            setTimeout(function () {
                $('#container').addClass('loaded');
            }, 500);

            setTimeout(function () {
                $('.loader-wrap').fadeOut(1000, function () {
                    $(this).remove();
                    // ✅ Trigger text animation AFTER preloader is gone
                    startTextAnimation();
                });
            }, 3000);

            // === Odometer counter trigger ===
            $('.odometer').waypoint(function (direction) {
                if (direction === 'down') {
                    let countNumber = $(this.element).attr("data-count");
                    $(this.element).html(countNumber);
                }
            }, { offset: '80%' });

            // === SVG Wave Animation ===
            const svg = document.getElementById("svg");
            const tl = gsap.timeline();
            const curve = "M0 502S175 272 500 272s500 230 500 230V0H0Z";
            const flat = "M0 2S175 1 500 1s500 1 500 1V0H0Z";

            tl.to(".loader-wrap-heading .load-text , .loader-wrap-heading .cont", {
                delay: 1.5,
                y: -100,
                opacity: 0,
            });
            tl.to(svg, {
                duration: 0.5,
                attr: { d: curve },
                ease: "power2.easeIn",
            }).to(svg, {
                duration: 0.5,
                attr: { d: flat },
                ease: "power2.easeOut",
            });
            tl.to(".loader-wrap", { y: -1500 });
            tl.to(".loader-wrap", { zIndex: -1, display: "none" });
            tl.from("main", { y: 0, opacity: 0, delay: 0.3 }, "-=1.5");

        });

        // ✅ GSAP Text Animation (runs after preloader ends)
        function startTextAnimation() {
            if ($('.rr-title-anim-2').length) {
                gsap.registerPlugin(ScrollTrigger, SplitText);

                let staggerAmount = 0.05,
                    translateXValue = 20,
                    delayValue = 0.5,
                    easeType = "power2.out",
                    animatedTextElements = document.querySelectorAll('.rr-title-anim-2');

                animatedTextElements.forEach((element) => {
                    let animationSplitText = new SplitText(element, { type: "chars, words" });
                    gsap.from(animationSplitText.chars, {
                        duration: 1,
                        delay: delayValue,
                        x: translateXValue,
                        autoAlpha: 0,
                        stagger: staggerAmount,
                        ease: easeType,
                        scrollTrigger: { trigger: element, start: "top 85%" },
                    });
                });
            }
        }
    }

    /* === Mean menu activation  Js (index 07) === */
    $('.main-menu').meanmenu({
        meanScreenWidth: "1199",
        meanMenuContainer: '.mobile-menu',
        meanMenuCloseSize: '28px',
    });
    $('.main-menu-all').meanmenu({
        meanScreenWidth: "5000",
        meanMenuContainer: '.mobile-menu',
        meanMenuCloseSize: '28px',
    });

    /* === Mobile Category Drill-Down Navigation === */
    $(document).ready(function() {
        // Replace + icons with > icons for category items and set up drill-down behavior
        setTimeout(function() {
            var $mobileMenu = $('.mobile-menu');
            
            // Find the Categories menu item
            var $categoriesMenuItem = null;
            var $categoryItems = null;
            
            $mobileMenu.find('> ul > li').each(function() {
                var $li = $(this);
                if ($li.find('> a').text().trim() === 'Categories' || $li.find('> a').text().trim().toLowerCase().includes('categor')) {
                    $categoriesMenuItem = $li;
                    $categoryItems = $li.find('> ul > li'); // Get direct category children
                    return false;
                }
            });
            
            if ($categoryItems && $categoryItems.length > 0) {
                // Set up drill-down for each category item
                $categoryItems.each(function() {
                    var $categoryLi = $(this);
                    var $categorySubmenu = $categoryLi.find('> ul');
                    var $trigger = $categoryLi.find('> .meanmenu-reveal');
                    
                    if ($categorySubmenu.length > 0 && $trigger.length > 0) {
                        // Replace the icon with >
                        $trigger.html('&rsaquo;').css({
                            'font-size': '20px',
                            'line-height': '1',
                            'cursor': 'pointer'
                        });
                        
                        // Prevent default expand behavior
                        $trigger.off('click').on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Hide all items in the categories menu except this one
                            $categoryItems.css('display', 'none');
                            
                            // Show this category
                            $categoryLi.css('display', 'block');
                            
                            // Show its submenu
                            $categorySubmenu.css('display', 'block');
                            
                            // Hide the trigger/icon
                            $trigger.css('display', 'none');
                            
                            // Add a back button if it doesn't exist
                            if ($mobileMenu.find('.mobile-menu-back').length === 0) {
                                var $backBtn = $('<li class="mobile-menu-back"><a href="#"><span>&larr;</span> Back</a></li>');
                                
                                $backBtn.find('a').css({
                                    'display': 'flex',
                                    'align-items': 'center',
                                    'font-weight': '600',
                                    'color': '#0c0c0c',
                                    'padding': '10px 0',
                                    'text-decoration': 'none'
                                });
                                
                                $backBtn.find('span').css({
                                    'margin-right': '10px',
                                    'font-size': '18px'
                                });
                                
                                $backBtn.on('click', function(e) {
                                    e.preventDefault();
                                    
                                    // Reset: show all categories again
                                    $categoryItems.css('display', 'list-item');
                                    
                                    // Hide all submenus
                                    $categoryItems.find('> ul').css('display', 'none');
                                    
                                    // Show all triggers/icons again
                                    $categoryItems.find('> .meanmenu-reveal').css('display', 'block');
                                    
                                    // Remove the back button
                                    $backBtn.remove();
                                });
                                
                                // Insert back button at the top of the mobile menu
                                $mobileMenu.find('> ul').prepend($backBtn);
                            }
                        });
                    }
                });
            }
        }, 100); // Small delay to ensure meanmenu has rendered
    });

    /* === Magnific Video popup Js (index 08) === */
    if ($('.video-popup').length && 'magnificPopup' in jQuery) {
        $('.video-popup').magnificPopup({
            type: 'iframe',
        });
    }

    /* === Text Invert With Scroll Js (index 09) === */
    const split = new SplitText(".text-invert", { type: "lines" });
    split.lines.forEach((target) => {
        gsap.to(target, {
            backgroundPositionX: 0,
            ease: "none",
            scrollTrigger: {
                trigger: target,
                scrub: 1,
                start: 'top 85%',
                end: "bottom center",
            }
        });
    });



    /* === gsap nav Js (index 10) === */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: 'smooth',
                });
            }
        });
    });

    /* === Nice Select Js (index 11) === */
    $("select").niceSelect();


    /* ========  main Js ======== */


})(jQuery);


/* === Side Info Toggle (independent of GSAP) === */
(function ($) {
    "use strict";

    function closeSidebar() {
        $(".side-info").removeClass("info-open");
        $(".offcanvas-overlay").removeClass("overlay-open");
        $("body, html").css({
            "overflow": "",
            "position": "",
            "width": ""
        });
        $(".bar-icon").removeClass("active");
    }

    function openSidebar() {
        $(".side-info").addClass("info-open");
        $(".offcanvas-overlay").addClass("overlay-open");
        $("body, html").css({
            "overflow": "hidden",
            "position": "fixed",
            "width": "100%"
        });
        $(".bar-icon").addClass("active");
    }

    // Close sidebar handlers
    $(document).on("click", ".side-info-close, .offcanvas-overlay", function (e) {
        e.preventDefault();
        e.stopPropagation();
        closeSidebar();
    });

    // Open/close sidebar handler
    $(document).on("click", ".side-toggle", function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $sidebar = $(".side-info");
        if ($sidebar.hasClass("info-open")) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    // Close on escape key
    $(document).on("keydown", function (e) {
        if (e.key === "Escape" || e.keyCode === 27) {
            if ($(".side-info").hasClass("info-open")) {
                closeSidebar();
            }
        }
    });

})(jQuery);
