<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Widget_Base;
use \Elementor\Skin_Base;
use \Elementor\Plugin;

class Skin_Layout_Three_Accordion extends Skin_Base
{
	public function __construct(Widget_Base $parent)
	{
		$this->parent = $parent;
		$this->_register_controls_actions();
		add_action('elementor/element/classyea-widget-accordion/classyea_acc_advanced_settings/before_section_end', array($this, 'register_controls'));
		add_action('elementor/element/classyea-widget-accordion/classyea_acc_advanced_settings/after_section_end', array($this, 'update_controls'));
	}
	public function get_id()
	{
		return 'classyea-accordion-layout-three';
	}

	public function get_title()
	{
		return __('Layout Three', 'classyea');
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
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => 'classyea-accordion-layout-three',
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
							'value'    => 'classyea-accordion-layout-three',
						)
					)
				)
			)
		);
		$this->parent->update_control(
			'adv_accordion_bg_image_color_bgtype',
			array(
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => '_skin',
							'operator' => '==',
							'value'    => 'classyea-accordion-layout-three',
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
				'of'   => 'general',
			)
		);
		$this->parent->end_injection();
	}
	public function render()
	{
		$settings    				= $this->parent->get_settings_for_display();
		$add_acc_items 				= $settings['add_acc_items'];
		$adv_acc_open_first_slide  	= $settings['adv_acc_open_first_slide'];

		$adv_acc_title_tag = $settings['adv_acc_title_tag'];
		$arrow_up                  = $settings['arrow_up'];
        $arrow_down                = $settings['arrow_down'];
?>
		<div id="classyea-accordion__container-item-1000" class="classyea-layout-three">
			<?php
			foreach ($add_acc_items as $i => $accorion_content) :
				$adv_acc_title = $accorion_content['adv_acc_title'];
				if ($accorion_content['adv_acc_is_active'] == 'yes') {
					$is_active = 'classyea-accordion__item-1000--active';
				} elseif ($adv_acc_open_first_slide == 'yes' && $i == '0') {
					$is_active = 'classyea-accordion__item-1000--active';
				} else {
					$is_active = '';
				}
			?>
			<div class="classyea-accordion__box-item-1000 <?php echo esc_attr($is_active); ?>">
				<div class="classyea-accordion__head-item-1000 classyea-accordion__head">
					<div class="classyea-accordion__head-inner">
						<<?php echo esc_html($adv_acc_title_tag); ?> class="classyea-accordion-title classyea-acc-tab-title"><?php echo esc_attr($adv_acc_title); ?></<?php echo esc_html($adv_acc_title_tag); ?>>
					</div>
					<span class="question-icon"><i class="fa fa-question"></i></span>
					<span class="classyea-accordion__item-icon normal"><i class="<?php echo esc_attr($arrow_down['value']);?>"></i></span>
					<span class="classyea-accordion__item-icon active"><i class="<?php echo esc_attr($arrow_up['value']);?>"></i></span>
				</div>
				<div class="classyea-accordion__content-item-1000 classyea-accordion__content">
					<div class="classyea-accordion__content-inner">
						<?php
						if ('content' == $accorion_content['adv_acc_content_type'] || 'image_content' == $accorion_content['adv_acc_content_type']) {
							echo  do_shortcode(wp_kses($accorion_content['adv_accordion_tab_content'],'classyea_kses'));
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