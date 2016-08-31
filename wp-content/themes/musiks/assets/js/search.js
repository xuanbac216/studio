+function ($) {
  var timeoutID = null;
  function findMember(query) {
    var $wrap = $('.navbar-form .dropdown-menu')
    $.ajax({
        type : 'post',
        url : ajax_object.ajaxurl,
        data : {
            action : 'load_search_results',
            query : query
        },
        beforeSend: function() {
            $wrap.find('#ajax-search-loading').removeClass('hide');
            $wrap.find('#ajax-search-results').html('');
        },
        success : function( response ) {
            $wrap.find('#ajax-search-loading').addClass('hide');
            $wrap.find('#ajax-search-results').html( response );
        }
    });
  }

  $(document).on('keyup', '.navbar-form input', function(e){
    var $target = $(this);
    if(!$target.val()){
      if($('#ajax-search').hasClass('open')){
        $("#ajax-search-toggle").dropdown('toggle');
      }
      return;
    }
    if(!$('#ajax-search').hasClass('open')){
      $("#ajax-search-toggle").dropdown('toggle');
    }
    clearTimeout(timeoutID);
    timeoutID = setTimeout(function() { findMember($target.val()); }, 500); 
  });

}(jQuery);
