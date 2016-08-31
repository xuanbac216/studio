+function ($) {
    if ($.support.pjax) {
      $.pjax.defaults.maxCacheLength = 0;
      var container = $('#ajax-container');
      $(document).on('click', 'a[data-pjax], .jp-title a, a', function(event) {
        var ids = ['change-avatar', 'change-cover-image', 'group-avatar', 'group-cover-image'];
        if($("#ajax-container").length == 0 || event.currentTarget.href.indexOf('redirect') > -1 || $.inArray($(this).attr('id'), ids) !== -1 || $(this).hasClass('no-ajax')){
          return;
        }
        $.pjax.click(event, {container: container, timeout: 6000, fragment: '#ajax-container'});
      });

      $(document).on('pjax:start', function() { NProgress.start(); });
      // fix js
      $(document).on('pjax:end', function() {
        NProgress.done();
          // fix edd ajax cart
        $( ".edd-add-to-cart.edd-no-js" ).each(function() {
          ($( this ).css('display') != 'none') && $( this ).css('display','none').prev().css('display','inline-block');
        });
        // fix masonry
        $('#masonry').tile();
        // fix mediaelement
        $(container).find('audio,video').mediaelementplayer();

        $( document ).trigger( "pjaxEnd" );
      });
    }
}(jQuery);
