/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    if ($('.single-editorial').length) {
      _this.Editorial.Single.init();
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

};

jQuery(document).ready(function () {
  'use strict';

  Site.init();

});