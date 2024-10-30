<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \ClassyEa\Helper\Elementor\Settings\Header;
use \Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Service Widget
 */
class Classyea_Service extends Widget_Base
{

	/**
	 * Retrieve service widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-service';
	}

	public function get_style_depends()
	{
		return [
			'font-awesome-5-all-classyea',
		];
	}
	/**
	 * Retrieve service widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Service', 'classyea');
	}
	/**
	 * Retrieve service widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-service-box';
	}
	/**
	 * Retrieve service widget category.
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
			'our service',
			'classy service',
			'classyea service',
			'services',
			'services card',
			'classy',
			'classy addons',
			'classyea service builder'

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
		$this->register_content_service_controls();
		$this->register_repeater_service_controls();

		/* Style Tab */
		$this->register_style_background_controls();
	}
	protected function register_content_service_controls()
	{

		/****
		 * Content Tab: service
		 ****/
		$this->start_controls_section(
			'section_service',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'service_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);
		$this->add_control(
			'box_style',
			[
				'label'   => __('Box Style', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'1'   => __('Design 1', 'classyea'),
					'2'   => __('Design 2', 'classyea'),
					'3'   => __('Design 3', 'classyea'),
					'default'   => __('default', 'classyea'),
				],
				'condition'             => [
					'service_layout'    => [
						'layout-3',
						'layout-4',
						'layout-6',
					]
				]
			]
		);
		$this->end_controls_section();
	}
	/***
	/*	Repeater TAB
	**/
	protected function register_repeater_service_controls()
	{

		/**
		 * Content Repeater: service
		 */
		$this->start_controls_section(
			'section_service_item',
			[
				'label'                 => __('Service Details', 'classyea'),
			]
		);
		$this->add_control(
			'item_content_heading',
			[
				'label' => __('Display Item Heading?', 'classyea'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'classyea'),
				'label_off' => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'service_heading',
			[
				'label'       => esc_html__('Service Heading', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Graphic Design', 'classyea'),
			]
		);

		$this->add_control(
			'service_heading_tag',
			[
				'label'   => __('Select Service Title Tag', 'classyea'),
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
			'service_content',
			[
				'label'                 => esc_html__('Service Content', 'classyea'),
				'type'                  => Controls_Manager::TEXTAREA,
				'label_block'           => true,
				'default'               => __('Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet.', 'classyea'),
			]
		);
		$this->add_control(
			'service_content_tag',
			[
				'label'   => __('Select Content  Tag', 'classyea'),
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
			'service_icon_type',
			[
				'label'   => esc_html__('Icon type ', 'classyea'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'icon'       => [
						'title' => esc_html__('Icon', 'classyea'),
						'icon'  => 'fa fa-star',
					],
					'image_icon' => [
						'title' => esc_html__('Image', 'classyea'),
						'icon'  => 'fa fa-image',
					],
					'none'       => [
						'title' => esc_html__('None', 'classyea'),
						'icon'  => 'fa fa-stop-circle',
					]
				],
				'default' => 'icon',
				'toggle'  => true,
			]
		);
		$this->add_control(
			'classyea_service_icons__switch',
			[
				'label'     => esc_html__('Add icon? ', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'condition' => [
					'service_icon_type' => 'icon',
				]
			]
		);

		$this->add_control(
			'classyea_service_icons',
			[
				'label'            => esc_html__('Icon', 'classyea'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility'      => 'service_icon',
				'default'          => [
					'value'   => 'fab fa-amazon',
					'library' => 'fa-brands',
				],
				'condition'        => [
					'service_icon_type'     => 'icon',
					'classyea_service_icons__switch' => 'yes',
				]
			]
		);
		$this->add_control(
			'service_image',
			[
				'label'                 => esc_html__('Service Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'service_icon_type' => 'image_icon',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'service_image[url]!' => '',
				],
				'condition' => [
					'service_icon_type' => 'image_icon',
				]
			]
		);
		$this->add_control(
			'service_number',
			[
				'label'                 => esc_html__('Service Number', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('01', 'classyea'),
			]
		);
		$this->add_control(
			'link_type',
			array(
				'label'   => __('Link Type', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'  => __('None', 'classyea'),
					'image' => __('Image', 'classyea'),
					'title' => __('Title', 'classyea'),
					'button' => __('Button', 'classyea'),
				)
			)
		);

		$this->add_control(
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
					'link_type!'   => 'none',
				]
			]
		);
		$this->add_control(
			'service_button_text',
			[
				'label'                 => __('Button Text', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => __('Know More', 'classyea'),
				'condition'             => [
					'link_type'   => 'button',
				]
			]
		);
		$this->end_controls_section();
	}
	/*	Background TAB */
	protected function register_style_background_controls()
	{

		$this->start_controls_section(
			'classyea_section_counterup_style_settings',
			[
				'label' => esc_html__('Container Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'normal_background',
			[
				'label'                 => __( 'Normal Background', 'classyea' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_bgtype',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-service-box-203,{{WRAPPER}} .classyea-service-box-204,{{WRAPPER}} .classyea-service-item-201,{{WRAPPER}} .classyea-service-item-2,{{WRAPPER}} .classyea-service-item-3',
				'condition'             => [
					'service_layout'    => [
						'layout-1',
						'layout-2',
						'layout-3',
					]
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_bgtype_two',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-service-205 .classyea-service,{{WRAPPER}} #classyea-service-box-202 .classyea-service-item-202,{{WRAPPER}} .classyea-service',
				'condition'             => [
					'service_layout'    => [
						'layout-4',
						'layout-5',
						'layout-6',
					]
				]
			]
		);
		$this->add_control(
			'hover_background',
			[
				'label'                 => __( 'Hover Background', 'classyea' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-2',
					]
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_hover_bg_bgtype',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-service-box-204:hover',
				'condition'             => [
					'service_layout'    => [
						'layout-2',
					]
				]
			]
		);

        $this->add_control(
            'classyea_contact_form_border_radius',
            [
                'label' => esc_html__('Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-box-203' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-service-box-204' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-service-item-201' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-service-item-202' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-service-205 .classyea-service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-service-206 .classyea-service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_contact_form_border',
                'selector' => '{{WRAPPER}} .classyea-service-box-203,{{WRAPPER}} .classyea-service-box-204,{{WRAPPER}} .classyea-service-item-201,{{WRAPPER}} .classyea-service-item-202,{{WRAPPER}} .classyea-service-205 .classyea-service,{{WRAPPER}} .classyea-service-206 .classyea-service',
				'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_contact_form_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-service-box-203,{{WRAPPER}} .classyea-service-box-204,{{WRAPPER}} .classyea-service-item-201,{{WRAPPER}} .classyea-service-item-202,{{WRAPPER}} .classyea-service-205 .classyea-service,{{WRAPPER}} .classyea-service-206 .classyea-service',
				'separator' => 'before',
            ]
        );

		$this->add_control(
            'bottom_border_hover_color',
            [
                'label' => __('Bottom Border Hover Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-206 .classyea-service-box-content:before' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        /**
         * Style Tab: Input & Textarea
        **/
        $this->start_controls_section(
            'section_title_content_style',
            [
                'label' => __('Title & Content', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-heading' => 'color: {{VALUE}}!important',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-service-heading',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-service-heading',
                'separator' => 'before',
            ]
        );
		$this->add_control(
            'content_color',
            [
                'label' => __('Content Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-text' => 'color: {{VALUE}}!important',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Content Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-service-text',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-service-text',
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'content_hover_color',
            [
                'label' => __('Content Hover Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-box-204:hover *' => 'color: {{VALUE}}!important',
                ],
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-2',
					]
				]
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'section_icon_style',
            [
                'label' => __('Icon Style', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-box-204 .icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-item-201 .classyea-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-item-3 .classyea-service-icon,.classyea-service-item-2 .classyea-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-item-202 .classyea-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-item-22 .classyea-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-205 .classyea-service .classyea-service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-206 .colorOne .service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-206 .colorTwo .service-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-206 .colorThree .service-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-service-box-203 .service-icon' => 'color: {{VALUE}}',
					
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'icon_background',
            [
                'label' => __('Icon Background', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-205 .classyea-service .classyea-service-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-item-202 .classyea-service-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-service-item-22 .classyea-service-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-service-box-203 .service-icon' => 'background: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-1',
						'layout-5',
						'layout-4',
					]
				]
            ]
        );

		$this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Hover Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-box-203 .service-icon:hover' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-1',
					]
				]
            ]
        );

		$this->add_control(
            'icon_hover_color_layout_5',
            [
                'label' => __('Icon Hover Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-205:hover .classyea-service-icon i' => 'color: {{VALUE}} !important',
                ],
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-5',
					]
				]
            ]
        );

		$this->add_control(
            'icon_hover_background',
            [
                'label' => __('Icon Hover Background', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-box-203 .service-icon:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-service-item-202 .classyea-service-icon:hover' => 'background-color: {{VALUE}}'
					
                ],
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-1',
						'layout-4',
						'layout-5',
					]
				]
            ]
        );

		$this->add_control(
			'hover_icon_background',
			[
				'label'                 => __( 'Icon Background', 'classyea' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-5',
						'layout-6',
					]
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_image_background',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-service-206 .colorOne .service-icon,{{WRAPPER}} .classyea-service-206 .colorTwo .service-icon,{{WRAPPER}} .classyea-service-206 .colorThree .service-icon',
				'condition'             => [
					'service_layout'    => [
						'layout-6',
					]
				]
			]
		);
		
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_icon_border',
                'selector' => '{{WRAPPER}} .classyea-service-item-11 .classyea-service-icon::after',
				'condition'             => [
					'service_layout'    => [
						'layout-4',
					]
				]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow_service',
                'selector' => '{{WRAPPER}} .classyea-service .classyea-service-icon',
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-5',
					]
				]
            ]
        );
		$this->end_controls_section();

		//Service Number Section

		$this->start_controls_section(
            'service_number_section',
            array(
                'label' => __('Service Number', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'service_layout'    => [
						'layout-3',
					]
				]
            )
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'label' => __('Service Number Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-service-item-201 .service-number',
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'service_number_color',
            [
                'label' => __('Service Number Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-item-201 .service-number' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		 //Button Section

		 $this->start_controls_section(
            'button_section',
            array(
                'label' => __('Button', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        
		$this->add_control(
            'button_color',
            [
                'label' => __('Button Title Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-btn' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'button_bg_color',
            [
                'label' => __('Button BG Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-btn' => 'background: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'service_layout'    => [
						'layout-5',
					]
				]
            ]
        );

		$this->end_controls_section();

		//Overlay Section

		$this->start_controls_section(
            'overlay_section',
            array(
                'label' => __('Overlay', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'service_layout'    => [
						'layout-5',
					]
				]
            )
        );

		$this->add_control(
            'overlay_bg_color',
            [
                'label' => __('Overlay Background Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-205:before' => 'background: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'overlay_color',
            [
                'label' => __('Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-205:hover *' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'overlay_button_bg_color',
            [
                'label' => __('Overlay Button BG Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-service-205:hover .classyea-service-btn' => 'background: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();
	}
	protected function render()
	{
		$settings =  $this->get_settings_for_display();

		$service_layout = $settings['service_layout'];
		
		switch ($service_layout) {
			case 'layout-1':
				$section_id = 'classyea-service-section-203';
				break;
			case 'layout-2':
				$section_id = 'classyea-service-section-204';
				break;
			case 'layout-3':
				$section_id = 'classyea-service-section-201';
				break;
			case 'layout-4':
				$section_id = 'classyea-service-section-202';
				break;
			case 'layout-5':
				$section_id = 'classyea-service-section-205';
				break;
			case 'layout-6':
				$section_id = 'classyea-service-section-206';
				break;
			default:
				$section_id = 'classyea-service-section-203';
		}
			?>
				<?php
				if ($service_layout == 'layout-2') { ?>
					<?php 
					// repeater control
					$this->classyea_render_service_repeater_control();
				} 
			if ($service_layout == 'layout-3') : ?>
                <div id="classyea-service-box-201">
					<?php 
					// repeater control
					$this->classyea_render_service_repeater_control();
					?>
				</div>
			<?php endif;
			if ($service_layout == 'layout-4') : ?>
			<div class="<?php echo esc_attr($section_id);?>">
				<div class="classyea-service-bottom-202">
					<div id="classyea-service-box-202">
					<?php 
						// repeater control
						$this->classyea_render_service_repeater_control();
					?>
					</div>
				</div>
			</div>
			<?php endif;
			if ($service_layout == 'layout-5') : ?>
				<?php 
					// repeater control
					$this->classyea_render_service_repeater_control();
				
			 endif;
			if ($service_layout == 'layout-1') : 
					// repeater control
					$this->classyea_render_service_repeater_control();
				
			endif;
			 if ($service_layout == 'layout-6') : ?>
				<div class="classyea-service-206">
				<?php 
					// repeater control
						$this->classyea_render_service_repeater_control();
					?>
				</div>
			<?php endif;
	}
	/**
	 * Service repeater control function
	 * Render counterup repeater output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_service_repeater_control()
	{
		$settings       = $this->get_settings_for_display();
		$service_layout = $settings['service_layout'];
		$box_style      = $settings['box_style'];
		
		$item_content_heading = $settings['item_content_heading'];

		if($box_style == '1'){
			$box_class 		 = 'classyea-service-item-11';
			$box_class_two   = 'classyea-service-item-2';
			$box_class_three = 'colorOne';
		}elseif($box_style == '2'){
			$box_class 		 = 'classyea-service-item-22';
			$box_class_two   = 'classyea-service-item-3';
			$box_class_three = 'colorTwo';
		}
		elseif($box_style == '3'){
			$box_class       = 'classyea-service-item-11';
			$box_class_two   = 'classyea-service-item-4';
			$box_class_three = 'colorThree';
		}
		else{
			$box_class       = 'classyea-service-item-11';
			$box_class_two   = 'classyea-service-item-1';
			$box_class_three = 'colorOne';
		}
			
			if ($service_layout == 'layout-2') { 
			?>
			<div class="classyea-service-box-204">
				<div class="classyea-service-img">
				<?php $this->classyea_service_image_icon();?>
				</div>
				<div class="classyea-service-text">
					<?php $this->classyea_service_title_description(); ?>
					<?php $this->classyea_service_item_button(); ?>
				</div>
            </div>
			<?php } elseif($service_layout == 'layout-4'){ ?>
				<div class="classyea-service-item-202 <?php echo esc_attr($box_class);?>">
					<?php 
						$this->classyea_service_image_icon();
					    $this->classyea_service_title_description(); 
						$this->classyea_service_item_button(); ?>
				</div>
			<?php } elseif($service_layout == 'layout-6'){ ?>
				<div class="classyea-service">
					<div class="classyea-service-img">
					<?php $this->classyea_service_image_icon(); ?>
					</div>
					<div class="classyea-service-box-content">
					<?php
					$this->classyea_service_title_description(); 
					$this->classyea_service_item_button();
					?>
					</div>
                </div>
			<?php } elseif($service_layout == 'layout-1'){ 
				 if($item_content_heading == 'yes') : ?>
					<div class="classyea-service-heading">
						<?php $this->classyea_service_title_description(); 
						$this->classyea_service_item_button(); ?>
					</div>
				<?php else : ?>
					<div class="classyea-service-box-203">
						<?php $this->classyea_service_image_icon(); ?>
						<div class="classyea-service-box-content">
						<?php $this->classyea_service_title_description(); ?>
						<?php $this->classyea_service_item_button(); ?>
						</div>
					</div>
				<?php endif; 
			    } elseif($service_layout == 'layout-5'){ ?>
				<div class="classyea-service-205">
					<div class="classyea-service">
						<?php 
						$this->classyea_service_image_icon();
						$this->classyea_service_title_description();
						$this->classyea_service_item_button(); 
						?>
					</div>
				</div>
			<?php } else if ($service_layout == 'layout-3'){ ?>
			<div class="classyea-service-box-1">
				<div class="classyea-service-item-201 <?php echo esc_attr($box_class_two);?>">
					<?php $this->classyea_service_image_icon(); ?>
					<?php if(!empty($settings['service_number'])){?>
					<div class="service-number"><?php echo $settings['service_number'];?></div>
					<?php } ?>
					<?php
					$this->classyea_service_title_description(); 
					$this->classyea_service_item_button(); ?>
					
				</div>
			</div>
		<?php } // endif
	}
	/**
	 * Service image icon function
	 * Render service icon or image output on the frontend.
	 * @access protected
	 */
	protected function classyea_service_image_icon()
	{
		$settings 		= $this->get_settings_for_display();
		$service_layout = $settings['service_layout'];
		if ('layout-3' === $service_layout) {
			$divspan = 'div';
			$icon_class = 'classyea-service-icon';
		} elseif ('layout-2' === $service_layout) {
			$icon_class = 'icon';
			$divspan = 'span';
		} elseif ('layout-4' === $service_layout) {
			$icon_class = 'classyea-service-icon';
			$divspan = 'div';
		} elseif ('layout-5' === $service_layout) {
			$icon_class = 'classyea-service-icon';
			$divspan = 'div';
		} elseif ('layout-6' === $service_layout) {
			$icon_class = 'service-icon';
			$divspan = 'div';
		} else {
			$divspan = 'div';
			$icon_class = 'service-icon';
		}
		
		if (!isset($settings['service_icon']) && !Icons_Manager::is_migration_allowed()) {
			// add old default
			$settings['service_icon'] = 'fa fa-star';
		}

		$has_icon = !empty($settings['service_icon']);

		if ($has_icon) {
			$this->add_render_attribute('i', 'class', $settings['service_icon']);
			$this->add_render_attribute('i', 'aria-hidden', 'true');
		}

		if (!$has_icon && !empty($settings['icon']['value'])) {
			$has_icon = true;
		}
		$migrated = isset($settings['__fa4_migrated']['icon']);
		$is_new   = !isset($settings['service_icon']) && Icons_Manager::is_migration_allowed();

		
		if(($settings['service_icon_type'] == 'image_icon') || ($settings['service_icon_type'] == 'icon')) : 
			if ($settings['service_icon_type'] == 'image_icon' && $settings['service_image']['url']) {
				if ('image' === $settings['link_type'] && $settings['link']['url']) {

					$link_key = $this->get_repeater_setting_key('link', 'service_image', '');

					$this->add_link_attributes($link_key, $settings['link']);
			?>
					<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>>
						<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'service_image'),'classyea_img'); ?>
					</a>
				<?php
				} else {
					echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'service_image'),'classyea_img');
				}
			} elseif(($settings['service_icon_type'] == 'image_icon') || ($settings['service_icon_type'] == 'icon')) {
				if ($is_new || $migrated) { ?>
				<<?php echo esc_html($divspan); ?> class="<?php echo esc_attr($icon_class); ?>">
					<?php Icons_Manager::render_icon($settings['classyea_service_icons'], ['aria-hidden' => 'true']); ?></<?php echo esc_html($divspan); ?>>
				<?php } elseif (!empty($settings['classyea_service_icons'])) {
					?><<?php echo esc_html($divspan); ?> class="<?php echo esc_attr($icon_class); ?>"><i <?php echo wp_kses_post($this->get_render_attribute_string('i')); ?>></i></<?php echo esc_html($divspan); ?>>
				<?php }
			}
		endif;
	}
	/**
	 * Service title description function
	 * Render service title & description output on the frontend.
	 * @access protected
	 */
	protected function classyea_service_title_description()
	{
		$settings        = $this->get_settings_for_display();
		$service_heading = $settings['service_heading'];
		$service_content = $settings['service_content'];
		if ($service_heading || $service_content) {
			$this->add_render_attribute('service_heading', 'class', 'classyea-service-heading',"");

			$service_heading_tag = $settings['service_heading_tag'];
			$service_content_tag = $settings['service_content_tag'];
			$this->add_render_attribute('service_content', 'class', 'classyea-service-text',"");
		}

		if ('title' === $settings['link_type'] && $settings['link']['url']) {

			$link_key = $this->get_repeater_setting_key('link', 'team_member_image', "");

			$this->add_link_attributes($link_key, $settings['link']);
		?>
			<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>>
				<?php
				if ($service_heading) {
					$service_heading_tag = Header::classyea_validate_html_tag($settings['service_heading_tag']);
				?>
					<<?php echo esc_html($service_heading_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('service_heading')); ?>>
						<?php echo wp_kses($service_heading,'classyea_kses'); ?>
					</<?php echo esc_html($service_heading_tag); ?>>
				<?php } ?>
			</a>
			<?php
			if ($service_content) {
				$service_content_tag = Header::classyea_validate_html_tag($service_content_tag);
			?>
				<<?php echo esc_html($service_content_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('service_content')); ?>>
					<?php echo wp_kses($service_content,'classyea_kses'); ?>
				</<?php echo esc_html($service_content_tag); ?>>
			<?php }
		} else { 
			if ($service_heading) {
				$service_heading_tag = Header::classyea_validate_html_tag($service_heading_tag);
			?>
				<<?php echo esc_html($service_heading_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('service_heading')); ?>>
					<?php echo wp_kses($service_heading,'classyea_kses'); ?>
				</<?php echo esc_html($service_heading_tag); ?>>
			<?php } 
			if ($service_content) {
				$service_content_tag = Header::classyea_validate_html_tag($service_content_tag);
			?>
				<<?php echo esc_html($service_content_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('service_content')); ?>>
					<?php echo wp_kses($service_content,'classyea_kses'); ?>
				</<?php echo esc_html($service_content_tag); ?>>
			<?php }
		}
	}
	/**
	 * Service item button function
	 * Render service button output on the frontend.
	 * @access protected
	 */
	protected function classyea_service_item_button()
	{
		$settings 		= $this->get_settings_for_display();
		$service_layout = $settings['service_layout'];
		
		if ('none' !== $settings['link_type']) {
			if (!empty($settings['link']['url'])) {
				if ('button' === $settings['link_type']) {

					if($service_layout == 'layout-1') :
						$this->add_link_attributes('button', $settings['link']);
						$this->add_render_attribute('button', 'class', ['classyea-btn-primary']);
						
					else :
						$this->add_link_attributes('button', $settings['link']);
						$this->add_render_attribute('button', 'class', ['classyea-service-btn']);	
					endif;
				}
			}
		}
		if ('button' === $settings['link_type'] && !empty($settings['service_button_text'])) { ?>
			<a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['service_button_text'],'classyea_kses'); ?>
			<?php if($service_layout == 'layout-4' || $service_layout == 'layout-5') : ?>
			<span class="eicon-arrow-right"></span>
			<?php endif; ?>
			</a>
	 	<?php }
	}
}