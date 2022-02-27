<?php

  $images = blahlab_value($this->instance, 'options.images', array());

  foreach ($images as $index => $image) {
    $name = 'image_' . ($index + 1);
    $$name = $image;
  }

  $bg_color = blahlab_value($this->instance, 'options.bg_color');

  $no_top_space = blahlab_value($this->instance, 'options.no_top_space');
  $no_bottom_space = blahlab_value($this->instance, 'options.no_bottom_space');

  $spacing_classes = array();

  if ($no_top_space) {
    $spacing_classes[] = 'no-top';
  }

  if ($no_bottom_space) {
    $spacing_classes[] = 'no-bottom';
  }


  $custom_css = "
    #{$widget_id}-inner {
      background-color: {$bg_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>

<div class="full <?php echo esc_attr(implode(' ', $spacing_classes)) ?>" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="case-intro">
    <div class="large-8 large-centered columns">
      <h2 class="case-title">
        <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
      </h2>
      <p class="case-text-big">
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
      <p><?php echo esc_html(blahlab_value($this->instance, 'options.sub_desc')) ?></p>
    </div>
  </div>

  <?php

    $show_images_grid = false;

    foreach ($images as $image ) {
      if ( blahlab_value($image, 'url') ) {
        $show_images_grid = true;
        break;
      }
    }

  ?>

  <?php if ( $show_images_grid ): ?>

    <div class="spacing"></div>

    <div class="studio-images">
      <div class="row">
        <div class="large-6 columns">
          <img src="<?php echo esc_attr(blahlab_value($image_1, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
        </div>
        <div class="large-6 columns">
          <div class="row">
            <div class="large-6 columns">
              <img src="<?php echo esc_attr(blahlab_value($image_2, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
            </div>
            <div class="large-6 columns">
              <img src="<?php echo esc_attr(blahlab_value($image_3, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
            </div>
          </div>
          <div class="row">
            <div class="large-4 columns">
              <img src="<?php echo esc_attr(blahlab_value($image_4, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
            </div>
            <div class="large-4 columns">
              <img src="<?php echo esc_attr(blahlab_value($image_5, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
            </div>
            <div class="large-4 columns">
              <img src="<?php echo esc_attr(blahlab_value($image_6, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="large-6 columns">
          <div class="large-4 columns">
            <img src="<?php echo esc_attr(blahlab_value($image_7, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
          </div>
          <div class="large-4 columns">
            <img src="<?php echo esc_attr(blahlab_value($image_8, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
          </div>
          <div class="large-4 columns">
            <img src="<?php echo esc_attr(blahlab_value($image_9, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
          </div>
        </div>
        <div class="large-6 columns">
          <div class="large-12 columns">
            <img src="<?php echo esc_attr(blahlab_value($image_10, 'url')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
          </div>
        </div>

      </div>
    </div>

  <?php endif ?>

</div>