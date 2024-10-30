<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Widget_Base;
use \Elementor\Skin_Base;
use \Elementor\Plugin;

class Skin_Image_Accordion extends Skin_Base
{
	public function __construct(Widget_Base $parent)
	{
		$this->parent = $parent;
		$this->_register_controls_actions();
		add_action('elementor/element/classyea-widget-accordion/adv_acc_left_content_settings/before_section_end', array($this, 'register_controls'));
		add_action('elementor/element/classyea-widget-accordion/adv_acc_left_content_settings/after_section_end', array($this, 'update_controls'));
	}
	public function get_id()
	{
		return 'classyea-image-accordion-layout-two';
	}

	public function get_title()
	{
		return __('Image Accordion', 'classyea');
	}

	protected function _register_controls_actions()
	{
		parent::_register_controls_actions();
	}

	public function update_controls(Widget_Base $widget)
	{
		$this->parent = $widget;
		$this->parent->update_control(
			'left_image',
			array(
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '==',
							'value'    => 'classyea-image-accordion-layout-two',
						),
						array(
							'name'     => '_skin',
							'operator' => '==',
							'value'    => 'classyea-image-accordion-layout-two',
						)
					)
				)
			)
		);
		$this->parent->update_control(
			'background_image',
			array(
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => 'classyea-image-accordion-layout-two',
						)
					)
				)
			)
		);
		$this->parent->update_control(
			'adv_acc_left_content_settings',
			array(
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => 'classyea-image-accordion-layout-two',
						)
					)
				)
			)
		);
		$this->parent->update_control(
			'adv_acc_main_sub_heading',
			array(
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => 'classyea-image-accordion-layout-two',
						)
					)
				)
			)
		);
	}

	public function register_controls(Widget_Base $widget)
	{

		$this->parent->start_injection(
			array(
				'type' => 'section',
				'at'   => 'end',
				'of'   => 'general'
			)
		);
		$this->parent->end_injection();
	}

	public function render()
	{
		$settings    			   = $this->parent->get_settings_for_display();
		$add_acc_items 			   = $settings['add_acc_items'];
		$adv_acc_open_first_slide  = $settings['adv_acc_open_first_slide'];
		$adv_acc_title_tag 		   = $settings['adv_acc_title_tag'];

?>
	<!--===== Design Two =====-->
	<div id="classyea-accordion-box-1003">
		<?php
		foreach ($add_acc_items as $i => $accorion_content) :
			$adv_acc_title 		  = $accorion_content['adv_acc_title'];
			$adv_acc_content_type = $accorion_content['adv_acc_content_type'];
			if ($adv_acc_content_type == 'image_content') {
				$item_image     = ($accorion_content["item_image"]["id"] != "") ? wp_get_attachment_image($accorion_content["item_image"]["id"], "full") : $accorion_content["item_image"]["url"];
				$item_image_alt = get_post_meta($accorion_content["item_image"]["id"], "_wp_attachment_item_image_alt", true);
			}

			if ($accorion_content['adv_acc_is_active'] == 'yes') {
				$is_active = 'active';
			} elseif ($adv_acc_open_first_slide == 'yes' && $i == '0') {
				$is_active = 'active';
			} else {
				$is_active = '';
			}
		?>
			<div class="classyea-accordion-item <?php echo esc_attr($is_active); ?>">
				<<?php echo esc_html($adv_acc_title_tag); ?> class="classyea-accordion-title classyea-acc-tab-title"><?php echo esc_html($adv_acc_title); ?></<?php echo esc_html($adv_acc_title_tag); ?>>
				<div class="classyea-accordion-content">
					<div class="classyea-accordion-content-image">
						<?php
						if ($adv_acc_content_type == 'image_content') {
							if (wp_http_validate_url($item_image)) {
						?>
							<img src="<?php echo esc_url($item_image); ?>" alt="<?php esc_attr($item_image_alt); ?>">
						<?php
							} else {
								echo wp_kses_post($item_image);
							}
						}
						?>
					</div>
					<div class="classyea-accordion-content-text">
						<?php
						if ('content' == $accorion_content['adv_acc_content_type'] || 'image_content' == $accorion_content['adv_acc_content_type']) { ?>
							<p><?php echo do_shortcode(wp_kses($accorion_content['adv_accordion_tab_content'],'classyea_kses'));?></p>
						<?php 
						} elseif ('template' == $accorion_content['adv_acc_content_type']) {
							if (!empty($accorion_content['adv_acc_primary_templates'])) {
								echo Plugin::$instance->frontend->get_builder_content($accorion_content['adv_acc_primary_templates'], true);
							}
						} ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php
	}
}
