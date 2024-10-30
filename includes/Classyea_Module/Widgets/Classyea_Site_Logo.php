<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Site Logo Widget
 */
class Classyea_Site_Logo extends Widget_Base {

    /**
     * Retrieve site logo widget name.
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'classyea-site-logo';
    }

    /**
     * Retrieve site logo widget name.
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Site Logo', 'classyea' );
    }

    /**
     * Retrieve site logo widget icon
     * @access public
     * @return string get icon
     */
    public function get_icon() {
        return 'eicon-site-logo classyea';
    }

    /**
     * Retrieve site logo categories
     * @access public
     * @return string Widget name.
     */
    public function get_categories() {
        return [ 'classyea_hfe' ];
    }

    /**
     * register control
     * @access protected
     * @return string register_controls
     */
    protected function register_controls() {
        $this->classyea_reg_content_site_logo_controls();
        $this->classyea_reg_site_logo_styling_controls();
        $this->classyea_logo_caption_styling_controls();
    }

    /**
     * register control function
     * @access protected
     * @return string classyea_reg_content_site_logo_controls
     */
    protected function classyea_reg_content_site_logo_controls() {
        $this->start_controls_section(
            'section_site_image',
            [
                'label' => __( 'Logo Settings', 'classyea' ),
            ]
        );

        $this->add_control(
            'custom_logo_enable_disable',
            [
                'label'       => __( 'Custom Logo Enable?', 'classyea' ),
                'type'        => Controls_Manager::SWITCHER,
                'yes'         => __( 'Yes', 'classyea' ),
                'no'          => __( 'No', 'classyea' ),
                'default'     => 'no',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'logo_custom_image',
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
                    'custom_logo_enable_disable' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail_logo_size',
                'default'   => 'full',
            ]
        );
        $this->add_responsive_control(
            'logo_alignment',
            [
                'label'              => __( 'Alignment', 'classyea' ),
                'type'               => Controls_Manager::CHOOSE,
                'options'            => [
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
                    ],
                ],
                'default'            => 'center',
                'selectors'          => [
                    '{{WRAPPER}} .classyea-logo-container, {{WRAPPER}} .classyea-caption-title figcaption' => 'text-align: {{VALUE}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'caption_enable_disable',
            [
                'label' => esc_html__( 'Caption Enable?', 'classyea' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'classyea' ),
                'label_off' => esc_html__( 'Hide', 'classyea' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'caption_title',
            [
                'label'       => __( 'Caption Title', 'classyea' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => __( 'Caption Text Here', 'classyea' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label'   => __( 'Select Link Type', 'classyea' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __( 'Default', 'classyea' ),
                    'none'    => __( 'None', 'classyea' ),
                    'file'    => __( 'Image File', 'classyea' ),
                    'custom'  => __( 'Custom URL', 'classyea' ),
                ],
            ]
        );

        $this->add_control(
            'imglink',
            [
                'label'       => __( 'Link', 'classyea' ),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'classyea' ),
                'condition'   => [
                    'link_type' => 'custom',
                ],
                'show_label'  => false,
            ]
        );

        $this->add_control(
            'logo_lightbox',
            [
                'label'     => __( 'Lightbox', 'classyea' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default' => __( 'Default', 'classyea' ),
                    'yes'     => __( 'Yes', 'classyea' ),
                    'no'      => __( 'No', 'classyea' ),
                ],
                'condition' => [
                    'link_type' => 'file',
                ],
            ]
        );

        $this->end_controls_section();
    }
    /**
     * Register Site Logo style Controls.
     */
    protected function classyea_reg_site_logo_styling_controls() {
        $this->start_controls_section(
            'section_style_site_logo_image',
            [
                'label' => __( 'Logo Style', 'classyea' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'site_logo_background_color',
            [
                'label'     => __( 'Background Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-logo-row .classyea-logo-container' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_contact_form_border',
                'selector' => '{{WRAPPER}} .classyea-service-box-203,{{WRAPPER}} .classyea-service-box-204,{{WRAPPER}} .classyea-service-item-201,{{WRAPPER}} .classyea-service-item-202,{{WRAPPER}} .classyea-service-205 .classyea-service,{{WRAPPER}} .classyea-service-206 .classyea-service',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'site_logo_image_border',
            [
                'label'       => __( 'Border Style', 'classyea' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', 'classyea' ),
                    'solid'  => __( 'Solid', 'classyea' ),
                    'double' => __( 'Double', 'classyea' ),
                    'dotted' => __( 'Dotted', 'classyea' ),
                    'dashed' => __( 'Dashed', 'classyea' ),
                ],
                'selectors'   => [
                    '{{WRAPPER}} .classyea-logo-container .classyea-site-logo-img' => 'border-style: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'site_logo_image_border_size',
            [
                'label'      => __( 'Border Width', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'site_logo_image_border!' => 'none',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-logo-container .classyea-site-logo-img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'site_logo_image_border_color',
            [
                'label'     => __( 'Border Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'condition' => [
                    'site_logo_image_border!' => 'none',
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-logo-container .classyea-site-logo-img' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'              => __( 'Border Radius', 'classyea' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', '%' ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'separator_panel_style',
            [
                'type'  => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_responsive_control(
            'logo_width',
            [
                'label'              => __( 'Width', 'classyea' ),
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'unit' => '%',
                ],
                'tablet_default'     => [
                    'unit' => '%',
                ],
                'mobile_default'     => [
                    'unit' => '%',
                ],
                'size_units'         => [ '%', 'px', 'vw' ],
                'range'              => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-site-logo .classyea-logo-container img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'max_space',
            [
                'label'              => __( 'Max Width', 'classyea' ) . ' (%)',
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'unit' => '%',
                ],
                'tablet_default'     => [
                    'unit' => '%',
                ],
                'mobile_default'     => [
                    'unit' => '%',
                ],
                'size_units'         => [ '%' ],
                'range'              => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'frontend_available' => true,
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .classyea-site-logo img',
            ]
        );

        $this->start_controls_tabs( 'image_effects' );

        $this->start_controls_tab(
            'normal',
            [
                'label' => __( 'Normal', 'classyea' ),
            ]
        );

        $this->add_control(
            'opacity',
            [
                'label'     => __( 'Opacity', 'classyea' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-site-logo img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters',
                'selector' => '{{WRAPPER}} .classyea-site-logo img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover',
            [
                'label' => __( 'Hover', 'classyea' ),
            ]
        );
        $this->add_control(
            'opacity_hover',
            [
                'label'     => __( 'Opacity', 'classyea' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-site-logo:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->add_control(
            'background_hover_transition',
            [
                'label'     => __( 'Transition Duration', 'classyea' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .classyea-site-logo img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters_hover',
                'selector' => '{{WRAPPER}} .classyea-site-logo:hover img',
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'classyea' ),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    /**
     * Register Site Logo style Controls.
     */
    protected function classyea_logo_caption_styling_controls() {
        $this->start_controls_section(
            'image_caption_style_caption',
            [
                'label'     => __( 'Caption Text', 'classyea' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'caption_enable_disable!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'image_caption__background_color',
            [
                'label'     => __( 'Background Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-caption-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'image_caption_text_color',
            [
                'label'     => __( 'Text Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-caption-content' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_responsive_control(
            'image_caption__padding',
            [
                'label'              => __( 'Padding', 'classyea' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', 'em', '%' ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-caption-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_responsive_control(
            'image_caption__space',
            [
                'label'              => __( 'Margin Top', 'classyea' ),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'            => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .classyea-caption-content' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: 0px;',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'image_caption_typography',
                'selector' => '{{WRAPPER}} .classyea-caption-content',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'image_caption_text_shadow',
                'selector' => '{{WRAPPER}} .classyea-caption-content',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Site Image output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     * 
     */
    protected function render() {

        $settings       = $this->get_settings_for_display();

        $check_clickable = (Plugin::$instance->editor->is_edit_mode()) ? 'elementor-non-clickable' : 'elementor-clickable';

        $link_type               = $settings['link_type'];
        $logo_lightbox           = $settings['logo_lightbox'];
        $caption_title           = $settings['caption_title'];
        $caption_enable_disable  = $settings['caption_enable_disable'];
        $imglink                 = $settings['imglink'];
		$site_link               = site_url();

		$default_imgurl = $site_link . '/wp-includes/images/media/default.png';

		$size                = $settings['thumbnail_logo_size'. '_size'];

		$classyea_image_url_func = $this->classyea_logo_image_func( $size );
       
		$attachment_size = $this->classyea_custom_attachment_size_func($size);
        
		$img_url = $this->classyea_image_url_default_func( $site_link );


        if ('none' !==  $link_type ) {
            if ( $link_type == 'file') {
               
                $this->add_render_attribute('imglink', 'href', $img_url );
            } elseif (  $link_type == 'default' ) {
                $this->add_render_attribute('imglink', 'href', $site_link );
            } else {
                $this->add_render_attribute('imglink', 'href', $this->classyea_link_type_func( $settings ) );
            }
        }

        if (  $logo_lightbox === 'no') {
            $check_clickable = 'elementor-non-clickable';
        }

		if( $classyea_image_url_func != '' ) {
			$img_url = $this->classyea_logo_image_func( $attachment_size );
		}

		$img_url = $this->classyea_image_url_func($default_imgurl,$img_url );
        
        ?>
        <div class='classyea-main-wrapper'>
            <div class="">
                <?php if( !empty( $imglink['url'] ) ) { ?>
                <a <?php echo wp_kses_post($this->get_render_attribute_string('imglink')); ?> data-elementor-open-lightbox="<?php echo esc_attr( $logo_lightbox ); ?>">
                <?php } ?>
                    <div class="classyea-logo-row">           
                        <div class="classyea-logo-container">
                            <img src="<?php echo esc_url($img_url);?>" class="classyea-site-logo-img" class="<?php echo esc_attr($check_clickable);?>">
                        </div>
                    </div>
                <?php if( !empty( $imglink['url'] ) ) { ?>
                </a>
                <?php } ?>
                <?php if( !empty( $caption_title ) && $caption_enable_disable == 'yes') { ?>
                <div class="classyea-caption-title"> 
                    <figcaption class="classyea-caption-content"><?php echo wp_kses($caption_title,'classyea_kses');?></figcaption>
                </div>
                <?php } ?>
			</div>
        </div>  
        <?php
    }

    public function classyea_logo_image_func($size = '') {

        $settings            = $this->get_settings_for_display();
        $logo_enable_disable = $settings['custom_logo_enable_disable'];
       
        if($logo_enable_disable == 'yes') {

            $logo_custom_image    = $settings['logo_custom_image']['id'];
            $image_src = wp_get_attachment_image_src( $logo_custom_image, $size ,true );

            if ( empty( $image_src[0] ) && 'thumbnail_logo_size_size' !== $size ) {
                $image_src = wp_get_attachment_image_src( $logo_custom_image );
            }
        } else {
            $image_src = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $size, true );
        }
        return ! empty( $image_src[0] ) ? $image_src[0] : '';
    }

	public function classyea_link_type_func( $settings ) {

        $link_type = $settings['link_type'];
		if ( 'none' !== $link_type ) {
			if ( !empty( $settings['link']['url'] ) ) {
                if ( 'custom' === $link_type ) {
                    return $settings['link'];
                }
                elseif ( 'default' === $link_type ) {
                    return site_url();
                }
            }
            return false;
        } 
        return false;
        
	}

	public function classyea_image_url_default_func( $site_link ) {
		$default_imgurl = $site_link . '/wp-includes/images/media/default.png';

		$classyea_image_url_func = $this->classyea_logo_image_func();

		if( $classyea_image_url_func == $default_imgurl ) {
			$site_image = ELEMENTOR_ASSETS_URL .'images/placeholder.png';
		} else {
			$site_image = $classyea_image_url_func;
		}

		return $site_image;
	}

	public function classyea_custom_attachment_size_func ($size) {
		$settings            = $this->get_settings_for_display();
		
		if ( 'custom' !== $size ) {
            $attachment_size = $size;
        } else {
            // Use BFI_Thumb script
            // TODO: Please rewrite this code.
            require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';

            $custom_dimension = $settings[ 'thumbnail_logo_size'  . '_custom_dimension' ];

            $attachment_size = [
                // Defaults sizes
                0 => null, // Width.
                1 => null, // Height.

                'bfi_thumb' => true,
                'crop' => true,
            ];

            $has_custom_size = false;
            if ( ! empty( $custom_dimension['width'] ) ) {
                $has_custom_size = true;
                $attachment_size[0] = $custom_dimension['width'];
            }

            if ( ! empty( $custom_dimension['height'] ) ) {
                $has_custom_size = true;
                $attachment_size[1] = $custom_dimension['height'];
            }

            if ( ! $has_custom_size ) {
                $attachment_size = 'full';
            }
        }

		return $attachment_size;
	}

	public function classyea_image_url_func( $default_imgurl,$img_url ) {
		if ( $default_imgurl == $img_url ) {
            $img_url =  ELEMENTOR_ASSETS_URL . 'images/placeholder.png';
        } else {
            $img_url = $img_url;
        }

		return $img_url;
	}

}