<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Widget_Base;
use \Elementor\Skin_Base;
use \Elementor\Plugin;
use \Elementor\Group_Control_Image_Size;

class Skin_Layout_Four_Accordion extends Skin_Base
{
	public function __construct(Widget_Base $parent)
	{
		$this->parent = $parent;
		$this->register_controls_actions();
		add_action('elementor/element/classyea-widget-accordion/adv_acc_left_content_settings/before_section_end', array($this, 'register_controls'));
		add_action('elementor/element/classyea-widget-accordion/adv_acc_left_content_settings/after_section_end', array($this, 'update_controls'));

		add_action('elementor/element/classyea-widget-accordion/adv_faq_tab/before_section_end', array($this, 'register_controls'));
		add_action('elementor/element/classyea-widget-accordion/adv_faq_tab/after_section_end', array($this, 'update_controls'));
	}
	public function get_id()
	{
		return 'classyea-layout-four-accordion';
	}

	public function get_title()
	{
		return __('Layout Four', 'classyea');
	}

	protected function register_controls_actions()
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
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => 'classyea-layout-four-accordion',
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
							'value'    => 'classyea-layout-four-accordion',
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
							'value'    => 'classyea-layout-four-accordion',
						)
					)
				)
			)
		);
		$this->parent->update_control(
			'adv_acc_main_sub_heading',
			array(
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '==',
							'value'    => 'classyea-layout-four-accordion',
						),
						array(
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => 'classyea-layout-four-accordion',
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
		$settings    				= $this->parent->get_settings_for_display();
		$add_acc_items 				= $settings['add_acc_items'];
		$adv_acc_open_first_slide   = $settings['adv_acc_open_first_slide'];
		$adv_acc_title_tag 			= $settings['adv_acc_title_tag'];
?>
		<div id="classyea-accordion__container-item-1001">
			<?php
			foreach ($add_acc_items as $i => $accorion_content) :
				$adv_acc_title 			= $accorion_content['adv_acc_title'];
				$adv_acc_heading 		= $accorion_content['adv_acc_heading'];
				$adv_acc_content_type 	= $accorion_content['adv_acc_content_type'];
				if ($adv_acc_content_type == 'image_heading_content' || $adv_acc_content_type == 'image_content') {
					$item_image = ($accorion_content["item_image"]["id"] != "") ? wp_get_attachment_image_url($accorion_content["item_image"]["id"], "full") : $accorion_content["item_image"]["url"];
				}

				if ($accorion_content['adv_acc_is_active'] == 'yes') {
					$is_active = 'classyea-accordion__item-1001--active';
				} elseif ($adv_acc_open_first_slide == 'yes' && $i == '0') {
					$is_active = 'classyea-accordion__item-1001--active';
				} else {
					$is_active = '';
				}

				$acc_tab_content = $accorion_content['adv_accordion_tab_content'];
			?>
				<div class="classyea-accordion__box-item-1001 <?php echo esc_attr($is_active); ?>">
					<div class="classyea-accordion__head-item-1001 classyea-accordion__head">
						<div class="classyea-accordion__head-inner">
							<<?php echo esc_html($adv_acc_title_tag); ?> class="classyea-accordion-title classyea-acc-tab-title"><?php echo wp_kses($adv_acc_title,'classyea_kses'); ?></<?php echo esc_html($adv_acc_title_tag); ?>>
						</div>
						<span class="classyea-accordion__item-icon">
						</span>
					</div>
					<!-- .classyea-accordion__head -->
					<div class="classyea-accordion__content-item-1001 classyea-accordion__content">
						<div class="classyea-accordion__content-left">
							<?php if ('image_heading_content' == $accorion_content['adv_acc_content_type']) { ?>
								<h3><?php echo wp_kses($adv_acc_heading,'classyea_kses'); ?></h3>
							<?php } ?>
							<?php
							if ('content' == $accorion_content['adv_acc_content_type'] || 'image_content' == $accorion_content['adv_acc_content_type'] || 'image_heading_content' == $accorion_content['adv_acc_content_type']) {
								echo  do_shortcode(wp_kses($acc_tab_content,'classyea_kses'));
							} elseif ('template' == $accorion_content['adv_acc_content_type']) {
								if (!empty($accorion_content['adv_acc_primary_templates'])) {
									echo Plugin::$instance->frontend->get_builder_content($accorion_content['adv_acc_primary_templates'], true);
								}
							} ?>
						</div>
						<?php 
						if ($adv_acc_content_type == 'image_heading_content' || $adv_acc_content_type == 'image_content') { ?>
							<div class="classyea-accordion__content-right">
							
								<img src="<?php echo esc_url($item_image); ?>" alt="coffee" style="width: 100%; object-fit: contain;">
							</div>
						<?php } ?>
					</div>
					<!-- .classyea-accordion__content -->
				</div>
			<?php endforeach; ?>
		</div>
	<?php
	}
}
