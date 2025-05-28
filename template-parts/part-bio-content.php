<?php
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
		<div class="left cell small-4">
			<div class="img-wrap relative">
				<?php if($photo) {
					echo wp_get_attachment_image( $photo['id'], 'medium' );
				} else {
					echo '<img width="300" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
				};?>
			</div>
		</div>
		<div class="right cell small-8">
			<div class="grid-x grid-padding-x align-middle">
				<div class="header cell small-12">
					<?php if($number || $position):?>
						<div class="cell small-12 grid-x align-middle">
							<?php if($number):?>
								<div class="number grid-x align-middle align-center">
									<b>#<?=esc_attr( $number );?></b>
								</div>
							<?php endif;?>
							<?php if( $position  ):?>
								<div class="h3">
									<div class="position"> 
										<?=esc_html($position );?>
									</div>
								</div>
							<?php endif;?>
						</div>
					<?php endif;?>
					<div class="cell small-12">
						<h2><?=esc_html( $name );?></h2>
					</div>
				</div>
				<div class="cell small-12">
					<?php if( $date_of_birth || $high_school || $graduation_year || $height ):?>
						<hr class="small-12">
					<?php endif;?>
					<div class="stats">
						<?php if($date_of_birth):?>
							<div class="grid-x align-middle">
								<div class="h5">
									Date of Birth:
								</div>
								<div class="p">
									<b>&nbsp;<?=esc_html($date_of_birth);?></b>
								</div>
							</div>
						<?php endif;?>
						<?php if($high_school):?>
							<div class="grid-x align-middle">
								<div class="h5">
									High School:
								</div>
								<div class="p">
									<b>&nbsp;<?=esc_html($high_school);?></b>
								</div>
							</div>
						<?php endif;?>
						<?php if($graduation_year):?>
							<div class="grid-x align-middle">
								<div class="h5">
									Graduation Year:
								</div>
								<div class="p">
									<b>&nbsp;<?=esc_html($graduation_year);?></b>
								</div>
							</div>
						<?php endif;?>
						<?php if($height):?>
							<div class="grid-x align-middle">
								<div class="h5">
									Height:
								</div>
								<div class="p">
									<b>&nbsp;<?=esc_html($height);?></b>
								</div>
							</div>
						<?php endif;?>
						<?php the_content();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>