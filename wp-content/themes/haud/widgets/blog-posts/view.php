<?php

  $blahlab_haud_query = array(
    'post_type' => 'post',
    'posts_per_page' => -1
  );

  $blahlab_haud_query_object = new WP_Query($blahlab_haud_query);


  while($blahlab_haud_query_object->have_posts()) {

    $blahlab_haud_query_object->the_post(); 
    global $post;

    $blahlab_haud_thumbnail_url = get_the_post_thumbnail_url($post);

    $custom_css = "
      #blogposts-{$post->ID} .post-image-wrap .post-image {
        background-image: url({$blahlab_haud_thumbnail_url});
      }
    ";

    wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

  }


?>


<div class="full no-top overlap-top" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="large-12 columns">
    <div class="posts blogposts">

      <?php 
        query_posts(array(
          'post_type' => 'post'
        ));

        $sticky_posts = get_option( 'sticky_posts' );

      ?>

      <?php while(have_posts()): ?>
        <?php the_post(); ?>
  
        <?php if ( is_sticky($post->ID) ): ?>
          
          <div class="large-12 columns">
            <div class="post featured" id="blogposts-<?php echo esc_attr($post->ID); ?>">
              <div class="post-desc">
                <p class="info-author">
                  <span>
                    <?php echo esc_html__('Posted by', 'haud-by-honryou') ?> <?php echo get_the_author(); ?>
                  </span>
                </p>
                <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h3>
<!--                 <p class="info-others">
                  <span><?php echo get_the_date() ?></span>
                  <span>
                    <?php echo esc_html__('In', 'haud-by-honryou') ?>
                    <?php echo get_the_category_list(', ') ?>
                  </span>
                  <span>
                    <?php comments_popup_link(esc_html__('Leave a comment', 'haud-by-honryou'), esc_html__('Comment 1', 'haud-by-honryou'), esc_html__('Comments %', 'haud-by-honryou')); ?>
                  </span>
                </p> -->
              </div>

              <div class="post-image-wrap">
                <div class="post-image"></div>
              </div>
            </div>
          </div>

        <?php else: ?>
          
          <div class="large-6 columns">
            <div class="post" id="blogposts-<?php echo esc_attr($post->ID); ?>">
              <div class="post-desc">
<!--                 <p class="info-author">
                  <span>
                    <?php echo esc_html__('Posted by', 'haud-by-honryou') ?> <?php echo get_the_author(); ?>
                  </span>
                </p> -->
                <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h3>
<!--                 <p class="info-others">
                  <span><?php echo get_the_date() ?></span>
                  <span>
                    <?php echo esc_html__('In', 'haud-by-honryou') ?>
                    <?php echo get_the_category_list(', ') ?>
                  </span>
                  <span>
                    <?php comments_popup_link(esc_html__('Leave a comment', 'haud-by-honryou'), esc_html__('Comment 1', 'haud-by-honryou'), esc_html__('Comments %', 'haud-by-honryou')); ?>
                  </span>
                </p> -->
              </div>

              <div class="post-image-wrap">
                <div class="post-image"></div>
              </div>
            </div>
          </div>

        <?php endif ?>

      <?php endwhile; ?>



    </div>
  </div>

  <div class="large-12 columns">
    <div class="four spacing"></div>
    <p class="centered-text">
      <a href="" id="load_more_posts" data-page="2" class="load-more button styled"><?php echo esc_html__('Load more', 'haud-by-honryou') ?></a>
    </p>
  </div>
</div>
