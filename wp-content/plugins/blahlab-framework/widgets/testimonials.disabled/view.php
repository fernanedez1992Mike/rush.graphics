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


<div class='full parallax white' style='background-image: url(<?php echo esc_attr(blahlab_value($this->instance, 'options.bg')) ?>);'>
  <div class='row'>
    <div class='large-12 columns'>
      <p class='centered-text'>
        <i class='fa fa-quote-left testimonial-quote-mark'></i>
      </p>
      <div class='spacing'></div>
    </div>
  </div>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 class="white"><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h2>
        </div>
      </div>
      <div class='spacing'></div>
    </div>
  </div>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='mod modTestimonials'>
        <div class='row'>
          <div class='small-12 columns'>
            <div class='items centered-text'>

              <?php foreach ($testimonials as $index => $testimonial): ?>
                <div class='item'>
                  <p class='quote'><?php echo esc_html(blahlab_value($testimonial, 'quote')) ?></p>
                  <p class='author'>
                    <?php
                      $author = blahlab_value($testimonial, 'author');
                      $position = blahlab_value($testimonial, 'position');
                    ?>
                    - <?php echo esc_html(blahlab_value($testimonial, 'author')) ?><?php echo blahlab_value($position) ? ',' : '' ?>
                    <?php echo esc_html(blahlab_value($position)) ?>
                  </p>
                  <div class='two spacing'></div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
          <div class='spacing'></div>
        </div>
      </div>
    </div>
  </div>
</div>