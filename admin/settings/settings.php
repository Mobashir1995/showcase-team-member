<?php
namespace Team_Member_Mobashir\Admin\Settings;
/**
* Team Member Shortcode Class
*/
class Team_Member_Settings
{
	/**
	 * Team Member Settings Constructor.
	 */
	function __construct(){
		add_action( 'admin_menu', array( $this, 'create_menu_page' ) );
		add_action( 'admin_menu', array( $this, 'create_settings_section' ) );
		add_filter( 'register_post_type_args', array( $this, 'change_post_type_slug' ), 10, 2 );
		add_action( 'wp_loaded', array( $this, 'change_post_type_name' ), 0 );
	}

	/**
	 * Add Menu Page
	 */	
	public function create_menu_page(){
		add_menu_page(
			'Team Member Settings',
			'Team Member Settings',
			'manage_options',
			'tmm_team_member_settings',
			array( $this, 'menu_page_callback')
		);
	}

	/**
	 * Menu Page Callback function
	 */	
	public function menu_page_callback(){
		echo '<form method="post" action="">';
		echo '<h1>Settings Page for Team Members</h1>';
		do_settings_sections('tmm_team_member_settings');
		submit_button(); 
		echo '</form>';
	}

	/**
	 * Add Settings Section to Menu Page
	 */	
	public function create_settings_section()
	{
		add_settings_section(
		    'tmm_team_member_post_type_settings',
		    __( 'Change Name and url slug', 'textdomain' ),
		    array( $this, 'settings_section_callback'),
		    'tmm_team_member_settings'
		);
	}

	/**
	 * Settings Section Callback
	 */	
	public function settings_section_callback(){
		//get name from user
		global $wp_post_types;
		$labels = $wp_post_types['tmm_team_member']->labels;

		$post_type_new_name = get_option('tmm_post_type_name');

		if( $post_type_new_name && !empty($post_type_new_name)  ){
			$post_type_new_name = get_option('tmm_post_type_name');
		}else{
			$post_type_new_name = $labels->name;
		}

		$post_type_data = get_post_type_object( 'tmm_team_member' );
		$post_type_slug = $post_type_data->rewrite['slug'];

		$post_type_new_slug = get_option('tmm_post_type_slug');

		if( $post_type_new_slug && !empty($post_type_new_slug)  ){
			$post_type_new_slug = get_option('tmm_post_type_slug');
		}else{
			$post_type_new_slug = $post_type_slug;
		}
	?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for='tmm_post_type_name'>Post Type Name</label></th>
					<td>
						<input type="text" name="tmm_post_type_name" id="tmm_post_type_name" value="<?php echo esc_attr($post_type_new_name); ?>" />
					</td>
				</tr>
				<tr>
					<th scope="row"><label for='tmm_post_type_slug'>Post Type URL Slug</label></th>
					<td>
						<input type="text" name="tmm_post_type_slug" id="tmm_post_type_slug" value="<?php echo esc_attr($post_type_new_slug); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	<?php
	}

	/**
	 * Change Post Type Name
	 */	
	public function change_post_type_name()
	{
	    global $wp_post_types;
	    $labels = $wp_post_types['tmm_team_member']->labels;

	    if( isset( $_POST['tmm_post_type_name'] ) && !empty( $_POST['tmm_post_type_name'] ) ){
			$post_type_new_name = sanitize_text_field($_POST['tmm_post_type_name']);
			$post_type_name_meta = update_option('tmm_post_type_name', $post_type_new_name );
		}

	    $post_type_new_name = get_option('tmm_post_type_name');

		if( $post_type_new_name && !empty($post_type_new_name)  ){
			$post_type_new_name = get_option('tmm_post_type_name');
		}else{
			$post_type_new_name = $labels->name;
		}

		$labels->name = $post_type_new_name;
	    $labels->singular_name = $post_type_new_name;
	    $labels->menu_name = $post_type_new_name;
	    $labels->name_admin_bar = $post_type_new_name;
	    $labels->add_new      = 'Add New '.$post_type_new_name;
	    $labels->add_new_item = 'Add New '.$post_type_new_name;
	    $labels->new_item = 'New '.$post_type_new_name;
	    $labels->edit_item = 'Edit '.$post_type_new_name;
	    $labels->view_item = 'View '.$post_type_new_name;
	    $labels->all_items = 'All '.$post_type_new_name;
	    $labels->search_items = 'Search '.$post_type_new_name;
	    $labels->not_found = 'No '.$post_type_new_name.' found';
	    $labels->not_found_in_trash = 'No '.$post_type_new_name.' found in Trash';
	}

	function change_post_type_slug( $args, $post_type ) {

		if( isset( $_POST['tmm_post_type_slug'] ) && !empty( $_POST['tmm_post_type_slug'] ) ){
			$post_type_new_slug = sanitize_text_field($_POST['tmm_post_type_slug']);
			$post_type_new_slug = preg_replace('/[^A-Za-z0-9\-_]/', '', $post_type_new_slug);
			$post_type_slug_meta = update_option('tmm_post_type_slug', $post_type_new_slug );
		}

		$post_type_new_slug = get_option('tmm_post_type_slug');

		if( $post_type_new_slug && !empty($post_type_new_slug)  ){
			$post_type_new_slug = get_option('tmm_post_type_slug');
			flush_rewrite_rules();
		}else{
			$post_type_new_slug = $args['rewrite']['slug'];
		}

	    if ( 'tmm_team_member' === $post_type ) {
	        $args['rewrite']['slug'] = $post_type_new_slug;
	    }

	    return $args;
	}

}

new Team_Member_Settings();