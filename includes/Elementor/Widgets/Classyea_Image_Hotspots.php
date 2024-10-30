<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Team Member Widget
 */
class Classyea_Image_Hotspots extends Widget_Base
{

	/**
	 * Retrieve team_member widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-image-hotspots';
	}
	/**
	 * Retrieve team_member widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Image Hotspots', 'classyea');
	}
	/**
	 * Retrieve team_member widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-image-hotspot classyea';
	}
	/**
	 * Retrieve team_member widget category.
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
			'hot spots',
			'image hotspots',
			'hotspots',
			'classyea image hotspots',
			'classy hotspots',
		];
	}
	public function get_script_depends()
	{
		return array('classyea-image-hotspots-script');
	}

	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	
	/**
	 * Register team member widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->classyea_reg_hotspot_setting_control();

		/* Style Tab */
		$this->classyea_rer_hotspots_image_control();
		/** style image tab */
		$this->classyea_reg_image_controls_style();
	}
	protected function classyea_reg_hotspot_setting_control()
	{

		/**
		 * Content Tab: team_member
		 */
		$this->start_controls_section(
			'section_hotspot_setting',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'hotspot_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);
		$this->add_control(
			'distance',
			array(
				'label'       => __( 'Distance', 'classyea' ),
				'description' => __( 'Distance between the hotspot and the Tooltip.', 'classyea' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array(
					'size' => '',
				),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => [
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-tooltip' => 'bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-tooltip' => 'bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-hotspot-item-1293:hover .classyea-hotspot-content-1293' => 'bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-hotspot-item-1294:hover .classyea-hotspot-content-1294' => 'bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-hotspot-item-1295:hover .classyea-hotspot-content-1295' => 'bottom: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-hotSpot-icon-1296:hover .classyea-hotSpot-content-1296' => 'top: {{SIZE}}{{UNIT}}!important;',
				],
			)
		);
		$this->add_control(
			'classyea_tooltip_arrow',
			array(
				'label'              => __( 'Tooltip Arrow Show/Hide', 'classyea' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'label_on'           => __( 'Yes', 'classyea' ),
				'label_off'          => __( 'No', 'classyea' ),
				'return_value'       => 'yes',
			)
		);
		$this->end_controls_section();
	}
	/**
	 *	Repeater TAB
	 **/
	protected function classyea_rer_hotspots_image_control()
	{

		/**
		 * Content Repeater: team_member
		 */
		$this->start_controls_section(
			'section_hotspots_image',
			[
				'label'                 => __('Image', 'classyea'),
			]
		);

		$this->add_control(
			'item_bg_image',
			array(
				'label'   => esc_html__('Item Background Image', 'loveicon'),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-img::after' => 'background: url({{URL}})',

				),
				'condition' => ['item_bg_image_on_off' => 'yes'],
			)
		);
		$this->add_control(
			'hotspots_image',
			[
				'label'                 => esc_html__('Choose Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'hotspots_image[url]!' => '',
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_hotspot_repeater_control',
			[
				'label'                 => __('Hotspot', 'classyea'),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('hot_spots_tabs');

		$repeater->start_controls_tab('tab_content', array('label' => __('Content', 'classyea')));

		$repeater->add_control(
			'hotspot_item_label',
			array(
				'label'       => __('Item Label', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => '',
			)
		);

		$repeater->add_control(
			'classyea_hotspot_type',
			array(
				'label'   => __('Type', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'description' => __( 'Text + Icon use for design two', 'classyea' ),
				'default' => 'icon',
				'options' => array(
					'icon'  => __('Icon', 'classyea'),
					'text'  => __('Text + Icon', 'classyea'),
				),
			)
		);

		$repeater->add_control(
			'classyea_selected_icon',
			array(
				'label'            => __('Icon', 'classyea'),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => false,
				'default'          => array(
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				),
				'fa4compatibility' => 'hotspot_icon',
				'skin'             => 'inline',
				'conditions'       => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'classyea_hotspot_type',
							'operator' => '==',
							'value'    => 'icon',
						),
						array(
							'name'     => 'classyea_hotspot_type',
							'operator' => '==',
							'value'    => 'text',
						),
					),
				),
			)
		);

		$repeater->add_control(
			'classyea_hotspot_text',
			array(
				'label'       => __('Text', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => '#',
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'classyea_hotspot_type',
							'operator' => '==',
							'value'    => 'text',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'hotspot_link',
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
		$repeater->add_control(
			'hotspot_design',
			array(
				'label'        => __('Hotspot Design?', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => __("Use for layout six"),
				'default'      => '',
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
			)
		);
		$repeater->add_control(
			'icon_design_class',
			array(
				'label'   => __('Tooltip Class', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'description'  => __("Use for layout six"),
				'default' => 'vase',
				'options' => array(
					'vase'  => __('vase', 'classyea'),
					'monitor'  => __('monitor', 'classyea'),
					'gallery' => __('gallery', 'classyea'),
					'chair' => __('chair', 'classyea'),
					'door' => __('door', 'classyea'),
				),
				'conditions'  => array(
					'terms' => array(
						array(
							'name'     => 'hotspot_design',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
			)
		);

		$repeater->end_controls_tab();
		$repeater->start_controls_tab('tab_position', array('label' => __('Position', 'classyea')));
		$repeater->add_control(
			'classyea_left_position',
			array(
				'label'     => __('Left Position (%)', 'classyea'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'default'   => [
					'unit' => 'px',
					'size' => 20,
				],
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%!important;',
				),
			)
		);

		$repeater->add_control(
			'classyea_top_position',
			array(
				'label'     => __('Top Position (%)', 'classyea'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'default'   => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%!important;',
				),
			)
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab('tab_tooltip', array('label' => __('Tooltip', 'classyea')));

		$repeater->add_control(
			'classyea_tooltip',
			array(
				'label'        => __('Tooltip', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'classyea_tooltip_style',
			array(
				'label'      => __('Tooltip Style', 'classyea'),
				'type'       => Controls_Manager::SELECT,
				'default'    => '1',
				'options'    => array(
					'1'      => __('Style 1', 'classyea'),
					'2'      => __('Style 2', 'classyea'),
				),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'classyea_tooltip',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'classyea_tooltip_content',
			array(
				'label'      => __('Content', 'classyea'),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => __('Tooltip Content', 'classyea'),
				'conditions' => array(
					'terms' => array(
						array(
							'name'     => 'classyea_tooltip',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'classyea_tooltip_btn_title',
			array(
				'label'      => __('Button Title', 'classyea'),
				'type'       => Controls_Manager::TEXT,
				'description' => __( 'Use for layout four & five', 'classyea' ),
				'default'    => __('Buy Now', 'classyea'),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'classyea_tooltip_style',
							'operator' => '==',
							'value'    => '2',
						),
						array(
							'name'     => 'classyea_tooltip',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'btn_link',
			array(
				'label'       => __('Button Link', 'classyea'),
				'type'        => Controls_Manager::URL,
				'description' => __( 'Use for layout four & five', 'classyea' ),
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => 'https://www.your-link.com',
				'default'     => array(
					'url' => '#',
				),
				'separator'   => 'before',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'classyea_tooltip_style',
							'operator' => '==',
							'value'    => '2',
						),
						array(
							'name'     => 'classyea_tooltip',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
			)
		);
		$repeater->add_control(
			'classyea_tooltip_price',
			array(
				'label'      => __('Price Text', 'classyea'),
				'type'       => Controls_Manager::TEXT,
				'description' => __( 'Use for layout four', 'classyea' ),
				'default'    => __('200$', 'classyea'),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'classyea_tooltip_style',
							'operator' => '==',
							'value'    => '2',
						),
						array(
							'name'     => 'classyea_tooltip',
							'operator' => '==',
							'value'    => 'yes',
						)
					)
				)
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'hotspot_item',
			[
				'label'                 => __('Add Hotspot Item', 'classyea'),
				'type'                  => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'hotspot_item_label' => __('Hotspot #1', 'classyea'),
						'classyea_hotspot_text'        => __('1', 'classyea'),
						'classyea_selected_icon'       => 'fa fa-plus',
						'classyea_left_position'       => 20,
						'classyea_top_position'        => 30,
					),
				),
				'fields'                => $repeater->get_controls(),
				'title_field' => '{{{ hotspot_item_label }}}',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_section_style_settings',
			[
				'label' => esc_html__('Hotspot', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'hotspot_typography',
				'label'     => __('Typography', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-hotSpot-icon,{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-hotSpot-text,{{WRAPPER}} .classyea-hotspot-wrap-1293 .classyea-hotspot-item-1293,{{WRAPPER}} .classyea-hotSpot-icon-1296 span i',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
					),
				)
			)
		);

		$this->add_control(
			'hotspot_color_single',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1293 .classyea-hotspot-item-1293' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1294 .classyea-hotspot-icon-1294' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-icon-1295' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-items-1296 .classyea-hotSpot-icon-1296 span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'hotspot_bg_color_single',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1293 .classyea-hotspot-item-1293' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-icon-1295' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-items-1296 .classyea-hotSpot-icon-1296 span' => 'background-color: {{VALUE}}',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-5',
						),
					),
				)
			)
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'classyea'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
					),
				)
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hotspot_field_border',
                'label' => __('Button Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-icon-1295,{{WRAPPER}} .classyea-hotSpot-items-1296 .classyea-hotSpot-icon-1296 span',
                'separator' => 'before',
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ],
						[
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-6'
                        ],
                    ]
                ]
            ]
        );

        $this->add_control(
            'hotspot_field_radius',
            [
                'label' => __('Button Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-icon-1295' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-hotSpot-items-1296 .classyea-hotSpot-icon-1296 span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ],
						[
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-6'
                        ],
                    ]
                ]
            ]
        );
		$this->add_responsive_control(
			'hotspots_padding',
			array(
				'label'      => __('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'.classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-hotSpot-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-hotSpot-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classyea-hotspot-wrap-1293 .classyea-hotspot-item-1293' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classyea-hotspot-wrap-1295 .classyea-hotspot-icon-1295' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.classyea-hotSpot-items-1296 .classyea-hotSpot-icon-1296 span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
					),
				)
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hotspots_box_shadow',
				'selector' => '.classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-hotSpot-icon,.classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-hotSpot-icon,.classyea-hotspot-wrap-1293 .classyea-hotspot-item-1293,.classyea-hotspot-wrap-1295 .classyea-hotspot-icon-1295,.classyea-hotSpot-items-1296 .classyea-hotSpot-icon-1296 span',
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-1',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-2',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-3',
						),
						array(
							'name'     => 'hotspot_layout',
							'operator' => '==',
							'value'    => 'layout-6',
						),
					),
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_tooltip_style_settings',
			[
				'label' => esc_html__('Tooltip', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'tooltip_typography',
				'label'     => __('Typography', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-tooltip,{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-tooltip,{{WRAPPER}} .classyea-hotspot-item-1293:hover .classyea-hotspot-content-1293,{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 h4,{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 h4,{{WRAPPER}} .classyea-hotSpot-content-1296',
			)
		);
		$this->add_control(
            'classyea_price_typography_heading',
            [
                'label' => __('Price Typography', 'classyea'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                    ]
                ]
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'tooltip_price_typography',
				'label'     => __('Typography', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 h3',
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                    ]
                ]
			)
		);
		$this->add_control(
            'classyea_btn_heading',
            [
                'label' => __('Button Typography', 'classyea'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ]
                    ]
                ]
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'tooltip_button_typography',
				'label'     => __('Typography', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 a,{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 a',
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ]
                    ]
                ]
			)
		);
		$this->add_control(
			'tooltip_color_single',
			array(
				'label'     => __('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-tooltip' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-content-1293' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-tooltip' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 h4' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 h4' => 'color:{{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-content-1296' => 'color:{{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-content-1296:before' => 'color:{{VALUE}}',
				),
			)
		);
		$this->add_control(
			'tooltip_price_color_two',
			array(
				'label'     => __('Price Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 h3' => 'color: {{VALUE}}',
				),
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                    ]
                ]
			)
		);
		$this->add_control(
			'tooltip_buttontss_color',
			array(
				'label'     => __('Button Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 a' => 'color: {{VALUE}}',
				),
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ]
                    ]
                ]
			)
		);
		$this->add_control(
			'tooltip_buttonbg_color',
			array(
				'label'     => __('Button BG Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 a' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 a' => 'background-color: {{VALUE}}',
				),
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ]
                    ]
                ]
			)
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'label' => __('Button Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 a,{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 a',
                'separator' => 'before',
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ]
                    ]
                ]
            ]
        );

        $this->add_control(
            'field_radius',
            [
                'label' => __('Button Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-4'
                        ],
                        [
                            'name' => 'hotspot_layout',
                            'operator' => '==',
                            'value' => 'layout-5'
                        ]
                    ]
                ]
            ]
        );
		
		$this->add_control(
			'tooltip_bg_color',
			array(
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-tooltip' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-content-1293' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-content-1293::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-tooltip' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1294 .classyea-hotspot-content-1294' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-content-1294::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotspot-wrap-1295 .classyea-hotspot-content-1295' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-content-1296' => 'background-color:{{VALUE}}',
					'{{WRAPPER}} .classyea-hotSpot-content-1296:before' => 'background-color:{{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'tooltip_padding',
			array(
				'label'      => __('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'.classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'.classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'.classyea-hotspot-wrap-1293 .classyea-hotspot-content-1293' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'.classyea-hotSpot-content-1296' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltip_box_twoshadow',
				'selector' => '.classyea-hotSpot-wrapper-1291 .classyea-hotSpot .classyea-tooltip,.classyea-hotSpot-wrapper-1292 .classyea-hotSpot .classyea-tooltip,.classyea-hotspot-wrap-1293 .classyea-hotspot-content-1293,.classyea-hotSpot-content-1296',
			)
		);
		$this->end_controls_section();
	}
	protected function classyea_reg_image_controls_style()
	{

		// image style tab
		$this->start_controls_section(
			'section_image_control_style',
			array(
				'label' => __('Image', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_width',
			array(
				'label'      => __('Width', 'classyea'),
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
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1293' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1294' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1295' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hubSpot-1296' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_align',
			array(
				'label'        => __('Alignment', 'classyea'),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => array(
					'left'   => array(
						'title' => __('Left', 'classyea'),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __('Center', 'classyea'),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __('Right', 'classyea'),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors'    => array(
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292' => 'float: {{VALUE}};',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291' => 'float: {{VALUE}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1293' => 'float: {{VALUE}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1294' => 'float: {{VALUE}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1295' => 'float: {{VALUE}};',
					'{{WRAPPER}} .classyea-hubSpot-1296'         => 'float: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'image_border',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-hotSpot-wrapper-1291 img,{{WRAPPER}} .classyea-hotSpot-wrapper-1292 img,{{WRAPPER}} .classyea-hotspot-wrapper-1293 img,{{WRAPPER}} .classyea-hotspot-wrapper-1294 img,{{WRAPPER}} .classyea-hubSpot-1296 img,{{WRAPPER}} .classyea-hotspot-wrapper-1295 img,{{WRAPPER}} .classyea-hotspot-wrapper-1295 img',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1291 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotSpot-wrapper-1292 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1293 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1294 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hubSpot-1296 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-hotspot-wrapper-1295 img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'image_box_shadow',
				'selector'  => '{{WRAPPER}} .classyea-hotSpot-wrapper-1291 img,{{WRAPPER}} .classyea-hotSpot-wrapper-1292 img,{{WRAPPER}} .classyea-hotspot-wrapper-1293 img,{{WRAPPER}} .classyea-hotspot-wrapper-1294 img,{{WRAPPER}} .classyea-hubSpot-1296 img,{{WRAPPER}} .classyea-hotspot-wrapper-1295 img',
				'separator' => 'before',
			)
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings 			=  $this->get_settings_for_display();
		$hotspot_layout 	= $settings['hotspot_layout'];
		$classyea_tooltip_arrow 	= $settings['classyea_tooltip_arrow'];

		if($classyea_tooltip_arrow == 'yes'){
			$arrow_class = '';
		}else{
			$arrow_class = 'arrow_show';
		}


		if ($hotspot_layout == 'layout-1') {
?>
			<div class="classyea-hotSpot-wrapper-1291 <?php echo esc_attr($arrow_class);?>">
				<?php
				$this->classyea_hotspots_image($settings);
				// repeater control
				$this->classyea_hotspots_repeater_control();
				?>
			</div>
		<?php
		} elseif ($hotspot_layout == 'layout-2') { ?>
			<!-- ===== Design Two ===== -->
			<div class="classyea-hotSpot-wrapper-1292 <?php echo esc_attr($arrow_class);?>">
				<?php
				$this->classyea_hotspots_image($settings);
				// repeater control
				$this->classyea_hotspots_repeater_control();
				?>
			</div>
			<!-- end .classyea-hotSpot-wrapper-1292 -->
		<?php
		} elseif ($hotspot_layout == 'layout-3') { ?>
			<!-- ===== Design Three ===== -->
			<div class="classyea-hotspot-bottom-1293">
				<div class="classyea-hotspot-wrapper-1293 <?php echo esc_attr($arrow_class);?>">
					<div class="classyea-hotspot-image-1293">
						<?php
						$this->classyea_hotspots_image($settings);
						?>
						<ul class="classyea-hotspot-wrap-1293">
							<?php
							// repeater control
							$this->classyea_hotspots_repeater_control();
							?>
							<!-- end .classyea-hotspot-item-1293 -->
						</ul>
						<!-- end .classyea-hotspot-wrap-1293 -->
					</div>
					<!-- end .classyea-hotspot-image-1293 -->
				</div>
				<!-- end .classyea-hotspot-box-1293 -->
			</div>
			<!-- end of .classyea-hotspot-bottom-1293 -->
		<?php
		} elseif ($hotspot_layout == 'layout-4') {  ?>
			<!-- end of .classyea-hotspot-top-1294 -->
			<div class="classyea-hotspot-bottom-1294">
				<div class="classyea-hotspot-wrapper-1294 <?php echo esc_attr($arrow_class);?>">
					<div class="classyea-hotspot-image-1294">
						<?php
						$this->classyea_hotspots_image($settings);
						?>
						<ul class="classyea-hotspot-wrap-1294">
							<?php
							// repeater control
							$this->classyea_hotspots_repeater_control();
							?>
						</ul>
						<!-- end .classyea-hotspot-wrap-1294 -->
					</div>
					<!-- end .classyea-hotspot-image-1294 -->
				</div>
				<!-- end .classyea-hotspot-box-1294 -->
			</div>
			<!-- end of .classyea-hotspot-bottom-1294 -->
		<?php } elseif ($hotspot_layout == 'layout-5') {  ?>

			<div class="classyea-hotspot-wrapper-1295 <?php echo esc_attr($arrow_class);?>">
				<div class="classyea-hotspot-image-1295">
					<?php
					$this->classyea_hotspots_image($settings);
					?>
					<ul class="classyea-hotspot-wrap-1295">
						<?php
						// repeater control
						$this->classyea_hotspots_repeater_control();
						?>
						<!-- end .classyea-hotspot-item-1295 -->
					</ul>
					<!-- end .classyea-hotspot-wrap-1295 -->
				</div>
				<!-- end .classyea-hotspot-image-1295 -->
			</div>
			<!-- end .classyea-hotspot-box-1295 -->
		<?php } elseif ($hotspot_layout == 'layout-6') {  ?>
			<!-- ===== Design Six ===== -->
			<div class="classyea-hubSpot-1296">
				<div class="classyea-hotSpot-image-1296 <?php echo esc_attr($arrow_class);?>">
					<?php
					$this->classyea_hotspots_image($settings);
					?>
					<div class="classyea-hotSpot-items-1296">
						<?php
						// repeater control
						$this->classyea_hotspots_repeater_control();
						?>
					</div>
					<!-- end .classyea-hotSpot-1296 -->
				</div>
				<!-- end .classyea-hotSpot-image-1296 -->
			</div>
			<!-- end classyea-hubSpot-1296 -->
		<?php	}
	}

	private function classyea_hotspots_repeater_control()
	{
		$settings 				= $this->get_settings_for_display();
		$hotspot_layout 	    = $settings['hotspot_layout'];
		$border_radius 			= $settings['border_radius'];
		$tooltip_bg_color 		= $settings['tooltip_bg_color'];
		$tooltip_color_single 	= $settings['tooltip_color_single'];
		if ($tooltip_bg_color) {
			$tooltip_bg = $tooltip_bg_color;
		} else {
			$tooltip_bg = '#222222';
		}
		$i = 1;
		foreach ($settings['hotspot_item'] as $index => $item) :
			
			$classyea_tooltip  		  	   = $item['classyea_tooltip'];
			$classyea_hotspot_type         = $item['classyea_hotspot_type'];
			$classyea_tooltip_btn_title    = $item['classyea_tooltip_btn_title'];
			$classyea_tooltip_price        = $item['classyea_tooltip_price'];
			$classyea_tooltip_style        = $item['classyea_tooltip_style'];
			$classyea_selected_icon        = $item['classyea_selected_icon']['value'];
			$changed_atts = array(
				'hotspot_icon' => $classyea_selected_icon,
				'classyea_tooltip' => $classyea_tooltip,
			);
			
			
			$hotspot_design        = $item['hotspot_design'];

			if ($hotspot_design == 'yes') {
				$icon_design_class        		= $item['icon_design_class'];
			} else {
				$icon_design_class = 'vase';
			}
			if ($classyea_hotspot_type == 'text') {
				$classyea_hotspot_text = $item['classyea_hotspot_text'];
			}else{
				$classyea_hotspot_text = "";
			}
			if ($classyea_tooltip == 'yes') {
				$tooltip_content  = $item['classyea_tooltip_content'];
			} else {
				$tooltip_content = "";
			}
			if ($classyea_tooltip_style == '2' || $hotspot_layout == 'layout-5' || $hotspot_layout == 'layout-4') {
				$this->add_render_attribute('btn_link', 'class', 'classyea-btn-link');
				$link_key = 'btn_link' . $i;
				if (!empty($item['btn_link']['url'])) {
					$this->add_link_attributes($link_key, $item['btn_link']);
				}
			}

			if ($hotspot_layout == 'layout-1') {
			?>
				<!-- Hotspot -->
				<div class="classyea-hotSpot elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-tooltipText='<?php echo wp_kses($tooltip_content, 'classyea_kses'); ?>' data-tooltipBg='<?php echo esc_attr($tooltip_bg); ?>' data-toolTipColor="<?php echo esc_attr($tooltip_color_single); ?>"  data-radius="<?php echo esc_attr($border_radius); ?>" data-icon='<?php echo wp_json_encode($changed_atts);?>'></div>
			<?php
			} elseif ($hotspot_layout == 'layout-2') { ?>
				<div id="classyea-hotSpot" class="classyea-hotSpot elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-icontwo='<?php echo wp_json_encode($changed_atts);?>' data-tooltipText='<?php echo wp_kses($tooltip_content, 'classyea_kses'); ?>' data-tooltipBg='<?php echo esc_attr($tooltip_bg); ?>' data-toolTipColor="<?php echo esc_attr($tooltip_color_single); ?>"  data-radius="<?php echo esc_attr($border_radius); ?>" data-hotspot_text="<?php echo wp_kses($classyea_hotspot_text, 'classyea_kses'); ?>"></div>
			<?php } elseif ($hotspot_layout == 'layout-3') { ?>
				<li class="classyea-hotspot-item-1293 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
					<?php Icons_Manager::render_icon($item['classyea_selected_icon'], ['aria-hidden' => 'true']); ?>
					<?php
						if ($classyea_tooltip == 'yes') { ?>
					<div class="classyea-hotspot-content-1293">
						<?php
							echo wp_kses($tooltip_content, 'classyea_kses');?>
					</div>
						<?php }
						?>
					<!-- end .classyea-hotspot-content-1293 -->
				</li>
			<?php } elseif ($hotspot_layout == 'layout-4') { ?>
				<li class="classyea-hotspot-item-1294 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
					<span class="classyea-hotspot-icon-1294">
						<?php Icons_Manager::render_icon($item['classyea_selected_icon'], ['aria-hidden' => 'true']); ?>
					</span>
					<!-- end .classyea-hotspot-icon-1294 -->
					<?php
						if ($classyea_tooltip == 'yes') { ?>
					<div class="classyea-hotspot-content-1294">
						<h3>
							<?php
							if ($classyea_tooltip == 'yes') {
								echo wp_kses($classyea_tooltip_price, 'classyea_kses');
							}
							?>
						</h3>
						<h4>
							<?php
								echo wp_kses($tooltip_content, 'classyea_kses');
							?>
						</h4>
						<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>><?php echo wp_kses($classyea_tooltip_btn_title, 'classyea_kses'); ?></a>
					</div>
					<?php }
						?>
					<!-- end .classyea-hotspot-content-1294 -->
				</li>
				<!-- end .classyea-hotspot-item-1294 -->
			<?php } elseif ($hotspot_layout == 'layout-5') { ?>
				<li class="classyea-hotspot-item-1295 elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
					<span class="classyea-hotspot-icon-1295">
						<?php Icons_Manager::render_icon($item['classyea_selected_icon'], ['aria-hidden' => 'true']); ?>
					</span>
					<!-- end .classyea-hotspot-icon-1295 -->
					<?php
						if ($classyea_tooltip == 'yes') { ?>
					<div class="classyea-hotspot-content-1295">
						<h4>
							<?php
								echo wp_kses($tooltip_content, 'classyea_kses');
							?>
						</h4>
						<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>><?php echo wp_kses($classyea_tooltip_btn_title, 'classyea_kses'); ?></a>
					</div>
					<?php }
						?>
					<!-- end .classyea-hotspot-content-1295 -->
				</li>
			<?php } elseif ($hotspot_layout == 'layout-6') { ?>
				<div class="classyea-hotSpot-icon-1296 <?php echo esc_attr($icon_design_class); ?> elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
				<?php
						if ($classyea_tooltip == 'yes') { ?>
					<div class="classyea-hotSpot-content-1296">
						<?php
						if ($classyea_tooltip == 'yes') {
							echo wp_kses($tooltip_content, 'classyea_kses');
						}
						?>
					</div>
					<?php }
						?>
					<!-- end .classyea-hotSpot-content-1296 -->
					<span><?php Icons_Manager::render_icon($item['classyea_selected_icon'], ['aria-hidden' => 'true']); ?></span>
				</div>
				<!-- end .classyea-hotSpot-icon-1296 -->
		<?php }
			$i++;
		endforeach; ?>
<?php	// endforeach
	}
	/**
	 * Hotspots image function
	 * hotspots image output on html
	 * @param [type] $settings
	 * @access private
	 */
	private function classyea_hotspots_image($settings)
	{
		if ($settings['hotspots_image']['url']) {
			echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'hotspots_image'), 'classyea_img');
		}
	}
}