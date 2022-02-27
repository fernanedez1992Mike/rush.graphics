<?php

class Blahlab_Members_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Members";
  public $widget_id = 'members';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults;

  // dynamically initialize $this->defaults
  // PHP properties have to be a constant value
  // http://php.net/manual/en/language.oop5.properties.php
  public function __construct() {

    $member = array(
      'name' => '',
      'position' => '',
      'avatar' => '',
      'desc' => '',
      'socials' => array(
        array('id' => '', 'url' => ''),
        array('id' => '', 'url' => '')
      )
    );

    $this->defaults = array(
      'title' => '',
      'desc' => '',
      'members' => array(
        $member, 
        $member, 
        $member
      )
    );

    parent::__construct();

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_members', array( 'Blahlab_Members_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_members', array( 'Blahlab_Members_Widget', 'ajax' ) );

?>