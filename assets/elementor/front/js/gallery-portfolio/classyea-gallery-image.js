(function ($) { 

    "use strict";

    var gallery_js = function($scope, $) {

        let sortBtn = $('.classyea-portfolio-filter-menu li');

        $(sortBtn).on("click", function(){ 

            $(sortBtn).removeClass('current');
            $(this).addClass('current').siblings().removeClass('current');
        });

        $(sortBtn).on("click", function(event){
            event.stopImmediatePropagation();
           let targatedItem = $(this).attr('data-target');
            
           let parentdata = $(this).parent().siblings().children("[data-item='" + targatedItem + "']");
           let otherdata = $(this).parent().siblings().children().not("[data-item='" + targatedItem + "']");
           let allitem = $(this).parent().siblings().children();

            if (targatedItem == "all") {
                allitem.removeClass('delete');
                allitem.removeClass('active');
                allitem.addClass('active');
            } else {
                parentdata.removeClass('delete');
                parentdata.addClass('active');
                otherdata.removeClass('active');
                otherdata.addClass('delete');
            } 
    
        });


        /* **************** Start Portfolio One Script*************** */
        let portfolioBtn353 = $('.classyea-portfolio-btn-353 li');

        $(portfolioBtn353).on("click", function(event){ 
            event.stopImmediatePropagation();
            $(portfolioBtn353).removeClass('current');
            $(this).addClass('current').siblings().removeClass('current');

            let targatedItem = $(this).attr('data-filter');

            let parentdata = $(this).parent().siblings().children("[data-item='" + targatedItem + "']");
            let otherdata = $(this).parent().siblings().children().not("[data-item='" + targatedItem + "']");
            let allitem = $(this).parent().siblings().children();
            
            if (targatedItem == "all") {
                allitem.removeClass('delete');
                allitem.removeClass('active');
                allitem.addClass('active');
            } else {
                parentdata.removeClass('delete');
                parentdata.addClass('active');
                otherdata.removeClass('active');
                otherdata.addClass('delete');
            } 


        });


        /* **************** Start Portfolio One Script*************** */
        let portfolioBtn354 = $('.classyea-portfolio-btn-354 li');

        $(portfolioBtn354).on("click", function(event){ 
            event.stopImmediatePropagation();
            $(portfolioBtn354).removeClass('current');
            $(this).addClass('current').siblings().removeClass('current');

            let targatedItem = $(this).attr('data-filter');
            
           let parentdata = $(this).parent().siblings().children("[data-item='" + targatedItem + "']");
           let otherdata = $(this).parent().siblings().children().not("[data-item='" + targatedItem + "']");
           let allitem = $(this).parent().siblings().children();

            
            if (targatedItem == "all") {
                allitem.removeClass('delete');
                allitem.removeClass('active');
                allitem.addClass('active');
            } else {
                parentdata.removeClass('delete');
                parentdata.addClass('active');
                otherdata.removeClass('active');
                otherdata.addClass('delete');
            } 

        });

        let sortBtnsix = $('.classyea-portfolio-menu li');

        $(sortBtnsix).on("click", function(event){ 
            event.stopImmediatePropagation();
            $(sortBtnsix).removeClass('current');
            $(this).addClass('current').siblings().removeClass('current');

            let targatedItemsix = $(this).attr('data-target');
            let parentdata = $(this).parent().siblings().children("[data-item='" + targatedItemsix + "']");
            let otherdata = $(this).parent().siblings().children().not("[data-item='" + targatedItemsix + "']");
            let allitem = $(this).parent().siblings().children();
            
            if (targatedItemsix == "all") {
                allitem.removeClass('delete');
                allitem.removeClass('active');
                allitem.addClass('active');
            } else {
                parentdata.removeClass('delete');
                parentdata.addClass('active');
                otherdata.removeClass('active');
                otherdata.addClass('delete');
            } 

        });
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-gallery-widget.default', gallery_js);
    });


})(window.jQuery);