<?php
namespace Team_Member_Mobashir\Admin\Metabox;
/**
* Metabox Class
*/
class Team_Member_Metabox
{
	/**
	 * Team Member Metabox Constructor.
	 */
	function __construct(){
		add_action( 'add_meta_boxes', array($this, 'add_position_metabox') );
		add_action( 'save_post', array($this, 'save_position_meta_value') );
	}

	/**
	 * Register Position Metabox
	 *
	 * @param $post_type
	 */
	public function add_position_metabox( $post_type ){
		add_meta_box( 
	        'team_member_position_box',
	        esc_html__( 'Member Position' ),
	        array($this, 'render_position_box'),
	        'tmm_team_member',
	        'normal',
	        'default'
	    );
	}

	/**
	 * Metabox Callback
	 *
	 *@param $post post object
	 */	
	public function render_position_box( $post ){
		wp_nonce_field( 'team_member_nonce', 'team_member_check_nonce');
		$position = get_post_meta( $post->ID, 'team_member_position', true);
	?>
		<p><label for="team_member_position">Position</label></p>
		<p><input type="text" value="<?php echo esc_attr($position); ?>" id="team_member_position" name="team_member_position" /></p>
	<?php
	}

	/**
	 * Save Metavalue
	 *
	 *@param $post_id id for the post
	 */	
	public function save_position_meta_value( $post_id ){
		if( !isset( $_POST['team_member_check_nonce'] ) ){
			return;
		}

		$nonce = $_POST['team_member_check_nonce'];

		if( !wp_verify_nonce($nonce, 'team_member_nonce') ){
			return;	
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }
        
        if( isset( $_POST['team_member_position'] ) ){
			$position =  sanitize_text_field($_POST['team_member_position']);
        	update_post_meta( $post_id, 'team_member_position', $position );
    	}else{
    		update_post_meta( $post_id, 'team_member_position', '' );
    	}
	}
}

new Team_Member_Metabox();