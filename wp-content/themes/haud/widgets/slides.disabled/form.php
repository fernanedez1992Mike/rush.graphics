<draggable v-model="options.slides" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="slide in options.slides" class="blahlab-accordion-item"  :key="slide">

    <blahlab-accordion-title :item="slide" v-on:remove="options.slides.splice(options.slides.indexOf(slide), 1)">
      {{ slide.title ? "Slide: " + slide.title : "Slide" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <blahlab-upload-image v-model="slide.image"><?php esc_html_e('Choose image', 'haud-by-honryou') ?></blahlab-upload-image>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.slides.push(clone(defaults.slides[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add New Slide', 'haud-by-honryou') ?></blahlab-button>
</p>