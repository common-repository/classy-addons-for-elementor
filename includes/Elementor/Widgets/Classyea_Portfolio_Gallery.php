<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \ClassyEa\Helper\Elementor\Settings\Header;
use \Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * portfolio gallery Widget
 */
class Classyea_Portfolio_Gallery extends Widget_Base
{


	/**
	 * Retrieve gallery widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-gallery-widget';
	}
	/**
	 * Retrieve gallery widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Filterable Gallery', 'classyea');
	}
	/**
	 * Retrieve gallery widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-image-filter';
	}

	public function get_categories()
	{
		return array('classyea');
	}
	public function get_script_depends()
	{
		return array('classyea-filterable-gallery');
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	
	/**
	 * Register portfolio gallery widget controls.
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_image_gallery_controls();
		$this->register_gallery_style_tab_controls();
	}

	protected function register_content_image_gallery_controls()
	{
		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__('General', 'classyea'),
			)
		);
		$layouts = array();
		for ($x = 1; $x <= 5; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}
		$this->add_control(
			'gallery_layout',
			[
				'label' => esc_html__( 'Layout', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-2',
				'options' => [
					'layout-2'  => esc_html__( 'Layout 1', 'classyea' ),
					'layout-3' => esc_html__( 'Layout 2', 'classyea' ),
					'layout-4' => esc_html__( 'Layout 3', 'classyea' ),
					'layout-6' => esc_html__( 'Layout 4', 'classyea' ),
				],
			]
		);
		$this->add_control(
			'filter_enable',
			[
				'label' => __('Enable Filter', 'classyea'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'all_label_text',
			[
				'label' => esc_html__('Gallery All Label', 'classyea'),
				'type' => Controls_Manager::TEXT,
				'dynamic'     => ['active' => true],
				'default' => 'All',
				'condition' => [
					'filter_enable' => 'yes',
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'gallery_item_control',
			array(
				'label' => esc_html__('Gallery Items', 'classyea'),
			)
		);
		$repeater = new Repeater();
		$repeater->start_controls_tabs('classyea_image_gallery_tabs');

		$repeater->start_controls_tab('tab_content', ['label' => __('Content', 'classyea')]);

		$repeater->add_control(
			'category_list',
			array(
				'label'       => __('Tab Title', 'classyea'),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __('programming'),
				'placeholder' => __('tab title name', 'classyea'),
			)
		);
		$repeater->add_control(
			'item_name',
			array(
				'label'       => esc_html__('Item Name', 'classyea'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			)
		);
		$repeater->add_control(
			'title_tag',
			[
				'label'   => __('Select Title Tag', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'p',
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
				]
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab('tab_image', ['label' => __('Image', 'classyea')]);
		
		$repeater->add_control(
			'gallery_image',
			[
				'label' => __('Image', 'classyea'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				],

			]
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'exclude' => ['custom'],
				'separator' => 'none',
				'condition' => [
					'gallery_image[url]!' => '',
				]

			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('classyea_tab_link', ['label' => __('Link', 'classyea')]);
		$repeater->add_control(
			'show_button',
			[
				'label'                 => __('Show Button', 'classyea'),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => '',
				'label_on'              => __('Yes', 'classyea'),
				'label_off'             => __('No', 'classyea'),
				'return_value'          => 'yes',
			]
		);
		$repeater->add_control(
			'link',
			[
				'label'                 => __('Link', 'classyea'),
				'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'        => true,
					'categories'    => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder'           => 'https://www.your-link.com',
				'default'               => [
					'url' => '#',
				],
				'condition'             => [
					'show_button'   => 'yes',
				]
			]
		);
		$repeater->add_control(
			'item_link_text',
			array(
				'label'   => esc_html__('Link Text', 'classyea'),
				'label_block' => true,
				'type'    => Controls_Manager::TEXT,
				'default' => __('', 'classyea'),
				'condition'             => [
					'show_button'   => 'yes',
				]
			)
		);
		$this->add_control(
			'galley_items_data',
			[
				'type'                  => Controls_Manager::REPEATER,
				'seperator'             => 'before',
				'default'               => [
					[
						'title'         => esc_html__('gallery #1', 'classyea'),
						'description'   => esc_html__('Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, odio', 'classyea'),
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
					[
						'title'         => esc_html__('gallery #2', 'classyea'),
						'description'   => esc_html__('Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, odio', 'classyea'),
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
					[
						'title'         => esc_html__('gallery #3', 'classyea'),
						'description'   => esc_html__('Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure odio', 'classyea'),
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						]
					]
				],
				'fields'        => $repeater->get_controls(),
				'title_field' => '{{item_name}}',
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Tab Style Filterable Gallery Style
	 **/
	protected function register_gallery_style_tab_controls()
	{
		$this->start_controls_section(
			'classyea_section_gallery_style_settings',
			[
				'label' => esc_html__('General Style', 'classyea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'classyea_gallery_container_padding',
			[
				'label' => esc_html__('Padding', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-351' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-gallery-portfolio-352' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-355' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-gallery-portfolio-356' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_gallery_container_margin',
			[
				'label' => esc_html__('Margin', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-351' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-gallery-portfolio-352' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-355' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-gallery-portfolio-356' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_gallery_border',
				'label' => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-portfolio-351,{{WRAPPER}} .classyea-portfolio-bottom-353,{{WRAPPER}} .classyea-gallery-portfolio-352,{{WRAPPER}} .classyea-portfolio-bottom-354,{{WRAPPER}} .classyea-portfolio-355,{{WRAPPER}} .classyea-gallery-portfolio-356',
			]
		);

		$this->add_control(
			'classyea_gallery_border_radius',
			[
				'label' => esc_html__('Border Radius', 'classyea'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-351' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-gallery-portfolio-352' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-355' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-gallery-portfolio-356' => 'border-radius: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'classyea_gallery_shadow',
				'selector' => '{{WRAPPER}} .classyea-portfolio-351,{{WRAPPER}} .classyea-portfolio-bottom-353,{{WRAPPER}} .classyea-gallery-portfolio-352,{{WRAPPER}} .classyea-portfolio-bottom-354,{{WRAPPER}} .classyea-portfolio-355,{{WRAPPER}} .classyea-gallery-portfolio-356',
			]
		);
		$this->end_controls_section();

		/**
		 * Filter Tab Style Filterable Gallery Control Style
		 * 
		 **/
		$this->start_controls_section(
			'classyea_filter_control_style_settings',
			[
				'label' => esc_html__('Control Style', 'classyea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'classyea_filter_control_padding',
			[
				'label' => esc_html__('Padding', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_filter_control_margin',
			[
				'label' => esc_html__('Margin', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'classyea_filter_control_typography',
				'selector' => '{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353,{{WRAPPER}} .classyea-portfolio-filter-menu li,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354,{{WRAPPER}} .classyea-portfolio-menu li',
			]
		);
		// Tabs
		$this->start_controls_tabs('classyea_filter_control_tabs');

		// Normal State Tab
		$this->start_controls_tab('classyea_filter_control_normal', ['label' => esc_html__('Normal', 'classyea')]);

		$this->add_control(
			'classyea_filter_control_normal_text_color',
			[
				'label' => esc_html__('Text Color', 'classyea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-menu li' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'classyea_filter_control_normal_bg_color',
			[
				'label' => esc_html__('Background Color', 'classyea'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-menu li' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_filter_control_normal_border',
				'label' => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353,{{WRAPPER}} .classyea-portfolio-filter-menu li,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354,{{WRAPPER}} .classyea-portfolio-menu li',
			]
		);

		$this->add_control(
			'classyea_filter_control_normal_border_radius',
			[
				'label' => esc_html__('Border Radius', 'classyea'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-menu li' => 'border-radius: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'classyea_filter_control_shadow',
				'selector' => '{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353,{{WRAPPER}} .classyea-portfolio-filter-menu li,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354,{{WRAPPER}} .classyea-portfolio-menu li',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		// Active State Tab
		$this->start_controls_tab('classyea_cta_btn_hover', ['label' => esc_html__('Active', 'classyea')]);

		$this->add_control(
			'classyea_filter_control_active_text_color',
			[
				'label' => esc_html__('Text Color', 'classyea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .current' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li.current' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li.hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .current' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-menu li.current' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-menu li:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'classyea_filter_control_active_bg_color',
			[
				'label' => esc_html__('Background Color', 'classyea'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .current' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li.current' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-.classyea-portfolio-filter-menu li .current' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .current' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-menu li:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-menu li.current' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_filter_control_active_border',
				'label' => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .current,{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353:hover,{{WRAPPER}} .classyea-portfolio-filter-menu li:hover,{{WRAPPER}} .classyea-portfolio-filter-menu li .current,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .current,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354:hover,{{WRAPPER}} .classyea-portfolio-menu li:hover,{{WRAPPER}} .classyea-portfolio-menu li.current',
			]
		);

		$this->add_control(
			'classyea_filter_control_active_border_radius',
			[
				'label' => esc_html__('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-filter-menu li .current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-menu li.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-menu li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'classyea_filter_control_active_shadow',
				'selector' => '{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .current,{{WRAPPER}} .classyea-portfolio-bottom-353 .classyea-portfolio-btn-353 .classyea-portfolio-btn-item-353:hover,{{WRAPPER}} .classyea-portfolio-filter-menu li:hover,{{WRAPPER}} .classyea-portfolio-filter-menu li .current,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .current,{{WRAPPER}} .classyea-portfolio-bottom-354 .classyea-portfolio-btn-354 .classyea-portfolio-btn-item-354:hover,{{WRAPPER}} .classyea-portfolio-menu li.current,{{WRAPPER}} .classyea-portfolio-menu li:hover',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// gallery title
		$this->start_controls_section(
			'classyea_gallery_content_style_section',
			[
				'label' => esc_html__('Item Title', 'classyea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'classyea_gallery_item_tilte_heading',
			[
				'label' => esc_html__('Title', 'classyea'),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'classyea_gallery_title_normal_color',
			[
				'label'		 => esc_html__('Color', 'classyea'),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-image-gallery-heading' => 'color: {{VALUE}};',

				]
			]
		);
		$this->add_control(
			'classyea_gallery_title_active_color',
			[
				'label'		 => esc_html__('Hover Color', 'classyea'),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-image-gallery-heading:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		 => 'classyea_gallery_title_typography',
				'selector'	 => '{{WRAPPER}} .classyea-image-gallery-heading',
			]
		);
		$this->add_responsive_control(
			'classyea_gallery_title_spacing_bottom',
			[
				'label' => esc_html__('Margin Bottom', 'classyea'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-image-gallery-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		// gallery title
		$this->start_controls_section(
			'classyea_gallery_button_style_section',
			[
				'label' => esc_html__('Button', 'classyea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'classyea_gallery_item_button_heading',
			[
				'label' => esc_html__('Button', 'classyea'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'classyea_content_button_normal_color',
			[
				'label'		 => esc_html__('Color', 'classyea'),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-portfolio-overlay a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-content a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'classyea_content_button_active_color',
			[
				'label'		 => esc_html__('Hover Color', 'classyea'),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-portfolio-overlay a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-portfolio-content a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		 => 'classyea_content_button_typography',
				'selector'	 => '{{WRAPPER}} .classyea-portfolio-overlay a,{{WRAPPER}} .classyea-portfolio-content a',
			]
		);

		$this->add_responsive_control(
			'classyea_content_button_spacing',
			[
				'label' => esc_html__('Margin', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-overlay a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-content a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Tab Style Filterable Gallery Item Style
		 **/
		$this->start_controls_section(
			'classyea_gallery_item_style_settings',
			[
				'label' => esc_html__('Item Style', 'classyea'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'classyea_gallery_item_container_padding',
			[
				'label' => esc_html__('Padding', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-box-351' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-portfolio-box-353 .classyea-portfolio-item-353' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-352' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-item-354' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-356' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_gallery_item_container_margin',
			[
				'label' => esc_html__('Margin', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-box-351' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-portfolio-box-353 .classyea-portfolio-item-353' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-352' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-item-354' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-356' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_gallery_item_border',
				'label' => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-portfolio-box-351,{{WRAPPER}} #classyea-portfolio-box-353 .classyea-portfolio-item-353,{{WRAPPER}} .classyea-portfolio-box-352,{{WRAPPER}} .classyea-portfolio-item-354,{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item,{{WRAPPER}} .classyea-portfolio-box-356',
			]
		);
		$this->add_responsive_control(
			'classyea_gallery_item_border_radius',
			[
				'label' => esc_html__('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .classyea-portfolio-box-351' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-portfolio-box-353 .classyea-portfolio-item-353' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-352' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-item-354' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-356' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-351 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-item-354:hover .classyea-portfolio-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-box-351 .classyea-portfolio-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-item-354 .classyea-portfolio-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item .classyea-portfolio-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'classyea_gallery_item_shadow',
				'selector' => '{{WRAPPER}} .classyea-portfolio-box-351,{{WRAPPER}} #classyea-portfolio-box-353 .classyea-portfolio-item-353,{{WRAPPER}} .classyea-portfolio-box-352,{{WRAPPER}} .classyea-portfolio-item-354,{{WRAPPER}} .classyea-portfolio-items-355 .classyea-portfolio-item,{{WRAPPER}} .classyea-portfolio-box-356',
			]
		);

		$this->end_controls_section();
	}
	protected function render()
	{
		$settings     	= $this->get_settings_for_display();
		$gallery_layout = $settings['gallery_layout'];
		$filter_enable  = $settings['filter_enable'];

		if ($gallery_layout == 'layout-1') : ?>
			<div class="classyea-portfolio-351">
				<?php $this->classyea_render_gallery_repeater_control(); ?>
			</div>
		<?php elseif ($gallery_layout == 'layout-2') : ?>
			<div class="classyea-portfolio-bottom-353">
				<?php
				if ($filter_enable == 'yes') :
					$this->classyea_render_gallery_filter_list();
				endif;
				?>
				<div id="classyea-portfolio-box-353">
					<?php $this->classyea_render_gallery_repeater_control(); ?>
				</div> 
			</div> 
		<?php elseif ($gallery_layout == 'layout-3') : ?>
			<div class="classyea-gallery-portfolio-352">
				<?php
				if ($filter_enable == 'yes') :
					$this->classyea_render_gallery_filter_list();
				endif;
				?>
				<div class="classyea-portfolio-352">
					<?php $this->classyea_render_gallery_repeater_control(); ?>
				</div>
			</div>
		<?php elseif ($gallery_layout == 'layout-4') : ?>
			<div class="classyea-portfolio-bottom-354">
				<?php
				if ($filter_enable == 'yes') :
					$this->classyea_render_gallery_filter_list();
				endif;
				?>
				<div id="classyea-portfolio-box-354">
					<?php $this->classyea_render_gallery_repeater_control(); ?>
				</div>
			</div>
		<?php elseif ($gallery_layout == 'layout-5') :  ?>
			<div class="classyea-portfolio-355">
				<div class="classyea-portfolio-items-355">
					<?php $this->classyea_render_gallery_repeater_control(); ?>
				</div>
			</div>
		<?php elseif ($gallery_layout == 'layout-6') : ?>
			<div class="classyea-gallery-portfolio-356">
				<?php if ($filter_enable == 'yes') :
					$this->classyea_render_gallery_filter_list();
				endif;
				?>
				<div class="classyea-portfolio-356">
					<?php $this->classyea_render_gallery_repeater_control(); ?>
				</div>
			</div>
		<?php elseif ($gallery_layout == 'layout-7') : ?>
			<div class="classyea-gallery-portfolio-356">
				<?php if ($filter_enable == 'yes') :
					$this->classyea_render_gallery_filter_list();
				endif;
				?>
				<div class="classyea-portfolio-356">
					<?php $this->classyea_render_gallery_repeater_control(); ?>
				</div>
			</div>
		<?php endif;
	}
	/**
	 * Portfolio repeater control function
	 * Render gallery repeater output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_gallery_repeater_control()
	{
		$settings 			= $this->get_settings_for_display();
		$gallery_layout 	= $settings['gallery_layout'];
		$category_arr_class = array();

		foreach ($settings['galley_items_data'] as $key => $item) {

			$cat                 = $item['category_list'];
			$child_categories_ex = preg_replace('/\n$/', '', preg_replace('/^\n/', '', preg_replace('/[\r\n]+/', "\n", $cat)));
			$child_categories_ex = explode(' ', $child_categories_ex);

			foreach ($child_categories_ex as $child_category) {

				$category_arr_class[] = str_replace(' ', '_', strtolower($child_category));
			}
		}
		foreach ($settings['galley_items_data'] as $key => $gallery_item) {

			$item_image = ($gallery_item["gallery_image"]["id"] != "") ? wp_get_attachment_image_url($gallery_item["gallery_image"]["id"], "full") : $gallery_item["gallery_image"]["url"];

			if ($gallery_layout == 'layout-2') : ?>
				<div class="classyea-portfolio-item-353" data-item="<?php echo esc_attr($category_arr_class[$key]); ?>">
					<div class="classyea-portfolio-image classyea-portfolio-image" style="background-image: url(<?php echo esc_url($item_image);?>);"></div>
				</div> 
			<?php elseif ($gallery_layout == 'layout-3') : ?>
				<div class="classyea-portfolio-box-352  classyea-item-gal" data-item="<?php echo esc_attr($category_arr_class[$key]); ?>">
					<?php $this->classyea_gallery_thumbnail_image($gallery_item); ?>
					<div class="classyea-portfolio-overlay">
						<?php 
						$this->classyea_render_name_heading($gallery_item, $key); 
						$this->classyea_button_link_markup($gallery_item, $key); ?>
					</div>
				</div>
			<?php elseif ($gallery_layout == 'layout-4') : ?>
				<div class="classyea-portfolio-item-354" data-item="<?php echo esc_attr($category_arr_class[$key]); ?>">
					<div class="classyea-portfolio-image">
						<?php $this->classyea_gallery_thumbnail_image($gallery_item); ?>
						<div class="classyea-portfolio-content">
							<?php $this->classyea_render_name_heading($gallery_item, $key); 
							$this->classyea_button_link_markup($gallery_item, $key); ?>
						</div>
					</div>
				</div>
			<?php elseif ($gallery_layout == 'layout-6') : ?>
				<div class="classyea-portfolio-box-356" data-item="<?php echo esc_attr($category_arr_class[$key]); ?>">
					<?php $this->classyea_gallery_thumbnail_image($gallery_item); ?>
					<div class="classyea-portfolio-overlay">
						<?php $this->classyea_render_name_heading($gallery_item, $key);
						$this->classyea_button_link_markup($gallery_item, $key); ?>
					</div>
				</div>
			<?php endif; 
		}  // end foreach
	}
	/**
	 * Portfolio image gallery thumbnail function
	 * Render gallery thumbnail image output on the frontend.
	 * @access private
	 */
	private function classyea_gallery_thumbnail_image($gallery_item)
	{

		ob_start();
			echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($gallery_item, 'thumbnail', 'gallery_image'),'classyea_img');
		echo ob_get_clean();
	}
	/**
	 * Portfolio image gallery filter list function
	 * Render image gallery filter output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_gallery_filter_list()
	{
		$settings 		= $this->get_settings_for_display();
		$all_type 		= $settings['all_label_text'];
		$gallery_layout = $settings['gallery_layout'];
		$filter_class   = 'classyea-portfolio-btn-353';
		if ($gallery_layout == 'layout-2') {
			$filter_class = 'classyea-portfolio-btn-353';
		} elseif ($gallery_layout == 'layout-3') {
			$filter_class = 'classyea-portfolio-filter-menu';
		} elseif ($gallery_layout == 'layout-4') {
			$filter_class = 'classyea-portfolio-btn-354';
		} elseif ($gallery_layout == 'layout-6') {
			$filter_class = 'classyea-portfolio-menu';
		}
		?>
		<ul class="<?php echo esc_attr($filter_class); ?>">
			<?php
			if (!empty($all_type)) { 
				if ($gallery_layout == 'layout-2') { ?>
					<li class="classyea-portfolio-btn-item-353 current" data-filter="all"><?php echo wp_kses($all_type,'classyea_kses'); ?></li>
				<?php } elseif ($gallery_layout == 'layout-3' || $gallery_layout == 'layout-6') { ?>
					<li class="current" data-target="all"><?php echo wp_kses($all_type,'classyea_kses'); ?></li>
				<?php } elseif ($gallery_layout == 'layout-4') { ?>
					<li class="classyea-portfolio-btn-item-354 current" data-filter="all"><?php echo wp_kses($all_type,'classyea_kses'); ?></li>
				<?php }
			}

			$category_arr1 = array();
			foreach ($settings['galley_items_data'] as $item) {
				$category_list = $item['category_list'];
				$arrayGetCode  = preg_replace('/\n$/', '', preg_replace('/^\n/', '', preg_replace('/[\r\n]+/', "\n", $category_list)));
				$arrayGet      = explode("\n", $arrayGetCode);
				$category_arr1 = array_merge($category_arr1, $arrayGet);
			}
			$category_arr1 = array_map('trim', $category_arr1);
			$category_arr1 = array_unique($category_arr1);
			$i             = 1;
			foreach ($category_arr1 as $category) {
				$key    = str_replace(' ', '_', $category);
				$key2 = strtolower($key);
				$active = '';
				if ($i == 1 && $all_type == '') {
					$active = 'current';
				}

				if ($gallery_layout == 'layout-2') {
					echo '<li class="classyea-portfolio-btn-item-353' . esc_attr($active) . '" data-filter="' . esc_attr($key2) . '">' . esc_html(ucfirst($category)) . '</li>';
				} elseif ($gallery_layout == 'layout-3' || $gallery_layout == 'layout-6') {
					echo '<li class="'.$active.'" data-target="' . esc_attr($key2) . '">' . esc_html(ucfirst($category)) . '</li>';
				} elseif ($gallery_layout == 'layout-4') {
					echo '<li class="classyea-portfolio-btn-item-354 ' . esc_attr($active) . '" data-filter="' . esc_attr($key2) . '">' . esc_html(ucfirst($category)) . '</li>';
				}
				$i++;
			}
			?>
		</ul> <!-- end of .classyea-portfolio-btn-343-->
		<?php }
	/**
	 * Portfolio name heading function
	 * Render image gallery heading output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_name_heading($gallery_item, $key)
	{
		if ($gallery_item['item_name']) {
			$this->add_inline_editing_attributes('item_name', 'none');
			$this->add_render_attribute('item_name', 'class', 'classyea-image-gallery-heading', $key);

			if ($gallery_item['item_name']) {
				$title_tag = Header::classyea_validate_html_tag($gallery_item['title_tag']);
		?>
				<<?php echo esc_html($title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('item_name')); ?>>
					<?php echo wp_kses($gallery_item['item_name'],'classyea_kses'); ?>
				</<?php echo esc_html($title_tag); ?>>
			<?php
			}
		}
	}
	/**
	 * Portfolio button link function
	 * Render accordion button output on the frontend.
	 * @access protected
	 */
	protected function classyea_button_link_markup($gallery_item, $key)
	{
		$show_button = $gallery_item['show_button'];
		if ('yes' === $show_button && !empty($gallery_item['item_link_text'])) :
			$link_key = $this->get_repeater_setting_key('link', 'button', $key);
			$this->add_link_attributes($link_key, $gallery_item['link']);
			$this->add_render_attribute($link_key, 'class', ['']);
		endif;

		if ('yes' === $show_button && !empty($gallery_item['item_link_text'])) { ?>
			<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>><?php echo wp_kses($gallery_item['item_link_text'],'classyea_kses'); ?></a>
		<?php
		}
	}
}
