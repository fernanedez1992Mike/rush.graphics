<?php

class Blahlab_Slider_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Slider";
  public $widget_id = 'slider';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults;

  public function __construct() {

    $button = array( 'text' => '', 'url' => '' );

    $slide = array(
      'image' => '',
      'title' => '',
      'tagline' => '',
      'button_1' => $button,
      'button_2' => $button,
      'background_video_url_webm' => '',
      'background_video_url_mp4' => ''
    );

    $this->defaults = array(
      'autoplay' => false,
      'title' => '',
      'slides' => array(
        $slide, $slide, $slide
      )
    );

    parent::__construct();
  }

}

add_action( 'wp_ajax_layers_widget_ajax_slider', array( 'Blahlab_Slider_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_layers_widget_ajax_slider', array( 'Blahlab_Slider_Widget', 'ajax' ) );


?>