<?php
namespace ClassyEa\Helper\Elementor\Widgets;
use \Elementor\Utils;
use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Service Widget
 */
class Classyea_Pricing_Table extends Widget_Base
{

	/**
	 * Retrieve service widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-widget-pricing-table';
	}
	/**
	 * Retrieve service widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Pricing Table', 'classyea');
	}
	/**
	 * Retrieve service widget icon.
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'classyicon classyea-pricing-table';
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

	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
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
			'pricing',
			'pricing table',
			'classy pricing',
			'classyea service',
			'pricing box',
			'price table',
			'price box',
			'classy',
			'classy addons',
			'classyea pricing builder'

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
		$this->register_repeater_service_controls();

		/* Style Tab */
		$this->register_style_background_controls();
		$this->register_repeater_servicelist_controls();
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
			'pricing_layout',
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
			'section_pricing_item',
			[
				'label'                 => __('Pricing Details', 'classyea'),
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
				'default'     => esc_html__('BASIC', 'classyea'),
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
			'currency',
			[
				'label'                 => esc_html__('Currency', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('$', 'classyea'),
			]
		);
		$this->add_control(
			'price',
			[
				'label'                 => esc_html__('Price', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('20', 'classyea'),
			]
		);
		$this->add_control(
			'old_price',
			[
				'label'                 => esc_html__('Old Price', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
			]
        );
		$this->add_control(
			'duration',
			[
				'label'                 => esc_html__('Duration', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'default'               => __('Month', 'classyea'),
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
				'default'               => [
					'url' => '#',
				],
			]
		);
		$this->add_control(
			'service_button_text',
			[
				'label'                 => __('Button Text', 'classyea'),
				'type'                  => Controls_Manager::TEXT,
				'dynamic'               => [
					'active'   => true,
				],
				'default'               => __('Know More', 'classyea'),
			]
		);
		$this->add_control(
			'featured',
			[
				'label' => esc_html__( 'Featured', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'false',
			]
		);
		$this->end_controls_section();
    }
    
	/***
	/*	Repeater TAB
	**/
	protected function register_repeater_servicelist_controls()
	{
        $this->start_controls_section(
			'section_pricing_service_list',
			[
				'label'                 => __('Service List', 'classyea'),
			]
		);
        $repeater = new Repeater();
		$repeater->add_control(
			'service_name',
			[
				'label'                 => __( 'Service name', 'classyea' ),
				'default' => __("4 Properties","classyea"),
				'type'                  => Controls_Manager::TEXT,
			]
        );
		$repeater->add_control(
			'service_name_tooltip',
			[
				'label'                 => __( 'Tooltip Text', 'classyea' ),
				'default' => __("Product Filters, Account Dashboard, Add to Cart, Categories, Oder Details, Account Navigation, and many more.","classyea"),
				'type'                  => Controls_Manager::TEXT,
			]
        );
        $this->add_control(
			'service_list',
			array(
				'label'       => esc_html__( 'Repeater List', 'classyea' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'list_title'   => esc_html__( 'Title #1', 'classyea' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'carneshop' ),
					),
				),
			)
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'                  => 'background_back',
				'types'                 => [ 'classic', 'gradient' ],
				'selector'              => '{{WRAPPER}} .classyea-price-table ,{{WRAPPER}} .classyea-price-table.layout-2',
				'separator'             => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_bgtype_two',
				'label' => __( 'Background', 'classyea' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .classyea-price-table ,{{WRAPPER}} .classyea-price-table.layout-2',
				'condition'             => [
					'service_layout'    => [
						'layout-1',
						'layout-2',
					]
				]
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'                 => __( 'Border Radius', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .classyea-price-table, {{WRAPPER}} .classyea-price-table.layout-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-price-table ,{{WRAPPER}} .classyea-price-table.layout-2' => '-webkit-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'pricing_layout'    => [
						'layout-2',
					]
				],
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'classyea_contact_form_border',
                'selector' => '{{WRAPPER}} .classyea-price-table,{{WRAPPER}} .classyea-price-table.layout-2',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'classyea_contact_form_box_shadow',
				'selector' => '{{WRAPPER}} .classyea-price-table,{{WRAPPER}} .classyea-price-table.layout-2',            ]
        );

        $this->end_controls_section();
	
		// Title Section

		$this->start_controls_section(
            'title_section',
            array(
                'label' => __('Title', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => __('Title', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-title,{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-title',

				
            )
        );
		$this->add_control(
            'title_color',
            array(
                'label'     => __('Title Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-title' => 'color: {{VALUE}}',	
                ),
            )
        );
		$this->add_control(
            'title_bg_color',
            array(
                'label'     => __('Title BG Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-title' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-title-wrapper:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-title-wrapper:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-title' => 'background-color: {{VALUE}}',
					
                ),
            )
        );
		$this->add_responsive_control(
			'classyea_title_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		// Price Section

		$this->start_controls_section(
            'price_section',
            array(
                'label' => __('Price', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'price_typography',
                'label'    => __('Price', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-price ,{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-price sup,{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-price',		
            )
        );

		$this->add_control(
            'price_color',
            array(
                'label'     => __('Price Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-price' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-price' => 'color: {{VALUE}}',
                ),
            )
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'old_price_typography',
                'label'    => __('Old Price', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-price-table .classyea-price-table-price sub.period',
					
            )
        );

		$this->add_control(
            'old_price_color',
            array(
                'label'     => __('Old Price Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table .classyea-price-table-price sub.period' => 'color: {{VALUE}}',

                ),
            )
        );

		$this->add_control(
            'price_bg_color',
            array(
				'label'     => __('Price BG Color', 'classyea'),
				'separator' => 'before',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-price' => 'background: {{VALUE}}',
					
                ),
				'condition'             => [
					'pricing_layout'    => [
						'layout-1',
					]
				],
            )
        );

		$this->add_responsive_control(
			'classyea_price_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-price-table.layout-1 .classyea-price-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-price-table.layout-2 .classyea-price-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Service List Section

		$this->start_controls_section(
            'service_list_section',
            array(
                'label' => __('Service List', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'service_name_typography',
                'label'    => __('Service Name', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-price-table ul li',		
            )
        );

		$this->add_responsive_control(
			'classyea_service_padding',
			[
				'label'      => esc_html__('Service Margin', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-price-table ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'service_name_color',
            array(
                'label'     => __('Service Name Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table ul li' => 'color: {{VALUE}}',
                ),
            )
        );

		$this->add_control(
            'tooltip_text_color',
            array(
                'label'     => __('Tooltip Text Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table .tooltip' => 'color: {{VALUE}}',
                ),
            )
        );

		$this->add_control(
            'tooltip_text__bg_color',
            array(
                'label'     => __('Tooltip Text BG Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table .tooltip' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table ul > li > .tooltip::before' => 'border-top-color: {{VALUE}}',					
                ),
            )
        );

		$this->add_responsive_control(
			'classyea_tooltip_padding',
			[
				'label'      => esc_html__('Tooltip Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-price-table .tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Button Section

		$this->start_controls_section(
            'button_section',
            array(
                'label' => __('Button', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'button_typography',
                'label'    => __('Button Text', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea-price-table.layout-2 a,{{WRAPPER}} .classyea-price-table.layout-1 a',	
            )
        );

		$this->add_control(
            'button_color',
            array(
                'label'     => __('Button Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 a' => 'color: {{VALUE}}',
                ),
            )
        );

		$this->add_control(
            'button_bg_color',
            array(
                'label'     => __('Button BG Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 a' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 a' => 'background-color: {{VALUE}}',
                ),
            )
        );

		$this->add_control(
            'button_hover_color',
            array(
                'label'     => __('Button Hover Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 a:hover' => 'color: {{VALUE}}',
                ),
            )
        );

		$this->add_control(
            'button_hover_bg_color',
            array(
                'label'     => __('Button Hover BG Color', 'classyea'),
                'separator' => 'before',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-price-table.layout-2 a:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .classyea-price-table.layout-1 a:hover' => 'background-color: {{VALUE}}',
                ),
            )
        );

		$this->add_responsive_control(
			'classyea_button_padding',
			[
				'label'      => esc_html__('Padding', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .classyea-price-table.layout-1 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea-price-table.layout-2 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
                    '{{WRAPPER}} .classyea-price-table.layout-1 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea-price-table.layout-2 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

		$this->end_controls_section();

	}
	protected function render()
	{
		
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
        $pricing_layout = $settings['pricing_layout'];
        $featured = $settings['featured'];
		if($featured == 'yes'){
			$featured_class = 'featured';
		}else{
			$featured_class = '';
		}
		
        if (!empty($settings['link']['url'])) {
                $this->add_link_attributes('button', $settings['link']);
                $this->add_render_attribute('button', 'class', ['classyea-btn-primary']);
		}
        
?>
    <div class="classyea-price-table <?php echo esc_attr($pricing_layout.' '.$featured_class)?>">
		<div class="classyea-price-table-title-wrapper">
        	<<?php echo $settings['title_tag'];?> class="classyea-price-table-title"><?php echo $settings['title'];?></<?php echo $settings['title_tag'];?>>
		</div>
        <span class="classyea-price-table-price">
			<sup><?php echo $settings['currency'];?></sup> 
			<?php echo $settings['price'];?>
			<?php if (!empty($settings['old_price'])) { ?>
			<sub class="period"> <?php echo $settings['old_price'];?></sub>
			<?php } ?>
			<sub> /<?php echo $settings['duration'];?></sub>
		</span>
        <ul>
            <?php foreach($settings['service_list'] as $service){?>
            <li><?php echo $service['service_name']; ?>
                <?php if (!empty($service['service_name_tooltip'])) { ?>
				<span class="eicon-info-circle-o"></span>
                <div class="tooltip"><?php echo wp_kses($service['service_name_tooltip'],'classyea_kses'); ?></div>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
       <?php if (!empty($settings['link']['url']) && !empty($settings['service_button_text'])) { ?>
        <a <?php echo wp_kses_post($this->get_render_attribute_string('button')); ?>><?php echo wp_kses($settings['service_button_text'],'classyea_kses'); ?><span class="eicon-arrow-right"></span></a>
        <?php } ?>
    </div>
	<?php
	}
}