<?php


namespace API;


class OrderTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "payment");
    }

    public function addOrder($userId, $paymentId) {
        var_dump($userId);
        var_dump($paymentId);
        $sql = <<<SQL
INSERT INTO $this->tableName (userId, paymentId) VALUES (?, ?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $ex = $statement->execute(array((int)$userId, $paymentId));
        var_dump($ex);
        if($ex) {
            return false;
        }
        return true;
    }

}