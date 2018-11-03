<?php
/**
 Plugin Name: Team Member By Mobashir
 Description: Team Member plugin to show your team members
 Version: 1.0
 Author URI: https://profiles.wordpress.org/webbuilder03
 License: GPLv2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 Text Domain: team-member-by-mobashir
 */

 namespace Team_Member_Mobashir;

 /**
 * Main Class
 */
 class Team_Member
 {
 	/**
     * Plugin constructor.
     *
     * When class is instantiated
     */
 	function __construct()
 	{	
 		if ( ! defined( 'TMM_ABSPATH' ) ) {
			define( 'TMM_ABSPATH', dirname( __FILE__ ) . '/' );
		}
		if ( ! defined( 'TMM_REALPATH' ) ) {
			define( 'TMM_REALPATH', plugin_dir_url( __FILE__ ) );
		}
 		
 		$this->includes();
 	}

 	/**
	 * include all required files
	 */	
 	public function includes(){
 		require_once( TMM_ABSPATH . '/admin/post-type/team-member.php' );
 		require_once( TMM_ABSPATH . '/admin/taxonomy/member-type.php' );
 		require_once( TMM_ABSPATH . '/admin/metabox/team-member-metabox.php' );
 		require_once( TMM_ABSPATH . '/admin/shortcode/team-members-shortcode.php' );
 		require_once( TMM_ABSPATH . '/admin/templates/single-team-member.php' );
 		require_once( TMM_ABSPATH . '/admin/templates/archive-team-member.php' );
 		require_once( TMM_ABSPATH . '/admin/settings/settings.php' );
 		require_once( TMM_ABSPATH . '/admin/settings/shortcode-builder-button.php' );

 		//enqueue stylesheets
 		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
 	}

 	/**
	 * enqueue stylesheets
     */
 	public function enqueue_styles(){
 		wp_enqueue_style('tmm_team-member-style', TMM_REALPATH.'assets/css/style.css', array(), true);
 	}
 }


 new Team_Member();