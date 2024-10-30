<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
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
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site Logo', 'classyea' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-site-logo classyea';
	}

	/**
	 * Retrieve site logo widget category.
	 * @access public
	 * @return string widget category
	 */
	public function get_categories() {
		return [ 'classyea_hfe' ];
	}

	/**
	 * Register Site Logo controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->classyea_reg_content_site_logo_controls();
		$this->classyea_reg_site_logo_styling_controls();
		$this->classyea_logo_caption_styling_controls();
	}

	/**
	 * Retrieve site logo general control option
	 * @access protected
	 */
	protected function classyea_reg_content_site_logo_controls() {
		$this->start_controls_section(
			'section_site_image',
			[
				'label' => __( 'Site Logo', 'classyea' ),
			]
		);

		$this->add_control(
			'site_logo_enable_disable',
			[
				'label'       => __( 'Custom Image', 'classyea' ),
				'type'        => Controls_Manager::SWITCHER,
				'yes'         => __( 'Yes', 'classyea' ),
				'no'          => __( 'No', 'classyea' ),
				'default'     => 'no',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'custom_image',
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
					'site_logo_enable_disable' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'site_logo_size',
				'label'   => __( 'Image Size', 'classyea' ),
				'default' => 'medium',
			]
		);
		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .classyea-hfe-site-logo-container, {{WRAPPER}} .classyea-hfe-caption-width figcaption' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'caption_source',
			[
				'label'   => __( 'Caption', 'classyea' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'no'  => __( 'No', 'classyea' ),
					'yes' => __( 'Yes', 'classyea' ),
				],
				'default' => 'no',
			]
		);

		$this->add_control(
			'caption',
			[
				'label'       => __( 'Custom Caption', 'classyea' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __( 'Enter caption', 'classyea' ),
				'condition'   => [
					'caption_source' => 'yes',
				],
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'link_type',
			[
				'label'   => __( 'Link Type', 'classyea' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'classyea' ),
					'none'    => __( 'None', 'classyea' ),
					'file'    => __( 'Media File', 'classyea' ),
					'custom'  => __( 'Custom URL', 'classyea' ),
				],
			]
		);

		$this->add_control(
			'link',
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
			'open_lightbox',
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

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'classyea' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Register Site Image Style Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function classyea_reg_site_logo_styling_controls() {
		$this->start_controls_section(
			'section_style_site_logo_image',
			[
				'label' => __( 'Site logo', 'classyea' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
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
					'{{WRAPPER}} .hfe-site-logo .classyea-hfe-site-logo-container img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'space',
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
					'{{WRAPPER}} .hfe-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
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

		$this->add_control(
			'site_logo_background_color',
			[
				'label'     => __( 'Background Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-hfe-site-logo-set .classyea-hfe-site-logo-container' => 'background-color: {{VALUE}};',
				],
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
					'{{WRAPPER}} .classyea-hfe-site-logo-container .classyea-hfe-site-logo-img' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .classyea-hfe-site-logo-container .classyea-hfe-site-logo-img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .classyea-hfe-site-logo-container .classyea-hfe-site-logo-img' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .hfe-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .hfe-site-logo img',
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
					'{{WRAPPER}} .hfe-site-logo img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters',
				'selector' => '{{WRAPPER}} .hfe-site-logo img',
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
					'{{WRAPPER}} .hfe-site-logo:hover img' => 'opacity: {{SIZE}};',
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
					'{{WRAPPER}} .hfe-site-logo img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .hfe-site-logo:hover img',
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
	 *
	 * @since 1.2.0
	 * @access protected
	 */
	protected function classyea_logo_caption_styling_controls() {
		$this->start_controls_section(
			'section_style_caption',
			[
				'label'     => __( 'Caption', 'classyea' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_control(
			'caption_background_color',
			[
				'label'     => __( 'Background Color', 'classyea' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .widget-image-caption',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .widget-image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label'              => __( 'Padding', 'classyea' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .widget-image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'caption_space',
			[
				'label'              => __( 'Spacing', 'classyea' ),
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
					'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: 0px;',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * check has caption
	 *
	 * @access private
	 * @since 1.2.0
	 *
	 * @param array $settings returns settings.
	 *
	 * @return boolean
	 */
	private function has_caption( $settings ) {
		return ( ! empty( $settings['caption_source'] ) && 'no' !== $settings['caption_source'] );
	}

	/**
	 * Get caption current widget.
	 *
	 * @access private
	 * @since 1.2.0
	 * @param array $settings returns the caption.
	 *
	 * @return string
	 */
	private function get_caption( $settings ) {
		$caption = '';
		if ( 'yes' === $settings['caption_source'] ) {
            $caption = ( $settings['caption'] ) ? $settings['caption'] : '';
		}
		return $caption;
	}

	/**
	 * Render Site Image output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @param array $size returns the size of an image.
	 * @access public
	 */
	public function site_image_url( $size ) {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['custom_image']['url'] ) ) {
			$logo = wp_get_attachment_image_src( $settings['custom_image']['id'], $size, true );
		} else {
			$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $size, true );
		}
		return $logo[0];
	}

	/**
	 * Render Site Image output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 * 
	 */
	protected function render() {
		$link     = '';
		$settings = $this->get_settings_for_display();

        $link_type      = $settings['link_type'];
        $custom_img     = $settings['custom_image'];
        $open_lightbox  = $settings['open_lightbox'];

		$has_caption = $this->has_caption( $settings );

		$this->add_render_attribute( 'wrapper', 'class', 'hfe-site-logo' );

		$size = $settings['site_logo_size_size'];

		$site_image = $this->site_image_url( $size );

        $site_default_imgurl = site_url() . '/wp-includes/images/media/default.png';

		if ( $site_default_imgurl === $site_image ) {
			$site_image = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';
		} else {
			$site_image = $site_image;
		}

		if ( 'file' === $link_type ) {
				$link = $site_image;
				$this->add_render_attribute( 'link', 'href', $link );
		} elseif ( 'default' === $link_type ) {
			$link = site_url();
			$this->add_render_attribute( 'link', 'href', $link );
		} else {
			$link = $this->get_link_url( $settings );

			if ( $link ) {
				$this->add_link_attributes( 'link', $link );
			}
		}
		$class = '';
		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$class = 'elementor-non-clickable';
		} else {
			$class = 'elementor-clickable';
		}
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
		<?php if ( $has_caption ) : ?>
				<figure class="wp-caption">
		<?php endif; ?>
		<?php if ( $link ) : ?>
					<?php
					if ( 'no' === $open_lightbox ) {
						$class = 'elementor-non-clickable';
					}
					?>
				<a data-elementor-open-lightbox="<?php echo esc_attr( $open_lightbox ); ?>"  class='<?php echo  esc_attr( $class ); ?>' <?php echo $this->get_render_attribute_string( 'link' ); ?>>
		<?php endif; ?>
		<?php
		if ( empty( $site_image ) ) {
			return;
		}
		$img_animation = '';

		if ( 'custom' !== $size ) {
			$image_size = $size;
		} else {
			require_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';

			$image_dimension = $settings['site_logo_size_custom_dimension'];

			$image_size = [
				// Defaults sizes.
				0           => null, // Width.
				1           => null, // Height.

				'bfi_thumb' => true,
				'crop'      => true,
			];

			$has_custom_size = false;
			if ( ! empty( $image_dimension['width'] ) ) {
				$has_custom_size = true;
				$image_size[0]   = $image_dimension['width'];
			}

			if ( ! empty( $image_dimension['height'] ) ) {
				$has_custom_size = true;
				$image_size[1]   = $image_dimension['height'];
			}

			if ( ! $has_custom_size ) {
				$image_size = 'full';
			}
		}

		$image_url = $site_image;

		if ( ! empty( $custom_img['url'] ) ) {
			$image_data = wp_get_attachment_image_src( $custom_img['id'], $image_size, true );
		} else {
			$image_data = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), $image_size, true );
		}

		$site_image_class = 'elementor-animation-';

		if ( ! empty( $settings['hover_animation'] ) ) {
			$img_animation = $settings['hover_animation'];
		}
		if ( ! empty( $image_data ) ) {
			$image_url = $image_data[0];
		}

		if ( $site_default_imgurl === $image_url ) {
			$image_url = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';
		} else {
			$image_url = $image_url;
		}

		$class_animation = $site_image_class . $img_animation;

		$image_unset = site_url() . '/wp-content/plugins/elementor/assets/images/placeholder.png';

		if ( $image_unset !== $image_url ) {
			$image_url = $image_url;
		}

		?>
			<div class="classyea-hfe-site-logo-set">           
				<div class="classyea-hfe-site-logo-container">
					<img class="classyea-hfe-site-logo-img <?php echo esc_attr( $class_animation ); ?>"  src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $custom_img ) ); ?>"/>
				</div>
			</div>
		<?php if ( $link ) : ?>
					</a>
		<?php endif; ?>
		<?php
		if ( $has_caption ) :
			$caption_text = $this->get_caption( $settings );
			?>
			<?php if (  $caption_text != '' ) : ?>
					<div class="classyea-hfe-caption-width"> 
						<figcaption class="widget-image-caption wp-caption-text"><?php echo wp_kses_post( $caption_text ); ?></figcaption>
					</div>
			<?php endif; ?>
				</figure>
		<?php endif; ?>
		</div>  
			<?php
	}

	/**
	 * site logo  function
	 * Render link output function
	 * @access private
	 */
	private function get_link_url( $settings ) {

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
}