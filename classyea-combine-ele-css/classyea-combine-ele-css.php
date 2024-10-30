<?php
defined( 'ABSPATH' ) || die();
use CLASSYEA\classes\helper\CLASSYEA_ELE_SC_LIST;
use CLASSYEA\classes\helper\CLASSYEA_PBModule;
use CLASSYEA\classes\helper\CLASSYEA_PB_BUILD_CSS;
use CLASSYEA\classes\helper\CLASSYEA_PB_SC_CHECK;

class CLASSYEA_COMBINE_ELE_CSS {

	private static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {


		add_action( 'save_post', array( $this, 'save_shortcode_for_combine' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_cvec_assets' ) );
		add_action( 'upload_dir', array( $this, 'upload_dir_ssl' ), 10, 1 );
	}

	public function upload_dir_ssl( $upload_dir ) {
		if ( is_ssl() ) {
			$upload_dir['baseurl'] = str_replace( 'http://', 'https://', $upload_dir['baseurl'] );
			$upload_dir['url']     = str_replace( 'http://', 'https://', $upload_dir['url'] );
		}
		return $upload_dir;
	}

	public function init() {

		include CLASSYEA_PLUGIN_PATH . 'classyea-combine-ele-css/classes/class.pb.php';
		include CLASSYEA_PLUGIN_PATH . 'classyea-combine-ele-css/classes/class.ele_sc_list.php';
		include CLASSYEA_PLUGIN_PATH . 'classyea-combine-ele-css/classes/class.pb_sc_check.php';
		include CLASSYEA_PLUGIN_PATH . 'classyea-combine-ele-css/classes/class.pb_build_css.php';

		CLASSYEA_PBModule::init();
		CLASSYEA_ELE_SC_LIST::init();
		CLASSYEA_PB_BUILD_CSS::init();
		
	}

	public function save_shortcode_for_combine( $post_id ) {
		$array_list = $array_list_ele = false;
		
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . '/wp-admin/includes/plugin.php';
		}
		if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
			return false;
		}
		
		if ( did_action( 'elementor/loaded' ) ) {
			$array_list_ele = $this->get_array_list( CLASSYEA_ELE_SC_LIST::class );
		}

		if ( $array_list && ! empty( $array_list ) ) {
			$get_exist_sc_array = CLASSYEA_PB_SC_CHECK::Check_sc_exist_in_post( $array_list, $post_id );
			if ( $get_exist_sc_array ) {
				update_post_meta( $post_id, CLASSYEA_CVEC_OPTION_NAME, $get_exist_sc_array );
				CLASSYEA_PB_BUILD_CSS::pb_build_css_assets_css( $post_id );
			} else {
				CLASSYEA_PB_BUILD_CSS::pb_build_css_remove_css( $post_id, true );
				update_post_meta( $post_id, CLASSYEA_CVEC_OPTION_NAME, '' );
			}
		}
		if ( $array_list_ele && ! empty( $array_list_ele ) ) {
			$get_exist_sc_array = CLASSYEA_PB_SC_CHECK::Check_ele_sc_exist_in_post( $array_list_ele, $post_id );
			if ( $get_exist_sc_array ) {
				update_post_meta( $post_id, CLASSYEA_CVEC_OPTION_NAME, $get_exist_sc_array );
				CLASSYEA_PB_BUILD_CSS::pb_build_css_assets_css( $post_id );
			} else {
				CLASSYEA_PB_BUILD_CSS::pb_build_css_remove_css( $post_id, true );
				update_post_meta( $post_id, CLASSYEA_CVEC_OPTION_NAME, '' );
			}
		}
	}

	public function get_array_list( $module ) {
		if ( isset( $module ) && $module != '' ) {
			if ( class_exists( $module ) ) {
				$_array = $module::get_pb_sc_array_list();
				return $_array;
			}
		}
	}

	public function enqueue_cvec_assets() {
		global $post;
		if ( ! isset( $post ) || empty( $post ) ) {
			return;
		}
		$post_meta_array = get_post_meta( $post->ID, CLASSYEA_CVEC_OPTION_NAME, true );
		if ( $post_meta_array == '' ) {
			$this->save_shortcode_for_combine( $post->ID );
		}
		$get_pb_build_css_array = CLASSYEA_PB_BUILD_CSS::pb_get_css_assets_css();

		if ( did_action( 'elementor/loaded' ) ) {
			if ( ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
				if ( $get_pb_build_css_array && isset( $get_pb_build_css_array['return_url'] ) ) {

					wp_enqueue_style( 'combine-vc-ele-css', $get_pb_build_css_array['return_url'], null, $get_pb_build_css_array['return_url_version'] );
				}
				if ( $get_pb_build_css_array && isset( $get_pb_build_css_array['return_url_custom'] ) ) {
					wp_enqueue_style( 'combine-vc-ele-css-custom', $get_pb_build_css_array['return_url_custom'], null, $get_pb_build_css_array['return_url_custom_version'] );
				}
			} else {
				$array_list_ele = $this->get_array_list( CLASSYEA_ELE_SC_LIST::class );

				$get_pb_build_css_array = CLASSYEA_PB_BUILD_CSS::pb_get_css_assets_css_for_editor_mode( $array_list_ele );
			}
		}
	}

}

CLASSYEA_COMBINE_ELE_CSS::instance();
