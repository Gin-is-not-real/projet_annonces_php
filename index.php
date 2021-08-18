<?php 
/**
 * routeur
 */
require_once 'Controller/LoginController.php';
require_once 'Controller/OfferController.php';

// require_once 'Manager/DatabaseManager.php';
require_once 'Manager/LoginManager.php';
require_once 'Manager/OfferManager.php';


$loginManager = new LoginManager('localhost', 'projet_offers', 'admin', 'admin', 'users');
$offerManager = new OfferManager('localhost', 'projet_offers', 'admin', 'admin', 'offers');


if(session_id() == '') {
    session_start();
}

try {
    if(!isset($_GET['action'])) {
        if(isset($_GET['session-state']) AND $_GET['session-state'] == 'init-session') {

            if(isset($_SESSION['username'])) {
                if(session_id() !== '') {
                    unset($_SESSION['username']);
                    session_destroy();
                }
            }
        }
        LoginController::index();
    }
    else {
        if($_GET['action'] == 'login') {
            if(!empty($_POST['username']) AND !empty($_POST['pass'])) {
                LoginController::login($loginManager, $_POST['username'], $_POST['pass']);
            }
        }
        elseif($_GET['action'] == 'register') {
            LoginController::register($loginManager, $_POST['username'], $_POST['email'], $_POST['pass']);
        }
        elseif($_GET['action'] == 'logout') {
            $_POST['message'] = 'You have been correctly disconnected';
            OfferController::index($offerManager);
        }

        elseif($_GET['action'] == 'admin') {
            // require 'templates/offer/index.php.php';
        }
    }
    
    

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}