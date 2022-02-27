<input v-model="options.recipient" type="text" placeholder="Contact Form Recipient" />
<input v-model='options.title' type="text" placeholder="Title" />

<draggable v-model="options.infos" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="(info, index) in options.infos" class="blahlab-accordion-item"  :key="info">

    <blahlab-accordion-title :item="info" v-on:remove="options.infos.splice(options.infos.indexOf(info), 1)">
      {{ info.title ? "Info: " + info.title : "Info" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model="info.title" placeholder="Title" />
      <textarea v-model="info.text" placeholder="Text"></textarea>
    </blahlab-accordion-content>

  </li>
</draggable>


<p>
  <blahlab-button v-on:click="options.infos.push(clone(defaults.infos[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Info</blahlab-button>
</p>