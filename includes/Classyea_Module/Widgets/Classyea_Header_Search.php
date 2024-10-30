<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

defined('ABSPATH') || exit;

class Classyea_Header_Search extends Widget_Base
{


    /**
	 * Retrieve search widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-header-search';
	}
	/**
	 * Retrieve search widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Search', 'classyea');
	}
	/**
	 * Retrieve search widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyea eicon-search';
	}
    public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
           'classyea-header-search'
        ];
	}

    public function get_script_depends() {
		return [
			'classyea-searchbox-js',
		];
	}
	/**
	 * header search from widget category.
	 *
	 * @access public
	 *
	 * @return string get_categories
	 */
	public function get_categories()
	{
		return ['classyea_hfe'];
	}

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

        $this->start_controls_section(
            'general_setting',
            [
                'label' => esc_html__('Search Setting', 'classyea'),
            ]
        );

        $this->add_control(
            'search_button_text', [
                'label' => esc_html__('Button Text', 'classyea'),
                'type' => Controls_Manager::TEXT,
                'default'   => 'Search Now!',
                'label_block' => true,
            ]
        );


        $this->add_control(
            'search_icons',
            [
                'label' => esc_html__('Select Icon', 'classyea'),
                'fa4compatibility' => 'search_icon',
                'default' => [
                    'value' => 'eicon-search',
                    'library' => 'classyeaicons',
                ],
                'label_block' => true,
                'type' => Controls_Manager::ICONS,

            ]
        );

        $this->add_control(
            'placeholder_markup_content', [
                'label' => esc_html__('Placeholder Text', 'classyea'),
                'type' => Controls_Manager::TEXT,
                'default'   => 'Search Here',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'classyea_header_search_section_tab_style',
            [
                'label' => esc_html__('Search Icon Area', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'search_toggler_font_size',
            [
                'label'         => esc_html__('Font Size', 'classyea'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-search-toggler svg'    => 'max-width: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'search_toggler_border',
                'selector' => '{{WRAPPER}} .classyea-search-toggler',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'       => 'search_tooggler_box_shadow',
                'selector'   => '{{WRAPPER}} .classyea-search-toggler',
            ]
        );
        $this->add_control(
            'search_toggler_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_toggler_margin',
            [
                'label'         => esc_html__('Margin', 'classyea'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em'],
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5' ,
                    'left' => '5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'search_toggler_padding',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0' ,
                    'left' => '0',
                ],
				'selectors' => [
					'{{WRAPPER}} .classyea-search-toggler' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->add_control(
			'enable_height_width',
			[
				'label' => esc_html__( 'Enable Height Width?', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_responsive_control(
            'search_toggler_width',
            [
                'label'         => esc_html__('Toggler Width', 'classyea'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => '40',
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_height_width' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'search_toggler_height',
            [
                'label'         => esc_html__('Toggler Height', 'classyea'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => '40',
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_height_width' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'search_toggler_line_height',
            [
                'label'         => esc_html__('Line Height', 'classyea'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', 'em', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => '40',
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_height_width' => 'yes'
                ]
            ]
        );
        $this->add_responsive_control(
            'search_toggler_alignment_content',
            [
                'label' => esc_html__( 'Alignment', 'classyea' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'classyea' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'classyea' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'classyea' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->start_controls_tabs( 'classyea_search_tab_search_tabs' );
        $this->start_controls_tab(
            'search_toggle_normal_control',
            [
                'label' =>esc_html__( 'Normal', 'classyea' ),
            ]
        );
        $this->add_control(
            'search_toggler_normal_color',
            [
                'label' =>esc_html__( 'Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler, {{WRAPPER}} .classyea-search-toggler i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-search-toggler svg path, {{WRAPPER}} .classyea-search-toggler svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_toggler_normal_bg',
            [
                'label' =>esc_html__( 'Background Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'search_toggle_hover_control',
            [
                'label' =>esc_html__( 'Hover', 'classyea' ),
            ]
        );
        $this->add_control(
            'search_toggler_hover_color',
            [
                'label' =>esc_html__( 'Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler:hover, {{WRAPPER}} .classyea-search-toggler:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-search-toggler:hover svg path, {{WRAPPER}} .classyea-search-toggler:hover svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_toggler_hover_bg',
            [
                'label' =>esc_html__( 'Background Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-toggler:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
    $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
			'popup_container_style_tabs',
			[
				'label' => __( 'Search Popup Container', 'classyea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'popup_search_backdrop_background',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="search"]',
			]
        );


        $this->add_control(
			'container_padding_popup',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '25',
                    'right' => '250',
                    'bottom' => '20' ,
                    'left' => '30',
                ],
				'selectors' => [
					'{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="search"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'container_placeholder_tilte_color',
			[
				'label' => __( 'Placeholder Color', 'classyea' ),
                'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-search-form .classyea-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-search-form .classyea-form-control::-moz-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-search-form .classyea-form-control:-ms-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-search-form .classyea-form-control:-moz-placeholder' => 'color: {{VALUE}}',
				],
			]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'search_border_field',
                'selector' => '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="search"]',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_radius_popup_search',
            [
                'label' => esc_html__( 'Border radius', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="search"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       

		$this->end_controls_section();

        $this->start_controls_section(
			'btn_style_tabs_popup_search_btn',
			[
				'label' => __( 'Search Button', 'classyea' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->start_controls_tabs( 'tab_button_tabs_popup_search' );
        $this->start_controls_tab(
            'tab_button_normal_popup_search',
            [
                'label' =>esc_html__( 'Normal', 'classyea' ),
            ]
        );
        $this->add_control(
            'searech_btn_color_popup_search',
            [
                'label' =>esc_html__( 'Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_popup_search',
            [
                'label' =>esc_html__( 'Background Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hoverpopup_search',
            [
                'label' =>esc_html__( 'Hover', 'classyea' ),
            ]
        );
        $this->add_control(
            'button_hover_color_popup_search',
            [
                'label' =>esc_html__( 'Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]:hover' => 'color: {{VALUE}}!important;',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color_popup_search',
            [
                'label' =>esc_html__( 'Background Color', 'classyea' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'border_radius_popup_search_btn',
            [
                'label' => esc_html__( 'Border radius', 'classyea' ),
                'separator' => 'before',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'button_padding_popup_search',
			[
				'label' => esc_html__( 'Padding', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0' ,
                    'left' => '0',
                ],
				'selectors' => [
					'{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'popup_search_button_typography',
                'selector' => '{{WRAPPER}} .classyea-search-popup .classyea-search-form fieldset input[type="submit"]',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->end_controls_section();
    }


    protected function render( ) {
        $settings = $this->get_settings();

        $placeholder_text   = $settings['placeholder_markup_content'];
        $search_button_text = $settings['search_button_text'];
        // new icon
        $migrate_icon   = isset( $settings['__fa4_migrated']['search_icons'] );
        $new_icon       = empty( $settings['search_icon'] );
        $randid 		=  $this->randomString();

        ?>
        <div class="classyea-search-toggler-wrapper">
            <div class="classyea-serach-button-style1 classyea-serach-button-style1--instyle2">
                <button type="button" class="classyea-search-toggler">
                    <?php
                    if ( $new_icon || $migrate_icon ) {
                        Icons_Manager::render_icon( $settings['search_icons'], [ 'aria-hidden' => 'true' ] );
                    } else {
                        ?>
                        <i class="<?php echo esc_attr($settings['search_icon']); ?>" aria-hidden="true"></i>
                        <?php
                    }
                ?>
                </button>
            </div>
        </div>

        <!-- classyea-search-popup -->
        <div class="classyea-classyea-search-popup">
            <div id="classyea-search-popup" class="classyea-search-popup">
                <div class="classyea-close-search"><i class="icon-close"></i></div>
                <div class="popup-inner">
                    <div class="classyea-overlay-layer"></div>
                    <div class="classyea-search-form">
                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/') ); ?>">
                            <div class="form-group">
                                <fieldset>
                                <input class="classyea-form-control" type="search" id="#classyea_modal-popup-<?php echo esc_attr($randid); ?>" placeholder="<?php echo esc_attr( $placeholder_text ); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" required="">
                                    <input type="submit" value="<?php echo esc_attr( $search_button_text );?>" class="classyea-search-btn">
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- classyea-search-popup end -->
        <?php
    }
}
