/*
:: Project Name : BiBOG
:: Project URI: https://bion.nhatgroup.com/bibog
:: Description: BiBog - Blog HTML5 Template
:: Project Date: 05-03-2017
:: Version: 1.0
:: Author: BionThemes
:: Author Website : https://bion.nhatgroup.com/
*/
// jQuery Document Ready
(function($) {
    "use strict";
    $(document).ready(function() {
        $(window).on("load", function() {
            $("#loading").fadeOut(500);
        });

        // Mobile Menu Toggle
        var mClose = $(".m-menu .toggle, .m-close"); 
        mClose.on("click", function() {
            $(".m-menu").toggleClass("open");
        });

        // Mobile Search Toggle
        var sClose = $(".m-search .toggle, .s-close")
        sClose.on("click", function() {
            $("#mobile-header").toggleClass("open");
        });

        // Mobile Menu List
        var mNavi = $(".m-navigation ul > li > a");
        mNavi.on("click", function() {
            $(".m-navigation ul ul").slideUp();
            if (!$(this).next().is(":visible")) {
                $(this).next().slideDown();
            }
        })

        var mVaviA = $(".m-navigation ul > li > ul > li > a");
        mVaviA.on("click", function() {
            $(".m-navigation ul ul ul").slideUp();
            if (!$(this).next().is(":visible")) {
                $(this).next().slideDown();
            }
        })

        // Search Toggle
        var searchTgg = $(".search .toggle");
        searchTgg.on("click", function() {
            $(".search").toggleClass("open");
        });

        // Activate tooltip by bootstrap
        $('[data-toggle="tooltip"]').tooltip();

        // Add parent class to navigation parents
        $(".m-navigation ul > li > ul, .m-navigation ul > li > ul ul,.topmenu ul > li > ul").parent().addClass('parent');

        // This is function to activate the Sticky Sidebar Plugin
        jQuery('#sidebar').theiaStickySidebar({
            // Settings
            additionalMarginTop: 80
        });

        // Fitvids Activated
        // Target your .container, .wrapper, .post, etc.
        $("#content").fitVids();

        // Activate Match Height Plugin
        $('.layout-grid').each(function() {
            $(this).children('.post.grid').matchHeight();
        });

        // Scroll To Top
        $(window).on("scroll", function() {
            if ($(this).scrollTop() > 100) {
                $('.totop').fadeIn();
            } else {
                $('.totop').fadeOut();
            }
        });
        $('.totop').on("click", function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });

        // Activate Sticky Header
        $('.topbar').stickMe();


        // Feature Slider
        var swiper = new Swiper('.featured-posts .featured-slider', {
            slidesPerView: 1,
            centeredSlides: false,
            loop: true,
            speed: 500,
            autoplay: false,
            slideActiveClass: 'animated',
            paginationClickable: true,
            spaceBetween: 5,
            effect: 'slide',
            pagination: '.featured-pagination',
            nextButton: '.featured-next',
            prevButton: '.featured-prev'
        });

        // Contact Form
        var submitContact = $('#submit_contact'),
        message = $('#msg');
        submitContact.on('click', function(e) {
            e.preventDefault();

            var $this = $(this);

            $.ajax({
                type: "POST",
                url: 'contact.php',
                dataType: 'json',
                cache: false,
                data: $('#contact-form').serialize(),
                success: function(data) {
                    if (data.info !== 'error') {
                        $this.parents('form').find('input[type=text],textarea,select').filter(':visible').val('');
                        message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
                    } else {
                        message.hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
                    }
                }
            });
        });
    });
})(jQuery);