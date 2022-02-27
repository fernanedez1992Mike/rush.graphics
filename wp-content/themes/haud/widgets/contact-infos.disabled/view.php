<?php 
  $blahlab_haud_copyright_message = blahlab_haud_get_option('copyright_message');
  $blahlab_haud_address = blahlab_haud_get_option('address');
  $blahlab_haud_phone = blahlab_haud_get_option('phone');
  $blahlab_haud_email = blahlab_haud_get_option('email');
  $blahlab_haud_emails = blahlab_haud_get_option('emails');

  $blahlab_haud_socials = blahlab_haud_get_option('socials', array());
?>

<div class="site-intro" id="contact-content">
  <h2><?php echo wp_kses(blahlab_value($this->instance, 'options.title'), array( 'br' => array() )) ?></h2>

  <?php if ( $blahlab_haud_phone ): ?>
    <p><?php echo esc_html(blahlab_value($blahlab_haud_phone)) ?></p>
  <?php endif ?>


  <?php if ( $blahlab_haud_address ): ?>
    <p>
      <?php echo wp_kses(blahlab_value($blahlab_haud_address), array( 'br' => array() )) ?>            
    </p>
  <?php endif ?>

  <?php if ( count($blahlab_haud_emails) > 0 ): ?>
    <div id="emails">
      <?php foreach ($blahlab_haud_emails as $index => $email): ?>
        <p><a href="mailto:<?php echo esc_url(blahlab_value($email, 'address')) ?>"><?php echo esc_html(blahlab_value($email, 'address')) ?></a></p>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <?php if ( count($blahlab_haud_socials) > 0 ): ?>
    <ul>
      <?php foreach ($blahlab_haud_socials as $social) { ?>
        <li><a target="_blank" href="<?php echo esc_url(blahlab_value($social, 'url')) ?>"><i class='fa fa-<?php echo esc_attr(blahlab_value($social, 'id')) ?>'></i></a></li>
      <?php } ?>
    </ul>
  <?php endif ?>

</div>
<div class="action-hint quick"><?php echo esc_html__('Scroll or drag to explore.', 'haud-by-honryou') ?></div>
<div class="action-hint-for-touch"><?php echo esc_html__('Swipe to explore.', 'haud-by-honryou') ?></div>