<?php
namespace CLASSYEA\classes\helper;

defined( 'ABSPATH' ) || die();

class CLASSYEA_PB_BUILD_CSS {

	public static $targetdircss        = '/cache/css/';
	public static $targetdirurlcss     = '/cache/css/';
	public static $defaultcssname      = 'default.min.css';
	public static $defaultcsspath      = CLASSYEA_PLUGIN_PATH . 'assets/combine/assets/css/';
	public static $defaultcssURL       = CLASSYEA_PLUGIN_URL. 'assets/combine/assets/css';
	public static $filename            = '';
	public static $filename_custom_css = '';
	public static function init() {
		$upload_dir            = wp_upload_dir();
		self::$targetdircss    = apply_filters( 'combine_vc_ele_css_pb_build_css_target_css_path', $upload_dir['basedir'] . self::$targetdircss );
		self::$defaultcssname  = apply_filters( 'combine_vc_ele_css_pb_build_css_assets_css_default_name', self::$defaultcssname );
		self::$defaultcsspath  = apply_filters( 'classyea_combine_ele_css_pb_build_css_assets_css_path', self::$defaultcsspath );
		self::$defaultcssURL  = apply_filters( 'classyea_combine_ele_css_pb_build_css_assets_css_url', self::$defaultcssURL );

		self::$targetdirurlcss = apply_filters( 'combine_vc_ele_css_pb_build_css_target_css_url', $upload_dir['baseurl'] . self::$targetdirurlcss );
	}

	

	public static function pb_build_css_assets_css( $post_id ) {

		self::$filename            = self::$targetdircss . "cvec_post_{$post_id}.css";
		self::$filename_custom_css = self::$targetdircss . "css_editor_{$post_id}.css";
		self::pb_build_css_remove_css();
		$array = get_post_meta( $post_id, CLASSYEA_CVEC_OPTION_NAME, true );
		$data  = '';
		if(is_array(self::$defaultcsspath)) {
			$default_path = self::$defaultcsspath;
			foreach($default_path as $key => $path) {
				
				if ( file_exists( $path . self::$defaultcssname ) ) {
					$data .= file_get_contents( $path . self::$defaultcssname );
				}
			}
			if ( ! empty( $array ) ) {
				$array=array_column($array, 'css');
				$array = array_map("unserialize", array_unique(array_map("serialize", $array)));
				foreach ( $array as $sccss ) {
					foreach ( $sccss as $css ) {
						foreach($default_path as $key => $path2) {
							if ( file_exists( $path2 . "{$css}.min.css" ) ) {
		
								$data .= file_get_contents( $path2 . "{$css}.min.css" );
							}
						}
					}
				}
				if ( ! is_dir( self::$targetdircss ) ) {
					@mkdir( self::$targetdircss, 0777, true );
				}
	
				if ( $data != '' ) {
					file_put_contents( self::$filename, $data );
				}
			}
			
		} else {
			if ( file_exists( self::$defaultcsspath . self::$defaultcssname ) ) {
				$data .= file_get_contents( self::$defaultcsspath . self::$defaultcssname );
			}
			if ( ! empty( $array ) ) {
				$array=array_column($array, 'css');
				$array = array_map("unserialize", array_unique(array_map("serialize", $array)));
				foreach ( $array as $sccss ) {
					foreach ( $sccss as $css ) {
	
						if ( file_exists( self::$defaultcsspath . "{$css}.min.css" ) ) {
	
							$data .= file_get_contents( self::$defaultcsspath . "{$css}.min.css" );
						}
					}
				}
				if ( ! is_dir( self::$targetdircss ) ) {
					@mkdir( self::$targetdircss, 0777, true );
				}
	
				if ( $data != '' ) {
					file_put_contents( self::$filename, $data );
				}
			}
		}

	}

	public static function pb_get_css_assets_css() {
		global $post;
		if ( ! isset( $post ) || empty( $post ) ) {
			return;
		}
		
		self::$filename            = self::$targetdircss . "cvec_post_{$post->ID}.css";
		self::$filename_custom_css = self::$targetdircss . "css_editor_{$post->ID}.css";
		
		$array = array();
		if ( file_exists( self::$filename ) ) {
			$path_parts                  = pathinfo( self::$filename );
			$array['return_url']         = self::$targetdirurlcss . $path_parts['basename'];
			$array['return_url_version'] = CLASSYEA_VERSION . '.' . get_post_modified_time( 'U', false, $post );
		}
		if ( file_exists( self::$filename_custom_css ) ) {
			$path_parts                         = pathinfo( self::$filename_custom_css );
			$array['return_url_custom']         = self::$targetdirurlcss . $path_parts['basename'];
			$array['return_url_custom_version'] = CLASSYEA_VERSION . '.' . get_post_modified_time( 'U', false, $post );
		}
		return $array;
	}


	public static function pb_get_css_assets_css_for_editor_mode($array) {
		global $post;
		if ( ! isset( $post ) || empty( $post ) ) {
			return;
		}
		$array=array_column($array, 'css');
		$array = array_map("unserialize", array_unique(array_map("serialize", $array)));
		foreach ( $array as $sccss ) {
			foreach ( $sccss as $css ) {
				$default_path = self::$defaultcsspath;
				
				if(is_array($default_path)) {
					foreach($default_path as $key => $path ){
						if ( file_exists( $path . "{$css}.min.css" ) ) {
							$default_url = self::$defaultcssURL;
							wp_enqueue_style( 'combine-vc-ele-'.$css, $default_url[$key] . "{$css}.min.css", null, CLASSYEA_VERSION . '.' . get_post_modified_time( 'U', false, $post ) );
						}
					}
				} else {
					if ( file_exists( self::$defaultcsspath . "{$css}.min.css" ) ) {
						wp_enqueue_style( 'combine-vc-ele-'.$css, self::$defaultcssURL . "{$css}.min.css", null, CLASSYEA_VERSION . '.' . get_post_modified_time( 'U', false, $post ) );
					}
				}
			}
		}
	}


	public static function pb_build_css_remove_css( $post_id = '', $remove_custom = false ) {
		if ( $post_id != '' ) {
			self::$filename            = self::$targetdircss . "cvec_post_{$post_id}.css";
			self::$filename_custom_css = self::$targetdircss . "css_editor_{$post_id}.css";
		}

		if ( file_exists( self::$filename ) ) {
			unlink( self::$filename );
		}
		if ( $remove_custom ) {
			if ( file_exists( self::$filename_custom_css ) ) {
				unlink( self::$filename_custom_css );
			}
		}
	}

}
