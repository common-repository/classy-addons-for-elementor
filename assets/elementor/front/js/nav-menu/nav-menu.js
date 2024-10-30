(function($) {
	"use strict";

    //Submenu Dropdown Toggle
    if ($('.classyea-main-header li.menu-item-has-children ul').length) {
        $('.classyea-main-header .classyea-navigation li.menu-item-has-children').append('<div class="dropdown-btn"><span class="fa fa-angle-right"></span></div>');
    }



    //Mobile Nav Hide Show
    if ($('.classyea-mobile-menu').length) {

        $('.classyea-mobile-menu .classyea-menu-box').mCustomScrollbar();

        var mobileMenuContent = $('.classyea-main-header .classyea-nav-outer .classyea-main-menu').html();
        $('.classyea-mobile-menu .classyea-menu-box .menu-outer').append(mobileMenuContent);

        //Dropdown Button
        $('.classyea-mobile-menu li.menu-item-has-children .dropdown-btn').on('click', function () {
            $(this).toggleClass('open');
            $(this).prev('ul').slideToggle(500);
        });

        //Dropdown Button
        $('.classyea-mobile-menu li.menu-item-has-children .dropdown-btn').on('click', function () {
            $(this).prev('.megamenu').slideToggle(900);
        });

        //Menu Toggle Btn
        $('.classyea-mobile-nav-toggler').on('click', function () {
            $('body').addClass('classyea-mobile-menu-visible');
        });

        //Menu Toggle Btn
        $('.classyea-mobile-menu .menu-backdrop,.classyea-mobile-menu .close-btn').on('click', function () {
            $('body').removeClass('classyea-mobile-menu-visible');
        });

    }



})(jQuery);