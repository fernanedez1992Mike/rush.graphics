<?php

class Blahlab_TeamMembers_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Team Members";
  public $widget_id = 'team-members';
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
    );

    $this->defaults = array(
      'title' => '',
      'desc' => '',
      'layout' => '',
      'members' => array(
        $member, 
        $member, 
        $member
      ),
      'bg_color' => '',
      'no_top_space' => false,
      'no_bottom_space' => false
    );

    parent::__construct();

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_team_members', array( 'Blahlab_TeamMembers_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_team_members', array( 'Blahlab_TeamMembers_Widget', 'ajax' ) );

?>