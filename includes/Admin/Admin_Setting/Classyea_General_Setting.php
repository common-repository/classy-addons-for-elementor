<?php 
namespace ClassyEa\Helper\Admin\Admin_Setting;
use ClassyEa\Helper\Traits\Classyea_Module;

class Classyea_General_Setting {
	use Classyea_Module;
    public function __construct()
    {
        // Admin
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'classyea_admin_menu' ) );
			add_action( 'admin_post_classyea_setting_admin_page', array( $this, 'classyea_setting_save_form' ) );
        }
    }

    /**
	 * Create an admin menu.
	 *
	 * @since 1.0.0
	 */
	public function classyea_admin_menu()
	{
		add_menu_page(
			__('Classy Addons', 'classyea'),
			__('Classy Addons', 'classyea'),
			'manage_options',
			'classyea-settings',
			[ $this, 'classyea_admin_settings_page' ],
			CLASSYEA_CORE_ASSETS . 'assets/images/icon.svg',
			'59'
		);
	}

    public function classyea_setting_save_form()
	{
		check_admin_referer("classyea_option_setting_nonce");

		if ( isset( $_POST['classyea_enable_widget'] ) && !empty( $_POST['classyea_enable_widget'] ) ) {
			$enable_widgets = classyea_sanitize_field($_POST['classyea_enable_widget']);
		    update_option( 'classyea_enable_widget', $enable_widgets );
		} else {
			update_option( 'classyea_enable_widget', 'disabled' );
		}
		
		wp_redirect(admin_url("admin.php?page=classyea-settings&action=widget"));
	}

    public function classyea_elements_widget_list()
	{

		$option_list      = $this->classyea_default_option();
		$module_name = [];
		foreach ($option_list as $key => $value ) {
			$module_name[$key] = $value[0];
		}

		ksort( $module_name );
		return $module_name;
	}

	public function classyea_elements_demo_link()
	{

		$option_list      = $this->classyea_default_option();
		$module_link = [];
		foreach ($option_list as $key => $value ) {
			if(isset($value[2]) && !empty($value[2])) {
				$module_link[$key] = $value[2];
			}
		}

		ksort( $module_link );
		return $module_link;
	}
    /**
	 * Create settings page.
	 *
	 * @since 1.0
	 */
	
	public function classyea_admin_settings_page()
	{
		$classyea_elements_demo_link = $this->classyea_elements_demo_link();
		$classyea_module_list = $this->classyea_elements_widget_list();
		$classyea_module_list = apply_filters( 'classyea_add_elementor_addons', $classyea_module_list );

?>
	<div class="classyea-wrapper-main">
		<div class="tabs">
			<ul>
				<li class="">
					<a href="<?php echo esc_url(admin_url( 'admin.php?page=classyea-settings&action=general' )); ?>" class="page-title-action"><?php _e( 'General', 'classyea' ); ?></a>
				</li>
				<li>
					<a href="<?php echo esc_url(admin_url( 'admin.php?page=classyea-settings&action=widget' )); ?>" class="page-title-action"><?php _e( 'Widget', 'classyea' ); ?></a>
				</li>
			</ul>
		</div>
		<div class="classyea-setting-form-content content">
			<?php 
			$action = isset( $_GET['action'] ) ? sanitize_text_field($_GET['action']) : 'general';
			switch ( $action ) {
				case 'general':
					include_once CLASSYEA_PLUGIN_PATH  . 'includes/Admin/templates/classyea-general-setting.php';
					break;
				case 'widget':
					include_once CLASSYEA_PLUGIN_PATH  . 'includes/Admin/templates/classyea-widget-setting.php';
					break;
	
				default:
					include_once CLASSYEA_PLUGIN_PATH  . 'includes/Admin/templates/classyea-general-setting.php';
					break;
			}
			?>
		</div>
	</div>
<?php
	}
	// hook function end  
}

function classyea_sanitize_field( $field ){
	if( is_array( $field ) ) {
		$value = array_map( 'sanitize_text_field', $field );
	}
	else {
		$value = sanitize_text_field( $field );
	}
	return $value;
}