<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >
<textarea v-model="options.desc" placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>
<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>
<input type="text" v-model="options.google_map_link.text" placeholder="<?php esc_attr_e('Google Map link text', 'haud-by-honryou') ?>">
<input type="text" v-model="options.google_map_link.url" placeholder="<?php esc_attr_e('Google Map link URL', 'haud-by-honryou') ?>">
