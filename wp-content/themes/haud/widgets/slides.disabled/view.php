

<div class="full">
  <div class="swiper-container haud-slides">
    <div class="swiper-wrapper">

      <?php

        $slides = blahlab_value($this->instance, 'options.slides', array());

      ?>

      <?php foreach ((array)$slides as $index => $slide): ?>
        <div class='swiper-slide'>
          <img alt='<?php esc_attr_e('image', 'haud-by-honryou') ?>' src="<?php echo esc_attr(blahlab_value($slide, 'image')) ?>" />
        </div>
      <?php endforeach ?>

    </div>
    <div class="swiper-pagination"></div>
  </div>
  <!-- Add Arrows -->
  <div class="swiper-arrows">
    <div class="swiper-button-next office"></div>
    <div class="swiper-button-prev office"></div>
  </div>
</div>