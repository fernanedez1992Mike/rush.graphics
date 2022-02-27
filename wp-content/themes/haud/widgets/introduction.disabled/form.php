<input type="text" v-model="options.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" />
<textarea v-model="options.text" placeholder="<?php esc_attr_e('Text', 'haud-by-honryou') ?>"></textarea>

<input type="text" v-model="options.button.text" placeholder="<?php esc_attr_e('Button Text', 'haud-by-honryou') ?>"></textarea>
<input type="text" v-model="options.button.url" placeholder="<?php esc_attr_e('Button URL', 'haud-by-honryou') ?>"></textarea>

<input type="text" v-model="options.hint_text.normal" placeholder="<?php esc_attr_e('Scroll hint text', 'haud-by-honryou') ?>" />
<input type="text" v-model="options.hint_text.touch" placeholder="<?php esc_attr_e('Swipe hint text for touch devices', 'haud-by-honryou') ?>" />