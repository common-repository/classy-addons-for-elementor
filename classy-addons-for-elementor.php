<?php
/*
Plugin Name: Classy Addons for Elementor
Plugin URI: https://classyaddons.com/classy-addons-for-elementor
Description: The most recommended plugin you install after installing Elementor! Classy Addons contains an amazing free element pack that includes Advanced Pricing Menu, Comparison Table, Data Table, Gallery and many more. It is a complete A to Z solution for your Elementor Page Builder needs.
Author: Classy Addons
Version: 1.2.7
Author URI: https://classyaddons.com/
Elementor tested up to: 3.7.0
*/

if (!defined('ABSPATH')) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

define( 'CLASSYEA_VERSION', '1.2.7' );
define('CLASSYEA_CORE_URL', plugin_dir_url(__FILE__));
define( 'CLASSYEA_PLUGIN_ROOT', __FILE__ );
define( 'CLASSYEA_PLUGIN_URL', plugins_url( '/', CLASSYEA_PLUGIN_ROOT ) );
define( 'CLASSYEA_PLUGIN_PATH', plugin_dir_path( CLASSYEA_PLUGIN_ROOT ) );
define( 'CLASSYEA_PLUGIN_BASE', plugin_basename( CLASSYEA_PLUGIN_ROOT ) );
define('CLASSYEA_CORE_ASSETS', CLASSYEA_CORE_URL);
define( 'CLASSYEA_CVEC_OPTION_NAME', 'combine_vc_ele_css_post_sc' );
define( 'CLASSYEA_CSS_EDITOR_NAME', 'custom_css_editor' );

// Require once File

require_once ( CLASSYEA_PLUGIN_PATH .'includes/class-classy-addon.php' );
require_once ( CLASSYEA_PLUGIN_PATH .'classyea-combine-ele-css/classyea-combine-ele-css.php' );

add_action(
	'elementor/editor/before_enqueue_styles',
	function () {
		wp_enqueue_style( 'classyea-stylesheet', CLASSYEA_PLUGIN_URL . 'assets/elementor/icons/classyea-icon.css', true );
		wp_enqueue_style( 'classyea-category-stylesheet', CLASSYEA_PLUGIN_URL . 'assets/elementor/icons/stylesheets.css', true );
	}
);

