/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Site, Swiper */

Site = {
  mobilethreshold: 601,
  init: function() {
    var _this = this;

//     Site.Layout.init();

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

//       Site.Layout.layout();

      if ($('#splash-video').length) {
        $('#splash-video').coverVid(1920, 1080).addClass('show');
      } else if ($('.splash-swiper').length) {
        _this.Splash.init();
      }

      if ($('body').hasClass('blog')) {
        _this.Journal.init();

        $(window).bind('resizeEnd', function() {
          _this.Journal.masonryLayout();
        });
        // bind end of resize event triggered by resizeDelay()
      }

      if ($('body').hasClass('single-editorial')) {
        _this.Editorial.Single.init();
      }

      if ($('body').hasClass('post-type-archive-editorial')) {
        _this.Editorial.Archive.init();
      }

      if ($('#products-stacey-nishimoto').length) {
        _this.StaceyNishimotoCatalog.init();
      }

      _this.Shop.init();

      _this.bindMenuToggle();

      if ($('.newsletter-form').length && WP.mailchimp !== null) {
        _this.Mailchimp.init();
      }

      if ($('#newsletter-popup').length && !$('body').hasClass('home')) {
        _this.Popup.init();
      }

      _this.fixWidows();

    });

  },

  onResize: function() {
    var _this = this;

    _this.resizeDelay();
  },

  resizeDelay: function() {
    var resizeTimer;

    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      $(window).trigger('resizeEnd');
    }, 500);
  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },

  bindMenuToggle: function() {
    $('#toggle-menu').on('click', function() {
      $('body').toggleClass('mobile-menu-active');
    });
  },
};

Site.Popup = {
  init: function() {
    var _this = this;

    // Check popup cookie
    var showPopup = Cookies.get('show-popup');

    if(typeof showPopup === 'undefined') { // Cookie is not set
      showPopup = true; // Default to true
    } else { // Cookie is set
      showPopup = parseInt(showPopup); // Parse the value of the cookie
    }

    if (showPopup) {
      _this.bindCloseButton();
      _this.showPopup();
    } else {
      $('.newsleter-popup').remove(); // Remove the popup element from the DOM
    }
  },

  bindCloseButton: function() {
    var _this = this;

    $('#close-popup').on('click', _this.closePopup);
  },

  showPopup: function() {
    setTimeout( function() {
      $('body').addClass('show-popup');
    }, 4000); // Delayfor 4 sec

    // Get how many times the popup has been shown from cookies
    var cookieCount = Cookies.get('popup-count') || 0; // Defaults to 0

    cookieCount = parseInt(cookieCount) + 1; // Increase the count

    if (cookieCount > 2) {
      Cookies.set('show-popup', 0, { expires: 90 }); // Disable popup for 90 days
    }

    Cookies.set('popup-count', cookieCount, { expires: 30 }); // Save new count or 30 days
  },

  closePopup: function(disable) {
    $('body').removeClass('show-popup');

    if(disable) {
      Cookies.set('show-popup', 0, { expires: 90 }); // Disable popup for 90 days
    }
  },
};

Site.Shop = {
  init: function() {
    if ($('body').hasClass('single-product')) {
      this.Product.init();
    }

    if ($('#products')) {
      this.ToggleProducts.init();
    }

    this.Cart.init();
  },

  Cart: {
    init: function() {
      this.$updateNotice = $('#cart-update-notice');

      this.handleCartUpdate = this.handleCartUpdate.bind(this);

      this.bindCartUpdate();
    },

    bindCartUpdate: function() {
      window.addEventListener('gwsCartUpdate', this.handleCartUpdate);
    },

    handleCartUpdate: function(e) {
      const context = e.detail.context;
      const variant = e.detail.variant;

      switch (context) {
        case 'added':
          this.handleItemAdded(variant);
          break;
        case 'removed':
          this.handleItemRemoved();
          break;
        case 'incart':
          this.handleItemAdded();
          break;
        default:
          console.log('context undefined');
      }
    },

    handleItemAdded: function(variant) {
      this.displayCartNotice('Item added');
    },

    handleItemRemoved: function() {
      console.log('removed');
    },

    displayCartNotice: function(notice) {
      this.$updateNotice.text(notice).fadeIn(300).delay(1000).fadeOut(500).text();
    }
  },

  ToggleProducts: {
    init: function() {
      var _this = this;

      if($('.toggle-sold').length) {
        // bind on click
        $('.toggle-sold').on('click', function(event) {
          event.preventDefault();

          // Check if products are hidden
          if($('body').hasClass('hidden-products')) {
            // show sold out products
            $('body').removeClass('hidden-products');
            $('.shop-product[data-gws-available="false"]').fadeIn(300);
          } else {
            // hide sold out products
            $('.shop-product[data-gws-available="false"]').fadeOut(300, function() {
              $('body').addClass('hidden-products');
            });
          }
        });

      }
    }
  },

  Product: {
    init: function() {
      var _this = this;

      if ($('.swiper-container').length) {
        _this.initSwiper();
      }
    },

    initSwiper: function() {
      var _this = this;

      _this.$sliderPrev = $('.slider-prev');
      _this.$sliderNext = $('.slider-next');

      _this.swiper = new Swiper('.swiper-container', {
        speed: 800,
        spaceBetween: 0,
        setWrapperSize: true,
        slidesPerView: 2,
        slidesPerGroup: 2,
        breakpoints: {
          // when window width is <= 600px
          600: {
            slidesPerView: 1,
            slidesPerGroup: 1,
          }
        },
        onInit: function(swiper) {
          // show slider
          $('.swiper-container').css('visibility','visible');

          // conditionally hide slider/product pagination
          if (swiper.isBeginning && !$('.slider-prev').is('[href]')) {
            $('.slider-prev').hide();
          }

          if (swiper.isEnd && !$('.slider-next').is('[href]')) {
            $('.slider-next').hide();
          }
        }
      });

      _this.bindPagination();
    },

    bindPagination: function() {
      var _this = this;

      // Prev moves gallery until first slide, then allows <a> link
      _this.$sliderPrev.on('click', function(e) {
        var href = $(this).attr('href');

        if (!_this.swiper.isBeginning || typeof href == typeof undefined || href == false) {
          e.preventDefault();
          _this.swiper.slidePrev();
        }
      });

      // Next moves gallery until last slide, then allows <a> link
      _this.$sliderNext.on('click', function(e) {
        var href = $(this).attr('href');

        if (!_this.swiper.isEnd || typeof href == typeof undefined || href == false) {
          e.preventDefault();
          _this.swiper.slideNext();
        }
      });
    }
  },
};

Site.StaceyNishimotoCatalog = {
  init: function() {
    var _this = this;

    if ($('.swiper-container').length) {
      _this.initSwiper();
    }
  },

  initSwiper: function() {
    var _this = this;

    _this.swiper = new Swiper('.swiper-container', {
      speed: 800,
      spaceBetween: 0,
      setWrapperSize: true,
      slidesPerView: 1,
      nextButton: '.swiper-next',
      prevButton: '.swiper-prev',
      loop: true,
      onInit: function(swiper) {
        // show slider
        $('.swiper-container').css('visibility','visible');
      }
    });
  }
}

Site.Journal = {
  init: function() {
    if ($('#journal-container').length) {
      $('#journal-container').masonry({
        itemSelector: '.journal-post',
        transitionDuration: 0,
      });

      $('#journal-container').imagesLoaded().progress( function() {
        $('#journal-container').masonry('layout');
      });
    }
  },

  masonryLayout: function() {
    if ($('#journal-container').length) {
      $('#journal-container').masonry('layout');
    }
  },

};

Site.Splash = {
  init: function() {
    var _this = this;

    _this.swiper = new Swiper('.swiper-container', {
      autoplay: 3000,
      loop: true,
      speed: 1500,
      effect: 'fade',
      fade: {
        crossFade: false
      },
    });
  },

};

Site.Editorial = {

  Single: {
    init: function() {
      var _this = this;

      var swiper = new Swiper('.swiper-container', {
        loop: false,
        speed: 800,
        spaceBetween: 36,
        nextButton: '.slider-next',
        prevButton: '.slider-prev',
        setWrapperSize: true,
        onInit: function(swiper) {
          $('.swiper-container').css('visibility','visible');
          _this.updateProductDetails(swiper);
        },
        onSlideChangeStart: function(swiper) {
          _this.updateProductDetails(swiper);

          if (swiper.isBeginning) {
            $('.slider-prev').hide();
            $('.slider-next').show();
          } else if (swiper.isEnd) {
            $('.slider-prev').show();
            $('.slider-next').hide();
          } else {
            $('.slider-prev').show();
            $('.slider-next').show();
          }
        }
      });
    },

    updateProductDetails: function(swiper) {
      var _this = this;

      if ($('.swiper-slide-active').attr('data-product-1') || $('.swiper-slide-active').attr('data-product-2')) {
        for(var prod = 1; prod < 3; prod++) {
          if ($('.swiper-slide-active').attr('data-product-' + prod)) {
            var productData = JSON.parse($('.swiper-slide-active').attr('data-product-' + prod));

            $('.slider-product-' + prod +'-details .js-product-title').html(productData['title']).attr('href',productData['url']);
            $('.slider-product-' + prod +'-details .js-product-content').html(productData['content']);
            $('.slider-product-' + prod +'-details .js-product-price').removeClass('u-hidden').html(productData['price']);
            $('.slider-product-' + prod +'-details .js-product-attributes').html(productData['attributes']);

            if (productData['stock']) {
              $('.slider-product-' + prod +'-details .js-product-button').html(productData['button_text']).removeClass('u-hidden');
              $('.slider-product-' + prod +'-details .js-product-id').attr('value',productData['id']);
              $('.slider-product-' + prod +'-details .js-product-sold').addClass('u-hidden');
            } else {
              $('.slider-product-' + prod +'-details .js-product-price').addClass('u-hidden');
              $('.slider-product-' + prod +'-details .js-product-sold').removeClass('u-hidden').html(productData['availability']['availability']);
              $('.slider-product-' + prod +'-details .js-product-button').addClass('u-hidden');
            }

            $('.slider-product-' + prod +'-details').show();
            $('.slider-credits').hide();
          } else {
            $('.slider-product-' + prod +'-details, .slider-credits').hide();
          }
        }
      } else if (swiper.isEnd) {
        $('.slider-product-details').hide();
        $('.slider-credits').show();
      } else {
        $('.slider-product-details').hide();
      }
    },
  },

  Archive: {

    init: function() {
      var _this = this;

      $('.archive-title').on('mouseover',function() {
        _this.showImage( $(this).attr('data-id') );
      });
    },

    showImage: function(id) {
      $('.archive-editorial-image').hide();
      $('.archive-editorial-image[data-id=' + id + ']').show();
    }
  },
};

Site.Mailchimp = {
  $form: $('.newsletter-form'),
  init: function() {
    var _this = this;

    _this.successCallback = _this.successCallback.bind(_this);

    _this.$form.submit(function(e) {
      e.preventDefault();

      var email = $(this).children('.newsletter-email').val();
      _this.$reply = $(this).children('.newsletter-reply');

      _this.subscribe(email);

    });

  },

  subscribe: function(email) {
    var _this = this;

    // Rewrite action URL for JSONP
    var url = WP.mailchimp.replace('/post?', '/post-json?').concat('&c=?');

    // Ajax post to Mailchimp API
    $.ajax({
      url: url,
      data: {
        EMAIL: email,
      },
      success: _this.successCallback,
      dataType: 'jsonp',
      error: function (resp, text) {
        console.log('mailchimp ajax submit error: ' + text);
      }
    });
  },

  successCallback: function(response) {
    var _this = this;

    var msg = '';

    if (response.result === 'success') {
      // Clean input
      $('.newsletter-email').val('');

      // Success message
      msg = 'You\'ve been successfully subscribed';
    } else {
      // Make error message from API response
      var index = -1;

      try {
        var parts = response.msg.split(' - ', 2);

        if (parts[1] === undefined) {
          msg = response.msg;
        } else {
          var i = parseInt(parts[0], 10);

          if (i.toString() === parts[0]) {
            index = parts[0];
            msg = parts[1];
          } else {
            index = -1;
            msg = response.msg;
          }
        }
      }
      catch (e) {
        index = -1;
        msg = response.msg;
      }
    }

    // Show message
    _this.$reply.html(msg);

    // If the popup is showing
    if ($('body').hasClass('show-popup')) {
      // close popup after 3 sec
      setTimeout(function() {
        Site.Popup.closePopup(true);
      }, 3000);
    }
  },
};

Site.init();
