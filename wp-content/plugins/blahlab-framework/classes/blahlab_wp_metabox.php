<?php
  
  // in order to save the metaboxes, the post should be saved first, if the title and content are all empty, the post won't be saved

  require_once plugin_dir_path(__FILE__) . '../vendor/wpalchemy/wp-content/wpalchemy/MetaBox.php';

  class Blahlab_WP_MetaBox extends WPAlchemy_MetaBox {

    function _setup() {
      try {
        ob_start();
        parent::_setup();
        $view = ob_get_clean(); 
      } catch (Exception $e) {
        $view = $e;
      }

      echo '<div class="blahlab_wp_metabox">';
      ?>
        <!-- when there are HTML in the values -->
        <script type="text/html" class="options hide">
          <?php
            $blahlab_framework_options = $this->get_the_value('options');
            echo blahlab_value($blahlab_framework_options, null, '{}');
          ?>
        </script>
        <p>
          <textarea class="options hide" name="<?php echo blahlab_esc($this->get_the_name('options')); ?>" rows="3" cols="80">
          </textarea>
        </p>
        <p>
          <textarea class="defaults hide" rows="3" cols="80">
            <?php echo json_encode(blahlab_value($this->defaults)); ?>
          </textarea>
        </p>
      <?php
      echo blahlab_esc($view);
      echo '</div>';
    }

  }

?>