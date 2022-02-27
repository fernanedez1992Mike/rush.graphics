<?php

  $achievements = blahlab_value($this->instance, 'options.achievements');

?>

<div class='full parallax white' style='background-image: url(<?php echo esc_attr(blahlab_value($this->instance, 'options.bg')) ?>);'>
  <div class='row'>
    <div class='large-10 large-centered columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 class="white">
            <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
          </h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
  </div>
  <div class='row'>

    <?php foreach ((array)$achievements as $index => $achievement): ?>
      <div class='medium-3 large-3 columns'>
        <div class='mod modMilestone'>
          <i class='fa fa-<?php echo esc_attr(blahlab_value($achievement, 'icon')) ?>'></i>
          <strong data-from='0' data-to='<?php echo esc_attr(blahlab_value($achievement, 'number')) ?>'>&nbsp;</strong>
          <span><?php echo esc_html(blahlab_value($achievement, 'title')) ?></span>
          <div class='four spacing'></div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
  <div class='two spacing'></div>
</div>