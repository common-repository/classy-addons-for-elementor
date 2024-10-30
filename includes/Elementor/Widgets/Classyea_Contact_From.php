<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \ClassyEa\Helper\Elementor\Settings\Header;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * contact from Widget
 */
class Classyea_Contact_From extends Widget_Base
{

	/**
	 * Retrieve contact from widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-contact-from';
	}
	/**
	 * Retrieve contact from widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Contact From 7', 'classyea');
	}
	/**
	 * Retrieve contact from widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-contact-form';
	}
    public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	/**
	 * Retrieve contact from widget category.
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
            'contact',
            'contact from',
            'contact from 7',
            'contact widget',
            'classy contact from 7'
        ];
    }
	/**
	 * Register contact from widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */

	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_contact_from_controls();

	}
	protected function register_content_contact_from_controls()
	{

		/***
		 * Content Tab: contact from
		 ***/
		$this->start_controls_section(
			'section_contact_from',
			[
				'label'                 => __('General', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'contact_from_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before'
			]
		);
        $this->add_control(
			'form_title',
			[
				'label'                 => __( 'Form Title', 'classyea' ),
				'type'                  => Controls_Manager::SWITCHER,
				'label_on'              => __( 'On', 'classyea' ),
				'label_off'             => __( 'Off', 'classyea' ),
				'return_value'          => 'yes',
                'condition'             => [
					'contact_from_layout'    => [
						'layout-3',
						'layout-4',
					]
				]
			]
		);
		$this->add_control(
            'classyea_form_title_content_heading',
            [
                'label' => __( 'Form Title', 'classyea' ),
                'type'  => Controls_Manager::HEADING,
                'condition'             => [
					'contact_from_layout'    => [
						'layout-3',
						'layout-4',
					]
				]
            ]
        );
		$this->add_control(
			'form_title_text',
			[
				'label'                 => esc_html__( 'Title', 'classyea' ),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => '',
				'condition'             => [
					'form_title'   => 'yes',
                    'contact_from_layout'    => [
						'layout-3',
						'layout-4',
					],
				]
			]
		);
        $this->add_control(
			'title_html_tag',
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
                ],
                'condition'             => [
					'contact_from_layout'    => [
						'layout-3',
						'layout-4',
                    ],
                    'form_title' => 'yes'
				]
			]
		);
        $this->add_control(
			'name_email_two_column',
			[
				'label' => __( 'Enable Name Email Inline?', 'classyea' ),
                'description' => __('Use for layout three','classyea'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'classyea' ),
				'label_off' => __( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'condition'             => [
					'contact_from_layout'    => [
						'layout-3',
					]
				]
			]
		);
        $this->add_control(
			'classyea_contact_cf7',
			array(
				'label'   => esc_html__('Select Contact Form', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'options' => Header::Classyea_getContactForm7Posts(),
			)
		);

		$this->end_controls_section();

		/****
		 * Content Tab:
		***/
		$this->start_controls_section(
			'section_errors',
			[
				'label' => __('Message', 'classyea'),
			]
		);

		$this->add_control(
			'error_messages',
			[
				'label' => __('Error Messages', 'classyea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => __('Show', 'classyea'),
					'hide' => __('Hide', 'classyea'),
				],
				'selectors_dictionary' => [
					'show' => 'block',
					'hide' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
					'{{WRAPPER}} .classyea-contactForm-box-501 .wpcf7-form.invalid .wpcf7-response-output' => 'display: {{VALUE}} !important;',
					'{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form.invalid .wpcf7-response-output' => 'display: {{VALUE}} !important;',
				]
			]
		);

		$this->add_control(
			'validation_errors',
			[
				'label' => __('Validation Errors', 'classyea'),
				'type' => Controls_Manager::SELECT,
				'default' => 'show',
				'options' => [
					'show' => __('Show', 'classyea'),
					'hide' => __('Hide', 'classyea'),
				],
				'selectors_dictionary' => [
					'show' => 'block',
					'hide' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}}!important;',
				]
			]
		);

		$this->end_controls_section();
		/**
         * Style Tab: Title & Description
         */
        $this->start_controls_section(
            'classyea_fields_title_description',
            [
                'label' => __('Title', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'             => [
					'contact_from_layout'    => [
						'layout-3',
						'layout-4',
					]
				]
            ]
        );

        $this->add_responsive_control(
            'classyea_heading_alignment',
            [
                'label' => __('Alignment', 'classyea'),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 h1' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-contact-form-7 h2' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-contact-form-7 h3' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-contact-form-7 h4' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-contact-form-7 h5' => 'text-align: {{VALUE}}!important;',
                    '{{WRAPPER}} .classyea-contact-form-7 h6' => 'text-align: {{VALUE}}!important;',
                ]
            ]
        );
        $this->add_control(
            'classyea_title_heading',
            [
                'label' => __('Title', 'classyea'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'classyea_title_text_color',
            [
                'label' => __('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .classyea-contactForm-form-505 .form-title' => 'color: {{VALUE}}!important',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'classyea_title_typography',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .classyea-contactForm-form-505 .form-title!important',
            ]
        );
        $this->add_responsive_control(
			'classyea_quote_icon_margin_bottom',
			[
				'label'      => esc_html__('Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-contact-form-7 .classyea-contactForm-form-505 .form-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
            'section_container_style',
            [
                'label' => __('Form Container Style', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_contact_form_background',
                'label' => __('Background', 'classyea'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .classyea-contactForm-box-501,{{WRAPPER}} .classyea-contactForm-box-502,{{WRAPPER}} .classyea-contactForm-form-504,{{WRAPPER}} .classyea-contactForm-section-506,{{WRAPPER}} .classyea-contactForm-507,{{WRAPPER}} .classyea-contactForm-508,{{WRAPPER}} .classyea-contactForm-507 form,{{WRAPPER}} #classyea-contactForm-box-505,{{WRAPPER}} .classyea-contactForm-507 .wpcf7,{{WRAPPER}} .classyea-contactForm-form-504:before,{{WRAPPER}} .classyea-contactForm-form-504 .circle,{{WRAPPER}} .classyea-contactForm-507 form,{{WRAPPER}} #classyea-contactForm-box-505,{{WRAPPER}} .classyea-contactForm-507 form',
            ]
        );
       
        $this->add_responsive_control(
            'classyea_contact_form_max_width',
            [
                'label' => esc_html__('Form Max Width', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1500,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 80,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form.classyea-contact-form-7' => 'max-width: {{SIZE}}{{UNIT}}!important;',
                    '{{WRAPPER}} .classyea-contact-form.classyea-contact-form-7' => 'width: {{SIZE}}{{UNIT}}!important;',
                ]
            ]
        );

        $this->add_responsive_control(
            'classyea_contact_form_margin',
            [
                'label' => esc_html__('Margin', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'classyea_contact_form_padding',
            [
                'label' => esc_html__('Form Padding', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .classyea-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-contactForm-507' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_contact_form_border',
                'selector' => '{{WRAPPER}} .classyea-contact-form',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_contact_form_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-contact-form,{{WRAPPER}} #classyea-contactForm-box-505',
            ]
        );

        $this->end_controls_section();
        /**
         * Style Tab: Input & Textarea
         */
        $this->start_controls_section(
            'section_fields_style',
            [
                'label' => __('Input & Textarea', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_fields_style');

        $this->start_controls_tab(
            'tab_fields_normal',
            [
                'label' => __('Normal', 'classyea'),
            ]
        );

        $this->add_control(
            'field_bg',
            [
                'label' => __('Background Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label' => __('Padding', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => __('Margin', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'field_textarea_padding',
            [
                'label' => __('Textarea Padding', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
            ]
        );

        $this->add_responsive_control(
            'input_height',
            [
                'label' => __('Input Height', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, 
                    {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, 
                    {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-date, 
                    {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'textarea_height',
            [
                'label' => __('Textarea Height', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-select',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'field_radius',
            [
                'label' => __('Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control.wpcf7-select',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_fields_focus',
            [
                'label' => __('Focus', 'classyea'),
            ]
        );

        $this->add_control(
            'field_bg_focus',
            [
                'label' => __('Background Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form textarea:focus' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'input_border_focus',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form textarea:focus',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'focus_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form textarea:focus',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab: Label Section
         */
        $this->start_controls_section(
            'section_label_style',
            [
                'label' => __('Labels', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color_label',
            [
                'label' => __('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-contact-form-7 label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_spacing',
            [
                'label' => __('Spacing', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form label, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form .wpcf7-quiz-label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_label',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form label, {{WRAPPER}} .classyea-contact-form-7 .wpcf7-form .wpcf7-quiz-label',
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab: Placeholder Section
         */
        $this->start_controls_section(
            'section_placeholder_style',
            [
                'label' => __('Placeholder', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'placeholder_switch',
            [
                'label' => __('Show Placeholder', 'classyea'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __('Yes', 'classyea'),
                'label_off' => __('No', 'classyea'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'text_color_placeholder',
            [
                'label' => __('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}!important',
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control::input-placeholder' => 'color: {{VALUE}}!important',
                ],
                'condition' => [
                    'placeholder_switch' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_placeholder',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder',
                'condition' => [
                    'placeholder_switch' => 'yes',
                ]
            ]
        );
        $this->end_controls_section();

        /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'section_submit_button_style',
            [
                'label' => __('Submit Button', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Alignment', 'classyea'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => __('Left', 'classyea'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'classyea'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'classyea'),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'prefix_class' => 'classyea-contact-form-7-button-align-',
                'condition' => [
                    'button_width_type' => 'custom',
                ]
            ]
        );

        $this->add_control(
            'button_width_type',
            [
                'label' => __('Width', 'classyea'),
                'type' => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'full-width' => __('Full Width', 'classyea'),
                    'custom' => __('Custom', 'classyea'),
                ],
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label' => __('Width', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}!important',
                ],
                'condition' => [
                    'button_width_type' => 'custom',
                ]
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'classyea'),
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label' => __('Background Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}!important',
                ]
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label' => __('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_normal',
                'label' => __('Border', 'classyea'),
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ]
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => __('Margin Top', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}!important',
                    '{{WRAPPER}} #classyea-contactForm-box-505 input.wpcf7-form-control.wpcf7-submit' => 'margin-top: {{SIZE}}{{UNIT}}!important',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"],{{WRAPPER}} #classyea-contactForm-box-505 input.wpcf7-form-control.wpcf7-submit',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'classyea'),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => __('Background Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}!important',
                ]
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => __('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}!important',
                ]
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label' => __('Border Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}!important',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_container_style',
            [
                'label' => __('Icon Style', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'             => [
					'contact_from_layout'    => [
						'layout-5'
					]
				]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'classyea_icon_backgroundfff',
                'label' => __('Background', 'classyea'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-name::after,{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-email::after,{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-subject::after,{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-message::after',
                'condition'             => [
					'contact_from_layout'    => [
						'layout-5'
					]
				]
            ]
        );
        $this->add_control(
            'classyea_icon_fdfdtext_color',
            [
                'label' => __('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-name::after' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-email::after' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-subject::after' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .classyea-contactForm-section-506 .wpcf7-form-control-wrap.your-message::after' => 'color: {{VALUE}}',
                    
                ],
                'condition'             => [
					'contact_from_layout'    => [
						'layout-5'
					]
				]
            ]
        );
        $this->end_controls_section();
	}
	protected function render()
	{
		$settings            =  $this->get_settings_for_display();
		$contact_from_layout = $settings['contact_from_layout'];
		$button_width_type   = $settings['button_width_type'];
		$section_class       = 'classyea-contactForm-box-501';
		$section_id          = 'default';
        $inline_field_enable = '';
        if($contact_from_layout == 'layout-3') {
            $name_email_two_column    = $settings['name_email_two_column'];
            if($name_email_two_column == 'yes'){
                $inline_field_enable  = 'inline-field';
            }
        }

        if($contact_from_layout == 'layout-3' || $contact_from_layout == 'layout-4') {
            $form_title = $settings['form_title'];
        }

        $full_width = '';
        if($button_width_type == 'full-width') {
            $full_width = 'full-width';
        }
        
		switch ($contact_from_layout) {
			case 'layout-1':
				$section_class = 'classyea-contactForm-box-501';
				break;
			case 'layout-2':
				$section_class = 'classyea-contactForm-box-502';
				break;
			case 'layout-3':
				$section_class = 'classyea-contactForm-section-505';
                $section_id = 'classyea-contactForm-box-505';
                
				break;
			case 'layout-4':
				$section_class = 'classyea-contactForm-form-504';
				break;
			case 'layout-5':
				$section_class = 'classyea-contactForm-section-506';
				break;
			case 'layout-6':
				$section_class = 'classyea-contactForm-507';
				break;
			case 'layout-7':
				$section_class = 'classyea-contactForm-508';
				break;
			default:
				$section_class = 'classyea-contactForm-box-501';
		}

		$this->add_render_attribute('contact-form', 'class', [
            'classyea-contact-form',
            'classyea-contact-form-7',
            'classyea-contact-form-' . esc_attr($this->get_id()),
			$section_class,
            $inline_field_enable,
            $full_width,
        ]);


        if ($settings['placeholder_switch'] == 'yes') {
            $this->add_render_attribute('contact-form', 'class', 'placeholder-show');
        }
        if ( function_exists( 'wpcf7' ) ) {
			if ( ! empty( $settings['classyea_contact_cf7'] ) ) { ?>
                    <div  <?php echo wp_kses_post($this->get_render_attribute_string('contact-form')); ?> id="<?php echo esc_attr($section_id);?>">
                        <?php if($contact_from_layout == 'layout-3' && $form_title == 'yes') : ?>
                            <div class="classyea-contactForm-form-505">
                           <?php $this->classyea_render_heading();
                        endif;
						if($contact_from_layout == 'layout-4' && $form_title == 'yes') : ?>
							<span class="circle one"></span>
                			<span class="circle two"></span>
							<?php $this->classyea_render_heading();
                        endif;
                        $contact_id = '[contact-form-7 id="' . $settings['classyea_contact_cf7'] . '" ]';
                           echo do_shortcode( wp_kses($contact_id,'classyea_kses') ); ?>
                        <?php if($contact_from_layout == 'layout-3' && $form_title == 'yes') : ?>
                            </div>
                            <?php endif;?>
                    </div>
				<?php
			} else {
				echo esc_html__("No contact from Selected","classyea");
			}
		} else{
            echo esc_html__("No contact from 7 Activated","classyea");
        } 
	}
    /**
     * Contact from heading function
     * Render image accordion heading output on the frontend.
     * @access protected
     */
	protected function classyea_render_heading()
	{
		$settings  = $this->get_settings_for_display();
        $layout    = $settings['contact_from_layout'];
        if($layout == 'layout-3' || $layout == 'layout-4') {
            if ($settings['form_title_text'] || $settings['form_title_text']) {
                $this->add_inline_editing_attributes('form_title_text', 'none');
                $this->add_render_attribute('form_title_text', 'class', "form-title");
                if ($settings['form_title_text']) {
                    $title_tag = Header::classyea_validate_html_tag($settings['title_html_tag']);
            ?>
                    <<?php echo esc_html($title_tag); ?> <?php echo esc_attr($this->get_render_attribute_string('form_title_text')); ?>>
                        <?php echo wp_kses($settings['form_title_text'],'classyea_kses'); ?>
                    </<?php echo esc_html($title_tag); ?>>
                <?php
                }
            }
        }
	}
}