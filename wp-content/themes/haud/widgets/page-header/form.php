<input type="text" v-model="options.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>">
<textarea v-model="options.desc" placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>
<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>
<blahlab-upload-image v-model="options.bg_image">Choose background image</blahlab-upload-image>
