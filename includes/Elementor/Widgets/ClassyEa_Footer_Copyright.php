<?php

namespace ClassyEa\Helper\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * elementor widget for copyright
 */
class ClassyEa_Footer_Copyright extends Widget_Base
{

    /**
     * Retrieve copyright widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'footer_copyright';
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.2.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Copyright', 'classyea');
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.2.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-slider-push classyea';
    }
    /**
     * Retrieve site logo widget category.
     * @access public
     * @return string widget category
     */
    public function get_categories()
    {
        return ['classyea_hfe'];
    }

    /**
     * Register Copyright controls.
     *
     * @since 1.5.7
     * @access protected
     */
    protected function register_controls()
    {
        $this->register_content_copy_right_controls();
        $this->classyea_reg_footer_copyright_style();
    }
    /**
     * Register Copyright General Controls.
     *
     * @since 1.2.0
     * @access protected
     */
    protected function register_content_copy_right_controls()
    {
        $this->start_controls_section(
            'general_section',
            [
                'label' => __('Copyright', 'classyea'),
            ]
        );

        $this->add_control(
            'shortcode_content',
            [
                'label'   => __('Copyright Text', 'classyea'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Copyright © [footer_current_year] [footer_site_title] All Rights Reserved', 'classyea'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __('Link', 'classyea'),
                'type'        => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'classyea'),
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'              => __('Alignment', 'classyea'),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
                    'left'   => [
                        'title' => __('Left', 'classyea'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'classyea'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'classyea'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-hfe-copyright-wrapper' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function classyea_reg_footer_copyright_style()
    {
        $this->start_controls_section(
            'section_style_site_logo_image',
            [
                'label' => __('Site logo', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-hfe-copyright-wrapper a, {{WRAPPER}} .classyea-hfe-copyright-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'caption_typography',
                'selector' => '{{WRAPPER}} .classyea-hfe-copyright-wrapper, {{WRAPPER}} .classyea-hfe-copyright-wrapper a',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render Copyright output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.2.3
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $link     = isset($settings['link']['url']) ? $settings['link']['url'] : '';

        if (!empty($link)) {
            $this->add_link_attributes('link', $settings['link']);
        }

        add_shortcode('footer_current_year', [$this, 'display_current_year']);
        add_shortcode('footer_site_title', [$this, 'display_site_title']);

        $copyright_shortcode = do_shortcode(shortcode_unautop($settings['shortcode_content'])); ?>
        <div class="classyea-hfe-copyright-wrapper">
            <?php if (!empty($link)) { ?>
                <a <?php echo wp_kses_post($this->get_render_attribute_string('link')); ?>>
                    <span><?php echo wp_kses_post($copyright_shortcode); ?></span>
                </a>
            <?php } else { ?>
                <span><?php echo wp_kses_post($copyright_shortcode); ?></span>
            <?php } ?>
        </div>
<?php
    }

    /**
     * Render shortcode widget as plain content.
     *
     * Override the default behavior by printing the shortcode instead of rendering it.
     *
     * @since 1.2.3
     * @access public
     */
    public function shortcode_plain_content()
    {
        echo esc_attr($this->get_settings('shortcode_content'));
    }


    /**
     * Get the copyright_current_year Details.
     *
     * @return array $coptyright_current_year Get Current Year Details.
     */
    public function display_current_year()
    {

        $copyright_current_year = gmdate('Y');
        $copyright_current_year = do_shortcode(shortcode_unautop($copyright_current_year));
        if (!empty($copyright_current_year)) {
            return $copyright_current_year;
        }
    }

    /**
     * Get site title of Site.
     *
     * @return string.
     */
    public function display_site_title()
    {

        $site_title = get_bloginfo('name');

        if (!empty($site_title)) {
            return $site_title;
        }
    }
}
