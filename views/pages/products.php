<?php
// to prevent undefined index notice
//$status = isset($_GET['status']) ? $_GET['status'] : "";
//$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
//$name = isset($_GET['name']) ? $_GET['name'] : "";
//if ($status == 'added') {
//    echo "<div class='alert alert-info'>";
//    echo "<strong>{$name}</strong> was added to your cart!";
//    echo "</div>";
//}
//
//if ($status == 'exists') {
//    echo "<div class='alert alert-info'>";
//    echo "<strong>{$name}</strong> already exists in your cart!";
//    echo "</div>";
//}
?>
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <th class='textAlignLeft'>Product Name</th>
        <th>Price (USD)</th>
        <th></th>
        <th>Action</th>
    </tr>

    <?php
    foreach ($products as $product) {
        //creating new table row per record
        echo "<tr>";
        echo "<td>";
        echo "<div class='product-id' style='display:none;'>$product->id</div>";
        echo "<div class='product-name'>$product->name</div>";
        echo "</td>";
        echo "<td>$product->price</td>";
        echo "<td><img style='display:block;' width='50%' height='50%' src='http://localhost/shopping_cart_mvc/images/$product->image'></td>";
        echo "<td>";
        echo '<form class="add-to-cart-form"><div class="input-group"><input name="quantity" value="1" min="1" class="form-control" placeholder="Type quantity here..." type="number"><span class="input-group-btn"><button type="submit" class="btn btn-primary add-to-cart"><span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</button></span></div></form>';
        //                    echo "<a href='add_to_cart.php?id={$id}&name={$name}' class='btn btn-primary'>";
        //                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
        //                    echo "</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>

</table>