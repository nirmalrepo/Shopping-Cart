<?php

class CartController {

    private static $count = NULL;

    public function __construct() {
        require_once('models/m_cart.php');
    }

    public function index() {
        self::$count = count($_SESSION['cart_items']);
        if (self::$count != 0) {
            $carts = Cart::all(self::$count);
        }
        require_once('views/pages/cart.php');
    }

    public function remove() {
        session_start();

        $id = isset($_GET['id']) ? $_GET['id'] : "";
        unset($_SESSION['cart_items'][$id]);


        header('Location: http://localhost/shopping_cart_mvc/cart/');
    }

}
