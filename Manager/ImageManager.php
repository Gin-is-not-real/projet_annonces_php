<?php 
require_once 'DatabaseManager.php';

class ImageManager extends DatabaseManager {
    public function add($image) {
        var_dump($image);
        try {
            $entry = $this->pdo->prepare("INSERT INTO $this->tablename (id, filename, offer_id) VALUES (:id, :filename, :offer_id)");
            $affectedLines = $entry->execute(array(
                'id' => date('hismd'),
                'filename' => $image['filename'],
                'offer_id' => $image['offer_id']
            ));
        } catch (Exception $e) {
            die('Error while try add an image: ' . $e->getMessage());
        }
    }

}