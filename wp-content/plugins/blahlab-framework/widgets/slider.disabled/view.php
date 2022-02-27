<?php

  $slides = blahlab_value($this->instance, 'options.slides', array());
  $autoplay = blahlab_value($this->instance, 'options.autoplay');

?>


<div class='mod modFullscreenSlider'>
  <div class='fullscreen_slideshow' data-autostop='off' data-timeout='<?php echo blahlab_value($autoplay) == 'on' ? 3000 : 0 ?>'>
    <a class='sequence-prev' href='javascript:void(0);'>
      <span></span>
    </a>
    <a class='sequence-next' href='javascript:void(0);'>
      <span></span>
    </a>
    <ul class='sequence-pagination'>
      <?php foreach ((array)$slides as $index => $slide): ?>
        <?php if ($index == 0): ?>
          <li class="current"></li>
        <?php else: ?>
          <li></li>
        <?php endif ?>
      <?php endforeach ?>
    </ul>
    <ul class='sequence-canvas'>
      <?php foreach ((array)$slides as $index => $slide): ?>
        <?php
          $class = $index == 0 ? "static" : '';
          $title = blahlab_value($slide, 'title');
          $tagline = blahlab_value($slide, 'tagline');
          $button_1_text = blahlab_value($slide, 'button_1.text');
          $button_1_url = blahlab_value($slide, 'button_1.url');
          $button_2_text = blahlab_value($slide, 'button_2.text');
          $button_2_url = blahlab_value($slide, 'button_2.url');
          $layout = 'centered-text';
          $background_video_url_webm = blahlab_value($slide, 'background_video_url_webm');
          $background_video_url_mp4 = blahlab_value($slide, 'background_video_url_mp4');
        ?>
        <li class='frame <?php echo esc_attr(blahlab_value($class)) ?> <?php echo esc_attr(blahlab_value($layout)) ?>'>
          <div class='bg' style='background-image: url(<?php echo esc_attr(blahlab_value($slide, 'image')) ?>);'></div>
          <?php if ($title): ?>
            <h1><?php echo esc_html(blahlab_value($title)) ?></h1>
          <?php endif ?>
          <?php if ($tagline): ?>
            <p><?php echo esc_html(blahlab_value($tagline)) ?></p>
          <?php endif ?>
          <div class="two spacing"></div>

          <div class='buttons-wrapper'>
            <?php if ($button_1_text && $button_1_url): ?>
              <a class='button boxed small' target="_blank" href='<?php echo esc_url(blahlab_value($button_1_url)) ?>'><?php echo esc_html(blahlab_value($button_1_text)) ?></a>
            <?php endif ?>
            <?php if ($button_2_text && $button_2_url): ?>
              <a class='button small' target="_blank" href='<?php echo esc_url(blahlab_value($button_2_url)) ?>'><?php echo esc_html(blahlab_value($button_2_text)) ?></a>
            <?php endif ?>
          </div>

          <?php if ($background_video_url_mp4 || $background_video_url_webm): ?>
            <div class='video_wrap'>
              <div class='overlay'></div>
              <video autoplay='autoplay' class='bg_video' loop='loop' muted='muted' preload='auto'>
                <source src='<?php echo esc_url(blahlab_value($background_video_url_webm)) ?>' type='video/webm'>
                <source src='<?php echo esc_url(blahlab_value($background_video_url_mp4)) ?>' type='video/mp4'>
              </video>
            </div>
          <?php endif ?>

        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>