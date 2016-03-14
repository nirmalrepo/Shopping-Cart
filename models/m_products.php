<?php

class Products {

    // we define 3 attributes
    // they are public so that we can access them using $post->author directly
    public $id;
    public $name;
    public $price;
    public $image;
    public $quantity;

    public function __construct($id, $name, $price, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM products');

        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $products) {
            $list[] = new Products($products['id'], $products['name'], $products['price'], $products['image']);
        }

        return $list;
    }

}

?>