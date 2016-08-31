+function ($) {
  $(document).ready(function(){
    var id, playlist=[];
    $(document).on('click', '.playlist-me', function(e){
      id = $(this).attr("data-c-id");
      // get the playlist
      $.ajax({
         type : "get",
         dataType : "json",
         url : ajax_object.ajaxurl,
         data : {action: "playlist", id : id},
         success: function(obj) {
            process(obj);
            // open modal
            $('#playlists').modal('show');
            $('#playlist-new').show();
         }
      });
    });

    $(document).on('click', '#playlist-thumb, #playlist-title', function(e){
      $('#playlists').modal('hide');
    });

    $(document).on('click', '#playlist-new-save', function(e){
      var title = $("#playlist-new-title").val();
      var that = $(this);
      that.prop('disabled', 'disabled');
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajax_object.ajaxurl,
         data : {action: "playlist", id: id, title: title, type: 1}
      }).done(function( obj ) {
        process(obj);
        $('#playlist-new').hide();
        that.prop('disabled', false);
        $("#playlist-new-title").val('');
      });
    });

    $(document).on('click', '#playlist-remove', function(e){
      var $el  = $(this).closest('.playlist-list-item');
      var $pid = $el.attr('pid');
      $.each(playlist, function( index, value ) {
        if($pid == playlist[index]['id']){
          playlist.splice( index, 1);
          return false;
        }
      });
      
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajax_object.ajaxurl,
         data : {action: "playlist", pid: $pid, type: 2}
      }).done(function( obj ) {
        renderPlaylist();
      });
    });

    $(document).on('click', '#playlist-add', function(e){
      var that = $(this);
      that.prop('disabled', 'disabled');
      var $el  = $(this).closest('.playlist-list-item');
      var $pid = $el.attr('pid');
      var $obj = getObj($pid, playlist);
      $obj['tracks'].unshift(id);
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajax_object.ajaxurl,
         data : {action: "playlist", id: id, type: 3, pid: $pid, tracks: $obj['tracks']}
      }).done(function( obj ) {
        that.prop('disabled', false);
        renderPlaylist();
      });
    });

    $(document).on('click', '#playlist-del', function(e){
      var that = $(this);
      that.prop('disabled', 'disabled');
      var $el  = $(this).closest('.playlist-list-item');
      var $pid = $el.attr('pid');
      var $obj = getObj($pid, playlist);
      $obj['tracks'].splice( $.inArray(id, $obj['tracks']), 1);
      $.ajax({
         type : "post",
         dataType : "json",
         url : ajax_object.ajaxurl,
         data : {action: "playlist", id: id, type: 3, pid: $pid, tracks: $obj['tracks']}
      }).done(function( obj ) {
        that.prop('disabled', false);
        renderPlaylist();
      });
    });

    function process(obj){
      // show error
      if(obj.status == 0){

      }

      // requre logged in
      if(obj.status && obj.redirect){
        location.href = obj.redirect;
        return;
      }

      // playlist
      if(obj.playlist && obj.type == 0){
        playlist = obj.playlist;
      }

      // polulate new
      if(obj.status && obj.type == 1){
        playlist.unshift(obj.playlist);
      }

      renderPlaylist();

    }

    function renderPlaylist(){
      // render list
      $('#playlist-list').empty();

      $.each(playlist, function(index, value){
        $el = $( "#playlist-list-item > div" ).clone();
        $el.attr('pid', value['id']);
        $el.find('#playlist-thumb img').attr('src', value['thumb'] );
        $el.find('#playlist-title').html( value['title'] );
        $el.find('#playlist-count').html( value['tracks'].length );
        $el.find('#playlist-thumb').attr('href', value['url']);
        $el.find('#playlist-title').attr('href', value['url']);
        if( $.inArray( id, value['tracks'] ) !== -1 ){
          $el.find('#playlist-del').show();
          $el.find('#playlist-add').hide();
        }else{
          $el.find('#playlist-del').hide();
          $el.find('#playlist-add').show();
        }

        $('#playlist-list').append($el);
      })
    }

    function getObj(key, objs){
      var $obj = false;
      $.each(objs, function( index, value ) {
        if(key == objs[index]['id']){
          $obj = objs[index];
          return;
        }
      });
      return $obj;
    }

  });
}(jQuery);
