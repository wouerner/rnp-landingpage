<?php
if (!$logged_in) :
  $frontCart = jsdn_cart_get_cart();
?>
  <a href="/cms/en/shoppingcart" class="fa fa-shopping-cart fa-lg">
    <span class="cart_count"><?php echo count($frontCart); ?></span>
  </a>
<?php endif; ?>
