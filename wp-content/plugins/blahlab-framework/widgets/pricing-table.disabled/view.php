<?php

  $plans = blahlab_value($this->instance, 'options.plans', array());

?>


<div class='full'>
  <div class='row'>
    <div class='large-10 large-centered columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2><?php echo esc_html(blahlab_value($this->instance, 'options.title')); ?></h2>
        </div>
      </div>
      <div class='spacing'></div>
      <p class="centered-text">
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
      <div class='spacing'></div>
    </div>
  </div>
  <div class='spacing'></div>
  <div class='row'>
    <?php foreach ($plans as $index => $plan): ?>
      <div class='medium-6 large-3 columns'>
        <div class='mod modPriceBox <?php echo blahlab_value($plan, 'featured') == 'on' ? 'featured' : '' ?>'>
          <div class='info'>
            <p class='level'><?php echo esc_html(blahlab_value($plan, 'name')) ?></p>
            <p class='desc'><?php echo esc_html(blahlab_value($plan, 'tagline')) ?></p>
            <p class='price'>
              <span class='dollar'>$</span>
              <span class='number'>
                <?php echo esc_html(blahlab_value($plan, 'price')) ?>
              </span>
            </p>
          </div>
          <div class='features'>
            <ul>
              <?php foreach (blahlab_value($plan, 'lines', array()) as $index => $line): ?>
                <li class="<?php echo blahlab_esc($index % 2 == 1 ? "even" : ''); ?>">
                  <?php echo esc_html(blahlab_value($line, 'text')); ?>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
          <?php
            $button_text = blahlab_value($plan, 'button.text');
            $button_url = blahlab_value($plan, 'button.url');
          ?>
          <?php if ($button_text && $button_url): ?>
            <p class='start'>
              <a target="_blank" class='button small' href='<?php echo esc_url(blahlab_value($button_url)) ?>'>
                <?php echo esc_html(blahlab_value($button_text)); ?>
              </a>
            </p>
          <?php endif ?>
        </div>
      </div>
      <?php endforeach; ?>
  </div>
  <div class='four spacing'></div>
</div>
