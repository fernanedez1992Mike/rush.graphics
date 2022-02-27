<!DOCTYPE html>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-187530832-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-187530832-1');
</script>

<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name=dropbox-domain-verification content=0jxpkfvyz8g5 />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MGSHNM4');</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8DLNZ2K03N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8DLNZ2K03N');
</script>

</head>
<?php do_action('blahlab_haud_after_head'); ?>
<body <?php body_class(); ?>>
  <?php
    $blahlab_haud_sidebars_widgets = wp_get_sidebars_widgets();
  ?>

  <div id="logo">
    <a href="<?php echo esc_url(home_url('/')) ?>">
      <h1>
        <?php 
          $blahlab_haud_custom_logo_id = get_theme_mod( 'custom_logo' );
          $blahlab_haud_logo = wp_get_attachment_image_src( $blahlab_haud_custom_logo_id , 'full' ); 
        ?>
        <?php if (blahlab_haud_value($blahlab_haud_logo)): ?>
          <img src="<?php echo esc_url(blahlab_haud_value($blahlab_haud_logo[0])); ?>" alt='<?php echo esc_attr(get_bloginfo('name')) ?>'>
        <?php else: ?>
          <?php echo esc_html(get_bloginfo('name')); ?>
        <?php endif ?>
      </h1>
    </a>
  </div>

  <div id="menu-wrapper">
    <div id="menu-controller">
      <div id="menu-icon">
        <div id="menu-icon-stack">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div id="menu-icon-close">
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <div id="menu-content">
      
      <nav id="main-menu">
        <?php if ( has_nav_menu('main-menu') ) { ?>          
          
            <?php 

              wp_nav_menu(array(
                'theme_location' => 'main-menu',
                'menu_class' => '',
                'fallback_cb' => false,
                'container' => '',
                'depth' => 3,
                'walker' => new Blahlab_Haud_Main_Menu_Nav_Menu_Walker(),
                'items_wrap' => '<ul id="%1$s" class="%2$s vertical menu accordion-menu" data-accordion-menu data-options="submenuToggle: true;">%3$s</ul>'
              ));

            ?>        
        <?php } else { ?>
          <?php esc_html_e('Please set your menu in the admin area', 'haud-by-honryou'); ?>
        <?php } ?>
      </nav>

      
      <?php 
        $blahlab_haud_address = blahlab_haud_get_option('address');
        $blahlab_haud_phone = blahlab_haud_get_option('phone');
        $blahlab_haud_email = blahlab_haud_get_option('email');
        $blahlab_haud_emails = blahlab_haud_get_option('emails', array());
        $blahlab_haud_socials = blahlab_haud_get_option('socials', array());
      ?>

      <div id="contact-info">
        <?php if ( $blahlab_haud_address ): ?>
          <p>
            <?php echo wp_kses(blahlab_value($blahlab_haud_address), array( 'br' => array() )) ?>            
          </p>
        <?php endif ?>
        <?php if ( $blahlab_haud_phone ): ?>
          <p><?php echo esc_html(blahlab_value($blahlab_haud_phone)) ?></p>
        <?php endif ?>
        <?php if ( count($blahlab_haud_emails) > 0 ): ?>
          <p>
            <?php foreach ($blahlab_haud_emails as $index => $email): ?>
              <a href="mailto:<?php echo esc_url(blahlab_value($email, 'address')) ?>"><?php echo esc_html(blahlab_value($email, 'address')) ?></a><br />
            <?php endforeach ?>
          </p>
        <?php endif ?>
      </div>
      <?php if ( count($blahlab_haud_socials) > 0 ): ?>
        <div id="socials">
          <ul>
            <?php foreach ($blahlab_haud_socials as $social) { ?>
              <li><a target="_blank" href="<?php echo esc_url(blahlab_value($social, 'url')) ?>"><i class='fa fa-<?php echo esc_attr(blahlab_value($social, 'id')) ?>'></i></a></li>
            <?php } ?>
          </ul>
        </div>
      <?php endif ?>
    </div>
    <div id="bg-primary" class=""></div>
  </div>

  <div id="white-bar">
  </div>




