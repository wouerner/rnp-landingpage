<?php

/**
 * @file
 * homebox.tpl.php
 * Default layout for homebox.
 */
?>
<?php global $user; ?>
<div id="homebox" class="<?php print $classes ?> clearfix">
<!--	<h1 id='pagetitle' class='title homeboxPageTitle'>
		/**<?php print drupal_get_title(); ?>*/
	</h1>
-->
  <?php if ($user->uid): ?>
    <div id="homebox-buttons">
      <?php if (!empty($add_links)): ?>
        <a href="javascript:void(0)" id="homebox-add-link"><?php print t('Add New Widget') ?></a>
      <?php endif; ?>
      <?php print $save_form; ?>
    </div>
	<div class="clear"></div>
  <?php endif; ?>

  <?php if (!empty($add_links)): ?>
    <div id="homebox-add"><?php print $add_links; ?></div>
  <?php endif; ?>

  <div class="homebox-maximized"></div>
  <?php for ($i = 1; $i <= count($regions); $i++): ?>
    <div class="homebox-column-wrapper homebox-column-wrapper-<?php print $i; ?> homebox-row-<?php print $page->settings['rows'][$i]; ?>"<?php print $page->settings['widths'][$i] ? ' style="width: ' . $page->settings['widths'][$i] . '%;"' : ''; ?>>
      <div class="homebox-column" id="homebox-column-<?php print $i; ?>">
        <?php foreach ($regions[$i] as $key => $weight): ?>
          <?php foreach ($weight as $block): ?>
            <?php if ($block->content): ?>
              <?php print theme('homebox_block', array('block' => $block, 'page' => $page)); ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endfor; ?>
</div>
