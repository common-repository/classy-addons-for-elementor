<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \ClassyEa\Helper\Classyea_Module\Settings\Classyea_Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Flip Box Widget
 */
class Classyea_FlipBox extends Widget_Base
{

	/**
	 * Retrieve flipbox widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-flipbox';
	}
	/**
	 * Retrieve flipbox widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Flip Box', 'classyea');
	}
	/**
	 * Retrieve flipbox widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-flip-box';
	}
	public function get_style_depends()
	{
		return [
			'classyea-fontawesome-5to8',
		];
	}

	public function get_script_depends()
	{
		return [
			'classyea-flipbox-js',
		];
	}
	/**
	 * Retrieve flipbox widget category.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea'];
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
			'card',
			'flip card',
			'classy flip card',
			'rotate',
			'flipbox',
			'flip',
			'classy flipbox',
			'classy flip box',
			'box',
			'flip box',

		];
	}

	/**
	 * Register flip box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->classyea_register_content_flipbox_controls();
		$this->classyea_register_repeater_flipbox_controls();
		$this->classyea_register_style_back_controls();
		$this->classyea_register_style_front_controls();
	}
	protected function classyea_register_content_flipbox_controls()
	{

		/**
		 * Content Tab: flipbox
		 */
		$this->start_controls_section(
			'section_flipbox',
			[
				'label' => __('General Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 5; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'flipbox_layout',
			[
				'label'   => esc_html__('Layout', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => esc_html__('Layout 1', 'classyea'),
					'layout-2' => esc_html__('Layout 2', 'classyea'),
					'layout-3' => esc_html__('Layout 3', 'classyea'),
					'layout-4' => esc_html__('Layout 4', 'classyea'),
					'layout-5' => esc_html__('Layout 5', 'classyea'),
					'layout-6' => esc_html__('Layout 6', 'classyea'),
					'layout-7' => esc_html__('Layout 7', 'classyea'),
					'layout-8' => esc_html__('Layout 8', 'classyea'),
					'layout-9' => esc_html__('Layout 9', 'classyea'),
					'layout-10' => esc_html__('Layout 10', 'classyea'),
				],
			]
		);
		
		$this->add_control(
			'link_type',
			[
				'label'   => __('Link Type', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'button',
				'options' => [
					'none'   => __('None', 'classyea'),
					'button' => __('Button', 'classyea'),
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1', 'layout-3','layout-4','layout-5','layout-6','layout-7','layout-8','layout-9','layout-10'
					],
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __('Link', 'classyea'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active'     => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => 'https://www.your-link.com',
				'default'     => [
					'url' => '#',
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1', 'layout-3','layout-4','layout-5','layout-6','layout-7','layout-8','layout-9','layout-10'
					],
				],
			]
		);

		$this->add_control(
			'flipbox_button_text',
			[
				'label'     => __('Button Text', 'classyea'),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => __('Get Started', 'classyea'),
				'condition' => [
					'link_type' => 'button',
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1', 'layout-3','layout-5','layout-6','layout-7','layout-8'
					],
				],
			]
		);

		$this->add_control(
			'cube_icon',
			[
				'label'                 => __('Icon', 'classyea'),
				'type'                  => Controls_Manager::ICONS,
				'default'               => [
					'value'     => 'fas fa-star',
					'library'   => 'fa-solid',
				],
				'condition' => ['flipbox_layout' => 'layout-4']
			]
		);
		$this->add_control(
			'google_map_iframe',
			[
				'label'     => __('Map Iframe', 'classyea'),
				'type'      => Controls_Manager::TEXTAREA,
				'default' => __('<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14709.912151828446!2d89.5403187!3d22.82179695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1647928189082!5m2!1sen!2sbd" allowfullscreen="" loading="lazy"></iframe>','classyea'),
				'condition' => ['flipbox_layout' => 'layout-3']
				
			]
		);

		$this->end_controls_section();
	}
	/***-----------------------------------------------------------------------------------*/
	/*    Repeater TAB
    /****-----------------------------------------------------------------------------------*/
	protected function classyea_register_repeater_flipbox_controls()
	{

		/**
		 * Content Repeater: flipbox
		 */
		$this->start_controls_section(
			'section_flipbox_item',
			[
				'label' => __('Flip Box Front', 'classyea'),
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-2',
						'layout-4',
						'layout-5',
						'layout-6',
						'layout-7',
						'layout-8',
						'layout-9',
						'layout-10',
					],
				],
			]
		);

		$this->add_control(
			'flipbox_front_title',
			[
				'label'       => esc_html__('Front Title', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Front Title', 'classyea'),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-2'
						],
					]
				]
			]
		);

		$this->add_control(
			'flipbox_front_title_tag',
			[
				'label'   => __('Select Front Title Tag', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => __('H1', 'classyea'),
					'h2'   => __('H2', 'classyea'),
					'h3'   => __('H3', 'classyea'),
					'h4'   => __('H4', 'classyea'),
					'h5'   => __('H5', 'classyea'),
					'h6'   => __('H6', 'classyea'),
					'span' => __('Span', 'classyea'),
					'p'    => __('P', 'classyea'),
					'div'  => __('Div', 'classyea'),
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-2'
						],
					]
				]
			]
		);
		$this->add_control(
			'total_follower',
			[
				'label'                 => __('Total Follower', 'classyea'),
				'label_block' => true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('4000', 'classyea'),
				'condition' => ['flipbox_layout' => 'layout-4']
			]
		);
		$this->add_control(
			'description_front',
			[
				'label'       => esc_html__('Front Subtitle/Description', 'classyea'),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => __('This is the front content. Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'classyea'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-6'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-7'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						]
					]
				]
			]
		);
		$this->add_control(
			'pricing_hint',
			[
				'label'                 => __('Pricing Hint', 'classyea'),
				'label_block' => true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('30 day money back', 'classyea'),
				'condition' => ['flipbox_layout' => 'layout-6']
			]
		);
		$this->add_control(
			'front_image',
			[
				'label'     => esc_html__('Front Image', 'classyea'),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-7'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-8'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						]
					]
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-7'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-8'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						]
					]
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_flipbox_box_back',
			[
				'label' => __('Flip Box Back', 'classyea'),
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-2',
						'layout-4',
						'layout-5',
						'layout-6',
					],
				],
			]
		);
		
		$this->add_control(
			'flipbox_back_title',
			[
				'label'       => esc_html__('Back Title/Name', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Back Title', 'classyea'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
			]
		);

		$this->add_control(
			'flipbox_back_title_tag',
			[
				'label'   => __('Select Back Title Tag', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'   => __('H1', 'classyea'),
					'h2'   => __('H2', 'classyea'),
					'h3'   => __('H3', 'classyea'),
					'h4'   => __('H4', 'classyea'),
					'h5'   => __('H5', 'classyea'),
					'h6'   => __('H6', 'classyea'),
					'span' => __('Span', 'classyea'),
					'p'    => __('P', 'classyea'),
					'div'  => __('Div', 'classyea'),
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
			]
		);

		$this->add_control(
			'counter_text',
			[
				'label'       => esc_html__('Back Count Text', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('01', 'classyea'),
				'condition' => [ 'flipbox_layout' => 'layout-5'],
			]
		);
		$this->add_control(
			'pricing_text',
			[
				'label'       => esc_html__('Pricing Text', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('$59.00', 'classyea'),
				'condition' => [ 'flipbox_layout' => 'layout-6'],
			]
		);

		$this->add_control(
			'description_back',
			[
				'label'       => esc_html__('Back Subtitle/Description/Designation', 'classyea'),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => __('This is the front content. Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'classyea'),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
				
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail-back',
				'default'   => 'full',
				'condition' => [
					'font_image[url]!' => '',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'flipbox_pricing_list',
			[
				'label'     => __('Pricing List', 'classyea'),
				'condition' => [
					'flipbox_layout' => 'layout-6'],
			]
		);
		$repeater2 = new Repeater();

		$repeater2->add_control(
			'pricing_list_icon',
			[
				'label' => esc_html__( 'List Icon', 'classyea' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);

		$repeater2->add_control(
			'list_active',
			[
				'label' => esc_html__( 'Active/Unactive', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater2->add_control(
			'pricing_list_text',
			[
				'label'       => esc_html__('Item Text', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('request api integration', 'classyea'),
			]
		);


		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'plugin-name' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'default' => [
					[
						'pricing_list_icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-brands',
						],
					],
					[
						'pricing_list_icon' => [
							'value'   => 'fas fa-check',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '{{{ pricing_list_text }}}',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'flipbox_social',
			[
				'label'     => __('Social Profile', 'classyea'),
				'condition' => [
					'flipbox_layout' => [
						'layout-2'
					],
				],
			]
		);
		$this->add_control(
			'social_item',
			[
				'label'        => __('Display Social Profiles?', 'classyea'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('Show', 'classyea'),
				'label_off'    => __('Hide', 'classyea'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'select_social_icon',
			[
				'label'            => __('Social Icon', 'classyea'),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'social_icon',
				'recommended'      => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'elementor',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'google-plus',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'stumbleupon',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid'  => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label'       => __('Social Link', 'classyea'),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'placeholder' => __('Enter URL', 'classyea'),
			]
		);
		$repeater->add_control(
			'social_select',
			[
				'label'   => __('Social Select', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'phone' => __('Phone', 'classyea'),
					'email' => __('Email', 'classyea'),
					'none'  => __('None', 'classyea'),
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'     => __('Add Social Links', 'classyea'),
				'type'      => Controls_Manager::REPEATER,
				'default'   => [
					[
						'select_social_icon' => [
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
					[
						'select_social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
					[
						'select_social_icon' => [
							'value'   => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
				],
				'fields'    => $repeater->get_controls(),
				'condition' => [
					'social_item' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'flipbox_contact_address',
			[
				'label'     => __('Contact Address', 'classyea'),
				'condition' => [
					'flipbox_layout' => [
						'layout-3'
					],
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'contact_select',
			[
				'label'   => __('Social Select', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'phone' => __('Phone', 'classyea'),
					'email' => __('Email', 'classyea'),
					'none'  => __('None', 'classyea'),
				],
			]
		);
		$repeater->add_control(
			'contact_title',
			[
				'label'                 => __('Contact Title', 'classyea'),
				'label_block' => true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Phone Number', 'classyea'),
			]
		);
		$repeater->add_control(
			'contact_info',
			[
				'label'                 => __('Contact Info', 'classyea'),
				'label_block' => true,
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('786 686 350 36', 'classyea'),
			]
		);
		$repeater->add_control(
			'contact_icon',
			[
				'label'                 => __('Icon', 'classyea'),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility'      => 'counter_icon',
				'default'               => [
					'value'     => 'fas fa-star',
					'library'   => 'fa-solid',
				],
			]
		);
		$this->add_control(
			'add_item',
			[
				'label'     => __('Add Contact', 'classyea'),
				'type'      => Controls_Manager::REPEATER,
				'default'   => [
					[
						'select_social_icon' => [
							'value'   => 'fas fa-phone-volume',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
					[
						'select_social_icon' => [
							'value'   => 'fas fa-envelope-open-text',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
					[
						'select_social_icon' => [
							'value'   => 'fas fa-map-marker-alt',
							'library' => 'fa-brands',
						],
						'social_link'        => [
							'url' => '#',
						],
					],
				],
				'fields'    => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();
	}
	protected function classyea_register_style_front_controls()
	{
		/**
		 * Style Tab: Front
		 */
		$this->start_controls_section(
			'section_wrapper_style',
			[
				'label' => esc_html__('Wrapper Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_field_border',
                'label' => __('Border', 'classyea'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .classyea-flipbox-front.classyea-with-border,{{WRAPPER}} .classyea-flipbox-back,{{WRAPPER}} .classyea-flipbox-front,{{WRAPPER}} .classyea-contact-info-wrap,{{WRAPPER}} .classyea-cube-default-state,{{WRAPPER}} .classyea-cube-active-state,{{WRAPPER}} .classyea-flipbox-inner',
                'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
			'wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classyea' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
                   
					'{{WRAPPER}} .classyea-flipbox-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-flipbox-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-team-block-team-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .team-one-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-contact-info-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-back .map iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-cube-default-state' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-cube-active-state' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'box_height',
            [
                'label' => __('Box Height', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-flipbox-back' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-flipbox-front' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-cube-default-state' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .classyea-cube-active-state' => 'height: {{SIZE}}{{UNIT}}',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						]
					]
				]
            ]
        );
		
		$this->end_controls_section();
		$this->start_controls_section(
			'section_front_style',
			[
				'label' => esc_html__('Front Side Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-2'
						],
						
					]
				]
			]
		);

		$this->add_responsive_control(
			'classyea_container_padding',
			[
				'label'      => esc_html__('Wrapper Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-flipbox-front.classyea-with-border' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} ul.classyea-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} ul.classyea-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-cube-default-state' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-cube-active-state' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-flipbox-front.flipbox-front-six-layout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-flipbox-front' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_front',
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .classyea-flipbox-front,{{WRAPPER}} ul.classyea-contact-info,{{WRAPPER}} .classyea-cube-default-state,{{WRAPPER}} .classyea-flipbox-front',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'classyea_acc_img_overlay_color_front_side',
			[
				'label'     => esc_html__('Overlay Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-front' 	   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} ul.classyea-contact-info'     => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-cube-default-state' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-front'      => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'front_overlay_opacity',
			[
				'label'                 => __( 'Opacity', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => 0,
						'max'   => 1,
						'step'  => 0.1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-front' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} ul.classyea-contact-info' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-cube-default-state' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-flipbox-front' => 'opacity: {{SIZE}};',

				],
			]
		);

		$this->add_control(
			'icon_box_bg_color',
			[
				'label'     => esc_html__('Icon Box Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-3-icon' => 'background-color: {{VALUE}};',

				],
				'condition' => ['flipbox_layout' => 'layout-8']
				
			]
		);
		
		$this->add_control(
			'title_heading_front',
			[
				'label'     => esc_html__('Title', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'flipbox_front_title!' => '',
				],
			]
		);

		$this->add_control(
			'title_color_front',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-title'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-title'      => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-2-title'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-contact-info-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-cube-text'     	   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-3-title'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-video-box-title'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-4-title'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-count-box-one'      => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'flipbox_front_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography_front',
				'selector'  => '{{WRAPPER}} .classyea-icon-box-title,{{WRAPPER}} .classyea-contact-info-title,{{WRAPPER}} .classyea-cube-text,{{WRAPPER}} .classyea-count-box-one,{{WRAPPER}} .classyea-pricing-title,{{WRAPPER}} .classyea-icon-box-2-title,{{WRAPPER}} .classyea-icon-box-3-title,{{WRAPPER}} .classyea-video-box-title,{{WRAPPER}} .classyea-icon-box-4-title',
				'condition' => [
					'flipbox_front_title!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'title_top_spacing_front',
			[
				'label'     => __('Title Top Spacing', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-title'     => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-pricing-title'      => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-front .classyea-contact-info-title' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-2-title'   => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-3-title'   => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-video-box-title'    => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-4-title'   => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-3',
						'layout-6',
						'layout-7',
						'layout-8',
						'layout-9',
						'layout-10',
					],
				],

			]
		);

		$this->add_responsive_control(
			'title_spacing_front',
			[
				'label'     => __('Title Bottom Spacing', 'classyea'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-title'     => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-front .classyea-contact-info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-pricing-title'      => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-2-title'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-3-title'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-video-box-title'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-4-title'    => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-3',
						'layout-6',
						'layout-7',
						'layout-8',
						'layout-9',
						'layout-10',
					],
				],
			]
		);
		
		$this->add_responsive_control(
			'classyea_gallerytitle_container_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-icon-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-cube-default-state' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						
					]
				]
			]
		);
		$this->add_responsive_control(
			'classyea_gallerytitle_container_margin',
			[
				'label'      => esc_html__('Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					'{{WRAPPER}} .classyea-cube-default-state' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						
					]
				]
			]
		);

		$this->add_control(
			'description_heading_front',
			[
				'label'     => esc_html__('Description', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-6'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-7'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
						
					]
				]
			]
		);

		$this->add_control(
			'description_color_front',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-back .classyea-icon-box-text-two' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-contact-info-text a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-cube-text strong' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-2-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-4-desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-contact-info-text' => 'color: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-6'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-7'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
						
					]
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'description_typography_front',
				'selector'  => '{{WRAPPER}} .classyea-icon-box-text-two,{{WRAPPER}} .classyea-contact-info-text a,{{WRAPPER}} .classyea-cube-text strong,{{WRAPPER}} .classyea-pricing-desc,{{WRAPPER}} .classyea-icon-box-2-text,{{WRAPPER}} .classyea-icon-box-4-desc,{{WRAPPER}} .classyea-contact-info-text',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-6'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-7'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
						
					]
				]
			]
		);

		$this->add_control(
			'pricing_list_color',
			[
				'label'     => esc_html__('List Active Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.classyea-pricing-list' => 'color: {{VALUE}};',
				],
				'condition' => ['flipbox_layout' => 'layout-6']

			]
		);
		$this->add_control(
			'pricing_list_unactive_color',
			[
				'label'     => esc_html__('List UnActive Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.classyea-pricing-list .unavailable' => 'color: {{VALUE}};',
				],
				'condition' => ['flipbox_layout' => 'layout-6']

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'pricing_list_typography_front',
				'selector'  => '{{WRAPPER}} ul.classyea-pricing-list',
				'condition' => ['flipbox_layout' => 'layout-6']
			]
		);

		$this->add_control(
			'pricing_hint_color',
			[
				'label'     => esc_html__('Pricing Hint Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-pricing-hint' => 'color: {{VALUE}};',
				],
				'condition' => ['flipbox_layout' => 'layout-6']

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'pricing_hint_typography',
				'selector'  => '{{WRAPPER}} .classyea-pricing-hint',
				'condition' => ['flipbox_layout' => 'layout-6']
			]
		);


		$this->add_control(
			'front_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-front .classyea-contact-info-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-cube-text i' => 'color: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
					]
				]
			]
		);
		$this->add_control(
			'border_background',
			[
				'label'     => esc_html__('Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-cube-text i:after' => 'background-color: {{VALUE}};',

				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
					]
				]
			]
		);
		$this->add_control(
			'list_top_border_color',
			[
				'label'     => esc_html__('List Top Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-pricing-top-content' => 'border-bottom-color: {{VALUE}};',
				],
				'condition' => ['flipbox_layout' => 'layout-6']
			]
		);
		
		$this->end_controls_section();
	}

	protected function classyea_register_style_back_controls()
	{
		/**
		 * Style Tab: Back
		 */
		$this->start_controls_section(
			'classyea_section_back_style',
			[
				'label' => esc_html__('Back Side Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-3'
						],
					]
				]
			]
		);
		

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background_back',
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .classyea-flipbox-back,{{WRAPPER}} .classyea-team-block-team-info,{{WRAPPER}} .classyea-cube-active-state,{{WRAPPER}} .classyea-flipbox-back.style-three,{{WRAPPER}} .classyea-flipbox-back.style-four,{{WRAPPER}} .classyea-flipbox-back',
				'separator' => 'before',
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-3'
						],
					]
				]
			]
		);
		$this->add_responsive_control(
			'classyea_back_container_padding',
			[
				'label'      => esc_html__('Wrapper Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-team-block-team-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
					]
				]
			]
		);
		$this->add_control(
			'classyea_acc_img_overlay_color',
			[
				'label'     => esc_html__('Overlay Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-back' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-block-team-info' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-cube-active-state' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-back.style-three' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-back.style-four' => 'background-color: {{VALUE}};',

				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-3'
						],
					]
				]
			]
		);

		$this->add_control(
			'back_overlay_opacity',
			[
				'label'                 => __( 'Opacity', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'min'   => 0,
						'max'   => 1,
						'step'  => 0.1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-back' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-team-block-team-info' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-cube-active-state' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-flipbox-back.style-three' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-flipbox-back.style-four' => 'opacity: {{SIZE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'border_back',
				'label'     => esc_html__('Border Style', 'classyea'),
				'selector'  => '{{WRAPPER}} .classyea-flipbox-back,{{WRAPPER}} .classyea-team-block-team-info,{{WRAPPER}} .classyea-cube-active-state,{{WRAPPER}} classyea-flipbox-back.style-three,{{WRAPPER}} .classyea-flipbox-back.style-four',
				'separator' => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-6'
						]
					]
				]
			]
		);

		$this->add_control(
			'title_heading_back',
			[
				'label'     => esc_html__('Title', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
				
			]
		);

		$this->add_control(
			'title_color_back',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-title.light'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-block-title'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-cube-text-btn'     => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-count-box-one-title.light'   => 'color: {{VALUE}}!important;',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography_back',
				'selector'  => '{{WRAPPER}} .classyea-icon-box-title.light,{{WRAPPER}} .classyea-team-block-title,{{WRAPPER}} .classyea-cube-text-btn,{{WRAPPER}} .classyea-count-box-one-title.light',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
				
			]
		);

		$this->add_responsive_control(
			'title_spacing_back',
			[
				'label'     => __('Spacing', 'classyea'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-title.light' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-block-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-count-box-one-title.light' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-cube-text-btn' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-4'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-5'
						]
					]
				]
				
			]
		);

		$this->add_control(
			'sub_title_color_back',
			[
				'label'     => esc_html__('Sub Title Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-team-block-designation' => 'color: {{VALUE}};',
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-2',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'sub_title_typography_back',
				'selector'  => '{{WRAPPER}} .classyea-team-block-designation',
				'condition' => [
					'flipbox_layout' => [
						'layout-2',
					],
				],
			]
		);

		$this->add_control(
			'description_heading_back',
			[
				'label'     => esc_html__('Description', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-5',
					],
				],
			]
		);
		$this->add_responsive_control(
			'description_spacing_back',
			[
				'label'     => __('Spacing', 'classyea'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-text-two' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-count-box-one-text-two' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-5',
					],
				],
			]
		);

		$this->add_control(
			'description_color_back',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-text-two' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-count-box-one-text-two' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-back .classyea-icon-box-text-two' => 'color: {{VALUE}};',
					
				],
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-5',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'description_typography_back',
				'selector'  => '{{WRAPPER}} .classyea-icon-box-text-two,{{WRAPPER}} .classyea-count-box-one-text-two,{{WRAPPER}} .classyea-flipbox-back .classyea-icon-box-text-two',
				'condition' => [
					'flipbox_layout' => [
						'layout-1',
						'layout-5',
					],
				],
			]
		);
		$this->add_control(
			'back_icon_hovercolor',
			[
				'label'     => esc_html__('Icon Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-cube-text.light i' => 'color: {{VALUE}};',
					
				],
				'condition' => [
					'flipbox_layout' => 'layout-4'],
			]
		);
		$this->add_control(
			'back_icon_hoverborder_color',
			[
				'label'     => esc_html__('Icon Border Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-cube-text.light i:after' => 'background-color: {{VALUE}};',
					
				],
				'condition' => [
					'flipbox_layout' => 'layout-4'],
			]
		);

		$this->add_control(
			'pricing_color',
			[
				'label'     => esc_html__('Pricing Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-pricing-price' => 'color: {{VALUE}};',
				],
				'condition' => [
					'flipbox_layout' => 'layout-6'],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'pricing_back_typography',
				'selector'  => '{{WRAPPER}} .classyea-pricing-price',
				'condition' => ['flipbox_layout' => 'layout-6'],
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_back_side_button_style',
			[
				'label'     => esc_html__('Back Side Social', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'flipbox_layout' => [
						'layout-2',
					],
				],
			]
		);

		$this->add_control(
			'social_color_back',
			[
				'label'     => esc_html__('Social Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-team-block-social-icon a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-block-social-icon a i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_bordercolor',
			[
				'label'     => esc_html__('Border Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-team-block-social-icon' => 'border-bottom:1px solid {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'social_hovercolor_back',
			[
				'label'     => esc_html__('Social Hover Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-team-block-social-icon a:hover' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-team-block-social-icon a:hover i' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'social_hoverbordercolor',
			[
				'label'     => esc_html__('Border Hover Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-team-block-social-icon a:hover' => 'border-bottom:1px solid {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'classyea_back_side_buttonsocial_style',
			[
				'label'     => esc_html__('Back Side Button', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-2'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-4'
						],
					]
				]
			]
		);
		$this->add_control(
			'button_heading_back',
			[
				'label'     => esc_html__('Button', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography_back',
				'selector'  => '{{WRAPPER}} .classyea-icon-box-btn-two,{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn,{{WRAPPER}} a.classyea-count-box-btn,{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2,{{WRAPPER}} .classyea-icon-box-2-btn-two,{{WRAPPER}} .classyea-flipbox-video-btn a',
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => __('Button Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-icon-box-btn-two,{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn,{{WRAPPER}} .classyea-count-box-one-link-btn-two,{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2,{{WRAPPER}} .classyea-icon-box-2-btn-two,{{WRAPPER}} .classyea-flipbox-video-btn a',
				
			]
		);
		
		$this->add_responsive_control(
			'classyea_gallery_container_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-icon-box-btn-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} a.classyea-count-box-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-9'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '!=',
							'value' => 'layout-10'
						],
					]
				]
			]
		);
		$this->add_control(
			'btn_border_radius',
			[
				'label' => __('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} a.classyea-count-box-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-icon-box-2-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-video-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
			'back_arrow_position_y',
			[
				'label' => __( 'Vertical', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn i' => 'top: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			]
		);
		
		$this->add_responsive_control(
			'back_arrow_position_yfffff',
			[
				'label' => __( 'Horizontal', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn i' => 'left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			]
		);
		$this->add_responsive_control(
            'video_button_width',
            [
                'label' => __('Video Btn Width', 'classyea'),
				'separator' => 'before',
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-flipbox-video-btn a' => 'width: {{SIZE}}{{UNIT}}!important',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
					]
				]
            ]
        );
		$this->add_responsive_control(
            'video_button_height',
            [
                'label' => __('Video Btn Height', 'classyea'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 1,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-flipbox-video-btn a' => 'height: {{SIZE}}{{UNIT}}!important',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-9'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-10'
						],
					]
				]
            ]
        );
		$this->start_controls_tabs( '_tabs_dots' );
		$this->start_controls_tab(
			'classyea_tab_dots_normal_button',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_links_bg_color',
				'label' => esc_html__( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .classyea-icon-box-btn-two,{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn,{{WRAPPER}} .classyea-count-box-btn,{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2,{{WRAPPER}} .classyea-icon-box-2-btn-two,{{WRAPPER}} .classyea-flipbox-video-btn a',
			]
		);
		$this->add_control(
			'button_color_back',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-two' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} a.classyea-count-box-btn' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-icon-box-2-btn-two' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-flipbox-video-btn a' => 'color: {{VALUE}}!important;',
					
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'classyea_tab_dots_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
			'button_links_bg_hover_color',
			[
				'label'     => __('Background', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-two:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} a.classyea-count-box-btn:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-icon-box-2-btn-two:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-video-btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_color_hover_back',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-two:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-back a.classyea-contact-info-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} a.classyea-count-box-btn:hover' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-pricing-link-btn a.classyea-pricing-btn-2:hover' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-icon-box-2-btn-two:hover' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-flipbox-video-btn a:hover' => 'color: {{VALUE}}!important;',
					
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'classyea_front_side_buttonsocial_style',
			[
				'label'     => esc_html__('Front Side Button', 'classyea'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-1'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-6'
						],
					]
				]
			]
		);
		$this->add_control(
			'front_button_heading_back',
			[
				'label'     => esc_html__('Button', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'front_button_typography_back',
				'selector'  => '{{WRAPPER}} .classyea-icon-box-btn-one,{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn,{{WRAPPER}} .classyea-pricing-btn',
				
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'front_button_border',
				'label'       => __('Button Border', 'classyea'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .classyea-icon-box-btn-one,{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn,{{WRAPPER}} .classyea-pricing-btn',
				
				
			]
		);
		
		$this->add_responsive_control(
			'front_classyea_gallery_container_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-icon-box-btn-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-pricing-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'front_btn_border_radius',
			[
				'label' => __('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-pricing-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_position_y',
			[
				'label' => __( 'Vertical', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn i' => 'top: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			]
		);
		
		$this->add_responsive_control(
			'arrow_position_yfffff',
			[
				'label' => __( 'Horizontal', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 500,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn i' => 'left: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'flipbox_layout',
							'operator' => '==',
							'value' => 'layout-3'
						],
					]
				]
			]
		);
		$this->start_controls_tabs( '_tabs_dots_front' );
		$this->start_controls_tab(
			'front_classyea_tab_dots_normal_button',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		$this->add_control(
			'front_button_links_bg_color',
			[
				'label'     => __('Background', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-one' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'front_button_color_back',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-one' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-btn' => 'color: {{VALUE}};',
					
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'front_classyea_tab_dots_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
			'front_button_links_bg_hover_color',
			[
				'label'     => __('Background', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-one:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'front_button_color_hover_back',
			[
				'label'     => esc_html__('Color', 'classyea'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .classyea-icon-box-btn-one:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-flipbox-front a.classyea-contact-info-btn:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-pricing-btn:hover' => 'color: {{VALUE}};',
					
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render()
	{
		
		$this->classyea_flip_box_repeater_control();
		
	}
	/**
	 * Flip box repeater control function
	 * Render flip box output on the frontend.
	 * @access protected
	 */
	private function classyea_flip_box_repeater_control()
	{
		$settings       = $this->get_settings_for_display();
		$flipbox_layout = $settings['flipbox_layout'];
		
		$flipbox_front_title = $settings['flipbox_front_title'];
		$description_front   = $settings['description_front'];
		$flipbox_back_title  = $settings['flipbox_back_title'];
		$description_back    = $settings['description_back'];
		

		$this->add_render_attribute('description_front', 'class', 'classyea-icon-box-text');
		$this->add_inline_editing_attributes('description_front', 'classyea_desc_kses');

		switch ( $flipbox_layout ) {
			case 'layout-1':
				$btn_class 	 = 'classyea-icon-box-btn-two';
				break;
			case 'layout-3':
				$btn_class = 'classyea-contact-info-btn';
				break;
			case 'layout-4':
				$btn_class    = 'classyea-cube-text-btn';
				break;
			case 'layout-5':
				$btn_class = 'classyea-count-box-btn';
				break;
			case 'layout-6':
				$btn_class    = 'classyea-pricing-btn';
				break;
			case 'layout-7':
				$btn_class    = 'classyea-icon-box-2-btn-two';
				break;	
			case 'layout-8':
				$btn_class    = 'classyea-icon-box-2-btn-two';
				break;	
			case 'layout-9':
				$btn_class    = 'overlay-link play-now ripple';
				break;
				
			default:
				$btn_class = '';
		}

		if ($flipbox_layout == 'layout-1' || $flipbox_layout == 'layout-3' || $flipbox_layout == 'layout-4' || $flipbox_layout == 'layout-5' || $flipbox_layout == 'layout-6' || $flipbox_layout == 'layout-7' || $flipbox_layout == 'layout-8' || $flipbox_layout == 'layout-9' || $flipbox_layout == 'layout-10') {
			if ('none' !== $settings['link_type']) {
				if (!empty($settings['link']['url'])) {
					
					if ('button' === $settings['link_type']) {

						$this->add_render_attribute('button', 'class', [$btn_class]);

						$this->add_link_attributes('button', $settings['link']);
					}
				}
			}
		}

		$add_item = $settings['add_item'];

		if ($flipbox_layout == 'layout-1') {
			if ($flipbox_front_title || $flipbox_back_title) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-icon-box-title');
				$this->add_inline_editing_attributes('flipbox_back_title', 'none');
				$this->add_render_attribute('flipbox_back_title', 'class', 'classyea-icon-box-title light');
			}
		?>
			<div class="classyea-flipbox">
				<div class="classyea-flipbox-inner">
					<div class="classyea-flipbox-front classyea-with-border">
						<?php
						if ($flipbox_layout == 'layout-1') {
							if (!empty($settings['front_image']['url'])) : ?>
								<div class="classyea-icon-box-icon"><?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'front_image'), 'classyea_img'); ?></div>
						<?php endif;
						} ?>
						<?php
							$this->classyea_front_title_tag($settings);
						?>
						<div <?php echo wp_kses_post($this->get_render_attribute_string('description_front')); ?>><?php echo wp_kses($description_front, 'classyea_kses'); ?></div>
						<?php if ($flipbox_layout == 'layout-1') {
							if ('button' === $settings['link_type']) { ?>
								<div class="classyea-icon-box-link-btn"><a href="<?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>" class="classyea-icon-box-btn-one"><i class="fas fa-arrow-right"></i></a></div>
						<?php }
						} ?>
					</div>
					<div class="classyea-flipbox-back">
						<?php $this->classyea_back_title_tag( $settings ); ?>
						<div class="classyea-icon-box-text-two"><?php echo wp_kses($description_back, 'classyea_kses'); ?></div>
						<?php if ($flipbox_layout == 'layout-1') {
							if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
								<div class="classyea-icon-box-link-btn-two"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?><i class="fas fa-arrow-right"></i></a></div>
						<?php }
						} ?>
					</div>
				</div>
			</div>
		<?php
			// layout 1 endif
		} elseif ($flipbox_layout == 'layout-2') { 
			$this->add_inline_editing_attributes('flipbox_back_title', 'none');
			$this->add_render_attribute('flipbox_back_title', 'class', 'classyea-team-block-title');
			?>
		<div class="classyea-flipbox">
			<div class="classyea-flipbox-inner">
				<div class="classyea-flipbox-front">
					<div class="team-one-image">
					<?php
						if (!empty($settings['front_image']['url'])) : ?>
							<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'front_image'), 'classyea_img'); ?>
						<?php endif;
						?>
					</div>
				</div>
				<div class="classyea-flipbox-back">
					<div class="classyea-team-block-team-info">
						<div class="classyea-team-block-top-content">
							<div class="classyea-team-block-designation"><?php echo wp_kses($description_back, 'classyea_kses'); ?></div>
							<?php $this->classyea_back_title_tag( $settings ); ?>
						</div>
						<?php if ($settings['social_item']) :
							$this->classyea_flipbox_social_links(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>  
		<?php } elseif($flipbox_layout == 'layout-3') { 
			$google_map_iframe  = $settings['google_map_iframe'];
			?>
		
		<div class="classyea-flipbox">
			<div class="classyea-flipbox-inner">
				<div class="classyea-flipbox-front">
					<div class="classyea-contact-info-wrap">
						<ul class="classyea-contact-info">
						<?php
						$i = 1;
						foreach ($add_item as $index => $item) { 
							$contact_select = $item['contact_select'];
							$contact_title  = $item['contact_title'];
							$contact_info   = $item['contact_info'];

						if ('email' === $contact_select) {
						?>
							<li>
								<div class="classyea-contact-info-icon"><?php Icons_Manager::render_icon($item['contact_icon'], array('aria-hidden' => 'true'));?></div>
								<h5 class="classyea-contact-info-title"><?php echo wp_kses($contact_title,'classyea_kses'); ?></h5>
								<div class="classyea-contact-info-text"><a href="mailto:<?php echo esc_attr($contact_info); ?>"><?php echo wp_kses($contact_info,'classyea_kses'); ?></a></div>
							</li>
							<?php
							} elseif ('phone' === $contact_select) {
							?>
								<li>
									<div class="classyea-contact-info-icon"><?php Icons_Manager::render_icon($item['contact_icon'], array('aria-hidden' => 'true'));?></div>
									<h5 class="classyea-contact-info-title"><?php echo wp_kses($contact_title,'classyea_kses'); ?></h5>
									<div class="classyea-contact-info-text"><a href="tel:<?php echo esc_attr($contact_info); ?>"><?php echo wp_kses($contact_info,'classyea_kses'); ?></a></div>
								</li>
							<?php } else { ?>
								<li>
									<div class="classyea-contact-info-icon"><?php Icons_Manager::render_icon($item['contact_icon'], array('aria-hidden' => 'true'));?></div>
									<h5 class="classyea-contact-info-title"><?php echo wp_kses($contact_title,'classyea_kses'); ?></h5>
									<div class="classyea-contact-info-text"><?php echo wp_kses($contact_info,'classyea_kses'); ?></div>
								</li>
							<?php } ?>
						<?php } ?>
						</ul>
						<?php if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
						<div class="classyea-contact-info-link-btn"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?> class="classyea-contact-info-btn"><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?> <i class="fas fa-arrow-right"></i></a></div>
						<?php } ?>
					</div>
				</div>
				<div class="classyea-flipbox-back style-two">
					<div class="classyea-contact-info">
						<div class="map">
							<?php 
								if($google_map_iframe != '') {
									echo wp_kses_post($google_map_iframe);
								} else {
									echo "<div class='map-iframe' style='padding-top:5px;padding-bottom:50px;color:red;'>".esc_html__('Please Input the map iframe','classyea')."</div>";
								}
							?>
						</div>
							<?php if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
						<div class="classyea-contact-info-link-btn"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?> class="classyea-contact-info-btn"><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?> <i class="fas fa-arrow-right"></i></a></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>    
		<?php } elseif ($flipbox_layout == 'layout-4') { 
			$cube_icon 		= $settings['cube_icon'];
			$total_follower = $settings['total_follower'];
			
			?>
		<div class="classyea-cube">
			<div class="classyea-cube-active-state">
				<?php 
					if ($flipbox_layout == 'layout-4') {
						if ('button' === $settings['link_type']) { ?>
				<p class="classyea-cube-text light"><?php Icons_Manager::render_icon($cube_icon, array('aria-hidden' => 'true'));?> </p> 
				<a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_back_title'], 'classyea_kses'); ?> <i class="fas fa-arrow-right"></i></a>
				<?php } } ?>
			</div>
			<div class="classyea-cube-default-state">
				<p class="classyea-cube-text"><?php Icons_Manager::render_icon( $cube_icon, array('aria-hidden' => 'true'));?> <strong><?php echo esc_html($total_follower);?></strong> <?php echo wp_kses($settings['flipbox_front_title'], 'classyea_kses'); ?></p>                                
			</div>
		</div>
		<?php }
		elseif ($flipbox_layout == 'layout-5') { 
			$this->add_inline_editing_attributes('flipbox_back_title', 'none');
			$this->add_render_attribute('flipbox_back_title', 'class', 'classyea-count-box-one-title light');
			if ($flipbox_front_title ) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-count-box-one');
			}

			?>
		<div class="classyea-flipbox">
			<div class="classyea-flipbox-inner">
				<div class="classyea-flipbox-front classyea-with-border">
					<?php
						$this->classyea_front_title_tag($settings);
					?>
				</div>
				<div class="classyea-flipbox-back style-three">
				<?php $this->classyea_back_title_tag( $settings ); ?>
					<div class="classyea-count-box-one-text-two"><?php echo wp_kses($description_back, 'classyea_kses'); ?></div>
				<?php 
					if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
					<div class="classyea-count-box-one-link-btn-two"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?> </a></div>
				<?php } ?>
				</div>
			</div>
		</div>  
		<?php }
		elseif ($flipbox_layout == 'layout-6') { 
			if ($flipbox_front_title ) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-pricing-title');
			}
			$pricing_hint = $settings['pricing_hint'];
			$pricing_text = $settings['pricing_text'];
			
			?>
		<div class="classyea-flipbox">
			<div class="classyea-flipbox-inner">
				<div class="classyea-flipbox-front flipbox-front-six-layout">
					<div class="classyea-pricing-content-wrap">
						<div class="classyea-pricing-top-content">
							<?php
								$this->classyea_front_title_tag($settings);
							?>
							<div class="classyea-pricing-desc"><?php echo wp_kses($description_front, 'classyea_kses'); ?></div>
								<?php 
					if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
							<div class="classyea-pricing-link-btn"><a  <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?></a></div>
					<?php } ?>
						</div>
						<div class="classyea-pricing-bottom-content">
							<?php $this->classyea_pricing_items($settings); ?>
							<div class="classyea-pricing-hint"><?php echo wp_kses($pricing_hint, 'classyea_kses'); ?> </div>
						</div>
					</div>
				</div>
				<div class="classyea-flipbox-back style-four">
					<div class="classyea-pricing-price"><?php echo wp_kses($pricing_text,'classyea_kses');?></div>
					<?php 
					if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
					<div class="classyea-pricing-link-btn"><a class="classyea-pricing-btn-2" <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?></a></div>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php }
		elseif($flipbox_layout == 'layout-7') { 
			if ($flipbox_front_title ) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-icon-box-2-title');
			}
			?> 
		 <!-- flipbox Style 07 -->
			<div class="classyea-flipbox">
				<div class="classyea-flipbox-inner">
					<div class="classyea-flipbox-front classyea-with-border">
						<div class="classyea-icon-box-2">
							<div class="classyea-icon-box-2-icon">
							<?php
							if (!empty($settings['front_image']['url'])) : ?>
								<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'front_image'), 'classyea_img'); ?>
							<?php endif; ?>
							</div>
							<?php
								$this->classyea_front_title_tag($settings);
							?>
							<div class="classyea-icon-box-2-text"><?php echo wp_kses($description_front, 'classyea_kses'); ?></div>
						</div>
					</div>
					<?php 
					if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
					<div class="classyea-flipbox-back">
						<div class="classyea-icon-box-2-link-btn-two"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?> <i class="fas fa-arrow-right"></i></a></div>
					</div>
					<?php } ?>
				</div>
			</div>
                    
		<?php }
		elseif($flipbox_layout == 'layout-8') { 
			if ($flipbox_front_title ) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-icon-box-3-title');
			}
			?>
			<div class="classyea-flipbox">
				<div class="classyea-flipbox-inner">
					<div class="classyea-flipbox-front">
						<div class="classyea-icon-box-3">
							<div class="classyea-icon-box-3-icon">
								<?php
							if (!empty($settings['front_image']['url'])) : ?>
								<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'front_image'), 'classyea_img'); ?>
							<?php endif; ?>
						</div>
						<?php
							$this->classyea_front_title_tag($settings);
						?>
						</div>
					</div>
					<?php 
					if ('button' === $settings['link_type'] && !empty($settings['flipbox_button_text'])) { ?>
					<div class="classyea-flipbox-back">
						<div class="classyea-icon-box-3-link-btn-two"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['flipbox_button_text'], 'classyea_kses'); ?> </a></div>
					</div>
					<?php } ?>
				</div>
			</div>
		<?php } elseif($flipbox_layout == 'layout-9') { 
			if ($flipbox_front_title ) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-video-box-title');
			}
			?> 
		<div class="classyea-flipbox">
			<div class="classyea-flipbox-inner">
				<div class="classyea-flipbox-front">
					<div class="classyea-video-box">
					<?php
						$this->classyea_front_title_tag($settings);
					?>
					</div>
				</div>
				<div class="classyea-flipbox-back">
				<?php 
					if ('button' === $settings['link_type']) { ?>
					<div class="classyea-flipbox-video-box">
						<div class="classyea-flipbox-video-btn"><a  <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>  data-fancybox="gallery" data-caption=""><i class="fas fa-play"></i></a></div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } elseif($flipbox_layout == 'layout-10') { 
			if ($flipbox_front_title ) {
				$this->add_inline_editing_attributes('flipbox_front_title', 'none');
				$this->add_render_attribute('flipbox_front_title', 'class', 'classyea-icon-box-4-title');
			}
			?>
			<div class="classyea-flipbox">
				<div class="classyea-flipbox-inner">
					<div class="classyea-flipbox-front">
						<div class="classyea-icon-box-4">
							<div class="classyea-icon-box-4-icon">
								<?php
								if (!empty($settings['front_image']['url'])) : ?>
									<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'front_image'), 'classyea_img'); ?>
								<?php endif; ?>
							</div>
							<?php
								$this->classyea_front_title_tag($settings);
							?>
							<div class="classyea-icon-box-4-desc"><?php echo wp_kses($description_front, 'classyea_kses'); ?></div>
						</div>
					</div>
					<div class="classyea-flipbox-back">
					<?php 
					if ('button' === $settings['link_type']) { ?>
						<div class="classyea-flipbox-video-box">
							<div class="classyea-flipbox-video-btn"><a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?> data-fancybox="gallery" data-caption=""><i class="fas fa-play"></i></a></div>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>       
		<?php } 
	}
	/**
	 * Flip box social link function
	 * Render flip box output on the frontend.
	 * @access protected
	 */
	protected function classyea_flipbox_social_links()
	{
		$settings          = $this->get_settings_for_display();
		$fallback_defaults = [
			'fa fa-facebook',
			'fa fa-twitter',
			'fa fa-google-plus',
		];

		$migration_allowed = Icons_Manager::is_migration_allowed();

		?>

		<div class="classyea-team-block-bottom-content">
			<ul class="classyea-team-block-social-icon">
			<?php
			$i = 1;
			foreach ($settings['items'] as $index => $item) {
				$social_select = $item['social_select'];

				// add old default
				if (!isset($item['icon']) && !$migration_allowed) {
					$item['icon'] = isset($fallback_defaults[$index]) ? $fallback_defaults[$index] : 'fa fa-check';
				}

				$migrated = isset($item['__fa4_migrated']['select_social_icon']);
				$is_new   = !isset($item['icon']) && $migration_allowed;

				$migrated = isset($item['__fa4_migrated']['select_social_icon']);
				$is_new   = empty($item['social_icon']) && $migration_allowed;
				$social   = '';

				// add old default
				if (empty($item['social_icon']) && !$migration_allowed) {
					$item['social_icon'] = isset($fallback_defaults[$index]) ? $fallback_defaults[$index] : 'fa fa-wordpress';
				}

				if (!empty($item['social_icon'])) {
					$social = str_replace('fa fa-', '', $item['social_icon']);
				}

				if (($is_new || $migrated) && 'svg' !== $item['select_social_icon']['library']) {
					$social = explode(' ', $item['select_social_icon']['value'], 2);
					if (empty($social[1])) {
						$social = '';
					} else {
						$social = str_replace('fa-', '', $social[1]);
					}
				}
				if ('svg' === $item['select_social_icon']['library']) {
					$social = '';
				}

				$this->add_render_attribute('social-link', 'class', 'classyea-tm-social-link');
				$social_link_key = 'social-link' . $i;
				if (!empty($item['social_link']['url'])) {
					$this->add_link_attributes($social_link_key, $item['social_link']);
				}

				if ('email' === $social_select) {
			?>
					<li><a href="mailto:<?php echo esc_attr($item['social_link']['url']); ?>">
						<?php
						if ($is_new || $migrated) {
							Icons_Manager::render_icon($item['select_social_icon'], array('aria-hidden' => 'true'));
						} else {
						?>
							<i class="<?php echo esc_attr($item['social_icon']); ?>"></i>
						<?php } ?>
					</a></li>
				<?php
				} elseif ('phone' === $social_select) {
				?>
					<li><a href="tel:<?php echo esc_attr($item['social_link']['url']); ?>">
						<?php
						if ($is_new || $migrated) {
							Icons_Manager::render_icon($item['select_social_icon'], array('aria-hidden' => 'true'));
						} else {
						?>
							<i class="<?php echo esc_attr($item['social_icon']); ?>"></i>
						<?php } ?>
					</a></li>
				<?php
				} else {
				?>
					<li><a <?php echo wp_kses_post($this->get_render_attribute_string($social_link_key)); ?>>
						<?php
						if ($is_new || $migrated) {
							Icons_Manager::render_icon($item['select_social_icon'], array('aria-hidden' => 'true'));
						} else {
						?>
							<i class="<?php echo esc_attr($item['social_icon']); ?>"></i>
						<?php } ?>
					</a></li>
			<?php
				}
				$i++;
			}
			?>
		</ul>
		</div>
<?php
	}

	protected function classyea_pricing_items($settings)
	{ 
			$pricing_item = $settings['list'];
			foreach ($pricing_item as $item) {
				$pricing_list_text = $item['pricing_list_text'];
				$listicon 		   = $item['pricing_list_icon'];
				$list_active = ($item['list_active']) ? '' : 'unavailable';

		?>
		<ul class="classyea-pricing-list">
			<li class="<?php echo esc_attr($list_active);?>"><?php echo wp_kses($pricing_list_text,'classyea_kses');?> 
					<i class="<?php echo esc_attr($listicon['value']); ?>"></i>
		</li>
		</ul>

	<?php
		}
	}

	protected function classyea_front_title_tag($settings) {
		
		if ($settings['flipbox_front_title']) {
			$flipbox_front_title_tag = Classyea_Helper::classyea_validate_html_tag($settings['flipbox_front_title_tag']);
		?>
			<<?php echo esc_html($flipbox_front_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('flipbox_front_title')); ?>>
				<?php echo wp_kses($settings['flipbox_front_title'], 'classyea_kses'); ?>
			</<?php echo esc_html($flipbox_front_title_tag); ?>>
		<?php } 
	}

	protected function classyea_back_title_tag( $settings ) {
		
		if ($settings['flipbox_back_title']) {
			$flipbox_back_title_tag = Classyea_Helper::classyea_validate_html_tag($settings['flipbox_back_title_tag']);
		?>
			<<?php echo esc_html($flipbox_back_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('flipbox_back_title')); ?>>
				<?php echo wp_kses($settings['flipbox_back_title'], 'classyea_kses'); ?>
			</<?php echo esc_html($flipbox_back_title_tag); ?>>
		<?php } 
	}
}
