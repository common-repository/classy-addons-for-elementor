<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Plugin;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
require 'Classyea_Layout_Two_Acc.php';
require 'Classyea_Layout_Three_Acc.php';
require 'Classyea_Layout_Four_Acc.php';

class Classyea_Widget_Accordion extends Widget_Base
{
    /**
	 * Retrieve accordion widget name.
	 * @access public
	 * @return string Widget name.
	 */
    public function get_name()
    {
        return 'classyea_widget_accordion';
    }
    /**
	 * Retrieve accordion widget title.
	 * @access public
	 * @return string Widget title.
	 */
    public function get_title()
    {
        return esc_html__('Advanced Accordion', 'classyea');
    }
    /**
	 * Retrieve accordion widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
    public function get_icon()
    {
        return 'classyicon classyea-accordion';
    }

    public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}

    public function get_categories()
    {
        return ['classyea'];
    }
    protected function register_skins() {
		$this->add_skin( new Skin_Image_Accordion( $this ) );
		$this->add_skin( new Skin_Layout_Three_Accordion( $this ) );
		$this->add_skin( new Skin_Layout_Four_Accordion( $this ) );
	}
    /**
	 * Get widget keywords.
	 * Keyword list of the widget belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
    public function get_keywords()
    {
        return [
            'accordion',
            'classy accordion',
            'classy advanced accordion',
            'toggle',
            'collapsible',
            'classy faq',
            'group',
            'expand',
            'collapse',
            'classy',
            'classy addons'
        ];
    }
    
    public function get_script_depends()
	{
		return array('classyea-accordion-script');
	}
    protected function register_controls()
    {

       
        $this->start_controls_section(
            'classyea_acc_advanced_settings',
            [
                'label' => esc_html__('General', 'classyea'),
            ]
        );
        $this->add_control(
            'adv_acc_title_tag',
            [
                'label'   => __('Heading Tag', 'classyea'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'div',
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
			'arrow_up',
			[
				'label' => esc_html__('Arrow Up', 'classyea'),
				'type' => Controls_Manager::ICONS,
				'default'          => [
					'value'   => 'fa fa-chevron-up',
					'library' => 'fa-brands',
				],
			]
		);
        $this->add_control(
			'arrow_down',
			[
				'label' => esc_html__('Arrow Down', 'classyea'),
				'type' => Controls_Manager::ICONS,
				'default'          => [
					'value'   => 'fa fa-chevron-down',
					'library' => 'fa-brands',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'adv_faq_tab', [
                'label' =>esc_html__( 'Accordion', 'classyea' ),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'adv_acc_content_type',
            [
                'label' => __('Content Type', 'classyea'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => __('Content', 'classyea'),
                    'image_content' => __('Content & Image', 'classyea'),
                    'image_heading_content' => __('Content & Image & Heading', 'classyea'),
                    'template' => __('Saved Templates', 'classyea'),   
                ],
                'default' => 'content',
            ]
        );

        $repeater->add_control(
            'adv_acc_title', [
                'label'         => esc_html__('Title', 'classyea'),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'Does Classy Addons work with WordPress  multisite?',
            ]
        );
        $repeater->add_control(
            'adv_acc_heading', [
                'label'         => esc_html__('Accordion Heading ', 'classyea'),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'Accordion Item',
                'condition' => ['adv_acc_content_type' => 'image_heading_content'],
            ]
        );

        $repeater->add_control(
            'adv_acc_is_active',
            [
                'label' => esc_html__('Keep this slide open? ', 'classyea'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' =>esc_html__( 'Yes', 'classyea' ),
                'label_off' =>esc_html__( 'No', 'classyea' ),
            ]
        );
        $repeater->add_control(
			'item_image',
			array(
				'label'   => esc_html__('Item Image', 'resox'),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'adv_acc_content_type',
                            'operator' => '==',
                            'value' => 'image_content'
                        ],
                        [
                            'name' => 'adv_acc_content_type',
                            'operator' => '==',
                            'value' => 'image_heading_content'
                        ]
                    ]
                ]

			)
		);
        $repeater->add_control(
            'adv_accordion_tab_content',
            [
                'name' => 'adv_accordion_tab_content',
                'label' => esc_html__('Tab Content', 'classyea'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi.', 'classyea'),
                'dynamic' => ['active' => true],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'adv_acc_content_type',
                            'operator' => '==',
                            'value' => 'image_content'
                        ],
                        [
                            'name' => 'adv_acc_content_type',
                            'operator' => '==',
                            'value' => 'content'
                        ],
                        [
                            'name' => 'adv_acc_content_type',
                            'operator' => '==',
                            'value' => 'image_heading_content'
                        ]
                    ]
                ]
            ]
        );

        $repeater->add_control(
            'adv_acc_primary_templates',
            [
                'name' => 'classyea_primary_templates',
                'label' => __('Choose Template', 'classyea'),
                'type' => Controls_Manager::SELECT,
                'options' => classyea_get_elementor_library(),
                'condition' => [
                    'adv_acc_content_type' => 'template',
                ]
            ]
        );

        $this->add_control(
            'add_acc_items',
            [
                'label' => esc_html__('Content', 'classyea'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'title_field' => '{{ adv_acc_title }}',
                'default' => [
                    [
                        'adv_acc_title' => esc_html__('Why do we use it?','classyea'),
                        'acc_content' => esc_html__('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout','classyea'),
                        'adv_acc_is_active'    => 'yes'
                    ],
                    [
                        'adv_acc_title' => esc_html__('Where does it come from?','classyea'),
                        'acc_content' => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text','classyea'),
                    ],
                    [
                        'adv_acc_title' => esc_html__('Where can I get some?','classyea'),
                        'acc_content' => esc_html__('There are many variations of passages of Lorem Ipsum available','classyea'),
                    ]
                ],
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->add_control(
            'adv_acc_open_first_slide',
            [
                'label' => esc_html__( 'Keep first slide auto open?', 'classyea' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'classyea' ),
                'label_off' => esc_html__( 'No', 'classyea' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'classyea_section_adv_accordions_tab_style_settings',
            [
                'label' => esc_html__('Title', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'classyea_adv_accordion_tab_distance',
            [
                'label'      => esc_html__('Items Gaps', 'classyea'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1000' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__item-1001--active' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__1004 .classyea_accordion' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__1004 .classyea_accordion' => 'margin-top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_adv_acc_tab_title_typography',
                'selector' => '{{WRAPPER}} .classyea-acc-tab-title.classyea-accordion-title',
            ]
        );

        $this->add_responsive_control(
            'classyea_adv_accordion_tab_padding',
            [
                'label'      => esc_html__('Padding', 'classyea'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1000 .classyea-accordion__head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1000' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__content-item-1000' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'        => 'classyea_acc_items_box_shadow',
				'selector'    => '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title,{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title,{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__head,{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__content,{{WRAPPER}} #classyea-accordion__1004 .classyea_accordion,{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000,{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001,{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item.active .classyea-accordion-title',
			]
		);
        
        $this->start_controls_tabs('classyea_adv_accordion_header_tabs');
        # Normal State Tab
        $this->start_controls_tab('classyea_adv_accordion_header_normal', ['label' => esc_html__('Normal', 'classyea')]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'classyea_adv_acc_tab_bgtype',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title,{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title,{{WRAPPER}} .classyea-accordion__box-item-1000,{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001',
            ]
        );
        $this->add_control(
            'classyea_adv_accordion_tab_icon_text_color',
            [
                'label'     => esc_html__('Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000 .classyea-accordion__head-item-1000 .classyea-accordion__head-inner .classyea-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__head' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__item-icon::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-accordion__content-left h3' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-acc-tab-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001 .classyea-accordion__head-inner .classyea-accordion-title' => 'color: {{VALUE}};',
                ]
            ]
        );
       
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'classyea_adv_accordion_tab_border',
                'label'    => esc_html__('Border', 'classyea'),
                'selector' => '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title,{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title,{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__head,{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__content,{{WRAPPER}} #classyea-accordion__1004 .classyea_accordion,{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000,{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001',
            ]
            
        );
        $this->add_responsive_control(
            'classyea_adv_accordion_tab_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'classyea'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__head' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__1004 .classyea_accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
       
        $this->end_controls_tab();
        /**
         * Active State Tab
         */
        $this->start_controls_tab(
            'classyea_adv_accordion_header_active',
            [
                'label' => esc_html__('Active', 'classyea'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'classyea_adv_accordion_tab_bgtype_active',
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} #classyea-accordion-box-1002 .active .classyea-accordion-title,{{WRAPPER}} #classyea-accordion-box-1002 .active .classyea-accordion-title::after,{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title,{{WRAPPER}} .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head,
                {{WRAPPER}} .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__content,
                {{WRAPPER}} .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active,{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head-item-1001',
            ]
        );
        $this->add_control(
            'classyea_adv_acc_tab_icon_color_active',
            [
                'label'     => esc_html__('Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#20b2aa',
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .active .classyea-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active .classyea-accordion__head-item-1000 .classyea-accordion__head-inner .classyea-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head-item-1001 .classyea-accordion__head-inner .classyea-accordion-title' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'classyea_adv_accordion_tab_border_active',
                'label'    => esc_html__('Border', 'classyea'),
                'selector' => '{{WRAPPER}} #classyea-accordion-box-1002 .active .classyea-accordion-title,{{WRAPPER}} .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head,{{WRAPPER}} .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__content,
                {{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title,{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active,{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head-item-1001',
                
            ]
        );
        $this->add_responsive_control(
            'classyea_adv_accordion_tab_border_radius_active',
            [
                'label'      => esc_html__('Border Radius', 'classyea'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .active .classyea-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}  #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head-item-1001' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'classyea_section_adv_accordions_tab_desc_settings',
            [
                'label' => esc_html__('Description', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'content_background_color',
            [
                'label'     => esc_html__( 'Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .active .classyea-accordion-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__content-item-1001' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__content-item-1001::before' => 'background-color: {{VALUE}};',
                ]
            ]
        );
       
        $this->add_control(
            'classyea_adv_accordion_tab_icon_content_color',
            [
                'label'     => esc_html__('Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea_accordion__pannel' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea_accordion__text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea_accordion__item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-content-text p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-accordion__content-inner' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__content .classyea-accordion__content-left' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'classyea_adv_description_padding',
            [
                'label'      => esc_html__('Padding', 'classyea'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active .classyea-accordion__content-item-1000' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__content-item-1001' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ]
            ]
        );

        $this->add_control(
			'show_left_border',
			[
				'label' => esc_html__( 'Left Border Color?', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'description'	 => esc_html__( 'Only Style One', 'classyea' ),
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => ''
                        ]
                    ]
                ]
			]
		);
        $this->add_control(
            'classyea_adv_accordion_content_border_left_color',
            [
                'label'     => esc_html__('Left Border Color', 'classyea'),
                'description'	 => esc_html__( 'Only Style One', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content::before' => 'border-left:3px solid {{VALUE}};',
                    
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => ''
                        ],
                        [
                            'name' => 'show_left_border',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        
                    ]
                ]
            ]
        );
        $this->add_control(
			'content_subHeading',
			[
				'label' => esc_html__( 'Heading Color Typography?', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
                'description'	 => esc_html__( 'Only use for style four', 'classyea' ),
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-layout-four-accordion'
                        ],
                        
                    ]
                ]
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_adv_acc_sub_heading_tab_content_typography',
                'selector' => '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__content .classyea-accordion__content-left h3',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-layout-four-accordion'
                        ],
                        [
                            'name' => 'content_subHeading',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        
                    ]
                ]
             ]
        );
       
        $this->add_control(
            'classyea_adv_accordion_sub_heading_tab_icon_content_color',
            [
                'label'     => esc_html__('Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'description'	 => esc_html__( 'Only use for style four', 'classyea' ),
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__content .classyea-accordion__content-left h3' => 'color: {{VALUE}};',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-layout-four-accordion'
                        ],
                        [
                            'name' => 'content_subHeading',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        
                    ]
                ]
            ]
        );
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'        => 'classyea_acc_description_box_shadow',
				'selector'    => '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content',
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'classyea_adv_acc_contetn_typography',
                'selector' => '{{WRAPPER}} .classyea-accordion-content,{{WRAPPER}} .classyea-accordion-content,{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content,{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-content P',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'classyea_section_adv_accordions_tab_icon_settings',
            [
                'label' => esc_html__('Icon', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'arrow_position_toggle',
			[
				'label' => __( 'Icon Position', 'classyea' ),
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
					'{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-title .classyea-accordion__item-icon' => 'top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-title .classyea-accordion__item-icon' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_popover();

      
        $this->add_responsive_control(
            'classyea_adv_acc_tab_icon_size',
            [
                'label'      => __('Icon Size', 'classyea'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title .classyea-accordion__item-icon'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1000 .classyea-accordion__item-icon::after'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title::before'=> 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title::after'=> 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-accordion__box-item-1001 .classyea-accordion__item-icon::after'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title:before'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000.classyea-layout-three span.question-icon'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active .classyea-accordion__item-icon.active'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000 .classyea-accordion__head-item-1000 .classyea-accordion__item-icon'=> 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001 .classyea-accordion__item-icon::after'=> 'font-size: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->start_controls_tabs('classyea_adv_accordion_icon_tabs');
        # Normal State Tab
        $this->start_controls_tab('classyea_adv_accordion_headericon_normal', ['label' => esc_html__('Normal', 'classyea')]);

        $this->add_control(
            'classyea_adv_accordion_tab_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000.classyea-layout-three span.question-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001 .classyea-accordion__item-icon::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title::before, 
                    {{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item .classyea-accordion-title:after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item .classyea-accordion-title .classyea-accordion__item-icon' => 'color: {{VALUE}};',
                    
                ]
            ]
        );
        
        $this->add_control(
            'content_icon_color',
            [
                'label'     => esc_html__( 'Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'description'	 => esc_html__( 'Use for style three & four', 'classyea' ),
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000 span.question-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head-item-1001 .classyea-accordion__item-icon:after' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control(
			'show_right_arrow_color',
			[
				'label' => esc_html__( 'Right Arrow Color?', 'classyea' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
                'description'	 => esc_html__( 'Use for Style Three', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-accordion-layout-three'
                        ]
                    ]
                ]
			]
		);
        $this->add_control(
            'classyea_tab_right_arrow_color',
            [
                'label'     => esc_html__('Right Arrow', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'description'	 => esc_html__( 'Use for Style Three', 'classyea' ),
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion__container-item-1000.classyea-layout-three .classyea-accordion__box-item-1000 .classyea-accordion__head-item-1000 .classyea-accordion__item-icon' => 'color:{{VALUE}};',
                    
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'show_right_arrow_color',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-accordion-layout-three'
                        ]
                    ]
                ]
            ]
        );
        $this->end_controls_tab();
        /**
         * Active State Tab
         */
        $this->start_controls_tab(
            'classyea_adv_accordion_headeractive_active',
            [
                'label' => esc_html__('Active', 'classyea'),
            ]
        );
        $this->add_control(
            'classyea_tab_active_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item.active .classyea-accordion-title:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item.active .classyea-accordion-title:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001.classyea-accordion__item-1001--active .classyea-accordion__head-item-1001 .classyea-accordion__item-icon::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active span.question-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title::before, 
                    {{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title:after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion-box-1003 .classyea-accordion-item.active .classyea-accordion-title::before, 
                    {{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item.active .classyea-accordion-title .classyea-accordion__item-icon' => 'color: {{VALUE}};',
                    
                    
                ]
            ]
        );
        
        $this->add_control(
            'classyea_tab_active_icon_rightactive_color',
            [
                'label'     => esc_html__('Border Right Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'description'	 => esc_html__( 'Only Style One', 'classyea' ),
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion-box-1002 .classyea-accordion-item.active .classyea-accordion-title:before' => 'border-right:1px solid {{VALUE}};',
                    
                ],
                'condition' => ['show_right_border' => 'yes'],
            ]
        );
        $this->add_control(
            'content_icon_active_color',
            [
                'label'     => esc_html__( 'Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'description'	 => esc_html__( 'Use for style three & four', 'classyea' ),
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active span.question-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} #classyea-accordion__container-item-1001 .classyea-accordion__box-item-1001 .classyea-accordion__head-item-1001 .classyea-accordion__item-icon:after' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'classyea_tab_active_right_arrow_color',
            [
                'label'     => esc_html__('Right Arrow', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'description'	 => esc_html__( 'Use for Style Three', 'classyea' ),
                'selectors' => [
                    '{{WRAPPER}} #classyea-accordion__container-item-1000 .classyea-accordion__box-item-1000.classyea-accordion__item-1000--active .classyea-accordion__item-icon.active' => 'color:{{VALUE}};',
                    
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'show_right_arrow_color',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-accordion-layout-three'
                        ]
                    ]
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'classyea_section_adv_accordions_image',
            [
                'label' => esc_html__('Image', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '==',
                            'value' => 'classyea-layout-four-accordion'
                        ]
                    ]
                ]
            ]
        );
        $this->add_responsive_control(
            'classyea_adv_image_padding_adv_acc',
            [
                'label'      => esc_html__('Padding', 'classyea'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-accordion__item-1001--active .classyea-accordion__content .classyea-accordion__content-right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings                  =  $this->get_settings_for_display();
        $add_acc_items             = $settings['add_acc_items'];
        $adv_acc_open_first_slide  = $settings['adv_acc_open_first_slide'];
        $adv_acc_title_tag         = $settings['adv_acc_title_tag'];  
        $arrow_up                  = $settings['arrow_up'];
        $arrow_down                = $settings['arrow_down'];

        
?> 
    <!-- ===== Design One ===== -->          
    <div id="classyea-accordion-box-1002">
        <?php
        foreach ($add_acc_items as $i => $accorion_content) :
            $adv_acc_title = $accorion_content['adv_acc_title'];
            if($accorion_content['adv_acc_is_active'] == 'yes'){
                $is_active = 'active';
            }elseif($adv_acc_open_first_slide == 'yes' && $i == '0'){
                $is_active = 'active';
            }else{
                $is_active = '';
            }
            $acc_content  = $accorion_content['adv_accordion_tab_content'];
            $acc_template = $accorion_content['adv_acc_primary_templates'];
            ?>
        <div class="classyea-accordion-item  <?php echo esc_attr($is_active);?>">
        <<?php echo esc_html($adv_acc_title_tag); ?> class="classyea-accordion-title classyea-acc-tab-title"><?php echo esc_html($adv_acc_title); ?><span class="classyea-accordion__item-icon normal"><i class="<?php echo esc_attr($arrow_down['value']);?>"></i></span>
				<span class="classyea-accordion__item-icon active"><i class="<?php echo esc_attr($arrow_up['value']);?>"></i></span></<?php echo esc_html($adv_acc_title_tag); ?>>
            <div class="classyea-accordion-content">
            <?php
                if ('content' == $accorion_content['adv_acc_content_type']) {
                    echo  do_shortcode(sprintf("%s",wp_kses($acc_content,'classyea_kses')));
                } elseif ('template' == $accorion_content['adv_acc_content_type']) {
                    if (!empty($accorion_content['adv_acc_primary_templates'])) {
                        echo Plugin::$instance->frontend->get_builder_content($acc_template, true);
                    }
                } ?>
            </div>

        </div>
        <?php endforeach; ?>
    </div> 
<?php
    }
}