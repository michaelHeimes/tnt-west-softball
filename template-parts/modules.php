<?php
if( have_rows('content_modules') ):
	while ( have_rows('content_modules') ) : the_row();

		// if( get_row_layout() == 'subscribe_cta' ):
		// 	get_template_part('template-parts/module', 'subscribe-cta');
		// elseif( get_row_layout() == 'cta_cards_mixed' ):
		// 	get_template_part('template-parts/module', 'cta-cards-mixed');
		// endif;

	endwhile;
endif;
?>