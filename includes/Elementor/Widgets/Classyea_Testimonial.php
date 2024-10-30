<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \ClassyEa\Helper\Elementor\Settings\Header;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Testimonial Widget
 */
class Classyea_Testimonial extends Widget_Base
{

	/**
	 * Retrieve testimonial widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-testimonial-widget';
	}
	/**
	 * Retrieve testimonial widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Testimonial', 'classyea');
	}
	/**
	 * Retrieve testimonial widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-testimonial';
	}
	/**
	 * Retrieve testimonial widget category.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea'];
	}

	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}

	public function get_script_depends()
	{
		return [
			'classyea-owl-carousel',
			'classyea-bxslider-script',
			'classyea-testimonial-script',
		];
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return [
			'testimonial',
			'classy testimonial',
			'classy testimonials',
			'classyea star rating',
			'social proof',
			'classy review',
			'classy addons',
			'testimony',
			'review',
			'endorsement',
			'recommendation',
			'reference',
			'appreciation',
			'feedback',
		];
	}
	/**
	 * Register testimonial widget controls.
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_testimonial_controls();
		$this->register_repeater_testimonial_controls();
		$this->register_content_style_controls();

		/* Style Tab */
		$this->register_style_background_controls();
		$this->classyea_client_dot_style_controls();
		$this->classyea_nav_arrow();
	}
	protected function register_content_testimonial_controls()
	{

		/**
		 * Content Tab: testimonial
		 */
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}
		$this->add_control(
			'testimonial_layout',
			[
				'label'     => __('Layout', 'classyea'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'layout-1',
				'options'   => $layouts,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'image_item_gap',
			[
				'label'     => __('Item Gap', 'classyea'),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 10,
				'condition' => [
					'testimonial_layout' =>
					['layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6'],
				],
			]
		);
		$this->add_control(
			'classyea_testimonial_show_arrow',
			[
				'label'        => esc_html__('Show Arrow', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'classyea'),
				'label_off'    => esc_html__('No', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => ['testimonial_layout' => 'layout-3'],
			]
		);
		$this->add_control(
			'classyea_testimonial_left_arrows',
			[
				'label'     => esc_html__('Quote Arrow Icon', 'classyea'),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-quote-left',
					'library' => 'solid',
				],
				'condition' => [
					'classyea_testimonial_show_arrow' => 'yes',
					'testimonial_layout'  => 'layout-3',
				],
			]
		);
		$this->add_control(
			'infinite',
			[
				'label'        => __('infinite Loop?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __('Autoplay?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'       => __('Animation Speed', 'classyea'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __('2500', 'classyea'),
			)
		);

		$this->add_control(
			'classyea_nav_heading',
			[
				'label'     => __('Navigation', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'arrows',
			[
				'label'        => __('Enable Arrows?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'testimonial_layout' =>
					['layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6'],
				],
			]
		);

		$this->add_control(
			'dots',
			[
				'label'        => __('Enable Dots?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'testimonial_layout' =>
					['layout-1', 'layout-3', 'layout-4', 'layout-5', 'layout-6'],
				],
			]
		);
		$this->add_control(
			'rating_order_nmb',
			[
				'label'       => esc_html__('Rating Order Number', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('1', 'classyea'),
				'label_block' => true,
				'condition'   => ['testimonial_layout' => 'layout-6'],
			]
		);
		$this->add_control(
			'desc_order_nmb',
			[
				'label'       => esc_html__('Description Order Number', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('2', 'classyea'),
				'label_block' => true,
				'condition'   => ['testimonial_layout' => 'layout-6'],
			]
		);
		$this->add_control(
			'name_desc_order_nmb',
			[
				'label'       => esc_html__('Name/Description Order Number', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('3', 'classyea'),
				'label_block' => true,
				'condition'   => ['testimonial_layout' => 'layout-6'],
			]
		);
		
		$this->add_control(
			'author_order_nmb',
			[
				'label'       => esc_html__('Author Order Number', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('5', 'classyea'),
				'label_block' => true,
				'condition'   => ['testimonial_layout' => 'layout-6'],
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Repeater TAB
	 */
	protected function register_repeater_testimonial_controls()
	{

		/**
		 * Content Repeater: testimonial
		 */
		$this->start_controls_section(
			'section_service_item',
			[
				'label' => __('Testimonial', 'classyea'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'client_name',
			[
				'label'       => esc_html__('Client Name', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Maria Haze', 'classyea'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_name_tag',
			[
				'label'   => __('Select Name  Tag', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => __('H1', 'classyea'),
					'h2'   => __('H2', 'classyea'),
					'h3'   => __('H3', 'classyea'),
					'h4'   => __('H4', 'classyea'),
					'h5'   => __('H5', 'classyea'),
					'h6'   => __('H6', 'classyea'),
					'span' => __('Span', 'classyea'),
					'p'    => __('P', 'classyea'),
					'div'  => __('Div', 'classyea'),
				],
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label'       => esc_html__('Designation', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__('Designation', 'classyea'),
			]
		);
		$repeater->add_control(
			'testimonial_designation_tag',
			[
				'label'   => __('Select Designation  Tag', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1'   => __('H1', 'classyea'),
					'h2'   => __('H2', 'classyea'),
					'h3'   => __('H3', 'classyea'),
					'h4'   => __('H4', 'classyea'),
					'h5'   => __('H5', 'classyea'),
					'h6'   => __('H6', 'classyea'),
					'span' => __('Span', 'classyea'),
					'p'    => __('P', 'classyea'),
					'div'  => __('Div', 'classyea'),
				],
			]
		);
		$repeater->add_control(
			'enable_rating',
			[
				'label'   => esc_html__('Display Rating?', 'classyea'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'rating_number',
			[
				'label'     => __('Testimonial Rating', 'classyea'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'rating-five',
				'options'   => [
					'rating-one'   => __('1', 'classyea'),
					'rating-two'   => __('2', 'classyea'),
					'rating-three' => __('3', 'classyea'),
					'rating-four'  => __('4', 'classyea'),
					'rating-five'  => __('5', 'classyea'),
				],
				'condition' => [
					'enable_rating' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'classyea_client_image_enable_avatar',
			[
				'label'   => esc_html__('Display Avatar?', 'classyea'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'client_image',
			[
				'label'     => esc_html__('Client Avatar', 'classyea'),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'classyea_client_image_enable_avatar' => 'yes',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'client_image[url]!'                  => '',
					'classyea_client_image_enable_avatar' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'testimonial_description',
			[
				'label'   => esc_html__('Testimonial Description', 'classyea'),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Add testimonial description here. Edit and place your own text.', 'classyea'),
			]
		);
		$this->add_control(
			'testimonial_items',
			[
				'label'       => esc_html__('Testimonial Items', 'classyea'),
				'type'        => Controls_Manager::REPEATER,
				'separator'   => 'before',
				'title_field' => '{{ client_name }}',
				'default'     => [
					[
						'client_name' => esc_html__('Thomas Henry', 'classyea'),
						'content'     => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text', 'classyea'),
					],
					[
						'client_name' => esc_html__('David Smith', 'classyea'),
						'content'     => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text', 'classyea'),
					],
					[
						'client_name' => esc_html__('Mark Jhon', 'classyea'),
						'content'     => esc_html__('There are many variations of passages of Lorem Ipsum available', 'classyea'),
					],
				],
				'fields'      => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Background TAB
	 */
	protected function register_style_background_controls()
	{
		$this->start_controls_section(
			'classyea_section_testimonial_background_sett',
			[
				'label'     => esc_html__('Background', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_layout' =>
					['layout-2', 'layout-3', 'layout-4', 'layout-5', 'layout-6'],
				],
			]
		);
		$this->add_responsive_control(
			'classyea_content_padding',
			[
				'label'      => esc_html__('Content Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-two .inner-column' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
				'condition'  => ['testimonial_layout' => 'layout-2'],
			]
		);
		$this->add_control(
			'bg_backgroundcolor',
			[
				'label'     => __('Background', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testmonial_box_bg',
				'label'    => __('Background', 'classyea'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box,
				{{WRAPPER}} .classyea-testimonial-two .inner-column,{{WRAPPER}} .classyea-testimonial-box-301,{{WRAPPER}} .classyea-testimonial-block .inner-box',
			]
		);
		$this->add_control(
			'bg_backgroundcolorhover',
			[
				'label'     => __('Hover Background', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['testimonial_layout' => 'layout-5'],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'testmonial_box_bghover',
				'label'     => __('Background', 'classyea'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .classyea-testimonial-block .inner-box:hover',
				'condition' => ['testimonial_layout' => 'layout-5'],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_section_testimonial_shapebg_style_settings',
			[
				'label'     => esc_html__('Shape Background', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => ['testimonial_layout' => 'layout-5'],

			]
		);
		$this->add_control(
			'shape_background_heading',
			[
				'label'     => __('Shape Image', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testimonialhovershapebackground',
				'label'    => __('Hover Background', 'classyea'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .classyea-testimonial-block .inner-box:before',

			]
		);
		$this->add_control(
			'hover_shape_background_heading',
			[
				'label'     => __('Hover Shape Image', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testimonialshapehoverbg',
				'label'    => __('Hover Shape Background', 'classyea'),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .classyea-testimonial-block:hover .inner-box:before',

			]
		);
		$this->end_controls_section();
	}
	protected function register_content_style_controls()
	{

		/**
		 * Testimonial Review Rating
		 */
		$this->start_controls_section(
			'classyea_testimonial_ratting_style',
			[
				'label'     => esc_html__('Rating', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_layout' => ['layout-3', 'layout-2', 'layout-4', 'layout-6'],
				],
			]
		);
		/**
		 * Testimonial Review ratting Color
		 */
		$this->add_control(
			'classyea_testimonial_review_ratting_color',
			[
				'label'     => esc_html__('Normal Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#d8d8d8',
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-ratings' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .rating .fa'                        => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .rating .fa'                                                => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonial_rating_hightlight_color',
			[
				'label'     => esc_html__('Highlight Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-one i:nth-child(1)'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-two i:nth-child(1)'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-two i:nth-child(2)'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-three i:nth-child(1)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-three i:nth-child(2)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-three i:nth-child(3)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-four i:nth-child(1)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-four i:nth-child(2)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-four i:nth-child(3)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-four i:nth-child(4)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-five i:nth-child(1)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-five i:nth-child(2)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-five i:nth-child(3)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-five i:nth-child(4)'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-ratings-rating-five i:nth-child(5)'  => 'color: {{VALUE}};',

				],
				'condition' => ['testimonial_layout' => 'layout-3'],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_ratting_font_size',
			[
				'label'      => esc_html__('Font Size', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-ratings' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .rating .fa'                        => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .rating .fa'                                                => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_review_ratting_spacing',
			[
				'label'      => esc_html__('Review Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .rating .fa'                        => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .rating .fa'                                                => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_testimonial_quote_icon_style',
			[
				'label'     => esc_html__('Quote Icon', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => ['testimonial_layout' => 'layout-3'],
			]
		);
		$this->start_controls_tabs(
			'classyea_quote_icon_color_tabs'
		);
		$this->start_controls_tab(
			'classyea_quote_normal_color_tab',
			[
				'label' => esc_html__('Normal', 'classyea'),
			]
		);
		// Testimonial quote Color
		$this->add_responsive_control(
			'classyea_testimonial_section_quote_icon_color',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content i'                                                      => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review i'                         => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image .classyea-testimonial-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text'                                 => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_quote_icon_active_color_tab',
			[
				'label' => esc_html__('Hover', 'classyea'),
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_section_quote_active_color',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-304:hover .classyea-testimonial-item-content .classyea-testimonial-review i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'classyea_testimonial_quote_icon_color_tab_end',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);
		// Testimonial icon size
		$this->add_responsive_control(
			'classyea_icon_size_typography',
			[
				'label'      => esc_html__('Icon Size', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content i'                                                        => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review i'                           => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image .classyea-testimonial-icon'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text .classyea-testimonial-quote-start' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_quote_icon_margin_bottom',
			[
				'label'      => esc_html__('Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content i'                                                        => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review i'                           => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image .classyea-testimonial-icon'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text .classyea-testimonial-quote-start' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_quote_icon_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content i'                                                        => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review i'                           => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image .classyea-testimonial-icon'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text .classyea-testimonial-quote-start' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'classyea_icon_badge_background',
				'label'     => esc_html__('Background', 'classyea'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image .classyea-testimonial-icon',
				'condition' => [
					'testimonial_layout' => 'layout-3',
				],
			]
		);
		$this->end_controls_section();

		// description
		$this->start_controls_section(
			'classyea_testimonial_content_desc',
			[
				'label' => esc_html__('Description', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'classyea_testimonial_desc_color',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content > p'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review > p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-text > p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text > p'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item .classyea-testimonial-content > p'             => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-client-testimonials .text p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .text p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content .text p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'classyea_testimonial_desc_active_color',
			[
				'label'     => esc_html__('Hover Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-304:hover .classyea-testimonial-item-content .classyea-testimonial-review p:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-client-testimonials .text p:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .text p:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text p:hover'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content .text p:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-text > p:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'classyea_testimonial_desc_typography',
				'label'    => esc_html__('Typography', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content > p,{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review > p,{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-text > p,{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text > p,
				{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item .classyea-testimonial-content > p,
				{{WRAPPER}} .classyea-client-testimonials .text p,
				{{WRAPPER}} .classyea-testimonial-block-two .inner-box .text p,
				{{WRAPPER}} .classyea-testimonial-block .inner-box .content .text p',
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_desc_margin',
			[
				'label'      => esc_html__('Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .elementskit-single-testimonial-slider  .elementskit-commentor-content > p'                         => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .elementskit-testimonial_card .elementskit-commentor-coment'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content > p'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-content .classyea-testimonial-review > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-text > p'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-text > p'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item .classyea-testimonial-content > p'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-client-testimonials .text'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .text'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content .text'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// client name & designation
		$this->start_controls_section(
			'classyea_testimonial_client_content_section',
			[
				'label' => esc_html__('Name & Designation', 'classyea-elememtor-addons'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'classyea_testimonial_client_name_heading',
			[
				'label' => esc_html__('Client Name', 'classyea-elememtor-addons'),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'classyea_testimonial_client_name_normal_color',
			[
				'label'     => esc_html__('Color', 'classyea-elememtor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content .classyea-testimonial-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-name' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-box-301 .classyea-testimonial-author-details .classyea-testimonial-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-name' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item .classyea-testimonial-content .classyea-testimonial-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-client-testimonials .classyea-testimonial-name' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .classyea-testimonial-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'classyea_testimonial_client_name_active_color',
			[
				'label'     => esc_html__('Hover Color', 'classyea-elememtor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-304:hover .classyea-testimonial-name'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-item-303:hover .classyea-testimonial-item-content .classyea-testimonial-name' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-item-303:hover .classyea-testimonial-box-301 .classyea-testimonial-author-details .classyea-testimonial-name'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-302:hover .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-name:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-305:hover .classyea-testimonial-item .classyea-testimonial-content .classyea-testimonial-name:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-client-testimonials .classyea-testimonial-name:hover'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .classyea-testimonial-name:hover'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3:hover'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author-details h3.classyea-testimonial-author-name:hover'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'classyea_testimonial_client_name_typography',
				'selector' => '{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content .classyea-testimonial-name,
				{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-name,
				{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-box-301 .classyea-testimonial-author-details .classyea-testimonial-name,
				{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-name,
				{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item .classyea-testimonial-content .classyea-testimonial-name,
				{{WRAPPER}} .classyea-client-testimonials .classyea-testimonial-name,
				{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .classyea-testimonial-name,{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3',

			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_client_name_spacing_bottom',
			[
				'label'      => esc_html__('Margin Bottom', 'classyea-elememtor-addons'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-name'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-content .classyea-testimonial-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-box-301 .classyea-testimonial-author-details .classyea-testimonial-name'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item .classyea-testimonial-content .classyea-testimonial-name'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-client-testimonials .classyea-testimonial-name'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .classyea-testimonial-name'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3'  => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .layout-six .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'classyea_testimonial_client_designation_heading',
			[
				'label'     => esc_html__('Client Designation', 'classyea-elememtor-addons'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'classyea_testimonial_designation_normal_color',
			[
				'label'     => esc_html__('Color', 'classyea-elememtor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-designation'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author-details .classyea-testimonial-designation'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-designation' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .location'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3 span'   => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'classyea_testimonial_designation_active_color',
			[
				'label'     => esc_html__('Hover Color', 'classyea-elememtor-addons'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-304:hover .classyea-testimonial-designation'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-301:hover .classyea-testimonial-author-details .classyea-testimonial-designation'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-box-302:hover .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-designation' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .location:hover'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3 span:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'classyea_testimonial_designation_typography',
				'selector' => '{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-designation,{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author-details .classyea-testimonial-designation,
				{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-designation,{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .location,{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3 span',
			]
		);

		$this->add_responsive_control(
			'classyea_testimonial_client_spacing',
			[
				'label'      => esc_html__('Margin', 'classyea-elememtor-addons'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .elementskit-commentor-bio'                                                                                                                 => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					'{{WRAPPER}} .classyea-testimonial-item-304:hover .classyea-testimonial-designation'                                                                     => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301:hover .classyea-testimonial-author-details .classyea-testimonial-designation'                                 => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302:hover .classyea-testimonial-inner-box .classyea-testimonial-author-details .classyea-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box .upper-box .location'                                                                            => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-block .inner-box .content h3 span'                                                                                    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_section_testimonial_image_styles',
			[
				'label' => esc_html__('Client Image', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_content_right_image_padding',
			[
				'label'      => esc_html__('Content Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'description'	 => esc_html__( 'Only use for layout two', 'classyea' ),
				'default'    => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '250',
                    'unit' => 'px',
                    'isLinked' => '',
                ],
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-block-two .inner-box'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				],
				'condition' => [
					'testimonial_layout' => 'layout-2'],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_image_width',
			[
				'label'      => esc_html__('Image Width', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => ['%', 'px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                 => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                 => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img' => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image'  => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                          => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image'     => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                          => 'width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                                => 'width:{{SIZE}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_max_image_width',
			[
				'label'      => esc_html__('Image Max Width', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '',
					'unit' => '%',
				],
				'range'      => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                => 'max-width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                => 'max-width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image' => 'max-width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                         => 'max-width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image'    => 'max-width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                         => 'max-width:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                               => 'max-width:{{SIZE}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_image_margin',
			[
				'label'      => esc_html__('Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                             => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                             => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                                   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_image_height',
			[
				'label'      => esc_html__('Image Height', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => ['%', 'px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                 => 'height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                 => 'height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img' => 'height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image'  => 'height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                          => 'height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                          => 'height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                                => 'height:{{SIZE}}{{UNIT}}!important;',

				],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_image_max_height',
			[
				'label'      => esc_html__('Image Min Height', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'range'      => [
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => ['%', 'px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                 => 'min-height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                 => 'min-height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img' => 'min-height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image'  => 'min-height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                          => 'min-height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                          => 'min-height:{{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                                => 'min-height:{{SIZE}}{{UNIT}}!important;',

				],
			]
		);
		$this->add_responsive_control(
			'classyea_testimonial_image_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                             => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                             => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                                   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_testimonial_image_border',
				'label'    => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img,{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img,{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img,{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img,{{WRAPPER}} .classyea-client-testimonials figure img,{{WRAPPER}} .classyea-testimonial-item-img img',
			]
		);
		$this->add_control(
			'classyea_testimonial_image_rounded',
			[
				'label'        => esc_html__('Rounded Avatar?', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'testimonial-avatar-rounded',
				'default'      => '',
			]
		);
		$this->add_control(
			'classyea_testimonial_image_border_radius',
			[
				'label'     => esc_html__('Border Radius', 'classyea'),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .classyea-testimonial-item-303 .classyea-testimonial-item-img img'                                    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .classyea-testimonial-item-304 .classyea-testimonial-item-img img'                                    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .classyea-testimonial-box-301 .classyea-testimonial-author .classyea-testimonial-author-image img'    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .classyea-testimonial-box-302 .classyea-testimonial-inner-box .classyea-testimonial-author-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .classyea-testimonial-305 .classyea-testimonial-item img'                                             => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .classyea-client-testimonials figure img'                                                             => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .classyea-testimonial-item-img img'                                                                   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
				'condition' => [
					'classyea_testimonial_image_rounded!' => 'testimonial-avatar-rounded',
				],
			]
		);
		$this->end_controls_section();
	}
	protected function classyea_client_dot_style_controls()
	{
		$this->start_controls_section(
			'classyea_testimonial_navigation_dots',
			[
				'label'     => __('Navigation - Dots', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_layout' =>
					['layout-1', 'layout-3', 'layout-4', 'layout-5', 'layout-6'],
				],
			]
		);

		$this->add_responsive_control(
			'dots_nav_spacing',
			[
				'label'      => __('Spacing', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-item'      => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dots span' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dots span' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dots span'              => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
				],
			]
		);

		$this->add_responsive_control(
			'dots_nav_align',
			[
				'label'       => __('Alignment', 'classyea'),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => __('Left', 'classyea'),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'classyea'),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __('Right', 'classyea'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager'                => 'text-align: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dots' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dots' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dots'              => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->start_controls_tabs('_tabs_dots');
		$this->start_controls_tab(
			'classyea_tab_dots_normal',
			[
				'label' => __('Normal', 'classyea'),
			]
		);

		$this->add_control(
			'dots_nav_size',
			[
				'label'      => __('Width', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link'      => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dots span' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dots span' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dots span'              => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_nav_heigt_size',
			[
				'label'      => __('Height', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link'      => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dots span' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dots span' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dots span'              => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_nav_color',
			[
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link'      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dots span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dots span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dots span'              => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_tab_dots_hover',
			[
				'label' => __('Hover', 'classyea'),
			]
		);

		$this->add_control(
			'dots_nav_hover_color',
			[
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link:hover'      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dots span:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dots span:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dots span:hover'              => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_tab_dots_active',
			[
				'label' => __('Active', 'classyea'),
			]
		);

		$this->add_control(
			'dots_nav_active_size',
			[
				'label'      => __('Width', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link.active'     => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dot.active span'              => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_nav_heigt_active_size',
			[
				'label'      => __('Height', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link.active'     => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dot.active span'              => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dots_nav_active_color',
			[
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-client-testimonials .bx-pager .bx-pager-link.active'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-dot.active span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-dot.active span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-design-five.owl-theme .owl-dot.active span'              => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function classyea_nav_arrow()
	{
		$this->start_controls_section(
			'classyea_carousel_navigation_arrow',
			[
				'label'     => esc_html__('Navigation - Arrow', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_layout' =>
					['layout-2', 'layout-3', 'layout-4', 'layout-6'],
				],
			]
		);

		$this->add_control(
			'arrow_position_toggle',
			[
				'label'        => __('Position', 'classyea'),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __('None', 'classyea'),
				'label_on'     => __('Custom', 'classyea'),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'arrow_position_y',
			[
				'label'      => __('Vertical', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition'  => [
					'arrow_position_toggle' => 'yes',
				],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%'  => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_position_x',
			[
				'label'      => __('Horizontal', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition'  => [
					'arrow_position_toggle' => 'yes',
				],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%'  => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .owl-theme .owl-nav button.owl-prev'                                        => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-theme .owl-nav button.owl-next'                                        => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev'      => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next'      => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev'      => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();
		$this->add_responsive_control(
			'dots_owl_nav_align',
			[
				'label'       => __('Alignment', 'classyea'),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => __('Left', 'classyea'),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'classyea'),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __('Right', 'classyea'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'toggle'      => true,
				'selectors'   => [
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'arrow_border_radius',
			[
				'label'      => __('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev, .classyea-testimonial-two .inner-column .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev, .classyea-testimonial-two .inner-column .owl-nav .owl-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span'                                             => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span'                                             => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span'                                             => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span'                                             => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('_tabs_nav_arrow');
		$this->start_controls_tab(
			'classyea_tab_navs_normal',
			[
				'label' => __('Normal', 'classyea'),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'field_border',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev, .classyea-testimonial-two .inner-column .owl-nav .owl-next,
				{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span,
				{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span,
				{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span,
				{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span',
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev'                 => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-next'                  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}!important',
				),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev, .classyea-testimonial-two .inner-column .owl-nav .owl-next' => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span'                                             => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span'                                             => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span'                                             => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span'                                             => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_tab_arrows_hover_color',
			[
				'label' => __('Hover', 'classyea'),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'field_border_hover',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev:hover, .classyea-testimonial-two .inner-column .owl-nav .owl-next:hover,
				{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span,
				{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span,
				{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span,
				{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span',
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'arrow_bg_hover_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev:hover, .classyea-testimonial-two .inner-column .owl-nav .owl-next:hover' => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span:hover'                                                   => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span:hover'                                                   => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span:hover'                                                   => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span:hover'                                                   => 'background-color: {{VALUE}}!important',
				),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-testimonial-two .inner-column .owl-nav .owl-prev:hover, .classyea-testimonial-two .inner-column .owl-nav .owl-next:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-prev span:hover'                                                   => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-302.owl-theme .owl-nav button.owl-next span:hover'                                                   => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-prev span:hover'                                                   => 'color: {{VALUE}}',
					'{{WRAPPER}} #classyea-testimonial-box-main-304.owl-theme .owl-nav button.owl-next span:hover'                                                   => 'color: {{VALUE}}',

				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$autoplay_speed     = $settings['autoplay_speed'];
		$testimonial_layout = $settings['testimonial_layout'];

		$image_item_gap = '30';
		if ($testimonial_layout == 'layout-6' || $testimonial_layout == 'layout-2' || $testimonial_layout == 'layout-3' || $testimonial_layout == 'layout-4' || $testimonial_layout == 'layout-5' ) {
			$image_item_gap = $settings['image_item_gap'];
		}

		if ($settings['infinite'] == 'yes') {
			$infiinite = true;
		} else {
			$infiinite = false;
		}

		if ($settings['autoplay'] == 'yes') {
			$autoplay = true;
		} else {
			$autoplay = false;
		}
		$dots = '';
		if ($testimonial_layout != 'layout-2') {
			if ($settings['dots'] == 'yes') {
				$dots = true;
			} else {
				$dots = false;
			}
		}
		$arrows = '';
		if ($testimonial_layout != 'layout-1' && $testimonial_layout != 'layout-5') {

			if ($settings['arrows'] == 'yes') {
				$arrows = true;
			} else {
				$arrows = false;
			}
		}

		$changed_atts = array(
			'infinite'       => $infiinite,
			'autoplay'       => $autoplay,
			'autoplaySpeed'  => $autoplay_speed,
			'dots'           => $dots,
			'arrows'         => $arrows,
			'image_item_gap' => $image_item_gap,
		);

		$testimonial_layout = $settings['testimonial_layout'];
		$section_class      = 'classyea-testimonial-bgclass';
		switch ($testimonial_layout) {
			case 'layout-1':
				$section_id = 'classyea-testimonial-box-303';
				break;
			case 'layout-2':
				$section_id = 'classyea-testimonial-box-304';
				break;
			case 'layout-3':
				$section_id    = 'classyea-testimonial-box-main-304';
				$section_class = 'classyea-two-item-owlcarousel owl-carousel owl-theme';
				break;
			case 'layout-4':
				$section_id    = 'classyea-testimonial-box-main-302';
				$section_class = 'classyea-three-item-carousel owl-carousel owl-theme';
				break;
			case 'layout-5':
				$section_id    = '';
				$section_class = 'classyea-testimonial-bgclass classyea-testimonial-305';
				break;
			case 'layout-6':
				$section_id    = 'classyea-testimonial-box-main-302';
				$section_class = 'classyea-three-item-carousel owl-carousel owl-theme layout-six';
				break;
			default:
				$section_id = 'classyea-testimonial-section-203';
		}

		if ($testimonial_layout == 'layout-1') { ?>
			<!-- Client Testimonials -->
			<section class="classyea-client-testimonials" id="testimonial_client" data-testimonial='<?php echo wp_json_encode($changed_atts); ?>'>
				<div class="client-item">
					<?php $this->classyea_render_testimonial_repeater_control(); ?>
				</div>
			</section>
				<!--End Client Testimonials-->
			<?php } elseif ($testimonial_layout == 'layout-2') { ?>
				<!-- Right Column -->
				<div class="classyea-testimonial-two" id="testimonial_two" data-testimonial='<?php echo wp_json_encode($changed_atts); ?>'>
					<div class="inner-column">
						<div class="classyea-two-item-carousel owl-carousel owl-theme">
							<?php $this->classyea_render_testimonial_repeater_control(); ?>
						</div>
					</div>
				</div>

				<!-- End Fullwidth Section Two -->
			<?php } elseif ($testimonial_layout == 'layout-5') { ?>
				<div class="classyea-design-five owl-carousel owl-theme" id="testimonial_five" data-testimonial='<?php echo wp_json_encode($changed_atts); ?>'>
					<?php echo $this->classyea_render_testimonial_repeater_control(); ?>
				</div>
			<?php } else { ?>
				<div id="<?php echo esc_attr($section_id); ?>" class="<?php echo esc_attr($section_class); ?>" data-testimonial='<?php echo wp_json_encode($changed_atts); ?>'>
					<?php $this->classyea_render_testimonial_repeater_control(); ?>
					<!-- end of .classyea-testimonial-item-303 -->
				</div>
				<?php
			}
		}
		/**
		 * Testimonial render name function
		 * Render testimonial name output on the frontend.
		 *
		 * @param [type] $testimonial_item
		 * @param [type] $index
		 * @access protected
		 */
		private function classyea_render_testimonial_name($testimonial_item, $index)
		{
			if ($testimonial_item['client_name']) {
				$this->add_inline_editing_attributes('client_name', 'none');
				$this->add_render_attribute('client_name', 'class', 'classyea-testimonial-name classyea-testimonial-author-name', $index);

				if ($testimonial_item['client_name']) {
					$name_tag = Header::classyea_validate_html_tag($testimonial_item['testimonial_name_tag']);
				?>
					<<?php echo esc_html($name_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('client_name')); ?>>
						<?php echo wp_kses($testimonial_item['client_name'], 'classyea_kses'); ?>
					</<?php echo esc_html($name_tag); ?>>
				<?php
				}
			}
		}
		/**
		 * Testimonial designation function
		 * Render testimonial designation output on the frontend.
		 * Written in PHP and used to generate the final HTML.
		 * @param [type] $testimonial_item
		 * @param [type] $index
		 * @access protected
		 */
		protected function classyea_render_testimonial_designation($testimonial_item, $index)
		{
			if ($testimonial_item['designation']) {
				$this->add_inline_editing_attributes('designation', 'none');
				$this->add_render_attribute('designation', 'class', 'classyea-testimonial-designation classyea-testimonial-author-desg location', $index);

				if ($testimonial_item['designation']) {
					$testimonial_designation_tag = Header::classyea_validate_html_tag($testimonial_item['testimonial_designation_tag']);
				?>
					<<?php echo esc_html($testimonial_designation_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('designation')); ?>>
						<?php echo wp_kses($testimonial_item['designation'], 'classyea_kses'); ?>
					</<?php echo esc_html($testimonial_designation_tag); ?>>
				<?php
				}
			}
		}
		/**
		 * Testimonial repeater control function
		 * Render counterup repeater output on the frontend.
		 * @access protected
		 */
		private function classyea_render_testimonial_repeater_control()
		{
			$settings           = $this->get_settings_for_display();
			$testimonial_items  = $settings['testimonial_items'];
			$testimonial_layout = $settings['testimonial_layout'];
			$show_arrow         = $settings['classyea_testimonial_show_arrow'];
			$image_item_gap     = ( $settings['image_item_gap'] ? $settings['image_item_gap'] : '' );

			

				$rating_order_nmb      = ($settings['rating_order_nmb'] ? $settings['rating_order_nmb'] : '');
				$desc_order_nmb        = ($settings['desc_order_nmb'] ? $settings['desc_order_nmb'] : '');
				$name_desc_order_nmb   = ($settings['name_desc_order_nmb'] ? $settings['name_desc_order_nmb'] : '');
				$author_order_nmb      = ($settings['author_order_nmb'] ? $settings['author_order_nmb'] : '');
			
	

			$item = 1;
			foreach ($testimonial_items as $index => $testimonial_item) {
				if ($testimonial_layout == 'layout-1') { ?>
					<article class="slide">
						<figure>
							<?php $this->classyea_render_testimonial_image($testimonial_item); ?>
						</figure>
						<?php $this->classyea_render_testimonial_name($testimonial_item, $index); ?>
						<div class="text">
							<?php echo $this->classyea_testimonial_desc($testimonial_item); ?>
						</div>
					</article>
				<?php } elseif ($testimonial_layout == 'layout-2') { ?>
					<!-- Testimonial Block Two -->
					<div class="classyea-testimonial-block-two">
						<div class="inner-box">
							<div class="image">
								<?php $this->classyea_render_testimonial_image($testimonial_item); ?>
							</div>
							<div class="upper-box">
								<div class="clearfix">
									<div class="pull-left">
										<?php
										$this->classyea_render_testimonial_name($testimonial_item, $index);
										$this->classyea_render_testimonial_designation($testimonial_item, $index); ?>
									</div>
									<?php
									$enable_rating = $testimonial_item['enable_rating'];
									if ($enable_rating == 'yes') {
									?>
										<div class="pull-right">
											<div class="rating">
												<?php
												$this->classyea_rating_number($testimonial_item)
												?>
											</div>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="text"><?php echo $this->classyea_testimonial_desc($testimonial_item); ?></div>
						</div>
					</div>
				<?php } elseif ($testimonial_layout == 'layout-3') { ?>
					<div class="classyea-testimonial-box-301 elementor-repeater-item-<?php echo esc_attr($testimonial_item['_id']); ?>">
						<div class="classyea-testimonial-author">
							<div class="classyea-testimonial-author-image">
								<?php $this->classyea_render_testimonial_image($testimonial_item);
								if ($show_arrow == 'yes') {
								?>
									<span class="classyea-testimonial-icon">
										<?php
										$this->classyea_testimonial_quote_left($settings); ?>
									</span>
								<?php } ?>
							</div>
							<?php $this->classyea_render_testimonial_rating($testimonial_item); ?>
						</div>

						<div class="classyea-testimonial-text">
							<?php $this->classyea_testimonial_desc($testimonial_item); ?>
						</div>
						<div class="classyea-testimonial-author-details">
							<?php $this->classyea_render_testimonial_name($testimonial_item, $index);
							$this->classyea_render_testimonial_designation($testimonial_item, $index); ?>
						</div>
					</div>
				<?php } elseif ($testimonial_layout == 'layout-4' || $testimonial_layout == 'layout-6') { ?>
					<div class="classyea-testimonial-box-302 elementor-repeater-item-<?php echo esc_attr($testimonial_item['_id']); ?>">

						<div class="classyea-testimonial-inner-box">
							<?php
							$enable_rating = $testimonial_item['enable_rating'];
							if ($enable_rating == 'yes') {
							?>
								<div class="rating" style="order: <?php echo esc_attr($rating_order_nmb);?>">
									<?php
									$this->classyea_rating_number($testimonial_item)
									?>
								</div>
							<?php } ?>
							<div class="classyea-testimonial-text" style="order: <?php echo esc_attr($desc_order_nmb);?>">
								<?php $this->classyea_testimonial_desc($testimonial_item); ?>
							</div>
							<div class="classyea-testimonial-author-image" style="order:<?php echo esc_attr($author_order_nmb);?> ">
								<?php $this->classyea_render_testimonial_image($testimonial_item); ?>
							</div>
							<div class="classyea-testimonial-author-details" style="order: <?php echo esc_attr($name_desc_order_nmb);?> ">
								<?php $this->classyea_render_testimonial_name($testimonial_item, $index);
								$this->classyea_render_testimonial_designation($testimonial_item, $index); ?>
							</div>
						</div>
					</div>
				<?php } elseif ($testimonial_layout == 'layout-5') { ?>
					<div class="classyea-testimonial-block elementor-repeater-item-<?php echo esc_attr($testimonial_item['_id']); ?>">
						<div class="inner-box">
							<div class="content">
								<div class="image">
									<?php $this->classyea_render_testimonial_image($testimonial_item); ?>
								</div>
								<h3><?php echo wp_kses($testimonial_item['client_name'], 'classyea_kses'); ?> - <span><?php echo wp_kses($testimonial_item['designation'], 'classyea_kses'); ?></span></h3>
								<div class="text"><?php $this->classyea_testimonial_desc($testimonial_item); ?></div>
							</div>
						</div>
					</div>
			<?php }
				$item++;
				if ($item > 2) {
					$item = 1;
				}
			} // endif
		}
		/**
		 * Testimonial designation function
		 * Render testimonial description output on the frontend.
		 * @param [type] $testimonial_item
		 * @access protected
		 */
		protected function classyea_testimonial_desc($testimonial_item)
		{
			$testimonial_desc = $testimonial_item['testimonial_description']; ?>
			<p><?php echo wp_kses($testimonial_desc, 'classyea_kses'); ?></p>
			<?php }
		/**
		 * Testimonial rating function
		 * Render testimonial rating output on the frontend.
		 * @param [type] $testimonial_item
		 * @access protected
		 */
		protected function classyea_render_testimonial_rating($testimonial_item)
		{
			$enable_rating = $testimonial_item['enable_rating'];
			if ($enable_rating == 'yes') :
			?>
				<div class="classyea-testimonial-ratings classyea-testimonial-ratings-<?php echo esc_attr($testimonial_item['rating_number']); ?>">
					<i class="fas fa fa-star" aria-hidden="true"></i>
					<i class="fas fa fa-star" aria-hidden="true"></i>
					<i class="fas fa fa-star" aria-hidden="true"></i>
					<i class="fas fa fa-star" aria-hidden="true"></i>
					<i class="fas fa fa-star" aria-hidden="true"></i>
				</div>
			<?php
			endif;
		}

		/**
		 * Undocumented function
		 *
		 * @param [type] rating function
		 * @return void
		 */
		protected function classyea_rating_number($testimonial_item)
		{

			$rating = $testimonial_item['rating_number'];
			if ($rating == 'rating-four') {
				$rating = 4;
			}
			if ($rating == 'rating-three') {
				$rating = 3;
			}
			if ($rating == 'rating-two') {
				$rating = 2;
			}
			if ($rating == 'rating-one') {
				$rating = 1;
			}
			if ($rating == 'rating-five') {
				$rating = 5;
			}
			$total_rating = 5;
			for ($i = 1; $i <= $total_rating; $i++) {
				if ($rating < $i) {
					echo '<span class="fa fa-star-o"></span>';
				} else {
					echo '<span class="fa fa-star"></span>';
				}
			}
		}
		/**
		 * Testimonial image function
		 * Render testimonial image output on the frontend.
		 * @param [type] $testimonial_item
		 * @access protected
		 */
		protected function classyea_render_testimonial_image($testimonial_item)
		{
			if ('yes' == $testimonial_item['classyea_client_image_enable_avatar']) :
			?>
				<div class="classyea-testimonial-item-img">
					<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($testimonial_item, 'thumbnail', 'client_image'), 'classyea_img'); ?>
				</div>
				<?php

			endif;
		}
		/**
		 * Testimonial Quote Left function
		 * Render testimonial left quote output on the frontend.
		 * @param [type] $settings
		 * @access protected
		 */
		protected function classyea_testimonial_quote_left($settings)
		{

			$testimonial_layout = $settings['testimonial_layout'];
			if ($testimonial_layout == 'layout-3') {
				if (!isset($settings['icon']) && !\Elementor\Icons_Manager::is_migration_allowed()) {
					$settings['icon'] = 'fa fa-star';
				}
				$migrated = isset($settings['__fa4_migrated']['classyea_testimonial_left_arrows']);
				$is_new   = !isset($settings['icon']) && \Elementor\Icons_Manager::is_migration_allowed();
				if ($is_new || $migrated) {
					\Elementor\Icons_Manager::render_icon($settings['classyea_testimonial_left_arrows'], array('aria-hidden' => 'true'));
				} else {
				?>
					<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
	<?php }
			}
		}
	}
