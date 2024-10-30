<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Service Widget
 */
class Classyea_CountDown extends Widget_Base
{

	/**
	 * Retrieve service widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-countdown';
	}
	/**
	 * Retrieve service widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Countdown', 'classyea');
	}
	/**
	 * Retrieve service widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-countdown';
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
	}
	/**
	 * Retrieve service widget category.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_categories()
	{
		return ['classyea'];
	}
	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return [
			'countdown',
			'count down',
			'count',
			'countdown service',
			'countdown box',
			'counter',
			'classy',
			'classy addons',
			'classyea progress builder'

		];
	}
	
	public function get_script_depends() {
		return [
			'classyea-countdown'
		];
	}
	public function randomString() {
		$length = 16;
		$chars  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str    = '';

		for ( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ mt_rand( 0, strlen( $chars ) - 1 ) ];
		}
		return $str;
	}
	/**
	 * Register service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @access protected
	 */
	protected function register_controls()
	{
		/* Content Tab */
		$this->register_content_service_controls();
		$this->register_repeater_service_controls();

		/* Style Tab */
		$this->register_style_background_controls();
	}
	protected function register_content_service_controls()
	{

		/****
		 * Content Tab: service
		 ****/
		$this->start_controls_section(
			'section_service',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 2; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}

		$this->add_control(
			'countdown_layout',
			[
				'label'                => __('Layout', 'classyea'),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'layout-1',
				'options'              => $layouts,
				'separator'            => 'before',
			]
		);

		$this->end_controls_section();
	}
	/***
	/*	Repeater TAB
	**/
	protected function register_repeater_service_controls()
	{

		/**
		 * Content Repeater: service
		 */
		$this->start_controls_section(
			'section_countdown_section',
			[
				'label'                 => __('Countdown', 'classyea'),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('This offer will be end below date.', 'classyea'),
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __('Select Title Tag', 'classyea'),
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
			'countdown_date',
			[
				'label'                 => esc_html__('Countdown Date', 'classyea'),
				'type'                  => Controls_Manager::DATE_TIME,
			]
		);
		$this->end_controls_section();
    }
    

	/*	Background TAB */
	protected function register_style_background_controls()
	{

		$this->start_controls_section(
			'classyea_section_counterup_style_settings',
			[
				'label' => esc_html__('Container Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'container_padding',
			[
				'label'                 => __( 'Padding', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-countdown-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'container_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-countdown-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'normal_background',
			[
				'label'                 => __( 'Normal Background', 'classyea' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_bgtype',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-countdown-box',
			]
		);
        $this->add_control(
            'classyea_contact_form_border_radius',
            [
                'label' => esc_html__('Border Radius', 'classyea'),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .classyea-countdown-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_contact_form_border',
                'selector' => '{{WRAPPER}} .classyea-countdown-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_contact_form_box_shadow',
                'selector' => '{{WRAPPER}} .classyea-countdown-box',
            ]
        );
		$this->add_responsive_control(
			'countdown_content_alignment',
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
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .classyea-countdown > div' => 'text-align: {{VALUE}};',
				]
			]
		);
        $this->end_controls_section();
        /**
         * Style Tab: Input & Textarea
        **/
        $this->start_controls_section(
            'section_title_content_style',
            [
                'label' => __('Content', 'classyea'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .classyea-countdown-title' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-countdown-title',
                'separator' => 'before',
            ]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea-countdown-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
            'date_color',
            [
                'label' => __('Date Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .countitem-number' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => __('Date Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .countitem-number',
                'separator' => 'before',
            ]
        );
		$this->add_control(
            'date_text_color',
            [
                'label' => __('Date Text Color', 'classyea'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .countitem-title' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_text_typography',
                'label' => __('Date Text Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .countitem-title',
                'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
			'countdown_content_title_alignment',
			[
				'label'                 => __( 'Title Alignment', 'classyea' ),
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
					'{{WRAPPER}} .classyea-countdown-box' => 'text-align: {{VALUE}};',
				]
			]
		);
        $this->end_controls_section();

	
	}
	protected function render()
	{
		$settings =  $this->get_settings_for_display();
		
		$this->classyea_render_service_repeater_control();
		
	}
	/**
	 * Service repeater control function
	 * Render counterup repeater output on the frontend.
	 * @access protected
	 */
	protected function classyea_render_service_repeater_control()
	{
		$settings       = $this->get_settings_for_display();
        $countdown_layout = $settings['countdown_layout'];
		$due_date_in_days =  $settings['countdown_date'];
		$randid =  $this->randomString();
	?>
		<div class="classyea-countdown-box <?php echo esc_attr($countdown_layout)?>">
			<?php $this->classyea_countdown_title(); ?>
			<div class="classyea-countdown" data-id="classyea-countdown-<?php echo esc_attr($randid); ?>" data-date="<?php echo esc_attr($due_date_in_days); ?>">
				<div id="classyea-countdown-<?php echo esc_attr($randid); ?>"></div>
			</div>   
		</div>
	<?php
	}
		/**
	 * Service item button function
	 * Render service button output on the frontend.
	 * @access protected
	 */
	protected function classyea_countdown_title()
	{
		$settings       = $this->get_settings_for_display();
		if(!empty($settings['title'])){
		?>
		<<?php echo esc_attr($settings['title_tag']);?> class="classyea-countdown-title"><?php echo wp_kses($settings['title'],'classyea_kses');?></<?php echo esc_attr($settings['title_tag']);?>>
		<?php
		}

	}

}