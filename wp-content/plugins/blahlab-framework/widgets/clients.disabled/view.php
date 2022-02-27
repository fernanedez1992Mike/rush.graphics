<?php

  $clients = blahlab_value($this->instance, 'options.clients', array());

?>


<div class='full parallax white' style='background-image: url(<?php echo esc_attr(blahlab_value($this->instance, 'options.bg')) ?>);'>
  <div class='row'>
    <div class='large-10 large-centered centered-text columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 class='white'>
            <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
          </h2>
        </div>
      </div>
      <div class='spacing'></div>
      <p>
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
      <div class='spacing'></div>
    </div>
  </div>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='mod modClients' data-slides_to_show='4'>
        <div class='clients'>
          <?php foreach ($clients as $index => $client): ?>
            <div>
              <img src="<?php echo esc_url(blahlab_value($client, 'image')) ?>" alt='image' />
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
  <div class='two spacing'></div>
</div>