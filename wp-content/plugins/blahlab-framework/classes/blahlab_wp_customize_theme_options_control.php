<?php 

class Blahlab_WP_Customize_Theme_Options_Control extends WP_Customize_Control {

  public $type = 'theme_options';

  public function render_content() {
    ?>
      <div id="blahlab_theme_options">
        <?php if ( blahlab_can_do_one_click_setup() ): ?>
          <div id="one_click_setup_wrapper">
            <button type="button" class="button" id="one_click_setup"><?php esc_attr_e( 'One click setup', 'blahlab-framework' ); ?></button>
          </div>
        <?php endif ?>
        <textarea class="widefat hide defaults" rows="3" cols="80">
          <?php echo json_encode(blahlab_value($this->defaults, null, '{}')); ?>
        </textarea>
        <div class="form">
          <?php 
            $theme_options_view_path = blahlab_get_theme_options_view_path();
            include($theme_options_view_path);
          ?>
        </div>
      </div>
    <?php
  }

}

?>