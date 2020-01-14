<?php


namespace API;


class OrderTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "order");
    }

    public function add($order) {
        $sql = 'INSERT INTO '.$this->tableName.' (userId, shippingId, cardId, productId, date, cost, isPaid, isShipped, isFulfilled) VALUES (?, ?, ?, ?, ?, true, false, false)';
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        if($statement->execute(array($order['userId'], $order['shippingId'], $order["cardId"], $order["productId"], $order["date"], $order["cost"]))) {
            return null;
        }
    }

}