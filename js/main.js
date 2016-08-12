/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr, Swiper */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    if ($('body').hasClass('single-editorial')) {
      _this.Editorial.Single.init();
    } 

    if ($('body').hasClass('post-type-archive-editorial')) {
      _this.Editorial.Archive.init();
    } 

    if ($('.splash-swiper').length) {
      _this.Splash.init();
    } 

    if ($('body').hasClass('woocommerce')) {
      _this.Shop.init();
    }

    if ($('body').hasClass('blog')) {
      _this.Journal.init();
    }

  },

  onResize: function() {
    var _this = this;

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
  },

  Search: {
    init: function() {
      var _this = this;

      if ($('#searchform').length) {
        _this.bindFocus();
      }
    },

    bindFocus: function() {
      $('#searchform').on('click', function(e) {
        if (!$(this).hasClass('active')) {
          e.preventDefault();

          $(this).addClass('active');
          $('#s').focus();
        }
      })
    },

  },

}

Site.Journal = {
  init: function() {
    if ($('.journal-container').length) {
      $('.journal-container').masonry({
        itemSelector: '.journal-post',
      }); 
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

    init: function() {
      var _this = this;

      var swiper = new Swiper('.swiper-container', {
        preloadImages: false,
        lazyLoading: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        onInit: function(swiper) {
          _this.updateProductDetails();
        },
        onSlideChangeStart: function(swiper) {
          $('.product-details').hide();
        },
        onSlideChangeEnd: function(swiper) {
          _this.updateProductDetails();
        }
      });

    },

    updateProductDetails: function() {
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

        $('.product-details').show();
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

      $('.archive-image').hide();
      $('.archive-image[data-id=' + id + ']').show();
    }

  },

};

jQuery(document).ready(function () {
  'use strict';

  Site.init();

});