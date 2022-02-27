<?php 
  
  // https://developer.wordpress.org/themes/customize-api/the-customizer-javascript-api/#focusing-ui-objects
  // deep-linking /wp-admin/customize.php?autofocus[section]=theme_options
  // specify the defautls for theme options control
  return array(
    'address' => '',
    'phone' => '',
    'emails' => array(
      array('address' => '')
    ),
    'portfolio_page' => '',
    'copyright_message' => '',
    'socials' => array(
      array( 'id' => '', 'url' => '' ),
      array( 'id' => '', 'url' => '' ),
      array( 'id' => '', 'url' => '' )
    ),
    'portfolio_item_cta' => array(
      'title' => '',
      'button' => array(
        'text' => '',
        'url' => ''
      )
    )
  );

?>