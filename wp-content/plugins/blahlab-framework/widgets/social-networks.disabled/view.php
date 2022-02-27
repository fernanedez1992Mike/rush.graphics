<?php

  $socials = blahlab_value($this->instance, 'options.socials');
  $logo = blahlab_value($this->instance, 'options.image');
?>

<div class='full parallax white' style='background-image: url(<?php echo esc_attr(blahlab_value($this->instance, 'options.bg')) ?>);'>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 class="white">
            <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
          </h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>

    <?php foreach ((array)$socials as $index => $social): ?>
      <div class='medium-3 columns'>
        <div class='big-social'>
          <a href='<?php echo esc_url(blahlab_value($social, 'url')) ?>' target="_blank">
            <i class='fa fa-<?php echo esc_attr(blahlab_value($social, 'id')) ?>'></i>
          </a>
          <h4 class="white"><?php echo esc_html(blahlab_value($social, 'title')) ?></h4>
          <p><?php echo esc_html(blahlab_value($social, 'sub_title')) ?></p>
        </div>
        <div class='two spacing'></div>
      </div>
    <?php endforeach ?>
  </div>
  <div class='four spacing'></div>
  <div class='two spacing'></div>
</div>