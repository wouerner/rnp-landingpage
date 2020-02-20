<?php
/**
 * @file
 * features_store.ds.inc
 */

/**
 * Implements hook_ds_field_settings_info().
 */
function features_store_ds_field_settings_info() {
  $export = array();

  $ds_fieldsetting = new stdClass();
  $ds_fieldsetting->api_version = 1;
  $ds_fieldsetting->id = 'comment|comment_node_product_page|default';
  $ds_fieldsetting->entity_type = 'comment';
  $ds_fieldsetting->bundle = 'comment_node_product_page';
  $ds_fieldsetting->view_mode = 'default';
  $ds_fieldsetting->settings = array(
    'post_date' => array(
      'weight' => '2',
      'label' => 'hidden',
      'format' => 'ds_post_date_long',
    ),
    'author' => array(
      'weight' => '0',
      'label' => 'hidden',
      'format' => 'default',
    ),
  );
  $export['comment|comment_node_product_page|default'] = $ds_fieldsetting;

  $ds_fieldsetting = new stdClass();
  $ds_fieldsetting->api_version = 1;
  $ds_fieldsetting->id = 'node|product_page|teaser';
  $ds_fieldsetting->entity_type = 'node';
  $ds_fieldsetting->bundle = 'product_page';
  $ds_fieldsetting->view_mode = 'teaser';
  $ds_fieldsetting->settings = array(
    'title' => array(
      'weight' => '0',
      'label' => 'hidden',
      'format' => 'default',
      'formatter_settings' => array(
        'link' => '1',
        'wrapper' => 'h2',
        'class' => 'smallh2',
      ),
    ),
  );
  $export['node|product_page|teaser'] = $ds_fieldsetting;

  return $export;
}



/**
 * Implements hook_ds_layout_settings_info().
 */
function features_store_ds_layout_settings_info() {
  $export = array();

  $ds_layout = new stdClass();
  $ds_layout->api_version = 1;
  $ds_layout->id = 'comment|comment_node_product_page|default';
  $ds_layout->entity_type = 'comment';
  $ds_layout->bundle = 'comment_node_product_page';
  $ds_layout->view_mode = 'default';
  $ds_layout->layout = 'panels-twocol';
  $ds_layout->settings = array(
    'regions' => array(
      'left' => array(
        0 => 'author',
        1 => 'comment_body',
        3 => 'post_date',
      ),
      'right' => array(
        2 => 'field_rating_review',
        4 => 'group_comment_rating',
        5 => 'field_support',
        6 => 'field_pricing',
      ),
    ),
    'fields' => array(
      'author' => 'left',
      'comment_body' => 'left',
      'field_rating_review' => 'right',
      'post_date' => 'left',
      'group_comment_rating' => 'right',
      'field_support' => 'right',
      'field_pricing' => 'right',
    ),
    'classes' => array(
      'layout_class' => array(
        '' => '',
      ),
    ),
    'wrappers' => array(
      'left' => 'div',
      'right' => 'div',
    ),
    'layout_wrapper' => 'div',
    'layout_attributes' => '',
    'layout_attributes_merge' => 1,
    'layout_link_attribute' => '',
    'layout_link_custom' => '',
  );
  $export['comment|comment_node_product_page|default'] = $ds_layout;

  $ds_layout = new stdClass();
  $ds_layout->api_version = 1;
  $ds_layout->id = 'node|product_page|full';
  $ds_layout->entity_type = 'node';
  $ds_layout->bundle = 'product_page';
  $ds_layout->view_mode = 'full';
  $ds_layout->layout = 'ds_3col_stacked_fluid';
  $ds_layout->settings = array(
    'regions' => array(
      'header' => array(
        0 => 'field_banner',
      ),
      'left' => array(
        1 => 'field_logo',
      ),
      'middle' => array(
        2 => 'title',
        3 => 'field_category',
        4 => 'field_rating',
      ),
      'right' => array(
        5 => 'field_share',
      ),
      'footer' => array(
        6 => 'field_product_offer_details',
        7 => 'guestuser_message_for_offer_disp',
        8 => 'group_ptabs',
        9 => 'field_features',
        10 => 'domain',
        11 => 'comments',
        12 => 'group_overview_container',
        13 => 'field_case_studies',
        14 => 'field_offer_details',
        15 => 'body',
        16 => 'group_overview',
        17 => 'group_feature',
        18 => 'group_pricing',
        19 => 'group_faq',
      ),
    ),
    'fields' => array(
      'field_banner' => 'header',
      'field_logo' => 'left',
      'title' => 'middle',
      'field_category' => 'middle',
      'field_rating' => 'middle',
      'field_share' => 'right',
      'field_product_offer_details' => 'footer',
      'guestuser_message_for_offer_disp' => 'footer',
      'group_ptabs' => 'footer',
      'field_features' => 'footer',
      'domain' => 'footer',
      'comments' => 'footer',
      'group_overview_container' => 'footer',
      'field_case_studies' => 'footer',
      'field_offer_details' => 'footer',
      'body' => 'footer',
      'group_overview' => 'footer',
      'group_feature' => 'footer',
      'group_pricing' => 'footer',
      'group_faq' => 'footer',
    ),
    'classes' => array(
      'layout_class' => array(
        '' => '',
      ),
      'left' => array(
        'serviceDetailsLogo' => 'serviceDetailsLogo',
      ),
    ),
    'wrappers' => array(
      'header' => 'div',
      'left' => 'div',
      'middle' => 'div',
      'right' => 'div',
      'footer' => 'div',
    ),
    'layout_wrapper' => 'div',
    'layout_attributes' => '',
    'layout_attributes_merge' => 1,
    'layout_link_attribute' => '',
    'layout_link_custom' => '',
    'hide_page_title' => '1',
    'page_option_title' => '',
  );
  $export['node|product_page|full'] = $ds_layout;

  $ds_layout = new stdClass();
  $ds_layout->api_version = 1;
  $ds_layout->id = 'node|product_page|teaser';
  $ds_layout->entity_type = 'node';
  $ds_layout->bundle = 'product_page';
  $ds_layout->view_mode = 'teaser';
  $ds_layout->layout = 'ds_2col';
  $ds_layout->settings = array(
    'regions' => array(
      'right' => array(
        0 => 'title',
        2 => 'body',
        4 => 'node_compare',
      ),
      'left' => array(
        1 => 'field_logo',
        3 => 'domain',
      ),
    ),
    'fields' => array(
      'title' => 'right',
      'field_logo' => 'left',
      'body' => 'right',
      'domain' => 'left',
      'node_compare' => 'right',
    ),
    'classes' => array(),
    'wrappers' => array(
      'left' => 'div',
      'right' => 'div',
    ),
    'layout_wrapper' => 'div',
    'layout_attributes' => '',
    'layout_attributes_merge' => 1,
    'layout_link_attribute' => '',
    'layout_link_custom' => '',
  );
  $export['node|product_page|teaser'] = $ds_layout;

  $ds_layout = new stdClass();
  $ds_layout->api_version = 1;
  $ds_layout->id = 'taxonomy_term|service_category|default';
  $ds_layout->entity_type = 'taxonomy_term';
  $ds_layout->bundle = 'service_category';
  $ds_layout->view_mode = 'default';
  $ds_layout->layout = 'ds_2col';
  $ds_layout->settings = array(
    'regions' => array(
      'left' => array(
        0 => 'field_logo',
      ),
      'right' => array(
        1 => 'description',
      ),
    ),
    'fields' => array(
      'field_logo' => 'left',
      'description' => 'right',
    ),
    'classes' => array(),
    'wrappers' => array(
      'left' => 'div',
      'right' => 'div',
    ),
    'layout_wrapper' => 'div',
    'layout_attributes' => '',
    'layout_attributes_merge' => 1,
    'layout_link_attribute' => '',
    'layout_link_custom' => '',
  );
  $export['taxonomy_term|service_category|default'] = $ds_layout;

  return $export;
}
