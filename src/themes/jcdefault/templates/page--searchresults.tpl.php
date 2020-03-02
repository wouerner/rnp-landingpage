<?php
die('searchresults');
global $_domain;
$roleName = json_decode($_SESSION['MenuJSON'])->profile->roleName;
?>
<div id="page-wrapper"><div id="page">
  <div id="headerTop">





  <div class="section clearfix">
    <div class="logo">    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?></div>
	<div class="headerRightDiv">
		<?php if ($page['header_top_left']): ?>
		  <div id="headerTop-Left" class="headerTopLeft region-header">
			<?php print render($page['header_top_left']); ?>
		  </div>
		<?php endif; ?>
	  <?php if ($logged_in) : ?>
        <div class="navbar-nav navbar-right padding-0">
         <a href="<?php echo $jsdnURL ?>/jsdn/users/myProfile.action?brdcrm=new" class="profileLink"><div class="lprofile"><span class="uname"><?php echo strlen($_SESSION['username']) > 25 ? substr($_SESSION['username'], 0, 25) . '..' : $_SESSION['username']; ?></span><span class="urole"><?php echo $roleName; ?></span></div></a>
        </div>
	  <?php endif; ?>
		<?php if ($page['header_top_right']): ?>
		  <div id="headerTop-Right" class="headerTopRight region-header">
			<?php print render($page['header_top_right']); ?>
      <?php include(drupal_get_path('theme', 'jcdefault').'/templates/inc/cart_icon.tpl.php'); ?>
		  </div>
		<?php endif; ?>
  </div>
  </div>
  <a id="responsive-menu-button" href="#" class="menu-button">Menu</a>
  </div>
  <div id="header" class=""><div class="section clearfix">



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

  <?php if ($messages): ?>
    <div id="messages"><div class="section clearfix">
      <?php print $messages; ?>
    </div></div> <!-- /.section, /#messages -->
  <?php endif; ?>

  <div class="bannerContainer">

  <?php if ($page['main_banner']): ?>
    <div id="mainBanner"><div class="section clearfix">
      <?php print render($page['main_banner']); ?>
    </div></div> <!-- /.section, /#Main Banner -->
  <?php endif; ?>

  </div>



    <?php if ($breadcrumb): ?>
      <div id="breadcrumb"><?php print $breadcrumb; ?></div>
    <?php endif; ?>

	  <?php if ($page['featured']): ?>
    <div class="section clearfix">
      <?php print render($page['featured']); ?>
    </div> <!-- /.section, /#featured -->
  <?php endif; ?>

  <div id="main-wrapper" class="clearfix innerPageWrapper"><div id="main" class="clearfix">

    <?php if ($page['sidebar_first'] or $page['sidebar_first_head']): ?>
      <div id="sidebar-first" class="column sidebar">

		  <div class="section topBlock">
			<?php print render($page['sidebar_first_head']); ?>
		  </div>


		  <div class="section facetsBar">
			<?php print render($page['sidebar_first']); ?>
		  </div>
	  </div> <!-- /.section, /#sidebar-first -->
    <?php endif; ?>

    <div id="content" class="column"><div class="section">
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <!-- <?php if (!$is_front): ?>
	  <?php if ($title): ?>
        <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
      <?php endif; ?>
	  <?php endif; ?>
	  -->
      <?php print render($title_suffix); ?>
      <?php if (!$is_front): ?>
	  <?php if ($tabs): ?>
        <div class="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>
	  <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>

    </div></div> <!-- /.section, /#content -->

    <?php if ($page['sidebar_second']): ?>
      <div id="sidebar-second" class="column sidebar"><div class="section">
        <?php print render($page['sidebar_second']); ?>
      </div></div> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>

  </div></div> <!-- /#main, /#main-wrapper -->

  <?php if ($page['triptych_first'] || $page['triptych_middle'] || $page['triptych_last']): ?>
    <div id="triptych-wrapper"><div id="triptych" class="clearfix">
      <?php print render($page['triptych_first']); ?>
      <?php print render($page['triptych_middle']); ?>
      <?php print render($page['triptych_last']); ?>
    </div></div> <!-- /#triptych, /#triptych-wrapper -->
  <?php endif; ?>

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

</div></div> <!-- /#page, /#page-wrapper -->
