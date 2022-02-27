<div class="site-intro">
  <h2><?php echo wp_kses(blahlab_value($this->instance, 'options.title'), array( 'br' => array() )) ?></h2>
  <?php echo wpautop(blahlab_value($this->instance, 'options.text'), array( 'br' => array() )) ?>
  <div class="spacing"></div>
  <?php
    $button_text = blahlab_value($this->instance, 'options.button.text');
    $button_url = blahlab_value($this->instance, 'options.button.url');
  ?>
  
  <?php if ($button_text && $button_url): ?>
    <p>
      <a href="<?php echo esc_url(blahlab_value($button_url)) ?>" class="button boxed black"><?php echo esc_html(blahlab_value($button_text)) ?></a>
    </p>
  <?php endif ?>

</div>

<?php 
  
  $hint_text = blahlab_value($this->instance, 'options.hint_text.normal');
  $hint_text_for_touch = blahlab_value($this->instance, 'options.hint_text.touch');

?>

<?php if ($hint_text): ?>
  <div class="action-hint"><?php echo esc_html($hint_text); ?></div>
<?php endif ?>

<?php if ($hint_text_for_touch): ?>
  <div class="action-hint-for-touch"><?php echo esc_html($hint_text_for_touch); ?></div>
<?php endif ?>