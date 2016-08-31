<?php
/*
Title: Playlist Fields
Description: this is the description
Post Type: playlist
Order: 1
Collapse: false
*/
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'tracks'
    ,'label' => esc_html__('Tracks','musik')
    ,'attributes' => array(
      'class' => 'regular-text'
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
