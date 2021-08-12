
<div class="shopping-cart-table">
        <div class="cart-item-container header">
            <div class="cart-info title">Title</div>
            <div class="cart-info">Quantity</div>
            <div class="cart-info price">Price</div>
        </div>
<?php
            foreach ($cartItem as $item) {
                ?>
				<div class="cart-item-container">
            <div class="cart-info title">
                <img class="cart-image"
                    src="<?php echo $item["image"]; ?>">
                    <?php echo $item["name"]; ?>
                </div>

            <div class="cart-info">
                        <?php echo $item["quantity"]; ?>
                    </div>

            <div class="cart-info price">
                        <?php echo "$".$item["price"]; ?>
                    </div>


            <div class="cart-info action">
                <a
                    href="index.php?action=remove&id=<?php echo $item["cart_id"]; ?>"
                    class="btnRemoveAction"><img
                    src="image/icon-delete.png" alt="icon-delete"
                    title="Remove Item" /></a>
            </div>
        </div>
				<?php
            }
            ?>
</div>
