<?php


add_action('acf/init', 'my_acf_init_block_types');

function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a dropcap block.
        acf_register_block_type(array(
            'name'              => 'video169',
            'title'             => __('Video (16:9)'),
            'description'       => __('Video (16:9) with Thumbnail'),
            'render_template'   => 'template-parts/blocks/video169.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'video, thumbnail, 16:9', 'quote' ),
        ));


        // register a dropcap block.
        acf_register_block_type(array(
            'name'              => 'styled-form',
            'title'             => __('CF7 Form Styled'),
            'description'       => __('CF7 Form Styled'),
            'render_template'   => 'template-parts/blocks/styled-form.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'cf7, form, styled, shortcode', 'quote' ),
        ));


    }



}



