<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Group_Control_Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * News Ticker Widget
 */
class Classyea_News_Ticker extends Widget_Base
{

    /**
     * Retrieve News Ticker widget name.
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'classyea-news-ticker';
    }

    /**
     * Retrieve News Ticker widget title.
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('News Ticker', 'classyea');
    }

    /**
     * Retrieve News Ticker widget icon.
     * @access public
     * @return string Widget icon.
     */

    public function get_icon()
    {
        return 'eicon-slider-push classyea';
    }

    /**
     * Retrieve News Ticker widget category.
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
            'classy newticker',
            'news',
            'news-ticker',
            'ticker',
            'text-slider',
            'slider',
        ];
    }

    public function get_script_depends()
    {
        return [
            'classyea-news-ticker-loaded',
        ];
    }
    public function get_style_depends()
    {
        return [
            'font-awesome-5-all-classyea',
        ];
    }

    /**
     * Register News Ticker widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 2.0.3
     * @access protected
     */

    protected function register_controls()
    {
        /* Content Tab */
        $this->register_content_controls();
        $this->classyea_news_control();
        $this->classyea_overlay_style_controls();
        $this->classyea_newsticker_style_controls();
    }

    protected function register_content_controls()
    {

        /**
         * Content Tab: News Ticker
         */
        $this->start_controls_section(
            'section_carousel_setting',
            [
                'label' => __('Settings', 'classyea'),
            ]
        );

        $layouts = array();
        for ($x = 1; $x <= 10; $x++) {
            $layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
        }

        $this->add_control(
            'newsticker_layout',
            [
                'label'     => __('Layout', 'classyea'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'layout-1',
                'options'   => $layouts,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_space',
            [
                'label'              => __('Space between items', 'classyea'),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 1,
                'max'                => 10000,
                'default'            => 1,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'              => __('Slide Speed', 'classyea'),
                'description'        => __('Autoplay speed in seconds. Default 3000', 'classyea'),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 1,
                'max'                => 10000,
                'default'            => 3000,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'slider_item',
            [
                'label'              => __('Slider items', 'classyea'),
                'type'               => Controls_Manager::NUMBER,
                'min'                => 0,
                'max'                => 3,
                'default'            => 2,
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'infinite',
            [
                'label'        => __('infinite Loop?', 'classyea'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'classyea'),
                'label_off'    => __('Hide', 'classyea'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    /**
     *    Repeater TAB
     **/
    protected function classyea_news_control()
    {

        $this->start_controls_section(
            'section_news_ticker',
            [
                'label' => __('News Ticker', 'classyea'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sticky_title',
            [
                'label'     => __('Sticky Title', 'classyea'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __('Breaking News', 'classyea'),
                'dynamic'   => [
                    'active' => true,
                ],
                'condition' => [
                    'newsticker_layout' =>
                    [
                        'layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-9', 'layout-10',
                    ],
                ],
            ]
        );

        $this->add_control(
            'account_title',
            [
                'label'     => __('Account Label Text', 'classyea'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __('My Account', 'classyea'),
                'dynamic'   => [
                    'active' => true,
                ],
                'condition' => ['newsticker_layout' => 'layout-1'],
            ]
        );
        $this->add_control(
            'title_label_txt',
            [
                'label'     => __('Title Label Text', 'classyea'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __('New Added:', 'classyea'),
                'dynamic'   => [
                    'active' => true,
                ],
                'condition' => ['newsticker_layout' => 'layout-1'],
            ]
        );

        $this->add_control(
            'news_post_type',
            [
                'label'       => esc_html__('Content Sourse', 'classyea'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => classyea_get_post_types(),
            ]
        );

        $this->add_control(
            'post_categories',
            [
                'label'       => esc_html__('Categories', 'classyea'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => classyea_get_categories(),
                'condition'   => [
                    'news_post_type' => 'post',
                ],
            ]
        );

        $this->add_control(
            'product_categories',
            [
                'label'       => esc_html__('Categories', 'classyea'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => classyea_get_categories('product_cat'),
                'condition'   => [
                    'news_post_type' => 'product',
                ],
            ]
        );

        $this->add_control(
            'classyea_newslimit',
            [
                'label'     => __('News Limit', 'classyea'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'custom_order',
            [
                'label'        => esc_html__('Custom order', 'classyea'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label'     => esc_html__('Order by', 'classyea'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'date'          => esc_html__('Date', 'classyea'),
                    'ID'            => esc_html__('ID', 'classyea'),
                    'author'        => esc_html__('Author', 'classyea'),
                    'title'         => esc_html__('Title', 'classyea'),
                    'modified'      => esc_html__('Modified', 'classyea'),
                    'rand'          => esc_html__('Random', 'classyea'),
                    'comment_count' => esc_html__('Comment count', 'classyea'),
                    'menu_order'    => esc_html__('Menu order', 'classyea'),
                ],
                'default'   => 'date',
                'condition' => [
                    'custom_order' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'     => esc_html__('Order', 'classyea'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'DESC',
                'options'   => [
                    'DESC' => esc_html__('Descending', 'classyea'),
                    'ASC'  => esc_html__('Ascending', 'classyea'),
                ],
                'default'   => 'DESC',
                'condition' => [
                    'custom_order' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'title_length',
            [
                'label'   => esc_html__('Post Title Length', 'classyea'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 20,
                'default' => 6,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_news_ticker_icon',
            [
                'label'     => __('Label Icon', 'classyea'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'newsticker_layout' =>
                    [
                        'layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-9', 'layout-10',
                    ],
                ],
            ]
        );
        $this->add_control(
            'classyea_news_icon',
            [
                'label'     => esc_html__('News Label Icon', 'classyea'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-star',
                    'library' => 'solid',
                ],
                'condition' => [
                    'newsticker_layout' =>
                    [
                        'layout-1', 'layout-2', 'layout-3', 'layout-4', 'layout-9', 'layout-10',
                    ],
                ],
            ]
        );
        $this->add_control(
            'classyea_acc_icon',
            [
                'label'     => esc_html__('Account Label Icon', 'classyea'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-user',
                    'library' => 'solid',
                ],
                'condition' => ['newsticker_layout' => 'layout-1'],
            ]
        );

        $this->add_control(
            'acc_newticker_icon',
            [
                'label'     => esc_html__('Title Label Icon', 'classyea'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-bolt',
                    'library' => 'solid',
                ],
                'condition' => ['newsticker_layout' => 'layout-1'],
            ]
        );

        $this->add_control(
            'logo_image',
            [
                'label'     => esc_html__('Newsticker Logo Image', 'classyea'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => ['newsticker_layout' => 'layout-3'],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => ['newsticker_layout' => 'layout-3'],
            ]
        );

        $this->end_controls_section();
    }

    protected function classyea_overlay_style_controls()
    {

        $this->start_controls_section(
            'overlay_background',
            [
                'label' => __('Wrapper', 'classyea'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_bordrfield_border',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-newsticker-wrapper',
                'separator' => 'before',
                'condition' => ['newsticker_layout' => [
                    'layout-1','layout-3'
                    ]
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'       => 'background',
                'label'      => esc_html__('Background', 'classyea'),
                'types'      => ['classic', 'gradient'],
                'show_label' => true,
                'selector'   => '{{WRAPPER}} .classyea-newsticker-right-side-two.style-three,{{WRAPPER}} .classyea-newsticker-carousel8,{{WRAPPER}} .classyea-newsticker-wrapper,{{WRAPPER}} .classyea-newsticker-wrapper-two,{{WRAPPER}} .classyea-newsticker-right-side-two.style-four,{{WRAPPER}} .classyea-newsticker-right-side-two.style-three,{{WRAPPER}} .classyea-newsticker-right-side-two.style-three',
            ]
        );

        $this->add_control(
            'overlay_opacity',
            [
                'label'     => __('Opacity', 'classyea'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-right-side-two.style-three' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel8'                  => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .classyea-newsticker-wrapper'                    => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .classyea-newsticker-wrapper-two'                => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .classyea-newsticker-right-side-two.style-three' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'main_wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-newsticker-right-side-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-right-side-two.style-four' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .newsticker-layout-ten .classyea-newsticker-label-two.style-three' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-right-side-two.style-three' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-wrapper-two.layout-seven' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['newsticker_layout' => [
                    'layout-10','layout-7','layout-6'
                    ]
                ],
			]
		);

        $this->end_controls_section();
    }

    protected function classyea_newsticker_style_controls()
    {
        $this->start_controls_section(
            'classyea_carousel_navigation_dots',
            [
                'label' => __('Navigation - Arrow', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'sticky_arrow_padding',
            [
                'label' => __( 'Arrow Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
					'{{WRAPPER}} .classyea-newsticker-carousel-nav.style-two' => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-nav' => 'top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .classyea-newsticker-carousel-nav.style-two' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-nav' => 'right: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
        $this->add_responsive_control(
			'border_position_x',
			[
				'label' => __( 'Border Vertical', 'classyea' ),
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
					'{{WRAPPER}} .classyea-newsticker-title.style-five:before' => 'top: {{SIZE}}{{UNIT}};',
					
				],
                'condition' => ['newsticker_layout' => 'layout-10'],
			]
		);
		$this->end_popover();
        $this->add_responsive_control(
			'arrow_gap_news',
			[
				'label' => __( 'Arrow Gap', 'classyea' ),
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
					'{{WRAPPER}} .classyea-newsticker-carousel-nav' => 'gap: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
        $this->add_responsive_control(
			'arrow_width',
			array(
				'label'      => __('Button Width', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-newsticker-carousel-button-prev.style-four.classyea-ncb-prev8' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-button-next.style-four.classyea-ncb-next8' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-button-prev' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-button-next' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
        $this->add_responsive_control(
			'arrow_height',
			array(
				'label'      => __('Button Height', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1200,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-newsticker-carousel-button-prev.style-four.classyea-ncb-prev8' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-button-next.style-four.classyea-ncb-next8' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-button-next' => 'height: {{SIZE}}{{UNIT}};',
                    
				),
			)
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'classyea_border_item_border',
				'label' => esc_html__( 'Border', 'classyea' ),
				'selector' => '{{WRAPPER}} .classyea-newsticker-carousel-button-prev,{{WRAPPER}} .classyea-newsticker-carousel-button-next',
			]
		);
        $this->add_responsive_control(
			'arrow_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .classyea-newsticker-carousel-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-newsticker-carousel-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

        $this->start_controls_tabs('_tabs_dots');
        $this->start_controls_tab(
            'classyea_tab_dots_normal',
            [
                'label' => __('Normal', 'classyea'),
            ]
        );

        $this->add_control(
            'arrow_background',
            [
                'label'     => esc_html__('Arrow Background', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-wt-leftarrow'                    => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow'                   => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-next' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-leftarrow-two'                => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow-two'               => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_nav_color',
            [
                'label'     => __('Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-wt-leftarrow'                                => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow'                               => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev'             => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-next'             => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-leftarrow-two'                            => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow-two'                           => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev.style-three' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'classyea_tab_dots_hover',
            [
                'label' => __('Hover', 'classyea'),
            ]
        );
        $this->add_control(
            'arrow_hover_background',
            [
                'label'     => esc_html__('Arrow Background', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-wt-leftarrow:hover'                    => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow:hover'                   => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-next:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-leftarrow-two:hover'                => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow-two:hover'               => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_nav_color',
            [
                'label'     => __('Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-wt-leftarrow:hover'                                => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow:hover'                               => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev:hover'             => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-next:hover'             => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-leftarrow-two:hover'                            => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-wt-rightarrow-two:hover'                           => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-carousel-button-prev.style-three:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'classyea_carousel_label_icon',
            [
                'label' => __('Label Icon', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_icon_color',
            [
                'label'     => __('Icon Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ul.classyea-newsticker-list i'                   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label i'                    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two i'                => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two-icon-color-two'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two-icon-color-three' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two.style-three i'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-dot-5'                      => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-dot-4'                      => 'background-color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 
                    [
                        'layout-1',
                        'layout-2',
                        'layout-3',
                        'layout-4',
                        'layout-6',
                        'layout-7',
                        'layout-8',
                        'layout-9',
                        'layout-10'
                    ]
                ],
            ]
        );

        $this->add_control(
            'label_icon_color_1',
            [
                'label'     => __('Icon Color 1', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-dot-1' => 'color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 'layout-5'],
            ]
        );
        $this->add_control(
            'label_icon_color_2',
            [
                'label'     => __('Icon Color 2', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-dot-2' => 'color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 'layout-5'],
            ]
        );
        $this->add_control(
            'label_icon_color_3',
            [
                'label'     => __('Icon Color 3', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-dot-3' => 'color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 'layout-5'],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'classyea_title_label_icon',
            [
                'label' => __('Title Label', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['newsticker_layout' =>
                    [
                        'layout-1','layout-3','layout-4',
                    ]
                ],
            ]
        );
        $this->add_control(
            'title_label_color',
            [
                'label'     => __('Title Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-label' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-title-count' => 'color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' =>
                    [
                        'layout-1','layout-3','layout-4',
                    ]
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-newsticker-label,{{WRAPPER}} .classyea-newsticker-title-count',
                'separator' => 'after',
                'condition' => ['newsticker_layout' =>
                    [
                        'layout-1','layout-3','layout-4',
                    ]
                ],
            ]
        );
        $this->add_control(
            'title_label_dot_bg_color',
            [
                'label'     => __('Background Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title-count' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' =>
                    [
                        'layout-4',
                    ]
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'classyea_sticky_title',
            [
                'label' => __('Sticky Title', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'breaking_label_color',
            [
                'label'     => __('Title Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} ul.classyea-newsticker-list' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two.style-two' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'breaking_typography',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} ul.classyea-newsticker-list,{{WRAPPER}} .classyea-newsticker-label-two,{{WRAPPER}} .classyea-newsticker-label-two.style-two',
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'breaking_news_bgcolor',
            [
                'label'     => __('Background', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-label-two' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} ul.classyea-newsticker-list' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .newsticker-layout-four .classyea-newsticker-label-two.style-two' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two.style-two' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two.style-three' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_stickytitlebordrfield_border',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} ul.classyea-newsticker-list li,{{WRAPPER}} .classyea-newsticker-label-two.style-two',
                'separator' => 'before',
                'condition' => ['newsticker_layout' =>
                    [
                        'layout-1','layout-2','layout-9','layout-4'
                    ]
                ],
            ]
        );
       
        $this->end_controls_section();
        $this->start_controls_section(
            'classyea_category_title',
            [
                'label' => __('Category', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => ['newsticker_layout' =>
                    [
                        'layout-9','layout-10',
                    ]
                ],
            ]
        );
        $this->add_control(
            'category_color_one',
            [
                'label'     => __('Color One', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title-label.bg-one' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'category_color_two',
            [
                'label'     => __('Color Two', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title-label.bg-two' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'category_color_three',
            [
                'label'     => __('Color Three', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title-label.bg-three' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'classyea_post_title',
            [
                'label' => __('Newsticker Title', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'Newsticker_label_color',
            [
                'label'     => __('Title Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'Newsticker_typography',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-newsticker-title',
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'title_bgcolor_main_newsticker',
            [
                'label'     => __('Title BG', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 
                    ['layout-2','layout-4','layout-5','layout-6','layout-7','layout-9','layout-10']
                ],
            ]
        );
        $this->add_control(
            'title_bgcolor_one',
            [
                'label'     => __('Title BG 1', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title.style-two.bg-one' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 'layout-8'],
            ]
        );
        $this->add_control(
            'title_bgcolor_two',
            [
                'label'     => __('Title BG 2', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title.style-two.bg-two' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 'layout-8'],
            ]
        );
        $this->add_control(
            'title_bgcolor_three',
            [
                'label'     => __('Title BG 3', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .classyea-newsticker-title.style-two.bg-three' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['newsticker_layout' => 'layout-8'],
            ]
        );
        $this->add_responsive_control(
            'newsticker_padding',
            [
                'label' => __( 'Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-logoCarousel-box-871' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['newsticker_layout' => 
                    [
                        'layout-2',
                        'layout-4',
                        'layout-5',
                        'layout-6',
                        'layout-7',
                        'layout-9',
                        'layout-8',
                        'layout-10'
                    ]
                ],
            ]
        );
        $this->add_control(
			'sticky_border_color',
			array(
				'label'     => __('Left Border Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} ul.classyea-newsticker-list li' => 'border-left:1px solid {{VALUE}}', 
					'{{WRAPPER}} .classyea-newsticker-title.style-five:before' => 'background: {{VALUE}}', 
					'{{WRAPPER}} .classyea-newsticker-title' => 'border-left:1px solid {{VALUE}}', 
				),
				'condition' => ['newsticker_layout' =>
                    [
                        'layout-1','layout-10','layout-9'
                    ]
                ],
			)
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'classyea_padding_section',
            [
                'label' => __('Padding Sticky | Label', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'sticky_title_padding',
            [
                'label' => __( 'Sticky Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ul.classyea-newsticker-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-newsticker-label-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-newsticker-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'post_title_padding',
            [
                'label' => __( 'Title Padding', 'classyea' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} ul.classyea-newsticker-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-newsticker-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                    '{{WRAPPER}} .classyea-newsticker-right-side' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings          = $this->get_settings_for_display();
        $custom_order      = $settings['custom_order'];
        $newsticker_layout = $settings['newsticker_layout'];
        $autoplay_speed    = $settings['autoplay_speed'];
        $item_space        = $settings['item_space'];
        $slider_item       = $settings['slider_item'];
        $infinite          = $settings['infinite'];

        if ($infinite == 'yes') {
            $enable = true;
        } else {
            $enable = false;
        }

        $news_post_type     = $settings['news_post_type'];
        $sticky_title       = $settings['sticky_title'];
        $post_categories    = $settings['post_categories'];
        $prod_categories    = $settings['product_categories'];
        $classyea_newslimit = $settings['classyea_newslimit'];
        $title_length       = $settings['title_length'];
        $account_title      = $settings['account_title'];
        $title_label_txt    = $settings['title_label_txt'];

        if (!empty($prod_categories)) {
            $get_categories = $prod_categories;
        } else {
            $get_categories = $post_categories;
        }

        if (is_array($get_categories)) {
            $posts_cats_ids = implode(', ', $get_categories);
        } else {
            $posts_cats_ids = $get_categories;
        }

        $args = [
            'post_type'           => ($news_post_type) ? $news_post_type : 'post',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'category_name'       => $posts_cats_ids,
            'posts_per_page'      => ($classyea_newslimit) ? $classyea_newslimit : 3,
            'include_children'    => false,
        ];

        if ($custom_order === 'yes') {
            $orderby         = $settings['orderby'];
            $order           = $settings['order'];
            $args['orderby'] = ($orderby) ? $orderby : 'DESC';
            $args['order']   = ($order) ? $order : 'DATE';
        }

        $changed_atts = array(
            'autoplay_speed' => ($autoplay_speed) ? $autoplay_speed : '30',
            'item_space'     => ($item_space) ? $item_space : '0',
            'slider_item'    => ($slider_item) ? $slider_item : '2',
            'infinite'       => $enable,
        );

        $query_args = new \WP_Query($args);
        if ($newsticker_layout == 'layout-1') {
?>
            <div class="classyea-newsticker-wrapper layout-one">
                <div class="container">
                    <div class="classyea-newsticker-inner-box">
                        <div class="classyea-newsticker-left-side">
                            <ul class="classyea-newsticker-list">
                                <li><?php echo $this->classyea_news_label_icon($settings); ?> <?php echo wp_kses($sticky_title, 'classyea_kses'); ?></li>
                                <li><?php \Elementor\Icons_Manager::render_icon($settings['classyea_acc_icon'], array('aria-hidden' => 'true')); ?> <?php echo wp_kses($account_title, 'classyea_kses'); ?></li>
                            </ul>
                        </div>
                        <div class="classyea-newsticker-right-side">
                            <div class="classyea-newsticker-label"><?php \Elementor\Icons_Manager::render_icon($settings['acc_newticker_icon'], array('aria-hidden' => 'true')); ?> <?php echo wp_kses($title_label_txt, 'classyea_kses'); ?></div>
                            <div class="swiper-container classyea-newsticker-carousel9" id="newsticker_nine" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                <?php
                                    if ($query_args->have_posts()) {
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="classyea-newsticker-title style-one">
                                            <?php
                                            echo wp_trim_words(get_the_title(), $title_length, '');
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>

                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev9 style-six"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next9 style-six"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        <?php } elseif ($newsticker_layout == 'layout-2') { ?>
            <div class="classyea-newsticker-wrapper-two layout-two">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two">
                            <div class="classyea-newsticker-label-two"><?php echo $this->classyea_news_label_icon($settings); ?> <?php echo wp_kses($sticky_title, 'classyea_kses'); ?></div>
                            <div class="swiper-container classyea-newsticker-carousel" id="newsticker_two" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title">
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?></div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev1"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next1"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-3') { ?>
            <div class="classyea-newsticker-wrapper layout-three">
                <div class="container">
                    <div class="classyea-newsticker-inner-box">
                        <div class="classyea-newsticker-left-side">
                            <div class="classyea-newsticker-logo">
                                <?php echo $this->logo_image($settings); ?></div>
                        </div>
                        <div class="classyea-newsticker-right-side">
                            <div class="classyea-newsticker-label">
                                <?php echo $this->classyea_news_label_icon($settings); ?> <?php echo wp_kses($sticky_title, 'classyea_kses'); ?></div>
                            <div class="swiper-container classyea-newsticker-carousel10" id="newsticker_ten" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                <?php
                                if ($query_args->have_posts()) {
                                    while ($query_args->have_posts()) {
                                        $query_args->the_post();
                                ?>
                                    <div class="swiper-slide">
                                        <div class="classyea-newsticker-title style-one">
                                            <?php
                                                echo wp_trim_words(get_the_title(), $title_length, '');
                                            ?>
                                            </div>
                                    </div>
                                <?php
                                    }
                                } else {
                                    ?>
                                    <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                <?php
                                }
                                wp_reset_postdata();
                                ?>

                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav style-five">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev10 style-five"><span><i class="fas fa-angle-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next10 style-five"><span><i class="fas fa-angle-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>    


        <?php } elseif ($newsticker_layout == 'layout-4') { ?>
            <div class="classyea-newsticker-wrapper-two newsticker-layout-four">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two">
                            <div class="classyea-newsticker-label-two style-two"><?php echo $this->classyea_news_label_icon($settings); ?> <?php echo wp_kses($sticky_title, 'classyea_kses'); ?></div>
                            <div class="swiper-container classyea-newsticker-carousel2" id="newsticker_four" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        $i     = 1;
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();

                                            if ($i < 10) {
                                                $counter = "0" . $i;
                                            } else {
                                                $counter = $i;
                                            }
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title">
                                                    <div class="classyea-newsticker-title-count">
                                                        <?php echo $counter; ?></div>
                                                    <?php echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev2"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next2"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-5') { ?>
            <div class="classyea-newsticker-wrapper-two">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two style-two">
                            <div class="swiper-container classyea-newsticker-carousel3" id="newsticker_five" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title style-two">
                                                    <div class="classyea-newsticker-dot-<?php echo esc_attr($count); ?>"></div>
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev3 style-two"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next3 style-two"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-6') { ?>
            <div class="classyea-newsticker-wrapper-two layout-six">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two style-three">
                            <div class="swiper-container classyea-newsticker-carousel4" id="newsticker_six" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();
                                            if ($count > 3) {
                                                $count = 1;
                                            }
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title style-three">
                                                    <div class="classyea-newsticker-dot-4"></div>
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav style-three">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev4 style-three"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next4 style-three"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-7') { ?>
            <div class="classyea-newsticker-wrapper-two layout-seven">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two style-three">
                            <div class="swiper-container classyea-newsticker-carousel5" id="newsticker_seven" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();

                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title style-three">
                                                    <div class="classyea-newsticker-dot-4"></div>
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav style-three">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev5 style-three"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next5 style-three"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-8') { ?>
            <div class="classyea-newsticker-wrapper-two">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two style-two">
                            <div class="swiper-container classyea-newsticker-carousel6" id="newsticker_eight" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">

                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();

                                            if ($count == '1') {
                                                $bg_class = 'bg-one';
                                            }
                                            if ($count == '2') {
                                                $bg_class = 'bg-two';
                                            }
                                            if ($count == '3') {
                                                $bg_class = 'bg-three';
                                            }
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title style-two <?php echo esc_attr($bg_class); ?>">
                                                    <div class="classyea-newsticker-dot-5"></div>
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev6 style-two"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next6 style-two"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-9') { ?>
            <div class="classyea-newsticker-wrapper-two layout-nine">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two">
                            <div class="classyea-newsticker-label-two style-two"><?php echo $this->classyea_news_label_icon($settings); ?> <?php echo wp_kses($sticky_title, 'classyea_kses'); ?></div>
                            <div class="swiper-container classyea-newsticker-carousel7" id="newsticker_eleven" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        while ($query_args->have_posts()) {

                                            $query_args->the_post();
                                            $category = get_the_category();

                                            if ($count == '1') {
                                                $bg_class = 'bg-one';
                                            }
                                            if ($count == '2') {
                                                $bg_class = 'bg-two';
                                            }
                                            if ($count == '3') {
                                                $bg_class = 'bg-three';
                                            }
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title style-four">
                                                <?php if(isset($category[0]->cat_name)) { ?> 
                                                    <div class="classyea-newsticker-title-label <?php echo esc_attr($bg_class); ?>"><?php echo esc_html($category[0]->cat_name); ?></div>
                                                    <?php } ?>
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav">
                                <div class="classyea-newsticker-carousel-button-prev classyea-ncb-prev7"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next classyea-ncb-next7"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } elseif ($newsticker_layout == 'layout-10') { ?>
            <div class="classyea-newsticker-wrapper-two newsticker-layout-ten">
                <div class="container">
                    <div class="classyea-newsticker-inner-box-two">
                        <div class="classyea-newsticker-right-side-two style-four">
                            <div class="classyea-newsticker-label-two style-three"><?php echo $this->classyea_news_label_icon($settings); ?> <?php echo wp_kses($sticky_title, 'classyea_kses'); ?></div>
                            <div class="swiper-container classyea-newsticker-carousel8" id="newsticker_twelve" data-id='<?php echo wp_json_encode($changed_atts); ?>'>
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($query_args->have_posts()) {
                                        $count = 1;
                                        $i     = 0;
                                        while ($query_args->have_posts()) {
                                            $query_args->the_post();
                                            $category = get_the_category();

                                            if ($count == '1') {
                                                $bg_class = 'bg-one';
                                            }
                                            if ($count == '2') {
                                                $bg_class = 'bg-two';
                                            }
                                            if ($count == '3') {
                                                $bg_class = 'bg-three';
                                            }
                                    ?>
                                            <div class="swiper-slide">
                                                <div class="classyea-newsticker-title style-five">
                                                    <?php if(isset($category[0]->cat_name)) { ?> 
                                                    <div class="classyea-newsticker-title-label <?php echo esc_attr($bg_class); ?>"><?php echo esc_html($category[0]->cat_name); ?></div>
                                                    <?php } ?>
                                                    <?php
                                                    echo wp_trim_words(get_the_title(), $title_length, '');
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($count == 3) {
                                            ?>
                                        <?php
                                                $count = 1;
                                            } else {
                                                $count++;
                                            }
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <li><a href="#"><?php esc_html_e('Content Not Found', 'classyea') ?></a></li>
                                    <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="classyea-newsticker-carousel-nav style-two">
                                <div class="classyea-newsticker-carousel-button-prev style-four classyea-ncb-prev8"><span><i class="fas fa-arrow-left"></i></span></div>
                                <div class="classyea-newsticker-carousel-button-next style-four classyea-ncb-next8"><span><i class="fas fa-arrow-right"></i></span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }

    protected function classyea_news_label_icon($settings)
    {

        if (!isset($settings['icon']) && !\Elementor\Icons_Manager::is_migration_allowed()) {
            $settings['icon'] = 'fa fa-star';
        }
        $migrated = isset($settings['__fa4_migrated']['classyea_news_icon']);
        $is_new   = !isset($settings['icon']) && \Elementor\Icons_Manager::is_migration_allowed();
        if ($is_new || $migrated) {
            \Elementor\Icons_Manager::render_icon($settings['classyea_news_icon'], array('aria-hidden' => 'true'));
        } else {
        ?>
            <i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
<?php }
    }

    protected function logo_image($settings)
    {

        $newsticker_layout = $settings['newsticker_layout'];
        if ($newsticker_layout == 'layout-3') {
            echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'logo_image'), 'classyea_img');
        }
    }
}
