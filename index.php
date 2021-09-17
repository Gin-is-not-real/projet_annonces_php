<?php 
/**
 * routeur
 */
require_once 'main.php';

try {
    if(!isset($_GET['action'])) {
        initNavigation();
    }
    else {
        if($_GET['action'] == 'login-index') {
            $GLOBALS['loginController']->index();
        }
        elseif($_GET['action'] == 'login') {
            if(!empty($_POST['username']) AND !empty($_POST['pass'])) {
                $GLOBALS['loginController']->login($_POST['username'], $_POST['pass']);
            }
        }
        elseif($_GET['action'] == 'register') {
            $GLOBALS['loginController']->register($_POST['username'], $_POST['email'], $_POST['pass']);
        }
        elseif($_GET['action'] == 'logout') {
            $GLOBALS['loginController']->logout();
        }
        elseif($_GET['action'] == 'admin') {
            if(isset($_SESSION['user_id'])) {
                $GLOBALS['offerController']->listByUser($_SESSION['user_id'], $GLOBALS['imageController'], 'own');
            }
            else {
                $GLOBALS['loginController']->index();
            }
        }

        elseif($_GET['action'] == 'offer-index') {
            if(isset($_GET['by-user-id'])) {
                $user = $GLOBALS['loginController']->manager->find($_GET['by-user-id'])->fetch();
                $_POST['h'] = 'All offers posted by ' . $user['username'];
                $GLOBALS['offerController']->index([' WHERE users.id=', $_GET['by-user-id']]);
            }
            elseif(isset($_GET['filter'])) {
                $_POST['h'] = 'All offers for the category ' . $_GET['filter'];
                $GLOBALS['offerController']->listOffersByCategory($_GET['filter']);
            }
            else {
                $option = null;
                $_POST['h'] = 'All offers';
                $GLOBALS['offerController']->index($option);
            }

        }
        elseif($_GET['action'] == 'show') {
            $GLOBALS['offerController']->show($_GET['id']);
        }
        elseif($_GET['action'] == 'new') {
            if(isset($_SESSION['user_id']) ) {
                $GLOBALS['offerController']->new($GLOBALS['imageController']);
            }
            else {
                $GLOBALS['loginController']->index();
            }
        }
        elseif($_GET['action'] == 'edit') {
            $GLOBALS['offerController']->edit($_GET['id'], $GLOBALS['imageController']);
        }
        elseif($_GET['action'] == 'delete') {
            $GLOBALS['imageController']->manager->clearImagesOfOffer($_GET['id']);
            $GLOBALS['offerController']->delete($_GET['id']);
        }


        elseif($_GET['action'] == 'delete-img') {
            $imageController->delete($_GET['id'], $_GET['filename']);
        }


        elseif($_GET['action'] == 'mail') {
            $GLOBALS['loginController']->sendMail(
                htmlspecialchars($_POST['mail-from']), 
                $_POST['mail-to'], 
                htmlspecialchars($_POST['mail-about']), 
                htmlspecialchars($_POST['mail-message']));
        }


        elseif($_GET['action'] == 'add-category') {
            $GLOBALS['offerController']->newCategory($_POST['new-category']);
            $GLOBALS['offerController']->new($imageController);
        }


        elseif($_GET['action'] == 'add-favorite') {
            $GLOBALS['offerController']->newFavorite($_GET['id']);
            $GLOBALS['offerController']->show($_GET['id']);
        }
        elseif($_GET['action'] == 'favorites') {
            $_POST['h'] = 'Your favorites';
            $GLOBALS['offerController']->listFavorites($_SESSION['user_id']);
        }
    }
    
    

} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}