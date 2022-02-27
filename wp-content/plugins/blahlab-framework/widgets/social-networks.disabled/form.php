<input v-model='options.title' type="text" placeholder="Title" >
<blahlab-upload-image v-model="options.bg">Choose Background Image</blahlab-upload-image>


<draggable v-model="options.socials" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="social in options.socials" class="blahlab-accordion-item"  :key="social">

    <blahlab-accordion-title :item="social" v-on:remove="options.socials.splice(options.socials.indexOf(social), 1)">
      {{ social.title ? "social: " + social.title : "social" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>

      <select v-model="social.id">
        <option disabled value="">Select social network</option>
        <option v-for="s in themeData.member_socials" v-bind:value="s.id">{{ s.desc }}</option>
      </select>

      <input type="text" v-model="social.title" placeholder="title" class="short">
      <input type="text" v-model="social.sub_title" placeholder="sub title" class="short">
      <input type="text" v-model="social.url" placeholder="url" class="short">
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.socials.push(clone(defaults.socials[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Social</blahlab-button>
</p>
