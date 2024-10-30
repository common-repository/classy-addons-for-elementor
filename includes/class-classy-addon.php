<?php
/**
 * The main plugin class
 */
use ClassyEa\Helper\Traits\Classyea_Module;
final class Classyea_Addon_Helper
{
	use Classyea_Module;
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var   string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var   string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since  1.2.0
	 * @access public
	 */
	/**
	 * Widget Options
	 *
	 * @var widget_options
	 */
	private function __construct()
	{
		// Register  deactive Active Hook
		register_activation_hook( CLASSYEA_PLUGIN_ROOT, [ $this, 'classyea_activate'] );
		register_deactivation_hook( CLASSYEA_PLUGIN_ROOT, [ $this, 'classyea_deactivate_hook'] );
		add_action( 'plugins_loaded', array( $this, 'classyea_init_plugin' ) );

		add_filter('plugin_action_links_'.CLASSYEA_PLUGIN_BASE,[ $this,'classyea_setting_page_link_func' ] );

		add_filter( 'classyea_deactivate_feedback_form_filter', array( $this, 'classyea_wpcf_nd_filter_deactivate_feedback_form' ), 10, 1 );

		add_filter('plugin_row_meta', array($this, 'classyea_plugin_meta_links'), 10, 2);

	}
	// hook function start

	/**
	 * Check if a plugin is installed
	 *
	 * @since v1.0.0
	 */
	public function is_plugin_installed( $basename )
	{
		if ( !function_exists( 'get_plugins' ) ) {
			include_once ABSPATH . '/wp-admin/includes/plugin.php';
		}
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $basename ] );
	}

	/**
	 * Initializes a singleton instance
	 *
	 * @return \ClassyEa
	 */
	public static function init()
	{
		static $instance = false;

        $get_version = get_option( 'classyea_version' );
        $updated     = get_option( 'classyea_updated' );

        if ( $get_version < CLASSYEA_VERSION && !$updated ) {
			
			$installer        = new \ClassyEa\Helper\Installer();
			$option_list      = $installer->classyea_default_option();
        	$option_array_key = array_keys($option_list);

			update_option( 'classyea_enable_widget', $option_array_key );
			update_option( 'classyea_version', CLASSYEA_VERSION );	
			update_option( 'classyea_updated',false );	
			
        }

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function classyea_init_plugin()
	{
		if( is_admin() ) {
			new \ClassyEa\Helper\Classyea_Admin();
		}
		$this->classyea_checkElementor();
		load_plugin_textdomain( 'classyea', false, basename(dirname( CLASSYEA_PLUGIN_ROOT ) ) . '/languages' );
		
		if ( did_action( 'elementor/loaded' ) ) {
			new \ClassyEa\Helper\Classyea_Elementor();
			new \ClassyEa\Helper\Template\Classyea_Templates_Lib();
		}

		// Plugins Required File
		if ( is_user_logged_in() ) {
			new \ClassyEa\Helper\Classyea_Review();
		}

	}

	public function classyea_checkElementor()
	{
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'classyea_admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if (!version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'classyea_admin_notice_min_ele_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'classyea_admin_notice_min_php_version' ) );
			return;
		}
	}

	// plugin activate function
	public function classyea_is_plugins_active( $plugin_file_path = NULL ){
        $all_plugins_list = get_plugins();
        return isset( $all_plugins_list[ $plugin_file_path ] );
    }
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function classyea_admin_notice_min_ele_version()
	{
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'classyea'),
			'<strong>' . esc_html__('Classy Addons', 'classyea') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'classyea') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function classyea_admin_notice_min_php_version()
	{
		if ( isset($_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'classyea'),
			'<strong>' . esc_html__('Classy Addons', 'classyea') . '</strong>',
			'<strong>' . esc_html__('PHP', 'classyea') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
     * Admin Notice if elementor plugin deactive
     * @return [void]
     */
    public function classyea_admin_notice_missing_main_plugin() {
		
		if ( isset($_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

        $elementor = 'elementor/elementor.php';
        if( $this->classyea_is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) { return; }

            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

            $message = '<p>' . __( 'Classy Addons not working because you need to activate the Elementor plugin.', 'classyea' ) . '</p>';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Active Elementor', 'classyea' ) ) . '</p>';
        } else {
            if ( ! current_user_can( 'install_plugins' ) ) { return; }

            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

            $message = '<p>' . __( 'Classy Addons not working because you need to install the Elementor plugin', 'classyea' ) . '</p>';

            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Active Elementor', 'classyea' ) ) . '</p>';
        }
		$message = sprintf( '<div class="error"><p>%s</p></div>', $message );
		echo wp_kses( $message, 'classyea_kses' );
    }

	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function classyea_activate()
	{

		$installer = new \ClassyEa\Helper\Installer();
		$installer->run();

	}

	/**
	 * deactive the main plugin
	 *
	 * @return \classyea_deactivate_hook
	*/
	public function classyea_deactivate_hook() {
		// Unregister the post type, so the rules are no longer in memory.
		$option_list = $this->classyea_default_option();

		$option_array_key = array_keys( $option_list );
		delete_option( 'classyea_enable_widget', $option_array_key );
		delete_option( 'classyea_version' );
		delete_option( 'classyea_updated' );
		flush_rewrite_rules();
	}

	

	public function classyea_setting_page_link_func( $links ) {
		$action_link = sprintf("<a href='%s'>%s</a>",admin_url('admin.php?page=classyea-settings'),__('Settings','classyea'));
		array_push( $links,$action_link );
		return $links;
	}

	
	public function classyea_wpcf_nd_filter_deactivate_feedback_form( $plugins ) {
		$plugins[] = (object) array(
			'slug' => 'classy-addons-for-elementor',
			'version' => CLASSYEA_VERSION
		);

		return $plugins;
	}

	public function classyea_plugin_meta_links($links, $file)
	{
		if ($file !== CLASSYEA_PLUGIN_BASE ) {
			return $links;
		}
		$rate_link = '<a target="_blank" href="https://wordpress.org/support/plugin/classy-addons-for-elementor/reviews/#new-post" title="' . __('Rate the plugin', 'classyea') . '">' . __('Rate the plugin ★★★★★', 'classyea') . '</a>';
		$links[] = $rate_link;

		return $links;
	} // plugin_meta_links

	
}
/**
 * Initializes the main plugin
 *
 * @return \classyea_addon
 */
function classyea_addon()
{
	return Classyea_Addon_Helper::init();
}

// kick-off the plugin
classyea_addon();