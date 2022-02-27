<?php

class Blahlab_ContactBoxes_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Contact Boxes";
  public $widget_id = 'contact-boxes';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public function __construct() {

    $sub_item = array(
      'text' => ''
    );

    $this->defaults = array(
      'contact_boxes' => array(
        array( 'email' => '', 'small_title' => '', 'title' => '', 'text' => '', 'bg' => '' ),
        array( 'email' => '', 'small_title' => '', 'title' => '', 'text' => '', 'bg' => '' )
      )
    );

    parent::__construct();

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_contact_boxes', array( 'Blahlab_ContactBoxes_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_contact_boxes', array( 'Blahlab_ContactBoxes_Widget', 'ajax' ) );

?>