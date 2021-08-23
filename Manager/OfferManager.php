<?php 
require_once 'DatabaseManager.php';

require_once 'Entity/User.php';
require_once 'ArrayPrint.php';


class OfferManager extends DatabaseManager {

    public function uploadImageAndCreatePost($file, $offerId) {
        if(isset($file) AND !empty($file)) {
            $img = $file;
            // var_dump($img, '</br>');

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
        // var_dump($_POST);
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
                // UNION ALL

    public function listOffers($option = null) {
            $option = $option != null ? $option[0] . ' ' . $option[1] : '';

            try {
                $result = $this->pdo->query("
                SELECT users.id AS usersid, users.username, offers.id AS offerid, offers.title, offers.place, offers.price, offers.date, offers.place, offers.content
                FROM users 
                INNER JOIN offers 
                ON users.id = offers.user_id
                " . $option);
            } catch (Exception $e) {
                die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
            }
            return $result;
    }

    public function findOffer($id) {
        try {
            $result = $this->pdo->query("
            SELECT users.id AS usersid, users.username, offers.id AS offerid, offers.title, offers.place, offers.price, offers.date, offers.place, offers.content
            FROM users 
            INNER JOIN offers 
            ON users.id = offers.user_id
            WHERE offers.id = $id
            ");
        } catch (Exception $e) {
            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
        ArrayPrint::printMultiArray($result->fetchAll());
        return $result;
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


