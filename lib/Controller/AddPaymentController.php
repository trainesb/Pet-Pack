<?php


namespace Controller;


use API\PaymentCardTable;

class AddPaymentController {

    private $result;

    public function __construct($site) {
        $paymentCards = new PaymentCardTable($site);
        if($paymentCards->add($_POST)) {
            $this->result = json_encode(["ok" => true]);
            return;
        }
        $this->result = json_encode(["ok" => false, "message" => "Error adding Payment card!"]);
    }

    public function getResult() { return $this->result; }
}