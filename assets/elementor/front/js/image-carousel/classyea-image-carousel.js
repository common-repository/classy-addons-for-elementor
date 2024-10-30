(function ($) { 

    "use strict";
    
    var image_carousel = function($scope, $) {

        var design_one = $('.classyea-carousel-wrapper-801'); 
        if(design_one.length){
            var slider_attr = $('#slider-one').data('slider');
            $('.classyea-carousel-wrapper-801 .owl-carousel').owlCarousel({
                autoplay:slider_attr['autoplay'],
                loop:slider_attr['infinite'],
                margin:slider_attr['item_gap'],
                nav: slider_attr['arrows'],
                dots: slider_attr['dots'],
                dotsEach: true,
                autoplaySpeed: slider_attr['autoplaySpeed'],
                infinite: slider_attr['infinite'],
                responsive:{
                    0: {
                        items: 1
                    }
                }
            })
        }
       
       
        /*****  Design Two *****/

        if ($(".sliders-carousel").length) {
            $(".sliders-carousel").not('.initialized').each(function () {
                var slider_nav = $('#sliders').data('nav');
                $(this).simpleSlider({
                    direction: "up",
                    navigation: slider_nav['navigation'],
                });

            });
        }

        $(document).ready(function() {
            var design_three = $('.classyea-imageCarousel-bottom-803');
            if(design_three.length){
                var slider_three = $('#slider-three').data('sliderthree');
                /*****  Design Three*****/
                $('.classyea-imageCarousel-bottom-803 .owl-carousel').owlCarousel({
                    autoplay:slider_three['autoplay'],
                    loop:slider_three['infinite'],
                    margin:slider_three['item_gap'],
                    nav: slider_three['arrows'],
                    dots: slider_three['dots'],
                    dotsEach: true,
                    autoplaySpeed: slider_three['autoplaySpeed'],
                    infinite: slider_three['infinite'],
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        900:{
                            items:3
                        }
                    }
                })
            }
        });
        
        var design_four = $('.classyea-imageCarousel-bottom-804');
        if( design_four.length ){
            var slider_four = $('#slider-four').data('sliderfour');
            /*****  Design Four *****/
            $('.classyea-imageCarousel-bottom-804 .owl-carousel').owlCarousel({
                center: slider_four['image_center'],
                dotsEach: false,
                autoplay:slider_four['autoplay'],
                loop:slider_four['infinite'],
                margin:slider_four['item_gap'],
                nav: slider_four['arrows'],
                dots: slider_four['dots'],
                autoplaySpeed: slider_four['autoplaySpeed'],
                infinite: slider_four['infinite'],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    900:{
                        items:3
                    },
                    1200:{
                        items:4
                    }
                }
            })
        }
        
        var design_five = $('.classyea-imageCarousel-right-807');
        if( design_five.length ){
            var slider_five = $('#slider-five').data('sliderfive');

            /*****  Design Five *****/
            $('.classyea-imageCarousel-right-807 .owl-carousel').owlCarousel({
                autoplay:slider_five['autoplay'],
                loop:slider_five['infinite'],
                margin:slider_five['item_gap'],
                nav: slider_five['arrows'],
                dots: slider_five['dots'],
                autoplaySpeed: slider_five['autoplaySpeed'],
                infinite: slider_five['infinite'],
                dotsEach:false,
                center: slider_five['image_center'],
                responsive:{
                    0:{
                        items:1
                    },
                    900:{
                        items:2
                    }
                }
            })
        }

        var design_six = $('.classyea-imageCarousel-805');
        if( design_six.length ) {
        
            var slider_six = $('#slider-six').data('slidersix');

            /*****  Design Six *****/
            $('.classyea-imageCarousel-805 .owl-carousel').owlCarousel({
                autoplay:slider_six['autoplay'],
                loop:slider_six['infinite'],
                margin:slider_six['item_gap'],
                nav: slider_six['arrows'],
                dots: slider_six['dots'],
                autoplaySpeed: slider_six['autoplaySpeed'],
                infinite: slider_six['infinite'],
                dotsEach: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    900:{
                        items:3
                    }
                }
            })
        }

    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-image-carousel.default', image_carousel);
    });

})(window.jQuery);