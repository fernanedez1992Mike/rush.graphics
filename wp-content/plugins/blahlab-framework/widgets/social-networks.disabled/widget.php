<?php

class Blahlab_SocialNetworks_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Social Networks";
  public $widget_id = 'social-networks';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'bg' => '',
    'socials' => array(
      array( 'id' => '', 'title' => '', 'sub_title' => '', 'url' => '' ),
      array( 'id' => '', 'title' => '', 'sub_title' => '', 'url' => '' ),
      array( 'id' => '', 'title' => '', 'sub_title' => '', 'url' => '' )
    )
  );

}

add_action( 'wp_ajax_blahlab_widget_ajax_social_networks', array( 'Blahlab_FooterSocialNetworks_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_social_networks', array( 'Blahlab_FooterSocialNetworks_Widget', 'ajax' ) );

?>