(function ($) { 

    "use strict";

    var logo_carousel_js = function($scope, $) {

        /*****  Design One *****/
        var design_one = $('.classyea-logoCarousel-wrapper-871'); 
        if(design_one.length){
            var carousel_one = $('#logo-sliderone').data('logoone');
            $('.classyea-logoCarousel-wrapper-871 .owl-carousel').owlCarousel({
                items:5,
                autoplay:carousel_one['autoplay'],
                loop:carousel_one['infinite'],
                margin:carousel_one['item_gap'],
                nav: carousel_one['arrows'],
                dots:carousel_one['dots'],
                autoplaySpeed: carousel_one['autoplaySpeed'],
                responsive:{
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });
        }

        /*****  Design Two *****/
       var design_two = $('.classyea-logoCarousel-wrapper-872');
       if( design_two.length ) {
            var slidertwo = $('#logo-slidertwo').data('logoone');
            $('.classyea-logoCarousel-wrapper-872 .owl-carousel').owlCarousel({
                items:5,
                autoplay:slidertwo['autoplay'],
                loop:slidertwo['infinite'],
                margin:slidertwo['item_gap'],
                nav:slidertwo['arrows'],
                dots:slidertwo['dots'],
                responsive:{
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });
        }
       
        /*****  Design Three *****/
        var design_three = $('.classyea-logoCarousel-wrapper-873');
        if( design_three.length ) {
            var sliderthree = $('#logo-sliderthree').data('logoone');
            $('.classyea-logoCarousel-wrapper-873 .owl-carousel').owlCarousel({
                items:5,
                autoplay:sliderthree['autoplay'],
                loop:sliderthree['infinite'],
                margin:sliderthree['item_gap'],
                nav:sliderthree['arrows'],
                dots:sliderthree['dots'],
                responsive:{
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });
        }

        /*****  Design Four *****/
        var design_four = $('.classyea-logoCarousel-wrapper-874');
        if( design_four.length ) {
            var sliderfour = $('#logo-sliderfour').data('logoone');
            $('.classyea-logoCarousel-wrapper-874 .owl-carousel').owlCarousel({
                items:5,
                autoplay:sliderfour['autoplay'],
                loop:sliderfour['infinite'],
                margin:sliderfour['item_gap'],
                nav:sliderfour['arrows'],
                dots:sliderfour['dots'],
                dotsEach:true,
                responsive:{
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });
        }
       
        var design_five = $('.classyea-logoCarousel-wrapper-875');
        if( design_five.length ) {
            var sliderfive = $('#logo-sliderfive').data('logoone');
            $('.classyea-logoCarousel-wrapper-875 .owl-carousel').owlCarousel({
                items:3,
                autoplay:sliderfive['autoplay'],
                loop:sliderfive['infinite'],
                margin:sliderfive['item_gap'],
                nav:sliderfive['arrows'],
                dots:sliderfive['dots'],
                responsive:{
                    0:{
                        items:1
                    },
                    450:{
                        items:2
                    },
                    650:{
                        items:3
                    }
                }
            });
        }

        var design_six = $('.classyea-logoCarousel-wrapper-880');
        if( design_six.length ) {
            var slidersix = $('#logo-slidersix').data('logoone');
            $('.classyea-logoCarousel-wrapper-880 .owl-carousel').owlCarousel({
                // stagePadding: 50,
                items:5,
                autoplay:slidersix['autoplay'],
                loop:slidersix['infinite'],
                margin:slidersix['item_gap'],
                nav:slidersix['arrows'],
                dots:slidersix['dots'],
                dotsEach:true,
                responsive:{
                    0:{
                        items:1
                    },
                    400:{
                        items:2
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });
        }
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-logo-carousel.default', logo_carousel_js);
    });
})(window.jQuery);