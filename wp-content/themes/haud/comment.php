<?php
  global $comment, $args, $depth;
?>
<?php switch($comment->comment_type): ?>
<?php case('pingback'): ?>
<?php case('trackback'): ?>
  <li class="post pingbacka">
    <p>
      <?php esc_html_e('Pingback:', 'haud-by-honryou'); ?>
      <?php comment_author_link(); ?>
      <?php edit_comment_link(esc_html__('Edit', 'haud-by-honryou'), '<span class="edit-link">', '</span>') ?>
    </p>
  </li>
  <?php break; ?>
<?php default: ?>

  <li id="comment-<?php esc_attr(comment_ID()) ?>">
    <div class="meta">
      <p class="avatar"><?php echo get_avatar($comment, 39) ?></p>
      <p class="info">
        <span class="name"><?php echo get_comment_author_link(); ?></span>
        <span class="datetime">
          <?php echo get_comment_date() ?>
          at

          <?php echo get_comment_date('g:ia') ?>
          <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'haud-by-honryou' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </span>
      </p>
    </div>
    <?php if($comment->comment_approved == '0'): ?>
      <em class="comment-awaiting-moderation">
        <?php esc_html_e('Your comment is awaiting moderation.', 'haud-by-honryou') ?>
      </em>
    <?php endif; ?>
    <?php comment_text(); ?>
<?php endswitch; ?>
