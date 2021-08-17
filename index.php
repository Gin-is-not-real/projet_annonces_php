<?php
require('Manager/UserManager.php');
require('Controller/UserController.php');

$userManager = new UserManager('localhost', 'projet_offers', 'admin', 'admin', 'users');

try {
    if(!isset($_GET['action'])) {
        // require_once('templates/base.php');

        //TESTS
        $test = $userManager->findBy("username", "admin");
        var_dump($test) ;
    }
    else {
        if($_GET['action'] == 'connect') {
            //on recupere les POST du form
            // $data = $_POST;
            //post est recup dans le controller
            UserController::connect($userManager);
        }

        elseif($_GET['action'] = 'test') {

        }
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}