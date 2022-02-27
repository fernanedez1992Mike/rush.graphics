<?php get_header(); ?>

<div class="full">
  <div class="row">
    <div class="large-12 columns">
      <h1>
        <?php esc_html_e("404 error:", 'haud-by-honryou') ?>
        <br/>
        <?php esc_html_e("page not found", 'haud-by-honryou') ?>
      </h1>
      <div class="four spacing"></div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <p><?php esc_html_e("Sorry, we don't know what you are looking for.", 'haud-by-honryou') ?></p>
      <div class="spacing"></div>
      <a href="<?php echo esc_url(home_url('/')) ?>" class="button small boxed black">
        <?php esc_html_e("Go back home", 'haud-by-honryou') ?>
      </a>
      <div class="four spacing"></div>
    </div>
  </div>
</div>


<?php get_footer(); ?>