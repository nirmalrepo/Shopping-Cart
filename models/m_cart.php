<?php

class Cart {

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
        foreach ($_SESSION['cart_items'] as $id => $value) {
            $ids = $ids . $id . ",";
        }

        // remove the last comma
        $ids = rtrim($ids, ',');

        $db = Db::getInstance();
        $query = "SELECT id, name, price FROM products WHERE id IN ({$ids}) ORDER BY name";
        $stmt = $db->prepare($query);
        $stmt->execute();
        foreach ($stmt->fetchAll() as $carts) {
            $quantity = $_SESSION['cart_items'][$carts['id']][1];
            $list[] = new Cart($carts['id'], $carts['name'], $carts['price'], $quantity);
        }
        return $list;
    }

}
