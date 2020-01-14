<?php


namespace Controller;


use API\ProductTable;

class DeleteProductController {

    private $result;

    public function __construct($site) {
        $products = new ProductTable($site);
        if($products->deleteById($_POST["id"])) {
            $this->result = json_encode(["ok" => true]);
            return;
        }
        $this->result = json_encode(["ok" => false, "message" => "Error deleting product!"]);
    }

    public function getResult() { return $this->result; }

}