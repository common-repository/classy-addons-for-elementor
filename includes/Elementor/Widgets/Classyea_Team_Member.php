<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Image_Size;
use \ClassyEa\Helper\Elementor\Settings\Header;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
use \Elementor\Core\Schemes\Typography as Scheme_Typography;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Team Member Widget
 */
class Classyea_Team_Member extends Widget_Base
{

	/**
	 * Retrieve team_member widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-team-member';
	}
	/**
	 * Retrieve team_member widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Team Member', 'classyea');
	}
	/**
	 * Retrieve team_member widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-team';
	}
	/**
	 * Retrieve team_member widget category.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea'];
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	
	/**
	 * Get widget keywords.
	 * widget keywords of the belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return [
			'team member',
			'team member',
			'classy team members',
			'person',
			'card',
			'team',
			'member',
			'classyea',
			'classyea addons',
			'meet the team',
			'team builder',
			'our team',

		];
	}
	/**
	 * Register team member widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.3
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_team_member_controls();
		$this->register_repeater_team_member_controls();

		/* Style Tab */
		$this->register_style_background_controls();
		$this->register_team_style_controls();
		$this->register_style_position_controls();
		$this->register_classyea_style_description_controls();
		$this->register_classyea_style_social_links_controls();
		$this->register_style_team_overlay_controls();
	}
	protected function register_content_team_member_controls()
	{

		/**
		 * Content Tab: team_member
		 */
		$this->start_controls_section(
			'section_team_member',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 6; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'team_member_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);
		$this->add_control(
			'team_member_name_tag',
			[
				'label'   => __('Select Name Title Tag', 'classyea'),
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
				]
			]
		);
		$this->add_control(
			'team_member_position_tag',
			[
				'label'   => __('Select Position Title Tag', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'p',
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
				]
			]
		);
		$this->end_controls_section();
	}
	/**
	*	Repeater TAB
	**/
	protected function register_repeater_team_member_controls()
	{

		/**
		 * Content Repeater: team_member
		 */
		$this->start_controls_section(
			'section_team_member_item',
			[
				'label'                 => __('Team Member Details', 'classyea'),
			]
		);

		$this->add_control(
			'team_member_name',
			[
				'label'       => esc_html__('Name', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Jhony Kimmer', 'classyea'),
			]
		);
		$this->add_control(
			'team_member_position',
			[
				'label'                 => esc_html__('Designation', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => __('Team Lead Dev', 'classyea'),
			]
		);
		$this->add_control(
			'team_phone_no',
			[
				'label'                 => esc_html__('Phone Number', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => __('+1 (234) 501 8607', 'classyea'),
			]
		);
		$this->add_control(
			'team_phone_icon',
			[
				'label'                 => __('Phone Icon', 'classyea'),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility'      => 'social_icon',
				'default'     			=>  [
					'value' => 'fas fa-phone-alt',
					'library' => 'fa-brands',
				],
			]
		);
		$this->add_control(
			'team_email',
			[
				'label'                 => esc_html__('Email', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'label_block'           => true,
				'default'               => __('classy@gmail.com', 'classyea'),
			]
		);
		$this->add_control(
			'team_email_icon',
			[
				'label'                 => __('Email Icon', 'classyea'),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility'      => 'social_icon',
				'default'     			=>  [
					'value' => 'far fa-envelope',
					'library' => 'fa-brands',
				],
			]
		);
		$this->add_control(
			'team_member_content',
			[
				'label'                 => esc_html__('Content', 'classyea'),
				'type'                  => Controls_Manager::TEXTAREA,
				'label_block'           => true,
				'default'               => __('Lorem ipsum, dolor sit amet consectetur adipisicing', 'classyea'),
			]
		);
		$this->add_control(
			'team_member_image',
			[
				'label'                 => esc_html__('Author Avatar Image', 'classyea'),
				'type'                  => Controls_Manager::MEDIA,
				'default'               => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'team_member_image[url]!' => '',
				]
			]
		);
		$this->add_control(
			'link_type',
			array(
				'label'   => __('Link Type', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'  => __('None', 'classyea'),
					'image' => __('Image', 'classyea'),
					'title' => __('Title', 'classyea'),
				)
			)
		);

		$this->add_control(
			'link',
			[
				'label'                 => __('Link', 'classyea'),
				'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'        => true,
					'categories'    => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder'           => 'https://www.your-link.com',
				'default'               => [
					'url' => '#',
				],
				'condition'             => [
					'link_type!'   => 'none',
				]
			]
		);

		$this->add_control(
			'team_member_button_text',
			[
				'label'                 => __('Button Text', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => __('Get Started', 'classyea'),
				'condition'             => [
					'link_type'   => 'button',
				]
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_team_member_social',
			[
				'label'                 => __('Social Links', 'classyea'),
			]
		);
		$this->add_control(
			'member_social_links',
			[
				'label'                 => __('Show Social Links', 'classyea'),
				'type'                  => Controls_Manager::SWITCHER,
				'default'               => 'yes',
				'label_on'              => __('Yes', 'classyea'),
				'label_off'             => __('No', 'classyea'),
				'return_value'          => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'select_social_icon',
			[
				'label'                 => __('Social Icon', 'classyea'),
				'type'                  => Controls_Manager::ICONS,
				'fa4compatibility'      => 'social_icon',
				'recommended' => [
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
					'fa-solid' => [
						'envelope',
						'link',
						'rss',
					]
				]
			]
		);

		$repeater->add_control(
			'social_link',
			[
				'label'                 => __('Social Link', 'classyea'),
				'type'                  => Controls_Manager::URL,
				'dynamic'               => [
					'active'  => true,
				],
				'label_block'           => true,
				'placeholder'           => __('Enter URL', 'classyea'),
			]
		);

		$this->add_control(
			'team_member_social',
			[
				'label'                 => __('Add Social Links', 'classyea'),
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					[
						'select_social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
						'social_link' => [
							'url' => '#',
						]
					],
					[
						'select_social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
						'social_link' => [
							'url' => '#',
						]
					],
					[
						'select_social_icon' => [
							'value' => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
						'social_link' => [
							'url' => '#',
						]
					]
				],
				'fields'                => $repeater->get_controls(),
				'condition'             => [
					'member_social_links' => 'yes',
				]
			]
		);
		$this->end_controls_section();
	}
	/** 
	 * Background TAB
	 * */
	protected function register_style_background_controls()
	{

		$this->start_controls_section(
			'classyea_section_team_member_style_settings',
			[
				'label' => esc_html__('Background', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
						'layout-2',
						'layout-3',
						'layout-4',
					]
				]
			]
		);
		$this->add_control(
			'background_heading',
			[
				'label'     => __('Background', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'content_background',
				'label'                 => __( 'Background', 'classyea' ),
				'types'                 => [ 'classic', 'gradient' ],
				'separator'             => 'before',
				'selector'              => '{{WRAPPER}} .classyea-team-box-251 .classyea-team-text,{{WRAPPER}} .classyea-team-box-252,{{WRAPPER}} .classyea-team-box-253,{{WRAPPER}} .classyea-team-item-254 .classyea-team-text ,{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content,{{WRAPPER}} .classyea-team-256 .classyea-team:before',
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
						'layout-2',
						'layout-3',
						'layout-4',
					]
				]
			]
		);
		$this->end_controls_section();
	}
	protected function register_team_style_controls(){
		$this->start_controls_section(
			'section_content_style',
			[
				'label'                 => __( 'Team Content', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
						'layout-2',
						'layout-3',
						'layout-4',
					]
				]
			]
		);
		$this->add_control(
            'content_background_tema_color',
            [
                'label'     => esc_html__( 'Background', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .classyea-team-box-251 .classyea-team-text' => 'background-color: {{VALUE}};',
				],
				'condition'             => [
					'team_member_layout'    => 'layout-1',
				]
            ]
        );

		$this->add_responsive_control(
			'team_content_alignment',
			[
				'label'                 => __( 'Content Alignment', 'classyea' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'classyea' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'classyea' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'classyea' ),
						'icon'  => 'eicon-h-align-right',
					]
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-item-254' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-253' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-text' => 'text-align: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-text' => 'text-align: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social' => 'text-align: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-bio' => 'text-align: {{VALUE}}!important;',
				]
			]
		);
		$this->add_responsive_control(
			'arrow_position_xx',
			[
				'label' => __( 'Line Position', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 2000,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-text .classyea-team-desig:before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'team_member_layout' => 'layout-1'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'team_member_content_border',
				'label'                 => __( 'Border', 'classyea' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'separator'             => 'before',
				'selector'              => '{{WRAPPER}} .classyea-team-box-251,{{WRAPPER}} .classyea-team-item-254,{{WRAPPER}} .classyea-team-box-252,{{WRAPPER}} .classyea-team-box-253,{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content,{{WRAPPER}} .classyea-team-256',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'team_content_box_shadow',
				'selector'              => '{{WRAPPER}} .classyea-team-box-251,{{WRAPPER}} .classyea-team-item-254,{{WRAPPER}} .classyea-team-box-252,{{WRAPPER}} .classyea-team-box-253,{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content,{{WRAPPER}} .classyea-team-256',
			]
		);

		$this->add_responsive_control(
			'team_member_box_content_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-overly-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-253' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-256' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'team_member_box_contentsocial_link_margin',
			[
				'label'                 => __( 'Phone Social Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => ['team_member_layout' => 'layout-2']
			]
		);

		

		$this->add_responsive_control(
			'team_member_box_content_padding',
			[
				'label'                 => __( 'Padding', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-252' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-253' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-256' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_member_image_style',
			[
				'label'                 => __( 'Team Image', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'team_member_image_border',
				'label'                 => __( 'Border', 'classyea' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .classyea-team-image img,{{WRAPPER}} .classyea-team-img img',
			]
		);

		$this->add_control(
			'team_member_image_border_radius',
			[
				'label'                 => __( 'Border Radius', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-image img,{{{WRAPPER}} .classyea-team-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_member_name_style',
			[
				'label'                 => __( 'Name', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_background_heading',
			[
				'label'     => __('Content Background', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => ['team_member_layout' => 'layout-6'],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'member_name_typography',
				'label'                 => __( 'Typography', 'classyea' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
				'selector'              => '{{WRAPPER}} .classyea-team-name',
			]
		);

		$this->add_control(
			'member_name_text_color',
			[
				'label'                 => __( 'Text Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-name' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'member_content_text_color',
			[
				'label'                 => __( 'Content Hover Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251:hover .classyea-team-text *' => 'color: {{VALUE}}!important',
				],
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
					]
				]
			]
		);

		$this->add_responsive_control(
			'member_name_margin',
			[
				'label'                 => __( 'Margin Bottom', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}
	protected function register_style_position_controls() {

		$this->start_controls_section(
			'section_member_position_style',
			[
				'label'                 => __( 'Position', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'member_position_typography',
				'label'                 => __( 'Typography', 'classyea' ),
				'scheme'                => Scheme_Typography::TYPOGRAPHY_3,
				'selector'              => '{{WRAPPER}} .classyea-team-desig',
			]
		);

		$this->add_control(
			'member_position_text_color',
			[
				'label'                 => __( 'Text Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-desig' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'member_position_margin',
			[
				'label'                 => __( 'Margin Bottom', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-desig' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'team_line_color',
			[
				'label'                 => __( 'Line Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-text p.classyea-team-desig:before' => 'background-color: {{VALUE}}!important',
				],
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
					]
				]
			]
		);
		
		$this->end_controls_section();
	}
	protected function register_classyea_style_description_controls() {

		$this->start_controls_section(
			'section_member_description_style',
			[
				'label'                 => __( 'Description', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'member_description_typography',
				'label'                 => __( 'Typography', 'classyea' ),
				'selector'              => '{{WRAPPER}} .classyea-text,{{WRAPPER}} .classyea-team-item-254 .classyea-team-name,{{WRAPPER}} .classyea-team-item-254 .classyea-team-bio',
			] 
		);

		$this->add_control(
			'member_description_text_color',
			[
				'label'                 => __( 'Text Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-name' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-bio' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'member_description_margin',
			[
				'label'                 => __( 'Margin Bottom', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
					'size' => 10,
					'unit' => 'px',
				],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-bio' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
	}
	protected function register_classyea_style_social_links_controls() {

		$this->start_controls_section(
			'section_member_social_links_style',
			[
				'label'                 => __( 'Social Links', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'member_icons_gap',
			[
				'label'                 => __( 'Icons Gap', 'classyea' ),
				'type'                  => Controls_Manager::SLIDER,
				'size_units'            => [ '%', 'px' ],
				'range'                 => [
					'px' => [
						'max' => 60,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-social li a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-social-links a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team-social-links a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-social a'=> 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social'=> 'gap: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'tabs_links_style' );

		$this->start_controls_tab(
			'tab_links_normal',
			[
				'label'                 => __( 'Normal', 'classyea' ),
			]
		);

		$this->add_control(
			'member_links_icons_color',
			[
				'label'                 => __( 'Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social .classyea-team-social-links a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-email a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-phone a i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-social li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-overly-inner *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social-links:before' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'member_links_bg_color',
			[
				'label'                 => __( 'Background Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social .classyea-team-social-links a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-social .classyea-team-social-links li a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'member_links_border',
				'label'                 => __( 'Border', 'classyea' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'separator'             => 'before',
				'selector'              => '{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social .classyea-team-social-links a,{{WRAPPER}} .classyea-team-box-252 .classyea-team-social .classyea-team-social-links a,{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a,{{WRAPPER}} .classyea-team-item-254 .classyea-team-social li a,{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i',
			]
		);

		$this->add_control(
			'member_links_border_radius',
			[
				'label'                 => __( 'Border Radius', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'member_links_padding',
			[
				'label'                 => __( 'Padding', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_links_hover',
			[
				'label'                 => __( 'Hover', 'classyea' ),
			]
		);

		$this->add_control(
			'member_links_icons_color_hover',
			[
				'label'                 => __( 'Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-254:hover .classyea-team-social li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-overly-inner:hover *' => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social-links:hover:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-email a:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-phone a:hover i' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'member_links_bg_color_hover',
			[
				'label'                 => __( 'Background Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social .classyea-team-social-links a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-254:hover .classyea-team-social li a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'member_links_border_color_hover',
			[
				'label'                 => __( 'Border Color', 'classyea' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-252 .classyea-team-social a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-253 .classyea-team-social li a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-item-254:hover .classyea-team-social li a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon i:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-box-251:hover .classyea-team-social a' => 'border-color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function register_style_team_overlay_controls() {

		$this->start_controls_section(
			'section_member_overlay_style',
			[
				'label'                 => __( 'Overlay', 'classyea' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
						'layout-5',
						'layout-4',
					]
				]
			]
		);

		$this->add_responsive_control(
			'overlay_alignment',
			[
				'label'                 => __( 'Alignment', 'classyea' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'classyea' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'classyea' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'classyea' ),
						'icon'  => 'eicon-h-align-right',
					]
				],
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-256 .classyea-team .classyea-team-content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea-team-overly-inner' => 'text-align: {{VALUE}};',
				],
				'condition'             => [
					'team_member_layout'    => ['layout-6','layout-1']]
			]
		);
		$this->add_responsive_control(
			'overlay_align_alignment',
			[
				'label'                 => __( 'Alignment', 'classyea' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'flex-start'      => [
						'title' => __( 'Left', 'classyea' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'classyea' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'     => [
						'title' => __( 'Right', 'classyea' ),
						'icon'  => 'eicon-h-align-right',
					]
				],
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-255 .classyea-team:hover .classyea-team-content' => 'align-items: {{VALUE}};',
				],
				'condition'             => [
					'team_member_layout'    => 'layout-5']
			]
		);
		$this->add_responsive_control(
			'arrow_position_yyy',
			[
				'label' => __( 'Line Position', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 2000,
					],
					'%' => [
						'min' => -110,
						'max' => 110,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social-links:before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'team_member_layout' => 'layout-1'
				],
			]
		);
		$this->add_responsive_control(
			'overlay_margin_content_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-256 .classyea-team .classyea-team-content .classyea-team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-256 .classyea-team .classyea-team-content .classyea-team-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content .classyea-team-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-team-overly-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'team_member_layout'    => 
						[
						 'layout-1',
						 'layout-6',
						 'layout-5'
						]
					]
				
			]
		);
		$this->add_control(
            'overlay_background',
            [
                'label'     => esc_html__( 'Overlay Color', 'classyea' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(0, 0, 0, 0.2)',
                'selectors' => [
                    '{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-team-256 .classyea-team:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .classyea-team-item-254 .classyea-team-overlay' => 'background-color: {{VALUE}};',
                ],
				'condition'             => [
					'team_member_layout'    => [
						'layout-1',
						'layout-5',
						'layout-4',
					]
				]
            ]
        );

		$this->add_control(
			'overlay_opacity',
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
				'selectors'             => [
					'{{WRAPPER}} .classyea-team-255 .classyea-team .classyea-team-content' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-team-256 .classyea-team:before' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-team-box-251 .classyea-team-image .classyea-team-social' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .classyea-team-item-254 .classyea-team-overlay' => 'opacity: {{SIZE}};',
				]
			]
		);

		$this->add_control(
			'contentarea_background_heading',
			[
				'label'     => __('Content Background', 'classyea'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'             => [
					'team_member_layout'    => [
						'layout-6',
					]
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'contentarea_background',
				'label'                 => __( 'Background', 'classyea' ),
				'types'                 => [ 'classic', 'gradient' ],
				'separator'             => 'before',
				'selector'              => '{{WRAPPER}} .classyea-team-256 .classyea-team .classyea-team-content',
				'condition'             => [
					'team_member_layout'    => [
						'layout-6',
					]
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings 			=  $this->get_settings_for_display();
		$team_member_layout = $settings['team_member_layout'];
?>
		<?php
		if ($team_member_layout == 'layout-1') {
			if ($team_member_layout == 'layout-1') {
				// repeater control
				$this->classyea_render_team_member_repeater_control();
			}
		} elseif ($team_member_layout == 'layout-2') {
			// repeater control
			$this->classyea_render_team_member_repeater_control();
		
		} elseif ($team_member_layout == 'layout-3') { ?>
			<div class="classyea-team-section-253">
				<div class="classyea-team-bottom-253">
					<div id="classyea-team-box-253" class="classyea-team-box-253">
						<?php
						// repeater control
						$this->classyea_render_team_member_repeater_control();
						?>
					</div> 
				</div> 
			</div> 
		<?php } elseif ($team_member_layout == 'layout-4') { ?>
					<div id="classyea-team-box-254">
				<?php
				// repeater control
				$this->classyea_render_team_member_repeater_control();
				?>
			</div> <!-- end of .classyea-team-box-253 -->
		<?php } elseif ($team_member_layout == 'layout-5') { ?>
			<div class="classyea-team-255">
				<?php
				// repeater control
				$this->classyea_render_team_member_repeater_control();
				?>
			</div>
		<?php } elseif ($team_member_layout == 'layout-6') { ?>
			<div class="classyea-team-256">
				<?php
				// repeater control
				$this->classyea_render_team_member_repeater_control();
				?>
			</div>
		<?php } 
	}
	/**
	 * Team member repeater function
	 * team member name & position output on html
	 * @access private
	 */
	private function classyea_render_team_member_repeater_control()
	{
		$settings 				= $this->get_settings_for_display();
		$team_member_layout 	= $settings['team_member_layout'];
		$team_content_alignment = $settings['team_content_alignment'];

		// if($team_content_alignment == 'left') : 
		// 	$team_alignment = 'team-alignment-left';
		// elseif($team_content_alignment == 'center') : 
		// 	$team_alignment = 'team-alignment-center';
		// elseif($team_content_alignment == 'right') : 
		// 	$team_alignment = 'team-alignment-right';
		// endif;
		$team_alignment = '';
		$image_class = "classyea-team-image ".$team_alignment."";

		switch ($team_member_layout) {
			case 'layout-1':
				$settings_id = "classyea-team-box-251 ".$team_alignment."";
				break;
			case 'layout-2':
				$settings_id = "classyea-team-box-252 ".$team_alignment."";
				break;
			case 'layout-3':
				$settings_id = "classyea-team-item-253 ".$team_alignment."";
				$image_class = "classyea-team-img ".$team_alignment."";
				break;
			case 'layout-4':
				$settings_id = "classyea-team-item-254 ".$team_alignment."";
				$image_class = "classyea-team-img ".$team_alignment."";
				break;
			case 'layout-5':
				$settings_id = "classyea-team ".$team_alignment."";
				$image_class = "classyea-team-img ".$team_alignment."";
				break;
			case 'layout-6':
				$settings_id = "classyea-team ".$team_alignment."";
				$image_class = "classyea-team-img ".$team_alignment."";
				break;
			default:
				$settings_id = "classyea-team-box-251 ".$team_alignment."";
		}
		$team_member_content = $settings['team_member_content'];
		$this->add_render_attribute('team_member_content', 'class', 'classyea-text classyea-team-bio');
	?>
		<div class="<?php echo esc_attr($settings_id); ?>">
			<div class="<?php echo esc_attr($image_class); ?>">
				<?php
				$this->classyea_team_member_image($settings);
				// classyea team social
				if ($settings['team_member_social'] && $team_member_layout == 'layout-1' || $team_member_layout == 'layout-4') :
					$this->classyea_team_member_social_links($settings);
				endif;
				?>
			</div>
			<!-- .classyea-team-image -->
			<?php
			if ($team_member_layout == 'layout-3') :
				$this->classyea_team_name_postion_two($settings, " ");
			elseif ($team_member_layout == 'layout-1' || $team_member_layout == 'layout-2' ) :
				$this->classyea_team_name_postion($settings, " ");
			endif;

			// layout 4 name & position and shape
			if ($team_member_layout == 'layout-4') : ?>
				<?php $this->classyea_team_name_postion($settings); 
			endif;
			
			// classyea team social 2, 3, 4
			if ($settings['team_member_social'] && ($team_member_layout == 'layout-2' || $team_member_layout == 'layout-3')) :
				$this->classyea_team_member_social_links($settings);
			endif;
			// classyea team social five
			if ($settings['team_member_social'] && $team_member_layout == 'layout-5') : ?>
				<div class="classyea-team-content">
					<?php $this->classyea_team_name_postion_three($settings);
					$this->classyea_team_member_social_links($settings); ?>
				</div>
			<?php
			endif;
			// classyea team social six
			if ($team_member_layout == 'layout-6') : ?>
				<div class="classyea-team-content <?php echo esc_attr($team_alignment);?>">
					<?php $this->classyea_team_name_postion_three($settings);
					?>
				</div>
			<?php
			endif;
			?>
		</div>
	<?php	// endforeach
	}
	/**
	 * Team member social link function
	 * team member social output on html
	 * @access protected
	 */
	protected function classyea_team_member_social_links()
	{
		$settings 			= $this->get_settings_for_display();
		$team_member_layout = $settings['team_member_layout'];
		$team_phone_no = $settings['team_phone_no'];
		$team_phone_no_tel = str_replace(str_split(' -)('), '', $team_phone_no);

		$social_div_class 	= 'classyea-team-social classyea-team-overlay';

		$team_member_content = $settings['team_member_content'];
		$this->add_render_attribute('team_member_content', 'class', 'classyea-text classyea-team-bio');

		if ($team_member_layout == 'layout-5') {
			$social_div_class = 'classyea-team-icon';
		}

		$fallback_defaults = [
			'fa fa-facebook',
			'fa fa-twitter',
			'fa fa-google-plus',
		];

		$migration_allowed = Icons_Manager::is_migration_allowed();

		if ($team_member_layout == 'layout-3')  : ?>
		<ul class="<?php echo esc_attr($social_div_class); ?>">
			<li>
		<?php else : ?>
			<div class="<?php echo esc_attr($social_div_class); ?>">
				<?php if ($team_member_layout != 'layout-5')  : ?>
				<div class="classyea-team-overly-inner">
					<?php if(!empty($team_phone_no)){ ?>
					<div class="classyea-team-phone"><a href="tel:<?php echo $team_phone_no_tel; ?>">
					<?php Icons_Manager::render_icon( $settings['team_phone_icon'], array( 'aria-hidden' => 'true' ) ); ?><?php echo $team_phone_no; ?></a></div>
					<?php } ?>
					<?php if(!empty($settings['team_email'])){ ?>
					<div class="classyea-team-email"><a href="mailto:<?php echo $settings['team_email']; ?>"><?php Icons_Manager::render_icon( $settings['team_email_icon'], array( 'aria-hidden' => 'true' ) ); ?><?php echo $settings['team_email']; ?></a></div>
					<?php } ?>
				<?php endif; ?>
				<div class="classyea-team-social-links">
			<?php endif;

			$i = 1;
			foreach ($settings['team_member_social'] as $index => $item) :
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
				} ?>

					<a <?php echo wp_kses_post( $this->get_render_attribute_string( $social_link_key ) ); ?>>
						<?php
						if ( $is_new || $migrated ) {
							Icons_Manager::render_icon( $item['select_social_icon'], array( 'aria-hidden' => 'true' ) );
						} else {
							?>
							<i class="<?php echo esc_attr( $item['social_icon'] ); ?>"></i>
						<?php } ?>
					</a>

					<?php if ($team_member_layout == 'layout-3') { 
				 } 
			 $i++;
			endforeach; 
		if ($team_member_layout == 'layout-3') : ?>
			</li>
		</ul>
		<?php else : ?>
			</div>
			<?php if ($team_member_layout == 'layout-4') : ?>
				<p <?php echo wp_kses_post($this->get_render_attribute_string('team_member_content')); ?>><?php echo wp_kses($team_member_content,'classyea_kses'); ?></p>
			<?php endif; ?>
			</div>
		</div>
	<?php endif;
	}
	/**
	 * Team member image function
	 * team member name & position output on html
	 * @param [type] $settings
	 * @access private
	 */
	private function classyea_team_member_image($settings)
	{
		if ($settings['team_member_image']['url']) {
			if ('image' === $settings['link_type'] && $settings['link']['url']) {

				$link_key = $this->get_repeater_setting_key('link', 'team_member_image', " ");

				$this->add_link_attributes($link_key, $settings['link']);
		?>
				<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>>
					<?php echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'team_member_image'),'classyea_img'); ?>
				</a>
			<?php
			} else {
				echo wp_kses(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'team_member_image'),'classyea_img');
			}
		}
	}
	/**
	 * Team member name and positon function
	 * team member name & position output on html
	 * @param [type] $settings
	 * @access protected
	 */
	protected function classyea_team_name_postion($settings)
	{
		$team_member_name 	  = $settings['team_member_name'];
		$team_member_position = $settings['team_member_position'];
		if ($team_member_name || $team_member_position) {
			$this->add_render_attribute('team_member_name', 'class', 'classyea-team-name', " ");
			$team_member_name_tag 	  = $settings['team_member_name_tag'];
			$team_member_position_tag = $settings['team_member_position_tag'];
			$this->add_render_attribute('team_member_position', 'class', 'classyea-team-desig', " ");
		}
		if ('title' === $settings['link_type'] && $settings['link']['url']) {

			$link_key = $this->get_repeater_setting_key('link', 'team_member_image', " ");

			$this->add_link_attributes($link_key, $settings['link']);
			?>
			<div class="classyea-team-text">
				<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>>
					<?php
					if ($team_member_name) {
						$team_name_title_tag = Header::classyea_validate_html_tag($team_member_name_tag);
					?>
						<<?php echo esc_html($team_name_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_name')); ?>>
							<?php echo wp_kses($team_member_name,'classyea_kses'); ?>
						</<?php echo esc_html($team_name_title_tag); ?>>
					<?php } ?>
				</a>
				<?php
				if ($team_member_position) {
					$team_position_tag = Header::classyea_validate_html_tag($team_member_position_tag);
				?>
					<<?php echo esc_html($team_position_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_position')); ?>>
						<?php echo wp_kses($team_member_position,'classyea_kses'); ?>
					</<?php echo esc_html($team_position_tag); ?>>
				<?php } ?>
			</div>
		<?php
		} else { ?>
			<div class="classyea-team-text">
				<?php
				if ($team_member_name) {
					$team_name_title_tag = Header::classyea_validate_html_tag($team_member_name_tag);
				?>
					<<?php echo esc_html($team_name_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_name')); ?>>
						<?php echo wp_kses($team_member_name,'classyea_kses'); ?>
					</<?php echo esc_html($team_name_title_tag); ?>>
				<?php } 
				if ($team_member_position) {
					$team_position_tag = Header::classyea_validate_html_tag($team_member_position_tag);
				?>
					<<?php echo esc_html($team_position_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_position')); ?>>
						<?php echo wp_kses($team_member_position,'classyea_kses'); ?>
					</<?php echo esc_html($team_position_tag); ?>>
				<?php } ?>
			</div>
		<?php }
	}
	/**
	 * Team member name and positon function two
	 * team member name & position output on html
	 * @param [type] $settings
	 * @access protected
	 */
	protected function classyea_team_name_postion_two($settings)
	{
		$team_member_name 	  = $settings['team_member_name'];
		$team_member_position = $settings['team_member_position'];
		if ($team_member_name || $team_member_position) {
			$this->add_render_attribute('team_member_name', 'class', 'classyea-team-name');
			$team_member_name_tag     = $settings['team_member_name_tag'];
			$team_member_position_tag = $settings['team_member_position_tag'];
			$this->add_render_attribute('team_member_position', 'class', 'classyea-team-desig');
		}
		$team_member_content = $settings['team_member_content'];
		$this->add_render_attribute('team_member_content', 'class', 'classyea-text');

		if ('title' === $settings['link_type'] && $settings['link']['url']) {

			$link_key = $this->get_repeater_setting_key('link', 'team_member_image', " ");

			$this->add_link_attributes($link_key, $settings['link']);
		?>
			<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>>
				<?php
				if ($team_member_name) {
					$team_name_title_tag = Header::classyea_validate_html_tag($team_member_name_tag);
				?>
					<<?php echo esc_html($team_name_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_name')); ?>>
						<?php echo wp_kses($team_member_name,'classyea_kses'); ?>
					</<?php echo esc_html($team_name_title_tag); ?>>
				<?php } ?>
			</a>
			<?php
			if ($team_member_position) {
				$team_position_tag = Header::classyea_validate_html_tag($team_member_position_tag);
			?>
				<<?php echo esc_html($team_position_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_position')); ?>>
					<?php echo wp_kses($team_member_position,'classyea_kses'); ?>
				</<?php echo esc_html($team_position_tag); ?>>
			<?php }
			if ($team_member_content) : ?>
				<p <?php echo wp_kses_post($this->get_render_attribute_string('team_member_content')); ?>><?php echo wp_kses($team_member_content,'classyea_kses'); ?></p>
			<?php
			endif;
		} else { 
			if ($team_member_name) {
				$team_name_title_tag = Header::classyea_validate_html_tag($team_member_name_tag);
			?>
				<<?php echo esc_html($team_name_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_name')); ?>>
					<?php echo wp_kses($team_member_name,'classyea_kses'); ?>
				</<?php echo esc_html($team_name_title_tag); ?>>
			<?php } 
			if ($team_member_position) {
				$team_position_tag = Header::classyea_validate_html_tag($team_member_position_tag);
			?>
				<<?php echo esc_html($team_position_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_position')); ?>>
					<?php echo wp_kses($team_member_position,'classyea_kses'); ?>
				</<?php echo esc_html($team_position_tag); ?>>
			<?php }
			if ($team_member_content) : ?>
				<p <?php echo wp_kses_post($this->get_render_attribute_string('team_member_content')); ?>><?php echo wp_kses($team_member_content,'classyea_kses'); ?></p>
			<?php
			endif;
		}
	}
	/**
	 * Team member name and positon function three
	 * team member name & position output on html
	 * @param [type] $settings
	 * @access protected
	 */
	protected function classyea_team_name_postion_three($settings)
	{
		$team_member_name 	  = $settings['team_member_name'];
		$team_member_position = $settings['team_member_position'];
		if ($team_member_name || $team_member_position) {

			$this->add_render_attribute('team_member_name', 'class', 'classyea-team-name', " ");
			$team_member_name_tag 	  = $settings['team_member_name_tag'];
			$team_member_position_tag = $settings['team_member_position_tag'];
			$this->add_render_attribute('team_member_position', 'class', 'classyea-team-desig', " ");
		}

		if ('title' === $settings['link_type'] && $settings['link']['url']) {

			$link_key = $this->get_repeater_setting_key('link', 'team_member_image', " ");

			$this->add_link_attributes($link_key, $settings['link']);
			?>
			<a <?php echo wp_kses_post($this->get_render_attribute_string($link_key)); ?>>
				<?php
				if ($team_member_name) {
					$team_name_title_tag = Header::classyea_validate_html_tag($team_member_name_tag);
				?>
					<div class="classyea-team-title">
						<<?php echo esc_html($team_name_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_name')); ?>>
							<?php echo wp_kses($team_member_name,'classyea_kses'); ?>
						</<?php echo esc_html($team_name_title_tag); ?>>
					</div>
				<?php } ?>
			</a>
			<?php
			if ($team_member_position) {
				$team_position_tag = Header::classyea_validate_html_tag($team_member_position_tag);
			?>
				<div class="classyea-team-post">
					<<?php echo esc_html($team_position_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_position')); ?>>
						<?php echo wp_kses($team_member_position,'classyea_kses'); ?>
					</<?php echo esc_html($team_position_tag); ?>>
				</div>
			<?php }
		} else { 
			if ($team_member_name) {
				$team_name_title_tag = Header::classyea_validate_html_tag($team_member_name_tag);
			?>
				<div class="classyea-team-title">
					<<?php echo esc_html($team_name_title_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_name')); ?>>
						<?php echo wp_kses($team_member_name,'classyea_kses'); ?>
					</<?php echo esc_html($team_name_title_tag); ?>>
				</div>
			<?php } 
			if ($team_member_position) {
				$team_position_tag = Header::classyea_validate_html_tag($team_member_position_tag);
			?>
				<div class="classyea-team-post">
					<<?php echo esc_html($team_position_tag); ?> <?php echo wp_kses_post($this->get_render_attribute_string('team_member_position')); ?>>
						<?php echo wp_kses($team_member_position,'classyea_kses'); ?>
					</<?php echo esc_html($team_position_tag); ?>>
				</div>
<?php }
		}
	}
}