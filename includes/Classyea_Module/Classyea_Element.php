<?php
namespace ClassyEa\Helper\Classyea_Module;

use Elementor\Plugin;
use ClassyEa\Helper\Traits\Classyea_Module;

class Classyea_Element
{
	use Classyea_Module;
	public function __construct()
	{
		add_action('elementor/elements/categories_registered', array($this, 'classyea_ele_widget_categories'));
		add_action('elementor/widgets/register', array($this, 'classyea_widgets_registered'));

	}
	public function classyea_widgets_registered()
	{
		$widget_class_list = $this->classyea_ele_widget_class_list();
		$enabled_widget    = get_option( 'classyea_enable_widget', true );

		if(is_array($enabled_widget)) {
			foreach($enabled_widget as $enabled_widget_key) {
				$enable_widget_list = $widget_class_list[ $enabled_widget_key ];
				$widget_class 		= "ClassyEa\\Helper\\Classyea_Module\\Widgets\\" . $enable_widget_list;
				Plugin::instance()->widgets_manager->register(new $widget_class);
			}
		}
	}
	public function classyea_ele_widget_class_list(){

		$option_list      = $this->classyea_default_option();

		$widgetclass_list = [];

		foreach ($option_list as $key => $value ) {
			$widgetclass_list[$key] = $value[1];	
		}
		ksort($widgetclass_list);
    	return $widgetclass_list;
	}
	
	public function classyea_ele_widget_categories( $widgets_manager )
	{
		$widgets_manager->add_category(
			'classyea',
			array(
				'title' => __('Classy Addons', 'classyea'),
				'icon'  => 'fa fa-plug',
			),
			1
		);

		$widgets_manager->add_category(
			'classyea_hfe',
			array(
				'title' => esc_html__( 'Classy Addons Header Footer', 'classyea' ),
				'icon'  => 'fa fa-plug',
			),
			1
		);
	}
}