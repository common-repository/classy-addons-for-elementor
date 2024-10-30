(function( $) {
	
    "use strict";
        if($('.wow').length){
            
            $('.wow').appear(function(){
                $(".classyea-progress-bar-fill").each(function() {
                    var progressWidth = $(this).attr('data-percent');
                    $(this).css('width', progressWidth + '%');
                    $(this).parent().parent().siblings('.classyea-progress-bar-border').css('width', progressWidth + '%');
                });
            },{accY: 0});
        }

        if($('.classyea-progress-bar-percent').length){
            $('.classyea-progress-bar-percent').appear(function(){
                //Progress Bar / Levels
                $(".classyea-progress-bar-fill-two").each(function() {
                    var progressHeight = $(this).attr('data-percent');
                    $(this).css('height', progressHeight + '%');
                });
            },{accY: 0});
        }


        if($('.classyea-progress-bar-percent').length){
            $('.classyea-progress-bar-percent').appear(function(){
        
                var $t = $(this),
                    n = $t.find(".classyea-progress-bar-percent-number").attr("data-stop"),
                    r = parseInt($t.find(".classyea-progress-bar-percent-number").attr("data-speed"), 10);
                    
                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".classyea-progress-bar-percent-number").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".classyea-progress-bar-percent-number").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".classyea-progress-bar-percent-number").text(this.countNum);
                        }
                    });
                }
                
            },{accY: 0});
        }

        if($('.classyea-funfacts-number').length){
            $('.classyea-funfacts-number').appear(function(){
        
                var $t = $(this),
                    n = $t.find(".classyea-funfacts-count-text").attr("data-stop"),
                    r = parseInt($t.find(".classyea-funfacts-count-text").attr("data-speed"), 10);
                    
                if (!$t.hasClass("counted")) {
                    $t.addClass("counted");
                    $({
                        countNum: $t.find(".classyea-funfacts-count-text").text()
                    }).animate({
                        countNum: n
                    }, {
                        duration: r,
                        easing: "linear",
                        step: function() {
                            $t.find(".classyea-funfacts-count-text").text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $t.find(".classyea-funfacts-count-text").text(this.countNum);
                        }
                    });
                }
                
            },{accY: 0});
        }


        $(".classyea-progress-bar-two-box").each(function(){

            var $bar = $(this).find(".classyea-progress-bar-two-bar");
            var $val = $(this).find("span.data-parcent");
            var perc = parseInt( $val.text(), 10);
            
            $({p:0}).animate({p:perc}, {
                duration: 3000,
                easing: "swing",
                step: function(p) {
                $bar.css({
                    transform: "rotate("+ (45+(p*1.8)) +"deg)", // 100%=180° so: ° = % * 1.8
                    // 45 is to add the needed rotation to have the green borders at the bottom
                });
                $val.text(p|0);
                }
            });
        });

        // Elements Animation

        var newstricker_elem = $('.wow');
        if ( newstricker_elem.length > 0 ) {

            newstricker_elem.each(function () {
                let iDName = $( this ).attr('class').split(" ")[0];
                
                if($(newstricker_elem.length)){ 
                    var wow = new WOW(
                        {
                            boxClass:     iDName,      // animated element css class (default is wow)
                            animateClass: 'animated', // animation css class (default is animated)
                            offset:       0,          // distance to the element when triggering the animation (default is 0)
                            mobile:       true,       // trigger animations on mobile devices (default is true)
                            live:         true       // act on asynchronously loaded content (default is true)
                        }
                    );
                    wow.init();
                }
            });
        }
        

})(jQuery);