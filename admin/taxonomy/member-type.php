<?php
namespace Team_Member_Mobashir\Admin\Taxonomy;
/**
* Post Type Class
*/
class Taxonomy_Member_type
{
	/**
     * Member Type Taxonomy constructor.
     */
	function __construct()
	{
		add_action('init', array($this, 'register'));
	}

	/**
     * Register taxonomy
     */
	public function register(){
		$labels = array(
			'name'              => _x( 'Member Types', 'member-type', 'team-member-by-mobashir' ),
			'singular_name'     => _x( 'Member Type', 'member-type', 'team-member-by-mobashir' ),
			'search_items'      => __( 'Search Member Types', 'team-member-by-mobashir' ),
			'all_items'         => __( 'All Member Types', 'team-member-by-mobashir' ),
			'parent_item'       => __( 'Parent Member Type', 'team-member-by-mobashir' ),
			'parent_item_colon' => __( 'Parent Member Type:', 'team-member-by-mobashir' ),
			'edit_item'         => __( 'Edit Member Type', 'team-member-by-mobashir' ),
			'update_item'       => __( 'Update Member Type', 'team-member-by-mobashir' ),
			'add_new_item'      => __( 'Add New Member Type', 'team-member-by-mobashir' ),
			'new_item_name'     => __( 'New Member Type Name', 'team-member-by-mobashir' ),
			'menu_name'         => __( 'Member Type', 'team-member-by-mobashir' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'member-type' ),
		);

		register_taxonomy( 'tmm_member_type', 'tmm_team_member', $args );
	}
}

new Taxonomy_Member_type();