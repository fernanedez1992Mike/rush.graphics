<input v-model='options.title' type="text" placeholder="Title" >

<input id="<?php echo blahlab_esc($this->get_field_id('show_filter')); ?>" type="checkbox" v-model="options.show_filter" />
<label for="<?php echo blahlab_esc($this->get_field_id('show_filter')); ?>" class="inline-filter">Show Filter</label>

<div class="spacing"></div>

<select size="1" v-model="options.items" multiple="multiple" class="long" class="inline-ui-4">
  <option value="all">All Portfolio items</option>
  <option v-for="p in themeData.portfolio_items" v-bind:value="p.id">{{ p.title }}</option>
</select>
