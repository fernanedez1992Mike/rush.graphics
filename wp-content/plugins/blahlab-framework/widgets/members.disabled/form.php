<input v-model='options.title' type="text" placeholder="Title" >


<draggable v-model="options.members" @start="onDragStart($event)" @end="onDragEnd($event)" class="blahlab-accordions-sortable blahlab-accordions" v-bind:options="{ handle: '.blahlab-accordion-title' }">
  <li v-for="(member, index) in options.members" class="blahlab-accordion-item"  :key="member">

    <blahlab-accordion-title :item="member" v-on:remove="options.members.splice(options.members.indexOf(member), 1)">
      {{ member.name ? "Member: " + member.name : "Member" }}
    </blahlab-accordion-title>

    <blahlab-accordion-content>
      <input type="text" v-model='member.name' placeholder="Name" >
      <input type="text" v-model="member.position" placeholder="Position">
      <blahlab-upload-image v-model="member.avatar">Choose avatar</blahlab-upload-image>
      <textarea v-model="member.desc" placeholder="Description"></textarea>

      <div class="socials">
        <ul>
          <li v-for="social in member.socials" class="social_item">
            <select v-model="social.id" class="short">
              <option disabled value="">Select social network</option>
              <option v-for="s in themeData.member_socials" v-bind:value="s.id">{{ s.desc }}</option>
            </select>
            <input type="text" v-model="social.url" placeholder="url" class="short">
            <a v-on:click.prevent="member.socials.splice(member.socials.indexOf(social), 1)" class="delete">[X]</a>
          </li>
        </ul>
        <a class="add" v-on:click.prevent="member.socials.push({ id: '', url: '' })">Add social network</a>
      </div>

    </blahlab-accordion-content>

  </li>
</draggable>

<p>
  <blahlab-button v-on:click="options.members.push(clone(defaults.members[0]));addClass('.blahlab-accordion-item:last', 'open')">Add New Member</blahlab-button>
</p>