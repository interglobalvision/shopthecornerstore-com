/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr, Swiper */

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
      }

      $(window).bind('resizeEnd', function() {
        _this.Journal.masonryLayout();
      });
      // bind end of resize event triggered by resizeDelay()

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

Site.Layout = {
  init: function() {
    var _this = this;

    _this.$mainContentHolder = $('#main-content-holder');
    _this.$mainContent = $('#main-content');
    _this.$header = $('#header');
    _this.$footer = $('#footer');

    _this.windowHeight = $(window).height();
    _this.windowWidth = $(window).width();

    _this.layout();
  },

  onResize: function() {
    var _this = this;

    _this.windowHeight = $(window).height();
    _this.windowWidth = $(window).width();

    _this.layout();
  },

  layout: function() {
    var _this = this;

    _this.$mainContentHolder.css({
      'height': 'auto'
    });

    if (_this.$mainContent.height() < _this.windowHeight) {

      var height = _this.windowHeight - (_this.$header.outerHeight(true) + _this.$footer.outerHeight(true));

      _this.$mainContentHolder.css({
        'height': height
      });
    }

  },
};

Site.Shop = {
  init: function() {
    var _this = this;

    this.Search.init();
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

}

Site.Journal = {
  init: function() {
    if ($('#journal-container').length) {
      $('#journal-container').masonry({
        itemSelector: '.journal-post',
        transitionDuration: 0,
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

    var swiper = new Swiper('.swiper-container', {
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
    $productDetails: $('.slider-product-details'),

    init: function() {
      var _this = this;

      var swiper = new Swiper('.swiper-container', {
        preloadImages: false,
        lazyLoading: true,
        loop: true,
        nextButton: '.button-next',
        prevButton: '.button-prev',
        onInit: function(swiper) {
          _this.updateProductDetails();
        },
        onSlideChangeStart: function(swiper) {
          _this.$productDetails.addClass('u-invisible');
        },
        onSlideChangeEnd: function(swiper) {
          _this.updateProductDetails();
        }
      });

    },

    updateProductDetails: function() {
      var _this = this;

      if ($('.swiper-slide-active').attr('data-product')) {
        var productData = JSON.parse($('.swiper-slide-active').attr('data-product'));

        $('.js-product-title').html(productData['title']).attr('href',productData['url']);
        $('.js-product-content').html(productData['content']);
        $('.js-product-price').html(productData['price']);

        if (productData['stock']) {
          $('.js-product-button').html(productData['button_text']).removeClass('u-hidden');
          $('.js-product-id').attr('value',productData['id']);
          $('.js-product-sold').addClass('u-hidden');
        } else {
          $('.js-product-sold').removeClass('u-hidden').html(productData['availability']['availability']);
          $('.js-product-button').addClass('u-hidden');
        }

        _this.$productDetails.removeClass('u-invisible');
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
      var _this = this;

      $('.archive-editorial-image').hide();
      $('.archive-editorial-image[data-id=' + id + ']').show();
    }

  },

};

Site.init();