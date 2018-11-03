<?php
/**
 *
 * Template file for displaying single team member
 *
 */
	get_header();
	if(have_posts()){
		while(have_posts()){
			the_post();
?>
	

	<div class="tmm_team_member_container">
		<div class="entry-content single-member">
			<div class="member-thumbnail">
				<?php 
					if( has_post_thumbnail() ){
						the_post_thumbnail('large');
					}
				?>
			</div>
			<div class="member-info">
				<div class="info">
					<h1><?php the_title(); ?></h1>
				<?php $member_types = wp_get_post_terms( get_the_ID(), 'tmm_member_type' ); if( !empty($member_types) ){ ?>
					<h2>
						Member Type:
						<?php
							$count = 0;
							foreach( $member_types as $type ){ 
								$count++;
								if( $count != 1 ){ echo ','; }
						?>
						<a href="<?php echo get_term_link($type->term_id, 'tmm_member_type'); ?>"><?php echo $type->name; ?></a>
						<?php
							}
						?>
					</h2>
				<?php } ?>
				<?php if( get_post_meta( get_the_ID(), 'team_member_position', true ) ){ ?><h3 class="position"><?php echo esc_html( get_post_meta( get_the_ID(), 'team_member_position', true ) ); ?></h3><?php } ?>
				</div>
				<?php the_content(); ?>
			</div>
		</div>
	</div>


<?php
		}
	}
	get_footer();
?>