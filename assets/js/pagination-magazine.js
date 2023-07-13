
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




	var init = function() {
		Pagination.Init(document.getElementById('pagination'), {
			size: totalpages, // pages size
			page: 1,  // selected page
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
var allcategories = [];

$.ajax({
    type: "GET",
    url: "/wp-json/wp/v2/categories?per_page=100",
    dataType : "json",
    success: function (categories) {
    	$("#pagination a.current").removeClass("current");
    	var crnt = parseInt( $("nav.pagination .current").text() );
    	allcategories = categories;
    	var x = 0;
    	$("#pagination > span a").each(function(){
    		var t = parseInt( $(this).text() );
    		if ( crnt == t) {
    			$(this).addClass("current");
    			x=1;
    		}
    	});
    	if ( x == 0) {
    		$("#pagination a").get(0).click();
    	} else {
    		$("#pagination a.current").get(0).click();
    	}


    	
    }

}).done(function (data) {
	// if ($(".page-numbers").length > 0 ) {
	// 	var loadedpage = parseInt ( $(".page-numbers.current").text() );
	// 	$("#pagination span a").eq(loadedpage-1).get(0).click();	
	// }
	// else {
	// 	$("#pagination span a").eq(0).get(0).click();
	// }
});



function searchArray(nameKey, myArray){
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i].id === nameKey) {
            return myArray[i];
        }
    }
}


var allposts = [];
var postsperpage = 9;

function loadPosts(page) {



	var loader = 
    `<div class="loader">
      <div class="inner one"></div>
      <div class="inner two"></div>
      <div class="inner three"></div>
    </div>`;


    $("#posts").html(loader);

	
	// make API URL 

	var apiurl = "/wp-json/wp/v2/magazine?_embed&orderby=date&per_page=100";

	//take category name from URL
	var catname = getUrlParameter('category');
    if (catname) {
		apiurl = apiurl+"&filter[magazine_categories]="+catname;
	}

	console.log(apiurl);

	
	$.ajax({

		url : apiurl,
		method : "GET",		
		dataType : "json",
		success : function (data) {
		
		   	var dataArr = data;

		   	
		   	page = page - 1;

		   	
		   	
		   	var html = "";

		   	var pageXposts = page*postsperpage ;


		 	
		   	for (var p = pageXposts ; p < pageXposts  + postsperpage; p++) {

		
		   		if (dataArr[p]) {



					var cateList = ``;

					
					var ftimg = "/wp-content/uploads/2021/01/placeholder-image.jpg";
					var termData = dataArr[p]._embedded['wp:term'];

					var catName = "";
					if ( dataArr[p].acf.main_category ) {
						catName = dataArr[p].acf.main_category.name;
					} else if ( !dataArr[p].acf.main_category && termData ) {
						catName = termData[0][0].name ;
					} else {
						catName = "";
					}
					
				
	

					if ( typeof(dataArr[p]._embedded['wp:featuredmedia']) != "undefined" ) {
						ftimg = dataArr[p]._embedded['wp:featuredmedia'][0].source_url;
					} 

					var exceprt = dataArr[p].excerpt.rendered;

					exceprt = exceprt.replaceAll("<p>", "");
					exceprt = exceprt.replaceAll("</p>", "");

					 
					html+= `
					<a href="`+ dataArr[p].link+`" class="org-grid-item post-item">
						<div class="top bg-orangeOpacity">
							<img src="`+ftimg+`" alt="`+ dataArr[p].title.rendered+ ` featured image">
							<object> <a href="#"> `+catName+` </a> </object>
						</div>
						<div class="bottom">
							<div class="date-tags"> 
								<date> `+dataArr[p].formatted_date+` </date>
							</div>
							<h4 class="mt16"> `+ dataArr[p].title.rendered+ ` </h4>
							<p class="limitRows3 mt8">  `+exceprt+` </p>
						</div>
					</a>
					`;	

					
			   		
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
		
		// adjust category colors
		$('.appendCategory').each(function(){
			var html = $(this).text(); 
			$(this).empty();
			$(this).append( html);

			$(this).find("span").each(function(){
				if ( !$(this).is(":last-child") ) {
					
					$(this).append(", ")
				}
			});
	    });
		
		Pagination.Init(document.getElementById('pagination'), {
			size: Math.ceil(data.length / postsperpage), // pages size
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


