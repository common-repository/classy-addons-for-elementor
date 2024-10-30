<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

class Classyea_Twitter_Posts extends Widget_Base
{

	public function get_name()
	{
		return 'classyea-twitter-posts';
	}

	public function get_title()
	{
		return esc_html__('Twitter Feed', 'classyea');
	}

	public function get_icon()
	{
		return 'classyicon classyea-service-box';
	}

	public function get_categories()
	{
		return array('classyea');
	}
	public function get_style_depends()
	{
		return [
			'font-awesome-5-all-classyea',
		];
	}
	public function get_keywords()
	{
		return [
			'twitter',
			'twitter feed',
			'twitter posts',
			'twitter posts',
			'twitters',
			'countdown box',
			'tweets',
			'tweet',
			'classy',
			'classy addons',
			'classyea twitter builder',

		];
	}
	public function get_script_depends()
	{
		return [
			'classyea-owl-carousel',
			'classyea-twitter',
		];
	}
	/**
	 * Register service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->register_content_settings_controls();
		$this->register_content_controls();
	}
	protected function register_content_settings_controls()
	{

		/****
		 * Content Tab: service
		 ****/
		$this->start_controls_section(
			'section_settings',
			[
				'label' => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 2; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}
		$this->add_control(
			'twitter_slider',
			[
				'label'        => __('Slider On/Off Switch', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('ON', 'classyea'),
				'label_off'    => esc_html__('OFF', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);
		$this->end_controls_section();
	}
	protected function register_content_controls()
	{

		$this->start_controls_section(
			'general',
			array(
				'label' => esc_html__('general', 'classyea'),
			)
		);

		$this->add_control(
			'author_name',
			array(
				'label'   => esc_html__('Author Name', 'classyea'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Tweets by @envato', 'classyea'),
			)
		);

		$this->add_control(
			'author',
			array(
				'label'         => esc_html__('Author URL', 'classyea'),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__('https://your-link.com', 'plugin-domain'),
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
			)
		);

		$this->add_control(
			'limit',
			array(
				'label'   => esc_html__('Posts Limit', 'classyea'),
				'type'    => Controls_Manager::NUMBER,
				'default' => __('3', 'classyea'),
			)
		);

		$this->end_controls_section();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$author_name    = $settings['author_name'];
		$limit          = $settings['limit'];
		$author         = $settings['author']['url'];
		$twitter_slider = $settings['twitter_slider'];
		if ($twitter_slider == 'yes') {
			$twitter_slider = 'classyea-twitter-active owl-theme';
		} else {
			$twitter_slider = '';
		}
?>
		<div class="classyea-twitter-timeline <?php echo esc_attr($twitter_slider); ?>">
			<a class="twitter-timeline" href="<?php echo esc_url($author); ?>" data-chrome="nofooter noborders noheader noscrollbar" data-tweet-limit="<?php echo esc_attr($limit); ?>"> <?php echo esc_html($author_name); ?></a>
		</div>
<?php
	}
}
