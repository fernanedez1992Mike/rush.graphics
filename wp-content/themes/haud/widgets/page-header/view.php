<?php 

  $background_url = blahlab_value($this->instance, 'options.bg_image');
  $bg_color = blahlab_value($this->instance, 'options.bg_color');

  $custom_css = "
    #{$widget_id}-inner {
      background-image: url({$background_url});
      background-color: {$bg_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>


<div class="full header head-bg" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="case-intro">
    <div class="large-12 columns">
      <div class="four spacing"></div>
      <h2 class="head-title">
        <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
      </h2>
    </div>
    <div class="large-6 columns end">
      <p class='case-text-big'>
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
    </div>
  </div>
</div>