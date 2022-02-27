<label>
  <span class="customize-control-title"><?php esc_html_e('Address', 'haud-by-honryou') ?></span>
  <textarea rows="2" v-model="options.address"></textarea>
</label>

<label>
  <span class="customize-control-title"><?php esc_html_e('Phone', 'haud-by-honryou') ?></span>
  <input type="text" v-model="options.phone">
</label>

<div class="emails">
  <span class="customize-control-title"><?php esc_html_e('Contact Emails', 'haud-by-honryou') ?></span>
  <ul>
    <li v-for="email in options.emails" class="email_item">
      <input type="text" v-model="email.address" placeholder="<?php esc_attr_e('your@email.com', 'haud-by-honryou') ?>" class="short">
      <a v-on:click.prevent="options.emails.splice(options.emails.indexOf(email), 1)" class="delete">[X]</a>
    </li>
  </ul>
  <a class="add" v-on:click.prevent="options.emails.push(clone(defaults.emails[0]))"><?php esc_html_e('Add an email', 'haud-by-honryou') ?></a>
</div>

<label for="">
  <span class="customize-control-title"><?php esc_html_e('Portfolio Page', 'haud-by-honryou') ?></span>
  <select size="1" v-model="options.portfolio_page" class="short">
    <option v-for="p in themeData.pages" v-bind:value="p.ID">{{ p.post_title }}</option>
  </select>

</label>

<div class="socials">
  <span class="customize-control-title"><?php esc_html_e('Social networks', 'haud-by-honryou') ?></span>
  <ul>
    <li v-for="social in options.socials" class="social_item">
      <select v-model="social.id" class="short">
        <option disabled value=""><?php esc_html_e('Select social network', 'haud-by-honryou') ?></option>
        <option v-for="s in themeData.member_socials" v-bind:value="s.id">{{ s.desc }}</option>
      </select>
      <input type="text" v-model="social.url" placeholder="<?php esc_attr_e('url', 'haud-by-honryou') ?>" class="short">
      <a v-on:click.prevent="options.socials.splice(options.socials.indexOf(social), 1)" class="delete">[X]</a>
    </li>
  </ul>
  <a class="add" v-on:click.prevent="options.socials.push(clone(defaults.socials[0]))"><?php esc_html_e('Add social network', 'haud-by-honryou') ?></a>
</div>

<div>
  <span class="customize-control-title">Portfolio item pages "call to action" section</span>
  <input type="text" v-model="options.portfolio_item_cta.title" placeholder="<?php esc_attr_e('Title', 'haud-by-honryou') ?>" class="short">
  <input type="text" v-model="options.portfolio_item_cta.button.text" placeholder="<?php esc_attr_e('Button Text', 'haud-by-honryou') ?>"></textarea>
  <input type="text" v-model="options.portfolio_item_cta.button.url" placeholder="<?php esc_attr_e('Button URL', 'haud-by-honryou') ?>"></textarea>
</div>