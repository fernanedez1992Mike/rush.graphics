<?php

class Blahlab_Slides_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Slides";
  public $widget_id = 'slides';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults;

  public function __construct() {

    $slide = array(
      'image' => ''
    );

    $this->defaults = array(
      'slides' => array(
        $slide, $slide, $slide
      )
    );

    parent::__construct();
  }

}

add_action( 'wp_ajax_layers_widget_ajax_slider', array( 'Blahlab_Slides_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_layers_widget_ajax_slider', array( 'Blahlab_Slides_Widget', 'ajax' ) );


?>