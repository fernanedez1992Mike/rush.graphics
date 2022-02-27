<?php

class Blahlab_PortfolioGallery_Widget extends Blahlab_Vue_Widget {

  public $widget_title = "PortfolioGallery";
  public $widget_id = 'portfolio-gallery';
  public $post_type = '';
  public $taxonomy = '';
  public $classname = '';


  public $defaults = array(
    'items' => array(
      array( 'id' => ''  ),
      array( 'id' => ''  ),
      array( 'id' => ''  ),
      array( 'id' => ''  )
    )
  );

}

?>