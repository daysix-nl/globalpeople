<div class="newsletter-box incl-form-box corner-triangle ct-topLeft ct-red ct-big shadow-for-box">

	<div class="newsletter-wrapper">
		<h2 data-animation="fadeInTop"> <?=get_field('newsletter_title', 6) ?> </h2>
		<p class="mt16 mb40 silver adelay200" data-animation="fadeInTop"> <?=get_field('newsletter_subtitle', 6) ?>  </p>

		<div class="form-styles opacity0 adelay300" data-animation="fadeInTop">

			<?php //echo do_shortcode('[contact-form-7 id="339" title="Newsletter - (MC Connected)"]') ?>
			<?php echo do_shortcode('[contact-form-7 id="3751" title="Newsletter New - (MC Connected)"]') ?>

			<p class="terms"> <?=get_field('newsletter_terms', 6)?> </p>

		</div>

	</div>

	<div class="thank-you-succes-form">
        <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
        <h3 class="mt16">  <?=get_field('newsletter_thank_you_title', 6)?>  </h3>
        <p class="silver mt8">  <?=get_field('newsletter_thank_you_subtitle', 6)?> </p> 
    </div>

</div>


<style type="text/css">
	.form-styles br {display: none}
</style>