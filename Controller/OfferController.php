<?php 
require_once 'Entity/Offer.php';

class OfferController {
    static function index($offerManager, $loginManager) {
        $_POST['all-offers'] = $offerManager->findRelations($loginManager);
        require_once 'templates/offer/index.php';
    }

    static function admin($offerManager, $loginManager) {
        //lister les offres correspondant a l'user
        // $_POST['user-offers'] = $offerManager->findBy('user_id', 1);
        $_POST['user-offers'] = $offerManager->findByRelations($loginManager, $_SESSION['user_id']);

        require_once 'templates/admin/index.php';
    }

    static function new() {

    }

    static function edit($offerManager, $id) {
        $_POST['offer'] = $offerManager->find($id);
        if(isset($_POST['title'])) {
            $offerManager->update($id, $_POST);

            require 'templates/admin/index.php';
        }
        require 'templates/offer/_form.php';
    }
}