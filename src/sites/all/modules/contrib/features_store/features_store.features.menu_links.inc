<?php
/**
 * @file
 * features_store.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function features_store_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: 768e0f1be0831e52b1867a01de7cd5ac_administration:<nolink>
  $menu_links['768e0f1be0831e52b1867a01de7cd5ac_administration:<nolink>'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Administration',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => '768e0f1be0831e52b1867a01de7cd5ac_administration:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -47,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: 768e0f1be0831e52b1867a01de7cd5ac_home:<front>
  $menu_links['768e0f1be0831e52b1867a01de7cd5ac_home:<front>'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Home',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => '768e0f1be0831e52b1867a01de7cd5ac_home:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: 768e0f1be0831e52b1867a01de7cd5ac_office-productivity:<nolink>
  $menu_links['768e0f1be0831e52b1867a01de7cd5ac_office-productivity:<nolink>'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Office Productivity',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => '768e0f1be0831e52b1867a01de7cd5ac_office-productivity:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
    'parent_identifier' => '768e0f1be0831e52b1867a01de7cd5ac_products:<nolink>',
  );
  // Exported menu link: 768e0f1be0831e52b1867a01de7cd5ac_online-backup:<nolink>
  $menu_links['768e0f1be0831e52b1867a01de7cd5ac_online-backup:<nolink>'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Online Backup',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => '768e0f1be0831e52b1867a01de7cd5ac_online-backup:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -48,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
    'parent_identifier' => '768e0f1be0831e52b1867a01de7cd5ac_products:<nolink>',
  );
  // Exported menu link: 768e0f1be0831e52b1867a01de7cd5ac_products:<nolink>
  $menu_links['768e0f1be0831e52b1867a01de7cd5ac_products:<nolink>'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Products',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => '768e0f1be0831e52b1867a01de7cd5ac_products:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: 768e0f1be0831e52b1867a01de7cd5ac_security:<nolink>
  $menu_links['768e0f1be0831e52b1867a01de7cd5ac_security:<nolink>'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Security',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => '768e0f1be0831e52b1867a01de7cd5ac_security:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
    'parent_identifier' => '768e0f1be0831e52b1867a01de7cd5ac_products:<nolink>',
  );
  // Exported menu link: main-menu_backupagent:node/48
  $menu_links['main-menu_backupagent:node/48'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/48',
    'router_path' => 'node/%',
    'link_title' => 'BackupAgent',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_backupagent:node/48',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_backupagent:node/56
  $menu_links['main-menu_backupagent:node/56'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/56',
    'router_path' => 'node/%',
    'link_title' => 'BackupAgent',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_backupagent:node/56',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_backupagent:node/66
  $menu_links['main-menu_backupagent:node/66'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/66',
    'router_path' => 'node/%',
    'link_title' => 'BackupAgent',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_backupagent:node/66',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_catalog:catalog
  $menu_links['main-menu_catalog:catalog'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'catalog',
    'router_path' => 'catalog',
    'link_title' => 'Catalog',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_catalog:catalog',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: main-menu_dashboard:<nolink>
  $menu_links['main-menu_dashboard:<nolink>'] = array(
    'menu_name' => 'main-menu',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Dashboard',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'main-menu_dashboard:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: main-menu_gomeetnow:node/43
  $menu_links['main-menu_gomeetnow:node/43'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/43',
    'router_path' => 'node/%',
    'link_title' => 'GoMeetNow',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_gomeetnow:node/43',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_gomeetnow:node/75
  $menu_links['main-menu_gomeetnow:node/75'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/75',
    'router_path' => 'node/%',
    'link_title' => 'GoMeetNow',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_gomeetnow:node/75',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_gomeetnow:node/80
  $menu_links['main-menu_gomeetnow:node/80'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/80',
    'router_path' => 'node/%',
    'link_title' => 'GoMeetNow',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_gomeetnow:node/80',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_hosted-microsoft-exchange:node/16
  $menu_links['main-menu_hosted-microsoft-exchange:node/16'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/16',
    'router_path' => 'node/%',
    'link_title' => 'Hosted Microsoft Exchange',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_hosted-microsoft-exchange:node/16',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_hosted-microsoft-exchange:node/57
  $menu_links['main-menu_hosted-microsoft-exchange:node/57'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/57',
    'router_path' => 'node/%',
    'link_title' => 'Hosted Microsoft Exchange',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_hosted-microsoft-exchange:node/57',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_kaseya:node/45
  $menu_links['main-menu_kaseya:node/45'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/45',
    'router_path' => 'node/%',
    'link_title' => 'Kaseya',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_kaseya:node/45',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_kaseya:node/71
  $menu_links['main-menu_kaseya:node/71'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/71',
    'router_path' => 'node/%',
    'link_title' => 'Kaseya',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_kaseya:node/71',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_kaseya:node/72
  $menu_links['main-menu_kaseya:node/72'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/72',
    'router_path' => 'node/%',
    'link_title' => 'Kaseya',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_kaseya:node/72',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_mcafee-saas-endpoint-protection:node/13
  $menu_links['main-menu_mcafee-saas-endpoint-protection:node/13'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/13',
    'router_path' => 'node/%',
    'link_title' => 'McAfee SaaS Endpoint Protection',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_mcafee-saas-endpoint-protection:node/13',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'en',
    'menu_links_customized' => 1,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_mcafee-saas-endpoint-protection:node/58
  $menu_links['main-menu_mcafee-saas-endpoint-protection:node/58'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/58',
    'router_path' => 'node/%',
    'link_title' => 'McAfee SaaS Endpoint Protection',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_mcafee-saas-endpoint-protection:node/58',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_mcafee-saas-endpoint-protection:node/59
  $menu_links['main-menu_mcafee-saas-endpoint-protection:node/59'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/59',
    'router_path' => 'node/%',
    'link_title' => 'McAfee SaaS Endpoint Protection',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_mcafee-saas-endpoint-protection:node/59',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-dynamics:node/44
  $menu_links['main-menu_microsoft-dynamics:node/44'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/44',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Dynamics',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-dynamics:node/44',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-dynamics:node/73
  $menu_links['main-menu_microsoft-dynamics:node/73'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/73',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Dynamics',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-dynamics:node/73',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-dynamics:node/74
  $menu_links['main-menu_microsoft-dynamics:node/74'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/74',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Dynamics',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-dynamics:node/74',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-exchange:node/10
  $menu_links['main-menu_microsoft-exchange:node/10'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/10',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Exchange',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-exchange:node/10',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 1,
    'language' => 'en',
    'menu_links_customized' => 1,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-office-365:node/63
  $menu_links['main-menu_microsoft-office-365:node/63'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/63',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Office 365',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-office-365:node/63',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-office-365:node/64
  $menu_links['main-menu_microsoft-office-365:node/64'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/64',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Office 365',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-office-365:node/64',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-office-365:node/9
  $menu_links['main-menu_microsoft-office-365:node/9'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/9',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft Office 365',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-office-365:node/9',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'en',
    'menu_links_customized' => 1,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-sharepoint:node/11
  $menu_links['main-menu_microsoft-sharepoint:node/11'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/11',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft SharePoint',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-sharepoint:node/11',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-sharepoint:node/61
  $menu_links['main-menu_microsoft-sharepoint:node/61'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/61',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft SharePoint',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-sharepoint:node/61',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_microsoft-sharepoint:node/62
  $menu_links['main-menu_microsoft-sharepoint:node/62'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/62',
    'router_path' => 'node/%',
    'link_title' => 'Microsoft SharePoint',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_microsoft-sharepoint:node/62',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_mozy:node/60
  $menu_links['main-menu_mozy:node/60'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/60',
    'router_path' => 'node/%',
    'link_title' => 'Mozy',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_mozy:node/60',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_mozy:node/65
  $menu_links['main-menu_mozy:node/65'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/65',
    'router_path' => 'node/%',
    'link_title' => 'Mozy',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_mozy:node/65',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_mozypro:node/12
  $menu_links['main-menu_mozypro:node/12'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/12',
    'router_path' => 'node/%',
    'link_title' => 'MozyPro',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_mozypro:node/12',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'en',
    'menu_links_customized' => 1,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_officedesktop:node/46
  $menu_links['main-menu_officedesktop:node/46'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/46',
    'router_path' => 'node/%',
    'link_title' => 'OfficeDesktop',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_officedesktop:node/46',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_officedesktop:node/69
  $menu_links['main-menu_officedesktop:node/69'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/69',
    'router_path' => 'node/%',
    'link_title' => 'OfficeDesktop',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_officedesktop:node/69',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_officedesktop:node/70
  $menu_links['main-menu_officedesktop:node/70'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/70',
    'router_path' => 'node/%',
    'link_title' => 'OfficeDesktop',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_officedesktop:node/70',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_samanage:node/47
  $menu_links['main-menu_samanage:node/47'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/47',
    'router_path' => 'node/%',
    'link_title' => 'SAManage',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_samanage:node/47',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_samanage:node/67
  $menu_links['main-menu_samanage:node/67'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/67',
    'router_path' => 'node/%',
    'link_title' => 'SAManage',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_samanage:node/67',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_samanage:node/68
  $menu_links['main-menu_samanage:node/68'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/68',
    'router_path' => 'node/%',
    'link_title' => 'SAManage',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_samanage:node/68',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_skoot:node/42
  $menu_links['main-menu_skoot:node/42'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/42',
    'router_path' => 'node/%',
    'link_title' => 'Skoot',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_skoot:node/42',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'en',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_skoot:node/76
  $menu_links['main-menu_skoot:node/76'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/76',
    'router_path' => 'node/%',
    'link_title' => 'Skoot',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_skoot:node/76',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_skoot:node/77
  $menu_links['main-menu_skoot:node/77'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/77',
    'router_path' => 'node/%',
    'link_title' => 'Skoot',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_skoot:node/77',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_support:<nolink>
  $menu_links['main-menu_support:<nolink>'] = array(
    'menu_name' => 'main-menu',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Support',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'main-menu_support:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: main-menu_xero:node/41
  $menu_links['main-menu_xero:node/41'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/41',
    'router_path' => 'node/%',
    'link_title' => 'Xero',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_xero:node/41',
    ),
    'module' => 'menu',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
    'language' => 'en',
    'menu_links_customized' => 1,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_xero:node/78
  $menu_links['main-menu_xero:node/78'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/78',
    'router_path' => 'node/%',
    'link_title' => 'Xero',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_xero:node/78',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'es',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: main-menu_xero:node/79
  $menu_links['main-menu_xero:node/79'] = array(
    'menu_name' => 'main-menu',
    'link_path' => 'node/79',
    'router_path' => 'node/%',
    'link_title' => 'Xero',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'main-menu_xero:node/79',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'ar',
    'menu_links_customized' => 0,
    'parent_identifier' => 'main-menu_catalog:catalog',
  );
  // Exported menu link: management_aaa-content:admin/domain/content/5
  $menu_links['management_aaa-content:admin/domain/content/5'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content/5',
    'router_path' => 'admin/domain/content/5',
    'link_title' => 'aaa content',
    'options' => array(
      'attributes' => array(
        'title' => 'View content assigned to aaa.aaa.com',
      ),
      'alter' => TRUE,
      'identifier' => 'management_aaa-content:admin/domain/content/5',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_affiliated-content:admin/domain/content',
  );
  // Exported menu link: management_abc-store-content:admin/domain/content/3
  $menu_links['management_abc-store-content:admin/domain/content/3'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content/3',
    'router_path' => 'admin/domain/content/3',
    'link_title' => 'ABC Store content',
    'options' => array(
      'attributes' => array(
        'title' => 'View content assigned to store.abc.com',
      ),
      'alter' => TRUE,
      'identifier' => 'management_abc-store-content:admin/domain/content/3',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 3,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_affiliated-content:admin/domain/content',
  );
  // Exported menu link: management_account-settings:admin/config/people/accounts
  $menu_links['management_account-settings:admin/config/people/accounts'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/people/accounts',
    'router_path' => 'admin/config/people/accounts',
    'link_title' => 'Account settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure default behavior of users, including registration requirements, e-mails, fields, and user pictures.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_account-settings:admin/config/people/accounts',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_people:admin/config/people',
  );
  // Exported menu link: management_actions:admin/config/system/actions
  $menu_links['management_actions:admin/config/system/actions'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/actions',
    'router_path' => 'admin/config/system/actions',
    'link_title' => 'Actions',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage the actions defined for your site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_actions:admin/config/system/actions',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_addthis:admin/config/user-interface/addthis
  $menu_links['management_addthis:admin/config/user-interface/addthis'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/addthis',
    'router_path' => 'admin/config/user-interface/addthis',
    'link_title' => 'AddThis',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure AddThis settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_addthis:admin/config/user-interface/addthis',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_administration-menu:admin/config/administration/admin_menu
  $menu_links['management_administration-menu:admin/config/administration/admin_menu'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/administration/admin_menu',
    'router_path' => 'admin/config/administration/admin_menu',
    'link_title' => 'Administration menu',
    'options' => array(
      'attributes' => array(
        'title' => 'Adjust administration menu settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_administration-menu:admin/config/administration/admin_menu',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin/config/administration',
  );
  // Exported menu link: management_administration:admin
  $menu_links['management_administration:admin'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin',
    'router_path' => 'admin',
    'link_title' => 'Administration',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_administration:admin',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 9,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: management_administration:admin/config/administration
  $menu_links['management_administration:admin/config/administration'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/administration',
    'router_path' => 'admin/config/administration',
    'link_title' => 'Administration',
    'options' => array(
      'attributes' => array(
        'title' => 'Administration tools.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_administration:admin/config/administration',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_affiliated-content:admin/domain/content
  $menu_links['management_affiliated-content:admin/domain/content'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content',
    'router_path' => 'admin/domain/content',
    'link_title' => 'Affiliated content',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer content by domain.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_affiliated-content:admin/domain/content',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_appearance:admin/appearance
  $menu_links['management_appearance:admin/appearance'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/appearance',
    'router_path' => 'admin/appearance',
    'link_title' => 'Appearance',
    'options' => array(
      'attributes' => array(
        'title' => 'Select and configure your themes.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_appearance:admin/appearance',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -6,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_auto-logout:admin/config/people/autologout
  $menu_links['management_auto-logout:admin/config/people/autologout'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/people/autologout',
    'router_path' => 'admin/config/people/autologout',
    'link_title' => 'Auto Logout',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer Auto Logout settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_auto-logout:admin/config/people/autologout',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_people:admin/config/people',
  );
  // Exported menu link: management_available-updates:admin/reports/updates
  $menu_links['management_available-updates:admin/reports/updates'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/updates',
    'router_path' => 'admin/reports/updates',
    'link_title' => 'Available updates',
    'options' => array(
      'attributes' => array(
        'title' => 'Get a status report about available updates for your installed modules and themes.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_available-updates:admin/reports/updates',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_back-to-top:admin/config/user-interface/back_to_top
  $menu_links['management_back-to-top:admin/config/user-interface/back_to_top'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/back_to_top',
    'router_path' => 'admin/config/user-interface/back_to_top',
    'link_title' => 'Back To Top',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer Back To Top settings',
      ),
      'alter' => TRUE,
      'identifier' => 'management_back-to-top:admin/config/user-interface/back_to_top',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_backup-and-migrate:admin/config/system/backup_migrate
  $menu_links['management_backup-and-migrate:admin/config/system/backup_migrate'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/backup_migrate',
    'router_path' => 'admin/config/system/backup_migrate',
    'link_title' => 'Backup and Migrate',
    'options' => array(
      'attributes' => array(
        'title' => 'Backup/restore your database and files or migrate data to or from another Drupal site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_backup-and-migrate:admin/config/system/backup_migrate',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_beautytips:admin/config/user-interface/beautytips
  $menu_links['management_beautytips:admin/config/user-interface/beautytips'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/beautytips',
    'router_path' => 'admin/config/user-interface/beautytips',
    'link_title' => 'BeautyTips',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure settings related to the Beautytips module.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_beautytips:admin/config/user-interface/beautytips',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_blocks:admin/structure/block
  $menu_links['management_blocks:admin/structure/block'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/block',
    'router_path' => 'admin/structure/block',
    'link_title' => 'Blocks',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure what block content appears in your site\'s sidebars and other regions.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_blocks:admin/structure/block',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_ckeditor:admin/config/content/ckeditor
  $menu_links['management_ckeditor:admin/config/content/ckeditor'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/ckeditor',
    'router_path' => 'admin/config/content/ckeditor',
    'link_title' => 'CKEditor',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure the rich text editor.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_ckeditor:admin/config/content/ckeditor',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_clean-urls:admin/config/search/clean-urls
  $menu_links['management_clean-urls:admin/config/search/clean-urls'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/clean-urls',
    'router_path' => 'admin/config/search/clean-urls',
    'link_title' => 'Clean URLs',
    'options' => array(
      'attributes' => array(
        'title' => 'Enable or disable clean URLs for your site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_clean-urls:admin/config/search/clean-urls',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_clientside-validation:admin/config/validation/clientside_validation
  $menu_links['management_clientside-validation:admin/config/validation/clientside_validation'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/validation/clientside_validation',
    'router_path' => 'admin/config/validation/clientside_validation',
    'link_title' => 'Clientside Validation',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer clientside validation.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_clientside-validation:admin/config/validation/clientside_validation',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_validation:admin/config/validation',
  );
  // Exported menu link: management_comments:admin/content/comment
  $menu_links['management_comments:admin/content/comment'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/content/comment',
    'router_path' => 'admin/content/comment',
    'link_title' => 'Comments',
    'options' => array(
      'attributes' => array(
        'title' => 'List and edit site comments and the comment approval queue.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_comments:admin/content/comment',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content:admin/content',
  );
  // Exported menu link: management_configuration:admin/config
  $menu_links['management_configuration:admin/config'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config',
    'router_path' => 'admin/config',
    'link_title' => 'Configuration',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_configuration:admin/config',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_content-assigned-to-all-affiliates:admin/domain/content/all
  $menu_links['management_content-assigned-to-all-affiliates:admin/domain/content/all'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content/all',
    'router_path' => 'admin/domain/content/all',
    'link_title' => 'Content assigned to all affiliates',
    'options' => array(
      'attributes' => array(
        'title' => 'View content assigned to all affiliate sites.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_content-assigned-to-all-affiliates:admin/domain/content/all',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_affiliated-content:admin/domain/content',
  );
  // Exported menu link: management_content-authoring:admin/config/content
  $menu_links['management_content-authoring:admin/config/content'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content',
    'router_path' => 'admin/config/content',
    'link_title' => 'Content authoring',
    'options' => array(
      'attributes' => array(
        'title' => 'Settings related to formatting and authoring content.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_content-authoring:admin/config/content',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_content-types:admin/config/validation/clientside_validation/content-types
  $menu_links['management_content-types:admin/config/validation/clientside_validation/content-types'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/validation/clientside_validation/content-types',
    'router_path' => 'admin/config/validation/clientside_validation/content-types',
    'link_title' => 'Content types',
    'options' => array(
      'attributes' => array(
        'title' => 'Override settings for content types.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_content-types:admin/config/validation/clientside_validation/content-types',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_clientside-validation:admin/config/validation/clientside_validation',
  );
  // Exported menu link: management_content-types:admin/structure/types
  $menu_links['management_content-types:admin/structure/types'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/types',
    'router_path' => 'admin/structure/types',
    'link_title' => 'Content types',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage content types, including default status, front page promotion, comment settings, etc.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_content-types:admin/structure/types',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_content:admin/content
  $menu_links['management_content:admin/content'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/content',
    'router_path' => 'admin/content',
    'link_title' => 'Content',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer content and comments.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_content:admin/content',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_cors:admin/config/services/cors
  $menu_links['management_cors:admin/config/services/cors'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/services/cors',
    'router_path' => 'admin/config/services/cors',
    'link_title' => 'CORS',
    'options' => array(
      'attributes' => array(
        'title' => 'Enable Cross-origin resource sharing',
      ),
      'alter' => TRUE,
      'identifier' => 'management_cors:admin/config/services/cors',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_web-services:admin/config/services',
  );
  // Exported menu link: management_cron:admin/config/system/cron
  $menu_links['management_cron:admin/config/system/cron'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/cron',
    'router_path' => 'admin/config/system/cron',
    'link_title' => 'Cron',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage automatic site maintenance tasks.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_cron:admin/config/system/cron',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_custom-forms:admin/config/validation/clientside_validation/custom-forms
  $menu_links['management_custom-forms:admin/config/validation/clientside_validation/custom-forms'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/validation/clientside_validation/custom-forms',
    'router_path' => 'admin/config/validation/clientside_validation/custom-forms',
    'link_title' => 'Custom forms',
    'options' => array(
      'attributes' => array(
        'title' => 'Override settings for custom forms.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_custom-forms:admin/config/validation/clientside_validation/custom-forms',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 12,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_clientside-validation:admin/config/validation/clientside_validation',
  );
  // Exported menu link: management_custom-tokens:admin/structure/token-custom
  $menu_links['management_custom-tokens:admin/structure/token-custom'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/token-custom',
    'router_path' => 'admin/structure/token-custom',
    'link_title' => 'Custom tokens',
    'options' => array(
      'attributes' => array(
        'title' => 'Administrate custom tokens.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_custom-tokens:admin/structure/token-custom',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_dashboard:admin/dashboard
  $menu_links['management_dashboard:admin/dashboard'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/dashboard',
    'router_path' => 'admin/dashboard',
    'link_title' => 'Dashboard',
    'options' => array(
      'attributes' => array(
        'title' => 'View and customize your dashboard.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_dashboard:admin/dashboard',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_date-and-time:admin/config/regional/date-time
  $menu_links['management_date-and-time:admin/config/regional/date-time'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/date-time',
    'router_path' => 'admin/config/regional/date-time',
    'link_title' => 'Date and time',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure display formats for date and time.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_date-and-time:admin/config/regional/date-time',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_default-settings:admin/config/validation/clientside_validation/default
  $menu_links['management_default-settings:admin/config/validation/clientside_validation/default'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/validation/clientside_validation/default',
    'router_path' => 'admin/config/validation/clientside_validation/default',
    'link_title' => 'Default settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Edit default settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_default-settings:admin/config/validation/clientside_validation/default',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_clientside-validation:admin/config/validation/clientside_validation',
  );
  // Exported menu link: management_delete-all-content:admin/content/delete_content
  $menu_links['management_delete-all-content:admin/content/delete_content'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/content/delete_content',
    'router_path' => 'admin/content/delete_content',
    'link_title' => 'Delete all content',
    'options' => array(
      'attributes' => array(
        'title' => 'Delete all nodes and comments on this site. This is useful for development sites, or prior to launching the site. Otherwise it destroys all data on a site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_delete-all-content:admin/content/delete_content',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content:admin/content',
  );
  // Exported menu link: management_delete-all-users:admin/content/delete_users
  $menu_links['management_delete-all-users:admin/content/delete_users'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/content/delete_users',
    'router_path' => 'admin/content/delete_users',
    'link_title' => 'Delete all users',
    'options' => array(
      'attributes' => array(
        'title' => 'Delete all users on this site. This is useful for development sites, or prior to launching the site. Otherwise it destroys all data on a site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_delete-all-users:admin/content/delete_users',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content:admin/content',
  );
  // Exported menu link: management_development:admin/config/development
  $menu_links['management_development:admin/config/development'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/development',
    'router_path' => 'admin/config/development',
    'link_title' => 'Development',
    'options' => array(
      'attributes' => array(
        'title' => 'Development tools.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_development:admin/config/development',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_display-suite:admin/structure/ds
  $menu_links['management_display-suite:admin/structure/ds'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/ds',
    'router_path' => 'admin/structure/ds',
    'link_title' => 'Display Suite',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage layouts for entities and configure fields, view modes etc.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_display-suite:admin/structure/ds',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_domains:admin/structure/domain
  $menu_links['management_domains:admin/structure/domain'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/domain',
    'router_path' => 'admin/structure/domain',
    'link_title' => 'Domains',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage and configure domains.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_domains:admin/structure/domain',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_entity-translation:admin/config/regional/entity_translation
  $menu_links['management_entity-translation:admin/config/regional/entity_translation'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/entity_translation',
    'router_path' => 'admin/config/regional/entity_translation',
    'link_title' => 'Entity translation',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure which entities can be translated and enable or disable language fallback.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_entity-translation:admin/config/regional/entity_translation',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_features:admin/structure/features
  $menu_links['management_features:admin/structure/features'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/features',
    'router_path' => 'admin/structure/features',
    'link_title' => 'Features',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage features.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_features:admin/structure/features',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_field-dependencies:admin/structure/dependencies
  $menu_links['management_field-dependencies:admin/structure/dependencies'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/dependencies',
    'router_path' => 'admin/structure/dependencies',
    'link_title' => 'Field dependencies',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer field dependencies for the site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_field-dependencies:admin/structure/dependencies',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_field-list:admin/reports/fields
  $menu_links['management_field-list:admin/reports/fields'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/fields',
    'router_path' => 'admin/reports/fields',
    'link_title' => 'Field list',
    'options' => array(
      'attributes' => array(
        'title' => 'Overview of fields on all entity types.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_field-list:admin/reports/fields',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_fields:admin/config/fields
  $menu_links['management_fields:admin/config/fields'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/fields',
    'router_path' => 'admin/config/fields',
    'link_title' => 'Fields',
    'options' => array(
      'attributes' => array(
        'title' => 'Field type settings and utilities',
      ),
      'alter' => TRUE,
      'identifier' => 'management_fields:admin/config/fields',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_file-system:admin/config/media/file-system
  $menu_links['management_file-system:admin/config/media/file-system'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/file-system',
    'router_path' => 'admin/config/media/file-system',
    'link_title' => 'File system',
    'options' => array(
      'attributes' => array(
        'title' => 'Tell Drupal where to store uploaded files and how they are accessed.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_file-system:admin/config/media/file-system',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_file-types:admin/config/media/file-types
  $menu_links['management_file-types:admin/config/media/file-types'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/file-types',
    'router_path' => 'admin/config/media/file-types',
    'link_title' => 'File types',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage files used on your site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_file-types:admin/config/media/file-types',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_fivestar:admin/config/content/fivestar
  $menu_links['management_fivestar:admin/config/content/fivestar'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/fivestar',
    'router_path' => 'admin/config/content/fivestar',
    'link_title' => 'Fivestar',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure site-wide widgets used for Fivestar rating.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_fivestar:admin/config/content/fivestar',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_flags:admin/structure/flags
  $menu_links['management_flags:admin/structure/flags'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/flags',
    'router_path' => 'admin/structure/flags',
    'link_title' => 'Flags',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure flags for marking content with arbitrary information (such as <em>offensive</em> or <em>bookmarked</em>).',
      ),
      'alter' => TRUE,
      'identifier' => 'management_flags:admin/structure/flags',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_floating-block:admin/config/user-interface/floating-block
  $menu_links['management_floating-block:admin/config/user-interface/floating-block'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/floating-block',
    'router_path' => 'admin/config/user-interface/floating-block',
    'link_title' => 'Floating block',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure floating block.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_floating-block:admin/config/user-interface/floating-block',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_footer-menu:admin/structure/menu/manage/menu-footer-menu
  $menu_links['management_footer-menu:admin/structure/menu/manage/menu-footer-menu'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/menu-footer-menu',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Footer Menu',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_footer-menu:admin/structure/menu/manage/menu-footer-menu',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_forums:admin/structure/forum
  $menu_links['management_forums:admin/structure/forum'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/forum',
    'router_path' => 'admin/structure/forum',
    'link_title' => 'Forums',
    'options' => array(
      'attributes' => array(
        'title' => 'Control forum hierarchy settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_forums:admin/structure/forum',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_general-settings:admin/config/validation/clientside_validation/general
  $menu_links['management_general-settings:admin/config/validation/clientside_validation/general'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/validation/clientside_validation/general',
    'router_path' => 'admin/config/validation/clientside_validation/general',
    'link_title' => 'General settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Edit general settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_general-settings:admin/config/validation/clientside_validation/general',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -1,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_clientside-validation:admin/config/validation/clientside_validation',
  );
  // Exported menu link: management_help:admin/help
  $menu_links['management_help:admin/help'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/help',
    'router_path' => 'admin/help',
    'link_title' => 'Help',
    'options' => array(
      'attributes' => array(
        'title' => 'Reference for usage, configuration, and modules.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_help:admin/help',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 9,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_hidden-fields:admin/config/fields/field_hidden
  $menu_links['management_hidden-fields:admin/config/fields/field_hidden'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/fields/field_hidden',
    'router_path' => 'admin/config/fields/field_hidden',
    'link_title' => 'Hidden Fields',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure Fields Hidden',
      ),
      'alter' => TRUE,
      'identifier' => 'management_hidden-fields:admin/config/fields/field_hidden',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_fields:admin/config/fields',
  );
  // Exported menu link: management_image-styles:admin/config/media/image-styles
  $menu_links['management_image-styles:admin/config/media/image-styles'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/image-styles',
    'router_path' => 'admin/config/media/image-styles',
    'link_title' => 'Image styles',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure styles that can be used for resizing or adjusting images on display.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_image-styles:admin/config/media/image-styles',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_image-toolkit:admin/config/media/image-toolkit
  $menu_links['management_image-toolkit:admin/config/media/image-toolkit'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/image-toolkit',
    'router_path' => 'admin/config/media/image-toolkit',
    'link_title' => 'Image toolkit',
    'options' => array(
      'attributes' => array(
        'title' => 'Choose which image toolkit to use if you have installed optional toolkits.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_image-toolkit:admin/config/media/image-toolkit',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_import-settings:admin/config/user-interface/owlcarousel/import
  $menu_links['management_import-settings:admin/config/user-interface/owlcarousel/import'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/owlcarousel/import',
    'router_path' => 'admin/config/user-interface/owlcarousel/import',
    'link_title' => 'Import Settings',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_import-settings:admin/config/user-interface/owlcarousel/import',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_owl-carousel:admin/config/user-interface/owlcarousel',
  );
  // Exported menu link: management_ip-address-blocking:admin/config/people/ip-blocking
  $menu_links['management_ip-address-blocking:admin/config/people/ip-blocking'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/people/ip-blocking',
    'router_path' => 'admin/config/people/ip-blocking',
    'link_title' => 'IP address blocking',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage blocked IP addresses.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_ip-address-blocking:admin/config/people/ip-blocking',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_people:admin/config/people',
  );
  // Exported menu link: management_jquery-update:admin/config/development/jquery_update
  $menu_links['management_jquery-update:admin/config/development/jquery_update'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/development/jquery_update',
    'router_path' => 'admin/config/development/jquery_update',
    'link_title' => 'jQuery update',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure settings related to the jQuery upgrade, the library path and compression.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_jquery-update:admin/config/development/jquery_update',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_development:admin/config/development',
  );
  // Exported menu link: management_jsdn-api-settings:admin/config/jsdn/jsdn_configuration
  $menu_links['management_jsdn-api-settings:admin/config/jsdn/jsdn_configuration'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/jsdn/jsdn_configuration',
    'router_path' => 'admin/config/jsdn/jsdn_configuration',
    'link_title' => 'JSDN API settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer JSDN api.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_jsdn-api-settings:admin/config/jsdn/jsdn_configuration',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -1,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_jsdn:admin/config/jsdn',
  );
  // Exported menu link: management_jsdn-source-store-content:admin/domain/content/1
  $menu_links['management_jsdn-source-store-content:admin/domain/content/1'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content/1',
    'router_path' => 'admin/domain/content/1',
    'link_title' => 'JSDN Source Store content',
    'options' => array(
      'attributes' => array(
        'title' => 'View content assigned to store.sourcestore.com',
      ),
      'alter' => TRUE,
      'identifier' => 'management_jsdn-source-store-content:admin/domain/content/1',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 1,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_affiliated-content:admin/domain/content',
  );
  // Exported menu link: management_jsdn:admin/config/jsdn
  $menu_links['management_jsdn:admin/config/jsdn'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/jsdn',
    'router_path' => 'admin/config/jsdn',
    'link_title' => 'JSDN',
    'options' => array(
      'attributes' => array(
        'title' => 'JSDN settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_jsdn:admin/config/jsdn',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -11,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_jstpl-store-content:admin/domain/content/2
  $menu_links['management_jstpl-store-content:admin/domain/content/2'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content/2',
    'router_path' => 'admin/domain/content/2',
    'link_title' => 'JSTPL Store content',
    'options' => array(
      'attributes' => array(
        'title' => 'View content assigned to store.jstpl.com',
      ),
      'alter' => TRUE,
      'identifier' => 'management_jstpl-store-content:admin/domain/content/2',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 2,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_affiliated-content:admin/domain/content',
  );
  // Exported menu link: management_language-fallback:admin/config/regional/language_fallback
  $menu_links['management_language-fallback:admin/config/regional/language_fallback'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/language_fallback',
    'router_path' => 'admin/config/regional/language_fallback',
    'link_title' => 'Language fallback',
    'options' => array(
      'attributes' => array(
        'title' => 'Configuration for Language fallback module',
      ),
      'alter' => TRUE,
      'identifier' => 'management_language-fallback:admin/config/regional/language_fallback',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_languages:admin/config/regional/language
  $menu_links['management_languages:admin/config/regional/language'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/language',
    'router_path' => 'admin/config/regional/language',
    'link_title' => 'Languages',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure languages for content and the user interface.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_languages:admin/config/regional/language',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_logging-and-errors:admin/config/development/logging
  $menu_links['management_logging-and-errors:admin/config/development/logging'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/development/logging',
    'router_path' => 'admin/config/development/logging',
    'link_title' => 'Logging and errors',
    'options' => array(
      'attributes' => array(
        'title' => 'Settings for logging and alerts modules. Various modules can route Drupal\'s system events to different destinations, such as syslog, database, email, etc.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_logging-and-errors:admin/config/development/logging',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_development:admin/config/development',
  );
  // Exported menu link: management_main-menu:admin/structure/menu/manage/main-menu
  $menu_links['management_main-menu:admin/structure/menu/manage/main-menu'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/main-menu',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Main menu',
    'options' => array(
      'identifier' => 'management_main-menu:admin/structure/menu/manage/main-menu',
      'alter' => TRUE,
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_maintenance-mode:admin/config/development/maintenance
  $menu_links['management_maintenance-mode:admin/config/development/maintenance'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/development/maintenance',
    'router_path' => 'admin/config/development/maintenance',
    'link_title' => 'Maintenance mode',
    'options' => array(
      'attributes' => array(
        'title' => 'Take the site offline for maintenance or bring it back online.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_maintenance-mode:admin/config/development/maintenance',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_development:admin/config/development',
  );
  // Exported menu link: management_management:admin/structure/menu/manage/management
  $menu_links['management_management:admin/structure/menu/manage/management'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/management',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Management',
    'options' => array(
      'identifier' => 'management_management:admin/structure/menu/manage/management',
      'alter' => TRUE,
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_media-browser-settings:admin/config/media/browser
  $menu_links['management_media-browser-settings:admin/config/media/browser'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/browser',
    'router_path' => 'admin/config/media/browser',
    'link_title' => 'Media browser settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure the behavior and display of the media browser.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_media-browser-settings:admin/config/media/browser',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_media:admin/config/media
  $menu_links['management_media:admin/config/media'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media',
    'router_path' => 'admin/config/media',
    'link_title' => 'Media',
    'options' => array(
      'attributes' => array(
        'title' => 'Media tools.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_media:admin/config/media',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_media:admin/content/media
  $menu_links['management_media:admin/content/media'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/content/media',
    'router_path' => 'admin/content/media',
    'link_title' => 'Media',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage files used on your site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_media:admin/content/media',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content:admin/content',
  );
  // Exported menu link: management_menu-block:admin/config/user-interface/menu-block
  $menu_links['management_menu-block:admin/config/user-interface/menu-block'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/menu-block',
    'router_path' => 'admin/config/user-interface/menu-block',
    'link_title' => 'Menu block',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure menu block.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_menu-block:admin/config/user-interface/menu-block',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_menu-breadcrumb:admin/config/user-interface/menu-breadcrumb
  $menu_links['management_menu-breadcrumb:admin/config/user-interface/menu-breadcrumb'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/menu-breadcrumb',
    'router_path' => 'admin/config/user-interface/menu-breadcrumb',
    'link_title' => 'Menu Breadcrumb',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure menu breadcrumb.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_menu-breadcrumb:admin/config/user-interface/menu-breadcrumb',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_menus:admin/structure/menu
  $menu_links['management_menus:admin/structure/menu'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu',
    'router_path' => 'admin/structure/menu',
    'link_title' => 'Menus',
    'options' => array(
      'attributes' => array(
        'title' => 'Add new menus to your site, edit existing menus, and rename and reorganize menu links.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_menus:admin/structure/menu',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_mini-panels:admin/structure/mini-panels
  $menu_links['management_mini-panels:admin/structure/mini-panels'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/mini-panels',
    'router_path' => 'admin/structure/mini-panels',
    'link_title' => 'Mini panels',
    'options' => array(
      'attributes' => array(
        'title' => 'Add, edit or delete mini panels, which can be used as blocks or content panes in other panels.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_mini-panels:admin/structure/mini-panels',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_module-filter:admin/config/user-interface/modulefilter
  $menu_links['management_module-filter:admin/config/user-interface/modulefilter'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/modulefilter',
    'router_path' => 'admin/config/user-interface/modulefilter',
    'link_title' => 'Module filter',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure how the modules page looks and acts.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_module-filter:admin/config/user-interface/modulefilter',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_modules:admin/modules
  $menu_links['management_modules:admin/modules'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/modules',
    'router_path' => 'admin/modules',
    'link_title' => 'Modules',
    'options' => array(
      'attributes' => array(
        'title' => 'Extend site functionality.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_modules:admin/modules',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -2,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_multilingual-settings:admin/config/regional/i18n
  $menu_links['management_multilingual-settings:admin/config/regional/i18n'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/i18n',
    'router_path' => 'admin/config/regional/i18n',
    'link_title' => 'Multilingual settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure extended options for multilingual content and translations.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_multilingual-settings:admin/config/regional/i18n',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_navigation:admin/structure/menu/manage/navigation
  $menu_links['management_navigation:admin/structure/menu/manage/navigation'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/navigation',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Navigation',
    'options' => array(
      'identifier' => 'management_navigation:admin/structure/menu/manage/navigation',
      'alter' => TRUE,
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_node-compare-settings:admin/config/content/node_compare
  $menu_links['management_node-compare-settings:admin/config/content/node_compare'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/node_compare',
    'router_path' => 'admin/config/content/node_compare',
    'link_title' => 'Node Compare settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Module settings page.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_node-compare-settings:admin/config/content/node_compare',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_owl-carousel:admin/config/user-interface/owlcarousel
  $menu_links['management_owl-carousel:admin/config/user-interface/owlcarousel'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/owlcarousel',
    'router_path' => 'admin/config/user-interface/owlcarousel',
    'link_title' => 'Owl Carousel',
    'options' => array(
      'attributes' => array(
        'title' => 'Owlcarousel instance settings list.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_owl-carousel:admin/config/user-interface/owlcarousel',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_page-titles:admin/config/search/page-title
  $menu_links['management_page-titles:admin/config/search/page-title'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/page-title',
    'router_path' => 'admin/config/search/page-title',
    'link_title' => 'Page titles',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure the page titles for your site (the title in the &lt;head&gt; tag).',
      ),
      'alter' => TRUE,
      'identifier' => 'management_page-titles:admin/config/search/page-title',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_pages:admin/structure/pages
  $menu_links['management_pages:admin/structure/pages'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/pages',
    'router_path' => 'admin/structure/pages',
    'link_title' => 'Pages',
    'options' => array(
      'attributes' => array(
        'title' => 'Add, edit and remove overridden system pages and user defined pages from the system.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_pages:admin/structure/pages',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_panels:admin/structure/panels
  $menu_links['management_panels:admin/structure/panels'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/panels',
    'router_path' => 'admin/structure/panels',
    'link_title' => 'Panels',
    'options' => array(
      'attributes' => array(
        'title' => 'Get a bird\'s eye view of items related to Panels.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_panels:admin/structure/panels',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_path-breadcrumbs:admin/structure/path-breadcrumbs
  $menu_links['management_path-breadcrumbs:admin/structure/path-breadcrumbs'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/path-breadcrumbs',
    'router_path' => 'admin/structure/path-breadcrumbs',
    'link_title' => 'Path Breadcrumbs',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage breadcrumbs for your site\'s pages.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_path-breadcrumbs:admin/structure/path-breadcrumbs',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_people:admin/config/people
  $menu_links['management_people:admin/config/people'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/people',
    'router_path' => 'admin/config/people',
    'link_title' => 'People',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure user accounts.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_people:admin/config/people',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_people:admin/people
  $menu_links['management_people:admin/people'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/people',
    'router_path' => 'admin/people',
    'link_title' => 'People',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage user accounts, roles, and permissions.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_people:admin/people',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -4,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_performance:admin/config/development/performance
  $menu_links['management_performance:admin/config/development/performance'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/development/performance',
    'router_path' => 'admin/config/development/performance',
    'link_title' => 'Performance',
    'options' => array(
      'attributes' => array(
        'title' => 'Enable or disable page caching for anonymous users and set CSS and JS bandwidth optimization options.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_performance:admin/config/development/performance',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_development:admin/config/development',
  );
  // Exported menu link: management_persistent-url:admin/config/search/purl
  $menu_links['management_persistent-url:admin/config/search/purl'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/purl',
    'router_path' => 'admin/config/search/purl',
    'link_title' => 'Persistent URL',
    'options' => array(
      'attributes' => array(
        'title' => 'Settings for persistent url.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_persistent-url:admin/config/search/purl',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_profile:admin/structure/menu/manage/menu-profile
  $menu_links['management_profile:admin/structure/menu/manage/menu-profile'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/menu-profile',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Profile',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_profile:admin/structure/menu/manage/menu-profile',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_rebuild-type-information-for-media:admin/config/media/rebuild_types
  $menu_links['management_rebuild-type-information-for-media:admin/config/media/rebuild_types'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/rebuild_types',
    'router_path' => 'admin/config/media/rebuild_types',
    'link_title' => 'Rebuild type information for media',
    'options' => array(
      'attributes' => array(
        'title' => 'In case there are files in file_managed w/o a type, this function rebuilds them',
      ),
      'alter' => TRUE,
      'identifier' => 'management_rebuild-type-information-for-media:admin/config/media/rebuild_types',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_recent-hits:admin/reports/hits
  $menu_links['management_recent-hits:admin/reports/hits'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/hits',
    'router_path' => 'admin/reports/hits',
    'link_title' => 'Recent hits',
    'options' => array(
      'attributes' => array(
        'title' => 'View pages that have recently been visited.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_recent-hits:admin/reports/hits',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_recent-log-messages:admin/reports/dblog
  $menu_links['management_recent-log-messages:admin/reports/dblog'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/dblog',
    'router_path' => 'admin/reports/dblog',
    'link_title' => 'Recent log messages',
    'options' => array(
      'attributes' => array(
        'title' => 'View events that have recently been logged.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_recent-log-messages:admin/reports/dblog',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -1,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_regional-and-language:admin/config/regional
  $menu_links['management_regional-and-language:admin/config/regional'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional',
    'router_path' => 'admin/config/regional',
    'link_title' => 'Regional and language',
    'options' => array(
      'attributes' => array(
        'title' => 'Regional settings, localization and translation.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_regional-and-language:admin/config/regional',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_regional-settings:admin/config/regional/settings
  $menu_links['management_regional-settings:admin/config/regional/settings'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/settings',
    'router_path' => 'admin/config/regional/settings',
    'link_title' => 'Regional settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Settings for the site\'s default time zone and country.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_regional-settings:admin/config/regional/settings',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_reports:admin/reports
  $menu_links['management_reports:admin/reports'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports',
    'router_path' => 'admin/reports',
    'link_title' => 'Reports',
    'options' => array(
      'attributes' => array(
        'title' => 'View reports, updates, and errors.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_reports:admin/reports',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_request:admin/structure/tb-megamenu/request
  $menu_links['management_request:admin/structure/tb-megamenu/request'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/tb-megamenu/request',
    'router_path' => 'admin/structure/tb-megamenu/request',
    'link_title' => 'Request',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_request:admin/structure/tb-megamenu/request',
    ),
    'module' => 'system',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_tb-mega-menu:admin/structure/tb-megamenu',
  );
  // Exported menu link: management_rss-publishing:admin/config/services/rss-publishing
  $menu_links['management_rss-publishing:admin/config/services/rss-publishing'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/services/rss-publishing',
    'router_path' => 'admin/config/services/rss-publishing',
    'link_title' => 'RSS publishing',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure the site description, the number of items per feed and whether feeds should be titles/teasers/full-text.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_rss-publishing:admin/config/services/rss-publishing',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_web-services:admin/config/services',
  );
  // Exported menu link: management_rules:admin/config/workflow/rules
  $menu_links['management_rules:admin/config/workflow/rules'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/workflow/rules',
    'router_path' => 'admin/config/workflow/rules',
    'link_title' => 'Rules',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage reaction rules and rule components.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_rules:admin/config/workflow/rules',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_workflow:admin/config/workflow',
  );
  // Exported menu link: management_search-and-metadata:admin/config/search
  $menu_links['management_search-and-metadata:admin/config/search'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search',
    'router_path' => 'admin/config/search',
    'link_title' => 'Search and metadata',
    'options' => array(
      'attributes' => array(
        'title' => 'Local site search, metadata and SEO.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_search-and-metadata:admin/config/search',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_search-api-fivestar:admin/config/search/search_api_fivestar
  $menu_links['management_search-api-fivestar:admin/config/search/search_api_fivestar'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/search_api_fivestar',
    'router_path' => 'admin/config/search/search_api_fivestar',
    'link_title' => 'Search API Fivestar',
    'options' => array(
      'attributes' => array(
        'title' => 'Configuration for the Search API Fivestar module',
      ),
      'alter' => TRUE,
      'identifier' => 'management_search-api-fivestar:admin/config/search/search_api_fivestar',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_search-api:admin/config/search/search_api
  $menu_links['management_search-api:admin/config/search/search_api'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/search_api',
    'router_path' => 'admin/config/search/search_api',
    'link_title' => 'Search API',
    'options' => array(
      'attributes' => array(
        'title' => 'Create and configure search engines.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_search-api:admin/config/search/search_api',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_search-settings:admin/config/search/settings
  $menu_links['management_search-settings:admin/config/search/settings'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/settings',
    'router_path' => 'admin/config/search/settings',
    'link_title' => 'Search settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure relevance settings for search and other indexing options.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_search-settings:admin/config/search/settings',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_shortcuts:admin/config/user-interface/shortcut
  $menu_links['management_shortcuts:admin/config/user-interface/shortcut'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/shortcut',
    'router_path' => 'admin/config/user-interface/shortcut',
    'link_title' => 'Shortcuts',
    'options' => array(
      'attributes' => array(
        'title' => 'Add and modify shortcut sets.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_shortcuts:admin/config/user-interface/shortcut',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_simple-dialog:admin/config/content/simple-dialog
  $menu_links['management_simple-dialog:admin/config/content/simple-dialog'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/simple-dialog',
    'router_path' => 'admin/config/content/simple-dialog',
    'link_title' => 'Simple Dialog',
    'options' => array(
      'attributes' => array(
        'title' => 'Settings for simple dialogs',
      ),
      'alter' => TRUE,
      'identifier' => 'management_simple-dialog:admin/config/content/simple-dialog',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_site-information:admin/config/system/site-information
  $menu_links['management_site-information:admin/config/system/site-information'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/site-information',
    'router_path' => 'admin/config/system/site-information',
    'link_title' => 'Site information',
    'options' => array(
      'attributes' => array(
        'title' => 'Change site name, e-mail address, slogan, default front page, and number of posts per page, error pages.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_site-information:admin/config/system/site-information',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_special-menu-items:admin/config/system/special_menu_items
  $menu_links['management_special-menu-items:admin/config/system/special_menu_items'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/special_menu_items',
    'router_path' => 'admin/config/system/special_menu_items',
    'link_title' => 'Special Menu Items',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure Special Menu Items.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_special-menu-items:admin/config/system/special_menu_items',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_statistics:admin/config/system/statistics
  $menu_links['management_statistics:admin/config/system/statistics'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/statistics',
    'router_path' => 'admin/config/system/statistics',
    'link_title' => 'Statistics',
    'options' => array(
      'attributes' => array(
        'title' => 'Control details about what and how your site logs access statistics.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_statistics:admin/config/system/statistics',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_status-report:admin/reports/status
  $menu_links['management_status-report:admin/reports/status'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/status',
    'router_path' => 'admin/reports/status',
    'link_title' => 'Status report',
    'options' => array(
      'attributes' => array(
        'title' => 'Get a status report about your site\'s operation and any detected problems.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_status-report:admin/reports/status',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -60,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_store1-test-content:admin/domain/content/4
  $menu_links['management_store1-test-content:admin/domain/content/4'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/domain/content/4',
    'router_path' => 'admin/domain/content/4',
    'link_title' => 'Store1 Test content',
    'options' => array(
      'attributes' => array(
        'title' => 'View content assigned to fdcmsstore.tgtmkt76.com',
      ),
      'alter' => TRUE,
      'identifier' => 'management_store1-test-content:admin/domain/content/4',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 4,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_affiliated-content:admin/domain/content',
  );
  // Exported menu link: management_string-overrides:admin/config/regional/stringoverrides
  $menu_links['management_string-overrides:admin/config/regional/stringoverrides'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/stringoverrides',
    'router_path' => 'admin/config/regional/stringoverrides',
    'link_title' => 'String overrides',
    'options' => array(
      'attributes' => array(
        'title' => 'Provides a quick and easy way of replacing text on the site.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_string-overrides:admin/config/regional/stringoverrides',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_structure:admin/structure
  $menu_links['management_structure:admin/structure'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure',
    'router_path' => 'admin/structure',
    'link_title' => 'Structure',
    'options' => array(
      'attributes' => array(
        'title' => 'Administer blocks, content types, menus, etc.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_structure:admin/structure',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -8,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_administration:admin',
  );
  // Exported menu link: management_stylizer:admin/structure/stylizer
  $menu_links['management_stylizer:admin/structure/stylizer'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/stylizer',
    'router_path' => 'admin/structure/stylizer',
    'link_title' => 'Stylizer',
    'options' => array(
      'attributes' => array(
        'title' => 'Add, edit or delete stylizer styles.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_stylizer:admin/structure/stylizer',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_system:admin/config/system
  $menu_links['management_system:admin/config/system'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system',
    'router_path' => 'admin/config/system',
    'link_title' => 'System',
    'options' => array(
      'attributes' => array(
        'title' => 'General system related configuration.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_system:admin/config/system',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -20,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_taxonomy-block:admin/config/taxonomy_block
  $menu_links['management_taxonomy-block:admin/config/taxonomy_block'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/taxonomy_block',
    'router_path' => 'admin/config/taxonomy_block',
    'link_title' => 'Taxonomy Block',
    'options' => array(
      'attributes' => array(
        'title' => 'Displays taxonomy hierarchy',
      ),
      'alter' => TRUE,
      'identifier' => 'management_taxonomy-block:admin/config/taxonomy_block',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_taxonomy:admin/structure/taxonomy
  $menu_links['management_taxonomy:admin/structure/taxonomy'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/taxonomy',
    'router_path' => 'admin/structure/taxonomy',
    'link_title' => 'Taxonomy',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage tagging, categorization, and classification of your content.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_taxonomy:admin/structure/taxonomy',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_tb-mega-menu:admin/structure/tb-megamenu
  $menu_links['management_tb-mega-menu:admin/structure/tb-megamenu'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/tb-megamenu',
    'router_path' => 'admin/structure/tb-megamenu',
    'link_title' => 'TB Mega Menu',
    'options' => array(
      'attributes' => array(
        'title' => 'TB Mega Menu',
      ),
      'alter' => TRUE,
      'identifier' => 'management_tb-mega-menu:admin/structure/tb-megamenu',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_test:admin/structure/menu/manage/menu-test
  $menu_links['management_test:admin/structure/menu/manage/menu-test'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/menu-test',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Test',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_test:admin/structure/menu/manage/menu-test',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_text-formats:admin/config/content/formats
  $menu_links['management_text-formats:admin/config/content/formats'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/formats',
    'router_path' => 'admin/config/content/formats',
    'link_title' => 'Text formats',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure how content input by users is filtered, including allowed HTML tags. Also allows enabling of module-provided filters.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_text-formats:admin/config/content/formats',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_themekey:admin/config/user-interface/themekey
  $menu_links['management_themekey:admin/config/user-interface/themekey'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/themekey',
    'router_path' => 'admin/config/user-interface/themekey',
    'link_title' => 'ThemeKey',
    'options' => array(
      'attributes' => array(
        'title' => 'Set up rules to switch the site\'s appearance (theme) dynamically, depending on Drupal paths or different properties.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_themekey:admin/config/user-interface/themekey',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_tipsy:admin/config/user-interface/tipsy
  $menu_links['management_tipsy:admin/config/user-interface/tipsy'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface/tipsy',
    'router_path' => 'admin/config/user-interface/tipsy',
    'link_title' => 'Tipsy',
    'options' => array(
      'attributes' => array(
        'title' => 'Integrates tipsy tooltips with Drupal',
      ),
      'alter' => TRUE,
      'identifier' => 'management_tipsy:admin/config/user-interface/tipsy',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_user-interface:admin/config/user-interface',
  );
  // Exported menu link: management_title-settings:admin/config/content/title
  $menu_links['management_title-settings:admin/config/content/title'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/title',
    'router_path' => 'admin/config/content/title',
    'link_title' => 'Title settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Settings for the Title module.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_title-settings:admin/config/content/title',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_top-access-denied-errors:admin/reports/access-denied
  $menu_links['management_top-access-denied-errors:admin/reports/access-denied'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/access-denied',
    'router_path' => 'admin/reports/access-denied',
    'link_title' => 'Top \'access denied\' errors',
    'options' => array(
      'attributes' => array(
        'title' => 'View \'access denied\' errors (403s).',
      ),
      'alter' => TRUE,
      'identifier' => 'management_top-access-denied-errors:admin/reports/access-denied',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_top-menu:admin/structure/menu/manage/menu-login
  $menu_links['management_top-menu:admin/structure/menu/manage/menu-login'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/menu-login',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'Top Menu',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'management_top-menu:admin/structure/menu/manage/menu-login',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_top-page-not-found-errors:admin/reports/page-not-found
  $menu_links['management_top-page-not-found-errors:admin/reports/page-not-found'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/page-not-found',
    'router_path' => 'admin/reports/page-not-found',
    'link_title' => 'Top \'page not found\' errors',
    'options' => array(
      'attributes' => array(
        'title' => 'View \'page not found\' errors (404s).',
      ),
      'alter' => TRUE,
      'identifier' => 'management_top-page-not-found-errors:admin/reports/page-not-found',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_top-pages:admin/reports/pages
  $menu_links['management_top-pages:admin/reports/pages'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/pages',
    'router_path' => 'admin/reports/pages',
    'link_title' => 'Top pages',
    'options' => array(
      'attributes' => array(
        'title' => 'View pages that have been hit frequently.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_top-pages:admin/reports/pages',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 1,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_top-referrers:admin/reports/referrers
  $menu_links['management_top-referrers:admin/reports/referrers'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/referrers',
    'router_path' => 'admin/reports/referrers',
    'link_title' => 'Top referrers',
    'options' => array(
      'attributes' => array(
        'title' => 'View top referrers.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_top-referrers:admin/reports/referrers',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_top-search-phrases:admin/reports/search
  $menu_links['management_top-search-phrases:admin/reports/search'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/search',
    'router_path' => 'admin/reports/search',
    'link_title' => 'Top search phrases',
    'options' => array(
      'attributes' => array(
        'title' => 'View most popular search phrases.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_top-search-phrases:admin/reports/search',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_top-visitors:admin/reports/visitors
  $menu_links['management_top-visitors:admin/reports/visitors'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/visitors',
    'router_path' => 'admin/reports/visitors',
    'link_title' => 'Top visitors',
    'options' => array(
      'attributes' => array(
        'title' => 'View visitors that hit many pages.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_top-visitors:admin/reports/visitors',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 2,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_translate-interface:admin/config/regional/translate
  $menu_links['management_translate-interface:admin/config/regional/translate'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/translate',
    'router_path' => 'admin/config/regional/translate',
    'link_title' => 'Translate interface',
    'options' => array(
      'attributes' => array(
        'title' => 'Translate the built in interface and optionally other text.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_translate-interface:admin/config/regional/translate',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_translation-sets:admin/config/regional/i18n_translation
  $menu_links['management_translation-sets:admin/config/regional/i18n_translation'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/regional/i18n_translation',
    'router_path' => 'admin/config/regional/i18n_translation',
    'link_title' => 'Translation sets',
    'options' => array(
      'attributes' => array(
        'title' => 'Translation sets overview.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_translation-sets:admin/config/regional/i18n_translation',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_regional-and-language:admin/config/regional',
  );
  // Exported menu link: management_universally-unique-identifiers:admin/config/system/uuid
  $menu_links['management_universally-unique-identifiers:admin/config/system/uuid'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/system/uuid',
    'router_path' => 'admin/config/system/uuid',
    'link_title' => 'Universally unique identifiers',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure universally unique identifiers.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_universally-unique-identifiers:admin/config/system/uuid',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_system:admin/config/system',
  );
  // Exported menu link: management_url-aliases:admin/config/search/path
  $menu_links['management_url-aliases:admin/config/search/path'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/path',
    'router_path' => 'admin/config/search/path',
    'link_title' => 'URL aliases',
    'options' => array(
      'attributes' => array(
        'title' => 'Change your site\'s URL paths by aliasing them.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_url-aliases:admin/config/search/path',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_user-interface:admin/config/user-interface
  $menu_links['management_user-interface:admin/config/user-interface'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/user-interface',
    'router_path' => 'admin/config/user-interface',
    'link_title' => 'User interface',
    'options' => array(
      'attributes' => array(
        'title' => 'Tools that enhance the user interface.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_user-interface:admin/config/user-interface',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -15,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_user-menu:admin/structure/menu/manage/user-menu
  $menu_links['management_user-menu:admin/structure/menu/manage/user-menu'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/menu/manage/user-menu',
    'router_path' => 'admin/structure/menu/manage/%',
    'link_title' => 'User menu',
    'options' => array(
      'identifier' => 'management_user-menu:admin/structure/menu/manage/user-menu',
      'alter' => TRUE,
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_menus:admin/structure/menu',
  );
  // Exported menu link: management_uuid-features-integration:admin/config/content/uuid_features
  $menu_links['management_uuid-features-integration:admin/config/content/uuid_features'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/uuid_features',
    'router_path' => 'admin/config/content/uuid_features',
    'link_title' => 'UUID Features Integration',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure the settings for UUID Features Integration.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_uuid-features-integration:admin/config/content/uuid_features',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_validation:admin/config/validation
  $menu_links['management_validation:admin/config/validation'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/validation',
    'router_path' => 'admin/config/validation',
    'link_title' => 'Validation',
    'options' => array(
      'attributes' => array(
        'title' => 'Validation settings.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_validation:admin/config/validation',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_video:admin/config/media/video
  $menu_links['management_video:admin/config/media/video'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/media/video',
    'router_path' => 'admin/config/media/video',
    'link_title' => 'Video',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure different aspects of the video module and its plugins',
      ),
      'alter' => TRUE,
      'identifier' => 'management_video:admin/config/media/video',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_media:admin/config/media',
  );
  // Exported menu link: management_views-contextual-range-filters:admin/config/content/contextual-range-filter
  $menu_links['management_views-contextual-range-filters:admin/config/content/contextual-range-filter'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/contextual-range-filter',
    'router_path' => 'admin/config/content/contextual-range-filter',
    'link_title' => 'Views Contextual Range Filters',
    'options' => array(
      'attributes' => array(
        'title' => 'Select which contextual filters need to be converted to contextual <em>range</em> filters.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_views-contextual-range-filters:admin/config/content/contextual-range-filter',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_views-plugins:admin/reports/views-plugins
  $menu_links['management_views-plugins:admin/reports/views-plugins'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/reports/views-plugins',
    'router_path' => 'admin/reports/views-plugins',
    'link_title' => 'Views plugins',
    'options' => array(
      'attributes' => array(
        'title' => 'Overview of plugins used in all views.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_views-plugins:admin/reports/views-plugins',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_reports:admin/reports',
  );
  // Exported menu link: management_views:admin/structure/views
  $menu_links['management_views:admin/structure/views'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/structure/views',
    'router_path' => 'admin/structure/views',
    'link_title' => 'Views',
    'options' => array(
      'attributes' => array(
        'title' => 'Manage customized lists of content.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_views:admin/structure/views',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_structure:admin/structure',
  );
  // Exported menu link: management_voting-api:admin/config/search/votingapi
  $menu_links['management_voting-api:admin/config/search/votingapi'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/search/votingapi',
    'router_path' => 'admin/config/search/votingapi',
    'link_title' => 'Voting API',
    'options' => array(
      'attributes' => array(
        'title' => 'Configure sitewide settings for user-generated ratings and votes.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_voting-api:admin/config/search/votingapi',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_search-and-metadata:admin/config/search',
  );
  // Exported menu link: management_web-services:admin/config/services
  $menu_links['management_web-services:admin/config/services'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/services',
    'router_path' => 'admin/config/services',
    'link_title' => 'Web services',
    'options' => array(
      'attributes' => array(
        'title' => 'Tools related to web services.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_web-services:admin/config/services',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: management_webform-settings:admin/config/content/webform
  $menu_links['management_webform-settings:admin/config/content/webform'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/content/webform',
    'router_path' => 'admin/config/content/webform',
    'link_title' => 'Webform settings',
    'options' => array(
      'attributes' => array(
        'title' => 'Global configuration of webform functionality.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_webform-settings:admin/config/content/webform',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_content-authoring:admin/config/content',
  );
  // Exported menu link: management_workflow:admin/config/workflow
  $menu_links['management_workflow:admin/config/workflow'] = array(
    'menu_name' => 'management',
    'link_path' => 'admin/config/workflow',
    'router_path' => 'admin/config/workflow',
    'link_title' => 'Workflow',
    'options' => array(
      'attributes' => array(
        'title' => 'Content workflow, editorial workflow tools.',
      ),
      'alter' => TRUE,
      'identifier' => 'management_workflow:admin/config/workflow',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 5,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'management_configuration:admin/config',
  );
  // Exported menu link: menu-footer-menu_about-us:node/28
  $menu_links['menu-footer-menu_about-us:node/28'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => 'node/28',
    'router_path' => 'node/%',
    'link_title' => 'About Us',
    'options' => array(
      'alter' => TRUE,
      'attributes' => array(),
      'item_attributes' => array(
        'id' => '',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-footer-menu_about-us:node/28',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-footer-menu_contact-us:node/29
  $menu_links['menu-footer-menu_contact-us:node/29'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => 'node/29',
    'router_path' => 'node/%',
    'link_title' => 'Contact Us',
    'options' => array(
      'alter' => TRUE,
      'attributes' => array(),
      'item_attributes' => array(
        'id' => '',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-footer-menu_contact-us:node/29',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -48,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-footer-menu_feedback:<nolink>
  $menu_links['menu-footer-menu_feedback:<nolink>'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Feedback',
    'options' => array(
      'alter' => TRUE,
      'attributes' => array(),
      'item_attributes' => array(
        'id' => 'jsdnFeedback',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-footer-menu_feedback:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-footer-menu_help:<nolink>
  $menu_links['menu-footer-menu_help:<nolink>'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Help',
    'options' => array(
      'alter' => TRUE,
      'attributes' => array(),
      'item_attributes' => array(
        'id' => 'jsdnHelp',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-footer-menu_help:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -47,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-footer-menu_home:<front>
  $menu_links['menu-footer-menu_home:<front>'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Home',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'menu-footer-menu_home:<front>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-footer-menu_privacy-policy:node/31
  $menu_links['menu-footer-menu_privacy-policy:node/31'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => 'node/31',
    'router_path' => 'node/%',
    'link_title' => 'Privacy Policy',
    'options' => array(
      'alter' => TRUE,
      'attributes' => array(),
      'item_attributes' => array(
        'id' => '',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-footer-menu_privacy-policy:node/31',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -45,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-footer-menu_security-policy:node/30
  $menu_links['menu-footer-menu_security-policy:node/30'] = array(
    'menu_name' => 'menu-footer-menu',
    'link_path' => 'node/30',
    'router_path' => 'node/%',
    'link_title' => 'Security Policy',
    'options' => array(
      'alter' => TRUE,
      'attributes' => array(),
      'item_attributes' => array(
        'id' => '',
        'class' => '',
        'style' => '',
      ),
      'identifier' => 'menu-footer-menu_security-policy:node/30',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -46,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_:node/53
  $menu_links['menu-login_:node/53'] = array(
    'menu_name' => 'menu-login',
    'link_path' => 'node/53',
    'router_path' => 'node/%',
    'link_title' => 'الاعلانات',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'menu-login_:node/53',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -46,
    'customized' => 1,
    'language' => 'ar',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_announcements:node/51
  $menu_links['menu-login_announcements:node/51'] = array(
    'menu_name' => 'menu-login',
    'link_path' => 'node/51',
    'router_path' => 'node/%',
    'link_title' => 'Announcements',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'menu-login_announcements:node/51',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -48,
    'customized' => 1,
    'language' => 'en',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_blog:blog
  $menu_links['menu-login_blog:blog'] = array(
    'menu_name' => 'menu-login',
    'link_path' => 'blog',
    'router_path' => 'blog',
    'link_title' => 'Blog',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'purl' => 'disabled',
      'identifier' => 'menu-login_blog:blog',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_forum:forum
  $menu_links['menu-login_forum:forum'] = array(
    'menu_name' => 'menu-login',
    'link_path' => 'forum',
    'router_path' => 'forum',
    'link_title' => 'Forum',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'purl' => 'disabled',
      'identifier' => 'menu-login_forum:forum',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_login:<nolink>
  $menu_links['menu-login_login:<nolink>'] = array(
    'menu_name' => 'menu-login',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Login',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'menu-login_login:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -44,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_logout:<nolink>
  $menu_links['menu-login_logout:<nolink>'] = array(
    'menu_name' => 'menu-login',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Logout',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'menu-login_logout:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -43,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_noticias:node/52
  $menu_links['menu-login_noticias:node/52'] = array(
    'menu_name' => 'menu-login',
    'link_path' => 'node/52',
    'router_path' => 'node/%',
    'link_title' => 'Noticias',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'menu-login_noticias:node/52',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -47,
    'customized' => 1,
    'language' => 'es',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-login_sign-up:<nolink>
  $menu_links['menu-login_sign-up:<nolink>'] = array(
    'menu_name' => 'menu-login',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => 'Sign Up',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'menu-login_sign-up:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -45,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: menu-profile_nbsp:<nolink>
  $menu_links['menu-profile_nbsp:<nolink>'] = array(
    'menu_name' => 'menu-profile',
    'link_path' => '<nolink>',
    'router_path' => '<nolink>',
    'link_title' => '&nbsp;',
    'options' => array(
      'attributes' => array(),
      'alter' => TRUE,
      'identifier' => 'menu-profile_nbsp:<nolink>',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 1,
    'language' => 'und',
    'menu_links_customized' => 1,
  );
  // Exported menu link: navigation_:jsdnLogin
  $menu_links['navigation_:jsdnLogin'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'jsdnLogin',
    'router_path' => 'jsdnLogin',
    'link_title' => '',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_:jsdnLogin',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_aaa:domain/aaa.aaa.com
  $menu_links['navigation_aaa:domain/aaa.aaa.com'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'domain/aaa.aaa.com',
    'router_path' => 'domain/aaa.aaa.com',
    'link_title' => 'aaa',
    'options' => array(
      'attributes' => array(
        'title' => 'Go to aaa.aaa.com',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_aaa:domain/aaa.aaa.com',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_domain:domain',
  );
  // Exported menu link: navigation_abc-store:domain/store.abc.com
  $menu_links['navigation_abc-store:domain/store.abc.com'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'domain/store.abc.com',
    'router_path' => 'domain/store.abc.com',
    'link_title' => 'ABC Store',
    'options' => array(
      'attributes' => array(
        'title' => 'Go to store.abc.com',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_abc-store:domain/store.abc.com',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_domain:domain',
  );
  // Exported menu link: navigation_add-content:node/add
  $menu_links['navigation_add-content:node/add'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add',
    'router_path' => 'node/add',
    'link_title' => 'Add content',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_add-content:node/add',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_article:node/add/article
  $menu_links['navigation_article:node/add/article'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/article',
    'router_path' => 'node/add/article',
    'link_title' => 'Article',
    'options' => array(
      'attributes' => array(
        'title' => 'Use <em>articles</em> for time-sensitive content like news, press releases or blog posts.',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_article:node/add/article',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: navigation_basic-page:node/add/page
  $menu_links['navigation_basic-page:node/add/page'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/page',
    'router_path' => 'node/add/page',
    'link_title' => 'Basic page',
    'options' => array(
      'attributes' => array(
        'title' => 'Use <em>basic pages</em> for your static content, such as an \'About us\' page.',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_basic-page:node/add/page',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: navigation_blog-entry:node/add/blog
  $menu_links['navigation_blog-entry:node/add/blog'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/blog',
    'router_path' => 'node/add/blog',
    'link_title' => 'Blog entry',
    'options' => array(
      'attributes' => array(
        'title' => 'Use for multi-user blogs. Every user gets a personal blog.',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_blog-entry:node/add/blog',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: navigation_blogs:blog
  $menu_links['navigation_blogs:blog'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'blog',
    'router_path' => 'blog',
    'link_title' => 'Blogs',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_blogs:blog',
    ),
    'module' => 'system',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_comparison-table:compare/type
  $menu_links['navigation_comparison-table:compare/type'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'compare/type',
    'router_path' => 'compare/type',
    'link_title' => 'Comparison table',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_comparison-table:compare/type',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_compose-tips:filter/tips
  $menu_links['navigation_compose-tips:filter/tips'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'filter/tips',
    'router_path' => 'filter/tips',
    'link_title' => 'Compose tips',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_compose-tips:filter/tips',
    ),
    'module' => 'system',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_domain:domain
  $menu_links['navigation_domain:domain'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'domain',
    'router_path' => 'domain',
    'link_title' => 'Domain',
    'options' => array(
      'attributes' => array(
        'title' => 'Go to main site',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_domain:domain',
    ),
    'module' => 'system',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_examples:simple-dialog-example/examples
  $menu_links['navigation_examples:simple-dialog-example/examples'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'simple-dialog-example/examples',
    'router_path' => 'simple-dialog-example/examples',
    'link_title' => 'Examples',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_examples:simple-dialog-example/examples',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_forum-topic:node/add/forum
  $menu_links['navigation_forum-topic:node/add/forum'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/forum',
    'router_path' => 'node/add/forum',
    'link_title' => 'Forum topic',
    'options' => array(
      'attributes' => array(
        'title' => 'A <em>forum topic</em> starts a new discussion thread within a forum.',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_forum-topic:node/add/forum',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: navigation_forums:forum
  $menu_links['navigation_forums:forum'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'forum',
    'router_path' => 'forum',
    'link_title' => 'Forums',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_forums:forum',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 1,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_jsdn-source-store:domain/store.sourcestore.com
  $menu_links['navigation_jsdn-source-store:domain/store.sourcestore.com'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'domain/store.sourcestore.com',
    'router_path' => 'domain/store.sourcestore.com',
    'link_title' => 'JSDN Source Store',
    'options' => array(
      'attributes' => array(
        'title' => 'Go to store.sourcestore.com',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_jsdn-source-store:domain/store.sourcestore.com',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_domain:domain',
  );
  // Exported menu link: navigation_jstpl-store:domain/store.jstpl.com
  $menu_links['navigation_jstpl-store:domain/store.jstpl.com'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'domain/store.jstpl.com',
    'router_path' => 'domain/store.jstpl.com',
    'link_title' => 'JSTPL Store',
    'options' => array(
      'attributes' => array(
        'title' => 'Go to store.jstpl.com',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_jstpl-store:domain/store.jstpl.com',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_domain:domain',
  );
  // Exported menu link: navigation_my-blog:blog/%
  $menu_links['navigation_my-blog:blog/%'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'blog/%',
    'router_path' => 'blog/%',
    'link_title' => 'My blog',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_my-blog:blog/%',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_blogs:blog',
  );
  // Exported menu link: navigation_panel:node/add/panel
  $menu_links['navigation_panel:node/add/panel'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/panel',
    'router_path' => 'node/add/panel',
    'link_title' => 'Panel',
    'options' => array(
      'attributes' => array(
        'title' => 'A panel layout broken up into rows and columns.',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_panel:node/add/panel',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: navigation_product-page:node/add/product-page
  $menu_links['navigation_product-page:node/add/product-page'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/product-page',
    'router_path' => 'node/add/product-page',
    'link_title' => 'Product Page',
    'options' => array(
      'attributes' => array(
        'title' => 'Content type for all Product Page',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_product-page:node/add/product-page',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: navigation_search:search
  $menu_links['navigation_search:search'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'search',
    'router_path' => 'search',
    'link_title' => 'Search',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_search:search',
    ),
    'module' => 'system',
    'hidden' => 1,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_store1-test:domain/fdcmsstore.tgtmkt76.com
  $menu_links['navigation_store1-test:domain/fdcmsstore.tgtmkt76.com'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'domain/fdcmsstore.tgtmkt76.com',
    'router_path' => 'domain/fdcmsstore.tgtmkt76.com',
    'link_title' => 'Store1 Test',
    'options' => array(
      'attributes' => array(
        'title' => 'Go to fdcmsstore.tgtmkt76.com',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_store1-test:domain/fdcmsstore.tgtmkt76.com',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_domain:domain',
  );
  // Exported menu link: navigation_target-page:simple-dialog-example/target-page
  $menu_links['navigation_target-page:simple-dialog-example/target-page'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'simple-dialog-example/target-page',
    'router_path' => 'simple-dialog-example/target-page',
    'link_title' => 'Target Page',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_target-page:simple-dialog-example/target-page',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_translate-strings:locale
  $menu_links['navigation_translate-strings:locale'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'locale',
    'router_path' => 'locale',
    'link_title' => 'Translate strings',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'navigation_translate-strings:locale',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: navigation_webform:node/add/webform
  $menu_links['navigation_webform:node/add/webform'] = array(
    'menu_name' => 'navigation',
    'link_path' => 'node/add/webform',
    'router_path' => 'node/add/webform',
    'link_title' => 'Webform',
    'options' => array(
      'attributes' => array(
        'title' => 'Create a new form or questionnaire accessible to users. Submission results and statistics are recorded and accessible to privileged users.',
      ),
      'alter' => TRUE,
      'identifier' => 'navigation_webform:node/add/webform',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 0,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
    'parent_identifier' => 'navigation_add-content:node/add',
  );
  // Exported menu link: user-menu_log-out:user/logout
  $menu_links['user-menu_log-out:user/logout'] = array(
    'menu_name' => 'user-menu',
    'link_path' => 'user/logout',
    'router_path' => 'user/logout',
    'link_title' => 'Log out',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'user-menu_log-out:user/logout',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => 10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Exported menu link: user-menu_user-account:user
  $menu_links['user-menu_user-account:user'] = array(
    'menu_name' => 'user-menu',
    'link_path' => 'user',
    'router_path' => 'user',
    'link_title' => 'User account',
    'options' => array(
      'alter' => TRUE,
      'identifier' => 'user-menu_user-account:user',
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -10,
    'customized' => 0,
    'language' => 'und',
    'menu_links_customized' => 0,
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('&nbsp;');
  t('ABC Store');
  t('ABC Store content');
  t('About Us');
  t('Account settings');
  t('Actions');
  t('Add content');
  t('AddThis');
  t('Administration');
  t('Administration menu');
  t('Affiliated content');
  t('Announcements');
  t('Appearance');
  t('Article');
  t('Auto Logout');
  t('Available updates');
  t('Back To Top');
  t('Backup and Migrate');
  t('BackupAgent');
  t('Basic page');
  t('BeautyTips');
  t('Blocks');
  t('Blog');
  t('Blog entry');
  t('Blogs');
  t('CKEditor');
  t('CORS');
  t('Catalog');
  t('Clean URLs');
  t('Clientside Validation');
  t('Comments');
  t('Comparison table');
  t('Compose tips');
  t('Configuration');
  t('Contact Us');
  t('Content');
  t('Content assigned to all affiliates');
  t('Content authoring');
  t('Content types');
  t('Cron');
  t('Custom forms');
  t('Custom tokens');
  t('Dashboard');
  t('Date and time');
  t('Default settings');
  t('Delete all content');
  t('Delete all users');
  t('Development');
  t('Display Suite');
  t('Domain');
  t('Domains');
  t('Entity translation');
  t('Examples');
  t('Features');
  t('Feedback');
  t('Field dependencies');
  t('Field list');
  t('Fields');
  t('File system');
  t('File types');
  t('Fivestar');
  t('Flags');
  t('Floating block');
  t('Footer Menu');
  t('Forum');
  t('Forum topic');
  t('Forums');
  t('General settings');
  t('GoMeetNow');
  t('Help');
  t('Hidden Fields');
  t('Home');
  t('Hosted Microsoft Exchange');
  t('IP address blocking');
  t('Image styles');
  t('Image toolkit');
  t('Import Settings');
  t('JSDN');
  t('JSDN API settings');
  t('JSDN Source Store');
  t('JSDN Source Store content');
  t('JSTPL Store');
  t('JSTPL Store content');
  t('Kaseya');
  t('Language fallback');
  t('Languages');
  t('Log out');
  t('Logging and errors');
  t('Login');
  t('Logout');
  t('Main menu');
  t('Maintenance mode');
  t('Management');
  t('McAfee SaaS Endpoint Protection');
  t('Media');
  t('Media browser settings');
  t('Menu Breadcrumb');
  t('Menu block');
  t('Menus');
  t('Microsoft Dynamics');
  t('Microsoft Exchange');
  t('Microsoft Office 365');
  t('Microsoft SharePoint');
  t('Mini panels');
  t('Module filter');
  t('Modules');
  t('Mozy');
  t('MozyPro');
  t('Multilingual settings');
  t('My blog');
  t('Navigation');
  t('Node Compare settings');
  t('Noticias');
  t('Office Productivity');
  t('OfficeDesktop');
  t('Online Backup');
  t('Owl Carousel');
  t('Page titles');
  t('Pages');
  t('Panel');
  t('Panels');
  t('Path Breadcrumbs');
  t('People');
  t('Performance');
  t('Persistent URL');
  t('Privacy Policy');
  t('Product Page');
  t('Products');
  t('Profile');
  t('RSS publishing');
  t('Rebuild type information for media');
  t('Recent hits');
  t('Recent log messages');
  t('Regional and language');
  t('Regional settings');
  t('Reports');
  t('Request');
  t('Rules');
  t('SAManage');
  t('Search');
  t('Search API');
  t('Search API Fivestar');
  t('Search and metadata');
  t('Search settings');
  t('Security');
  t('Security Policy');
  t('Shortcuts');
  t('Sign Up');
  t('Simple Dialog');
  t('Site information');
  t('Skoot');
  t('Special Menu Items');
  t('Statistics');
  t('Status report');
  t('Store1 Test');
  t('Store1 Test content');
  t('String overrides');
  t('Structure');
  t('Stylizer');
  t('Support');
  t('System');
  t('TB Mega Menu');
  t('Target Page');
  t('Taxonomy');
  t('Taxonomy Block');
  t('Test');
  t('Text formats');
  t('ThemeKey');
  t('Tipsy');
  t('Title settings');
  t('Top \'access denied\' errors');
  t('Top \'page not found\' errors');
  t('Top Menu');
  t('Top pages');
  t('Top referrers');
  t('Top search phrases');
  t('Top visitors');
  t('Translate interface');
  t('Translate strings');
  t('Translation sets');
  t('URL aliases');
  t('UUID Features Integration');
  t('Universally unique identifiers');
  t('User account');
  t('User interface');
  t('User menu');
  t('Validation');
  t('Video');
  t('Views');
  t('Views Contextual Range Filters');
  t('Views plugins');
  t('Voting API');
  t('Web services');
  t('Webform');
  t('Webform settings');
  t('Workflow');
  t('Xero');
  t('aaa');
  t('aaa content');
  t('jQuery update');
  t('الاعلانات');


  return $menu_links;
}
