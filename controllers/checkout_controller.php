<?php

class CheckoutController {

    private static $count = NULL;

    public function __construct() {
        require_once('models/m_checkout.php');
    }

    public function index() {
        self::$count = count($_SESSION['cart_items']);
        if (self::$count != 0) {
            $carts = Checkout::all(self::$count);
        }
        require_once('views/pages/checkout.php');
    }

}
