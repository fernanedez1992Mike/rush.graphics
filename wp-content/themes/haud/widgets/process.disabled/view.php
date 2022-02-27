<div class="full no-right">
  <div class="text-block-right">

    <?php
      $introductions = blahlab_value($this->instance, 'options.introductions', array());
    ?>

    <?php foreach ($introductions as $introduction): ?>
      
      <h2><?php echo esc_html(blahlab_value($introduction, 'title')) ?></h2>
      <p class="big-text">
        <?php echo esc_html(blahlab_value($introduction, 'text')) ?>
      </p>
      <p><?php echo esc_html(blahlab_value($introduction, 'small_text')) ?></p>

      <div class="four spacing"></div>
    <?php endforeach ?>


    <?php 
      
      $hint_text = blahlab_value($this->instance, 'options.hint_text.normal');
      $hint_text_for_touch = blahlab_value($this->instance, 'options.hint_text.touch');

    ?>

  
    <div class="process-hint">
      <?php if ($hint_text): ?>
        <div class="action-hint"><?php echo esc_html($hint_text); ?></div>
      <?php endif ?>
      <?php if ($hint_text_for_touch): ?>
        <div class="action-hint-for-touch"><?php echo esc_html($hint_text_for_touch); ?></div>
      <?php endif ?>
    </div>

  </div>

  <?php 
    $steps = blahlab_value($this->instance, 'options.steps', array());
  ?>

  <div class="swiper-container haud-process">
    <div class="swiper-wrapper">

      <?php foreach ($steps as $index => $step): ?>
        <?php 
          $number = $index + 1;
          $number = str_pad($number, 2, "0", STR_PAD_LEFT);
        ?>

        <div class="swiper-slide">
          <h3><?php echo esc_html($number) ?>. <?php echo esc_html(blahlab_value($step, 'title')) ?></h3>
          <?php echo wpautop(blahlab_value($step, 'desc'), array( 'br' => array() )) ?>
        </div>

      <?php endforeach ?>
    </div>
  </div>
</div>