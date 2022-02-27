<draggable v-model="options.contact_boxes" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="box in options.contact_boxes" class="blahlab-accordion-item"  :key="box">

    <blahlab-accordion-title :item="box" v-on:remove="options.contact_boxes.splice(options.contact_boxes.indexOf(box), 1)">
      {{ box.title ? "ContactBox: " + box.title : "ContactBox" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model="box.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" />
      <textarea v-model="box.text" placeholder="<?php esc_attr_e('Text', 'haud-by-honryou') ?>"></textarea>
      <input type="text" v-model="box.small_title" placeholder="<?php esc_attr_e('Small Title', 'haud-by-honryou') ?>" />
      <input type="text" v-model="box.email" placeholder="<?php esc_attr_e('Email', 'haud-by-honryou') ?>" />
      <select v-model="box.bg">
        <option disabled value=""><?php esc_html_e('Choose background', 'haud-by-honryou') ?></option>
        <option value="white"><?php esc_html_e('White', 'haud-by-honryou') ?></option>
        <option value="black"><?php esc_html_e('Black', 'haud-by-honryou') ?></option>
      </select>      
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.contact_boxes.push(clone(defaults.contact_boxes[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add New Box', 'haud-by-honryou') ?></blahlab-button>
</p>