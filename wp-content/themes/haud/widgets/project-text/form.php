<input type="text" v-model="options.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" />

<select size="1" v-model="options.title_style">
  <option value=""><?php esc_html_e('Choose title style', 'haud-by-honryou') ?></option>
  <option value="big"><?php esc_html_e('Big', 'haud-by-honryou') ?></option>
  <option value="small"><?php esc_html_e('Small', 'haud-by-honryou') ?></option>
</select>

<textarea v-model="options.text" placeholder="<?php esc_attr_e('Text', 'haud-by-honryou') ?>"></textarea>

<select size="1" v-model="options.position">
  <option value=""><?php esc_html_e('Choose position', 'haud-by-honryou') ?></option>
  <option value="left"><?php esc_html_e('Left', 'haud-by-honryou') ?></option>
  <option value="right"><?php esc_html_e('Right', 'haud-by-honryou') ?></option>
  <option value="title_left_text_right" v-if="options.title_style != 'small'"><?php esc_html_e('Title left text right', 'haud-by-honryou') ?></option>
</select>

<blahlab-color-picker v-model="options.bg_color"><?php esc_html_e('Select Background Color', 'haud-by-honryou') ?></blahlab-color-picker>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" type="checkbox" v-model="options.no_top_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" class="inline-filter">No top space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" type="checkbox" v-model="options.no_bottom_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" class="inline-filter">No bottom space</label>
</p>
