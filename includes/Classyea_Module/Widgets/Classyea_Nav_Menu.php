<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use ClassyEa\Helper\Classyea_Module\Settings\Classyea_Nav_Menu_Walker;
use Elementor\Group_Control_Image_Size;

class Classyea_Nav_Menu extends Widget_Base {

   /**
	 * Retrieve nav menu widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-nav-menu';
	}

	public function get_style_depends()
	{
		return [
			'font-awesome-5-all-classyea',
            'classyea-nav-menu'
		];
	}

    public function get_script_depends()
	{
		return [
			'classyea-scrollbar-js',
            'classyea-nav-menu-js'
		];
	}
	/**
	 * Retrieve nav menu widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Nav Menu', 'classyea');
	}
	/**
	 * Retrieve nav menu widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyea eicon-nav-menu';
	}
	/**
	 * Retrieve nav menu widget category.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea_hfe'];
	}

   /**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.2.5
	 * @access protected
	 *
	 * @return string nav index.
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

    protected function register_controls()
	{

        $this->classyea_content_general_func();
        $this->menu_wrapper_style_tab();
        $this->classyea_menu_item_tab_style();
        $this->submenu_item_style_tab();
        $this->classyea_submenu_box_style();
        $this->classyea_mobile_menu_social_tab();
        
    }
    

    private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

    /**
	 * Check if the Elementor is updated.
	 *
	 * @since 1.2.5
	 *
	 * @return boolean if Elementor updated.
	 */
	public static function is_elementor_updated() {
		if ( ! class_exists( 'Elementor\Icons_Manager' ) ) {
            return false;
		} else {
            return true;
		}
	}


    protected function classyea_content_general_func() {

        $this->start_controls_section(
            'classyea_content_tab',
            [
                'label' => esc_html__('Classy Nav Menu', 'classyea'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $menus = $this->get_available_menus();

		
        $this->add_control(
            'classyea_nav_menu',
            [
                'label'        => __( 'Select menu', 'classyea' ),
                'type'         => Controls_Manager::SELECT,
                'options'      => $menus,
                'default'      => array_keys( $menus )[0],
                'save_default' => true,
                'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'classyea' ), admin_url( 'nav-menus.php' ) ),
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_position',
            [
                'label' => esc_html__( 'Menu Position', 'classyea' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'classyea-menu-left',
                'options' => [
                    'classyea-menu-left'  => esc_html__( 'Left', 'classyea' ),
                    'classyea-menu-center' => esc_html__( 'Center', 'classyea' ),
                    'classyea-menu-right' => esc_html__( 'Right', 'classyea' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'classyea_menu_setting',
            [
                'label' => esc_html__('Menu Settings', 'classyea'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'classyea_nav_menu_logo_select_url',
            [
                'label' => esc_html__( 'Mobile Logo link', 'classyea' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'home',
                'options' => [
                    'home' => esc_html__( 'Default(Home)', 'classyea' ),
                    'custom' => esc_html__( 'Custom URL', 'classyea' ),
                ],
            ]
        );

        $this->add_control(
            'classyea_nav_menu_logo_link',
            [
                'label' => esc_html__( ' Custom Link', 'classyea' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://links.com',
                'condition' => [
                    'classyea_nav_menu_logo_select_url' => 'custom',
                ],
                'show_label' => false,

            ]
        );
        $this->add_control(
			'dropdown',
			[
				'label'        => __( 'Breakpoint', 'classyea' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __( 'Mobile (768px >)', 'classyea' ),
					'tablet' => __( 'Tablet (1025px >)', 'classyea' ),
					'none'   => __( 'None', 'classyea' ),
				],
				'prefix_class' => 'classyea-nav-menu__breakpoint-',
				'render_type'  => 'template',
			]
        );

        $this->add_control(
			'dropdown_default_icon',
			[
				'label' => esc_html__( 'Dropdown Default Icon', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'condition'   => [
                    'dropdown!' => 'none',
                ],
			]
		);

        if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'classyea_dropdown_icon',
				[
					'label'       => __( 'Menu Icon', 'classyea' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'fas fa-align-justify',
						'library' => 'fa-solid',
					],
					'condition'   => [
						'dropdown!' => 'none',
                        'dropdown_default_icon!' => 'yes'
					],
				]
			);
		} else {
			$this->add_control(
				'classyea_dropdown_icon',
				[
					'label'       => __( 'Icon', 'classyea' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-align-justify',
					'condition'   => [
						'dropdown!' => 'none',
                        'dropdown_default_icon!' => 'yes'
					],
				]
			);
		}

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'classyea_dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'classyea' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'far fa-window-close',
						'library' => 'fa-regular',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'classyea_dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'classyea' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-close',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

        $this->add_control(
            'mobile_logo_enable_disable',
            [
                'label'       => __( 'Logo Image Enable?', 'classyea' ),
                'type'        => Controls_Manager::SWITCHER,
                'yes'         => __( 'Yes', 'classyea' ),
                'no'          => __( 'No', 'classyea' ),
                'default'     => 'no',
            ]
        );

        $this->add_control(
            'mobile_logo_image',
            [
                'label'     => __( 'Logo Image', 'classyea' ),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'mobile_logo_enable_disable' => 'yes',
                ],
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

        $this->start_controls_section(
			'menu_social',
			[
				'label'     => __('Nav Menu Social', 'classyea'),
			]
		);
		$this->add_control(
			'social_item',
			[
				'label'        => __('Display Social Contact?', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'social_link',
			[
				'label'       => __('Social Link', 'classyea'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'placeholder' => __('Enter URL', 'classyea'),
			]
		);
        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Select Icon', 'classyea'),
                'fa4compatibility' => 'classyea_social_icon',
                'default' => [
                    'value' => 'fab fa-facebook',
                    'library' => 'fa-solid',
                ],
                'label_block' => true,
                'type' => Controls_Manager::ICONS,

            ]
        );

		$this->add_control(
			'items',
			[
				'label'     => __('Add Social Links', 'classyea'),
				'type'      => Controls_Manager::REPEATER,
				'default'   => [
					[
						'select_social_icon' => [
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
					[
						'select_social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
					[
						'select_social_icon' => [
							'value'   => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
				],
				'fields'    => $repeater->get_controls(),
				'condition' => [
					'social_item' => 'yes',
				],
			]
		);
		$this->end_controls_section();

    }

    protected function menu_wrapper_style_tab () {

        $this->start_controls_section(
            'classyea_menu_style_tab',
            [
                'label' => esc_html__('Menu Wrapper', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_main_menu_bg',
                'label' => esc_html__( 'Menu  Background', 'classyea' ),
                'types' => [ 'classic', 'gradient' ],
                'devices' => [ 'desktop' ],
                'selector' => '{{WRAPPER}} .classyea-main-header .classyea-nav-outer',
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_width',
            [
                'label' => esc_html__( 'Width', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 350,
                        'max' => 700,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-header' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_height',
            [
                'label' => esc_html__( 'Height', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 300,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-header .classyea-nav-outer' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_border_radius',
            [
                'label' => esc_html__( 'border radius', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'separator' => [ 'before' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-header .classyea-nav-outer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function classyea_menu_item_tab_style() {


        $this->start_controls_section(
            'classyea_style_tab_main_menu_item',
            [
                'label' => esc_html__('Menu  style', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'classyea_menu_item_spacing',
            [
                'label' => esc_html__( 'Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => [ 'before' ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_margin',
            [
                'label' => esc_html__( 'Margin', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'classyea_content_typography',
                'label' => esc_html__( 'Typography', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li>a',
            ]
        );


        $this->start_controls_tabs(
            'classyea_nav_main_menu_tabs'
        );
        // Normal
        $this->start_controls_tab(
            'classyea_nav_main_menu_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'classyea' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_main_content_nav_background',
                'label' => esc_html__( 'Item background', 'classyea' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a',
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_text_color',
            [
                'label' => esc_html__( 'text color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'desktop_default' => '#000000',
                'tablet_default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a' => 'color: {{VALUE}}',
                ],
            ]
        );
	
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'  => 'classyea_main_menu_text_border',
				'selector'  => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a',
				'size_units'  => ['px'],
			]
		);

		$this->add_control(
			'classyea_main_menu_text_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'classyea_nav_main_menu_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'classyea' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_main_menu_background_hover',
                'label' => esc_html__( 'background', 'classyea' ),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a:hover,{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a:focus',
            ]
        );

        $this->add_responsive_control(
            'classyea_main_menu_item_color_hover',
            [
                'label' => esc_html__( 'Text color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li a:current-menu-item' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'  => 'classyea_main_menu_text_border_hover',
				'selector'  => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li:hover > a',
				'size_units'  => ['px'],
			]
		);

		$this->add_control(
			'classyea_main_menu_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius (px)', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li:hover > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        // active
        $this->start_controls_tab(
            'classyea_nav_main_menu_active_tab',
            [
                'label' => esc_html__( 'Active', 'classyea' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'		=> 'classyea_nav_main_menu_active_bg_color',
                'label' 	=> esc_html__( 'background', 'classyea' ), 
                'types'		=> ['classic', 'gradient'],
                'selector'	=> '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-item a,{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-ancestor a'
            ]
        );

        $this->add_responsive_control(
            'classyea_nav_menu_active_text_color',
            [
                'label' => esc_html__( 'text color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-item a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-ancestor a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-item a .classyea-submenu-indicator' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'  => 'classyea_main_menu_bordertext_active',
				'selector'  => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-item a',
				'size_units'  => ['px'],
			]
		);

		$this->add_control(
			'classyea_main_menu_border_text_radius_active',
			[
				'label'      => esc_html__('Border Radius (px)', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function submenu_item_style_tab() {

        $this->start_controls_section(
            'classyea_style_tab_submenu_item',
            [
                'label' => esc_html__('Submenu  style', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'classyea_style_tab_item_arrow',
            [
                'label' => esc_html__( 'Submenu Indicator', 'classyea' ),
                'type'  => Controls_Manager::SELECT,
                'default' => 'fas fa-angle-down',
                'options' => [
                    'fas fa-angle-down'    => esc_html__( 'Line Arrow', 'classyea' ),
                    'fas fa-plus'     => esc_html__( 'Plus', 'classyea' ),
                    'fas fa-caret-down'    => esc_html__( 'Fill Arrow', 'classyea' ),
                    'classyea_none'          => esc_html__( 'None', 'classyea' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_style_tab_submenu_indicator_color',
            [
                'label' => esc_html__( 'Indicator color', 'classyea' ),
                'type'  => Controls_Manager::COLOR,
                'default'   =>  '#101010',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .has-submenu-custom .classyea-menu-toggle i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'classyea_style_tab_submenu_item_arrow!' => 'classyea_none'
                ]
            ]
        );
        $this->add_responsive_control(
            'classyea_submenu_indicator_spacing',
            [
                'label' => esc_html__( 'Indicator Margin (px)', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .has-submenu-custom .classyea-menu-toggle i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'classyea_style_tab_submenu_item_arrow!' => 'classyea_none'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'classyea_menu_item_typography',
                'label' => esc_html__( 'Typography', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li.current-menu-item .sub-menu a',
            ]
        );

        $this->add_responsive_control(
            'classyea_submenu_item_spacing',
            [
                'label' => esc_html__( 'Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'classyea_submenu_active_hover_tabs'
        );
        $this->start_controls_tab(
            'classyea_submenu_normal_tab',
            [
                'label'	=> esc_html__('Normal', 'classyea')
            ]
        );

        $this->add_responsive_control(
            'classyea_submenu_item_color',
            [
                'label' => esc_html__( 'Item text color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu a' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_menu_item_background',
                'label' => esc_html__( 'Item background', 'classyea' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'classyea_submenu_hover_tab',
            [
                'label'	=> esc_html__('Hover', 'classyea')
            ]
        );

        $this->add_responsive_control(
            'classyea_item_text_color_hover',
            [
                'label' => esc_html__( 'Item text color (hover)', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li.current-menu-item a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li:hover  a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_menu_item_background_hover',
                'label' => esc_html__( 'Item background (hover)', 'classyea' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '
					{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li a:hover'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'classyea_submenu_active_tab',
            [
                'label'	=> esc_html__('Active', 'classyea')
            ]
        );

        $this->add_responsive_control(
            'classyea_nav_sub_menu_active_text_color',
            [
                'label' => esc_html__( 'Item text color (Active)', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#707070',
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li.current-menu-item a' => 'color: {{VALUE}} !important'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'		=> 'classyea_nav_sub_menu_active_bg_color',
                'label' 	=> esc_html__( 'Item background (Active)', 'classyea' ),
                'types'		=> ['classic', 'gradient'],
                'selector'	=> '{{WRAPPER}} .classyea-main-menu.style2 .classyea-navigation>li .sub-menu li.current-menu-item a',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'classyea_menu_item_border_heading',
            [
                'label' => esc_html__( 'Sub Menu Items Border', 'classyea' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_menu_item_border',
                'label' => esc_html__( 'Border', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-main-menu .classyea-navigation>li>ul>li',
            ]
        );


        $this->end_controls_section();

    }

    protected function classyea_submenu_box_style() {

        $this->start_controls_section(
            'classyea_style_tab_submenu_panel',
            [
                'label' => esc_html__('Submenu Box style', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'sub_panel_padding',
			[
				'label'         => esc_html__('Padding', 'classyea'),
                'type'          => Controls_Manager::DIMENSIONS,
				'selectors'     => [
					'{{WRAPPER}} .classyea-main-menu .classyea-navigation>li.menu-item-has-children:hover>ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_panel_submenu_border',
                'label' => esc_html__( 'Panel Menu Border', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-main-menu .classyea-navigation>li.menu-item-has-children:hover>ul',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_submenu_container_background',
                'label' => esc_html__( 'Container background', 'classyea' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .classyea-main-menu .classyea-navigation>li.menu-item-has-children:hover>ul',
            ]
        );

        $this->add_responsive_control(
            'classyea_submenu_panel_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu .classyea-navigation>li.menu-item-has-children:hover>ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_submenu_container_width',
            [
                'label' => esc_html__( 'Width', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-main-menu .classyea-navigation>li>ul' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_panel_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-main-menu .classyea-navigation>li>ul',
            ]
        );


        $this->end_controls_section();
    }

    protected function classyea_mobile_menu_logo_style_tab() {
           

        $this->start_controls_section(
            'classyea_mobile_menu_logo_style_tab',
            [
                'label' => esc_html__( 'Mobile Menu Logo', 'classyea' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'classyea_mobile_menu_logo_width',
            [
                'label' => esc_html__( 'Width', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-menu-box .nav-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_mobile_menu_logo_height',
            [
                'label' => esc_html__( 'Height', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-menu-box .nav-logo img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_mobile_menu_logo_margin',
            [
                'label' => esc_html__( 'Margin', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-menu-box .nav-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_mobile_menu_logo_padding',
            [
                'label' => esc_html__( 'Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-menu-box .nav-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function classyea_mobile_menu_social_tab() {
        $this->start_controls_section(
            'classyea_mobile_menu_social_tabsss',
            [
                'label' => esc_html__( 'Mobile Menu Social', 'classyea' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'classyea_social_width',
            [
                'label' => esc_html__( 'Width', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .social-links li a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'classyea_social_height',
            [
                'label' => esc_html__( 'Height', 'classyea' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .social-links li a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'classyea_social_border_radius',
			[
				'label'      => esc_html__('Border Radius (px)', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-mobile-menu .social-links li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'  => 'classyea_social_border',
				'selector'  => '{{WRAPPER}} .classyea-mobile-menu .social-links li a',
				'size_units'  => ['px'],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'classyea_social_typography',
                'label' => esc_html__( 'Typography', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-mobile-menu .social-links li a',
            ]
        );

        $this->start_controls_tabs(
            'classyea_social_active_hover_tabs'
        );
        $this->start_controls_tab(
            'classyea_social_normal_tab',
            [
                'label'	=> esc_html__('Normal', 'classyea')
            ]
        );

        $this->add_responsive_control(
            'classy_social_normal_bg',
            [
                'label'     => esc_html__( 'Social Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .social-links li a'   => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'classy_social_normal_color',
            [
                'label'     => esc_html__( 'Social Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .social-links li a'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'classyea_social_hover_tab',
            [
                'label'	=> esc_html__('Hover', 'classyea')
            ]
        );

        $this->add_responsive_control(
            'classy_social_hover_bg',
            [
                'label'     => esc_html__( 'Social Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .social-links li a:hover'   => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'classy_social_hover_color',
            [
                'label'     => esc_html__( 'Social Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .social-links li a:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function classyea_mobile_menu_style_tab() {
        $this->start_controls_section(
            'classyea_mobile_menu_style_tabsss',
            [
                'label' => esc_html__( 'Mobile Menu', 'classyea' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'wrapper_color_mobile',
            [
                'label'     => esc_html__( 'Mobile Wrapper Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .classyea-menu-box'   => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'  => 'classyea_mobile_left_color_border',
				'selector'  => '{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li>a:before',
				'size_units'  => ['px'],
			]
		);

        $this->add_responsive_control(
            'classy_menu_hovermobile_color',
            [
                'label'     => esc_html__( 'Menu Normal Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li>a'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classy_menu_active_mobile_color',
            [
                'label'     => esc_html__( 'Menu Active Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li.current-menu-item>a'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classyea_menu_mobile_menu_item_space',
            [
                'label' => esc_html__( 'Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => [ 'before' ],
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'arrow_position_dropdown_vertical',
			[
				'label' => __( 'Arrow Vertical', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li.menu-item-has-children .dropdown-btn' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'dropdown_btn_bg',
            [
                'label'     => esc_html__( 'Dropdown Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li.menu-item-has-children .dropdown-btn'   => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_btn_icon_color',
            [
                'label'     => esc_html__( 'Dropdown Icon Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .classyea-navigation li.menu-item-has-children .dropdown-btn'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'classy_menu_close_btn_icon_color',
            [
                'label'     => esc_html__( 'Close Btn Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-mobile-menu .close-btn i'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings_for_display();

        // Return classyea_nav_menu select or not
        if(empty($settings['classyea_nav_menu'])) {
            return;
        }

        $nav_menu = $settings['classyea_nav_menu'];

        $rand_id = $this->randomString();

        $get_id = $this->get_id();

        $wp_nav_menu = wp_nav_menu( [
            'menu'        => $nav_menu,
			'menu_class'  => 'classyea-navigation clearfix',
			'menu_id'     => 'menu-' . $rand_id . '-' . $get_id,
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
            'echo'        => false,
			'walker'      => new Classyea_Nav_Menu_Walker(),
        ]);


        $dropdown_default_icon       = $settings['dropdown_default_icon'];
        $classyea_main_menu_position = $settings['classyea_main_menu_position'];

        $menu_position = '';
        if( $classyea_main_menu_position == 'classyea-menu-left' ) {
            $menu_position = 'menu-po-left';
        }
        elseif( $classyea_main_menu_position == 'classyea-menu-center' ) {
            $menu_position = 'menu-po-center';
        } elseif( $classyea_main_menu_position == 'classyea-menu-right' ) {
            $menu_position = 'menu-po-right';
        }

        $submenu_arrow = $settings['classyea_style_tab_item_arrow'];

        $classyea_dropdown_icon = $settings['classyea_dropdown_icon'];

        $close_icon = $settings['classyea_dropdown_close_icon'];

        if( isset( $nav_menu ) && $nav_menu != '' && wp_get_nav_menu_items( $nav_menu ) !== false ){
            /**
             * Hamburger Toggler Button
             */
            ?>
            <div class="classyea-main-header">
                <div class="classyea-nav-outer style2 clearfix <?php echo esc_attr($menu_position);?>">
                    <!--Mobile Navigation Toggler-->
                    <div class="classyea-mobile-nav-toggler">
                        <div class="inner">
                            <?php if($dropdown_default_icon == 'yes') { ?>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <?php } else { 
                                if ( $this->is_elementor_updated() ) {
                                    Icons_Manager::render_icon( $classyea_dropdown_icon,['aria-hidden' => 'true','tabindex'    => '0',]);
                                } else {
                                    echo wp_kses_post('<i class="' . esc_attr( $classyea_dropdown_icon ) . '" aria-hidden="true" tabindex="0"></i>');
                                } } ?>
                        </div>
                    </div>
                    <!-- Main Menu -->
                    <nav class="classyea-main-menu style2 navbar-expand-md">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <?php echo wp_kses_post($wp_nav_menu); ?>
                        </div>
                    </nav>
                    <!-- Main Menu End-->
                </div>
            </div>
            <div class="classyea-mobile-menu">
			<div class="menu-backdrop"></div>
			<div class="close-btn">
                <?php 
                 if ( $this->is_elementor_updated() ) {
                    Icons_Manager::render_icon( $close_icon,['aria-hidden' => 'true','tabindex'    => '0',]
                    );
                } else {
                    echo wp_kses_post('<i class="' . esc_attr( $close_icon ) . '" aria-hidden="true" tabindex="0"></i>');
                }
                 ?>
            </div>
			<?php $this->get_mobile_menu( $settings ); ?>
		</div>
        <script>
            jQuery(".classyea-menu-toggle i").addClass("<?php echo esc_attr($submenu_arrow);?>");
        </script>
        <?php 
        }
        
    }


    public function get_mobile_menu( $settings ) {

        $mobile_logo_enable_disable  = $settings['mobile_logo_enable_disable'];

         /**
             * mobile menu functionality
             */
            $link = $target = $nofollow = '';

            if (isset($settings['classyea_nav_menu_logo_select_url']) && $settings['classyea_nav_menu_logo_select_url'] == 'home') {
                $link = get_home_url('/');
            } elseif(isset($settings['classyea_nav_menu_logo_select_url']) && !empty($settings['classyea_nav_menu_logo_link']['url'])){
                $link = $settings['classyea_nav_menu_logo_link']['url'];
                $target = ($settings['classyea_nav_menu_logo_link']['is_external'] != "on" ? "" : "_blank");
                $nofollow = ($settings['classyea_nav_menu_logo_link']['nofollow'] != "on" ? "" : "nofollow");
            }

        ?>
            <nav class="classyea-menu-box">
                <?php 
                if($mobile_logo_enable_disable == 'yes') { 
                    ?> 
				<div class="nav-logo">
					<a href="<?php echo esc_url($link); ?>" target="<?php echo (!empty($target) ? esc_attr($target) : '_self');?>" rel="<?php echo esc_attr($nofollow);?>">
                    <?php 
                    if (!empty($settings['mobile_logo_image']['url'])) : 
                        echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'mobile_logo_image'),'classyea_img');
                    endif;
                    ?>
					</a>
				</div>
                <?php } ?>
				<div class="menu-outer">
					<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
				</div>
                <?php $this->classyea_nav_social_links(); ?>
			</nav>

        <?php 
    }


    protected function classyea_nav_social_links()
	{
		$settings = $this->get_settings_for_display();

        $social_item = $settings['social_item'];
		?>
        <?php if($social_item == 'yes') { ?>
                <div class="social-links">
                    <ul class="clearfix">
			<?php
			$i = 1;
			foreach ($settings['items'] as $index => $item) {

                // new icon
                $migrated = isset( $item['__fa4_migrated']['social_icon'] );
                // old icon
                $is_new = empty( $item['classyea_social_icon'] );

			?>
                    <li>
                        <a href="<?php echo esc_attr($item['social_link']['url']); ?>">
                        <?php
                            if ($is_new || $migrated) {
                                Icons_Manager::render_icon($item['social_icon'], array('aria-hidden' => 'true'));
                            } else {
                            ?>
                                <i class="<?php echo esc_attr($item['classyea_social_icon']); ?>"></i>
                            <?php } ?>
                        </a>
                    </li>
				<?php
				$i++;
			}
			?>
		</ul>
		</div>
<?php
        }
	}
}