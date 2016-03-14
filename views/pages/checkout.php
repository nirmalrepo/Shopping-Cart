<div class="row-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4>Shipping Details</h4>
            <div class="form">
                <div class="form-group">
                    <label for="usr">Name:</label>

                    <input type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                    <label for="pwd">Address:</label>
                    <input type="text" class="form-control" id="pwd">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Your Order</h4>
            <div class="row">
                <div class='col-md-8'><strong>Item</strong></div><div class='col-md-4'><strong>Amount</strong></div>
                <?php
                foreach ($carts as $cart) {
                    $sub_total = ($cart->price) * ($cart->quantity);
                    $sums+=$sub_total;

                    echo "<div class='col-md-8'><p>$cart->name x $cart->quantity</p></div><div class='col-md-4'>&#36;$sub_total</div>";
                }
                echo "<div class='col-md-8'><p>Total</p></div><div class='col-md-4'>&#36;$sums</div>";
                ?>
            </div>
        </div>

    </div>
</div>