<?php
// Template Name: PAGE: Vacancies Alert Form
get_header();
?>

  <div class="contact-header alert-header" style="padding-bottom: 273px;">
    <img class="shape" src="/wp-content/uploads/2021/01/Shape.svg" alt="shape bg decoration">
    <div class="container" style="justify-content: flex-start;">
      <div class="left" style="margin-right: 50px;">
        <h2 style="width: 354px"> <?= get_field('title') ?> </h2>
        <div class="contact" style="border-top: none">
          <div>
            <img src="/wp-content/uploads/2021/01/email-1.png">
            <a href="mailto:<?= get_field('email') ?>"><?= get_field('email') ?></a>
          </div>

          <div>
            <img src="/wp-content/uploads/2021/01/phone-1.png">
            <a href="tel:<?= get_field('phone') ?>"><?= get_field('phone') ?></a>
          </div>
        </div>
      </div>

      <div class="right" style="margin-top: 118px; max-width: 355px;">
        <p class="silver"> <?= get_field('description') ?> </p>
      </div>
    </div>
  </div>

  <section class="alertform">
    <div class="container">
      <div class="alertform-box incl-form-box corner-triangle ct-topRight ct-red ct-big shadow-for-box">
        <h2 class="mb32"> <?= get_field('form_title') ?> </h2>

        <div class="form-styles form-styles-2">
          <div class="input">
            <?= do_shortcode('[cx_open_application openformid="2"]') ?>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php if (isset($_GET['success'])) { ?>
  <script type="text/javascript">
    document.getElementById('personal-cv_change').click();
  </script>

  <div class="payment-successfull">
    <div class="payment-successfull-box shadow-for-box">
      <button class="close-pay-success"><img src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg"
                                             alt="close icon"></button>

      <div class="thank-you-succes-form" style="display: block!important">
        <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
        <h3 class="mt16"> <?= get_field('success_title') ?> </h3>
        <p class="silver mt8"> <?= get_field('success_description') ?> </p>
      </div>
    </div>
  </div>
<?php } ?>
<?php get_footer(); ?>