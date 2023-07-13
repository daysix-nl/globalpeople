

var $ = jQuery.noConflict();

var PROJECT_ANIMATIONS = class
{
    splitTextInRows()
    {
        $(".splitTextInRows").each(function(){

            var spanInserted = $(this).html().split(" ").join(" </span><span class='dha-animate' data-animation='fadeInTop'>");
            var wrapped = ("<span class='dha-animate' data-animation='fadeInTop'>").concat(spanInserted, "</span>");
            $(this).html(wrapped);
            var refPos = $(this).find('span:first-child').position().top;
            var newPos;
            $(this).find("span").each(function(index) {
                newPos = $(this).position().top;
                if (index == 0){
                   return;
                }
                if (newPos == refPos) {
                    $(this).prepend($(this).prev().text() + " ");
                    $(this).prev().remove();
                } 
                refPos = newPos;
            });


        });
    }

};


if (typeof project_animations === "undefined" || PROJECT_ANIMATIONS === null) {

    var project_animations = new PROJECT_ANIMATIONS();


    $( window ).on("load", function() {
        setTimeout(function(){
             dha_animations();
        }, 200)
       
    });


    $(window).scroll(function() {
        dha_animations();
    });




}


function dha_animations() {
    $('[data-animation]').each(function () {

        var imagePos = $(this).offset().top;
        var topOfWindow = $(window).scrollTop();


        if ( imagePos < topOfWindow + $(window).height() ) {
            var animateClass = $(this).attr("data-animation");
            $(this).addClass(animateClass);
           
        } 
        // else {
        //     var animateClass = $(this).attr("data-animation");
        //     $(this).removeClass(animateClass);
        // }
    });


    $('.rating-line span').each(function () {

        var imagePos = $(this).offset().top;
        var topOfWindow = $(window).scrollTop();

        if (imagePos < topOfWindow + $(window).height() && imagePos + $(window).height() > topOfWindow) {
            $(this).css("width", $(this).attr("data-width"));
        }
        // else {
        //     $(this).css("width", 0);
        // }
    });


}
