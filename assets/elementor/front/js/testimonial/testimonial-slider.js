(function ($) { 

    "use strict";
       
        var testimonial_js = function() {
            $(document).ready(function(){
            //Clients Testimonial Slider
            // design one
            var design_1 = $('.classyea-client-testimonials .client-item');
                if(design_1.length){
                    var carousel_one = $('#testimonial_client').data('testimonial');
                    $(design_1).not('.initialized').each(function () {
                        var client_item = $(this);
                        $(client_item).bxSlider({
                            infiniteLoop: carousel_one['infinite'],
                            adaptiveHeight: false,
                            auto:carousel_one['autoplay'],
                            mode:'fade',
                            controls: false,
                            pause: 5000,
                            speed: carousel_one['autoplaySpeed'],
                            pager:carousel_one['dots'],
                        });
                    });
                }
                // design two
                // Two Item Carousel 
                if ($('.classyea-two-item-carousel').length) {
                    var testimonial_two = $('#testimonial_two').data('testimonial');
                    $('.classyea-two-item-carousel').owlCarousel({
                        autoplay: testimonial_two['autoplay'],
                        loop:testimonial_two['infinite'],
                        margin:testimonial_two['image_item_gap'],
                        nav: testimonial_two['arrows'],
                        smartSpeed: 700,
                        autoplaySpeed: testimonial_two['autoplaySpeed'],
                        autoHeight: true,
                        navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:1
                            },
                            800:{
                                items:1
                            },
                            1024:{
                                items:1
                            },
                            1200:{
                                items:1
                            },
                            1650:{
                                items:1
                            },
                            1700:{
                                items:2
                            }
                        }
                    });    		
                }

                // design four
                //three-item-carousel
                if ($('.classyea-three-item-carousel').length) {
                    var testimonial_three = $('#classyea-testimonial-box-main-302').data('testimonial');

                    $('.classyea-three-item-carousel').owlCarousel({
                        loop:testimonial_three['infinite'],
                        margin:30,
                        nav: testimonial_three['arrows'],
                        smartSpeed: 1000,
                        autoplaySpeed: testimonial_three['autoplaySpeed'],
                        autoplay: testimonial_three['autoplay'],
                        autoHeight: true,
                        dots:testimonial_three['dots'],
                        responsive: {
                            0: {
                                items: 1
                            },
                            480: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            800: {
                                items: 2
                            },
                            1024: {
                                items: 3
                            }
                        }
                    });
                }

                // design three
                //two-item-carousel
                if ($('.classyea-two-item-owlcarousel').length) {
                    var testimonial_four = $('.classyea-two-item-owlcarousel').data('testimonial');
                    $('.classyea-two-item-owlcarousel').owlCarousel({
                        loop:testimonial_four['infinite'],
                        margin:testimonial_four['image_item_gap'],
                        nav: testimonial_four['arrows'],
                        smartSpeed: 1000,
                        autoplay: testimonial_four['autoplay'],
                        autoHeight: true,
                        autoplaySpeed: testimonial_four['autoplaySpeed'],
                        dots:testimonial_four['dots'],
                        responsive: {
                            0: {
                                items: 1
                            },
                            480: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            800: {
                                items: 2
                            },
                            1024: {
                                items: 3
                            }
                        }
                    });
                }

                //design five carousel
                if ($('.classyea-design-five').length) {
                    var testimonial_five = $('#testimonial_five').data('testimonial');
                    $('.classyea-design-five').owlCarousel({
                        loop:testimonial_five['infinite'],
                        margin:testimonial_five['image_item_gap'],
                        nav: false,
                        smartSpeed: 1000,
                        autoplay: testimonial_five['autoplay'],
                        autoHeight: true,
                        autoplaySpeed: testimonial_five['autoplaySpeed'],
                        dots:testimonial_five['dots'],
                        responsive: {
                            0: {
                                items: 1
                            },
                            480: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            800: {
                                items: 2
                            },
                            1024: {
                                items: 3
                            }
                        }
                    });
                }

            });
  
        }

        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea-testimonial-widget.default', testimonial_js);
        });   

})(window.jQuery);