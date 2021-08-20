<?php 
require_once 'DatabaseManager.php';
require_once 'Entity/User.php';


class OfferManager extends DatabaseManager {

    public function uploadImageAndCreatePost($file) {
        if(isset($file) AND !empty($file)) {
            $img = $file;
            var_dump($img, '</br>');

            //on verifie si c'est une image
            if(strpos($img['type'], 'image') !== '') {

                $tmpName = $file['tmp_name'];
                //C:\Users\acs\AppData\Local\Temp\php5F0E.tmp

                $filename = $img['name'];
                //user-shape_icon-64px.png

                $dest = 'public/uploads/';
                move_uploaded_file($tmpName, $dest . $filename);

                $_POST['image'] = ['filename'=> $filename, 'offer_id' => $_POST['id']];

                return $_POST['image'];
            }
        }
    }

    public function add($offer) {
        var_dump($offer);
        try {
            $entry = $this->pdo->prepare("INSERT INTO $this->tablename (id, title, content, price, place, user_id) VALUES (:id, :title, :content, :price, :place, :user_id)");
            $affectedLines = $entry->execute(array(
                'id' => date('mdhis'),
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'price' => floatval($_POST['price']),
                'place' => $_POST['place'],
                'user_id' => $_SESSION['user_id']
            ));
        } catch (Exception $e) {
            die('Error on add: ' . $e->getMessage());
        }
    }

    public function update($id) {
        try {
            $toUp = $this->pdo->prepare("UPDATE $this->tablename SET 
                title = :title, content = :content, price = :price, place = :place, date = :date WHERE id = $id");

            $affectedLines = $toUp->execute(array(
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'price' => floatval($_POST['price']),
                'place' => $_POST['place'],
                'date' => date('Y-m-d H:i:s')
            ));
            return $affectedLines;
        }
        catch (Exception $e) {
            die('Error on update: ' . $e->getMessage());
        }
    }

    // public function findByRelatedUser() {
    //     try {
    //         // $result = $this->pdo->query("SELECT * FROM User::table INNER JOIN offers ON users.id = offers.user_id ");
    //         $result = $this->pdo->query("SELECT * FROM ". User::$TABLE_NAME . " WHERE id = 1");

    //     }
    //     catch (Exception $e) {
    //         die('ERROR function findByRelations: ' . $e->getMessage());
    //     }
    //     var_dump($result->fetchAll());
    //     // return $result;
    // }

    // public function findRelations($entityManager) {
    //     try {
    //         $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = offers.user_id ");
    //     }
    //     catch (Exception $e) {
    //         die('ERROR function findByRelations: ' . $e->getMessage());
    //     }
    //     return $result;
    //     // return $this->fetchData($result);
    // }

    // public function findByRelations($entityManager, $user_id) {
    //     try {
    //         // $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = '" . $user_id ."'");
    //         $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = offers.user_id WHERE offers.user_id='" . $user_id ."'");
    //     }
    //     catch (Exception $e) {
    //         die('ERROR function findByRelations: ' . $e->getMessage());
    //     }
    //     return $result;
    //     // return $this->fetchData($result);
    // }
    
    // public function findRelationsBy($entityManager, $field, $value) {
    //     try {
    //         $result = $this->pdo->query("SELECT * FROM $entityManager->tablename INNER JOIN offers ON users.id = offers.user_id WHERE " . $field . "='" . $value . "'");
    //     }
    //     catch (Exception $e) {
    //         die('ERROR function findByRelations: ' . $e->getMessage());
    //     }

    //     return $result;
    //     // return $this->fetchData($result);
    // }
}


