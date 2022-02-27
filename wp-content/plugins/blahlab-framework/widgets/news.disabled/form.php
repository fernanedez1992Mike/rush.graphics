<input v-model='options.title' type="text" placeholder="Title" >
<blahlab-upload-image v-model="options.bg">Choose Background Image</blahlab-upload-image>
<textarea v-model="options.desc" placeholder="Descriptions"></textarea>

<select size="1" v-model="options.posts" multiple="multiple" class="long" style="min-height: 200px;">
  <option v-for="p in themeData.posts" v-bind:value="p.ID">{{ p.post_title }}</option>
</select>
