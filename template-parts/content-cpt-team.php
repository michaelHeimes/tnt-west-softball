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
		
		<ul class="accordion" data-responsive-accordion-tabs="accordion medium-tabs" data-multi-expand="true" data-allow-all-closed="true">
			<?php if( $schedule_title || $schedule ):?>
				<li class="schedule-item accordion-item is-active" data-accordion-item>
					<a href="#" class="accordion-title">Schedule</a>
					<div class="schedule-content accordion-content" data-tab-content>
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
					<a href="#" class="accordion-title">Roster</a>
					<div class="roster-content accordion-content" data-tab-content>
						<?php if( $roster_title ):?>
							<h2 class="text-center"><?=esc_html($roster_title);?></h2>
						<?php endif;?>
						<nav class="roster-nav">
							<ul class="no-bullet grid-x grid-padding-x align-center">
								<?php foreach($roster as $index => $post):
									setup_postdata($post);
									$number = get_field('number') ?? null;
									$photo = get_field('photo') ?? null;
									$name = get_the_title(); 
									$name_with_breaks = implode('<br>', explode(' ', $name));
									$position = get_field('position') ?? null;
								?>
									<li class="cell shrink grid-x align-bottom">
										<a class="grid-x align-bottom" href="<?=esc_url( get_permalink() );?>" rel="bookmark" data-slide-index="<?= $index; ?>">
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
								<?php endforeach; wp_reset_postdata()?>
							</ul>
						</nav>
					</div>
				</li>
			<?php endif;?>
			<?php if( $staff ):?>
				<li class="roster-item accordion-item" data-accordion-item>
					<a href="#" class="accordion-title">Staff</a>
					<div class="roster-content accordion-content" data-tab-content>
						<?php if( $staff_title ):?>
							<h2 class="text-center"><?=esc_html($staff_title);?></h2>
						<?php endif;?>
						<nav class="roster-nav">
							<ul class="no-bullet grid-x grid-padding-x align-center">
								<?php foreach($staff as $post):
									setup_postdata($post);
									$photo = get_field('photo') ?? null;
									$name = get_the_title(); 
									$name_with_breaks = implode('<br>', explode(' ', $name));
									$position = get_field('position') ?? null;
								?>
									<li class="cell shrink grid-x align-bottom">
										<a class="grid-x align-bottom" href="<?=esc_url( get_permalink() );?>" rel="bookmark" data-slide-index="<?= $index; ?>">
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
