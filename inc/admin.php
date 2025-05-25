<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function trailhead_custom_admin_footer() {
// 	_e('<span id="footer-thankyou">Developed by <a href="https://proprdesign.com/" target="_blank">Propr Design</a></span>.', 'trailhead');
}

// adding it to the admin area
add_filter('admin_footer_text', 'trailhead_custom_admin_footer');

/* WP Editor
 */

	// Don't remove additional line breaks in editor
	// http://tinymce.moxiecode.com/wiki.php/Configuration
	function custom_tinymce_config( $init ) {
		$init['remove_linebreaks'] = false; 
		return $init;
	}
	add_filter('tiny_mce_before_init', 'custom_tinymce_config');

	function dg_tiny_mce_remove_h1( $in ) {
	        $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
	    return $in;
	}
	add_filter( 'tiny_mce_before_init', 'dg_tiny_mce_remove_h1' );


/**
 * Misc edits to the Wordpress Admin
 */

	// Remove useless dashboard widgets
	function remove_dashboard_widgets() {
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
		remove_meta_box('dashboard_primary', 'dashboard', 'normal');
		remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	}
	add_action('admin_init', 'remove_dashboard_widgets');


	// add styleselect to editor
	function add_styleselect($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'add_styleselect');


	// add default styles to styleselect
	function add_styleselect_classes( $init_array ) {  
		// Define the style_formats array
		$style_formats = array(  
			// Each array child is a format with it's own settings
	        array(  
	            'title' => 'Large Blue Text',  
	            'block' => 'span',  
	            'classes' => 'large-blue-text',
	            'wrapper' => true,
	        ),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array;  
	} 
	add_filter( 'tiny_mce_before_init', 'add_styleselect_classes' ); 


	// add editor-style.css
	function theme_editor_style() {
		add_editor_style( get_template_directory_uri() . '/assets/styles/style.min.css' );
	}
	add_action('init', 'theme_editor_style');


	// remove revisions meta box and recreate on right side for all post types
	function relocate_revisions_metabox() {
		$args = array(
		'public'   => true,
		'_builtin' => false
		); 
		$output = 'names'; // names or objects
		$post_types = get_post_types($args,$output); 
		foreach ($post_types  as $post_type) {
			remove_meta_box('revisionsdiv',$post_type,'normal'); 
			add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', $post_type, 'side', 'low');
		}
		
		// page 
		remove_meta_box('revisionsdiv','page','normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'page', 'side', 'low');
		
		// post 
		remove_meta_box('revisionsdiv','post','normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'post', 'side', 'low');
		
	}
	add_action('do_meta_boxes','relocate_revisions_metabox', 30);