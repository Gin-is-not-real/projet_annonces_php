<?php 
require_once 'DatabaseManager.php';

require_once 'Entity/User.php';
require_once 'ArrayPrint.php';


class OfferManager extends DatabaseManager {

    public function clearCategories($offerId) {
        $sql = "DELETE FROM offers_categories WHERE offer_id=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$offerId]);
    }

    public function addCategory($category, $offerId) {
        try {
            $entry = $this->pdo->prepare(" INSERT INTO offers_categories (category, offer_id) VALUES (:category, :offer_id)");
            $affectedLines = $entry->execute(array(
                'category' => $category,
                'offer_id' => $offerId
            ));
            return $affectedLines;
        } catch(Exception $e) {
            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }

    public function getCategoriesFields() {
        try {
            $result = $this->pdo->query("
            SELECT * FROM categories
            ");
            return $result;
        } catch (Exception $e) {
            die('Error on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }

    public function getCategoriesForOffer($offerId) {
        try {
            $result = $this->pdo->query("SELECT category FROM offers_categories WHERE offer_id = '" . $offerId . "'");
            return $result;
        } catch (Exception $e) {
            die('Error on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }

    public function add($offer) {
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
            SELECT users.id AS usersid, users.username, offers.id AS offerid, offers.title, offers.place, offers.price, offers.date, offers.place, offers.content, offers.categories
            FROM users 
            INNER JOIN offers 
            ON users.id = offers.user_id
            WHERE offers.id = $id
            ");
        } catch (Exception $e) {
            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
        // ArrayPrint::printMultiArray($result->fetchAll());
        return $result;
    }

}


