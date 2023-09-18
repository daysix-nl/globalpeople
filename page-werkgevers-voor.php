<?php 

    // Template Name: PAGE: Werkgevers Voor
    get_header(); 

?>

<div class="werk-header">
    <img src="/wp-content/uploads/2021/01/Shape-1-1.png" class="shape">
    <div class="container">
        <div class="left">
            <h1 data-animation="fadeInTop"> <?=get_field('title')?> </h1>
        </div>

        <div class="right">
            <h3 data-animation="fadeInTop"> <?=get_field('subtitle')?> </h3>

            <p data-animation="fadeInTop" class="adelay200">
                <?=get_field('description')?>
            </p>

            <a href="<?=get_field('heading_link')['url']?>" class="textLink orange adelay400" data-animation="fadeInTop"> <?=get_field('heading_link')['title']?> <arrow>➝</arrow> </a>
        </div>
    </div>
</div>


<?php if( have_rows('grid_links') ): ?>
    <div class="werk-features">
        <div class="container">
            <h1 data-animation="fadeInTop"> <?=get_field('grid_links_title')?> </h1>

            <div class="features">
           
                <?php while( have_rows('grid_links') ): the_row(); 
                    $icon = get_sub_field('icon')['sizes']['thumbnail'];
                    $title = get_sub_field('name');
                    $link = get_sub_field('link')['url'];
                ?>
                    <a href="<?=$link?>" data-animation="fadeInTop">
                        <img class="logo" src="<?=$icon?>">
                        <img class="arrow" src="/wp-content/uploads/2021/01/icon.png">
                        <p> <?=$title?> </p>
                    </a>

                <?php endwhile; ?>

            </div>
        </div>
    </div>
<?php endif; ?>


<div class="werk-info-6" style="margin-top: 156px;" id="werving">
    <div class="container">
        <div class="left" data-animation="fadeInDown">
            <img class="image" src="<?=get_field('flex_1_image_left')['url']?>">
        </div>

        <div class="right middle">
            <div class="info-1 checkmark-list">

                <?=get_field('flex_1_content_top')?>

                <a target="<?=get_field('flex_1_button')['target']?>" href="<?=get_field('flex_1_button')['url']?>" class="button-1 adelay500" data-animation="fadeInTop">
                    <span><?=get_field('flex_1_button')['title']?></span>
                    <div></div>
                </a>
            </div>

            <div class="tabs-1" style="margin-top: 80px" data-animation="fadeInTop">

                <h3> <?=get_field('flex_1_dropdowns_title')?> </h3>

                <div class="werk-dropdowns">

                    <?php $x=0; while( have_rows('flex_1_dropdowns') ): the_row();  $x++;
                        $title = get_sub_field('title');
                        $text = get_sub_field('text');
                    ?>

                         <div class="item tab <?php if ($x==1) {echo 'opened';} ?>">
                            <div class="title name">
                                <div class="toggle"> <img src="/wp-content/uploads/2021/01/icon-2.png"></div>
                                <?=$title?>    
                            </div>
                            <div class="answer content">
                                <?=$text?>   
                            </div>
                        </div>

                    <?php endwhile; ?>


                </div>
            </div>
        </div>
    </div>
</div>


<div class="werk-info-2" style="margin-top: 100px;" id="training">
    <div class="container">
        <div class="left middle">
            <div class="info-1 checkmark-list">
                
                <?=get_field('flex_2_content_top')?>

                <a target="<?=get_field('flex_2_button')['target']?>" href="<?=get_field('flex_2_button')['url']?>" class="button-1 adelay500" data-animation="fadeInTop">
                    <span> <?=get_field('flex_2_button')['title']?> </span>
                    <div></div>
                </a>
            </div>
        </div>

        <div class="right" data-animation="fadeInDown">
            <img class="image" src="<?=get_field('flex_2_image_right')['url']?>">
        </div>
    </div>
</div>


<?php

    //  get & cache partners each day
    if( false === ( $events = get_transient('posts_transient_events_recent') ) ) {

        
        $events = new WP_Query( array(
            'post_type' => 'event',
            'orderby' => 'date',
            'order'   => 'DESC',          
            'posts_per_page'    => 10
           
        ));

        set_transient('posts_transient_events_recent', $events, DAY_IN_SECONDS );
    }


?>

<div class="werk-dark-slider" style="margin-top: 160px; margin-bottom: 20px;" id="netwerk">
    <img src="/wp-content/uploads/2021/01/Subtract.png" class="shape">

    <div class="container">
        <h3 class="title" data-animation="fadeInTop"> <?=get_field('netwerk_title')?> </h3>

        <p class="description adelay200" data-animation="fadeInTop">
            <?=get_field('netwerk_description')?>
        </p>

        <div class="controls noselect adelay400" data-animation="fadeInTop">
            <div class="wsp"><img src="/wp-content/uploads/2021/01/icon-4.png"></div>
            <div class="wsn"><img src="/wp-content/uploads/2021/01/icon-4.png"></div>
        </div>

        <div class="items adelay400" data-animation="fadeInTop">
            <div class="swiper-wrapper" style="color: #fff;">

                <?php while ($events->have_posts()) : $events->the_post(); ?>

    

                     <div class="swiper-slide">
                        <div class="post-2">
                            <div class="left">
                                <a href="<?php the_permalink()?>">
                                        <div class="image">
                                        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'medium' ); ?>
                                        <img src="<?php echo $url ?>" alt="<?php the_title()?> image" />
                                        <span class="date"> <img src="/wp-content/uploads/2021/01/.png"> <?=get_field('event_date')?> </span>
                                    </div>
                                </a>
                            </div>

                            <div class="right">
                                <a href="<?php the_permalink()?>">  <h3 class="title"> <?php the_title()?>  </h3> </a>
                                <p class="description limitRows4">  <?=get_the_excerpt() ?> </p>
                                <a href="<?php the_permalink()?>" class="textLink orange"> Lees meer over dit event <arrow>➝</arrow> </a>
                            </div>
                        </div>
                    </div>

                 

                <?php endwhile ; wp_reset_postdata() ; ?>

                
                
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php include 'template-parts/block-newsletterForm.php'; ?>
</div>
<?php get_footer(); ?>
