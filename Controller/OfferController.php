<?php 
require_once 'Entity/Offer.php';

class OfferController {
    static function index($offerManager) {
        $_POST['all-offers'] = $offerManager->findAll();
        require_once 'templates/offer/index.php';
    }

    static function admin($offerManager) {
        //lister les offres correspondant a l'user
        $_POST['user-offers'] = $offerManager->find(1);

        require_once 'templates/admin/index.php';
    }

    static function new() {

    }

    static function edit($id) {

    }
}