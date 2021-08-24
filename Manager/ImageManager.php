<?php 
require_once 'DatabaseManager.php';

class ImageManager extends DatabaseManager {

    public function uploadImageAndCreatePost($file, $offerId) {
        if(isset($file) AND !empty($file)) {
            $img = $file;
            //on verifie si c'est une image
            if(strpos($img['type'], 'image') !== '') {

                $tmpName = $file['tmp_name'];
                //C:\Users\acs\AppData\Local\Temp\php5F0E.tmp

                $filename = $img['name'];
                //user-shape_icon-64px.png

                $dest = 'public/uploads/';
                move_uploaded_file($tmpName, $dest . $filename);

                $_POST['image'] = ['filename'=> $filename, 'offer_id' => $offerId];
                return $_POST['image'];
            }
        }
    }

    public function add($image) {
        // var_dump($image);
        try {
            $entry = $this->pdo->prepare("INSERT INTO $this->tablename (id, filename, offer_id) VALUES (:id, :filename, :offer_id)");
            $affectedLines = $entry->execute(array(
                'id' => $image['filename'] . date('hismd'),
                'filename' => $image['filename'],
                'offer_id' => $image['offer_id']
            ));
        } catch (Exception $e) {
            die('Error while try add an image: ' . $e->getMessage());
        }
    }

    public function update($id, $image) {
        try {
            $toUp = $this->pdo->prepare("UPDATE $this->tablename SET 
                filename = :filename, offer_id = :offer_id WHERE id = $id");

            $affectedLines = $toUp->execute(array(
                'filename' => $image['filename'],
                'offer_id' => $image['offer_id']
            ));
            return $affectedLines;
        }
        catch (Exception $e) {
            die('Error on ' . __METHOD__ . ' : ' . $e->getMessage());
        }
    }

    public function updateOLD($id) {
        try {
            $toUp = $this->pdo->prepare("UPDATE $this->tablename SET 
                filename = :filename, offer_id = :offer_id WHERE id = $id");

            $affectedLines = $toUp->execute(array(
                'filename' => $_POST['image']['filename'],
                'offer_id' => $_POST['image']['offer_id']
            ));
            return $affectedLines;
        }
        catch (Exception $e) {
            die('Error on ' . __METHOD__ . ' : ' . $e->getMessage());
        }
    }
}