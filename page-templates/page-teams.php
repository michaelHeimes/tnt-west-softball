<?php
/**
 * Template name: Teams Page
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
				
					<header class="entry-header text-center">
						<div class="grid-container">
							<h1><?php the_title();?></h1>
						</div>
					</header><!-- .entry-header -->
				
					<section class="entry-content" itemprop="text">
						<?php the_content(); ?>

						<?php get_template_part('template-parts/section', 'team-grid');?>

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