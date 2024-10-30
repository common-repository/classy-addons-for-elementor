(function ($) { 

    "use strict";

    var tab_js = function($scope, $) {
        //Tabs Box
        if($('.classyea-mouseenter').length){ 
         
            var toggle_mouseenter = $('.classyea-mouseenter').data('toggletype');
          
            $('.classyea-mouseenter .tab-buttons .tab-btn').on(toggle_mouseenter, function(e) {
                e.preventDefault();
                var target = $($(this).attr('data-tab'));
                
                if ($(target).is(':visible')){
                    return false;
                }else{
                    target.parents('.classyea-tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
                    $(this).addClass('active-btn');
                    target.parents('.classyea-tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
                    target.parents('.classyea-tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
                    $(target).fadeIn(300);
                    $(target).addClass('active-tab');
                }
            });

        }

        if($('.classyea-click').length){ 
            //  var toggle_type = []
              var toggle_type = $('.classyea-click').data('toggletype');
            
              $('.classyea-tabs-box .tab-buttons .tab-btn').on(toggle_type, function(e) {
                  e.preventDefault();
                  var target = $($(this).attr('data-tab'));
                  
                  if ($(target).is(':visible')){
                      return false;
                  }else{
                      target.parents('.classyea-tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
                      $(this).addClass('active-btn');
                      target.parents('.classyea-tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
                      target.parents('.classyea-tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
                      $(target).fadeIn(300);
                      $(target).addClass('active-tab');
                  }
              });
          }
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-tab-widget.default', tab_js);
    });
})(window.jQuery);