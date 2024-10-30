<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

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
     * @since 1.2.4
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
     * @since 1.2.4
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
     * Register  controls.
     *
     * @since 1.2.4
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
     * @since 1.2.4
     * @access protected
     */
    protected function register_content_copy_right_controls()
    {
        $this->start_controls_section(
            'general_setting',
            [
                'label' => __('Copyright', 'classyea'),
            ]
        );

        $this->add_control(
            'footer_copyright_content',
            [
                'label'   => __('Copyright Text', 'classyea'),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Copyright © 2022 site title. All Rights Reserved', 'classyea'),
            ]
        );

        $this->add_control(
            'copyright_link',
            [
                'label'       => __('Link', 'classyea'),
                'type'        => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'classyea'),
            ]
        );

        $this->add_responsive_control(
            'copyright_alignment',
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
                    '{{WRAPPER}} .classyea-copyright-wrapper' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function classyea_reg_footer_copyright_style()
    {
        $this->start_controls_section(
            'section_copyright_style_section',
            [
                'label' => __('Copyright Style', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'copyright_typography',
                'selector' => '{{WRAPPER}} .classyea-copyright-wrapper, {{WRAPPER}} .classyea-copyright-wrapper a',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );
        $this->add_control(
            'copyright_title_color',
            [
                'label'     => __('Text Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-copyright-wrapper a, {{WRAPPER}} .classyea-copyright-wrapper' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

   /**
	 * render function
	 * Render   output on the frontend.
	 * @access protected
	 */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['copyright_link']['url'] ) ) {
			$this->add_link_attributes( 'copyright_link', $settings['copyright_link'] );
		}

        $copyright_content = $settings['footer_copyright_content']; ?>
        <div class="classyea-copyright-wrapper">
            <?php if (!empty($settings['copyright_link']['url'])) { ?>
                <a <?php echo wp_kses_post($this->get_render_attribute_string( 'copyright_link' )); ?>>
                    <span><?php echo wp_kses($copyright_content,'classyea_kses'); ?></span>
                </a>
            <?php } else { ?>
                <span><?php echo wp_kses($copyright_content,'classyea_kses'); ?></span>
            <?php } ?>
        </div>
<?php
    }

}
