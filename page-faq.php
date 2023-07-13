<?php 

    // Template Name: PAGE: FAQ
    get_header(); 

?>

<div class="faq-header">
    <img class="shape" src="/wp-content/uploads/2021/01/Shape-4.png">
    <div class="container">
        <h1 data-animation="fadeInTop"> <?=get_field('title')?>  </h1>
        <p data-animation="fadeInTop" class="adelay200"> <?=get_field('subtitle')?> </p>
    </div>
</div>

<div class="faq">
    <div class="container werk-tabs">
        <div class="left adelay200" data-animation="fadeInDown">
            <div class="tabs">
                <ul>
                    <?php
                    $categories = get_terms( 'faq_category', array('hide_empty' => true) );
                    $k = 0;
                    foreach($categories as $category) { $k++; ?>
                        <li for="#faq-<?=$k?>" class="<?php if ( $k == 1 ) {echo 'active';} ?>"> <?=$category->name?> </li> 
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="right adelay400" data-animation="fadeInDown">


                
                <?php
                /*
                 * Loop through Categories and Display Posts within
                 */
                $post_type = 'faqs';
                 
                // Get all the taxonomies for this post type
                $taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
                 
                $x=0;
                foreach( $taxonomies as $taxonomy ) :
                 
                    // Gets every "category" (term) in this taxonomy to get the respective posts
                  
                    $terms = get_terms( $taxonomy );?>

                
                        <?php foreach( $terms as $term ) : $x++; ?>

                            <div class="tab-content <?php if ( $x == 1 ) {echo 'visible';} ?>" id="faq-<?=$x?>">
                                <div class="werk-dropdowns tabs-1">
                                    <?php
                                    $args = array(
                                        'post_type' => $post_type,
                                        'posts_per_page' => -1,  //show all posts
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => $taxonomy,
                                                'field' => 'slug',
                                                'terms' => $term->slug,
                                            )
                                        )
                         
                                    );

                                    $posts = new WP_Query($args);

                             
                                    if( $posts->have_posts() ): ?> 
                                     
                                    <?php while( $posts->have_posts() ) : $posts->the_post(); ?>
                             

                                       <div class="item tab">
                                            <div class="title name">
                                                <div class="toggle">
                                                    <img src="/wp-content/uploads/2021/01/icon-2.png">
                                                </div>

                                                <?php the_title() ?>
                                            </div>
                                            <div class="answer content">
                                                <?php the_content() ?>
                                            </div>
                                        </div>

                        
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>  
                     
                        <?php endforeach; ?>

                <?php endforeach; ?>

    
            
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>