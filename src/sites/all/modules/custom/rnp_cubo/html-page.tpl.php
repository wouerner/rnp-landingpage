<div id="cubo"></div>
<?php
drupal_add_js(drupal_get_path('module', 'rnp_cubo') . '/dist/cubo.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_js(drupal_get_path('module', 'rnp_cubo') . '/dist/chunk-vendors.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_js(drupal_get_path('module', 'rnp_cubo') . '/dist/chunk-common.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_css(drupal_get_path('module', '/dist/chunk-vendors.css'),
  array('type' => 'file',
  'scope' => 'footer'
  )
);

drupal_add_css(
  drupal_get_path('module', 'rnp_cubo') . '/dist/cubo.css',
  array('type' => 'file',
  'scope' => 'footer'
  )
);
?>
