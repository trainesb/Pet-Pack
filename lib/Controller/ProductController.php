<?php


namespace Controller;


use API\ProductTable;
use Model\Product;

class ProductController {

    private $result;

    public function __construct($site) {
        if(isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];

            $products = new ProductTable($site);
            $product = $products->getById($_POST['id']);
            $product = new Product($product);
            $cart->addToCart($_POST['name'], $product, $_POST['qty']);
            $this->result = json_encode(["ok" => true]);
            return;
        }
        $this->result = json_encode(["ok" => false, "message" => "Error adding to cart!"]);
    }

    public function getResult() { return $this->result; }
}