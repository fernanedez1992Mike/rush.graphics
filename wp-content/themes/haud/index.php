<?php get_header(); ?>

<?php

  $blahlab_haud_query = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'paged' => get_query_var('paged') ? get_query_var('paged') : get_query_var('page')
  );

  $blahlab_haud_query_object = new WP_Query($blahlab_haud_query);


  while($blahlab_haud_query_object->have_posts()) {

    $blahlab_haud_query_object->the_post();
    global $post;

    $blahlab_haud_thumbnail_url = get_the_post_thumbnail_url($post);

    $blahlab_haud_custom_css = "
      #blogposts-{$post->ID} .post-image-wrap .post-image {
        background-image: url({$blahlab_haud_thumbnail_url});
      }
    ";

    wp_add_inline_style( 'blahlab-haud-inline-style', $blahlab_haud_custom_css);

  }

  wp_reset_postdata();

?>


<div class="full header head-bg grey">
  <div class="case-intro">
    <div class="large-12 columns">
      <div class="four spacing"></div>
      <h2 class="head-title">
        <?php $blahlab_haud_no_sticky = true; ?>
        <?php if(is_day()): ?>
          <?php echo esc_html__('Daily archives:', 'haud-by-honryou'); ?>
          <?php echo get_the_date(); ?>
        <?php elseif(is_month()): ?>
          <?php echo esc_html__('Monthly archives:', 'haud-by-honryou') ?>
          <?php echo get_the_date(_x('F Y', 'monthly archives date format', 'haud-by-honryou')) ?>
        <?php elseif(is_year()): ?>
          <?php echo esc_html__('Yearly archives:', 'haud-by-honryou') ?>
          <?php echo get_the_date(_x('Y', 'yearly archives date format', 'haud-by-honryou')); ?>
        <?php elseif(is_tag()): ?>
          <?php esc_html_e('Tag:', 'haud-by-honryou') ?>
          <?php echo single_tag_title('', false) ?>
        <?php elseif(is_category()): ?>
          <?php esc_html_e('Category:', 'haud-by-honryou') ?>
          <?php echo single_cat_title('', false) ?>
        <?php elseif(is_search()): ?>
          <?php esc_html_e('Search results:', 'haud-by-honryou') ?>
          <?php echo esc_html(blahlab_haud_value($_GET['s'])); ?>
        <?php else: ?>
          <?php $blahlab_haud_no_sticky = false; ?>
          <?php esc_html_e('Blog Archives', 'haud-by-honryou'); ?>
        <?php endif; ?>
      </h2>
    </div>
  </div>
</div>


<?php if ( have_posts() ): ?>
  <div class="full">
    <div class="large-12 columns">
      <div class="posts blogposts">

        <?php if ( $blahlab_haud_no_sticky ): ?>

          <?php while(have_posts()): ?>
            <?php the_post(); ?>
            <?php
              global $post;
              setup_postdata( $post );

              $blahlab_haud_thumbnail_url = get_the_post_thumbnail_url($post);
            ?>

            <div class="large-6 columns">
              <div class="post" id="blogposts-<?php echo esc_attr($post->ID); ?>">
                <div class="post-desc">
                  <p class="info-author">
                    <span>
                      <?php echo esc_html__('Posted by', 'haud-by-honryou') ?> <?php echo get_the_author(); ?>
                    </span>
                  </p>
                  <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h3>
<!--                   <p class="info-others">
                    <span><?php echo get_the_date() ?></span>
                    <?php 
                      $blahlab_haud_post_cats = get_the_category();
                      $blahlab_haud_post_in_any_cat = count($blahlab_haud_post_cats) > 0;
                    ?>
                    <?php if ($blahlab_haud_post_in_any_cat): ?>
                      <span>
                        <?php echo esc_html__('In', 'haud-by-honryou') ?>
                        <?php echo get_the_category_list(', ') ?>
                      </span>
                    <?php endif ?>
                    <span>
                      <?php comments_popup_link(esc_html__('Leave a comment', 'haud-by-honryou'), esc_html__('Comment 1', 'haud-by-honryou'), esc_html__('Comments %', 'haud-by-honryou')); ?>
                    </span>
                  </p> -->
                </div>

                <div class="post-image-wrap">
                  <div class="post-image"></div>
                </div>
              </div>
            </div>


          <?php endwhile; ?>

        <?php else: ?>


          <?php 

            $blahlab_haud_sticky_posts = get_option('sticky_posts');

          ?>

          
          <?php if ( count($blahlab_haud_sticky_posts) > 0 && !is_paged() ): ?>
            

            <?php 

              $blahlab_haud_args = array(
                'posts_per_page' => -1,
                'post__in'  => get_option( 'sticky_posts' ),
                'ignore_sticky_posts' => 1
              );
              $blahlab_haud_query = new WP_Query( $blahlab_haud_args );

            ?>

            <?php while( $blahlab_haud_query->have_posts() ): ?>
              <?php
                $blahlab_haud_query->the_post();
                setup_postdata($post->ID);
              ?>

              <div class="large-12 columns">
                <div class="post featured" id="blogposts-<?php echo esc_attr($post->ID); ?>">
                  <div class="post-desc">
                    <p class="info-author">
                      <span>
                        <?php echo esc_html__('Posted by', 'haud-by-honryou') ?> <?php echo get_the_author(); ?>
                      </span>
                    </p>
                    <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h3>
<!--                     <p class="info-others">
                      <span><?php echo get_the_date() ?></span>
                      <?php 
                        $blahlab_haud_post_cats = get_the_category();
                        $blahlab_haud_post_in_any_cat = count($blahlab_haud_post_cats) > 0;
                      ?>
                      <?php if ($blahlab_haud_post_in_any_cat): ?>
                        <span>
                          <?php echo esc_html__('In', 'haud-by-honryou') ?>
                          <?php echo get_the_category_list(', ') ?>
                        </span>
                      <?php endif ?>
                      <span>
                        <?php comments_popup_link(esc_html__('Leave a comment', 'haud-by-honryou'), esc_html__('Comment 1', 'haud-by-honryou'), esc_html__('Comments %', 'haud-by-honryou')); ?>
                      </span>
                    </p> -->
                  </div>

                  <div class="post-image-wrap">
                    <div class="post-image"></div>
                  </div>
                </div>
              </div>

            <?php endwhile; ?>

          <?php endif ?>
          

          <?php while(have_posts()): ?>

            <?php
              the_post();
            ?>

            <div class="large-6 columns">
              <div class="post" id="blogposts-<?php echo esc_attr($post->ID); ?>">
                <div class="post-desc">
                  <p class="info-author">
                    <span>
                      <?php echo esc_html__('Posted by', 'haud-by-honryou') ?> <?php echo get_the_author(); ?>
                    </span>
                  </p>

                  <h3>
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                      <?php 
                        // https://stackoverflow.com/questions/1532693/weird-php-error-cant-use-function-return-value-in-write-context
                        $blahlab_haud_the_title = trim( get_the_title() );
                      ?>
                      <?php if ( !empty( $blahlab_haud_the_title ) ): ?>
                        <?php echo get_the_title(); ?>
                      <?php else: ?>
                        <?php echo esc_html__('Untitled', 'haud-by-honryou'); ?>                      
                      <?php endif ?>                                      
                    </a>
                  </h3> 

<!--                   <p class="info-others">
                    <span><?php echo get_the_date() ?></span>
                    <?php 
                      $blahlab_haud_post_cats = get_the_category();
                      $blahlab_haud_post_in_any_cat = count($blahlab_haud_post_cats) > 0;
                    ?>
                    <?php if ($blahlab_haud_post_in_any_cat): ?>
                      <span>
                        <?php echo esc_html__('In', 'haud-by-honryou') ?>
                        <?php echo get_the_category_list(', ') ?>
                      </span>
                    <?php endif ?>
                    <span>
                      <?php comments_popup_link(esc_html__('Leave a comment', 'haud-by-honryou'), esc_html__('Comment 1', 'haud-by-honryou'), esc_html__('Comments %', 'haud-by-honryou')); ?>
                    </span>
                  </p> -->
                </div>

                <div class="post-image-wrap">
                  <div class="post-image"></div>
                </div>
              </div>
            </div>

          <?php endwhile; ?>

        <?php endif ?>


      </div>
    </div>
  </div>
<?php else: ?>
  <div class="full">
    <div class="large-8 columns">
      <h2><?php esc_html_e('Nothing found.', 'haud-by-honryou') ?></h2>
      <p><?php esc_html_e("Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.", 'haud-by-honryou') ?></p>
      <p><?php esc_html_e("Go to ", 'haud-by-honryou') ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e("home page", 'haud-by-honryou') ?></a>?</p>
    </div>
    <div class="spacing"></div>

    <div class="large-8 end columns">
      <?php get_search_form(); ?>
    </div>

  </div>
<?php endif ?>


<?php if ( blahlab_haud_show_posts_nav() ): ?>
  <div class="full grey pager-wrapper">
    <div class="large-12 columns">

      <?php
        function add_class_to_previous_posts_link() { return 'class="newer button small boxed black"'; }
        function add_class_to_next_posts_link() { return 'class="older button small boxed black"'; }
        add_filter('previous_posts_link_attributes', 'add_class_to_previous_posts_link');
        add_filter('next_posts_link_attributes', 'add_class_to_next_posts_link');
      ?>
      <div class="pager">
        <?php posts_nav_link(' ', esc_html__('Newer Entries ', 'haud-by-honryou') . '<i class="fa fa-angle-double-right"></i>', '<i class="fa fa-angle-double-left"></i>' . esc_html__(' Older Entries', 'haud-by-honryou')); ?>
      </div>

    </div>
  </div>
<?php endif ?>



<?php get_footer(); ?>