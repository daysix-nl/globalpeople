<?php 

// Template Name: PAGE: Vacancies

use Carerix\Api\Rest\Entity\CRVacancy;

    $url_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
    $company = explode('/', $url_path)[1] ?? false;

    if ( $company == "tbwa") {
        $company = "tbwa/neboko";
    }

    $cp = 0;

    if ($company == "page") {
        $pageNumber = explode('/', $url_path)[2] ?? 1;
    }

    if (!isset($pageNumber) || !$pageNumber ) { $pageNumber = 1; }

    if($company && $company != "page" )
    {
        $cp = 1;
        $company = '/' . $company;
    }

    $procedure = Entity_Form_EmployeeApply::get_system_select_options('Procedure');
    $function  = Entity_Form_EmployeeApply::get_system_select_options('Function0');
 
    $cities    = [];
    $companies = [];


    $vacancies = (array) CRVacancy::findAll(['count' => 150]);

    foreach($vacancies as $vacancy)
    {
        if($vacancy->isHidden || $vacancy->deleted)
        {
            continue;
        }

        if(isset($vacancy->endDate))
        {
            if(strtotime($vacancy->endDate) < microtime(true))
            {
                continue;
            }
        }

        if(isset($vacancy->deadline))
        {
            if(strtotime($vacancy->deadline) < microtime(true))
            {
                continue;
            }
        }

        $cities[strtolower($vacancy->workCity)] = [$vacancy->coordX, $vacancy->coordY];

        if(!in_array($vacancy->invoiceCompanyName, $companies))
        {
            array_push($companies, $vacancy->invoiceCompanyName);
        }
    }


    if($_GET['json'] ?? false)
    {
        include 'page-vacancies-json.php'; exit;
    }
    
    get_header(); 
?>

<style type="text/css">
    .procedure.active, .function.active, .sort.active, .city.active
    {
        background: var(--red);
        color: #fff!important;
        padding-left: 10px!important;
    }
</style>

<section class="vacancies-header">
    <div class="container">
        <div class="content">
            <h2 data-animation="fadeInTop">Staat je vacature er niet tussen en wil je graag dat wij meedenken?</h2>
            <p class="silver mt16 adelay200" data-animation="fadeInTop"> Wij zijn Global People. Net als jij. We kennen de uitdagingen van het solliciteren, de valkuilen en (onbewuste) vooroordelen. Al 15 jaar slaan wij een brug tussen multicultureel talent en topwerkgevers. Om jou uitdagende banen te kunnen bieden bij mooie organisaties. Die inclusief denken én doen. Zoek hier de vacature die bij je past.  </p>
            <a href="/vacancy/200/Open%20Sollicitatie" class="textLink orange adelay400" data-animation="fadeInTop"> Upload je CV hier! <arrow>➝</arrow> </a>
        </div>
    </div>
    <img class="personImg" src="/wp-content/uploads/2021/01/vacancies-header-image.jpg" alt="vacancies header image" data-animation="fadeIn">
    <img class="shapeImg" src="/wp-content/uploads/2021/01/Shape-4.svg" alt="bg-shape" data-animation="fadeIn">
</section>

<section class="vacancies-list" data-animation="fadeInDown">
    <div class="container">

        <div class="vacancies-filters shadow-for-box">

            <!--<div class="item">
                <div class="custom-select multiselect">
                    <div class="selection-trigger">
                        <img src="/wp-content/uploads/2021/01/contracttype.svg">
                        <value> Contracttype </value>
                    </div>
                    <div class="custom-select-options">
                        <ul>
                            <?php /*foreach($procedure as $filter) { if($filter['label']) { */?>
                                <li class="procedure" data-value="<?/*=$filter['value']*/?>"> <?/*=$filter['label']*/?> </li>
                            <?php /*} } */?>
                        </ul>
                    </div>
                </div>
            </div>-->

            <!-- <div class="item">
                <div class="custom-select multiselect">
                    <div class="selection-trigger">
                        <img src="/wp-content/uploads/2021/01/opleid.svg">
                        <value> Opleidingsniveau </value>
                    </div>
                    <div class="custom-select-options">
                        <ul>
                            <li> Something </li>
                            <li> Something 2 </li>
                            <li> Something 3 </li>
                            <li> Something 4 </li>
                        </ul>
                    </div>
                </div>
            </div> -->

            <div class="item">
                <div class="custom-select multiselect">
                    <div class="selection-trigger">
                        <img src="/wp-content/uploads/2021/01/werkvelden.svg">
                        <value> Werkvelden </value>
                    </div>
                    <div class="custom-select-options">
                        <?php foreach($function as $filter) { if($filter['label']) { ?>
                            <li class="function" data-value="<?=$filter['value']?>"> <?=$filter['label']?> </li>
                        <?php } } ?>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="custom-select multiselect">
                    <div class="selection-trigger">
                        <img src="/wp-content/uploads/2021/01/werklocation.svg">
                        <value> Werklocatie </value>
                    </div>
                    <div class="custom-select-options">
                        <?php foreach($cities as $city => $coords) { if($city) { ?>
                            <li class="city" data-value="<?=strtolower($city)?>"> <?=ucfirst($city)?> </li>
                        <?php } } ?>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="filter-input ">
                    
                    <img src="/wp-content/uploads/2021/02/search.svg" style="left: 37px; top: 10px;">
                    <input type="text" placeholder="Search" class="search">
                    
                </div>
            </div>

            <button class="ApplyFilters button-1 big" onclick="loadPosts(1);"> <span>Filter</span> <div><div></button>
        </div>

        <div class="vacancies-sorts">

            <h2> Vacatures </h2>
            <div class="sort-filters">

                <div class="sort-item">
                    <label> Sorteer op </label>
                    <div class="custom-select sorteer">
                        <div class="selection-trigger">
                            <value> Nieuwste </value>
                        </div>
                        <div class="custom-select-options">
                            <ul>
                                <li class="sort active" data-value="1"> Nieuwste </li>
                                <li class="sort" data-value="2"> Oudste </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- <div class="sort-item">
                    <label> Toon </label>
                    <div class="custom-select ">
                        <div class="selection-trigger">
                            <value> 12 </value>
                        </div>
                        <div class="custom-select-options tac">
                            <ul>
                                <li class="per-page" data-value="6"> 6 </li>
                                <li class="per-page" data-value="12"> 12 </li>
                                <li class="per-page" data-value="24"> 24 </li>
                                <li class="per-page" data-value="26"> 36 </li>
                                <li class="per-page" data-value="48"> 48 </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>  
        </div>


        <?php if ( $cp > 0 ) { ?>
            <div class="vacancies-grid" id="posts" data-url="vacatures<?=htmlspecialchars($company, ENT_QUOTES)?>" currentPage="<?=$pageNumber?>"></div>
        <?php } else { ?>
            <div class="vacancies-grid" id="posts" data-url="vacatures" currentPage="<?=$pageNumber?>"></div>
        <?php } ?>
        <div id="pagination" style="margin-top: 40px;"></div>
    </div>
</section>

<div class="container" style="margin-top: 120px;">
    <?php include 'template-parts/block-newsletterForm.php'; ?>
</div>

<?php get_footer(); ?>