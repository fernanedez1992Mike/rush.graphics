<input v-model='options.title' type="text" placeholder="Title" >
<blahlab-upload-image v-model="options.bg">Choose Background Image</blahlab-upload-image>

<draggable v-model="options.skills" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="skill in options.skills" class="blahlab-accordion-item"  :key="skill">

    <blahlab-accordion-title :item="skill" v-on:remove="options.skills.splice(options.skills.indexOf(skill), 1)">
      {{ skill.title ? "skill: " + skill.title : "skill" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model='skill.title' placeholder="Title" >
      <input type="text" v-model="skill.percent" placeholder="Percents number">
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.skills.push(clone(defaults.skills[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Skill</blahlab-button>
</p>