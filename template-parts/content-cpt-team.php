<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */
$fields = get_fields();

$coach_coaches = $fields['coach_coaches'] ?? null;
$team_photo = $fields['team_photo'] ?? null;
$schedule_title = $fields['schedule_title'] ?? null;
$schedule = $fields['schedule'] ?? null;
$roster_title = $fields['roster_title'] ?? null;
$roster = $fields['roster'] ?? null;
$staff_title = $fields['staff_title'] ?? null;
$staff = $fields['staff'] ?? null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="grid-x grid-padding-x">
			<div class="cell shrink">
				<h1>TNT West <?php the_title();?></h1>
			</div>
			<?php if( $coach_coaches ):?>
				<div class="cell shrink h1">|</div>
				<div class="cell auto h1">
					<?=esc_html( $coach_coaches );?>
				</div>
			<?php endif;?>
		</div>
	</header><!-- .entry-header -->

	<?php trailhead_post_thumbnail(); ?>

	<div class="entry-content">
		
		<ul class="accordion" data-responsive-accordion-tabs="accordion medium-tabs" data-multi-expand="true" data-allow-all-closed="true" data-deep-link="true">
			<?php if( $schedule_title || $schedule ):?>
				<li class="schedule-item accordion-item is-active" data-accordion-item>
					<a href="#schedule" class="accordion-title">Schedule</a>
					<div id="schedule" class="schedule-content accordion-content" data-tab-content>
						<?php if( have_rows('schedule') ): ?>
							<table>
								<?php if( $schedule_title ): ?>
									<caption class="h2"><?= esc_html($schedule_title); ?></caption>
								<?php endif; ?>
						
								<thead>
									<tr>
										<th>Date</th>
										<th>Tournament</th>
										<th>Location</th>
									</tr>
								</thead>
						
								<tbody>
									<?php while( have_rows('schedule') ): the_row(); 
										$start_date = get_sub_field('start_date');
										$end_date = get_sub_field('end_date');
										$tournament = get_sub_field('tournament');
										$location = get_sub_field('location');
									?>
										<tr>
											<td>
												<?php
													if ( $start_date && $end_date && $start_date !== $end_date ) {
														echo '<span>' . wp_kses_post( date('M j', strtotime($start_date)) . '–</span><span>' . date('M j', strtotime($end_date)) . '</span>');
													} elseif ( $start_date ) {
														echo '<span>' . wp_kses_post( date('M j', strtotime($start_date)) ) . '</span>';
													} else {
														echo '&mdash;';
													}
												?>
											</td>
											<td><?= esc_html($tournament ?: '—'); ?></td>
											<td><?= esc_html($location ?: '—'); ?></td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</li>
			<?php endif;?>
			<?php if( $roster ):
				usort($roster, function($a, $b) {
					$nameA = get_field('last_name', $a->ID);
					$nameB = get_field('last_name', $b->ID);
					return strcmp($nameA, $nameB);
				});
			?>
				<li class="roster-item accordion-item" data-accordion-item>
					<a href="#roster" class="accordion-title">Roster</a>
					<div id="roster" class="roster-content accordion-content" data-tab-content>
						<?php if( $roster_title ):?>
							<h2 class="text-center"><?=esc_html($roster_title);?></h2>
						<?php endif;?>
						<nav class="roster-nav" data-nav="player-modal">
							<ul class="no-bullet grid-x grid-padding-x">
								<?php foreach($roster as $index => $post):
									setup_postdata($post);
									$number = get_field('number') ?? null;
									$photo = get_field('photo') ?? null;
									$name = get_the_title(); 
									$name_with_breaks = implode('<br>', explode(' ', $name));
									$position = get_field('position') ?? null;
								?>
									<li class="cell shrink grid-x align-bottom">
										<a class="grid-x align-bottom" href="#" rel="bookmark" data-slide-index="<?= $index; ?>" data-open="player-modal">
											<div class="img-wrap">
												<?php if($photo) {
													echo wp_get_attachment_image( $photo['id'], 'thumbnail' );
												} else {
													echo '<img width="75" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
												};?>
												<?php if( $number ):?>
													<div class="number grid-x align-middle align-center">
														<?=esc_attr( $number );?>
													</div>
												<?php endif;?>
											</div>
											<div class="text-wrap grid-x flex-dir-column">
												<div>
													<?=wp_kses_post($name_with_breaks);?>
												</div>
												<?php if( $position  ):?>
													<div class="position">
														<hr>
														<?=esc_html($position );?>
													</div>
												<?php endif;?>
											</div>
										</a>
									</li>
								<?php endforeach; wp_reset_postdata();?>
							</ul>
						</nav>
						<div class="reveal roster-modal" id="player-modal" data-reveal>
							<div class="grid-container">
								<div class="grid-x grid-padding-x align-center">
									<div class="close-btn-wrap grid-x align-middle align-right">
										<button class="close-button" data-close aria-label="Close modal" type="button">
											<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480a256 256 0 1 0 0-512 256 256 0 1 0 0 512zm-75.3-331.3c-6.2 6.2-6.2 16.4 0 22.6l52.7 52.7-52.7 52.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l52.7-52.7 52.7 52.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L278.6 256l52.7-52.7c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L256 233.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0z" fill="#fff"/></svg>
										</button>
									</div>


									<div class="swiper roster-slider" swiper-cpt="roster">
										<div class="swiper-wrapper">						
											<?php foreach($roster as $post):?>
												<div class="swiper-slide">
													<?php get_template_part('template-parts/part', 'bio-content');?>
												</div>
											<?php endforeach; wp_reset_postdata();?>
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
					</div>
				</li>
			<?php endif;?>
			<?php if( $staff ):?>
				<li class="staff-item accordion-item" data-accordion-item>
					<a href="#staff" class="accordion-title">Staff</a>
					<div id="staff" class="roster-content accordion-content" data-tab-content>
						<?php if( $staff_title ):?>
							<h2 class="text-center"><?=esc_html($staff_title);?></h2>
						<?php endif;?>
						<nav class="roster-nav" data-nav="staff-modal">
							<ul class="no-bullet grid-x grid-padding-x align-center">
								<?php foreach($staff as $index => $post):
									setup_postdata($post);
									$photo = get_field('photo') ?? null;
									$name = get_the_title(); 
									$name_with_breaks = implode('<br>', explode(' ', $name));
									$position = get_field('position') ?? null;
								?>
									<li class="cell shrink grid-x align-bottom">
										<a class="grid-x align-bottom" href="#" data-slide-index="<?= $index; ?>"  data-open="staff-modal">
											<div class="img-wrap">
												<?php if($photo) {
													echo wp_get_attachment_image( $photo['id'], 'thumbnail' );
												} else {
													echo '<img width="75" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
												};?>
											</div>
											<div class="text-wrap grid-x flex-dir-column">
												<div>
													<?=wp_kses_post($name_with_breaks);?>
												</div>
												<?php if( $position  ):?>
													<div class="position">
														<hr>
														<?=esc_html($position );?>
													</div>
												<?php endif;?>
											</div>
										</a>
									</li>
								<?php endforeach; wp_reset_postdata()?>
							</ul>
						</nav>
						<div class="reveal roster-modal" id="staff-modal" data-reveal>
							<div class="grid-container">
								<div class="grid-x grid-padding-x align-center">
									<div class="close-btn-wrap grid-x align-middle align-right">
										<button class="close-button" data-close aria-label="Close modal" type="button">
											<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 32a224 224 0 1 1 0 448 224 224 0 1 1 0-448zm0 480a256 256 0 1 0 0-512 256 256 0 1 0 0 512zm-75.3-331.3c-6.2 6.2-6.2 16.4 0 22.6l52.7 52.7-52.7 52.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l52.7-52.7 52.7 52.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L278.6 256l52.7-52.7c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L256 233.4l-52.7-52.7c-6.2-6.2-16.4-6.2-22.6 0z" fill="#fff"/></svg>
										</button>
									</div>
						
						
									<div class="swiper roster-slider">
										<div class="swiper-wrapper">						
											<?php foreach($staff as $post):
												setup_postdata($post);
											?>
												<div class="swiper-slide">
													<?php get_template_part('template-parts/part', 'bio-content');?>
												</div>
											<?php endforeach; wp_reset_postdata();?>
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
					</div>
				</li>
			<?php endif;?>
		</ul>
		
		
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'trailhead' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'trailhead' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php trailhead_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
