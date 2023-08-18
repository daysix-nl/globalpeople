<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GlobalPeople
 */

  if ($_POST['pay'] ?? false) {
    include 'event/pay/app.php';
    exit;
  }

  if (($_GET['webhook'] ?? false) && ($_POST['id'] ?? false)) {
    include 'event/webhook/app.php';
    exit;
  }

  $procedure = Entity_Form_EmployeeApply::get_system_select_options('Procedure');
  $function = Entity_Form_EmployeeApply::get_system_select_options('Function0');
  $functieniveau = Entity_Form_EmployeeApply::get_system_select_options('Functieniveau');
  $country = Entity_Form_EmployeeApply::get_system_select_options('Country');
  $education = Entity_Form_EmployeeApply::get_system_select_options('Education0');

  if ($_GET['test'] ?? false) {
    print_r($procedure);
    exit;
  }

  //  EVENTS SINGLE TEMPLATE
  get_header(null, ['header_class' => 'h_transparent']);
?>

<!-- count remaining tickets -->
<?php
$ticketsAvailable = 0;
if (have_rows('ticket')): ?>
  <?php while (have_rows('ticket')): the_row(); ?>
    <?php if (get_sub_field('tickets_available') > 0) { ?>
      <?php $ticketsAvailable++;
    } ?>
  <?php endwhile; ?>
<?php endif; ?>


<!-- success buy tickets -->
<?php if (isset($_GET['success'])) { ?>

  <div class="payment-successfull">
    <div class="payment-successfull-box shadow-for-box">

      <button class="close-pay-success"><img src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg"
                                             alt="close icon"></button>

      <div class="thank-you-succes-form" style="display: block!important">
        <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
        <h3 class="mt16"> Gelukt! </h3>
        <p class="silver mt8"> Bedankt! Je inschrijving is gelukt. Je ontvangt van ons binnenkort een email met alle
          informatie. </p>
      </div>

    </div>
  </div>

<?php } ?>


<section class="events-single-header">
  <div class="video-background">
    <?php if (get_field('video_background')) { ?>
      <video class="lazyvideo" data-src="<?= get_field('video_background') ?>" type="video/mp4" autoplay loop muted
             playsinline></video>
    <?php } else { ?>
      <img src="<?= get_field('background_image_if_no_video') ?>" alt="Event background image">
    <?php } ?>
  </div>

  <div class="container">

    <div>
      <h4 data-animation="fadeInTop"> <?= get_field('small_heading_over_title') ?> </h4>
      <h2 class="mt8 mb8 adelay200" data-animation="fadeInTop"> <?php the_title() ?> </h2>
      <p class="silver mb24 adelay400" style="color:#e5e5e5" data-animation="fadeInTop"> <?= get_the_excerpt() ?></p>

      <div class="event-cts adelay500" data-animation="fadeInTop">

        <?php if ($ticketsAvailable > 0) { ?>

          <?php if (!get_field('hide_tickets_button')) { ?>
            <a href="" class="golden-button" id="buyTickets" style="background:<?= get_field('event_color') ?>">
              <?php if (get_field('tickets_button_label')) { ?>
                <span> <?= get_field('tickets_button_label') ?> </span>
              <?php } else { ?>
                <span> Bestel je kaarten </span>
              <?php } ?>
            </a>
          <?php } ?>


        <?php } else { ?>
          <a href="" class="golden-button" style="pointer-events: none; background: var(--red)"> <span> Helaas zijn er geen plaatsen meer vrij. </span>
          </a>
        <?php } ?>


        <?php if (get_field('stem_nu_button')) { ?>
          <a href="<?= get_field('stem_nu_button')['url'] ?>" target="_blank" class="white-gold-button"
             style="color:<?= get_field('event_color') ?>"> <span> <?= get_field('stem_nu_button')['title'] ?> </span>
          </a>
        <?php } ?>

      </div>
    </div>
  </div>

</section>


<!-- FLOATING BASIC INFO AND LOGO -->
<!-- FLOATING BASIC INFO AND LOGO -->
<!-- FLOATING BASIC INFO AND LOGO -->
<?php if (have_rows('info_list')): ?>
  <section class="event-basic-info adelay200" data-animation="fadeInDown">
    <div class="container">

      <div class="box shadow-for-box">


        <div class="logo">
          <img src="<?= get_field('event_logo')['url'] ?>" alt="<?php the_title() ?> Logo">
        </div>

        <ul>

          <?php while (have_rows('info_list')): the_row();
            $title = get_sub_field('title');
            $value = get_sub_field('value');
            ?>
            <li><span> <?= $title ?> </span> <?= $value ?> </li>
          <?php endwhile; ?>

        </ul>

      </div>

    </div>
  </section>
<?php endif; ?>

<!-- KANDIDATEN  -->
<!-- KANDIDATEN  -->
<!-- KANDIDATEN  -->

<?php if (have_rows('kandidaten')): ?>


  <section class="ons-team ons-team-event">
    <div class="container">
      <div class="cnt">
        <h2> <?= get_field('kand_title') ?> </h2>
        <p class="silver mt8">
          <?= get_field('kand_desc') ?>
        </p>
      </div>


      <?php $kandidatenCount = count(get_field('kandidaten')); ?>

      <div class="team-tabs" data-animation="fadeInTop">

        <?php if ($kandidatenCount > 1) { ?>
          <div class="tabs-list">
            <ul>

              <?php $i = 0;
              while (have_rows('kandidaten')): the_row();
                $tabName = get_sub_field('kand_category_tab_name');
                $tabSlug = preg_replace('/\s+/', '', $tabName);
                ?>
                <li class="<?php if ($i == 0) {
                  echo 'active';
                } ?>" id="<?= $tabSlug ?>"> <?= $tabName ?> </li>
                <?php $i++; endwhile; ?>

            </ul>
          </div>
        <?php } ?>

        <div class="team-grids">


          <?php while (have_rows('kandidaten')): the_row();
            $tabName = get_sub_field('kand_category_tab_name');
            $tabSlug = preg_replace('/\s+/', '', $tabName);
            ?>


            <div class="team-grid" id="<?= 'tab-content-' . $tabSlug ?>">

              <?php while (have_rows('kandidaten_subcategory')): the_row(); ?>
                <?php if (get_sub_field('subcategory_name')) { ?>
                  <div class="kand_subcategory_title" style="   ">
                    <h3> <?= get_sub_field('subcategory_name') ?> </h3>
                  </div>
                <?php } ?>


                <?php $p = 0;
                while (have_rows('kandidatens')): the_row();
                  $candidate_name_field = get_sub_field('candidate_name_field');
                  $name = get_sub_field('name');
                  $catNameField = get_sub_field('category_name_field');
                  $catName = get_sub_field('category_name');
                  $votes = get_sub_field('votes');
                  $votesNumber = get_sub_field('number_of_votes');
                  $hashName = "candidate-modal-" . str_replace(' ', '', $name);
                  $description = get_sub_field('description');
                  $image = get_sub_field('image');
                  $video = get_sub_field('video');
                  $voteBtnText = get_sub_field('vote_button_text');
                  $voteBtnURL = get_sub_field('vote_button_url');
                  $videoThumbnail = get_sub_field('video_thumbnail');
                  $videoIframe = get_sub_field('video_iframe');
                  $videoUpload = get_sub_field('video_upload');

                  $fb = get_sub_field('facebook');
                  $linkedin = get_sub_field('linkedin');
                  $twitter = get_sub_field('twitter');
                  $youtube = get_sub_field('youtube');
                  $website = get_sub_field('website');
                  $p += 100;

                  ?>

                  <div href="#" class="team-item adelay<?= $p ?>" data-animation="fadeInTop" data-candidate-item="<?= str_replace(' ', '', $name); ?>">

                    <div class="thumbnail">
                      <img src="<?= $image['sizes']['medium'] ?>" data-src="<?= $image['sizes']['medium'] ?>" alt="<?= $name ?> image">
                      <span><span class="thumbnail-votes"></span> stemmen</span>
                    </div>

                    <div class="info mt24" style="text-align: center;">
                      <h4> <?= $name ?> </h4>
                      <?php if ($voteBtnText && $voteBtnURL) { ?>
													<div class="button-vote" style="margin-bottom: 16px;">
														<a class="button-1 mt0" href="<?= $voteBtnURL ?>">
                        								<span><?= $voteBtnText ?></span>
                        								<div></div>
                    								</a>
													</div>
												<?php } ?>
                      <a href="#<?= $hashName; ?>" class="textLink gold kandidaten-readmore"
                         data-category="<?= $tabSlug ?>"> Lees meer
                        <arrow>➝</arrow>
                      </a>

                      <div class="voting-details" style="display: none">
                        <h2> <?= $candidate_name_field ?> </h2>
                        <p class="cat-name-field"><?= $catNameField ?></p>
                        <p class="cat-name"><?= $catName ?></p>
                        <p class="votes"><?= $votes ?></p>
													<p class="votes-number" data-candidate="<?= str_replace(' ', '', $name); ?>"></p>
                        <?php if ($video) { ?>
                          <div class="video-regular">
                            <video width="730" controls>
                              <source src="<?= $video['url'] ?>" type="video/mp4">
                            </video>
                          </div>
                        <?php } ?>

                        <?php if ($videoIframe) { ?>
                          <div class="video169">
                            <div class="thumbnail">
                              <img class="thumb" src="<?= $videoThumbnail['sizes']['medium_large'] ?>"
                                   alt="video thumbnail">
                              <button class="playVideo">
                                <img src="/wp-content/uploads/2021/01/play-icon-red.svg" alt="play icon">
                              </button>
                            </div>
                            <div class="video">
                              <?php if ($videoIframe) { ?>
                                <iframe class="videoSrc"
                                        data-src="<?= $videoIframe ?>" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                              <?php } ?>
                            </div>
                          </div>
                        <?php } ?>
                        <?php if ($voteBtnText && $voteBtnURL) { ?>
													<div class="button-vote">
														<a class="button-1 mt0" href="<?= $voteBtnURL ?>">
                        								<span><?= $voteBtnText ?></span>
                        								<div></div>
                    								</a>
													</div>
													<?php } ?>
                      </div>

                      <div class="kand-socials" style="display: none">
                        <div class="socials">
                          <?php if ($fb) { ?>
                            <a target="_blank" href="<?= $fb ?>">
                              <img src="/wp-content/uploads/2021/01/Facebook.svg" alt="fb icon"
                                   data-src="/wp-content/uploads/2021/01/Facebook.svg">
                            </a>
                          <?php } ?>
                          <?php if ($youtube) { ?>
                            <a target="_blank" href="<?= $youtube ?>">
                              <img src="/wp-content/uploads/2021/01/Youtube-color-1.svg" alt="yt icon"
                                   data-src="/wp-content/uploads/2021/01/Youtube-color-1.svg">
                            </a>
                          <?php } ?>
                          <?php if ($twitter) { ?>
                            <a target="_blank" href="<?= $twitter ?>">
                              <img src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg"
                                   alt="twitter icon"
                                   data-src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg"
                                   class="lazyloaded">
                            </a>
                          <?php } ?>
                          <?php if ($linkedin) { ?>
                            <a target="_blank" href="<?= $linkedin ?>">
                              <img src="/wp-content/uploads/2021/01/linkedin.svg" alt="linkedin icon"
                                   data-src="/wp-content/uploads/2021/01/linkedin.svg">
                            </a>
                          <?php } ?>
                          <?php if ($website) { ?>
                            <a target="_blank" href="<?= $website ?>">
                              <img src="/wp-content/uploads/2021/01/globe.svg" alt="website icon"
                                   data-src="/wp-content/uploads/2021/01/linkedin.svg">
                            </a>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="kand-description" style="display: none">
                        <?= $description ?>
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

      <button class="close-kand-pop"><img src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg" alt="close icon">
      </button>

      <div class="kandidaten-box-content corner-triangle ct-topLeft ct-red ct-big">
        <div class="flex">
          <div class="image">
            <img class="nolazy" alt="Person image placeholder">
          </div>

          <div class="cnt">
            <h4 class="small-red"></h4>
            <h2 class="mb16">Naam Placeholder</h2>
            <h4 class="small-red cat"></h4>
            <h2 class="cat-name mb16"></h2>
            <h4 class="small-red votes"></h4>
            <h2 class="votes-number mb16"></h2>
            <div class="vote-button"></div>
            <div class="kand-socials">

            </div>


          </div>
        </div>

        <div class="kand-description"></div>
        <div class="video169"></div>
        <div class="video-regular"></div>

      </div>


    </div>

  </div>


<?php endif; ?>


<!-- Diversiteit FEATURES GRID -->
<!-- Diversiteit FEATURES GRID -->
<!-- Diversiteit FEATURES GRID -->
<?php if (have_rows('div_items')): ?>
  <section class="met-features met-features-event bgWhite">
    <!-- <section class="met-features met-features-event bgWhite" style="background: #FAFAFB;"> -->

    <div class="container">
      <div class="cnt">
        <h2 class="mb24" data-animation="fadeInTop"> <?= get_field('div_title') ?> </h2>
        <?php if (get_field('div_link')) { ?>
          <a target="<?= get_field('div_link')['target'] ?>" href="<?= get_field('div_link')['url'] ?>"
             class="textLink gold adelay200" data-animation="fadeInTop">
            <?= get_field('div_link')['title'] ?>
            <arrow>➝</arrow>
          </a>
        <?php } ?>
      </div>

      <div class="met-features-grid">


        <?php $o = 100;
        while (have_rows('div_items')): the_row();
          $icon = get_sub_field('icon');
          $title = get_sub_field('title');
          $desc = get_sub_field('description');
          ?>
          <div class="met-feature adelay<?= $o ?>" data-animation="fadeInTop">
            <div class="icon">
              <img src="<?= $icon ?>" alt="<?= $title ?> icon">
            </div>
            <div class="text">
              <h4 class="mb8"> <?= $title ?>  </h4>
              <p> <?= $desc ?> </p>
            </div>
          </div>
          <?php $o += 100; endwhile; ?>


      </div>

    </div>

  </section>
<?php endif; ?>


<!-- SPONSORS  / PARTNERS SLIDER -->
<!-- SPONSORS  / PARTNERS SLIDER -->
<!-- SPONSORS  / PARTNERS SLIDER -->

<?php if (have_rows('partners')): ?>


  <section class="sponsors-slider-intro">

    <div class="container">
      <div class="cnt">
        <?= get_field('partners_intro') ?>
      </div>
    </div>

  </section>

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
            <?php $x = 0;
            while (have_rows('partners')): the_row();
              $logo = get_sub_field('logo')['sizes']['thumbnail'];
              $description = get_sub_field('content');
              ?>


              <div class="swiper-slide <?php if ($x == 0) {
                echo 'currentSponsor';
              } ?>">
                <div class="logo">
                  <img src="<?= $logo ?>" alt="partner logo">
                </div>
                <div class="content" style="display: none">
                  <?= $description ?>
                </div>
              </div>


              <?php $x++; endwhile; ?>
          </div>
        </div>

      </div>

    </div>

    <div class="sponsors-carousel-arrows">
      <i class="fas fa-chevron-left"></i>
      <i class="fas fa-chevron-right"></i>
    </div>


  </section>

<?php endif; ?>

<!-- PROGRAMMA / JURY TABS -->
<!-- PROGRAMMA / JURY TABS -->
<!-- PROGRAMMA / JURY TABS -->

<?php if (have_rows('een_tabs')): ?>
  <div class="bgWhite" style="padding: 16px;" data-animation="fadeInDown">
    <div class="event-program" style="margin:0">
      <div class="container">
        <h2 class="title">
          <?= get_field('een_title') ?>
        </h2>

        <p class="description">
          <?= get_field('een_description') ?>
        </p>

        <div class="programs werk-tabs">
          <div class="tabs">
            <ul>
              <?php $i = 0;
              while (have_rows('een_tabs')): the_row();
                $tabName = get_sub_field('tab_name');
                $tabSlug = preg_replace('/\s+/', '', $tabName);
                ?>
                <li class="<?php if ($i == 0) {
                  echo 'active';
                } ?>" for="#<?= $i ?>"> <?= $tabName ?> </li>
                <?php $i++; endwhile; ?>
            </ul>
          </div>

          <?php $i = 0;
          while (have_rows('een_tabs')): the_row();
            $tabName = get_sub_field('tab_name');
            $tabSlug = preg_replace('/\s+/', '', $tabName);
            $tabContent = get_sub_field('tab_content');
            ?>
            <div class="tab-content <?php if ($i == 0) {
              echo 'visible';
            } ?>" id="<?= $i ?>">
              <?= $tabContent ?>
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

<?php if (have_rows('testiomonials')): ?>


  <div class="event-testimonials">
    <div class="container">
      <h3 class="title" data-animation="fadeInTop"> Testimonials </h3>

      <div class="controls noselect adelay500y" data-animation="fadeInDown">
        <div class="wsp"><img src="/wp-content/uploads/2021/01/arrow-right.png"></div>
        <div class="wsn"><img src="/wp-content/uploads/2021/01/arrow-right.png"></div>
      </div>

      <div class="testimonials">
        <div class="swiper-wrapper" style="color: #fff;">
          <?php $u = 0;
          while (have_rows('testiomonials')): the_row();
            $image = get_sub_field('author_image');
            $author_name = get_sub_field('author_name');
            $author_position = get_sub_field('author_position');
            $testimonial = get_sub_field('testiomonial');
            $u += 100;
            ?>
            <div class="swiper-slide adelay<?= $u ?>" data-animation="fadeInTop">
              <div class="testimonial">
                <div class="top">
                  <?= $testimonial ?>
                </div>

                <div class="bottom">
                  <div class="left">
                    <img src="<?= $image['sizes']['thumbnail'] ?>">
                  </div>

                  <div class="right middle">
                    <div>
                      <h4> <?= $author_name ?> </h4>
                      <p>  <?= $author_position ?> </p>
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

<?php if (get_field('mag_category')) : ?>


  <?php

  $catID = get_field('mag_category');


  $magazine_posts = new WP_Query(array(
    'post_type' => 'magazine',
    'posts_per_page' => 3,
    'tax_query' => array(
      array(
        'taxonomy' => 'magazine_categories',
        'field' => 'term_id',
        'terms' => $catID,
      )
    )

  ));

  $term = get_term($catID);
  $catName = $term->name;
  ?>

  <section class="event-magazine bgWhite">
    <div class="container">

      <h2 class="mb80" data-animation="fadeInTop"> Magazine </h2>

      <div class="hp-organisations-grid posts-grid" data-animation="fadeInDown">


        <?php $t = 0;
        while ($magazine_posts->have_posts()) : $magazine_posts->the_post();
          $t += 100; ?>


          <a href="<?php the_permalink() ?>" class="org-grid-item post-item adelay<?= $t ?>"
             style="box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.04), 0px 0px 2px rgba(0, 0, 0, 0.06), 0px 0px 1px rgba(0, 0, 0, 0.04);"
             data-animation="fadeInTop"
          >
            <div class="top bg-orangeOpacity">
              <?php $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'thumbnail');
              if ($url) { ?>
                <img src="<?php echo $url ?>" alt="<?php the_title() ?>" alt="<?php the_title() ?> background">
              <?php } ?>
              <object><a href="#"> <?= $catName; ?> </a></object>
            </div>
            <div class="bottom">
              <div class="date-tags">
                <date>  <?php echo get_the_date('M d,  Y'); ?> </date>
              </div>
              <h4 class="mt16"> <?php the_title() ?> </h4>
              <?php
              $search_text = get_the_excerpt();
              $tags = array("<p>", "</p>");
              $search_content = str_replace($tags, "", $search_text);
              ?>
              <p class="limitRows3 mt8"> <?= $search_text; ?> </p>
            </div>
          </a>


        <?php endwhile;
        wp_reset_postdata(); ?>

      </div>

    </div>

  </section>

<?php endif; ?>


<!-- BESTEL CARDS -->
<!-- BESTEL CARDS -->
<!-- BESTEL CARDS -->

<div class="bgWhite" style="padding: 16px">
  <section class="bestel-karten" style="margin:0" data-animation="fadeInDown">
    <img src="<?= get_field('karteen_background_image')['url'] ?>" alt="Bestel bg">
    <div class="container">
      <?php if (!get_field('hide_tickets_button')) { ?>
        <h2 class="mb24 adelay200" data-animation="fadeInTop"> <?= get_field('karteen_title') ?> </h2>
        <a href="#" id="buyTickets" class="textLink orange adelay400"
           data-animation="fadeInTop"> <?= get_field('karteen_title') ?>
          <arrow>➝</arrow>
        </a>
      <?php } ?>
    </div>
  </section>
</div>


<div class="bgWhite">
  <?php get_footer(); ?>
</div>


<!--  TICKETS  -->
<!--  TICKETS  -->
<!--  TICKETS  -->


<section class="event-signup-form" event-id="<?= get_the_id() ?>" style="display: none;" id="ticket-payform">

  <div class="container">
    <form method="POST" enctype="multipart/form-data" id="ticketForm">
      <input type="hidden" name="pay" value="1">
      <div class="event-signup-form-box incl-form-box  shadow-for-box">

        <div class="left">
          <h4 class="mb32"> Tickets reservation </h4>


          <div class="reserve-fields-wrapper form-styles">

            <div id="tickets-list">
              <div class="reserve-fields-user" id="ticket-1">

                <h5 class="mb32"> Ticket #
                  <ticketNumber>1</ticketNumber>
                </h5>

                <div class="input" value="Ticket-Type">
                  <label> Ticket Type </label>
                  <select name="type[]" class="ticketPrices inputValue">

                    <?php if (have_rows('ticket')): ?>

                      <?php $i = 0;
                      while (have_rows('ticket')): the_row(); ?>

                        <?php if (get_sub_field('tickets_available') > 0) { ?>

                          <option
                            <?php if ($i == 0) { ?>selected<?php } ?>
                            value="<?php the_sub_field('ticket_name'); ?>"
                            data-price="<?php the_sub_field('ticket_price'); ?>"
                            data-available="<?php the_sub_field('tickets_available'); ?>"
                          >
                            <?php the_sub_field('ticket_name'); ?>
                          </option>

                          <?php $i++;
                        } else { ?>

                          <option
                            disabled
                            value="<?php the_sub_field('ticket_name'); ?>"
                            data-price="<?php the_sub_field('ticket_price'); ?>"
                            data-available="<?php the_sub_field('tickets_available'); ?>"
                          >
                            <?php the_sub_field('ticket_name'); ?> (SOLD OUT)
                          </option>

                        <?php } ?>

                      <?php endwhile; ?>

                    <?php endif; ?>

                  </select>
                </div>


                <?php $requiredFields = get_field('attendie_info_needed'); ?>

                <?php if (in_array("Voornaam", $requiredFields)) { ?>
                  <div class="input" value="Voornaam">
                    <label> Voornaam </label>
                    <input autocomplete="off" required class="inputValue" name="voornaam[]" type="text" placeholder="">
                  </div>
                <?php } ?>


                <?php if (in_array("Achternaam", $requiredFields)) { ?>
                  <div class="input" value="Achternaam">
                    <label> Achternaam </label>
                    <input autocomplete="off" required class="inputValue" name="achternaam[]" type="text"
                           placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Email", $requiredFields)) { ?>
                  <div class="input" value="Email">
                    <label> Email </label>
                    <input autocomplete="off" required class="inputValue" name="email[]" type="email" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Telefoonnummer", $requiredFields)) { ?>
                  <div class="input" value="Telefoonnummer">
                    <label> Telefoonnummer </label>
                    <input autocomplete="off" required class="inputValue" name="telefoonnummer[]" type="text"
                           placeholder="">
                  </div>
                <?php } ?>

          <?php if (in_array("Dieetwensen", $requiredFields)) { ?>
                  <div class="input" value="Dieetwensen">
                    <label> Diëet wensen? </label>
                    <input autocomplete="off" class="inputValue" name="dieetwensen[]" type="text" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Opleidingsniveau", $requiredFields)) { ?>
                  <div class="input" value="Opleidingsniveau">
                    <label> Opleidingsniveau </label>
                    <select required class="inputValue" name="opleidingsniveau[]">
                      <option selected disabled>Select</option>
                      <?php foreach ($education as $f) { ?>
                        <option value="<?= $f['value'] ?>"><?= $f['label'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>

                <?php if (in_array("Opleiding", $requiredFields)) { ?>
                  <div class="input" value="Opleiding">
                    <label> Opleiding </label>
                    <input autocomplete="off" required class="inputValue" name="opleiding[]" type="text" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Functie", $requiredFields)) { ?>
                  <div class="input" value="Functie">
                    <label> Functie </label>
                    <input autocomplete="off" required class="inputValue" name="functie[]" type="text" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Bedrijf", $requiredFields)) { ?>
                  <div class="input" value="Bedrijf">
                    <label> Bedrijf </label>
                    <input autocomplete="off" class="inputValue" name="bedrijf[]" type="text" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Studentenvereniging" , $requiredFields)) { ?>
                  <div class="input" value="Studentenvereniging">
                    <label> Studentenvereniging </label>
                    <input autocomplete="off" class="inputValue" name="studentenvereniging[]" type="text" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Gevonden" , $requiredFields)) { ?>
                  <div class="input" value="Gevonden">
                    <label> Hoe heb je Diversity Dinner gevonden? </label>
                    <input autocomplete="off" class="inputValue" name="gevonden[]" type="text" placeholder="">
                  </div>
                <?php } ?>

                <?php if (in_array("Werkvelden", $requiredFields)) { ?>
                  <div class="input" value="Werkvelden">
                    <label> Werkvelden </label>
                    <select required class="inputValue" name="werkvelden[]">
                      <option selected disabled>Select</option>
                      <?php foreach ($function as $f) { ?>
                        <option value="<?= $f['value'] ?>"><?= $f['label'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>

                <?php if (in_array("CV", $requiredFields)) { ?>
                  <div class="input" value="CV">
                    <label> CV </label>
                    <div class="fileupload">
                      <input class="inputValue" type="file" id="cv" name="cv[]">
                      <!-- <input required class="inputValue" type="file" id="cv" name="cv[]"> -->
                    </div>
                  </div>
                <?php } ?>

              </div>

            </div>

            <div class="cta-button">
              <div class="button-1 blue add-ticket">
                <span> Add New Ticket </span>
                <div></div>
              </div>
            </div>

          </div>

        </div>

        <div class="tickets-rec">

          <button type="button" class="close-event-pay-pop"><img
              src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg" alt="close icon"></button>

          <h4 class="mb32"> Summary </h4>

          <ul>
            <li> Tickets amount: <span id="tickets-amount"> 1 </span></li>
          </ul>
          <p id="totalprice"> Total price: <span> 0 EUR </span></p>

          <button class="cta-button">
            <div class="button-1" id="checkout">
              <span> Checkout </span>
              <div></div>
            </div>
          </button>

          <div class="loaderDots" id="CheckoutDots"></div>

        </div>
      </div>
    </form>
  </div>

</section>


<div class="reserve-fields-user" id="blank-ticket-example">

  <h5 class="mb32"> Ticket #
    <ticketNumber>1</ticketNumber>
  </h5>

  <button class="button-1 white remove-ticket"><span> Remove </span>
    <div></div>
  </button>

  <div class="input" value="Ticket-Type">
    <label> Ticket Type </label>
    <select name="type[]" class="ticketPrices inputValue">

      <?php if (have_rows('ticket')): ?>

        <?php $i = 0;
        while (have_rows('ticket')): the_row(); ?>

          <?php if (get_sub_field('tickets_available') > 0) { ?>

            <option
              <?php if ($i == 0) { ?>selected<?php } ?>
              value="<?php the_sub_field('ticket_name'); ?>"
              data-price="<?php the_sub_field('ticket_price'); ?>"
              data-available="<?php the_sub_field('tickets_available'); ?>"
            >
              <?php the_sub_field('ticket_name'); ?>
            </option>

            <?php $i++;
          } else { ?>

            <option
              disabled
              value="<?php the_sub_field('ticket_name'); ?>"
              data-price="<?php the_sub_field('ticket_price'); ?>"
              data-available="<?php the_sub_field('tickets_available'); ?>"
            >
              <?php the_sub_field('ticket_name'); ?> (SOLD OUT)
            </option>

          <?php } ?>

        <?php endwhile; ?>

      <?php endif; ?>

    </select>
  </div>


  <?php $requiredFields = get_field('attendie_info_needed'); ?>

  <?php if (in_array("Voornaam", $requiredFields)) { ?>
    <div class="input" value="Voornaam">
      <label> Voornaam </label>
      <input autocomplete="off" required class="inputValue" name="voornaam[]" type="text" placeholder="">
    </div>
  <?php } ?>


  <?php if (in_array("Achternaam", $requiredFields)) { ?>
    <div class="input" value="Achternaam">
      <label> Achternaam </label>
      <input autocomplete="off" required class="inputValue" name="achternaam[]" type="text" placeholder="">
    </div>
  <?php } ?>

  <?php if (in_array("Email", $requiredFields)) { ?>
    <div class="input" value="Email">
      <label> Email </label>
      <input autocomplete="off" required class="inputValue" name="email[]" type="email" placeholder="">
    </div>
  <?php } ?>

  <?php if (in_array("Telefoonnummer", $requiredFields)) { ?>
    <div class="input" value="Telefoonnummer">
      <label> Telefoonnummer </label>
      <input autocomplete="off" required class="inputValue" name="telefoonnummer[]" type="text" placeholder="">
    </div>
  <?php } ?>

	<?php if (in_array("Dieetwensen", $requiredFields)) { ?>
                  <div class="input" value="Dieetwensen">
                    <label> Diëet wensen? </label>
                    <input autocomplete="off" class="inputValue" name="dieetwensen[]" type="text" placeholder="">
                  </div>
                <?php } ?>

  <?php if (in_array("Opleidingsniveau", $requiredFields)) { ?>
    <div class="input" value="Opleidingsniveau">
      <label> Opleidingsniveau </label>
      <select required class="inputValue" name="opleidingsniveau[]">
        <option selected disabled>Select</option>
        <?php foreach ($education as $f) { ?>
          <option value="<?= $f['value'] ?>"><?= $f['label'] ?></option>
        <?php } ?>
      </select>
    </div>
  <?php } ?>



  <?php if (in_array("Opleiding", $requiredFields)) { ?>
    <div class="input" value="Opleiding">
      <label> Opleiding </label>
      <input autocomplete="off" required class="inputValue" name="opleiding[]" type="text" placeholder="">
    </div>
  <?php } ?>

  <?php if (in_array("Functie", $requiredFields)) { ?>
    <div class="input" value="Functie">
      <label> Functie </label>
      <input autocomplete="off" required class="inputValue" name="functie[]" type="text" placeholder="">
    </div>
  <?php } ?>

  <?php if (in_array("Bedrijf", $requiredFields)) { ?>
    <div class="input" value="Bedrijf">
      <label> Bedrijf </label>
      <input autocomplete="off" class="inputValue" name="bedrijf[]" type="text" placeholder="">
    </div>
  <?php } ?>

  <?php if (in_array("Studentenvereniging" , $requiredFields)) { ?>
      <div class="input" value="Studentenvereniging">
        <label> Studentenvereniging </label>
        <input autocomplete="off" class="inputValue" name="studentenvereniging[]" type="text" placeholder="">
      </div>
  <?php } ?>

  <?php if (in_array("Werkvelden", $requiredFields)) { ?>
    <div class="input" value="Werkvelden">
      <label> Werkvelden </label>
      <select required class="inputValue" name="werkvelden[]">
        <option selected disabled>Select</option>
        <?php foreach ($function as $f) { ?>
          <option value="<?= $f['value'] ?>"><?= $f['label'] ?></option>
        <?php } ?>
      </select>
    </div>
  <?php } ?>

  <?php if (in_array("CV", $requiredFields)) { ?>
    <div class="input" value="CV">
      <label> CV </label>
      <div class="fileupload">
        <input class="inputValue" type="file" id="cv" name="cv[]">
      </div>
    </div>
  <?php } ?>

</div>

<div class="hidden-epoll" style="display: none;">
	<?php echo do_shortcode('[IT_EPOLL id="28307"][/IT_EPOLL]') ?>
	<?php echo do_shortcode('[IT_EPOLL id="28305"][/IT_EPOLL]') ?>
	<?php echo do_shortcode('[IT_EPOLL id="28302"][/IT_EPOLL]') ?>
</div>


<style type="text/css">
  .event-program .programs .tabs li.active {
    border-bottom: 2px solid <?=get_field('event_color')?> !important;
  }

  .textLink.gold, .textLink.orange {
    color: <?=get_field('event_color')?> !important;
  }

  .kand_subcategory_title h3::before, .kand_subcategory_title h3::after, .ons-team-event .tabs-list ul li.active::after {
    background: <?=get_field('event_color')?> !important;
  }

  .event-cts {
    display: flex;
    flex-wrap: wrap;
  }

  .event-cts a {
    margin-bottom: 10px;
  }

  p a {
    color: <?=get_field('event_color')?> !important;
  }

  p a:hover {
    color: <?=get_field('event_color')?> !important;
  }

</style>


<script type="text/javascript">
  document.querySelector('#ticketForm').addEventListener('submit', e => {
    document.querySelector('#checkout').style.display = 'none';
    document.querySelector('#CheckoutDots').style.display = 'block';
  });
</script>


<style type="text/css">
  #CheckoutDots {
    display: none
  }

  .loaderDots {
    margin: 30px auto;
    background-color: var(--red);
    width: 12px;
    height: 12px;
    border-radius: 50%;
    position: relative;
    left: -18px;
  }

  .loaderDots:before, .loaderDots:after {
    content: " ";
    position: absolute;
    background-color: var(--red);
    width: 12px;
    height: 12px;
    border-radius: 50%;
  }

  .loaderDots:before {
    right: -20px;
    animation-delay: 1s;
  }

  .loaderDots:after {
    right: -40px;
    animation-delay: 2s;
  }

  .animate-coloring, .loaderDots, .loaderDots:before, .loaderDots:after {
    animation-name: coloring;
    animation-iteration-count: infinite;
    animation-duration: 3s;
    animation-timing-function: linear;
  }

  @keyframes coloring {
    0% {
      background-color: var(--red);
    }
    50% {
      background-color: white;
    }
    100% {
      background-color: var(--red);
    }
  }

</style>
