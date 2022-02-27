<?php

  $colors = blahlab_value($this->instance, 'options.colors', array());

  foreach ($colors as $index => $color) {    

    $bg_color = blahlab_value($color, 'bg_color');
    $text_color = blahlab_value($color, 'text_color');

    $custom_css = "
      #{$widget_id}-inner #color-{$index} {
        background: {$bg_color};
        color: {$text_color};
      }
    ";

    wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

  } 



?>


<div class="full no-top" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="case-intro">

    <div class="large-12 columns">
      <h4><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h4>
    </div>

    <?php foreach ($colors as $index => $color): ?>

      <?php 
        $end_class = $index == count($colors) - 1 ? 'end' : '';
      ?>
      
      <div class="large-3 columns <?php echo esc_attr($end_class) ?>">
        <div class="color-wrapper">
          <div id="color-<?php echo esc_attr($index) ?>" class="color">
            <p><?php echo esc_html(blahlab_value($color, 'bg_color')) ?></p>
          </div>
        </div>
      </div>

    <?php endforeach ?>

  </div>
</div>