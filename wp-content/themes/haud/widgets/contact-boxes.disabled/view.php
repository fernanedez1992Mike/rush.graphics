<?php $boxes = blahlab_value($this->instance, 'options.contact_boxes', array()) ?>

<div class="full">

  <?php foreach ($boxes as $index => $box): ?>
    
    <?php
      $end_class = $index == count($boxes) - 1 ? 'end' : '';
      $bg_class = blahlab_value($box, 'bg') == 'black' ? 'dark' : '';
    ?>

    <div class="large-6 columns <?php echo esc_attr($end_class) ?>">
      <div class="contact-block-bottom <?php echo esc_attr($bg_class) ?>">
        <h3><?php echo esc_html(blahlab_value($box, 'title')) ?></h3>
        <p class="big-text">
          <?php echo esc_html(blahlab_value($box, 'text')) ?>
        </p>
        <div class="two spacing"></div>
        <p class="contact-email">
          <em><?php echo esc_html(blahlab_value($box, 'small_title')) ?></em>
          <a href="mailto:<?php echo esc_attr(blahlab_value($box, 'email')) ?>" title="<?php echo esc_attr(blahlab_value($box, 'small_title')) ?>"><?php echo esc_html(blahlab_value($box, 'email')) ?></a>
        </p>
      </div>
    </div>

  <?php endforeach ?>

</div>