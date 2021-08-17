<?php 

class BaseController {
    private $servname;
    private $dbname;
    private $user;
    private $pass;

    public function __construct($servname, $dbname, $user, $pass) {
        $this->servname = $servname;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;

        $this->pdo = $this->initPdo($servname, $dbname, $user, $pass);
    }

    public function initPdo() {
        try {
            $pdo = new PDO("mysql:host=$this->servname;dbname=$this->dbname", $this->user, $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
        $this->pdo;        
    }

    // public function createDatabase() {
    //     $createTb = "CREATE TABLE users(
    //         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //         title VARCHAR NOT NULL,
    //     )"
    // }

    public function getServname() {
        return $this->servname;
    }
    public function setServname($servname) {
        $this->servname = $servname;
        return $this;
    }

    public function getDbname() {
        return $this->dbname;
    }
    public function setDbname($dbname) {
        $this->dbname = $dbname;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getPass() {
        return $this->pass;
    }
    public function setPass($pass) {
        $this->pass = $pass;
        return $this;
    }
}