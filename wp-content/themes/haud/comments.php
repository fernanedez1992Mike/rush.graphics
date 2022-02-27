<?php if(get_comments_number() > 0): ?>
  <div class="comments-wrapper">
    <?php if(post_password_required()): ?>
      <p class="nopassword">
        <?php esc_html_e('This post is password protected. Enter the password to view any comments.', 'haud-by-honryou'); ?>
      </p>
      </div>
      <?php return; ?>
    <?php endif; ?>
    <?php if(have_comments()): ?>
      <ul class="comments">
        <?php paginate_comments_links(); ?>
        <?php wp_list_comments(array('callback' => 'blahlab_haud_custom_comment', 'short_ping' => true)); ?>
      </ul>
    <?php elseif(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')): ?>
      <p class="nocomments">
        <?php esc_html_e('Comments are closed.', 'haud-by-honryou'); ?>
      </p>
    <?php endif; ?>
  </div>
<?php endif; ?>
