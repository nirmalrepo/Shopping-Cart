<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        session_start();
        include 'navigation.php';
        ?>
        <div class="container">
            <pre>
                <?php
                print_r($_SESSION['cart_items']);
                ?>
            </pre>

            <div class="page-header">
                <h1>Shopping Cart</h1>
                <div class="information">

                </div>
                <?php require_once('routes.php'); ?>
            </div>

        </div>
        <!-- /container -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function () {
//                $('.add-to-cart').click(function (e) {
//                    alert();
//                });
                $('form.add-to-cart-form').submit(
                        function () {
                            var content = '';
                            var id = $(this).closest('tr').find('.product-id').text();
                            var name = $(this).closest('tr').find('.product-name').text().trim();
                            var quantity = $(this).closest('tr').find('input').val();
                            var count;
//                            window.location.href = "cart/add/" + id + "/" + name + "/" + quantity;
                            $.post('/shopping_cart_mvc/routes.php', {
                                method: 'ajax',
                                id: id,
                                name: name,
                                quantity: quantity
                            }, function (e) {
                                console.log(e);
                                content += "<div class='alert alert-info'>";
                                if (e['status'] === 'exists') {
                                    content += "<strong>" + e['name'] + "</strong> already exists in your cart!";

                                } else {
                                    content += "<strong>" + e['name'] + "</strong>was added to your cart!";
                                }

                                content += "</div>";
                                $('.information').html(content);
                                $('#comparison-count').html(e['count']);

                            }, 'json');
                            return false;
                        });
                $('form.update-quantity-form').submit(
                        function () {
                            var content = '';
                            var id = $(this).data('id');
                            var name = $(this).data('name');
                            var price = $(this).closest('tr').find('.product-price').text().slice(1);
                            var sub_price = $(this).closest('tr').find('.product-sub');
                            var quantity = $(this).closest('tr').find('input').val();
                            var $dataRows = $("#cart tr:not(:first, :last)");
                            var count;
                            var totals = 0;
                            $.post('/shopping_cart_mvc/routes.php', {
                                method: 'ajax_update',
                                id: id,
                                name: name,
                                quantity: quantity
                            }, function (e) {
                                content += "<div class='alert alert-info'>";
                                content += "<strong> Cart is updated!</strong>";
                                content += "</div>";
                                $('.information').html(content);
                                $(sub_price).html('$' + price * (e['quantity']));
                                $dataRows.each(function () {
                                    totals += parseInt($(this).find('.product-sub').text().slice(1));
                                });
                                $('.cart_total').html('$' + totals);
                            }, 'json');
                            return false;
                        });
            });

        </script>
    </body>
</html>