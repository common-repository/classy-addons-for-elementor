<?php
namespace ClassyEa\Helper;
use ClassyEa\Helper\Traits\Classyea_Module;
/**
 * Installer class
 */
class Installer {

    use Classyea_Module;

    /**
     * Run the installer
     *
     * @return void
     */
    public function run() {
        $this->classyea_add_version();
    }

    /**
     * Add time and version on DB
     */
    public function classyea_add_version() {

        $installed = get_option( 'classyea_installed' );

        if ( ! $installed ) {
            $option_list      = $this->classyea_default_option();
            $option_array_key = array_keys($option_list);
		    update_option( 'classyea_enable_widget', $option_array_key );
            update_option( 'classyea_installed', time() );
        }
    }
}
