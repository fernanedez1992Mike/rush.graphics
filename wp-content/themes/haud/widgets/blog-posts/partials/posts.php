<?php while(have_posts()): ?>
  <?php the_post(); ?>
  <?php 
    global $post;
    setup_postdata( $post );

    $blahlab_haud_thumbnail_url = get_the_post_thumbnail_url($post);
  ?>

  <div class="large-6 columns">
    <div class="post" id="blogposts-<?php echo esc_attr($post->ID); ?>">
      <div class="post-desc">
        <p class="info-author">
          <span>
            <?php echo esc_html__('Posted by', 'haud-by-honryou') ?> <?php echo get_the_author(); ?>
          </span>
        </p>
        <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h3>
<!--         <p class="info-others">
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


<?php endwhile; ?>