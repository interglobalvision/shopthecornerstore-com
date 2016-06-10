/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    if ($('body').hasClass('post-type-archive-editorial')) {
      $('.archive-title').on('mouseover',function() {
        _this.showArchiveImage( $(this).attr('data-id') );
      });
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

  showArchiveImage: function(id) {
    $('.archive-image').hide();
    $('.archive-image[data-id=' + id + ']').show();
  }
};

jQuery(document).ready(function () {
  'use strict';

  Site.init(); 

});