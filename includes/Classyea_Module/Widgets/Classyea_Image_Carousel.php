<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \ClassyEa\Helper\Classyea_Module\Settings\Classyea_Helper;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Image Carousel Widget
 */
class Classyea_Image_Carousel extends Widget_Base
{

	/**
	 * Retrieve Image Carousel widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-image-carousel';
	}
	/**
	 * Retrieve Image Carousel widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Image Carousel', 'classyea');
	}
	/**
	 * Retrieve Image Carousel widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-slider-push classyea';
	}
	/**
	 * Retrieve Image Carousel widget category.
	 * @access public
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
	/**
	 * Get widget keywords.
	 * widget keywords of the belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return [
			'image carousel',
			'carousel',
			'slider carousel',
			'classyea image carousel',
			'classy carousel',
			'unlimited carousel',
		];
	}
	public function get_script_depends() {
		return [
			'classyea-jquery-simpleslider',
			'classyea-owl-carousel',
			'classyea-image-carousel'
		];
	}
	/**
	 * Register Image Carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->classyea_reg_carousel_setting_control();

		/* Style Tab */
		$this->classyea_repeater_slider_control();
		/** style image tab */
		$this->classyea_style_control_func();
		$this->classyea_slider_dot_style_controls();
		$this->classyea_slider_nav_style_controls();
	}
	protected function classyea_reg_carousel_setting_control()
	{

		/**
		 * Content Tab: Image carousel
		 */
		$this->start_controls_section(
			'section_carousel_setting',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}
		$this->add_control(
			'carousel_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);
		$this->add_control(
			'infinite',
			[
				'label' => __( 'infinite Loop?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'no',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						
					),
				)
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						
					),
				)
			]
		);
		$this->add_control(
			'autoplay_speed',
			array(
				'label'       => __( 'Animation Speed', 'classyea' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '2500', 'classyea' ),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						
					),
				)
			)
		);
		$this->add_control(
            'classyea_nav_heading',
            [
                'label' => __('Navigation', 'classyea'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Enable Arrows?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						
					),
				)
			]
		);
		$this->add_control(
			'enable_navigation',
			[
				'label' => __( 'Enable Navigation?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						
					),
				)
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Enable Dots?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => '',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						
					),
				)
			]
		);
		$this->add_control(
			'image_center',
			[
				'label' => __( 'Center Enable?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => '',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						
					),
				)
			]
		);
		$this->end_controls_section();
	}
	/**
	 *	Repeater TAB
	 **/
	protected function classyea_repeater_slider_control()
	{

		$this->start_controls_section(
			'section_carousel_repeater_control',
			[
				'label'                 => __('Slider', 'classyea'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'carousel_image',
			[
				'label'                 => esc_html__('Choose Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		$repeater->add_control(
			'hotspot_link',
			array(
				'label'       => __('Link', 'classyea'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => 'https://www.your-link.com',
				'default'     => array(
					'url' => '#',
				),
				'separator'   => 'before',
			)
		);
		$repeater->add_control(
			'title_subtitle_on_off',
			array(
				'label'        => __('Title Subtitle ON/OFF', 'classyea'),
				'description'  => __('Use for design four & five','classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
			)
		);
		$repeater->add_control(
            'title_and_typography',
            [
                'label' => __('Title & Subtitle', 'classyea'),
				'description'  => __('Use for design four & five','classyea'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['title_subtitle_on_off' => 'yes']
            ]
        );
		$repeater->add_control(
			'slider_title',
			array(
				'type'        => Controls_Manager::TEXT,
				'description'  => __('Use for design four & five','classyea'),
				'label_block' => true,
				'default'     => __('Pamukalle, Turkey', 'classyea'),
				'condition' => ['title_subtitle_on_off' => 'yes']
			)
		);
		$repeater->add_control(
			'title_tag',
			[
				'label'   => __('Select Title Tag', 'classyea'),
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
				'condition' => ['title_subtitle_on_off' => 'yes']
			]
		);
		$repeater->add_control(
			'slider_subtitle',
			array(
				'type'       => Controls_Manager::TEXTAREA,
				'description'  => __('Use for design four & five','classyea'),
				'default'    => __('Some text here', 'classyea'),
				'condition' => ['title_subtitle_on_off' => 'yes']
			)
		);
		$this->add_control(
			'slider_item',
			[
				'label'                 => __('Add Slider Item', 'classyea'),
				'type'                  => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'slider_title' => __('Slider #1', 'classyea'),
					),
				),
				'fields'                => $repeater->get_controls(),
				'title_field' => '{{{ slider_title }}}',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
			]
		);
		$this->end_controls_section();
	}
	protected function classyea_style_control_func(){
		$this->start_controls_section(
			'classyea_carousel_style_settings',
			[
				'label' => esc_html__('Carousel Item', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'image_item_gap',
			[
				'label' => __( 'Item Gap', 'classyea' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'default' => 10,
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
					),
				)
			]
		);
		$this->add_control(
			'carousel_border_radius',
			[
				'label' => __('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-801 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-carousel-wrapper-802 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-805 li img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .sliders-carousel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_slide_content_settings',
			[
				'label' => esc_html__('Slide Content', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '==',
							'value'    => 'layout-4',
						),
						array(
							'name'     => 'carousel_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
						
					),
				)
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-imageCarousel-bottom-804 .classyea-imageCarousel-content,{{WRAPPER}} .classyea-imageCarousel-805 li:hover .classyea-imageCarousel-content',
			]
		);
		$this->add_responsive_control(
			'carousel_padding',
			array(
				'label'      => __('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'.classyea-imageCarousel-bottom-804 .classyea-imageCarousel-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'.classyea-imageCarousel-805 li:hover .classyea-imageCarousel-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					
				),
			)
		);
		$this->add_responsive_control(
			'title_margin_margin_bottom',
			array(
				'label'      => __('Margin Bottom', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'.classyea-image-carousel-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					
				),
			)
		);
		$this->add_control(
			'carousel_content_color',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .classyea-imageCarousel-content' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 li:hover .classyea-imageCarousel-content' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 .classyea-image-carousel-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 .classyea-imageCarousel-content p' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'heading_typography',
				'label'     => __('Heading Typography', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-image-carousel-heading',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'content_typography',
				'label'     => __('Content Typography', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-imageCarousel-bottom-804 .classyea-imageCarousel-content h5,{{WRAPPER}} .classyea-imageCarousel-805 .classyea-imageCarousel-content p',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_carousel_navigation_arrow',
			[
				'label' => esc_html__('Navigation - Arrow', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
					),
				)
			]
		);
		$this->add_control(
			'arrow_position_toggle',
			[
				'label' => __( 'Position', 'classyea' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'classyea' ),
				'label_on' => __( 'Custom', 'classyea' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();
		$this->add_responsive_control(
			'arrow_position_y',
			[
				'label' => __( 'Vertical', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'arrow_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_position_x',
			[
				'label' => __( 'Horizontal', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'arrow_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-next' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();
		$this->add_control(
            'arrow_border_radius',
            [
                'label' => __('Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-prev span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-next span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-prev span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-next span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-prev span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-next span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-prev span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-next span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-prev span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-next span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}', 
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}', 
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}', 
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}', 
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}', 
					'{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-prev span, {{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-prev span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-next span' => 'background-color: {{VALUE}}',
					
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
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-prev span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-prev span,{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-prev span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-prev span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-right-807 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-prev span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function classyea_slider_nav_style_controls() {
		$this->start_controls_section(
			'classyea_carousel_navigation_nav',
			[
				'label' => __( 'Navigation - Nav', 'classyea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => ['carousel_layout' => 'layout-2']
			]
		);
		$this->add_control(
			'nav_position_toggle',
			[
				'label' => __( 'Position', 'classyea' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'classyea' ),
				'label_on' => __( 'Custom', 'classyea' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();
		$this->add_responsive_control(
			'nav_position_y',
			[
				'label' => __( 'Vertical', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'nav_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .sliders-carousel #navigation' => 'top: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);
		$this->add_responsive_control(
			'nav_position_left',
			[
				'label' => __( 'Left', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'nav_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .sliders-carousel #navigation' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_position_right',
			[
				'label' => __( 'Right', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'nav_position_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .sliders-carousel #navigation' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();
		$this->start_controls_tabs( 'classyea_tabs_nav' );
		$this->start_controls_tab(
			'classyea_tab_navs_normal',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		$this->add_control(
			'navigation_bg_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.prev' => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.next' => 'background-color: {{VALUE}}!important',
					
				),
			)
		);
		$this->add_control(
			'navigation_color',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.prev' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.next' => 'color: {{VALUE}}!important',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'classyea_tab_nav_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
			'navigation_bg_hover_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.prev:hover' => 'background-color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.next:hover' => 'background-color: {{VALUE}}!important',
					
				),
			)
		);
		$this->add_control(
			'navigation_hover_color',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.prev:hover' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-carousel-wrapper-802 .slider-nav.next:hover' => 'color: {{VALUE}}!important',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function classyea_slider_dot_style_controls() {
		$this->start_controls_section(
			'classyea_carousel_navigation_dots',
			[
				'label' => __( 'Navigation - Dots', 'classyea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'carousel_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
					),
				)
			]
		);
		$this->add_responsive_control(
			'dots_nav_position_y',
			[
				'label' => __( 'Vertical Position', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -100,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-carousel-wrapper-801 .owl-theme .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-803 .owl-theme .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-805 .owl-theme .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-imageCarousel-wrapper-807 .owl-theme .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'dots_nav_spacing',
			[
				'label' => __( 'Spacing', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot span' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
				],
			]
		);
		$this->add_responsive_control(
			'dots_nav_position_sssx',
			[
				'label' => __( 'Horizontal Position', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 1000,
					],
					'%' => [
						'min' => -100,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots' => 'left: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-imageCarousel-bottom-804 .owl-theme .owl-dots' => 'left: {{SIZE}}{{UNIT}}!important;',
					
				],
			]
		);
		$this->start_controls_tabs( '_tabs_dots' );
		$this->start_controls_tab(
			'classyea_tab_dots_normal',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		$this->add_control(
			'dots_nav_size',
			[
				'label' => __( 'Width', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'dots_nav_heigt_size',
			[
				'label' => __( 'Height', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot span' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'dots_nav_color',
			[
				'label' => __( 'Color', 'classyea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot span' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'classyea_tab_dots_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
			'dots_nav_hover_color',
			[
				'label' => __( 'Color', 'classyea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'classyea_tab_dots_active',
			[
				'label' => __( 'Active', 'classyea' ),
			]
		);
		$this->add_control(
			'dots_nav_active_size',
			[
				'label' => __( 'Width', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'dots_nav_heigt_active_size',
			[
				'label' => __( 'Height', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'dots_nav_active_color',
			[
				'label' => __( 'Color', 'classyea' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings 			=  $this->get_settings_for_display();
		$carousel_layout 	= $settings['carousel_layout'];
		$autoplay_speed 	= $settings['autoplay_speed'];
		$image_item_gap 	= $settings['image_item_gap'];

		if ($carousel_layout == 'layout-1' || $carousel_layout == 'layout-3' || $carousel_layout == 'layout-4' || $carousel_layout == 'layout-5' || $carousel_layout == 'layout-6') {
			if($settings['infinite'] == 'yes'){
				$infiinite = true;
			}else{
				$infiinite = false;
			}

			if($settings['image_center'] == 'yes'){
				$image_center = true;
			}else{
				$image_center = false;
			}

			if($settings['autoplay'] == 'yes'){
				$autoplay = true;
			}else{
				$autoplay = false;
			}

			if($settings['dots'] == 'yes'){
				$dots = true;
			}else{
				$dots = false;
			}

			if($settings['arrows'] == 'yes'){
				$arrows = true;
			} else{
				$arrows = false;
			}
			
			$changed_atts = array(
				'infinite'       => $infiinite,
				'autoplay'       => $autoplay,
				'autoplaySpeed'  => $autoplay_speed,
				'dots' 			 => $dots,
				'arrows' 		 => $arrows,
				'item_gap' 	     => $image_item_gap,
				'image_center' 	 => $image_center
			);  
		}
		if ($carousel_layout == 'layout-2'){
			if($settings['enable_navigation'] == 'yes'){
				$navigation = true;
			}else{
				$navigation = false;
			}
			$changed_atts_two = array(
				'navigation' 	 => $navigation
			);  
		}
		
		if ($carousel_layout == 'layout-1' ) {
			$slider_atts = 'data-slider';
		}
		elseif ($carousel_layout == 'layout-2' ) {
			$slider_atts = 'data-nav';
		}
		elseif ($carousel_layout == 'layout-3' ) {
			$slider_atts = 'data-sliderthree';
		}
		elseif ($carousel_layout == 'layout-4' ) {
			$slider_atts = 'data-sliderfour';
		}
		elseif ($carousel_layout == 'layout-5' ) {
			$slider_atts = 'data-sliderfive';
		}
		elseif ($carousel_layout == 'layout-6' ) {
			$slider_atts = 'data-slidersix';
		}

		if ($carousel_layout == 'layout-2'){ 
			$this->add_render_attribute( 'slider_settings', $slider_atts , wp_json_encode( $changed_atts_two ) );
		} else {
			$this->add_render_attribute( 'slider_settings', $slider_atts , wp_json_encode( $changed_atts ) );
		}
		

		if ($carousel_layout == 'layout-1') { ?>
			<div class="classyea-carousel-wrapper-801" id="slider-one" <?php $this->print_render_attribute_string( 'slider_settings' ); ?>>
				<div class="owl-carousel owl-theme">
					<?php $this->classyea_carousel_repeater_control(); ?>
				</div>
			</div>
			<!-- end .classyea-carousel-wrapper-801 -->
			<?php
		} elseif($carousel_layout == 'layout-2'){ ?>
			<!-- end .classyea-container-left -->
			<div class="classyea-addons-container-right">
				<div class="classyea-carousel-wrapper-802">
					<div class="sliders-carousel sliderstype2" id="sliders"  style="width: 100%; height: 365px;"  <?php $this->print_render_attribute_string( 'slider_settings' ); ?>>
						<?php $this->classyea_carousel_repeater_control(); ?>
					</div>
				</div>
			</div>
			<!-- end .classyea-carousel-wrapper-802 -->
			<?php 
		} elseif($carousel_layout == 'layout-3'){ ?>
			<div class="classyea-imageCarousel-wrapper-803" id="slider-three" <?php $this->print_render_attribute_string( 'slider_settings' ); ?>>
				<div class="classyea-imageCarousel-bottom-803">
					<ul class="owl-carousel owl-theme">
						<?php $this->classyea_carousel_repeater_control(); ?>
					</ul>
				</div> <!-- end .classyea-imageCarousel-bottom-803 -->
			</div> <!-- end .classyea-imageCarousel-wrapper-803 -->
			<?php 
		}  elseif($carousel_layout == 'layout-4'){ ?>
			<div class="classyea-imageCarousel-bottom-804" id="slider-four" <?php $this->print_render_attribute_string( 'slider_settings' ); ?>>
				<ul class="owl-carousel owl-theme">
					<?php $this->classyea_carousel_repeater_control(); ?>
				</ul>
			</div> <!-- end .classyea-imageCarousel-bottom-804 -->
			<?php 
		} elseif($carousel_layout == 'layout-5'){ ?>
			<div class="classyea-imageCarousel-wrapper-807" id="slider-five" <?php $this->print_render_attribute_string( 'slider_settings' ); ?>>
				<div class="classyea-imageCarousel-right-807">
					<ul class="owl-carousel owl-theme">
						<?php $this->classyea_carousel_repeater_control(); ?>
					</ul>
				</div> <!-- end .classyea-imageCarousel-right-807 -->
			</div> <!-- end .classyea-imageCarousel-wrapper-807 -->
			<?php 
		} elseif($carousel_layout == 'layout-6'){ ?>
			<div class="classyea-imageCarousel-805" id="slider-six" <?php $this->print_render_attribute_string( 'slider_settings' ); ?>>
				<ul class="owl-carousel owl-theme">
					<?php $this->classyea_carousel_repeater_control(); ?>
				</ul> <!-- end .owl-carousel owl-theme -->
			</div> <!-- end .imageCarousel-805 -->
			<?php 
		}
	}

	private function classyea_carousel_repeater_control()
	{
		$settings 				= $this->get_settings_for_display();
		$carousel_layout 	    = $settings['carousel_layout'];
		$i = 1;
		foreach ($settings['slider_item'] as $key => $item) :
			$slider_subtitle = $item['slider_subtitle'];

			if ($carousel_layout == 'layout-1') { ?>
				<div class="item">
					<?php $this->classyea_carousel_thumbnail_image($item); ?>
				</div>
				<?php 
			} elseif ($carousel_layout == 'layout-2') { ?>
				<div class="slide">
					<?php $this->classyea_carousel_thumbnail_image($item); ?>
				</div>
				<?php 
			} elseif($carousel_layout == 'layout-3'){ ?>
				<li>
					<?php $this->classyea_carousel_thumbnail_image($item); ?>
				</li>
				<?php 
			} elseif($carousel_layout == 'layout-4'){ ?>
				<li>
					<?php $this->classyea_carousel_thumbnail_image($item); ?>
					<div class="classyea-imageCarousel-content">
						<?php $this->classyea_render_title_heading($item, $key);?>
						<h5><?php echo wp_kses($slider_subtitle ,'classyea_kses');?></h5>
					</div>
				</li>
				<?php 
			} elseif($carousel_layout == 'layout-5'){ ?>
				<li>
					<?php $this->classyea_carousel_thumbnail_image($item); ?>
				</li>
				<?php 
			} elseif($carousel_layout == 'layout-6'){ ?>
				<li>
					<?php $this->classyea_carousel_thumbnail_image($item); ?>
					<div class="classyea-imageCarousel-content">
					<?php $this->classyea_render_title_heading($item, $key);?>
					<p><?php echo wp_kses($slider_subtitle ,'classyea_kses');?></p>
					</div>
				</li>
				<?php 
			}
			$i++;
		endforeach; ?>
		<?php	// endforeach
	}
	/**
	 * carousel image thumbnail function
	 * Render image thumbnail image output on the frontend.
	 * @access private
	 */
	private function classyea_carousel_thumbnail_image($item)
	{
		echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($item, 'thumbnail', 'carousel_image'), 'classyea_img');
	}

	/**
	 * carousel title heading function
	 * Render image carousel heading output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_title_heading($item, $key)
	{

		$title_subtitle_on_off  = $item['title_subtitle_on_off'];
		if ($title_subtitle_on_off == 'yes') {
			if ($item['slider_title']) {
				$this->add_inline_editing_attributes('slider_title', 'none');
				$this->add_render_attribute('slider_title', 'class', 'classyea-image-carousel-heading', $key);

				if ($item['slider_title']) {
					$title_tag = Classyea_Helper::classyea_validate_html_tag($item['title_tag']);
			?>
					<<?php echo esc_html($title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('slider_title')); ?>>
						<?php echo wp_kses($item['slider_title'],'classyea_kses'); ?>
					</<?php echo esc_html($title_tag); ?>>
				<?php
				}
			}
		}
	}
}