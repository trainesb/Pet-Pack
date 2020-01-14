<?php


namespace Model;


class Address {


    private $id;
    private $userId;
    private $fullName = "Full Name";
    private $address1 = "Address";
    private $address2 = "Address 2...";
    private $city = "City";
    private $state = "State";
    private $zip = "zip";

    public function __construct($address) {
        $this->userId = $_SESSION["user"]->getId();

        if(!empty($address)) {
            $this->fullName = $address["fullName"];
            $this->address1 = $address["address1"];
            $this->address2 = $address["address2"];
            $this->city = $address["city"];
            $this->state = $address["state"];
            $this->zip = $address["zip"];
        }
        if(isset($address["id"])) {
            $this->id = $address["id"];
        }
    }

    public function getId() { return $this->id; }

    public function getUserId() { return $this->userId; }

    public function getFullName() { return $this->fullName; }

    public function getAddress1() { return $this->address1; }

    public function getAddress2() { return $this->address2; }

    public function getCity() { return $this->city; }

    public function getState() { return $this->state; }

    public function getZip() { return $this->zip; }
}