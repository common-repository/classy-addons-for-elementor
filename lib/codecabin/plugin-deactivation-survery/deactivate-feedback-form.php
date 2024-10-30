<?php
if (!defined('ABSPATH')) {
	exit;
}

if(!is_admin())
	return;

global $pagenow;

if($pagenow != "plugins.php")
	return;

if(defined('CLASSYEA_DEACTIVATE_FEEDBACK_FORM_INCLUDED'))
	return;
define('CLASSYEA_DEACTIVATE_FEEDBACK_FORM_INCLUDED', true);

add_action('admin_enqueue_scripts', function() {
	
	// Enqueue scripts
	wp_enqueue_script('remodal', plugin_dir_url(__FILE__) . 'remodal.min.js');
	wp_enqueue_style('remodal', plugin_dir_url(__FILE__) . 'remodal.css');
	wp_enqueue_style('remodal-default-theme', plugin_dir_url(__FILE__) . 'remodal-default-theme.css');
	
	wp_enqueue_script('classyea-deactivate-feedback-form', plugin_dir_url(__FILE__) . 'deactivate-feedback-form.js');
	wp_enqueue_style('classyea-deactivate-feedback-form', plugin_dir_url(__FILE__) . 'deactivate-feedback-form.css');
	
	// Localized strings
	wp_localize_script('classyea-deactivate-feedback-form', 'classyea_deactivate_feedback_form_strings', array(
		'quick_feedback'			=> __('Quick Feedback', 'classyea'),
		'foreword'					=> __('If you would be kind enough, please tell us why you\'re deactivating?', 'classyea'),
		'better_plugins_name'		=> __('Please tell us which plugin?', 'classyea'),
		'please_tell_us'			=> __('Please tell us the reason so we can improve the plugin', 'classyea'),
		'do_not_attach_email'		=> __('Do not send my e-mail address with this feedback', 'classyea'),
		
		'brief_description'			=> __('Please give us any feedback that could help us improve', 'classyea'),
		'admin_email'				=> get_option('admin_email'),
		'time'						=> time(),
		'domain'					=> site_url(),
		'classy_uninstall_nonce'	=> wp_create_nonce( 'classy_uninstall_nonce' ),
		'cancel'					=> __('Cancel', 'classyea'),
		'skip_and_deactivate'		=> __('Skip &amp; Deactivate', 'classyea'),
		'submit_and_deactivate'		=> __('Submit &amp; Deactivate', 'classyea'),
		'please_wait'				=> __('Please wait', 'classyea'),
		'thank_you'					=> __('Thank you!', 'classyea')
	));
	
	// Plugins
	$plugins = apply_filters('classyea_deactivate_feedback_form_plugins', array());

	
	// Reasons
	$defaultReasons = array(
		'suddenly-stopped-working'	=> __('The plugin suddenly stopped working', 'classyea'),
		'plugin-broke-site'			=> __('The plugin broke my site', 'classyea'),
		'no-longer-needed'			=> __('I don\'t need this plugin any more', 'classyea'),
		'found-better-plugin'		=> __('I found a better plugin', 'classyea'),
		'temporary-deactivation'	=> __('It\'s a temporary deactivation, I\'m troubleshooting', 'classyea'),
		'other'						=> __('Other', 'classyea'),
	);
	
	foreach($plugins as $plugin)
	{
		$plugin->reasons = apply_filters('classyea_deactivate_feedback_form_reasons', $defaultReasons, $plugin);
	}
	
	// Send plugin data
	wp_localize_script('classyea-deactivate-feedback-form', 'classyea_deactivate_feedback_form_plugins', $plugins);
});

/**
 * Hook for adding plugins, pass an array of objects in the following format:
 *  'slug'		=> 'plugin-slug'
 *  'version'	=> 'plugin-version'
 * @return array The plugins in the format described above
 */
add_filter('classyea_deactivate_feedback_form_plugins', function($plugins) {

	return $plugins;
});





