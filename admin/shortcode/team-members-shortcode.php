<?php
namespace Team_Member_Mobashir\Admin\Shortcode;
/**
* Team Member Shortcode Class
*/
class Team_Member_Metabox
{
	/**
	 * Team Member Shortcode Constructor.
	 */
	function __construct(){
		add_shortcode( 'team_members', array( $this, 'team_members_shortcode_builder' ) );
	}

	/**
	 * Team Member Shortcode Constructor.
     * @param $atts array 
     * @param $content 
     *
     * @return mixed
     */
	function team_members_shortcode_builder( $attr, $content='' ){
		$team_members = shortcode_atts( array(
				          'team_members_to_show'  =>  '4',
				          'image_position' => 'top',
				          'show_button'  => 'yes',
				      ), $attr);

		$total_show = intval($team_members['team_members_to_show']);
		$button_to_show = 'yes';
		$image_position = 'top';

		if( in_array( strtolower($team_members['show_button']), array('yes', 'no') ) ){
			$button_to_show = strtolower($team_members['show_button']);
		}

		if( in_array( strtolower($team_members['image_position'] ), array('top', 'bottom') ) ){
			$image_position = strtolower($team_members['image_position']);
		}

		$member_query = new \WP_Query(
								array(
									'post_type'	=>	'tmm_team_member',
									'posts_per_page' => $total_show
								)
							);
		ob_start();
		
	?>
		<div class="tmm_team_member_container">
			<div class="row">
			<?php if( $member_query->have_posts() ){ while( $member_query->have_posts() ){ $member_query->the_post(); ?>
				<div class="column">
					<div class="column-inn">

					<?php if( $image_position != 'bottom' ){ ?>
						<div class="image">
							<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ){
										the_post_thumbnail('thumbnail');
									}
								?>
							</a>
						</div>
					<?php } ?>

						<div class="info">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php if( get_post_meta( get_the_ID(), 'team_member_position', true ) ){ ?><h3 class="position"><?php echo esc_html( get_post_meta( get_the_ID(), 'team_member_position', true ) ); ?></h3><?php } ?>
						</div>

					<?php if( $image_position == 'bottom' ){ ?>
						<div class="image">
							<a href="<?php the_permalink(); ?>">
								<?php
									if( has_post_thumbnail() ){
										the_post_thumbnail('thumbnail');
									}
								?>
							</a>
						</div>
					<?php } ?>
					
					</div>
				</div>

			<?php } wp_reset_postdata(); } ?>

			<?php if( $button_to_show == 'yes' ){ ?>
				<div class="tmm-team-member-button">
					<?php $archive_url = get_post_type_archive_link('tmm_team_member'); ?>
					<a href="<?php echo $archive_url; ?>">Show All</a>
				</div>
			<?php } ?>

			</div>
		</div>
	<?php
		return ob_get_clean();
	}
}

new Team_Member_Metabox();