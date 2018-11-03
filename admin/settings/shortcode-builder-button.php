<?php
namespace Team_Member_Mobashir\Admin\Settings;
/**
* Team Member Shortcode Class
*/
class Team_Member_Shortcode_Builder_Button
{
	/**
	 * Team Member Settings Constructor.
	 */
	function __construct(){
		add_action( 'admin_footer', array( $this, 'tmm_team_member_mce_popup' ) );
		add_action( 'media_buttons', array( $this, 'tmm_team_member_mce_buttons' ) );
	}

	/**
	 * Add popup HTML and script into admin footer
	 */
	public function tmm_team_member_mce_popup(){
		wp_enqueue_script( 'tmm_team_member_shortcode_builder_popup', TMM_REALPATH.'assets/js/shortcode-builder-button.js' );
	?>
		<script>
			
		</script>
		<div id="tm_team_member_container">
			<div class="wrap tm_team_member_shortcode">
				<div>
					<div>
						<h3 class="popup-title">Team Member Shortcode Builder</h3>

						<div class="field-container">
							<div class="label-desc">
								<label for="team_members_to_show">How Many Member You want to show:</label>
							</div>
							<div class="content">
								<input type="text" name="team_members_to_show" id="team_members_to_show" />
							</div>
						</div>

						<div class="field-container">
							<div class="label-desc">
								<label for="image_position">Image Position:</label>
							</div>
							<div class="content">
								<select id='image_position' name="image_position">
									<option value="">Select Option</option>
									<option value="top">Top</option>
									<option value="bottom">bottom</option>
								</select>
							</div>
						</div>

						<div class="field-container">
							<div class="label-desc">
								<label for="show_button">Show Button:</label>
							</div>
							<div class="content">
								<select id="show_button" name="show_button">
									<option value="">Select Option</option>
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
					</div>
					<div>
						<input type="button" class="button-primary" value="Insert Shortcode" onclick="InsertContainer();"/>&nbsp;&nbsp;&nbsp;
						<a class="button" href="#" onclick="tb_remove(); return false;">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	<?php
	}

	public function tmm_team_member_mce_buttons()
	{
		wp_enqueue_style('tmm_team-member-shortcode_generator', TMM_REALPATH.'assets/css/shortcode_generator.css', array(), true);
	?>
		<a href="#TB_inline?width=480&height=500&inlineId=tm_team_member_container" class = "button thickbox wp_doin_media_link" id = "add_div_shortcode" title = "Team Member Shortcode Generator">Add Team Member</a>
	<?php
	}

}

new Team_Member_Shortcode_Builder_Button();