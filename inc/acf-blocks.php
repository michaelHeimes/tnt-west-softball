<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'large-colored-copy',
            'title'             => __('Large Colored Copy'),
            'description'       => __('A custom Large Colored Copy block.'),
            'render_template'   => 'template-parts/blocks/large-colored-copy.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'large', 'colored', 'copy', 'text' ),
        ));
    }
}