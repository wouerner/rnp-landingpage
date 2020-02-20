<?php

/**
 * @file
 * Admin settings for jsdnapi api
 */

function jsdnapi_general_settings_form($form_id, $form_state) {
    
  //jsdnapi settings
  $form['jsdnapi_general_settings'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#title' => t('JSDN api general settings'),
    '#description' => t('JSDN api general settings for consumer key and consumer secret.'),
  );

  $form['jsdnapi_general_settings']['jsdn_consumer_key'] = array(
    '#type' => 'textfield',
    '#default_value' => variable_get('jsdn_consumer_key', ''),
    '#title' => t('JSDN CONSUMER KEY'),
  );
  
  $form['jsdnapi_general_settings']['jsdn_consumer_secret'] = array(
    '#type' => 'password',
    '#default_value' => variable_get('jsdn_consumer_secret', ''),
    '#title' => t('JSDN CONSUMER SECRET'),
  );

  return system_settings_form($form);
}