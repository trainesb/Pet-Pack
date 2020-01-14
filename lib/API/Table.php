<?php


namespace API;


class Table {

    private $site;
    protected $tableName;

    public function __construct($site, $tableName) {
        $this->site = $site;
        $this->tableName = $tableName;
    }

    public function pdo() { return $this->site->pdo(); }

    public function getAll() {
        $sql = 'SELECT * FROM '.$this->tableName;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0) { return null; }
        return $statement->fetchALL(\PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = 'SELECT * FROM '.$this->tableName.' WHERE id=?';
        $statement = $this->pdo()->prepare($sql);
        if(!$statement->execute(array($id))) { return null; }
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function deleteById($id) {
        $sql = 'DELETE FROM '.$this->tableName.' WHERE id=?';
        $statement = $this->pdo()->prepare($sql);
        if($statement->execute(array($id))) { return null; }
    }

    public function getByUser($id) {
        $sql = 'SELECT * FROM '.$this->tableName.' WHERE userId = ?';
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));

        if($statement->rowCount() === 0) {
            return false;
        }

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}