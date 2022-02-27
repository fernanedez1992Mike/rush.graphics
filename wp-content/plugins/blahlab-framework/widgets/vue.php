<?php

require_once dirname(__FILE__) . '/base.php';

class Blahlab_Vue_Widget extends Blahlab_Widget {

  // switch for selective refresh
  public $customize_selective_refresh = false;

  function form( $instance ){

    // $instance Defaults
    // If we have information in this widget, then ignore the defaults
    $instance_defaults = empty( $instance ) ? $this->defaults : array();

    $instance = wp_parse_args( $instance, $instance_defaults );

    $this->instance = $instance;

    extract( $instance, EXTR_SKIP );

    ?>

      <p class="hide">
        <textarea class="widefat options" rows="8" cols="20" name="<?php echo $this->get_field_name('options'); ?>"><?php echo blahlab_value($this->instance, 'options', '{}') ?></textarea>
      </p>
      
      <div class="vue-widget-content">
        <!-- don't show for update-widget ajax call  -->
        <?php if( ! $this->is_ajax_update_widget() ) { ?>
          <p class="no-top-margin widget-anchor-id">Anchor ID: #{{widgetId}}</p>
          <?php include($this->form); ?>
          <p class="hide">
            <textarea class="defaults widefat" rows="8" cols="20"><?php echo json_encode(blahlab_value($this->defaults)) ?></textarea>
          </p>
        <?php } ?>        
      </div>

    <?php

  }

}

?>