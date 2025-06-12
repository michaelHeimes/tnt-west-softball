<?php

// Disable Gutenberg Post Type

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    if ($post_type === 'cpt-player' || $post_type === 'cpt-team' || $post_type === 'cpt-staff' || $post_type === 'cpt-alumnus') return false;
    return $current_status;
}


/**
 * Templates and Page IDs without editor
 *
 */
function ea_disable_editor( $id = false ) {
     $excluded_templates = array(
         'page-templates/page-teams.php',
         'page-templates/page-alumni.php',
     );
 
     if ( empty( $id ) ) return false;
 
     $template = get_page_template_slug( $id );
 
     return in_array( $template, $excluded_templates );
 }
 
 function ea_disable_gutenberg_per_post( $use_block_editor, $post ) {
     if ( ! $post instanceof WP_Post ) return $use_block_editor;
 
     if ( ea_disable_editor( $post->ID ) ) {
         return false;
     }
 
     return $use_block_editor;
 }
 add_filter( 'use_block_editor_for_post', 'ea_disable_gutenberg_per_post', 10, 2 );