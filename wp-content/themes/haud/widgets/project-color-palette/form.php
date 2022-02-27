<input v-model="options.title" type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>">


<draggable v-model="options.colors" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="color in options.colors" class="blahlab-accordion-item"  :key="color">

    <blahlab-accordion-title :item="color" v-on:remove="options.colors.splice(options.colors.indexOf(color), 1)">
      {{ color.value ? "color: " + color.value : "color" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>

      <blahlab-color-picker v-model="color.bg_color">Select Background Color</blahlab-color-picker>
      <blahlab-color-picker v-model="color.text_color">Select Text Color</blahlab-color-picker>

    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.colors.push(clone(defaults.colors[0]));addClass('.blahlab-accordion-item:last', 'open')">Add a Color</blahlab-button>
</p>