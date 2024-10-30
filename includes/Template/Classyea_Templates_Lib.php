<?php
/**
 * ClassyEa Template.
 *
 * @package ClassyEaElements
 */
namespace ClassyEa\Helper\Template;
use Elementor\Plugin;
use Elementor\TemplateLibrary\Source_Base;
use Elementor\TemplateLibrary\Source_Local;
use Elementor\Core\Common\Modules\Ajax\Module as Ajax;
use Elementor\User;
/**
 * ClassyEa Template Library.
 *
 * @since 1.6.0
 */
class Classyea_Templates_Lib {
	/**
	 * ClassyEa library option key.
	 */
	const LIBRARY_OPTION_KEY = 'classyea_templates_library';

	const TRANSIENT_KEY_PREFIX = 'classyea_templates_data_';

	/**
	 * API templates URL.
	 *
	 * All Template URL.
	 *
	 * @access public
	 * @static
	 *
	 * @var string API URL.
	 */
	public static $api_url = 'http://templates.classyaddons.com/api/v2/templates/';

	public static $api_url_single = 'http://templates.classyaddons.com/api/v2/template/';
	/**
	 * Init.
	 *
	 * Initializes the elementor hooks.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return void
	 */

	public static function init() {

		
		add_action( 'elementor/init', [ __CLASS__, 'classyea_template_source_register_func' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'classyea_frontend_enq_scripts_func' ] );
		add_action( 'elementor/ajax/register_actions', [ __CLASS__, 'classyea_template_ajax_actions_func' ] );
		add_action( 'elementor/editor/footer', [ __CLASS__, 'classyea_template_rendering_func' ] );
	}

	/**
	 * Register elementor source.
	 *
	 * Registers the library source.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return void
	 */
	public static function classyea_template_source_register_func() {
		Plugin::$instance->templates_manager->register_source( __NAMESPACE__ . '\Classyea_Source' );
	}

	/**
	 * Enqueue Editor Scripts.
	 *
	 * Enqueues required scripts in Elementor edit mode.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return void
	 */
	public static function classyea_frontend_enq_scripts_func() {
		wp_enqueue_script( 'classyea-editor-js', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/editor.js', array( 'jquery' ), CLASSYEA_VERSION, true );
		wp_enqueue_script(
			'classyea-templates-lib',
			CLASSYEA_CORE_ASSETS . 'assets/elementor/template/js/classyea-templates-lib.js',
			[
				'jquery',
				'backbone-marionette',
				'backbone-radio',
				'elementor-common-modules',
				'elementor-dialog',
				'classyea-editor-js',
				'elementor-editor'
			],
			CLASSYEA_VERSION,
			true
		);

		wp_localize_script( 'classyea-templates-lib', 'classyea_templates_lib', array(
			'logoUrl'	=> CLASSYEA_PLUGIN_URL . 'assets/images/icon.svg',
		) );
	}

	/**
	 *
	 * Initialize template library ajax calls for allowed ajax requests.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param Ajax Ajax object.
	 * @return void
	 */
	public static function classyea_template_ajax_actions_func( Ajax $ajax ) {
		$library_ajax_requests = [
			'classyea_get_library_data',
		];

		foreach ( $library_ajax_requests as $ajax_request ) {
			$ajax->register_ajax_action( $ajax_request, function( $data ) use ( $ajax_request ) {
				return self::handle_ajax_request( $ajax_request, $data );
			} );
		}
	}

	/**
	 * Handle ajax request.
	 *
	 * @since 1.6.0
	 * @access private
	 *
	 * @param string $ajax_request Ajax request.
	 * @param array  $data Elementor data.
	 *
	 * @return mixed
	 * @throws \Exception Throws error message.
	 */
	private static function handle_ajax_request( $ajax_request, array $data ) {
		if ( ! User::is_current_user_can_edit_post_type( Source_Local::CPT ) ) {
			throw new \Exception( 'Access Denied' );
		}

		if ( ! empty( $data['editor_post_id'] ) ) {
			$editor_post_id = absint( $data['editor_post_id'] );

			if ( ! get_post( $editor_post_id ) ) {
				throw new \Exception( __( 'Post not found.', 'classyea' ) );
			}

			Plugin::$instance->db->switch_to_post( $editor_post_id );
		}

		$result = call_user_func( [ __CLASS__, $ajax_request ], $data );

		if ( is_wp_error( $result ) ) {
			throw new \Exception( $result->get_error_message() );
		}

		return $result;
	}

	/**
	 * Get library data.
	 *
	 * Get data for template library.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param array $args Arguments.
	 *
	 * @return array Collection of templates data.
	 */
	public static function classyea_get_library_data( array $args ) {
		
		$library_data = self::get_library_data( ! empty( $args['sync'] ) );

		// Ensure all document are registered.
		Plugin::$instance->documents->get_document_types();

		return [
			'templates' => self::get_templates(),
			'config' => $library_data['types_data'],
		];
	}

	/**
	 * Get templates.
	 *
	 * Retrieve all the templates registered sources.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return array Templates array.
	 */
	public static function get_templates() {
		$source = Plugin::$instance->templates_manager->get_source( 'classyea' );
		return $source->get_items();
	}

	/**
	 * Ajax reset API data.
	 *
	 * Reset Elementor library API data using an ajax call.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 */
	public static function ajax_reset_api_data() {
		check_ajax_referer( 'elementor_reset_library', '_nonce' );

		self::get_templates_data( true );

		wp_send_json_success();
	}

	/**
	 * This function the templates data.
	 *
	 * @since 1.6.0
	 * @access private
	 * @static
	 *
	 * @param bool $force_update Optional option data
	 *
	 * @return array|false Templates data true or false.
	 */
	private static function get_templates_data( $force_update = false ) {
		$cache_key = 'classy_template_data_' . CLASSYEA_VERSION;

		$templates_data = get_transient( $cache_key );
		
		
		if ( $force_update || false === $templates_data ) {
			$timeout = ( $force_update ) ? 25 : 8;
			$response = wp_remote_get( self::$api_url, [
				'timeout' => $timeout,
				'body' => [
					'api_version' => CLASSYEA_VERSION,
					'site_lang' => get_bloginfo( 'language' ),
				],
			] );
			
			if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
				 set_transient( $cache_key, [], 2 * HOUR_IN_SECONDS );

				return false;
			}

			$templates_data = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $templates_data ) || ! is_array( $templates_data ) ) {
				set_transient( $cache_key, [], 2 * HOUR_IN_SECONDS );

				return false;
			}

			if ( isset( $templates_data['library'] ) ) {
				update_option( self::LIBRARY_OPTION_KEY, $templates_data['library'], 'no' );

				unset( $templates_data['library'] );
			}

			set_transient( $cache_key, $templates_data, 12 * HOUR_IN_SECONDS );
		}

		return $templates_data;
	}

	/**
	 * Get templates data.
	 *
	 * Retrieve the templates data from a remote server.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 *
	 * @return array The templates data.
	 */
	public static function get_library_data( $force_update = false ) {
		self::get_templates_data( $force_update );

		$library_data = get_option( self::LIBRARY_OPTION_KEY );

		if ( empty( $library_data ) ) {
			return [];
		}

		return $library_data;
	}

	/** retrive template data
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 *
	 * @param int $template_id The template ID.
	 *
	 * @return object|\WP_Error The template content.
	 */
	public static function get_template_content( $template_id ) {

		$url = self::$api_url_single . '/' . $template_id;
		
		$license_key = null;

		$args = [
			'body' => [
				'api_version' 	=> self::$api_url_single, // Which API version is used.
				'license_key'	=> $license_key,
				'home_url' 		=> trailingslashit( home_url() ),
			],
			'timeout' => 25,
		];

		$response = wp_remote_get( $url, $args );
		
		if ( is_wp_error( $response ) ) {
			// @codingStandardsIgnoreStart WordPress.XSS.EscapeOutput.
			wp_die( $response, [
				'back_link' => true,
			] );
			// @codingStandardsIgnoreEnd WordPress.XSS.EscapeOutput.
		}

		$body = wp_remote_retrieve_body( $response );
		
		$response_code = (int) wp_remote_retrieve_response_code( $response );
		
		if ( ! $response_code ) {
			return new \WP_Error( 500, 'No Response' );
		}

		// Server sent a success message without content.
		if ( 'null' === $body ) {
			$body = true;
		}

		$as_array = true;
		$body = json_decode( $body, $as_array );
		if ( false === $body ) {
			return new \WP_Error( 422, 'Wrong Server Response' );
		}

		if ( 200 !== $response_code ) {
			// In case $as_array = true.
			$body = (object) $body;
			
			
			$message = isset( $body->message ) ? $body->message : wp_remote_retrieve_response_message( $response );
			$code = isset( $body->code ) ? $body->code : $response_code;

			return new \WP_Error( $code, $message );
		}

		return $body;
	}
	
	/**
	 * template rendaring data
	 *
	 * Library modal template.
	 *
	 * @since 1.6.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function classyea_template_rendering_func() {
		include_once CLASSYEA_PLUGIN_PATH  . 'includes/Template/classyea-template-list.php';
	}
}

Classyea_Templates_Lib::init();

/**
 * Custom source.
 */
class Classyea_Source extends Source_Base {
	/**
	 * Get remote template ID.
	 *
	 * Retrieve the remote template ID.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return string The remote template ID.
	 */

	public function get_id() {
		return 'classyea';
	}

	/**
	 * Get remote template title.
	 *
	 * Retrieve the remote template title.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @return string The remote template title.
	 */
	public function get_title() {
		return 'ClassyEa';
	}

	/**
	 * Register remote template data.
	 *
	 * Used to register custom template data like a post type, a taxonomy or any
	 * other data.
	 *
	 * @since 1.6.0
	 * @access public
	 */
	public function register_data() {}

	/**
	 * Get remote templates.
	 *
	 * Retrieve remote templates from Elementor.com servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param array $args Optional. Nou used in remote source.
	 *
	 * @return array Remote templates.
	 */
	public function get_items( $args = [] ) {
		$library_data = Classyea_Templates_Lib::get_library_data();
		
		$templates = [];

		if ( ! empty( $library_data['templates'] ) ) {
			foreach ( $library_data['templates'] as $template_data ) {
				$data = $this->prepare_template( $template_data );
				$templates[] = $data;
			}
		}

		return $templates;
	}

	/**
	 * Get remote template.
	 *
	 * Retrieve a single remote template from Elementor.com servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param int $template_id The template ID.
	 *
	 * @return array Remote template.
	 */
	public function get_item( $template_id ) {
		$templates = $this->get_items();
		
		return $templates[ $template_id ];
	}

	/**
	 * Save remote template.
	 *
	 * Remote template from Elementor.com servers cannot be saved on the
	 * database as they are retrieved from remote servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param array $template_data Remote template data.
	 *
	 * @return \WP_Error
	 */
	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to a remote source' );
	}

	/**
	 * Update remote template.
	 *
	 * Remote template from Elementor.com servers cannot be updated on the
	 * database as they are retrieved from remote servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param array $new_data New template data.
	 *
	 * @return \WP_Error
	 */
	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to a remote source' );
	}

	/**
	 * Delete remote template.
	 *
	 * Remote template from Elementor.com servers cannot be deleted from the
	 * database as they are retrieved from remote servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param int $template_id The template ID.
	 *
	 * @return \WP_Error
	 */
	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from a remote source' );
	}

	/**
	 * Export remote template.
	 *
	 * Remote template from Elementor.com servers cannot be exported from the
	 * database as they are retrieved from remote servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param int $template_id The template ID.
	 *
	 * @return \WP_Error
	 */
	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from a remote source' );
	}

	/**
	 * Get remote template data.
	 *
	 * Retrieve the data of a single remote template from Elementor.com servers.
	 *
	 * @since 1.6.0
	 * @access public
	 *
	 * @param array  $args    Custom template arguments.
	 * @param string $context Optional. The context. Default is `display`.
	 *
	 * @return array|\WP_Error Remote Template data.
	 */
	public function get_data( array $args, $context = 'display' ) {
		
		$data = Classyea_Templates_Lib::get_template_content( $args['template_id'] );
		
		if ( is_wp_error( $data ) ) {
			return $data;
		}

		$data = (array) $data;

		$data['content'] = $this->replace_elements_ids( $data['content'] );
		$data['content'] = $this->process_export_import_content( $data['content'], 'on_import' );
		
		$post_id = $args['editor_post_id'];
		$document = Plugin::$instance->documents->get( $post_id );

		$document = Plugin::$instance->documents->get( $post_id );
		if ( $document ) {
			$data['content'] = $document->get_elements_raw_data( $data['content'], true );
		}

		return $data;
	
	}
	/**
	 * prepare_template data
	 * @since 2.2.0
	 * @access private
	 */
	private function prepare_template( array $template_data ) {
		$favorite_templates = $this->get_user_meta( 'favorites' );
		return [
			'template_id' => $template_data['id'],
			'source' => $this->get_id(),
			'type' => $template_data['type'],
			'subtype' => $template_data['subtype'],
			'title' => $template_data['title'],
			'thumbnail' => $template_data['thumbnail'],
			'date' => $template_data['tmpl_created'],
			'author' => $template_data['author'],
			'tags' => json_decode( $template_data['tags'] ),
			'isPro' => $template_data['is_pro'],
			'url' => $template_data['url'],
			'favorite' => ! empty( $favorite_templates[ $template_data['id'] ] ),
		];
	}
}