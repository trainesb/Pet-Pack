<?php


namespace API;


use Model\User;

class UserTable extends Table {

    public function __construct($site) {
        parent::__construct($site, "user");
    }

    public function login($username, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where username=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($username));
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);
    }

    public function exists($username) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE username = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($username));
        if($statement->rowCount() === 0) {
            return false;
        }

        return true;
    }

    public function checkEmail($email) {
        $sql = "SELECT * FROM ".$this->tableName." WHERE email = ?";
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return false;
        }

        return true;
    }

    public function addUser($user) {
        $salt = $this->randomSalt();
        $hash = $this->hashPassword($user["password"], $salt);

        $sql = "INSERT INTO ".$this->tableName." (customerId, username, password, salt, email, role) VALUES (?, ?, ?, ?, ?, ?)";
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        if(!$statement->execute(array($user['customerId'], $user['username'], $hash, $salt, $user['email'], "M"))) {
            return false;
        }
        return true;
    }

    public function hashPassword($password, $salt) {
        return hash("sha256", $password . $salt);
    }

    public function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len/2);
        return bin2hex($bytes);
    }
}