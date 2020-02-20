<?php
/**
 * @file
 * features_store.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function features_store_user_default_roles() {
  $roles = array();

  // Exported role: administrator.
  $roles['administrator'] = array(
    'name' => 'administrator',
    'weight' => 2,
  );

  // Exported role: customer admin.
  $roles['customer admin'] = array(
    'name' => 'customer admin',
    'weight' => 5,
  );

  // Exported role: end user.
  $roles['end user'] = array(
    'name' => 'end user',
    'weight' => 4,
  );

  // Exported role: store admin.
  $roles['store admin'] = array(
    'name' => 'store admin',
    'weight' => 3,
  );

  return $roles;
}
