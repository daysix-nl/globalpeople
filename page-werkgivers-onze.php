<?php 

    // Template Name: PAGE: Werkgivers Onze

     get_header(); 


    // pagination
    function pagination_bar( $custom_query ) {

        $total_pages = $custom_query->max_num_pages;
        $big = 999999999; // need an unlikely integer

        if ($total_pages > 1){
            $current_page = max(1, get_query_var('paged'));

            echo paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => $current_page,
                'total' => $total_pages
                
            ));
        }
    }



    //  get & cache workgivers each day
    if( false === ( $workgivers = get_transient('posts_transient_werkgevers') ) ) {


        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $workgivers = new WP_Query( array(
            'post_type' => 'onze-werkgever',
            'orderby' => 'date',
            'order'   => 'DESC',        
            'posts_per_page'    => 8,
            'paged'             => $paged
        ));

        set_transient('posts_transient_werkgevers', $workgivers, DAY_IN_SECONDS );
    }



   

?>

<div class="werk-header workgivers-header">
    <img class="shape" src="/wp-content/uploads/2021/01/Shape-3.png">

    <div class="container">
       
        <h1 data-animation="fadeInTop"> <?=get_field('title')?> </h1>
        
        <p class="silver mt24 adelay200" data-animation="fadeInTop"> <?=get_field('description')?> </p>

    </div>

</div>



<section class="workgivers adelay400" data-animation="fadeInDown" >


    <div class="container">

        <?php if ( $workgivers->have_posts() ): ?>

            <div class="workgivers-grid" id="posts" data-url="onze-werkgevers">
                <!-- content of posts here is coming from JS API -->
                <!--  JAVASCRIPT IS IN assets/js/workgivers-pagination.js -->
            </div>

            <nav class="pagination" style="display: none">
                <?php pagination_bar( $workgivers ); ?>
            </nav>

            <div id="pagination"> </div>

        <?php wp_reset_postdata(); endif;  ?>
            

    </div>
    
</section>



<?php get_footer(); ?>