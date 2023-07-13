<?php 



function javascript_custom() {

    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $urlpath = explode('/', $url_path)[0];



    wp_enqueue_script( 'validate',  get_template_directory_uri() . '/assets/js/jquery.validate.min.js' , ['jquery'], '1.19.3', true );
    wp_enqueue_script( 'libraries-js',  get_template_directory_uri() . '/assets/js/libraries.js' , ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'main-js',  get_template_directory_uri() . '/assets/js/main.js?v=6' , ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'main2-js',  get_template_directory_uri() . '/assets/js/main2.js' , ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'animations-js',  get_template_directory_uri() . '/assets/js/animations.js' , ['jquery'], '1.0.0', true );
    wp_enqueue_script( 'event-checkout-js',  get_template_directory_uri() . '/assets/js/event-checkout.js' , ['jquery'], '4.0.0', true ); 


    //  pagination defaults
    if ( is_page(159) || is_page(104) || is_page(156) || is_page(175)  || is_page(167) || is_archive() || $urlpath === 'vacatures' )  {
      wp_enqueue_script( 'pagination-js',  get_template_directory_uri() . '/assets/js/pagination.min.js' , ['jquery'], '1.0.0', true ); 
      wp_enqueue_script( 'pagination-defaults-js',  get_template_directory_uri() . '/assets/js/pagination-defaults.js' , ['jquery'], '1.0.0', true ); 
    }

    // workgiver pagination
    if ( is_page(159) ) {
      wp_enqueue_script( 'workgivers-pagination-js',  get_template_directory_uri() . '/assets/js/pagination-workgivers.js' , ['jquery'], '1.0.0', true ); 
    }

    // partners pagination
    if ( is_page(104) ) {
      wp_enqueue_script( 'partners-pagination-js',  get_template_directory_uri() . '/assets/js/pagination-partners.js' , ['jquery'], '1.0.0', true ); 
    }

    // Magazine pagination & categories
    if ( is_page(156) || is_archive() ) {
      wp_enqueue_script( 'magazine-pagination-js',  get_template_directory_uri() . '/assets/js/pagination-magazine.js' , ['jquery'], '1.0.0', true ); 
    }
    

    // Events pagination
    if ( is_page(175) ) {
      wp_enqueue_script( 'events-pagination-js',  get_template_directory_uri() . '/assets/js/pagination-events.js' , ['jquery'], '1.0.0', true ); 
    }

    // Vacancies pagination

    if ( $urlpath === 'vacatures' ) {
      wp_enqueue_script( 'events-vancacies-js',  get_template_directory_uri() . '/assets/js/pagination-vancacies.js' , ['jquery'], '1.0.0', true ); 
    }





}

add_action( 'wp_enqueue_scripts', 'javascript_custom' );









