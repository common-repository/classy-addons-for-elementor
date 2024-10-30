(function ($) { 

    "use strict";

    var hotpots_js = function($scope, $) {

        var $hotspot1291 = $('.classyea-hotSpot-wrapper-1291 .classyea-hotSpot');

        function showHotSpot1291($items) {
            $.each($items, function($index, $item){
                var hotspot_icon = $(this).data('icon');
                var icon = hotspot_icon['hotspot_icon'];
                var classyea_tooltip = hotspot_icon['classyea_tooltip'];
                $($item).css('top', $($item).data().positiony + '%')
                $($item).css('left', $($item).data().positionx + '%')
                $($item).css('borderRadius', $($item).data().radius + 'px')
                if(classyea_tooltip == 'yes'){
                    $($item).html(` <span class="classyea-tooltip" style="background: ${$($item).data().tooltipbg};">${$($item).data().tooltiptext}</span>
                    <span class="classyea-hotSpot-icon"><i class="${icon}"></i></span>
                    `)
                }else{
                    $($item).html(`<span class="classyea-hotSpot-icon"><i class="${icon}"></i></span>
                    `)
                }
            })
        }

        showHotSpot1291($hotspot1291);
                    

        /* Design Two */
        var $hotspot1292 = $('.classyea-hotSpot-wrapper-1292 .classyea-hotSpot');
        if($hotspot1292){
            function showHotSpot1292($items) {
                $.each($items, function($index, $item){
                    var hotspot_icon_two = $(this).data('icontwo');
                    var icontwo = hotspot_icon_two['hotspot_icon'];
                    var classyea_tooltiptwo = hotspot_icon_two['classyea_tooltip'];
                    
                    $($item).css('top', $($item).data().positiony + '%')
                    $($item).css('left', $($item).data().positionx + '%')
                    $($item).css('borderRadius', $($item).data().radius + 'px')
                    if(classyea_tooltiptwo == 'yes'){
                        $($item).html(` <span class="classyea-tooltip" style="background: ${$($item).data().tooltipbg};">${$($item).data().tooltiptext}</span>
                        <span class="classyea-hotSpot-icon"><i class="${icontwo}"></i></span>
                        <span class="classyea-hotSpot-text">${$($item).data().hotspot_text}</span>
                        `)
                    }else{
                        $($item).html(` <span class="classyea-hotSpot-icon"><i class="${icontwo}"></i></span>
                        <span class="classyea-hotSpot-text">${$($item).data().hotspot_text}</span>
                        `)
                    }
                })
            }
            showHotSpot1292($hotspot1292) 
        }
        
    }

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/classyea-image-hotspots.default', hotpots_js);
    });
})(window.jQuery);