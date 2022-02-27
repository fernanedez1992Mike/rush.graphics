<?php
  // *-spec.php is optional if you don't need to specify options for the metabox
  // *-view.php is always required
  // $blahlab_framework_mb->the_field('FILED_SLUG');
  // FIELD_SLUG could be any value
?>
<div>

  <p>
    <label for="">Primary color(for background)</label>
    <blahlab-color-picker v-model="options.primary">Choose color</blahlab-color-picker>
  </p>

  <p>
    <label for="" class="bottom-spacing">Secondary color(for link and label)</label>
    <input type="radio" v-model="options.secondary_same_as_primary" v-bind:value="true" id="same_as_primary">
    <label for="same_as_primary">Same as primary color</label>
    <br>
    <input type="radio" v-model="options.secondary_same_as_primary" v-bind:value="false" id="other">    
    <label for="other">other</label>
  </p>
  <p v-if="!options.secondary_same_as_primary">
    <blahlab-color-picker v-model="options.secondary">Choose color</blahlab-color-picker>
  </p>

</div>
