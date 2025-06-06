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

$teams = $fields['teams'];
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
						<?php if( $teams ):?>
							<div class="grid-x grid-padding-x">
								<?php foreach($teams as $post):
									setup_postdata($post);
									$url = get_the_permalink();
									$team_photo = get_field('team_photo') ?? null;
									$name = get_the_title();
								?>
									<article id="post-<?php the_ID(); ?>" <?php post_class('cell shrink medium-6 tablet-4'); ?>>
										<a class="text-center" href="<?=$url ;?>" rel="bookmark">
											<div class="name">
												<?=esc_html( $name );?>
											</div>
											<div class="image">
												<?php if( $team_photo ) :?>
													<?=wp_get_attachment_image( $team_photo['id'], 'large' );?>
												<?php endif;?>
											</div>
										</a>
										<ul class="team-tab-nav menu horizontal">
											<li>
												<a href="<?=esc_url($url);?>#schedule">Schedule</a>
											</li>
											<li>
												<a href="<?=esc_url($url);?>#roster">Roster</a>
											</li>
											<li>
												<a href="<?=esc_url($url);?>#staff">Staff</a>
											</li>
										</ul>
									</article>
								<?php endforeach; wp_reset_postdata();?>
							</div>
						<?php endif;?>
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