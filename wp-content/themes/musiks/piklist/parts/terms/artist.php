<?php
/*
Title: 
Description: 
Taxonomy: download_artist
Order: 0
*/

  piklist('field', array(
    'type' => 'file'
    ,'field' => 'photo'
    ,'label' => esc_html__('Photo', 'musik')
  ));

  piklist('field', array(
    'type' => 'editor'
    ,'label' => __('Content', 'musik')
    ,'description' => __('This is a content of the artist.', 'musik')
    ,'field' => 'content'
    ,'options' => array (
     'media_buttons' => true
     ,'teeny' => true
    )
  ));
  
?>
