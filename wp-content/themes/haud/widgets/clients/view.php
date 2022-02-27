<?php

  $clients = blahlab_value($this->instance, 'options.clients', array());
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
    
    <?php if ( $layout != 'intro_text_right'): ?>
      <div class="large-6 columns">
        <h2 class="case-title">
          <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
        </h2>
        <p>
          <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
        </p>
      </div>
      
      <div class="large-6 columns">
        <div class="clients">
          <div class='row'>            
            <?php foreach ($clients as $index => $client): ?>
              <?php
                $end_class = $index == count($clients) - 1 ? 'end' : '';
              ?>
              <div class='small-6 large-4 medium-6 columns <?php echo esc_attr(blahlab_value($end_class)) ?>'>
                <div class="client">
                  <a href="javascript:void"><img alt='<?php echo esc_attr(blahlab_value($client, 'name')) ?>' src="<?php echo esc_url(blahlab_value($client, 'logo')) ?>" /></a>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="large-6 columns">
        <div class="clients">
          <div class='row'>
            
            <?php foreach ($clients as $index => $client): ?>
              <?php
                $end_class = $index == count($clients) - 1 ? 'end' : '';
              ?>
              <div class='small-6 large-4 medium-6 columns <?php echo esc_attr(blahlab_value($end_class)) ?>'>
                <div class="client">
                  <a href="javascript:void"><img alt='<?php echo esc_attr(blahlab_value($client, 'name')) ?>' src="<?php echo esc_url(blahlab_value($client, 'logo')) ?>" /></a>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>

      <div class="large-6 columns">
        <h2 class="case-title">
          <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
        </h2>
        <p>
          <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
        </p>
      </div>
    <?php endif ?>


  </div>
</div>