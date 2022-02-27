<?php
/**
 * Template Name: Haud Template
 *
 */

get_header();
global $post;

$blahlab_haud_queried_object = get_queried_object();

if ( $blahlab_haud_queried_object->ID == get_option('page_for_posts') ) {
  $post = $blahlab_haud_queried_object;
  setup_postdata( $post );
}

if ( post_password_required() ) { ?>
  <section id="post-<?php the_ID(); ?>">
    <div class="row">
      <div class="twelve columns">
        <?php echo get_the_password_form(); ?>
      </div>
    </div>
  </section>
<?php } else { ?>

  <?php 

    if (is_active_sidebar( 'blahlab-builder-' . $post->ID )) {
      dynamic_sidebar( 'blahlab-builder-' . $post->ID );
    }

  ?>

<?php }

get_footer();