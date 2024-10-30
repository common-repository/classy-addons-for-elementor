(function ($) { 

    "use strict";

    var countdown_js = function() {

      $('.classyea-countdown').each(function() {

        var date = $(this).data('date');
        var activeId = $(this).data('id');

        if($(this).length){

            var countDownDate = new Date(date).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {
            
              // Get today's date and time
              var now = new Date().getTime();
                
              // Find the distance between now and the count down date
              var distance = countDownDate - now;
                
              // Time calculations for days, hours, minutes and seconds
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
              // Output the result in an element with id="demo"
              document.getElementById(activeId).innerHTML = "<div class='countitem'><span class='countitem-number'>"+days + "</span><span class='countitem-title'>days</span></div><div class='countitem'><span class='countitem-number'>" + hours + "</span><span class='countitem-title'>hours </span></div><div class='countitem'><span class='countitem-number'>"
              + minutes + "</span><span class='countitem-title'>minutes</span></div><div class='countitem'><span class='countitem-number'>" + seconds + "</span><span class='countitem-title'>seconds</span></div>";
                
              // If the count down is over, write some text 
              if (distance < 0) {
                clearInterval(x);
                document.getElementById(activeId).innerHTML = "EXPIRED";
              }
            }, 1000);
        }

      });

    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-widget-countdown.default', countdown_js);
    });
})(window.jQuery);