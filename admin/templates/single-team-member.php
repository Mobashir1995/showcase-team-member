<?php
namespace Team_Member_Mobashir\Admin\Templates\Single_Post;
/**
* Team Member Single Post Class to Render Individual Member
*/
class Team_Member_Single_Post
{
	/**
	 * Team Member Single Post Constructor.
	 */
	function __construct(){
		add_filter( 'single_template', array( $this, 'render_single_team_member' ) );
	}

	/**
	 * Assign Single Member Template
     * @param $template array 
     */
	public function render_single_team_member( $template ){
		global $post;
	    $post_type = $post->post_type;
	    if( $post_type == 'tmm_team_member' ){
		    $template = plugin_dir_path( __FILE__ ) . '../../templates/single-team-member.php';
		    if ( $template && ! empty($template) ){
		    	return $template;
		    }
		}
	}
}

new Team_Member_Single_Post();
