<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >

<textarea v-model="options.desc" placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>

<select v-model="options.layout">
  <option disabled value=""><?php esc_html_e('Choose layout', 'haud-by-honryou') ?></option>
  <option value="intro_text_left"><?php esc_html_e('Introdution text at left', 'haud-by-honryou') ?></option>
  <option value="intro_text_right"><?php esc_html_e('Introdution text at right', 'haud-by-honryou') ?></option>
</select>

<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>

<div class="spacing"></div>

<draggable v-model="options.members" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="(member, index) in options.members" class="blahlab-accordion-item"  :key="member">

    <blahlab-accordion-title :item="member" v-on:remove="options.members.splice(options.members.indexOf(member), 1)">
      {{ member.name ? "Member: " + member.name : "Member" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model='member.name' placeholder="<?php esc_attr_e('Name', 'haud-by-honryou') ?>" >
      <input type="text" v-model="member.position" placeholder="<?php esc_attr_e('Position', 'haud-by-honryou') ?>">
      <blahlab-upload-image v-model="member.avatar"><?php esc_html_e('Choose avatar', 'haud-by-honryou') ?></blahlab-upload-image>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.members.push(clone(defaults.members[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add a Member', 'haud-by-honryou') ?></blahlab-button>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" type="checkbox" v-model="options.no_top_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" class="inline-filter">No top space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" type="checkbox" v-model="options.no_bottom_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" class="inline-filter">No bottom space</label>
</p>