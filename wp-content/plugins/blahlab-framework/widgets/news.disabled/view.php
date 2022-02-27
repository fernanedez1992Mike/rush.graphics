<?php

  $posts = blahlab_value($this->instance, 'options.posts');

  $query = array(
    'posts_per_page' => -1,
    'orderby' => 'date',
  );

  $query['include'] = $posts;

  if (count($posts) > 0) {
    $posts = get_posts($query);
  } else {
    $posts = array();
  }

  wp_reset_postdata();

  $title = blahlab_value($this->instance, 'options.title');
  $desc = blahlab_value($this->instance, 'options.desc');

?>



<div class='full parallax' style='background-image: url(<?php echo esc_attr(blahlab_value($this->instance, 'options.bg')) ?>);'>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 class="white">
            <?php echo esc_html(blahlab_value($title)) ?>
          </h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
  </div>
  <div class='row'>
    <?php foreach ($posts as $index => $post): ?>
      <?php setup_postdata( $post ); ?>
      <div class='large-4 medium-4 columns'>
        <div class='mod modBlogPost'>
          <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
            <?php echo wp_get_attachment_image( get_post_thumbnail_id($post->ID, 'full'), 'full' ); ?>
          </a>
          <div class='content'>
            <p class='date'><?php echo get_the_date('', $post->ID) ?></p>
            <h4><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo get_the_title($post) ?></a></h4>
            <?php the_excerpt(); ?>
            <div class='tags'>
              <?php $tags = get_the_tags($post); ?>
              <?php foreach ((array)$tags as $index => $tag): ?>
                <a href="<?php echo esc_url(get_tag_link($tag)); ?>"><?php echo esc_html(blahlab_value($tag->name)) ?></a>
                <?php if (count($tags) - 1 > $index): ?>
                  ,
                <?php endif ?>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <div class='two spacing'></div>
  <div class='row'>
    <div class='large-12 columns'>
      <p class='centered-text'>
        <?php
          $blahlab_blog = get_option('page_for_posts')
        ?>
        <a class='button boxed' href='<?php echo esc_attr(get_permalink($blahlab_blog)); ?>'>See more posts</a>
      </p>
    </div>
  </div>
  <div class='three spacing'></div>
</div>

