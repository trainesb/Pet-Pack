<?php


namespace Controller;


use API\OrderTable;

class CheckoutController {

    private $result;

    public function __construct($site) {
        $orders = new OrderTable($site);
        if($orders->add($_POST)) {
            $this->result = json_encode(["ok" => true]);
            return;
        }

        $this->result = json_encode(["ok" => false, "message" => "Error checking out!"]);
    }

    public function getResult() { return $this->result; }
}