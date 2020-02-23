<?php echo 'tessssssssssssssssssssssssssssssssssssssssste'; ?>
<div id="app">
</div>

<?php
drupal_add_js(drupal_get_path('module', 'teste') . '/dist/app.js', array(
  'type' => 'file',
  'scope' => 'footer'
));

drupal_add_js(drupal_get_path('module', 'teste') . '/dist/chunk-vendors.js', array(
  'type' => 'file',
  'scope' => 'footer'
));
?>
