<?php
$link = get_permalink();
$number = get_field('number') ?? null;
$photo = get_field('photo') ?? null;
$name = get_the_title(); 
$position = get_field('position') ?? null;
$date_of_birth = get_field('date_of_birth') ?? null;
$high_school = get_field('high_school') ?? null;
$graduation_year = get_field('graduation_year') ?? null;
$height = get_field('height') ?? null;
?>
<div class="roster-bio h-100">
	<div class="grid-x grid-padding-x h-100">
		<div class="left cell small-4 show-for-tablet">
			<div class="img-wrap relative">
				<?php if($photo) {
					echo wp_get_attachment_image( $photo['id'], 'medium' );
				} else {
					echo '<img width="300" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
				};?>
			</div>
		</div>
		<div class="right cell small-12 tablet-8">
			<div class="grid-x grid-padding-x align-middle">
				<div class="header cell small-12">
					<div class="grid-x grid-padding-x">
						<div class="mobile-img-wrap relative hide-for-tablet cell small-5 medium-4">
							<?php if($photo) {
								echo wp_get_attachment_image( $photo['id'], 'medium' );
							} else {
								echo '<img width="300" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
							};?>
						</div>
						<div class="small-7 medium-8 tablet-12">
							<?php if($number || $position):?>
								<div class="cell small-12 grid-x align-middle">
									<?php if($number):?>
										<div class="number grid-x align-middle align-center">
											<b>#<?=esc_attr( $number );?></b>
										</div>
									<?php endif;?>
									<?php if( $position  ):?>
										<div class="h3 m-0">
											<div class="position"> 
												<?=esc_html($position );?>
											</div>
										</div>
									<?php endif;?>
								</div>
							<?php endif;?>
							<div class="cell small-12">
								<div class="name-link grid-x grid-padding-x">
									<div class="cell auto">
										<h2><?=esc_html( $name );?></h2>
									</div>
									<div class="shrink grid-x align-middle">
										<div class="link-wrap">
											<a href="<?=esc_url($link);?>" rel="bookmark" target="_blank">
												<svg xmlns="http://www.w3.org/2000/svg" width="28" viewBox="0 0 512 512"><path d="M304 41c0 10.9 4.3 21.3 12 29l46.1 46L207 271c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l155-155 46.2 46.1c7.7 7.7 18.1 12 29 12 22.6 0 41-18.3 41-41V40c0-22.1-17.9-40-40-40H345c-22.6 0-41 18.3-41 41zm57.9 7H464v102.1L361.9 48zM72 32C32.2 32 0 64.2 0 104v336c0 39.8 32.2 72 72 72h336c39.8 0 72-32.2 72-72V312c0-13.3-10.7-24-24-24s-24 10.7-24 24v128c0 13.3-10.7 24-24 24H72c-13.3 0-24-10.7-24-24V104c0-13.3 10.7-24 24-24h128c13.3 0 24-10.7 24-24s-10.7-24-24-24H72z" fill="#800000"/></svg>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="cell small-12">
					<?php if( $date_of_birth || $high_school || $graduation_year || $height ):?>
						<hr class="small-12">
					<?php endif;?>
					<div class="stats">
						<?php if($date_of_birth):?>
							<div class="p">
								<span>Date of Birth:</span>
								<span><?=esc_html($date_of_birth);?></span>
							</div>
						<?php endif;?>
						<?php if($high_school):?>
							<div class="p">
								<span>High School:</span>
								<span><?=esc_html($high_school);?></span>
							</div>
						<?php endif;?>
						<?php if($graduation_year):?>
							<div class="p">
								<span>Graduation Year:</span>
								<span><?=esc_html($graduation_year);?></span>
							</div>
						<?php endif;?>
						<?php if($height):?>
							<div class="p">
								<span>Height:</span>
								<span><?=esc_html($height);?></span>
							</div>
						<?php endif;?>
					</div>
					<div class="content-wrap">
						<?php the_content();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>