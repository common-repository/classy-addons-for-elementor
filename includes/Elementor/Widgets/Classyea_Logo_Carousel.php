<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Logo Carousel Widget
 */
class Classyea_Logo_Carousel extends Widget_Base
{

	/**
	 * Retrieve Logo Carousel widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-logo-carousel';
	}

	/**
	 * Retrieve Logo Carousel widget title.
	 * @access public
	 * @return string Widget title.
	*/
	public function get_title()
	{
		return esc_html__('Logo Carousel', 'classyea');
	}

	/**
	 * Retrieve Logo Carousel widget icon.
	 * @access public
	 * @return string Widget icon.
	*/

	public function get_icon()
	{
		return 'eicon-slider-push classyea';
	}

	/**
	 * Retrieve Logo Carousel widget category.
	 * @access public
	 * @return string Widget icon.
	*/

	public function get_categories()
	{
		return ['classyea'];
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
			'Logo Carousel',
			'carousel',
			'slider carousel',
			'classyea Logo Carousel',
			'classy carousel',
			'unlimited carousel',
		];
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}

	public function get_script_depends() {
		return [
			'classyea-owl-carousel',
			'classyea-logo-carousel-script',
		];
	}

	/**
	 * Register Logo Carousel widget controls.
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
	}

	protected function classyea_reg_carousel_setting_control()
	{

		/**
		 * Content Tab: Logo Carousel
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
			'logo_layout',
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
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay?', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'       => __( 'Animation Speed', 'classyea' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '2500', 'classyea' ),
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
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-5',
						),
						
					),
				)
			]
		);

		$this->add_control(
			'dots',
			[
				'label' => __( 'Enable Dots?', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => '',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-4',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-6',
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
				'label'                 => __('Logo', 'classyea'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'carousel_image',
			[
				'label'                 => esc_html__('Logo Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_control(
			'logo_link',
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
		
		$this->add_control(
			'logo_item',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ logo_link.label }}}',
				'default'     => [
					[
						'label' => __( 'Logo #1', 'classyea' ),
					],
					[
						'label' => __( 'Logo #2', 'classyea' ),
					],
					[
						'label' => __( 'Logo #3', 'classyea' ),
					],
					[
						'label' => __( 'Logo #4', 'classyea' ),
					],
					[
						'label' => __( 'Logo #5', 'classyea' ),
					],
					[
						'label' => __( 'Logo #5', 'classyea' ),
					],
				]
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
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'default' => 10,
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-4',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-5',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-6',
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
					'{{WRAPPER}} .classyea-logoCarousel-box-871' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-logoCarousel-box-874' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-logoCarousel-box-874 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-logoCarousel-box-875' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-logoCarousel-image-880' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-logoCarousel-box-871 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-4',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-5',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
						
					),
				)
			]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-logoCarousel-box-871,{{WRAPPER}} .classyea-logoCarousel-box-874,{{WRAPPER}} .classyea-logoCarousel-box-875,{{WRAPPER}} .classyea-logoCarousel-image-880',
                'separator' => 'before',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-4',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-5',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
						
					),
				)
            ]
        );
		
		$this->add_responsive_control(
		    'logo_carousel_width',
		    [
			    'label' => __('Width', 'classyea'),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => ['px', '%'],
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
			    'devices' => ['desktop', 'tablet', 'mobile'],
			    'selectors' => [
				    '{{WRAPPER}} .classyea-logoCarousel-box-871' => 'width: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-872' => 'width: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-873' => 'width: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-874' => 'width: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-875' => 'width: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-image-880' => 'width: {{SIZE}}{{UNIT}} !important;',
			    ],
		    ]
	    );
		
		$this->add_control(
			'logo_carousel_opacity',
			[
				'label' => __( 'Opacity', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
				    '{{WRAPPER}} .classyea-logoCarousel-box-871' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-872' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-873 img' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-874' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-875' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-image-880' => 'opacity: {{SIZE}} !important;',
				],
			]
		);
		
		$this->add_control(
			'logo_carousel_opacity_hover',
			[
				'label' => __( 'Opacity', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
				    '{{WRAPPER}} .classyea-logoCarousel-box-871:hover' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-872:hover' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-873 img:hover' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-874:hover' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-875:hover' => 'opacity: {{SIZE}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-image-880:hover' => 'opacity: {{SIZE}} !important;',
				],
			]
		);
	    $this->add_responsive_control(
		    'logo_carousel_height',
		    [
			    'label' => __('Height', 'classyea'),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => ['px', '%'],
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
			    'devices' => ['desktop', 'tablet', 'mobile'],
			    'selectors' => [
				    '{{WRAPPER}} .classyea-logoCarousel-box-871' => 'height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-872' => 'height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-873 img' => 'height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-874' => 'height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-875' => 'height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-image-880' => 'height: {{SIZE}}{{UNIT}} !important;',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'logo_carousel_image_size',
		    [
			    'label' => __('Image Size', 'classyea'),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => ['px', '%'],
			    'range' => [
				    'px' => [
					    'min' => 0,
					    'max' => 500,
					    'step' => 5,
				    ],
				    '%' => [
					    'min' => 0,
					    'max' => 100,
				    ],
			    ],
			    'devices' => ['desktop', 'tablet', 'mobile'],
			    'selectors' => [
				    '{{WRAPPER}} .classyea-logoCarousel-box-871' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-872' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-873' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-874' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-box-875' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
				    '{{WRAPPER}} .classyea-logoCarousel-image-880' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;',
			    ],
		    ]
	    );
		$this->add_responsive_control(
            'logo_padding',
            [
                'label' => __( 'Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-logoCarousel-box-871' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-logoCarousel-box-872' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-logoCarousel-box-873' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-logoCarousel-box-874' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-logoCarousel-box-875' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-logoCarousel-image-880' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
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
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '==',
							'value'    => 'layout-5',
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
					'{{WRAPPER}} .owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .owl-theme .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-theme .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .owl-theme .owl-nav button.owl-prev span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-5',
						),
					),
				)
            ]
        );
		$this->add_control(
            'arrow_border_design_five_radius',
            [
                'label' => __('Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-logoCarousel-wrapper-875 .owl-theme .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
				'condition' => array( 'logo_layout' => 'layout-5'),
            ]
        );

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .owl-theme .owl-nav button.owl-prev span,{{WRAPPER}} .owl-theme .owl-nav button.owl-next span',
                'separator' => 'before',
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-5',
						),
					),
				)
            ]
        );
		$this->add_control(
			'field_border_five_design',
			array(
				'label'     => __('Border Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-875 .owl-theme .owl-nav button' => 'border-color: {{VALUE}}!important', 
				),
				'condition' => array( 'logo_layout' => 'layout-5'),
			)
		);
		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-871 .owl-theme .owl-nav button' => 'background-color: {{VALUE}}!important', 
				),
				'conditions' => array(
					'relation' => 'and',
					'terms' => array(
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'logo_layout',
							'operator' => '!=',
							'value'    => 'layout-5',
						),
					),
				)
			)
		);
		$this->add_control(
			'arrow_bg__fiv_desbgcolor',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-875 .owl-theme .owl-nav button' => 'background-color: {{VALUE}}!important', 
				),
				'condition' => array( 'logo_layout' => 'layout-5'),
			)
		);
		$this->add_control(
			'arrow_color',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-871 .owl-theme .owl-nav button.owl-prev span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-871 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-875 .owl-theme .owl-nav button.owl-prev span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-logoCarousel-wrapper-875 .owl-theme .owl-nav button.owl-next span' => 'color: {{VALUE}}',
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
			]
		);

		$this->add_responsive_control(
			'dots_nav_position_y',
			[
				'label' => __( 'Margin Top Spacing', 'classyea' ),
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
					'{{WRAPPER}} .owl-theme .owl-nav.disabled+.owl-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-theme .owl-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
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
			'dots_nav_align',
			[
				'label' => __( 'Alignment', 'classyea' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'classyea' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'classyea' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'classyea' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-dots' => 'text-align: {{VALUE}}'
				]
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
		$logo_layout 	    = $settings['logo_layout'];
		$autoplay_speed 	= $settings['autoplay_speed'];
        $image_item_gap = '';

		if ( $logo_layout == 'layout-1' || $logo_layout == 'layout-4' || $logo_layout == 'layout-5' || $logo_layout == 'layout-6' ) {
			$image_item_gap 	= $settings['image_item_gap'];
		}

			if ( $settings['infinite'] == 'yes' ) {
				$infiinite = true;
			} else {
				$infiinite = false;
			}

			if( $settings['autoplay'] == 'yes' ) {
				$autoplay = true;
			} else {
				$autoplay = false;
			}

			if ( $settings['dots'] == 'yes' ) {
				$dots = true;
			} else {
				$dots = false;
			}

			if( $settings['arrows'] == 'yes' ) {
				$arrows = true;
			} else {
				$arrows = false;
			}
			
			$changed_atts = array(
				'infinite'       => $infiinite,
				'autoplay'       => $autoplay,
				'autoplaySpeed'  => $autoplay_speed,
				'dots' 			 => $dots,
				'arrows' 		 => $arrows,
				'item_gap' 	     => $image_item_gap,
			);  

		switch ( $logo_layout ) {
			case 'layout-1':
				$section_class = 'classyea-logoCarousel-wrapper-871';
				$section_id    = 'sliderone';
				break;
			case 'layout-2':
				$section_class = 'classyea-logoCarousel-wrapper-872';
				$section_id    = 'slidertwo';
				break;
			case 'layout-3':
				$section_class = 'classyea-logoCarousel-wrapper-873';
				$section_id    = 'sliderthree';
				break;
			case 'layout-4':
				$section_class = 'classyea-logoCarousel-wrapper-874';
				$section_id    = 'sliderfour';
				break;
			case 'layout-5':
				$section_class = 'classyea-logoCarousel-wrapper-875';
				$section_id    = 'sliderfive';
				break;
			case 'layout-6':
				$section_class = 'classyea-logoCarousel-wrapper-880';
				$section_id    = 'slidersix';
				break;
			default:
				$section_class = 'classyea-logoCarousel-wrapper-871';
				$section_id    = 'sliderone';
		}
		?>
			<div class="<?php echo esc_attr( $section_class );?>" id="logo-<?php echo esc_attr( $section_id );?>" 
				data-logoone='<?php echo wp_json_encode($changed_atts);?>'>
				<div class="owl-carousel owl-theme">
					<?php $this->classyea_carousel_repeater_control(); ?>
				</div>
			</div>
		<?php
	}

	private function classyea_carousel_repeater_control()
	{
		$settings 		    = $this->get_settings_for_display();
		$logo_layout 	    = $settings['logo_layout'];

		$i = 1;
		foreach ( $settings['logo_item'] as $key => $item ) :
			$this->add_render_attribute('logo_link', 'class', 'logo-link');
			$logo_link_key = 'logo_link' . $i;
			if (!empty($item['logo_link']['url'])) {
				$this->add_link_attributes($logo_link_key, $item['logo_link']);
			} 
			if ( $logo_layout == 'layout-5' ) { 
				$image_url_src = ($item["carousel_image"]["id"] != "") ? wp_get_attachment_image_url($item["carousel_image"]["id"], "full") : $item["carousel_image"]["url"];
			}

			if ( $logo_layout == 'layout-1' ) { 
				?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $logo_link_key ) ); ?>>
						<div class="classyea-logoCarousel-box-871">
							<?php echo $this->classyea_logo_carousel_thumb_image( $item ); ?>
						</div>
					</a>
				<?php 
			} elseif ( $logo_layout == 'layout-2' ) { 
				?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $logo_link_key ) ); ?>>
						<div class="classyea-logoCarousel-box-872">
							<?php echo $this->classyea_logo_carousel_thumb_image( $item ); ?>
						</div>
					</a>
				<?php
			} elseif ( $logo_layout == 'layout-3' ) {
				?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $logo_link_key ) ); ?>>
						<div class="classyea-logoCarousel-box-873">
							<?php echo $this->classyea_logo_carousel_thumb_image( $item ); ?>
						</div> 
					</a>
				<?php
			} elseif ( $logo_layout == 'layout-4' ) {
				?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $logo_link_key ) ); ?>>
						<div class="classyea-logoCarousel-box-874">
							<?php echo $this->classyea_logo_carousel_thumb_image( $item ); ?>
						</div>
					</a>
				<?php
			} elseif ( $logo_layout == 'layout-5' ) {
				?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $logo_link_key ) ); ?>>
						<div class="classyea-logoCarousel-box-875">
							<figure>
								<img class="mainLogo" src="<?php echo esc_url($image_url_src);?>" alt="Logo-Image" loading="lazy">
								<img class="altLogo" src="<?php echo esc_url($image_url_src);?>" alt="Logo-Image" loading="lazy">
							</figure>
						</div>
					</a>
				<?php
			} elseif ( $logo_layout == 'layout-6' ) {
				?>
					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $logo_link_key ) ); ?>>
						<div class="classyea-logoCarousel-image-880">
							<?php echo $this->classyea_logo_carousel_thumb_image( $item ); ?>
						</div>
					</a>
				<?php
			}
			$i++;
		endforeach; 
		// endforeach
	}

	/**
	 * carousel image thumbnail function
	 * Render image thumbnail image output on the frontend.
	 * @access private
	 */
	private function classyea_logo_carousel_thumb_image( $item )
	{
		$image_html = ($item["carousel_image"]["id"] != "") ? wp_get_attachment_image($item["carousel_image"]["id"], "full") : $item["carousel_image"]["url"];
		$image_alt = get_post_meta($item["carousel_image"]["id"], "_wp_attachment_image_alt", true);
		if ( wp_http_validate_url($image_html ) ) {
			$image_html = '<img src=" '.esc_url( $image_html ).'" alt="'.esc_url( $image_alt ).'">';
		} else {
			$image_html;
		}
		
		return $image_html;
	}
}