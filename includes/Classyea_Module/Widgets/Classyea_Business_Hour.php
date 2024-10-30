<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \ClassyEa\Helper\Classyea_Module\Settings\Classyea_Helper;
use \Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Business hour widget
 *
*/
class Classyea_Business_Hour extends Widget_Base
{

	/**
	 * Retrieve business hours widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-business-hours';
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}

	/**
	 * Retrieve business hours widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Business Hours', 'classyea');
	}

	/**
	 * Retrieve business hours widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-business-hour';
	}

	public function get_script_depends() {
		return [
			'classyea-business-hours'
		];
	}

	/**
	 * Retrieve business hours widget category.
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
			'our business hours',
			'classy business hour',
			'business hours',
			'business hour',
			'business hours',
			'classy',
			'classy addons',
			'business hours widget'
		];
	}

	/**
	 * Register business hours widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access private
	 */
	private function business_day_list() {
		$business_hours_list = array(
			'00:00' => '12:00 AM',
			'00:30' => '12:30 AM',
			'01:00' => '1:00 AM',
			'01:30' => '1:30 AM',
			'02:00' => '2:00 AM',
			'02:30' => '2:30 AM',
			'03:00' => '3:00 AM',
			'03:30' => '3:30 AM',
			'04:00' => '4:00 AM',
			'04:30' => '4:30 AM',
			'05:00' => '5:00 AM',
			'05:30' => '5:30 AM',
			'06:00' => '6:00 AM',
			'06:30' => '6:30 AM',
			'07:00' => '7:00 AM',
			'07:30' => '7:30 AM',
			'08:00' => '8:00 AM',
			'08:30' => '8:30 AM',
			'09:00' => '9:00 AM',
			'09:30' => '9:30 AM',
			'10:00' => '10:00 AM',
			'10:30' => '10:30 AM',
			'11:00' => '11:00 AM',
			'11:30' => '11:30 AM',
			'12:00' => '12:00 PM',
			'12:30' => '12:30 PM',
			'13:00' => '1:00 PM',
			'13:30' => '1:30 PM',
			'14:00' => '2:00 PM',
			'14:30' => '2:30 PM',
			'15:00' => '3:00 PM',
			'15:30' => '3:30 PM',
			'16:00' => '4:00 PM',
			'16:30' => '4:30 PM',
			'17:00' => '5:00 PM',
			'17:30' => '5:30 PM',
			'18:00' => '6:00 PM',
			'18:30' => '6:30 PM',
			'19:00' => '7:00 PM',
			'19:30' => '7:30 PM',
			'20:00' => '8:00 PM',
			'20:30' => '8:30 PM',
			'21:00' => '9:00 PM',
			'21:30' => '9:30 PM',
			'22:00' => '10:00 PM',
			'22:30' => '10:30 PM',
			'23:00' => '11:00 PM',
			'23:30' => '11:30 PM',
			'24:00' => '12:00 PM',
			'24:30' => '12:30 PM'
		);
		return $business_hours_list;
	}

	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_business_hour_controls();
		$this->register_repeater_service_controls();
		$this->register_day_style_controls();
	}

	protected function register_content_business_hour_controls()
	{

		/*****
		 * Content Tab: business hours
		 ****/
		$this->start_controls_section(
			'section_business_hour',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);

		$layouts = array();
		for ($x = 1; $x <= 9; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'business_hour_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before'
			]
		);

		$this->add_control(
			'business_timings_hour',
			array(
				'label'   => __( 'Business Timings', 'classyea' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default', 'classyea' ),
					'custom'     => __( 'Custom', 'classyea' )
				)
			)
		);

		$this->add_control(
			'hours_format',
			array(
				'label'        => __( 'Display 24 Hours Format?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'classyea' ),
				'label_off'    => __( 'No', 'classyea' ),
				'return_value' => 'yes',
				'condition'    => array(
					'business_timings_hour' => 'default'
				)
			)
		);

		$this->add_control(
			'days_format',
			array(
				'label'     => __( 'Display Days Format?', 'classyea' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'long',
				'options'   => array(
					'long'  => __( 'Long', 'classyea' ),
					'short' => __( 'Short', 'classyea' ),
				),
				'condition' => array(
					'business_timings_hour' => 'default'
				)
			)
		);

		$this->end_controls_section();
	}

	/*	Repeater Tab */
	protected function register_repeater_service_controls()
	{

		/****
		 * Content Repeater: business hours
		 ****/
		$this->start_controls_section(
			'section_bus_hour_item',
			[
				'label'                 => __('Business Hours', 'classyea'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'day',
			array(
				'label'   => __( 'Day Schedule', 'classyea' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Monday',
				'options' => array(
					'Monday'    => __( 'Monday', 'classyea' ),
					'Tuesday'   => __( 'Tuesday', 'classyea' ),
					'Wednesday' => __( 'Wednesday', 'classyea' ),
					'Thursday'  => __( 'Thursday', 'classyea' ),
					'Friday'    => __( 'Friday', 'classyea' ),
					'Saturday'  => __( 'Saturday', 'classyea' ),
					'Sunday'    => __( 'Sunday', 'classyea' )
				)
			)
		);

		$repeater->add_control(
			'closed',
			array(
				'label'        => __( 'Closed Enable?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'No', 'classyea' ),
				'label_off'    => __( 'Yes', 'classyea' ),
				'return_value' => 'no'
			)
		);

		$repeater->add_control(
			'opening_hours',
			array(
				'label'     => __( 'Opening Hours', 'classyea' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '10:00',
				'options'   => $this->business_day_list(),
				'condition' => array(
					'closed' => 'no'
				)
			)
		);

		$repeater->add_control(
			'closing_hours',
			array(
				'label'     => __( 'Closing Hours', 'classyea' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '20:00',
				'options'   => $this->business_day_list(),
				'condition' => array(
					'closed' => 'no'
				)
			)
		);

		$repeater->add_control(
			'closed_text',
			array(
				'label'       => __( 'Closed Text', 'classyea' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Closed', 'classyea' ),
				'default'     => __( 'Closed', 'classyea' ),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'closed',
							'operator' => '!=',
							'value'    => 'no',
						)
					)
				)
			)
		);

		$repeater->add_control(
			'highlight',
			array(
				'label'        => __( 'Color Highlight?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'classyea' ),
				'label_off'    => __( 'No', 'classyea' ),
				'return_value' => 'yes'
			)
		);

		$repeater->add_control(
			'highlight_bg',
			array(
				'label'     => __( 'Background Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-business-hour-item{{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-businessHour-408 ul li.classyea-businessHour-item{{CURRENT_ITEM}}' => 'background: {{VALUE}}!important',
				),
				'condition' => array(
					'highlight' => 'yes'
				)
			)
		);

		$repeater->add_control(
			'highlight_color',
			array(
				'label'     => __( 'Text Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-business-hour-item{{CURRENT_ITEM}}' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-businessHour-408 ul li.classyea-businessHour-item{{CURRENT_ITEM}}' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-business-hour-item{{CURRENT_ITEM}} .classyea-business-hour-day' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-business-hour-item{{CURRENT_ITEM}} .classyea-business-hour-time' => 'color: {{VALUE}}!important',
				),
				'condition' => array(
					'highlight' => 'yes'
				)
			)
		);

		$this->add_control(
			'business_hours',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'day' => 'Monday',
					),
					array(
						'day' => 'Tuesday',
					),
					array(
						'day' => 'Wednesday',
					),
					array(
						'day' => 'Thursday',
					),
					array(
						'day' => 'Friday',
					),
					array(
						'day'             => 'Saturday',
						'closed'          => 'yes',
						'highlight'       => 'yes',
						'highlight_color' => '#FF5252',
					),
					array(
						'day'             => 'Sunday',
						'closed'          => 'yes',
						'highlight'       => 'yes',
						'highlight_color' => '#FF5252',
					)
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ day }}}',
				'condition'   => array(
					'business_timings_hour' => 'default'
				)
			)
		);

		$repeater_custom = new Repeater();

		$repeater_custom->add_control(
			'day',
			array(
				'label'   => __( 'Day', 'classyea' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Monday'
			)
		);

		$repeater_custom->add_control(
			'closed',
			array(
				'label'        => __( 'Closed?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'No', 'classyea' ),
				'label_off'    => __( 'Yes', 'classyea' ),
				'return_value' => 'no'
			)
		);

		$repeater_custom->add_control(
			'time',
			array(
				'label'     => __( 'Time', 'classyea' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '10:00 AM - 07:00 PM',
				'condition' => array(
					'closed' => 'no'
				)
			)
		);

		$repeater_custom->add_control(
			'closed_text',
			array(
				'label'       => __( 'Closed Text', 'classyea' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Closed', 'classyea' ),
				'default'     => __( 'Closed', 'classyea' ),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'closed',
							'operator' => '!=',
							'value'    => 'no',
						)
					)
				)
			)
		);

		$repeater_custom->add_control(
			'highlight',
			array(
				'label'        => __( 'Color Highlight?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'classyea' ),
				'label_off'    => __( 'No', 'classyea' ),
				'return_value' => 'yes'
			)
		);

		$repeater_custom->add_control(
			'highlight_bg',
			array(
				'label'     => __( 'Background Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'highlight' => 'yes'
				)
			)
		);

		$repeater_custom->add_control(
			'highlight_color',
			array(
				'label'     => __( 'Text Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'highlight' => 'yes'
				)
			)
		);

		$this->add_control(
			'business_hours_custom',
			array(
				'label'       => 'Business Hour List',
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'day' => 'Monday',
					),
					array(
						'day' => 'Tuesday',
					),
					array(
						'day' => 'Wednesday',
					),
					array(
						'day' => 'Thursday',
					),
					array(
						'day' => 'Friday',
					),
					array(
						'day'             => 'Saturday',
						'closed'          => 'yes',
						'highlight'       => 'yes',
						'highlight_color' => '#FF5252',
					),
					array(
						'day'             => 'Sunday',
						'closed'          => 'yes',
						'highlight'       => 'yes',
						'highlight_color' => '#FF5252',
					)
				),
				'fields'      => $repeater_custom->get_controls(),
				'title_field' => '{{{ day }}}',
				'condition'   => array(
					'business_timings_hour' => 'custom',
				)
			)
		);

		$this->add_control(
			'item_business_heading',
			array(
				'label'        => __( 'Display Business Heading?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'classyea' ),
				'label_off'    => __( 'No', 'classyea' ),
				'return_value' => 'yes'
			)
		);

		$this->add_control(
			'item_business_hour_heading',
			[
				'label'                 => __('Business Heading', 'classyea'),
				'label_block' 			=> true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Business Hours', 'classyea'),
				'condition'             => [
					'item_business_heading'    => 'yes'
					
				]
			]
		);

		$this->add_control(
			'business_item_heading_tag',
			[
				'label'   => __('Select Heading Tag', 'classyea'),
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
				'condition'             => [
					'item_business_hour_heading!'    => '',
				]
			]
		);

		$this->add_control(
			'item_business_hour_sub_heading',
			[
				'label'                 => __('Business Sub Heading', 'classyea'),
				'label_block' 			=> true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Business Hours', 'classyea'),
				'condition'             => [
					'business_hour_layout'    => 'layout-4'	
				]
			]
		);

		$this->add_control(
			'item_business_hour_bottom_heading',
			[
				'label'                 => __('Business Sub Heading', 'classyea'),
				'label_block' 			=> true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Business Hours', 'classyea'),
				'condition'             => [
					'business_hour_layout'    => 'layout-4'
					
				]
			]
		);

		$this->add_control(
			'icon_image_on_off',
			array(
				'label'        => __( 'Display Iocn Image?', 'classyea' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'classyea' ),
				'label_off'    => __( 'No', 'classyea' ),
				'return_value' => 'yes'
			)
		);

		$this->add_control(
			'icon_image',
			[
				'label'                 => esc_html__('Icon Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'             => [
					'icon_image_on_off' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'icon_image[url]!' => '',
				],
				'condition'             => [
					'icon_image_on_off' => 'yes'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function register_day_style_controls()
	{
		$this->start_controls_section(
			'classyea_business_background_wrapper_style_section',
			[
				'label' => esc_html__( 'Main Wrapper', 'classyea' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'business_hour_layout'    => ['layout-4','layout-2','layout-6']
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'classyea_main_wrapper_background',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .classyea-businessHour-453 ul,{{WRAPPER}} .classyea-businessHour-452,{{WRAPPER}} .classyea-businessHour-box-455'
				
			]
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_main_wrapper_form_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-businessHour-453 ul!important,{{WRAPPER}} .classyea-businessHour-452!important,{{WRAPPER}} .classyea-businessHour-box-455',
            ]
        );
		$this->add_responsive_control(
			'classyea_business_hour_mian_wrapper_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-businessHour-453' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-452' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-box-455' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		// Style Business day section
		$this->start_controls_section(
			'classyea_business_hour_day_style_section',
			[
				'label' => esc_html__( 'Business Day', 'classyea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'classyea_business_hour_day_color',
			[
				'label'     => esc_html__( 'Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-day' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-businessHour-box-454 ul .classyea-business-hour-item.item-closed .classyea-business-hour-day' => 'color: {{VALUE}}!important;',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'classyea_business_hour_day_typography',
				'selector' => '{{WRAPPER}} .classyea-business-hour-day'
			]
		);

		$this->add_responsive_control(
			'classyea_business_hour_item_day_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-day' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_business_hour_item_day_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();

		// Style Business Time section
		$this->start_controls_section(
			'classyea_business_hour_time_style_section',
			[
				'label' => esc_html__( 'Business Time', 'classyea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'classyea_business_hour_time_color',
			[
				'label'     => esc_html__( 'Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-time' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-businessHour-item' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'classyea_business_hour_time_typography',
				'selector' => '{{WRAPPER}} .classyea-business-hour-time,{{WRAPPER}} .classyea-businessHour-item',
			]
		);

		$this->add_responsive_control(
			'classyea_business_hour_item_time_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-time' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_business_hour_item_time_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		// Style Item section
		$this->start_controls_section(
            'classyea_business_item_style_section',
            [
                'label' => esc_html__( 'Item Style', 'classyea' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'classyea_acc_title_text',
            [
                'label'     => esc_html__( 'Wrapper Border', 'classyea' ),
                'type'      => Controls_Manager::HEADING,
            ]
        );
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_mian_business_item_border',
				'label' => esc_html__( 'Wrapper Border', 'classyea' ),
				'selector' => '{{WRAPPER}} .classyea-businessHour-451 ul,{{WRAPPER}} .classyea-businessHour-408 ul',
			]
		);

		$this->add_responsive_control(
			'classyea_business_item_margin',
			[
				'label' => esc_html__( 'Margin', 'classyea' ),
				'separator' => 'before',
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-408 ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'classyea_business_item_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-408 ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'after'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'classyea_business_item_background',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .classyea-business-hour-item,{{WRAPPER}} .classyea-businessHour-408 ul',
			]
		);

		$this->add_responsive_control(
			'classyea_business_item_item_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-businessHour-408 ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_business_item_border',
				'label' => esc_html__( 'Border', 'classyea' ),
				'selector' => '{{WRAPPER}} .classyea-business-hour-item:not(:last-child),{{WRAPPER}} .classyea-businessHour-item:not(:last-child)',
			]
		);

        $this->end_controls_section();

		// Style Heading section
		$this->start_controls_section(
            'classyea_business_heading_section',
            [
                'label' => esc_html__( 'Heading & Sub Heading', 'classyea' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_heading_title_typography',
                'selector' => '{{WRAPPER}} .classyea-business-hours-title h3,{{WRAPPER}} .classyea-business-hours-title,{{WRAPPER}} .classyea-businessHour-heading,{{WRAPPER}} .heading,{{WRAPPER}} #classyea-businessHour-box-453 .classyea-businessHour-453 ul .classyea-business-hour-titleHeader h3',
                'separator' => 'after'
            ]
        );

		$this->add_control(
			'title_heading',
			[
				'label'                 => __('Sub Heading Typography', 'classyea'),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_sub_heading_heading_title_typography',
                'selector' => '{{WRAPPER}} .classyea-business-hour-title h3,{{WRAPPER}} .heading,{{WRAPPER}} .classyea-business-hour-title,{{WRAPPER}} #classyea-businessHour-box-453 .classyea-businessHour-453 ul .classyea-business-hour-title,{{WRAPPER}} #classyea-businessHour-box-453 .classyea-businessHour-453 ul .classyea-business-hour-title h3',
                'separator' => 'after'
            ]
        );

		$this->add_responsive_control(
			'classyea_business_heading_margin',
			[
				'label' => esc_html__( 'Margin', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-business-hour-titleHeader' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'before'
			]
		);

		$this->add_responsive_control(
			'classyea_business_heading_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-business-hour-titleHeader' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'after'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'classyea_business_heading_background',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .classyea-business-hour-title,{{WRAPPER}} .classyea-business-hour-titleHeader,{{WRAPPER}} .heading'
				
			]
		);

		$this->add_responsive_control(
			'classyea_business_heading_color',
			[
				'label'     => esc_html__( 'Text Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hours-title' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-businessHour-heading' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} #classyea-businessHour-box-453 .classyea-businessHour-453 ul .classyea-business-hour-title' => 'color: {{VALUE}}!important;',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_business_heading_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-business-hour-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-business-hour-titleHeader' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_business_heading_border',
				'label' => esc_html__( 'Border', 'classyea' ),
				'selector' => '{{WRAPPER}} .classyea-business-hour-title:not(:last-child),{{WRAPPER}} .classyea-business-hour-titleHeader:not(:last-child),{{WRAPPER}} .heading:not(:last-child)',
				
			]
		);

        $this->end_controls_section();

		// Style Heading section
		$this->start_controls_section(
            'classyea_bottom_business_heading_section',
            [
                'label' => esc_html__( 'Bottom Heading', 'classyea' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_bottom_heading_title_typography',
                'selector' => '{{WRAPPER}} .classyea-businessHour-453 .classyea-business-hour-book h3',
                'separator' => 'after'
            ]
        );

		$this->add_responsive_control(
			'classyea_bottom_business_heading_margin',
			[
				'label' => esc_html__( 'Margin', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-businessHour-453 .classyea-business-hour-book' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'before'
			]
		);

		$this->add_responsive_control(
			'classyea_bottom_business_heading_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-businessHour-453 .classyea-business-hour-book' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'after'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'classyea_bottom_business_heading_background',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .classyea-businessHour-453 .classyea-business-hour-book'
				
			]
		);

		$this->add_responsive_control(
			'classyea_bottom_business_heading_color',
			[
				'label'     => esc_html__( 'Text Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-businessHour-453 .classyea-business-hour-book' => 'color: {{VALUE}}!important;',
				]
			]
		);
        $this->end_controls_section();
	}

	protected function render()
	{
		$settings 			   =  $this->get_settings_for_display();
		$business_hour_layout  = $settings['business_hour_layout'];
		$item_business_heading = $settings['item_business_heading'];

		if( $business_hour_layout == 'layout-4') : 
			$item_business_hour_sub_heading    = $settings['item_business_hour_sub_heading'];
			$item_business_hour_bottom_heading = $settings['item_business_hour_bottom_heading'];
		endif;

		$section_inside = 'classyea-businessHour-451';
		$title_header   = 'classyea-business-hour-title';

		switch ($business_hour_layout) {
			case 'layout-1':
				$section_id 	= 'classyea-businessHour-box-451';
				$section_inside = 'classyea-businessHour-451';
				break;
			case 'layout-2':
				$section_id 	= 'classyea-businessHour-box-452';
				$section_inside = 'classyea-businessHour-452';
				break;
			case 'layout-3':
				$section_id     = 'classyea-businessHour-box-459';
				$section_inside = 'classyea-businessHour-459';
				
				break;
			case 'layout-4':
				$section_id     = 'classyea-businessHour-box-453';
				$section_inside = 'classyea-businessHour-453';
				$title_header   = 'classyea-business-hour-titleHeader';
				break;
			case 'layout-5':
				$section_id     = 'classyea-businessHour-section-454';
				$section_inside = 'classyea-businessHour-box-454';
				break;
			case 'layout-6':
				$section_id     = 'classyea-business-hours-section-206';
				$section_inside = 'classyea-businessHour-box-455';
				break;
			case 'layout-7':
				$section_id     = 'classyea-business-hours-section-206';
				$section_inside = 'classyea-businessHour-box-456';
				break;
			case 'layout-8':
				$section_id     = 'classyea-business-hours-section-206';
				$section_inside = 'classyea-businessHour-407';
				$title_header   = 'classyea-businessHour-item heading';
				break;
			case 'layout-9':
				$section_id     = 'classyea-business-hours-section-206';
				$section_inside = 'classyea-businessHour-408';
				$title_header   = 'classyea-businessHour-item heading';
				
				break;
			default:
				$section_id     = 'classyea-business hours-section-203';
		}
	
		if( $business_hour_layout == 'layout-3' ) : ?>
			<div class="classyea-businessHour-bottom-459">
				<?php endif;
					if( $business_hour_layout == 'layout-1' ||
						$business_hour_layout == 'layout-2' || $business_hour_layout == 'layout-3' || $business_hour_layout == 'layout-4') : ?>
						<div id="<?php echo esc_attr( $section_id );?>">
							<?php endif; ?>
							<div class="<?php echo esc_attr( $section_inside );?>">
								<?php 
									if( $business_hour_layout == 'layout-7') {
										$this->classyea_render_business_box_icon_image();
										$this->classyea_render_business_hour_title();
									}
								?>
								<ul>
									<?php
										if ( 'default' === $settings['business_timings_hour'] || 'custom' === $settings['business_timings_hour'] ) { 

										 	if( $item_business_heading  == 'yes' && ($business_hour_layout == 'layout-1' || $business_hour_layout == 'layout-3' || $business_hour_layout == 'layout-4' || $business_hour_layout == 'layout-8' || $business_hour_layout == 'layout-9' ) ) :  
											 	?>
													<li class="<?php echo esc_attr($title_header);?>">
														<?php $this->classyea_render_business_hour_title();?>
													</li>
												<?php 
											endif;

											if($business_hour_layout == 'layout-4') { 
												?>
													<li class="classyea-business-hour-title">
														<h3><?php echo wp_kses( $item_business_hour_sub_heading,'classyea_kses' );?></h3>
													</li>
												<?php 
											} 

											$this->classyea_busin_default_repeater_control( $settings ); 

											if($business_hour_layout == 'layout-4') { 
												?>
													<li class="classyea-business-hour-book">
														<h3><?php echo wp_kses( $item_business_hour_bottom_heading,'classyea_kses');?></h3>
													</li>
												<?php 
											} 
										}
									?>
								</ul>
							</div>
							<?php 
							  if( $business_hour_layout == 'layout-1' || $business_hour_layout == 'layout-2' || $business_hour_layout == 'layout-3' || $business_hour_layout == 'layout-4') : 
							?>
						</div>
					<?php endif;
		    	if( $business_hour_layout == 'layout-3' ) : ?>
			</div>
		<?php endif;
	}
	/**
	 * Business hour title function
	 * Render business hours title output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_business_hour_title()
	{
		$settings 	      = $this->get_settings_for_display();
		$business_heading = $settings['item_business_hour_heading'];
		if ( $business_heading ) {
			$this->add_inline_editing_attributes('item_business_hour_heading', 'none');
			$this->add_render_attribute('item_business_hour_heading', 'class', 'classyea-business-hours-title classyea-businessHour-heading');

			if ( $business_heading ) {
				$title_tag = Classyea_Helper::classyea_validate_html_tag( $settings['business_item_heading_tag'] );
		?>
				<<?php echo esc_html( $title_tag ); ?> <?php echo wp_kses_post($this->get_render_attribute_string('item_business_hour_heading')); ?>>
					<?php echo wp_kses( $business_heading, 'classyea_kses' ); ?>
				</<?php echo esc_html( $title_tag ); ?>>
			<?php
			}
		}
	}
	/**
	 * Business repeater control function
	 * Render business hours description output on the frontend.
	 * @access protected
	 */
	protected function classyea_busin_default_repeater_control( $settings )
	{
		$settings 			   = $this->get_settings_for_display();
		$business_timings_hour = $settings['business_timings_hour'];
		if( $business_timings_hour == 'default' ) {
			$business_hours = $settings['business_hours'];
		} else{
			$business_hours = $settings['business_hours_custom'];
		}

		foreach ( $business_hours as $index => $business_item ) { 

			$setting_key = $this->get_repeater_setting_key( 'business', 'business_hours', $index );

			$this->add_render_attribute( $setting_key, 'class', [
				'classyea-business-hour-item',
				'classyea-businessHour-item',
				'elementor-repeater-item-' . esc_attr( $business_item['_id'] ),
			] );
			
			if ( 'no' !== $business_item['closed'] ) {
				$this->add_render_attribute( $setting_key, 'class', 'item-closed' );
			}

			?>
			<li <?php echo wp_kses_post( $this->get_render_attribute_string( $setting_key ) ); ?>>
				<?php 
					$this->classyea_render_business_day( $settings, $business_item );
					$this->classyea_render_business_time( $settings, $business_item );
				 ?>
			</li>
	   <?php } // endif
	}
	/**
	 * Business day function
	 * Render business day output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_business_day( $settings, $item ) {

		$day_format = $settings['days_format']; 
		?>
			<span dir="rtl" class="classyea-business-hour-day"><?php if ( 'long' === $day_format ) { echo esc_attr( ucwords( $item['day'] ) );} else { echo esc_attr( ucwords( substr( $item['day'], 0, 3 ) ) );} ?></span>			
		<?php 
	}
	/**
	 * Business hour time function
	 * Render business time output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_business_time( $settings, $item ){

		$business_timings_hour = $settings['business_timings_hour'];

		if( $business_timings_hour == 'default' ){

			if ( 'no' === $item['closed'] ) { ?>
				<span class="classyea-business-hour-time">
					<?php
					if ( 'yes' === $settings['hours_format'] ) {
						echo esc_attr( $item['opening_hours'] );
					} else {
						echo esc_attr( gmdate( 'g:i A', strtotime( $item['opening_hours'] ) ) );
					}
					?>
					-
					<?php
					if ( 'yes' === $settings['hours_format'] ) {
						echo esc_attr( $item['closing_hours'] );
					} else {
						echo esc_attr( gmdate( 'g:i A', strtotime( $item['closing_hours'] ) ) );
					}
					?>
					</span>
			<?php } else { ?>
				<span class="classyea-business-hour-time">
					<?php 
						if ( $item['closed_text'] ) {
						echo esc_attr( $item['closed_text'] );
						} else {
							esc_attr_e( 'Closed', 'classyea' );
						} 
					?>
				</span>
			<?php

			} 
		} else {
			if ( 'no' === $item['closed'] && $item['time'] ) {
				echo esc_attr( $item['time'] );
			} else {
				if ( $item['closed_text'] ) {
					echo esc_attr( $item['closed_text'] );
				} else {
					esc_attr_e( 'Closed', 'classyea' );
				}
			}
		}			
	}
	/**
	 * Business hour icon image function
	 * Render business hour box icon image output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_business_box_icon_image()
	{
		$settings = $this->get_settings_for_display();

		if ( !empty( $settings['icon_image']['url'] ) ) : 
			?>
				<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'icon_image' ),'classyea_img' ); ?></hr>
			<?php 
		endif;
	}
}