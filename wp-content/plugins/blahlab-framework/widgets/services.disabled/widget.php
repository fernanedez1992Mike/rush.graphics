<?php

class Blahlab_Services_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Services";
  public $widget_id = 'services';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';
  
  public $defaults = array(
    'title' => '',
    'desc' => '',
    'image' => '',
    'services' => array(
      array( 'icon' => '', 'title' => '', 'desc' => '' ),
      array( 'icon' => '', 'title' => '', 'desc' => '' ),
      array( 'icon' => '', 'title' => '', 'desc' => '' )
    )
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_services', array( 'Blahlab_Services_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_services', array( 'Blahlab_Services_Widget', 'ajax' ) );

?>