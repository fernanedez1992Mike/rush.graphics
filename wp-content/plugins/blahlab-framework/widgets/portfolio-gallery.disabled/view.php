<?php

  $items = blahlab_value($this->instance, 'options.items');

  $query = array(
    'posts_per_page' => -1,
    'orderby' => 'menu_order date',
    'post_type' => 'portfolio'
  );

  $query['include'] = $items;

  if (count($items) > 0) {
    $works = get_posts($query);
  } else {
    $works = array();
  }

  wp_reset_postdata();

  $filters = array();
  foreach($works as $work) {
    $terms = get_the_terms($work->ID, 'portfolio_category');
    if($terms) {
      foreach($terms as $term) {
        if(!in_array($term->name, $filters)) {
          $filters[] = $term->name;
        }
      }
    }
  }
  sort($filters);

  $title = blahlab_value($this->instance, 'options.title');
  $tagline = blahlab_value($this->instance, 'options.tagline');
  $type = blahlab_value($this->instance, 'options.type');
  $filter = blahlab_value($this->instance, 'options.show_filter');

  $columns = blahlab_value($this->instance, 'options.columns');

?>





<div class='full'>
  <div class='row'>
    <div class='large-12 columns'>
      <div class='alt mod modSectionHeader'>
        <div class='special-title centered-text'>
          <h2><?php echo esc_html(blahlab_value($title)) ?></h2>
        </div>
      </div>
      <div class='two spacing'></div>
      <div class='mod modGallery'>

        <?php if ($filter): ?>
          <div class='gallery-nav'>
            <ul>
              <li class="current">
                <a href='#' data-cat='all'>All</a>
              </li>
              <?php foreach( $filters as $filter ): ?>
                <li>
                  <?php
                    $cat = strtolower(str_replace(' ', '-', $filter));
                  ?>
                  <a href='#' data-cat="<?php echo blahlab_esc($cat); ?>"><?php echo ucwords($filter) ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif ?>

        <ul class='gallery large-block-grid-3 medium-block-grid-3 seperated small-block-grid-2'>
          <?php foreach ($works as $index => $work): ?>
            <?php
              $category_names = array();
              $terms = get_the_terms($work->ID, 'portfolio_category');
              $category_names = array();
              $category_slugs = array();
              if($terms) {
                foreach($terms as $term) {
                  $category_slugs[] = strtolower(str_replace(' ', '-', $term->name));
                  $category_names[] = strtolower($term->name);
                }
              }
            ?>
            <li class="<?php echo esc_attr(implode(' ', $category_slugs)); ?>">
              <a href="<?php echo esc_url(get_permalink($work)); ?>">
                <?php echo get_the_post_thumbnail($work->ID, 'portfolio') ?>
                <div class='overlay' style='background: rgba(143, 221, 115, 0.8);'>
                  <div class='thumb-info'>
                    <h3><?php echo get_the_title($work->ID) ?></h3>
                    <p><?php echo ucwords(implode(' &amp; ', $category_names)) ?></p>
                  </div>
                </div>
              </a>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
  <div class='four spacing'></div>
  <?php
    $blahlab_portfolio = blahlab_get_option('portfolio_page');
  ?>
<!--   <div class='row'>
    <div class='large-12 columns'>
      <p class='centered-text'>
        <a class='button boxed black' href='<?php echo esc_attr(get_permalink($blahlab_portfolio)); ?>'>View more works</a>
      </p>
    </div>
  </div>
  <div class='four spacing'></div> -->
</div>


