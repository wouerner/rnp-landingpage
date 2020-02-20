<?php

/**
 * @file
 * template.php
 */
function jsdn_mobile_bootstrap_subtheme_preprocess_page(&$vars, $hook) {
 if (arg(0) == 'user' && arg(1) == 'login') {
  $vars['title'] = t('SignIn');
}
  $alias_parts = explode('/', drupal_get_path_alias());

  if (count($alias_parts) && $alias_parts[0] == 'dashboard') {
    $vars['theme_hook_suggestions'][] = 'page__homebox';
  }

}

function jsdn_mobile_bootstrap_subtheme_preprocess_html(&$vars) {
  $path = drupal_get_path_alias();
  $aliases = explode('/', $path);

  foreach($aliases as $alias) {
    $vars['classes_array'][] = drupal_clean_css_identifier($alias);
  } 
}

function MYTHEME_preprocess_page(&$vars) {

}