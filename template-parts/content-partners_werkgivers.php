
<div class="default-blue-header">
    <div class="container">
        <h1 data-animation="fadeInTop"> <?php the_title() ?>  </h1>
    </div>
</div>

<div class="single-info-post-1" style="margin-top: 40px;">
    <div class="container">
        <div class="left adelay200" data-animation="fadeInDown">
           <div class="options">
            
                <?php if (get_field('facebook')) { ?>
                    <a target="_blank" href="<?=get_field('facebook')?>"> <img src="/wp-content/uploads/2021/01/Facebook.svg" alt="fb icon"> </a>  
                <?php } ?>

                <?php if (get_field('youtube')) { ?>
                    <a target="_blank" href="<?=get_field('youtube')?>"> <img src="/wp-content/uploads/2021/01/Youtube-color-1.svg" alt="youtube icon"> </a>  
                <?php } ?>

                <?php if (get_field('twitter')) { ?>
                   <a target="_blank" href="<?=get_field('twitter')?>"> <img src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg" alt="twitter icon"> </a> 
                <?php } ?>

                <?php if (get_field('linkedin')) { ?>
                    <a target="_blank" href="<?=get_field('linkedin')?>"> <img src="/wp-content/uploads/2021/01/linkedin.svg" alt="linkedin icon"> </a> 
                <?php } ?>

                <?php if (get_field('instagram')) { ?>
                    <a target="_blank" href="<?=get_field('instagram')?>"> <img src="/wp-content/uploads/2021/01/instagram.svg" alt="instagram icon"> </a> 
                <?php } ?>

                <?php if (get_field('website')) { ?>
                    <a target="_blank" href="<?=get_field('website')?>"> <img src="/wp-content/uploads/2021/01/globe.svg" alt="globe iocn"> </a>
                <?php } ?>

            </div>

            <div class="partner-werk-content adelay400" data-animation="fadeInDown">
            	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content();
                endwhile; else: ?>
                    <p>Sorry, no posts matched your criteria.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="right" style="margin-top: -136px" data-animation="fadeInDown">
            <div class="brand white">
            	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' ); ?>
				<img src="<?php echo $url ?>" alt="<?php the_title()?> Image" />
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 120px;">
    <?php include 'block-newsletterForm.php'; ?>
</div>
 