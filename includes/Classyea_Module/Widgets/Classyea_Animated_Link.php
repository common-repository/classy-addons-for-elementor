<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Typography;
use \Elementor\Modules\DynamicTags\Module as TagsModule;
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Animated Link Widget
 */
class Classyea_Animated_Link extends Widget_Base
{

	/**
	 * Retrieve Animated Link widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-animated-link';
	}

	/**
	 * Retrieve Animated Link widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Animated Link', 'classyea');
	}

	/**
	 * Retrieve Animated Link widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-animated-headline classyea';
	}

	/**
	 * Retrieve Animated Link widget category.
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
			'animated',
			'classy animated',
			'animated link',
			'animated text',
			'animated link widget',
			'classy',
			'classy addons',
			'classyea animated link'

		];
	}
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
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
		$this->register_animated_content_link();

	}

	protected function register_content_service_controls()
	{

		/****
		 * Content Tab: service
		 ****/
		$this->start_controls_section(
			'section_animated',
			[
				'label'                 => __('Settings', 'classyea'),
			]
		);
		$layouts = array();
		for ($x = 1; $x <= 2; $x++) {
			$layouts['layout-' . $x] = __('Layout', 'classyea') . ' ' . $x;
		}
		$this->add_control(
			'animated_layout',
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
	/*	Animated Link Content
	**/
	protected function register_animated_content_link()
	{

		/**
		 * Content Animated Link
		 */
		$this->start_controls_section(
			'animated_content',
			[
				'label'                 => __('Link Content', 'classyea'),
			]
		);
		$this->add_control(
			'link_design',
			[
				'label'   => __('Design Style', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'   => __('Design 1', 'classyea'),
					'2'   => __('Design 2', 'classyea'),
					'3'   => __('Design 3', 'classyea'),
					'4'   => __('Design 4', 'classyea'),
					'5'   => __('Design 5', 'classyea'),
				],
				'condition'             => [ 'animated_layout' => 'layout-2']
			]
		);
		$this->add_control(
			'animation_style',
			[
				'label'   => __('Animation Style', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'link--metis',
				'options' => [
					'link--metis'   => __('metis', 'classyea'),
					'link--io'   => __('io', 'classyea'),
					'link--thebe'   => __('thebe', 'classyea'),
					'link--leda'   => __('leda', 'classyea'),
					'link--ersa'   => __('ersa', 'classyea'),
					'link--elara'   => __('elara', 'classyea'),
					'link--dia' => __('dia', 'classyea'),
					'link--kale'    => __('kale', 'classyea'),
					'link--carpo'  => __('carpo', 'classyea'),
					'link--helike'  => __('helike', 'classyea'),
					'link--mneme'  => __('mneme', 'classyea'),
					'link--iocaste'  => __('iocaste', 'classyea'),
					'link--herse'  => __('herse', 'classyea'),
					'link--carme'  => __('carme', 'classyea'),
					'link--eirene'  => __('eirene', 'classyea'),
					'link--carpo'  => __('carpo', 'classyea'),
					'link--carpo'  => __('carpo', 'classyea'),
					'link--carpo'  => __('carpo', 'classyea'),
					'link--carpo'  => __('carpo', 'classyea'),
				],
				'condition'             => ['animated_layout' => 'layout-1']
			]
		);
		$this->add_control(
			'link_title',
			[
				'label'       => esc_html__('Title', 'classyea'),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('Shop the look', 'classyea'),
			]
		);
		$this->add_control(
			'sub_title',
			[
				'label'       => esc_html__('Sub Title', 'classyea'),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'label_block' => true,
				'default'     => esc_html__('heartbeat Effect', 'classyea'),
				'condition'             => ['animated_layout' => 'layout-2']
			]
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
				'show_external' => true,
				'default'               => [
					'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
				],
			]
		);
		$this->end_controls_section();

		// color_section
		$this->start_controls_section(
			'color_section',
			array(
				'label' => __('Content Style', 'classyea'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'classyea_animated_alignment',
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
					],
				],
				'default'               => 'left',
				'selectors'             => [
					'{{WRAPPER}} .classyea_link_content_item' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .classyea_link_content_item' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 li' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea_link_content_item .classyealink,{{WRAPPER}}  .classyea-animated-link-wrap-1301 a',
                'separator' => 'before',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __('Sub Title Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-link-type-1301',
                'separator' => 'before',
				'condition' => ['animated_layout' => 'layout-2']
            ]
        );
		
		$this->start_controls_tabs('tabs_button_style');
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __('Normal', 'classyea'),
			)
		);
		$this->add_control(
			'link_color',
			array(
				'label'     => __('Title Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea_link_content_item .classyealink' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-1 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-2 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-3 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-4 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-5 a' => 'text-fill-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-5 a' => '-webkit-text-fill-color: {{VALUE}}',
				),
			)					
			
		);
		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __('Sub Title Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-link-type-1301' => 'color: {{VALUE}}',
				),
				'condition' => ['animated_layout' => 'layout-2']
			)					
			
		);
		$this->add_control(
			'border_top_subtitle_color',
			array(
				'label'     => __('Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-link-type-1301' => 'border-top-color: {{VALUE}}',
				),
				'condition' => ['animated_layout' => 'layout-2']
			)					
			
		);
		
		$this->add_control(
			'bounce_effect_color',
			array(
				'label'     => __('Bounce Effect Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .link-3 a::after' => 'background: {{VALUE}}',
				),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'animated_layout',
							'operator' => '==',
							'value' => 'layout-2'
						],
						[
							'name' => 'link_design',
							'operator' => '==',
							'value' => '3'
						]
					]
				]
			)					
			
		);
		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __('Hover', 'classyea'),
			)
		);
		$this->add_control(
			'link_hover_color',
			array(
				'label'     => __('Title & Link Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea_link_content_item .classyealink:hover' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-animated-link-content:hover .link__graphic' => 'stroke: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 li a:hover' => 'color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-5:hover a' => 'text-fill-color: {{VALUE}}!important',
					'{{WRAPPER}} .classyea-animated-link-wrap-1301 .link-5:hover a' => '-webkit-text-fill-color: {{VALUE}}!important',
								
				),
			)
		);
		$this->add_control(
			'link_hoverborderbottom_color',
			array(
				'label'     => __('Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .left .link-1 a:before' => 'border-bottom-color: {{VALUE}}!important',
					'{{WRAPPER}} .link-4 a:before, .link-4 a:after' => 'background: {{VALUE}}!important',
								
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings 		    =  $this->get_settings_for_display();
		$animated_layout    = $settings['animated_layout'];
		$animated_alignment = $settings['classyea_animated_alignment'];
		
		if ( $animated_layout == 'layout-1' ) { 
			?>
				<ol class="classyea-animated-link-content">
					<?php 
						if ( $animated_layout == 'layout-1' ) {
							$this->classyea_render_animated_control();
						}
					?>
				</ol>
			<?php 
		} elseif ( $animated_layout == 'layout-2' ) { 
			?>
				<ul class="classyea-animated-link-wrap-1301 <?php echo esc_attr($animated_alignment);?>">
					<?php $this->classyea_render_animated_control();?>
				</ul>
			<?php
		}
	}

	/**
	 * Animated repeater control function
	 * Render counterup repeater output on the frontend.
	 * @access protected
	*/
	protected function classyea_render_animated_control()
	{
		$settings              = $this->get_settings_for_display();
		$animated_layout 	   = $settings['animated_layout'];
		$item_url 		   	   = $settings["link"]["url"];
		$animation_style       = $settings['animation_style'];
		$link_title 		   = $settings['link_title'];
		$explode_title 		   = explode(" ",$link_title);

		$title = "";
		if( $animation_style == 'link--leda' || $animation_style == 'link--ersa' || 
			$animation_style ==   'link--elara' || $animation_style == 'link--eirene' ) {
			$title = "<span>$link_title</span>";
		} else{
			$title =  $link_title;
		}
			
		if ( $animated_layout == 'layout-1' ) { 
			?>
				<li class="classyea_link_content_item">
					<a  href="<?php echo esc_url($item_url); ?>" target="_blank" class="classyealink 
						<?php echo  esc_attr($animation_style);?> custom-link" data-text="<?php echo wp_kses($link_title,'classyea_kses'); ?>">
						<?php 
							if( $animation_style == 'link--iocaste' ) { 
								?>
									<span><?php echo wp_kses($link_title,'classyea_kses'); ?></span>
									<svg class="link__graphic link__graphic--slide" width="300%" height="100%" viewBox="0 0 1200 60"
										preserveAspectRatio="none">
										<path
											d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0">
										</path>
									</svg> 
								<?php 
							} elseif( $animation_style == 'link--herse' ) { 
								?>
									<span><?php echo wp_kses($link_title,'classyea_kses'); ?></span>
									<svg class="link__graphic link__graphic--stroke link__graphic--arc" width="100%" height="18"
										viewBox="0 0 59 18">
										<path d="M.945.149C12.3 16.142 43.573 22.572 58.785 10.842" pathLength="1" />
									</svg>
								<?php 
							} elseif( $animation_style == 'link--carme' ) { 
								?>
									<span><?php echo wp_kses($link_title,'classyea_kses'); ?></span>
									<svg class="link__graphic link__graphic--stroke link__graphic--scribble" width="100%" height="9"
										viewBox="0 0 101 9">
										<path
											d="M.426 1.973C4.144 1.567 17.77-.514 21.443 1.48 24.296 3.026 24.844 4.627 27.5 7c3.075 2.748 6.642-4.141 10.066-4.688 7.517-1.2 13.237 5.425 17.59 2.745C58.5 3 60.464-1.786 66 2c1.996 1.365 3.174 3.737 5.286 4.41 5.423 1.727 25.34-7.981 29.14-1.294"
											pathLength="1" />
									</svg>
								<?php 
							} else { 
									echo wp_kses($title,'classyea_kses'); 
							}   
						?>
					</a>
				</li> 
			<?php
		} elseif( $animated_layout == 'layout-2' ){ 

			$link_design = $settings['link_design'];
			$sub_title   = $settings['sub_title'];

			if($link_design == '1') { 
				?>
					<li class="link-1">
						<a href="<?php echo esc_url($item_url); ?>">
							<?php 
								$count = 1;
								foreach( $explode_title as $title ) {
									if ( $count % 2 == 0 ){
										$spanclass = 'thick';
									} else {
										$spanclass = 'thin';
									}

									$output1 = "<span class='".$spanclass."'>$title</span>";
									echo wp_kses( $output1,'classyea_kses' );
									$count++;
								} 
							?>
						</a>
						<p class="classyea-link-type-1301"><?php echo wp_kses( $sub_title,'classyea_kses'); ?></p>    
					</li>
				<?php 
			} elseif( $link_design == '2' ) { 
				?>
					<li class="link-2">
						<a href="<?php echo esc_url( $item_url ); ?>" class="hover-shadow hover-color">
							<?php 
								$output 		= " ";
								$explode_title2 = explode(" ",$link_title);
								foreach ( $explode_title2 as $title2 ) {
									$output = "<span>$title2</span>";
									echo wp_kses( $output,'classyea_kses' );
								} 
							?>
						</a>
						<p class="classyea-link-type-1301"><?php echo wp_kses($sub_title,'classyea_kses'); ?></p>
					</li>
				<?php 
			} else { 
				?>
					<li class="link-<?php echo esc_attr( $link_design );?>">
						<a href="<?php echo esc_url($item_url); ?>"><?php echo wp_kses( $link_title,'classyea_kses' ); ?></a>
						<br>
						<p class="classyea-link-type-1301"><?php echo wp_kses( $sub_title,'classyea_kses' ); ?></p>
					</li>
				<?php 
			} 
		}
	}
}