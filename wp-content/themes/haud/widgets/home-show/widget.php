<?php

class Blahlab_HomeShow_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Home Show";
  public $widget_id = 'home-show';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults;

  public function __construct() {

    $catchword = array( 
      'word' => ''
    );

    $featured_work = array(
      'work_id' => '',
      'nav_text' => '',
      'bg_text' => ''
    );

    $this->defaults = array(
      'catchwords' => array(
        $catchword,
        $catchword,
        $catchword
      ),
      'sub_title' => '',
      'hint_text' => '',
      'contact_link' => array(
        'text' => '',
        'url' => ''
      ),
      'shape_mask_svg' => '',
      'featured_works' => array(
        $featured_work,
        $featured_work,
        $featured_work
      ),
      'video' => ''
    );

    parent::__construct();
  }

}

add_action( 'wp_ajax_layers_widget_ajax_slider', array( 'Blahlab_HomeShow_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_layers_widget_ajax_slider', array( 'Blahlab_HomeShow_Widget', 'ajax' ) );


?>