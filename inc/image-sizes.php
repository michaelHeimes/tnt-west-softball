<?php
function add_custom_sizes() {
	// Team Photos
	add_image_size( 'team-photo', 880, 629, true );
}
add_action('after_setup_theme','add_custom_sizes');