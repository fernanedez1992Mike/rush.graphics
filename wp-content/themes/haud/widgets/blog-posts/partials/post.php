<?php setup_postdata( $post ); ?>

<?php
  $class = "post";

  if ($index % 2 == 1) {
    $class .= " alt";
  }

  $bg = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'full') );

  if ($bg) {
    $class .= " bg";
  }


  $blahlab_haud_the_id = get_the_ID();

  $custom_css = "
    #post-{$blahlab_haud_the_id} {
      background-image: url({$bg});
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>

<div <?php post_class($class) ?> id="post-<?php echo esc_attr($blahlab_haud_the_id); ?>">
  <?php if (is_sticky()): ?>
    <div class="featured-post wow flipInX" data-wow-delay="1s">
      <p><?php esc_html_e('Featured', 'haud-by-honryou'); ?></p>
    </div>
  <?php endif ?>
  <p class='info'>
    <span><?php echo get_the_date() ?></span>
    /
    <span>
      <?php echo esc_html__('by', 'haud-by-honryou') ?>
      <a href="#"><?php echo get_the_author(); ?></a>
    </span>
    /
    <span>
      <?php echo esc_html__('In', 'haud-by-honryou') ?>
      <?php echo get_the_category_list(', ') ?>
    </span>
    /
    <span>
      <?php comments_popup_link(esc_html__('Leave a comment', 'haud-by-honryou'), esc_html__('1 Comment', 'haud-by-honryou'), esc_html__('Comments %', 'haud-by-honryou')); ?>
    </span>
  </p>
  <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
  <div class="three spacing"></div>
  <p><a href="<?php echo get_permalink(); ?>" class="button boxed red tiny"><?php echo esc_html__('Read more', 'haud-by-honryou') ?></a></p>
</div>