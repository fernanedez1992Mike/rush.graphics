<?php get_header(); ?>
<?php the_post(); ?>

<?php

  global $blahlab_haud_portfolio_colors_metabox;
  $blahlab_haud_portfolio_colors_metabox->the_meta($post->ID);
  $portfolio_colors_options = json_decode($blahlab_haud_portfolio_colors_metabox->get_the_value('options'), true);

  $blahlab_haud_primary_color = blahlab_value($portfolio_colors_options, 'primary');
  $blahlab_haud_secondary_color = blahlab_value($portfolio_colors_options, 'secondary');
  $blahlab_haud_secondary_same_as_primary = blahlab_value($portfolio_colors_options, 'secondary_same_as_primary');
  if ( $blahlab_haud_secondary_same_as_primary ) {
    $blahlab_haud_secondary_color = $blahlab_haud_primary_color;
  }



  $blahlab_haud_custom_css = "

    body.single-portfolio.postid-{$post->ID} .case-intro .case-video, body.single-portfolio.postid-{$post->ID} .case-intro .case-image {
      background: {$blahlab_haud_primary_color};
    }

    body.single-portfolio.postid-{$post->ID} .svg-graphic > rect {
      mask: url(#post-{$post->ID}-mask);
      fill: {$blahlab_haud_primary_color};
    }

    body.single-portfolio.postid-{$post->ID} .case-study-label {
      background-color: {$blahlab_haud_secondary_color};
    }

    body.single-portfolio.postid-{$post->ID} .styled-button-wrapper .styled.button {
      color: {$blahlab_haud_secondary_color};
      background-image: linear-gradient(to bottom, transparent 62%, {$blahlab_haud_secondary_color} 0);
    }

  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $blahlab_haud_custom_css);


  global $blahlab_haud_portfolio_details_metabox;
  $blahlab_haud_portfolio_details_metabox->the_meta($post->ID);
  $portfolio_details_options = json_decode($blahlab_haud_portfolio_details_metabox->get_the_value('options'), true);

  $blahlab_haud_client = blahlab_value($portfolio_details_options, 'client');
  $blahlab_haud_services = blahlab_value($portfolio_details_options, 'services', array());
  $blahlab_haud_service_names = array();
  foreach ($blahlab_haud_services as $service) {
    $blahlab_haud_service_names[] = blahlab_value($service, 'name');
  }
  $blahlab_haud_link = blahlab_value($portfolio_details_options, 'link');


  global $blahlab_haud_portfolio_media_metabox;
  $blahlab_haud_portfolio_media_metabox->the_meta($post->ID);
  $blahlab_haud_portfolio_media_options = json_decode($blahlab_haud_portfolio_media_metabox->get_the_value('options'), true);

  $blahlab_haud_video_url = blahlab_value($blahlab_haud_portfolio_media_options, 'video');
  $blahlab_haud_image_url = blahlab_value($blahlab_haud_portfolio_media_options, 'image');
  $blahlab_haud_media_type = blahlab_value($blahlab_haud_portfolio_media_options, 'media_type');
  $blahlab_haud_shape_mask_svg = blahlab_value($blahlab_haud_portfolio_media_options, 'svg_mask_code');


  $blahlab_haud_category_names = array();
  $blahlab_haud_terms = get_the_terms($post->ID, 'portfolio_category');
  $blahlab_haud_category_names = array();
  $blahlab_haud_category_slugs = array();
  if($blahlab_haud_terms) {
    foreach($blahlab_haud_terms as $blahlab_haud_term) {
      $blahlab_haud_category_slugs[] = strtolower(str_replace(' ', '-', $blahlab_haud_term->name));
      $blahlab_haud_category_names[] = ucfirst(strtolower($blahlab_haud_term->name));
    }
  }


  $blahlab_haud_items = blahlab_haud_value($blahlab_haud_meta_options, 'related_projects');

  $blahlab_haud_query = array(
    'posts_per_page' => -1,
    'orderby' => 'date',
    'post_type' => 'portfolio'
  );

  $blahlab_haud_query['include'] = $blahlab_haud_items;

  if (count($blahlab_haud_items) > 0) {
    $blahlab_haud_related_projects = get_posts($blahlab_haud_query);
  } else {
    $blahlab_haud_related_projects = array();
  }

  wp_reset_postdata();

?>

<?php $blahlab_haud_the_id = get_the_ID(); ?>

<div class="full header">
  <div class="case-intro">
    <div class="large-12 columns">
      <div class="four spacing"></div>
      <h2 class="case-title">
        <?php echo get_the_title(); ?>
      </h2>
    </div>
    <div class="large-6 columns">
      <p class="case-text-big">
        <?php echo wp_kses(nl2br($post->post_content), array( 'br' => array() ) ); ?>
      </p>
      <div class="two spacing"></div>
      <?php if ( blahlab_value($blahlab_haud_link, 'text') && blahlab_value($blahlab_haud_link, 'url') ): ?>
        <p>
          <span class="styled-button-wrapper">
            <a href="<?php echo esc_url(blahlab_value($blahlab_haud_link, 'url')) ?>" class="styled button">
              <?php echo esc_html(blahlab_value($blahlab_haud_link, 'text')) ?>
            </a>
          </span>
        </p>
      <?php endif ?>
    </div>

    <div class="large-4 columns">
      <?php if ( $blahlab_haud_client ): ?>
        <p class="case-tags">
          <strong>Client:</strong> <span><?php echo esc_html($blahlab_haud_client) ?></span>
        </p>
      <?php endif ?>

      <?php if ( count($blahlab_haud_service_names) > 0 ): ?>
        <p class="case-tags">
          <strong>Services:</strong> <span><?php echo esc_html(implode(', ', $blahlab_haud_service_names)) ?></span>
        </p>
      <?php endif ?>

      <?php if ( count($blahlab_haud_category_names) > 0 ): ?>
        <p class="case-tags">
          <strong>Category:</strong> <span><?php echo esc_html(implode(', ', $blahlab_haud_category_names)) ?></span>
        </p>
      <?php endif ?>

    </div>
  </div>
</div>


<div class="full no-sides no-bottom no-top">
  <div class="case-intro">

    <?php if ( $blahlab_haud_media_type == 'image' ): ?>

      <div class="case-image">
         <img src="<?php echo esc_url($blahlab_haud_image_url) ?>" alt="<?php esc_attr_e('case image', 'haud-by-honryou') ?>">
      </div>

    <?php elseif ( $blahlab_haud_media_type == 'video' ): ?>

      <div class="case-video">

        <video loop="" autoplay="" muted="" playsinline="" class="brand-video" preload="">
          <source src="<?php echo esc_url($blahlab_haud_video_url) ?>" type="video/mp4">
        </video>
        <svg width="1000" height="563" viewBox="0 0 1000 563" class="svg-graphic">
          <defs>
            <mask id="post-<?php echo esc_attr($post->ID) ?>-mask" x="0" y="0" width="1000" height="563">
              <rect x="0" y="0" width="1000" height="563" fill="#fff"></rect>
              <?php echo wp_kses( blahlab_value($blahlab_haud_shape_mask_svg), blahlab_haud_svg_wp_kses_array() ); ?>
            </mask>
          </defs>
          <rect x="0" y="0" width="1000" height="563"></rect>
        </svg>

      </div>

    <?php endif ?>

  </div>
</div>

<?php

  if (is_active_sidebar( 'blahlab-builder-' . $post->ID )) {
    dynamic_sidebar( 'blahlab-builder-' . $post->ID );
  }


  $blahlab_haud_next = get_next_post();

?>

<?php if ( $blahlab_haud_next ): ?>

  <div class="full no-sides no-top no-bottom case-bottom-wrapper">
    <a href="<?php echo esc_url(get_permalink($blahlab_haud_next)) ?>" class="next-project-link"></a>
    <div class="case-bottom">
      <h2><?php echo esc_html(get_the_title($blahlab_haud_next)) ?></h2>
      <span>Next Project</span>
    </div>
  </div>

<?php endif ?>



<?php get_footer(); ?>