var $ = jQuery.noConflict();

// [ HAMBURGER MENU ]

$(document).ready(function () {
  $('.menu-wrapper').on('click', function () {
    $('.hamburger-menu').toggleClass('animate');
    $('.header .menu').fadeToggle();
  });

  // voting edits
  $('.it_epoll_survey-item-action.it_epoll_survey-item-action-disabled').append(
    '<p>Je hebt al gestemd</p>'
  );

  // submenus in hamb menu
  $('.header .menu-list > li.menu-item-has-children > a').on(
    'click',
    function (e) {
      if ($(window).width() <= 991) {
        e.preventDefault();

        if (e.offsetX > this.offsetWidth - 50) {
          $(this).parent().find('.sub-menu').slideToggle('fast');
        } else {
          var url = $(this).first().attr('href');
          window.location.href = url;
        }
      }
    }
  );

  //  FAQ PRE CLICK TAB IF HASH IN URL
  if (window.location.href.indexOf('faq') > -1) {
    if (window.location.hash) {
      var hash = window.location.hash;
      hash = hash.replace('#', '').toLowerCase();

      $('.faq .werk-tabs .tabs ul li').each(function () {
        var name = $(this).text().trim().replace(' ', '-').toLowerCase();
        if (name == hash) {
          $(this).trigger('click');
        }
      });
    }
  }

  // FAV ICON / BLACK AND WHITE VERSION
  if (!window.matchMedia) return;

  var current = $('head > link[rel="icon"][media]');
  $.each(current, function (i, icon) {
    var match = window.matchMedia(icon.media);

    function swap() {
      if (match.matches) {
        current.remove();
        current = $(icon).appendTo('head');
      }
    }
    match.addListener(swap);
    swap();
  });

  // PLACE VOTE NUMBER IN MODAL
  const epollCompletes = document.querySelectorAll('.it_epoll_survey-item');

  epollCompletes.forEach((complete) => {
    const name = complete
      .querySelector('.it_epoll_survey-name')
      .innerText.trim()
      .replace(' ', '').replace(' ', '');
    const votes = complete
      .querySelector('.it_epoll_survey-completes')
      .innerText.split('/')[0];

      console.log(name);

    let details;
    let thumbVotes;
    const item = document.querySelector(`[data-candidate-item="${name}"]`);

    if (item) {
      details = item.querySelector(`[data-candidate="${name}"]`);
      thumbVotes = item.querySelector('.thumbnail-votes');
    }

    if (details) {
      details.innerHTML = votes;
      thumbVotes.innerHTML = votes;
      thumbVotes.parentElement.style.display = 'block';
    }
  });

  // $('.it_epoll_survey-progress-labels .it_epoll_survey-completes').each(
  //   function (index) {
  //     console.log($(this).data());
  //     var itemName = $(this).data('item').trim();
  //     var itemVotes = $(this).text();
  //     $('.voting-details .votes-number[data-candidate=' + itemName + ']').html(
  //       itemVotes
  //     );
  //   }
  // );

  // OPEN CANDIDATE MODAL ON LOAD
  var hash = window.location.hash;

  if (hash) {
    $('html, body').animate(
      {
        scrollTop: $('.team-tabs').offset().top - 300,
      },
      2500
    );

    if (hash.includes('candidate-modal')) {
      var anchorSelector = $("a[href$='" + hash + "']");
      var categoryAnchor = '#' + anchorSelector.data('category');

      $(categoryAnchor).click();
      anchorSelector.click();
    } else {
      $(hash).click();
    }
  }
});

// [ SMOOTH SCROLL ERROR ON GOOGLE LIGHTHOUSE FIX ]

jQuery.event.special.touchstart = {
  setup: function (_, ns, handle) {
    if (ns.includes('noPreventDefault')) {
      this.addEventListener('touchstart', handle, { passive: false });
    } else {
      this.addEventListener('touchstart', handle, { passive: true });
    }
  },
};

window.addEventListener('load', function () {
  $('#loader').fadeOut();
  $('html').css('opacity', 1);

  $('.lazyvideo').each(function () {
    $(this).attr('src', $(this).attr('data-src'));
  });
});

document.addEventListener('DOMContentLoaded', function (event) {
  $('.videoSrc').each(function () {
    $(this).attr('src', $(this).attr('data-src'));
  });

  $('.header .menu-list > li:not(.special)')
    .on('mouseenter', function () {
      $('.header .menu-list > li').removeClass('visible');

      if ($(this).find('.sub-menu').length > 0) {
        $('.header').addClass('submenuActive');
        $(this).addClass('visible');
      } else {
        $('.header').removeClass('submenuActive');
        $(this).removeClass('visible');
      }
    })
    .on('mouseleave', function () {
      if (!$(this).hasClass('current_page_item')) {
        $(this).removeClass('visible');
        $('.header').removeClass('submenuActive');

        if ($('.menu-item-has-children.active').length > 0) {
          $('.current_page_item').addClass('visible');
          $('.header').addClass('submenuActive');
        }
      }
    });

  if ($('.menu-item-has-children.active').length > 0) {
    $('.current_page_item').addClass('visible');
    $('.header').addClass('submenuActive');
  }

  //  change html of wordpress default videos

  var changeVideoHTML = setInterval(changeHTMLofWPvideos, 1000);
  setTimeout(function () {
    clearInterval(changeVideoHTML);
  }, 10000);
});

function changeHTMLofWPvideos() {
  $('.wp-video').each(function () {
    var src = $(this).find('video').find('source').attr('src');
    if ($(this).find('.mejs-poster-img').length > 0) {
      var posterSrc = $(this).find('.mejs-poster-img').attr('src');
      $(this).empty();
      var html =
        `<div class="video169">
                <div class="thumbnail">
                    <img class="thumb" src="` +
        posterSrc +
        `" alt="video thumbnail">
                    <button class="playVideo">
                        <img src="/wp-content/uploads/2021/01/play-icon-red.svg" alt="play icon">
                    </button> 
                </div>
                <div class="video">
                    <video class="videoSrc" data-src="` +
        src +
        `" controls autoplay playsinline ></video>
                </div> 
            </div>

            `;
      $(this).append(html);
    }
  });
}

// werk tabs

$(document).on('click', '.werk-tabs .tabs ul li', function (e) {
  var ac = $(this).hasClass('active');

  if (!ac) {
    $(this).closest('.werk-tabs').find('li.active').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('for');
    $(this).closest('.werk-tabs').find('.tab-content').hide();
    $(id).fadeIn();
  }
});

// werk tabs -  dropdowns

$(document).on('click', '.werk-dropdowns .item .title', function (e) {
  var current = $(this).closest('.werk-dropdowns').find('.item.opened');

  if ($(this).parent().hasClass('opened')) {
    e.preventDefault();
  } else {
    $(current)
      .find('.answer')
      .slideUp(200, function () {
        $(current).removeClass('opened');
      });
    $(this)
      .parent()
      .find('.answer')
      .slideDown(200, function () {
        $(this).parent().addClass('opened');
      });
  }
});

$(document).on('click', '.playVideo', function (e) {
  var parent = $(this).closest('.video169');
  var videoItem = $(parent).find('.videoSrc');

  var tag = $(videoItem).prop('tagName').toLowerCase();

  if (tag == 'iframe') {
    if (!$(videoItem).attr('src')) {
      $(videoItem).attr('src', $(videoItem).attr('data-src'));
    }

    setTimeout(function () {
      $(videoItem)[0].contentWindow.postMessage(
        '{"event":"command","func":"' + 'playVideo' + '","args":""}',
        '*'
      );
    }, 1000);
  } else if (tag == 'video') {
    if (!$(videoItem).attr('src')) {
      $(videoItem).attr('src', $(videoItem).attr('data-src'));
    } else {
      $(videoItem).attr('src', $(videoItem).attr('src'));
    }

    $(videoItem).get(0).play();
  }

  $(parent).find('.thumbnail').fadeOut();
});

$(document).on('click', '.tabs-list ul li', function (e) {
  if (!$(this).hasClass('active')) {
    var div_id = $(this).attr('id');
    //window.location.hash = '#' + div_id;
    history.pushState({}, '', '#' + div_id);
    var parent = $(this).closest('.team-tabs');

    $(parent).find('li.active').removeClass('active');
    $(parent).find('.team-grid').hide();

    $('#tab-content-' + div_id)
      .css('display', 'grid')
      .hide()
      .fadeIn();
    $(this).addClass('active');
  }
});

//  custom select

$(document).on('click', ' .custom-select .selection-trigger', function (e) {
  var parent = $(this).closest('.custom-select');
  if (!$(parent).hasClass('active')) {
    $('.custom-select').removeClass('active');
    $('.vacancies-filters .item').removeClass('active');
    $(parent).addClass('active');
    $(this).closest('.item').addClass('active');
  }
});

$(document).mouseup(function (e) {
  var container = $('.custom-select');

  if (!container.is(e.target) && container.has(e.target).length === 0) {
    container.removeClass('active');
  }
});

$(window).scroll(function () {
  if ($(document).scrollTop() > 10) {
    $('.header.h_transparent').css('background', 'var(--blue)');
  } else {
    $('.header.h_transparent').css('background', 'transparent');
  }
});

//  Newsletter

function notifyNewsletterInfo(smallText, bigText) {
  $('.incl-form-box .newsletter-wrapper > p').css('opacity', 1);
  $('.incl-form-box .newsletter-wrapper > h2').css('opacity', 1);

  $('.incl-form-box .newsletter-wrapper > p').removeClass('fadeInTop');
  $('.incl-form-box .newsletter-wrapper > h2').removeClass('fadeInTop');

  $('.incl-form-box .newsletter-wrapper > p').removeAttr('data-animation');
  $('.incl-form-box .newsletter-wrapper > h2').removeAttr('data-animation');

  $('.incl-form-box .newsletter-wrapper > p').removeClass('adelay200');

  $('.incl-form-box .newsletter-wrapper > p').text(smallText);
  $('.incl-form-box .newsletter-wrapper > h2').text(bigText);

  $('.incl-form-box .newsletter-wrapper > p').addClass('jump');
  $('.incl-form-box .newsletter-wrapper > h2').addClass('jump');

  setTimeout(function () {
    $('.incl-form-box .newsletter-wrapper > p').removeClass('jump');
    $('.incl-form-box .newsletter-wrapper > h2').removeClass('jump');
  }, 300);
}

if ($('.newsletter-wrapper').length > 0) {
  var wpcf7Elm = document.querySelector('.newsletter-wrapper .wpcf7');

  wpcf7Elm.addEventListener(
    'wpcf7invalid',
    function (event) {
      $('html, body').animate(
        {
          scrollTop: $('.newsletter-wrapper').offset().top - 140,
        },
        200
      );

      setTimeout(function () {
        notifyNewsletterInfo('Oeps er gaat iets mis', 'Probeer het nogmaals');
      }, 200);
    },
    false
  );

  wpcf7Elm.addEventListener(
    'wpcf7mailsent',
    function (event) {
      $('.newsletter-wrapper').hide();
      $('.newsletter-box .thank-you-succes-form').fadeIn();
      $('html, body').animate(
        {
          scrollTop: $('.newsletter-wrapper').offset().top - 140,
        },
        200
      );
    },
    false
  );
}

// Contact Form

function notifyContactInfo(smallText, bigText) {
  $('.contact-wrapper > p').css('opacity', 1);
  $('.contact-wrapper > h2').css('opacity', 1);

  $('.contact-wrapper > p').removeClass('fadeInTop');
  $('.contact-wrapper > h2').removeClass('fadeInTop');

  $('.contact-wrapper > p').removeAttr('data-animation');
  $('.contact-wrapper > h2').removeAttr('data-animation');

  $('.contact-wrapper > p').removeClass('adelay200');

  $('.contact-wrapper > p').text(smallText);
  $('.contact-wrapper > h2').text(bigText);

  $('.contact-wrapper > p').addClass('jump');
  $('.contact-wrapper > h2').addClass('jump');

  setTimeout(function () {
    $('.contact-wrapper > p').removeClass('jump');
    $('.contact-wrapper > h2').removeClass('jump');
  }, 300);
}

if ($('.contact-wrapper').length > 0) {
  var contactForm = document.querySelector('.contact-wrapper .wpcf7');

  contactForm.addEventListener(
    'wpcf7invalid',
    function (event) {
      $('html, body').animate(
        {
          scrollTop: $('.contact-wrapper').offset().top - 140,
        },
        200
      );
      setTimeout(function () {
        notifyContactInfo('Oeps er gaat iets mis', 'Probeer het nogmaals');
      }, 200);
    },
    false
  );

  contactForm.addEventListener(
    'wpcf7mailsent',
    function (event) {
      $('.contact-wrapper').hide();
      $('.contactForm .thank-you-succes-form').fadeIn();
      $('html, body').animate(
        {
          scrollTop: $('.contact-wrapper').offset().top - 140,
        },
        200
      );
    },
    false
  );
}

// Plan een adviesgesprek FORM -

function notifyPlanFormInfo(smallText, bigText) {
  $('.plan-form-wrap > p').show();
  $('.plan-form-wrap > p').css('opacity', 1);
  $('.plan-form-wrap > h2').css('opacity', 1);

  $('.plan-form-wrap > p').removeClass('fadeInTop');
  $('.plan-form-wrap > h2').removeClass('fadeInTop');

  $('.plan-form-wrap > p').removeAttr('data-animation');
  $('.plan-form-wrap > h2').removeAttr('data-animation');

  $('.plan-form-wrap > p').removeClass('adelay200');

  $('.plan-form-wrap > p').text(smallText);
  $('.plan-form-wrap > h2').text(bigText);

  $('.plan-form-wrap > p').addClass('jump');
  $('.plan-form-wrap > h2').addClass('jump');

  setTimeout(function () {
    $('.plan-form-wrap > p').removeClass('jump');
    $('.plan-form-wrap > h2').removeClass('jump');
  }, 300);
}

if ($('.plan-form-wrap').length > 0) {
  var planForm = document.querySelector('.plan-form-wrap .wpcf7');

  planForm.addEventListener(
    'wpcf7invalid',
    function (event) {
      $('html, body').animate(
        {
          scrollTop: $('.plan-form-wrap').offset().top - 140,
        },
        200
      );
      setTimeout(function () {
        notifyPlanFormInfo('Oeps er gaat iets mis', 'Probeer het nogmaals');
      }, 200);
    },
    false
  );

  planForm.addEventListener(
    'wpcf7mailsent',
    function (event) {
      $('.plan-form-wrap').hide();
      $('.plan-form .thank-you-succes-form').fadeIn();

      $('html, body').animate(
        {
          scrollTop: $('.plan-form-wrap').offset().top - 140,
        },
        200
      );
    },
    false
  );
}

//  CUSTOM FORMS

if ($('.customform-wrapper').length > 0) {
  var wpcf7Elm = document.querySelector('.customform-wrapper .wpcf7');

  wpcf7Elm.addEventListener(
    'wpcf7mailsent',
    function (event) {
      $('.customform-wrapper').hide();
      $('.customAddedForm .thank-you-succes-form').fadeIn();
      $('html, body').animate(
        {
          scrollTop: $('.customAddedForm').offset().top - 140,
        },
        200
      );
    },
    false
  );
}

//  KANDIDATEN READ MORE OPEN POPUP
//  KANDIDATEN READ MORE OPEN POPUP
//  KANDIDATEN READ MORE OPEN POPUP

$(document).on('click', ' .kandidaten-readmore', function (e) {
  e.preventDefault();
  var parent = $(this).closest('.team-item');
  var hash = $(this).attr('href');
  history.pushState({}, '', hash);

  // get content
  var imageURL = $(parent).find('.thumbnail img').attr('data-src');
  var videoFile = $(parent).find('.video-regular').html();
  var videoBlock = $(parent).find('.video169').html();
  var socials = $(parent).find('.kand-socials').html();
  var content = $(parent).find('.kand-description').html();
  var candidateName = $(parent).find('.voting-details h2').text();
  var name = $(parent).find('.info h4').text();
  var catNameField = $(parent).find('.voting-details .cat-name-field').text();
  var catName = $(parent).find('.voting-details .cat-name').text();
  var votes = $(parent).find('.voting-details .votes').text();
  var votesNumber = $(parent).find('.voting-details .votes-number').text();
  var voteBtnText = $(parent).find('.button-vote').html();

  // set content
  $('.kandidaten-box-content .image img').attr('src', imageURL);
  $('.kandidaten-box-content .video-regular').html(videoFile);
  $('.kandidaten-box-content .video169').html(videoBlock);
  $('.kandidaten-box-content .kand-socials').html(socials);
  $('.kandidaten-box-content .kand-description').html(content);
  $('.kandidaten-box-content .cnt .small-red ').text(candidateName);
  $('.kandidaten-box-content .cnt .mb16 ').text(name);
  $('.kandidaten-box-content .cnt .small-red.cat ').text(catNameField);
  $('.kandidaten-box-content .cnt .cat-name ').text(catName);
  $('.kandidaten-box-content .cnt .small-red.votes ').text(votes);
  $('.kandidaten-box-content .cnt .votes-number ').text(votesNumber);
  $('.kandidaten-box-content .cnt .vote-button').html(voteBtnText);

  // show popup
  $('.kandidate-popup').fadeIn();
});

$(document).on('click', ' .close-kand-pop', function (e) {
  $('.kandidate-popup').fadeOut();
});

// EVENT SINGLE - SPONSORS SLIDER
// EVENT SINGLE - SPONSORS SLIDER
// EVENT SINGLE - SPONSORS SLIDER

var sponsors_swiper = new Swiper('.sponsors-carousel', {
  loop: true,
  loopedSlides: 6,
  autoplay: {
    delay: 2100,
  },

  breakpoints: {
    0: {
      slidesPerView: 2.5,
      spaceBetween: 10,
    },
    580: {
      width: 196,
      spaceBetween: 32,
    },
  },
});

$(document).on(
  'click',
  ' .sponsors-carousel-arrows i.fa-chevron-left',
  function (e) {
    sponsors_swiper.slidePrev();
  }
);

$(document).on(
  'click',
  ' .sponsors-carousel-arrows i.fa-chevron-right',
  function (e) {
    sponsors_swiper.slideNext();
  }
);

sponsors_swiper.on('slideChange', function () {
  setTimeout(function () {
    $('.swiper-slide.swiper-slide-active .logo').trigger('click');
  }, 100);
});

$(document).on('click', ' .sponsors-slider .logo', function (e) {
  var parent = $(this).closest('.swiper-slide');

  $('.currentSponsor').removeClass('currentSponsor');
  $(parent).addClass('currentSponsor');

  var content = $(parent).find('.content').html();
  $('.sponsor-content').html(content);
});

$('.sponsors-slider .currentSponsor .logo').trigger('click');

//  PLAN EEN FORM - DATE TRIGGER

$(document).on('click', '.dateandtimeTrigger', function (event) {
  $('.dateTrigger').hide();
  $(this).val('Time is selected');
  $('.dateandtime').show();
  $('.dateTime').show();

  setTimeout(function () {
    $('.dateandtime').click();
    $('.dateandtime').focus();
  }, 100);
});

// EVENT SINGLE PAY TICKETS

$(document).on('click', '#buyTickets', function (event) {
  event.preventDefault();
  $('#ticket-payform').fadeIn();
});

$(document).on('click', '.close-event-pay-pop', function (event) {
  $('#ticket-payform').fadeOut();
});

// success payment close popup
$(document).on('click', '.close-pay-success', function (event) {
  $('.payment-successfull').fadeOut();
});

//  SCROLL ON ANCOR CLICK WITH HASH

$(document).on(
  'click',
  'a[href^="#"]:not(.kandidaten-readmore)',
  function (event) {
    event.preventDefault();

    $('html, body').animate(
      {
        scrollTop: $($.attr(this, 'href')).offset().top - 120,
      },
      500
    );
  }
);

//  SCROLL ON ANCOR CLICK WITH HASH

var swiper = new Swiper('.homepage-partners-slider', {
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    600: {
      slidesPerView: 4,
      spaceBetween: 30,
    },
    1000: {
      slidesPerView: 5,
      spaceBetween: 40,
    },

    1400: {
      slidesPerView: 7,
      spaceBetween: 40,
    },
  },
});

//  TRANSLATE ALERT FORM

$('.page-template-page-vacancies-alertform label.cx2_personal-firstName').text(
  'Voornaam'
);
$('.page-template-page-vacancies-alertform label.cx2_personal-lastName').text(
  'Achternaam'
);
$('.page-template-page-vacancies-alertform label.cx2_contact-email').text(
  'E-mail adres'
);
$(
  '.page-template-page-vacancies-alertform label.cx2_contact-mobileNumber'
).text('Telefoonnummer');
$(
  '.page-template-page-vacancies-alertform label.cx2_wishes-desiredFunction1'
).text('Gewenste werkveld');
$(
  '.page-template-page-vacancies-alertform label.cx2_wishes-desiredFunction2'
).text('Gewenste werkveld');
$(
  '.page-template-page-vacancies-alertform label.cx2_wishes-desiredFunction3'
).text('Gewenste werkveld');
$('.page-template-page-vacancies-alertform label.cx2_education-education').text(
  'Opleidingsniveau'
);
$('.page-template-page-vacancies-alertform label.cx2_personal-cv').text(
  'CV als bijlage'
);

$('.page-template-page-vacancies-alertform #apply_button').val(
  'Stuur mij de Job Alert'
);

$(
  '.page-template-page-vacancies-alertform .cx2_motivationAndSource-sourceOther'
).val('GP Job Alert');

$('.page-template-page-vacancies-alertform #apply_button').on(
  'mouseenter',
  function () {
    $(
      '.page-template-page-vacancies-alertform .cx2_motivationAndSource-sourceOther'
    ).val('GP Job Alert');
  }
);

/*voting*/

/*$( ".it_epoll_survey-completes" ).val();*/
