<?php
namespace ClassyEa\Helper\Header_Footer;

class Cpt_Column_Hook
{
	public static $instance = null;

	public function __construct()
	{

		add_action('admin_init', array($this, 'classyea_author_support_to_column'), 10);
		add_filter('manage_classyea_template_posts_columns', array($this, 'classyea_set_columns'));
		add_action('manage_classyea_template_posts_custom_column', array($this, 'classyea_render_column'), 10, 2);
	}

	public function classyea_author_support_to_column()
	{
		add_post_type_support('classyea_template', 'author');
	}

	/**
	 * Set custom column for template list.
	 */
	public function classyea_set_columns($columns)
	{

		$date_column   = $columns['date'];
		$author_column = $columns['author'];

		unset($columns['date']);
		unset($columns['author']);

		$columns['type']      = esc_html__('Type', 'classyea');
		$columns['status']      = esc_html__('Status', 'classyea');
		$columns['condition'] = esc_html__('Display Rules', 'classyea');
		$columns['date']      = $date_column;
		$columns['author']    = $author_column;

		return $columns;
	}

	/**
	 * Render Column
	 *
	 * Enqueue js and css to frontend.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function classyea_render_column($column, $post_id)
	{

		switch ($column) {
			case 'type':
				$type   = get_post_meta($post_id, 'type', true);

				$output_type = ucfirst($type);
				echo wp_kses($output_type, 'classyea_kses');

				break;
			case 'status':
				$active = get_post_meta($post_id, 'activation', true);
				$status = ($active == '1') ?  esc_html__('Active', 'classyea') : esc_html__("InActive","classyea");
				echo wp_kses($status, 'classyea_kses');
				break;
			case 'condition':
				$condition_singular_id 		= get_post_meta( get_the_ID(), 'condition_singular_id' );
				$convert_array_to_string 	= implode( " " ,$condition_singular_id );
				$conditonal_singular_ids 	= maybe_unserialize( $convert_array_to_string );
				$con_sinid = '';
				if(is_array($conditonal_singular_ids)) {
					$con_sinid = $conditonal_singular_ids[0];
				}
		
				$condition_singular 		= get_post_meta($post_id, 'condition_singular', true );
				$condition_a 				= get_post_meta($post_id, 'condition_a', true);
				$cond = array(
					'condition_a'           => $condition_a,
					'condition_singular'    => $condition_singular,
					'condition_singular_id' => $con_sinid,
				);

				echo esc_html(ucwords(
					str_replace(
						'_',
						' ',
						$cond['condition_a']
							. (($cond['condition_a'] == 'singular')
								? (($cond['condition_singular'] != '')
									? (' > ' . $cond['condition_singular']
										. (($cond['condition_singular_id'] != '')
											? ' > ' . $cond['condition_singular_id']
											: ''))
									: '')
								: '')
					)
				));

				break;
				
		}
	}


	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}