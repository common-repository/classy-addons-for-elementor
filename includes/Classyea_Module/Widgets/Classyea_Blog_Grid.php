<?php
namespace ClassyEa\Helper\Classyea_Module\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

/**
 * Animated Link Widget
 */
class Classyea_Blog_Grid extends Widget_Base
{

	/**
	 * Retrieve Animated Link widget name.
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'classyea-blog-grid';
	}

	/**
	 * Retrieve Animated Link widget title.
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Blog Grid', 'classyea');
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
	public function get_style_depends()
	{
		return [
           'font-awesome-5-all-classyea',
        ];
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
			'classyea animated link',

		];
	}

	/**
	 * List of service categories.
	 * @access private
	 */

	private function get_taxonomy_categories()
	{
		$taxonomy_categories_list = array();
		$taxonomy_category        = 'category';
		if (!empty($taxonomy_category)) {

			$terms_cat = get_terms(
				array(
					'parent'     => 0,
					'taxonomy'   => $taxonomy_category,
					'hide_empty' => false,
				)
			);

			if (!empty($terms_cat)) {
				$taxonomy_categories_list[''] = 'Select';
				foreach ($terms_cat as $term) {
					if (isset($term)) {
						if (isset($term->slug) && isset($term->name)) {
							$taxonomy_categories_list[$term->slug] = $term->name;
						}
					}
				}
			}
		}
		return $taxonomy_categories_list;
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
	}

	protected function register_content_service_controls()
	{

		$this->start_controls_section(
			'clad_blog_posts_layout',
			[
				'label' => esc_html__('Layout Options', 'classyea'),
			]
		);
		$this->add_control(
			'clad_blog_posts_layout_style',
			[
				'label'   => esc_html__('Layout Style', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'classyea_blog_list_post' => esc_html__('List', 'classyea'),
					'classyea_blog_grid_post' => esc_html__('Grid', 'classyea'),
				],
				'default' => 'classyea_blog_list_post',
			]
		);
		$this->add_control(
			'clad_blog_posts_featured_img',
			[
				'label'     => esc_html__('Show Featured Image', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'default'   => 'yes',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'clad_blog_posts_feature_img_size',
				'default' => 'large',
				'include'   => [],
				'condition' => [
					'clad_blog_posts_featured_img' => 'yes',
				],
			]
		);


		$this->add_control(
			'clad_blog_posts_column',
			[
				'label'     => esc_html__('Show Posts Per Row', 'classyea'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'classyea-lg-12 classyea-md-12' => esc_html__('1', 'classyea'),
					'classyea-lg-6 classyea-md-6'   => esc_html__('2', 'classyea'),
					'classyea-lg-4 classyea-md-6'   => esc_html__('3', 'classyea'),
					'classyea-lg-3 classyea-md-6'   => esc_html__('4', 'classyea'),
					'classyea-lg-2 classyea-md-6'   => esc_html__('6', 'classyea'),
				],
				'condition' => [
					'clad_blog_posts_layout_style' => ['classyea_blog_grid_post'],
				],
				'default'   => 'classyea-lg-12 classyea-md-12',
			]
		);
		$this->add_control(
			'clad_blog_posts_title',
			[
				'label'     => esc_html__('Show Title', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'clad_blog_posts_title_trim',
			[
				'label'     => esc_html__('Title Length', 'classyea'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '10',
				'condition' => [
					'clad_blog_posts_title' => 'yes',
				],
			]
		);
		$this->add_control(
			'clad_blog_posts_content',
			[
				'label'     => esc_html__('Show Content', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'clad_blog_posts_content_trim',
			[
				'label'     => esc_html__('Excerpt Length', 'classyea'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '30',
				'condition' => [
					'clad_blog_posts_content' => 'yes',
				],
			]
		);
		$this->add_control(
			'clad_blog_posts_read_more',
			[
				'label'     => esc_html__('Show Read More', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'pagination_onoff',
			[
				'label' => esc_html__( 'Pagination ON/OFF', 'classyea' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classyea' ),
				'label_off' => esc_html__( 'Hide', 'classyea' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'divider_on_off',
			[
				'label'     => esc_html__('Blog List Divider ON/OFF', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'default'   => 'no',
			]
		);
		$this->add_control(
			'blog_large_container_onoff',
			[
				'label'     => esc_html__('Large Container', 'classyea'),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__('Yes', 'classyea'),
				'label_off' => esc_html__('No', 'classyea'),
				'default'   => 'no',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'clad_blog_posts_content_section',
			[
				'label' => esc_html__('Query', 'classyea'),
			]
		);

		$this->add_control(
			'clad_blog_posts_num',
			[
				'label'   => esc_html__('Post Per Page', 'classyea'),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
			]
		);
		$this->add_control(
			'clad_blog_posts_is_manual_selection',
			[
				'label'   => esc_html__('Select posts by:', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'recent' => esc_html__('Recent Post', 'classyea'),
					'cat'    => esc_html__('Category Post', 'classyea'),
				],

			]
		);
		$this->add_control(
			'clad_blog_posts_cats',
			[
				'label'       => esc_html__('Select Categories', 'classyea'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $this->get_taxonomy_categories(),
				'label_block' => true,
				'multiple'    => true,
				'condition'   => ['clad_blog_posts_is_manual_selection' => 'cat'],
			]
		);
		$this->add_control(
			'clad_blog_posts_offset',
			[
				'label'   => esc_html__('Offset', 'classyea'),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 20,
				'default' => 0,
			]
		);
		$this->add_control(
			'clad_blog_posts_order_by',
			[
				'label'   => esc_html__('Order by', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'          => esc_html__('Date', 'classyea'),
					'ID'            => esc_html__('ID', 'classyea'),
					'author'        => esc_html__('Author', 'classyea'),
					'title'         => esc_html__('Title', 'classyea'),
					'modified'      => esc_html__('Modified', 'classyea'),
					'rand'          => esc_html__('Random', 'classyea'),
					'comment_count' => esc_html__('Comment count', 'classyea'),
					'menu_order'    => esc_html__('Menu order', 'classyea'),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'clad_blog_posts_sort',
			[
				'label'   => esc_html__('Order', 'classyea'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__('ASC', 'classyea'),
					'DESC' => esc_html__('DESC', 'classyea'),
				],
				'default' => 'DESC',
			]
		);

		$this->end_controls_section();

		 //Background Section
		 $this->start_controls_section(
            'background_section',
            array(
                'label' => __('Background', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_image_background',
				'label'     => __('Background', 'classyea'),
				'types'     => ['classic', 'gradient', 'video'],
				'selector'  => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single ,{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single',
				
			]
		);
		$this->add_control(
            'classyea_blog_divider_heading',
            [
                'label' => __( 'Blog List Divider Border', 'classyea' ),
				'description' => __("Use for only Blog List","classyea"),
                'type'  => Controls_Manager::HEADING,
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_divider_border',
				'separator'  => 'before',
				'selector' => '{{WRAPPER}} .blog-list-divider.classyea-blog-post-single',
				
			]
		);

		$this->add_control(
            'large_title_container',
            array(
                'label'     => __('Large Image Container BG', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box.large-container .lower-content' => 'background: {{VALUE}}',
					
                ),
				'condition' => ['blog_large_container_onoff' => 'yes']
            )
        );

		$this->add_control(
            'category_bg_color',
            array(
                'label'     => __('Category Background', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-blog-post-single .inner-box.large-container .post-img span.category' => 'background: {{VALUE}}',
					
                ),
				'condition' => ['blog_large_container_onoff' => 'yes']
            )
        );
		$this->add_control(
            'category_text_color',
            array(
                'label'     => __('Category Text', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-blog-post-single .inner-box.large-container .post-img span.category a' => 'color: {{VALUE}}!important',
					
                ),
				'condition' => ['blog_large_container_onoff' => 'yes']
            )
        );

		$this->add_control(
			'category_position_toggle',
			[
				'label' => __( 'Position', 'classyea' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'classyea' ),
				'label_on' => __( 'Custom', 'classyea' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'category_position_y',
			[
				'label' => __( 'Vertical', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'category_position_toggle' => 'yes'
				],
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
					'{{WRAPPER}} .classyea-blog-post-single .inner-box.large-container .post-img span.category' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_position_x',
			[
				'label' => __( 'Horizontal', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'condition' => [
					'category_position_toggle' => 'yes'
				],
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
					'{{WRAPPER}} .classyea-blog-post-single .inner-box.large-container .post-img span.category' => 'right: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
		$this->end_popover();


		$this->end_controls_section();

		//Wrapper Section
		$this->start_controls_section(
            'wrapper_content_section',
            array(
                'label' => __('Wrapper', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_contact_form_border',
				'selector' => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single, {{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single',
				
			]
		);

		$this->add_control(
			'classy_blog_grid_list_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'classyea'),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'clad_blog_posts_layout_style'    => [
						'classyea_blog_list_post',
					]
				]
			]
		);

		$this->add_responsive_control(
			'classy_blog_grid_list_content_margin',
			[
				'label'                 => __( 'Margin', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'before',
				'selectors'             => [
					'{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'classy_blog_grid_list_content_padding',
			[
				'label'                 => __( 'Padding', 'classyea' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'separator'             => 'after',
				'selectors'             => [
					'{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'classyea_contact_form_box_shadow',
				'selector'  => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single ,{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single',
				'separator' => 'after',
			]
		);

        $this->end_controls_section();

		//Title & Content Section
		$this->start_controls_section(
            'title_content_section',
            array(
                'label' => __('Title & Content', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_responsive_control(
            'classyea_title_margin',
            [
                'label'      => esc_html__( 'Margin', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .title-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .title-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => __('Title Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .title-post,{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .title-post',

				
            )
        );

		$this->add_control(
            'title_color',
            array(
                'label'     => __('Title Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .title-post a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .title-post a' => 'color: {{VALUE}}',
					
                ),
            )
        );
		$this->add_control(
            'title_hovercolor',
            array(
                'label'     => __('Title Hover Color', 'classyea'),
				'separator' => 'after',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .title-post a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .title-post a:hover' => 'color: {{VALUE}}',
					
                ),
            )
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'content_typography',
				'separator' => 'before',
                'label'    => __('Content Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .content-text, {{WRAPPER}}	.classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .content-text',
            )
        );

		$this->add_control(
            'content_color',
            array(
                'label'     => __('Content Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .content-text' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .content-text' => 'color: {{VALUE}}',
					
                ),
            )
        );
		$this->add_control(
            'date_color',
            array(
                'label'     => __('Date Color', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-blog-post-single .inner-box .lower-content ul li .post-date span' => 'color: {{VALUE}}',
					
                ),
            )
        );
		$this->add_control(
            'date_iconcolor',
            array(
                'label'     => __('Date Icon Color', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-blog-post-single .inner-box .lower-content ul li .post-date::after' => 'color: {{VALUE}}',
					
                ),
            )
        );
		$this->add_control(
            'authorcolor',
            array(
                'label'     => __('Author Color', 'classyea'),
				'separator' => 'after',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea-blog-post-single .inner-box .lower-content ul li .post-author span span' => 'color: {{VALUE}}',
					
                ),
            )
        );

		
		
		$this->add_responsive_control(
            'classyea_titlecontent_margin',
            [
                'label'      => esc_html__( 'Margin', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .content-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .content-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
		$this->add_control(
			'link_hoverborderbottom_color',
			array(
				'label'     => __('Border Color', 'classyea'),
				'separator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .title-post' => 'border-bottom-color: {{VALUE}}!important',				
				),
				'condition' => [
					'clad_blog_posts_layout_style'    => [
						'classyea_blog_grid_post',
					]
				]
			)
		);
		$this->add_control(
			'link_hoverborderbottom_size_color',
			[
				'label' => esc_html__( 'Border Width', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .title-post' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'classyea_meta_padding',
            [
                'label'      => esc_html__( 'Meta Padding', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea-blog-post-single .inner-box .lower-content ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

		$this->end_controls_section();
		

		//Button Section
		$this->start_controls_section(
            'button_section',
            array(
                'label' => __('Button', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
		$this->add_responsive_control(
            'classyea_button_padding',
            [
                'label'      => esc_html__( 'Padding', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
            ]
        );
		$this->add_responsive_control(
            'classyea_button_margin',
            [
                'label'      => esc_html__( 'Margin', 'classyea' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_button_borderr',
				'selector' => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a,{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a',
				'separator'  => 'after',
				
			]
		);

		$this->add_control(
			'classyea_border_radius',
			[
				'label' => __('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'.classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'clad_blog_posts_layout_style'    => [
						'classyea_blog_list_post',
					]
				]
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'button_title_typography',
                'label'    => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a, {{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a ',
            )
        );
		$this->start_controls_tabs( 'classyea_tabs_nav' );
		$this->start_controls_tab(
			'classyea_tab_navs_normal',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		
		$this->add_control(
            'button_title_bg_color',
            array(
                'label'     => __('Background', 'classyea'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'background: {{VALUE}}',
					
                ),
            )
        );
		$this->add_control(
            'button_title_color',
            array(
                'label'     => __('Color', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a' => 'color: {{VALUE}}',
                ),
            )
        );
		$this->end_controls_tab();
		

		$this->start_controls_tab(
			'classyea_tab_nav_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
            'button_bgcolor_hover_color',
            array(
                'label'     => __('Background', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a:hover' => 'background: {{VALUE}}',
                ),
            )
        );
		$this->add_control(
            'button_title_hover_color',
            array(
                'label'     => __('Color', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .lower-content .read-more-link a:hover' => 'color: {{VALUE}}',
                ),
            )
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		//Image Section
		$this->start_controls_section(
            'image_thumb_section',
            array(
                'label' => __('Image', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
		$this->add_control(
			'classyea_image_border_radius',
			[
				'label' => __('Border Radius', 'classyea'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'.classyea_blog_grid_post .classyea-blog-post-single .inner-box .post-img a img, .classyea_blog_list_post .classyea-blog-post-single .inner-box .post-img a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_thumb_size_section',
			[
				'label' => esc_html__( 'Width', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea_blog_grid_post .classyea-blog-post-single .inner-box .post-img a img, {{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .post-img a img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'image_thumb_wrapper_size_section',
			[
				'label' => esc_html__( 'Image Wrapper Width', 'classyea' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .classyea_blog_list_post .classyea-blog-post-single .inner-box .post-img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
            'blog_pagination',
            array(
                'label' => __('Pagination', 'classyea'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

		$this->add_responsive_control(
            'classyea_pagination_alignment',
            [
                'label' => __('Alignment', 'classyea'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
					'left' => [
						'title' => __( 'Left', 'classyea' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'classyea' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'classyea' ),
						'icon' => 'eicon-h-align-right',
					],
				],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .pagination.styled-pagination' => 'justify-content: {{VALUE}}!important;',
                ]
            ]
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'pagination_text_typography',
                'label'    => __('Typography', 'classyea'),
                'selector' => '{{WRAPPER}} .styled-pagination .page-numbers',
            )
        );
		$this->start_controls_tabs( 'classyea_pagination_tabs_nav' );
		$this->start_controls_tab(
			'classyea_pagination_tab_navs_normal',
			[
				'label' => __( 'Normal', 'classyea' ),
			]
		);
		
		$this->add_control(
            'pagination_normal_bg_color',
            array(
                'label'     => __('Background', 'classyea'),
                'separator' => 'after',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .styled-pagination .page-numbers' => 'background: {{VALUE}}',
					
                ),
            )
        );
		$this->add_control(
            'pagination_normal_text_color',
            array(
                'label'     => __('Color', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .styled-pagination .page-numbers' => 'color: {{VALUE}}',
                ),
            )
        );
		$this->end_controls_tab();
		

		$this->start_controls_tab(
			'classyea_pagination_nav_hover',
			[
				'label' => __( 'Hover', 'classyea' ),
			]
		);
		$this->add_control(
            'pagination_bg_hover_color',
            array(
                'label'     => __('Background', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .styled-pagination .page-numbers:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .styled-pagination .page-numbers.current' => 'background: {{VALUE}}',
                ),
            )
        );
		$this->add_control(
            'pagination_bgtext_hover_color',
            array(
                'label'     => __('Color', 'classyea'),
                'separator' => 'before',
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .styled-pagination .page-numbers:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .styled-pagination .page-numbers.current' => 'color: {{VALUE}}',
                ),
            )
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'classyea_pagination_border',
				'selector' => '{{WRAPPER}} .styled-pagination .page-numbers',
				
			]
		);
		$this->add_control(
			'classy_pagination_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'classyea'),
				'separator'  => 'before',
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .styled-pagination .page-numbers'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render()
	{
		$settings                              = $this->get_settings_for_display();

		$clad_blog_posts_layout_style          = $settings['clad_blog_posts_layout_style'];
		$clad_blog_posts_featured_img          = $settings['clad_blog_posts_featured_img'];
		$clad_blog_posts_feature_img_size_size = $settings['clad_blog_posts_feature_img_size_size'];
		$clad_blog_posts_column                = $settings['clad_blog_posts_column'];
		$clad_blog_posts_title                 = $settings['clad_blog_posts_title'];
		$clad_blog_posts_title_trim            = $settings['clad_blog_posts_title_trim'];
		$clad_blog_posts_content               = $settings['clad_blog_posts_content'];
		$clad_blog_posts_content_trim          = $settings['clad_blog_posts_content_trim'];
		$clad_blog_posts_read_more             = $settings['clad_blog_posts_read_more'];
		$clad_blog_posts_cats                  = $settings['clad_blog_posts_cats'];
		$clad_blog_posts_num                   = $settings['clad_blog_posts_num'];
		$clad_blog_posts_is_manual_selection   = $settings['clad_blog_posts_is_manual_selection'];
		$clad_blog_posts_offset                = $settings['clad_blog_posts_offset'];
		$clad_blog_posts_order_by              = $settings['clad_blog_posts_order_by'];
		$clad_blog_posts_sort                  = $settings['clad_blog_posts_sort'];
		$pagination_onoff                      = $settings['pagination_onoff'];
		$divider_on_off                        = $settings['divider_on_off'];
		$blog_large_container_onoff            = $settings['blog_large_container_onoff'];

		if (is_array($clad_blog_posts_cats)) {
			$clad_blog_posts_cats_ids = implode(', ', $clad_blog_posts_cats);
		} else {
			$clad_blog_posts_cats_ids = $clad_blog_posts_cats;
		}

		$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

		$post_query_list = array(
			'post_type'      => array('post'),
			'post_status'    => array('publish'),
			'paged'          => $paged,
			'posts_per_page' => $clad_blog_posts_num,
			'category_name'  => $clad_blog_posts_cats_ids,
			'orderby'        => $clad_blog_posts_order_by,
			'order'          => $clad_blog_posts_sort,
			'offset'         => $clad_blog_posts_offset,
		);

		if($clad_blog_posts_layout_style == 'classyea_blog_list_post') {
			$clad_column = 'classyea-lg-12';
		} else {
			$clad_column  = $clad_blog_posts_column;
		}

		add_image_size( 'blog-large-image-size', 630, 330 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode
		add_image_size( 'blog-small-image-size', 160, 120 ); // 220 pixels wide by 180 pixels tall, soft proportional crop mode


		$post_query = new \WP_Query($post_query_list);
	if($blog_large_container_onoff != 'yes') {
?>
		<div class="classyea-blog-post <?php echo esc_attr($clad_blog_posts_layout_style); ?>">

			<div class="classyea-con">
				<div class="classyea-row">

					<?php
					if ($post_query->have_posts()) {
						while ($post_query->have_posts()) {

							$post_query->the_post();
							global $post;
							$categories = get_the_category();
					?>
							<div class="<?php echo esc_attr($clad_column); ?>">
								<div class="classyea-blog-post-single <?php echo ($divider_on_off == 'yes') ? 'blog-list-divider' : '';?>">
									<div class="inner-box">

										<?php if ($clad_blog_posts_featured_img == 'yes') : ?>
											<?php if (has_post_thumbnail()) : ?>
												<div class="post-img">
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php the_post_thumbnail($clad_blog_posts_feature_img_size_size); ?>
													</a>
												</div>
											<?php endif; ?>
										<?php endif; ?>

										<div class="lower-content">
											<div class="category"><i class="fas fa-folder"></i> <a href="<?php echo esc_url(get_permalink()); ?>" rel="category tag"><?php 
												if ( ! empty( $categories ) ) {
													echo esc_html( $categories[0]->name );   
												}
											?></a></div>
											<?php if ($clad_blog_posts_title == 'yes') : ?>
												<h3 class="title-post">
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php
														$get_the_title = substr(get_the_title(), 0, $clad_blog_posts_title_trim);
														echo wp_kses_post($get_the_title);
														?>
													</a>
												</h3>
											<?php endif; ?>
											<?php if ($clad_blog_posts_content == 'yes') : ?>
												<div class="content-text">
													<?php
													$get_the_excerpt = substr(get_the_excerpt(), 0, $clad_blog_posts_content_trim);
													echo wp_kses_post($get_the_excerpt);
													?>
												</div>
											<?php endif; ?>
											<?php if ($clad_blog_posts_read_more == 'yes') : ?>
												<div class="read-more-link">
													<a href="<?php echo esc_url(get_permalink()); ?>" class="readmore-link"><i class="flaticon-up-arrow"></i><?php echo esc_html__("More Details","classyea"); ?></a>
												</div>												
											<?php endif; ?>
											<ul>
												<li>
													<div class="post-date">
														<span><?php echo esc_html(get_the_date()); ?></span>
													</div>
												</li>
												<li>
													<div class="post-author">
														<span><?php echo esc_html__("by ","classyea"); ?> <span><?php echo esc_html(get_the_author()); ?></span></span>
													</div>
												</li>
											</ul>
										</div>

									</div>
								</div>
							</div>
					<?php
						}
						wp_reset_postdata(); 
					}

					if( $pagination_onoff == 'yes' ) {
					?>
					<div class="classyea-lg-12">
						<div class="pagination styled-pagination">
							<?php 
								echo paginate_links( array(
									'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
									'total'        => $post_query->max_num_pages,
									'current'      => max( 1, get_query_var( 'paged' ) ),
									'format'       => '?paged=%#%',
									'show_all'     => false,
									'type'         => 'plain',
									'end_size'     => 2,
									'mid_size'     => 1,
									'prev_next'    => true,
									'prev_text'    => sprintf( '<i></i> %1$s', __( 'Prev', 'classyea' ) ),
									'next_text'    => sprintf( '%1$s <i></i>', __( 'Next', 'classyea' ) ),
									'add_args'     => false,
									'add_fragment' => '',
								) );

							?>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>

	<?php } else { ?>

		<div class="classyea-blog-post <?php echo esc_attr($clad_blog_posts_layout_style); ?> classyea-blog-large-small">

			<div class="classyea-con">
				<div class="classyea-row">
				<div class="col-xl-6 col-lg-6 col-sm-12 left-container">
				<?php
					$posts_per_loop = 1; 
					if ($post_query->have_posts()) {
						while ($post_query->have_posts()) {
							global $post;
							$post_query->the_post(); 
							$categories = $post_query->query['category_name'];
							$str_arr = explode (",", $categories); 
							?>
								<div class="classyea-blog-post-single">
									<div class="inner-box large-container">
										<?php if ($clad_blog_posts_featured_img == 'yes') : ?>
											<?php if (has_post_thumbnail()) : ?>
												<div class="post-img">
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php the_post_thumbnail('blog-large-image-size'); ?>
													</a>
													<?php if ( isset( $str_arr[1]) ) { ?>
													<span class="category"> <a href="<?php echo esc_url(get_permalink()); ?>" rel="category tag"><?php 
														if ( isset( $str_arr[1]) ) {
															echo esc_html( $str_arr[1] );   
														}
													?></a></span>
													<?php } ?>
													
												</div>
											<?php endif; ?>
										<?php endif; ?>
										<div class="lower-content">
											<?php if ($clad_blog_posts_title == 'yes') : ?>
												<h3 class="title-post">
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php
														$get_the_title = substr(get_the_title(), 0, $clad_blog_posts_title_trim);
														echo wp_kses_post($get_the_title);
														?>
													</a>
												</h3>
											<?php endif; ?>
											<?php if ($clad_blog_posts_content == 'yes') : ?>
												<div class="content-text">
													<?php
													$get_the_excerpt = substr(get_the_excerpt(), 0, $clad_blog_posts_content_trim);
													echo wp_kses_post($get_the_excerpt);
													?>
												</div>
											<?php endif; ?>
											<?php if ($clad_blog_posts_read_more == 'yes') : ?>
												<div class="read-more-link">
													<a href="<?php echo esc_url(get_permalink()); ?>" class="readmore-link"><i class="flaticon-up-arrow"></i><?php echo esc_html__("More Details","classyea"); ?></a>
												</div>
											<?php endif; ?>
											<ul>
												<li>
													<div class="post-date">
														<span><?php echo esc_html(get_the_date()); ?></span>
													</div>
												</li>
												<li>
													<div class="post-author">
														<span><?php echo esc_html__("by ","classyea"); ?> <span><?php echo esc_html(get_the_author()); ?></span></span>
													</div>
												</li>
											</ul>
										</div>
								</div>
							</div>
							<?php 
							if( $post_query->current_post+1 == $posts_per_loop ) break;  
						}
						wp_reset_postdata(); 
					}
					?>
				</div>
				<div class="col-xl-6 col-lg-6 col-sm-12 right-container">
					<div class="hug-padding-left">
					<?php
					$posts_per_loop2 = 4; 
					if ($post_query->have_posts()) {
						while ($post_query->have_posts()) {
							$categories = get_the_category();
							$post_query->the_post(); ?>
								<div class="classyea-blog-post-single <?php echo esc_attr(($divider_on_off == 'yes') ? 'blog-list-divider' : '');?>">
									<div class="inner-box">

										<?php if ($clad_blog_posts_featured_img == 'yes') : ?>
											<?php if (has_post_thumbnail()) : ?>
												<div class="post-img">
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php the_post_thumbnail('blog-small-image-size'); ?>
													</a>
												</div>
											<?php endif; ?>
										<?php endif; ?>

										<div class="lower-content">
											<div class="category"><i class="fas fa-folder"></i> <a href="<?php echo esc_url(get_permalink()); ?>" rel="category tag"><?php 
												if ( ! empty( $categories ) ) {
													echo esc_html( $categories[0]->name );   
												}
											?></a></div>
											<?php if ($clad_blog_posts_title == 'yes') : ?>
												<h3 class="title-post">
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php
														$get_the_title = substr(get_the_title(), 0, $clad_blog_posts_title_trim);
														echo wp_kses_post($get_the_title);
														?>
													</a>
												</h3>
											<?php endif; ?>
											<?php if ($clad_blog_posts_content == 'yes') : ?>
												<div class="content-text">
													<?php
													$get_the_excerpt = substr(get_the_excerpt(), 0, $clad_blog_posts_content_trim);
													echo wp_kses_post($get_the_excerpt);
													?>
												</div>
											<?php endif; ?>
											<?php if ($clad_blog_posts_read_more == 'yes') : ?>
												<div class="read-more-link">
													<a href="<?php echo esc_url(get_permalink()); ?>" class="readmore-link"><i class="flaticon-up-arrow"></i><?php echo esc_html__("More Details","classyea"); ?></a>
												</div>												
											<?php endif; ?>
											<ul>
												<li>
													<div class="post-date">
														<span><?php echo esc_html(get_the_date()); ?></span>
													</div>
												</li>
												<li>
													<div class="post-author">
														<span><?php echo esc_html__("by ","classyea"); ?> <span><?php echo esc_html(get_the_author()); ?></span></span>
													</div>
												</li>
											</ul>
										</div>
									</div>
							</div>
							<?php
							if( $post_query->current_post+1 == $posts_per_loop2 ) break; 
						}
						wp_reset_postdata(); 
					}
					?>
					</div>
				</div>
				</div>
			</div>
		</div>
<?php
		}
	}
}
