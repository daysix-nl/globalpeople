<div class=" shadow-for-box customAddedForm">

	<div class="customform-wrapper">

		<div class="form-styles opacity0 adelay300" data-animation="fadeInTop">

			<?php echo do_shortcode(get_field('shortcode')) ?>

		</div>

	</div>

	<div class="thank-you-succes-form">
        <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
        <h3 class="mt16"> <?=get_field('thank_you_title')?>   </h3>
        <p class="silver mt8"> <?=get_field('thank_you_description')?> </p> 
    </div>

</div>


<style type="text/css">
	.customAddedForm br {display: none!important}

	.customAddedForm {
		padding: 60px 40px;
		margin:42px 0;
	}

	.customAddedForm h5 {margin-bottom: 32px;}

	.customAddedForm .wpcf7-radio span.wpcf7-list-item {
		display: flex;
		margin-left: 0;
	}

	.customAddedForm .wpcf7-radio span.wpcf7-list-item input {
		width: 14px;
    	margin-right: 10px;
    	position: relative;
    	top: 1px;
	}
	body .customAddedForm .wpcf7-not-valid-tip {bottom: -20px}
	.customAddedForm .wpcf7-form-control-wrap {display: block;}


	@media (max-width: 480px) { 
		.customAddedForm {padding: 30px 15px;}

	}


</style>