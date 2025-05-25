<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
?>

	<main id="primary" class="site-main">

			<header class="page-header text-center">
				<div class="grid-container">
					<div class="grid-x grid-padding-x">
						<div class="cell small-12">
							<h1>Our Team</h1>
						</div>
					</div>
				</div>
			</header><!-- .page-header -->

			<div class="grid-container">

				<div class="grid-x grid-padding-x">
					<?php			
					$args = array(  
						'post_type' => 'team_member',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
					);
					
					
					$loop = new WP_Query( $args ); 
					
					if ( $loop->have_posts() ) : 
						while ( $loop->have_posts() ) : $loop->the_post();
							get_template_part('template-parts/loop-team-card');
						endwhile;									
					endif;
					wp_reset_postdata(); 
					?>
			
				</div>
			</div>

	</main><!-- #main -->

<?php
get_footer();
