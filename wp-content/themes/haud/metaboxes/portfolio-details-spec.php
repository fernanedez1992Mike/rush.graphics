<?php

  // 'context' => 'normal',
  // 'priority' => 'high',
  // 'autosave' => TRUE,
  // 'mode' => WPALCHEMY_MODE_ARRAY,
  // 'include_template' => array('page.php', 'template-portfolio.php')

  return array(
    'types' => array('portfolio'),
    'title' => 'Portfolio Details',
    'defaults' => array(
      'client' => '',
      'link' => array( 'url' => '', 'text' => '' ),
      'services' => array(
        array( 'name' => '' ),
        array( 'name' => '' ),
        array( 'name' => '' )
      )
    )
  );

?>