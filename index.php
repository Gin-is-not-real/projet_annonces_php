<?php 
/**
 * routeur
 */
require_once 'main.php';

if(session_id() == '') {
    session_start();
}

try {
    if(!isset($_GET['action'])) {
        clearSession();
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
            if(isset($_GET['by-user-id'])) {
                $user = $loginController->manager->find($_GET['by-user-id'])->fetch();
                $_POST['h'] = 'All offers posted by ' . $user['username'];
                $offerController->index([' WHERE users.id=', $_GET['by-user-id']]);
            }
            elseif(isset($_GET['filter'])) {
                $_POST['h'] = 'All offers for the category ' . $_GET['filter'];
                $offerController->listOffersByCategory($_GET['filter']);
            }
            else {
                $option = null;
                $_POST['h'] = 'All offers';
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
        elseif($_GET['action'] == 'favorites') {
            $_POST['h'] = 'Your favorites';
            $offerController->listFavorites($_SESSION['user_id']);
        }
    }
    
    

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}