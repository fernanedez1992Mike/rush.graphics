<?php

return;

// only use customized widgets

function blahlab_remove_bundled_widgets($sidebars_widgets) {

  // blahlab_dump($sidebars_widgets);

  foreach ((array)$sidebars_widgets as $key => $value) {
    $new_value = array();

    foreach ((array)$value as $widget) {
      if (preg_match("/^blahlab-widget/", $widget)) {
        array_push($new_value, $widget);
      }
    }

    $sidebars_widgets[$key] = $new_value;
  }


  return $sidebars_widgets;
}

if ( !blahlab_value($blahlab_widget_ready) ) {
  add_filter('sidebars_widgets', 'blahlab_remove_bundled_widgets');
}

?>