<?php 

	get_header(null, [ 'header_class' => 'h_silver' ]);

	$host = $_SERVER['HTTP_HOST']; 
	
	function pagination_bar( $custom_query ) {

	    $total_pages = $custom_query->max_num_pages;
	    $big = 999999999; // need an unlikely integer

	    if ($total_pages > 1){
	        $current_page = max(1, get_query_var('paged'));

	        echo paginate_links(array(
	            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	            'format' => '?paged=%#%',
	            'current' => $current_page,
	            'total' => $total_pages,
	            
	        ));
	    }
	}


	//  get & cache workgivers each day

    $category = $_GET['category'];

	if (!$category || !isset($category) ) {
		$category = "";
	}


    if( false === ( $loop = get_transient('posts_transient_magazineeee') ) ) {

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$loop = new WP_Query( array( 				
	        'post_type' 		=> 'magazine',
	        'posts_per_page' 	=> 9,
	       	'paged'  			=> $paged
	       
	    ));

       set_transient('posts_transient_magazineeee', $loop, DAY_IN_SECONDS );
    }


?>


<section class="blog-wrapper">
	<div class="container">


		<div class="blog-hdr mb40">
			<h1 class="" data-animation="fadeInTop"> <?=get_field('title', 156)?> </h1>
			<p class="silver adelay200 " data-animation="fadeInTop"> <?=get_field('description', 156)?> </p>
		</div>

		<div class="posts-and-filters">


			<div class="blog-categories  adelay300" data-animation="fadeInTop">
				<span> <?=get_field('categories_title', 156)?> </span>

				<?php
				$cats = get_terms(
					    array(
					        'taxonomy'   => 'magazine_categories',
					        'hide_empty' => true,
					    )
					);
				?>
				<ul>	
					<li> <a href="/magazine/"> <?=get_field('all_categories', 156)?> </a> </li>
					<?php foreach ($cats as $cat) : ?>
						<li> <a href="/magazine/?category=<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a> </li>
					<?php endforeach; ?>

				</ul>

			</div>


			<div class="posts  adelay300" data-animation="fadeInTop">

				<?php

					
				if ( $loop->have_posts() ): ?>

				<div class="hp-organisations-grid posts-grid" id="posts" data-url="magazine">
					<!-- load posts with JS here -->
					<div class="loader">
				      	<div class="inner one"></div>
				      	<div class="inner two"></div>
				      	<div class="inner three"></div>
				    </div>
				</div>

				<nav class="pagination" style="display: none">
			        <?php pagination_bar( $loop ); ?>
			    </nav>

			

				<?php wp_reset_postdata(); endif;  ?>
				 <div id="pagination"> </div>
			</div>

		</div>

	</div>
</section>


<div class="magaizne-newsletter-wrapper" style="background: #fafafa; padding: 16px;">
	<section class="newsletter-short">

		<img src="/wp-content/uploads/2021/01/Shape-3.svg" alt="Shape Decoration Bg">

		<div class="container">

			<div class="box">


				<h2 class="" data-animation="fadeInTop"> <?=get_field('newsletter_title', 6) ?>  </h2>
				<p class="silver mt16 mb24  adelay200" data-animation="fadeInTop"> <?=get_field('newsletter_subtitle', 6) ?> </p>

				<div class="newsletter-short-box adelay300 " data-animation="fadeInTop">

					<div class="form-styles form-styles-2 mt24">

						<?php echo do_shortcode('[contact-form-7 id="3752" title="Newsletter Mini New (MC Connected)"]') ?>

					</div>

				</div>

			</div>

		</div>
		
	</section>
</div>


<?php get_footer(); ?>

