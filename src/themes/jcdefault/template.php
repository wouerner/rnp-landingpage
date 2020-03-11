<?php

/**
 * Add body classes if certain regions have content.
 */
function jcdefault_preprocess_html(&$variables) {
  if (!empty($variables['page']['featured'])) {
    $variables['classes_array'][] = 'featured';
  }

  if (!empty($variables['page']['triptych_first'])
    || !empty($variables['page']['triptych_middle'])
    || !empty($variables['page']['triptych_last'])) {
    $variables['classes_array'][] = 'triptych';
  }

  if (!empty($variables['page']['footer_firstcolumn'])
    || !empty($variables['page']['footer_secondcolumn'])
    || !empty($variables['page']['footer_thirdcolumn'])
    || !empty($variables['page']['footer_fourthcolumn'])) {
    $variables['classes_array'][] = 'footer-columns';
  }

if(!empty($variables['page']['header']['jsdn_common_render_menu']) && (!empty(variable_get('menu_position') && variable_get('menu_position') == "vertical" )) ) {
	$variables['classes_array'][] = 'hasLeftMenu';
}
if(!empty($variables['page']['header']['jsdn_common_render_menu']) && (!empty(variable_get('menu_position') && variable_get('menu_position') == "horizontal" )) ) {
  $variables['classes_array'][] = 'hasTopMenu';
}

  // Add conditional stylesheets for IE
  drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
  drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));

  drupal_add_css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array('type' => 'external'));
  drupal_add_css('https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css', array('type' => 'external'));

  /* drupal_add_css( */
  /*   path_to_theme() . '/css/bootstrap.4.css' */
  /* ); */

  // icons vuetify
  drupal_add_css('https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css', array('type' => 'external'));
}
/**
 * login form placeholder
 */
function jcdefault_form_alter( &$form, &$form_state, $form_id )
{
    if (in_array( $form_id, array( 'user_login', 'user_login_block')))
    {
        $form['name']['#title_display'] = 'invisible';
        $form['pass']['#title_display'] = 'invisible';
        $form['name']['#attributes']['placeholder'] = t( 'Username' );
        $form['pass']['#attributes']['placeholder'] = t( 'Password' );
        $form['name']['#attributes']['class'] = array('form-control');
        $form['pass']['#attributes']['class'] = array('form-control');
      }
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function jcdefault_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Override or insert variables into the page template.
 */
function jcdefault_process_page(&$variables) {




  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
  // Since the title and the shortcut link are both block level elements,
  // positioning them next to each other is much simpler with a wrapper div.
  if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
    // Add a wrapper div using the title_prefix and title_suffix render elements.
    $variables['title_prefix']['shortcut_wrapper'] = array(
      '#markup' => '<div class="shortcut-wrapper clearfix">',
      '#weight' => 100,
    );
    $variables['title_suffix']['shortcut_wrapper'] = array(
      '#markup' => '</div>',
      '#weight' => -99,
    );
    // Make sure the shortcut link is the first item in title_suffix.
    $variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
  }
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function jcdefault_preprocess_maintenance_page(&$variables) {
  // By default, site_name is set to Drupal if no db connection is available
  // or during site installation. Setting site_name to an empty string makes
  // the site and update pages look cleaner.
  // @see template_preprocess_maintenance_page
  if (!$variables['db_is_active']) {
    $variables['site_name'] = '';
  }
  drupal_add_css(drupal_get_path('theme', 'jcdefault') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function jcdefault_process_maintenance_page(&$variables) {
  // Always print the site name and slogan, but if they are toggled off, we'll
  // just hide them visually.
  $variables['hide_site_name']   = theme_get_setting('toggle_name') ? FALSE : TRUE;
  $variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
  if ($variables['hide_site_name']) {
    // If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
    $variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
  }
  if ($variables['hide_site_slogan']) {
    // If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
    $variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
  }
}

/**
 * Override or insert variables into the node template.
 */
function jcdefault_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
}

/**
 * Override or insert variables into the block template.
 */
function jcdefault_preprocess_block(&$variables) {
  // In the header region visually hide block titles.
  if ($variables['block']->region == 'header') {
    $variables['title_attributes_array']['class'][] = 'element-invisible';
  }
}

/**
 * Implements theme_menu_tree().
 */
function jcdefault_menu_tree($variables) {
  return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function jcdefault_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
  }

  // Render the items.
  $output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  foreach ($variables['items'] as $delta => $item) {
    $output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  }
  $output .= '</ul>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '"' . $variables['attributes'] .'>' . $output . '</div>';

  return $output;
}
function jcdefault_form_comment_form_alter(&$form, &$form_state, &$form_id) {
  $form['comment_body']['#after_build'][] = '_jcdefault_customize_comment_form';
}

function _jcdefault_customize_comment_form(&$form) {
  $form[LANGUAGE_NONE][0]['format']['#access'] = FALSE;
  return $form;
}
function jcdefault_preprocess_page(&$vars, $hook) {
  if (isset($vars['node'])) {
  // If the node type is "blog" the template suggestion will be "page--blog.tpl.php".
   $vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', $vars['node']->type);
   $vars['node_id'] = $vars['node']->id;
  }
$url_alias = drupal_get_path_alias($_GET['q']);
$split_url = explode('/', $url_alias);

if (count($split_url) > 1 && $split_url[0]=='dashboard') {
    $vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', 'homebox');
}

if ($split_url[0]=='resource-summary'|| $split_url[0]=='resource' ) {
 $vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', 'homeboxresources');
}
}




/**
* Override video filter display to rewrite url to https
*/
function jcdefault_video_filter_flash($variables) {
  $output = '';

  $video = $variables['video'];
  $params = isset($variables['params']) ? $variables['params'] : array();

  // Rewrite the url to be SSL to eliminate the mixed content warnings
  $video['source'] = preg_replace("/http/", "https", $video['source']);

  // Create classes
  $classes = array(
    'video-filter',
    'video-' . $video['codec']['codec_name'],  // Adds codec name
  );

  // Adds alignment
  if (isset($video['align'])) {
    $classes[] = 'video-' . $video['align'];
  }

  // First match is the URL, we don't want that as a class.
  unset($video['codec']['matches'][0]);
  foreach ($video['codec']['matches'] AS $match) {
    $classes[] = 'vf-' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $match));
  }

  $output .= '<object class="' . implode(' ', $classes) . '" type="application/x-shockwave-flash" ';

  $output .= 'width="' . $video['width'] . '" height="' . $video['height'] . '" data="' . $video['source'] . '">' . "\n";

  $defaults = array(
    'movie' => $video['source'],
    'wmode' => 'transparent',
    'allowFullScreen' => 'true',
  );

  $params = array_merge($defaults, (is_array($params) && count($params)) ? $params : array());

  foreach ($params as $name => $value) {
    $output .= '  <param name="' . $name . '" value="' . $value . '" />' . "\n";
  }

  $output .= '</object>' . "\n";

  return $output;
}
function jcdefault_html_head_alter(&$head_elements) {
  unset($head_elements['system_meta_generator']);
}
