<?php
die('enterprise');
global $_domain;
$domain_ad_configure = domain_conf_variable_get($_domain['domain_id'], 'domain_ad_configure');
$logged_in_classes = ($logged_in) ? 'logged-in' : 'not-logged-in';
?>
  <nav class="navbar <?php echo $logged_in_classes;?>">
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
        </div>
      <?php endif; ?>
    </div>
  </div>
</nav>
 <a id="responsive-menu-button" href="#" class="menu-button">Menu</a>
  <div class="jumbotron loginPage" id="mainWrapper">
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

  <div class="innerPage bg-3 text-center <?php echo $node->type;?> <?php if($node->type =="product" && $node->nid){echo 'product-'.$node->nid;}?>">
    <?php if ($page['highlighted']): ?>
      <div id="highlighted"><?php print render($page['highlighted']); ?></div>
    <?php endif; ?>
    <div class="login-section">
      <?php  if(user_is_anonymous()){?>
        <h1><?php print t('Sign In');?></h1>
      <?php  print drupal_render(drupal_get_form('user_login_block')); }
      if (empty($domain_ad_configure) && user_is_anonymous()) { ?>
        <div class="user_login_form_reset_password"><a href="#"><?php print t('Forgot Password?');?></a></div>
      <?php } ?>
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
