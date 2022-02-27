<?php
  // *-spec.php is optional if you don't need to specify options for the metabox
  // *-view.php is always required
  // $blahlab_framework_mb->the_field('FILED_SLUG');
  // FIELD_SLUG could be any value
?>
<div>

  <p>
    <select v-model="options.media_type">
      <option value=""><?php esc_html_e('Choose media type', 'haud-by-honryou') ?></option>
      <option value="image"><?php esc_html_e('Image', 'haud-by-honryou') ?></option>
      <option value="video"><?php esc_html_e('Video', 'haud-by-honryou') ?></option>
    </select>
  </p>

  <p>
    <blahlab-upload-image v-if="options.media_type == 'image'" v-model="options.image"><?php esc_html_e('Upload image', 'haud-by-honryou') ?></blahlab-upload-image>
    <blahlab-upload-video v-if="options.media_type == 'video'" v-model="options.video" placeholder="<?php esc_attr_e('Paste MP4 video URL', 'haud-by-honryou') ?>"><?php esc_html_e('Or select video', 'haud-by-honryou') ?></blahlab-upload-video>    
  </p>


  <p v-if="options.media_type == 'video'">
    <textarea rows="5" cols="80" v-model='options.svg_mask_code' placeholder="<?php esc_attr_e('SVG mask code', 'haud-by-honryou') ?>"></textarea>
  </p>

</div>
