<?php 

  $image = blahlab_value($this->instance, 'options.image');

  $bg_color = blahlab_value($this->instance, 'options.bg_color');

  $no_top_space = blahlab_value($this->instance, 'options.no_top_space');
  $no_bottom_space = blahlab_value($this->instance, 'options.no_bottom_space');

  $full = blahlab_value($this->instance, 'options.full');

  $spacing_classes = array();

  if ($no_top_space) {
    $spacing_classes[] = 'no-top';
  }

  if ($no_bottom_space) {
    $spacing_classes[] = 'no-bottom';
  }

  if ( $full ) {
    $spacing_classes[] = 'no-sides';
  }


  $custom_css = "
    #{$widget_id}-inner {
      background-color: {$bg_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>


<div class="full <?php echo esc_attr(implode(' ', $spacing_classes)) ?>" id="<?php echo esc_attr($widget_id . '-inner'); ?>">
    
  <div class="case-intro">
    <div class="large-12 columns">
      <?php if ( $image ): ?>
        <img src="<?php echo esc_url($image) ?>" alt="<?php esc_attr_e('project image', 'haud-by-honryou') ?>">
      <?php endif ?>
    </div>
  </div>

</div>
