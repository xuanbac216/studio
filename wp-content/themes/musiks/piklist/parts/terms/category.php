<?php
/*
Title: Text
Description: 
Taxonomy: category
Order: 0
*/

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'category_template'
    ,'label' => __('Category Template', 'musik')
    ,'choices' => array_merge( array(''), array_flip (get_page_templates()))
  ));
  
?>
