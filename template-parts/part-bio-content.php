<?php
$number = get_field('number') ?? null;
$photo = get_field('photo') ?? null;
$name = get_the_title(); 
$position = get_field('position') ?? null;
?>
<div class="roster-bio">
	<div class="grid-x grid-padding-x">
		<div class="cell small-4">
			<?php if($photo) {
				echo wp_get_attachment_image( $photo['id'], 'medium' );
			} else {
				echo '<img width="300" src="' . get_template_directory_uri() . '/assets/images/no-img-placeholder-300.jpg" alt="Fallback for missing image">';
			};?>
		</div>
		<div class="cell small-8">
			<div class="header grid-x grid-padding-x align-middle">
				<?php if($number):?>
					<div class="cell small-12 grid-x align-middle">
						<div class="number grid-x align-middle align-center">
							#<?=esc_attr( $number );?>
						</div>
						<?php if( $position  ):?>
							<div class="h3 grid-x">
								<div class="sep">|</div>
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
		</div>
	</div>
</div>