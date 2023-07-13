<?php 

    // Template Name: PAGE: Partners
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



    //  get & cache partners each day
    if( false === ( $partners = get_transient('posts_transient_partners') ) ) {

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        
        $partners = new WP_Query( array(
            'post_type' => 'partner',
            'orderby' => 'date',
            'order'   => 'DESC',          
            'posts_per_page'    => 5,
            'paged'             => $paged
        ));

        set_transient('posts_transient_partners', $partners, DAY_IN_SECONDS );
    }

   
?>

<div class="partners-header">
    <img class="shape" src="/wp-content/uploads/2021/01/Shape-3.png">
    <div class="container">
        <h1 data-animation="fadeInTop"> <?=get_field('title')?> </h1>
        <p class="adelay200" data-animation="fadeInDown">
            <?=get_field('description')?>
        </p>
    </div>
</div>

<div class="partners-list adelay200" style="padding-top: 80px; padding-bottom: 160px" data-animation="fadeInDown">
    <div class="container">
        <div class="left">


            <?php if ( $partners->have_posts() ): ?>

                <div class="partners-list" id="posts" data-url="partners">
                    <!-- content of posts here is coming from JS API -->
                    <!--  JAVASCRIPT IS IN assets/js/workgivers-pagination.js -->
                </div>

                <nav class="pagination" style="display: none">
                    <?php pagination_bar( $partners ); ?>
                </nav>

                <div id="pagination"> </div>

            <?php wp_reset_postdata(); endif;  ?>


        </div>

        <div class="right">
            <div class="vertical-newsletter">
                <?php include 'template-parts/block-newsletterForm.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>