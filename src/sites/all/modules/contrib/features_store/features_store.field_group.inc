<?php
/**
 * @file
 * features_store.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function features_store_field_group_info() {
  $export = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_casestudies|node|product_page|default';
  $field_group->group_name = 'group_casestudies';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'Overview',
    'weight' => '16',
    'children' => array(
      0 => 'body',
    ),
    'format_type' => 'htab',
    'format_settings' => array(
      'label' => 'Overview',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-casestudies field-group-htab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $export['group_casestudies|node|product_page|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_comment_rating|comment|comment_node_product_page|default';
  $field_group->group_name = 'group_comment_rating';
  $field_group->entity_type = 'comment';
  $field_group->bundle = 'comment_node_product_page';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Comment Rating',
    'weight' => '3',
    'children' => array(
      0 => 'field_rating_review',
      1 => 'field_support',
      2 => 'field_pricing',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Comment Rating',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-comment-rating field-group-fieldset',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $export['group_comment_rating|comment|comment_node_product_page|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_faq|node|product_page|full';
  $field_group->group_name = 'group_faq';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'FAQ',
    'weight' => '27',
    'children' => array(
      0 => 'field_case_studies',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-faq field-group-tab',
      ),
    ),
  );
  $export['group_faq|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_features|node|product_page|default';
  $field_group->group_name = 'group_features';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'Features',
    'weight' => '17',
    'children' => array(
      0 => 'field_features',
    ),
    'format_type' => 'htab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-features field-group-htab',
        'id' => '',
      ),
    ),
  );
  $export['group_features|node|product_page|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_feature|node|product_page|full';
  $field_group->group_name = 'group_feature';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'Supplymentary Meterials',
    'weight' => '25',
    'children' => array(
      0 => 'field_features',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Supplymentary Meterials',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-feature field-group-htab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $export['group_feature|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_iaas_ppty|node|product_page|form';
  $field_group->group_name = 'group_iaas_ppty';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'IaaS Properties',
    'weight' => '2',
    'children' => array(
      0 => 'field_region',
      1 => 'field_operating_system',
      2 => 'field_iaas_image',
      3 => 'field_flavor',
      4 => 'field_hard_disk',
      5 => 'field_cpu',
      6 => 'field_instance_type',
      7 => 'field_instance_size',
    ),
    'format_type' => 'fieldset',
    'format_settings' => array(
      'formatter' => 'collapsible',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-iaas-ppty field-group-fieldset',
        'required_fields' => 1,
      ),
    ),
  );
  $export['group_iaas_ppty|node|product_page|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_offers|node|product_page|default';
  $field_group->group_name = 'group_offers';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'Offers',
    'weight' => '18',
    'children' => array(
      0 => 'field_offer_details',
    ),
    'format_type' => 'htab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-offers field-group-htab',
        'id' => '',
      ),
    ),
  );
  $export['group_offers|node|product_page|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_oright|node|product_page|full';
  $field_group->group_name = 'group_oright';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'overvireRight',
    'weight' => '37',
    'children' => array(),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'overvireRight',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-oright field-group-div',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $export['group_oright|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_overview_container|node|product_page|full';
  $field_group->group_name = 'group_overview_container';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = 'group_overview';
  $field_group->data = array(
    'label' => 'Overview Container div',
    'weight' => '12',
    'children' => array(
      0 => 'body',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Overview Container div',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-overview-container field-group-div',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $export['group_overview_container|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_overview|node|product_page|full';
  $field_group->group_name = 'group_overview';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'Product Overview',
    'weight' => '24',
    'children' => array(
      0 => 'group_overview_container',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Product Overview',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-overview field-group-htab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $export['group_overview|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_pricing|node|product_page|full';
  $field_group->group_name = 'group_pricing';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = 'group_ptabs';
  $field_group->data = array(
    'label' => 'Requirements',
    'weight' => '26',
    'children' => array(
      0 => 'field_offer_details',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'label' => 'Requirements',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-pricing field-group-htab',
        'description' => '',
      ),
      'formatter' => 'closed',
    ),
  );
  $export['group_pricing|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_provider|node|product_page|full';
  $field_group->group_name = 'group_provider';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'sameProvider',
    'weight' => '38',
    'children' => array(),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'sameProvider',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-provider field-group-div',
        'description' => '',
        'show_label' => '0',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $export['group_provider|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_ptabs|node|product_page|default';
  $field_group->group_name = 'group_ptabs';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Product Tabs',
    'weight' => '6',
    'children' => array(
      0 => 'group_offers',
      1 => 'group_features',
      2 => 'group_casestudies',
    ),
    'format_type' => 'htabs',
    'format_settings' => array(
      'formatter' => '',
      'instance_settings' => array(
        'classes' => 'group-ptabs field-group-htabs',
      ),
    ),
  );
  $export['group_ptabs|node|product_page|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_ptabs|node|product_page|full';
  $field_group->group_name = 'group_ptabs';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Product Tabs',
    'weight' => '10',
    'children' => array(
      0 => 'group_overview',
      1 => 'group_feature',
      2 => 'group_pricing',
      3 => 'group_faq',
    ),
    'format_type' => 'tabs',
    'format_settings' => array(
      'formatter' => '',
      'instance_settings' => array(
        'classes' => 'group-ptabs field-group-htabs',
      ),
    ),
  );
  $export['group_ptabs|node|product_page|full'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_related|node|product_page|full';
  $field_group->group_name = 'group_related';
  $field_group->entity_type = 'node';
  $field_group->bundle = 'product_page';
  $field_group->mode = 'full';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Related',
    'weight' => '35',
    'children' => array(
      0 => 'field_industry',
      1 => 'field_provider',
    ),
    'format_type' => 'div',
    'format_settings' => array(
      'label' => 'Related',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'group-related field-group-fieldset',
        'description' => '',
        'show_label' => '1',
        'label_element' => 'h3',
        'effect' => 'none',
        'speed' => 'fast',
      ),
      'formatter' => 'open',
    ),
  );
  $export['group_related|node|product_page|full'] = $field_group;

  return $export;
}
