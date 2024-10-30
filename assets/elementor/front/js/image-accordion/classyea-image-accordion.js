(function ($) { 

    "use strict";

        /***** Design One *****/ 

       var image_accordion_js = function($scope, $) {
            let classyea_imageAccordion_2000 = $('.classyea-imageAccordion__item-2000');

            $(classyea_imageAccordion_2000).on("click", function(event){
                event.stopImmediatePropagation();
                var parentdata = $(this).parent();
                
                if (parentdata.hasClass("classyea-imageAccordion__item-2000--active")) {
                    parentdata.toggleClass("classyea-imageAccordion__item-2000--active");
        
                } else {
                    parentdata.siblings().removeClass('classyea-imageAccordion__item-2000--active');
                    parentdata.addClass("classyea-imageAccordion__item-2000--active");  
                    
                }

            });

            let classyea_imageAccordion_2001 = $('.classyea-imageAccordion__item-2001');

            $(classyea_imageAccordion_2001).on("click", function(event){
                event.stopImmediatePropagation();
                var parentdata = $(this).parent();
                
                if (parentdata.hasClass("classyea-imageAccordion__item-2001--active")) {
                    parentdata.toggleClass("classyea-imageAccordion__item-2001--active");
        
                } else {
                    parentdata.siblings().removeClass('classyea-imageAccordion__item-2001--active');
                    parentdata.addClass("classyea-imageAccordion__item-2001--active");  
                    
                }

            });

            /***** Design Three *****/
            let imageAccordionItemOne = $(".classyea-imageAccordion-image");

            $(imageAccordionItemOne).on("click", function(event){
                event.stopImmediatePropagation();
                var parentdata = $(this).parent();
                
                if (parentdata.hasClass("active")) {
                    parentdata.toggleClass("active");
        
                } else {
                    parentdata.siblings().removeClass('active');
                    parentdata.addClass("active");  
                    
                }

            });

            let imageAccordionItemTwo = $(".classyea-imageAccordion-item-2003");

            $(imageAccordionItemTwo).on("click", function(event){
                event.stopImmediatePropagation();
                var parentdata = $(this).parent();
                
                if (parentdata.hasClass("active")) {
                    parentdata.toggleClass("active");
        
                } else {
                    parentdata.siblings().removeClass('active');
                    parentdata.addClass("active");  
                    
                }

            });
        }

        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea-widget-image-accordion.default', image_accordion_js);
        });

})(window.jQuery);