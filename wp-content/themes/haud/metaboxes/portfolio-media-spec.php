<?php


  // 'context' => 'normal',
  // 'priority' => 'high',
  // 'autosave' => TRUE,
  // 'mode' => WPALCHEMY_MODE_ARRAY,
  // 'include_template' => array('page.php', 'template-portfolio.php')

  return array(
    'types' => array('portfolio'),
    'title' => 'Portfolio Media',
    'defaults' => array(
      'media_type' => '',
      'image' => '',
      'video' => '',
      'svg_mask_code' => ''
    )
  );

?>