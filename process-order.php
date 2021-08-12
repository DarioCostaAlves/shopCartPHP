<?php
require_once "ShoppingCart.php";

$member_id = 2; // you can your integerate authentication module here to get logged in member

$shoppingCart = new ShoppingCart();

/* Calculate Cart Total Items */
$cartItem = $shoppingCart->getMemberCartItem($member_id);
$item_quantity = 0;
$item_price = 0;
if (! empty($cartItem)) {
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity"];
            $item_price = $item_price + ($item["price"] * $item["quantity"]);
        }
    }
}

if(!empty($_POST["proceed_payment"])) {
    $name = $_POST ['name'];
    $address = $_POST ['address'];
    $city = $_POST ['city'];
    $zip = $_POST ['zip'];
    $country = $_POST ['country'];
}
$order = 0;
if (! empty ($name) && ! empty ($address) && ! empty ($city) && ! empty ($zip) && ! empty ($country)) {
    // able to insert into database
    
    $order = $shoppingCart->insertOrder ( $_POST, $member_id, $item_price);
    if(!empty($order)) {
        if (! empty($cartItem)) {
            if (! empty($cartItem)) {
                foreach ($cartItem as $item) {
                    $shoppingCart->insertOrderItem ( $order, $item["id"], $item["price"], $item["quantity"]);
                }
            }
        }
    }
}
?>
<HTML>
<HEAD>
<TITLE>Enriched Responsive Shopping Cart in PHP</TITLE>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="shopping-cart">
        <div class="txt-heading">
            <div class="txt-heading-label">Shopping Cart</div>

            <a id="btnEmpty" href="index.php?action=empty"><img
                src="image/empty-cart.png" alt="empty-cart"
                title="Empty Cart" class="float-right" /></a>
            <div class="cart-status">
                <div>Total Quantity: <?php echo $item_quantity; ?></div>
                <div>Total Price: $ <?php echo $item_price; ?></div>
            </div>
        </div>
        <?php
        if (! empty($cartItem)) {
            ?>
<?php
            require_once ("cart-list.php");
            ?>
<?php
        } // End if !empty $cartItem
        ?>

</div>
<?php if(!empty($order)) { ?>
    <form name="frm_customer_detail" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">
        <input type="hidden" name="cmd" value="_cart">  
        <input type="hidden" name="upload" value="1">
        <input type='hidden'name='business' value='sb-unhom7091284@business.example.com'> 
        <input type='hidden' name='item_name_1' value='Prancha Surf'> 
        <input type='hidden' name='amount_1' value='<?php echo $item_price; ?>'> 
        <input type='hidden' name='quantity_1' value='<?php echo $item_quantity; ?>'> 
        <input type='hidden' name='item_name_2' value='Barbatanas'> 
        <input type='hidden' name='amount_2' value='<?php echo $item_price; ?>'> 
        <input type='hidden' name='quantity_2' value='<?php echo $item_quantity; ?>'> 
        <input type='hidden' name='currency_code' value='EUR'>     
        <input type="hidden" name="order" value="<?php echo $order;?>">
        <div>
            <input type="submit" class="btn-action"
                    name="continue_payment" value="Continue Payment">
        </div>
    </form>
<?php } else { ?>
<div class="success">Problem in placing the order. Please try again!</div>
<div>
        <button class="btn-action">Back</button>
    </div>
<?php } ?>
</BODY>
</HTML>