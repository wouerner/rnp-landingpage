<?php
/**
 * @file
 * features_store.features.menu_custom.inc
 */

/**
 * Implements hook_menu_default_menu_custom().
 */
function features_store_menu_default_menu_custom() {
  $menus = array();

  // Exported menu: 04072aa399a97e6f6edb9c866228fa3d.
  $menus['04072aa399a97e6f6edb9c866228fa3d'] = array(
    'menu_name' => '04072aa399a97e6f6edb9c866228fa3d',
    'title' => 'storemenu for aaa',
    'description' => 'Primary menu for stores for aaa',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: 768e0f1be0831e52b1867a01de7cd5ac.
  $menus['768e0f1be0831e52b1867a01de7cd5ac'] = array(
    'menu_name' => '768e0f1be0831e52b1867a01de7cd5ac',
    'title' => 'Loggedin Menu',
    'description' => 'Primary menu',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: 9aee278cf50965619b4d658d13d0d9c2.
  $menus['9aee278cf50965619b4d658d13d0d9c2'] = array(
    'menu_name' => '9aee278cf50965619b4d658d13d0d9c2',
    'title' => 'storemenu for ABC Store',
    'description' => 'Primary menu for stores for ABC Store',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: ba286ba23676e933defb08dc5489b1ff.
  $menus['ba286ba23676e933defb08dc5489b1ff'] = array(
    'menu_name' => 'ba286ba23676e933defb08dc5489b1ff',
    'title' => 'storemenu for store.jamcracker.com',
    'description' => 'Primary menu for stores for store.jamcracker.com',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: cdea21f9c8cd6bf7c14c5361a11b43f9.
  $menus['cdea21f9c8cd6bf7c14c5361a11b43f9'] = array(
    'menu_name' => 'cdea21f9c8cd6bf7c14c5361a11b43f9',
    'title' => 'storemenu for Store1 Test',
    'description' => 'Primary menu for stores for Store1 Test',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: features.
  $menus['features'] = array(
    'menu_name' => 'features',
    'title' => 'Features',
    'description' => 'Menu items for any enabled features.',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: main-menu.
  $menus['main-menu'] = array(
    'menu_name' => 'main-menu',
    'title' => 'Main menu',
    'description' => 'The <em>Main</em> menu is used on many sites to show the major sections of the site, often in a top navigation bar.',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: management.
  $menus['management'] = array(
    'menu_name' => 'management',
    'title' => 'Management',
    'description' => 'The <em>Management</em> menu contains links for administrative tasks.',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: menu-footer-menu.
  $menus['menu-footer-menu'] = array(
    'menu_name' => 'menu-footer-menu',
    'title' => 'Footer Menu',
    'description' => '',
    'language' => 'und',
    'i18n_mode' => 5,
  );
  // Exported menu: menu-login.
  $menus['menu-login'] = array(
    'menu_name' => 'menu-login',
    'title' => 'Top Menu',
    'description' => '',
    'language' => 'und',
    'i18n_mode' => 5,
  );
  // Exported menu: menu-profile.
  $menus['menu-profile'] = array(
    'menu_name' => 'menu-profile',
    'title' => 'Profile',
    'description' => '',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: menu-test.
  $menus['menu-test'] = array(
    'menu_name' => 'menu-test',
    'title' => 'Test',
    'description' => 'test',
    'language' => 'und',
    'i18n_mode' => 5,
  );
  // Exported menu: navigation.
  $menus['navigation'] = array(
    'menu_name' => 'navigation',
    'title' => 'Navigation',
    'description' => 'The <em>Navigation</em> menu contains links intended for site visitors. Links are added to the <em>Navigation</em> menu automatically by some modules.',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Exported menu: user-menu.
  $menus['user-menu'] = array(
    'menu_name' => 'user-menu',
    'title' => 'User menu',
    'description' => 'The <em>User</em> menu contains links related to the user\'s account, as well as the \'Log out\' link.',
    'language' => 'und',
    'i18n_mode' => 0,
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Features');
  t('Footer Menu');
  t('Loggedin Menu');
  t('Main menu');
  t('Management');
  t('Menu items for any enabled features.');
  t('Navigation');
  t('Primary menu');
  t('Primary menu for stores for ABC Store');
  t('Primary menu for stores for Store1 Test');
  t('Primary menu for stores for aaa');
  t('Primary menu for stores for store.jamcracker.com');
  t('Profile');
  t('Test');
  t('The <em>Main</em> menu is used on many sites to show the major sections of the site, often in a top navigation bar.');
  t('The <em>Management</em> menu contains links for administrative tasks.');
  t('The <em>Navigation</em> menu contains links intended for site visitors. Links are added to the <em>Navigation</em> menu automatically by some modules.');
  t('The <em>User</em> menu contains links related to the user\'s account, as well as the \'Log out\' link.');
  t('Top Menu');
  t('User menu');
  t('storemenu for ABC Store');
  t('storemenu for Store1 Test');
  t('storemenu for aaa');
  t('storemenu for store.jamcracker.com');
  t('test');


  return $menus;
}
