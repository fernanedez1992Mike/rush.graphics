<?php

  $services = blahlab_value($this->instance, 'options.services', array());
  $bg_color = blahlab_value($this->instance, 'options.bg_color');
  $layout = blahlab_value($this->instance, 'options.layout');

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
    <?php if ( $layout != 'intro_text_left'): ?>
      <div class="large-6 columns">
      </div>
    <?php endif ?>

    <div class="large-6 columns">
      <h2 class="case-title">
        <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
      </h2>
      <p>
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
    </div>

    <?php if ( $layout == 'intro_text_left'): ?>
      <div class="large-6 columns">
      </div>
    <?php endif ?>

  </div>
  <div class="spacing"></div>


  <?php
    $services = blahlab_value($this->instance, 'options.services', array());

    foreach ($services as $index => $service) {
      $service_id = $this->id . '-' . $index;

      $end_class = $index == count($services) - 1 ? 'end' : '';

  ?>

    <div class="large-3 medium-6 columns <?php echo esc_attr(blahlab_value($end_class)) ?>">
      <div class="icon-text">
        <span class="icon-bg"><i class="icon-basic-<?php echo esc_attr(blahlab_value($service, 'icon')) ?>"></i></span>
        <h3><?php echo esc_html(blahlab_value($service, 'title')) ?></h3>
        <ul>
          <?php
            $subs = blahlab_value($service, 'subs', array());
            foreach ($subs as $sub) {
          ?>
            <li><?php echo esc_html(blahlab_value($sub, 'text')); ?></li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  <?php
    }
  ?>

</div>