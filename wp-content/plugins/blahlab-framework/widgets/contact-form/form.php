<!-- <blahlab-upload-image v-model="options.image">Upload image</blahlab-upload-image> -->
<input v-model="options.recipient" type="text" placeholder="<?php esc_attr_e('Contact Form Recipient', 'haud-by-honryou') ?>" />
<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" />
<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>
<blahlab-color-picker v-model="options.text_color">Select Text Color</blahlab-color-picker>