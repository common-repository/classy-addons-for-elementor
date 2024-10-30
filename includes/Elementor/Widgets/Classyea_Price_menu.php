<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Typography;
use \Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Animated Link Widget
 */
class Classyea_Price_menu extends Widget_Base {

	/**
	 * Retrieve Animated Link widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'classyea-price-menu';
	}

	/**
	 * Retrieve Animated Link widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__('Classyea Price Menu', 'classyea');
	}

	/**
	 * Retrieve Animated Link widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-animated-headline classyea';
	}

	/**
	 * Retrieve Animated Link widget category.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_categories(){
		return ['classyea'];
	}

	public function get_style_depends()
	{
		return [
           'classyea-fontawesome-five',
        ];
	}

	

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords(){
		return [
			'animated',
			'classy animated',
			'animated link',
			'animated text',
			'animated link widget',
			'classy',
			'classy addons',
			'classyea animated link'

		];
	}

	/**
	 * Register service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @access protected
	 */
	protected function register_controls(){
		/* Content Tab */
		$this->register_content_service_controls();

	}

	protected function register_content_service_controls(){

        $this->start_controls_section(
			'clad_blog_posts_layout',
			[
				'label' => esc_html__( 'Layout Options', 'classyea' ),
			]
		);
		$this->end_controls_section();
 
	}

	protected function render() {
			$settings = $this->get_settings_for_display();
		?>
			price menu
		<?php
	}
}