(function($) {
  'use strict';


  $(document).foundation();

  var $contact_forms = $('form.blahlab_contact_form');

  for (var i = 0; i < $contact_forms.length; i++) {

    $($contact_forms[i]).validate({
      messages: { },
      submitHandler: function(form) {
        $.ajax({
          type: 'POST',
          url: ajaxurl,
          data: $(form).serialize(),
          success: function(data) {
            if(data.match(/success/)) {
              $(form).trigger('reset');
              $(form).find('p.thanks').removeClass('hide').show().fadeOut(5000);
            }
          }
        });
        return false;
      }
    });

  }

  var videos = $('video');

  var resizeId;

  $('#menu-controller').on('click', function() {

    var wrapper = $(this).closest('#menu-wrapper');

    if ( $(wrapper).hasClass('open-menu') ) {
      $("#menu-wrapper").removeClass('open-menu').addClass('close-menu');
    } else {
      $("#menu-wrapper").removeClass('close-menu').addClass('open-menu');
    }

  });

$(window).resize(function () {
ktSetColumnsHeight();
});
  $(document).ready(function() {
    $('.red, .purple, .orange').each(function() {

      $(this).appear();

      $(this).on('appear', function() {
        $(this).addClass('appear');

      });

      $(this).on('disappear', function() {
        $(this).removeClass('appear');

      });

    });
	  ktSetColumnsHeight();
  });
	function ktSetColumnsHeight(){
		$('.case-table .case-video, .case-table .case-image').css('min-height',($(window).outerHeight() - ($('#wpadminbar').length ? $('#wpadminbar').outerHeight() : 0) ) /2 );
	}


  // for white-board
  // https://jonsuh.com/blog/detect-the-end-of-css-animations-and-transitions-with-javascript/
  // Function from David Walsh: http://davidwalsh.name/css-animation-callback
  function whichTransitionEndEvent(){
    var t,
        el = document.createElement("fakeelement");

    var transitions = {
      "transition"      : "transitionend",
      "OTransition"     : "oTransitionEnd",
      "MozTransition"   : "transitionend",
      "WebkitTransition": "webkitTransitionEnd"
    }

    for (t in transitions){
      if (el.style[t] !== undefined){
        return transitions[t];
      }
    }
  }

  function whichAnimationEndEvent(){
    var t,
        el = document.createElement("fakeelement");

    var transitions = {
      "transition"      : "animationend",
      "OTransition"     : "oAnimationEnd",
      "MozTransition"   : "animationend",
      "WebkitTransition": "webkitAnimationEnd"
    }

    for (t in transitions){
      if (el.style[t] !== undefined){
        return transitions[t];
      }
    }
  }

  var transitionEndEvent = whichTransitionEndEvent();
  var animationEndEvent = whichAnimationEndEvent();


  function swiperInit() {
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 0,
      centeredSlides: true,
      autoplay: false,
      mousewheel: true,
      speed: 0,
      reverseDirection: true,
      effect:'fade',
      direction: 'vertical',
      hashNavigation: {
        replaceState: false
      },
      on: {
        init: function() {

          var swiper = this;

          setTimeout(function() {
            swiper.$el.addClass('initd');
          }, 100);

        },
        slideChange: function() {

          if (this.activeIndex == 0) {
            this.$el.removeClass('greater-than-one');
          } else {
            this.$el.addClass('greater-than-one');
          }

          setTimeout(function() {
            // update the browser history state to work with smoothState.js
            if(window.history.state === null && window.smoothState) {
              // the 'main' is the id of the smoothState element
              var state = { id: 'main' };

              /** Update history entry */
              window.history.replaceState(state, document.title, window.location.href);
            }
          }, 100)

        },
        slideNextTransitionStart: function() {

          this.mousewheel.disable();
          $('#white-board').addClass('playact');
        },
        slideNextTransitionEnd: function() {

        },
        slidePrevTransitionStart: function() {

          this.mousewheel.disable();
          $('#white-board-reverse').addClass('playact');
        },
        slidePrevTransitionEnd: function() {

        }
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
        renderBullet: function(index, className) {
          return '<span class="' + className + '"><strong>' + $(this.slides[index]).data('title') + '</strong></span>';
        }
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        800: {

        }
      }


    });


    $('#white-board').on(animationEndEvent, function() {
      $(this).removeClass('playact');

      swiper.mousewheel.enable();
    });


    $('#white-board-reverse').on(animationEndEvent, function() {
      $(this).removeClass('playact');

      swiper.mousewheel.enable();
    });

    window.swiper = swiper;
  }

  swiperInit();

  var smoothStateOptions = {
    debug: true,
    onAfter: function($container, $newContent) {
      swiperInit();
    },
    onStart: {
      duration: 1000, // Duration of our animation
      render: function ($container) {
        // Restart your animation
        $('#main').data('smoothState').restartCSSAnimations();
      }
    },
    onReady: {
      duration: 0,
      render: function ($container, $newContent) {
        // Inject the new content
        $container.html($newContent);
      }
    }
  };

  if ( window.WOW ) {
    new WOW().init();
  }
  

})(jQuery);
