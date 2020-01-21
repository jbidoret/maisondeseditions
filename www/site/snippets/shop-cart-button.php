<?php
    use Wagnerwagner\Merx\Merx;
    use Wagnerwagner\Merx\Cart;
?>
<div class='cart-items-number'>
    <div>
        <?php
        $merx = merx();
        $cart = $merx->cart();
        $cartItemsNb = 0;

        foreach($cart as $cartItem){
            if(array_key_exists("quantity", $cartItem) && $cartItem["id"] != "shop/shipping") {
                $cartItemsNb += intval( $cartItem["quantity"] );
            }
        }
        $checkoutpage = option('checkoutPage');
        if ($cartItemsNb != 0) {
            echo "~";
            echo "<a id='cart-button' href='$checkoutpage'>$cartItemsNb</a>";
        }
        ?>
</div>
</div>
