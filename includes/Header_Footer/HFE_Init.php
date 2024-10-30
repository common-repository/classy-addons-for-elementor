<?php
namespace ClassyEa\Helper\Header_Footer;

defined( 'ABSPATH' ) || exit;

class HFE_Init {

	public function __construct() {
	
		// enqueue scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'classyea_hfe_enqueue_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'classyea_hfe_enqueue_scripts' ] );
		add_action( 'add_meta_boxes', [ $this, 'classyea_tem_reg_metabox' ] );
		add_action( 'save_post', [ $this, 'classyea_save_meta' ] );

		new Posttype\Classyaddon_Template();

		Cpt_Column_Hook::instance();
		Activator::instance();
		
	}

	/**
	 * Register meta box(es).
	 */
	public function classyea_tem_reg_metabox() {
		add_meta_box(
			'classyea-meta-box',
			__( 'Classy Header & Footer Builder Options', 'classyea' ),
			[
				$this,
				'classyea_tem_metabox_render',
			],
			'classyea_template',
			'normal',
			'high'
		);
	}

	/**
	 * Render Meta field.
	 *
	 * @param  POST $post Currennt post object which is being displayed.
	 */
	public function classyea_tem_metabox_render( $post ) {

		$values            			= get_post_custom( $post->ID );  // Retrieve post meta fields, based on post ID.
		$template_type     			= isset( $values['type'] ) ? esc_attr( $values['type'][0] ) : '';
		$condition_all     			= isset( $values['condition_a'] ) ? esc_attr( $values['condition_a'][0] ) : '';
		$condition_singular     	= isset( $values['condition_singular'] ) ? esc_attr( $values['condition_singular'][0] ) : '';
		$condition_singular_id 		= get_post_meta( $post->ID, 'condition_singular_id' );
		$convert_array_to_string 	= implode( " " ,$condition_singular_id );
		$conditonal_singular_ids 	= maybe_unserialize( $convert_array_to_string );
		$activation 				= isset( $values['activation'] ) ? true : false;
		$title 						= isset ( $values['title'][0] ) ? $values['title'][0] : '';

		/** We'll use this nonce field later on when saving.  */

		wp_nonce_field( 'classyea_meta_nonce', 'classyea_meta_nonce' );

		$post_data = get_singular_list();
		
		?>
		<table class="classyea-template-table widefat">
			<tbody>
			
			<tr class="hfe-options-row type-of-template">
					<td class="hfe-options-row-heading">
						<label for="classyea_template_type"><?php _e( 'Title', 'classyea' ); ?></label>
					</td>
					<td class="classyea-template-row-content hfe-options-row-content">
						<input required type="text" name="title" value="<?php echo esc_attr($title);?>" class="widefat template-title-field"/>
					</td>
				</tr>
				<tr class="hfe-options-row type-of-template">
					<td class="hfe-options-row-heading">
						<label for="classyea_template_type"><?php _e( 'Type of Template', 'classyea' ); ?></label>
					</td>
					<td class="hfe-options-row-content">
						<select name="type" id="classyea_template_type">
							<option value="" <?php selected( $template_type, '' ); ?>><?php _e( 'Select Option', 'classyea' ); ?></option>
							<option value="header" <?php selected( $template_type, 'header' ); ?>><?php _e( 'Header', 'classyea' ); ?></option>
							<option value="footer" <?php selected( $template_type, 'footer' ); ?>><?php _e( 'Footer', 'classyea' ); ?></option>
						</select>
					</td>
				</tr>

				<tr class="classyea-target-rules-row hfe-options-row">
					<td class="classyea-target-rules-row-heading hfe-options-row-heading">
						<label><?php esc_html_e( 'Display On', 'classyea' ); ?></label>
						<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
							title="<?php echo esc_attr__( 'Add locations for where this template should appear.', 'classyea' ); ?>"></i>
					</td>
					<td class="classyea-template-row-content hfe-options-row-content classyea-template-on-change">
						<select name="condition_a" class="classyea-template-modalinput-condition_a attr-form-control">
							<option value="entire_site" <?php selected( $condition_all, 'entire_site' ); ?>><?php _e( 'Entire Website', 'classyea' ); ?></option>
							<option value="singular" <?php selected( $condition_all, 'singular' ); ?>><?php _e( 'Singular', 'classyea' ); ?></option>
							<option value="archive" <?php selected( $condition_all, 'archive' ); ?>><?php _e( 'Archive', 'classyea' ); ?></option>
						</select>
						
						<select name="condition_singular"
							class="classyea-template-condition_singular attr-form-control" <?php if( 'singular' !== $condition_all ) { echo 'style="display:none"';} ?>>
							<option value="all" <?php selected( $condition_singular, 'all' ); ?>><?php _e( 'All Singulars', 'classyea' ); ?></option>
							<option value="front_page" <?php selected( $condition_singular, 'front_page' ); ?>><?php _e( 'Front Page', 'classyea' ); ?></option>
							<option value="all_posts" <?php selected( $condition_singular, 'all_posts' ); ?>><?php _e( 'All Posts', 'classyea' ); ?></option>
							<option value="all_pages" <?php selected( $condition_singular, 'all_pages' ); ?>><?php _e( 'All Pages', 'classyea' ); ?></option>
							<option value="selective" <?php selected( $condition_singular, 'selective' ); ?>><?php _e( 'Selective Singular (Only Pro)', 'classyea' ); ?>
							</option>
							<option value="404page" <?php selected( $condition_singular, '404page' ); ?>><?php _e( '404 Page', 'classyea' ); ?></option>
						</select>
						<div class="condition-singular-id-allpost" <?php if( 'selective' !== $condition_singular || 'singular' !== $condition_all ) { echo 'style="display:none"';} ?>>
							<select name="condition_singular_id[]" id="singular-all-page-select" class="classyea-template-condition_singular_id-container" multiple <?php if( 'selective' !== $condition_singular && 'singular' !== $condition_all ) { echo 'style="display:none"';} ?>>
								<?php 
									
									$i = 0;
									foreach( $post_data as $key => $single_post ) {
										$single_id = '';
										if(isset($conditonal_singular_ids[$i])) {
											$single_id = $conditonal_singular_ids[$i];
										}

										if( $single_post['id'] == $single_id ) {
											$selected = "selected = 'selected'";
										} else {
											$selected = '';
										}

								?>
								<option value="<?php echo $single_post['id'];?>" <?php echo $selected; ?>><?php  echo $single_post['title'];?></option>
								<?php $i++;}  ?>
									
							</select>
						</div>
						
						
					</td>
				</tr>

				<tr class="hfe-options-row enable-for-canvas">
					<td class="hfe-options-row-heading">
						<label for="activation-template">
							<?php _e( 'Enable Layout for Elementor Canvas Template?', 'classyea' ); ?>
						</label>
						<i class="hfe-options-row-heading-help dashicons dashicons-editor-help" title="<?php _e( 'Enable Layout for Elementor Canvas Template? ', 'classyea' ); ?>"></i>
					</td>
					<td class="hfe-options-row-content">
						<input type="checkbox" id="activation-template" name="activation" value="1" <?php checked( $activation, true ); ?> />
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	/**
	 * Save meta field.
	 *
	 * @param  POST $post_id Currennt post object which is being displayed.
	 *
	 * @return Void
	 */
	public function classyea_save_meta( $post_id ) {


		/** when doing auto then return  */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		/** nonce verify  */
		if ( ! isset( $_POST['classyea_meta_nonce'] ) || ! wp_verify_nonce( $_POST['classyea_meta_nonce'], 'classyea_meta_nonce' ) ) {
			return;
		}

		if ( isset( $_POST['type'] ) ) {
			update_post_meta( $post_id, 'type', esc_attr( $_POST['type'] ) );
		}

		if ( isset( $_POST['title'] ) ) {
			update_post_meta( $post_id, 'title', esc_attr( $_POST['title'] ) );
		} else {
			delete_post_meta( $post_id, 'title' );
		}

		if ( isset( $_POST['condition_singular'] ) ) {
			update_post_meta( $post_id, 'condition_singular', esc_attr( $_POST['condition_singular'] ) );
		} else {
			delete_post_meta( $post_id, 'condition_singular' );

		}

		if ( isset( $_POST['condition_singular_id'] ) ) {

			$singular_ids 	= $_POST['condition_singular_id'];

			if ( isset( $_POST['condition_singular_id'] ) && is_array( $_POST['condition_singular_id'] ) ) {
				$singular_id_serialize = serialize($singular_ids);
				update_post_meta( $post_id, 'condition_singular_id', $singular_id_serialize );

			} else {
				delete_post_meta( get_the_ID(), 'condition_singular_id' );
			}
			
		}

		if ( isset( $_POST['condition_a'] ) ) {
			update_post_meta( $post_id, 'condition_a', esc_attr( $_POST['condition_a'] ) );
		}
		else {
			delete_post_meta( $post_id, 'condition_a' );
		}

		if ( isset( $_POST['activation'] ) ) {
			update_post_meta( $post_id, 'activation', esc_attr( $_POST['activation'] ) );
		} else {
			delete_post_meta( $post_id, 'activation' );
		}
	}

	/**
	 * header footer js css enqueue
	 */

	public function classyea_hfe_enqueue_styles() {

		$screen = get_current_screen();
		wp_enqueue_style( 'classyea-select2', CLASSYEA_CORE_ASSETS . 'includes/Header_Footer/assets/css/select2.min.css', false, CLASSYEA_VERSION );
		wp_enqueue_style( 'classyea-template-admin-style', CLASSYEA_CORE_ASSETS . 'includes/Header_Footer/assets/css/admin-style.css', false, CLASSYEA_VERSION );
	}

	public function classyea_hfe_enqueue_scripts() {
		$screen = get_current_screen();
		wp_enqueue_script( 'classyea-select2', CLASSYEA_CORE_ASSETS . 'includes/Header_Footer/assets/js/select2.min.js', array( 'jquery' ), true, CLASSYEA_VERSION );
		wp_enqueue_script( 'classyea-template-admin-script', CLASSYEA_CORE_ASSETS . 'includes/Header_Footer/assets/js/admin-script.js', array( 'jquery' ), true, CLASSYEA_VERSION );
	}

}