<?php


namespace API;


class AddressTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "address");
    }

    public function add($address) {
        $sql = 'INSERT INTO '.$this->tableName.' (userId, fullName, address1, address2, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        if($statement->execute(array($address['userId'], $address['fullName'], $address['address1'], $address['address2'], $address['city'], $address['state'], $address['zip']))) {
            return null;
        }
    }
}