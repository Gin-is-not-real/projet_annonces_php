<?php 
/**
 * routeur
 */
require_once 'Controller/LoginController.php';
require_once 'Controller/OfferController.php';
require_once 'Controller/ImageController.php';

// require_once 'Manager/DatabaseManager.php';
require_once 'Manager/LoginManager.php';
require_once 'Manager/OfferManager.php';
require_once 'Manager/ImageManager.php';


$loginController = new LoginController();
$loginController->setManager(new LoginManager('localhost', 'projet_offers', 'admin', 'admin', 'users'));

$offerController = new OfferController();
$offerController->setManager(new OfferManager('localhost', 'projet_offers', 'admin', 'admin', 'offers'), 'Offer');
// $offerController->pushRelation(User::$TABLE_NAME, User::$TABLE_NAME . User::$PRIMARY_KEY,  'user_id');
$offerController->pushRelation('users', 'users.id',  'offers.user_id');

$offerController->pushRelation('images', 'images.id', 'offers.image_id');

$imageController = new ImageController();
$imageController->setManager(new ImageManager('localhost', 'projet_offers', 'admin', 'admin', 'images'), 'Image');
// $imageManager = new ImageManager('localhost', 'projet_offers', 'admin', 'admin', 'images');


if(session_id() == '') {
    session_start();
}

try {
    if(!isset($_GET['action'])) {

        if(isset($_SESSION['username'])) {
            if(session_id() !== '') {
                unset($_SESSION['username']);
                unset($_SESSION['user_id']);
                session_destroy();
            }
        }
        $imageController->clearFolder();
        $offerController->index();

    }
    else {
        if($_GET['action'] == 'login-index') {
            $loginController->index();
        }
        elseif($_GET['action'] == 'login') {
            if(!empty($_POST['username']) AND !empty($_POST['pass'])) {
                $loginController->login($_POST['username'], $_POST['pass']);
            }
        }
        elseif($_GET['action'] == 'register') {
            $loginController->register($_POST['username'], $_POST['email'], $_POST['pass']);
        }
        elseif($_GET['action'] == 'logout') {
            $loginController->logout();
        }
        elseif($_GET['action'] == 'admin') {
            if(isset($_SESSION['user_id'])) {
                $offerController->listByUser($_SESSION['user_id'], $imageController, 'own');
            }
            else {
                $loginController->index();
            }
        }
        elseif($_GET['action'] == 'offer-index') {
            if(isset($_GET['filter'])) {
                $offerController->listOffersByCategory($_GET['filter']);
            }
            else {
                $option = null;
                $offerController->index($option);
            }

        }
        
        elseif($_GET['action'] == 'show') {
            $offerController->show($_GET['id']);
        }

        elseif($_GET['action'] == 'new') {
            if(isset($_SESSION['user_id']) ) {
                $offerController->new($imageController);
            }
            else {
                $loginController->index();
            }
        }
        elseif($_GET['action'] == 'edit') {
            $offerController->edit($_GET['id'], $imageController);
        }
        elseif($_GET['action'] == 'delete') {
            $imageController->manager->clearImagesOfOffer($_GET['id']);
            $offerController->delete($_GET['id']);
        }

        elseif($_GET['action'] == 'delete-img') {
            $imageController->delete($_GET['id'], $_GET['filename']);
        }

        elseif($_GET['action'] == 'mail') {
            $loginController->sendMail(
                htmlspecialchars($_POST['mail-from']), 
                $_POST['mail-to'], 
                htmlspecialchars($_POST['mail-about']), 
                htmlspecialchars($_POST['mail-message']));
        }

        elseif($_GET['action'] == 'add-category') {
            $offerController->newCategory($_POST['new-category']);
            $offerController->new($imageController);
        }

        elseif($_GET['action'] == 'add-favorite') {
            $offerController->newFavorite($_GET['id']);
            $offerController->show($_GET['id']);
        }
    }
    
    

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}