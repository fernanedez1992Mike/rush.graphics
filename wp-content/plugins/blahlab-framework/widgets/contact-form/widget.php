<?php

class Blahlab_ContactForm_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "Contact Form";
  public $widget_id = 'contact-form';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $customize_selective_refresh = false;

  public $defaults = array(
    'recipient' => '',
    'title' => '',
    'bg_color' => '', // #000000
    'text_color' => '' // #ffffff
  );

  public static function ajax() {

    $widget = new Blahlab_ContactForm_Widget();
    $widget->number = $_POST[ 'widget_number' ];

    if ( 'send_email' == $_POST['widget_action'] ) {
      $all_instances = $widget->get_settings();
      $instance = $all_instances[$widget->number];

      if ( isset($instance['options']) && is_string($instance['options']) ) {
        $decoded = json_decode($instance['options'], true);
        if ( is_array($decoded) ) {
          $instance['options'] = $decoded;
        }
      }

      $to  = blahlab_value($instance, 'options.recipient');

      // var_dump($instance);

      include(blahlab_join_paths($widget->root, 'partials', 'email.php'));

      die();

    }

  }

}

add_action( 'wp_ajax_blahlab_widget_ajax_contact_details', array( 'Blahlab_ContactForm_Widget', 'ajax' ) );
add_action( 'wp_ajax_nopriv_blahlab_widget_ajax_contact_details', array( 'Blahlab_ContactForm_Widget', 'ajax' ) );

?>