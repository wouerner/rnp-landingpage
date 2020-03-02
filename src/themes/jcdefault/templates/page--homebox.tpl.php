<?php
die('homebox');
global $_domain;
$roleName = json_decode($_SESSION['MenuJSON'])->profile->roleName;
$currencyLocale = json_decode($_SESSION['MenuJSON'])->profile->currencyLocale;
$menuPosition = variable_get('menu_position');
?>
<?php if ($messages): ?>
  <div class="container-fluid text-center">
	<div class="section clearfix">
	  <?php print $messages; ?>
	</div>
  </div>
<?php endif; ?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart', 'table'],'language': <?php echo $currencyLocale; ?>}]}"></script>


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
	<?php if ($logged_in) : ?>
		<?php print '<div id="breadcrumb"><div class="breadcrumb"></div></div>' ?>
	<?php endif; ?>
  <div class="bg-3 clearfix jsdndashboard-page <?php if(arg(1) == 'inventory'){?>inventoryPage<?php } elseif(arg(1) == 'migration'){?>migrationPage<?php }?>">
    <div  class="clearfix jsdndashboard">
      <div class="dashboard-left-side">
          <div id="sidebar-first" class="column sidebar jsdndashboard-side-menu">
                <?php
                 if(arg(1) != 'saas') {
                    $menu = menu_navigation_links('menu-dashboard-overview');
                    print theme('links__menu_dashboard_overview', array('links' => $menu));
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
          <img src="/cms/themes/jcdefault/images/info-icon.png" class="info-icon"  />
          <?php if(arg(1) != 'inventory' &&  arg(1) != 'saas' && arg(1) != 'recommendation' && arg(1) != 'migration') {?>
          <span class="updatedtime"><?php print t('Last Updated On');?>: <span class="sessionTime"></span></span>
          <?php } ?>
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

<?php $dateformat = json_decode($_SESSION['MenuJSON'])->locale->dateformat; ?>
<script type="text/javascript">
	var sessionUpdateTime="<?php echo $_SESSION['LastUpdatedDate']; ?>";
	var dateformat = "<?php echo $dateformat; ?>";
	dateformat=dateformat.toUpperCase();
	if (sessionUpdateTime=='' || sessionUpdateTime=='null'){
            jQuery(".updatedtime").hide();
	}
	else if(typeof moment !== "undefined"){
		sessionUpdateTime=moment.utc(sessionUpdateTime,'ddd MMM DD HH:mm:ss YYYY').utcOffset(timeoffset).format(''+dateformat+', HH:mm:ss');
		jQuery('.sessionTime').html(sessionUpdateTime);
	}

   var value = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
   if(value=="summary"){
      var infoMsg="<div><?php print t('The Executive Dashboard tracks key cloud trends such as costs and resources in order to help customer oversee all of their cloud costs centrally.');?><br><br><i><?php print t('All costs displayed in this dashboard are excluding taxes (if any).');?></i><br><b><?php print t('For more details, refer to the');?> <a class='jsdnHelp' url='topic/executive-dashboard.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section');?></b></div>";
   }else if(value=="products"){
      var infoMsg="<div><div><?php print t('To get the most out of your spending data, this dashboard allows you to drill deeper into the costs based on different parameters and help you provide further information to enable you to optimize the size, spend and scale of your cloud deployments.');?><br><br><i><?php print t('All costs displayed in this dashboard are excluding taxes (if any).');?></i><br><b><?php print t('For more details, refer to the');?> <a class='jsdnHelp' url='topic/cost-analytics.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section') ?></b></div></div>";
    }else if(value=="tags"){
       var infoMsg="<div><div><?php print t("Tag-based cost allocation involves analysing and associating the costs with specific categories (e.g. department, project, cost centre ) to provide detailed cost visibility and ensure governance. Once a resource is tagged either in the providers' console or from the Cloud Management Platform, the cost associated with this resource is reported by this tag. This enables you to organize your resources in a way that is independent of the deployment relationships.");?><br><br><i><?php print t('Only resources that are tagged are considered. Resources that are not Tagged are excluded.');?></i><br><i><?php print t("Server metadata or Resource metadata information captured using the providers' tagging functionality is also excluded from this report");?></i><br><i><?php print t('All costs displayed in this dashboard are excluding taxes (if any).');?></i><br><b><?php print t("For more details, refer to the");?> <a class='jsdnHelp' url='topic/tag-analytics.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section');?></b></div></div>";
    }else if(value=="inventory" || value=="instances"){
       var infoMsg="<div><div><?php print t('IaaS resources is a list of all resources (account level) being used by your company from different providers.');?></div></div>";
    }else if(value=="saas" || value=="saas#"){
       var infoMsg="<div><div><?php print t("SaaS Dashboard is a dashboard with extensive information on utilization of SaaS resources. Ample information is represented in a graphical format in terms of cost, order status, license status etc. to help you visualize the previous and current utility and expenses involved with each of the resources.");?><br><br><i><?php print t('All costs displayed in this dashboard are excluding taxes (if any).');?></i><br><i><?php print t("Cost of a particular will reflect in the cost related widgets if an invoice for the same has been generated within the system");?></i><br><i><?php print t('Cost of service(s) shown in the graphs under SaaS Dashboard will be zero when the service is offered with 100% discounts/ promotions. This is applicable to all cost related widgets.');?></i><br><b><?php print t("For more details, refer to the");?> <a class='jsdnHelp' url='topic/saas-dashboard.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section');?></b></div></div>";
    }else if(value=="microsoft-ea"){
       var infoMsg="<div><?php print t('This page displays the cost aggregated based on the Departments or Accounts or Subscriptions for a Microsoft Enterprise Agreement.');?><br><b><?php print t('For more details, refer to the');?> <a class='jsdnHelp' url='topic/microsoft-ea.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section');?></b></div>";
    }else if(value=="recommendation" || value=="recommendation#"){
       var infoMsg="<div><div><?php print t('Optimize your cloud cost with these recommendations by resizing or terminating underutilized resources.');?></div></div>";
    }else if(value=="migration" || value=="migration#"){
       var infoMsg="<div><?php print t('Migration dashboard provides insights into your private cloud usage and cost, side by side with your public cloud usage and cost. Migration dashboard enables you to quickly track, analyze and plan your data center migration.');?><br><b><?php print t('For more details, refer to the');?> <a class='jsdnHelp' url='topic/cloud-migration.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section');?></b></div>";
    }else if(value=="reservation" || value=="reservation#"){
       var infoMsg="<div><?php print t('Reservation is a dashboard with extensive information on utilization of reserved instances. Ample information is represented in a graphical format in terms of cost, count, usage etc. to help you visualize the previous, current utility along with expenses involved with each of the reserved resources.');?><br><b><?php print t('For more details, refer to the');?> <a class='jsdnHelp' url='topic/reservation.html' onclick='openHelp(this);'><?php print t('Help');?></a> <?php print t('section');?></b></div>";
    }

    jQuery('.info-icon').bt(infoMsg,{ fill: '#fff',strokeStyle:'#B7B7B7',spikeLength: 10,spikeGirth: 10,padding: 8,cornerRadius: 0,trigger: 'click',positions: ['right','bottom'],cssStyles:{width:'500px'},closeWhenOthersOpen:true});
</script>
