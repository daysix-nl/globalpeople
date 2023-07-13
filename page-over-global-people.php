<?php 

	// Template Name: PAGE: Over Global People
	get_header(); 

?>


<section class="heading-white posRelative cornerLeftBottom bg-orangeOpacity" style="padding: 120px 0 345px 0">

	<img data-animation="fadeInDown" src="/wp-content/uploads/2021/01/Shape-1.svg" alt="bg docration shape"> 
	<div class="container">

		<div class="heading-white-flex">
			<h1 data-animation="fadeInTop"> <?=get_field('title')?> </h1>
			<p class="silver adelay200" data-animation="fadeInTop"> <?=get_field('description')?> </p>
		</div>

	</div>
</section>



<section class="video-alone">
	<div class="container">

		<div class="video169" data-animation="fadeInDown">
			<div class="thumbnail">
				<img class="thumb" src="<?=get_field('video_thumbnail')['sizes']['medium_large']?>" alt="video thumbnail">
				<button class="playVideo">
					<img src="/wp-content/uploads/2021/01/play-icon-red.svg" alt="play icon">
				</button> 
			</div>
			<div class="video">
				<iframe class="videoSrc" data-src="<?=get_field('iframe_embed_url')?>?enablejsapi=1&version=3&playerapiid=ytplayer" modestbranding="0"  controls="0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div> 
		</div>
	</div>
</section>


<section class="number-stats">
	<div class="container">
		<div class="number-stats-flex">
			
			<div class="left">
				<h2 data-animation="fadeInTop"> <?=get_field('left_title')?> </h2>
				<p class="silver mt24 adelay200" data-animation="fadeInTop"> <?=get_field('left_description')?></p>
			</div>

			<div class="right">
				<div class="stats-grid adelay300" data-animation="fadeInDown">


					<?php if( have_rows('right_items') ): ?>
				  
					    <?php  while( have_rows('right_items') ): the_row(); 
					        $numb = get_sub_field('number');
					        $label = get_sub_field('label');
					    ?>
					        <div class="stats-item">
								<h2> <?=$numb?> </h2>
								<p class="silver mt8"> <?=$label?> </p>
							</div>

					    <?php  endwhile; ?>
					    
					<?php endif; ?>

					


				</div>
			</div>

		</div>
	</div>
</section>



<section class="diverse-world">
	<div class="container">
		<div class="diverse-world-flex">

			<div class="left">
				<div class="imagesBox" data-animation="fadeInDown">
					<img src="<?=get_field('diverse_left_image_1')['sizes']['medium']?>" alt="Diverse world 1">
					<img src="<?=get_field('diverse_left_image_2')['sizes']['medium']?>" alt="Diverse world 2">
					<span class="orangeCircle"></span>
				</div>
			</div>

			<div class="right adelay200" data-animation="fadeInTop">
				<?=get_field('diverse_right_content')?>
			</div>


		</div>
	</div>
</section>



<section class="met-features">

	<div class="container">
		<div class="cnt">
			<h2 class="mb24" data-animation="fadeInTop"> <?=get_field('met_title')?> </h2>
			<a target="<?=get_field('met_link')['target']?>" href="<?=get_field('met_link')['url']?>" class="textLink adelay200" data-animation="fadeInTop"> <?=get_field('met_link')['title']?> <arrow>➝</arrow> </a>
		</div>


		<div class="met-features-grid">


			<?php if( have_rows('met_features_grid') ): ?>
				  
			    <?php $o=100; while( have_rows('met_features_grid') ): the_row(); 
			        $icon = get_sub_field('icon')['sizes']['thumbnail'];
			        $title = get_sub_field('title');
			        $desc = get_sub_field('description');
			    ?>
			        <div class="met-feature adelay<?=$o?>" data-animation="fadeInTop">
						<div class="icon">
							<img src="<?=$icon?>" alt="<?=$title?> icon" >
						</div>
						<div class="text">
							<h4 class="mb8"> <?=$title?>  </h4>
							<p> <?=$desc?> </p>
						</div>
					</div>
			    <?php $o+=100; endwhile; ?>
			    
			<?php endif; ?>


		</div>

	</div>

</section>



<section class="shall-we-met">
	<img src="/wp-content/uploads/2021/01/Shape-2.svg" alt="Shape">
	<div class="container">
		<h2 class="mb24" data-animation="fadeInTop"> <?=get_field('letsmeet_title')?> </h2>
		<a target="<?=get_field('letsmeet_link')['target']?>" href="<?=get_field('letsmeet_link')['url']?>" class="textLink orange adelay200" data-animation="fadeInTop">  
			<?=get_field('letsmeet_link')['title']?> 
			<arrow>➝</arrow> 
		</a>
	</div>
</section>








<section class="ons-team" id="ons-team">
	<div class="container">
		<div class="cnt">
			<h2 data-animation="fadeInTop"> <?=get_field('team-title')?> </h2>
			<p class="silver mt8 adelay200" data-animation="fadeInTop"> <?=get_field('team_description')?> </p>
		</div>

		<div class="team-tabs" data-animation="fadeInDown">

			<div class="tabs-list">
				<ul>
					<?php
					$categories = get_terms( 'team_category', array('hide_empty' => true) );
					$k = 0;
					foreach($categories as $category) { $k++; ?>
					 	<li id="<?=$category->slug?>" class="<?php if ( $k == 1 ) {echo 'active';} ?>"> <?=$category->name?> </li> 
					<?php } ?>
				</ul>
			</div>


			
			<div class="team-grids">

				
				<?php
				/*
				 * Loop through Categories and Display Posts within
				 */
				$post_type = 'team';
				 
				// Get all the taxonomies for this post type
				$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
				 
				$x=0;
				foreach( $taxonomies as $taxonomy ) :
				 
				    // Gets every "category" (term) in this taxonomy to get the respective posts
				  
				    $terms = get_terms( $taxonomy );?>

				
					    <?php foreach( $terms as $term ) : $x++; ?>

					    	<div class="team-grid" id="<?='tab-content-'.$term->slug;?>">

					        <?php
					        $args = array(
				                'post_type' => $post_type,
				                'posts_per_page' => -1,  //show all posts
				                'orderby' => 'menu_order', 
    							'order' => 'ASC', 
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
					         
					        <?php $y=0; while( $posts->have_posts() ) : $posts->the_post(); $y+=100; if ($y == 1200) {$y = 100;} ?>
					 

								<a href="<?php the_permalink()?>" class="team-item adelay<?=$y?>" data-animation="fadeInTop">

									<div class="thumbnail">
										<?=the_post_thumbnail( 'large' );?>
									</div>

									<div class="info mt24">
										<h4> <?php the_title() ?> </h4>
										<p class="silver mt8"> <?=get_field('position')?> </p>
									</div>

								</a>

				
					        <?php endwhile; endif; ?>

					        </div> 
					 
					    <?php endforeach; ?>

				<?php endforeach; ?>

	
			</div>


		</div>


	</div>
</section>

<?php get_footer(); ?>

