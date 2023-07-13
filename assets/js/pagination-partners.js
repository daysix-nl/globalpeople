
    
// Pagination initialize 
// What happens on a tag click is done in pagination.js
// 
function initPagination () {
    
    var totalpages = 1;

    if ( $(".page-numbers").length > 0 ) {
        if ( $(".next.page-numbers").length > 0 ) {
            totalpages = parseInt( $(".page-numbers").eq(-2).text() );
        }
        else {
            totalpages = parseInt( $(".page-numbers").last().text() );  
        }
    }


    var s = window.location.href;
    var url = window.location.href;
    var arr = url.split('/');
    var pageNum = arr[arr.indexOf('page') + 1];


    var init = function() {
        Pagination.Init(document.getElementById('pagination'), {
            size: totalpages, // pages size
            page: parseInt(pageNum),  // selected page
            step: 2   // pages before and after current
        });
    };

    document.addEventListener('DOMContentLoaded', init, false);init

        
    setTimeout(function(){
        $("#pagination a.current").get(0).click()
    }, 1000);
    
}


initPagination ()





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


// edit next and previous pagination

$(".pagination .next").html("Prev");
$(".pagination .prev").html("Next");





function searchArray(nameKey, myArray){
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i].id === nameKey) {
            return myArray[i];
        }
    }
}


var allposts = [];
var postsperpage = 5;



function loadPosts(page) {

  
    // make API URL 


    var loader = 
    `<div class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>`;


    $("#posts").html(loader);

    var apiurl = "/wp-json/wp/v2/partner?_embed&per_page=50";


    $.ajax({

        url : apiurl,
        method : "GET",     
        dataType : "json",
        success : function (data) {
        
            var dataArr = data;
            page = page - 1;
            var html = "";
            var pageXposts = page*postsperpage;

            for (var p = pageXposts ; p < pageXposts + postsperpage; p++) {
                
                
                if (dataArr[p] && typeof(dataArr[p]) != "undefined" ) {
                    
                    if ( typeof(dataArr[p]._embedded) != "undefined" ) {
                        ftimg = dataArr[p]._embedded['wp:featuredmedia'][0].source_url;
                    } else {
                        ftimg = "";
                    }


                    html+=`
                    <a href="`+ dataArr[p].link+`" class="partner">
                        <div class="image">
                             <img src="`+ftimg+`" alt="`+ dataArr[p].title.rendered+ ` Image" />
                        </div>

                        <div class="info middle">
                            <div>
                                <div class="organization"> Partner </div>
                                <h3> `+ dataArr[p].title.rendered+ `  </h3>
                                <div class="limitRows2"> `+ dataArr[p].excerpt.rendered+ ` </div>
                            </div>
                        </div>
                    </a>`; 
                    
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
            size: Math.ceil(data.length / 5), // pages size
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




