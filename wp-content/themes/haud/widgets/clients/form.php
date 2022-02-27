<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >
<textarea type="text" v-model="options.desc" placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>

<select v-model="options.layout">
  <option disabled value=""><?php esc_html_e('Choose layout', 'haud-by-honryou') ?></option>
  <option value="intro_text_left"><?php esc_html_e('Introdution text at left', 'haud-by-honryou') ?></option>
  <option value="intro_text_right"><?php esc_html_e('Introdution text at right', 'haud-by-honryou') ?></option>
</select>

<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>

<div class="spacing"></div>

<draggable v-model="options.clients" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="(client, index) in options.clients" class="blahlab-accordion-item"  :key="client">

    <blahlab-accordion-title :item="client" v-on:remove="options.clients.splice(options.clients.indexOf(client), 1)">
      {{ client.logo ? "Client: " + basename(client.logo) : "Client" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <blahlab-upload-image v-model="client.logo">Upload logo</blahlab-upload-image>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.clients.push(clone(defaults.clients[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add a Client', 'haud-by-honryou') ?></blahlab-button>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" type="checkbox" v-model="options.no_top_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" class="inline-filter">No top space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" type="checkbox" v-model="options.no_bottom_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" class="inline-filter">No bottom space</label>
</p>