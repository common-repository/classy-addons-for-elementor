<?php 
namespace ClassyEa\Helper;
/**
 * user review
 */
class Review {
    
    public function __construct()
	{

		// Register  deactive Active Hook
        add_action( 'admin_init', [$this,'classyea_check_installation_time'] );
        add_action( 'admin_init', [$this,'classyea_void_spare_me'], 5 );

	}

    //check if review notice should be shown or not

    public function classyea_check_installation_time() {   

        
        $classyea_nobug = get_option( 'rated_status', "0");

        if ($classyea_nobug == "1" || $classyea_nobug == "2") {
            return;
        }

        $install_date = get_option( 'classyea_installed', strtotime("now") );
        $past_date    = strtotime( '-7 days' );
        
        $remind_time   = get_option( 'classyea_remind_me',strtotime("now"));
        $remind_due    = strtotime( "+15 days", $remind_time);
       
        $now           = strtotime("now");

        if ($now >= $remind_due) {
            add_action( 'admin_notices', [ $this, 'classyea_grid_display_admin_notice']);
        }
        if (($past_date >= $install_date) &&  $classyea_nobug !== "3") {
              add_action( 'admin_notices', [ $this, 'classyea_grid_display_admin_notice']);
         }

    }

    public function classyea_grid_display_admin_notice() {
        global $pagenow;

        $exclude = [ 'themes.php', 'users.php', 'tools.php', 'options-general.php', 'options-writing.php', 'options-reading.php', 'options-discussion.php', 'options-media.php', 'options-permalink.php', 'options-privacy.php', 'edit-comments.php', 'upload.php', 'media-new.php', 'admin.php', 'import.php', 'export.php', 'site-health.php', 'export-personal-data.php', 'erase-personal-data.php' ];

        if ( ! in_array( $pagenow, $exclude ) ) {
            $admin_url = $this->classyea_current_admin_url();
            $classyea_dont_disturb = esc_url( add_query_arg( 'rated_status', '1', $admin_url ) );
            $classyea_remind_me    = esc_url( add_query_arg( 'rated_status', '3', $admin_url ) );
            $rated                 = esc_url( add_query_arg( 'rated_status', '2', $admin_url ) );
            $classyea_reviewurl    = esc_url( 'https://wordpress.org/support/plugin/classy-addons-for-elementor/reviews/?rate=5#new-post' ); ?>
            
                <div class="classyea-review-wrap">
                    <div class="classyea-review-content">
                        <h2><?php _e("Enjoying Classy Addons","classyea");?></h2>
                        <p><?php echo wp_kses("You have been using our plugin for a week now, do you like it? If so, please leave us a review with your feedback! ","classyea_kses"); ?></p>
                    </div>
                    <?php printf(__('<div class="void-review-btn">
                        <a href="%s" class="classyea-rated-btn" target="_blank">👍 Rate Now!</a>
                        <a href="%s" class="classyea-void-grid-review-done">🙌 Already Rated !</a>
                        <a href="%s" class="classyea-remind-me-btn"><span>🔔 Remind Me Later</span></a>
                        <a href="%s" class="classyea-btn-danger"><span>💔 No Thanks</span></a>
                    </div>'),$classyea_reviewurl, $rated, $classyea_remind_me, $classyea_dont_disturb ); ?>
                </div> 
            <?php         
        }
    }

    /**
    * Display Admin Notice, asking for a review
    **/
    

    // remove the notice for the user if review already done or if the user does not want to
    public function classyea_void_spare_me(){    
        if( isset( $_GET['rated_status'] ) && !empty( $_GET['rated_status'] ) ){
            $rated_status = $_GET['rated_status'];
            if( '1' == $rated_status ){
                update_option( 'rated_status', "1" );
            } 
            elseif ( '3' == $rated_status ) {
                $get_activation_time = strtotime( "now" );
                update_option( 'classyea_remind_me', $get_activation_time );
                update_option( 'rated_status', "3" );
            } elseif ( '2' == $rated_status ) {
                update_option( 'rated_status', '2' );
                
            }
        }
        
    }

    public function classyea_current_admin_url() {
        $classyea_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
        $classyea_uri = preg_replace( '|^.*/wp-admin/|i', '', $classyea_uri );

        if ( ! $classyea_uri ) {
            return '';
        }
        return remove_query_arg( [ '_wpnonce', '_wc_notice_nonce', 'wc_db_update', 'wc_db_update_nonce', 'wc-hide-notice' ], admin_url( $classyea_uri ) );
    }
    
}