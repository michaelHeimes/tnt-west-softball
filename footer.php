<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trailhead
 */

$logo = get_field('header_logo', 'option');
$copyright_text = get_field('copyright_text', 'option');


?>

				<footer id="colophon" class="site-footer">
					<div class="divider"></div>
					<div class="top grid-container">
						<div class="grid-x grid-padding-x align-center align-middle">
							<div class="cell small-12 large-10">
								<div class="grid-x grid-padding-x">
									<div class="cell small-12 medium-shrink">
										<?php if( !empty( $logo ) ) :?>
											<ul class="menu">
												<li class="logo">
													<a href="<?php echo home_url(); ?>" rel="home">
														<?= wp_get_attachment_image( $logo['id'], 'full' );?>
														<span class="show-for-sr"><?php bloginfo( 'name' ); ?></span>
													</a>
												</li>
											</ul>
										<?php endif;?>
									</div>
									
									<div class="nav-wrap cell small-12 medium-auto grid-x align-middle">
										<?php trailhead_footer_links();?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="site-info">
						<div class="grid-container">
							<div class="grid-x grid-padding-x">
								<div class="si-left cell small-12 tablet-shrink">
									&copy;<?= date("Y");?>
									<?php if( !empty( $copyright_text ) ){
										echo $copyright_text;	
									};?>
								</div>
								<div class="si-right cell small-12 tablet-auto text-right">
									<a class="team-tab-link uppercase" href="https://cairndigitalmedia.com/" target="_blank">
										Website by Cairn
									</a>
								</div>
							</div>
						</div>
					</div>
				</footer><!-- #colophon -->
					
			</div><!-- #page -->
			
		</div>  <!-- end .off-canvas-content -->
							
	</div> <!-- end .off-canvas-wrapper -->
					
<?php wp_footer(); ?>

</body>
</html>
