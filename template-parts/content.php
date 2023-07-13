<section class="team-single">

    <div class="container">

        <div >
            <div class="team-single-item">

                

                <div class="tags-list mt8">
                    
                    <date> <?php echo get_the_date( 'M d,  Y' ); ?> </date>
                    <!-- echo categories of the current -->
                    <?php $categories = get_the_category( $post->ID ); 
                        foreach($categories as $category) { ?>
                            <a href="/magazine/?category=<?=$category->slug?>"> <?=$category->name?> </a>
                        <?php }
                    ?>

                </div>


                <h2 class="mb24 mt24"> <?php the_title()?> </h2>

                <div class="thumbnail-wrapper">
                    <div class="thumbnaila">
                        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' ); ?>
                        <img src="<?php echo $url ?>" alt="<?php the_title()?> Image" />
                    </div>
                </div>

            </div>

        </div>
    </div>

</section>



<div class="single-info-post-1" >
    <div class="container">
        <div class="left" style="padding-right: 0;">


            <div class="partner-werk-content">
                <?php
                    wp_reset_query(); // necessary to reset query
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile; // End of the loop.
                ?>


            </div>



            <?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

            <div class="share-socials">

                <div class="share-socials-items opacity0 adelay1000" data-animation="fadeIn">

                    <div class="head">
                        <span> Share this article </span>
                    </div>
                    
                    <ul>

                        <li> 
                            <a href="#" 
                                onclick="share_fb('<?php echo $actual_link ?>');return false;" rel="nofollow" 
                                share_url="<?php echo $actual_link ?>" 
                                target="_blank"> <img src="/wp-content/uploads/2021/01/facebook-1.svg"/> 
                            </a> 
                        </li>

                        <li> 
                            <a target="_blank" 
                                href="https://twitter.com/share?url=<?php echo $actual_link ?>&text=<?php the_title()?>"> 
                                <img src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg"/> 
                            </a> 
                        </li>

                        <li>
                            <a target="_blank" 
                                href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $actual_link ?>">
                                <img src="/wp-content/uploads/2021/01/linkedin.svg"/> 
                            </a>
                        </li>


                        <li > 
                            <a href="whatsapp://send?text=<?php echo $actual_link ?>" data-action="share/whatsapp/share">
                                <img src="/wp-content/uploads/2021/01/iconmonstr-whatsapp-1.svg"/> 
                            </a> 
                        </li>
                        
                        <li>
                            <a href="mailto:?subject=I wanted you to see this&amp;body=<?php echo $actual_link ?>"
                               title="Share by Email">
                               <img src="/wp-content/uploads/2021/01/iconmonstr-email-2.svg"/> 
                              
                            </a>
                        </li>

                    </ul>
                </div>

            </div>


        </div>

    </div>
</div>

<div class="container" style="margin-top: 120px;">
    <?php include 'block-newsletterForm.php'; ?>
</div>
 

 <style type="text/css">

    .single-info-post-1 {
        padding-bottom: 120px;
    }

    .single-info-post-1 .container, .team-single-item .thumbnail, .team-single-item .thumbnail-wrapper {
        max-width: 740px;
    }

    .team-single-item {
       padding: 0 20px;
    }

    .team-single-item .thumbnail {
        padding-bottom: 0;
    }

    .team-single-item .thumbnail img {
        position: relative;
    }


    .team-single {
        padding-top: 80px;
    }

    .team-single::before {
        background: #fafafb;
        height: 450px;
    }



    .team-single-item date {
        font-size: 14px;
        font-weight: 500;
        padding: 4px 8px;
        border-radius: 4px;
        background: white;
        margin:4px;
        display: inline-flex;
        align-items: center;
    }


    .tags-list {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .tags-list a {
        background: var(--blue);
        font-weight: 500;
        font-size: 14px;
        padding: 4px 8px;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.2s;
        margin:4px;
        color: white;
    }

    .single-magazine .thumbnail-wrapper {
        max-width: 100%!important;
    }

    .single-magazine .team-single:before  {
        background: #fafafb;
        height: 450px;
    }

    .single-magazine .single-info-post-1 {
        padding-bottom: 0;
    }

    .single-info-post-1 .left {max-width: 100%}

    .single-magazine  .partner-werk-content .wp-block-image img {border-radius: 8px;}
    .single-magazine  .partner-werk-content p {
         word-break: break-word
    }

    .single-magazine  .photonic-stream {
        max-width: 600px !important;
    }
   

 </style>




<div id="fb-root"></div>


<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<script type="text/javascript">

    function share_fb(url) {
      window.open('https://www.facebook.com/sharer/sharer.php?u='+url,'facebook-share-dialog',"width=626, height=436")
    }
    
    
</script>