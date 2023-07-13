<?php 

    // Template Name: PAGE: Contact
    get_header(); 

?>

<div class="contact-header" style="margin-bottom: 173px;">
    <img class="shape" src="/wp-content/uploads/2021/01/Shape.svg" alt="shape bg decoration">
    <div class="container">

        <div class="left">

            <h2 class="" data-animation="fadeInTop"> <?=get_field('title')?> </h2>
            <p class=" adelay200" data-animation="fadeInTop">  <?=get_field('subtitle')?> </p>

            <div class="contact  adelay300" data-animation="fadeInTop">
                <div class=" adelay300" data-animation="fadeInTop">
                    <img src="/wp-content/uploads/2021/01/location.png">
                     <?=get_field('address')?>
                </div>

                <div class=" adelay400" data-animation="fadeInTop">
                    <img src="/wp-content/uploads/2021/01/email-1.png">
                    <a href="mailto:<?=get_field('email')?>"> <?=get_field('email')?></a>
                </div>

                <div class=" adelay500" data-animation="fadeInTop">
                    <img src="/wp-content/uploads/2021/01/phone-1.png">
                    <a href="tel:<?=get_field('phone')?>"> <?=get_field('phone')?></a>
                </div>
            </div>
        </div>

        <div class="right contactForm  adelay300" data-animation="fadeInDown">

            <div class="incl-form-box corner-triangle ct-topRight ct-red ct-big shadow-for-box">

                <div class="contact-wrapper">
                    <h2>  <?=get_field('c_title')?> </h2>
                    <p> </p>

                    <div class="form-styles">
                        <?php echo do_shortcode('[contact-form-7 id="338" title="Contact form"]') ?>
                    </div>

                </div>

                <div class="thank-you-succes-form">
                    <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
                    <h3 class="mt16">  <?=get_field('thank_you_title')?>  </h3>
                    <p class="silver mt8">  <?=get_field('thank_you_subtitle')?> </p> 
                </div>

            </div>

        </div>

    </div>
</div>

<?php get_footer(); ?>