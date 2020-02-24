<?php echo 'tessssssssssssssssssssssssssssssssssssssssste'; ?>
<div id="app">
</div>

<?php
drupal_add_js(drupal_get_path('module', 'teste') . '/dist/catalogo.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_js(drupal_get_path('module', 'teste') . '/dist/chunk-vendors.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_js(drupal_get_path('module', 'teste') . '/dist/chunk-common.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_css(drupal_get_path('module', '/dist/chunk-vendors.css'),
  array('type' => 'external',
  'scope' => 'footer'
  )
);
?>
