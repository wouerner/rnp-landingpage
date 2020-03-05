<?php
/* die('page:front'); */
global $_domain;
$roleName = json_decode($_SESSION['MenuJSON'])->profile->roleName;
$menuPosition = variable_get('menu_position');
?>
      <?php if ($messages): ?>
      <div class="text-center">
        <div class="section clearfix">
          <?php print $messages; ?>
        </div>
      </div> <!-- /.section, /xmessages -->
    <?php endif; ?>

<!--inc/nav.tpl.php -->
<?php include(path_to_theme() . '/templates/inc/nav.tpl.php'); ?>
<!--inc/nav.tpl.php -->

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
      <div class="jumbotron bg-white" id="mainWrapper">
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
    <?php if ($page['featured']): ?>
      <div class="featured-section clearfix">
        <?php //print render($page['featured']); ?>
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
<!-- <?php if ($logged_in) : ?>
      <?php print '<div id="breadcrumb"><div class="breadcrumb">' ?>
      <?php print '</div></div>';?>
    <?php endif; ?>  -->
    <div class="container-fluid text-center content-section">
          <?php if ($page['main_banner']): ?>
          <div id="mainBanner"><div class="section clearfix">
            <?php print render($page['main_banner']); ?>
          </div></div> <!-- /.section, /#Main Banner -->
          <?php endif; ?>
    </div>
    <div class="bg-3 text-center">
      <?php if ($page['highlighted']): ?>
        <div id="highlighted"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
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
