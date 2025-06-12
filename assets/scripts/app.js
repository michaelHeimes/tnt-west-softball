/**
 * Required
 */
 
 //@prepros-prepend vendor/foundation/js/plugins/foundation.core.js

/**
 * Optional Plugins
 * Remove * to enable any plugins you want to use
 */
 
 // What Input
 //@*prepros-prepend vendor/whatinput.js
 
 // Foundation Utilities
 // https://get.foundation/sites/docs/javascript-utilities.html
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.box.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.imageLoader.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.keyboard.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.mediaQuery.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.motion.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.nest.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.timer.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.touch.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.triggers.min.js


// JS Form Validation
//@*prepros-prepend vendor/foundation/js/plugins/foundation.abide.js

// Tabs UI
//@prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// Accordian
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

// Menu enhancements
//@prepros-prepend vendor/foundation/js/plugins/foundation.drilldown.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.dropdown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdownMenu.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.responsiveMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveToggle.js

// Equalize heights
//@*prepros-prepend vendor/foundation/js/plugins/foundation.equalizer.js

// Responsive Images
//@*prepros-prepend vendor/foundation/js/plugins/foundation.interchange.js

// Navigation Widget
//@*prepros-prepend vendor/foundation/js/plugins/foundation.magellan.js

// Offcanvas Naviagtion Option
//@prepros-prepend vendor/foundation/js/plugins/foundation.offcanvas.js

// Carousel (don't ever use)
//@*prepros-prepend vendor/foundation/js/plugins/foundation.orbit.js

// Modals
//@prepros-prepend vendor/foundation/js/plugins/foundation.reveal.js

// Form UI element
//@*prepros-prepend vendor/foundation/js/plugins/foundation.slider.js

// Anchor Link Scrolling
//@prepros-prepend vendor/foundation/js/plugins/foundation.smoothScroll.js

// Sticky Elements
//@prepros-prepend vendor/foundation/js/plugins/foundation.sticky.js

// On/Off UI Switching
//@*prepros-prepend vendor/foundation/js/plugins/foundation.toggler.js

// Tooltips
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tooltip.js

// What Input
//@prepros-prepend vendor/what-input.js

// Swiper
//@prepros-prepend vendor/swiper-bundle.js

// DOM Ready
(function($) {
	'use strict';
    
    var _app = window._app || {};
    
    _app.foundation_init = function() {
        $(document).foundation();
    }
        
    _app.emptyParentLinks = function() {
            
        $('.menu li a[href="#"]').click(function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;
        });	
        
    };
    
    _app.fixed_nav_hack = function() {
        $('.off-canvas').on('opened.zf.offCanvas', function() {
            $('header.site-header').addClass('off-canvas-content is-open-right has-transition-push');		
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').addClass('clicked');	
        });
        
        $('.off-canvas').on('close.zf.offCanvas', function() {
            $('header.site-header').removeClass('off-canvas-content is-open-right has-transition-push');
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
        });
        
        $(window).on('resize', function() {
            if ($(window).width() > 1023) {
                $('.off-canvas').foundation('close');
                $('header.site-header').removeClass('off-canvas-content has-transition-push');
                $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
            }
        });    
    }
    
    _app.display_on_load = function() {
        $('.display-on-load').css('visibility', 'visible');
    }
    
    // Custom Functions
    
    _app.mobile_takover_nav = function() {
        $(document).on('click', 'a#menu-toggle', function(){
            
            if ( $(this).hasClass('clicked') ) {
                $(this).removeClass('clicked');
                $('#off-canvas').fadeOut(200);
            
            } else {
            
                $(this).addClass('clicked');
                $('#off-canvas').fadeIn(200);
            
            }
            
        });
    }
    
    _app.roster_sliders = function() {
        let rosterSliders = document.querySelectorAll('.swiper.roster-slider');
        if(  rosterSliders.length < 1 ) return;     
        
        document.body.classList.add('roster-swiper-init');  
        
        let rosterSliderWrapper = document.querySelectorAll('.roster-modal'); 
        
        let swiperInstances = new Map();
        let pendingSlideIndex = new Map(); // store index to slide to when modal opens
        
        // Bind nav link clicks on load
        document.querySelectorAll('nav[data-nav]').forEach(nav => {
            const modalId = nav.getAttribute('data-nav');
            const modal = document.getElementById(modalId);
        
            nav.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();
                    const index = parseInt(link.getAttribute('data-slide-index'), 10);
                    pendingSlideIndex.set(modalId, index); // store target index
                    // new Foundation.Reveal($(modal)).open();   // open modal via JS API
                });
            });
        });
        
        // When modal opens, init Swiper (or re-init) and go to stored index
        $(document).on('open.zf.reveal', '.roster-modal', function () {
            const wrapper = this;
            const modalId = wrapper.id;
            const targetIndex = pendingSlideIndex.get(modalId) ?? 0;
        
            const rosterSlider = wrapper.querySelector('.swiper.roster-slider');
            const nextBtn = wrapper.querySelector('.swiper-button-next');
            const prevBtn = wrapper.querySelector('.swiper-button-prev');
        
            // Destroy old instance if needed
            if (swiperInstances.has(modalId)) {
                swiperInstances.get(modalId).destroy(true, true);
            }
        
            // Use requestAnimationFrame to ensure layout is visible
            requestAnimationFrame(() => {
                const swiper = new Swiper(rosterSlider, {
                    loop: true,
                    slidesPerView: 1,
                    spaceBetween: 30,
                    keyboard: {
                        enabled: true,
                    },
                    navigation: {
                        nextEl: nextBtn,
                        prevEl: prevBtn,
                    },
                });
        
                swiperInstances.set(modalId, swiper);
        
                // Slide to index, using slideToLoop for correct loop behavior
                swiper.slideToLoop(targetIndex);
            });
        });

    }
    
    _app.scrollTo = function() {
        window.trailhead_scroll_to = function (target, options, onCompleteEvent) {
            if (target === undefined) {
                return;
            }
        
            if (options === undefined) {
                options = {
                    animationDuration: 500,
                    animationEasing: 'swing', // Can be `'swing'` or `'linear'`
                    threshold: 50,
                    offset: 150
                };
            }
        
            // threshold is required for some reason
            if (!options.hasOwnProperty('threshold')) {
                options.threshold = 50;
            }
        
        
            Foundation.SmoothScroll.scrollToLoc(target, options);
        }
        
        // scroll to hash on page load
        if (window.location.hash) {
            setTimeout(function () {
                trailhead_scroll_to($(window.location.hash));
            }, 400);
        }
    }
            
    _app.init = function() {
        
        // Standard Functions
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.fixed_nav_hack();
        _app.display_on_load();
        
        // Custom Functions
        //_app.mobile_takover_nav();
        _app.roster_sliders();
        _app.scrollTo();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);