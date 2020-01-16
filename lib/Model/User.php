<?php


namespace Model;


class User {

    const ADMIN = "A";
    const MEMBER = "M";

    const SESSION_NAME = 'user';

    private $id;
    private $customerId;
    private $username;
    private $email;
    private $role;

    public function __construct($row) {
        $this->id = $row['id'];
        $this->customerId = $row['customerId'];
        $this->username = $row['username'];
        $this->email = $row['email'];
        $this->role = $row['role'];
    }

    public function isAdmin() { return $this->role === self::ADMIN; }

    public function isMember() { return $this->role === self::MEMBER || self::ADMIN; }

    public function getId() { return $this->id; }

    public function getCustomerId() { return $this->customerId; }

    public function getUsername() { return $this->username; }

    public function getEmail() { return $this->email; }

    public function getRole() { return $this->role; }
}