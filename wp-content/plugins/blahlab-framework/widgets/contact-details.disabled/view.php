<?php

  $contact_infos = blahlab_value($this->instance, 'options.infos', array());

?>

<div class='full'>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2 style=''>
            <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
          </h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
  </div>
  <div class='row'>
    <div class='medium-8 columns'>
      <div class='form'>
        <div class='row'>
          <form id='contact_form' method='POST'>
            <div class='large-12 columns'>
              <p id='thanks' class='hide'>
                Thanks for contacting us, we'll be in touch soon!
              </p>
            </div>
            <div class='medium-12 columns'>
              <input class='required' name='name' placeholder='NAME' type='text'>
              <input class='required email' name='email' placeholder='EMAIL' type='text'>
              <input class='required' name='subject' placeholder='SUBJECT' type='text'>
              <textarea class='required' name='message' placeholder='MESSAGE'></textarea>
              <input type="hidden" name="action" value="blahlab_widget_ajax_contact_details">
              <input type="hidden" name="widget_action" value="send_email">
              <input type="hidden" name="widget_number" value="<?php echo esc_attr($this->number); ?>">
              <input class='button' type='submit' value="Submit">
            </div>
          </form>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
    <div class='medium-4 columns'>
      <div class='contact-details'>
        <?php foreach ($contact_infos as $index => $contact_info): ?>
          <h4><?php echo esc_html(blahlab_value($contact_info, 'title')) ?></h4>
          <p><?php echo esc_html(blahlab_value($contact_info, 'text')) ?></p>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>
