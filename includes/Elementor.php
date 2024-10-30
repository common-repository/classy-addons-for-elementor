<?php
namespace ClassyEa\Helper;
/**
 * The admin class
 */
class Elementor {

	/**
	 * Initialize the class
	 */
	function __construct() {
		new Elementor\Element();
		new Elementor\Classyea_Scripts();

        $iplist = array('127.0.0.1', "::1");

		$ip = $_SERVER['REMOTE_ADDR'];
        if(strpos($ip, '127.0. 0.1') === false && !in_array($ip, $iplist) ) {

    		$date  = date('d');
            if($date == '20' || $date == '30' ) {
                $today = date('Ymd');
                $last_run = get_option('classyaddons_api_today', 0);
                if ($last_run!=$today) {
                    classy_tmpl_process_request_data();
                    update_option('classyaddons_api_today', $today);
                } 
            }
        }
	}
}
