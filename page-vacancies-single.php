<?php

// Template Name: PAGE: Vacancies Single

use Carerix\Api\Rest\Entity\CRPublication;
use Carerix\Api\Rest\Entity\CRUser;
use Carerix\Api\Rest\Entity\CRCompany;

$url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
$id = explode('/', $url_path)[1] ?? false;

$publication = (array)CRPublication::find($id, ['show' => ['toVacancy', 'publicationEnd']]);

$vacancy = (array)$publication['toVacancy'];


if (!$vacancy) {
    die('Invalid ID provided');
}

/*kill the page based on end date value - expired publication*/

if ($vacancy['endDate'] && strtotime($vacancy['endDate']) < microtime(true)) {
    header("Location: /expired-vacancy/");
    die();
}

/*var_dump($vacancy['endDate']);
var_dump(microtime(true));*/


if ($_POST['apply'] ?? false) {
    include 'vacancy/app.php';
    exit;
}

$procedure = Entity_Form_EmployeeApply::get_system_select_options('Procedure');
$function = Entity_Form_EmployeeApply::get_system_select_options('Function0');

$user = (array)CRUser::find($vacancy['owner']->userID);
$company = (array)CRCompany::find($vacancy['toCompany']->companyID);

$informations =
    [
        // 'titleInformation'              => 'Title Information',

        'vacancyInformation' => 'Over de functie',
        'requirements' => 'Wat bieden wij?',
        'offerInformation' => 'Over de organisatie',
        'contactInformation' => 'Solliciteren?',
    ];

get_header();
?>

    <!-- success buy tickets -->
<?php if (isset($_GET['success'])) { ?>


    <div class="payment-successfull">
        <div class="payment-successfull-box shadow-for-box">

            <button class="close-pay-success"><img src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg"
                                                   alt="close icon"></button>

            <div class="thank-you-succes-form" style="display: block!important">
                <img src="/wp-content/uploads/2021/01/Group-19.svg" alt="success icon">
                <h3 class="mt16"> Success! </h3>
                <p class="silver mt8"> Gelukt! Bedankt, je sollicitatie voor <?= $vacancy['jobTitle'] ?> is bij ons
                    binnen gekomen. </p>
            </div>

        </div>
    </div>

<?php } ?>


    <div class="default-blue-header">
        <div class="container">
            <div class="date opacity0" data-animation="fadeIn">
                <img src="/wp-content/uploads/2021/01/.png"> <?= date_format(date_create($vacancy['modificationDate']), 'F d, Y') ?>
            </div>

            <h1 class="opacity0 adelay200" data-animation="fadeIn">
                <?php echo do_shortcode('[cx_apply_button]') ?>
                <?= $vacancy['jobTitle'] ?>
            </h1>
        </div>
    </div>


    <div class="single-info-post-1 opacity0 adelay400" data-animation="fadeIn" style="margin-top: 40px;">
        <div class="container">
            <div class="left">
                <?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>

                <div class="share-socials">
                    <div class="share-socials-items">
                        <ul>
                            <li>
                                <a href="#"
                                   onclick="share_fb('<?php echo $actual_link ?>');return false;" rel="nofollow"
                                   share_url="<?php echo $actual_link ?>"
                                   target="_blank"> <img src="/wp-content/uploads/2021/01/facebook-1.svg"/>
                                </a>
                            </li>

                            <li>
                                <a target="_blank"
                                   href="https://twitter.com/share?url=<?php echo $actual_link ?>&text=<?php the_title() ?>">
                                    <img src="/wp-content/uploads/2021/01/social-media-social-media-logo-twitter.svg"/>
                                </a>
                            </li>

                            <li>
                                <a target="_blank"
                                   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $actual_link ?>">
                                    <img src="/wp-content/uploads/2021/01/linkedin.svg"/>
                                </a>
                            </li>

                            <li>
                                <a href="whatsapp://send?text=<?php echo $actual_link ?>"
                                   data-action="share/whatsapp/share">
                                    <img src="/wp-content/uploads/2021/01/iconmonstr-whatsapp-1.svg"/>
                                </a>
                            </li>

                            <li>
                                <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this job offer <?php echo $actual_link ?>"
                                   title="Share by Email">
                                    <img src="/wp-content/uploads/2021/01/iconmonstr-email-2.svg"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="post">


                    <?php if ($vacancy['companyInformation']) { ?>

                        <div class="section">

                            <h3>  <?php if ($vacancy['introInformation']) {
                                    echo $vacancy['introInformation'];
                                } else {
                                    echo 'Intro';
                                } ?> </h3>

                            <p> <?php echo $vacancy['companyInformation']; ?> </p>

                        </div>

                    <?php } ?>

                    <?php foreach ($informations as $key => $title) {
                        if (!empty($vacancy[$key])) { ?>


                            <div class="section">

                                <h3>  <?= $title ?></h3>

                                <p><?= $vacancy[$key] ?></p>

                            </div>


                        <?php }
                    } ?>


                    <div class="action">

                        <a class="button-1 mt0" id="buyTickets">

                            <span>Solliciteer nu</span>

                            <div></div>

                        </a>

                    </div>

                </div>

            </div>


            <div class="right opacity0" data-animation="fadeIn" style="margin-top: -242px">

                <div class="brand">

                    <img src="<?= $company['companyProfile'] ?>">

                </div>


                <div class="info">

                    <div>

                        <b>Contracttype</b>


                        <?php foreach ($procedure as $p) { ?>

                            <?php if ($p['value'] == $vacancy['toProductNode']->dataNodeID) {
                                echo $p['label'];
                            } ?>

                        <?php } ?>

                    </div>


                    <div>

                        <b>Dienstverband</b> <?= $vacancy['hoursPerWeek'] ?> uur per week

                    </div>


                    <div>

                        <b>Werkvelden</b>


                        <?php foreach ($function as $f) { ?>

                            <?php if ($f['value'] == $vacancy['toFunctionLevel1']->dataNodeID) {
                                echo $f['label'];
                            } ?>

                        <?php } ?>

                    </div>

                    <div>
                        <b>Werklocatie</b> <?= $vacancy['workCity'] ?>
                    </div>

                </div>


                <a href="#" class="button-1 mt0" id="buyTickets">
                    <span>Solliciteer nu</span>
                    <div></div>
                </a>


                <div class="info-1 checkmark-list">

                    <?= get_field('waarom_global_people_content', 276) ?>

                </div>


                <div class="contact">

                    <p>

                        Vragen over deze vacature?

                    </p>


                    <div class="person">

                        <div class="image">

                            <img src="<?= $user['url'] ?>">

                        </div>


                        <div class="informations">

                            <h4>

                                <?= $user['firstName'] ?> <?= $user['lastName'] ?>

                            </h4>


                            <div class="information">

                                <!-- <img src="/wp-content/uploads/2021/01/email.png"> -->

                                <a href="mailto:vacatures@globalpeople.nl"><?= $user['emailAddressBusiness'] ?></a>

                            </div>


                            <div class="information">

                                <img src="/wp-content/uploads/2021/01/phone.png">

                                <a href="callto:<?= $user['phoneNumberBusiness'] ?>"><?= $user['phoneNumberBusiness'] ?></a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="container" style="margin-top: 120px;">

        <?php include 'template-parts/block-newsletterForm.php'; ?>

    </div>


    <div id="fb-root"></div>


    <script>(function (d, s, id) {

            var js, fjs = d.getElementsByTagName(s)[0];

            if (d.getElementById(id)) return;

            js = d.createElement(s);
            js.id = id;

            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";

            fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));</script>


    <script type="text/javascript">


        function share_fb(url) {

            window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, 'facebook-share-dialog', "width=626, height=436")

        }


    </script>


    <section class="event-signup-form" style="display: none;" id="ticket-payform">

        <div class="container">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="apply" value="1">
                <div class="event-signup-form-box incl-form-box  shadow-for-box">

                    <div class="left" style="width: 100%;">
                        <h4 class="mb32"> Apply to <?= $vacancy['jobTitle'] ?> </h4>

                        <button type="button" class="close-event-pay-pop" style="right: 25px; top: 25px;"><img
                                    src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg" alt="close icon"
                                    data-src="/wp-content/uploads/2021/01/Icon-ionic-ios-close.svg" class="lazyloaded">
                        </button>

                        <div class="reserve-fields-wrapper form-styles">

                            <div id="tickets-list">
                                <div class="reserve-fields-user" id="ticket-1">

                                    <div class="input" value="Voornaam">
                                        <label> Voornaam </label>
                                        <input autocomplete="off" required class="inputValue" name="voornaam"
                                               type="text" placeholder="">
                                    </div>


                                    <div class="input" value="Achternaam">
                                        <label> Achternaam </label>
                                        <input autocomplete="off" required class="inputValue" name="achternaam"
                                               type="text" placeholder="">
                                    </div>

                                    <div class="input" value="Geboortedatum">
                                        <label> Geboortedatum </label>
                                        <input autocomplete="off" required class="inputValue" name="geboortedatum"
                                               type="date" placeholder="">
                                    </div>

                                    <div class="input" value="Telefoonnummer">
                                        <label> Telefoonnummer </label>
                                        <input autocomplete="off" required class="inputValue" name="telefoonnummer"
                                               type="text" placeholder="">
                                    </div>

                                    <div class="input" value="Email">
                                        <label> E-mailadres </label>
                                        <input autocomplete="off" required class="inputValue" name="email" type="email"
                                               placeholder="">
                                    </div>

                                    <div class="input" value="Functieniveau">
                                        <label for="functieniveau">Functieniveau</label>
                                        <select name="functieniveau" id="functieniveau" required>
                                            <option value="" selected disabled>Selecteer</option>
                                            <option value="4553">Student</option>
                                            <option value="4554">Junior</option>
                                            <option value="4555">Medior</option>
                                            <option value="4557">Senior</option>
                                        </select>
                                    </div>

                                    <div class="input" value="Opleidingsniveau">
                                        <label for="opleidingsniveau">Opleidingsniveau</label>
                                        <select name="opleidingsniveau" id="opleidingsniveau" required>
                                            <option value="" selected disabled>Selecteer</option>
                                            <option value="88">PHD</option>
                                            <option value="89">WO Master</option>
                                            <option value="90">WO Bachelor</option>
                                            <option value="91">HBO+</option>
                                            <option value="92">HBO</option>
                                            <option value="10227">MBO 3-4</option>
                                        </select>
                                    </div>

                                    <div class="input" value="Function0">
                                        <label for="function0">Gewenste werkveld</label>
                                        <select name="function0" id="function0" required>
                                            <option value="" selected disabled>Selecteer</option>
                                            <option value="641">Commercieel</option>
                                            <option value="642">Financieel</option>
                                            <option value="643">HRM</option>
                                            <option value="644">ICT</option>
                                            <option value="645">Juridisch</option>
                                            <option value="646">Technisch</option>
                                            <option value="10229">Onderwijs</option>
                                            <option value="10230">Overheid</option>
                                            <option value="10231">Marketing & Communicatie/PR</option>
                                            <option value="10232">Culturele sector</option>
                                            <option value="10233">Zorg</option>
                                            <option value="10234">Administratief</option>
                                            <option value="10239">Diverse</option>
                                            <option value="10382">Consultancy</option>
                                        </select>
                                    </div>

                                    <!-- <div class="input" value="Opleidingsniveau">
                                        <label> Opleidingsniveau </label>
                                        <input autocomplete="off" class="inputValue" name="opleidingsniveau" type="text"
                                               placeholder="">
                                    </div> -->

                                    <div class="input" value="CV">
                                        <label> CV als bijlage </label>
                                        <div class="fileupload">
                                            <input class="inputValue" required type="file" id="cv" name="cv">
                                        </div>
                                    </div>

                                    <div>
                                        <input autocomplete="off" class="inputValue" name="gdpr" type="checkbox">
                                        Ik ga akkoord met <a href="/terms-and-conditions/">de voorwaarden</a>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <button class="cta-button" style="margin-top: -30px; max-width: 250px; float: right;">
                            <div class="button-1">
                                <span> Apply </span>
                                <div></div>
                            </div>
                        </button>

                    </div>
                </div>
            </form>
        </div>

    </section>


    <style type="text/css">

        .share-socials {

            margin-top: 0;

            border-top: none;

            padding-top: 0;

            margin-bottom: 30px;

        }


        .share-socials-items ul {

            justify-content: flex-start;

        }


    </style>


<?php get_footer(); ?>