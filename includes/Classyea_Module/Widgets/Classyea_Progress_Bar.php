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
class Classyea_Progress_Bar extends Widget_Base
{
	
	/**
	 * Retrieve progress_bar widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-progress-bar';
	}
	/**
	 * Retrieve progress_bar widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function randomString() {
		$length = 16;
		$chars  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str    = '';

		for ( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ mt_rand( 0, strlen( $chars ) - 1 ) ];
		}
		return $str;
	}
	public function get_title()
	{
		return esc_html__('Progress Bar', 'classyea');
	}
	/**
	 * Retrieve progress_bar widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-progress-bar';
	}
	/**
	 * Retrieve progress_bar widget category.
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
	 * Retrieve the list of keywords the widget belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return [
			'progress',
			'progress bar',
			'classy progress',
			'classyea progressbar',
			'progress box',
			'progress table',
			'progress box',
			'classy',
			'classy addons',
			'classyea progress'

		];
	}
	/**
	 * Register progress_bar widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_progress_bar_controls();
		$this->register_repeater_progress_bar_controls();

		/* Style Tab */
		$this->register_style_background_controls();
	}
	protected function register_content_progress_bar_controls()
	{

		/****
		 * Content Tab: progress_bar
		 ****/
		$this->start_controls_section(
			'section_progress_bar',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 10; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'progress_layout',
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
	protected function register_repeater_progress_bar_controls()
	{

		/**
		 * Content Repeater: progress_bar
		 */
		$this->start_controls_section(
			'section_progress_section',
			[
				'label'                 => __('Progress Details', 'classyea'),
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'                 => esc_html__('Bg Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'classyea'),
				'type' => Controls_Manager::ICONS,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-5'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
					]
				]
			]
		);

		$this->add_control(
			'prograss_bar_title',
			[
				'label'       => esc_html__('Progress Bar Title', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Digital Solution', 'classyea'),
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
			'prograss_content',
			[
				'label'       => esc_html__('Progress Bar Content', 'classyea'),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('This is the full preview of my InboxIQ', 'classyea'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-8'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
					]
				]
			]
		);

		$this->add_control(
			'progress',
			[
				'label'                 => esc_html__('Progress Number', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('65', 'classyea'),
			]
		);

		$this->add_control(
			'data_speed',
			[
				'label'                 => esc_html__('Data Speed', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('3000', 'classyea'),
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
				'selector'  => '{{WRAPPER}} .classyea-progress-bar-box, {{WRAPPER}} .classyea-progress-bar-box.style-two, {{WRAPPER}} .classyea-funfacts-block, {{WRAPPER}} .classyea-progress-bar-box.st , {{WRAPPER}} .classyea-progress-bar-box.style-four,{{WRAPPER}} .classyea-progress-bar-box.style-five ,{{WRAPPER}} .classyea-progress-bar-box.style-six, {{WRAPPER}} .classyea-progress-bar-box.style-seven, {{WRAPPER}} .classyea-progress-bar-two-box, {{WRAPPER}} .classyea-progress-bar-two-box.style-two',
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

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_progressbar_border',
				'selector'  => '{{WRAPPER}} .classyea-progress-bar-box, {{WRAPPER}} .classyea-progress-bar-box.style-two, {{WRAPPER}} .classyea-funfacts-block, {{WRAPPER}} .classyea-progress-bar-box.st , {{WRAPPER}} .classyea-progress-bar-inner-box,{{WRAPPER}} .classyea-progress-bar-box.style-five ,{{WRAPPER}} .classyea-progress-bar-box.style-six, {{WRAPPER}} .classyea-progress-bar-box.style-seven, {{WRAPPER}} .classyea-progress-bar-two-box, {{WRAPPER}} .classyea-progress-bar-two-box.style-two',
				'separator'  => 'after',
			]
		);

		$this->add_control(
			'classy_progressbar_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-progress-bar-box'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-two'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-funfacts-block'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.st'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-inner-box'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-five'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-six '     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-seven '     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-two-box '     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-two-box.style-two '     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'classy_progressbar_margin',
			[
				'label'                 => __('Margin', 'classyea'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'separator'             => 'after',
				'selectors'             => [
					'{{WRAPPER}} .classyea-progress-bar-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-funfacts-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.st' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-inner-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-five ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-six ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-seven ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-two-box ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-two-box.style-two ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classy_progressbar_padding',
			[
				'label'                 => __('Padding', 'classyea'),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => ['px', 'em', '%'],
				'separator'             => 'after',
				'selectors'             => [
					'{{WRAPPER}} .classyea-progress-bar-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-funfacts-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.st' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-inner-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-five ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-six ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-box.style-seven ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-two-box ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-progress-bar-two-box.style-two ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'classyea_progressbar_box_shadow',
				'selector'  => '{{WRAPPER}} .classyea-progress-bar-box, {{WRAPPER}} .classyea-progress-bar-box.style-two, {{WRAPPER}} .classyea-funfacts-block, {{WRAPPER}} .classyea-progress-bar-box.st , {{WRAPPER}} .classyea-progress-bar-fill.style-four,{{WRAPPER}} .classyea-progress-bar-box.style-five ,{{WRAPPER}} .classyea-progress-bar-box.style-six, {{WRAPPER}} .classyea-progress-bar-box.style-seven, {{WRAPPER}} .classyea-progress-bar-two-box, {{WRAPPER}} .classyea-progress-bar-two-box.style-two',
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

		// Title Section
		$this->start_controls_section(
			'title_section',
			array(
				'label' => __('Title', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __('Title', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-progress-bar-title,{{WRAPPER}} .classyea-funfacts-title,{{WRAPPER}} .classyea-progress-bar-title-three',
			)
		);
		$this->add_control(
			'title_color',
			array(
				'label'     => __('Title Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-funfacts-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-progress-bar-title-three' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'title_bg_color',
			array(
				'label'     => __('Title Bg', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-title,{{WRAPPER}} .classyea-funfacts-title,{{WRAPPER}} .classyea-progress-bar-title-three' => 'background: {{VALUE}}',
				),
			)
		);
		$this->add_responsive_control(
			'classyea_progress_title_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-progress-bar-title,{{WRAPPER}} .classyea-funfacts-title,{{WRAPPER}} .classyea-progress-bar-title-three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_progress_title_margin',
			[
				'label'      => esc_html__('Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-progress-bar-title,{{WRAPPER}} .classyea-funfacts-title,{{WRAPPER}} .classyea-progress-bar-title-three' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Progress Number Section

		$this->start_controls_section(
			'progress_section',
			array(
				'label' => __('Progress', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'progress_number_typography',
				'label'    => __('Progress Number', 'classyea'),
				'selector' => '{{WRAPPER}} .classyea-progress-bar-percent,{{WRAPPER}} .classyea-funfacts-count-text,{{WRAPPER}} .classyea-funfacts-count-prefix,{{WRAPPER}} .classyea-progress-bar-percent.style-five',
			)
		);
		$this->add_control(
			'progress_number_posiation_left',
			[
				'label' => esc_html__( 'Left', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-progress-bar-percent,{{WRAPPER}} .classyea-funfacts-count-text,{{WRAPPER}} .classyea-funfacts-count-prefix,{{WRAPPER}} .classyea-progress-bar-percent.style-five' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'progress_number_posiation_right',
			[
				'label' => esc_html__( 'Right', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-progress-bar-percent,{{WRAPPER}} .classyea-funfacts-count-text,{{WRAPPER}} .classyea-funfacts-count-prefix,{{WRAPPER}} .classyea-progress-bar-percent.style-five' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'progress_number_posiation_top',
			[
				'label' => esc_html__( 'Top', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-progress-bar-percent,{{WRAPPER}} .classyea-funfacts-count-text,{{WRAPPER}} .classyea-funfacts-count-prefix,{{WRAPPER}} .classyea-progress-bar-percent.style-five' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'progress_number_posiation_bottom',
			[
				'label' => esc_html__( 'Bottom', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-progress-bar-percent,{{WRAPPER}} .classyea-funfacts-count-text,{{WRAPPER}} .classyea-funfacts-count-prefix,{{WRAPPER}} .classyea-progress-bar-percent.style-five' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'Progress_number_color',
			array(
				'label'     => __('Progress Number Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-percent' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-funfacts-count-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-funfacts-count-prefix' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-progress-bar-percent.style-five' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'Progress_number_bg_color',
			array(
				'label'     => __('Progress Number BG Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-percent' => 'background: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-8'
						],
					]
				]
			)
		);

		$this->add_control(
			'Progress_color',
			array(
				'label'     => __('Progress Bar Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-fill' => 'background: {{VALUE}}',
					'{{WRAPPER}} .animated .classyea-progress-bar-fill-two' => 'background: {{VALUE}}',
					'{{WRAPPER}} .classyea-progress-bar-two-bar' => 'border-bottom-color: {{VALUE}}!important;border-right-color: {{VALUE}}!important',
				),
			)
		);

		$this->add_control(
			'Progress_bg_color',
			array(
				'label'     => __('Progress Bar BG Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-inner' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-progress-bar-two-bar' => 'border-color: {{VALUE}}',

				),
			)
		);
		$this->add_control(
			'progress_bar_height',
			[
				'label' => esc_html__( 'Height', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-progress-bar-inner,{{WRAPPER}} .classyea-progress-bar-two-bar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

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
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-10'
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
				'selector' => '{{WRAPPER}} .classyea-progress-bar-icon-two,{{WRAPPER}} .classyea-progress-bar-icon',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
					]
				]
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __('Icon Color', 'classyea'),
				'separator' => 'after',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-progress-bar-icon-two' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-progress-bar-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-progress-bar-percent.style-four .ca-icon' => 'color: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-5'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'progress_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
					]
				]
			)
		);

		$this->end_controls_section();
	}
	protected function render()
	{

		$this->classyea_render_progress_bar_repeater_control();
	}
	/**
	 * Service repeater control function
	 * Render counterup repeater output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_progress_bar_repeater_control()
	{
		$settings        = $this->get_settings_for_display();
		$progress_layout = $settings['progress_layout'];

		$randid =  $this->randomString();


		if ($progress_layout == 'layout-1') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
?>
			<!-- Progress Bar Style 01 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box wow fadeIn classyea-progress-bar-box-one" data-wow-delay="100ms" data-wow-duration="1500ms"  id="progress-bar-<?php echo esc_attr($randid); ?>">
				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
				<div class="classyea-progress-bar-inner-box">
					<div class="classyea-progress-bar-outside">
						<div class="classyea-progress-bar-inner">
							<div class="classyea-progress-bar-fill" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
						</div>
						<div class="classyea-progress-bar-percent"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
					</div>
				</div>
			</div>
		<?php } elseif ($progress_layout == 'layout-2') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
		?>
			<!-- Progress Bar Style 02 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box style-two wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">

				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title style-two"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
				<div class="classyea-progress-bar-inner-box">
					<div class="classyea-progress-bar-outside style-two">
						<div class="classyea-progress-bar-inner">
							<div class="classyea-progress-bar-fill style-two" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
						</div>
						<div class="classyea-progress-bar-percent style-two"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
					</div>
				</div>
			</div>
		<?php

		} elseif ($progress_layout == 'layout-3') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$bg_image    		= ($settings["bg_image"]["id"] != "") ? wp_get_attachment_image_url($settings["bg_image"]["id"], "full") : $settings["bg_image"]["url"];
			$bg_image_alt 		= get_post_meta($settings["bg_image"]["id"], "_wp_attachment_image_alt", true);
		?>
			<!-- Progress Bar Style 03 -->

			<div class="classyea-funfacts-block">
				<div class="classyea-funfacts-bg">
					<?php
					if (wp_http_validate_url($bg_image)) {
					?>
						<img src="<?php echo esc_url($bg_image); ?>" alt="<?php echo esc_attr($bg_image_alt); ?>">
					<?php
					} else {
						echo wp_kses_post($bg_image);
					}
					?>
				</div>
				<div class="classyea-funfacts-number">
					<span class="classyea-funfacts-count-text" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-funfacts-count-prefix">%</span>
				</div>
				<<?php echo esc_attr($title_tag); ?> class="classyea-funfacts-title"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
			</div>

		<?php
		} elseif ($progress_layout == 'layout-4') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$icon               = $settings["icon"];
		?>
			<!-- Progress Bar Style 04  -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box style-three wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<div class="classyea-progress-bar-icon">
					<?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?>
				</div>
				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title style-three"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
				<div class="classyea-progress-bar-inner-box">
					<div class="classyea-progress-bar-outside style-three">
						<div class="classyea-progress-bar-inner style-three">
							<div class="classyea-progress-bar-fill style-three" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
						</div>
						<div class="classyea-progress-bar-percent style-three"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
					</div>
				</div>
			</div>

		<?php
		} elseif ($progress_layout == 'layout-5') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$icon               = $settings["icon"];
		?>

			<!-- Progress Bar Style 05 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box style-four wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title style-four"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
				<div class="classyea-progress-bar-inner-box">
					<div class="classyea-progress-bar-outside style-four">
						<div class="classyea-progress-bar-inner style-four">
							<div class="classyea-progress-bar-fill style-four" data-percent="<?php echo esc_attr($ca_progress); ?>">
								<div class="classyea-progress-bar-percent style-four"><span class="ca-icon"><?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?></span><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		} elseif ($progress_layout == 'layout-6') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
		?>
			<!-- Progress Bar Style 06 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box style-five wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<div class="classyea-progress-bar-inner-box">
					<div class="classyea-progress-bar-percent-shape">
						<div class="classyea-progress-bar-percent style-five"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
					</div>
					<div class="classyea-progress-bar-outside style-five">
						<div class="classyea-progress-bar-inner style-five">
							<div class="classyea-progress-bar-fill style-five" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
						</div>
					</div>
				</div>
				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title style-five"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
			</div>
		<?php
		} elseif ($progress_layout == 'layout-7') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$prograss_content   = $settings['prograss_content'];
		?>
			<!-- Progress Bar Style 07 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box style-six wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title style-six"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?>></<?php echo esc_attr($title_tag); ?>>
				<div class="classyea-progress-bar-inner-box p-relative">
					<div class="classyea-progress-bar-percent style-six"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
					<div class="classyea-progress-bar-border"></div>
					<div class="classyea-progress-bar-outside style-six">
						<div class="classyea-progress-bar-inner style-six">
							<div class="classyea-progress-bar-fill style-six" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
						</div>
					</div>
				</div>
			</div>
		<?php
		} elseif ($progress_layout == 'layout-8') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$prograss_content   = $settings['prograss_content'];
			$icon               = $settings["icon"];
		?>
			<!-- Progress Bar Style 08 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-box style-seven wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<div class="classyea-progress-bar-inner-box p-relative">
					<div class="classyea-progress-bar-percent style-seven"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
					<div class="classyea-progress-bar-outside style-seven">
						<div class="classyea-progress-bar-inner style-seven">
							<div class="classyea-progress-bar-fill-two" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
						</div>
					</div>
				</div>
				<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title style-seven"><?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?></<?php echo esc_attr($title_tag); ?>>
				<div class="classyea-progress-bar-description"><?php echo wp_kses($prograss_content,'classyea_kses'); ?></div>
			</div>
		<?php
		} elseif ($progress_layout == 'layout-9') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$prograss_content   = $settings['prograss_content'];
			$icon               = $settings["icon"];
		?>
			<!-- Progress Bar Style 09 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-two-box wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<div class="classyea-progress-bar-two-out-side">
					<div class="classyea-progress-bar-two-bar"></div>
				</div>
				<span class="data-parcent d-none"><?php echo wp_kses_post($ca_progress); ?></span>
				<div class="text-center">
					<div class="classyea-progress-bar-icon-two"><?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?></div>
					<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title-three style-two">
						<div class="classyea-progress-bar-percent style-eight"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div>
						<?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?>
					</<?php echo esc_attr($title_tag); ?>>
					<div class="classyea-progress-bar-description-two"><?php echo wp_kses($prograss_content,'classyea_kses'); ?></div>
				</div>
			</div>

		<?php
		} elseif ($progress_layout == 'layout-10') {
			$prograss_bar_title = $settings['prograss_bar_title'];
			$title_tag          = $settings['title_tag'];
			$ca_progress        = $settings['progress'];
			$ca_data_speed      = $settings['data_speed'];
			$prograss_content   = $settings['prograss_content'];
			$icon               = $settings["icon"];

		?>
			<!-- Progress Bar Style 10 -->
			<div data-id="progress-bar-<?php echo esc_attr($randid); ?>" class="progress-bar-<?php echo esc_attr($randid); ?> classyea-progress-bar-two-box style-two wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<div class="classyea-progress-bar-outside style-eight">
					<div class="classyea-progress-bar-inner style-eight">
						<div class="classyea-progress-bar-fill-two style-two" data-percent="<?php echo esc_attr($ca_progress); ?>"></div>
					</div>
				</div>
				<div class="text-left">
					<div class="classyea-progress-bar-icon-two"><?php Icons_Manager::render_icon(($icon), array('aria-hidden' => 'true')); ?></div>
					<<?php echo esc_attr($title_tag); ?> class="classyea-progress-bar-title-three style-two">
						<div class="classyea-progress-bar-percent style-eight"><span class="classyea-progress-bar-percent-number" data-speed="<?php echo esc_attr($ca_data_speed); ?>" data-stop="<?php echo esc_attr($ca_progress); ?>"></span><span class="classyea-progress-bar-percent-prefix">%</span></div> <?php echo wp_kses($prograss_bar_title,'classyea_kses'); ?>
					</<?php echo esc_attr($title_tag); ?>>
					<div class="classyea-progress-bar-description-two"><?php echo wp_kses($prograss_content,'classyea_kses'); ?></div>
				</div>
			</div>
		<?php
		}
	}

	/**
	 * Service item button function
	 * Render progress_bar button output on the frontend.
	 * @access protected
	 */
	protected function classyea_progress_title()
	{
		$settings       = $this->get_settings_for_display();
		?>
		<<?php echo esc_attr($settings['title_tag']); ?> class="classyea-progress-bar-title"><?php echo wp_kses($settings['prograss_bar_title'], 'classyea_kses'); ?></<?php echo esc_attr($settings['title_tag']); ?>>
<?php

	}
}
