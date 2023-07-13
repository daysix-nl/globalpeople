<?php 

    // Template Name: PAGE: Events
 
    get_header(null, [ 'header_class' => 'h_silver' ]);


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



    //  get & cache partners each day
    if( false === ( $events = get_transient('posts_transient_events') ) ) {

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        
        $events = new WP_Query( array(
            'post_type' => 'event',
            'orderby' => 'menu_order',
            'order'   => 'DESC',          
            'posts_per_page'    => 6,
            'paged'             => $paged
        ));

        set_transient('posts_transient_events', $events, DAY_IN_SECONDS );
    }


?>


<section class="blog-wrapper">
    <div class="container">


        <div class="blog-hdr mb40">
            <h1 data-animation="fadeInTop"> <?=get_field('title')?> </h1>
            <p class="silver adelay200"  style="max-width: 580px" data-animation="fadeInTop"> 
                <?=get_field('subtitle')?>
            </p>
        </div>

    </div>
</section>



<section class="events adelay200" data-animation="fadeInDown">
    

    <div class="container">

        <?php if ( $events->have_posts() ): ?>

        <div class="events-grid" id="posts" data-url="evenementen">
            <!-- content of posts here is coming from JS API -->
            <!--  JAVASCRIPT IS IN assets/js/pagination-events.js -->
        </div>

        <nav class="pagination" style="display: none">
            <?php pagination_bar( $events ); ?>
        </nav>

        <div id="pagination"> </div>

        <?php wp_reset_postdata(); endif;  ?>


    </div>


</section>



<div class="events-newsletter vertical-newsletter ">
    <div class="container" style="margin-top: 120px;">
        <?php include 'template-parts/block-newsletterForm.php'; ?>
        <img src="/wp-content/uploads/2021/01/eye-for-ebony-OeXcIHFwtsM-unsplash-1.jpg" alt="Newsletter man image">
    </div>
</div>

<?php get_footer(); ?>




