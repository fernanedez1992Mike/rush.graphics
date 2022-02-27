<input v-model='options.title' type="text" placeholder="Title" >
<textarea v-model="options.desc" placeholder="Descriptions"></textarea>

<draggable v-model="options.plans" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="(plan, pindex) in options.plans" class="blahlab-accordion-item"  :key="plan">

    <blahlab-accordion-title :item="plan" v-on:remove="options.plans.splice(options.plans.indexOf(plan), 1)">
      {{ plan.title ? "Plan: " + plan.title : "Plan" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model='plan.name' placeholder="Name" >
      <input type="text" v-model='plan.tagline' placeholder="Tagline" >
      <input type="text" v-model='plan.price' placeholder="Price" >
      <ul>
        <li v-for="(line, index) in plan.lines">
          <input type="text" v-model="line.text" :placeholder="'line '+(index+1)" style="width: 92%;display: inline-block;">
          <a href="#" v-on:click.prevent="plan.lines.splice(plan.lines.indexOf(line), 1)" class="delete" style="font-size: 125%;padding-left: 3px;">X</a>
        </li>
        <li style="display: block;margin-top: -11px;margin-bottom: 18px;">
          <a v-on:click.prevent="plan.lines.push({ text: '' })">Add line</a>
        </li>
      </ul>
      <input type="text" v-model='plan.button.text' placeholder="Button Text" >
      <input type="text" v-model='plan.button.url' placeholder="Button URL" >
      <input :id="'<?php echo blahlab_esc($this->get_field_id('featured')); ?>-'+pindex" type="checkbox" v-model="plan.featured" />
      <label :for="'<?php echo blahlab_esc($this->get_field_id('featured')); ?>-'+pindex" style="display: inline;font-weight: normal;text-transform: none;">Featured</label>
      <div class="spacing"></div>
      <div class="spacing"></div>
    </blahlab-accordion-content>

  </li>
</draggable>


<p>
  <blahlab-button v-on:click="options.plans.push(clone(defaults.plans[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Plan</blahlab-button>
</p>
