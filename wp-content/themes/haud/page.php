<?php get_header(); ?>
<?php the_post(); ?>

<div class="full header head-bg grey">
  <div class="case-intro">
    <div class="large-12 columns">
      <div class="four spacing"></div>
      <h2 class="head-title">
        <?php echo get_the_title(); ?>
      </h2>
    </div>
  </div>
</div>

<div class="full less-bottom">
  <div class="post-content">
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
          <?php echo the_tags('Tags: ', ', ', ''); ?>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="full no-top less-bottom">
  <?php if ( get_comments_number() != 0 ): ?>
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
    <div class="four spacing"></div>
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



<?php get_footer(); ?>