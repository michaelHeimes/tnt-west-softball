<?php
// Adds your styles to the WordPress editor
add_action( 'init', 'add_editor_styles' );
function add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/assets/styles/style.css' );
}

// Adds your styles to the Gutenberg editor
add_action( 'after_setup_theme', 'trailhead_gutenberg_css' );

function trailhead_gutenberg_css(){

	add_theme_support( 'editor-styles' ); // if you don't add this line, your stylesheet won't be added
	add_editor_style( '/assets/styles/style.css' ); // tries to include style-editor.css directly from your theme folder

}