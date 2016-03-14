<?php

class ProductController {

    public function __construct() {
        require_once('models/m_products.php');
    }

    public function home() {
        $products = Products::all();
        require_once('views/pages/products.php');
    }

    public function error() {
        require_once('views/pages/error.php');
    }

}

?>