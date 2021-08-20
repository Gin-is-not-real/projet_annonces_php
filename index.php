<?php 
/**
 * routeur
 */
require_once 'Controller/LoginController.php';
require_once 'Controller/OfferController.php';

// require_once 'Manager/DatabaseManager.php';
require_once 'Manager/LoginManager.php';
require_once 'Manager/OfferManager.php';
require_once 'Manager/ImageManager.php';


$loginController = new LoginController();
$loginController->setManager(new LoginManager('localhost', 'projet_offers', 'admin', 'admin', 'users'));

$offerController = new OfferController();
$offerController->setManager(new OfferManager('localhost', 'projet_offers', 'admin', 'admin', 'offers'), 'Offer');
$offerController->pushRelation(User::$TABLE_NAME, User::$PRIMARY_KEY, 'user_id');

$imageManager = new ImageManager('localhost', 'projet_offers', 'admin', 'admin', 'images');

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
        $offerController->index($loginController);
        
        //TEST
        // $offerController->manager->findByRelation($offerController->relations['users'], ['offers.id', 1]);

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
            // $_POST['message'] = 'You have been correctly disconnected';
            $loginController->logout();
        }
        elseif($_GET['action'] == 'admin') {
            // require 'templates/offer/index.php.php';
            $offerController->admin();
        }
        elseif($_GET['action'] == 'offer-index') {
            $offerController->index();
        }

        elseif($_GET['action'] == 'show') {
            $offerController->show($_GET['id']);
        }

        elseif($_GET['action'] == 'new') {
            $offerController->new($imageManager);
        }
        elseif($_GET['action'] == 'edit') {
            $offerController->edit($_GET['id']);
        }
        elseif($_GET['action'] == 'delete') {
            $offerController->delete($_GET['id']);
        }
    }
    
    

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}