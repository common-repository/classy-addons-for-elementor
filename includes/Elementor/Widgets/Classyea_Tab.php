<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Plugin;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Tab Link Widget
 */
class Classyea_Tab extends Widget_Base
{

	/**
	 * Retrieve Tab Link widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-tab-widget';
	}

	/**
	 * Retrieve Tab Link widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Tab', 'classyea');
	}

	/**
	 * Retrieve Tab Link widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-progress-bar';
	}

	/**
	 * Retrieve Tab Link widget category.
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

	public function get_script_depends()
	{
		return [
			'classyea-tab-script',
		];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return [
			'tab',
			'classy tab',
			'tab accordion',
			'tab widget',
			'element tab',
			'classy',
			'unlimited tab',

		];
	}

	/**
	 * Register service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_tab_repeater_control();
	}

	/***
    /*    Tab repeater control
	 **/
	protected function register_tab_repeater_control()
	{

		/**
		 * Content Tab Link
		 */
		$this->start_controls_section(
			'tab_content',
			[
				'label' => __('Tab Content', 'classyea'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'classyea_is_active_tab',
			[
				'label'     => esc_html__('Keep this tab open? ', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
			]
		);
		$repeater->add_control(
			'classyea_tab_title',
			[
				'label'       => esc_html__('Title', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'classyea_tab_icon_type',
			[
				'label'       => esc_html__('Icon Type', 'classyea'),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'none'  => [
						'title' => esc_html__('None', 'classyea'),
						'icon'  => 'fa fa-ban',
					],
					'icon'  => [
						'title' => esc_html__('Icon', 'classyea'),
						'icon'  => 'fa fa-paint-brush',
					],
					'image' => [
						'title' => esc_html__('Image', 'classyea'),
						'icon'  => 'fa fa-image',
					],
				],
				'default'     => 'icon',
			]
		);
		$repeater->add_control(
			'tab_title_icons',
			[
				'label'       => esc_html__('Title Icon', 'classyea'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'icon icon-earth',
					'library' => 'solid',
				],
				'condition'   => [
					'classyea_tab_icon_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'classyea_tab_title_image',
			[
				'label'     => esc_html__('Choose Image', 'classyea'),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
					'id'  => -1,
				],
				'condition' => [
					'classyea_tab_icon_type' => 'image',
				],
			]
		);
		$repeater->add_control(
            'classyea_tab_content_type',
            [
                'label' => __('Content Type', 'classyea'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => __('Content', 'classyea'),
                    'template' => __('Saved Templates', 'classyea'),   
                ],
                'default' => 'content',
            ]
        );
		$repeater->add_control(
			'classyea_tab_content',
			[
				'label'       => esc_html__('Content', 'classyea'),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default'     => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.The vertical tabs WordPress will allow you to display your content with tab section in your website. Some time people ask the question "H','classyea'),
				'condition' => [
                    'classyea_tab_content_type' => 'content',
                ]
			]
		);
		$repeater->add_control(
            'tab_primary_templates',
            [
                'name' => 'classyea_primary_templates',
                'label' => __('Choose Template', 'classyea'),
                'type' => Controls_Manager::SELECT,
                'options' => classyea_get_elementor_library(),
                'condition' => [
                    'classyea_tab_content_type' => 'template',
                ]
            ]
        );

		$this->add_control(
			'classyea_tabs_items',
			[
				'label'       => esc_html__('Tabs Items', 'classyea'),
				'type'        => Controls_Manager::REPEATER,
				'separator'   => 'before',
				'title_field' => '{{ classyea_tab_title }}',
				'default'     => [
					[
						'classyea_tab_title' => esc_html__('WordPress', 'classyea'),
						'content'            => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text', 'classyea'),
					],
					[
						'classyea_tab_title' => esc_html__('Prestashop', 'classyea'),
						'content'            => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text', 'classyea'),
					],
					[
						'classyea_tab_title' => esc_html__('Shopify', 'classyea'),
						'content'            => esc_html__('There are many variations of passages of Lorem Ipsum available', 'classyea'),
					],
				],
				'fields'      => $repeater->get_controls(),
			]
		);
		$this->add_responsive_control(
			'classyea_nav_position',
			[
				'label'     => esc_html__('Alignment', 'classyea'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__('Left', 'classyea'),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => esc_html__('Center', 'classyea'),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => esc_html__('Right', 'classyea'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .classyea-tabs-box.horizontal .tab-buttons' => 'justify-content: {{VALUE}};',
				],
				'default'   => 'center',
			]
		);
		$this->add_control(
			'position_type',
			[
				'label'        => esc_html__('Position', 'classyea'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'horizontal',
				'options'      => [
					'horizontal' => esc_html__('Horizontal', 'classyea'),
					'vertical'   => esc_html__('Vertical', 'classyea'),
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'hover_border_animation',
			[
				'label'        => esc_html__('Border Hover Animation?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'description'  => __("This effect is active when Border Bottom Style Disable",'classyea'),
				'label_on'     => esc_html__('Show', 'classyea'),
				'label_off'    => esc_html__('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'icon_show_hide',
			[
				'label'        => esc_html__('Icon Enable/Disable', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'classyea'),
				'label_off'    => esc_html__('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'tab_text_decoratino_enable',
			[
				'label'        => esc_html__('Text Decoration Enable?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'classyea'),
				'label_off'    => esc_html__('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'classyea_tab_toggle_type',
			[
				'label'   => esc_html__('Toggle Type', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'click',
				'options' => [
					'click'      => esc_html__('Click', 'classyea'),
					'mouseenter' => esc_html__('Hover', 'classyea'),
				],

			]
		);
		$this->add_control(
			'border_bottom_hover_style',
			[
				'label'        => esc_html__('Border Bottom Style?', 'classyea'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'classyea'),
				'label_off'    => esc_html__('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_responsive_control(
			'border_hoverstyle_width',
			[
				'label' => __( 'Border Width', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'border_bottom_hover_style' => 'yes'
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
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:before' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'hover_bottom_bordr_color',
			[
				'label'                 => __( 'Border Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'border_bottom_hover_style' => 'yes'
				],
			]
		);
		$this->add_responsive_control(
			'arrow_position_xffff',
			[
				'label'      => __('Border Position', 'classyea'),
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
					'{{WRAPPER}} .classyea-tab-wrapper .classyea-tabs-box.horizontal .tab-btns li.bottom-hover-border:before, .classyea-tab-wrapper .classyea-tabs-box.vertical .tab-btns li.bottom-hover-border:before'  => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'border_bottom_hover_style' => 'yes'
				],
			]
		);
		$this->end_controls_section();
		//  main Content

		$this->start_controls_section(
			'classyea_content_wrappe',
			[
				'label' => esc_html__('Main Wrapper', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'classyea_wrapper_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'classyea_adv_accordion_tab_bgtype_active',
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_wrapper_border',
				'label'    => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper',
			]
		);
		$this->add_responsive_control(
			'classyea_border_radius_content',
			[
				'label'      => esc_html__('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'classyea_box_shadow_content',
				'label'    => esc_html__('Box Shadow', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_content_content_style',
			[
				'label' => esc_html__('Content Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-wrapper .tabs-content .inner-box .content-box' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tabs-content .inner-box .content-box',
			]
		);

		$this->add_responsive_control(
			'classyea_content_style_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '30',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'classyea_content_bg_color',
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tabs-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_wrapper_border_style',
				'label'    => esc_html__('Border', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tabs-content',
			]
		);
		$this->add_responsive_control(
			'classyea_border_radius_content_style',
			[
				'label'      => esc_html__('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tabs-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'classyea_box_shadow_content_style',
				'label'    => esc_html__('Box Shadow', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tabs-content',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_tabs_style',
			[
				'label' => esc_html__('Nav Item', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label'     => esc_html__('Navigation Width', 'classyea'),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => '%',
				],
				'range'     => [
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-btn-box' => 'flex-basis: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'position_type' => 'vertical',
				],
			]
		);

		$this->add_control(
			'arrow_position_toggle',
			[
				'label' => __( 'Border', 'classyea' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'classyea' ),
				'label_on' => __( 'Custom', 'classyea' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();
		$this->add_responsive_control(
			'border_before_width',
			[
				'label' => __( 'Border Bottom', 'classyea' ),
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
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:before' => 'border-bottom: {{SIZE}}{{UNIT}} solid',
				],
			]
		);

		$this->add_responsive_control(
			'border_before_height',
			[
				'label' => __( 'Border Left', 'classyea' ),
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
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:before' => 'border-left: {{SIZE}}{{UNIT}} solid',
					
				],
			]
		);
		$this->add_responsive_control(
			'border_after_width',
			[
				'label' => __( 'Border Top', 'classyea' ),
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
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:after' => 'border-top: {{SIZE}}{{UNIT}} solid',
				],
			]
		);

		$this->add_responsive_control(
			'border_after_height',
			[
				'label' => __( 'Border Right', 'classyea' ),
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
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:after' => 'border-right: {{SIZE}}{{UNIT}} solid',
				],
			]
		);
		$this->add_control(
			'nav_border_color',
			[
				'label'                 => __( 'Border Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:before' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->end_popover();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_typography',
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tab-btns li.active-btn h3,{{WRAPPER}} .classyea-tab-wrapper .tab-btns li:hover h3',
			]
		);
		$this->add_responsive_control(
			'classyea_icon_margin_bottom',
			[
				'label'      => esc_html__('Margin Bottom', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'position_type' => 'vertical',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_icon_margin_right',
			[
				'label'      => esc_html__('Margin Right', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'position_type' => 'horizontal',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_icon_margin_right_vertical',
			[
				'label'      => esc_html__('Margin Right', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tabs-box' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'position_type' => 'vertical',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_tab_nav_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'      => '14',
					'right'    => '35',
					'bottom'   => '14',
					'left'     => '35',
					'unit'     => 'px',
					'isLinked' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__('Nav Icon & Title', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'classyea_icon_spacing',
			[
				'label'      => esc_html__('Icon Spacing', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li .icon-box' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'classyea_tab_icon_size',
			[
				'label'      => esc_html__('Icon Size', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					],
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li .icon-box i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li .icon-box img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->start_controls_tabs(
			'classyea_style_tabs_normal'
		);
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__('Normal', 'classyea'),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__('Icon Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li .icon-box i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'classyea_title_color',
			[
				'label'     => esc_html__('Title Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'classyea_title_background_group',
				'label'    => esc_html__('Background', 'classyea'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tab-btns li',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_header_style_tabs_active',
			[
				'label' => esc_html__('Active', 'classyea'),
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__('Icon Hover Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2575fc',
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li.active-btn .icon-box i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'classyea_active_title_color',
			[
				'label'     => esc_html__('Title Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2575fc',
				'selectors' => [
					'{{WRAPPER}} .classyea-tab-wrapper .tab-btns li.active-btn h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'classyea_title_active_background_group',
				'label'    => esc_html__('Background', 'classyea'),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .classyea-tab-wrapper .tab-btns li.active-btn',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$tabs_items      		= $settings['classyea_tabs_items'];
		$hover_animation 		= $settings['hover_border_animation'];
		$icon_show_hide  		= $settings['icon_show_hide'];
		$text_decoratino_enable  		= $settings['tab_text_decoratino_enable'];
		$position_type  		= $settings['position_type'];
		$toggle_type     		= $settings['classyea_tab_toggle_type'];
		$bottom_hover_style     = ( $settings['border_bottom_hover_style'] == 'yes') ? 'bottom-hover-border' : '';
		
		$postion_class = ( $position_type == 'horizontal')  ? 'horizontal' : 'vertical';


		$text_decoration = '';
		if ($text_decoratino_enable == 'yes') {
			$text_decoration = 'text-decoration-class';
		}

		if ($hover_animation == 'yes' && $bottom_hover_style == '') {
			$animation_class = 'animation-border';
		} else {
			$animation_class = '';
		}
		$unique_id = $this->get_id();

		$has_active_tab = false;
		foreach ($tabs_items as $index => $tab) {
			if ($tab['classyea_is_active_tab'] == 'yes') {
				$has_active_tab = true;
			}
		}

		if($toggle_type == 'click'){
			$classyea_click = 'classyea-click';
		}
		else if($toggle_type == 'mouseenter'){
			$classyea_click = 'classyea-mouseenter';
		}

?>
		<!-- tab-section -->
		<div class="classyea-tab-wrapper bg-color-1 <?php echo esc_attr($bottom_hover_style);?>">
			<div class="classyea-tabs-box <?php echo esc_attr($postion_class);?>">
				<div class="classyea-tab-btn-box <?php echo esc_attr($classyea_click);?>" id="classyea-tab-btn-box" data-toggletype="<?php echo esc_attr($toggle_type);?>">
					<input type="hidden" id="data_horizontal" data-horizontal="<?php echo esc_attr($postion_class);?>" />
					<ul class="tab-btns tab-buttons clearfix">
						<?php
						foreach ($tabs_items as $index => $tab) {

							$active_btn = ($tab['classyea_is_active_tab'] == 'yes') ? 'active-btn' : '';
							$active_btn = ($has_active_tab == false && $index == 0) ? 'active-btn' : $active_btn;
							$icon_type  = $tab['classyea_tab_icon_type'];
							$tab_title  = $tab['classyea_tab_title'];
							$tab_id     = $unique_id . $index;

							if (!isset($tab['tab_title_icons']) && !Icons_Manager::is_migration_allowed()) {
								// add old default
								$tab['tab_title_icons'] = 'fa fa-star';
							}

							$has_icon = !empty($tab['tab_title_icons']);

							if ($has_icon) {
								$this->add_render_attribute('i', 'class', $tab['tab_title_icons']);
								$this->add_render_attribute('i', 'aria-hidden', 'true');
							}

							if (!$has_icon && !empty($tab['tab_title_icons']['value'])) {
								$has_icon = true;
							}

							$migrated = isset($tab['__fa4_migrated']['tab_title_icons']);
							$is_new   = !isset($tab['tab_title_icons']) && Icons_Manager::is_migration_allowed();
						?>
							<li class="tab-btn <?php echo esc_attr($active_btn); ?> <?php echo esc_attr($animation_class); ?> <?php echo esc_attr($text_decoration); ?> <?php echo esc_attr($bottom_hover_style);?>" data-tab="#tab-<?php echo esc_attr($tab_id); ?>">
								<?php if ($icon_show_hide == 'yes') { ?>
									<figure class="icon-box">

										<?php
										if ($icon_type == 'icon') {
											if ($is_new || $migrated) {
												Icons_Manager::render_icon($tab['tab_title_icons'], ['aria-hidden' => 'true']);
											} elseif (!empty($tab['tab_title_icons'])) {
										?><i <?php echo wp_kses_post($this->get_render_attribute_string('i')); ?>></i>
										<?php
											}
										} else {
											$this->classyea_title_icon_image($tab);
										}
										?>
									</figure>
								<?php } ?>
								<h3><?php echo wp_kses($tab_title, 'classyea_kses'); ?></h3>
							</li>
						<?php
						} ?>
					</ul>
				</div>
				<div class="tabs-content">
					<?php
					foreach ($tabs_items as $index => $tab) {
						$active_btn  = ($tab['classyea_is_active_tab'] == 'yes') ? 'active-tab' : '';
						$active_btn  = ($has_active_tab == false && $index == 0) ? 'active-tab' : $active_btn;
						$tab_id      = $unique_id . $index;
						$tab_content = $tab['classyea_tab_content'];
						$tab_templates = $tab['tab_primary_templates'];
					?>

						<div class="tab <?php echo esc_attr($active_btn); ?>" id="tab-<?php echo esc_attr($tab_id); ?>">
							<div class="inner-box">
								<div class="content-box">
								<?php
									if ('content' == $tab['classyea_tab_content_type']) {
										echo  do_shortcode(sprintf("%s",wp_kses($tab_content,'classyea_kses')));
									} elseif ('template' == $tab['classyea_tab_content_type']) {
										if (!empty($tab_templates)) {
											echo Plugin::$instance->frontend->get_builder_content($tab_templates, true);
										}
									} ?>
								</div>
							</div>
						</div>
					<?php
					} ?>

				</div>
			</div>
		</div>
		<!-- industries-section end -->
		
		<?php
	}

	/**
	 * tab image function
	 * Render tab image output on the frontend.
	 * @param [type] $tab_item
	 * @access protected
	 */
	protected function classyea_title_icon_image($tab_item)
	{
		if ('image' == $tab_item['classyea_tab_icon_type']) :
		?>
			<div class="classyea-testimonial-item-img">
				<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($tab_item, 'thumbnail', 'classyea_tab_title_image'), 'classyea_img'); ?>
			</div>
<?php

		endif;
	}
}
