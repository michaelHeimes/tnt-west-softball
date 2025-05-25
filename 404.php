<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package trailhead
 */

get_header();
?>
	<div class="content">
		<div class="grid-container">
			<div class="inner-content grid-x grid-padding-x">
				<main id="primary" class="site-main">
			
					<article class="content-not-found">
					
						<header class="article-header">
							<h1>404</h1>
						</header> <!-- end article header -->
					
						<section class="entry-content">
							<p>The page you're looking for doesn't exist. Please use the navigation at the top of the page or <a href="<?php echo home_url(); ?>">return to the home page.</a></p>
						</section> <!-- end article section -->
					
					
					</article> <!-- end article -->
			
				</main><!-- #main -->
			</div>
		</div>
	</div><!-- end content -->

<?php
get_footer();
