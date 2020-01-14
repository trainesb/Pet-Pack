<?php


namespace Controller;


use API\AddressTable;

class AddAddressController {
    private $result;

    public function __construct($site) {
        $addresses = new AddressTable($site);
        if($addresses->add($_POST)) {
            $this->result = json_encode(["ok" => true]);
            return;
        }
        $this->result = json_encode(["ok" => false, "message" => "Error adding address!"]);
    }

    public function getResult() { return $this->result; }

}