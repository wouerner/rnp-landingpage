<?php
/**
 * @file
 * Basic cart shopping cart html template
 */
?>

<?php if (empty($cart)): ?>
    <div class="basic-cart-cart basic-cart-grid">
        <div style="width:100%">
          <table cellspacing="0" id="shoppingCartTableHeader" class="tblShoppingCart">
            <tbody>
              <tr>
                <td class="alignLeft header"><?php print t('Item Details'); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="basic-cart-cart-contents row"><?php print t('Your shopping cart is empty.'); ?></div>
        <div style="margin-top:14px;" class="cell package-buy">
              <?php print l(t('CONTINUE SHOPPING'), 'catalog', array('attributes' => array('class' => 'btn btn-primary'))); ?>          
        </div>
    </div>
<?php else: ?>

  <div class="basic-cart-cart basic-cart-grid">
        <div style="margin:0; width:100%">
          <table cellspacing="0" id="shoppingCartTableHeader" class="tblShoppingCart">
            <tbody>
              <tr>
                <td class="alignLeft header paddingBoth-10 paddingLeft-10"><?php print t('Item Details'); ?></td>
              </tr>
            </tbody>
          </table>
        </div>
    <?php if(is_array($cart) && count($cart) >= 1): ?>
      <?php foreach($cart as $nid => $node): ?>
        <div class="basic-cart-cart-contents row">
            <div style="margin:0; width:100%">
                <div class="basic-cart-cart-node-title"><strong><?php print  t($node->basic_cart_node_offername); ?></strong></div>
                <div class="basic-cart-delete-image cartLogoDiv">
                    <?php
                    if($node->type == 'service_family'){
                        $field_logo = file_create_url($node->field_service_family_logo['und'][0]['uri']);
                    }else{
                        $field_logo = file_create_url($node->field_logo['und'][0]['uri']);
                    }
                    ?>
                    <img class="img-responsive center-block" src="<?php print $field_logo; ?>" alt="logo">
                </div>
            </div>
            <div class="basic-cart-cart-node-remove floatLeft marginRight-5"><?php print  l(t('Remove'), 'jsdncart/remove/' . $nid, array('html' => TRUE)); ?> </div>
            
        </div>
      <?php endforeach; ?>
   </div> 
   <div class="basic-cart-cart basic-cart-grid basic-cart-footer">
      <div class="basic-cart-cart-total-price-contents">
        <div class="basic-cart-checkout-button cell package-trial orange-bg">
          <?php print l(t('Proceed'), '#', array('attributes' => array('class' => 'btn-primary btn ctools-use-modal ctools-modal-modal-popup-medium','data-toggle' => 'modal', 'data-target' => '#loginPopUp'))); ?>
        </div>
        <div class="basic-cart-proceed-button cell package-buy">
         <?php print l(t('Continue Shopping'), 'catalog', array('attributes' => array('class' => 'btn btn-primary'))); ?>          
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
