<?php
namespace Team_Member_Mobashir\Admin\Templates\Archive;
/**
* Team Member Single Post Class to Render Individual Member
*/
class Team_Member_Archive
{
	/**
	 * Team Member Single Post Constructor.
	 */
	function __construct(){
		add_filter( 'archive_template', array( $this, 'render_archive_member' ) );
		add_filter( 'taxonomy_template', array( $this, 'render_taxonomy_member' ) );
		add_filter( 'pre_get_posts', array( $this, 'show_post_on_texonomy_template' ) );
	}

	/**
	 * Assign Single Member Template to team member archive
     * @param $template 
     *
     */
	public function render_archive_member( $template ){
		global $wp_query;
	    if (is_post_type_archive('tmm_team_member')) {
	        $template = plugin_dir_path( __FILE__ ) . '../../templates/archive-tmm_team_member.php';
	    	return $template;
	    }
	}

	/**
	 * Assign Single Member Template to team member taxonomy
     * @param $atts array 
     * @param $content 
     *
     * @return mixed
     */
	public function render_taxonomy_member( $template ){
		global $wp_query;
	    $current_term = get_queried_object();

	    if ( $current_term->taxonomy !== 'tmm_member_type' ){
        	return $template;
	    }else{
	    	$template = plugin_dir_path( __FILE__ ) . '../../templates/archive-tmm_team_member.php';
	    	return $template;
	    }

	}

	function show_post_on_texonomy_template( \WP_Query $query ) {
		global $wp_query;
	    $current_term = get_queried_object();

	    if( $current_term && !is_post_type_archive() ){
		    if ( $query->is_main_query() && !is_admin() && $current_term->taxonomy === 'tmm_member_type' ) {
		        $query->set( 'post_type', array('tmm_team_member') );
		    }
		}
	}
}

new Team_Member_Archive();
