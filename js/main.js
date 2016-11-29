/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Site, Swiper */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

//     Site.Layout.init();

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

//       Site.Layout.layout();

      if ($('.splash-swiper').length) {
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

      if ($('body').hasClass('woocommerce')) {
        _this.Shop.init();
      }

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

};

Site.Shop = {
  init: function() {
    var _this = this;

    this.Search.init();

    if ($('body').hasClass('single-product')) {
      _this.Product.init();
    }
  },

  Search: {
    init: function() {
      var _this = this;

      if ($('#searchform').length) {
        if (!$('#s').val()) {
          $('#searchform').addClass('active');
        }
        _this.bindFocus();
        _this.bindFocusOut();
      }
    },

    bindFocus: function() {
      $('#searchform').on('click', function(e) {
        if (!$(this).hasClass('active')) {
          e.preventDefault();

          $(this).addClass('active');
          $('#s').focus();
        }
      });
    },

    bindFocusOut: function() {
      $('#s').on('focusout', function() {
        if(!$(this).val()) {
          $('#searchform').removeClass('active');
        }
      });
    },

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
        spaceBetween: 36,
        setWrapperSize: true,
        onInit: function() {
          $('.swiper-container').css('visibility','visible');
        },
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
            $('.slider-product-' + prod +'-details .js-product-price').html(productData['price']);
            $('.slider-product-' + prod +'-details .js-product-attributes').html(productData['attributes']);

            if (productData['stock']) {
              $('.slider-product-' + prod +'-details .js-product-button').html(productData['button_text']).removeClass('u-hidden');
              $('.slider-product-' + prod +'-details .js-product-id').attr('value',productData['id']);
              $('.slider-product-' + prod +'-details .js-product-sold').addClass('u-hidden');
            } else {
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

Site.init();
