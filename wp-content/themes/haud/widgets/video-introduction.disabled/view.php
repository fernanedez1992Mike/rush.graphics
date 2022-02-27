<div class="swiper-container haud-video-introduction">
  <div class="swiper-wrapper">
    <div class="swiper-slide media">
      <?php 
        $blahlab_haud_video_url = blahlab_value($this->instance, 'options.video_url');

        if ( defined('WP_DEBUG') && WP_DEBUG ) {        
          $blahlab_haud_video_url = add_query_arg(array( 'ver' => time() ), $blahlab_haud_video_url);
        }

      ?>
      <video loop muted autoplay preload>
        <source src='<?php echo esc_url($blahlab_haud_video_url) ?>' type='video/mp4'>
      </video>
    </div>
    <div class="swiper-slide">
      <h2><?php echo wp_kses(blahlab_value($this->instance, 'options.title'), array( 'br' => array() )) ?></h2>
      <p class="big-text">
        <?php echo wpautop(blahlab_value($this->instance, 'options.text'), array( 'br' => array() )) ?>
      </p>
      <p>
        <?php echo wpautop(blahlab_value($this->instance, 'options.small_text'), array( 'br' => array() )) ?>
      </p>
      <?php 
        $blahlab_haud_hint_text = blahlab_value($this->instance, 'options.hint_text');
      ?>
      <div class="action-hint"><?php echo esc_html($blahlab_haud_hint_text); ?></div>
      <div class="action-hint-for-touch"><?php echo esc_html($blahlab_haud_hint_text); ?></div>
    </div>
  </div>
</div>
<div class="four spacing"></div>