<?php 
require_once 'DatabaseManager.php';
require_once 'src/Entity/User.php';
require_once 'lib/ArrayPrint.php';

/**
 * @method findOffer
 * @method listOffer
 * @method add
 * @method update
 * 
 * @method getCategoriesFields
 * @method getCategoriesForOffer
 * @method addCategory
 * @method clearCategories
 * 
 * @method addNewCategory
 * 
 * @method isFavorite
 * @method addFavorite
 * @method removeFavorite
 * 
 */
class OfferManager extends DatabaseManager {
    /**
     * search on the database an offer by it's id, and some seller informations, using inner join request
     */
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


    /**
     * get all offers from database, and some seller informations, using inner join request. 
     */
    public function listOffers($option = null) {
        $option = $option != null ? $option[0] . ' ' . $option[1] : '';

        try {
            $result = $this->pdo->query("
            SELECT users.id AS usersid, users.username, users.email, offers.id AS offerid, offers.title, offers.place, offers.price, offers.date, offers.place, offers.content
            FROM users 
            INNER JOIN offers 
            ON users.id = offers.user_id
            " . $option);


        } catch (Exception $e) {

            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
        
        return $result;
    }


    /**
     * Recover POST data from form, after they have been secured in the index, and put them into the database 
     */
    public function add() {
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


    /**
     * Recover POST data from form, after they have been secured in the index, and use them for update an offer from database
     */
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

            
        } catch (Exception $e) {

            die('Error on update: ' . $e->getMessage());
        }
    }


    /**
     * Get all categories from the database
     */
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

    /**
     * Get categories associate to an offer whose id is passed as a parameter
     */
    public function getCategoriesForOffer($offerId) {
        try {
            $result = $this->pdo->query("SELECT category FROM offers_categories WHERE offer_id = '" . $offerId . "'");

            return $result;


        } catch (Exception $e) {

            die('Error on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }


    /**
     * Add a category to an offer by associates its id and the category on a associative table from the database
     */
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


    /**
     * Remove all couple category/offer_id from the database associative table
     */
    public function clearCategories($offerId) {
        $sql = "DELETE FROM offers_categories WHERE offer_id=?";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([$offerId]);
    }


    /**
     * Add a new category in the database, if it doesn't already exist
     */
    public function addNewCategory($category) {
        $test = $this->findByIn('categories', 'name', $category);

        if($data = $test->fetch()) {
            // if the category already exist

        }
        else {
            try {
                $entry = $this->pdo->prepare("INSERT INTO categories (name) VALUES (:name)");

                $affectedLines = $entry->execute(array(
                    'name' => $category
                ));

                return $affectedLines;


            } catch(Exception $e) {

                die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
            }
        }
    }


    /**
     * Search into the database if the offer is on the favorite list to the user
     */
    public function isFavorite($userId, $offerId) {
        try {
            $result = $this->pdo->query("SELECT * FROM users_favorites WHERE user_id=" . $userId . " AND offer_id=" . $offerId);

            return $result;


        } catch(Exception $e) {

            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }

    /**
     * Add an offer in user favorites list by linking their ids in an associative table from database
     */
    public function addFavorite($userId, $offerId) {
        try {
            $entry =$this->pdo->prepare("INSERT INTO users_favorites (user_id, offer_id) VALUES (:user_id, :offer_id)");

            $affectedLines = $entry->execute(array(
                'user_id' => $userId,
                'offer_id' => $offerId
            ));

            return $affectedLines;


        } catch(Exception $e) {

            die('ERROR on ' . __METHOD__ . ': ' . $e->getMessage());
        }
    }


    /**
     * Remove an offer from the user favorite list by using the database entry id
     */
    public function removeFavorite($id) {
        $sql = "DELETE FROM users_favorites WHERE id=?";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
    }











}


