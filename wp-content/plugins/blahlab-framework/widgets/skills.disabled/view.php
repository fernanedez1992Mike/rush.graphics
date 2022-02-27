<?php

  $skills = blahlab_value($this->instance, 'options.skills', array());

  $col_left = array();
  $col_right = array();

  foreach ($skills as $index => $skill) {
    if ($index % 2 == 0) {
      $col_left[] = $skill;
    } else {
      $col_right[] = $skill;
    }
  }

?>


<div class='full parallax white' style='background-image: url(<?php echo esc_attr(blahlab_value($this->instance, 'options.bg')) ?>);'>
  <div class='row'>
    <div class='large-10 large-centered columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 class='white'>
            <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
          </h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
  </div>
  <div class='row'>
    <div class='large-6 columns'>
      <div class='mod modBarGraph'>
        <ul class='bars'>
          <?php foreach ($col_left as $index => $skill): ?>
            <li>
              <h4 class="white">
                <?php echo esc_html(blahlab_value($skill, 'title')) ?>
                <strong><?php echo esc_html(blahlab_value($skill, 'percent')) ?>%</strong>
              </h4>
              <p class='highlighted' data-percent='<?php echo esc_attr(blahlab_value($skill, 'percent')) ?>'></p>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
    <div class='large-6 columns'>
      <div class='mod modBarGraph'>
        <ul class='bars'>
          <?php foreach ($col_right as $index => $skill): ?>
            <li>
              <h4 class="white">
                <?php echo esc_html(blahlab_value($skill, 'title')) ?>
                <strong><?php echo esc_html(blahlab_value($skill, 'percent')) ?>%</strong>
              </h4>
              <p class='highlighted' data-percent='<?php echo esc_attr(blahlab_value($skill, 'percent')) ?>'></p>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
  <div class='four spacing'></div>
</div>