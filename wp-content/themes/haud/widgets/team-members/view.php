<?php

  $members = blahlab_value($this->instance, 'options.members', array());

  $bg_color = blahlab_value($this->instance, 'options.bg_color');
  $layout = blahlab_value($this->instance, 'options.layout');

  $no_top_space = blahlab_value($this->instance, 'options.no_top_space');
  $no_bottom_space = blahlab_value($this->instance, 'options.no_bottom_space');

  $spacing_classes = array();

  if ($no_top_space) {
    $spacing_classes[] = 'no-top';
  }

  if ($no_bottom_space) {
    $spacing_classes[] = 'no-bottom';
  }


  $custom_css = "
    #{$widget_id}-inner {
      background-color: {$bg_color};
    }
  ";

  wp_add_inline_style( 'blahlab-haud-inline-style', $custom_css);

?>


<div class="full <?php echo esc_attr(implode(' ', $spacing_classes)) ?>" id="<?php echo esc_attr($widget_id) ?>-inner">
  <div class="case-intro">

    <?php if ( $layout == 'intro_text_right'): ?>
      <div class="large-6 columns"></div>
    <?php endif ?>

    <div class="large-6 columns">
      <h2 class="case-title">
        <?php echo esc_html(blahlab_value($this->instance, 'options.title')) ?>
      </h2>
      <p>
        <?php echo esc_html(blahlab_value($this->instance, 'options.desc')) ?>
      </p>
    </div>

    <?php if ( $layout != 'intro_text_right'): ?>
      <div class="large-6 columns"></div>
    <?php endif ?>
  </div>

  <div class="spacing"></div>
  <div class="large-12 columns">
    <div id="members">
      <?php
        $groups = array_chunk($members, 4);
      ?>

      <?php
        foreach ($groups as $index => $row_members) {
      ?>
          <div class="members-row">
            <?php
              foreach ($row_members as $index => $member) {
                $end_class = $index == count($row_members) - 1 ? 'end' : '';
            ?>
                <div class="large-3 medium-6 columns <?php echo esc_attr(blahlab_value($end_class)) ?>">
                  <div class="member slideInUp">
                    <img src="<?php echo esc_url(blahlab_value($member, 'avatar')) ?>" alt="<?php esc_attr_e('image', 'haud-by-honryou') ?>">
                    <h4><?php echo esc_html(blahlab_value($member, 'name')) ?></h4>
                    <p class='position'><?php echo esc_html(blahlab_value($member, 'position')) ?></p>
                  </div>
                </div>
            <?php
              }
            ?>
          </div>
      <?php
        }
      ?>
    </div>
  </div>

</div>
