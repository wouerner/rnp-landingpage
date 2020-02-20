<?php

/**
 * @file
 * Adds Views3 support.
 */

/**
 * Implements hook_views_plugins().
 */
function views_multiple_themes_views_plugins() {
  return array(
    'display_extender' => array(
      'themes' => array(
        'title' => t('Themes'),
        'help' => t('Switch the views display according to the current theme.'),
        'handler' => 'views_multiple_themes_plugin_display_extender_themes',
      ),
    ),
  );
}
