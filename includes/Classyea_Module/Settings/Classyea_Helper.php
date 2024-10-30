<?php
namespace ClassyEa\Helper\Classyea_Module\Settings;

use Elementor\Utils;

class Classyea_Helper {


	const ALLOWED_HTML_WRAPPER_TAGS = [
		'article',
		'aside',
		'div',
		'footer',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'header',
		'main',
		'nav',
		'p',
		'section',
		'span',
	];

	public static function classyea_validate_html_tag( $tag ) {
		// Check if Elementor method exists, else we will run custom validation code.
		if ( method_exists( 'Elementor\Utils', 'validate_html_tag' ) ) {
			return Utils::validate_html_tag( $tag );
		} else {
			return in_array( strtolower( $tag ), self::ALLOWED_HTML_WRAPPER_TAGS, true ) ? $tag : 'div';
		}
	}

	public static function Classyea_getContactForm7Posts() {
		$args    = array(
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => -1,
		);
		$catlist = array();
		if ( $categories = get_posts( $args ) ) {
			foreach ( $categories as $category ) {
				(int) $catlist[ $category->ID ] = $category->post_title;
			}
		} else {
			(int) $catlist['0'] = esc_html__( 'No contect From 7 form found', 'classyea' );
		}
		return $catlist;
	}
}
