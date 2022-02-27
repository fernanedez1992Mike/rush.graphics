<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >
<textarea v-model="options.desc" placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>

<select v-model="options.layout">
  <option disabled value=""><?php esc_html_e('Choose layout', 'haud-by-honryou') ?></option>
  <option value="intro_text_left"><?php esc_html_e('Introdution text at left', 'haud-by-honryou') ?></option>
  <option value="intro_text_right"><?php esc_html_e('Introdution text at right', 'haud-by-honryou') ?></option>
</select>

<blahlab-color-picker v-model="options.bg_color">Select Background Color</blahlab-color-picker>

<div class="spacing"></div>

<draggable v-model="options.services" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="service in options.services" class="blahlab-accordion-item"  :key="service">

    <blahlab-accordion-title :item="service" v-on:remove="options.services.splice(options.services.indexOf(service), 1)">
      {{ service.title ? "Service: " + service.title : "Service" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <ul class="fa-icons">
        <li v-for="icon in themeData.linea_icons" class="fa" v-bind:class="[ { active: icon == service.icon }, 'icon-basic-'+icon ]" v-on:click="service.icon = icon"></li>
      </ul>
      <input type="text" v-model="service.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" />
      
      <div class="subs">
        <ul>
          <li v-for="sub in service.subs" class="sub_item">
            <input type="text" v-model="sub.text" placeholder="<?php esc_attr_e('service item', 'haud-by-honryou') ?>" class="short">
            <a v-on:click.prevent="service.subs.splice(service.subs.indexOf(sub), 1)" class="delete">[X]</a>
          </li>
        </ul>
        <a class="add" v-on:click.prevent="service.subs.push(clone(defaults.services[0].subs[0]))">Add Item</a>
      </div>

      <div class="spacing"></div>

    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.services.push(clone(defaults.services[0]));addClass('.blahlab-accordion-item:last', 'open')">Add a Service</blahlab-button>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" type="checkbox" v-model="options.no_top_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_top_space')); ?>" class="inline-filter">No top space</label>
</p>

<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" type="checkbox" v-model="options.no_bottom_space" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('no_bottom_space')); ?>" class="inline-filter">No bottom space</label>
</p>
