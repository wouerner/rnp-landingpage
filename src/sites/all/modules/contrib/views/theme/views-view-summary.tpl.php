<?php

/**
 * @file
 * Default simple view template to display a list of summary lines.
 *
 * @ingroup views_templates
 */
?>
<div class="item-list">
  <ul class="views-summary">
  <?php foreach ($rows as $id => $row): ?>
    <li>
    	<li class="list_wrapper">
	    	<a href="<?php print $row->url; ?>"<?php print !empty($row_classes[$id]) ? ' class="'. $row_classes[$id] .'"' : ''; ?>><?php print $row->link; ?></a>
	      <?php if (!empty($options['count'])): ?>
	        (<?php print $row->count?>)
	      <?php endif; ?>
      	</li>
    </li>
  <?php endforeach; ?>
  </ul>
</div>
