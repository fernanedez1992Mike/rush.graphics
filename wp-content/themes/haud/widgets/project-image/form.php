<blahlab-upload-image v-model="options.image"><?php esc_html_e('Choose image', 'haud-by-honryou') ?></blahlab-upload-image>
<blahlab-color-picker v-model="options.bg_color"><?php esc_html_e('Choose background color', 'haud-by-honryou') ?></blahlab-color-picker>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" type="checkbox" v-model="options.no_top_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" class="inline-filter">No top space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" type="checkbox" v-model="options.no_bottom_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" class="inline-filter">No bottom space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('full')); ?>" type="checkbox" v-model="options.full" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('full')); ?>" class="inline-filter">Full width</label>
</p>