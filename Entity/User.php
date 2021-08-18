<?php 

class User {
    private $id;
    private $username;
    private $email;
    private $pass;
    private $role;

    public function __construct($username, $pass, $email = '', $role = '') {
        $this->username = $username;
        $this->email = $email;
        $this->pass = $pass;
        //#
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getpass() {
        return $this->pass;
    }
    public function setpass($pass) {
        $this->pass = $pass;
        return $this;
    }

    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
        return $this;
    }
}