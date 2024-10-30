(function ($) { 

    "use strict";

    var image_comparison_js_two = function($scope, $) {
   
            //design one and two js
            
            if ($(".classyea-before-after-twentytwenty").not('initialized').length) {

                $(".classyea-before-after-twentytwenty").not('initialized').each(function () {  
                    var variable =  $(this);
                    var verticalhorizontal = $(this).data('verticalhorizontal');
                    
                    $(variable).twentytwenty({
                        orientation: verticalhorizontal.orientation,
                        before_label:           verticalhorizontal.before_label,
                        after_label:            verticalhorizontal.after_label,
                        default_offset_pct:     verticalhorizontal.visible_ratio,
                        move_slider_on_hover:   verticalhorizontal.slider_on_hover,
                        move_with_handle_only:  verticalhorizontal.slider_with_handle,
                        click_to_move:          verticalhorizontal.slider_with_click,
                        no_overlay:             verticalhorizontal.no_overlay
                    });

                    // hack for bs tab 
                    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
                        var paneTarget = $(e.target).attr('data-target');
                        var $thePane = $('.tab-pane' + paneTarget);
                        var twentyTwentyContainer = '.' + objName;
                        var twentyTwentyHeight = $thePane.find(twentyTwentyContainer).height();
                        if (0 === twentyTwentyHeight) {
                            $thePane.find(twentyTwentyContainer).trigger('resize');
                        }
                    });
                });
            }; 
        }

        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea-widget-image-comparison.default', image_comparison_js_two);
            
        });

}(jQuery));