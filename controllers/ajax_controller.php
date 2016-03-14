<?php

class AjaxController {

    public function add() {
        session_start();
        $id = isset($_POST['id']) ? $_POST['id'] : "";
// get the product id
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
        $count = count($_SESSION['cart_items']);
        /*
         * check if the 'cart' session array was created
         * if it is NOT, create the 'cart' session array
         */
        if (!isset($_SESSION['cart_items'])) {
            $_SESSION['cart_items'] = array();
        }
        //check if the item is in the array, if it is, do not add
        if (array_key_exists($id, $_SESSION['cart_items'])) {
            // redirect to product list and tell the user it was added to cart
            echo json_encode(array('status' => 'exists', 'id' => $id, 'name' => $name, 'count' => $count));
//            header('Location: http://localhost/shopping_cart_mvc/?status=exists&id' . $id . '&name=' . $name);
        }

// else, add the item to the array
        else {
            $_SESSION['cart_items'][$id] = array($name, $quantity);
            $count = count($_SESSION['cart_items']);
            echo json_encode(array('status' => 'added', 'id' => $id, 'name' => $name, 'count' => $count));

            // redirect to product list and tell the user it was added to cart
//            header('Location: http://localhost/shopping_cart_mvc/?status=added&id' . $id . '&name=' . $name);
        }
    }

    public function update() {
        session_start();
        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
        $count = count($_SESSION['cart_items']);
        if (array_key_exists($id, $_SESSION['cart_items'])) {
            $_SESSION['cart_items'][$id][1] = $quantity;
            echo json_encode(array('status' => 'updated', 'id' => $id, 'name' => $name, 'quantity' => $_SESSION['cart_items'][$id][1]));
        }
    }

}

?>