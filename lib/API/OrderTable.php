<?php


namespace API;


class OrderTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "order");
    }

    public function addOrder($userId, $paymentId) {
        print_r($userId);
        print_r($paymentId);
        $sql = <<<SQL
INSERT INTO $this->tableName (userId, paymentId) VALUES (?, ?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $ex = $statement->execute(array($userId, $paymentId));
        print_r($ex);
        if($ex) {
            return null;
        }
    }

}