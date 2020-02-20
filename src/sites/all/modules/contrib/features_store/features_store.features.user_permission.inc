<?php
/**
 * @file
 * features_store.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function features_store_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'access administration menu'.
  $permissions['access administration menu'] = array(
    'name' => 'access administration menu',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'admin_menu',
  );

  // Exported permission: 'access administration pages'.
  $permissions['access administration pages'] = array(
    'name' => 'access administration pages',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'system',
  );

  // Exported permission: 'access all views'.
  $permissions['access all views'] = array(
    'name' => 'access all views',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'views',
  );

  // Exported permission: 'access all webform results'.
  $permissions['access all webform results'] = array(
    'name' => 'access all webform results',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'access back_to_top settings'.
  $permissions['access back_to_top settings'] = array(
    'name' => 'access back_to_top settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'back_to_top',
  );

  // Exported permission: 'access backup and migrate'.
  $permissions['access backup and migrate'] = array(
    'name' => 'access backup and migrate',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'backup_migrate',
  );

  // Exported permission: 'access backup files'.
  $permissions['access backup files'] = array(
    'name' => 'access backup files',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'backup_migrate',
  );

  // Exported permission: 'access comments'.
  $permissions['access comments'] = array(
    'name' => 'access comments',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'access content'.
  $permissions['access content'] = array(
    'name' => 'access content',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'node',
  );

  // Exported permission: 'access content overview'.
  $permissions['access content overview'] = array(
    'name' => 'access content overview',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'access contextual links'.
  $permissions['access contextual links'] = array(
    'name' => 'access contextual links',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'contextual',
  );

  // Exported permission: 'access dashboard'.
  $permissions['access dashboard'] = array(
    'name' => 'access dashboard',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'dashboard',
  );

  // Exported permission: 'access domain navigation'.
  $permissions['access domain navigation'] = array(
    'name' => 'access domain navigation',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain_nav',
  );

  // Exported permission: 'access domain settings form'.
  $permissions['access domain settings form'] = array(
    'name' => 'access domain settings form',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain_settings',
  );

  // Exported permission: 'access inactive domains'.
  $permissions['access inactive domains'] = array(
    'name' => 'access inactive domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'access own webform results'.
  $permissions['access own webform results'] = array(
    'name' => 'access own webform results',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'access own webform submissions'.
  $permissions['access own webform submissions'] = array(
    'name' => 'access own webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'access rules debug'.
  $permissions['access rules debug'] = array(
    'name' => 'access rules debug',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'rules',
  );

  // Exported permission: 'access site in maintenance mode'.
  $permissions['access site in maintenance mode'] = array(
    'name' => 'access site in maintenance mode',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'access site reports'.
  $permissions['access site reports'] = array(
    'name' => 'access site reports',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'access statistics'.
  $permissions['access statistics'] = array(
    'name' => 'access statistics',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'statistics',
  );

  // Exported permission: 'access taxonomy_block'.
  $permissions['access taxonomy_block'] = array(
    'name' => 'access taxonomy_block',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy_block',
  );

  // Exported permission: 'access the domain content page'.
  $permissions['access the domain content page'] = array(
    'name' => 'access the domain content page',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain_content',
  );

  // Exported permission: 'access user profiles'.
  $permissions['access user profiles'] = array(
    'name' => 'access user profiles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'add media from remote sources'.
  $permissions['add media from remote sources'] = array(
    'name' => 'add media from remote sources',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'media_internet',
  );

  // Exported permission: 'admin webform remote posts'.
  $permissions['admin webform remote posts'] = array(
    'name' => 'admin webform remote posts',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform_remote_post',
  );

  // Exported permission: 'admin_classes'.
  $permissions['admin_classes'] = array(
    'name' => 'admin_classes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ds_ui',
  );

  // Exported permission: 'admin_display_suite'.
  $permissions['admin_display_suite'] = array(
    'name' => 'admin_display_suite',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ds',
  );

  // Exported permission: 'admin_fields'.
  $permissions['admin_fields'] = array(
    'name' => 'admin_fields',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ds_ui',
  );

  // Exported permission: 'admin_view_modes'.
  $permissions['admin_view_modes'] = array(
    'name' => 'admin_view_modes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ds_ui',
  );

  // Exported permission: 'administer actions'.
  $permissions['administer actions'] = array(
    'name' => 'administer actions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer addthis'.
  $permissions['administer addthis'] = array(
    'name' => 'administer addthis',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'addthis',
  );

  // Exported permission: 'administer advanced addthis'.
  $permissions['administer advanced addthis'] = array(
    'name' => 'administer advanced addthis',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'addthis',
  );

  // Exported permission: 'administer advanced pane settings'.
  $permissions['administer advanced pane settings'] = array(
    'name' => 'administer advanced pane settings',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer autologout'.
  $permissions['administer autologout'] = array(
    'name' => 'administer autologout',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'autologout',
  );

  // Exported permission: 'administer backup and migrate'.
  $permissions['administer backup and migrate'] = array(
    'name' => 'administer backup and migrate',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'backup_migrate',
  );

  // Exported permission: 'administer blocks'.
  $permissions['administer blocks'] = array(
    'name' => 'administer blocks',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'block',
  );

  // Exported permission: 'administer ckeditor'.
  $permissions['administer ckeditor'] = array(
    'name' => 'administer ckeditor',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ckeditor',
  );

  // Exported permission: 'administer comments'.
  $permissions['administer comments'] = array(
    'name' => 'administer comments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'administer content translations'.
  $permissions['administer content translations'] = array(
    'name' => 'administer content translations',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'i18n_node',
  );

  // Exported permission: 'administer content types'.
  $permissions['administer content types'] = array(
    'name' => 'administer content types',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'administer contextual range filters'.
  $permissions['administer contextual range filters'] = array(
    'name' => 'administer contextual range filters',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'contextual_range_filter',
  );

  // Exported permission: 'administer custom tokens'.
  $permissions['administer custom tokens'] = array(
    'name' => 'administer custom tokens',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'token_custom',
  );

  // Exported permission: 'administer dependencies'.
  $permissions['administer dependencies'] = array(
    'name' => 'administer dependencies',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'conditional_fields',
  );

  // Exported permission: 'administer domains'.
  $permissions['administer domains'] = array(
    'name' => 'administer domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'administer entity translation'.
  $permissions['administer entity translation'] = array(
    'name' => 'administer entity translation',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'entity_translation',
  );

  // Exported permission: 'administer facets'.
  $permissions['administer facets'] = array(
    'name' => 'administer facets',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'facetapi',
  );

  // Exported permission: 'administer features'.
  $permissions['administer features'] = array(
    'name' => 'administer features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'administer fieldgroups'.
  $permissions['administer fieldgroups'] = array(
    'name' => 'administer fieldgroups',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'field_group',
  );

  // Exported permission: 'administer filters'.
  $permissions['administer filters'] = array(
    'name' => 'administer filters',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'filter',
  );

  // Exported permission: 'administer flags'.
  $permissions['administer flags'] = array(
    'name' => 'administer flags',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'flag',
  );

  // Exported permission: 'administer forums'.
  $permissions['administer forums'] = array(
    'name' => 'administer forums',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'forum',
  );

  // Exported permission: 'administer image styles'.
  $permissions['administer image styles'] = array(
    'name' => 'administer image styles',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'image',
  );

  // Exported permission: 'administer jsdn api'.
  $permissions['administer jsdn api'] = array(
    'name' => 'administer jsdn api',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'jsdnapi',
  );

  // Exported permission: 'administer languages'.
  $permissions['administer languages'] = array(
    'name' => 'administer languages',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'locale',
  );

  // Exported permission: 'administer media'.
  $permissions['administer media'] = array(
    'name' => 'administer media',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'media',
  );

  // Exported permission: 'administer menu'.
  $permissions['administer menu'] = array(
    'name' => 'administer menu',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'menu',
  );

  // Exported permission: 'administer menu attributes'.
  $permissions['administer menu attributes'] = array(
    'name' => 'administer menu attributes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'menu_attributes',
  );

  // Exported permission: 'administer menus per domain'.
  $permissions['administer menus per domain'] = array(
    'name' => 'administer menus per domain',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain_menu_access',
  );

  // Exported permission: 'administer mini panels'.
  $permissions['administer mini panels'] = array(
    'name' => 'administer mini panels',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_mini',
  );

  // Exported permission: 'administer module filter'.
  $permissions['administer module filter'] = array(
    'name' => 'administer module filter',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'module_filter',
  );

  // Exported permission: 'administer modules'.
  $permissions['administer modules'] = array(
    'name' => 'administer modules',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer morecomments'.
  $permissions['administer morecomments'] = array(
    'name' => 'administer morecomments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'morecomments',
  );

  // Exported permission: 'administer nodes'.
  $permissions['administer nodes'] = array(
    'name' => 'administer nodes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'administer owlcarousel settings'.
  $permissions['administer owlcarousel settings'] = array(
    'name' => 'administer owlcarousel settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'owlcarousel_ui',
  );

  // Exported permission: 'administer own domains'.
  $permissions['administer own domains'] = array(
    'name' => 'administer own domains',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'domain_admin',
  );

  // Exported permission: 'administer page manager'.
  $permissions['administer page manager'] = array(
    'name' => 'administer page manager',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'page_manager',
  );

  // Exported permission: 'administer page titles'.
  $permissions['administer page titles'] = array(
    'name' => 'administer page titles',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'page_title',
  );

  // Exported permission: 'administer pane access'.
  $permissions['administer pane access'] = array(
    'name' => 'administer pane access',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panel-nodes'.
  $permissions['administer panel-nodes'] = array(
    'name' => 'administer panel-nodes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_node',
  );

  // Exported permission: 'administer panels layouts'.
  $permissions['administer panels layouts'] = array(
    'name' => 'administer panels layouts',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer panels styles'.
  $permissions['administer panels styles'] = array(
    'name' => 'administer panels styles',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'administer path breadcrumbs'.
  $permissions['administer path breadcrumbs'] = array(
    'name' => 'administer path breadcrumbs',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'path_breadcrumbs_ui',
  );

  // Exported permission: 'administer pathauto'.
  $permissions['administer pathauto'] = array(
    'name' => 'administer pathauto',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'pathauto',
  );

  // Exported permission: 'administer permissions'.
  $permissions['administer permissions'] = array(
    'name' => 'administer permissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'administer rules'.
  $permissions['administer rules'] = array(
    'name' => 'administer rules',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'rules',
  );

  // Exported permission: 'administer search'.
  $permissions['administer search'] = array(
    'name' => 'administer search',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search',
  );

  // Exported permission: 'administer search_api'.
  $permissions['administer search_api'] = array(
    'name' => 'administer search_api',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search_api',
  );

  // Exported permission: 'administer shortcuts'.
  $permissions['administer shortcuts'] = array(
    'name' => 'administer shortcuts',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'shortcut',
  );

  // Exported permission: 'administer simple dialog'.
  $permissions['administer simple dialog'] = array(
    'name' => 'administer simple dialog',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'simple_dialog',
  );

  // Exported permission: 'administer site configuration'.
  $permissions['administer site configuration'] = array(
    'name' => 'administer site configuration',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer software updates'.
  $permissions['administer software updates'] = array(
    'name' => 'administer software updates',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer statistics'.
  $permissions['administer statistics'] = array(
    'name' => 'administer statistics',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'statistics',
  );

  // Exported permission: 'administer string overrides'.
  $permissions['administer string overrides'] = array(
    'name' => 'administer string overrides',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'stringoverrides',
  );

  // Exported permission: 'administer stylizer'.
  $permissions['administer stylizer'] = array(
    'name' => 'administer stylizer',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'stylizer',
  );

  // Exported permission: 'administer taxonomy'.
  $permissions['administer taxonomy'] = array(
    'name' => 'administer taxonomy',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'administer taxonomy_block'.
  $permissions['administer taxonomy_block'] = array(
    'name' => 'administer taxonomy_block',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy_block',
  );

  // Exported permission: 'administer tb_megamenu'.
  $permissions['administer tb_megamenu'] = array(
    'name' => 'administer tb_megamenu',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'tb_megamenu',
  );

  // Exported permission: 'administer theme assignments'.
  $permissions['administer theme assignments'] = array(
    'name' => 'administer theme assignments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'themekey',
  );

  // Exported permission: 'administer themekey settings'.
  $permissions['administer themekey settings'] = array(
    'name' => 'administer themekey settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'themekey',
  );

  // Exported permission: 'administer themes'.
  $permissions['administer themes'] = array(
    'name' => 'administer themes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'system',
  );

  // Exported permission: 'administer tipsy'.
  $permissions['administer tipsy'] = array(
    'name' => 'administer tipsy',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'tipsy',
  );

  // Exported permission: 'administer url aliases'.
  $permissions['administer url aliases'] = array(
    'name' => 'administer url aliases',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'path',
  );

  // Exported permission: 'administer users'.
  $permissions['administer users'] = array(
    'name' => 'administer users',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'administer uuid'.
  $permissions['administer uuid'] = array(
    'name' => 'administer uuid',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'uuid',
  );

  // Exported permission: 'administer video presets'.
  $permissions['administer video presets'] = array(
    'name' => 'administer video presets',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'video',
  );

  // Exported permission: 'administer views'.
  $permissions['administer views'] = array(
    'name' => 'administer views',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'views',
  );

  // Exported permission: 'administer voting api'.
  $permissions['administer voting api'] = array(
    'name' => 'administer voting api',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'votingapi',
  );

  // Exported permission: 'assign domain editors'.
  $permissions['assign domain editors'] = array(
    'name' => 'assign domain editors',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'block IP addresses'.
  $permissions['block IP addresses'] = array(
    'name' => 'block IP addresses',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'system',
  );

  // Exported permission: 'bypass conversion video'.
  $permissions['bypass conversion video'] = array(
    'name' => 'bypass conversion video',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'video',
  );

  // Exported permission: 'bypass node access'.
  $permissions['bypass node access'] = array(
    'name' => 'bypass node access',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'bypass rules access'.
  $permissions['bypass rules access'] = array(
    'name' => 'bypass rules access',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'rules',
  );

  // Exported permission: 'cancel account'.
  $permissions['cancel account'] = array(
    'name' => 'cancel account',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'change layouts in place editing'.
  $permissions['change layouts in place editing'] = array(
    'name' => 'change layouts in place editing',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'change own logout threshold'.
  $permissions['change own logout threshold'] = array(
    'name' => 'change own logout threshold',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'autologout',
  );

  // Exported permission: 'change own username'.
  $permissions['change own username'] = array(
    'name' => 'change own username',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'convert on submission'.
  $permissions['convert on submission'] = array(
    'name' => 'convert on submission',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'video',
  );

  // Exported permission: 'create article content'.
  $permissions['create article content'] = array(
    'name' => 'create article content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create article content on assigned domains'.
  $permissions['create article content on assigned domains'] = array(
    'name' => 'create article content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'create blog content'.
  $permissions['create blog content'] = array(
    'name' => 'create blog content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create blog content on assigned domains'.
  $permissions['create blog content on assigned domains'] = array(
    'name' => 'create blog content on assigned domains',
    'roles' => array(),
    'module' => 'domain',
  );

  // Exported permission: 'create forum content'.
  $permissions['create forum content'] = array(
    'name' => 'create forum content',
    'roles' => array(
      'authenticated user' => 'authenticated user',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create forum content on assigned domains'.
  $permissions['create forum content on assigned domains'] = array(
    'name' => 'create forum content on assigned domains',
    'roles' => array(),
    'module' => 'domain',
  );

  // Exported permission: 'create mini panels'.
  $permissions['create mini panels'] = array(
    'name' => 'create mini panels',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_mini',
  );

  // Exported permission: 'create page content'.
  $permissions['create page content'] = array(
    'name' => 'create page content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create page content on assigned domains'.
  $permissions['create page content on assigned domains'] = array(
    'name' => 'create page content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'create panel content'.
  $permissions['create panel content'] = array(
    'name' => 'create panel content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create panel content on assigned domains'.
  $permissions['create panel content on assigned domains'] = array(
    'name' => 'create panel content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'create panel-nodes'.
  $permissions['create panel-nodes'] = array(
    'name' => 'create panel-nodes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_node',
  );

  // Exported permission: 'create product_page content'.
  $permissions['create product_page content'] = array(
    'name' => 'create product_page content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create product_page content on assigned domains'.
  $permissions['create product_page content on assigned domains'] = array(
    'name' => 'create product_page content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'create url aliases'.
  $permissions['create url aliases'] = array(
    'name' => 'create url aliases',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'path',
  );

  // Exported permission: 'create webform content'.
  $permissions['create webform content'] = array(
    'name' => 'create webform content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'create webform content on assigned domains'.
  $permissions['create webform content on assigned domains'] = array(
    'name' => 'create webform content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'customize ckeditor'.
  $permissions['customize ckeditor'] = array(
    'name' => 'customize ckeditor',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'ckeditor',
  );

  // Exported permission: 'customize shortcut links'.
  $permissions['customize shortcut links'] = array(
    'name' => 'customize shortcut links',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'shortcut',
  );

  // Exported permission: 'delete all webform submissions'.
  $permissions['delete all webform submissions'] = array(
    'name' => 'delete all webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'delete any article content'.
  $permissions['delete any article content'] = array(
    'name' => 'delete any article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete any blog content'.
  $permissions['delete any blog content'] = array(
    'name' => 'delete any blog content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete any forum content'.
  $permissions['delete any forum content'] = array(
    'name' => 'delete any forum content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete any page content'.
  $permissions['delete any page content'] = array(
    'name' => 'delete any page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete any panel content'.
  $permissions['delete any panel content'] = array(
    'name' => 'delete any panel content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete any panel-nodes'.
  $permissions['delete any panel-nodes'] = array(
    'name' => 'delete any panel-nodes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_node',
  );

  // Exported permission: 'delete any product_page content'.
  $permissions['delete any product_page content'] = array(
    'name' => 'delete any product_page content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete any webform content'.
  $permissions['delete any webform content'] = array(
    'name' => 'delete any webform content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'delete article content on assigned domains'.
  $permissions['delete article content on assigned domains'] = array(
    'name' => 'delete article content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'delete backup files'.
  $permissions['delete backup files'] = array(
    'name' => 'delete backup files',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'backup_migrate',
  );

  // Exported permission: 'delete blog content on assigned domains'.
  $permissions['delete blog content on assigned domains'] = array(
    'name' => 'delete blog content on assigned domains',
    'roles' => array(),
    'module' => 'domain',
  );

  // Exported permission: 'delete domain content'.
  $permissions['delete domain content'] = array(
    'name' => 'delete domain content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'delete forum content on assigned domains'.
  $permissions['delete forum content on assigned domains'] = array(
    'name' => 'delete forum content on assigned domains',
    'roles' => array(),
    'module' => 'domain',
  );

  // Exported permission: 'delete own article content'.
  $permissions['delete own article content'] = array(
    'name' => 'delete own article content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own blog content'.
  $permissions['delete own blog content'] = array(
    'name' => 'delete own blog content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own forum content'.
  $permissions['delete own forum content'] = array(
    'name' => 'delete own forum content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own page content'.
  $permissions['delete own page content'] = array(
    'name' => 'delete own page content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own panel content'.
  $permissions['delete own panel content'] = array(
    'name' => 'delete own panel content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own panel-nodes'.
  $permissions['delete own panel-nodes'] = array(
    'name' => 'delete own panel-nodes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_node',
  );

  // Exported permission: 'delete own product_page content'.
  $permissions['delete own product_page content'] = array(
    'name' => 'delete own product_page content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own webform content'.
  $permissions['delete own webform content'] = array(
    'name' => 'delete own webform content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete own webform submissions'.
  $permissions['delete own webform submissions'] = array(
    'name' => 'delete own webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'delete page content on assigned domains'.
  $permissions['delete page content on assigned domains'] = array(
    'name' => 'delete page content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'delete panel content on assigned domains'.
  $permissions['delete panel content on assigned domains'] = array(
    'name' => 'delete panel content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'delete product_page content on assigned domains'.
  $permissions['delete product_page content on assigned domains'] = array(
    'name' => 'delete product_page content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'delete revisions'.
  $permissions['delete revisions'] = array(
    'name' => 'delete revisions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'delete terms in cpu'.
  $permissions['delete terms in cpu'] = array(
    'name' => 'delete terms in cpu',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in flavor'.
  $permissions['delete terms in flavor'] = array(
    'name' => 'delete terms in flavor',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in forums'.
  $permissions['delete terms in forums'] = array(
    'name' => 'delete terms in forums',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in hard_disk'.
  $permissions['delete terms in hard_disk'] = array(
    'name' => 'delete terms in hard_disk',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in images'.
  $permissions['delete terms in images'] = array(
    'name' => 'delete terms in images',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in industry'.
  $permissions['delete terms in industry'] = array(
    'name' => 'delete terms in industry',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in instance_size'.
  $permissions['delete terms in instance_size'] = array(
    'name' => 'delete terms in instance_size',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in instance_type'.
  $permissions['delete terms in instance_type'] = array(
    'name' => 'delete terms in instance_type',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in operating_system'.
  $permissions['delete terms in operating_system'] = array(
    'name' => 'delete terms in operating_system',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in provider'.
  $permissions['delete terms in provider'] = array(
    'name' => 'delete terms in provider',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in region'.
  $permissions['delete terms in region'] = array(
    'name' => 'delete terms in region',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in service_category'.
  $permissions['delete terms in service_category'] = array(
    'name' => 'delete terms in service_category',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in service_type'.
  $permissions['delete terms in service_type'] = array(
    'name' => 'delete terms in service_type',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete terms in tags'.
  $permissions['delete terms in tags'] = array(
    'name' => 'delete terms in tags',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'delete webform content on assigned domains'.
  $permissions['delete webform content on assigned domains'] = array(
    'name' => 'delete webform content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'display drupal links'.
  $permissions['display drupal links'] = array(
    'name' => 'display drupal links',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'admin_menu',
  );

  // Exported permission: 'edit all webform submissions'.
  $permissions['edit all webform submissions'] = array(
    'name' => 'edit all webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'edit any article content'.
  $permissions['edit any article content'] = array(
    'name' => 'edit any article content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit any blog content'.
  $permissions['edit any blog content'] = array(
    'name' => 'edit any blog content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit any forum content'.
  $permissions['edit any forum content'] = array(
    'name' => 'edit any forum content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit any page content'.
  $permissions['edit any page content'] = array(
    'name' => 'edit any page content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit any panel content'.
  $permissions['edit any panel content'] = array(
    'name' => 'edit any panel content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit any panel-nodes'.
  $permissions['edit any panel-nodes'] = array(
    'name' => 'edit any panel-nodes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_node',
  );

  // Exported permission: 'edit any product_page content'.
  $permissions['edit any product_page content'] = array(
    'name' => 'edit any product_page content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit any webform content'.
  $permissions['edit any webform content'] = array(
    'name' => 'edit any webform content',
    'roles' => array(),
    'module' => 'node',
  );

  // Exported permission: 'edit domain content'.
  $permissions['edit domain content'] = array(
    'name' => 'edit domain content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'edit media'.
  $permissions['edit media'] = array(
    'name' => 'edit media',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'media',
  );

  // Exported permission: 'edit own article content'.
  $permissions['edit own article content'] = array(
    'name' => 'edit own article content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own blog content'.
  $permissions['edit own blog content'] = array(
    'name' => 'edit own blog content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own comments'.
  $permissions['edit own comments'] = array(
    'name' => 'edit own comments',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'edit own forum content'.
  $permissions['edit own forum content'] = array(
    'name' => 'edit own forum content',
    'roles' => array(
      'authenticated user' => 'authenticated user',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own page content'.
  $permissions['edit own page content'] = array(
    'name' => 'edit own page content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own panel content'.
  $permissions['edit own panel content'] = array(
    'name' => 'edit own panel content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own panel-nodes'.
  $permissions['edit own panel-nodes'] = array(
    'name' => 'edit own panel-nodes',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels_node',
  );

  // Exported permission: 'edit own product_page content'.
  $permissions['edit own product_page content'] = array(
    'name' => 'edit own product_page content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own webform content'.
  $permissions['edit own webform content'] = array(
    'name' => 'edit own webform content',
    'roles' => array(
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'edit own webform submissions'.
  $permissions['edit own webform submissions'] = array(
    'name' => 'edit own webform submissions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'edit terms in cpu'.
  $permissions['edit terms in cpu'] = array(
    'name' => 'edit terms in cpu',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in flavor'.
  $permissions['edit terms in flavor'] = array(
    'name' => 'edit terms in flavor',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in forums'.
  $permissions['edit terms in forums'] = array(
    'name' => 'edit terms in forums',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in hard_disk'.
  $permissions['edit terms in hard_disk'] = array(
    'name' => 'edit terms in hard_disk',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in images'.
  $permissions['edit terms in images'] = array(
    'name' => 'edit terms in images',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in industry'.
  $permissions['edit terms in industry'] = array(
    'name' => 'edit terms in industry',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in instance_size'.
  $permissions['edit terms in instance_size'] = array(
    'name' => 'edit terms in instance_size',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in instance_type'.
  $permissions['edit terms in instance_type'] = array(
    'name' => 'edit terms in instance_type',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in operating_system'.
  $permissions['edit terms in operating_system'] = array(
    'name' => 'edit terms in operating_system',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in provider'.
  $permissions['edit terms in provider'] = array(
    'name' => 'edit terms in provider',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in region'.
  $permissions['edit terms in region'] = array(
    'name' => 'edit terms in region',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in service_category'.
  $permissions['edit terms in service_category'] = array(
    'name' => 'edit terms in service_category',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in service_type'.
  $permissions['edit terms in service_type'] = array(
    'name' => 'edit terms in service_type',
    'roles' => array(),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit terms in tags'.
  $permissions['edit terms in tags'] = array(
    'name' => 'edit terms in tags',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'taxonomy',
  );

  // Exported permission: 'edit webform components'.
  $permissions['edit webform components'] = array(
    'name' => 'edit webform components',
    'roles' => array(
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'webform',
  );

  // Exported permission: 'field hidden administer'.
  $permissions['field hidden administer'] = array(
    'name' => 'field hidden administer',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'field_hidden',
  );

  // Exported permission: 'flag recently_viewed'.
  $permissions['flag recently_viewed'] = array(
    'name' => 'flag recently_viewed',
    'roles' => array(
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'flag',
  );

  // Exported permission: 'flush caches'.
  $permissions['flush caches'] = array(
    'name' => 'flush caches',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'admin_menu',
  );

  // Exported permission: 'generate features'.
  $permissions['generate features'] = array(
    'name' => 'generate features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'import media'.
  $permissions['import media'] = array(
    'name' => 'import media',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'media',
  );

  // Exported permission: 'jsdn offer display'.
  $permissions['jsdn offer display'] = array(
    'name' => 'jsdn offer display',
    'roles' => array(
      'administrator' => 'administrator',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'jsdnapi',
  );

  // Exported permission: 'list custom tokens'.
  $permissions['list custom tokens'] = array(
    'name' => 'list custom tokens',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'token_custom',
  );

  // Exported permission: 'manage features'.
  $permissions['manage features'] = array(
    'name' => 'manage features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'notify of path changes'.
  $permissions['notify of path changes'] = array(
    'name' => 'notify of path changes',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'pathauto',
  );

  // Exported permission: 'override player dimensions'.
  $permissions['override player dimensions'] = array(
    'name' => 'override player dimensions',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'video',
  );

  // Exported permission: 'perform backup'.
  $permissions['perform backup'] = array(
    'name' => 'perform backup',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'backup_migrate',
  );

  // Exported permission: 'post comments'.
  $permissions['post comments'] = array(
    'name' => 'post comments',
    'roles' => array(
      'administrator' => 'administrator',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'comment',
  );

  // Exported permission: 'publish from assigned domain'.
  $permissions['publish from assigned domain'] = array(
    'name' => 'publish from assigned domain',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'publish from default domain'.
  $permissions['publish from default domain'] = array(
    'name' => 'publish from default domain',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'publish to any assigned domain'.
  $permissions['publish to any assigned domain'] = array(
    'name' => 'publish to any assigned domain',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'rate content'.
  $permissions['rate content'] = array(
    'name' => 'rate content',
    'roles' => array(
      'administrator' => 'administrator',
      'authenticated user' => 'authenticated user',
      'store admin' => 'store admin',
    ),
    'module' => 'fivestar',
  );

  // Exported permission: 're convert video'.
  $permissions['re convert video'] = array(
    'name' => 're convert video',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'video',
  );

  // Exported permission: 'rename features'.
  $permissions['rename features'] = array(
    'name' => 'rename features',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'features',
  );

  // Exported permission: 'restore from backup'.
  $permissions['restore from backup'] = array(
    'name' => 'restore from backup',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'backup_migrate',
  );

  // Exported permission: 'revert revisions'.
  $permissions['revert revisions'] = array(
    'name' => 'revert revisions',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'review content for all domains'.
  $permissions['review content for all domains'] = array(
    'name' => 'review content for all domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain_content',
  );

  // Exported permission: 'search content'.
  $permissions['search content'] = array(
    'name' => 'search content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search',
  );

  // Exported permission: 'select account cancellation method'.
  $permissions['select account cancellation method'] = array(
    'name' => 'select account cancellation method',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'user',
  );

  // Exported permission: 'set domain access'.
  $permissions['set domain access'] = array(
    'name' => 'set domain access',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'set page title'.
  $permissions['set page title'] = array(
    'name' => 'set page title',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'page_title',
  );

  // Exported permission: 'skip comment approval'.
  $permissions['skip comment approval'] = array(
    'name' => 'skip comment approval',
    'roles' => array(),
    'module' => 'comment',
  );

  // Exported permission: 'submit translations to localization server'.
  $permissions['submit translations to localization server'] = array(
    'name' => 'submit translations to localization server',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'l10n_client',
  );

  // Exported permission: 'switch shortcut sets'.
  $permissions['switch shortcut sets'] = array(
    'name' => 'switch shortcut sets',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'shortcut',
  );

  // Exported permission: 'toggle field translatability'.
  $permissions['toggle field translatability'] = array(
    'name' => 'toggle field translatability',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'entity_translation',
  );

  // Exported permission: 'translate admin strings'.
  $permissions['translate admin strings'] = array(
    'name' => 'translate admin strings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'i18n_string',
  );

  // Exported permission: 'translate any entity'.
  $permissions['translate any entity'] = array(
    'name' => 'translate any entity',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'entity_translation',
  );

  // Exported permission: 'translate content'.
  $permissions['translate content'] = array(
    'name' => 'translate content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'translation',
  );

  // Exported permission: 'translate interface'.
  $permissions['translate interface'] = array(
    'name' => 'translate interface',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'locale',
  );

  // Exported permission: 'translate node entities'.
  $permissions['translate node entities'] = array(
    'name' => 'translate node entities',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'entity_translation',
  );

  // Exported permission: 'translate taxonomy_term entities'.
  $permissions['translate taxonomy_term entities'] = array(
    'name' => 'translate taxonomy_term entities',
    'roles' => array(),
    'module' => 'entity_translation',
  );

  // Exported permission: 'translate user-defined strings'.
  $permissions['translate user-defined strings'] = array(
    'name' => 'translate user-defined strings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'i18n_string',
  );

  // Exported permission: 'unflag recently_viewed'.
  $permissions['unflag recently_viewed'] = array(
    'name' => 'unflag recently_viewed',
    'roles' => array(
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'flag',
  );

  // Exported permission: 'update article content on assigned domains'.
  $permissions['update article content on assigned domains'] = array(
    'name' => 'update article content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'update blog content on assigned domains'.
  $permissions['update blog content on assigned domains'] = array(
    'name' => 'update blog content on assigned domains',
    'roles' => array(),
    'module' => 'domain',
  );

  // Exported permission: 'update forum content on assigned domains'.
  $permissions['update forum content on assigned domains'] = array(
    'name' => 'update forum content on assigned domains',
    'roles' => array(),
    'module' => 'domain',
  );

  // Exported permission: 'update page content on assigned domains'.
  $permissions['update page content on assigned domains'] = array(
    'name' => 'update page content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'update panel content on assigned domains'.
  $permissions['update panel content on assigned domains'] = array(
    'name' => 'update panel content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'update product_page content on assigned domains'.
  $permissions['update product_page content on assigned domains'] = array(
    'name' => 'update product_page content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'update webform content on assigned domains'.
  $permissions['update webform content on assigned domains'] = array(
    'name' => 'update webform content on assigned domains',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  // Exported permission: 'use PHP for settings'.
  $permissions['use PHP for settings'] = array(
    'name' => 'use PHP for settings',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'php',
  );

  // Exported permission: 'use advanced search'.
  $permissions['use advanced search'] = array(
    'name' => 'use advanced search',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'search',
  );

  // Exported permission: 'use comparison'.
  $permissions['use comparison'] = array(
    'name' => 'use comparison',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'node_compare',
  );

  // Exported permission: 'use default thumb'.
  $permissions['use default thumb'] = array(
    'name' => 'use default thumb',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'video',
  );

  // Exported permission: 'use flag import'.
  $permissions['use flag import'] = array(
    'name' => 'use flag import',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'flag',
  );

  // Exported permission: 'use ipe with page manager'.
  $permissions['use ipe with page manager'] = array(
    'name' => 'use ipe with page manager',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use on-page translation'.
  $permissions['use on-page translation'] = array(
    'name' => 'use on-page translation',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'l10n_client',
  );

  // Exported permission: 'use page manager'.
  $permissions['use page manager'] = array(
    'name' => 'use page manager',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'page_manager',
  );

  // Exported permission: 'use panels caching features'.
  $permissions['use panels caching features'] = array(
    'name' => 'use panels caching features',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use panels dashboard'.
  $permissions['use panels dashboard'] = array(
    'name' => 'use panels dashboard',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use panels in place editing'.
  $permissions['use panels in place editing'] = array(
    'name' => 'use panels in place editing',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use panels locks'.
  $permissions['use panels locks'] = array(
    'name' => 'use panels locks',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'use text format ds_code'.
  $permissions['use text format ds_code'] = array(
    'name' => 'use text format ds_code',
    'roles' => array(),
    'module' => 'filter',
  );

  // Exported permission: 'use text format filtered_html'.
  $permissions['use text format filtered_html'] = array(
    'name' => 'use text format filtered_html',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'filter',
  );

  // Exported permission: 'use text format full_html'.
  $permissions['use text format full_html'] = array(
    'name' => 'use text format full_html',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
      'store admin' => 'store admin',
    ),
    'module' => 'filter',
  );

  // Exported permission: 'use text format php_code'.
  $permissions['use text format php_code'] = array(
    'name' => 'use text format php_code',
    'roles' => array(),
    'module' => 'filter',
  );

  // Exported permission: 'view apicall_field on node'.
  $permissions['view apicall_field on node'] = array(
    'name' => 'view apicall_field on node',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'customer admin' => 'customer admin',
      'store admin' => 'store admin',
    ),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view author on comment'.
  $permissions['view author on comment'] = array(
    'name' => 'view author on comment',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view author on node'.
  $permissions['view author on node'] = array(
    'name' => 'view author on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view changed_date on node'.
  $permissions['view changed_date on node'] = array(
    'name' => 'view changed_date on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view comments on node'.
  $permissions['view comments on node'] = array(
    'name' => 'view comments on node',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view ds_user_picture on comment'.
  $permissions['view ds_user_picture on comment'] = array(
    'name' => 'view ds_user_picture on comment',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view ds_user_picture on node'.
  $permissions['view ds_user_picture on node'] = array(
    'name' => 'view ds_user_picture on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view ds_user_picture on user'.
  $permissions['view ds_user_picture on user'] = array(
    'name' => 'view ds_user_picture on user',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view guestuser_message_for_offer_disp on node'.
  $permissions['view guestuser_message_for_offer_disp on node'] = array(
    'name' => 'view guestuser_message_for_offer_disp on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view links on comment'.
  $permissions['view links on comment'] = array(
    'name' => 'view links on comment',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view links on node'.
  $permissions['view links on node'] = array(
    'name' => 'view links on node',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view media'.
  $permissions['view media'] = array(
    'name' => 'view media',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
      'store admin' => 'store admin',
    ),
    'module' => 'media',
  );

  // Exported permission: 'view more_link on taxonomy_term'.
  $permissions['view more_link on taxonomy_term'] = array(
    'name' => 'view more_link on taxonomy_term',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view name on user'.
  $permissions['view name on user'] = array(
    'name' => 'view name on user',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view node_link on node'.
  $permissions['view node_link on node'] = array(
    'name' => 'view node_link on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view offers on node'.
  $permissions['view offers on node'] = array(
    'name' => 'view offers on node',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'customer admin' => 'customer admin',
      'store admin' => 'store admin',
    ),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view own unpublished content'.
  $permissions['view own unpublished content'] = array(
    'name' => 'view own unpublished content',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'view pane admin links'.
  $permissions['view pane admin links'] = array(
    'name' => 'view pane admin links',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'panels',
  );

  // Exported permission: 'view permalink on comment'.
  $permissions['view permalink on comment'] = array(
    'name' => 'view permalink on comment',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view post access counter'.
  $permissions['view post access counter'] = array(
    'name' => 'view post access counter',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'statistics',
  );

  // Exported permission: 'view post_date on comment'.
  $permissions['view post_date on comment'] = array(
    'name' => 'view post_date on comment',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view post_date on node'.
  $permissions['view post_date on node'] = array(
    'name' => 'view post_date on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view revisions'.
  $permissions['view revisions'] = array(
    'name' => 'view revisions',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'node',
  );

  // Exported permission: 'view search_info on node'.
  $permissions['view search_info on node'] = array(
    'name' => 'view search_info on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view search_snippet on node'.
  $permissions['view search_snippet on node'] = array(
    'name' => 'view search_snippet on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view submitted on comment'.
  $permissions['view submitted on comment'] = array(
    'name' => 'view submitted on comment',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view submitted_by on node'.
  $permissions['view submitted_by on node'] = array(
    'name' => 'view submitted_by on node',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view the administration theme'.
  $permissions['view the administration theme'] = array(
    'name' => 'view the administration theme',
    'roles' => array(
      'administrator' => 'administrator',
      'store admin' => 'store admin',
    ),
    'module' => 'system',
  );

  // Exported permission: 'view title on comment'.
  $permissions['view title on comment'] = array(
    'name' => 'view title on comment',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view title on node'.
  $permissions['view title on node'] = array(
    'name' => 'view title on node',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view title on taxonomy_term'.
  $permissions['view title on taxonomy_term'] = array(
    'name' => 'view title on taxonomy_term',
    'roles' => array(),
    'module' => 'ds_extras',
  );

  // Exported permission: 'view unpublished domain content'.
  $permissions['view unpublished domain content'] = array(
    'name' => 'view unpublished domain content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'domain',
  );

  return $permissions;
}
