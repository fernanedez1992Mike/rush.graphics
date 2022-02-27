<?php

class Blahlab_News_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "News";
  public $widget_id = 'news';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';

  public $defaults = array(
    'title' => '',
    'bg' => '',
    'desc' => '',
    'posts' => array()
  );

}

?>