<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \ClassyEa\Helper\Classyea_Module\Settings\Classyea_Helper;
use \Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * image accordion Widget
 */
class Classyea_Image_Accordion extends Widget_Base
{

	/****
	 * Retrieve image accordion widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 ***/
	public function get_name()
	{
		return 'classyea-widget-image-accordion';
	}
	/**
	 * Retrieve image accordion widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Image Accordion', 'classyea');
	}
	/**
	 * Retrieve image accordion widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-image-accordion';
	}
	/**
	 * Retrieve image accordion widget category.
	 *
	 * @access public
	 *
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
	public function get_script_depends()
	{
		return array('classyea-image-accordion-script');
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
            'gallery',
            'classy filter gallery',
            'classy filterable gallery',
            'image gallery',
            'media gallery',
            'media',
            'photo gallery',
            'portfolio',
            'classy portfolio',
            'media grid',
            'responsive gallery',
            'photo gallery',
            'classy',
            'classy addons'
        ];
    }
	/**
	 * Register image accordion widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_image_compare_controls();
		$this->register_image_compare_main_controls();
		$this->register_style_tab_section_controls();

	}
	protected function register_content_image_compare_controls()
	{

		/**
		 * Content Tab: image accordion
		 */
		$this->start_controls_section(
			'section_image_comparision',
			[
				'label'                 => __('General', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 5; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
			if($x == 1){
				$layouts['layout-' . $x] = __('On Click + Horizontal Layout', 'classyea') . ' ' . $x;
			}
			elseif($x == 2){
				$layouts['layout-' . $x] = __('On Click + Vertical Layout', 'classyea') . ' ' . $x;
			}
			elseif($x == 3){
				$layouts['layout-' . $x] = __('On Click + Horizontal Layout', 'classyea') . ' ' . $x;
			}
			elseif($x == 4){
				$layouts['layout-' . $x] = __('On Click + Vertical Layout', 'classyea') . ' ' . $x;
			}
			elseif($x == 5){
				$layouts['layout-' . $x] = __('On Hover + Horizontal Layout', 'classyea') . ' ' . $x;
			}
		}

		$this->add_control(
			'image_accordion_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);
		$this->add_control(
            'classyea_img_accordion_content_heading',
            [
                'label' => __( 'Content', 'classyea' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'classyea_img_acc_con_horizontal_align',
            [
                'label'   => __( 'Horizontal Alignment', 'classyea' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => __( 'Left', 'classyea' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'classyea' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'classyea' ),
                        'icon'  => 'eicon-h-align-right',
                    ]
                ],
                'default' => 'center',
                'toggle'  => true,
            ]
        );
        $this->add_control(
            'classyea_img_acc_con_vertical_align',
            [
                'label'   => __( 'Vertical Alignment', 'classyea' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'top'    => [
                        'title' => __( 'Top', 'classyea' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'classyea' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => __( 'Bottom', 'classyea' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'center',
                'toggle'  => true,
            ]
        );

        $this->add_responsive_control(
			'items_spacing',
			[
				'label'                 => esc_html__( 'Items Spacing', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px'        => [
						'min'   => 0,
						'max'   => 50,
						'step'  => 1,
					],
				],
				'size_units'            => [ 'px' ],
				'default'               => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002:not(:last-child)' => 'margin-right: {{SIZE}}px',
					'{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003:not(:last-child)' => 'margin-bottom: {{SIZE}}px!important',
					'{{WRAPPER}} .classyea-imageAccordion__box-item-2000:not(:last-child)' => 'margin-right: {{SIZE}}px!important',
					'{{WRAPPER}} .classyea-imageAccordion__box-item-2001:not(:last-child)' => 'margin-bottom: {{SIZE}}px!important',
					'{{WRAPPER}} .classyea_imageAccodion__item.classyea_imageAccordion__item:not(:last-child)' => 'margin-right: {{SIZE}}px!important',
					'{{WRAPPER}} #classyea-imageAccordion__container_2004 .classyea_imageAccodion__item:not(:last-child)' => 'margin-right: {{SIZE}}px!important',
				]
			]
		);

		$this->end_controls_section();
	}

	/****
	 * Tab Style Image accordion ****/
	protected function register_style_tab_section_controls(){
        $this->start_controls_section(
            'classyea_section_img_accordion_style_settings',
            [
                'label' => esc_html__( 'Overlay', 'classyea' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'classyea_acc_img_overlay_color',
            [
                'label'     => esc_html__( 'Overlay Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, 0.2)',
                'selectors' => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2001 .overlay' => 'background-color: {{VALUE}};',
                ],
				'condition'             => [
					'image_accordion_layout'    => [
						'layout-1',
						'layout-2',
					]
				]
            ]
        );

        $this->add_responsive_control(
            'classyea_acc_container_padding',
            [
                'label'      => esc_html__( 'Padding', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay, .classyea-imageAccordion__box-item-2001 .overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_imageAccodion__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'classyea_acc_container_margin',
            [
                'label'      => esc_html__( 'Margin', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay, .classyea-imageAccordion__box-item-2001 .overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_imageAccodion__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'classyea_acc_border',
                'label'    => esc_html__( 'Border', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay, .classyea-imageAccordion__box-item-2001 .overlay,{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image,{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image,{{WRAPPER}} .classyea_imageAccodion__item',
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'classyea_section_img_acc_thumbnail_style_settings',
            [
                'label' => esc_html__( 'Image', 'classyea' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'classyea_img_accordion_min_height',
			[
				'label' => esc_html__( 'Min Height', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
	
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion__container-item-2001' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion__container-item-2001, .classyea-imageAccordion__box-item-2001' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion-box-2002' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion-box-2002' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion__container_2004 .classyea_imageAccodion__gallery__wrap' => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion__container_2004 .classyea_imageAccodion__gallery__wrap' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #classyea-imageAccordion__container-item-2000' => 'min-height: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} #classyea-imageAccordion__container-item-2000' => 'height: {{SIZE}}{{UNIT}}!important;',
					
					
				],
			]
		);

        $this->add_control(
            'classyea_image_acc_thumbnail_margin',
            [
                'label'      => __( 'Margin', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2001' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_imageAccodion__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'classyea_image_acc_thumbnail_padding',
            [
                'label'      => __( 'Padding', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2001' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_imageAccodion__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'classyea_image_acc_thumbnail_radius',
            [
                'label'      => __( 'Border Radius', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2001' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_imageAccodion__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-imageAccordion__item-2000' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'classyea_image_acc_thumbnail_border',
                'label'    => __( 'Border', 'classyea' ),
                'selector' => '{{WRAPPER}} .classyea-imageAccordion__box-item-2000,{{WRAPPER}} .classyea-imageAccordion__box-item-2001,{{WRAPPER}} #classyea-imageAccordion-box-2002 .classyea-imageAccordion-item-2002 .classyea-imageAccordion-image,{{WRAPPER}} #classyea-imageAccordion-box-2003 .classyea-imageAccordion-item-2003 .classyea-imageAccordion-image,{{WRAPPER}} .classyea_imageAccodion__item',
            ]
        );
        $this->end_controls_section();

		$this->start_controls_section(
            'classyea_img_acc_title_settings',
            [
                'label' => esc_html__( 'Title', 'classyea' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'classyea_acc_title_text',
            [
                'label'     => esc_html__( 'Title', 'classyea' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'classyea_acc_title_color',
            [
                'label'     => esc_html__( 'Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay .overlay__inner__content' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2001 .overlay .overlay__inner__content .classyea-image-acc-heading' => 'color: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-image-acc-heading' => 'color: {{VALUE}}!important;',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_acc_title_typography',
                'selector' => '{{WRAPPER}} .classyea-image-acc-heading',
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'classyea_img_acc_title_content_settings',
            [
                'label' => esc_html__( 'Content', 'classyea' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'classyea_acc_content_text',
            [
                'label'     => esc_html__( 'Content', 'classyea' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'classyea_acc_content_color',
            [
                'label'     => esc_html__( 'Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay .overlay__inner__content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-imageAccordion__box-item-2001 .overlay .overlay__inner__content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2002 .active .classyea-imageAccordion-image .classyea-imageAccordion-content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-imageAccordion-box-2003 .active .classyea-imageAccordion-image .classyea-imageAccordion-content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea_imageAccodion__item:hover p' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_acc_content_typography',
                'selector' => '{{WRAPPER}} .classyea-imageAccordion__box-item-2000 .overlay .overlay__inner__content p,.classyea-imageAccordion__box-item-2001 .overlay .overlay__inner__content p,{{WRAPPER}} #classyea-imageAccordion-box-2002 .active .classyea-imageAccordion-image .classyea-imageAccordion-content p,#classyea-imageAccordion-box-2003 .active .classyea-imageAccordion-image .classyea-imageAccordion-content p,.classyea_imageAccodion__item:hover p',
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'classyea_img_acc_title_button_settings',
            [
                'label' => esc_html__( 'Button', 'classyea' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'classyea_button_color',
            [
                'label'     => esc_html__( 'Button Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .classyea-imageAccordion__item-2001--active a' => 'color: {{VALUE}}!important;',
                ]
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_button_typography',
                'selector' => '{{WRAPPER}} .classyea-imageAccordion__item-2001--active a',
            ]
        );
        $this->end_controls_section();
	}
	
	/*	Main Control */
	protected function register_image_compare_main_controls()
	{

		$this->start_controls_section(
			'section_items',
			[
				'label'                 => esc_html__( 'Accordion', 'classyea' ),
			]
		);
		$repeater = new Repeater();
		$repeater->start_controls_tabs( 'classyea_image_accordion_tabs' );
		$repeater->start_controls_tab( 'tab_content', [ 'label' => __( 'Content', 'classyea' ) ] );
		$repeater->add_control(
            'image_acc_is_active',
            [
                'label' => esc_html__('Keep this slide open? ', 'classyea'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'classyea' ),
                'label_off' =>esc_html__( 'No', 'classyea' ),
            ]
        );
		$repeater->add_control(
			'title',
			[
				'label'                 => esc_html__( 'Title', 'classyea' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => esc_html__( 'Accordion Title', 'classyea' ),
				'dynamic'               => [
					'active'   => true,
				]
			]
		);
		$repeater->add_control(
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
		$repeater->add_control(
			'description',
			[
				'label'                 => esc_html__( 'Description', 'classyea' ),
				'type'                  => Controls_Manager::WYSIWYG,
				'label_block'           => true,
				'default'               => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'classyea' ),
				'dynamic'               => [
					'active'   => true,
				]
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab( 'tab_image', [ 'label' => __( 'Image', 'classyea' ) ] );
		$repeater->add_control(
			'acc_image',
			[
				'label' => __('Image', 'classyea'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [
					'active' => true,
				]
				
			]
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'exclude' => ['custom'],
				'separator' => 'none',
				
			]
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab( 'classyea_tab_link', [ 'label' => __( 'Link', 'classyea' ) ] );
		$repeater->add_control(
			'show_button',
			[
				'label'                 => __( 'Show Button', 'classyea' ),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => '',
				'label_on'              => __( 'Yes', 'classyea' ),
				'label_off'             => __( 'No', 'classyea' ),
				'return_value'          => 'yes',
			]
		);
		$repeater->add_control(
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
					'show_button'   => 'yes',
				]
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label'                 => __( 'Button Text', 'classyea' ),
				'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => __( 'Get Started', 'classyea' ),
				'condition'             => [
					'show_button'   => 'yes',
				]
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$this->add_control(
			'accordion_items',
			[
				'type'                  => Controls_Manager::REPEATER,
				'seperator'             => 'before',
				'default'               => [
					[
						'title'         => esc_html__( 'Accordion #1', 'classyea' ),
						'description'   => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, odio', 'classyea' ),
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
					[
						'title'         => esc_html__( 'Accordion #2', 'classyea' ),
						'description'   => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, odio','classyea'), 
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
					[
						'title'         => esc_html__( 'Accordion #3', 'classyea' ),
						'description'   => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure odio','classyea'), 
						'image'         => [
							'url' => Utils::get_placeholder_image_src(),
						]
					],
				],
				'fields'        => $repeater->get_controls(),
				'title_field' => '{{title}}',
			]
		);
		$this->add_control(
            'image_acc_open_first_slide',
            [
                'label' => esc_html__( 'Keep first slide auto open?', 'classyea' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'classyea' ),
                'label_off' => esc_html__( 'No', 'classyea' ),
                'return_value' => 'yes',
                'default' => 'yes',
				'condition'             => [
					'image_accordion_layout' => [
						'layout-3',
						'layout-4',
					]
				]
            ]
        );
        $this->end_controls_section();
		
	}
	protected function render()
	{
		$settings 				=  $this->get_settings_for_display();
		$image_accordion_layout = $settings['image_accordion_layout'];
		
		$section_id = '';
		switch ($image_accordion_layout) {
			case 'layout-1':
				$section_id = 'classyea-imageAccordion__container-item-2000';
				
				break;
			case 'layout-3':
				$section_id = 'classyea-imageAccordion-box-2002';
				break;
			case 'layout-4':
				$section_id = 'classyea-imageAccordion-box-2003';
				break;
			case 'layout-6':
				$section_id = 'classyea-image-compare-box-406';
				break;
			default:
		}

			 if($image_accordion_layout == 'layout-1') : ?>
				<div id="classyea-imageAccordion__container-item-2000">
					<?php $this->classyea_img_acc_repeater_control($settings);?>
				</div>
			<?php elseif($image_accordion_layout == 'layout-2') : ?>
				<div>
					<div id="classyea-imageAccordion__container-item-2001">
						<?php $this->classyea_img_acc_repeater_control($settings);?>
					</div>
				</div>
			<?php elseif($image_accordion_layout == 'layout-3' || $image_accordion_layout == 'layout-4') : ?>
				<div id="<?php echo esc_attr($section_id);?>">
					<?php $this->classyea_img_acc_repeater_control($settings);?>
				</div>
			<?php elseif($image_accordion_layout == 'layout-5') : ?>
				<div id="classyea-imageAccordion__container_2004">
				<div class="classyea_imageAccodion__gallery__wrap">
					<div class="classyea_imageAccordion__overlay"></div>
					<?php $this->classyea_img_acc_repeater_control($settings);?>
				</div>
				</div>
			<?php endif;
	}
	/**
	 * Image accordion repeater control function
	 * Render image accordion output on the frontend.
	 * @access protected
	 */
	protected function classyea_img_acc_repeater_control($settings)
	{
		$settings = $this->get_settings_for_display();
		$image_accordion_layout = $settings['image_accordion_layout'];
		$accordion_items 		= $settings['accordion_items'];
		
		switch ($image_accordion_layout) {
			case 'layout-1':
				$accordion_id = 'classyea-team-box-251';
				break;
			case 'layout-2':
				$accordion_id = 'classyea-team-box-252';
				break;
			case 'layout-3':
				$accordion_id = 'classyea-imageAccordion-item-2002';
				break;
			case 'layout-4':
				$accordion_id = 'classyea-imageAccordion-item-2003';
				break;
			case 'layout-5':
				$accordion_id = 'classyea-team';
				break;
			case 'layout-6':
				$accordion_id = 'classyea-team';
				break;
			default:
				$accordion_id = 'classyea-team-box-251';
		}

		$horizontal_alignment = $settings['classyea_img_acc_con_horizontal_align'];
		$vertical_alignment = $settings['classyea_img_acc_con_vertical_align'];

		if($horizontal_alignment == 'left') :
			$horizontal_class = 'horizontal-left';
		elseif($horizontal_alignment == 'center') :
			$horizontal_class = 'horizontal-center';
		elseif($horizontal_alignment == 'right') :
			$horizontal_class = 'horizontal-right';
		endif;

		if($vertical_alignment == 'top') :
			$vertical_class = 'vertical-top';
		elseif($vertical_alignment == 'center') :
			$vertical_class = 'vertical-center';
		elseif($vertical_alignment == 'bottom') :
			$vertical_class = 'vertical-bottom';
		endif;
		$i = 1;
		foreach ($accordion_items as $index => $accordion_item) { 
			$title = $accordion_item['title'];
			if ($title) {
				$this->add_inline_editing_attributes('title', 'none');
				$this->add_render_attribute('title', 'class', 'image-accordion-heading');

			}

			if($image_accordion_layout == 'layout-3' || $image_accordion_layout == 'layout-4') {
				$image_acc_open_first_slide = $settings['image_acc_open_first_slide'];
				if($accordion_item['image_acc_is_active'] == 'yes'){
					$is_active = 'active';
				} elseif($image_acc_open_first_slide == 'yes' && $index == '0'){
					$is_active = 'active';
				} else{
					$is_active = '';
				}

			}

			if($image_accordion_layout == 'layout-1') {
				
				$image_acc_open_first_slide = $settings['image_acc_open_first_slide'];
				if($accordion_item['image_acc_is_active'] == 'yes'){
					$is_active = 'classyea-imageAccordion__item-2000--active';
				} elseif($image_acc_open_first_slide == 'yes' && $index == '0'){
					$is_active = 'classyea-imageAccordion__item-2000--active';
				} else{
					$is_active = '';
				}

			}

			
			if($image_accordion_layout == 'layout-1' || $image_accordion_layout == 'layout-2' || $image_accordion_layout == 'layout-5') :
				$item_image = ($accordion_item["acc_image"]["id"] != "") ? wp_get_attachment_image_url($accordion_item["acc_image"]["id"], "full") : $accordion_item["acc_image"]["url"];

			endif;
			
			if($image_accordion_layout == 'layout-1') : ?>
			<div class="classyea-imageAccordion__box-item-2000 <?php echo esc_attr($is_active);?>">
				<div class="classyea-imageAccordion__item-2000" style="background-image: url(<?php echo esc_url($item_image);?>);">
					<div class="overlay">
						<div class="overlay__inner">
							<div class="overlay__inner__content <?php echo esc_attr($horizontal_class);?> <?php echo esc_attr($vertical_class);?>">
								<?php $this->classyea_render_heading($accordion_item,$index);?>
								<?php $this->classyea_image_accordion_desc($accordion_item);?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php elseif($image_accordion_layout == 'layout-2') : ?>
				<div class="classyea-imageAccordion__box-item-2001">
					<div class="classyea-imageAccordion__item-2001" style="background-image: url(<?php echo esc_url($item_image);?>);">
						<div class="overlay <?php echo esc_attr($horizontal_class);?>">
							<div class="overlay__inner">
								<div class="overlay__inner__content <?php echo esc_attr($vertical_class);?>">
									<?php 
										$this->classyea_render_heading($accordion_item,$index);
										$this->classyea_button_link_markup($accordion_item,$index);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php elseif($image_accordion_layout == 'layout-3' || $image_accordion_layout == 'layout-4') : ?>
				<div class="<?php echo esc_attr($accordion_id);?> <?php echo esc_attr($is_active);?>">
					<div class="classyea-imageAccordion-image">
						<?php $this->classyea_accordion_thumbnail_image($accordion_item,$settings);?>
						<div class="classyea-imageAccordion-content <?php echo esc_attr($horizontal_class);?> <?php echo esc_attr($vertical_class);?>">
							<?php 
								$this->classyea_render_heading($accordion_item,$index);
								$this->classyea_image_accordion_desc($accordion_item);
							?>
						</div>
					</div>
				</div>
			<?php elseif($image_accordion_layout == 'layout-5') : ?>
				<div class="classyea_imageAccodion__item classyea_imageAccordion__item<?php echo esc_attr($i);?>" style="background-image: url(<?php echo esc_url($item_image);?>);">
					<div class="classyea_imageAccordion__hoverText <?php echo esc_attr($horizontal_class);?> <?php echo esc_attr($vertical_class);?>">
						<?php 
							$this->classyea_render_heading($accordion_item,$index);
							$this->classyea_image_accordion_desc($accordion_item);
						?>
					</div>
				</div>
			<?php endif;
	   $i++; } // endif
	}
	/**
	 * Image accordion render heading function
	 * Render image accordion heading output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_heading($accordion_item,$index)
	{

		if ($accordion_item['title']) {
			$this->add_inline_editing_attributes('title', 'none');
			$this->add_render_attribute('title', 'class', 'classyea-image-acc-heading',$index);

			if ($accordion_item['title']) {
				$title_tag = Classyea_Helper::classyea_validate_html_tag($accordion_item['title_tag']);
		?>
				<<?php echo esc_html($title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('title')); ?>>
					<?php echo wp_kses($accordion_item['title'],'classyea_kses'); ?>
				</<?php echo esc_html($title_tag); ?>>
			<?php
			}
		}
	}
	/**
	 * Image accordion render description function
	 * Render accordion description output on the frontend.
	 * @access protected
	 */
	protected function classyea_image_accordion_desc($accordion_item) {
		$description = $accordion_item['description'];?>
		<p><?php echo wp_kses($description,'classyea_kses');?></p>
	<?php }
	/**
	 * Image accordion render image function
	 * Render accordion thumbnail image output on the frontend.
	 * @access protected
	 */
	protected function classyea_accordion_thumbnail_image($accordion_item,$settings)
	{
		$image_accordion_layout = $settings['image_accordion_layout'];
		if( 'layout-3' == $image_accordion_layout || 'layout-4' == $image_accordion_layout) : 
			ob_start();
				echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($accordion_item, 'thumbnail', 'acc_image'),'classyea_img'); 
			echo ob_get_clean();
		endif;
	}
	/**
	 * Image accordion button link function
	 * Render accordion button output on the frontend.
	 * @access protected
	 */
	protected function classyea_button_link_markup($accordion_item,$index)
	{
		
		$show_button = $accordion_item['show_button'];
		if ('yes' === $show_button && !empty($accordion_item['button_text'])) :
			$link_key = $this->get_repeater_setting_key('link', 'button', $index);
			$this->add_link_attributes($link_key, $accordion_item['link']);
			$this->add_render_attribute($link_key, 'class',['classyea__btn__primary']);
		endif;
	
		if ('yes' === $show_button && !empty($accordion_item['button_text']))  { ?>
		<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>><?php echo wp_kses($accordion_item['button_text'],'classyea_kses'); ?></a>
	<?php
		} 
	}
}