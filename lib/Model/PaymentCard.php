<?php


namespace Model;


class PaymentCard {

    private $id;
    private $userId = "User Id";
    private $alias = "Alias";
    private $fullName = "Full Name";
    private $cardNumber = "Card Number";
    private $vcc = "vcc";
    private $zip = "zip";

    public function __construct($card) {
        $this->userId = $_SESSION["user"]->getId();
        if(!empty($card)) {
            $this->alias = $card["alias"];
            $this->fullName = $card["fullName"];
            $this->cardNumber = $card["cardNumber"];
            $this->vcc = $card["vcc"];
            $this->zip = $card["zip"];
        }
        if(isset($card["id"])) {
            $this->id = $card["id"];
        }
    }

    public function getId() { return $this->id; }

    public function getUserId() { return $this->userId; }

    public function getAlias() { return $this->alias; }

    public function getFullName() { return $this->fullName; }

    public function getCardNumber() { return $this->cardNumber; }

    public function getVcc() { return $this->vcc; }

    public function getZip() { return $this->zip; }
}