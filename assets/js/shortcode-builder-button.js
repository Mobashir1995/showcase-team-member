function InsertContainer() {
	// let's obtain the values of the fields
	var team_members_to_show = jQuery('#team_members_to_show').val() != '' ? ' team_members_to_show='+jQuery('#team_members_to_show').val() : ''  ;
	var image_position = jQuery('#image_position').val() != '' ? " image_position='"+jQuery('#image_position').val()+"'" : ''  ;
	var show_button = jQuery('#show_button').val() != '' ? " show_button='"+jQuery('#show_button').val()+"'" : '';

	//send the shortcode parameters to editor
	window.send_to_editor("[team_members "+team_members_to_show+" "+image_position+""+ show_button +"]");
}