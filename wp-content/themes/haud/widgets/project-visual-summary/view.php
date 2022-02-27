<?php 
  
  $big_image = blahlab_value($this->instance, 'options.big_image');
  $small_image = blahlab_value($this->instance, 'options.small_image');
  $bg_text = blahlab_value($this->instance, 'options.bg_text');

?>

<div class="full no-sides">
  <?php if ( $bg_text ): ?>
    <div class="bg-text-honri wow slideInRight" data-wow-duration="1.5s">
      <h2><?php echo esc_html($bg_text) ?></h2>
    </div>
  <?php endif ?>

  <?php if ( $big_image ): ?>
    <img src="<?php echo esc_url($big_image) ?>" alt="<?php esc_attr_e('big image', 'haud-by-honryou') ?>">
  <?php endif ?>

  <?php if ( $small_image ): ?>
    <img src="<?php echo esc_url($small_image) ?>" alt="<?php esc_attr_e('small image', 'haud-by-honryou') ?>" class="float-img">
  <?php endif ?>
  
</div>