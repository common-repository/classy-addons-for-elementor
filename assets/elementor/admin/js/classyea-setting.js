;(function($) {
    'use strict';
	$(function() {
        
        var clicked = false;
        $(".classyea_btn_disable").on("click", function() {
            $(".classyea_checksingle").prop("checked", clicked);
            clicked = clicked;

        });  
        $(".classyea_btn_en").on("click", function() {
            $(".classyea_checksingle").prop("checked", !clicked);
            clicked = clicked;
        }); 
		
	});
})(window.jQuery);