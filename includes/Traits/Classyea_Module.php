<?php
namespace ClassyEa\Helper\Traits;

trait Classyea_Module {

    public function classyea_default_option() {

        $classyea_module_list = [
            'classyea-advanced-accordion' =>
            [
                'Advanced Accordion',
                'Classyea_Widget_Accordion',
                'https://classyaddons.com/elementor-accordion-widget/'
            ],
            'classyea-team-member'        =>
            [
                'Team Member',
                'Classyea_Team_Member',
                'https://classyaddons.com/elementor-team-widget/'
            ],
            'classyea-business-hours'     =>
            [
                'Business Hours',
                'Classyea_Business_Hour',
                'https://classyaddons.com/elementor-business-hour-widget/'
            ],
            'classyea-flip-box'           =>
            [
                'Flip Box',
                'Classyea_FlipBox',
                'https://classyaddons.com/elementor-flip-box-widget/'
            ],
            'classyea-image-comparison'   =>
            [
                'Image Comparison',
                'Classyea_Image_Comparison',
                'https://classyaddons.com/elementor-image-compare-widget/'
            ],
            'classyea-testimonial'        =>
            [
                'Testimonial',
                'Classyea_Testimonial',
                'https://classyaddons.com/elementor-testimonial-widget/'
            ],
            'classyea-service'            =>
            [
                'Service Box',
                'Classyea_Service',
                'https://classyaddons.com/elementor-service-box-widget/'
            ],
            'classyea-filterable-gallery' =>
            [
                'Filterable Gallery',
                'Classyea_Portfolio_Gallery',
                'https://classyaddons.com/elementor-filterable-gallery-widget/'
            ],
            'classyea-image-accordion'    =>
            [
                'Image Accordion',
                'Classyea_Image_Accordion',
                'https://classyaddons.com/elemetor-image-accordion-widget/'
            ],
            'classyea-counterup'          =>
            [
                'CounterUp',
                'Classyea_Counterup',
                'https://classyaddons.com/elementor-counter-up-widget/'
            ],
            'classyea-contact-from'       =>
            [
                'Contact From',
                'Classyea_Contact_From',
                'https://classyaddons.com/elementor-contact-form-7-widget/'
            ],
            'classyea-animated-link'      =>
            [
                'Animated Link',
                'Classyea_Animated_Link',
                'https://classyaddons.com/classy-animated-link/'
            ],
            'classyea-image-hotspots'     =>
            [
                'Image Hotspots',
                'Classyea_Image_Hotspots',
                'https://classyaddons.com/elementor-image-hotspots/'
            ],
            'classyea-image-carousel'     =>
            [
                'Image Carousel',
                'Classyea_Image_Carousel',
                'https://classyaddons.com/elementor-image-carousel/'
            ],
            'classyea-logo-carousel'      =>
            [
                'Logo Carousel',
                'Classyea_Logo_Carousel',
                'https://classyaddons.com/elementor-logo-carousel-widget/'
            ],
            'classyea-pricing-table'      =>
            [
                'Pricing Table',
                'Classyea_Pricing_Table',
                'https://classyaddons.com/elementor-pricing-table/'
            ],
            'classyea-progress-bar'       =>
            [
                'Progress Bar',
                'Classyea_Progress_Bar',
                'https://classyaddons.com/elementor-progress-bar/'
            ],
            'classyea-tab'                =>
            [
                'Advanced Tab',
                'Classyea_Tab',
                'https://classyaddons.com/elementor-tab-widget/'
            ],
            'classyea-countdown'          =>
            [
                'Countdown',
                'Classyea_CountDown',
                'https://classyaddons.com/elementor-countdown/'
            ],
            'classyea-blog-grid'          =>
            [
                'Blog Post',
                'Classyea_Blog_Grid',
                'https://classyaddons.com/elementor-blog-grid/'
            ],
            'classyea-twitter-post'      =>
            [
                'Twitter Feed',
                'Classyea_Twitter_Posts',
                'https://classyaddons.com/elementor-twitter-post/'
            ],
            'classyea-step-flow'      =>
            [
                'Step Flow',
                'Classyea_Step_Flow',
                'https://classyaddons.com/classy-step-flow/'
            ],
            'classyea-heading'      =>
            [
                'Heading',
                'Classyea_Heading',
                'https://classyaddons.com/heading-widget/'
            ], 
            'classyea-newsticker'      =>
            [
                'News Ticker',
                'Classyea_News_Ticker',
                'https://classyaddons.com/elementor-newsticker/'
            ], 
            'classyea-site-logo'      =>
            [
                'Site Logo',
                'Classyea_Site_Logo',
            ], 
            'footer_copyright'      =>
            [
                'Footer Copyright',
                'ClassyEa_Footer_Copyright',
            ], 
            'classyea-header-info' =>
            [
                'Header Info',
                'Classyea_Header_Info',
            ],
            'classyea-header-search' =>
            [
                'Header Search',
                'Classyea_Header_Search',
            ],
            'classyea-nav-menu' =>
            [
                'Nav Menu',
                'Classyea_Nav_Menu',
            ],

            
            
        ];
        return $classyea_module_list;
    }

}