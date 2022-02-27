<?php

  $items = blahlab_value($this->instance, 'options.items', array());

  $item_ids = array();

  foreach ($items as $index => $item) {
    $item_ids[] = $item['id'];
  }

  $query = array(
    'posts_per_page' => -1,
    'orderby' => 'post__in',
    'post_type' => 'portfolio'
  );

  $query['post__in'] = $item_ids;

  if (count($items) > 0) {
    $works = get_posts($query);
  } else {
    $works = array();
  }

  // start sorting the works

  $the_works = array();

  foreach ($items as $item) {
    foreach ($works as $work) {
      if ( $item['id'] == $work->ID ) {
        $the_works[] = $work;
        break;
      }
    }
  }

  $works = $the_works;

  wp_reset_postdata();

  $theme_data = blahlab_theme_data();
  $portfolio_items_dictionary = $theme_data['portfolio_items_dictionary'];

?>


<?php foreach ($works as $index => $work): ?>

  <?php 
    $slide_id = $widget_id . "-case-" . ($index + 1);
    $work_id = $work->ID;

    if ( isset($portfolio_items_dictionary[$work_id]) ) {
      $portfolio_item = $portfolio_items_dictionary[$work_id];
    } else {
      continue;
    }

  ?>

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

      #{$slide_id} .case-video, #{$slide_id} .case-image {
        background: {$primary_color};
      }

      #{$slide_id} .svg-graphic > rect {
        mask: url(#{$slide_id}-mask);
        fill: {$primary_color};
      }

      #{$slide_id} .case-study-label {
        background-color: {$secondary_color};
      }

      #{$slide_id} .styled-button-wrapper .styled.button {
        color: {$secondary_color};
        background-image: linear-gradient(to bottom, transparent 62%, {$secondary_color} 0);
      }

    ";

    wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);
  ?>

  
  <?php 

    global $blahlab_haud_portfolio_media_metabox;
    $blahlab_haud_portfolio_media_metabox->the_meta($work_id);
    $portfolio_media_options = json_decode($blahlab_haud_portfolio_media_metabox->get_the_value('options'), true);

    $media_type = blahlab_value($portfolio_media_options, 'media_type');
    $video_url = blahlab_value($portfolio_media_options, 'video');
    $image_url = blahlab_value($portfolio_media_options, 'image');
    $shape_mask_svg = blahlab_value($portfolio_media_options, 'svg_mask_code');

  ?>

  <div class="full no-sides no-top no-bottom case-table" id="<?php echo esc_attr($slide_id) ?>">
    <?php if ($index % 2 == 0): ?>

      <?php if ( $media_type == 'image' ): ?>

        <div class="case-image">
           <img src="<?php echo esc_url($image_url) ?>" alt="<?php esc_attr_e('case image', 'haud-by-honryou') ?>">
        </div>

      <?php elseif ( $media_type == 'video' ): ?>
      
        <div class="case-video">
          <video loop="" autoplay="" muted="" playsinline="" class="brand-video" preload="">
            <source src="<?php echo esc_url($video_url) ?>" type="video/mp4">
          </video>
          <svg width="1000" height="563" viewBox="0 0 1000 563" class="svg-graphic">
            <defs>
              <mask id="<?php echo esc_attr($slide_id) ?>-mask" x="0" y="0" width="1000" height="563">
                <rect x="0" y="0" width="1000" height="563" fill="#fff"></rect>
                <?php echo wp_kses( blahlab_value($shape_mask_svg), blahlab_haud_svg_wp_kses_array() ); ?>
              </mask>
            </defs>
            <rect x="0" y="0" width="1000" height="563"></rect>
          </svg>
        </div>
      <?php endif; ?>
      
      <div class="case-table-content">
        <h3><?php echo esc_html(blahlab_value($portfolio_item, 'title')) ?></h3>
        <p>
          <?php echo wp_kses(nl2br(blahlab_value($portfolio_item, 'content')), array( 'br' => array() ) ); ?>
        </p>
        <p>
          <span class="styled-button-wrapper">
            <a href="<?php echo esc_url(get_permalink($work_id)) ?>" class="styled button">
              View case study
            </a>
          </span>
        </p>
      </div>

    <?php else: ?>

      <div class="case-table-content">
        <h3><?php echo esc_html(blahlab_value($portfolio_item, 'title')) ?></h3>
        <p>
          <?php echo wp_kses(nl2br(blahlab_value($portfolio_item, 'content')), array( 'br' => array() ) ); ?>
        </p>
        <p>
          <span class="styled-button-wrapper">
            <a href="<?php echo esc_url(get_permalink($work_id)) ?>" class="styled button">
              View case study
            </a>
          </span>
        </p>
      </div>

      <?php if ( $media_type == 'image' ): ?>

        <div class="case-image">
           <img src="<?php echo esc_url($image_url) ?>" alt="<?php esc_attr_e('case image', 'haud-by-honryou') ?>">
        </div>

      <?php elseif ( $media_type == 'video' ): ?>
      
        <div class="case-video">
          <video loop="" autoplay="" muted="" playsinline="" class="brand-video" preload="">
            <source src="<?php echo esc_url($video_url) ?>" type="video/mp4">
          </video>
          <svg width="1000" height="563" viewBox="0 0 1000 563" class="svg-graphic">
            <defs>
              <mask id="<?php echo esc_attr($slide_id) ?>-mask" x="0" y="0" width="1000" height="563">
                <rect x="0" y="0" width="1000" height="563" fill="#fff"></rect>
                <?php echo wp_kses( blahlab_value($shape_mask_svg), blahlab_haud_svg_wp_kses_array() ); ?>
              </mask>
            </defs>
            <rect x="0" y="0" width="1000" height="563"></rect>
          </svg>
        </div>
      <?php endif; ?>

    <?php endif ?>
  </div>



  
<?php endforeach ?>