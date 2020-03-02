<?php
die('product_page');
global $_domain;
$roleName = json_decode($_SESSION['MenuJSON'])->profile->roleName;
$menuPosition = variable_get('menu_position');?>
<nav class="navbar">
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
	  <?php if ($logged_in) : ?>
        <div class="navbar-nav navbar-right padding-0">
         <a href="<?php echo $jsdnURL ?>/jsdn/users/myProfile.action?brdcrm=new" class="profileLink"><div class="lprofile"><span class="uname"><?php echo strlen($_SESSION['username']) > 25 ? substr($_SESSION['username'], 0, 25) . '..' : $_SESSION['username']; ?></span><span class="urole"><?php echo $roleName; ?></span></div></a>
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
  <div id="header" class=""><div class="section clearfix">
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
  <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
  <?php endif;  ?>
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
  <div class="bg-3 text-center catalog-listing">
    <?php if ($page['highlighted']): ?>
      <div id="highlighted"><?php print render($page['highlighted']); ?></div>
    <?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?>
      <ul class="action-links">
        <?php print render($action_links); ?>
      </ul>
    <?php endif; ?>
    <?php if ($page['filter_block']): ?>
      <div class="container-fluid text-center filter-section"><?php print render($page['filter_block']); ?></div>
    <?php endif; ?>
    <?php print render($page['content']); ?>
    <?php print $feed_icons; ?>
  </div>
</div>

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
