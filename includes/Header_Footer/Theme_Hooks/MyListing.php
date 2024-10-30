<?php 
namespace ClassyEa\Helper\Header_Footer\Theme_Hooks;

defined( 'ABSPATH' ) || exit;

/**
 * MyListing support for the header footer.
 */
class MyListing {

	/**
	 * Run all the Actions / Filters.
	 */
	private $footer;
	function __construct( $template_ids ) {
		global $classyea_template_ids;
		
		$classyea_template_ids = $template_ids;
		include 'my-listing-functions.php';
	}

}
