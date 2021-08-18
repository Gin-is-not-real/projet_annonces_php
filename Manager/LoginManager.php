<?php 
require_once 'DatabaseManager.php';

class LoginManager extends DatabaseManager {

    public function insert($username, $email, $pass) {
        $req = $this->pdo->prepare("INSERT INTO $this->tablename(username, email, pass) VALUES (:username, :email, :pass)");

        $affectedLines = $req->execute(array(
            'username' => $username,
            'email' => $email, 
            'pass' => $pass
        ));
        return $affectedLines;
    }

}