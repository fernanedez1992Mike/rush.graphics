<label>Catchwords</label>
<div class="spacing"></div>
<li v-for="catchword in options.catchwords">
  <input type="text" v-model="catchword.word" placeholder="<?php esc_attr_e('Catchword', 'haud-by-honryou') ?>" />
</li>

<div class="spacing"></div>

<blahlab-upload-video v-model="options.video" placeholder="<?php esc_attr_e('Paste MP4 video URL', 'haud-by-honryou') ?>"><?php esc_html_e('Or select video', 'haud-by-honryou') ?></blahlab-upload-video>

<textarea v-model="options.sub_title" placeholder="<?php esc_attr_e('Sub title', 'haud-by-honryou') ?>"></textarea>
<input type="text" v-model="options.hint_text" placeholder="<?php esc_attr_e('Hint text', 'haud-by-honryou') ?>" />


<input type="text" v-model="options.contact_link.text" placeholder="<?php esc_attr_e('Contact link text', 'haud-by-honryou') ?>">
<input type="text" v-model="options.contact_link.url" placeholder="<?php esc_attr_e('Contact link URL', 'haud-by-honryou') ?>">

<textarea type="text" v-model="options.shape_mask_svg" placeholder="<?php esc_attr_e('Shape mask SVG code', 'haud-by-honryou') ?>"></textarea>


<draggable v-model="options.featured_works" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="work in options.featured_works" class="blahlab-accordion-item"  :key="work">

    <blahlab-accordion-title :item="work" v-on:remove="options.featured_works.splice(options.featured_works.indexOf(work), 1)">
      {{ work.work_id && themeData.portfolio_items_dictionary[work.work_id] && themeData.portfolio_items_dictionary[work.work_id].title ? "Featured work: " + themeData.portfolio_items_dictionary[work.work_id].title : "Featured work" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>

      <select v-model="work.work_id">
        <option disabled value=""><?php esc_html_e('Choose portfolio item', 'haud-by-honryou') ?></option>
        <option v-for="p in themeData.portfolio_items" v-bind:value="p.id">{{ p.title }}</option>
      </select>

      
      <input type="text" v-model="work.nav_text" placeholder="<?php esc_attr_e('Nav text', 'haud-by-honryou') ?>" />
      <input type="text" v-model="work.bg_text" placeholder="<?php esc_attr_e('Background text', 'haud-by-honryou') ?>" />

    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.featured_works.push(clone(defaults.featured_works[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add another featured work', 'haud-by-honryou') ?></blahlab-button>
</p>
