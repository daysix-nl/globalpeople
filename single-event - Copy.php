<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GlobalPeople
 */

if($_GET['pay'] ?? false)
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once 'Mollie/vendor/autoload.php';
    require_once 'Mollie/examples/functions.php';

    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey('test_JcWqk3QUCxUCdHnRrpFcn9cQmCAwhd');

    $payment = $mollie->payments->create([
        "amount" => [
            "currency" => "EUR",
            "value" => "10.00"
        ],
        "description" => "My first API payment",
        "redirectUrl" => "https://webshop.example.org/order/12345/",
        "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
    ]);

    header("Location: " . $payment->getCheckoutUrl(), true, 303);

    // $purchases = $wpdb->get_results("SELECT * FROM $wpdb->event_purchases");

    /* Export */

    // $content = '<table>';

    // $i = 0; foreach($purchases as $purchase) 
    // {
    //     if($i == 0)
    //     {
    //         $content .= '<tr>';

    //         foreach($purchase as $key => $value)
    //         {
    //             $content .= '<th>' . str_replace('_' , ' ', str_replace('purchase_', '', $key)) . '</th>';
    //         }

    //         $content .= '</tr>';
    //     }

    //     $content .= '<tr>';

    //     foreach($purchase as $key => $value)
    //     {
    //         $content .= '<td>' . $value . '</td>';
    //     }
        
    //     $content .= '</tr>';

    //     $i++;
    // }

    // $content .= '</table';

    // header('Content-type: application/ms-excel');
    // header('Content-Disposition: attachment; filename=export.xls');

    // echo $content;
    exit;
}


//  EVENTS SINGLE TEMPLATE


get_header(null, [ 'header_class' => 'h_transparent' ]);



?>





<section class="events-single-header">


	<div class="video-background">
		<?php if ( get_field('video_background') ) { ?>
			<video src="<?=get_field('video_background')?>" type="video/mp4" autoplay loop muted playsinline></video>
		<?php } else { ?>
			<img src="<?=get_field('background_image_if_no_video')?>" alt="Event background image">
		<?php } ?>
	</div>

	<div class="container">

		<div>
			<h4 data-animation="fadeInTop"> <?=get_field('small_heading_over_title')?> </h4>
			<h2 class="mt8 mb8 adelay200" data-animation="fadeInTop"> <?php the_title() ?> </h2>
			<p class="silver mb24 adelay400" data-animation="fadeInTop"> <?=get_the_excerpt()?></p>

			<div class="event-cts adelay500" data-animation="fadeInTop"> 
				<a href="#" class="golden-button"> <span> Bestel je kaarten </span> </a>
				<a href="#" class="white-gold-button"> <span> Stem nu </span> </a>
			</div>
		</div>
	</div>

</section>


<!-- FLOATING BASIC INFO AND LOGO -->
<!-- FLOATING BASIC INFO AND LOGO -->
<!-- FLOATING BASIC INFO AND LOGO -->

<section class="event-basic-info adelay200" data-animation="fadeInDown">
	<div class="container">

		<div class="box shadow-for-box">


			<div class="logo">
				<img src="<?=get_field('event_logo')['url']?>" alt="<?php the_title()?> Logo">
			</div>	

			<ul>
				<?php if( have_rows('info_list') ): ?>
				  
				    <?php while( have_rows('info_list') ): the_row(); 
				        $title = get_sub_field('title');
				        $value = get_sub_field('value');
				    ?>
				        <li> <span> <?=$title?> </span> <?=$value?> </li> 
				    <?php endwhile; ?>
				    
				<?php endif; ?>
			</ul>

		</div>

	</div>
</section>


<!-- Diversiteit FEATURES GRID -->
<!-- Diversiteit FEATURES GRID -->
<!-- Diversiteit FEATURES GRID -->
	
<section class="met-features met-features-event" style="background: #FAFAFB;">

	<div class="container">
		<div class="cnt">
			<h2 class="mb24" data-animation="fadeInTop"> <?=get_field('div_title')?> </h2>
			<a href="#" class="textLink gold adelay200" data-animation="fadeInTop"> Lees meer over dit event <arrow>➝</arrow> </a>
		</div>

		<div class="met-features-grid">

			<?php if( have_rows('div_items') ): ?>
				  
			    <?php $o=100; while( have_rows('div_items') ): the_row(); 
			        $icon = get_sub_field('icon');
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


<!-- KANDIDATEN  -->
<!-- KANDIDATEN  -->
<!-- KANDIDATEN  -->

<?php if( have_rows('kandidaten') ): ?>
				  
    
	<section class="ons-team ons-team-event bgWhite">
		<div class="container">
			<div class="cnt">
				<h2> <?=get_field('kand_title')?> </h2>
				<p class="silver mt8">
					<?=get_field('kand_desc')?>
				</p>
			</div>

			<div class="team-tabs" data-animation="fadeInTop">

				<div class="tabs-list">
					<ul>

						<?php $i=0; while( have_rows('kandidaten') ): the_row(); 
					        $tabName = get_sub_field('kand_category_tab_name');
					        $tabSlug =  preg_replace('/\s+/', '', $tabName);
					    ?>
					        <li class="<?php if ( $i == 0 ) {echo 'active';} ?>" for="#<?=$tabSlug?>"> <?=$tabName?> </li>
					    <?php $i++; endwhile; ?>

					</ul>
				</div>


				<div class="team-grids">

					<?php while( have_rows('kandidaten') ): the_row(); 
					        $tabName = get_sub_field('kand_category_tab_name');
					        $tabSlug =  preg_replace('/\s+/', '', $tabName);
					    ?>

					    
		
							<div class="team-grid" id="<?=$tabSlug?>">

								<?php while( have_rows('kandidaten_subcategory') ): the_row(); ?>

									<div class="kand_subcategory_title" style="   ">
										<h3> <?=get_sub_field('subcategory_name')?> </h3>
									</div>

					    
									<?php $p=0; while( have_rows('kandidatens') ): the_row(); 
									        $name = get_sub_field('name');
									        $description = get_sub_field('description');
									        $image = get_sub_field('image');

									        $fb = get_sub_field('facebook');
									        $linkedin = get_sub_field('linkedin');
									        $twitter = get_sub_field('twitter');
									        $youtube = get_sub_field('youtube');
									        $website = get_sub_field('website');
									        $p+=100;
									    ?>

										<div href="#" class="team-item adelay<?=$p?>" data-animation="fadeInTop">

											<div class="thumbnail">
												<img src="<?=$image['sizes']['medium']?>" alt="<?=$name?> image">
											</div>

											<div class="info mt24">
												<h4> <?=$name?> </h4>
												<object><a href="#" class="textLink gold kandidaten-readmore"> Read more <arrow>➝</arrow> </a></object>

												<div class="kand-socials" style="display: none">
													<div class="socials">
														<?php if ( $fb ) { ?>
									                        <a target="_blank" href="<?=$fb?>">
									                            <img src="/wp-content/uploads/2021/01/Facebook.svg" alt="fb icon" data-src="/wp-content/uploads/2021/01/Facebook.svg">
									                        </a>
								                        <?php } ?>
								                        <?php if ( $youtube ) { ?>
									                        <a target="_blank" href="<?=$youtube?>">
									                            <img src="/wp-content/uploads/2021/01/Youtube-color-1.svg" alt="yt icon" data-src="/wp-content/uploads/2021/01/Youtube-color-1.svg">
									                        </a>
								                        <?php } ?>
								                        <?php if ( $twitter ) { ?>
									                        <a target="_blank" href="<?=$twitter?>">
									                           <img src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg" alt="twitter icon" data-src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg" class="lazyloaded">
									                        </a>
								                        <?php } ?>
								                        <?php if ( $linkedin ) { ?>
									                        <a target="_blank" href="<?=$linkedin?>">
									                            <img src="/wp-content/uploads/2021/01/linkedin.svg" alt="linkedin icon" data-src="/wp-content/uploads/2021/01/linkedin.svg" >
									                        </a>
								                    	<?php } ?>
								                        <?php if ( $website ) { ?>
									                        <a target="_blank" href="<?=$website?>">
									                            <img src="/wp-content/uploads/2021/01/globe.svg" alt="website icon" data-src="/wp-content/uploads/2021/01/linkedin.svg" >
									                        </a>
								                        <?php } ?>
								                    </div>
												</div>
												<div class="kand-description" style="display: none">
													<?=$description?>
												</div>
											</div>

										</div>

									<?php endwhile; ?>

								<?php endwhile; ?>

							</div>

						
					<?php endwhile; ?>
				</div>


			</div>


		</div>
	</section>


	<div class="kandidate-popup">

		<div class="kandidaten-box">

			<button class="close-kand-pop"> <img src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg" alt="close icon"> </button>

			<div class="kandidaten-box-content">
				<div class="image">
					<img class="nolazy" alt="Person image placeholder">
				</div>

				<div class="cnt">
					<h2 class="mb16">Naam Placeholder</h2>
					
					<div class="kand-socials">
                        
                    </div>

                    <div class="kand-description">
                    </div>
					
				</div>

			</div>


		</div>

	</div>


<?php endif; ?>



<!-- SPONSORS  / PARTNERS SLIDER -->
<!-- SPONSORS  / PARTNERS SLIDER -->
<!-- SPONSORS  / PARTNERS SLIDER -->

<?php if( have_rows('partners') ): ?>

<section class="sponsors-slider-wrapper" data-animation="fadeInTop">

	<div class="container">

		<div class="sponsor-content">
			
			<p>
			 	Loading content...
			</p>

		</div>


		<div class="sponsors-slider">
			 <div class="swiper-container-initialized swiper-container-horizontal sponsors-carousel">
			 	<div class="swiper-wrapper">
				 	<?php $x=0; while( have_rows('partners') ): the_row(); 
				        $logo = get_sub_field('logo')['sizes']['thumbnail'];
				        $description = get_sub_field('content');
				    ?>
			
					   
				      	<div class="swiper-slide <?php if  ($x ==0) {echo 'currentSponsor';} ?>">
				      		<div class="logo">
				      			<img src="<?=$logo?>" alt="partner logo">
				      		</div>
				      		<div class="content" style="display: none">
								<?=$description?>
				      		</div>
				      	</div>
					   

				    <?php $x++; endwhile; ?>	
			   </div>
			</div>

		</div>

	</div>

</section>

<?php endif; ?>

<!-- PROGRAMMA / JURY TABS -->
<!-- PROGRAMMA / JURY TABS -->
<!-- PROGRAMMA / JURY TABS -->

<?php if( have_rows('een_tabs') ): ?>
	<div class="bgWhite" style="padding: 16px;" data-animation="fadeInDown">
		<div class="event-program" style="margin:0">
		    <div class="container">
		        <h2 class="title">
		            <?=get_field('een_title')?>
		        </h2>

		        <p class="description">
		           	<?=get_field('een_description')?>
		        </p>

		        <div class="programs werk-tabs">
		            <div class="tabs">
		                <ul>
							<?php $i=0; while( have_rows('een_tabs') ): the_row(); 
						        $tabName = get_sub_field('tab_name');    
						        $tabSlug =  preg_replace('/\s+/', '', $tabName);
						    ?>
						        <li class="<?php if ( $i == 0 ) {echo 'active';} ?>" for="#<?=$tabSlug?>"> <?=$tabName?> </li>
						    <?php $i++; endwhile; ?>
		                </ul>
		            </div>

		    		<?php $i=0; while( have_rows('een_tabs') ): the_row(); 
				        $tabName = get_sub_field('tab_name');
				        $tabSlug =  preg_replace('/\s+/', '', $tabName);
				        $tabContent = get_sub_field('tab_content');
				    ?>
				    	<div class="tab-content <?php if ( $i == 0 ) {echo 'visible';} ?>" id="<?=$tabSlug?>">
			             	<?=$tabContent?>
			            </div>
				    <?php $i++; endwhile; ?>

		        </div>
		    </div>
		</div>
	</div>


<?php endif; ?>


<!--  TESTIMONIALS -->
<!--  TESTIMONIALS -->
<!--  TESTIMONIALS -->

<?php if( have_rows('testiomonials') ): ?>


	<div class="event-testimonials">
	    <div class="container">
	        <h3 class="title" data-animation="fadeInTop"> Testimonials </h3>

	        <div class="controls noselect adelay500y" data-animation="fadeInDown">
	            <div class="wsp"><img src="/wp-content/uploads/2021/01/arrow-right.png"></div>
	            <div class="wsn"><img src="/wp-content/uploads/2021/01/arrow-right.png"></div>
	        </div>

	        <div class="testimonials">
	            <div class="swiper-wrapper" style="color: #fff;">
	                <?php $u=0; while( have_rows('testiomonials') ): the_row(); 
	                		$image = get_sub_field('author_image');
					        $author_name = get_sub_field('author_name');    
					        $author_position = get_sub_field('author_position');
					        $testimonial = get_sub_field('testiomonial');
					        $u+=100;
					    ?>
	                    <div class="swiper-slide adelay<?=$u?>" data-animation="fadeInTop">
	                        <div class="testimonial">
	                            <div class="top">
	                               	<?=$testimonial?>
	                            </div>

	                            <div class="bottom">
	                                <div class="left">
	                                    <img src="<?=$image['sizes']['thumbnail']?>">
	                                </div>

	                                <div class="right middle">
	                                    <div>
	                                        <h4> <?=$author_name?> </h4>
	                                        <p>  <?=$author_position?> </p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                <?php endwhile; ?>
	            </div>
	        </div>
	    </div>
	</div>


<?php endif; ?>



<!-- MAGAZINE -->
<!-- MAGAZINE -->
<!-- MAGAZINE -->

<?php if( get_field('magazine_category') ) : ?>




	<?php

		$catID = get_field('magazine_category');
		
		$magazine_posts = new WP_Query( array( 
			'post_type' => 'post',				
	        'post_type' 		=> 'post',
	        'posts_per_page' 	=> 3,
	       	'cat' => $catID
	    ));

		$catName = get_cat_name( $catID );
	?>

	<section class="event-magazine bgWhite">
		<div class="container">

			<h2 class="mb80" data-animation="fadeInTop"> Magazine </h2>

			<div class="hp-organisations-grid posts-grid" data-animation="fadeInDown">


				<?php $t=0; while ($magazine_posts->have_posts()) : $magazine_posts->the_post(); $t+=100; ?>
			

					<a 	href="<?php the_permalink()?>" class="org-grid-item post-item adelay<?=$t?>" 
						style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.04), 0px 0px 2px rgba(0, 0, 0, 0.06), 0px 0px 1px rgba(0, 0, 0, 0.04);"
						data-animation="fadeInTop"
						>
						<div class="top bg-orangeOpacity">
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); 
							if ($url) { ?>
								<img src="<?php echo $url ?>" alt="<?php the_title()?>" alt="<?php the_title()?> background">
							<?php } ?>
							<object> <a href="#"> <?=$catName;?> </a> </object>
						</div>
						<div class="bottom">
							<div class="date-tags"> 
								<date>  <?php echo get_the_date( 'M d,  Y' ); ?> </date>
							</div>
							<h4 class="mt16"> <?php the_title()?> </h4>
							<?php
								$search_text = get_the_excerpt();
								$tags = array("<p>", "</p>");
								$search_content = str_replace($tags, "", $search_text);
							?>
							<p class="limitRows3 mt8"> <?=$search_text;?> </p>
						</div>
					</a>


				<?php endwhile ; wp_reset_postdata() ; ?>
			
			</div>

		</div>

	</section>

<?php endif; ?>




<!-- BESTEL CARDS -->
<!-- BESTEL CARDS -->
<!-- BESTEL CARDS -->

<div class="bgWhite" style="padding: 16px">
	<section class="bestel-karten" style="margin:0" data-animation="fadeInDown">
		<img src="<?=get_field('karteen_background_image')['url']?>" alt="Bestel bg">
		<div class="container">
			<h2 class="mb24 adelay200" data-animation="fadeInTop"> <?=get_field('karteen_title')?> </h2>
			<a href="#" class="textLink orange adelay400" data-animation="fadeInTop"> <?=get_field('karteen_title')?> <arrow>➝</arrow> </a>
		</div>
	</section>
</div>


<div class="bgWhite">
	<?php get_footer(); ?>
</div>






<!--  TICKETS  -->
<!--  TICKETS  -->
<!--  TICKETS  -->

<section class="event-signup-form" event-id="<?=get_the_id()?>" style="display: none;">
		
	<div class="container">

		<div class="event-signup-form-box incl-form-box corner-triangle ct-topRight ct-red ct-big shadow-for-box">

			<div class="left">
				<h4 class="mb32"> Tickets reservation </h4>

				<div class="reserve-fields-wrapper form-styles">

					<div id="tickets-list">
						<div class="reserve-fields-user" id="ticket-1">

							<h5 class="mb32"> Ticket #<ticketNumber>1</ticketNumber> </h5>

							<div class="input" value="Ticket-Type">
								<label> Ticket Type </label>
								<select class="ticketPrices inputValue">  
									<?php if( have_rows('ticket') ): ?>
									    <?php while( have_rows('ticket') ): the_row(); ?>
									        <option value="<?php the_sub_field('ticket_price'); ?>"> <?php the_sub_field('ticket_name'); ?> </option>
									    <?php endwhile; ?>
									<?php endif; ?>
								</select>
							</div>
							

							<?php $requiredFields =   get_field('attendie_info_needed'); ?>

							<?php if( in_array( "Voornaam" , $requiredFields ) ) { ?>
							   	<div class="input" value="Voornaam">
									<label> Voornaam </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							
							<?php if( in_array( "Achternaam" , $requiredFields ) ) { ?>
								<div class="input" value="Achternaam">
									<label> Achternaam </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "Email" , $requiredFields ) ) { ?>
								<div class="input" value="Email">
									<label> Email </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "Telefoonnummer" , $requiredFields ) ) { ?>
								<div class="input" value="Telefoonnummer">
									<label> Telefoonnummer </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "Opleidingsniveau" , $requiredFields ) ) { ?>
								<div class="input" value="Opleidingsniveau">
									<label> Opleidingsniveau </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "Opleiding" , $requiredFields ) ) { ?>
								<div class="input" value="Opleiding">
									<label> Opleiding </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "Functie" , $requiredFields ) ) { ?>
								<div class="input" value="Functie">
									<label> Functie </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "Bedrijf" , $requiredFields ) ) { ?>
								<div class="input" value="Bedrijf">
									<label> Bedrijf </label>
									<input class="inputValue" type="text" placeholder="">
								</div>
							<?php } ?>

							<?php if( in_array( "CV" , $requiredFields ) ) { ?>
								<div class="input" value="CV">
									<label> CV </label>
									<div class="fileupload">
										<input class="inputValue" type="file">
									</div>
								</div>
							<?php } ?>

						</div>

					</div>

					<div class="cta-button">
						<button class="button-1 add-ticket">
		                    <span> Add New Ticket </span>
		                    <div></div>
		                </button>
					</div>

				</div>

			</div>

			<div class="tickets-rec">

				<h4 class="mb32"> Summary </h4>

				<ul>
					<li> Tickets amount: <span id="tickets-amount"> 1 </span> </li>
				</ul>
				<p id="totalprice"> Total price: <span> 0 EUR </span> </p>

				<div class="cta-button">
					<a href="#" class="button-1" id="checkout-tickets">
	                    <span> Checkout </span>
	                    <div></div>
	                </a>
				</div>

			</div>	


		</div>

	</div>

</section>


<div class="reserve-fields-user" id="blank-ticket-example">

	<h5 class="mb32"> Ticket #<ticketNumber>1</ticketNumber> </h5>

	<button class="button-1 white remove-ticket"> <span> Remove </span> <div></div></button>

	<div class="input" value="Ticket-Type">
		<label> Ticket Type </label>
		<select class="ticketPrices inputValue" > 
			<?php if( have_rows('ticket') ): ?>
			    <?php while( have_rows('ticket') ): the_row(); ?>
			        <option value="<?php the_sub_field('ticket_price'); ?>"> <?php the_sub_field('ticket_name'); ?> </option>
			    <?php endwhile; ?>
			<?php endif; ?>
		</select>
	</div>
	

	<?php $requiredFields =   get_field('attendie_info_needed'); ?>

	<?php if( in_array( "Voornaam" , $requiredFields ) ) { ?>
	   	<div class="input" value="Voornaam">
			<label> Voornaam </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	
	<?php if( in_array( "Achternaam" , $requiredFields ) ) { ?>
		<div class="input" value="Achternaam">
			<label> Achternaam </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "Email" , $requiredFields ) ) { ?>
		<div class="input email" value="Email">
			<label> Email </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "Telefoonnummer" , $requiredFields ) ) { ?>
		<div class="input" value="Telefoonnummer">
			<label> Telefoonnummer </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "Opleidingsniveau" , $requiredFields ) ) { ?>
		<div class="input" value="Opleidingsniveau">
			<label> Opleidingsniveau </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "Opleiding" , $requiredFields ) ) { ?>
		<div class="input" value="Opleiding"> 
			<label> Opleiding </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "Functie" , $requiredFields ) ) { ?>
		<div class="input" value="Functie">
			<label> Functie </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "Bedrijf" , $requiredFields ) ) { ?>
		<div class="input" value="Bedrijf">
			<label> Bedrijf </label>
			<input class="inputValue" type="text" placeholder="">
		</div>
	<?php } ?>

	<?php if( in_array( "CV" , $requiredFields ) ) { ?>
		<div class="input" value="CV">
			<label> CV </label>
			<div class="fileupload">
				<input class="inputValue" type="file">
			</div>
		</div>
	<?php } ?>

</div>
