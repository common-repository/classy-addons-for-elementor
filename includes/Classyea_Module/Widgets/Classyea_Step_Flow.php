<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Service Widget
 */
class Classyea_Step_Flow extends Widget_Base
{
	/**
	 * Retrieve step_flow widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-step-flow';
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	/**
	 * Retrieve step_flow widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Step Flow', 'classyea');
	}
	/**
	 * Retrieve step_flow widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-slider-push classyea';
	}
	/**
	 * Retrieve step_flow widget category.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea'];
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
			'step',
			'step flow',
			'classy stepflow',
			'classyea step_flow',
			'classy',
			'classy addons',
			'classyea'

		];
	}
	public function get_script_depends()
	{
		return [
			'classyea-appear'
		];
	}
	/**
	 * Register step_flow widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_step_flow_controls();
		$this->register_repeater_step_flow_controls();

		/* Style Tab */
		$this->register_style_background_controls();
	}
	protected function register_content_step_flow_controls()
	{

		/****
		 * Content Tab: step_flow
		 ****/
		$this->start_controls_section(
			'section_step_flow',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 4; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'step_flow_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);

		$this->end_controls_section();
	}
	/***
	/*	Repeater TAB
	 **/
	protected function register_repeater_step_flow_controls()
	{

		/**
		 * Content Repeater: step_flow
		 */
		$this->start_controls_section(
			'section_progress_section',
			[
				'label'                 => __('Step Flow Details', 'classyea'),
			]
		);

		$this->add_control(
			'bg_image_hide',
			[
				'label' => __('Display Line Image?', 'classyea'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'classyea'),
				'label_off' => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .ca-line-shape,{{WRAPPER}} .ca_line_shape2,{{WRAPPER}} .ca_line_shape3,{{WRAPPER}} .ca_line_shape4',
				'condition' => ['bg_image_hide' => 'yes' ],
			]
		);


		$this->add_control(
			'icon_one',
			[
				'label' => esc_html__('Icon', 'classyea'),
				'type' => Controls_Manager::ICONS,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
					]
				],
				'default'          => [
					'value'   => 'fas fa-check',
					'library' => 'fa-brands',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Hover Icon', 'classyea'),
				'type' => Controls_Manager::ICONS,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				],
				'default'          => [
					'value'   => 'fas fa-check',
					'library' => 'fa-brands',
				],
			]
		);

		$this->add_control(
			'step_flow_title',
			[
				'label'       => esc_html__('Title', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Start Discussion', 'classyea'),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __('Select Title Tag', 'classyea'),
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
				]
			]
		);

		$this->add_control(
			'step_flow_content',
			[
				'label'       => esc_html__('Content', 'classyea'),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Lorem ipsum dolor sit amet adipelit sed eiusmtempor dolore.', 'classyea'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			]
		);

		$this->add_control(
			'step_flow_number',
			[
				'label'                 => esc_html__('Step Number', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('1', 'classyea'),
			]
		);

		$this->end_controls_section();
	}

	/*	Background TAB */
	protected function register_style_background_controls()
	{
		//Background Section
		$this->start_controls_section(
			'background_section',
			array(
				'label' => __('Background', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'image_background',
				'label'     => __('Background', 'classyea'),
				'types'     => ['classic', 'gradient', 'video'],
				'selector'  => '{{WRAPPER}} .ca_stepflow_one, {{WRAPPER}} .ca_stepflow_four, {{WRAPPER}} .ca_stepflow_three, {{WRAPPER}} .ca_stepflow_two',
			]
		);

		$this->end_controls_section();

		//Wrapper Section
		$this->start_controls_section(
			'wrapper_content_section',
			array(
				'label' => __('Wrapper', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'classy_progressbar_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .ca_stepflow_one'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_two'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_three'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_four'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'classy_progressbar_margin',
			[
				'label'                 => __('Margin', 'classyea'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .ca_stepflow_one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_three' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_four' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classy_progressbar_padding',
			[
				'label'                 => __('Padding', 'classyea'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .ca_stepflow_one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_stepflow_four' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'classyea_progressbar_box_shadow',
				'separator'  => 'before',
				'selector'  => '{{WRAPPER}} .ca_stepflow_one, {{WRAPPER}} .ca_stepflow_two, {{WRAPPER}} .ca_stepflow_three, {{WRAPPER}} .ca_stepflow_four',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Title Section
		$this->start_controls_section(
			'title_section',
			array(
				'label' => __('Title & Content', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __('Title Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_title2' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_title4' => 'color: {{VALUE}}',

				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __('Title typography', 'classyea'),
				'selector' => '{{WRAPPER}} .ca-title,{{WRAPPER}} .ca_title4,{{WRAPPER}} .ca_title2',
			)
		);
		$this->add_responsive_control(
			'classy_title_margin',
			[
				'label'                 => __('Title Margin', 'classyea'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .ca_title2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ca_title4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __('Content Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} p' => 'color: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						]
					]
				]
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'label'    => __('Content Typography', 'classyea'),
				'selector' => '{{WRAPPER}} p',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			)
		);
		$this->add_responsive_control(
			'classy_content_margin',
			[
				'label'                 => __('Content Margin', 'classyea'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		// Step Number Section

		$this->start_controls_section(
			'step_number_section',
			array(
				'label' => __(' Step Number', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'step_number_typography',
				'label'    => __('Typography ', 'classyea'),
				'selector' => '{{WRAPPER}} .ca-number, {{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number, {{WRAPPER}} .stepflow3_number,{{WRAPPER}} .stepflow2_number,{{WRAPPER}} .ca_stepflow_inner .ca-count-box i:before',
			)
		);
		$this->start_controls_tabs( '_tabs_number' );
		$this->start_controls_tab(
			'classyea_tab_number_normal',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		$this->add_control(
			'step_number_color',
			array(
				'label'     => __('Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca-number' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stepflow3_number' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stepflow2_number' => 'color: {{VALUE}}',

				),
			)
		);

		$this->add_control(
			'step_number_bg_color',
			array(
				'label'     => __('BG Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow_inner .ca-count-box' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number' => 'background: {{VALUE}}',
					'{{WRAPPER}} .stepflow3_number' => 'background: {{VALUE}}',
					'{{WRAPPER}} .stepflow2_number' => 'background: {{VALUE}}',

				),
			)
		);

		$this->add_control(
			'step_number_border_color',
			array(
				'label'     => __('Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .stepflow3_number' => 'border-color: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			)
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_step_number_twobox_shadow',
                'selector' => '{{WRAPPER}} .stepflow2_number,{{WRAPPER}} .stepflow3_number,{{WRAPPER}} .ca_stepflow_inner .ca-count-box,{{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number',
            ]
        );
		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_tab_number_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
			'step_number_hover_color',
			array(
				'label'     => __('Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow2_inner:hover .ca_stepflow2_iconbox .stepflow2_number' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stepflow3_number:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow_inner .ca-count-box i:before' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'step_number_hover_bg_color',
			array(
				'label'     => __('BG Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow2_inner:hover .ca_stepflow2_iconbox .stepflow2_number' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .stepflow3_number:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow_inner .ca-count-box::before' => 'background: {{VALUE}}',

				),
			)
		);
		$this->add_control(
			'step_number_borderhover_color',
			array(
				'label'     => __('Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .stepflow3_number:hover' => 'border-color: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			)
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_step_number_hover_twobox_shadow',
                'selector' => '{{WRAPPER}} .stepflow2_number:hover,{{WRAPPER}} .stepflow3_number:hover,{{WRAPPER}} .ca_stepflow_inner .ca-count-box:hover,{{WRAPPER}} .ca_stepflow4_iconbox .stepflow4_number:hover,{{WRAPPER}} .ca_stepflow_inner:hover .ca-count-box',
            ]
        );

		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Icon Section

		$this->start_controls_section(
			'icon_section',
			array(
				'label' => __('Icon', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
					]
				]
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'icon_typography',
				'label'    => __('Icon', 'classyea'),
				'separator' => 'after',
				'selector' => '{{WRAPPER}} .inner_iconbox4, {{WRAPPER}} .ca_stepflow3_iconbox .inner_iconbox3, {{WRAPPER}} .ca_stepflow3_inner:hover .ca_stepflow3_iconbox .stepflow3_hover_iconbox, {{WRAPPER}} .ca_stepflow2_iconbox .inner_iconbox,{{WRAPPER}} .ca_stepflow2_inner:hover .ca_stepflow2_iconbox .stepflow2_hover_iconbox',
			)
		);

		$this->start_controls_tabs( '_tabs_icon' );
		$this->start_controls_tab(
			'classyea_tab_icon_normal',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __('Icon Color', 'classyea'),
				'separator' => 'after',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow3_iconbox .inner_iconbox3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow2_iconbox .inner_iconbox' => 'color: {{VALUE}}',
					'{{WRAPPER}} .inner_iconbox4' => 'color: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
					]
				]
			)
		);

		$this->add_control(
			'icon_bg_color',
			array(
				'label'     => __('BG Color', 'classyea'),
				'separator' => 'after',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow4_inner .ca_stepflow4_iconbox:before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow3_iconbox' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow2_iconbox' => 'background: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'step_flow_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
					]
				]
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'classyea_tab_icon_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __('Icon Color', 'classyea'),
				'separator' => 'after',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow3_inner:hover .ca_stepflow3_iconbox .stepflow3_hover_iconbox' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow2_inner:hover .ca_stepflow2_iconbox .stepflow2_hover_iconbox' => 'color: {{VALUE}}',
					'{{WRAPPER}} .inner_iconbox4:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_hover_bg_color',
			array(
				'label'     => __('BG Color', 'classyea'),
				'separator' => 'after',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ca_stepflow3_inner:hover .ca_stepflow3_iconbox .stepflow3_hover_iconbox' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow2_inner:hover .ca_stepflow2_iconbox .stepflow2_hover_iconbox' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow_inner .ca-count-box::before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .ca_stepflow4_inner .ca_stepflow4_iconbox:hover::before' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_step_number_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ca_stepflow_inner:hover .ca-count-box',
				'condition' => ['step_flow_layout' => 'layout-1']
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'count_box_border',
			array(
				'label' => __('Count Box', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'count_box_border',
                'selector' => '{{WRAPPER}} .ca_stepflow_inner .ca-count-box i,{{WRAPPER}} .ca_stepflow4_inner .ca_stepflow4_iconbox:before,{{WRAPPER}} .ca_stepflow2_iconbox,{{WRAPPER}} .ca_stepflow3_iconbox',
            ]
        );
		$this->end_controls_section();
	}
	protected function render()
	{

		$this->classyea_render_step_flow_repeater_control();
	}
	/**
	 * Service repeater control function
	 * Render counterup repeater output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_step_flow_repeater_control()
	{
		$settings         = $this->get_settings_for_display();
		$step_flow_layout = $settings['step_flow_layout'];


		if ($step_flow_layout == 'layout-1') {
			$step_flow_title   = $settings['step_flow_title'];
			$title_tag         = $settings['title_tag'];
			$step_flow_content = $settings['step_flow_content'];
			$step_flow_number  = $settings['step_flow_number'];
			$icon              = $settings['icon'];
			$bg_image_hide     = $settings['bg_image_hide'];
?>
			<!-- Step Flow Style 01 -->
			<div class="ca_stepflow_center">
				<div class="ca_stepflow_one">
					<div class="ca_stepflow_inner">
						<?php if ($bg_image_hide == 'yes') { ?>
							<div class="ca-line-shape"></div>
						<?php	} ?>
						<div class="ca-count-box">
							<span class="ca-number"><?php echo esc_html($step_flow_number); ?></span>
							<div class="overlay-icon">
								<?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?>
							</div>
						</div>
						<div class="ca-text-center">
							<<?php echo esc_attr($title_tag); ?> class="ca-title"><?php echo wp_kses($step_flow_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
							<p class="font_family_poppins"><?php echo wp_kses($step_flow_content,'classyea_kses'); ?></p>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ($step_flow_layout == 'layout-2') {
			$step_flow_title   = $settings['step_flow_title'];
			$title_tag         = $settings['title_tag'];
			$step_flow_number  = $settings['step_flow_number'];
			$icon              = $settings['icon'];
			$icon_one          = $settings['icon_one'];
			$bg_image_hide     = $settings['bg_image_hide'];
			
		?>
			<!-- Step Flow Style 02 -->
			<div class="ca_stepflow_center">
				<div class="ca_stepflow_two">
					<div class="ca_stepflow2_inner">
						<?php if ($bg_image_hide == 'yes') { ?>
							<div class="ca_line_shape2"></div>
						<?php	} ?>
						<div class="ca_stepflow2_iconbox">
							<div class="inner_iconbox">
								<?php Icons_Manager::render_icon(($icon_one), array('aria-hidden' => 'true')); ?>
							</div>
							<div class="stepflow2_hover_iconbox">
								<?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?>
							</div>
							<span class="stepflow2_number"><?php echo wp_kses($step_flow_number,'classyea_kses'); ?></span>
						</div>
						<<?php echo esc_attr($title_tag); ?> class="ca_title2"><?php echo wp_kses($step_flow_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
					</div>
				</div>
			</div>
		<?php } elseif ($step_flow_layout == 'layout-3') {
			$step_flow_title   = $settings['step_flow_title'];
			$title_tag         = $settings['title_tag'];
			$step_flow_content = $settings['step_flow_content'];
			$step_flow_number  = $settings['step_flow_number'];
			$icon              = $settings['icon'];
			$icon_one          = $settings['icon_one'];
			$bg_image_hide     = $settings['bg_image_hide'];
			
		?>
			<!-- Step Flow Style 03 -->
			<div class="ca_stepflow_center">
				<div class="ca_stepflow_three">
					<div class="ca_stepflow3_inner">
						<?php if ($bg_image_hide == 'yes') { ?>
							<div class="ca_line_shape3"></div>
						<?php	} ?>
						<div class="ca_stepflow3_iconbox">
							<div class="inner_iconbox3">
								<?php Icons_Manager::render_icon(($icon_one), array('aria-hidden' => 'true')); ?>
							</div>
							<div class="stepflow3_hover_iconbox">
								<?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?>
							</div>
							<span class="stepflow3_number"><?php echo esc_html($step_flow_number); ?></span>
						</div>
						<<?php echo esc_attr($title_tag); ?> class="ca_title2 ca_title_color"><?php echo wp_kses($step_flow_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
						<p class="font_family_poppins"><?php echo wp_kses($step_flow_content,'classyea_kses'); ?></p>
					</div>
				</div>
			</div>

		<?php } elseif ($step_flow_layout == 'layout-4') {
			$step_flow_title  = $settings['step_flow_title'];
			$title_tag        = $settings['title_tag'];
			$step_flow_number = $settings['step_flow_number'];
			$icon_one         = $settings['icon_one'];
			$bg_image_hide    = $settings['bg_image_hide'];
			
		?>
			<!-- Step Flow Style 04 -->
			<div class="ca_stepflow_four">
				<div class="ca_stepflow4_inner">
					<?php if ($bg_image_hide == 'yes') { ?>
						<div class="ca_line_shape4"></div>
					<?php	} ?>
					<div class="ca_stepflow4_iconbox">
						<div class="inner_iconbox4"><?php Icons_Manager::render_icon(($icon_one), array('aria-hidden' => 'true')); ?></div>
						<span class="stepflow4_number"><?php echo wp_kses($step_flow_number,'classyea_kses'); ?></span>
					</div>
					<<?php echo esc_attr($title_tag); ?> class="ca_title4"><?php echo wp_kses($step_flow_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
				</div>
			</div>
		<?php

		}
	}
}
