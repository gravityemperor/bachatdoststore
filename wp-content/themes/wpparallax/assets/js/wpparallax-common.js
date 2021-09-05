jQuery(document).ready(function($) {
    
    var win = $(window);
    /**
     * Back to top button
     **/
    win.scroll(function() {
        if ($(this).scrollTop() > 1000) {
            $('#wpop-top').fadeIn();
        } else {
            $('#wpop-top').fadeOut();
        }
    });

    $('#wpop-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    });

    /**
     * Sticky menu
     */
    var IsSticky = wpparallax_option.is_sticky;
    if (IsSticky == 'show') {
        $(".header-wrap").sticky({
            topSpacing: 0
        });
    }

    $('body').on('click', '.plx-nav li', function() {
        $('.main-navigation').removeClass('toggled');
    });

    /**
     * Wow Animation
     */
    var WowOptionVal = wpparallax_option.mode;
    if (WowOptionVal == 'show' && $('body').hasClass('home')) {
        new WOW().init();
    }

    /**
     * For Parallax Menu
     **/
    var headerHeight = $('#masthead').outerHeight();
    var plxNav = $('.home .plx-nav.nav');
    if(plxNav.length){
        plxNav.onePageNav({
            currentClass: 'current',
            changeHash: false,
            scrollSpeed: 1500,
            scrollOffset: headerHeight,
            scrollThreshold: 0.5,
        });

        plxNav.on('click','li',function(){
            $('body').removeClass('toggled-modal');
            $('.site-header').removeClass('toggled-on');
        });
    }

    /**
     * Search Option
     **/

    $('.search-icon').on('click keypress', function() {
        $('.full-search-container').addClass('search_on');
    });
    $('.closebtn').on('click keypress', function() {
        $('.full-search-container').removeClass('search_on');
    });



    /*For main Slider */
    var wpopSlider = $('.wpop-slider');
    if(wpopSlider.length){
        wpopSlider.lightSlider({
            adaptiveHeight: false,
            item: 1,
            slideMargin: 0,
            loop: true,
            pager: false,
            auto: true,
            speed: 1500,
            pause: 4200,
            enableDrag: true,
            onSliderLoad: function() {
                $('.wpop-slider').removeClass('cS-hidden');
            }
        });
    }

    /* Portfolio */
    var portf = $('.portfolio-postse');
    if(portf.length){
        var $grid = $('.portfolio-postse').imagesLoaded(function() {
            // init Isotope after all images have loaded
            $grid.isotope({
                itemSelector: '.portfolio-post-wrape',
                layoutMode: 'packery'
            });
        });

        $('.portfolio-post-filter').on('click', '.filter', function() {
            $('.portfolio-post-filter .filter').removeClass('active');
            $(this).addClass('active');
            var filterValue = $(this).attr('data-filter');
            $('.portfolio-postse').isotope({
                filter: filterValue
            });
        });
    }

    /* Team section */
    $('.team-content:first').show();
    $('.team-thumb:first').addClass('active');
    $('.team-thumb').click(function() {
        $('.team-thumb').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('id');
        $('.team-content').hide();
        $('.' + id).fadeIn();
        return false;
    });

    /**
     * Testimonial Section
     */
    var testi = $(".testimonialwrap");
    if(testi.length){
        $(".testimonialwrap").lightSlider({
            item: 1,
            pager: true,
            loop: true,
            controls: false,
        });
    }

    /**
     * Google map Toggle
     */
    win.bind('load', function() {
        $('.googlemap-content').hide();
    });

    var open = false;
    $('.googlemap-toggle').on('click', function() {
        if (!open) {
            open = true;
        }
        $('.googlemap-content').slideToggle();
        $(this).toggleClass('active');
    });

    /*if (win.width() < 766) {

        $('<div class="wplx-sub-toggle"></div>').insertBefore('li.menu-item-has-children ul');
        $('<div class="wplx-sub-toggle-children"></div>').insertBefore('li.page_item_has_children ul');

        $('body').on('vclick touchstart','.wplx-sub-toggle', function()  {
          $(this).next('ul.sub-menu').slideToggle();
          $(this).parent('li').toggleClass('wplx-mob-menu-toggle');
        });

        $('body').on('vclick touchstart','.wplx-sub-toggle-children',function() {
            $(this).next('ul').slideToggle();
        });

    }else{
        $('.wplx-sub-toggle,.wplx-sub-toggle-children').remove();
    }*/

    /* Post Formats */
    var gal_items = $('.wpparallax-gallery-items');
    if(gal_items.length > 0){
        gal_items.lightSlider({
            item: 1,
            pager: false,
            loop: true,
            controls: true,
        });
    }

    //Fix audio and video size
    if($('.wpparallax_video_wrap').length){
        $(".main-blog-left").fitVids();
    }
    if($('.wpparallax_audio_wrap').length){
        $(".main-blog-left").fitVids({
            customSelector: "iframe[src^='https://w.soundcloud.com']"
        });
    }

    /* Sticky Sidebar */
    if (wpparallax_option.sidebar_sticky == 'show' && $('.widget-area').length) {
        $('.content-area, .widget-area').theiaStickySidebar();
    }

    //Smooth scroll
    if(wpparallax_option.smooth_scroll == 'show'){
        SmoothScroll({
            animationTime    : 2000, // [ms]
            stepSize         : 100, // [px]
        });
    }

});

//Preloader section
jQuery(window).load(function() {
    jQuery('.opstore-loader').fadeOut('slow');
});