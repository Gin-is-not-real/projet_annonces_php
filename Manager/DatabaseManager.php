<?php 
/**
 * 
 */

class DatabaseManager {
    private $servname;
    private $dbname;
    private $user;
    private $pass;
    public $pdo;

    protected $tablename;
    
    public function __construct($servname, $dbname, $user, $pass, $tablename) {
        $this->servname = $servname;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
        if(!empty($tablename) AND $tablename !== null) {
            $this->tablename = $tablename;
        }
        $this->pdo = $this->initPdo($servname, $dbname, $user, $pass);
    }

    public function initPdo($servname, $dbname, $user, $pass) {
        try {
            $pdo = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
        return $pdo;        
    }

///////////////////////////////////////////////////////////////////////
    public function findAll() {
        try {
            $result = $this->pdo->query("SELECT * FROM $this->tablename");
        }
        catch (Exception $e) {
            die('ERROR on function findAll: ' . $e->getMessage());
        }
        return $result;
    }

    public function find($id) {
        try {
            $result = $this->pdo->query("SELECT * FROM $this->tablename WHERE id=" . $id);
        }
        catch (Exception $e) {
            die('ERROR function find ' . $e->getMessage());
        }
        return $result;
    }

    public function findBy($field, $value) {
        try {
            $result = $this->pdo->query("SELECT * FROM $this->tablename WHERE " . $field . "='" . $value ."'");
        }
        catch (Exception $e) {
            die('ERROR function findBy: ' . $e->getMessage());
        }
        return $result;
        // return $this->fetchData($result);
    }

    public function fetchData($result) {
        $fetched = [];
        while($data = $result->fetch()) {
            array_push($fetched, $data);
        }
        return $fetched;
    }

///////////////////////////////////////////////////////////////////////

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

    public function getTablename() {
        return $this->tablename;
    }
    public function setTablename($tablename) {
        $this->tablename = $tablename;
        return $this;
    }

}