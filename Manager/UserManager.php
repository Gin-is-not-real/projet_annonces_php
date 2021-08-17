<?php 
/**
 * cette classe est chargée de recuperer les donnees de la base
 */

require('DatabaseManager.php');

class UserManager extends DatabaseManager {
    protected $tablename;

    public function __construct($servname, $dbname, $user, $pass, $tablename) {
        parent::__construct($servname, $dbname, $user, $pass);
        $this->tablename = $tablename;
        $this->initPdo($servname, $dbname, $user, $pass);
    }

    public function connect($user) {

    }

    public function add($user) {
        try {
            $entry = $this->pdo->prepare("INSERT INTO $this->tablename(username, email, password) VALUES (:username, :email, :password)");
            $affectedLines = $entry->execute(array(
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ));
        } catch (Exception $e) {
            die('ERROR on add(user)' . $e->getMessage());
        }
        return $affectedLines;
    }

    public function update($id) {
        try {
            $toUp = $this->pdo->prepare("UPDATE $this->tablename SET username = :username, email = :email, password = :password WHERE id = $id");

            $affectedLines = $toUp->execute(array(
                'username' => $_POST['username'],
                'email' => $_POST['email'], 
                'password' => $_POST['password']
            ));
        } catch (Exception $e) {
            die('ERROR on function update(id): ' . $e->getMessage());
        };
    }


    
    public function getTablename() {
        return $this->tablename;
    }
    public function setTablename($tablename) {
        $this->tablename = $tablename;
        return $this;
    }

}