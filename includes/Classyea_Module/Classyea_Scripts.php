<?php
namespace ClassyEa\Helper\Classyea_Module;

/**
 * The Menu handler class
 */
class Classyea_Scripts {

    public function __construct() {

        // Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'classyea_widget_scripts' ) );
        // Register widget Style
        add_action( 'wp_head', array( $this, 'classyea_register_assets' ), 10 );
        add_filter( 'classyea_combine_ele_css_pb_build_css_assets_css_path', array( $this, 'classyea_css_list' ) );
        add_filter( 'classyea_combine_ele_css_pb_build_css_assets_css_url', array( $this, 'classyea_css_list_url' ) );
        add_filter( 'classyea_combine_ele_css_pb_sc_list_array', array( $this, 'classyea_array_list' ) );

    }

    /**
     * All available scripts
     *
     * @return array
     */
    public function classyea_get_scripts() {
        return [
            'classyea-accordion-script'       => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/accordion/classyea-accordion.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-business-hours'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/business-hour/classyea-business-hour.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-image-accordion-script' => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-accordion/classyea-image-accordion.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-counterup'              => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/counterup/classyea-counter.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-counterTo'              => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/counterup/countTo.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-appear-script'          => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/counterup/appear.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],

            'classyea-filterable-gallery'     => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/gallery-portfolio/classyea-gallery-image.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],

            'classyea-jquery-even-move'       => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-comparison/jquery.event.move.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-twentytwenty'           => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-comparison/jquery.twentytwenty.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-image-compare-twenty'   => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-comparison/classyea-image-compare-twenty.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],

            'classyea-image-hotspots-script'  => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-hotspot/classyea-hotspots.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-jquery-simpleslider'    => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-carousel/jquery.simpleslider.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-owl-carousel'           => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/owl-carousel/owl.carousel.min.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-image-carousel'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/image-carousel/classyea-image-carousel.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-appear'                 => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/counterup/appear.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-logo-carousel-script'   => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/logo-carousel/logo-carousel.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-bxslider-script'        => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/bxslider/bxslider.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-testimonial-script'     => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/testimonial/testimonial-slider.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-tab-script'             => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/tab/classyea-tab.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],

            'classyea-countdown'              => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/countdown/countdown.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-twitter'                => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/twitter/twitter.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-news-ticker-loaded'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/newsticker/newsticker.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-flipbox-js'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/flipbox/flipbox.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-searchbox-js'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/header-search/header-search.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-scrollbar-js'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/nav-menu/scrollbar.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],
            'classyea-nav-menu-js'         => [
                'src'     => CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/nav-menu/nav-menu.js',
                'version' => CLASSYEA_VERSION,
                'deps'    => ['jquery'],
            ],

            
            

        ];
    }

    public function classyea_widget_scripts() {

        $scripts = $this->classyea_get_scripts();
       
        foreach ( $scripts as $handle => $script ) {
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;
            wp_register_script( $handle, $script['src'], $deps, $script['version'], true );
        }

        wp_enqueue_script( 'classyea-progressbar-js', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/progress-bar/progressbar.js', array( 'jquery' ), CLASSYEA_VERSION, true );

        wp_enqueue_script(
            'font-awesome-4-shim-classyea',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/js/v4-shims.min.js',
            false,
            CLASSYEA_VERSION
        );

        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            wp_enqueue_script( 'classyea-progressbar-bar', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/progress-bar/progressbar-backend.js', array( 'jquery' ), CLASSYEA_VERSION, true );
        } else {
            wp_enqueue_script( 'classyea-progressbar-frontend', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/js/progress-bar/progressbar-frontend.js', array( 'jquery' ), CLASSYEA_VERSION, true );
        }

    }

    /**
     * Register scripts and styles
     *
     * @return void  
     */
    public function classyea_register_assets() {
        wp_enqueue_style( 'classyea-stylesheet', CLASSYEA_CORE_ASSETS . 'assets/elementor/icons/classyea-icon.css', false,CLASSYEA_VERSION );
        wp_register_style( 'classyea-main-style', CLASSYEA_CORE_ASSETS . 'assets/elementor/icons/main-style.css', false, CLASSYEA_VERSION );
        wp_enqueue_style( 'classyea-globle-style', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/css/classiy-globle.css', false, CLASSYEA_VERSION );
        wp_register_style( 'classyea-fontawesome-5to8', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/css/fontawesome/css/font-awesome.min.css', false, CLASSYEA_VERSION );

         // register fontawesome as fallback
        wp_register_style(
            'font-awesome-5-all-classyea',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css',
            false,
            CLASSYEA_VERSION
        );

        wp_register_style(
            'font-awesome-4-shim-classyea',
            ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/v4-shims.min.css',
            false,
            CLASSYEA_VERSION
        );

        wp_register_style( 'classyea-nav-menu', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/css/nav-menu/navmenu.min.css', false, time() );
        wp_register_style( 'classyea-header-search', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/css/header-search/headersearch.min.css', false, time() );
        wp_register_style( 'classyea-header-info', CLASSYEA_CORE_ASSETS . 'assets/elementor/front/css/header-info/headerinfo.min.css', false, time() );

    }

    public function classyea_css_list( $classyea_css_path ) {
      
        $classyea_css_path = [
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/accordion/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/animated-link/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/blog/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/business-hour/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/contact-form/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/countdown/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/counterup/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/flipbox/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/gallery-portfolio/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/image-accordion/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/image-carousel/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/image-comparison/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/image-hotspot/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/logo-carousel/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/owl-carousel/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/pricing-table/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/progress-bar/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/service/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/progress-bar/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/step-flow/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/tab/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/team-member/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/testimonial/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/twitter/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/heading/",
            CLASSYEA_PLUGIN_PATH . "assets/elementor/front/css/newsticker/",
        ];

        return $classyea_css_path;

    }

    public function classyea_css_list_url() {

        $css_path_url = [
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/accordion/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/animated-link/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/blog/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/business-hour/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/contact-form/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/countdown/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/counterup/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/flipbox/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/gallery-portfolio/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/image-accordion/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/image-carousel/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/image-comparison/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/image-hotspot/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/logo-carousel/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/owl-carousel/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/pricing-table/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/progress-bar/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/service/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/progress-bar/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/step-flow/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/tab/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/team-member/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/testimonial/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/twitter/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/heading/",
            CLASSYEA_PLUGIN_URL . "assets/elementor/front/css/newsticker/",
        ];

        return $css_path_url;

    }

    public function classyea_array_list( $classyea_css_array ) {

        $classyea_css_array = array(
            'classyea-animated-link'           => array(
                'css'      => array( 'classyea-animated-link' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-blog-grid'               => array(
                'css'      => array( 'classyea-blog' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-business-hours'   => array(
                'css'      => array( 'classyea-business-hour' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-contact-from'     => array(
                'css'      => array( 'classyea-contact-from' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-countdown'        => array(
                'css'      => array( 'classyea-countdown' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-counterup'        => array(
                'css'      => array( 'classyea-counterup' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-flipbox'          => array(
                'css'      => array( 'classyea-flipbox' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-image-accordion'  => array(
                'css'      => array( 'classyea-image-accordion' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-image-carousel'          => array(
                'css'      => array( 'classyea-image-carousel','owl-carousel','owl-theme-default' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-image-comparison' => array(
                'css'      => array( 'classyea-image-compare', 'comparison-twenty', 'twenty-twenty' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-image-hotspots'          => array(
                'css'      => array( 'classyea-hot-spot' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-gallery-widget'          => array(
                'css'      => array( 'classyea-gallery-portfolio' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-pricing-table'    => array(
                'css'      => array( 'pricing-table' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-progress-bar'     => array(
                'css'      => array( 'progress-bar','progressbar' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-service'          => array(
                'css'      => array( 'classyea-service' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-step-flow'               => array(
                'css'      => array( 'step-flow' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-tab-widget'              => array(
                'css'      => array( 'classyea-tab' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-widget-team-member'      => array(
                'css'      => array( 'classyea-team-member' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-testimonial-widget'      => array(
                'css'      => array( 'classyea-testimonial','owl-carousel','owl-theme-default' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-twitter-posts'           => array(
                'css'      => array( 'classyea-twitter' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea_widget_accordion'        => array(
                'css'      => array( 'classyea-accordion' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-logo-carousel'           => array(
                'css'      => array( 'logo-carousel','owl-carousel','owl-theme-default' ),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-heading'                  => array(
                'css'      => array( 'heading'),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),
            'classyea-news-ticker'       => array(
                'css'      => array( 'newsticker'),
                'js'       => array(),
                'external' => array(
                    'css' => array(),
                    'js'  => array(),
                ),
            ),  

        );
        return $classyea_css_array;
    }
}