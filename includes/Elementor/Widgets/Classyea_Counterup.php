<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \ClassyEa\Helper\Elementor\Settings\Header;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Counterup Widget
 */
class Classyea_Counterup extends Widget_Base
{

	/**
	 * Retrieve counter widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-counterup';
	}
	/**
	 * Retrieve counter widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('CounterUp', 'classyea');
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	/**
	 * Retrieve counter widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-counter-up';
	}
	/**
	 * Retrieve counterup widget category.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea'];
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
			'counterup',
		];
	}
	public function get_script_depends()
	{
		return array(
			'classyea-counterTo',
			'classyea-counterup',
			'classyea-appear-script'
		);
	}
	
	/**
	 * Register counterup widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_repeater_counter_controls();

		/* Style Tab */
		$this->classyea_register_style_counter_icon_controls();
		$this->classyea_register_style_counter_number_controls();
		$this->classyea_register_style_title_controls();
	}

	
	/*	Repeater TAB*/
	protected function register_repeater_counter_controls()
	{

		/**
		 * Content Tab: Counter
		 */
		$this->start_controls_section(
			'section_counter_item',
			[
				'label'                 => __('Counter', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'counter_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);
		$this->add_control(
			'item_counter_title',
			[
				'label'                 => __('Counter Title', 'classyea'),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);
		$this->add_control(
			'item_counter_title_two',
			[
				'label'                 => __('Counter Title', 'classyea'),
				'label_block' => true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Counter Title', 'classyea'),
			]
		);
		$this->add_control(
            'counter_title_tag',
            [
                'label'   => __('Heading HTML Tag', 'classyea'),
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

		$this->add_control(
			'starting_number',
			[
				'label'                 => __('Starting Number', 'classyea'),
				'type'                  => Controls_Manager::NUMBER,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => 0,
			]
		);

		$this->add_control(
			'ending_number',
			[
				'label'                 => __('Ending Number', 'classyea'),
				'type'                  => Controls_Manager::NUMBER,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => 250,
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label'                 => __('Icon', 'classyea'),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);

		$this->add_control(
			'classyea_counterup_icon_type',
			[
				'label'                 => esc_html__('Icon Type', 'classyea'),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'toggle'                => false,
				'options'               => [
					'none'        => [
						'title'   => esc_html__('None', 'classyea'),
						'icon'    => 'fa fa-ban',
					],
					'icon'        => [
						'title'   => esc_html__('Icon', 'classyea'),
						'icon'    => 'fa fa-star',
					],
					'image'       => [
						'title'   => esc_html__('Image', 'classyea'),
						'icon'    => 'fa fa-picture-o',
					]
				],
				'default'               => 'icon',
			]
		);

		$this->add_control(
			'icon',
			[
				'label'                 => __('Icon', 'classyea'),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility'      => 'counter_icon',
				'default'               => [
					'value'     => 'fas fa-star',
					'library'   => 'fa-solid',
				],
				'condition'             => [
					'classyea_counterup_icon_type'  => 'icon',
				]
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label'                 => __('Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'             => [
					'classyea_counterup_icon_type'  => 'image',
				]
			]
		);
		$this->add_control(
			'counter_speed',
			[
				'label'                 => __('Counter Speed', 'classyea'),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => ['size' => 1000],
				'range'                 => [
					'px' => [
						'min'   => 100,
						'max'   => 2000,
						'step'  => 1,
					],
				],
				'size_units'            => '',
			]
		);
		$this->add_responsive_control(
			'classyea_counter_flex_alignment',
			[
				'label'                 => __( 'Alignment', 'classyea' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'flex-start'      => [
						'title' => __( 'Left', 'classyea' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'classyea' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'     => [
						'title' => __( 'Right', 'classyea' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} #classyea-counterUp__container-item-100'   => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} #classyea-counterUp-box-103 .classyea-counterUp-item-103'   => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .classyea-counterUp__box-item-106'   => 'align-items: {{VALUE}};',
				],
				'condition'             => [
					'counter_layout'    => [
						'layout-2',
						'layout-3',
						'layout-5',
					]
				]
			]
		);
		$this->add_responsive_control(
			'classyea_counter_alignment',
			[
				'label'                 => __( 'Alignment', 'classyea' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'classyea' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'classyea' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'classyea' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-item-102'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-counter-item'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-counterUp__box-item-101'   => 'text-align: {{VALUE}};',
				],
				'condition'             => [
					'counter_layout'    => [
						'layout-6',
						'layout-4',
						'layout-1',
					]
				]
			]
		);
		$this->add_control(
			'divider_on_off',
			array(
				'label'        => __( 'Divider On/Off', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => __("use for style one","classyea"),
 				'default'      => 'no',
				'label_on'     => __( 'Yes', 'classyea' ),
				'label_off'    => __( 'No', 'classyea' ),
				'return_value' => 'yes',
				'condition'    => array(
					'counter_layout' => 'layout-1'
				)
			)
		);
		$this->end_controls_section();
	}
	protected function classyea_register_style_counter_icon_controls() {
		/**
		 * Style Tab: Icon
		 */
		$this->start_controls_section(
			'section_counter_icon_style',
			[
				'label'                 => __( 'Icon', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'classyea_counterup_icon_type!' => 'none',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'counter_icon_bg',
				'label'                 => __( 'Background', 'classyea' ),
				'types'                 => [ 'none', 'classic', 'gradient' ],
				'condition'             => [
					'classyea_counterup_icon_type!' => 'none',
				],
				'selector'              => '{{WRAPPER}} .classyea-counterUp__box-item-101 .icon,{{WRAPPER}} .classyea-counterUp__box-item-106 span.icon,{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-item-102 i,{{WRAPPER}} #classyea-counterUp-box-103 .classyea-counterUp-item-103 .classyea-counterUp-icon,{{WRAPPER}} .classyea-icon-box i',
				'condition'             => [
					'counter_layout' => [
						'layout-1','layout-5'
					]
				]
				
			]
		);

		$this->add_control(
			'counter_icon_color',
			[
				'label'                 => __( 'Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-counterUp__box-item-101 .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-counterUp__box-item-106 span.icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-item-102 i' => 'color: {{VALUE}};',
					'{{WRAPPER}} #classyea-counterUp-box-103 .classyea-counterUp-item-103 .classyea-counterUp-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box i' => 'color: {{VALUE}};',
				],
				'condition'             => [
					'classyea_counterup_icon_type'  => 'icon',
				]
			]
		);

		$this->add_responsive_control(
			'counter_icon_size',
			[
				'label'                 => __( 'Size', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => 5,
						'max'   => 100,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px', 'em' ],
				'default'               => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-counterUp__box-item-101 .icon' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-counterUp__box-item-106 span.icon' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-item-102 i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} #classyea-counterUp-box-103 .classyea-counterUp-item-103 .classyea-counterUp-icon' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-icon-box i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition'             => [
					'classyea_counterup_icon_type'  => 'icon',
				]
			]
		);

		$this->add_responsive_control(
			'counter_icon_img_width',
			[
				'label'                 => __( 'Image Width', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => 10,
						'max'   => 500,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px', '%' ],
				'default'               => [
					'unit' => 'px',
					'size' => '',
				],
				'condition'             => [
					'classyea_counterup_icon_type'  => 'image',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-counterUp__box-item-101 .image img' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-counterUp__box-item-106 span.image img' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-item-102 .image img' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} #classyea-counterUp-box-103 .classyea-counterUp-item-103 .image img' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-icon-box .image img' => 'width: {{SIZE}}{{UNIT}}',
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'counter_icon_border',
				'label'                 => __( 'Border', 'classyea' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .classyea-counterUp__box-item-101 .icon,{{WRAPPER}} .classyea-counterUp__box-item-106 span.icon,{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-i',
				'condition'             => [
					'classyea_counterup_icon_type!' => 'none',
				]
			]
		);

		$this->add_control(
			'counter_icon_border_radius',
			[
				'label'                 => __( 'Border Radius', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .classyea-counterUp__box-item-101 .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-counterUp__box-item-106 span.icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-counterUp-box-102 .classyea-counterUp-item-102 i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} #classyea-counterUp-box-103 .classyea-counterUp-item-103 .classyea-counterUp-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'classyea_counterup_icon_type!' => 'none',
				]
			]
		);

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_contact_form_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-counterUp__box-item-101 .icon',
				'condition' => [
					'counter_layout' => 
					['layout-1','layout-5']
				]
            ]
        );

		$this->end_controls_section();
	}

	protected function classyea_register_style_counter_number_controls() {
		/*****
		 * Style Tab: Number
		 ****/
		$this->start_controls_section(
			'section_counter_num_style',
			[
				'label'                 => __( 'Number', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'counter_num_color',
			[
				'label'                 => __( 'Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-counterUp__box-item-101 .number' => 'color: {{VALUE}};',
					'{{WRAPPER}} .number' => 'color: {{VALUE}};',
					'{{WRAPPER}} #number102' => 'color: {{VALUE}};',
					'{{WRAPPER}} #number103' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .counter' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'counter_num_typography',
				'label'                 => __( 'Typography', 'classyea' ),
				'selector'              => '{{WRAPPER}} .classyea-counterUp__box-item-101 .number,{{WRAPPER}} .number,{{WRAPPER}} #number102,{{WRAPPER}} #number103,{{WRAPPER}} .counter',
			]
		);

		$this->add_responsive_control(
			'counter_num_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-counterUp__box-item-101 .number' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
					'{{WRAPPER}} .number' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
					'{{WRAPPER}} #number102' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
					'{{WRAPPER}} #number103' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}}!important;',
					'{{WRAPPER}} .counter' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}
	protected function classyea_register_style_title_controls() {
		/****
		 * Style Tab: Title
		 ****/
		$this->start_controls_section(
			'section_counter_title_style',
			[
				'label'                 => __( 'Title', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'item_counter_title_two!' => '',
				]
			]
		);

		$this->add_control(
			'title_style_heading',
			[
				'label'                 => __( 'Title', 'classyea' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
				'condition'             => [
					'item_counter_title_two!' => '',
				]
			]
		);

		$this->add_control(
			'counter_title_color',
			[
				'label'                 => __( 'Text Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .text' => 'color: {{VALUE}};',
				],
				'condition'             => [
					'item_counter_title_two!' => '',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'counter_title_typography',
				'label'                 => __( 'Typography', 'classyea' ),
				'selector'              => '{{WRAPPER}} .text',
				'condition'             => [
					'item_counter_title_two!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'counter_title_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'             => [
					'{{WRAPPER}} .text' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'separator'             => 'before',
				'condition'             => [
					'item_counter_title_two!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'counter_title_padding',
			[
				'label'                 => __( 'Padding', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'           => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
				'selectors'             => [
					'{{WRAPPER}} .text' => 'padding-top: {{TOP}}{{UNIT}}; padding-left: {{LEFT}}{{UNIT}}; padding-right: {{RIGHT}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
				'condition'             => [
					'item_counter_title_two!' => '',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_circle_style',
			[
				'label'                 => __( 'Circle', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'counter_layout' => 'layout-3',
				]
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_contact_form_border',
                'selector' => '{{WRAPPER}} .classyea-counterUp__box-item-100',
            ]
        );
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings 		=  $this->get_settings_for_display();
		$counter_layout = $settings['counter_layout'];

		if ('layout-4' === $counter_layout) { ?>
			<div class="classyea-counterUp-section">
			<?php } 
			if ('layout-1' === $counter_layout) { 
				// Counter box
				$this->classyea_counter_box_control();
					
			}
			if ('layout-3' === $counter_layout) { ?>
				<div id="classyea-counterUp__container-item-100">
					<?php
					// Counter box
					$this->classyea_counter_box_control();
					?>
				</div>
			<?php }
			if ('layout-4' === $counter_layout) { ?>
				<div id="classyea-counterUp-box-102">
					<?php
					// Counter box
					$this->classyea_counter_box_control();
					?>
				</div>
			<?php }
			
			if ('layout-5' === $counter_layout) { ?>
				<div id="classyea-counterUp-box-103">
					<?php
					// Counter box
					$this->classyea_counter_box_control();
					?>
				</div>
			<?php }
			if ('layout-6' === $counter_layout) { ?>
				<div class="classyea-counterUp-104">
					<?php
					// Counter box
					$this->classyea_counter_box_control();
					?>
				</div>
			<?php }
			// layout two counter box
			if ('layout-2' === $counter_layout) { ?>
				<div id="classyea-counterUp__container-item-106">
					<?php
					// Counter box
					$this->classyea_counter_box_control_two();
					?>
				</div>
				<!-- .classyea-container-right -->
			<?php }
			if ('layout-4' === $counter_layout) { ?>
			</div>
		<?php }
		}
		/**
		 * Counter box control function
		 * Render counterup repeater output on the frontend.
		 * @access protected
		 */
		protected function classyea_counter_box_control()
		{
			$settings 		= $this->get_settings_for_display();
			$counter_layout = $settings['counter_layout'];
			if ('layout-6' === $counter_layout || 'layout-1' === $counter_layout) { 
				$classyea_counter_alignment = $settings['classyea_counter_alignment'];

				if($classyea_counter_alignment == 'left') :
					$alignment = 'left-alignment';
				elseif($classyea_counter_alignment == 'center') :
					$alignment = 'center-alignment';
				elseif($classyea_counter_alignment == 'right') :
					$alignment = 'right-alignment';
				endif;
			}

			$starting_number 			  = $settings['starting_number'];
			$ending_number   			  = $settings['ending_number'];
			$classyea_counterup_icon_type = $settings['classyea_counterup_icon_type'];
			$counter_speed = ($settings['counter_speed']) ? $settings['counter_speed'] : 1500;

			if (!isset($settings['counter_icon']) && !Icons_Manager::is_migration_allowed()) {
				// add old default
				$settings['counter_icon'] = 'fa fa-star';
			}

			$has_icon = !empty($settings['counter_icon']);

			if ($has_icon) {
				$this->add_render_attribute('i', 'class', $settings['counter_icon']);
				$this->add_render_attribute('i', 'aria-hidden', 'true');
			}

			if (!$has_icon && !empty($settings['counter_icon']['value'])) {
				$has_icon = true;
			}
			if ('layout-1' === $counter_layout) {
				$divider_on_off = $settings['divider_on_off'];
				$divider = '';
				if($divider_on_off == 'yes'){
					$divider = 'divider-on-off';
				}
				$alignemtn_divider = $alignment . " " . $divider;
			}

			$migrated = isset($settings['__fa4_migrated']['counter_icon']);
			$is_new = !isset($settings['counter_icon']) && Icons_Manager::is_migration_allowed();
			$icon_class = 'icon';
			
			if ('layout-3' === $counter_layout) {
				$item_class = "classyea-counterUp__box-item-100 ";
				$divspan = 'span';
			} elseif ('layout-1' === $counter_layout) {
				$item_class = "classyea-counterUp__box-item-101 $alignemtn_divider";
				$divspan = 'span';
				$icon_class = "icon $alignment";
			} elseif ('layout-4' === $counter_layout) {
				$item_class = 'classyea-counterUp-item-102';
			} elseif ('layout-5' === $counter_layout) {
				$item_class = 'classyea-counterUp-item-103';
				$icon_class = 'classyea-counterUp-icon';
				$divspan = 'div';
			} elseif ('layout-6' === $counter_layout) {
				$item_class = 'classyea-counter-item';
				$icon_class = "classyea-icon-box $alignment";
				$divspan = 'div';
			} else {
				$item_class = 'classyea-counterUp__box-item-101';
				$divspan = 'span';
			}
		?>
		<div class="<?php echo esc_attr($item_class); ?>">
			<?php if ('layout-1' === $counter_layout || 'layout-4' === $counter_layout || 'layout-5' === $counter_layout || 'layout-6' === $counter_layout) {
				if ('icon' === $classyea_counterup_icon_type) {
					if ('layout-4' != $settings['counter_layout']) { ?>
						<<?php echo esc_html($divspan); ?> class="<?php echo esc_attr($icon_class); ?>">
						<?php }
					if ($is_new || $migrated) {
						Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']);
					} elseif (!empty($settings['counter_icon'])) {
						?><i <?php echo wp_kses_post($this->get_render_attribute_string('i')); ?>></i>
						<?php }
					if ('layout-4' != $settings['counter_layout']) { ?>
						</<?php echo esc_html($divspan); ?>>
					<?php }
				} elseif ('image' === $classyea_counterup_icon_type) {
					$image = $settings['icon_image'];
					if ($image['url']) { ?>
						<span class="image">
							<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'image', 'icon_image'),'classyea_img'); ?>
						</span>
				<?php }
				}
			}
			if ('layout-3' == $counter_layout || 'layout-1' == $counter_layout) { 
				?>
				<h3 class="number" data-start="<?php echo esc_attr($starting_number);?>" data-target="<?php echo esc_attr($ending_number); ?>" data-speed="<?php echo esc_attr($counter_speed['size']); ?>"><?php echo wp_kses($ending_number,'classyea_kses'); ?></h3>
				<?php $this->classyea_title_tag();
			} elseif ('layout-5' === $counter_layout) { ?>
				<div class="classyea-counterUp-text">
					<h3 id="number103" data-speed="<?php echo esc_attr($counter_speed['size']); ?>" data-start="<?php echo esc_attr($starting_number);?>" data-target="<?php echo esc_attr($ending_number); ?>"></h3>
					<?php $this->classyea_title_tag();?>
				</div>
			<?php } elseif ('layout-4' === $counter_layout) { ?>
				<h2 id="number102" data-speed="<?php echo esc_attr($counter_speed['size']); ?>" data-start="<?php echo esc_attr($starting_number);?>" data-target="<?php echo esc_attr($ending_number); ?>"><?php echo wp_kses($ending_number,'classyea_kses'); ?></h2>
				<?php $this->classyea_title_tag();
			} elseif ('layout-6' === $counter_layout) { ?>
				<h3 class="counter number" data-start="<?php echo esc_attr($starting_number); ?>" data-target="<?php echo esc_attr($ending_number); ?>" data-speed="<?php echo esc_attr($counter_speed['size']); ?>"><span><?php echo wp_kses($ending_number,'classyea_kses'); ?></span></h3>
				<?php $this->classyea_title_tag();
			} ?>
		</div>
	<?php
		}
		/**
		 * Counter box control two function
		 * Render counterup repeater two output on the frontend.
		 * @access protected
		 */
		protected function classyea_counter_box_control_two()
		{
			$settings 		 			  = $this->get_settings_for_display();
			$ending_number 	 			  = $settings['ending_number'];
			$starting_number 			  = $settings['starting_number'];
			$classyea_counterup_icon_type = $settings['classyea_counterup_icon_type'];
			$counter_speed = ($settings['counter_speed']) ? $settings['counter_speed'] : 1500;

			if (!isset($settings['counter_icon']) && !Icons_Manager::is_migration_allowed()) {
				// add old default
				$settings['counter_icon'] = 'fa fa-star';
			}

			$has_icon = !empty($settings['counter_icon']);

			if ($has_icon) {
				$this->add_render_attribute('i', 'class', $settings['counter_icon']);
				$this->add_render_attribute('i', 'aria-hidden', 'true');
			}

			if (!$has_icon && !empty($settings['icon']['value'])) {
				$has_icon = true;
			}
			$migrated = isset($settings['__fa4_migrated']['icon']);
			$is_new = !isset($settings['counter_icon']) && Icons_Manager::is_migration_allowed(); ?>

		<div class="classyea-counterUp__box-item-106 count-box">
			<?php if ('icon' === $classyea_counterup_icon_type) { ?>
				<span class="icon">
					<?php
					if ($is_new || $migrated) {
						Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']);
					} elseif (!empty($settings['counter_icon'])) {
					?><i <?php echo wp_kses_post($this->get_render_attribute_string('i')); ?>></i><?php } ?>
				</span>
				<?php
			} elseif ('image' === $classyea_counterup_icon_type) {
				$image = $settings['icon_image'];
				if ($image['url']) { ?>
					<span class="image">
						<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'image', 'icon_image'),'classyea_img'); ?>
					</span>
			<?php }
				}
			?>
			<h3 class="number" data-start="<?php echo esc_attr($starting_number);?>" data-target="<?php echo esc_attr($ending_number); ?>" data-speed="<?php echo esc_attr($counter_speed['size']); ?>"><?php echo wp_kses($ending_number,'classyea_kses'); ?></h3>
			<?php $this->classyea_title_tag();?>
		</div>
	<?php
	}
	/**
	 * Counter title function
	 * Render counter title output on the frontend.
	 * @access protected
	 */
	protected function classyea_title_tag(){
		$settings 				= $this->get_settings_for_display();
		$item_counter_title_two = $settings['item_counter_title_two'];
		$counter_title_tag 		= $settings['counter_title_tag'];
		if ($item_counter_title_two) {
			$this->add_render_attribute('item_counter_title_two', 'class', 'text', " ");
			$counter_title_tag = Header::classyea_validate_html_tag($counter_title_tag);
		?>
			<<?php echo esc_html($counter_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('item_counter_title_two')); ?>>
				<?php echo wp_kses($item_counter_title_two,'classyea_kses'); ?>
			</<?php echo esc_html($counter_title_tag); ?>>
		<?php } 
	}
}