<?php

class Blahlab_TeamCulture_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Team Culture";
  public $widget_id = 'team-culture';
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
      'sub_desc' => '',
      'bg_color' => '',
      'no_top_space' => false,
      'no_bottom_space' => false,
      'images' => array(
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' ),
        array( 'url' => '' )
      )
    );

    parent::__construct();

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_team_culture', array( 'Blahlab_TeamCulture_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_team_culture', array( 'Blahlab_TeamCulture_Widget', 'ajax' ) );

?>