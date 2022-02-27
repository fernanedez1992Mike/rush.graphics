<?php

  $services = blahlab_value($this->instance, 'options.services', array());

?>


<div class='full color-f5f5f5'>
  <div class='row'>
    <div class='large-10 large-centered columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
  </div>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='mod modBoxedTextSlider'>
        <div class='boxes'>
          <?php foreach ($services as $index => $service): ?>
            <div class='box'>
              <i class='fa fa-<?php echo esc_attr(blahlab_value($service, 'icon')) ?>'></i>
              <h4><?php echo esc_html(blahlab_value($service, 'title')) ?></h4>
              <p><?php echo esc_html(blahlab_value($service, 'desc')) ?></p>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
  <div class='four spacing'></div>
</div>