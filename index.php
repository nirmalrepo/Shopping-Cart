<?php

require_once('connection.php');
if (isset($_GET['controller'])) {

    if (isset($_GET['action'])) {
        $action = $_GET['action']; //show
    }
    $controller = $_GET['controller']; //post
    if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['quantity'])) {
        $id = $_GET['id']; //show
        $name = $_GET['name']; //show
        $quantity = $_GET['quantity']; //show
    }
} else {
    $controller = 'products';
    $action = 'home';
}
require_once('views/layout.php');
?>