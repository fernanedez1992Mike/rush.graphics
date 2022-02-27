<?php get_header(); ?>
<?php the_post(); ?>

<?php

  $blahlab_haud_thumbnail_url = get_the_post_thumbnail_url($post);

  $blahlab_haud_custom_css = "
    body.postid-{$post->ID} .post-image-wrap .post-image  {
      background-image: url({$blahlab_haud_thumbnail_url});
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $blahlab_haud_custom_css);

?>

<div class="full grey">
</div>

<div class="full no-top overlap-top">
  <div class="post">
      <div class="row">
          <div class="large-8 large-centered columns">
              <div class="post-desc">
<!--                 <p class="info-author">
                  <span>
                    <?php echo esc_html__('Posted by', 'haud-by-honryou') ?>
                    <?php echo get_the_author(); ?>
                  </span>
                </p> -->
                <h2><?php echo get_the_title(); ?></h2>
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
          </div>
      </div>

      <div class="post-image-wrap">
        <div class="post-image"></div>
      </div>
  </div>
  <div class="post-content">
    <div class="two spacing"></div>

    <div class="row">
      <div class="large-8 large-centered columns">
        <?php the_content(); ?>

        <?php
          wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'haud-by-honryou' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
          ) );
        ?>
		  
		  <div class="tags">
			  <div>Published on <?php echo get_the_date() ?></div>
			  <div>
				  <?php echo esc_html__('In', 'haud-by-honryou') ?>
				  <?php echo get_the_category_list(', ') ?>
			  </div>                 
		  </div>

        <div class="tags">
          <?php echo the_tags('Tags: ', ', ', ''); ?>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="full no-top">
  <?php if ( !post_password_required() && get_comments_number() != 0 ): ?>
    <div class="row">
      <div class="large-8 large-centered columns">
        <h4>
          <?php echo esc_html__('Comments', 'haud-by-honryou') . ' (' . get_comments_number() . ')'; ?>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="large-8 large-centered columns">
        <div class='comments-wrapper'>
          <a href="#comments"></a>
          <?php comments_template('', true); ?>
        </div>
      </div>
    </div>
    <div class="two spacing"></div>
  <?php endif; ?>
  <?php if (comments_open()): ?>
    <div class="row">
      <div class="large-8 large-centered columns">
        <h4>
          <?php echo esc_html__('Leave a comment', 'haud-by-honryou') ?>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="large-8 large-centered columns">
        <div id='comments-form'>
          <?php
            comment_form(
              array(
                'fields' => array(
                  'author' => "<p class='name'><input class='input-text required' id='name' name='author' type='text' placeholder='" . esc_attr__('Name', 'haud-by-honryou') . "'></p>",
                  'email' => "<p class='email'><input class='input-text required' id='email' name='email' type='text' placeholder='" . esc_attr__('Email', 'haud-by-honryou') . "'></p>",
                ),
                'comment_notes_before' => '',
                'comment_notes_after' => '',
                'comment_field' => "<p class='message'><textarea class='required' cols='80' id='message' name='comment' rows='5' placeholder='" . esc_attr__('Comment', 'haud-by-honryou') . "'></textarea></p>",
                'label_submit' => esc_html__('Post Comment', 'haud-by-honryou'),
                'title_reply' => '',
                'class_form' => 'dark'
              )
            );
          ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php
  $blahlab_previous = get_previous_post();
  $blahlab_next = get_next_post();
?>

<nav class='wrapper'>
  <div class="small-6 columns">
    <?php if ( $blahlab_previous ): ?>
      <a class="previous" href='<?php echo esc_attr(get_permalink($blahlab_previous)); ?>'>
        <i class='fa fa-angle-left'></i>
        <span class="sub-title">Previous post</span>
        <span class="title"><?php echo get_the_title($blahlab_previous); ?></span>
      </a>
    <?php endif ?>
  </div>
  <div class="small-6 columns">
    <?php if ( $blahlab_next ): ?>
      <a class="next" href='<?php echo esc_attr(get_permalink($blahlab_next)); ?>'>
        <i class='fa fa-angle-right'></i>
        <span class="sub-title">Next post</span>
        <span class="title"><?php echo get_the_title($blahlab_next); ?></span>
      </a>
    <?php endif ?>
  </div>
</nav>


<?php get_footer(); ?>