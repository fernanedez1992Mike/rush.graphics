<?php 
  

  $bg_color = blahlab_value($this->instance, 'options.bg_color');
  $text_color = blahlab_value($this->instance, 'options.text_color');

  $custom_css = "
    #{$widget_id}-inner {
      background: {$bg_color};
      color: {$text_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>

<div class="full" id="<?php echo $widget_id ?>-inner">
  <div class="case-intro">
    <div class="large-12 columns">
      <h2 class="case-title"><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h2>
    </div>
    <div class='form'>
      <form id='contact_form' method='POST' class="blahlab_contact_form">
        <div class="large-6 columns">
          <input class='required' name='name' placeholder='<?php esc_attr_e('NAME', 'haud-by-honryou') ?>' type='text'>
        </div>
        <div class="large-6 columns">
          <input class='required email' name='email' placeholder='<?php esc_attr_e('EMAIL', 'haud-by-honryou') ?>' type='text'>
        </div>
        <div class="large-12 columns">
          <input class='required' name='subject' placeholder='<?php esc_attr_e('SUBJECT', 'haud-by-honryou') ?>' type='text'>
        </div>
        <div class="large-12 columns">
          <textarea class='required' name='message' placeholder='<?php esc_attr_e('MESSAGE', 'haud-by-honryou') ?>'></textarea>
          <input type="hidden" name="action" value="blahlab_widget_ajax_contact_details">
          <input type="hidden" name="widget_action" value="send_email">
          <input type="hidden" name="widget_number" value="<?php echo esc_attr($this->number); ?>">
          <input class='button white boxed contact-button' type='submit' value="Send it">
          <p class='hide thanks'>
            Thanks for contacting us, we'll be in touch soon!
          </p>
        </div>
      </form>
    </div>
  </div>
</div>