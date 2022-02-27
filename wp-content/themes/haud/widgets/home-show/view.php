<?php

  $catchwords = blahlab_value($this->instance, 'options.catchwords', array());
  $works = blahlab_value($this->instance, 'options.featured_works', array());
  $sub_title = blahlab_value($this->instance, 'options.sub_title');
  $hint_text = blahlab_value($this->instance, 'options.hint_text');
  $shape_mask_svg = blahlab_value($this->instance, 'options.shape_mask_svg');
  $contact_link = blahlab_value($this->instance, 'options.contact_link');


  $custom_css = "
    #{$widget_id}-inner .home-svg > rect {
      mask: url(#{$widget_id}-logo-mask);
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>


<div class="swiper-container" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div id="white-board"></div>
  <div id="white-board-reverse"></div>
  <div class="swiper-wrapper">
    <div class="swiper-slide" data-history="case-0" data-hash="case-0" data-title="">
      <div class="home-intro stretchhh">
        <svg viewBox="0 0 300 400" class="home-svg" preserveAspectRatio="xMidYMid slice">
          <defs>
            <mask id="<?php echo esc_attr($widget_id) ?>-logo-mask" x="0" y="0" width="100%" height="100%">
              <rect x="0" y="0" width="100%" height="100%" fill="#fff"></rect>
              <?php echo wp_kses( blahlab_value($shape_mask_svg), blahlab_haud_svg_wp_kses_array() ); ?>
            </mask>
          </defs>
          <rect x="0" y="0" width="100%" height="100%"></rect>
        </svg>
        <h2>
          <?php
            foreach ($catchwords as $key => $catchword) {
          ?>
            <span><?php echo esc_html(blahlab_value($catchword, 'word')); ?></span>
          <?php
            }
          ?>
        </h2>
        <h3>
          <?php echo wp_kses(nl2br(blahlab_value($sub_title)), array( 'br' => array() ) ); ?>
        </h3>

        <?php if ($hint_text): ?>
          <div class="action-hint"><?php echo esc_html($hint_text); ?></div>
        <?php endif ?>

      </div>

      <?php if ( blahlab_value($contact_link, 'url') && blahlab_value($contact_link, 'text') ): ?>
        <div class="home-contact-link">
          <a href="<?php echo esc_url(blahlab_value($contact_link, 'url')) ?>">
            <span class="link-label"><?php echo esc_html(blahlab_value($contact_link, 'text')) ?></span>
            <span class="link-hover"><?php echo esc_html(blahlab_value($contact_link, 'text')) ?></span>
          </a>
        </div>
      <?php endif ?>


<?php $videos=blahlab_value($this->instance, 'options.video');
			 if($videos){
			 $videos=explode("\n",$videos);
			 $videos = array_filter($videos, function ($value) {
	return strlen($value) > 1;
});
			 $video=$videos[rand(0,count($videos)-1)];
			 if($video){?>
      <video autoplay="autoplay" playsinline muted="" class="fullscreen-video" loop="loop">
        <source src="<?php echo esc_url($video) ?>" type="video/mp4">
      </video>
		<?php }
			 } ?>
    </div>

    <?php

      $theme_data = blahlab_theme_data();
      $portfolio_items_dictionary = $theme_data['portfolio_items_dictionary'];

    ?>


    <?php foreach ($works as $index => $work): ?>

      <?php
        $slide_id = $widget_id . "-case-" . ($index + 1);
        $nav_text = blahlab_value($work, 'nav_text');
        $bg_text = blahlab_value($work, 'bg_text');
        $work_id = blahlab_value($work, 'work_id');

        if ( isset($portfolio_items_dictionary[$work_id]) ) {
          $portfolio_item = $portfolio_items_dictionary[$work_id];
        } else {
          continue;
        }

      ?>

      <div class="swiper-slide" data-history="<?php echo esc_attr($slide_id) ?>" data-hash="<?php echo esc_attr($slide_id) ?>" id="<?php echo esc_attr($slide_id) ?>" data-title="<?php echo esc_attr($nav_text) ?>">

        <?php

          global $blahlab_haud_portfolio_colors_metabox;
          $blahlab_haud_portfolio_colors_metabox->the_meta($work_id);
          $portfolio_colors_options = json_decode($blahlab_haud_portfolio_colors_metabox->get_the_value('options'), true);

          $primary_color = blahlab_value($portfolio_colors_options, 'primary');
          $secondary_color = blahlab_value($portfolio_colors_options, 'secondary');
          $secondary_same_as_primary = blahlab_value($portfolio_colors_options, 'secondary_same_as_primary');
          if ( $secondary_same_as_primary ) {
            $secondary_color = $primary_color;
          }

        ?>

        <?php

          $custom_css = "

            #{$widget_id}-inner #{$slide_id} {
              background: {$primary_color};
            }

            #{$widget_id}-inner #{$slide_id} .svg-graphic > rect {
              mask: url(#{$slide_id}-mask);
              fill: {$primary_color};
            }

            #{$widget_id}-inner #{$slide_id} .case-study-label {
              background-color: {$secondary_color};
            }

            #{$widget_id}-inner #{$slide_id} .styled-button-wrapper .styled.button {
              color: {$secondary_color};
              background-image: linear-gradient(to bottom, transparent 62%, {$secondary_color} 0);
            }

          ";

          wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);
        ?>

        <div class="left-section stretchhh">
          <span class="case-study-label">
              case study
          </span>
          <div class="case-intro-wrapper">
            <h2>
              <span>
                <?php echo esc_html(blahlab_value($portfolio_item, 'title')) ?>
              </span>
            </h2>
            <p class="case-text">
              <?php echo wp_kses(nl2br(blahlab_value($portfolio_item, 'content')), array( 'br' => array() ) ); ?>
            </p>

            <?php

              global $blahlab_haud_portfolio_details_metabox;
              $blahlab_haud_portfolio_details_metabox->the_meta($work_id);
              $portfolio_details_options = json_decode($blahlab_haud_portfolio_details_metabox->get_the_value('options'), true);

              $client = blahlab_value($portfolio_details_options, 'client');
              $services = blahlab_value($portfolio_details_options, 'services');

            ?>

            <?php if ($client): ?>
              <p class="case-tags">
                <strong>Client:</strong>
                <span><?php echo esc_html($client); ?></span>
              </p>
            <?php endif ?>

            <?php if ( count($services) > 0 ): ?>


              <?php
                $service_names = array();

                foreach ($services as $index => $service) {
                  $service_names[] = blahlab_value($service, 'name');
                }
              ?>

              <p class="case-tags">
                <strong>Services: </strong>
                <span><?php echo esc_html(implode(', ', $service_names)) ?></span>
              </p>

            <?php endif ?>

            <div class="four spacing"></div>
            <p class="case-button">
              <span class="styled-button-wrapper">
                <a href="<?php echo esc_url(get_permalink($work_id)) ?>" class="styled button">
                  View case
                </a>
              </span>
            </p>
          </div>
        </div>
        <a href="<?php echo esc_url(get_permalink($work_id)) ?>">
          <?php

            global $blahlab_haud_portfolio_media_metabox;
            $blahlab_haud_portfolio_media_metabox->the_meta($work_id);
            $portfolio_media_options = json_decode($blahlab_haud_portfolio_media_metabox->get_the_value('options'), true);

            $media_type = blahlab_value($portfolio_media_options, 'media_type');
            $video_url = blahlab_value($portfolio_media_options, 'video');
            $image_url = blahlab_value($portfolio_media_options, 'image');
            $shape_mask_svg = blahlab_value($portfolio_media_options, 'svg_mask_code');

          ?>

          <?php if ( $media_type == 'image' ): ?>

            <div class="case-image">
               <img src="<?php echo esc_url($image_url) ?>" alt="<?php esc_attr_e('case image', 'haud-by-honryou') ?>">
            </div>

          <?php elseif ( $media_type == 'video' ): ?>

            <video loop="" autoplay="" muted="" playsinline="" class="brand-video" preload="">
              <source src="<?php echo esc_url($video_url) ?>" type="video/mp4">
            </video>
            <svg width="1000" height="563" viewBox="0 0 1000 563" class="svg-graphic">
              <defs>
                <mask id="<?php echo esc_attr($slide_id) ?>-mask" x="0" y="0" width="1000" height="563">
                  <rect x="0" y="0" width="1000" height="563" fill="#fff"></rect>
                  <?php
                    echo wp_kses(
                      blahlab_value($shape_mask_svg),
                      blahlab_haud_svg_wp_kses_array()
                    );
                  ?>
                </mask>
              </defs>
              <rect x="0" y="0" width="1000" height="563"></rect>
            </svg>

          <?php endif; ?>

        </a>
        <div class="bg-text-wrapper">
          <h2 class="bg-text">
            <?php echo esc_html($bg_text); ?>
          </h2>
        </div>
      </div>

    <?php endforeach ?>

  </div>
  <!-- Add Pagination -->
  <div class="swiper-pagination"></div>
  <!-- Add Arrows -->
</div>

