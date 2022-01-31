var $ = jQuery.noConflict();
jQuery(document).ready(function() {
  // single function
  initHeader();
  initCustomForms();
  initAnchor();

  // isElementExist helper
  isElementExist(".img-a", anImgRightOnScrollVewportChecker);
  isElementExist(".img-a-left", anImgLeftOnScrollVewportChecker);
  isElementExist(".img-a-up", anImgUpOnScrollVewportChecker);
  isElementExist(".img-a-video", anImgRightOnScrollVewportCheckerAndVideo);
  isElementExist(".scroll-link", myScrollLink);
  isElementExist(".a-bg-up", blockHeight, [".a-bg-up"]);
  isElementExist(".a-bg-down", blockHeight, [".a-bg-down"]);
  isElementExist(".slides", slickSliderInit);
  isElementExist(".tab", initTab);
  isElementExist(".post-slider", initPostSlider);
  isElementExist(".menus-hours", initMenusHours);
  isElementExist(".media-content-accordion", initMediaContentAccordion);
  isElementExist(".media-content-tab", initMediaContentTab);
  isElementExist(".culinary-module", initCulinaryModule);
  isElementExist(".rooms-carousel", initRoomsCarousel);
  isElementExist(".rooms-module", initRoomsModule);
  isElementExist(".people-slider", initPeopleSlider);
  isElementExist(".booking-popup", initBookingPopup);
  isElementExist("#sbi_images", initInstagramSlider);
  isElementExist(".offers-module", initOffersModule);
  isElementExist(".gallery-hero", initGalleryHero);
  isElementExist('.booking-calendar', initBookingCalendar);
  isElementExist('.three-cards', initThreeCards);
  isElementExist('.culinary-detail', initCulinaryDetail);
  isElementExist('.culinary-form', initCulinaryForm);
  isElementExist('.popup-block', initPopup);
  isElementExist('.amentities-images', initAmentities);
  isElementExist('.journal-slider__slides', initJournalSlider);
  isElementExist('.home-map', initHomeMap);
  isElementExist('.neighborhood-map', initNeighborhood);
  isElementExist('.offers-grid', initOffersGrid);
  isElementExist('.venues-module', initVenuesModule);
  isElementExist('.gallery-grid', initGalleryGrid);
  isElementExist('.two-columns-alt', initTwoColumnsAlt);
  isElementExist('.amentities .popup-block', initAmentitiesPopup);
  isElementExist('.about-block', initAbout);
  isElementExist('.media-content.has-slider', initMediaContentSlider);

  
  // viewportCheckerAnimate function
  viewportCheckerAnimate(".a-bg-up", "_animate");
  viewportCheckerAnimate(".a-bg-down", "_animate");
  viewportCheckerAnimate(".a-up", "fadeInUp", true);
  viewportCheckerAnimate(".a-down", "fadeInDown");
  viewportCheckerAnimate(".a-down-full", "downFull");
  viewportCheckerAnimate(".a-up-full", "upFull");
  viewportCheckerAnimate(".a-up-nested > *:not([class*='img-a'])", "fadeInUp");
  viewportCheckerAnimate(".a-left", "fadeInLeft");
  viewportCheckerAnimate(".a-right", "fadeInRight");
  viewportCheckerAnimate(".a-op", "fade");
  viewportCheckerAnimate(".a-b-up", "beforeHeightUp");

  $(document).on("click", ".img-a-img picture", function() {
    $(this).parent().addClass("active");
    $(this).siblings().find("video").get(0).play();
    return false;
  });

  // Video play
  $(".btn-audio").on("click", function() {
    let $parent = $(this).closest("section");
    $(this).toggleClass("mute");
    $("video", $parent).prop("muted", !$("video", $parent).prop("muted"));
  });

  // Toggle Accordion
  $(".accordion-title").on("click", function() {
    let $accordion = $(this).closest(".accordion");
    $(this).toggleClass("active");
    $(".accordion-content", $accordion).slideToggle();
  });

  // Close Cookie
  $('.cli-bar-close').on('click', function() {
    $('#cookie-law-info-bar').fadeOut(300);
  });

  const validateEmail = (email) => {
    return String(email)
      .toLowerCase()
      .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
  };

  $('.newsletter-form').on('submit', function(e) {
    let email = $('#newsletter_email').val();
    $('.newsletter-form__wrapper .newsletter-form__notification').remove();
    if( email && validateEmail(email) ) {
      $('.newsletter-form__wrapper').removeClass('invalid');
      $.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
          action: "newsletterSignup",
          email
        },
        success: function(res) {
          let json = $.parseJSON(res);
          if( json.success ) {
            $('.newsletter-form__wrapper').append('<span class="newsletter-form__notification success">' + json.message + '</span>');
          } else {
            $('.newsletter-form__wrapper').append('<span class="newsletter-form__notification error">' + json.message + '</span>');
          }
        },
        complete: function() {
  
        },
        error : function (xhr, ajaxOptions, thrownError){  
          console.log(xhr.status);          
          console.log(thrownError);
        } 
      });
    } else {
      $('.newsletter-form__wrapper').addClass('invalid');
      if( !email ) {
        $('.newsletter-form__wrapper').append('<span class="newsletter-form__notification error">This field is required.</span>');
      } else if( !validateEmail(email) ) {
        $('.newsletter-form__wrapper').append('<span class="newsletter-form__notification error">Please enter correct email address.</span>');
      }
    }
    e.preventDefault();
    return false;
  });

  // Show Venues Popup
  $(document).on('click', '.venues-modal__btn', function(e) {
    let id = $(this).attr('data-id');
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "venuesPopup",
        id
      },
      success: function( res ) {
        let json = $.parseJSON(res);
        $('body').append(json.output);
      },
      complete: function() {
        $('.popup-block__slide img').lazyload();
        $('.popup-block__slides').slick({
          arrows: false,
          dots: true,
          autoplay: true,
          autoplaySpeed: 3000
        });
        $('.popup-block').fadeIn(300);
        $('html, body').css('overflow', 'hidden');
        $('.popup-block__slides').slick('setPosition');
      },
      error : function (xhr, ajaxOptions, thrownError){  
        console.log(xhr.status);          
        console.log(thrownError);
      } 
    })
    return false;
  });

  $(document).on('click', '#venues-popup .popup-block__close', function() {
    $('#venues-popup').fadeOut(300, function() {
      $(this).remove();
      $('html, body').removeAttr('style');
    });
    return false;
  });



  $('.link-select').on('change', function() {
    window.location.href = $(this).val();
  })


  // Init fancybox
  Fancybox.bind('[data-fancybox]', {
    Toolbar: {
      display: [
        "close",
      ],
    },
    Image: {
      zoom: false,
      maxScale: 1,
      click: null,
      wheel: null
    }
  });
  Fancybox.defaults.Image = {
    zoom: false
  };
  Fancybox.defaults.Hash = false;
  
  // Init Lazyload
  lazyload();
});

//-------- -------- -------- --------
//-------- js custom start
//-------- -------- -------- --------

// register ScrollTrigger Plugin for gsap
// gsap.registerPlugin(ScrollTrigger);
// for debug gsap + ScrollTrigger
// ScrollTrigger.defaults({markers: true});


function ajaxLocations(id, lat, lng) {
  let $walking = $('#tab-walking__list');
  let $driving = $('#tab-driving__list');
  let $postsWrapper = $('.home-map__posts');
  let $posts = $('.home-map__posts--grid');
  $.ajax({
    url: ajaxurl,
    type: "POST",
    data: {
      action: "loadAjaxLocations",
      id,
      lat,
      lng
    },
    beforeSend: function() {
      
    },
    success: function(res) {
      let json = $.parseJSON(res);
      $walking.html(json.neighborhood_walking);
      $driving.html(json.neighborhood_drive);
      if( json.neighborhood_posts ) {
        $posts.html(json.neighborhood_posts);
        $postsWrapper.show();
      } else {
        $postsWrapper.hide();
      }
    },  
    complete: function() {
    }
  })
}

function initMap( $el ) {
  var style = [
      {
          "featureType": "all",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "weight": "2.00"
              }
          ]
      },
      {
          "featureType": "all",
          "elementType": "geometry.stroke",
          "stylers": [
              {
                  "color": "#9c9c9c"
              }
          ]
      },
      {
          "featureType": "all",
          "elementType": "labels.text",
          "stylers": [
              {
                  "visibility": "on"
              }
          ]
      },
      {
          "featureType": "landscape",
          "elementType": "all",
          "stylers": [
              {
                  "color": "#f2f2f2"
              }
          ]
      },
      {
          "featureType": "landscape",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "color": "#ffffff"
              }
          ]
      },
      {
          "featureType": "landscape.man_made",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "color": "#ffffff"
              }
          ]
      },
      {
          "featureType": "poi",
          "elementType": "all",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "all",
          "stylers": [
              {
                  "saturation": -100
              },
              {
                  "lightness": 45
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "color": "#eeeeee"
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "labels.text.fill",
          "stylers": [
              {
                  "color": "#7b7b7b"
              }
          ]
      },
      {
          "featureType": "road",
          "elementType": "labels.text.stroke",
          "stylers": [
              {
                  "color": "#ffffff"
              }
          ]
      },
      {
          "featureType": "road.highway",
          "elementType": "all",
          "stylers": [
              {
                  "visibility": "simplified"
              }
          ]
      },
      {
          "featureType": "road.arterial",
          "elementType": "labels.icon",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "transit",
          "elementType": "all",
          "stylers": [
              {
                  "visibility": "off"
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "all",
          "stylers": [
              {
                  "color": "#46bcec"
              },
              {
                  "visibility": "on"
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "geometry.fill",
          "stylers": [
              {
                  "color": "#c8d7d4"
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "labels.text.fill",
          "stylers": [
              {
                  "color": "#070707"
              }
          ]
      },
      {
          "featureType": "water",
          "elementType": "labels.text.stroke",
          "stylers": [
              {
                  "color": "#ffffff"
              }
          ]
      }
  ];
  // Find marker elements within map.
  var $markers = $el.find('.marker');
  // Create gerenic map.
  var mapArgs = {
      zoom        : parseInt($el.attr('data-zoom')) || 16,
      mapTypeId   : google.maps.MapTypeId.ROADMAP,
      disableDoubleClickZoom: false,
      fullscreenControl: false,
      streetViewControl: false,
      mapTypeControl: false,
      scrollwheel : false,
      styles: style,
  };
  var map = new google.maps.Map( $el[0], mapArgs );

  // Add markers.
  map.markers = [];
  $markers.each(function(){
      initMarker( $(this), map );
  });

  // Center map based on markers.
  centerMap( map );

  // Return map instance.
  return map;
}

function initMarker( $marker, map ) {

  // Get position from marker.
  var lat = $marker.attr('data-lat');
  var lng = $marker.attr('data-lng');
  var latLng = {
      lat: parseFloat( lat ),
      lng: parseFloat( lng )
  };

  // Create marker instance.
  var icon;
  if( $marker.attr('data-icon') ) {
    icon = $marker.attr('data-icon');
  } else {
    let svg = '<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="black"/></svg>';
    icon = 'data:image/svg+xml;charset=UTF-8;base64,' + btoa(svg);
  }
  var marker = new google.maps.Marker({
      position : latLng,
      map: map,
      icon: {
        url: icon
      }
  });

  // Append to reference for later use.
  map.markers.push( marker );

  // If marker contains HTML, add it to an infoWindow.
  if( $marker.html() ){

      // Create info window.
      var infowindow = new google.maps.InfoWindow({
          content: $marker.html()
      });

      // Show info window when marker is clicked.
      google.maps.event.addListener(marker, 'click', function() {
          infowindow.open( map, marker );
      });
  }
  
  google.maps.event.addListener(marker, 'click', function() {
    map.setCenter(marker.getPosition());
    let id = $marker.attr('data-id');
    if( id ) {
      ajaxLocations(id, lat, lng);
    }
  });
}

function centerMap( map ) {

  // Create map boundaries from all map markers.
  var bounds = new google.maps.LatLngBounds();
  map.markers.forEach(function( marker ){
      bounds.extend({
          lat: marker.position.lat(),
          lng: marker.position.lng()
      });
  });

  // Case: Single marker.
  if( map.markers.length == 1 ){
      map.setCenter( bounds.getCenter() );

  // Case: Multiple markers.
  } else{
      map.fitBounds( bounds );
  }
}


// Helper if element exist then call function
function isElementExist(_el, _cb, _argCb) {
  var elem = document.querySelector(_el);
  if (document.body.contains(elem)) {
    try {
      if (arguments.length <= 2) {
        _cb();
      } else {
        _cb(..._argCb);
      }
    } catch (e) {
      console.log(e);
    }
  }
}

function initHeader() {
  let $secondaryNav = $('.secondary-nav');
  if ( $secondaryNav.length ) 
    var secondaryNavOffset = $secondaryNav.offset().top;
  // Sticky Header
  $(window).scroll(function() {
    if ($(window).scrollTop() >= 50) $(".header").addClass("sticky");
    else $(".header").removeClass("sticky");
    // Add Secondary nav
    if( $('.secondary-nav').length ) {
      if ($(window).scrollTop() >= secondaryNavOffset ) {
        $('.secondary-nav').addClass('secondary-nav--fixed');
      } else {
        $('.secondary-nav').removeClass('secondary-nav--fixed');
      }
    }
  });
  // Toggle Menu
  $(".hamburger, .hamburger-close").on("click", function() {
    $(".header").toggleClass("header--open");
    if ($(".header").hasClass("header--open")) {
      $("html, body").css("overflow", "hidden");
    } else {
      $("html, body").removeAttr("style");
    }
  });
  $(".dropdown-toggle .arrow").on("click", function(e) {
    let $dropdown = $(this).closest(".dropdown");
    $('.dropdown-toggle', $dropdown).toggleClass("dropdown--open");
    $(".dropdown-menu", $dropdown).slideToggle();
    e.stopPropagation();
    e.preventDefault();
  });
  $('.secondary-nav__select').on('change', function() {
    let val = $(this).val();
    $('html, body').animate({
      scrollTop: $(val).offset().top - $('.header').outerHeight() - $('.secondary-nav').outerHeight() - 50
    }, 500);
  });
  // Close popup
  $(document).on('click', '.popup-close', function() {
    $('.popup').fadeOut(300);
  });
}

function initAnchor() {
  $(".arrow-bottom").click(function(event) {
    $("html, body").animate({
        scrollTop: $($.attr(this, "href")).offset().top,
      },
      500
    );
    event.preventDefault();
  });
}

// initialize custom form elements (checkbox, radio, select) https://github.com/w3co/jcf
// initialize jquery datepicker
function initCustomForms() {
  jcf.setOptions("Select", {
    maxVisibleItems: 4, // visible dropdown items before scroll appear
    wrapNative: false,
    fakeDropInBody: false,
  });
  jcf.replaceAll();
  $('.form-date').attr('readonly', 'readonly');
  $(".form-date").datepicker({
    format: "yyyy-MM-DD",
  }).on('change', function() {
    $(this).datepicker('hide');
    updateBookingLink();
  });

}

function updateBookingLink() {
  let defaulthref = 'https://reservations.bostonharborhotel.com/?Hotel=26834&shell=rBOSHA&chain=10237&template=rBOSHA';
  let suitehref = 'https://reservations.bostonharborhotel.com/?Hotel=26834&shell=rBOSHA&chain=10237&template=rBOSHA&rooms=1&room=CVS,HVS,HCT,ADM,GRN,SPS,PRS';
  let href = defaulthref;
  let date = $('#booking-popup__calendar--range').val();
  let check_in = $("#booking_check_in").val();
  let check_out = $("#booking_check_out").val();
  let adult = $("#booking_adult_number").val();
  let kid = $('#booking_kids_number').val();
  let promo = $('#booking_promo').val();
  if($('#booking_suites_only').prop('checked')) {
    href = suitehref;
  }
  if( window.matchMedia("(max-width: 768px)").matches ) {
    if (check_in) {
      href += "&arrive=" + check_in;
    }
    if (check_out) {
      href += "&depart=" + check_out;
    }
  } else {
    if (date) {
      let dateArr = date.split(' to ');
      if( dateArr[0] ) href += '&arrive=' + dateArr[0];
      if( dateArr[1] ) href += '&depart=' + dateArr[1];
    }
  }
  if (adult) {
    href += "&adult=" + adult;
  }
  if (kid > 0) {
    href += "&child=" + kid;
  }
  if (promo) {
    href += '&promo=' + promo;
  }
  $("#booking_submit").attr("href", href);
}

// Init Booking Popup
function initBookingPopup() {
  $('#booking-popup__calendar--range').dateRangePicker({
    inline:true,
    container: '#booking-popup__calendar--calendar',
    alwaysOpen:true,
    showShortcuts: false,
    showTopbar: false
  }).bind('datepicker-change', function(event, obj) {
    updateBookingLink();
  });
  $('.btn-modal').on('click', function() {
    $('html, body').css('overflow', 'hidden');
    $('.header').addClass('header--booking');
    $('.booking-popup').fadeIn(300);
    if($(this).hasClass('header-cta--mobile')) {
      $(this).hide();
      $('.header').removeClass('header--open');
    }
    return false;
  });
  $('.booking-popup__close, #booking_cancel').on('click', function() {
    $('html, body').removeAttr('style');
    $('.header').removeClass('header--booking');
    if($(this).hasClass('header-cta--mobile')) {
      $(this).show();
    }
    $('.booking-popup').fadeOut(300);
  });
  $("#booking_adult_number, #booking_kids_number").on("change", function () {
    updateBookingLink();
  });
  $('#booking_promo').on('change', function() {
    if( $(this).val() ) updateBookingLink();
  });
  $('#booking_suites_only').on('change', function() {
    updateBookingLink();
  });
}

// Init instagram slider
function initInstagramSlider() {
  $('#sbi_images').slick({
    arrows: false,
    dots: false,
    slidesToShow: 4,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
      }
    }, {
      breakpoint: 576,
      settings: {
        slidesToShow: 1
      }
    }]
  })
}

// Initialize Tab
function initTab() {
  $(".tab-link").on("click", function() {
    if ($(this).hasClass("active")) return;
    let target = $(this).attr("href");
    let $tab = $(this).closest(".tab");
    $(".tab-content.active", $tab).removeClass("active");
    $(".tab-link.active", $tab).removeClass("active");
    $(this).addClass("active");
    $(target).addClass("active");
    var $slider = $(".slides", $(target));
    if ($slider.length) $slider.slick("setPosition");
    return false;
  });
  $('.tab-select').on('change', function() {
    let target = $(this).val();
    let $tab = $(this).closest(".tab");
    $(".tab-content.active", $tab).removeClass("active");
    $(".tab-link.active", $tab).removeClass("active");
    $(target).addClass("active");
    var $slider = $(".slides", $(target));
    if ($slider.length) $slider.slick("setPosition");
  });
}

// Initialize Rooms Carousel
function initRoomsCarousel() {
  // Initialize rooms big carousel
  $('.rooms-carousel__slides').slick({
    dots: false,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 600,
    responsive: [{
      breakpoint: 769,
      settings: {
        dots: true,
        arrows: false,
      }
    }]
  });
}

// Initialize rooms module
function initRoomsModule() {
  $('.rooms-module__slides').slick({
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '.rooms-module__slides--buttons',
    responsive: [{
      breakpoint: 769,
      settings: {
        dots: true,
        arrows: false
      }
    }]
  }).on('afterChange', function(event, slick, currentSlide, nextSlide) {
    $('.rooms-module__link.active').removeClass('active');
    $('.rooms-module__link').eq(currentSlide).addClass('active');
  });
  $('.rooms-module__slides--buttons').slick({
    dots: false,
    arrows: false,
    fade: true,
    asNavFor: '.rooms-module__slides'
  });
  $('.rooms-module__link').on('click', function() {
    let id = $(this).index();
    $('.rooms-module__slides').slick('slickGoTo', id);
    return false; 
  });
}

// Initialize Post Slider
function initPostSlider() {
  $(".post-slides__images").slick({
    dots: true,
    arrows: false,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 5000,
    asNavFor: ".post-slides__contents",
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: true,
        dots: false,
      },
    }, ],
  });
  $(".post-slides__contents").slick({
    dots: false,
    arrows: false,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 5000,
    asNavFor: ".post-slides__images",
  });
}

// Initialize Menus and Hours
function initMenusHours() {
  $(".menus-hours__col--title").on("click", function() {
    let $parent = $(this).closest(".menus-hours__col");
    let $content = $(".menus-hours__col--content", $parent);
    if (window.matchMedia("(max-width: 768px)").matches) {
      $content.slideToggle();
      $parent.toggleClass("open");
    }
  });
}

// Init Media
function initMediaContentAccordion() {
  $(".media-content__accordion--heading").on("click", function() {
    let $accordions = $(this).closest(".media-content__accordions");
    let $parent = $(this).closest(".media-content__accordion");
    let $oldActive = $(".media-content__accordion.open", $accordions);
    $parent.toggleClass("open");
    $(".media-content__accordion--content", $parent).slideToggle();
    if ($parent.hasClass("open") && $oldActive.length) {
      $oldActive.removeClass("open");
      $(".media-content__accordion--content", $oldActive).slideToggle();
    }
  });
}

// Init culinary module
function initCulinaryModule() {
  let $slider = $(".culinary-module__slider");
  if ($slider.length) {
    $slider.slick({
      arrows: true,
      dots: false,
      autoplay: true,
      autoplaySpeed: 5000,
      slidesToShow: 3,
      prevArrow: `<button class="slick-arrow slick-prev"><svg width="49" height="11" viewBox="0 0 49 11" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 6L49 6" stroke="#191919" stroke-width="2"/>
      <path d="M44.1699 10.6788C44.3824 9.52314 44.9222 8.45281 45.7252 7.59495C46.5281 6.73708 47.5604 6.12775 48.6995 5.83936" stroke="#191919" stroke-width="2"/>
      <path d="M44.1699 1C44.3827 2.1555 44.9226 3.22566 45.7255 4.08347C46.5284 4.94128 47.5606 5.55072 48.6995 5.83941" stroke="#191919" stroke-width="2"/>
      </svg></button>`,
      nextArrow: `<button class="slick-arrow slick-next"><svg width="49" height="11" viewBox="0 0 49 11" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 6L49 6" stroke="#191919" stroke-width="2"/>
      <path d="M44.1699 10.6788C44.3824 9.52314 44.9222 8.45281 45.7252 7.59495C46.5281 6.73708 47.5604 6.12775 48.6995 5.83936" stroke="#191919" stroke-width="2"/>
      <path d="M44.1699 1C44.3827 2.1555 44.9226 3.22566 45.7255 4.08347C46.5284 4.94128 47.5606 5.55072 48.6995 5.83941" stroke="#191919" stroke-width="2"/>
      </svg></button>`,
      responsive: [{
        breakpoint: 769,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1,
          variableWidth: false,
          centerMode: true,
          centerPadding: '30px'
        },
      }, ],
    });
  }
  $(".culinary-module__filter").on("click", function() {
    let filter = $(this).attr("data-filter");
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      if ($slider.length) $slider.slick("slickUnfilter");
    } else {
      $(".culinary-module__filter.active").removeClass("active");
      $(this).addClass("active");
      if ($slider.length) {
        $slider.slick("slickUnfilter").slick("slickFilter", filter);
        let image = $(this).attr("data-image");
        $(".culinary-module__bg").css("background-image", `url("${image}")`);
      }
    }
    if ($slider.length == 0) {
      $(`.loop-culinary:not(${filter})`).fadeOut();
      $(`.loop-culinary${filter}`).fadeIn();
      $('.loop-culinary.all-day').fadeIn();
    }
    return false;
  });
  $(".culinary-module__select").on("change", function() {
    let filter = $(this).val();
    if( $slider.length ) {
      if (filter) {
        $slider.slick("slickUnfilter").slick("slickFilter", filter);
      } else {
        $slider.slick("slickUnfilter");
      }
    } else {
      $(`.loop-culinary:not(${filter})`).fadeOut();
      $(`.loop-culinary${filter}`).fadeIn();
      $('.loop-culinary.all-day').fadeIn();
    }
  });
}

// Init Offers module
function initOffersModule() {
  let $slider = $('.offers-module__grid');
  if (window.matchMedia('(max-width: 768px)').matches) {
    if (!$slider.hasClass("slick-initialized")) {
      $slider.slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        centerMode: true,
        centerPadding: '30px',
      });
    }
  } else {
    if ($slider.hasClass("slick-initialized")) {
      $slider.slick('unslick');
    }
  }
  windowResize(initOffersModule);
}

// Init Gallery Hero
function initGalleryHero() {
  let $carousel = $('.gallery-hero__images')
  if (window.matchMedia("(max-width: 768px)").matches) {
    if(!$carousel.hasClass('slick-initialized')) {
      $carousel.slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 600
      });
    }
  } else {
    if($carousel.hasClass('slick-initialized')) {
      $carousel.slick('unslick');
    }
  }
  windowResize(initGalleryHero);
}

// Init Booking Calendar
function initBookingCalendar() {
  $('#booking-range').dateRangePicker({
    inline:true,
    format: 'YYYY-MM-DD',
    container: '#booking-calendar',
    alwaysOpen:true,
    singleMonth: true,
    showShortcuts: false,
    showTopbar: false
  }).bind('datepicker-change', function(event, obj) {
    let href = $('.btn-check-availability').attr('href');
    let date = obj.value;
    if (date) {
      let dateArr = date.split(' to ');
      if( dateArr[0] ) href += '&arrive=' + dateArr[0];
      if( dateArr[1] ) href += '&depart=' + dateArr[1];
    }
    $('.btn-check-availability').attr('href', href);
  });
}

// Init Three Cards
function initThreeCards() {
  let $carousel = $('.three-cards__inner')
  if (window.matchMedia("(max-width: 768px)").matches) {
    if(!$carousel.hasClass('slick-initialized')) {
      $carousel.slick({
        arrows: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 600,
        centerMode: true,
        centerPadding: '30px'
      });
    }
  } else {
    if($carousel.hasClass('slick-initialized')) {
      $carousel.slick('unslick');
    }
  }
  windowResize(initThreeCards);
}

// initialize culinary detail
function initCulinaryDetail() {
  $('.culinary-detail__images').slick({
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 5000,
  });
}

// initialize culinary form
function initCulinaryForm() {
  $('.culinary-form__slides').slick({
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 5000,
  });
}

function initPopup() {
  // setTimeout(() => {
  //   $('.popup-block').fadeIn(300);
  //   $('html, body').css('overflow', 'hidden');
  //   $('.popup-block__slides').slick('setPosition');
  // }, 3000);
  $('.popup-block__slides').slick({
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 5000
  });
  $('.popup-block__close').on('click', function() {
    let $parent = $(this).parent('.popup-block');
    $parent.fadeOut(300);
    $('html, body').removeAttr('style');
  });
}

// function initAmentities
function initAmentities() {
  if( $('.amentities-image').length > 1 ) {
    $('.amentities-carousel').slick({
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 5000
    })
  }
}

function initAmentitiesPopup() {
  $('.btn-view-gallery').on('click', function() {
    $('.popup-block').fadeIn(300);
    $('html, body').css('overflow', 'hidden');
    $('.popup-block__slides').slick('setPosition');
    return false;
  });
}

function initAbout() {
  function ajaxPeople(is_load_more = false) {
    let $parent = $('.people-grid');
    let category = $('.people-grid').attr('data-cat');
    let page = $('#load-more-people').attr( 'data-page' ); 
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "loadAjaxPeople",
        category: category,
        page: page
      },
      beforeSend: function() {
        if( is_load_more ) {
          $parent.after('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
        } else {
          $parent.html(
            '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
          );
        }
        $('#load-more-people').parent().hide();
        $('.people-title').hide();
      },
      success: function(res) {
        let json = $.parseJSON(res);
        $('.lds-roller').remove();
        let strHTML = json.output;
        $parent.append(strHTML);
        $('#load-more-people').attr( 'data-page', json.page );
        if( json.has_more_pages ) {
          $('#load-more-people').parent().show();
        }
        if( json.heading ) {
          $('.people-title').html(json.heading);
          $('.people-title').show();
        }
      },
      complete: function() {

      }
    }); 
  }

  $('.people-filter').on('change', function() {
    let cat = $(this).val();
    $('#load-more-people').attr('data-page', 0);
    $('.people-grid').attr('data-cat', cat);
    ajaxPeople();
    return false;
  });

  $('#load-more-people').on('click', function() {
    $('.people-grid').attr('data-cat', $('.people-filter').val());
    ajaxPeople( true );
    return false;
  });
}

function initMediaContentSlider() {
  $('.media-content.has-slider .media-content__media').slick({
    arrows: false,
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1
  })
}

// 
function initJournalSlider() {
  $('.journal-slider__slides').slick({
    arrows: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
    variableWidth: true,
    responsive: [{
      breakpoint: 769,
      settings: {
        variableWidth: false,
        centerMode: true,
        centerPadding: '35px'
      }
    }]
  });
}

// Init Home Map
function initHomeMap() {
  if( $('.home-map__map').length ) {
    let $map = $('.home-map__map');
    var map = initMap( $map );
    let id = $map.attr('data-id');
    let lat = $map.attr('data-lat');
    let lng = $map.attr('data-lng');
    ajaxLocations(id, lat, lng);
  }
}

// Init Neighborhood Map
function initNeighborhood() {
  function hideLocationCards() {
    $('.location-card').each(function(index) {
      if( index > 3 ) $(this).addClass('hide');
    });
  }

  function ajaxNeighborhoods(id, cat, lat, lng) {
    let $parent = $('.neighborhood-map__locations');
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "loadAjaxNeighborhood",
        id,
        cat,
        lat,
        lng
      },
      beforeSend: function() {
        $parent.html(
          '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
        );
      },
      success: function(res) {
        let json = $.parseJSON(res);
        $parent.html(json.output);
        $('.neighborhood-map__map').html(json.map);
      },  
      complete: function() {
        initNeighborhoodMap();
        if( $('.location-card').length > 4 ) {
          $('.neighborhood-map__all').show();
        }
        hideLocationCards();
      }
    });
  }
  function initNeighborhoodMap() {
    let $map = $('.neighborhood-map__map');
    var style = [
        {
            "featureType": "all",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "weight": "2.00"
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#9c9c9c"
                }
            ]
        },
        {
            "featureType": "all",
            "elementType": "labels.text",
            "stylers": [
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#f2f2f2"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "landscape.man_made",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": 45
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#eeeeee"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#7b7b7b"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [
                {
                    "color": "#46bcec"
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#c8d7d4"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#070707"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                }
            ]
        }
    ];
    // Find marker elements within map.
    var $markers = $map.find('.marker');
    // Create gerenic map.
    var mapArgs = {
        zoom        : parseInt($map.attr('data-zoom')) || 16,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        disableDoubleClickZoom: false,
        fullscreenControl: false,
        streetViewControl: false,
        mapTypeControl: false,
        scrollwheel : false,
        styles: style,
    };
    var map = new google.maps.Map( $map[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function( ){
        // Get position from marker.
        var lat = $(this).attr('data-lat');
        var lng = $(this).attr('data-lng');
        var latLng = {
            lat: parseFloat( lat ),
            lng: parseFloat( lng )
        };
      
        // Create marker instance.
        var icon;
        if( $(this).attr('data-icon') ) {
          icon = $(this).attr('data-icon');
        } else {
          let svg = '<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#405370"/></svg>';
          icon = 'data:image/svg+xml;charset=UTF-8;base64,' + btoa(svg);
        }
        var marker = new google.maps.Marker({
            position : latLng,
            map: map,
            icon: {
              url: icon
            }
        });
      
        // Append to reference for later use.
        map.markers.push( marker );
      
        // If marker contains HTML, add it to an infoWindow.
        if( $(this).html() ){
      
            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: $(this).html(),
            });
      
            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.close();
                infowindow.open( map, marker );
                map.setCenter(marker.getPosition());
            });

        }
    });
    // Center map based on markers.
    centerMap( map );
  }

  initNeighborhoodMap();
  hideLocationCards();
  if($('.location-card').length > 4) 
    $('.neighborhood-map__all').show();
  $('.neighborhood-map__category').on('change', function() {
    let cat = $(this).val();
    let id = $('.neighborhood-map__map').attr('data-id');
    let lat = $('.neighborhood-map__map').attr('data-lat');
    let lng = $('.neighborhood-map__map').attr('data-lng');
    ajaxNeighborhoods(id, cat, lat, lng);
  });
  $('.neighborhood-map__all .btn').on('click', function() {
    $('.location-card').each(function(index) {
      if(index > 3) {
        $(this).removeClass('hide');
      }
    });
    $('.neighborhood-map__all').hide();
});
}

// init Offers Grid
function initOffersGrid() {
  function ajaxOffers(is_load_more = false) {
    let $parent = $('#offers-grid');
    let page = $('#load-more-offers').attr( 'data-page' ); 
    let category = $('#offers-grid').attr( 'data-category' );
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "loadAjaxOffers",
        category: category,
        page: page
      },
      beforeSend: function() {
        if( is_load_more ) {
          $parent.before('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
        } else {
          $parent.html(
            '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
          );
        }
        $('#load-more-offers').parent().hide();
      },
      success: function(res) {
        let json = $.parseJSON(res);
        $('.lds-roller').remove();
        let strHTML = json.output;
        $parent.append(strHTML);
        $('#load-more-offers').attr( 'data-page', json.page );
        if( json.has_more_pages ) {
          $('#load-more-offers').parent().show();
        }
      },
      complete: function() {
        $('.loop-offer__bg').lazyload();
      }
    });
  }
  $('.offer-category__select').on('change', function() {
    let cat = $(this).val();
    $('#offers-grid').attr('data-category', cat);
    $('#load-more-offers').attr('data-page', 0);
    ajaxOffers();
    return false;
  });

  $('#load-more-offers').on('click', function() {
    ajaxOffers(true);
    return false;
  })

}

// init Venues Module
function initVenuesModule() {
  function ajaxVenues() {
    let $parent = $('.venues-module__grid');
    let page = $('#load-more-venues').attr( 'data-page' ); 
    let type = $parent.attr('data-type');
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "loadAjaxVenues",
        page: page,
        type: type
      },
      beforeSend: function() {
        $parent.append(
          '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
        );
        $('#load-more-venues').parent().hide();
      },
      success: function(res) {
        let json = $.parseJSON(res);
        $('.lds-roller').remove();
        let strHTML = json.output;
        $parent.append(strHTML);
        $('#load-more-venues').attr( 'data-page', json.page );
        if( json.has_more_pages ) {
          $('#load-more-venues').parent().show();
        }
      },
      complete: function() {
        $('.loop-venues--img img').lazyload();
      }
    });
  }

  $('.venues-module__filter--select').on('change', function() {
    ajaxVenues();
    return false;
  });
  
  $('#load-more-venues').on('click', function() {
    ajaxVenues( );
    return false;
  });
}

function initGalleryGrid() {
  if( window.matchMedia("(min-width: 768px)").matches ) {
    $('.gallery-grids').imagesLoaded( function() {
      $('.gallery-grids').masonry({
        columnWidth: '.grid-sizer',
        itemSelector: '.gallery-image',
        percentPosition: true,
        gutter: 10,
        fitWidth: true,
      });
    });
  }
  $('.gallery-grid__select').on('change', function() {
    let val = $(this).val();
    if( val == 'all' ) {
      $('.gallery-image').show();
    } else {
      $('.gallery-image').each(function() {
        if( $(this).attr('data-cat') != val ) {
          $(this).hide();
        } else {
          $(this).show();
        }
      })
    }
    initGalleryGrid();
  });
  windowResize(initGalleryGrid);
}

function initTwoColumnsAlt() {
  if(window.matchMedia("(max-width: 768px)").matches) {
    $('.two-columns-alt.only-image .row').slick({
      arrows: false,
      dots: true,
      slidesToShow: 1,
      autoplay: true,
      autoplaySpeed: 3000
    });
  } else {
    $('.two-columns-alt.only-image .row').slick('unslick');
  }
  windowResize(initTwoColumnsAlt);
}

// Init Media Content Tab
function initMediaContentTab() {
  $(".media-content-tab__link").on("click", function() {
    if ($(this).hasClass("active")) return;
    let $parent = $(this).closest(".media-content-tab");
    $(".media-content-tab__link.active", $parent).removeClass("active");
    $(this).addClass("active");
    let target = $(this).attr("href");
    $(".media-content-tab__content.active", $parent).removeClass("active");
    $(target).addClass("active");
    return false;
  });
}

// Init People Slider
function initPeopleSlider() {
  $('.peoples').slick({
    arrows: true,
    dots: false,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 5000,
    variableWidth: true,
    responsive: [{
      breakpoint: 769,
      settings: {
        arrows: false
      }
    }]
  });
}

// slideChangeTransitionEnd

// helper blockHeight
function blockHeight(whatElementHeight) {
  jQuery(whatElementHeight).each((index, element) => {
    jQuery(element).css("--block-height", jQuery(element).innerHeight() + "px");
  });
}

// helper windowResize
function windowResize(functName) {
  $(window).on("resize orientationchange", debounce(functName, 200));
}

// helper Smooth Scroll Link
function myScrollLink() {
  var navLink = jQuery(".scroll-link");
  navLink.on("click", function(e) {
    var elementClick = jQuery(this).attr("href");
    var destination = jQuery(elementClick).offset().top;
    var scrollTime =
      jQuery(this).attr("data-scrollTime") != undefined ?
      +jQuery(this).attr("data-scrollTime") :
      1000;
    var scrollTopVar =
      jQuery(this).attr("data-scrollTop") != undefined ?
      +jQuery(this).attr("data-scrollTop") :
      jQuery(".header").outerHeight();
    var scrollBottomVar =
      jQuery(this).attr("data-scrollBottom") != undefined ?
      +jQuery(this).attr("data-scrollBottom") :
      0;
    if (jQuery(this).hasClass('secondary-nav__link')) scrollTopVar += jQuery('.secondary-nav').outerHeight() + 50;
    var destinationFull = destination - scrollTopVar + scrollBottomVar;
    jQuery("html,body").stop().animate({
        scrollTop: destinationFull,
      },
      scrollTime
    );
    return false;
  });
}

// viewportCheckerAnimate function
function viewportCheckerAnimate(
  whatElement,
  whatClassAdded,
  classAfterAnimate
) {
  jQuery(whatElement)
    .addClass("a-hidden")
    .viewportChecker({
      classToRemove: "a-hidden",
      classToAdd: "animated " + whatClassAdded,
      offset: 10,
      callbackFunction: function(elem) {
        if (classAfterAnimate) {
          elem.on("animationend", function() {
            elem.addClass("animation-end");
          });
        }
      },
    });
}

// function animate on scroll init
function anImgRightOnScrollVewportChecker() {
  $("<div/>").attr("class", "img-a-decor").appendTo(".img-a");
  jQuery(".img-a").viewportChecker({
    classToAdd: "",
    classToRemove: "",
    classToAddForFullView: "",
    offset: 100,
    callbackFunction: function(elem, action) {
      let tl = gsap.timeline();
      let decor = elem.find(".img-a-decor");
      let elImg = elem.find(".img-a-img img");
      var durationVar = 0.5;
      tl.to(decor, {
          duration: durationVar,
          x: "0%"
        })
        .to(decor, {
          duration: durationVar,
          xPercent: 100
        })
        .to(
          elImg, {
            duration: durationVar,
            "clip-path": "polygon(0 0, 100% 0, 100% 100%, 0% 100%)",
          },
          "-=" + durationVar
        )
        .to(decor, {
          duration: 0,
          opacity: 0
        });
    },
  });
}

// function animate on scroll init
function anImgRightOnScrollVewportCheckerAndVideo() {
  $("<div/>").attr("class", "img-a-decor").appendTo(".img-a-video");
  jQuery(".img-a-video").viewportChecker({
    classToAdd: "",
    classToRemove: "",
    classToAddForFullView: "",
    offset: 100,
    callbackFunction: function(elem, action) {
      let tl = gsap.timeline();
      let decor = elem.find(".img-a-decor");
      let elImg = elem.find(".img-a-img img");
      let elVideo = elem.find(".hero-img-popup-link");
      var durationVar = 0.5;
      tl.to(decor, {
          duration: durationVar,
          x: "0%"
        })
        .to(decor, {
          duration: durationVar,
          xPercent: 100
        })
        .to(
          elImg, {
            duration: durationVar,
            "clip-path": "polygon(0 0, 100% 0, 100% 100%, 0% 100%)",
          },
          "-=" + durationVar
        )
        .to(elVideo, {
          duration: 1,
          opacity: 1
        }, "+=" + 1)
        .to(decor, {
          duration: 0.2,
          opacity: 0
        })
        .to(elImg, {
          duration: 0.2,
          opacity: 0
        });
    },
  });
}

// function animate on scroll init
function anImgLeftOnScrollVewportChecker() {
  $("<div/>").attr("class", "img-a-decor").appendTo(".img-a-left");
  jQuery(".img-a-left").viewportChecker({
    classToAdd: "",
    classToRemove: "",
    classToAddForFullView: "",
    offset: 100,
    callbackFunction: function(elem, action) {
      let tl = gsap.timeline();
      let decor = elem.find(".img-a-decor");
      let elImg = elem.find(".img-a-img img");
      var durationVar = 0.5;
      tl.to(decor, {
          duration: durationVar,
          x: "0%"
        })
        .to(decor, {
          duration: durationVar,
          xPercent: -100
        })
        .to(elImg, {
          duration: durationVar,
          width: "100%"
        }, "-=" + durationVar)
        .to(decor, {
          duration: 0.2,
          opacity: 0
        });
    },
  });
}

// function animate on scroll init
function anImgUpOnScrollVewportChecker() {
  $("<div/>").attr("class", "img-a-decor").appendTo(".img-a-up");
  jQuery(".img-a-up").viewportChecker({
    classToAdd: "",
    classToRemove: "",
    classToAddForFullView: "",
    offset: 100,
    callbackFunction: function(elem, action) {
      let tl = gsap.timeline();
      let decor = elem.find(".img-a-decor");
      let elImg = elem.find(".img-a-img img");
      var durationVar = 0.5;
      tl.to(decor, {
          duration: durationVar,
          x: "0%"
        })
        .to(decor, {
          duration: durationVar,
          xPercent: 100
        })
        .to(
          elImg, {
            duration: durationVar,
            yPercent: -100
          },
          "-=" + durationVar
        )
        .to(decor, {
          duration: 0.2,
          opacity: 0
        });
    },
  });
}

// function init
// slick Slider
function slickSliderInit() {
  $(".slides-images").slick({
    dots: true,
    arrows: true,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 5000,
    asNavFor: ".slides-contents",
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
      },
    }, ],
  });
  $(".slides-contents").slick({
    dots: false,
    arrows: false,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 5000,
    asNavFor: ".slides-images",
  });
}

//-------- -------- -------- --------
//-------- js custom end
//-------- -------- -------- --------

//-------- -------- -------- --------
//-------- included js libs start
//-------- -------- -------- --------

// custom helper function for debounce - how to work see https://codepen.io/Hyubert/pen/abZmXjm
/*
 * Debounce
 * need for once call function
 *
 * @param { function } - callback function
 * @param { number } - timeout time (ms)
 * @return { function }
 */
function debounce(func, timeout) {
  var timeoutID,
    timeout = timeout || 200;
  return function() {
    var scope = this,
      args = arguments;
    clearTimeout(timeoutID);
    timeoutID = setTimeout(function() {
      func.apply(scope, Array.prototype.slice.call(args));
    }, timeout);
  };
}

// library for custom form
/*!
 * JavaScript Custom Forms
 *
 * Copyright 2014-2015 PSD2HTML - http://psd2html.com/jcf
 * Released under the MIT license (LICENSE.txt)
 *
 * Version: 1.1.3
 */
(function(root, factory) {
  "use strict";
  if (typeof define === "function" && define.amd) {
    define(["jquery"], factory);
  } else if (typeof exports === "object") {
    module.exports = factory(require("jquery"));
  } else {
    root.jcf = factory(jQuery);
  }
})(this, function($) {
  "use strict";

  // define version
  var version = "1.1.3";

  // private variables
  var customInstances = [];

  // default global options
  var commonOptions = {
    optionsKey: "jcf",
    dataKey: "jcf-instance",
    rtlClass: "jcf-rtl",
    focusClass: "jcf-focus",
    pressedClass: "jcf-pressed",
    disabledClass: "jcf-disabled",
    hiddenClass: "jcf-hidden",
    resetAppearanceClass: "jcf-reset-appearance",
    unselectableClass: "jcf-unselectable",
  };

  // detect device type
  var isTouchDevice =
    "ontouchstart" in window ||
    (window.DocumentTouch && document instanceof window.DocumentTouch),
    isWinPhoneDevice = /Windows Phone/.test(navigator.userAgent);
  commonOptions.isMobileDevice = !!(isTouchDevice || isWinPhoneDevice);

  var isIOS = /(iPad|iPhone).*OS ([0-9_]*) .*/.exec(navigator.userAgent);
  if (isIOS) isIOS = parseFloat(isIOS[2].replace(/_/g, "."));
  commonOptions.ios = isIOS;

  // create global stylesheet if custom forms are used
  var createStyleSheet = function() {
    var styleTag = $("<style>").appendTo("head"),
      styleSheet = styleTag.prop("sheet") || styleTag.prop("styleSheet");

    // crossbrowser style handling
    var addCSSRule = function(selector, rules, index) {
      if (styleSheet.insertRule) {
        styleSheet.insertRule(selector + "{" + rules + "}", index);
      } else {
        styleSheet.addRule(selector, rules, index);
      }
    };

    // add special rules
    addCSSRule(
      "." + commonOptions.hiddenClass,
      "position:absolute !important;left:-9999px !important;height:1px !important;width:1px !important;margin:0 !important;border-width:0 !important;-webkit-appearance:none;-moz-appearance:none;appearance:none"
    );
    addCSSRule(
      "." + commonOptions.rtlClass + " ." + commonOptions.hiddenClass,
      "right:-9999px !important; left: auto !important"
    );
    addCSSRule(
      "." + commonOptions.unselectableClass,
      "-webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-tap-highlight-color: rgba(0,0,0,0);"
    );
    addCSSRule(
      "." + commonOptions.resetAppearanceClass,
      "background: none; border: none; -webkit-appearance: none; appearance: none; opacity: 0; filter: alpha(opacity=0);"
    );

    // detect rtl pages
    var html = $("html"),
      body = $("body");
    if (html.css("direction") === "rtl" || body.css("direction") === "rtl") {
      html.addClass(commonOptions.rtlClass);
    }

    // handle form reset event
    html.on("reset", function() {
      setTimeout(function() {
        api.refreshAll();
      }, 0);
    });

    // mark stylesheet as created
    commonOptions.styleSheetCreated = true;
  };

  // simplified pointer events handler
  (function() {
    var pointerEventsSupported =
      navigator.pointerEnabled || navigator.msPointerEnabled,
      touchEventsSupported =
      "ontouchstart" in window ||
      (window.DocumentTouch && document instanceof window.DocumentTouch),
      eventList,
      eventMap = {},
      eventPrefix = "jcf-";

    // detect events to attach
    if (pointerEventsSupported) {
      eventList = {
        pointerover: navigator.pointerEnabled ? "pointerover" : "MSPointerOver",
        pointerdown: navigator.pointerEnabled ? "pointerdown" : "MSPointerDown",
        pointermove: navigator.pointerEnabled ? "pointermove" : "MSPointerMove",
        pointerup: navigator.pointerEnabled ? "pointerup" : "MSPointerUp",
      };
    } else {
      eventList = {
        pointerover: "mouseover",
        pointerdown: "mousedown" + (touchEventsSupported ? " touchstart" : ""),
        pointermove: "mousemove" + (touchEventsSupported ? " touchmove" : ""),
        pointerup: "mouseup" + (touchEventsSupported ? " touchend" : ""),
      };
    }

    // create event map
    $.each(eventList, function(targetEventName, fakeEventList) {
      $.each(fakeEventList.split(" "), function(index, fakeEventName) {
        eventMap[fakeEventName] = targetEventName;
      });
    });

    // jQuery event hooks
    $.each(eventList, function(eventName, eventHandlers) {
      eventHandlers = eventHandlers.split(" ");
      $.event.special[eventPrefix + eventName] = {
        setup: function() {
          var self = this;
          $.each(eventHandlers, function(index, fallbackEvent) {
            if (self.addEventListener)
              self.addEventListener(fallbackEvent, fixEvent, false);
            else self["on" + fallbackEvent] = fixEvent;
          });
        },
        teardown: function() {
          var self = this;
          $.each(eventHandlers, function(index, fallbackEvent) {
            if (self.addEventListener)
              self.removeEventListener(fallbackEvent, fixEvent, false);
            else self["on" + fallbackEvent] = null;
          });
        },
      };
    });

    // check that mouse event are not simulated by mobile browsers
    var lastTouch = null;
    var mouseEventSimulated = function(e) {
      var dx = Math.abs(e.pageX - lastTouch.x),
        dy = Math.abs(e.pageY - lastTouch.y),
        rangeDistance = 25;

      if (dx <= rangeDistance && dy <= rangeDistance) {
        return true;
      }
    };

    // normalize event
    var fixEvent = function(e) {
      var origEvent = e || window.event,
        touchEventData = null,
        targetEventName = eventMap[origEvent.type];

      e = $.event.fix(origEvent);
      e.type = eventPrefix + targetEventName;

      if (origEvent.pointerType) {
        switch (origEvent.pointerType) {
          case 2:
            e.pointerType = "touch";
            break;
          case 3:
            e.pointerType = "pen";
            break;
          case 4:
            e.pointerType = "mouse";
            break;
          default:
            e.pointerType = origEvent.pointerType;
        }
      } else {
        e.pointerType = origEvent.type.substr(0, 5); // "mouse" or "touch" word length
      }

      if (!e.pageX && !e.pageY) {
        touchEventData = origEvent.changedTouches ?
          origEvent.changedTouches[0] :
          origEvent;
        e.pageX = touchEventData.pageX;
        e.pageY = touchEventData.pageY;
      }

      if (origEvent.type === "touchend") {
        lastTouch = {
          x: e.pageX,
          y: e.pageY
        };
      }
      if (e.pointerType === "mouse" && lastTouch && mouseEventSimulated(e)) {
        return;
      } else {
        return ($.event.dispatch || $.event.handle).call(this, e);
      }
    };
  })();

  // custom mousewheel/trackpad handler
  (function() {
    var wheelEvents = (
        "onwheel" in document || document.documentMode >= 9 ?
        "wheel" :
        "mousewheel DOMMouseScroll"
      ).split(" "),
      shimEventName = "jcf-mousewheel";

    $.event.special[shimEventName] = {
      setup: function() {
        var self = this;
        $.each(wheelEvents, function(index, fallbackEvent) {
          if (self.addEventListener)
            self.addEventListener(fallbackEvent, fixEvent, false);
          else self["on" + fallbackEvent] = fixEvent;
        });
      },
      teardown: function() {
        var self = this;
        $.each(wheelEvents, function(index, fallbackEvent) {
          if (self.addEventListener)
            self.removeEventListener(fallbackEvent, fixEvent, false);
          else self["on" + fallbackEvent] = null;
        });
      },
    };

    var fixEvent = function(e) {
      var origEvent = e || window.event;
      e = $.event.fix(origEvent);
      e.type = shimEventName;

      // old wheel events handler
      if ("detail" in origEvent) {
        e.deltaY = -origEvent.detail;
      }
      if ("wheelDelta" in origEvent) {
        e.deltaY = -origEvent.wheelDelta;
      }
      if ("wheelDeltaY" in origEvent) {
        e.deltaY = -origEvent.wheelDeltaY;
      }
      if ("wheelDeltaX" in origEvent) {
        e.deltaX = -origEvent.wheelDeltaX;
      }

      // modern wheel event handler
      if ("deltaY" in origEvent) {
        e.deltaY = origEvent.deltaY;
      }
      if ("deltaX" in origEvent) {
        e.deltaX = origEvent.deltaX;
      }

      // handle deltaMode for mouse wheel
      e.delta = e.deltaY || e.deltaX;
      if (origEvent.deltaMode === 1) {
        var lineHeight = 16;
        e.delta *= lineHeight;
        e.deltaY *= lineHeight;
        e.deltaX *= lineHeight;
      }

      return ($.event.dispatch || $.event.handle).call(this, e);
    };
  })();

  // extra module methods
  var moduleMixin = {
    // provide function for firing native events
    fireNativeEvent: function(elements, eventName) {
      $(elements).each(function() {
        var element = this,
          eventObject;
        if (element.dispatchEvent) {
          eventObject = document.createEvent("HTMLEvents");
          eventObject.initEvent(eventName, true, true);
          element.dispatchEvent(eventObject);
        } else if (document.createEventObject) {
          eventObject = document.createEventObject();
          eventObject.target = element;
          element.fireEvent("on" + eventName, eventObject);
        }
      });
    },
    // bind event handlers for module instance (functions beggining with "on")
    bindHandlers: function() {
      var self = this;
      $.each(self, function(propName, propValue) {
        if (propName.indexOf("on") === 0 && $.isFunction(propValue)) {
          // dont use $.proxy here because it doesn't create unique handler
          self[propName] = function() {
            return propValue.apply(self, arguments);
          };
        }
      });
    },
  };

  // public API
  var api = {
    version: version,
    modules: {},
    getOptions: function() {
      return $.extend({}, commonOptions);
    },
    setOptions: function(moduleName, moduleOptions) {
      if (arguments.length > 1) {
        // set module options
        if (this.modules[moduleName]) {
          $.extend(this.modules[moduleName].prototype.options, moduleOptions);
        }
      } else {
        // set common options
        $.extend(commonOptions, moduleName);
      }
    },
    addModule: function(proto) {
      // add module to list
      var Module = function(options) {
        // save instance to collection
        if (!options.element.data(commonOptions.dataKey)) {
          options.element.data(commonOptions.dataKey, this);
        }
        customInstances.push(this);

        // save options
        this.options = $.extend({},
          commonOptions,
          this.options,
          getInlineOptions(options.element),
          options
        );

        // bind event handlers to instance
        this.bindHandlers();

        // call constructor
        this.init.apply(this, arguments);
      };

      // parse options from HTML attribute
      var getInlineOptions = function(element) {
        var dataOptions = element.data(commonOptions.optionsKey),
          attrOptions = element.attr(commonOptions.optionsKey);

        if (dataOptions) {
          return dataOptions;
        } else if (attrOptions) {
          try {
            return $.parseJSON(attrOptions);
          } catch (e) {
            // ignore invalid attributes
          }
        }
      };

      // set proto as prototype for new module
      Module.prototype = proto;

      // add mixin methods to module proto
      $.extend(proto, moduleMixin);
      if (proto.plugins) {
        $.each(proto.plugins, function(pluginName, plugin) {
          $.extend(plugin.prototype, moduleMixin);
        });
      }

      // override destroy method
      var originalDestroy = Module.prototype.destroy;
      Module.prototype.destroy = function() {
        this.options.element.removeData(this.options.dataKey);

        for (var i = customInstances.length - 1; i >= 0; i--) {
          if (customInstances[i] === this) {
            customInstances.splice(i, 1);
            break;
          }
        }

        if (originalDestroy) {
          originalDestroy.apply(this, arguments);
        }
      };

      // save module to list
      this.modules[proto.name] = Module;
    },
    getInstance: function(element) {
      return $(element).data(commonOptions.dataKey);
    },
    replace: function(elements, moduleName, customOptions) {
      var self = this,
        instance;

      if (!commonOptions.styleSheetCreated) {
        createStyleSheet();
      }

      $(elements).each(function() {
        var moduleOptions,
          element = $(this);

        instance = element.data(commonOptions.dataKey);
        if (instance) {
          instance.refresh();
        } else {
          if (!moduleName) {
            $.each(self.modules, function(currentModuleName, module) {
              if (
                module.prototype.matchElement.call(module.prototype, element)
              ) {
                moduleName = currentModuleName;
                return false;
              }
            });
          }
          if (moduleName) {
            moduleOptions = $.extend({
              element: element
            }, customOptions);
            instance = new self.modules[moduleName](moduleOptions);
          }
        }
      });
      return instance;
    },
    refresh: function(elements) {
      $(elements).each(function() {
        var instance = $(this).data(commonOptions.dataKey);
        if (instance) {
          instance.refresh();
        }
      });
    },
    destroy: function(elements) {
      $(elements).each(function() {
        var instance = $(this).data(commonOptions.dataKey);
        if (instance) {
          instance.destroy();
        }
      });
    },
    replaceAll: function(context) {
      var self = this;
      $.each(this.modules, function(moduleName, module) {
        $(module.prototype.selector, context).each(function() {
          if (this.className.indexOf("jcf-ignore") < 0) {
            self.replace(this, moduleName);
          }
        });
      });
    },
    refreshAll: function(context) {
      if (context) {
        $.each(this.modules, function(moduleName, module) {
          $(module.prototype.selector, context).each(function() {
            var instance = $(this).data(commonOptions.dataKey);
            if (instance) {
              instance.refresh();
            }
          });
        });
      } else {
        for (var i = customInstances.length - 1; i >= 0; i--) {
          customInstances[i].refresh();
        }
      }
    },
    destroyAll: function(context) {
      if (context) {
        $.each(this.modules, function(moduleName, module) {
          $(module.prototype.selector, context).each(function(index, element) {
            var instance = $(element).data(commonOptions.dataKey);
            if (instance) {
              instance.destroy();
            }
          });
        });
      } else {
        while (customInstances.length) {
          customInstances[0].destroy();
        }
      }
    },
  };

  // always export API to the global window object
  window.jcf = api;

  return api;
});

/*!
 * JavaScript Custom Forms : Select Module
 *
 * Copyright 2014-2015 PSD2HTML - http://psd2html.com/jcf
 * Released under the MIT license (LICENSE.txt)
 *
 * Version: 1.1.3
 */
(function($, window) {
  "use strict";

  jcf.addModule({
    name: "Select",
    selector: "select",
    options: {
      element: null,
      multipleCompactStyle: false,
    },
    plugins: {
      ListBox: ListBox,
      ComboBox: ComboBox,
      SelectList: SelectList,
    },
    matchElement: function(element) {
      return element.is("select");
    },
    init: function() {
      this.element = $(this.options.element);
      this.createInstance();
    },
    isListBox: function() {
      return this.element.is("[size]:not([jcf-size]), [multiple]");
    },
    createInstance: function() {
      if (this.instance) {
        this.instance.destroy();
      }
      if (this.isListBox() && !this.options.multipleCompactStyle) {
        this.instance = new ListBox(this.options);
      } else {
        this.instance = new ComboBox(this.options);
      }
    },
    refresh: function() {
      var typeMismatch =
        (this.isListBox() && this.instance instanceof ComboBox) ||
        (!this.isListBox() && this.instance instanceof ListBox);

      if (typeMismatch) {
        this.createInstance();
      } else {
        this.instance.refresh();
      }
    },
    destroy: function() {
      this.instance.destroy();
    },
  });

  // combobox module
  function ComboBox(options) {
    this.options = $.extend({
        wrapNative: true,
        wrapNativeOnMobile: true,
        fakeDropInBody: true,
        useCustomScroll: true,
        flipDropToFit: true,
        maxVisibleItems: 10,
        fakeAreaStructure: '<span class="jcf-select"><span class="jcf-select-text"></span><span class="jcf-select-opener"></span></span>',
        fakeDropStructure: '<div class="jcf-select-drop"><div class="jcf-select-drop-content"></div></div>',
        optionClassPrefix: "jcf-option-",
        selectClassPrefix: "jcf-select-",
        dropContentSelector: ".jcf-select-drop-content",
        selectTextSelector: ".jcf-select-text",
        dropActiveClass: "jcf-drop-active",
        flipDropClass: "jcf-drop-flipped",
      },
      options
    );
    this.init();
  }
  $.extend(ComboBox.prototype, {
    init: function() {
      this.initStructure();
      this.bindHandlers();
      this.attachEvents();
      this.refresh();
    },
    initStructure: function() {
      // prepare structure
      this.win = $(window);
      this.doc = $(document);
      this.realElement = $(this.options.element);
      this.fakeElement = $(this.options.fakeAreaStructure).insertAfter(
        this.realElement
      );
      this.selectTextContainer = this.fakeElement.find(
        this.options.selectTextSelector
      );
      this.selectText = $("<span></span>").appendTo(this.selectTextContainer);
      makeUnselectable(this.fakeElement);

      // copy classes from original select
      this.fakeElement.addClass(
        getPrefixedClasses(
          this.realElement.prop("className"),
          this.options.selectClassPrefix
        )
      );

      // handle compact multiple style
      if (this.realElement.prop("multiple")) {
        this.fakeElement.addClass("jcf-compact-multiple");
      }

      // detect device type and dropdown behavior
      if (
        this.options.isMobileDevice &&
        this.options.wrapNativeOnMobile &&
        !this.options.wrapNative
      ) {
        this.options.wrapNative = true;
      }

      if (this.options.wrapNative) {
        // wrap native select inside fake block
        this.realElement
          .prependTo(this.fakeElement)
          .css({
            position: "absolute",
            height: "100%",
            width: "100%",
          })
          .addClass(this.options.resetAppearanceClass);
      } else {
        // just hide native select
        this.realElement.addClass(this.options.hiddenClass);
        this.fakeElement.attr("title", this.realElement.attr("title"));
        this.fakeDropTarget = this.options.fakeDropInBody ?
          $("body") :
          this.fakeElement;
      }
    },
    attachEvents: function() {
      // delayed refresh handler
      var self = this;
      this.delayedRefresh = function() {
        setTimeout(function() {
          self.refresh();
          if (self.list) {
            self.list.refresh();
            self.list.scrollToActiveOption();
          }
        }, 1);
      };

      // native dropdown event handlers
      if (this.options.wrapNative) {
        this.realElement.on({
          focus: this.onFocus,
          change: this.onChange,
          click: this.onChange,
          keydown: this.onChange,
        });
      } else {
        // custom dropdown event handlers
        this.realElement.on({
          focus: this.onFocus,
          change: this.onChange,
          keydown: this.onKeyDown,
        });
        this.fakeElement.on({
          "jcf-pointerdown": this.onSelectAreaPress,
        });
      }
    },
    onKeyDown: function(e) {
      if (e.which === 13) {
        this.toggleDropdown();
      } else if (this.dropActive) {
        this.delayedRefresh();
      }
    },
    onChange: function() {
      this.refresh();
    },
    onFocus: function() {
      if (!this.pressedFlag || !this.focusedFlag) {
        this.fakeElement.addClass(this.options.focusClass);
        this.realElement.on("blur", this.onBlur);
        this.toggleListMode(true);
        this.focusedFlag = true;
      }
    },
    onBlur: function() {
      if (!this.pressedFlag) {
        this.fakeElement.removeClass(this.options.focusClass);
        this.realElement.off("blur", this.onBlur);
        this.toggleListMode(false);
        this.focusedFlag = false;
      }
    },
    onResize: function() {
      if (this.dropActive) {
        this.hideDropdown();
      }
    },
    onSelectDropPress: function() {
      this.pressedFlag = true;
    },
    onSelectDropRelease: function(e, pointerEvent) {
      this.pressedFlag = false;
      if (pointerEvent.pointerType === "mouse") {
        this.realElement.focus();
      }
    },
    onSelectAreaPress: function(e) {
      // skip click if drop inside fake element or real select is disabled
      var dropClickedInsideFakeElement = !this.options.fakeDropInBody &&
        $(e.target).closest(this.dropdown).length;
      if (
        dropClickedInsideFakeElement ||
        e.button > 1 ||
        this.realElement.is(":disabled")
      ) {
        return;
      }

      // toggle dropdown visibility
      this.selectOpenedByEvent = e.pointerType;
      this.toggleDropdown();

      // misc handlers
      if (!this.focusedFlag) {
        if (e.pointerType === "mouse") {
          this.realElement.focus();
        } else {
          this.onFocus(e);
        }
      }
      this.pressedFlag = true;
      this.fakeElement.addClass(this.options.pressedClass);
      this.doc.on("jcf-pointerup", this.onSelectAreaRelease);
    },
    onSelectAreaRelease: function(e) {
      if (this.focusedFlag && e.pointerType === "mouse") {
        this.realElement.focus();
      }
      this.pressedFlag = false;
      this.fakeElement.removeClass(this.options.pressedClass);
      this.doc.off("jcf-pointerup", this.onSelectAreaRelease);
    },
    onOutsideClick: function(e) {
      var target = $(e.target),
        clickedInsideSelect =
        target.closest(this.fakeElement).length ||
        target.closest(this.dropdown).length;

      if (!clickedInsideSelect) {
        this.hideDropdown();
      }
    },
    onSelect: function() {
      this.refresh();

      if (this.realElement.prop("multiple")) {
        this.repositionDropdown();
      } else {
        this.hideDropdown();
      }

      this.fireNativeEvent(this.realElement, "change");
    },
    toggleListMode: function(state) {
      if (!this.options.wrapNative) {
        if (state) {
          // temporary change select to list to avoid appearing of native dropdown
          this.realElement.attr({
            size: 4,
            "jcf-size": "",
          });
        } else {
          // restore select from list mode to dropdown select
          if (!this.options.wrapNative) {
            this.realElement.removeAttr("size jcf-size");
          }
        }
      }
    },
    createDropdown: function() {
      // destroy previous dropdown if needed
      if (this.dropdown) {
        this.list.destroy();
        this.dropdown.remove();
      }

      // create new drop container
      this.dropdown = $(this.options.fakeDropStructure).appendTo(
        this.fakeDropTarget
      );
      this.dropdown.addClass(
        getPrefixedClasses(
          this.realElement.prop("className"),
          this.options.selectClassPrefix
        )
      );
      makeUnselectable(this.dropdown);

      // handle compact multiple style
      if (this.realElement.prop("multiple")) {
        this.dropdown.addClass("jcf-compact-multiple");
      }

      // set initial styles for dropdown in body
      if (this.options.fakeDropInBody) {
        this.dropdown.css({
          position: "absolute",
          top: -9999,
        });
      }

      // create new select list instance
      this.list = new SelectList({
        useHoverClass: true,
        handleResize: false,
        alwaysPreventMouseWheel: true,
        maxVisibleItems: this.options.maxVisibleItems,
        useCustomScroll: this.options.useCustomScroll,
        holder: this.dropdown.find(this.options.dropContentSelector),
        multipleSelectWithoutKey: this.realElement.prop("multiple"),
        element: this.realElement,
      });
      $(this.list).on({
        select: this.onSelect,
        press: this.onSelectDropPress,
        release: this.onSelectDropRelease,
      });
    },
    repositionDropdown: function() {
      var selectOffset = this.fakeElement.offset(),
        selectWidth = this.fakeElement.outerWidth(),
        selectHeight = this.fakeElement.outerHeight(),
        dropHeight = this.dropdown.css("width", selectWidth).outerHeight(),
        winScrollTop = this.win.scrollTop(),
        winHeight = this.win.height(),
        calcTop,
        calcLeft,
        bodyOffset,
        needFlipDrop = false;

      // check flip drop position
      if (
        selectOffset.top + selectHeight + dropHeight >
        winScrollTop + winHeight &&
        selectOffset.top - dropHeight > winScrollTop
      ) {
        needFlipDrop = true;
      }

      if (this.options.fakeDropInBody) {
        bodyOffset =
          this.fakeDropTarget.css("position") !== "static" ?
          this.fakeDropTarget.offset().top :
          0;
        if (this.options.flipDropToFit && needFlipDrop) {
          // calculate flipped dropdown position
          calcLeft = selectOffset.left;
          calcTop = selectOffset.top - dropHeight - bodyOffset;
        } else {
          // calculate default drop position
          calcLeft = selectOffset.left;
          calcTop = selectOffset.top + selectHeight - bodyOffset;
        }

        // update drop styles
        this.dropdown.css({
          width: selectWidth,
          left: calcLeft,
          top: calcTop,
        });
      }

      // refresh flipped class
      this.dropdown
        .add(this.fakeElement)
        .toggleClass(
          this.options.flipDropClass,
          this.options.flipDropToFit && needFlipDrop
        );
    },
    showDropdown: function() {
      // do not show empty custom dropdown
      if (!this.realElement.prop("options").length) {
        return;
      }

      // create options list if not created
      if (!this.dropdown) {
        this.createDropdown();
      }

      // show dropdown
      this.dropActive = true;
      this.dropdown.appendTo(this.fakeDropTarget);
      this.fakeElement.addClass(this.options.dropActiveClass);
      this.refreshSelectedText();
      this.repositionDropdown();
      this.list.setScrollTop(this.savedScrollTop);
      this.list.refresh();

      // add temporary event handlers
      this.win.on("resize", this.onResize);
      this.doc.on("jcf-pointerdown", this.onOutsideClick);
    },
    hideDropdown: function() {
      if (this.dropdown) {
        this.savedScrollTop = this.list.getScrollTop();
        this.fakeElement.removeClass(
          this.options.dropActiveClass + " " + this.options.flipDropClass
        );
        this.dropdown.removeClass(this.options.flipDropClass).detach();
        this.doc.off("jcf-pointerdown", this.onOutsideClick);
        this.win.off("resize", this.onResize);
        this.dropActive = false;
        if (this.selectOpenedByEvent === "touch") {
          this.onBlur();
        }
      }
    },
    toggleDropdown: function() {
      if (this.dropActive) {
        this.hideDropdown();
      } else {
        this.showDropdown();
      }
    },
    refreshSelectedText: function() {
      // redraw selected area
      var selectedIndex = this.realElement.prop("selectedIndex"),
        selectedOption = this.realElement.prop("options")[selectedIndex],
        selectedOptionImage = selectedOption ?
        selectedOption.getAttribute("data-image") :
        null,
        selectedOptionText = "",
        selectedOptionClasses,
        self = this;

      if (this.realElement.prop("multiple")) {
        $.each(this.realElement.prop("options"), function(index, option) {
          if (option.selected) {
            selectedOptionText +=
              (selectedOptionText ? ", " : "") + option.innerHTML;
          }
        });
        if (!selectedOptionText) {
          selectedOptionText = self.realElement.attr("placeholder") || "";
        }
        this.selectText.removeAttr("class").html(selectedOptionText);
      } else if (!selectedOption) {
        if (this.selectImage) {
          this.selectImage.hide();
        }
        this.selectText.removeAttr("class").empty();
      } else if (
        this.currentSelectedText !== selectedOption.innerHTML ||
        this.currentSelectedImage !== selectedOptionImage
      ) {
        selectedOptionClasses = getPrefixedClasses(
          selectedOption.className,
          this.options.optionClassPrefix
        );
        this.selectText
          .attr("class", selectedOptionClasses)
          .html(selectedOption.innerHTML);

        if (selectedOptionImage) {
          if (!this.selectImage) {
            this.selectImage = $("<img>")
              .prependTo(this.selectTextContainer)
              .hide();
          }
          this.selectImage.attr("src", selectedOptionImage).show();
        } else if (this.selectImage) {
          this.selectImage.hide();
        }

        this.currentSelectedText = selectedOption.innerHTML;
        this.currentSelectedImage = selectedOptionImage;
      }
    },
    refresh: function() {
      // refresh fake select visibility
      if (this.realElement.prop("style").display === "none") {
        this.fakeElement.hide();
      } else {
        this.fakeElement.show();
      }

      // refresh selected text
      this.refreshSelectedText();

      // handle disabled state
      this.fakeElement.toggleClass(
        this.options.disabledClass,
        this.realElement.is(":disabled")
      );
    },
    destroy: function() {
      // restore structure
      if (this.options.wrapNative) {
        this.realElement
          .insertBefore(this.fakeElement)
          .css({
            position: "",
            height: "",
            width: "",
          })
          .removeClass(this.options.resetAppearanceClass);
      } else {
        this.realElement.removeClass(this.options.hiddenClass);
        if (this.realElement.is("[jcf-size]")) {
          this.realElement.removeAttr("size jcf-size");
        }
      }

      // removing element will also remove its event handlers
      this.fakeElement.remove();

      // remove other event handlers
      this.doc.off("jcf-pointerup", this.onSelectAreaRelease);
      this.realElement.off({
        focus: this.onFocus,
      });
    },
  });

  // listbox module
  function ListBox(options) {
    this.options = $.extend({
        wrapNative: true,
        useCustomScroll: true,
        fakeStructure: '<span class="jcf-list-box"><span class="jcf-list-wrapper"></span></span>',
        selectClassPrefix: "jcf-select-",
        listHolder: ".jcf-list-wrapper",
      },
      options
    );
    this.init();
  }
  $.extend(ListBox.prototype, {
    init: function() {
      this.bindHandlers();
      this.initStructure();
      this.attachEvents();
    },
    initStructure: function() {
      this.realElement = $(this.options.element);
      this.fakeElement = $(this.options.fakeStructure).insertAfter(
        this.realElement
      );
      this.listHolder = this.fakeElement.find(this.options.listHolder);
      makeUnselectable(this.fakeElement);

      // copy classes from original select
      this.fakeElement.addClass(
        getPrefixedClasses(
          this.realElement.prop("className"),
          this.options.selectClassPrefix
        )
      );
      this.realElement.addClass(this.options.hiddenClass);

      this.list = new SelectList({
        useCustomScroll: this.options.useCustomScroll,
        holder: this.listHolder,
        selectOnClick: false,
        element: this.realElement,
      });
    },
    attachEvents: function() {
      // delayed refresh handler
      var self = this;
      this.delayedRefresh = function(e) {
        if (e && e.which === 16) {
          // ignore SHIFT key
          return;
        } else {
          clearTimeout(self.refreshTimer);
          self.refreshTimer = setTimeout(function() {
            self.refresh();
            self.list.scrollToActiveOption();
          }, 1);
        }
      };

      // other event handlers
      this.realElement.on({
        focus: this.onFocus,
        click: this.delayedRefresh,
        keydown: this.delayedRefresh,
      });

      // select list event handlers
      $(this.list).on({
        select: this.onSelect,
        press: this.onFakeOptionsPress,
        release: this.onFakeOptionsRelease,
      });
    },
    onFakeOptionsPress: function(e, pointerEvent) {
      this.pressedFlag = true;
      if (pointerEvent.pointerType === "mouse") {
        this.realElement.focus();
      }
    },
    onFakeOptionsRelease: function(e, pointerEvent) {
      this.pressedFlag = false;
      if (pointerEvent.pointerType === "mouse") {
        this.realElement.focus();
      }
    },
    onSelect: function() {
      this.fireNativeEvent(this.realElement, "change");
      this.fireNativeEvent(this.realElement, "click");
    },
    onFocus: function() {
      if (!this.pressedFlag || !this.focusedFlag) {
        this.fakeElement.addClass(this.options.focusClass);
        this.realElement.on("blur", this.onBlur);
        this.focusedFlag = true;
      }
    },
    onBlur: function() {
      if (!this.pressedFlag) {
        this.fakeElement.removeClass(this.options.focusClass);
        this.realElement.off("blur", this.onBlur);
        this.focusedFlag = false;
      }
    },
    refresh: function() {
      this.fakeElement.toggleClass(
        this.options.disabledClass,
        this.realElement.is(":disabled")
      );
      this.list.refresh();
    },
    destroy: function() {
      this.list.destroy();
      this.realElement
        .insertBefore(this.fakeElement)
        .removeClass(this.options.hiddenClass);
      this.fakeElement.remove();
    },
  });

  // options list module
  function SelectList(options) {
    this.options = $.extend({
        holder: null,
        maxVisibleItems: 10,
        selectOnClick: true,
        useHoverClass: false,
        useCustomScroll: false,
        handleResize: true,
        multipleSelectWithoutKey: false,
        alwaysPreventMouseWheel: false,
        indexAttribute: "data-index",
        cloneClassPrefix: "jcf-option-",
        containerStructure: '<span class="jcf-list"><span class="jcf-list-content"></span></span>',
        containerSelector: ".jcf-list-content",
        captionClass: "jcf-optgroup-caption",
        disabledClass: "jcf-disabled",
        optionClass: "jcf-option",
        groupClass: "jcf-optgroup",
        hoverClass: "jcf-hover",
        selectedClass: "jcf-selected",
        scrollClass: "jcf-scroll-active",
      },
      options
    );
    this.init();
  }
  $.extend(SelectList.prototype, {
    init: function() {
      this.initStructure();
      this.refreshSelectedClass();
      this.attachEvents();
    },
    initStructure: function() {
      this.element = $(this.options.element);
      this.indexSelector = "[" + this.options.indexAttribute + "]";
      this.container = $(this.options.containerStructure).appendTo(
        this.options.holder
      );
      this.listHolder = this.container.find(this.options.containerSelector);
      this.lastClickedIndex = this.element.prop("selectedIndex");
      this.rebuildList();
    },
    attachEvents: function() {
      this.bindHandlers();
      this.listHolder.on(
        "jcf-pointerdown",
        this.indexSelector,
        this.onItemPress
      );
      this.listHolder.on("jcf-pointerdown", this.onPress);

      if (this.options.useHoverClass) {
        this.listHolder.on(
          "jcf-pointerover",
          this.indexSelector,
          this.onHoverItem
        );
      }
    },
    onPress: function(e) {
      $(this).trigger("press", e);
      this.listHolder.on("jcf-pointerup", this.onRelease);
    },
    onRelease: function(e) {
      $(this).trigger("release", e);
      this.listHolder.off("jcf-pointerup", this.onRelease);
    },
    onHoverItem: function(e) {
      var hoverIndex = parseFloat(
        e.currentTarget.getAttribute(this.options.indexAttribute)
      );
      this.fakeOptions
        .removeClass(this.options.hoverClass)
        .eq(hoverIndex)
        .addClass(this.options.hoverClass);
    },
    onItemPress: function(e) {
      if (e.pointerType === "touch" || this.options.selectOnClick) {
        // select option after "click"
        this.tmpListOffsetTop = this.list.offset().top;
        this.listHolder.on(
          "jcf-pointerup",
          this.indexSelector,
          this.onItemRelease
        );
      } else {
        // select option immediately
        this.onSelectItem(e);
      }
    },
    onItemRelease: function(e) {
      // remove event handlers and temporary data
      this.listHolder.off(
        "jcf-pointerup",
        this.indexSelector,
        this.onItemRelease
      );

      // simulate item selection
      if (this.tmpListOffsetTop === this.list.offset().top) {
        this.listHolder.on(
          "click",
          this.indexSelector, {
            savedPointerType: e.pointerType
          },
          this.onSelectItem
        );
      }
      delete this.tmpListOffsetTop;
    },
    onSelectItem: function(e) {
      var clickedIndex = parseFloat(
          e.currentTarget.getAttribute(this.options.indexAttribute)
        ),
        pointerType =
        (e.data && e.data.savedPointerType) || e.pointerType || "mouse",
        range;

      // remove click event handler
      this.listHolder.off("click", this.indexSelector, this.onSelectItem);

      // ignore clicks on disabled options
      if (e.button > 1 || this.realOptions[clickedIndex].disabled) {
        return;
      }

      if (this.element.prop("multiple")) {
        if (
          e.metaKey ||
          e.ctrlKey ||
          pointerType === "touch" ||
          this.options.multipleSelectWithoutKey
        ) {
          // if CTRL/CMD pressed or touch devices - toggle selected option
          this.realOptions[clickedIndex].selected = !this.realOptions[clickedIndex].selected;
        } else if (e.shiftKey) {
          // if SHIFT pressed - update selection
          range = [this.lastClickedIndex, clickedIndex].sort(function(a, b) {
            return a - b;
          });
          this.realOptions.each(function(index, option) {
            option.selected = index >= range[0] && index <= range[1];
          });
        } else {
          // set single selected index
          this.element.prop("selectedIndex", clickedIndex);
        }
      } else {
        this.element.prop("selectedIndex", clickedIndex);
      }

      // save last clicked option
      if (!e.shiftKey) {
        this.lastClickedIndex = clickedIndex;
      }

      // refresh classes
      this.refreshSelectedClass();

      // scroll to active item in desktop browsers
      if (pointerType === "mouse") {
        this.scrollToActiveOption();
      }

      // make callback when item selected
      $(this).trigger("select");
    },
    rebuildList: function() {
      // rebuild options
      var self = this,
        rootElement = this.element[0];

      // recursively create fake options
      this.storedSelectHTML = rootElement.innerHTML;
      this.optionIndex = 0;
      this.list = $(this.createOptionsList(rootElement));
      this.listHolder.empty().append(this.list);
      this.realOptions = this.element.find("option");
      this.fakeOptions = this.list.find(this.indexSelector);
      this.fakeListItems = this.list.find(
        "." + this.options.captionClass + "," + this.indexSelector
      );
      delete this.optionIndex;

      // detect max visible items
      var maxCount = this.options.maxVisibleItems,
        sizeValue = this.element.prop("size");
      if (sizeValue > 1 && !this.element.is("[jcf-size]")) {
        maxCount = sizeValue;
      }

      // handle scrollbar
      var needScrollBar = this.fakeOptions.length > maxCount;
      this.container.toggleClass(this.options.scrollClass, needScrollBar);
      if (needScrollBar) {
        // change max-height
        this.listHolder.css({
          maxHeight: this.getOverflowHeight(maxCount),
          overflow: "auto",
        });

        if (this.options.useCustomScroll && jcf.modules.Scrollable) {
          // add custom scrollbar if specified in options
          jcf.replace(this.listHolder, "Scrollable", {
            handleResize: this.options.handleResize,
            alwaysPreventMouseWheel: this.options.alwaysPreventMouseWheel,
          });
          return;
        }
      }

      // disable edge wheel scrolling
      if (this.options.alwaysPreventMouseWheel) {
        this.preventWheelHandler = function(e) {
          var currentScrollTop = self.listHolder.scrollTop(),
            maxScrollTop =
            self.listHolder.prop("scrollHeight") -
            self.listHolder.innerHeight();

          // check edge cases
          if (
            (currentScrollTop <= 0 && e.deltaY < 0) ||
            (currentScrollTop >= maxScrollTop && e.deltaY > 0)
          ) {
            e.preventDefault();
          }
        };
        this.listHolder.on("jcf-mousewheel", this.preventWheelHandler);
      }
    },
    refreshSelectedClass: function() {
      var self = this,
        selectedItem,
        isMultiple = this.element.prop("multiple"),
        selectedIndex = this.element.prop("selectedIndex");

      if (isMultiple) {
        this.realOptions.each(function(index, option) {
          self.fakeOptions
            .eq(index)
            .toggleClass(self.options.selectedClass, !!option.selected);
        });
      } else {
        this.fakeOptions.removeClass(
          this.options.selectedClass + " " + this.options.hoverClass
        );
        selectedItem = this.fakeOptions
          .eq(selectedIndex)
          .addClass(this.options.selectedClass);
        if (this.options.useHoverClass) {
          selectedItem.addClass(this.options.hoverClass);
        }
      }
    },
    scrollToActiveOption: function() {
      // scroll to target option
      var targetOffset = this.getActiveOptionOffset();
      if (typeof targetOffset === "number") {
        this.listHolder.prop("scrollTop", targetOffset);
      }
    },
    getSelectedIndexRange: function() {
      var firstSelected = -1,
        lastSelected = -1;
      this.realOptions.each(function(index, option) {
        if (option.selected) {
          if (firstSelected < 0) {
            firstSelected = index;
          }
          lastSelected = index;
        }
      });
      return [firstSelected, lastSelected];
    },
    getChangedSelectedIndex: function() {
      var selectedIndex = this.element.prop("selectedIndex"),
        targetIndex;

      if (this.element.prop("multiple")) {
        // multiple selects handling
        if (!this.previousRange) {
          this.previousRange = [selectedIndex, selectedIndex];
        }
        this.currentRange = this.getSelectedIndexRange();
        targetIndex =
          this.currentRange[
            this.currentRange[0] !== this.previousRange[0] ? 0 : 1
          ];
        this.previousRange = this.currentRange;
        return targetIndex;
      } else {
        // single choice selects handling
        return selectedIndex;
      }
    },
    getActiveOptionOffset: function() {
      // calc values
      var dropHeight = this.listHolder.height(),
        dropScrollTop = this.listHolder.prop("scrollTop"),
        currentIndex = this.getChangedSelectedIndex(),
        fakeOption = this.fakeOptions.eq(currentIndex),
        fakeOptionOffset = fakeOption.offset().top - this.list.offset().top,
        fakeOptionHeight = fakeOption.innerHeight();

      // scroll list
      if (fakeOptionOffset + fakeOptionHeight >= dropScrollTop + dropHeight) {
        // scroll down (always scroll to option)
        return fakeOptionOffset - dropHeight + fakeOptionHeight;
      } else if (fakeOptionOffset < dropScrollTop) {
        // scroll up to option
        return fakeOptionOffset;
      }
    },
    getOverflowHeight: function(sizeValue) {
      var item = this.fakeListItems.eq(sizeValue - 1),
        listOffset = this.list.offset().top,
        itemOffset = item.offset().top,
        itemHeight = item.innerHeight();

      return itemOffset + itemHeight - listOffset;
    },
    getScrollTop: function() {
      return this.listHolder.scrollTop();
    },
    setScrollTop: function(value) {
      this.listHolder.scrollTop(value);
    },
    createOption: function(option) {
      var newOption = document.createElement("span");
      newOption.className = this.options.optionClass;
      newOption.innerHTML = option.innerHTML;
      newOption.setAttribute(this.options.indexAttribute, this.optionIndex++);

      var optionImage,
        optionImageSrc = option.getAttribute("data-image");
      if (optionImageSrc) {
        optionImage = document.createElement("img");
        optionImage.src = optionImageSrc;
        newOption.insertBefore(optionImage, newOption.childNodes[0]);
      }
      if (option.disabled) {
        newOption.className += " " + this.options.disabledClass;
      }
      if (option.className) {
        newOption.className +=
          " " +
          getPrefixedClasses(option.className, this.options.cloneClassPrefix);
      }
      return newOption;
    },
    createOptGroup: function(optgroup) {
      var optGroupContainer = document.createElement("span"),
        optGroupName = optgroup.getAttribute("label"),
        optGroupCaption,
        optGroupList;

      // create caption
      optGroupCaption = document.createElement("span");
      optGroupCaption.className = this.options.captionClass;
      optGroupCaption.innerHTML = optGroupName;
      optGroupContainer.appendChild(optGroupCaption);

      // create list of options
      if (optgroup.children.length) {
        optGroupList = this.createOptionsList(optgroup);
        optGroupContainer.appendChild(optGroupList);
      }

      optGroupContainer.className = this.options.groupClass;
      return optGroupContainer;
    },
    createOptionContainer: function() {
      var optionContainer = document.createElement("li");
      return optionContainer;
    },
    createOptionsList: function(container) {
      var self = this,
        list = document.createElement("ul");

      $.each(container.children, function(index, currentNode) {
        var item = self.createOptionContainer(currentNode),
          newNode;

        switch (currentNode.tagName.toLowerCase()) {
          case "option":
            newNode = self.createOption(currentNode);
            break;
          case "optgroup":
            newNode = self.createOptGroup(currentNode);
            break;
        }
        list.appendChild(item).appendChild(newNode);
      });
      return list;
    },
    refresh: function() {
      // check for select innerHTML changes
      if (this.storedSelectHTML !== this.element.prop("innerHTML")) {
        this.rebuildList();
      }

      // refresh custom scrollbar
      var scrollInstance = jcf.getInstance(this.listHolder);
      if (scrollInstance) {
        scrollInstance.refresh();
      }

      // refresh selectes classes
      this.refreshSelectedClass();
    },
    destroy: function() {
      this.listHolder.off("jcf-mousewheel", this.preventWheelHandler);
      this.listHolder.off(
        "jcf-pointerdown",
        this.indexSelector,
        this.onSelectItem
      );
      this.listHolder.off(
        "jcf-pointerover",
        this.indexSelector,
        this.onHoverItem
      );
      this.listHolder.off("jcf-pointerdown", this.onPress);
    },
  });

  // helper functions
  var getPrefixedClasses = function(className, prefixToAdd) {
    return className ?
      className.replace(/[\s]*([\S]+)+[\s]*/gi, prefixToAdd + "$1 ") :
      "";
  };
  var makeUnselectable = (function() {
    var unselectableClass = jcf.getOptions().unselectableClass;

    function preventHandler(e) {
      e.preventDefault();
    }
    return function(node) {
      node.addClass(unselectableClass).on("selectstart", preventHandler);
    };
  })();
})(jQuery, this);

// library for viewportchecker animate
/*
The MIT License (MIT)

Copyright (c) 2014 Dirk Groenen

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
*/
(function($) {
  $.fn.viewportChecker = function(useroptions) {
    // Define options and extend with user
    var options = {
      classToAdd: "visible",
      classToRemove: "invisible",
      classToAddForFullView: "full-visible",
      removeClassAfterAnimation: false,
      offset: 100,
      repeat: false,
      invertBottomOffset: true,
      callbackFunction: function(elem, action) {},
      scrollHorizontal: false,
      scrollBox: window,
    };
    $.extend(options, useroptions);
    // Cache the given element and height of the browser
    var $elem = this,
      boxSize = {
        height: $(options.scrollBox).height(),
        width: $(options.scrollBox).width(),
      };
    /*
     * Main method that checks the elements and adds or removes the class(es)
     */
    this.checkElements = function() {
      var viewportStart, viewportEnd;
      // Set some vars to check with
      if (!options.scrollHorizontal) {
        viewportStart = Math.max(
          $("html").scrollTop(),
          $("body").scrollTop(),
          $(window).scrollTop()
        );
        viewportEnd = viewportStart + boxSize.height;
      } else {
        viewportStart = Math.max(
          $("html").scrollLeft(),
          $("body").scrollLeft(),
          $(window).scrollLeft()
        );
        viewportEnd = viewportStart + boxSize.width;
      }
      // Loop through all given dom elements
      $elem.each(function() {
        var $obj = $(this),
          objOptions = {},
          attrOptions = {};
        //  Get any individual attribution data
        if ($obj.data("vp-add-class"))
          attrOptions.classToAdd = $obj.data("vp-add-class");
        if ($obj.data("vp-remove-class"))
          attrOptions.classToRemove = $obj.data("vp-remove-class");
        if ($obj.data("vp-add-class-full-view"))
          attrOptions.classToAddForFullView = $obj.data(
            "vp-add-class-full-view"
          );
        if ($obj.data("vp-keep-add-class"))
          attrOptions.removeClassAfterAnimation = $obj.data(
            "vp-remove-after-animation"
          );
        if ($obj.data("vp-offset")) attrOptions.offset = $obj.data("vp-offset");
        if ($obj.data("vp-repeat")) attrOptions.repeat = $obj.data("vp-repeat");
        if ($obj.data("vp-scrollHorizontal"))
          attrOptions.scrollHorizontal = $obj.data("vp-scrollHorizontal");
        if ($obj.data("vp-invertBottomOffset"))
          attrOptions.scrollHorizontal = $obj.data("vp-invertBottomOffset");
        // Extend objOptions with data attributes and default options
        $.extend(objOptions, options);
        $.extend(objOptions, attrOptions);
        // If class already exists; quit
        if ($obj.data("vp-animated") && !objOptions.repeat) {
          return;
        }
        // Check if the offset is percentage based
        if (String(objOptions.offset).indexOf("%") > 0) {
          console.log("if string");
          objOptions.offset =
            (parseInt(objOptions.offset) / 100) * boxSize.height;
        }
        // Get the raw start and end positions
        var rawStart = !objOptions.scrollHorizontal ?
          $obj.offset().top :
          $obj.offset().left,
          rawEnd = !objOptions.scrollHorizontal ?
          rawStart + $obj.height() :
          rawStart + $obj.width();
        // Add the defined offset
        var elemStart = Math.round(rawStart) + objOptions.offset,
          elemEnd = !objOptions.scrollHorizontal ?
          elemStart + $obj.height() :
          elemStart + $obj.width();
        if (objOptions.invertBottomOffset) elemEnd -= objOptions.offset * 2;
        // Add class if in viewport
        if (elemStart < viewportEnd && elemEnd > viewportStart) {
          // Remove class
          $obj.removeClass(objOptions.classToRemove);
          $obj.addClass(objOptions.classToAdd);
          // Do the callback function. Callback wil send the jQuery object as parameter
          objOptions.callbackFunction($obj, "add");
          // Check if full element is in view
          if (rawEnd <= viewportEnd && rawStart >= viewportStart)
            $obj.addClass(objOptions.classToAddForFullView);
          else $obj.removeClass(objOptions.classToAddForFullView);
          // Set element as already animated
          $obj.data("vp-animated", true);
          if (objOptions.removeClassAfterAnimation) {
            $obj.one(
              "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
              function() {
                $obj.removeClass(objOptions.classToAdd);
              }
            );
          }
          // Remove class if not in viewport and repeat is true
        } else if ($obj.hasClass(objOptions.classToAdd) && objOptions.repeat) {
          $obj.removeClass(
            objOptions.classToAdd + " " + objOptions.classToAddForFullView
          );
          // Do the callback function.
          objOptions.callbackFunction($obj, "remove");
          // Remove already-animated-flag
          $obj.data("vp-animated", false);
        }
      });
    };
    /**
     * Binding the correct event listener is still a tricky thing.
     * People have expierenced sloppy scrolling when both scroll and touch
     * events are added, but to make sure devices with both scroll and touch
     * are handles too we always have to add the window.scroll event
     *
     * @see  https://github.com/dirkgroenen/jQuery-viewport-checker/issues/25
     * @see  https://github.com/dirkgroenen/jQuery-viewport-checker/issues/27
     */
    // Select the correct events
    if ("ontouchstart" in window || "onmsgesturechange" in window) {
      // Device with touchscreen
      $(document).bind(
        "touchmove MSPointerMove pointermove",
        this.checkElements
      );
    }
    // Always load on window load
    $(options.scrollBox).bind("load scroll", this.checkElements);
    // On resize change the height var
    $(window).resize(function(e) {
      boxSize = {
        height: $(options.scrollBox).height(),
        width: $(options.scrollBox).width(),
      };
      $elem.checkElements();
    });
    // trigger inital check if elements already visible
    this.checkElements();
    // Default jquery plugin behaviour
    return this;
  };
})(jQuery);

// library for scroll https://github.com/chayka/jQuery.Scroolly
// https://github.com/chayka/jQuery.Scroolly
!(function(a, b) {
  "use strict";
  return "function" == typeof define && define.amd ?
    void define(["jquery"], function(c) {
      return b(a, c, !1);
    }) :
    void b(a, a.jQuery || a.Zepto || a.ender || a.$, !0);
})(this, function(a, b, c) {
  "use strict";
  var d;
  return (
    (d = {
      options: {
        timeout: null,
        meter: b(".scroolly"),
        body: document
      },
      theCSSPrefix: "",
      theDashedCSSPrefix: "",
      isMobile: !1,
      isInitialized: !1,
      animFrame: null,
      direction: 0,
      scrollTop: 0,
      scrollCenter: 0,
      scrollBottom: 0,
      docHeight: 0,
      docMiddle: 0,
      winHeight: b(window).height(),
    }),
    (d.scrollLayout = {}),
    (d._isObject = function(a) {
      return "object" == typeof a;
    }),
    (d._isArray = function(a) {
      return a instanceof Array;
    }),
    (d._isNumber = function(a) {
      return a instanceof Number || "number" == typeof a;
    }),
    (d._isString = function(a) {
      return a instanceof String || "string" == typeof a;
    }),
    (d._default = function(a, b, c) {
      void 0 === c && (c = null);
      var e = (b + "").split(".");
      if (a && (d._isObject(a) || d._isArray(a))) {
        var f,
          g = a;
        for (var h in e) {
          if (
            ((f = e[h]), (!d._isObject(g) && !d._isArray(g)) || void 0 === g[f])
          )
            return c;
          g = g[f];
        }
        return g;
      }
      return c;
    }),
    (d.parseCoords = function(a) {
      var b = a.split(/\s*=\s*/),
        c = b[0] || "doc-top",
        e = d.parseCoord(c),
        f = b[1] || e.anchor,
        g = d.parseCoord(f);
      return [e, g];
    }),
    (d.parseCoord = function(a) {
      var b = /((vp|doc|el|con)-)?(top|center|bottom)?/i,
        c = "(\\+|-)?\\s*(\\d+)(\\%|vp|doc|el|con)?",
        d = new RegExp(c, "gi"),
        e = a.match(b),
        f = a.match(d);
      if (!e && !f) return !1;
      var g = e[1] ? e[2] : "vp",
        h = e[3] || "top",
        i = [];
      if (f) {
        d = new RegExp(c, "i");
        for (var j, k, l, m, n, o = 0; o < f.length; o++)
          (j = f[o]),
          (k = j.match(d)),
          (l = k[1] && "-" === k[1] ? -1 : 1),
          (m = (k[2] && parseInt(k[2]) * l) || 0),
          (n = "px"),
          k[3] && (n = "%" === k[3] ? g : k[3]),
          i.push({
            offset: m,
            subject: n
          });
      }
      return {
        original: a,
        subject: g,
        anchor: h,
        offsets: i
      };
    }),
    (d.calculateCoord = function(a, b, c) {
      d._isString(a) && (a = d.parseCoord(a));
      var e = 0;
      if ("vp" === a.subject)
        switch (a.anchor) {
          case "top":
            e = d.scrollTop;
            break;
          case "center":
            e = d.scrollCenter;
            break;
          case "bottom":
            e = d.scrollBottom;
        }
      else if ("doc" === a.subject)
        switch (a.anchor) {
          case "top":
            e = 0;
            break;
          case "center":
            e = d.docMiddle;
            break;
          case "bottom":
            e = d.docHeight;
        }
      else {
        var f = "con" === a.subject ? c : b,
          g = f.outerHeight(),
          h = f.offset().top,
          i = h + g,
          j = h + Math.floor(g / 2);
        switch (a.anchor) {
          case "top":
            e = h;
            break;
          case "center":
            e = j;
            break;
          case "bottom":
            e = i;
        }
      }
      var k, l, m, n;
      for (k = 0; k < a.offsets.length; k++) {
        if (((l = a.offsets[k]), (m = l.offset), "px" !== l.subject)) {
          switch (((n = 0), l.subject)) {
            case "vp":
              n = d.winHeight;
              break;
            case "doc":
              n = d.docHeight;
              break;
            case "el":
              n = b.outerHeight();
              break;
            case "con":
              n = c.outerHeight();
          }
          m = Math.ceil((l.offset / 100) * n);
        }
        e += m;
      }
      return e;
    }),
    (d.cmpCoords = function(a, b, c) {
      return d.calculateCoord(a[0], b, c) - d.calculateCoord(a[1], b, c);
    }),
    (d.isRuleInActiveWidthRange = function(a) {
      var c,
        e,
        f,
        g = d._default(a, "minWidth", 0),
        h = d._default(a, "maxWidth", "infinity"),
        i = d._default(d.options, "meter"),
        j = b(window).width();
      return i.length ?
        ((c = i.length ? parseInt(i.css("min-width")) : 0),
          (e = i.length ? i.css("max-width") : "none"),
          (e = "none" === e ? "infinity" : parseInt(e)),
          (f = c >= g && ("infinity" === h || h >= e))) :
        j > g && ("infinity" === h || h >= j);
    }),
    (d.isRuleActive = function(a, b, c) {
      var e = d.isRuleInActiveWidthRange(a);
      if (!e) return !1;
      var f = d._default(a, "direction", 0),
        g = d.direction;
      if (f && ((f > 0 && 0 > g) || (0 > f && g >= 0))) return !1;
      var h = d._default(a, "from", "0"),
        i = d._default(a, "to", "finish"),
        j = d.cmpCoords(h, b, c);
      if (j > 0) return !1;
      var k = d.cmpCoords(i, b, c);
      return 0 >= k ? !1 : {
        offset: -j,
        length: k - j
      };
    }),
    (d.getScrollLayoutLength = function() {
      return Object.keys ?
        Object.keys(d.scrollLayout).length :
        b.map(d.scrollLayout, function() {
          return 1;
        }).length;
    }),
    (d.addItem = function(a, c, e, f) {
      if (!c.length) return !1;
      f = f || "self";
      var g, h, i, j, k, l, m;
      m = function(a, b, c, e) {
        var f,
          g,
          h = b / c,
          i = d._default(e, "cssFrom"),
          j = d._default(e, "cssTo"),
          k = {};
        for (var l in i)
          (f = i[l]),
          (g = d._default(j, l, f)),
          (k[l] = d.getTransitionValue(f, g, h));
        a.css(d.extendCssWithPrefix(k));
      };
      for (var n in e)
        (g = e[n]),
        (h = !f),
        (i = d._default(g, "from", "doc-top")),
        (d._isString(i) || d._isNumber(i)) &&
        ((i = d.parseCoords("" + i)), (g.from = i)),
        (j = d._default(g, "to", "doc-bottom")),
        (d._isString(j) || d._isNumber(j)) &&
        ((j = d.parseCoords("" + j)), (g.to = j)),
        (k = d._default(g, "cssFrom")),
        (l = d._default(g, "cssTo")),
        k && l && (g.cssOnScroll = m);
      if (c.length > 1)
        return (
          c.each(function(c) {
            for (var g, h, i = [], j = null, k = 0; k < e.length; k++)
              (g = e[k]), (h = {}), b.extend(h, g), i.push(h);
            f &&
              (j =
                "self" === f ? f : f.length > 1 && c < f.length ? b(f[c]) : f),
              d.addItem(a + "-" + c, b(this), i, j);
          }),
          !0
        );
      var o = d._default(d.scrollLayout, a);
      return (
        o ?
        o.rules.concat(e) :
        (d.scrollLayout[a] = {
          element: c,
          container: f,
          rules: e
        }),
        !0
      );
    }),
    (d.factory = function(a, b, c, e) {
      return (
        d.init(),
        a.length && b ?
        ((e = e || a[0].tagName + "_" + d.getScrollLayoutLength()),
          void d.addItem(e, a, b, c, !1)) :
        !1
      );
    }),
    (d.stickItem = function(a, b, c) {
      d.stickItemXY(a, b, c instanceof Array ? c : [c]);
    }),
    (d.stickItemXY = function(a, c, e) {
      e = e || [];
      var f,
        g,
        h,
        i,
        j,
        k,
        l,
        m,
        n = [];
      for (var o in e)
        (f = e[o]),
        (g = d._default(f, "$bottomContainer", b("body"))),
        (h = d._default(f, "mode")),
        (i = d._default(f, "offsetTop", 0)),
        (j = d._default(f, "offsetBottom", 0)),
        (k = d._default(f, "minWidth", 0)),
        (l = d._default(f, "maxWidth", "infinity")),
        (m = d._default(f, "static", !1)),
        "next" === g ?
        ((h = h || "margin"), (g = b(c).next())) :
        ("parent" !== g && g) ||
        ((h = h || "padding"), (g = b(c).parent())),
        m ?
        n.push({
          source: "sticky",
          alias: "static",
          minWidth: k,
          maxWidth: l,
          bottomContainer: g,
        }) :
        (n.push({
            source: "sticky",
            alias: "top",
            minWidth: k,
            maxWidth: l,
            offsetTop: i,
            offsetBottom: j,
            bottomContainer: g,
            mode: h,
          }),
          n.push({
            source: "sticky",
            alias: "fixed",
            minWidth: k,
            maxWidth: l,
            offsetTop: i,
            offsetBottom: j,
            bottomContainer: g,
            mode: h,
          }),
          n.push({
            source: "sticky",
            alias: "bottom",
            minWidth: k,
            maxWidth: l,
            offsetTop: i,
            offsetBottom: j,
            bottomContainer: g,
            mode: h,
          }));
      d.addItem(a, b(c), n);
    }),
    (d.processStickyItemRange = function(a, c) {
      c = c || {};
      var e = d._default(c, "bottomContainer", b("body")),
        f = (d._default(c, "mode"), d._default(c, "offsetTop", 0)),
        g = d._default(c, "offsetBottom", 0),
        h =
        parseInt(a.css("margin-top")) +
        a.height() +
        parseInt(a.css("margin-bottom"));
      "border-box" === a.css("box-sizing") &&
        (h +=
          parseInt(a.css("padding-top")) + parseInt(a.css("padding-bottom")));
      var i =
        parseInt(e.css("margin-top")) +
        e.height() +
        parseInt(e.css("margin-bottom"));
      "border-box" === e.css("box-sizing") &&
        (i +=
          parseInt(e.css("padding-top")) + parseInt(e.css("padding-bottom")));
      var j = Math.round(a.offset().top - parseInt(a.css("margin-top"))),
        k = Math.round(e.offset().top + (i - h - g));
      switch (c.alias) {
        case "top":
          (c.from = 0),
          (c.to = j - f),
          (c.css = {
            position: "absolute",
            top: j + "px"
          }),
          (c.itemHeight = h);
          break;
        case "fixed":
          (c.from = j - f),
          (c.to = k),
          (c.css = {
            position: "fixed",
            top: f + "px"
          }),
          (c.itemHeight = h);
          break;
        case "bottom":
          (c.from = k),
          (c.css = {
            position: "absolute",
            top: k + f + "px"
          }),
          (c.itemHeight = h);
          break;
        case "static":
          (c.from = 0), (c.css = {
            position: "",
            top: ""
          }), (c.itemHeight = 0);
      }
      return c;
    }),
    (d.onResize = function() {
      (d.winHeight = b(window).height()),
      (d.docHeight = d.body.height()),
      (d.docMiddle = Math.floor(d.docHeight / 2));
      var a = !1;
      for (var c in d.scrollLayout) {
        var e,
          f,
          g,
          h = d.scrollLayout[c];
        for (var i in h.rules)
          (e = h.rules[i]),
          (f = d.isRuleInActiveWidthRange(e)),
          (a |= f),
          f &&
          void 0 === e.from &&
          (b(h.element).css("position", ""),
            b(h.element).css("top", ""),
            e.bottomContainer && e.bottomContainer.css("margin-top", ""),
            (g = d._default(e, "source")),
            "sticky" === g &&
            (h.rules[i] = d.processStickyItemRange(h.element, e)));
      }
      return (
        a &&
        ((d.scrollLayout = d.scrollLayout),
          setTimeout(function() {
            d.onScroll(!0);
          }, 0)),
        !0
      );
    }),
    (d.getProgress = function(a, b) {
      var c = a / b;
      return {
        offset: a,
        length: b,
        relative: c,
        left: b - a,
        leftRelative: 1 - c,
      };
    }),
    (d.getTransitionFloatValue = function(a, b, c) {
      return 0 >= c ? a : c >= 1 ? b : a + (b - a) * c;
    }),
    (d.getTransitionIntValue = function(a, b, c) {
      return Math.round(d.getTransitionFloatValue(a, b, c));
    }),
    (d.hashColor2rgb = function(a) {
      var b = a.match(/^#([0-9a-f]{3})$/i);
      return b ? [
          17 * parseInt(b[1].charAt(0), 16),
          17 * parseInt(b[1].charAt(1), 16),
          17 * parseInt(b[1].charAt(2), 16),
        ] :
        (b = a.match(/^#([0-9a-f]{6})$/i)) ? [
          parseInt(b[1].substr(0, 2), 16),
          parseInt(b[1].substr(2, 2), 16),
          parseInt(b[1].substr(4, 2), 16),
        ] : [0, 0, 0];
    }),
    (d.rgb2HashColor = function(a, b, c) {
      var d,
        e,
        f = "#";
      for (var g in arguments)
        (d = arguments[g]),
        (e = d.toString(16)),
        16 > d && (e = "0" + e),
        (f += e);
      return f;
    }),
    (d.getTransitionColorValue = function(a, b, c) {
      if (0 >= c) return a;
      if (c >= 1) return b;
      var e = d.hashColor2rgb(a),
        f = d.hashColor2rgb(b),
        g = d.getTransitionIntValue(e[0], f[0], c),
        h = d.getTransitionIntValue(e[1], f[1], c),
        i = d.getTransitionIntValue(e[2], f[2], c);
      return d.rgb2HashColor(g, h, i);
    }),
    (d.getTransitionValue = function(a, b, c) {
      if (0 >= c) return a;
      if (c >= 1) return b;
      var e = 0;
      if (d._isNumber(a) && d._isNumber(b))
        return d.getTransitionFloatValue(a, b, c);
      var f = /(\d*\.\d+)|(\d+)|(#[0-9a-f]{6})|(#[0-9a-f]{3})/gi,
        g = ("" + b).match(f);
      return ("" + a).replace(f, function(a, b, f, h, i) {
        var j = g[e];
        return (
          e++,
          f && f.length ?
          /\d*\.\d+/.test(j) ?
          d.getTransitionFloatValue(parseFloat(a), parseFloat(j), c) :
          d.getTransitionIntValue(parseInt(a), parseInt(j), c) :
          b && b.length ?
          d.getTransitionFloatValue(parseFloat(a), parseFloat(j), c) :
          (h && h.length) || (i && i.length) ?
          d.getTransitionColorValue(a, j, c) :
          a
        );
      });
    }),
    (d.onScroll = function(a) {
      var b = d.body.scrollTop();
      if (!a && b === d.scrollTop) return !1;
      var c = d.scrollTop,
        e = d.direction;
      (d.scrollTop = b),
      (d.scrollBottom = b + d.winHeight),
      (d.scrollCenter = b + Math.floor(d.winHeight / 2)),
      (d.direction = b - c);
      var f,
        g,
        h,
        i,
        j,
        k,
        l,
        m,
        n,
        o,
        p,
        q,
        r,
        s,
        t,
        u,
        v = !(
          d.direction === e ||
          (d.direction < 0 && 0 > e) ||
          (d.direction > 0 && e > 0)
        );
      for (k in d.scrollLayout) {
        for (
          f = d.scrollLayout[k],
          g = f.rules.length,
          h = [],
          i = [],
          j = [],
          l = 0; g > l; l++
        )
          (o = f.rules[l]),
          (p = d._default(o, "minWidth", 0)),
          (q = d._default(o, "maxWidth", "infinity")),
          (r = "self" === f.container ? f.element : f.container),
          (o.checkin = d.isRuleActive(o, f.element, r)),
          (o["class"] =
            o["class"] ||
            "scroll-pos-" + o.alias + " window-width-" + p + "-to-" + q),
          o.checkin ?
          (j.push(l), o.isActive || ((o.isActive = !0), h.push(l))) :
          o.isActive && ((o.isActive = !1), i.push(l)),
          (f.rules[l] = o);
        for (n = 0; n < i.length; n++)
          (l = i[n]),
          (o = f.rules[l]),
          f.element.removeClass(o["class"]),
          o.cssOnScroll &&
          ((m = o.length || 0),
            o.cssOnScroll(f.element, b > c ? m : 0, m, o)),
          o.onScroll &&
          ((m = o.length || 0), o.onScroll(f.element, b > c ? m : 0, m, o)),
          o.onCheckOut && o.onCheckOut(f.element, o),
          o.onTopOut && c > b ?
          o.onTopOut(f.element, o) :
          o.onBottomOut && b > c && o.onBottomOut(f.element, o);
        for (n = 0; n < h.length; n++)
          (l = h[n]),
          (o = f.rules[l]),
          o.css && f.element.css(d.extendCssWithPrefix(o.css)),
          o.addClass && f.element.addClass(o.addClass),
          o.removeClass && f.element.removeClass(o.removeClass),
          f.element.addClass(o["class"]),
          (s = d._default(o, "bottomContainer")),
          (t = d._default(o, "mode")),
          (u = d._default(o, "itemHeight")),
          s && t && u && s.css(t + "-top", u + "px"),
          o.onCheckIn && o.onCheckIn(f.element, o),
          o.onTopIn && b > c ?
          o.onTopIn(f.element, o) :
          o.onBottomIn && c > b && o.onBottomIn(f.element, o),
          (o.length = o.checkin.length);
        for (n = 0; n < j.length; n++)
          (l = j[n]),
          (o = f.rules[l]),
          o.cssOnScroll &&
          o.cssOnScroll(f.element, o.checkin.offset, o.checkin.length, o),
          o.onScroll &&
          o.onScroll(f.element, o.checkin.offset, o.checkin.length, o),
          v &&
          o.onDirectionChanged &&
          o.onDirectionChanged(f.element, d.direction, o);
        d.scrollLayout[k] = f;
      }
    }),
    (d.detectCSSPrefix = function() {
      var a = /^(?:O|Moz|webkit|ms)|(?:-(?:o|moz|webkit|ms)-)/;
      if (window.getComputedStyle) {
        var b = window.getComputedStyle(document.body, null);
        for (var c in b)
          if (
            ((d.theCSSPrefix = c.match(a) || (+c === c && b[c].match(a))),
              d.theCSSPrefix)
          )
            break;
        if (!d.theCSSPrefix)
          return void(d.theCSSPrefix = d.theDashedCSSPrefix = "");
        (d.theCSSPrefix = d.theCSSPrefix[0]),
        "-" === d.theCSSPrefix.slice(0, 1) ?
          ((d.theDashedCSSPrefix = d.theCSSPrefix),
            (d.theCSSPrefix = {
              "-webkit-": "webkit",
              "-moz-": "Moz",
              "-ms-": "ms",
              "-o-": "O",
            } [d.theCSSPrefix])) :
          (d.theDashedCSSPrefix = "-" + d.theCSSPrefix.toLowerCase() + "-");
      }
    }),
    (d.cssPrefix = function(a) {
      return d.theDashedCSSPrefix + a;
    }),
    (d.extendCssWithPrefix = function(a) {
      var c,
        e,
        f,
        g,
        h,
        i = {};
      for (c in a)
        (e = /^-(moz-|webkit-|o-|ms-)?/i),
        (f = c.match(e)),
        (g = c.slice(1)),
        f &&
        !f[1] &&
        ((h = a[c]), (i[g] = h), (i[d.cssPrefix(g)] = h), delete a[c]);
      return b.extend(a, i), a;
    }),
    (d.now =
      Date.now ||
      function() {
        return +new Date();
      }),
    (d.getRAF = function() {
      var a =
        window.requestAnimationFrame ||
        window[d.theCSSPrefix.toLowerCase() + "RequestAnimationFrame"],
        b = d.now();
      return (
        a ||
        (a = function(a) {
          var c = d.now() - b,
            e = Math.max(0, 1e3 / 60 - c);
          return window.setTimeout(function() {
            (b = d.now()), a();
          }, e);
        }),
        a
      );
    }),
    (d.getCAF = function() {
      var a =
        window.cancelAnimationFrame ||
        window[d.theCSSPrefix.toLowerCase() + "CancelAnimationFrame"];
      return (
        (d.isMobile || !a) &&
        (a = function(a) {
          return window.clearTimeout(a);
        }),
        a
      );
    }),
    (d.animLoop = function() {
      d.onScroll(), (d.animFrame = window.requestAnimFrame(d.animLoop));
    }),
    (d.init = function(a) {
      return d.isInitialized ?
        !1 :
        (b.extend(d.options, a),
          (d.isMobile = d._default(
            d.options,
            "isMobile",
            /Android|iPhone|iPad|iPod|BlackBerry/i.test(
              navigator.userAgent || navigator.vendor || window.opera
            )
          )),
          d.detectCSSPrefix(),
          (d.body = b(d.options.body)),
          (window.requestAnimFrame = d.getRAF()),
          (window.cancelAnimFrame = d.getCAF()),
          (d.timesCalled = 0),
          b(document).ready(function() {
            b(window).resize(d.onResize).resize(), d.animLoop();
          }),
          void(d.isInitialized = !0));
    }),
    (d.destroy = function() {
      window.cancelAnimFrame(d.animFrame);
    }),
    (d.factorySticky = function(a, b, c) {
      return (
        (c = c || a[0].tagName + "_" + d.getScrollLayoutLength()),
        d.stickItemXY(c, a, b instanceof Array ? b : [b]) ? c : !1
      );
    }),
    c &&
    ((b.scroolly = d),
      (b.fn.scroolly = function(a, b, c) {
        return d.factory(this, a, b, c), this;
      }),
      (b.fn.scroollySticky = function(a, b) {
        return d.init(), this.length ? d.factorySticky(this, a, b) : !1;
      })),
    d
  );
});

//-------- -------- -------- --------
//-------- included js libs end
//-------- -------- -------- --------