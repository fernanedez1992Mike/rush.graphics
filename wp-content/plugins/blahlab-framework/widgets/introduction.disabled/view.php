<?php

  $text = blahlab_value($this->instance, 'options.text');
  $image = blahlab_value($this->instance, 'options.image');

?>

<div class='full'>
  <div class='row'>
    <div class='large-10 columns large-centered'>
      <div class='spacing'></div>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h2>
        </div>
      </div>
      <div class='spacing'></div>
      <p class='centered-text big-text'>
        <?php echo esc_html(blahlab_value($this->instance, 'options.text')) ?>
      </p>
      <div class='two spacing'></div>
      <p class='centered-text'>
        <img width="260" height="197" alt='image' src="<?php echo esc_url(blahlab_value($this->instance, 'options.image')) ?>" />
      </p>
    </div>
  </div>
</div>