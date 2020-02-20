<?php
/**
 * @file
 * features_store.layouts.inc
 */

/**
 * Implements hook_default_panels_layout().
 */
function features_store_default_panels_layout() {
  $export = array();

  $layout = new stdClass();
  $layout->disabled = FALSE; /* Edit this to true to make a default layout disabled initially */
  $layout->api_version = 1;
  $layout->name = 'default_front_page_layout';
  $layout->admin_title = 'Default Front Page Layout';
  $layout->admin_description = 'Default Panel Layout for Front Page';
  $layout->category = '';
  $layout->plugin = 'flexible';
  $layout->settings = array(
    'items' => array(
      'canvas' => array(
        'type' => 'row',
        'contains' => 'column',
        'children' => array(
          0 => 'main',
        ),
        'parent' => NULL,
      ),
      'main' => array(
        'type' => 'column',
        'width' => 100,
        'width_type' => '%',
        'children' => array(
          0 => 1,
          1 => 'main-row',
          2 => 2,
          3 => 3,
        ),
        'parent' => 'canvas',
      ),
      'main-row' => array(
        'type' => 'row',
        'contains' => 'region',
        'children' => array(
          0 => 'center',
        ),
        'parent' => 'main',
      ),
      'center' => array(
        'type' => 'region',
        'title' => 'Promotions',
        'width' => 100,
        'width_type' => '%',
        'parent' => 'main-row',
        'class' => 'promoBlock',
      ),
      1 => array(
        'type' => 'row',
        'contains' => 'region',
        'children' => array(
          0 => 'aaa',
          1 => 'search_region',
        ),
        'parent' => 'main',
        'class' => 'searchBar',
      ),
      'search_region' => array(
        'type' => 'region',
        'title' => 'Social Column',
        'width' => '50',
        'width_type' => '%',
        'parent' => '1',
        'class' => 'socialColumn',
      ),
      'aaa' => array(
        'type' => 'region',
        'title' => 'Search Column',
        'width' => '50',
        'width_type' => '%',
        'parent' => '1',
        'class' => 'searchColumn',
      ),
      2 => array(
        'type' => 'row',
        'contains' => 'region',
        'children' => array(
          0 => 'service_view',
        ),
        'parent' => 'main',
        'class' => 'serviceGridView',
      ),
      'service_view' => array(
        'type' => 'region',
        'title' => 'Service View',
        'width' => 100,
        'width_type' => '%',
        'parent' => '2',
        'class' => '',
      ),
      3 => array(
        'type' => 'row',
        'contains' => 'region',
        'children' => array(
          0 => 'bottom',
        ),
        'parent' => 'main',
        'class' => 'bottomRegion',
      ),
      'bottom' => array(
        'type' => 'region',
        'title' => 'Bottom',
        'width' => 100,
        'width_type' => '%',
        'parent' => '3',
        'class' => '',
      ),
    ),
  );
  $export['default_front_page_layout'] = $layout;

  return $export;
}
