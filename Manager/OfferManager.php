<?php 
require_once 'DatabaseManager.php';

class OfferManager extends DatabaseManager {
    public function update($id, $values) {
        try {
            $toUp = $this->pdo->prepare("UPDATE $this->tablename SET 
                title = :title, content = :content, price = :price, place = :place, date = :date WHERE id = $id");

            $affectedLines = $toUp->execute(array(
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'price' => $_POST['price'],
                'place' => $_POST['place'],
                'date' => date('Y-m-d H:i:s')
            ));
        }
        catch (Exception $e) {
            die('Error on update: ' . $e->getMessage());
        }
    }

    public function findRelations($entityManager) {
        try {
            $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = offers.user_id ");

        }
        catch (Exception $e) {
            die('ERROR function findByRelations: ' . $e->getMessage());
        }
        return $result;
        // return $this->fetchData($result);
    }

    public function findByRelations($entityManager, $user_id) {
        try {
            // $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = '" . $user_id ."'");
            $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = offers.user_id WHERE offers.user_id='" . $user_id ."'");

        }
        catch (Exception $e) {
            die('ERROR function findByRelations: ' . $e->getMessage());
        }
        return $result;
        // return $this->fetchData($result);
    }
}