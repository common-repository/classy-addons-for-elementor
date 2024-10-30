<?php
if ( ! function_exists( 'classyea_hfe_render_header' ) ) {
	function classyea_hfe_render_header() {
		global $classyea_template_ids;
		if ( $classyea_template_ids[0] == null ) {
			return;
		}

		do_action( 'classyea/template/before_header' );
		echo '<div class="classyea-template-content-markup classyea-template-content-header">';
			echo classyea_render_elementor_content( $classyea_template_ids[0] ); 
		echo '</div>';
		do_action( 'classyea/template/after_header' );
	}
}

if ( ! function_exists( 'classyea_get_hfe_header_id' ) ) {
	function classyea_get_hfe_header_id() {
		global $classyea_template_ids;
		return $classyea_template_ids[0];
	}
}

if ( ! function_exists( 'classyea_hfe_render_footer' ) ) {
	function classyea_hfe_render_footer() {
		global $classyea_template_ids;
		if ( $classyea_template_ids[1] == null ) {
			return;
		}

		do_action( 'classyea/template/before_footer' );
		echo '<div class="classyea-template-content-markup classyea-template-content-header">';
			echo classyea_render_elementor_content( $classyea_template_ids[1] ); 
		echo '</div>';
		do_action( 'classyea/template/after_footer' );
	}
}

if ( ! function_exists( 'classyea_get_hfe_footer_id' ) ) {
	function classyea_get_hfe_footer_id() {
		global $classyea_template_ids;
		return $classyea_template_ids[1];
	}
}
