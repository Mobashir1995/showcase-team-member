<?php
namespace Team_Member_Mobashir\Admin\Post_Type;
/**
* Post Type Class
*/
class Post_Team_Member
{
	/**
     * Team Member Post Type constructor.
     */
	function __construct()
	{
		add_action('init', array($this, 'register'));
		add_filter("manage_tmm_team_member_posts_columns", array($this, 'set_custom_columns') );
		add_action("manage_tmm_team_member_posts_custom_column", array($this, 'edit_custom_columns'), 10, 2 );
	}

	/**
     * Register post type
     */
	public function register(){
		$labels = array(
			'name'               => _x( 'Team Member', 'team-member', 'team-member-by-mobashir' ),
			'singular_name'      => _x( 'Team Member', 'team-member', 'team-member-by-mobashir' ),
			'menu_name'          => _x( 'Team Member', 'admin menu', 'team-member-by-mobashir' ),
			'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'team-member-by-mobashir' ),
			'add_new'            => _x( 'Add New Team Member', 'team-member', 'team-member-by-mobashir' ),
			'add_new_item'       => __( 'Add New Team Member', 'team-member-by-mobashir' ),
			'new_item'           => __( 'New Team Member', 'team-member-by-mobashir' ),
			'edit_item'          => __( 'Edit Team Member', 'team-member-by-mobashir' ),
			'view_item'          => __( 'View Team Member', 'team-member-by-mobashir' ),
			'all_items'          => __( 'All Team Members', 'team-member-by-mobashir' ),
			'search_items'       => __( 'Search Team Members', 'team-member-by-mobashir' ),
			'parent_item_colon'  => __( 'Parent Team Member:', 'team-member-by-mobashir' ),
			'not_found'          => __( 'No Team Members found.', 'team-member-by-mobashir' ),
			'not_found_in_trash' => __( 'No Team Members found in Trash.', 'team-member-by-mobashir' )
		);	

		$args = array(
					'labels' => $labels,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'rewrite'            => array('slug'=>'tmm_team_member'),
					'capability_type'    => 'post',
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_icon'          =>'dashicons-groups',
					'menu_position'      => 50,
					'supports' 			 => array( 'title', 'thumbnail', 'editor' )
				);

		register_post_type( 'tmm_team_member' , $args);
	}

	/**
	 * set custom columns 
	 *
     * @param $columns
     *
     * @return array
     *
     */
	public function set_custom_columns( $columns ){
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => 'Name',
			'position' => 'Position',
			'image' => 'Image',
			'bio' => 'Bio'
		);
		return $columns;
	}

	/**
	 * show content and image in custom column 
	 *
     * @param $column
     * @param $post_id
     *
     */
    public function edit_custom_columns( $column, $post_id ) {
        switch ($column) {	
			case 'title':
				the_title();  
			break;	
			case 'position':
				echo get_post_meta( $post_id, 'team_member_position', true );  
			break;	
			case 'image':
				the_post_thumbnail('thumbnail');  
			break;	
			case 'bio':
				the_excerpt();  
			break;	
		}
    }
}


new Post_Team_Member();