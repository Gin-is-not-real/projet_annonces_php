<?php
require_once 'DatabaseManager.php';

/**
 * @method insert
 * @method findRelations
 */
class LoginManager extends DatabaseManager {
    /**
     * Insert an user in the database using data passed as paramaters
     */
    public function insert($username, $email, $pass) {
        try {
            $req = $this->pdo->prepare("INSERT INTO $this->tablename(id, username, email, pass) VALUES (:id, :username, :email, :pass)");

            $affectedLines = $req->execute(array(
                'id' => date('mdhis'),
                'username' => $username,
                'email' => $email, 
                'pass' => $pass
            ));

            return $affectedLines;

        } catch (Exception $e) {
            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());        
        }
    }


    /**
     * 
     */
    public function findRelations() {
        try {
            $result = $this->pdo->query("SELECT * FROM $this->tablename INNER JOIN offers ON users.id = offers.user_id ");

        } catch (Exception $e) {
            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }

        return $result;
        // return $this->fetchData($result);
    }

}