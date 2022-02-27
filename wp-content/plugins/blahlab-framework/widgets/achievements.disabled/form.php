<input v-model="options.title" type="text" placeholder="Title" />
<blahlab-upload-image v-model="options.bg">Choose Background Image</blahlab-upload-image>

<draggable v-model="options.achievements" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="achievement in options.achievements" class="blahlab-accordion-item"  :key="achievement">

    <blahlab-accordion-title :item="achievement" v-on:remove="options.achievements.splice(options.achievements.indexOf(achievement), 1)">
      {{ achievement.title ? "Achievement: " + achievement.title : "Achievement" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <ul class="fa-icons">
        <li v-for="icon in themeData.fa_icons" class="fa" v-bind:class="[ { active: icon == achievement.icon }, 'fa-'+icon ]" v-on:click="achievement.icon = icon"></li>
      </ul>
      <input type="text" v-model="achievement.number" placeholder="Number" />
      <input type="text" v-model="achievement.title" placeholder="Title" />
    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.achievements.push({ title: '', number: '', icon: '' });addClass('.blahlab-accordion-item:last', 'open')">Add New Achievement</blahlab-button>
</p>