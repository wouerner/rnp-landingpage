<?php
/**
 * @file
 * features_store.locales.inc
 */

/**
 * Implements hook_domain_locale_default_locales().
 */
function features_store_domain_locale_default_locales() {
  $locales = array();
  $locales['wipe-domain-locale-tables'] = 'wipe-domain-locale-tables';
  $locales['aaa_aaa_com'] = array(
    'ar' => 0,
    'en' => 0,
    'es' => 0,
  );
  $locales['store1_tgtmkt76_com'] = array(
    'ar' => 0,
    'de' => 0,
    'en' => 0,
    'es' => 0,
  );
  $locales['store_abc_com'] = array(
    'en' => 0,
    'es' => 0,
  );
  $locales['store_jamcracker_com'] = array(
    'en' => 0,
  );
  $locales['store_jstpl_com'] = array(
    'en' => 0,
    'es' => 0,
  );

  return $locales;
}
