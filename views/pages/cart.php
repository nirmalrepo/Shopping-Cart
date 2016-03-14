<?php
if (self::$count == 0) {
    echo "<div class='alert alert-info'>";
    echo "Cart is empty!";
    echo "</div>";
} else {
    ?>
    <table id='cart' class = 'table table-hover table-responsive table-bordered'>
        <tr>
            <th class = 'textAlignLeft'>Product Name</th>
            <th>Price (USD)</th>
            <th>Quantity</th>
            <th>Sub Total</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($carts as $cart) {
            $sub_total = ($cart->price) * ($cart->quantity);
            $sums+=$sub_total;
            echo "<tr>";
            echo "<td>$cart->name<div class='product-id' style='display:none;'>$cart->id</div></td>";
            echo "<td class='product-price'>&#36;$cart->price</td>";
            echo "<td>";
            echo '<form class="update-quantity-form" data-id="' . $cart->id . '" data-name="' . $cart->name . '"><div class="input-group"><input name="quantity" value="' . $cart->quantity . '" min="1" class="form-control" required="" type="number"><span class="input-group-btn"><button type="submit" class="btn btn-default update-quantity">Update</button></span></div></form>';
            echo "</td>";
            echo "<td class='product-sub'>&#36;$sub_total</td>";
            echo "<td>";
            echo '<a href="http://localhost/shopping_cart_mvc/cart/remove/' . $cart->id . '/" class="btn btn-danger">';
            echo "<span class = 'glyphicon glyphicon-remove'></span> Remove from cart";
            echo "</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
        <tr>
            <td><strong>Total</strong></td>
            <td></td>
            <td></td>
            <td class='cart_total'>&#36;<?php
                echo $sums;
                ?></td>
            <td><a href="http://localhost/shopping_cart_mvc/checkout" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Checkout</a></td>
        </tr>
    </table>
<?php
} 
    
