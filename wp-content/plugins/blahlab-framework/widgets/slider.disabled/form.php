<p>
  <input id="<?php echo blahlab_esc($this->get_field_id('autoplay')); ?>" type="checkbox" v-model="options.autoplay" class="checkbox">
  <label for="<?php echo blahlab_esc($this->get_field_id('autoplay')); ?>" class="inline-filter">Autoplay</label>
</p>

<input type="text" v-model='options.title' placeholder="Title" >

<draggable v-model="options.slides" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="slide in options.slides" class="blahlab-accordion-item"  :key="slide">

    <blahlab-accordion-title :item="slide" v-on:remove="options.slides.splice(options.slides.indexOf(slide), 1)">
      {{ slide.title ? "slide: " + slide.title : "slide" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <blahlab-upload-image v-model="slide.image">Choose background image</blahlab-upload-image>
      <input type="text" v-model='slide.title' placeholder="Title" >
      <input type="text" v-model='slide.tagline' placeholder="Tagline" >

      <input type="text" v-model='slide.button_1.text' placeholder="Button 1 Text" >
      <input type="text" v-model='slide.button_1.url' placeholder="Button 1 URL" >

      <input type="text" v-model='slide.button_2.text' placeholder="Button 2 Text" >
      <input type="text" v-model='slide.button_2.url' placeholder="Button 2 URL" >

      <input type="text" v-model='slide.background_video_url_webm' placeholder="Background webm video url" >
      <input type="text" v-model='slide.background_video_url_mp4' placeholder="Background mp4 video url" >
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.slides.push(clone(defaults.slides[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Slide</blahlab-button>
</p>