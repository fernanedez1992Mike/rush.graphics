<input type="text" v-model="options.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>">
<input type="text" v-model="options.sub_title" placeholder="<?php esc_attr_e('Sub title', 'haud-by-honryou') ?>">
<input type="text" v-model="options.url" placeholder="<?php esc_attr_e('URL', 'haud-by-honryou') ?>">
<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>
<blahlab-color-picker v-model="options.text_color">Select Text Color</blahlab-color-picker>


