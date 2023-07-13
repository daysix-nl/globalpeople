<?php 

	// Template Name: PAGE: Default Content
	get_header();

?>


<div class="style-content-wrapper">
	<div class="container">
		<h1 class="title"> <?php the_title() ?> </h1>
		<div class="style-content">
			<?php
                wp_reset_query(); // necessary to reset query
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile; // End of the loop.
            ?>

		</div>
	</div>
</div>



<?php get_footer(); ?>
