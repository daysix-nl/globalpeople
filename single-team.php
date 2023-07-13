<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GlobalPeople
 */


//  TEAM MEMBER TEMPLATE




global $post;
$terms = wp_get_post_terms( $post->ID, 'team_category');
$cats = [];
foreach ($terms as $term ) {
	array_push($cats, $term->term_id );
}


$other_team = new WP_Query( array(
    'post_type' => 'team',
    'tax_query' => array(
        'taxonomy' => 'team_category',
        'terms' => $cats,
        'field' => 'term_id'
    ),
    'orderby' => 'rand',
    'order'   => 'DESC',          
    'posts_per_page'    => 6,
    'post__not_in'           => array(get_the_ID())
));



get_header(null, [ 'header_class' => 'h_orange' ]);


?>

	
	<section class="team-single" >

		<div class="container">

			<div style="border-bottom: 1px dashed #8596A7; padding-bottom: 120px;">
				<div class="team-single-item">

					<div class="thumbnail-wrapper">
						<div class="thumbnail" data-animation="fadeInDown">
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' ); ?>
							<img src="<?php echo $url ?>" alt="<?php the_title()?> Image" />
						</div>
					</div>

					<h2 class="mb24 adelay200" data-animation="fadeInTop"> <?php the_title()?> </h2>
					<h4 class="adelay400" data-animation="fadeInTop"> <?=get_field('position')?> </h4> 

					<div class="socials-center mt40 adelay600" data-animation="fadeInTop">
						<ul>
							 <?php if (get_field('facebook')) { ?>
			                    <li><a target="_blank" href="<?=get_field('facebook')?>"> <img src="/wp-content/uploads/2021/01/Facebook.svg" alt="fb icon"> </a>  </li>
			                <?php } ?>

			                <?php if (get_field('youtube')) { ?>
			                    <li><a target="_blank" href="<?=get_field('youtube')?>"> <img src="/wp-content/uploads/2021/01/Youtube-color-1.svg" alt="youtube icon"> </a>  </li>
			                <?php } ?>

			                <?php if (get_field('twitter')) { ?>
			                   <li><a target="_blank" href="<?=get_field('twitter')?>"> <img src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg" alt="twitter icon"> </a> </li>
			                <?php } ?>

			                <?php if (get_field('linkedin')) { ?>
			                    <li><a target="_blank" href="<?=get_field('linkedin')?>"> <img src="/wp-content/uploads/2021/01/linkedin.svg" alt="linkedin icon"> </a> </li>
			                <?php } ?>

			                <?php if (get_field('instagram')) { ?>
			                    <li><a target="_blank" href="<?=get_field('instagram')?>"> <img src="/wp-content/uploads/2021/01/instagram.svg" alt="instagram icon"> </a> </li>
			                <?php } ?>

			                <?php if (get_field('website')) { ?>
			                    <li><a target="_blank" href="<?=get_field('website')?>"> <img src="/wp-content/uploads/2021/01/globe.svg" alt="globe iocn"> </a></li>
			                <?php } ?>

			                <?php if (get_field('eemail')) { ?>
			                    <li><a href="mailto:<?=get_field('eemail')?>"> <i style="color: var(--blue);font-size: 11px;" class="fas fa-envelope"></i> </a></li>
			                <?php } ?>

			                <?php if (get_field('phone')) { ?>
			                    <li><a href="tel:<?=get_field('phone')?>"> <i style="color: var(--blue);font-size: 11px;" class="fas fa-phone"></i> </a></li>
			                <?php } ?>


						</ul>
					</div>

					<div class="member-desc mt40 silver adelay600" data-animation="fadeInTop">
				<?php echo get_post_field('post_content', $post->ID); ?>

					</div>

				</div>
			</div>

		</div>

	</section>


	<section class="team-without-tabs">
		<div class="container">


			<h2 data-animation="fadeInTop"> Andere team leden </h2>

			<div class="team-grid" id="raad-van-advies">
				<?php if( $other_team->have_posts() ): ?> 
					         
		        <?php $r = 0; while( $other_team->have_posts() ) : $other_team->the_post(); $r+=100; ?>
		 

					<a href="<?php the_permalink()?>" class="team-item adelay<?=$r?>" data-animation="fadeInTop">

						<div class="thumbnail">
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'medium' ); ?>
							<img src="<?php echo $url ?>" alt="<?php the_title()?> Image" />
						</div>

						<div class="info mt24">
							<h4> <?php the_title() ?> </h4>
							<p class="silver mt8"> <?=get_field('position')?> </p>
						</div>

					</a>

	
		        <?php endwhile; endif; ?>

			</div>


		</div>
	</section>


<?php

get_footer();

