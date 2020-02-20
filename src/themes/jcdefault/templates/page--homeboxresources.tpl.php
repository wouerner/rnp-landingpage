<?php
/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
$menuPosition = variable_get('menu_position');
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart', 'table']}]}"></script>
<nav class="navbar">
  <div class="messages"></div>
  <div class="container-fluid header-section">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <?php if (!$logged_in) { ?>
			<a class="navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
		<?php  }  else { ?>
			<a class="navbar-brand" href="/jsdn/dashboard/dashboardHome.action" title="<?php print t('Home'); ?>" rel="home" id="logo">
		<?php } ?>
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <?php if ($page['header_top_left']): ?>
        <div class="navbar-nav navbar-left">
          <?php print render($page['header_top_left']); ?>
        </div> 
      <?php endif; ?>
      <?php if ($page['header_top_right']): ?>
        <div class="navbar-nav navbar-right">
        <?php print render($page['header_top_right']); ?>
        <?php include(drupal_get_path('theme', 'jcdefault').'/templates/inc/cart_icon.tpl.php'); ?>
        </div> 
      <?php endif; ?>
    </div> 
  </div>
</nav> 
<a id="responsive-menu-button" href="#" class="menu-button">Menu</a>
<?php if($menuPosition == "vertical"):?>
  <div id="verticalDiv">
    <div class="vertical-left">
      <div id="header"><div class="section clearfix">
        <?php print render($page['header']); ?>
        <?php if ($main_menu): ?>
          <div id="main-menu" class="navigation">
            <?php print theme('links__system_main_menu', array(
              'links' => $main_menu,
              'attributes' => array(
                'id' => 'main-menu-links',
                'class' => array('links', 'clearfix'),
              ),
              'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          </div> <!-- /#main-menu -->
        <?php endif; ?>
      </div></div> <!-- /.section, /#header -->
    </div>
    <div class="vertical-right">
<?php endif;?>
<div class="jumbotron" id="mainWrapper">
  <?php if ($site_name || $site_slogan): ?>
      <div id="name-and-slogan"<?php if ($hide_site_name && $hide_site_slogan) { print ' class="element-invisible"'; } ?>>

        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
              <strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </strong>
            </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>>
            <?php print $site_slogan; ?>
          </div>
        <?php endif; ?>

      </div> <!-- /#name-and-slogan -->
    <?php endif; ?>   
    <?php if ($messages): ?>
      <div class="container-fluid text-center">
        <div class="section clearfix">
          <?php print $messages; ?>
        </div>
      </div> <!-- /.section, /xmessages -->
    <?php endif; ?>
    <?php if ($page['featured']): ?>
    <div class="featured-section clearfix">
      <?php print render($page['featured']); ?>
    </div> <!-- /.section, /#featured -->
  <?php endif; ?>
  <?php if($menuPosition == "horizontal" || $menuPosition == ""):?>
    <div id="header"><div class="section clearfix">
      <?php print render($page['header']); ?>
      <?php if ($main_menu): ?>
        <div id="main-menu" class="navigation">
          <?php print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'id' => 'main-menu-links',
              'class' => array('links', 'clearfix'),
            ),
            'heading' => array(
              'text' => t('Main menu'),
              'level' => 'h2',
              'class' => array('element-invisible'),
            ),
          )); ?>
        </div> <!-- /#main-menu -->
      <?php endif; ?>
    </div></div> <!-- /.section, /#header -->
  <?php endif;?>
  <?php if ($logged_in) : ?> 
    <?php print '<div id="breadcrumb"><div class="breadcrumb">' ?>
    <?php print '</div></div>';?>
  <?php endif; ?>   
  <div class="container-fluid text-center content-section">
      <?php if ($page['search_block']): ?>
        <div class="container-fluid text-center search-section">
        <?php print render($page['search_block']); ?>
        </div> 
      <?php endif; ?>
        <?php if ($page['main_banner']): ?>
        <div id="mainBanner"><div class="section clearfix">
          <?php print render($page['main_banner']); ?>
        </div></div> <!-- /.section, /#Main Banner -->
        <?php endif; ?>
  </div>
  <div class="bg-3 clearfix resourcesummary-page <?php if(arg(1) == 'inventory'){?>inventoryPage<?php } elseif(arg(1) == 'migration'){?>migrationPage<?php }?>">    
    <div  class="clearfix jsdndashboard">
      <div class="dashboard-left-side"> 
          <div id="sidebar-first" class="column sidebar jsdndashboard-side-menu">
                <?php 
                 if(arg(1) != 'saas' && arg(0) != 'resource-summary' && arg(0) != 'resource'){
                    $menu = menu_navigation_links('menu-dashboard-overview');
                    print theme('links__menu_dashboard_overview', array('links' => $menu)); 
                 }
                 elseif(arg(0) != 'resource-summary' && arg(0) != 'resource'){
                    $menu = menu_navigation_links('menu-dashboard-saas');
                    print theme('links__menu_dashboard_saas', array('links' => $menu)); 
                 }
                ?>
          </div> <!-- /.section, /#sidebar-first -->
      </div>
  <div class="dashboard-right-side"> 
    <div class="column"><div class="section">
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>

   <div class="titleDiv">
    <?php if ($title): ?>
       
        <h1 class="title" id="page-title">
          <?php print t($title); ?>
        </h1>

    <?php endif; ?>

    <?php if ($page['dashboard_filter']): ?>
      <div class="dashboardFilter">
        <?php print render($page['dashboard_filter']); ?>
      </div>
    <?php endif; ?>
    </div>
    <?php if(arg(1) == 'inventory'): ?>
    <div class="section_inventory">
        <?php $menu = menu_navigation_links('menu-dashboard-inventory');
        print theme('links__menu_dashboard_inventory', array('links' => $menu)); 
        ?>
    </div> 
    <?php endif; ?>
      <?php print render($title_suffix); ?>   
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
   
    <?php if ($page['dashboard_left']): ?>
       <div class="dashboardLeft">
    <?php print render($page['dashboard_left']); ?>
       </div>
    <?php endif; ?>
    <?php if ($page['resource_details']): ?>
       <div class="resource_details">
    <?php print render($page['resource_details']); ?>
       </div>
    <?php endif; ?>
    <?php print render($page['content']); ?>

    <?php print $feed_icons; ?>
    </div></div> <!-- /.section, /#content -->
  <div class="clear"></div>
  </div>
    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-second" class="column sidebar"><div class="section">
        <?php print render($page['sidebar_second']); ?>
      </div></div> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>
  </div>
  </div>
</div>
<?php if($menuPosition == "vertical"):?>
    </div>
</div>
<?php endif;?>

<footer class="container-fluid text-center">
   <div id="footer-wrapper"><div class="section">
    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
      <div id="footer-columns" class="clearfix">
        <?php print render($page['footer_firstcolumn']); ?>
        <?php print render($page['footer_secondcolumn']); ?>
        <?php print render($page['footer_thirdcolumn']); ?>
        <?php print render($page['footer_fourthcolumn']); ?>
      </div> <!-- /#footer-columns -->
    <?php endif; ?>
  
  <?php if ($page['footer_left']): ?>
      <div id="footerLeft">
        <?php print render($page['footer_left']); ?>
      </div> 
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <div id="footer">
        <?php print render($page['footer']); ?>
      </div> <!-- /#footer -->
    <?php endif; ?>
  </div></div>
</footer> 