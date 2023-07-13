var $ = jQuery.noConflict();

/* [Werkgevers Slider] */

    var wergevers_slider = new Swiper('.items', 
    {
        navigation: 
        {
            nextEl: '.wsn',
            prevEl: '.wsp'
        },
        breakpoints: {
            0: {
                slidesPerView: 1.2,
                spaceBetween: 40
            },
            768: {
                width: 640,
                spaceBetween: 49
            },
           
        }
    });

/* [Testimonials] */

    var testimonials = new Swiper('.testimonials', 
    {
        navigation: 
        {
            nextEl: '.wsn',
            prevEl: '.wsp'
        },
        breakpoints: {
            0: {
                slidesPerView: 1.2,
                spaceBetween: 20
            },
            768: {
                width: 544,
                spaceBetween: 32
            },
           
        }
    });