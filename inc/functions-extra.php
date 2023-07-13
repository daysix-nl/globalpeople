<?php

// set active class to menu items
// add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );

// function add_current_nav_class($classes, $item) {
//     global $post;
//     $id = ( isset( $post->ID ) ? get_the_ID() : NULL );
//     if (isset( $id )){
//         $current_post_type = get_post_type_object(get_post_type($post->ID));
//         $current_post_type_slug = $current_post_type->rewrite['slug'];          
//         $menu_slug = strtolower(trim($item->url));

//         if (strpos($menu_slug,$current_post_type_slug) !== false) {

//            $classes[] = 'active';

//         }
//     }

//     if (in_array('current-menu-item', $classes) ){
// 	    $classes[] = 'active ';
// 	}

//     return $classes;
// }





add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
  $urlpath = explode('/', $url_path)[0];

  if ( $urlpath === 'vacancy' ) {
     // load the file if exists
     $load = locate_template('page-vacancies-single.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
});




add_action('init', function() {
  $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
  $urlpath = explode('/', $url_path)[0];

  if ( $urlpath === 'vacatures' ) {
     // load the file if exists
     $load = locate_template('page-vacancies.php', true);
     if ($load) {
        exit(); // just exit if template was found and loaded
     }
  }
});





// Enable the option show in rest
add_filter( 'acf/rest_api/field_settings/show_in_rest', '__return_true' );

// Enable the option edit in rest
add_filter( 'acf/rest_api/field_settings/edit_in_rest', '__return_true' );




// remove useless block styles
function dm_remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style('style.css'); 
}

add_action( 'wp_enqueue_scripts', 'dm_remove_wp_block_library_css' );





// magazine 
function filter_rest_work_query( $args, $request ) { 
    $params = $request->get_params(); 
    if(isset($params['magazine_categories'])){
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'magazine',
                'field' => 'slug',
                'terms' => explode(',', $params['magazine_categories'])
            )
        );
    }
    return $args; 
}   



//  REGISTER MENUS
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu-1' => __( 'Footer Menu 1' ),
      'footer-menu-2' => __( 'Footer Menu 2' ),
      'footer-menu-3' => __( 'Footer Menu 3' ),
      'footer-menu-legal-links' => __( 'Footer Menu Legal Links' )

    )
  );
}

add_action( 'init', 'register_my_menus' );







/**
 * Add a Formatted Date to the WordPress REST API JSON Post Object
 *
 */
add_action('rest_api_init', function() {
    register_rest_field(
        array('magazine'),
        'formatted_date',
        array(
            'get_callback'    => function() {
                return get_the_date();
            },
            'update_callback' => null,
            'schema'          => null,
        )
    );
});



function wpse_287931_register_categories_names_field() {

    register_rest_field( 'project',
        'categories_names',
        array(
            'get_callback'    => 'wpse_287931_get_categories_names',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

add_action( 'rest_api_init', 'wpse_287931_register_categories_names_field' );

function wpse_287931_get_categories_names( $object, $field_name, $request ) {

    $formatted_categories = array();

    $categories = get_the_category( $object['id'] );

    foreach ($categories as $category) {
        $formatted_categories[] = $category->name;
    }

    return $formatted_categories;
}



?>