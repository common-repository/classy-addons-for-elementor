jQuery( function( $ ) {

	$( '.classyea-template-modalinput-condition_a' ).change( function() {

		var val = $(this).val();
		if( 'singular' == val ) {
			$( '.classyea-template-condition_singular' ).show();

			$( '.classyea-template-condition_singular' ).change( function() {
       
				var singular_val = $(this).val();
				if( 'selective' == singular_val ) {
					$( '.condition-singular-id-allpost' ).show();
				} else {
					$( '.condition-singular-id-allpost' ).hide();
				}
			});

		} else {
			$( '.classyea-template-condition_singular' ).hide();
			$( '.condition-singular-id-allpost' ).hide();
		}
	});

} );

 jQuery( function( $ ) {

	$( '.classyea-template-condition_singular' ).change( function() {
       
		var singular_val = $(this).val();
		if( 'selective' == singular_val ) {
			$( '.condition-singular-id-allpost' ).show();
		} else {
			$( '.condition-singular-id-allpost' ).hide();
		}
	});

} );

jQuery(document).ready(function($) {
    $('#singular-all-page-select').select2({
        multiple: true,
    });
});