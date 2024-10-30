<?php 
namespace ClassyEa\Helper\Header_Footer\Posttype;

class Classyaddon_Template {

	public function __construct() {
		
        add_action( 'init', array( $this, 'classyea_template_post_type' ), 0 );
		add_action( 'admin_menu', array( $this, 'classyea_cpt_menu' ) );
		add_filter( 'single_template', array( $this, 'classyea_load_canvas_template' ) );
	}

	public function classyea_template_post_type() {
		
		$labels = array(
			'name'               => esc_html__( 'Templates', 'classyea' ),
			'singular_name'      => esc_html__( 'Template', 'classyea' ),
			'menu_name'          => esc_html__( 'Header Footer', 'classyea' ),
			'name_admin_bar'     => esc_html__( 'Header Footer', 'classyea' ),
			'add_new'            => esc_html__( 'Add New', 'classyea' ),
			'add_new_item'       => esc_html__( 'Add New Template', 'classyea' ),
			'new_item'           => esc_html__( 'New Template', 'classyea' ),
			'edit_item'          => esc_html__( 'Edit Template', 'classyea' ),
			'view_item'          => esc_html__( 'View Template', 'classyea' ),
			'all_items'          => esc_html__( 'All Templates', 'classyea' ),
			'search_items'       => esc_html__( 'Search Templates', 'classyea' ),
			'parent_item_colon'  => esc_html__( 'Parent Templates:', 'classyea' ),
			'not_found'          => esc_html__( 'No Templates found.', 'classyea' ),
			'not_found_in_trash' => esc_html__( 'No Templates found in Trash.', 'classyea' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'page',
			'hierarchical'        => false,
			'supports'            => array( 'title', 'thumbnail', 'elementor' ),
		);

		register_post_type( 'classyea_template', $args );
	}

	public function classyea_cpt_menu() {
		$link_our_new_cpt = 'edit.php?post_type=classyea_template';
		add_submenu_page( 'classyea-settings', esc_html__( 'Header Footer', 'classyea' ), esc_html__( 'Header Footer', 'classyea' ), 'manage_options', $link_our_new_cpt );
	}

	function classyea_load_canvas_template( $single_template ) {

		global $post;

		if ( 'classyea_template' == $post->post_type ) {

			$elementor_canvas_path = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_canvas_path ) ) {
				return $elementor_canvas_path;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}
}