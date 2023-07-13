<?php 

    // Template Name: PAGE: Werkzoekend
    get_header(); 

?>

<div class="werk-header">
    <img src="/wp-content/uploads/2021/01/Shape-2.png" class="shape">
    <div class="container">
        <div class="left">
            <h1> <?=get_field('title')?></h1>
        </div>

        <div class="right">
            <h3> <?=get_field('title_right')?>  </h3>
            <p>  <?=get_field('text_right')?> </p>
            <a target="<?=get_field('link_right')['target']?>" href="<?=get_field('link_right')['url']?>" class="textLink orange"> <?=get_field('link_right')['title']?> <arrow>➝</arrow> </a>
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


<!-- 1 -->
<div class="werk-info-1" style="margin-top: 156px;" id="Interessante">
    <div class="container">
        <div class="left">
            <img class="image" src="<?=get_field('flex_1left_image_1')['url']?>">
            <img class="shape" src="/wp-content/uploads/2021/01/Shape.png">
            <img class="image" src="<?=get_field('flex_1left_image_2')['url']?>">
        </div>

        <div class="right middle">
            <div class="info-1 checkmark-list">
                
                <?=get_field('flex_1right_content')?>

                <a href="<?=get_field('flex_1right_button')['url']?>" class="button-1 adelay400" data-animation="fadeInTop">
                    <span> <?=get_field('flex_1right_button')['title']?> </span>
                    <div></div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 2 -->

<div class="werk-info-2" style="margin-top: 100px;" id="Coaching">
    <div class="container">
        <div class="left middle">
            <div class="info-1 checkmark-list">

                <?=get_field('flex_2left_content')?>

                <a href="<?=get_field('flex_2button')['url']?>" class="button-1 adelay400" data-animation="fadeInTop">
                    <span><?=get_field('flex_2button')['title']?></span>
                    <div></div>
                </a>
            </div>
        </div>

        <div class="right" data-animation="fadeInDown">
            <img class="image" src="<?=get_field('flex_2right_image')['url']?>">
        </div>
    </div>
</div>

<!-- 3 -->
<div class="werk-info-3" style="margin-top: 160px;" id="Kennis">
    <div class="container">
        <div class="left" data-animation="fadeInDown">


            <?php
            $magazine_post = get_field('flex3_magazine_post');
            if( $magazine_post ): 
                    $permalink = get_permalink( $magazine_post->ID );
                    $title = get_the_title( $magazine_post->ID );
                    $text = get_the_excerpt( $magazine_post->ID);
                ?>
                <h3></h3>

                <a href="<?=$permalink?>" class="post-1">

                    <div>
                        <div class="image">
                            <?php $url = wp_get_attachment_url( get_post_thumbnail_id($magazine_post->ID), 'medium' ); ?>
                            <img src="<?php echo $url ?>" alt=" <?php echo esc_html( $title ); ?> image"  />
                        </div>
                    </div>

                    <h4 class="title">
                       <?php echo esc_html( $title ); ?>
                    </h4>

                    <p class="description">
                        <?=$text?> 
                    </p>
                </a>

            <?php endif; ?>

            

        </div>

        <div class="right middle adelay200" data-animation="fadeInTop" id="Kennis">
            <div class="info-1 checkmark-list">

                <?=get_field('flex_3right_content')?>

                <a href="<?=get_field('flex_3right_button')['url']?>" class="button-1">
                    <span><?=get_field('flex_3right_button')['title']?></span>
                    <div></div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 4 -->
<div class="werk-info-4" style="margin-top: 160px;" id="netwerk">
    <div class="container">
        <div class="left middle">
            <div class="info-1 checkmark-list" >

                <?=get_field('flex_4left_content')?>

                <a href="<?=get_field('flex_4left_button')['url']?>" class="button-1 mt0 adelay300" data-animation="fadeInTop">
                    <span><?=get_field('flex_4left_button')['title']?></span>
                    <div></div>
                </a>
            </div>
        </div>

        <div class="right" data-animation="fadeInDown">
            <img class="image" src="<?=get_field('flex_4right_image')['url']?>">
        </div>
    </div>
</div>


<!-- 5 -->

<div class="werk-info-5" style="margin-top: 102px;" id="wervingsevents">
    <div class="container">
        <div class="left" data-animation="fadeInDown">
            <img class="image" src="<?=get_field('flex_5left_image_1')['url']?>">
            <img class="shape" src="/wp-content/uploads/2021/01/Shape-1.png">
            <img class="image" src="<?=get_field('flex_5left_image_2')['url']?>">
        </div>

        <div class="right middle">
            <div class="info-1 checkmark-list">

                <?=get_field('flex_5right_content')?>

                <a href="<?=get_field('flex_5right_link')['url']?>" class="textLink orange adelay300" data-animation="fadeInTop"> <?=get_field('flex_5right_link')['title']?> <arrow>➝</arrow> </a>
            </div>
        </div>
    </div>
</div>


<!--  EVENTS -->

<div class="events-dark" style="margin-top: 180px; margin-bottom: 20px;" id="Vacatures">
    <img class="shape" src="/wp-content/uploads/2021/01/Shape-1.png">
    <div class="container">
        <div class="heading">
            <div class="left">
                <h2 data-animation="fadeInTop"> <?=get_field('events_title')?> </h2>
                <a href="<?=get_field('events_link')['url']?>" data-animation="fadeInTop" class="adelay200">
                    <?=get_field('events_link')['title']?> <arrow>➝</arrow>
                </a>
            </div>

            <div class="right" data-animation="fadeInDown">
                <p>
                    <?=get_field('events_description')?>
                </p>
            </div>
        </div>

        <?php
        $featured_events = get_field('events_to_show',6);
        if( $featured_events ): ?>

            <div class="events" >
                <?php foreach( $featured_events as $featured_event ): 
                        $permalink = get_permalink( $featured_event->ID );
                        $title = get_the_title( $featured_event->ID );
                        $date_text = get_field( 'event_date_text', $featured_event->ID );

                    ?>
                    <a href="<?=$permalink?>" class="event" data-animation="fadeInTop">
                        <div>
                            <?=$title?>
                        </div>

                        <div>
                            <?=$date_text?>
                            <img src="/wp-content/uploads/2021/01/icon-1.png">
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


    </div>
</div>

<div class="container">
    <?php include 'template-parts/block-newsletterForm.php'; ?>
</div>

<?php get_footer(); ?>