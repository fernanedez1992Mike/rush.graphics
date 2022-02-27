<input type="text" v-model='options.video_url' placeholder="<?php esc_attr_e('Background mp4 video url', 'haud-by-honryou') ?>" >

<input type="text" v-model="options.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" />
<textarea v-model="options.text" placeholder="<?php esc_attr_e('Text', 'haud-by-honryou') ?>"></textarea>
<textarea v-model="options.small_text" placeholder="<?php esc_attr_e('Small Text', 'haud-by-honryou') ?>"></textarea>

<input type="text" v-model="options.hint_text" placeholder="<?php esc_attr_e('Scroll hint text', 'haud-by-honryou') ?>" />
