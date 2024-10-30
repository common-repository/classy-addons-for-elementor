(function ($) { 

    "use strict";
       
        var accordion_jstwo = function() {
            // // design five
            if($('.classyea_accordion')){
                $('.classyea_accordion').on("click", function(event){
                    event.stopImmediatePropagation();
                    if($(this).hasClass('current')){
                        $(this).removeClass('current');
                        let elHeight = $(this)[0].nextElementSibling.scrollHeight
                        $(this).next().css("maxHeight", `${0}px`);
                        $(this).next().css("height", `${0}px`);
                    }else{
                        $(this).addClass('current');
                        let elHeight = $(this)[0].nextElementSibling.scrollHeight
                        $(this).next().css("maxHeight", `${elHeight}px`);
                        $(this).next().css("height", `${elHeight}px`);
                    }
                });
            }

            // // design one
            
            $(".classyea-accordion-title").on("click", function(event){
                    
                event.stopImmediatePropagation();
                var parentdata = $(this).parent('.classyea-accordion-item');
            
                if (parentdata.hasClass("active")) {
                    parentdata.toggleClass("active");
        
                } else {
                    var sibling = parentdata.siblings();
                    parentdata.siblings().removeClass('active');
                    parentdata.addClass("active"); 
                    
                }
            });

            // // Accordion three
            var accordion__head__1000 = $('.classyea-accordion__head-item-1000');

            accordion__head__1000.on("click", function(event){
                event.stopImmediatePropagation();
                var parentdata = $(this).parent();

                if (parentdata.hasClass("classyea-accordion__item-1000--active")) {
                    parentdata.removeClass("classyea-accordion__item-1000--active");
        
                } else {
                    parentdata.siblings().removeClass('classyea-accordion__item-1000--active');
                    parentdata.addClass("classyea-accordion__item-1000--active");  
                    
                }

            });

            // // accordion item four

            // // Accordion two
            var accordion__head__1001 = $('.classyea-accordion__head-item-1001');

            if(accordion__head__1001){

                accordion__head__1001.on("click", function(event){
                    event.stopImmediatePropagation();
                    var parentdata = $(this).parent();

                    if (parentdata.hasClass("classyea-accordion__item-1001--active")) {
                    parentdata.toggleClass("classyea-accordion__item-1001--active");
            
                    } else {
                        parentdata.siblings().removeClass('classyea-accordion__item-1001--active');
                        parentdata.addClass("classyea-accordion__item-1001--active");  
                        
                    }

                });
            }   
            
        }

        $(window).on('elementor/frontend/init', function () {
           
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea_widget_accordion.default', accordion_jstwo);
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea_widget_accordion.classyea-accordion-layout-three', accordion_jstwo);
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea_widget_accordion.classyea-accordion-layout-seven', accordion_jstwo);
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea_widget_accordion.classyea-image-accordion-layout-two', accordion_jstwo);
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea_widget_accordion.classyea-layout-four-accordion', accordion_jstwo);
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea_widget_accordion.classyea-layout-five-accordion', accordion_jstwo);
            
        });    
})(window.jQuery);