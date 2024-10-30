<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;

defined('ABSPATH') || exit;

class Classyea_Header_Info extends Widget_Base
{
    /**
     * Retrieve header info widget name.
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'classyea-header-info';
    }

    /**
     * Retrieve Header info widget title.
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Header Info', 'classyea');
    }

    /**
     * Retrieve Header info widget icon.
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-animated-headline classyea';
    }

     /**
     * header style depend
     * @access public
     * @return string Widget icon.
     */

    public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
           'classyea-header-info'
        ];
	}

    /**
	 * Retrieve header info category
	 * @access public
	 * @return string widget category
	 */
	public function get_categories() {
		return [ 'classyea_hfe' ];
	}

    protected function register_controls()
    {

        $this->start_controls_section(
            'classyea_header_info',
            [
                'label' => esc_html__('Header Info', 'classyea'),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'classyea_headerinfo_icons',
            [
                'label'         => esc_html__('Icon', 'classyea'),
                'label_block'   => true,
                'type'          => Controls_Manager::ICONS,
                'default'       => [
                    'value'     => 'fas fa-star',
					'library'   => 'fa-solid',
                ],

            ]
        );

        $repeater->add_control(
            'classyea_headerinfo_text',
            [
                'label' => esc_html__('Text', 'classyea'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '463 7th Ave, NY 10018, USA',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_control(
            'classyea_headerinfo_link',
            [
                'label' => esc_html__('Link', 'classyea'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://link.com', 'classyea'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'classyea_header_items',
            [
                'label' => esc_html__('Header Info', 'classyea'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'classyea_headerinfo_text' => esc_html__('60 Broklyn Street, USA', 'classyea'),
                    ],

                ],
                'title_field' => '{{{ classyea_headerinfo_text }}}',
            ]
        );

        $this->add_responsive_control(
            'info_alignment',
            [
                'label'              => __('Alignment', 'classyea'),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'flex-start'   => [
                        'title' => __('Left', 'classyea'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'classyea'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'  => [
                        'title' => __('Right', 'classyea'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-header-contact-info ul' => 'justify-content: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'contact_info_header_icon_style',
            [
                'label' => esc_html__('Header Info', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contact_info_bg',
            [
                'label'     => esc_html__('Background Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'contact_info_txt_color',
            [
                'label' => esc_html__('Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li .text h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-header-contact-info ul li .text h6 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'contact_info_margin',
            [
                'label' => esc_html__('Margin', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'contact_info_padding',
            [
                'label' => esc_html__('Padding', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'contact_info_typography',
                'label' => esc_html__('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-header-contact-info ul li .text h6 a,{{WRAPPER}} .classyea-header-contact-info ul li .text h6',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'classyea_header_icon',
            [
                'label' => esc_html__('Header Icon', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     => __('Icon', 'classyea'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'header_contact_info_icon_color',
            [
                'label' => esc_html__('Icon Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-header-contact-info ul li .icon svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'header_contact_info_icon_size',
            [
                'label' => esc_html__('Icon Size', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 5,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-header-contact-info ul li .icon svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
                ],
            ]
        );
        $this->add_responsive_control(
            'header_contact_info_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-header-contact-info ul li' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function render()
    {
        ?>
        <div class="classyea-outer-box">
            <div class="classyea-header-style_top-left">
                <div class="classyea-header-contact-info">
                    <?php
                        $this->header_info_item();
                    ?>
                </div>
            </div>
        </div>
    <?php
    }

    protected function header_info_item()
    {
        $settings = $this->get_settings_for_display();
?>

        <ul>
        <?php
            if ( $settings['classyea_header_items'] ) {
                foreach ( $settings['classyea_header_items'] as $key => $value) {
                    if (!empty($value['classyea_headerinfo_link']['url'])) {
                        $this->add_link_attributes('button-' . $key, $value['classyea_headerinfo_link']);
                    }
            ?>
            <li>
                <div class="icon">
                    <?php Icons_Manager::render_icon($value['classyea_headerinfo_icons'], ['aria-hidden' => 'true']); ?>
                </div>
                <div class="text">
                    <h6>
                        <a <?php echo wp_kses_post($this->get_render_attribute_string('button-' . $key ));  ?>>
                        <?php echo esc_html($value['classyea_headerinfo_text']); ?></a></h6>
                </div>
            </li>
            <?php

                }
            }
            ?>
        </ul>
<?php
    }
}
