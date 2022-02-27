<?php

  $services = blahlab_value($this->instance, 'options.services');

?>


<div class='full no-padding color-333' style='background-color: <?php echo esc_attr(blahlab_value($this->instance, 'options.bg_color')) ?>;'>
  <div class='two spacing'></div>
  <div class='mod modCallToAction'>
    <div class='row'>
      <div class='medium-9 large-9 columns'>
        <p><?php echo esc_html(blahlab_value($this->instance, 'options.text')) ?></p>
      </div>
      <?php
        $button_text = blahlab_value($this->instance, 'options.button.text');
        $button_url = blahlab_value($this->instance, 'options.button.url');
      ?>
      <div class='medium-3 large-3 columns'>
        <?php if ($button_text && $button_url): ?>
          <a class='boxed button black' target="_blank" href='<?php echo esc_url(blahlab_value($button_url)) ?>'><?php echo esc_html(blahlab_value($button_text)) ?></a>
        <?php endif ?>
      </div>
    </div>
  </div>
  <div class='spacing'></div>
</div>