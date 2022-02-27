<input v-model='options.title' type="text" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >

<draggable v-model="options.testimonials" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="testimonial in options.testimonials" class="blahlab-accordion-item"  :key="testimonial">

    <blahlab-accordion-title :item="testimonial" v-on:remove="options.testimonials.splice(options.testimonials.indexOf(testimonial), 1)">
      {{ testimonial.author ? "Testimonial: " + testimonial.author : "Testimonial" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <textarea v-model="testimonial.quote" placeholder="<?php esc_attr_e('Quote', 'haud-by-honryou') ?>"></textarea>
      <input type="text" v-model='testimonial.author' placeholder="<?php esc_attr_e('Author Name', 'haud-by-honryou') ?>" >
      <input type="text" v-model='testimonial.position' placeholder="<?php esc_attr_e('Position', 'haud-by-honryou') ?>" >
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.testimonials.push(clone(defaults.testimonials[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add New Testimonial', 'haud-by-honryou') ?></blahlab-button>
</p>