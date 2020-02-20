<?php
/**
 * @file
 * features_store.stylizer.inc
 */

/**
 * Implements hook_default_stylizer().
 */
function features_store_default_stylizer() {
  $export = array();

  $style = new stdClass();
  $style->disabled = FALSE; /* Edit this to true to make a default style disabled initially */
  $style->api_version = 1;
  $style->name = 'panelbox';
  $style->admin_title = 'panelbox';
  $style->admin_description = 'Front page panel box';
  $style->settings = array(
    'name' => 'panelbox',
    'style_base' => 'pane_plain_box',
    'font' => array(
      'font' => '',
      'size' => '',
      'letter_spacing' => '',
      'word_spacing' => '',
      'decoration' => '',
      'weight' => '',
      'style' => '',
      'variant' => '',
      'case' => '',
      'alignment' => '',
    ),
    'header_font' => array(
      'font' => 'Arial, Helvetica, sans-serif',
      'size' => 'large',
      'letter_spacing' => '',
      'word_spacing' => '',
      'decoration' => '',
      'weight' => '',
      'style' => '',
      'variant' => '',
      'case' => '',
      'alignment' => '',
    ),
    'border' => array(
      'thickness' => '',
      'style' => '',
    ),
    'header_border' => array(
      'thickness' => '1px',
      'style' => 'solid',
    ),
    'padding' => array(
      'top' => '',
      'right' => '',
      'bottom' => '',
      'left' => '',
    ),
    'palette' => array(
      'background' => '#FFFFFF',
      'text' => '#000000',
      'border' => '#000000',
      'header-background' => '#FFFFFF',
      'header-text' => '#000000',
      'header-border' => '#d3d3d3',
    ),
  );
  $export['panelbox'] = $style;

  return $export;
}
