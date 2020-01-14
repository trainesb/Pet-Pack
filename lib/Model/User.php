<?php


namespace Model;


class User {

    const ADMIN = "A";
    const MEMBER = "M";

    const SESSION_NAME = 'user';

    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    private $profileImg;
    private $joined;
    private $role;

    public function __construct($row) {
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->profileImg = $row['profileImg'];
        $this->joined = strtotime($row['joined']);
        $this->role = $row['role'];
    }

    public function isAdmin() { return $this->role === self::ADMIN; }

    public function isMember() { return $this->role === self::MEMBER || self::ADMIN; }

    public function getId() { return $this->id; }

    public function getUsername() { return $this->username; }

    public function getFirstName() { return $this->firstName; }

    public function getLastName() { return $this->lastName; }

    public function getEmail() { return $this->email; }

    public function getPhone() { return $this->phone; }

    public function getProfileImg() { return $this->profileImg; }

    public function getJoined() { return $this->joined; }

    public function getRole() { return $this->role; }
}