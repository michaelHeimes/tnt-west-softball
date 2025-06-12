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
				
					<header class="entry-header text-center">
						<div class="grid-container">
							<h1><?php the_title();?></h1>
						</div>
					</header><!-- .entry-header -->
				
					<section class="entry-content" itemprop="text">
						<?php the_content(); ?>
						<?php if( $teams ):?>
							<div class="grid-container">
								<div class="team-cards grid-x grid-padding-x">
									<?php foreach($teams as $post):
										setup_postdata($post);
										$url = get_the_permalink();
										$team_photo = get_field('team_photo') ?? null;
										$name = get_the_title();
									?>
										<article id="post-<?php the_ID(); ?>" <?php post_class('cell shrink medium-6 tablet-4'); ?>>
											<a class="text-center" href="<?=$url ;?>" rel="bookmark">
												<h2 class="name uppercase m-0">
													<?=esc_html( $name );?>
												</h2>
												<div class="image">
													<?php if( $team_photo ) :?>
														<?=wp_get_attachment_image( $team_photo['id'], 'large' );?>
													<?php endif;?>
												</div>
											</a>
											<nav class="team-tab-nav">
												<ul class="no-bullet uppercase menu grid-x grid-padding-x text-center">
													<li class="cell small-4">
														<a class="team-tab-link" href="<?=esc_url($url);?>#roster">Roster</a>
													</li>
													<li class="cell small-4">
														<a class="team-tab-link" href="<?=esc_url($url);?>#schedule">Schedule</a>
													</li>
													<li class="cell small-4">
														<a class="team-tab-link" href="<?=esc_url($url);?>#staff">Staff</a>
													</li>
												</ul>
											</nav>
										</article>
									<?php endforeach; wp_reset_postdata();?>
								</div>
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