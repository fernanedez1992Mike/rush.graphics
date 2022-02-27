<?php

class Blahlab_Services_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Services";
  public $widget_id = 'services';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public function __construct() {

    $bullet = array(
      'text' => ''
    );

    $this->defaults = array(
      'title' => '',
      'desc' => '',
      'layout' => '',      
      'services' => array(
        array( 'icon' => '', 'title' => '', 'subs' => array($bullet, $bullet, $bullet) ),
        array( 'icon' => '', 'title' => '', 'subs' => array($bullet, $bullet, $bullet) ),
        array( 'icon' => '', 'title' => '', 'subs' => array($bullet, $bullet, $bullet) )
      ),
      'bg_color' => '',
      'no_top_space' => false,
      'no_bottom_space' => false
    );

    parent::__construct();

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_services', array( 'Blahlab_Services_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_services', array( 'Blahlab_Services_Widget', 'ajax' ) );

?>