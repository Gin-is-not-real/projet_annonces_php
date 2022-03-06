<?php 
require_once 'src/main.php';
require_once 'lib/securize_form.php';

// session lifetime
require 'src/demo_account_task.php';

try {
    // secure POST and GET using securize_form.php
    $_POST = valid_data_array($_POST);
    $_GET = valid_data_array($_GET);

    // anti-bot check: if this input if filled, return to index
    if(isset($_POST['atbt']) && !empty($_POST['atbt'])) {
        // $_POST['error'] = 'something wrong';
        $GLOBALS['offerController']->index();
        return;
    }

    if(!isset($_GET['action'])) {
        // call a main.php function
        initNavigation();
    }
    else {
        if($_GET['action'] == 'login-index') {
            $GLOBALS['loginController']->index();
        }
        elseif($_GET['action'] == 'login') {
            $GLOBALS['loginController']->login();
        }
        elseif($_GET['action'] == 'register') {
            $GLOBALS['loginController']->register();
        }
        elseif($_GET['action'] == 'mail') {
            $GLOBALS['loginController']->sendMail();
        }
        elseif($_GET['action'] == 'logout') {
            $GLOBALS['loginController']->logout();
        }

        elseif($_GET['action'] == 'admin') {
                $GLOBALS['offerController']->listByUser($_SESSION['user_id'], 'own');
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