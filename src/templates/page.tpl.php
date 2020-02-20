<?php
global $_domain;
$roleName = json_decode($_SESSION['MenuJSON'])->profile->roleName;
$menuPosition = variable_get('menu_position'); ?>
    <?php if ($messages): ?>
    <div class="text-center">
      <div class="section clearfix">
        <?php print $messages; ?>
      </div>
    </div> <!-- /.section, /xmessages -->
  <?php endif; ?>
  
<nav class="navbar">
  <div class="container-fluid header-section">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <a class="navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
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
  <div class="innerPage bg-3 <?php echo $node->type;?> <?php if($node->type =="product" && $node->nid){echo 'product-'.$node->nid;}?>">   
    <?php if($node->type != "product"){
          if ($title): ?>
        <h1 class="title" id="page-title">
          <?php print t($title); ?>
        </h1>
      <?php endif; ?>
    <?php } ?> 
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
<?php include(drupal_get_path('theme', 'jcdefault').'/templates/footer.tpl.php'); ?>