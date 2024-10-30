<?php
namespace ClassyEa\Helper;
/**
 * The admin class
 */
class Classyea_Elementor {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		new Classyea_Module\Classyea_Element();
		new Classyea_Module\Classyea_Scripts();

	}
}
