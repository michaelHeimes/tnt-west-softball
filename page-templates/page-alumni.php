<?php
/**
 * Template name: Alumni Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();

?>
	<div class="content">
		<div class="inner-content">

			<main id="primary" class="site-main">
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-center">
						<div class="cell small-12 large-10">
		
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
								<header class="entry-header home-banner">
									<h1><?php the_title();?></h1>
									<div class="grid-x grid-padding-x">
										<div class="cell small-12 tablet-10 large-8">
											<?php the_content();?>
										</div>
									</div>
								</header><!-- .entry-header -->
							
								<section class="entry-content" itemprop="text">
									<?php $args = array(  
										'post_type' => 'cpt-alumnus',
										'post_status' => 'publish',
										'posts_per_page' => 5,
									);
									
									$loop = new WP_Query( $args ); 
									
									$index = 0;
									
									if ( $loop->have_posts() ) : ?>
										<nav class="alumni-nav" data-nav="player-modal">
											<ul class="no-bullet post-grid small-gutter-grid grid-x grid-padding-x small-up-2 medium-up-4 tablet-up-5">
												<?php while ( $loop->have_posts() ) : $loop->the_post();
													$photo = get_field('photo') ?? null;
													$position = get_field('position') ?? null;
													$college = get_field('college') ?? null;
													$college_team_logo = get_field('college_team_logo') ?? null;
													$url_for_college_profile = get_field('url_for_college_profile') ?? null;	
												?>
													<li class="cell">
														<article id="post-<?php the_ID(); ?>" <?php post_class('h-100'); ?>>
															<a class="grid-x h-100" href="#" rel="bookmark" data-slide-index="<?= $index; ?>" data-open="player-modal">

																<div class="photo-logo relative">
																	<?php if($photo) {
																		echo wp_get_attachment_image( $photo['id'], 'large', false, [ 'class' => 'img-fill' ] );
																	} else {
																		echo '<img width="75" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
																	};?>
																	<?php if($college_team_logo):?>
																		<div class="logo relative">
																			<?=wp_get_attachment_image( $college_team_logo['id'], 'large' );?>
																		</div>
																	<?php endif;?>
																</div>
																
																<h3 class="h4"><?php the_title();?></h3>	
																<h4 class="h6">
																	<?php if( $position ):?>
																		<?=esc_html( $position );?> -
																	<?php endif;?>
																	<?php if( $college ):?>
																		<?=esc_html( $college );?>
																	<?php endif;?>
																</h4>												
															
															</a>
														</article>
													</li>
												<?php $index++; endwhile;?>
											</ul>
										</nav>									
									
										<?php if ( $loop->have_posts() ) : ?>
											<div class="reveal large roster-modal" id="player-modal" data-reveal>
												<div class="grid-container">
													<div class="grid-x grid-padding-x align-center">
														<div class="close-btn-wrap grid-x align-middle align-right">
															<button class="close-button" data-close aria-label="Close modal" type="button">
																<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480a256 256 0 1 0 0-512 256 256 0 1 0 0 512zm-75.3-331.3c-6.2 6.2-6.2 16.4 0 22.6l52.7 52.7-52.7 52.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l52.7-52.7 52.7 52.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L278.6 256l52.7-52.7c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L256 233.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0z" fill="#fff"/></svg>
															</button>
														</div>				
														<div class="swiper roster-slider" swiper-cpt="roster">
															<div class="swiper-wrapper">	
																<?php while ( $loop->have_posts() ) : $loop->the_post();
																	$photo = get_field('photo') ?? null;
																	$position = get_field('position') ?? null;
																	$high_school = get_field('high_school') ?? null;
																	$college = get_field('college') ?? null;
																	$college_team_logo = get_field('college_team_logo') ?? null;
																	$url_for_college_profile = get_field('url_for_college_profile') ?? null;	
																?>
																	<div class="swiper-slide">
																		<?php get_template_part('template-parts/part', 'bio-content');?>
																	</div>	
																<?php endwhile;?>
															</div>
														</div>
														<div class="swiper-nav grid-x grid-padding-x align-middle align-center">
															<div class="cell shrink">
																<div class="swiper-button-prev">
																	<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M32 416c0 17.7 14.3 32 32 32h320c17.7 0 32-14.3 32-32V96c0-17.7-14.3-32-32-32H64c-17.7 0-32 14.3-32 32v320zm32 64c-35.3 0-64-28.7-64-64V96c0-35.3 28.7-64 64-64h320c35.3 0 64 28.7 64 64v320c0 35.3-28.7 64-64 64H64zm16-224c0-9.2 3.5-18 9.7-24.7l84-91c7.2-7.8 17.4-12.3 28.1-12.3 21.1 0 38.3 17.1 38.3 38.3V192h80c26.5 0 48 21.5 48 48v32c0 26.5-21.5 48-48 48h-80v25.7c0 21.1-17.1 38.3-38.3 38.3-10.7 0-20.9-4.5-28.1-12.3l-84-91C83.5 274 80 265.2 80 256zm33.2 3 84 91c1.2 1.3 2.9 2 4.6 2 3.5 0 6.3-2.8 6.3-6.3V304c0-8.8 7.2-16 16-16h96c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16h-96c-8.8 0-16-7.2-16-16v-41.7c0-3.5-2.8-6.3-6.3-6.3-1.7 0-3.4.7-4.6 2l-84 91c-.8.8-1.2 1.9-1.2 3s.4 2.2 1.2 3z" fill="#fff"/></svg>
																</div>
															</div>
															<div class="cell shrink">
																<div class="swiper-button-next">
																	<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 96c0-17.7-14.3-32-32-32H64c-17.7 0-32 14.3-32 32v320c0 17.7 14.3 32 32 32h320c17.7 0 32-14.3 32-32V96zm-32-64c35.3 0 64 28.7 64 64v320c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96c0-35.3 28.7-64 64-64h320zm-16 224c0 9.2-3.5 18-9.7 24.7l-84 91a38.29 38.29 0 0 1-28.1 12.3c-21.1 0-38.3-17.1-38.3-38.3V320h-80c-26.5 0-48-21.5-48-48v-32c0-26.5 21.5-48 48-48h80v-25.7c0-21.1 17.1-38.3 38.3-38.3 10.7 0 20.9 4.5 28.1 12.3l84 91c6.2 6.7 9.7 15.6 9.7 24.7zm-33.2-3-84-91c-1.2-1.3-2.9-2-4.6-2-3.5 0-6.3 2.8-6.3 6.3V208c0 8.8-7.2 16-16 16h-96c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h96c8.8 0 16 7.2 16 16v41.7c0 3.5 2.8 6.3 6.3 6.3 1.7 0 3.4-.7 4.6-2l84-91c.8-.8 1.2-1.9 1.2-3s-.4-2.2-1.2-3z" fill="#fff"/></svg>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endif;?>
									
									<?php endif;
									wp_reset_postdata(); 
									?>
			
								</section> <!-- end article section -->
										
								<footer class="article-footer">
									<?php wp_link_pages(); ?>
								</footer> <!-- end article footer -->
									
							</article><!-- #post-<?php the_ID(); ?> -->
							
						</div>
					</div>
				</div>
			</main><!-- #main -->
				
		</div>
	</div>

<?php
get_footer();