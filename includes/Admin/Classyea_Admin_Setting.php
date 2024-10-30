<?php
namespace ClassyEa\Helper\Admin;

class Classyea_Admin_Setting {


    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'classyea_admin_enqueue_scripts'));
        $this->classyea_admin_setting_page();

        add_filter('classyea_deactivate_feedback_form_filter', array( $this,'classyea_feedback_form_filter_func' ) );


    }

    public function classyea_admin_setting_page(){

        if( is_admin() ) {
            new Admin_Setting\Classyea_General_Setting();
        }
    }

    public function classyea_admin_enqueue_scripts()
	{
        $screen = \get_current_screen();
        global $pagenow;
        
		if($screen->id == 'toplevel_page_classyea-settings') {
            wp_enqueue_style('classyea-elementor-admin-css', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/css/classyea-admin.css', false, time());
            wp_enqueue_script( 'classyea-setting-js', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/js/classyea-setting.js', array( 'jquery' ), CLASSYEA_VERSION, true );
        }
        wp_enqueue_style('classyea-rating-css', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/css/classyea-rating.css', false, CLASSYEA_VERSION );
        
        // Enqueue scripts

        if($pagenow === "plugins.php") {
        
            wp_enqueue_style('classyea-remodal-css', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/css/remodal.css',false, CLASSYEA_VERSION );
            wp_enqueue_style('classyea-remodal-default-theme', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/css/remodal-default-theme.css',false, CLASSYEA_VERSION );
            wp_enqueue_style('classyea-feedback-form-css', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/css/deactivate-feedback-form.css',false, CLASSYEA_VERSION );

            wp_enqueue_script('classyea-remodal-js', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/js/remodal.min.js',array( 'jquery' ), CLASSYEA_VERSION, true );
            wp_enqueue_script('classyea-feedback-form-handle', CLASSYEA_CORE_ASSETS . 'assets/elementor/admin/js/deactivate-feedback-form.js',array( 'jquery' ), time(), true );

            // feedback array 
            $feedback_arr = [
                'quick_feedback'			=> __('Quick Feedback', 'classyea'),
                'why_deactive_plugin'					=> __('If you would be kind enough, please tell us why you\'re deactivating?', 'classyea'),
                'better_plugins_name'		=> __('Please tell us which plugin?', 'classyea'),
                'please_tell_us'			=> __('Please tell us the reason so we can improve the plugin', 'classyea'),
                'do_not_attach_email'		=> __('Do not send my e-mail address with this feedback', 'classyea'),
                
                'brief_description'			=> __('Please give us any feedback that could help us improve', 'classyea'),
                'time'						=> time(),
                'domain'					=> site_url(),
                'classy_uninstall_nonce'	=> wp_create_nonce( 'classy_uninstall_nonce' ),
                'cancel'					=> __('Cancel', 'classyea'),
                'skip_and_deactivate'		=> __('Skip &amp; Deactivate', 'classyea'),
                'submit_and_deactivate'		=> __('Submit &amp; Deactivate', 'classyea'),
                'please_wait'				=> __('Please wait', 'classyea'),
                'thank_you'					=> __('Thank you!', 'classyea')
            ];

            // Localized script register

            wp_localize_script('classyea-feedback-form-handle', 'classyea_feedback_obj', $feedback_arr );
            
            // feedback filter
            $feedbacks = apply_filters('classyea_deactivate_feedback_form_filter', array());

            
            // Reasons array data
            $reason_array_data = array(
                'suddenly-stopped-working'	=> __('The plugin suddenly stopped working', 'classyea'),
                'plugin-broke-site'			=> __('The plugin broke my site', 'classyea'),
                'no-longer-needed'			=> __('I don\'t need this plugin any more', 'classyea'),
                'found-better-plugin'		=> __('I found a better plugin', 'classyea'),
                'temporary-deactivation'	=> __('It\'s a temporary deactivation, I\'m troubleshooting', 'classyea'),
                'other'						=> __('Other', 'classyea'),
            );
            
            foreach($feedbacks as $feedback)
            {
                $feedback->reasons = apply_filters('classyea_deactivate_feedback_form_reasons', $reason_array_data, $feedback);
            }
            
            /*  plugin data sending */
            wp_localize_script( 'classyea-feedback-form-handle', 'classyea_deactivate_feedback_form_filter', $feedbacks );

        }

	}

    public function classyea_feedback_form_filter_func( $feedbacks ) {
        return $feedbacks;
    }
    
}