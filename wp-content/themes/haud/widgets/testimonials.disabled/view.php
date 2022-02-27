<?php

  $testimonials = blahlab_value($this->instance, 'options.testimonials', array());

  $col_left = array();
  $col_right = array();

  foreach ($testimonials as $index => $t) {
    if ($index % 2 == 0) {
      $col_left[] = $t;
    } else {
      $col_right[] = $t;
    }
  }

?>

<div class="full no-right">
  <div class="text-block-right">
    <h2><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h2>
    <div class="testimonials">

      <?php foreach ($testimonials as $index => $t): ?>
        
        <blockquote class="big-text">
          "<?php echo esc_html(blahlab_value($t, 'quote')) ?>"
        </blockquote>
        <p>- <?php echo esc_html(blahlab_value($t, 'author')) ?>, <?php echo esc_html(blahlab_value($t, 'position')) ?></p>

      <?php endforeach ?>

    </div>

  </div>

</div>
