<?php

class Blahlab_ContactInfo_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Contact Info";
  public $widget_id = 'contact-info';
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
      'google_map_link' => array(
        'text' => '',
        'url' => ''
      ),      
      'bg_color' => '',
    );

    parent::__construct();

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_contact_info', array( 'Blahlab_ContactInfo_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_contact_info', array( 'Blahlab_ContactInfo_Widget', 'ajax' ) );

?>