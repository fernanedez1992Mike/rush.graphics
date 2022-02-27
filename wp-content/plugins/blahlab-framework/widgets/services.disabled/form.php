<input v-model='options.title' type="text" placeholder="Title" >


<draggable v-model="options.services" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="service in options.services" class="blahlab-accordion-item"  :key="service">

    <blahlab-accordion-title :item="service" v-on:remove="options.services.splice(options.services.indexOf(service), 1)">
      {{ service.title ? "service: " + service.title : "service" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <ul class="fa-icons">
        <li v-for="icon in themeData.fa_icons" class="fa" v-bind:class="[ { active: icon == service.icon }, 'fa-'+icon ]" v-on:click="service.icon = icon"></li>
      </ul>
      <input type="text" v-model="service.title" placeholder="Title" />
      <textarea v-model="service.desc" placeholder="Descriptions"></textarea>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.services.push(clone(defaults.services[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Service</blahlab-button>
</p>
