<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \ClassyEa\Helper\Elementor\Settings\Header;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Heading Link Widget
 */
class Classyea_Heading extends Widget_Base
{

	/**
	 * Retrieve Heading Link widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-heading';
	}

	/**
	 * Retrieve Heading Link widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Heading', 'classyea');
	}

	/**
	 * Retrieve Heading Link widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-animated-headline classyea';
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}

	/**
	 * Retrieve Heading Link widget category.
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
			'heading',
			'classy heading',
			'heading desc',
			'Title',
			'animated heading',
			'classy',
			'classy addons',
			'classyea heading design'

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
		$this->register_animated_content_link();

	}

	protected function register_content_service_controls()
	{

		/****
		 * Content Tab: service
		 ****/
		$this->start_controls_section(
			'section_animated',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 9; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}
		$this->add_control(
			'heading_layout',
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
	/*	Heading Link Content
	**/
	protected function register_animated_content_link()
	{

		/**
		 * Content Heading Link
		 */
		$this->start_controls_section(
			'heading_content',
			[
				'label'                 => __('Heading', 'classyea'),
			]
		);
		$this->add_control(
			'classyea_heading_title', [
				'label'			 =>esc_html__( 'Heading Title', 'classyea' ),
				'type'			 => Controls_Manager::TEXT,
				'description'	 => esc_html__( '"Focused Title" Settings will be worked, If you use this {{something}} format', 'classyea' ),
				'label_block'	 => true,
				'placeholder'	 => esc_html__( 'What We Do On {{highlight_text}}', 'classyea' ),
				'default'	     => esc_html__( 'What We Do On {{highlight_text}}', 'classyea' ),

			]
		);

		$this->add_control(
			'classyea_heading_title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'classyea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control( 'title_float_left_width', [
			'label' => __( 'Title Width', 'classyea' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [ 'unit' => '%', 'size' => '40' ],
			'range' => [
				'%' => [
					'min' => 0,
					'max' => 200,
					'step' => 1,
				]
			],
			'selectors' => [
				'{{WRAPPER}} .classyea-heading__title-wrapper' => 
					'width: {{SIZE}}{{UNIT}};'
			],
			'condition' => [
				'title_float_left' => 'yes'	
			]
		]);

		$this->add_control(
			'classyea_mark_text', [
				'label'			 =>esc_html__( 'Mark Text', 'classyea' ),
				'type'			 => Controls_Manager::TEXT,
				'description'	 => esc_html__( 'mark text', 'classyea' ),
				'label_block'	 => true,
				'placeholder'	 => esc_html__( 'Mark Text', 'classyea' ),
				'default'	     => esc_html__( 'to the next level', 'classyea' ),
				'condition' => ['heading_layout' => 'layout-6']

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_heading_section_subtitle',
			array(
				'label' => esc_html__( 'Subtitle', 'classyea' ),
				'condition' => [
					'heading_layout' => 
					[
						'layout-2',
						'layout-3',
						'layout-4',
						'layout-5',
						'layout-6',
						'layout-7',
						'layout-8',
						'layout-9'
					]
				]
			)
		);

		$this->add_control(
			'classyea_heading_sub_title_show',
			[
				'label' => esc_html__( 'Show Sub Title', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$this->add_control(
			'classyea_heading_sub_title', [
				'label'			 =>esc_html__( 'Heading Sub Title', 'classyea' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Serviecs', 'classyea' ),
				'default'		 =>esc_html__( 'Serviecs', 'classyea' ),
				'condition' => [
					'classyea_heading_sub_title_show' => 'yes'
				],

			]
		);

		$this->add_control(
			'classyea_heading_sub_title_tag',
			[
				'label' => esc_html__( 'Sub Title HTML Tag', 'classyea' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'div',
				'condition' => [
					'classyea_heading_sub_title_show' => 'yes'
				]
			]
		);

		$this->add_control(
			'classyea_sub_title_two', [
				'label'			 =>esc_html__( 'Heading Sub Title Two', 'classyea' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'default'		 =>esc_html__( 'start from $29', 'classyea' ),
				'condition' => [
					'heading_layout' => 
					[
						'layout-7',
					],
					'classyea_heading_sub_title_show' => 
					[
						'yes',
					],
				]

			]
		);
		$this->add_control(
			'classyea_tag_highlight', [
				'label'			 =>esc_html__( 'Tag Highlight', 'classyea' ),
				'type'			 => Controls_Manager::TEXT,
				'description'	 => esc_html__( 'Tag Highlight', 'classyea' ),
				'label_block'	 => true,
				'default'	     => esc_html__( 'Introducing', 'classyea' ),
				'condition' => ['heading_layout' => 'layout-6']

			]
		);
	
		$this->end_controls_section();

		//Title Description
		$this->start_controls_section(
			'heading_section_description',
			array(
				'label' => esc_html__( 'Title Description', 'classyea' ),
				'condition' => [
					'heading_layout' => 
					[
						'layout-1',
						'layout-2',
					]
				]
			)
		);

		$this->add_control(
			'heading_section_extra_title_show',
			[
				'label' => esc_html__( 'Show Description', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Heading Description', 'classyea' ),
				'type' => Controls_Manager::WYSIWYG,
				'rows' => 10,
				'label_block'	 => true,
				'default'	 =>esc_html__( 'Our design services here', 'classyea' ),
				'placeholder'	 =>esc_html__( 'Title Description', 'classyea' ),
				'condition' => [
					'heading_section_extra_title_show' => 'yes'
				],

			]
		);

		$this->add_responsive_control( 'desciption_width', [
			'label' => __( 'Maximum Width', 'classyea' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .classyea-heading__description' => 'max-width: {{SIZE}}{{UNIT}};'
			],
			'condition' => [
				'heading_section_extra_title_show' => 'yes'
			]
		]);

		$this->end_controls_section();
		/** Start Heading placeholder text setion */
		$this->start_controls_section( 'placeholder_text_section', [
			'label' => esc_html__( 'Shadow Text', 'classyea' ),
			'condition' => ['heading_layout' => [
				'layout-2','layout-9'
				]
			]
		]);

		$this->add_control( 'show_placeholder_text', [
			'label' => esc_html__( 'Show Shadow Text', 'classyea' ),
			'type' => Controls_Manager::SWITCHER,
			'default' => 'no',
		]);

		$this->add_control( 'placeholder_text_content', [
			'label'			 =>esc_html__( 'Content', 'classyea' ),
			'label_block'	 => true,
			'type'			 => Controls_Manager::TEXT,
			'default'		 => esc_html__( 'Services', 'classyea' ),
			'condition' => [
				'show_placeholder_text' => 'yes'
			],

		]);
		$this->end_controls_section();

		// divider option
		$this->start_controls_section(
			'classyea_divider_section',
			array(
				'label' => __('Divider', 'classyea'),
				'condition' => [
					'heading_layout' => 'layout-1',
				]
			)
		);
		$this->add_control(
			'heading_section_divider_show',
			[
				'label' => esc_html__( 'Show Divider', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				
			]
		);
		$this->add_responsive_control( 'divider_width', [
			'label' => __( 'Divider Width', 'classyea' ),
			
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
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
			'default' => [
				'unit' => '%',
				'size' => '30',
			],
			'selectors' => [
				'{{WRAPPER}} .classyea-heading-one-wrapper:before' => 'max-width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .classyea-heading-one-wrapper:before' => 'width: {{SIZE}}{{UNIT}};'
			],
			'condition' => [
				'heading_section_divider_show' => 'yes'
			]
		]);
		$this->add_responsive_control(
			'heading_seperator_color', [
				'label'		 =>esc_html__( 'Divider color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-one-wrapper:before' => 'background: {{VALUE}}',
					
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_icon_or_image_section',
			array(
				'label' => __('Icon', 'classyea'),
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'heading_layout',
                            'operator' => '==',
                            'value' => 'layout-7'
                        ],
						[
                            'name' => 'heading_layout',
                            'operator' => '==',
                            'value' => 'layout-8'
                        ],
                    ]
                ]
			)
		);
		$this->add_control(
			'heading_icon_type',
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
				'default' => 'image_icon',
				'toggle'  => true,
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'heading_layout',
                            'operator' => '==',
                            'value' => 'layout-7'
                        ],
						[
                            'name' => 'heading_layout',
                            'operator' => '==',
                            'value' => 'layout-8'
                        ],
                        
                    ]
                ]
			]
		);

		$this->add_control(
			'classyea_heading_icons',
			[
				'label'            => esc_html__('Icon', 'classyea'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility'      => 'service_icon',
				'default'          => [
					'value'   => 'fab fa-amazon',
					'library' => 'fa-brands',
				],
				'condition' => ['heading_icon_type' => 'icon']

			]
		);
		$this->add_control(
			'heading_image',
			[
				'label'                 => esc_html__('Icon Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => ['heading_icon_type' => 'image_icon']
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'heading_image[url]!' => '',
				],
			]
		);
		$this->add_control(
			'line_heading_image',
			[
				'label'                 => esc_html__('Shape Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => ['heading_layout' => 'layout-8']

			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_icon_or_image_background_section',
			array(
				'label' => __('Intro Icon', 'classyea'),
				'condition' => ['heading_layout' => 
					'layout-5'
				]
			)
		);
		$this->add_control(
            'classyea_title_heading',
            [
                'label' => __('Tagline Icon', 'classyea'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'condition' => ['heading_layout' => 'layout-5']
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Tagline Icon', 'classyea' ),
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .classyea-heading-five-sub-title:before',
				'condition' => ['heading_layout' => 'layout-5']
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_heading_section_general',
			array(
				'label' => esc_html__( 'General', 'classyea' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_title_align_two',
			[
				'label' => esc_html__( 'Align Items', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'flex-start'  => esc_html__( 'Start', 'classyea' ),
					'center' => esc_html__( 'Center', 'classyea' ),
					'flex-end' => esc_html__( 'End', 'classyea' ),
				],
				'condition' => [
					'heading_layout' => 'layout-1'
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-heading-one-wrapper' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_title_align', [
				'label'			 =>esc_html__( 'Alignment', 'classyea' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [
					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'classyea' ),
						'icon'	 => 'eicon-text-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'classyea' ),
						'icon'	 => 'eicon-text-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'classyea' ),
						'icon'	 => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-heading-one-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-two-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-three-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-four-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-five-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-six-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-seven-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-eight-wrapper' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-nine-wrapper' => 'text-align: {{VALUE}};',
				],
				'default'		 => '',
			]
		);

		$this->add_responsive_control(
			'arrow_position_x',
			[
				'label' => __( 'Sub Title Position', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-heading-three-sub-title' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'heading_layout' => 'layout-3'
				],
			]
		);

		$this->end_controls_section();

		// Description Style Section
		$this->start_controls_section(
			'classyea_heading_section_extra_title_style', [
				'label'	 => esc_html__( 'Title Description', 'classyea' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'heading_layout' => 
					[
						'layout-1',
						'layout-2',
					]
				]
			]
		);

		$this->add_responsive_control(
			'classyea_heading_extra_title_color', [
				'label'		 =>esc_html__( 'Title Description color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-one-description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-one-description p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-two-description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-two-description p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'classyea_heading_extra_title_typography',
			'selector'	 => '{{WRAPPER}} .classyea-heading-one-description,{{WRAPPER}} .classyea-heading-one-description p,{{WRAPPER}} .classyea-heading-two-description,{{WRAPPER}} .classyea-heading-two-description p',
			]
		);

		$this->add_responsive_control(
			'classyea_heading_extra_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'classyea' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-heading-one-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-one-description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-two-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-two-description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Heading Style Section
		$this->start_controls_section(
			'classyea_heading_section_title_style', [
				'label'	 => esc_html__( 'Heading', 'classyea' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'classyea_heading_title_color', [
				'label'		 =>esc_html__( 'Heading color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-one-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-two-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-three-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-four-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-five-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-six-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-seven-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-eight-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-nine-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_heading_title_highlight_color', [
				'label'		 =>esc_html__( 'Highlight color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-theme-color' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .classyea-heading-four-mark-title' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .classyea-heading-five-mark-title' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
				'condition' => [
					'heading_layout' => 
					[
						'layout-1',
						'layout-4',
						'layout-5',
					]
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'classyea_heading_title_typography',
			'selector'	 => '{{WRAPPER}} .classyea-heading-one-title,{{WRAPPER}} .classyea-heading-two-title,{{WRAPPER}} .classyea-heading-three-title,{{WRAPPER}} .classyea-heading-four-title,{{WRAPPER}} .classyea-heading-five-title,{{WRAPPER}} .classyea-heading-six-title,{{WRAPPER}} .classyea-heading-seven-title,{{WRAPPER}} .classyea-heading-eight-title,{{WRAPPER}} .classyea-heading-nine-title',
			]
		);

		$this->add_responsive_control(
			'classyea_heading_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'classyea' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-heading-one-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-two-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-three-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-four-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-five-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-six-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-seven-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-eight-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-nine-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				),
			)
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'heading_shadow_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-heading-one-title,{{WRAPPER}} .classyea-heading-two-title,{{WRAPPER}} .classyea-heading-three-title,{{WRAPPER}} .classyea-heading-four-title,{{WRAPPER}} .classyea-heading-five-title,{{WRAPPER}} .classyea-heading-six-title,{{WRAPPER}} .classyea-heading-seven-title,{{WRAPPER}} .classyea-heading-eight-title,{{WRAPPER}} .classyea-heading-nine-title',
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		// Sub Heading Style Section
		$this->start_controls_section(
			'classyea_sub_heading_section_title_style', [
				'label'	 => esc_html__( 'Sub Title', 'classyea' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'heading_layout!' => 'layout-1',
				]
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_title_color', [
				'label'		 =>esc_html__( 'Sub Heading color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-two-sub-title' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .classyea-heading-three-sub-title' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .classyea-heading-four-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-five-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-six-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-seven-sub-title-two' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .classyea-heading-eight-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-heading-nie-sub-title' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->add_responsive_control(
			'classyea_sub_heading_title_highlight_color', [
				'label'		 =>esc_html__( 'Highlight color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-six-mark-sub-title' => 'background-image:  linear-gradient(90deg, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
				'condition' => [
					'heading_layout' => 'layout-6'
				]
			]
		);
		$this->add_responsive_control(
			'classyea_sub_heading_title_border_color', [
				'label'		 =>esc_html__( 'Border color', 'classyea' ),
				'description' => __("use for style three","classyea"),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-three-wrapper' => 'border-top:  1px solid {{VALUE}};',
				],
				'condition' => [
					'heading_layout' => 'layout-3'
				]
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_HIGHTLIGHT_padding',
			array(
				'label'      => esc_html__( 'Highlight Tag Padding', 'classyea' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-heading-six-mark-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => [
					'heading_layout' => 'layout-6'
				]
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'classyea_sub_heading_title_typography',
			'selector'	 => '{{WRAPPER}} .classyea-heading-two-sub-title,{{WRAPPER}} .classyea-heading-three-sub-title,{{WRAPPER}} .classyea-heading-four-sub-title,{{WRAPPER}} .classyea-heading-five-sub-title,{{WRAPPER}} .classyea-heading-six-sub-title,{{WRAPPER}} .classyea-heading-seven-sub-title-two,{{WRAPPER}} .classyea-heading-eight-sub-title,{{WRAPPER}} .classyea-heading-nie-sub-title,{{WRAPPER}} .classyea-heading-six-mark-sub-title',
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'classyea' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-heading-two-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-three-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-four-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-five-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-six-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-seven-sub-title-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-eight-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-nie-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Sub Heading Style Section
		$this->start_controls_section(
			'classyea_sub_heading_section_titletwo_style', [
				'label'	 => esc_html__( 'Sub Title Two', 'classyea' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'heading_layout' => 'layout-7'
				]
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_title_two_color', [
				'label'		 =>esc_html__( 'Sub Heading color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-seven-sub-title' => 'color:  {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'classyea_sub_heading_title_two_typography',
			'selector'	 => '{{WRAPPER}} .classyea-heading-seven-sub-title',
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_title_two_margin',
			array(
				'label'      => esc_html__( 'Margin', 'classyea' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-heading-seven-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		// Sub Heading Style Section
		$this->start_controls_section(
			'classyea_sub_heading_section_shadow_style', [
				'label'	 => esc_html__( 'Shadow Text', 'classyea' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'heading_layout' => 
					[
						'layout-2',
						'layout-9',
					]
				]
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_shadow_text_color', [
				'label'		 =>esc_html__( 'Shadow Text color', 'classyea' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .classyea-heading-two-big-title' => 'background-image: linear-gradient(0deg, {{VALUE}} 0%, {{VALUE}} 100%);',
					'{{WRAPPER}} .classyea-heading-nie-big-title' => 'background-image: linear-gradient(0deg, {{VALUE}} 0%, {{VALUE}} 100%);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'classyea_sub_heading_shadow_typography',
			'selector'	 => '{{WRAPPER}} .classyea-heading-two-big-title,{{WRAPPER}} .classyea-heading-nie-big-title',
			]
		);

		$this->add_responsive_control(
			'classyea_sub_heading_shadow_margin',
			array(
				'label'      => esc_html__( 'Margin', 'classyea' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-heading-two-big-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-heading-nie-big-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-heading-two-big-title,{{WRAPPER}} .classyea-heading-nie-big-title',
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings 		     =  $this->get_settings_for_display();
		$heading_layout      = $settings['heading_layout'];
		$desc_enable 	     = $settings['heading_section_extra_title_show'];
		$heading_description = $settings['heading_description'];
		$classyea_sub_title_two = $settings['classyea_sub_title_two'];
		$divider_show 		 = $settings['heading_section_divider_show'];
		$alignment = '';
		if( $heading_layout == 'layout-2' || $heading_layout == 'layout-3' || $heading_layout == 'layout-5') {
			$alignment = ($settings['heading_title_align']) ? $settings['heading_title_align'] : " ";
		}
		$alignment2 = '';
		if( $heading_layout == 'layout-1') { 
			$alignment2 = ($settings['heading_title_align_two']) ? $settings['heading_title_align_two'] : " ";
		}
		
		$divider = '';
		if($divider_show == 'yes'){ 
			$divider = 'divider-show';
		}
		
		if ( $heading_layout == 'layout-1' ) { 
			?>
				<!-- Heading Style 01 -->
					<div class="classyea-heading-one-wrapper <?php echo esc_attr($divider);?> <?php echo esc_attr( $alignment2 );?>">
						<?php $this->classyea_render_heading( $settings );?>
						<?php 
						if($desc_enable == 'yes') { ?>
						<div class="classyea-heading-one-description"><?php echo wp_kses($heading_description,'classyea_kses');?></div>
						<?php } ?>
						
					</div>
				<!-- Heading Style 02 -->
			<?php 
		} 
		elseif ( $heading_layout == 'layout-2' ) { 
			$show_placeholder_text     = $settings['show_placeholder_text']; 
			?>
			<div class="classyea-heading-two-wrapper <?php echo esc_attr( $alignment );?>">
				<?php if($show_placeholder_text == 'yes') { ?>
				<div class="classyea-heading-two-big-title"><?php echo wp_kses($settings['placeholder_text_content'], 'classyea_kses'); ?></div>
				<?php } ?>
				<?php echo $this->classyea_render_sub_heading($settings);?>
				<?php $this->classyea_render_heading( $settings );?>
				<div class="classyea-heading-two-description"><?php echo wp_kses($heading_description,'classyea_kses');?></div>
			</div>
		<?php } elseif($heading_layout == 'layout-3') { ?>
			<div class="classyea-heading-three-wrapper <?php echo esc_attr( $alignment );?>">
				<?php echo $this->classyea_render_sub_heading($settings);?>
				<?php $this->classyea_render_heading( $settings );?>
			</div>
		<?php } elseif($heading_layout == 'layout-4') { ?>
			<div class="classyea-heading-four-wrapper">
				<?php echo $this->classyea_render_sub_heading($settings);?>
				<?php $this->classyea_render_heading( $settings );?>
			</div>
		<?php } elseif($heading_layout == 'layout-5') { ?>
			<!-- Heading Style 05 -->
			<div class="classyea-heading-five-wrapper <?php echo esc_attr( $alignment );?>">
				<?php echo $this->classyea_render_sub_heading($settings);?>
				<?php $this->classyea_render_heading( $settings );?>
			</div>
		<?php } elseif($heading_layout == 'layout-6'){ ?>
				<div class="classyea-heading-six-wrapper">
					<?php echo $this->classyea_render_sub_heading($settings);?>
					<?php $this->classyea_render_heading( $settings );?>
				</div>
			<?php } elseif($heading_layout == 'layout-7'){ ?>
				<div class="classyea-heading-seven-wrapper">  
					<?php echo $this->classyea_render_sub_heading($settings);?> 
					<div class="classyea-heading-seven-sub-title-two"><?php echo wp_kses($classyea_sub_title_two,'classyea_kses');?></div>                 
                    <?php $this->classyea_render_heading( $settings );?>
                </div>
			<?php } elseif($heading_layout == 'layout-8'){ ?>
				<div class="classyea-heading-eight-wrapper">
                    <div class="classyea-heading-eight-icon"><i class="icon"><?php echo $this->classyea_icon_image( $settings );?></i></div>
                    <?php echo $this->classyea_render_sub_heading($settings);?>
					<?php $this->classyea_render_heading( $settings );?>
                </div>
				
			<?php } elseif($heading_layout == 'layout-9'){ 
				$show_placeholder_text     = $settings['show_placeholder_text'];
				?>
				<div class="classyea-heading-nine-wrapper">
					<?php if($show_placeholder_text == 'yes') { ?>
						<div class="classyea-heading-nie-big-title"><?php echo wp_kses($settings['placeholder_text_content'], 'classyea_kses'); ?></div>
					<?php } ?>
                    <?php echo $this->classyea_render_sub_heading($settings);?>
                    <?php $this->classyea_render_heading( $settings );?>
                </div>
			<?php }
	}

	/**
	 * headign tag function
	 * Render headign  output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 * @param [type] $headign
	 * @access protected
	 */
	protected function classyea_render_heading( $settings )
	{
		$heading_layout    = $settings['heading_layout'];
		$heading_title     = $settings['classyea_heading_title'];
		$classyea_mark_text  = $settings['classyea_mark_text'];

		$search = array('{{', '}}');
		$replace = array('', '');
		$replace_heading   = str_replace($search, $replace, $heading_title);

		$highlight_text = $this->classyea_getInbetweenStrings("{{", "}}",$heading_title);

		if(isset($highlight_text[0])){
			$main_heading = str_replace($highlight_text[0],'',$replace_heading);
			$explode      = explode(' ',$main_heading);
			$rep_str  = $explode[0];
			$five_heading = str_replace($rep_str,'',$main_heading);
		}else {
			$main_heading = $heading_title;
		}

		
		$theme_color = 'classyea-theme-color';

		if($heading_layout == 'layout-1') {
			$heading_class = "classyea-heading-one-title";
		}
		elseif($heading_layout == 'layout-2') { 
			$heading_class = 'classyea-heading-two-title';
		}
		elseif($heading_layout == 'layout-3') { 
			$heading_class = 'classyea-heading-three-title';
		}
		elseif($heading_layout == 'layout-4') { 
			$heading_class = 'classyea-heading-four-title';
			
		}
		elseif($heading_layout == 'layout-5') { 
			$heading_class = 'classyea-heading-five-title';
			$theme_color = 'classyea-heading-five-mark-title';
		}
		elseif($heading_layout == 'layout-6') { 
			$heading_class = 'classyea-heading-six-title';
		}
		elseif($heading_layout == 'layout-7') { 
			$heading_class = 'classyea-heading-seven-title';
		}
		elseif($heading_layout == 'layout-8') { 
			$heading_class = 'classyea-heading-eight-title';
		}
		elseif($heading_layout == 'layout-9') { 
			$heading_class = 'classyea-heading-nine-title ';
		}
		

		if ($settings['classyea_heading_title']) {
			$this->add_inline_editing_attributes('classyea_heading_title', 'none');
			$this->add_render_attribute('classyea_heading_title', 'class', $heading_class);

			if ($settings['classyea_heading_title']) {
				$heading_tag = Header::classyea_validate_html_tag($settings['classyea_heading_title_tag']);
			?>
				<<?php echo esc_html($heading_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('classyea_heading_title')); ?>>
					<?php 
						if($heading_layout == 'layout-4') { ?> 
							<?php if($highlight_text[0] != '') { ?><span class="classyea-heading-four-mark-title"><?php echo wp_kses($highlight_text[0],'classyea_kses');?></span>
							<?php } 
							echo wp_kses($main_heading, 'classyea_kses');
						} elseif( $heading_layout == 'layout-5' ) {
							if(isset($explode[0]) ){
								echo wp_kses($explode[0], 'classyea_kses');
							}
							 ?> 
							<?php if(isset($highlight_text[0] )) { ?> <span class="<?php echo esc_attr($theme_color);?>"><?php echo wp_kses($highlight_text[0],'classyea_kses');?></span> <?php echo wp_kses($five_heading,'classyea_kses');
							} else{ 
								echo wp_kses($main_heading, 'classyea_kses');
							}
						} elseif( $heading_layout == 'layout-6' ) { ?> 
							<?php if(isset($highlight_text[0] )) { 
								echo wp_kses($main_heading, 'classyea_kses');  } else{ 
									echo wp_kses($main_heading, 'classyea_kses');
								} ?> <br> <span class="classyea-heading-six-mark-title"><?php echo wp_kses($classyea_mark_text,'classyea_kses');?></span> <?php  
						}
						elseif($heading_layout == 'layout-8') { ?>
							<span class="classyea-heading-eight-shape"><?php echo $this->classyea_shape_image($settings);?></span>
                        	<?php if(isset($highlight_text[0] )) { ?> <span class="<?php echo esc_attr($theme_color);?>"><?php echo wp_kses($highlight_text[0],'classyea_kses');?></span> <?php echo wp_kses($five_heading,'classyea_kses');
							} else{ 
								echo wp_kses($main_heading, 'classyea_kses');
							} ?>
						
						<?php } else {
							echo wp_kses($main_heading, 'classyea_kses'); ?> 
							<?php if(isset($highlight_text[0])) { ?> <br> <span class="<?php echo esc_attr($theme_color);?>"><?php echo wp_kses($highlight_text[0],'classyea_kses');?></span>
							<?php } 
						} ?>
						
				</<?php echo esc_html($heading_tag); ?>>
			<?php
			}
		}
	}

	public function classyea_getInbetweenStrings($start, $end, $str){
		$matches = array();
		$regex = "/$start([a-zA-Z0-9_,---,'“”‘’ ]*)$end/";
		preg_match_all($regex, $str, $matches);
		
		return $matches[1];
	}

	/**
	 * headign tag function
	 * Render headign  output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 * @param [type] $headign
	 * @access protected
	 */
	protected function classyea_render_sub_heading( $settings )
	{
		$heading_layout    = $settings['heading_layout'];
		$sub_heading       = $settings['classyea_heading_sub_title'];
		$sub_title_tag     = $settings['classyea_heading_sub_title_tag'];
		$sub_title_two     = $settings['classyea_sub_title_two'];
		$classyea_tag_highlight     = $settings['classyea_tag_highlight'];
		
		
		$sub_class = '';
		if($heading_layout == 'layout-2') { 
			$sub_class = 'classyea-heading-two-sub-title';
		}
		elseif($heading_layout == 'layout-3') { 
			$sub_class = 'classyea-heading-three-sub-title';
		}
		elseif($heading_layout == 'layout-4') { 
			$sub_class = 'classyea-heading-four-sub-title';
		}
		elseif($heading_layout == 'layout-5') { 
			$sub_class = 'classyea-heading-five-sub-title';
		}
		elseif($heading_layout == 'layout-6') { 
			$sub_class = 'classyea-heading-six-sub-title';
		}
		elseif($heading_layout == 'layout-7') { 
			$sub_class = 'classyea-heading-seven-sub-title';
		}
		elseif($heading_layout == 'layout-8') { 
			$sub_class = 'classyea-heading-eight-sub-title';
		}
		elseif($heading_layout == 'layout-9') { 
			$sub_class = 'classyea-heading-nie-sub-title ';
		}
		

		if ($settings['classyea_heading_sub_title']) {
			$this->add_inline_editing_attributes('classyea_heading_sub_title', 'none');
			$this->add_render_attribute('classyea_heading_sub_title', 'class', $sub_class);

			if ($settings['classyea_heading_title']) {
				$sub_title_tag = Header::classyea_validate_html_tag($sub_title_tag);

				if($heading_layout == 'layout-7') { 
			?>
				<<?php echo esc_html($sub_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('classyea_heading_sub_title')); ?>>
					<?php echo wp_kses($sub_heading, 'classyea_kses'); ?>
					<div class="classyea-heading-seven-icon"><?php echo $this->classyea_icon_image( $settings );?></div>
				</<?php echo esc_html($sub_title_tag); ?>>
			<?php
				} elseif($heading_layout == 'layout-6') {  ?>
				<<?php echo esc_html($sub_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('classyea_heading_sub_title')); ?>>
					<span class="classyea-heading-six-mark-sub-title"><?php echo wp_kses($classyea_tag_highlight,'classyea_kses');?></span> <?php echo wp_kses($sub_heading, 'classyea_kses'); ?>
				</<?php echo esc_html($sub_title_tag); ?>>
				<?php } else { ?>
				<<?php echo esc_html($sub_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('classyea_heading_sub_title')); ?>>
					<?php echo wp_kses($sub_heading, 'classyea_kses'); ?>
				</<?php echo esc_html($sub_title_tag); ?>>
			<?php }
			}
		}
	}

	protected function classyea_icon_image( $settings ) {
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

		if(($settings['heading_icon_type'] == 'image_icon') || ($settings['heading_icon_type'] == 'icon')) : 
			if ($settings['heading_icon_type'] == 'image_icon' && $settings['heading_image']['url']) {
				if ('image' === $settings['heading_icon_type']) {
					echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'heading_image'),'classyea_img'); 
				
				} else {
					echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'heading_image'),'classyea_img');
				}
			} elseif(($settings['heading_icon_type'] == 'image_icon') || ($settings['heading_icon_type'] == 'icon')) {
				if ($is_new || $migrated) { ?>
					<?php Icons_Manager::render_icon($settings['classyea_heading_icons'], ['aria-hidden' => 'true']); ?>
				<?php } elseif (!empty($settings['classyea_heading_icons'])) {
					?><i <?php echo wp_kses_post($this->get_render_attribute_string('i')); ?>></i>
				<?php }
			}
		endif;
	}

	protected function classyea_shape_image( $settings ) {

		echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'line_heading_image'),'classyea_img');
	}
}