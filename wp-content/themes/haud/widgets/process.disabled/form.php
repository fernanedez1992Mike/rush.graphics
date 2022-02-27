<draggable v-model="options.introductions" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="introduction in options.introductions" class="blahlab-accordion-item" :key="introduction">

    <blahlab-accordion-title :item="introduction" v-on:remove="options.introductions.splice(options.introductions.indexOf(introduction), 1)">
      {{ introduction.title ? "Introduction: " + introduction.title : "Introduction" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model='introduction.title' placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >
      <textarea v-model='introduction.text' placeholder="<?php esc_attr_e('Text', 'haud-by-honryou') ?>"></textarea>
      <textarea v-model='introduction.small_text' placeholder="<?php esc_attr_e('Small Text', 'haud-by-honryou') ?>"></textarea>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.introductions.push(clone(defaults.introductions[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add New Introduction', 'haud-by-honryou') ?></blahlab-button>
</p>



<draggable v-model="options.steps" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="step in options.steps" class="blahlab-accordion-item" :key="step">

    <blahlab-accordion-title :item="step" v-on:remove="options.steps.splice(options.steps.indexOf(step), 1)">
      {{ step.title ? "Step: " + step.title : "Step" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model='step.title' placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" >
      <textarea v-model='step.desc' placeholder="<?php esc_attr_e('Description', 'haud-by-honryou') ?>"></textarea>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.steps.push(clone(defaults.steps[0]));addClass('.blahlab-accordion-item:last', 'open')"><?php esc_html_e('Add New Step', 'haud-by-honryou') ?></blahlab-button>
</p>

<input type="text" v-model="options.hint_text.normal" placeholder="<?php esc_attr_e('Scroll hint text', 'haud-by-honryou') ?>" />
<input type="text" v-model="options.hint_text.touch" placeholder="<?php esc_attr_e('Swipe hint text for touch devices', 'haud-by-honryou') ?>" />