(function ($) { 

    "use strict";


    //Fact Counter + Text Count

    var countjs = function($scope, $) {

        if($('.classyea-counterUp__box-item-101').length){
            $('.classyea-counterUp__box-item-101').appear(function(){
                var $t = $(this),
                    n = $t.find(".number").attr("data-target"),
                    s = $t.find(".number").attr("data-start"),
                    r = parseInt($t.find(".number").attr("data-speed"), 10);

                    

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: s 

                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".number").text(Math.floor(this.countNum));
                        
                        },
                        complete: function() {
                            $t.find(".number").text(this.countNum);
                           
                        }
                    });
                }

            },{accY: 0});
        }

        if($('.classyea-counterUp__box-item-106').length){
            $('.classyea-counterUp__box-item-106').appear(function(){


                var $t = $(this),
                    n = $t.find(".number").attr("data-target"),
                    s = $t.find(".number").attr("data-start"),
                    r = parseInt($t.find(".number").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: s
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".number").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".number").text(this.countNum);
                        }
                    });
                }

            },{accY: 0});
        }

        if($('.classyea-counterUp__box-item-100').length){
            $('.classyea-counterUp__box-item-100').appear(function(){


                var $t = $(this),
                    n = $t.find(".number").attr("data-target"),
                    s = $t.find(".number").attr("data-start"),
                    r = parseInt($t.find(".number").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: s
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".number").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".number").text(this.countNum);
                        }
                    });
                }

            },{accY: 0});
        }

        if($('.classyea-counterUp-item-102').length){
            $('.classyea-counterUp-item-102').appear(function(){

                var $t = $(this),
                    n = $t.find("#number102").attr("data-target"),
                    s = $t.find("#number102").attr("data-start"),
                    r = parseInt($t.find("#number102").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: s
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find("#number102").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find("#number102").text(this.countNum);
                        }
                    });
                }

            },{accY: 0});
        }

        if($('.classyea-counterUp-text').length){
            $('.classyea-counterUp-text').appear(function(){


                var $t = $(this),
                    n = $t.find("#number103").attr("data-target"),
                    s = $t.find("#number103").attr("data-start"),
                    r = parseInt($t.find("#number103").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: s
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find("#number103").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find("#number103").text(this.countNum);
                        }
                    });
                }

            },{accY: 0});
        }

        if($('.classyea-counter-item').length){
            $('.classyea-counter-item').appear(function(){

                var $t = $(this),
                    n = $t.find(".number").attr("data-target"),
                    s = $t.find(".number").attr("data-start"),
                    r = parseInt($t.find(".number").attr("data-speed"), 10);

                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: s
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".number").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".number").text(this.countNum);
                        }
                    });
                }

            },{accY: 0});
        }


    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-widget-counterup.default', countjs);
    });


})(window.jQuery);