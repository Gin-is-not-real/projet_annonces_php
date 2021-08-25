<?php 
require_once 'DatabaseManager.php';

class ImageManager extends DatabaseManager {

    public function add($image) {
        try {
            $entry = $this->pdo->prepare("INSERT INTO $this->tablename (id, filename, offer_id) VALUES (:id, :filename, :offer_id)");
            $affectedLines = $entry->execute(array(
                'id' => $image['id'],
                'filename' => $image['filename'],
                'offer_id' => $image['offer_id']
            ));
        } catch (Exception $e) {
            die('Error on ' . __METHOD__ . ' : ' . $e->getMessage());
        }
    }

    public function update($id, $image) {
        try {
            $toUp = $this->pdo->prepare("UPDATE $this->tablename SET id = :id,
                filename = :filename, offer_id = :offer_id WHERE id='" . $id . "'");

            $affectedLines = $toUp->execute(array(
                'id' => $id, 
                'filename' => $image['filename'],
                'offer_id' => $image['offer_id']
            ));
            return $affectedLines;
        }
        catch (Exception $e) {
            die('Error on ' . __METHOD__ . ' : ' . $e->getMessage());
        }
    }

    public function removeImage($id) {
        // die("DELETE FROM $this->tablename WHERE id='$id'");
        $this->pdo->exec("DELETE FROM $this->tablename WHERE id='$id'");
    }

}