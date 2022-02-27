<?php 
  
  $title = blahlab_value($this->instance, 'options.title');
  $sub_title = blahlab_value($this->instance, 'options.sub_title');

  $bg_color = blahlab_value($this->instance, 'options.bg_color');
  $text_color = blahlab_value($this->instance, 'options.text_color');

  $custom_css = "
    #{$widget_id}-inner {
      background-color: {$bg_color};
      color: {$text_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>

<div class="full no-right" id="<?php echo esc_attr($widget_id) ?>-inner">
  <a href="<?php echo esc_url(blahlab_value($this->instance, 'options.url')) ?>" class="bottom-call-to-action"></a>
  <div class="case-intro">
    <div class="large-12 columns">
      <?php if ($sub_title): ?>
        <p class="case-text-big"><?php echo esc_html($sub_title) ?></p>
      <?php endif ?>      
      <h2 class="case-title"><?php echo esc_html($title) ?></h2>
    </div>
  </div>
</div>