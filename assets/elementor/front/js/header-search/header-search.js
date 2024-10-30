(function ($) { 

    "use strict";
       
        var search_js = function() {
            //Search Popup
            if ($('#classyea-search-popup').length) {
                //Show Popup
                $('.classyea-search-toggler').on('click', function () {
                    $('#classyea-search-popup').addClass('popup-visible');
                });
                $(document).keydown(function (e) {
                    if (e.keyCode === 27) {
                        $('#classyea-search-popup').removeClass('popup-visible');
                    }
                });
                //Hide Popup
                $('.classyea-close-search,.classyea-search-popup .classyea-overlay-layer').on('click', function () {
                    $('#classyea-search-popup').removeClass('popup-visible');
                });
            }
  
        }

        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/classyea-header-search.default', search_js);
        });   

})(window.jQuery);