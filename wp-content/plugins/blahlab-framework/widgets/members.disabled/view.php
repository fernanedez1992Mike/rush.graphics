<?php

  $members = blahlab_value($this->instance, 'options.members');

?>


<div class='full'>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2><?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?></h2>
        </div>
      </div>
      <div class='two spacing'></div>
    </div>
  </div>
  <div class='row'>

    <?php foreach ((array)$members as $index => $member): ?>
      <div class='small-6 medium-3 large-3 columns'>
        <div class='mod modTeamMember style-2'>
          <div class='member'>
            <img src="<?php echo esc_url(blahlab_value($member, 'avatar')) ?>" alt='image'>
          </div>
          <h3><?php echo esc_html(blahlab_value($member, 'name')) ?></h3>
          <p class='position'><?php echo esc_html(blahlab_value($member, 'position')) ?></p>
          <p><?php echo esc_html(blahlab_value($member, 'desc')) ?></p>
          <?php
            $socials = blahlab_value($member, 'socials', array());
          ?>
          <ul class='socials'>
            <?php foreach ($socials as $index => $social): ?>
              <li>
                <a href='<?php echo esc_url(blahlab_value($social, 'url')) ?>' target="_blank">
                  <i class='fa fa-<?php echo esc_attr(blahlab_value($social, 'id')) ?>'></i>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>

    <?php endforeach; ?>

  </div>
  <div class='four spacing'></div>
</div>
