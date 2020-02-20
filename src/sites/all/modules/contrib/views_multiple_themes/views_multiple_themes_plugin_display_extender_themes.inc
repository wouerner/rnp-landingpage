<?php

/**
 * @file
 * Custom display extender plugin for Views.
 */

/**
 * Views multiple themes plugin class.
 */
class views_multiple_themes_plugin_display_extender_themes extends views_plugin_display_extender {

  /**
   * Default values.
   */
  function options_definition() {
    $options = parent::option_definition();
    $options['vmt_trigger_theme'] = array('default' => '');
    $options['vmt_redirect_display'] = array('default' => '');
    return $options;
  }

  /**
   * Defines where within the Views admin UI the new settings will be visible.
   */
  function options_summary(&$categories, &$options) {
    $categories['vmt_themes'] = array(
      'title' => t('Themes'),
      'column' => 'second',
    );

    $trigger_theme = check_plain($this->display->get_option('vmt_trigger_theme'));
    $options['vmt_trigger_theme'] = array(
      'category' => 'vmt_themes',
      'title' => t('Trigger theme'),
      'value' => !empty($trigger_theme) ? $trigger_theme : t('Not defined'),
    );

    $redirect_display = check_plain($this->display->get_option('vmt_redirect_display'));
    $options['vmt_redirect_display'] = array(
      'category' => 'vmt_themes',
      'title' => t('Display redirect from'),
      'value' => !empty($redirect_display) ? $redirect_display : t('Not defined'),
    );
  }

  /**
   * Provide the default form for setting options.
   */
  function options_form(&$form, &$form_state) {
    // It is very important to call the parent function here:
    parent::options_form($form, $form_state);

    switch ($form_state['section']) {
      case 'vmt_trigger_theme':
        $form['#title'] .= t('Trigger theme');
        $themes_list = array('' => t('- None -'));

        foreach (list_themes() as $key => $value) {
          // Add enabled themes only.
          if (!empty($value->status)) {
            $themes_list[$key] = $key;
          }
        }

        $form['vmt_trigger_theme'] = array(
          '#type' => 'select',
          '#description' => t('Select which theme this should trigger.'),
          '#options' => $themes_list,
          '#default_value' => $this->display->get_option('vmt_trigger_theme'),
        );
        break;

      case 'vmt_redirect_display':
        $form['#title'] .= t('Display redirect');
        $displays = array('' => t('- None -'));
        $excludes_display = array($this->display->view->current_display, 'default');
        $current_display_plugin = $this->view->display[$this->display->view->current_display]->display_plugin;

        foreach ($this->view->display as $display_id => $display) {
          // Add to list for the same display_plugin (page, block, ...)
          // and except current display and master display.
          if (!in_array($display_id, $excludes_display)
            && $display->display_plugin == $current_display_plugin
            && !empty($display->handler) && $display->handler->accept_attachments()) {
              $displays[$display_id] = "($display_id) {$display->display_title}";
          }
        }

        $form['vmt_redirect_display'] = array(
          '#type' => 'select',
          '#description' => t('Select which display this should attach to for redirect.'),
          '#options' => $displays,
          '#default_value' => $this->display->get_option('vmt_redirect_display'),
        );
        break;
    }
  }

  /**
   * Perform any necessary changes to the form values prior to storage.
   */
  function options_submit(&$form, &$form_state) {
    // It is very important to call the parent function here:
    parent::options_submit($form, $form_state);

    switch ($form_state['section']) {
      case 'vmt_trigger_theme':
      case 'vmt_redirect_display':
        $this->display->set_option($form_state['section'], $form_state['values'][$form_state['section']]);
        break;
    }
  }

  /**
   * Destroy object.
   */
  function destroy() {
      parent::destroy();
  }

}
