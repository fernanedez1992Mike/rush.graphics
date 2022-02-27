<?php 

  $position = blahlab_value($this->instance, 'options.position');

  $title = blahlab_value($this->instance, 'options.title');
  $title_style = blahlab_value($this->instance, 'options.title_style');
  
  $bg_color = blahlab_value($this->instance, 'options.bg_color');

  $no_top_space = blahlab_value($this->instance, 'options.no_top_space');
  $no_bottom_space = blahlab_value($this->instance, 'options.no_bottom_space');

  $spacing_classes = array();

  if ($no_top_space) {
    $spacing_classes[] = 'no-top';
  }

  if ($no_bottom_space) {
    $spacing_classes[] = 'no-bottom';
  }


  $custom_css = "
    #{$widget_id}-inner {
      background-color: {$bg_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>


<div class="full <?php echo esc_attr(implode(' ', $spacing_classes)) ?>" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="case-intro">

    <?php if ( $position == 'title_left_text_right' ): ?>      
      <div class="large-6 columns">
        <h2 class="case-title">
          <?php echo wp_kses($title, array( 'br' => array() )) ?>
        </h2>
      </div>
      <div class="large-6 columns">
        <?php echo wpautop(blahlab_value($this->instance, 'options.text'), array( 'br' => array() )) ?>
      </div>
    <?php elseif ( $position == 'right' ): ?>

      <div class="large-6 columns"></div>
      <div class="large-6 columns">

        <?php if ( $title_style == 'small' ): ?>
          <h4>
            <?php echo wp_kses($title, array( 'br' => array() )) ?>
          </h4>
        <?php else: ?>
          <h2 class="case-title">
            <?php echo wp_kses($title, array( 'br' => array() )) ?>
          </h2>
        <?php endif ?>


        <?php echo wpautop(blahlab_value($this->instance, 'options.text'), array( 'br' => array() )) ?>
      </div>

    <?php else: ?>  

      <div class="large-6 columns">

        <?php if ( $title_style == 'small' ): ?>
          <h4>
            <?php echo wp_kses($title, array( 'br' => array() )) ?>
          </h4>
        <?php else: ?>
          <h2 class="case-title">
            <?php echo wp_kses($title, array( 'br' => array() )) ?>
          </h2>
        <?php endif ?>

        <?php echo wpautop(blahlab_value($this->instance, 'options.text'), array( 'br' => array() )) ?>
      </div>
      <div class="large-6 columns"></div>

    <?php endif ?>


  </div>
</div>