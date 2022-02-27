<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >
<textarea v-model="options.desc" placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>
<textarea v-model="options.sub_desc" placeholder="<?php esc_attr_e('Sub description', 'haud-by-honryou') ?>"></textarea>

<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" type="checkbox" v-model="options.no_top_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" class="inline-filter">No top space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" type="checkbox" v-model="options.no_bottom_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" class="inline-filter">No bottom space</label>
</p>

<div class="spacing"></div>

<label for="">10 images grid</label>
<div class="spacing"></div>
<draggable v-model="options.images" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="image in options.images" class="blahlab-accordion-item"  :key="image">

    <blahlab-accordion-title :item="image">
      {{ image.url ? "Image: " + basename(image.url) : "Image" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>

      <blahlab-upload-image v-model="image.url">Choose Image</blahlab-upload-image>
      
<!--       <select v-model="image.width" class="short">
        <option disabled value="">Select image width</option>
        <option value="full">Full</option>
        <option value="half">1/2</option>
        <option value="one-fourth">1/4</option>
        <option value="one-sixth">1/6</option>
      </select> -->

    </blahlab-accordion-content>

  </li>
</draggable>


