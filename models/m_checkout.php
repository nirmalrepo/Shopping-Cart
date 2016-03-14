<?php

class Checkout {

    public $id;
    public $name;
    public $price;
    public $image;
    public $quantity;

    public function __construct($id, $name, $price, $quantity, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->image = $image;
    }

    public static function all($count) {
        $ids = "";
        $values = "";
        foreach ($_SESSION['cart_items'] as $id => $value) {
            $ids = $ids . $id . ",";
            $new_val = $value[0] . 'x' . $value[1];
            $values = $values . $new_val . ',';
        }

        $ids = rtrim($ids, ',');
        $db = Db::getInstance();
        try {
            $stmt = $db->prepare("INSERT INTO orders (order_name, order_address)
    VALUES (:firstname, :address)");

            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':address', $address);

// insert a row
            $firstname = "Fern";
            $address = "Colombo";
            $new = $stmt->execute();
            $order_id = $db->lastInsertId();
            if ($new) {
                foreach ($_SESSION['cart_items'] as $id => $value) {
                    $new_val = $value[0] . 'x' . $value[1];
                    $values = $values . $new_val . ',';
                    try {
                        $stmt = $db->prepare("INSERT INTO order_details (order_id, product_id,quantity)
    VALUES (:order_id, :product_id,:quantity)");

                        $stmt->bindParam(':order_id', $order_id);
                        $stmt->bindParam(':product_id', $product_id);
                        $stmt->bindParam(':quantity', $quantity);

// insert a row
                        $product_id = $id;
                        $quantity = $value[1];
                        $stmt->execute();
                    } catch (Exception $ex) {
                        
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $query = "SELECT id, name, price FROM products WHERE id IN ({$ids}) ORDER BY name";
        $stmt = $db->prepare($query);
        $stmt->execute();
        foreach ($stmt->fetchAll() as $carts) {
            $quantity = $_SESSION['cart_items'][$carts['id']][1];
            $list[] = new Checkout($carts['id'], $carts['name'], $carts['price'], $quantity);
        }
        return $list;
    }

}
