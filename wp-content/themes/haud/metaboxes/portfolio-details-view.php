<?php
  // *-spec.php is optional if you don't need to specify options for the metabox
  // *-view.php is always required
  // $blahlab_framework_mb->the_field('FILED_SLUG');
  // FIELD_SLUG could be any value
?>
<div>
  <p>
    <label><?php esc_html_e('Client', 'haud-by-honryou') ?></label>
    <input class="full-width" type='text' v-model='options.client'></input>
  </p>

  
  <div>
    <label><?php esc_html_e('Services', 'haud-by-honryou') ?></label>
    <ul>
      <li v-for="service in options.services" class="sub_item">
        <input type="text" v-model="service.name" placeholder="<?php esc_attr_e('service', 'haud-by-honryou') ?>" class="short" ref="service">
        <a v-on:click.prevent="options.services.splice(options.services.indexOf(service), 1)" class="delete">[X]</a>
      </li>
    </ul>
    <a class="add" v-on:click.prevent="options.services.push(clone(defaults.services[0]));focusLast('service')"><?php esc_html_e('Add a service', 'haud-by-honryou') ?></a>
  </div>
  
  <p>
    <label><?php esc_html_e('Link URL', 'haud-by-honryou') ?></label>
    <input class="full-width" type='text' v-model='options.link.url'></input>
  </p>
  <p>
    <label><?php esc_html_e('Link text', 'haud-by-honryou') ?></label>
    <input class="full-width" type='text' v-model='options.link.text'></input>
  </p>
  <div class="spacing"></div>

</div>
