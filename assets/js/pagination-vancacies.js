
// Pagination initialize 
// What happens on a tag click is done in pagination.js


function initPagination () {

    var init = function() {
        Pagination.Init(document.getElementById('pagination'), {
            size: 3, // pages size
            page: parseInt($("#posts").attr("currentPage") ),  // selected page
            step: 2   // pages before and after current
        });
    };

    document.addEventListener('DOMContentLoaded', init, false);init
    
}

initPagination ();

// Get URL Paramater, like category = 'something', used for categories.

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

// make array of categories
// var allcategories = [];

// $.ajax({
//     type: "GET",
//     url: "/wp-json/wp/v2/categories",
//     dataType : "json",
//     success: function (categories) {
//         allcategories = categories;
//         $("#pagination a.current").get(0).click();
//     }

// }).done(function (data) {
//     // if ($(".page-numbers").length > 0 ) {
//     //     var loadedpage = parseInt ( $(".page-numbers.current").text() );
//     //     $("#pagination span a").eq(loadedpage-1).get(0).click();    
//     // }
//     // else {
//     //     $("#pagination span a").eq(0).get(0).click();
//     // }
// });



function searchArray(nameKey, myArray){
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i].id === nameKey) {
            return myArray[i];
        }
    }
}


var allposts = [];
var postsperpage = 15;

$(document).on('click', '.procedure', function()
{
    $(this).toggleClass('active');

    loadPosts(1);
});

$(document).on('click', '.function', function()
{
    $(this).toggleClass('active');

    loadPosts(1);
});

$(document).on('click', '.city', function()
{
    $(this).toggleClass('active');

    loadPosts(1);
});

$(document).on('click', '.sort', function()
{
    $('.sort').removeClass('active');
    $(this).toggleClass('active');

    loadPosts(1);
});

$(document).on('change', '.search', function()
{
    loadPosts(1);
});

function loadPosts(page) {

    var loader =
        `<div class="loader">
          <div class="inner one"></div>
          <div class="inner two"></div>
          <div class="inner three"></div>
        </div>`;


    $("#posts").html(loader);


    // make API URL
    //let url = window.location.href;
    let url = '/vacatures/';
    var apiurl = url + "?json=true";
    let route = window.location.pathname.split('/');

    if(route.length >= 3)
    {
        route = route[2];

        if(route !== 'page')
        {
            apiurl = url+route+"?json=true";
        }
    }

    // Get procedure filters

    apiurl += '&procedure='

    $('.procedure').each(function()
    {
        if($(this).hasClass('active'))
        {
            apiurl += $(this).attr('data-value') + ',';
        }
    });

    // Get function filters

    apiurl += '&function='

    $('.function').each(function()
    {
        if($(this).hasClass('active'))
        {
            apiurl += $(this).attr('data-value') + ',';
        }
    });

    // Get city filters

    apiurl += '&city='

    $('.city').each(function()
    {
        if($(this).hasClass('active'))
        {
            apiurl += $(this).attr('data-value') + ',';
        }
    });

    // Get sort filters

    apiurl += '&sort='

    $('.sort').each(function()
    {
        if($(this).hasClass('active'))
        {
            apiurl += $(this).attr('data-value');
        }
    });

    // Get search filters
    apiurl += '&search=' + $('.search').val();

    //take category name from URL
    var catname = getUrlParameter('category');

    var foundCatID; 


    // if category URL , to api url add category listing.
    if (catname) {

        for (var c=0; c < allcategories.length; c++) {
            if (allcategories[c].slug === catname) {
               foundCatID = allcategories[c].id;
            }
        }

        apiurl = apiurl+"&categories="+foundCatID;
    }

    console.log("API ", apiurl);

    $.ajax({
        url : apiurl,
        method : "GET",        
        dataType : "json",
        success : function (data) {
               var dataArr = data;
               page = page - 1;
               var html = "";
               var pageXposts = page*postsperpage ;
            

                // var companyName = dataArr[0].invoiceCompanyName;
                // var path = window.location.pathname;
                // path = path.toLowerCase();
                // if ( path != "/vacatures" && path != "/vacatures/"){
                //     $(".vacancies-sorts > h2").text("Vacatures - " + companyName);  
                // }
                for (var p = pageXposts ; p < pageXposts  + postsperpage; p++) {

                   if (dataArr[p]) {
                        var descr = dataArr[p].companyInformation;
                        if (descr) {
                            descr = descr.replace(/(<([^>]+)>)/ig,"");
                        }
                        html+= `
                            <a href="/vacancy/${dataArr[p].publicationID}/${dataArr[p].jobTitle}"  class="vacancies-item">

                                <div  class="top">
                                    <tag> ${dataArr[p].function_data} </tag>
                                    <h4 class="mt16"> ${dataArr[p].jobTitle} </h4>
                                    <div class="limitRows3 silver mt16 companyInfoShort"> ${descr} </div>
                                    <div class="date-and-tags">
                                        <date> ${dataArr[p].modificationDate} </date>
                                        <tag> ${dataArr[p].procedure_data} </tag>
                                        <tag> ${dataArr[p].workCity} </tag>
                                    </div>
                                </div>
                                <div class="logo-name">
                                    <object><a href="/vacatures/`+ dataArr[p].invoiceCompanyName.replace(/\s+/g, '-').toLowerCase() +`/">
                                        <p>${dataArr[p].invoiceCompanyName}</p>
                                    </a></object>
                                </div>
                            </a>
                        `;
                        $('#city').append(`<li class="city" data-value="${dataArr[p].workCity}">${dataArr[p].workCity}</li>`);
                    }
                }
           $("#posts").html(html);
        },

        error : function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }

    }).done(function (data) { 

        if ( data.length < 1) {

            $("#pagination").hide();
            $("#posts").hide();
        }
        else {
            $("#pagination").show();
            $("#posts").show();
        }
        

        Pagination.Init(document.getElementById('pagination'), {
            size: Math.ceil(data.length / 15), // pages size
            page: page+1,  // selected page
            step: 2   // pages before and after current
        });
        
    
        
         if ( $("#pagination span a").last().hasClass("current") ) {
              $(".nextPag").hide();
          }
          else {
              $(".nextPag").show();
          }


          if ( $("#pagination span a").first().hasClass("current") ) {
              $(".prevPag").hide();
          }
          else {
              $(".prevPag").show();
          }

          $("#pagination").css("opacity", 1);
        
    });

}

// update categories status
$(".blog-categories a").on("click", function(e){
    
    e.preventDefault();

    $(".blog-categories li").removeClass("active");
    $(this).parent().addClass("active");

    var CatURL = $(this).attr("href");
    history.pushState(null, '', CatURL);

    var catname = getUrlParameter('category');

    if (!catname) {
        catname = "Category";
    }

    loadPosts(1);

});


function updateCategoryStatus() {
    var catname = getUrlParameter('category');
    var found = 0;
    $(".blog-categories li a").each(function(){
        var a = $(this).text().toLowerCase().replaceAll(" ", "-");
        if ( a == catname ) {
            $(this).parent().addClass("active");
            found = 1;
        }
    });
    if ( found == 0) {
        $(".blog-categories li").eq(0).addClass("active");
    }

}


updateCategoryStatus();

let pageUrl = window.location.href;
let pageNum = 1;
if (pageUrl.includes("/page/")) {
    let pageNumSplit = pageUrl.split("/page/")[1].match(/^\d*/);
    pageNum = pageNumSplit[0];
}


loadPosts(pageNum);

// window.addEventListener('load', function() {
//     setTimeout(function(){
//         $("#pagination a.current").get(0).click();
//     }, 200)
// });
