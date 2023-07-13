<?php 

	// Template Name: PAGE: Plan een adviesgesprek 
 
	get_header(null, [ 'header_class' => 'h_orange' ]);


?>
<?php do_shortcode('[datetimepicker]') ?>
<section class="plan-een">
	<div class="container">
		<div class="plan-een-flex">


			<div class="left">

				<div class="plan-form shadow-for-box">

					<div class="plan-form-wrap">

						<h2 data-animation="fadeInTop"> <?=get_field('form_title')?> </h2>
						<p style="display: none;" class="silver mt8"></p> 

						<div class="form-styles form-styles-2 mt24 adelay200" data-animation="fadeInTop">

				
							<?php echo do_shortcode('[contact-form-7 id="443" title="Plan een adviesgesprek  - Form"]') ?>

							<p class="terms"> <?=get_field('terms_text')?> </p>

						</div>
					</div>

					<div class="thank-you-succes-form">
	                    <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
	                    <h3 class="mt16"> <?=get_field('success_title')?> </h3>
	                    <p class="silver mt8"> <?=get_field('success_description')?> </p> 
	                </div>

				</div>
			</div>

			<div class="right checkmark-list" data-animation="fadeInDown">

				<?=get_field('content_right')?>

			</div>

		</div>
	</div>
</section>

<section class="team-without-tabs plan-team">
	<div class="container">


		<h2 data-animation="fadeInTop"> <?=get_field('team_title')?> </h2>
		<p class="silver mb80 adelay200" data-animation="fadeInTop"> <?=get_field('team_description')?>  </p>

		
		<?php
			
			$post_type = 'team';
			$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
			$x=0; ?>
			
			 
	    	<div class="team-grid" id="team-<?=$x?>">

		        <?php
		        $args = array(
	                'post_type' => $post_type,
	                'posts_per_page' => -1,  //show all posts
	                'orderby' => 'menu_order', 
					'order' => 'ASC', 
	                'tax_query' => array(
	                    array(
	                        'taxonomy' => 'team_category',
	                        'field' => 'slug',
	                        'terms' => 'ons-team',
	                    )
	                )
	 
	            );

		        $posts = new WP_Query($args);

		 
		        if( $posts->have_posts() ): ?> 
		         
		        <?php $y=0; while( $posts->have_posts() ) : $posts->the_post(); $y+=100; if ($y == 1200) {$y = 100;} ?>
		 

					<a href="<?php the_permalink()?>" class="team-item adelay<?=$y?>" data-animation="fadeInTop">

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



<style type="text/css">
	.dateandtime {display:none}
	.plan-form-wrap br {display: none}
</style>

<?php get_footer(); ?>

