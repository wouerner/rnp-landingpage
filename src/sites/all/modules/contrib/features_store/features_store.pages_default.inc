<?php
/**
 * @file
 * features_store.pages_default.inc
 */

/**
 * Implements hook_default_page_manager_pages().
 */
function features_store_default_page_manager_pages() {
  $page = new stdClass();
  $page->disabled = FALSE; /* Edit this to true to make a default page disabled initially */
  $page->api_version = 1;
  $page->name = 'default_frontpage';
  $page->task = 'page';
  $page->admin_title = 'default frontpage';
  $page->admin_description = 'Default Front Page Theme';
  $page->path = 'home';
  $page->access = array();
  $page->menu = array();
  $page->arguments = array();
  $page->conf = array(
    'admin_paths' => FALSE,
  );
  $page->default_handlers = array();
  $handler = new stdClass();
  $handler->disabled = FALSE; /* Edit this to true to make a default handler disabled initially */
  $handler->api_version = 1;
  $handler->name = 'page_default_frontpage_panel_context';
  $handler->task = 'page';
  $handler->subtask = 'default_frontpage';
  $handler->handler = 'panel_context';
  $handler->weight = 0;
  $handler->conf = array(
    'title' => 'Default',
    'no_blocks' => 0,
    'pipeline' => 'ipe',
    'body_classes_to_remove' => '',
    'body_classes_to_add' => '',
    'css_id' => '',
    'css' => '',
    'contexts' => array(),
    'relationships' => array(),
  );
  $display = new panels_display();
  $display->layout = 'flexible:default_front_page_layout';
  $display->layout_settings = array();
  $display->panel_settings = array(
    'style_settings' => array(
      'default' => NULL,
      'middle' => NULL,
      'center' => NULL,
      'search_region' => NULL,
      'aaa' => NULL,
      'service_view' => NULL,
      'bottom' => NULL,
    ),
  );
  $display->cache = array();
  $display->title = '';
  $display->uuid = '5de01e3f-9317-4838-acb7-14d261549765';
  $display->content = array();
  $display->panels = array();
    $pane = new stdClass();
    $pane->pid = 'new-73725736-d67d-449e-abce-315050d5216f';
    $pane->panel = 'aaa';
    $pane->type = 'block';
    $pane->subtype = 'block-4';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 1,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 0;
    $pane->locks = array();
    $pane->uuid = '73725736-d67d-449e-abce-315050d5216f';
    $display->content['new-73725736-d67d-449e-abce-315050d5216f'] = $pane;
    $display->panels['aaa'][0] = 'new-73725736-d67d-449e-abce-315050d5216f';
    $pane = new stdClass();
    $pane->pid = 'new-722dc294-9af1-4ca6-b8d8-ebf39043dff3';
    $pane->panel = 'bottom';
    $pane->type = 'node';
    $pane->subtype = 'node';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'nid' => '17',
      'links' => 1,
      'leave_node_title' => 0,
      'identifier' => '',
      'build_mode' => 'full',
      'link_node_title' => 0,
      'override_title' => 1,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 0;
    $pane->locks = array();
    $pane->uuid = '722dc294-9af1-4ca6-b8d8-ebf39043dff3';
    $display->content['new-722dc294-9af1-4ca6-b8d8-ebf39043dff3'] = $pane;
    $display->panels['bottom'][0] = 'new-722dc294-9af1-4ca6-b8d8-ebf39043dff3';
    $pane = new stdClass();
    $pane->pid = 'new-4a46c413-3d4e-494a-a5db-e3f4e5193639';
    $pane->panel = 'center';
    $pane->type = 'block';
    $pane->subtype = 'views-new_services-block';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 0,
      'override_title_text' => 'Newly Launched',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 0;
    $pane->locks = array();
    $pane->uuid = '4a46c413-3d4e-494a-a5db-e3f4e5193639';
    $display->content['new-4a46c413-3d4e-494a-a5db-e3f4e5193639'] = $pane;
    $display->panels['center'][0] = 'new-4a46c413-3d4e-494a-a5db-e3f4e5193639';
    $pane = new stdClass();
    $pane->pid = 'new-1449ee69-dd6d-4d1d-8977-4ac254b6c53c';
    $pane->panel = 'search_region';
    $pane->type = 'block';
    $pane->subtype = 'addthis-addthis_block';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 0,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 0;
    $pane->locks = array();
    $pane->uuid = '1449ee69-dd6d-4d1d-8977-4ac254b6c53c';
    $display->content['new-1449ee69-dd6d-4d1d-8977-4ac254b6c53c'] = $pane;
    $display->panels['search_region'][0] = 'new-1449ee69-dd6d-4d1d-8977-4ac254b6c53c';
    $pane = new stdClass();
    $pane->pid = 'new-e144715f-d0aa-4a2f-a9cd-c264c30148d5';
    $pane->panel = 'service_view';
    $pane->type = 'block';
    $pane->subtype = 'views-f536433d85f230810e9503fb543a57d3';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 1,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 0;
    $pane->locks = array();
    $pane->uuid = 'e144715f-d0aa-4a2f-a9cd-c264c30148d5';
    $display->content['new-e144715f-d0aa-4a2f-a9cd-c264c30148d5'] = $pane;
    $display->panels['service_view'][0] = 'new-e144715f-d0aa-4a2f-a9cd-c264c30148d5';
  $display->hide_title = PANELS_TITLE_FIXED;
  $display->title_pane = '0';
  $handler->conf['display'] = $display;
  $page->default_handlers[$handler->name] = $handler;
  $pages['default_frontpage'] = $page;

  $page = new stdClass();
  $page->disabled = FALSE; /* Edit this to true to make a default page disabled initially */
  $page->api_version = 1;
  $page->name = 'incredible_store_front';
  $page->task = 'page';
  $page->admin_title = 'Incredible Store Front';
  $page->admin_description = 'Incredible Store Front';
  $page->path = 'incrediblefront';
  $page->access = array();
  $page->menu = array();
  $page->arguments = array();
  $page->conf = array(
    'admin_paths' => FALSE,
  );
  $page->default_handlers = array();
  $handler = new stdClass();
  $handler->disabled = FALSE; /* Edit this to true to make a default handler disabled initially */
  $handler->api_version = 1;
  $handler->name = 'page_incredible_store_front_panel_context';
  $handler->task = 'page';
  $handler->subtask = 'incredible_store_front';
  $handler->handler = 'panel_context';
  $handler->weight = 0;
  $handler->conf = array(
    'title' => 'Panel',
    'no_blocks' => 0,
    'pipeline' => 'ipe',
    'body_classes_to_remove' => '',
    'body_classes_to_add' => '',
    'css_id' => '',
    'css' => '',
    'contexts' => array(),
    'relationships' => array(),
  );
  $display = new panels_display();
  $display->layout = 'onecol';
  $display->layout_settings = array();
  $display->panel_settings = array(
    'style_settings' => array(
      'default' => NULL,
      'top' => NULL,
      'left' => NULL,
      'right' => NULL,
      'bottom' => NULL,
      'middle' => NULL,
    ),
  );
  $display->cache = array();
  $display->title = 'Application Marketplace';
  $display->uuid = '374c8f0f-c029-45de-a33b-87ae9978607e';
  $display->content = array();
  $display->panels = array();
    $pane = new stdClass();
    $pane->pid = 'new-a12755e9-1d6c-4ed1-bb2a-d29983640425';
    $pane->panel = 'middle';
    $pane->type = 'block';
    $pane->subtype = 'views-servicesbanner-block';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 1,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
      'style' => 'rounded_corners',
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 0;
    $pane->locks = array();
    $pane->uuid = 'a12755e9-1d6c-4ed1-bb2a-d29983640425';
    $display->content['new-a12755e9-1d6c-4ed1-bb2a-d29983640425'] = $pane;
    $display->panels['middle'][0] = 'new-a12755e9-1d6c-4ed1-bb2a-d29983640425';
    $pane = new stdClass();
    $pane->pid = 'new-288b8cf2-5bd8-4f90-89fd-b6f3bffb1d70';
    $pane->panel = 'middle';
    $pane->type = 'block';
    $pane->subtype = 'views-popular_services-block';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 0,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
      'style' => 'stylizer:panelbox',
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 1;
    $pane->locks = array();
    $pane->uuid = '288b8cf2-5bd8-4f90-89fd-b6f3bffb1d70';
    $display->content['new-288b8cf2-5bd8-4f90-89fd-b6f3bffb1d70'] = $pane;
    $display->panels['middle'][1] = 'new-288b8cf2-5bd8-4f90-89fd-b6f3bffb1d70';
    $pane = new stdClass();
    $pane->pid = 'new-59d3e434-1806-406b-8400-0d2b0e921971';
    $pane->panel = 'middle';
    $pane->type = 'block';
    $pane->subtype = 'views-dd935fdb6810c6e8f0c351b2eb78fcad';
    $pane->shown = TRUE;
    $pane->access = array();
    $pane->configuration = array(
      'override_title' => 0,
      'override_title_text' => '',
    );
    $pane->cache = array();
    $pane->style = array(
      'settings' => NULL,
      'style' => 'stylizer:panelbox',
    );
    $pane->css = array();
    $pane->extras = array();
    $pane->position = 2;
    $pane->locks = array();
    $pane->uuid = '59d3e434-1806-406b-8400-0d2b0e921971';
    $display->content['new-59d3e434-1806-406b-8400-0d2b0e921971'] = $pane;
    $display->panels['middle'][2] = 'new-59d3e434-1806-406b-8400-0d2b0e921971';
  $display->hide_title = PANELS_TITLE_FIXED;
  $display->title_pane = '0';
  $handler->conf['display'] = $display;
  $page->default_handlers[$handler->name] = $handler;
  $pages['incredible_store_front'] = $page;

  return $pages;

}
