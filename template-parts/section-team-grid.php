<?php		

$global_teams_fallback_image = get_field('global_teams_fallback_image', 'option') ?? null;
	
$args = array(  
	'post_type' => 'cpt-team',
	'post_status' => 'publish',
	'posts_per_page' => -1,
);

$loop = new WP_Query( $args ); 

if ( $loop->have_posts() ) : ?>
	<section class="teams">
		<div class="grid-container">
			<div class="team-cards grid-x grid-padding-x">
				<div class="cell small-12">
					<h2 class="text-center">Teams</h2>
				</div>
				<?php while ( $loop->have_posts() ) : $loop->the_post();
					$url = get_the_permalink();
					$team_photo = get_field('team_photo') ?? null;
					
					if( empty( $team_photo && $global_teams_fallback_image ) ) {
						$team_photo = $global_teams_fallback_image;
					}
					
					$name = get_the_title();	
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('cell small-12 tablet-6 large-4'); ?>>
						<a class="text-center" href="<?=$url ;?>" rel="bookmark">
							<h2 class="h3 name uppercase m-0">
								<?=esc_html( $name );?>
							</h2>
							<div class="image">
								<?php if( $team_photo ) :?>
									<?=wp_get_attachment_image( $team_photo['id'], 'team-photo' );?>
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
				<?php endwhile;?>
			</div>
		</div>
	</section>
<?php endif;
wp_reset_postdata(); 
?>