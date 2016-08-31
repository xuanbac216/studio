<script>
    var api = 'https://api.soundcloud.com/resolve.json?url=',
        clientid = '&client_id=<?php echo get_theme_mod( "soundcloud-clientid")?>';
    jQuery(document).ready(function(){
      var el = jQuery('._post_meta_soundcloud_trackurl');
      el.parent().append('<a class="button get_sc_id" style="margin-top:25px">Get</a>');

      jQuery(document).on('click', '.get_sc_id', function(){
        var url = el.val(),
            _url = api+url+clientid,
            that = jQuery(this);
        if(that.hasClass('disabled')) return;
        that.addClass('disabled');
        if(url == '') return;
        jQuery.ajax({
          url: _url,
          method: "GET"
        }).done(function( obj ) {
          jQuery('._post_meta_soundcloud_trackid').val(obj.id);
          that.removeClass('disabled');
        }).fail(function( jqXHR, textStatus ) {
          that.removeClass('disabled');
          alert( "Request failed: " + textStatus );
        });
      })
    });
  </script>

<?php
/*
Title: Music Fields
Description: this is the description
Post Type: download
Order: 1
Collapse: false
*/
  piklist('field', array(
    'type' => 'select'
    ,'field' => 'music_type'
    ,'label' => esc_html__('Type','musik')
    ,'description' => esc_html__('Default is single, select bundle when this is a bundle product.','musik')
    ,'choices' => array(
      'single' => 'Single'
      ,'bundle' => 'Bundle'
    )
    ,'value' => 'single'
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'preview_type'
    ,'label' => esc_html__('Preview','musik')
    ,'choices' => array(
      'local' => 'Local'
      ,'remote' => 'Remote'
    )
    ,'conditions' => array(
      array(
        'field' => 'music_type'
        ,'value' => 'single'
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));

  piklist('field', array(
    'type' => 'file'
    ,'field' => 'preview'
    ,'scope' => 'post_meta'
    ,'label' => esc_html__('Preview file','musik')
    ,'description' => esc_html__('Preview audio file, you can add mp3, ogg, mp4 file(s).','musik')
    ,'conditions' => array(
      array(
        'field' => 'preview_type'
        ,'value' => 'local'
      ),
      array(
        'field' => 'music_type'
        ,'value' => 'single'
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'preview_url'
    ,'label' => esc_html__('Preview file','musik')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'select'
        ,'field' => 'preview_media_type'
        ,'label' => esc_html__('Format','musik')
        ,'columns' => 2
        ,'choices' => array(
          'mp3' => 'mp3'
          ,'m4a' => 'mp4'
          ,'m4v' => 'm4v'
          ,'oga' => 'ogg'
          ,'webma' => 'webm'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'preview_media_url'
        ,'label' =>  esc_html__('URL','musik')
        ,'columns' => 10
      )
    )
    ,'conditions' => array(
      array(
        'field' => 'preview_type'
        ,'value' => 'remote'
      ),
      array(
        'field' => 'music_type'
        ,'value' => 'single'
      )
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Soundcloud'
    ,'description' => esc_html__('Input the soundcloud url and click the get button','musik')
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'soundcloud_trackid'
        ,'label' => 'trackid'
        ,'columns' => 3
      )
      ,array(
        'type' => 'text'
        ,'field' => 'soundcloud_trackurl'
        ,'label' => 'url'
        ,'columns' => 7
      )
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'year'
    ,'label' => esc_html__('Publish year','musik')
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => '2015'
    )
  ));
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'time'
    ,'label' => esc_html__('Duration','musik')
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => '00:00'
    )
  ));
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'itunes'
    ,'label' => esc_html__('iTunes','musik')
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'http://'
    )
  ));
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'googleplay'
    ,'label' => esc_html__('Google Play','musik')
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'http://'
    )
  ));

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'links'
    ,'label' => esc_html__('Links','musik')
    ,'add_more' => true
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'link_text'
        ,'label' =>  esc_html__('Text','musik')
        ,'columns' => 4
      )
      ,array(
        'type' => 'text'
        ,'field' => 'link_url'
        ,'label' =>  esc_html__('URL','musik')
        ,'columns' => 8
        ,'attributes' => array(
          'class' => 'regular-text'
          ,'placeholder' => 'http://'
        )
      )
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'hide_play'
    ,'label' => esc_html__('Hide play btn','musik')
    ,'choices' => array(
      'first' => ''
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('field', array(
    'type' => 'checkbox'
    ,'field' => 'download'
    ,'label' => esc_html__('Allow download music','musik')
    ,'description' => esc_html__('Download the preview file','musik')
    ,'choices' => array(
      'first' => ''
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'plays'
    ,'label' => esc_html__('Play count','musik')
    ,'attributes' => array(
      'class' => 'regular-text'
    )
    ,'capability' => 'administrator'
  ));
  
?>
