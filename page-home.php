<?php 

	// Template Name: PAGE: Home
	get_header(); 

?>



<section class="hp-jumbo">
	
	<div class="container">

		<div class="hp-jumbo-flex">
			<div class="left">

				<h1 data-animation="fadeInTop"><?=get_field('heading_title')?></h1>
				<p class="silver mt24 fw500 fs18 mb28 adelay200" data-animation="fadeInTop"> <?=get_field('heading_subtitle')?> </p>


				<a href="<?=get_field('heading_button')['url']?>" class="button-1 big adelay400" data-animation="fadeInTop">
                    <span> <?=get_field('heading_button')['title']?> <arrow>➝</arrow> </span>
                    <div></div>
                </a>

			</div>

			<div class="right" data-animation="fadeIn">
				<img src="<?=get_field('heading_image')?>" alt="<?=get_field('heading_title')?> Image">
			</div>
		</div>

	</div>


</section>



<section class="floating-ad" data-animation="fadeInDown">
	<div class="container">
		<div class="box corner-triangle ct-bottomRight ct-purple" >
			<div class="left">
				<h2> <?=get_field('float_title')?>  </h2>
			</div>

			<div class="right">
				<p class="fs18 silver"> <?=get_field('float_description')?> </p> 
			</div>
		</div>
	</div>
</section>


<section class="partners">
	<div class="container">
		<div class="cnt">
			<h2 class="mb24" data-animation="fadeInTop">  <?=get_field('werklogos_title')?> </h2>
			<a href="<?=get_field('werklogos_link')['url']?>" class="textLink textShadow adelay200" data-animation="fadeInTop"> <?=get_field('werklogos_link')['title']?>  <arrow>➝</arrow> </a>
		</div>
	</div>

	<div class="partners-grid">
		

		<div class="swiper-container homepage-partners-slider">
		    <div class="swiper-wrapper">
		        <?php 
				$images = get_field('werklogos_logos');
				if( $images ): ?>
			        <?php foreach( $images as $image ): ?>
			            <div class="item swiper-slide" data-animation="">
							<img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="Partner logo" />
						</div>
			        <?php endforeach; ?>
				<?php endif; ?>
		    </div>
		</div>

	</div>

</section>

<section>
	<div class="container">
		<div class="test">
			<h3>Dit is een test</h3>
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



<section class="werk-tabs-wrapper" data-animation="fadeInDown">
	<div class="container">

		<div class="werk-tabs" >

			<div class="tabs">
				<ul>
					<li class="active" for="#werkzoekenden"> <?=get_field('werkz_tab_name')?> </li>
					<li for="#werkgevers"> <?=get_field('werkg_tab_name')?> </li>
				</ul>
			</div>

			<div class="tab-content visible" id="werkzoekenden">
				
				<div class="tab-content-flex">

					<div class="left">
						<img src="<?=get_field('werkz_image')['sizes']['medium']?>" alt="<?=get_field('werkz_tab_name')?> Image">
					</div>

					<div class="right">
						<h2> <?=get_field('werkz_title')?> </h2>
						<div class="werk-dropdowns">

							<?php if( have_rows('werkz_dropdowns') ): ?>

								<?php $a=0; while( have_rows('werkz_dropdowns') ): the_row(); ?>
				  
									<div class="item <?php if( $a == 0 ) { echo 'opened'; } ?>"> 
										<div class="title">
											<h4> 
												<div> <img src="<?=get_sub_field('icon')?>" alt="<?=get_sub_field('title')?> icon">  </div>
												<?=get_sub_field('title')?>
											</h4>
										</div>
										<div class="answer">
											<p class="silver"> <?=get_sub_field('description')?> </p>
										</div>
									</div>

								<?php $a++; endwhile; ?>

							<?php endif; ?>

						</div>

						<div class="cta-button">
							<a href="<?=get_field('werkz_button')['url']?>" class="button-1 ">
			                    <span> <?=get_field('werkz_button')['title']?> <arrow>➝</arrow> </span>
			                    <div></div>
			                </a>
						</div>
					</div>

				</div>				
			</div>

			<div class="tab-content" id="werkgevers">
				
				<div class="tab-content-flex">

					<div class="left">
						<img src="<?=get_field('werkg_image')['sizes']['medium']?>" alt="<?=get_field('werkg_tab_name')?> Image">
					</div>

					<div class="right">
						<h2> <?=get_field('werkg_title')?></h2>
						<div class="werk-dropdowns">

							
							<?php if( have_rows('werkg_dropdowns') ): ?>

								<?php $a=0; while( have_rows('werkg_dropdowns') ): the_row(); ?>
				  
									<div class="item <?php if( $a == 0 ) { echo 'opened'; } ?>"> 
										<div class="title">
											<h4> 
												<div> <img src="<?=get_sub_field('icon')?>" alt="<?=get_sub_field('title')?> icon">  </div>
												<?=get_sub_field('title')?>
											</h4>
										</div>
										<div class="answer">
											<p class="silver"> <?=get_sub_field('description')?> </p>
										</div>
									</div>
									
								<?php $a++; endwhile; ?>

							<?php endif; ?>

						</div>

						<div class="cta-button">
							<a href="<?=get_field('werkg_button')['url']?>" class="button-1 ">
			                    <span> <?=get_field('werkg_button')['title']?> <arrow>➝</arrow> </span>
			                    <div></div>
			                </a>
						</div>
					</div>

				</div>				


			</div>


		</div>

	</div>
</section>




<section class="hp-organisations">
	<div class="container">


		<div class="cnt">
			<h2 class="mb16" data-animation="fadeInTop"> <?=get_field('org_title')?> </h2>
			<p class="silver adelay200" data-animation="fadeInTop"> <?=get_field('org_description')?> </p>
		</div>

		<div class="hp-organisations-grid">


			<?php if( have_rows('org_organisations') ): ?>

				<?php  while( have_rows('org_organisations') ): the_row(); ?>
 

					<a href="<?=get_sub_field('link')?>" class="org-grid-item" data-animation="fadeInTop">
						<div class="top bg-orangeOpacity">
							<img src="<?=get_sub_field('logo')['url']?>" alt="<?=get_sub_field('title')?> image">
							<object> <a href="#" style="background:<?=get_sub_field('category_tag_background')?>"> <?=get_sub_field('category_tag')?> </a> </object>
						</div>
						<div class="bottom">
							<date> <?=get_sub_field('date')?> </date>
							<h4 class="mt16"> <?=get_sub_field('title')?> </h4>
							<p class="limitRows2 mt8"> <?=get_sub_field('short_text')?> </p>
						</div>
					</a>
					
				<?php endwhile; ?>

			<?php endif; ?>


		</div>

		<div class="cta-buttons" >

			<a href="<?=get_field('org_button_1')['url']?>" class="button-1 white adelay600" data-animation="fadeInTop">
                <span> <?=get_field('org_button_1')['title']?> </span>
                <div></div>
            </a>

			<a href="<?=get_field('org_button_2')['url']?>" class="button-1 adelay700" data-animation="fadeInTop">
                <span> <?=get_field('org_button_2')['title']?> </span>
                <div></div>
            </a>
		</div>


	</div>
</section>

<div style="margin:16px; margin-top: 60px;">
	<div class="events-dark">
	    <img class="shape" src="/wp-content/uploads/2021/01/Shape-1.png">
	    <div class="container">
	        <div class="heading">
	            <div class="left">
	                <h2 data-animation="fadeInTop"> <?=get_field('ev_title')?> </h2>
	                <a target="<?=get_field('ev_link')['target']?>" href="<?=get_field('ev_link')['url']?>" data-animation="fadeInTop" class="adelay200">
	                    <?=get_field('ev_link')['title']?>  <arrow>➝</arrow>
	                </a>
	            </div>

	            <div class="right" data-animation="fadeInDown">
	                <p>
	                    <?=get_field('ev_description')?>
	                </p>
	            </div>
	        </div>

	        <?php
			$featured_events = get_field('events_to_show');
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
			                    <img src="/wp-content/uploads/2021/01/icon-1.png" alt="date icon">
			                </div>
			            </a>
			        <?php endforeach; ?>
		        </div>
		    <?php endif; ?>

	    </div>
	</div>
</div>


<section class="bg-orangeOpacity image-cnt-flex corner-triangle ct-topRight ct-white">
	<div class="container">

		<div class="image mb20" data-animation="fadeInDown">
			<img src="<?=get_field('fgp_image')?>" alt=" Image">
		</div>

		<div class="text adelay200" data-animation="fadeInTop">
			<h2 class="mb20"> <?=get_field('fgp_title')?> </h2>
			<a target="<?=get_field('fgp_link')['target']?>" href="<?=get_field('fgp_link')['url']?>" class="textLink orange"> <?=get_field('fgp_link')['title']?> <arrow>➝</arrow> </a>
			<?=get_field('fgp_content')?>
		</div>

	</div>
</section>



<section class="incl-form">

	<div class="container">
		<?php include 'template-parts/block-newsletterForm.php'; ?>
	</div>
	
</section>

<?php get_footer(); ?>

