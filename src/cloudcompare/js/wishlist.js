function validateFloatKeyPress(el) {
    var v = parseFloat(el.value);
    el.value = (isNaN(v)) ? '' : v.toFixed(0);
}

$(document).ready(function(){           
        //Remove items from cart
    $(".shopping-cart-box").on('click', 'a.remove-item-VM', function(e) {
            e.preventDefault(); 
            var pcode = $(this).attr("data-code"); //get product code
            var product_type = 'VM';
            var provider = $(this).attr("provider-code"); //get provider code
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "addtocart.php", {"remove_code":pcode, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
                $('.wishlistWrapperScroll').jScrollPane();
            });
    });
    
    $(".shopping-cart-box").on('change', 'input.product-item-VM', function(e) {
        e.preventDefault(); 
        var pcode = $(this).attr("data-code"); //get product code
        var provider = $(this).attr("provider-code"); //get provider code
        var pqty = $(this).val(); //get product code
        var product_type = 'VM';
        $.getJSON( "addtocart.php", {"add_product":pcode, "product_qty":pqty, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
				$('.wishlistWrapperScroll').jScrollPane();
        });
    });
    
      //Remove items from cart
    $(".shopping-cart-box").on('click', 'a.remove-item-RDS', function(e) {
            e.preventDefault(); 
            var pcode = $(this).attr("data-code"); //get product code
            var provider = $(this).attr("provider-code"); //get provider code
            var product_type = 'RDS';
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "addtocart.php", {"remove_code":pcode, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
				$('.wishlistWrapperScroll').jScrollPane();
            });
    });
    
    $(".shopping-cart-box").on('change', 'input.product-item-RDS', function(e) {
        e.preventDefault(); 
        var pcode = $(this).attr("data-code"); //get product code
        var provider = $(this).attr("provider-code"); //get provider code
        var pqty = $(this).val(); //get product code
        var product_type = 'RDS';
        $.getJSON( "addtocart.php", {"add_product":pcode, "product_qty":pqty, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
				$('.wishlistWrapperScroll').jScrollPane();
        });
    });
    
        //Remove items from cart
    $(".shopping-cart-box").on('click', 'a.remove-item-ELB', function(e) {
            e.preventDefault(); 
            var pcode = $(this).attr("data-code"); //get product code
            var provider = $(this).attr("provider-code"); //get provider code
            var product_type = 'ELB';
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "addtocart.php", {"remove_code":pcode, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
				$('.wishlistWrapperScroll').jScrollPane();
            });
    });
    
    $(".shopping-cart-box").on('change', 'input.product-item-ELB', function(e) {
        e.preventDefault(); 
        var pcode = $(this).attr("data-code"); //get product code
        var provider = $(this).attr("provider-code"); //get provider code
        var pqty = $(this).val(); //get product code
        var product_type = 'ELB';
        $.getJSON( "addtocart.php", {"add_product":pcode, "product_qty":pqty, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
				$('.wishlistWrapperScroll').jScrollPane();
        });
    });
    
    $(".shopping-cart-box").on('click', 'a.remove-item-STORAGE', function(e) {
            e.preventDefault(); 
            var pcode = $(this).attr("data-code"); //get product code
            var product_type = 'STORAGE';
            var provider = $(this).attr("provider-code"); //get provider code
            $(this).parent().fadeOut(); //remove item element from box
            $.getJSON( "addtocart.php", {"remove_code":pcode, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
                $('.wishlistWrapperScroll').jScrollPane();
            });
    });
    
    $(".shopping-cart-box").on('change', 'input.product-item-STORAGE', function(e) {
        e.preventDefault(); 
        var pcode = $(this).attr("data-code"); //get product code
        var provider = $(this).attr("provider-code"); //get provider code
        var pqty = $(this).val(); //get product code
        var product_type = 'STORAGE';
        $.getJSON( "addtocart.php", {"add_product":pcode, "product_qty":pqty, "product_type":product_type, "provider": provider} , function(data){ //get Item count from Server
                $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                $(".shopping-cart-box .totalCalculated").html(data.total_price);
                $("#wishlist .totalCalculated").html(data.total_price);
                $("#wishlist .wishlist_details").html(data.cart_details);
				$('.wishlistWrapperScroll').jScrollPane();
        });
    });
});