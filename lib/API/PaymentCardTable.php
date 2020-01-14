<?php


namespace API;


class PaymentCardTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "card");
    }

    public function add($card) {
        $sql = 'INSERT INTO '.$this->tableName.' (userId, alias, fullName, cardNumber, vcc, zip) VALUES (?, ?, ?, ?, ?, ?)';
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        if($statement->execute(array($card['userId'], $card['alias'], $card['fullName'], $card['cardNumber'], $card['vcc'], $card['zip']))) {
            return null;
        }
    }
}