<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Core\Schemes\Typography as Scheme_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Image Comparision Widget
 */
class Classyea_Image_Comparison extends Widget_Base
{

	/**
	 * Retrieve image comparision widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-image-comparison';
	}
	/**
	 * Retrieve image comparision widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.f
	 */
	public function get_title()
	{
		return esc_html__('Image Comparison', 'classyea');
	}
	/**
	 * Retrieve image comparision widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-image-compare';
	}
	/**
	 * Retrieve image comparision widget category.
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
			'classyea-fontawesome-5to8',
			'classyea-main-style',
		];
	}
	public function get_script_depends()
	{
		return array(
			'classyea-jquery-even-move',
			'classyea-twentytwenty',
			'classyea-image-compare-twenty',
		);
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
			'image comparision',
			'classy image comparision',
			'classy image compare',
			'classyea addons',
			'compare image before',
			'compare image after',
		];
	}
	/**
	 * Register image comparision widget controls.
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->classyea_reg_content_img_compare_controls();
		$this->classyea_reg_img_compare_main_controls();
		$this->classyea_register_style_handle_controls();
		$this->classyea_register_style_divider_controls();
		$this->classyea_register_style_label_controls();
	}
	protected function classyea_reg_content_img_compare_controls()
	{

		/**
		 * Content Tab: image comparision
		 */
		$this->start_controls_section(
			'section_image_comparision',
			[
				'label' => __('General Settings', 'classyea'),
			]
		);

		$this->add_control(
			'visible_ratio',
			array(
				'label' => __('Visible Ratio', 'classyea'),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					),
				),

			)
		);

		$this->add_control(
			'orientation',
			array(
				'label'   => __('Orientation', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'vertical'   => __('Vertical', 'classyea'),
					'horizontal' => __('Horizontal', 'classyea'),
				),
			)
		);
		$this->add_control(
			'move_slider',
			array(
				'label'   => __('Move Slider', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'drag',
				'options' => array(
					'drag'        => __('Drag', 'classyea'),
					'mouse_move'  => __('Mouse Move', 'classyea'),
					'mouse_click' => __('Mouse Click', 'classyea'),
				),
			)
		);
		$this->add_control(
			'overlay',
			array(
				'label'        => __('Overlay', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();
	}
	/*    Main Control */
	protected function classyea_reg_img_compare_main_controls()
	{

		/**
		 * Before Image
		 */
		$this->start_controls_section(
			'section_before_image',
			[
				'label' => __('Before Image', 'classyea'),
			]
		);
		$this->add_control(
			'before_image',
			[
				'label'   => esc_html__('Image', 'classyea'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'before_image_size',
				'default'   => 'full',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'before_label',
			array(
				'label'   => __('Label Text', 'classyea'),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __('Before', 'classyea'),
			)
		);
		$this->end_controls_section();

		/**
		 * After Image
		 */
		$this->start_controls_section(
			'section_after_image',
			[
				'label' => __('After Image', 'classyea'),
			]
		);
		$this->add_control(
			'after_image',
			[
				'label'   => esc_html__('After Image', 'classyea'),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'after_image_size',
				'default'   => 'full',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'after_label',
			array(
				'label'   => __('Label Text', 'classyea'),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __('After', 'classyea'),
			)
		);
		$this->end_controls_section();
	}
	/*-----------------------------------------------------------------------------------*/
	/*    Handle register control
    /*-----------------------------------------------------------------------------------*/
	protected function classyea_register_style_handle_controls()
	{
		$this->start_controls_section(
			'classyea_handle_style',
			[
				'label' => __('Handle', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'handle_background_color',
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .twentytwenty-handle',
			]
		);
		$this->add_control(
			'handle_icon_color',
			[
				'label'     => __('Arrow Up/Down Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-before-after-work-area .twentytwenty-left-arrow:before' => 'color:{{VALUE}}',
					'{{WRAPPER}} .classyea-before-after-work-area .twentytwenty-right-arrow:before' => 'color:{{VALUE}}',
					'{{WRAPPER}} .classyea-before-after-work-area .twentytwenty-down-arrow:before' => 'color:{{VALUE}}',
					'{{WRAPPER}} .classyea-before-after-work-area .twentytwenty-up-arrow:before' => 'color:{{VALUE}}',
					

				],
			]
		);

		$this->add_control(
			'down_arrow_border',
			[
				'label'     => __('Arrow Circle Border', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'handle_border',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .twentytwenty-handle',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'handle_border_radius',
			[
				'label'      => __('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .twentytwenty-handle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'handle_box_shadow',
				'selector' => '{{WRAPPER}} .twentytwenty-handle',
			]
		);
		$this->end_controls_section();
	}
	/**
	 * Style Tab: Divider
	 */
	protected function classyea_register_style_divider_controls()
	{
		$this->start_controls_section(
			'classyea_section_divider_style',
			[
				'label' => __('Divider', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'divider_background_color',
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'divider_border',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'divider_border_radius',
			[
				'label'      => __('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before'   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'divider_box_shadow',
				'selector' => '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before,{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after,{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before,{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after',
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Style Tab: Label control
	 */
	protected function classyea_register_style_label_controls()
	{
		$this->start_controls_section(
			'section_label_style',
			[
				'label' => __('Label', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'arrow_position_toggle',
			[
				'label'        => __('Position', 'classyea'),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __('None', 'classyea'),
				'label_on'     => __('Custom', 'classyea'),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'arrow_position_y',
			[
				'label'      => __('Vertical', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition'  => [
					'arrow_position_toggle' => 'yes',
				],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 1000,
					],
					'%'  => [
						'min' => -110,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before'                                                              => 'top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before'                                                               => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-before-label:before, .twentytwenty-horizontal .twentytwenty-after-label:before' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_position_x',
			[
				'label'      => __('Horizontal', 'classyea'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition'  => [
					'arrow_position_toggle' => 'yes',
				],
				'range'      => [
					'px' => [
						'min' => -100,
						'max' => 1000,
					],
					'%'  => [
						'min' => -110,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before, .twentytwenty-vertical .twentytwenty-after-label:before,.twentytwenty-horizontal .twentytwenty-before-label:before' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-after-label:before'                                                                                                                    => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();
		$this->start_controls_tabs('tabs_label_style');

		$this->start_controls_tab(
			'tab_label_before',
			[
				'label' => __('Before', 'classyea'),
			]
		);

		$this->add_control(
			'label_text_color_before',
			[
				'label'     => __('Text Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-imagecompare-overlay .old'                      => 'color: {{VALUE}}',
					'{{WRAPPER}} .before-effect-button'                                    => 'color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-before-label:before'                        => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'label_bg_color_before',
			[
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-imagecompare-overlay .old'                      => 'background: {{VALUE}}',
					'{{WRAPPER}} .before-effect-button'                                    => 'background: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-before-label:before'                        => 'background: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'label_border',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-imagecompare-overlay .old,{{WRAPPER}} .before-effect-button,{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before,{{WRAPPER}} .twentytwenty-before-label:before',
			]
		);

		$this->add_control(
			'label_border_radius',
			[
				'label'      => __('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-imagecompare-overlay .old'                      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .before-effect-button'                                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-before-label:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-before-label:before'                        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_label_after',
			[
				'label' => __('After', 'classyea'),
			]
		);

		$this->add_control(
			'label_text_color_after',
			[
				'label'     => __('Text Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-imagecompare-overlay .new'                     => 'color: {{VALUE}}',
					'{{WRAPPER}} .before-effect-button'                                   => 'color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-after-label:before'                        => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'label_bg_color_after',
			[
				'label'     => __('Background Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-imagecompare-overlay .new'                     => 'background: {{VALUE}}',
					'{{WRAPPER}} .before-effect-button'                                   => 'background: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .twentytwenty-after-label:before'                        => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'label_border_after',
				'label'       => __('Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-imagecompare-overlay .new,{{WRAPPER}} .before-effect-button,{{WRAPPER}} .twentytwenty-after-label:before',
			]
		);

		$this->add_control(
			'label_border_radius_after',
			[
				'label'      => __('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-imagecompare-overlay .new' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .before-effect-button'               => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-after-label:before'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'label_typography',
				'label'     => __('Typography', 'classyea'),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'selector'  => '{{WRAPPER}} .classyea-imagecompare-overlay span,{{WRAPPER}} .before-effect-button,{{WRAPPER}} .twentytwenty-vertical .twentytwenty-after-label:before,{{WRAPPER}} .twentytwenty-after-label:before',
				'separator' => 'before',

			]
		);

		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => __('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-imagecompare-overlay span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .before-effect-button'               => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-before-label:before'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .twentytwenty-after-label:before'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);
		$this->end_controls_section();
	}
	public function randomString()
	{
		$length = 16;
		$chars  = '0122356789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str    = '';

		for ($i = 0; $i < $length; $i++) {
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$orientation = $settings['orientation'];

		$unique_id = $this->randomString();

		$changed_atts = array(
			'visible_ratio'      => ($settings['visible_ratio']['size']) ? $settings['visible_ratio']['size'] : '0.5',
			'orientation'        => $orientation,
			'before_label'       => ($settings['before_label']) ? esc_attr($settings['before_label']) : '',
			'after_label'        => ($settings['after_label']) ? esc_attr($settings['after_label']) : '',
			'slider_on_hover'    => 'mouse_move' === $settings['move_slider'] ? true : false,
			'slider_with_handle' => 'drag' === $settings['move_slider'] ? true : false,
			'slider_with_click'  => 'mouse_click' === $settings['move_slider'] ? true : false,
			'no_overlay'         => ('yes' === $settings['overlay']) ? false : true,
			'no_overlay'         => ('yes' === $settings['overlay']) ? false : true,
		);

		$this->add_render_attribute( 'comparison_settings', 'data-verticalhorizontal' , wp_json_encode( $changed_atts ) );

?>
		<!--Start Before After Work Area-->
		<div class="classyea-before-after-work-area" data-uniqueid="<?php echo esc_attr($unique_id); ?>">
			<div class="classyea-before-after-content">
				<div class="before-after">
					<div data-id="classyea-wrinkle-before-after-<?php echo esc_attr($unique_id); ?>" class="classyea-before-after-twentytwenty" id="classyea-wrinkle-before-after<?php echo esc_attr($unique_id); ?>" <?php $this->print_render_attribute_string( 'comparison_settings' ); ?>>
						<?php $this->classyea_render_before_image($settings); ?>
						<?php $this->classyea_render_after_image($settings); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
	/**
	 * Image comparison before image function
	 * Render image comparison before image output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_before_image($settings)
	{

		if ('' !== $settings['before_image']['url']) :
			$this->add_render_attribute('before-image', 'src', $settings['before_image']['url']);
			$this->add_render_attribute('before-image', 'alt', Control_Media::get_image_alt($settings['before_image']));
			$this->add_render_attribute('before-image', 'title', Control_Media::get_image_title($settings['before_image']));
		?>
			<?php
			echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'before_image_size', 'before_image'), 'classyea_img');
			?>
		<?php
		endif;
	}
	/**
	 * Image comparison after image function
	 * Render image comparison after image output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_after_image($settings)
	{

		if ('' !== $settings['after_image']['url']) :
			$this->add_render_attribute('after-image', 'src', $settings['after_image']['url']);
			$this->add_render_attribute('after-image', 'alt', Control_Media::get_image_alt($settings['after_image']));
			$this->add_render_attribute('after-image', 'title', Control_Media::get_image_title($settings['after_image']));
		?>
			<?php
			echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'after_image_size', 'after_image'), 'classyea_img');
			?>
<?php
		endif;
	}
}
