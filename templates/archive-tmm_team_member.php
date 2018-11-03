<?php
/**
 *
 * Template file for displaying team member archive and taxonomy
 *
 */
get_header();
?>
	
	<div class="tmm_team_member_container">
		<div class="row">
		<?php if( have_posts() ){ while( have_posts() ){ the_post(); ?>
			<div class="column">
				<div class="column-inn">

					<div class="image">
						<a href="<?php the_permalink(); ?>">
							<?php
								if( has_post_thumbnail() ){
									the_post_thumbnail('thumbnail');
								}
							?>
						</a>
					</div>

					<div class="info">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if( get_post_meta( get_the_ID(), 'team_member_position', true ) ){ ?><h3 class="position"><?php echo esc_html( get_post_meta( get_the_ID(), 'team_member_position', true ) ); ?></h3><?php } ?>
					</div>
				
				</div>
			</div>

		<?php } } ?>
		
			<div class="pagination">
				<?php echo paginate_links(); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>