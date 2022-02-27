<?php

  $bg_color = blahlab_value($this->instance, 'options.bg_color');

  $custom_css = "
    #{$widget_id}-inner {
      background-color: {$bg_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

  $google_map_link = blahlab_value($this->instance, 'options.google_map_link');
  $google_map_link_text = blahlab_value($google_map_link, 'text');
  $google_map_link_url = blahlab_value($google_map_link, 'url');

?>


<div class="full white-text" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="case-intro">
    <div class="large-12 columns">
      <div class="four spacing"></div>
      <h2 class="head-title">
        <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
      </h2>
    </div>
    <div class="large-6 columns">
      <p class='case-text-big'>
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
      <div class="two spacing"></div>

      <?php if ( $google_map_link_text && $google_map_link_url ): ?>
        <p>
          <a class="button boxed black google-map-button" target="_blank" href="<?php echo esc_url($google_map_link_url) ?>"><i class="icon-basic-geolocalize-01"></i><?php echo esc_html($google_map_link_text) ?></a>
        </p>
      <?php endif ?>

      <div class="spacing"></div>
    </div>
    <div class="large-4 columns">

      <?php
        $blahlab_haud_address = blahlab_haud_get_option('address');
        $blahlab_haud_phone = blahlab_haud_get_option('phone');
        $blahlab_haud_email = blahlab_haud_get_option('email');
        $blahlab_haud_emails = blahlab_haud_get_option('emails', array());
        $blahlab_haud_socials = blahlab_haud_get_option('socials', array());
      ?>

      <div class="contact-details">

        <?php if ( $blahlab_haud_address ): ?>
          <p>
            <?php echo wp_kses(blahlab_value($blahlab_haud_address), array( 'br' => array() )) ?>
          </p>
        <?php endif ?>



        <?php if ( $blahlab_haud_phone ): ?>
          <p><?php echo esc_html(blahlab_value($blahlab_haud_phone)) ?></p>
        <?php endif ?>

        <?php if ( count($blahlab_haud_emails) > 0 ): ?>
          <?php foreach ($blahlab_haud_emails as $index => $email): ?>
            <p>
              <a href="mailto:<?php echo esc_url(blahlab_value($email, 'address')) ?>"><?php echo esc_html(blahlab_value($email, 'address')) ?></a><br />
            </p>
          <?php endforeach ?>
        <?php endif ?>



        <?php if ( count($blahlab_haud_socials) > 0 ): ?>
          <ul class="socials">
            <?php foreach ($blahlab_haud_socials as $social) { ?>
              <li><a target="_blank" href="<?php echo esc_url(blahlab_value($social, 'url')) ?>"><i class='fa fa-<?php echo esc_attr(blahlab_value($social, 'id')) ?>'></i></a></li>
            <?php } ?>
          </ul>
        <?php endif ?>

      </div>
    </div>
  </div>
</div>
