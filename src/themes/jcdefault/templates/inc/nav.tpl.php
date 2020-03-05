<nav class="navbar">
  <div class="container header-section">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <?php if (!$logged_in): ?>
          <a class="navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <?php else: ?>
          <a class="navbar-brand" href="/jsdn/dashboard/dashboardHome.action" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <?php endif; ?>
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
		<?php if (!$domain_is_store): ?>
			<?php include(drupal_get_path('theme', 'jcdefault').'/templates/inc/cart_icon.tpl.php'); ?>
		<?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($page['header_top_right_cubo']): ?>
      <?php print render($page['header_top_right_cubo']); ?>
    <?php endif; ?>
  </div>
</nav>
