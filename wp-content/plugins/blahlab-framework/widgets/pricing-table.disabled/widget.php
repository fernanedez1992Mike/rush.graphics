<?php

class Blahlab_PricingTable_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Pricing Table";
  public $widget_id = 'pricing-table';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults;

  public function __construct() {

    $line = array( 'text' => '' );
    $button = array( 'text' => '', 'url' => '' );

    $plan = array(
      'name' => '',
      'tagline' => '',
      'price' => '',
      'lines' => array(
        $line, $line, $line
      ),
      'button' => $button,
      'featured' => false
    );

    $this->defaults = array(
      'title' => '',
      'desc' => '',
      'plans' => array(
        $plan, $plan, $plan
      )
    );

    parent::__construct();
  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_pricing_table', array( 'Blahlab_PricingTable_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_pricing_table', array( 'Blahlab_PricingTable_Widget', 'ajax' ) );


?>