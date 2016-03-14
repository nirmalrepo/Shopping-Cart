<?php

if ($_POST['method'] == "ajax") {
    require_once('controllers/ajax_controller.php');
    $controller = new AjaxController();
    $controller->add();
}
if ($_POST['method'] == "ajax_update") {
    require_once('controllers/ajax_controller.php');
    $controller = new AjaxController();
    $controller->update();
}

function call($controller, $action) {//post and show
    require_once('controllers/' . $controller . '_controller.php');

    switch ($controller) {
        case 'products':
            $controller = new ProductController();
            break;
        case 'cart':
            $controller = new CartController();
            break;

        case 'checkout':
            $controller = new CheckoutController();
            break;
    }
    $controller->{ $action }();
}

// we're adding an entry for the new controller and its actions
$controllers = array('products' => ['home', 'error'],
    'posts' => ['index', 'show'], 'cart' => ['index', 'remove'], 'checkout' => ['index', 'add']);
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call($controller, 'index');
    }
} else {
    call('pages', 'error');
}
?>