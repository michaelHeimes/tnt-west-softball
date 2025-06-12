<?php
/**
 * Template name: Alumni Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
$fields = get_fields();
?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
		
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header home-banner text-center">
						<h1><?php the_title();?></h1>
					</header><!-- .entry-header -->
				
					<section class="entry-content" itemprop="text">
						<?php the_content(); ?>
						<?php			
						$args = array(  
							'post_type' => 'cpt-alumni',
							'post_status' => 'publish',
							'posts_per_page' => -1,
						);
						
						$loop = new WP_Query( $args ); 
						
						if ( $loop->have_posts() ) : ?>
							
							<?php while ( $loop->have_posts() ) : $loop->the_post();?>
							
								
							<?php endwhile;?>
							
						
						<?php endif;
						wp_reset_postdata(); 
						?>

					</section> <!-- end article section -->
							
					<footer class="article-footer">
						 <?php wp_link_pages(); ?>
					</footer> <!-- end article footer -->
						
				</article><!-- #post-<?php the_ID(); ?> -->
		
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();