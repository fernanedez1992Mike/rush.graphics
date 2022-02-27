<input v-model='options.title' type="text" placeholder="Title" >
<blahlab-upload-image v-model="options.bg">Choose Background Image</blahlab-upload-image>

<draggable v-model="options.testimonials" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="testimonial in options.testimonials" class="blahlab-accordion-item"  :key="testimonial">

    <blahlab-accordion-title :item="testimonial" v-on:remove="options.testimonials.splice(options.testimonials.indexOf(testimonial), 1)">
      {{ testimonial.author ? "Testimonial: " + testimonial.author : "Testimonial" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <textarea v-model="testimonial.quote" placeholder="Quote"></textarea>
      <input type="text" v-model='testimonial.author' placeholder="Author Name" >
      <input type="text" v-model='testimonial.position' placeholder="Position" >
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.testimonials.push(clone(defaults.testimonials[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Testimonial</blahlab-button>
</p>