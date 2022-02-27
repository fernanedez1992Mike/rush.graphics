<input v-model='options.title' type="text" placeholder="Title" >
<textarea v-model="options.desc" placeholder="Descriptions"></textarea>
<blahlab-upload-image v-model="options.bg">Choose Background Image</blahlab-upload-image>

<draggable v-model="options.clients" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="(client, index) in options.clients" class="blahlab-accordion-item"  :key="client">

    <blahlab-accordion-title :item="client" v-on:remove="options.clients.splice(options.clients.indexOf(client), 1)">
      Client
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <blahlab-upload-image v-model="client.image">Choose Image</blahlab-upload-image>
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.clients.push(clone(defaults.clients[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Client</blahlab-button>
</p>