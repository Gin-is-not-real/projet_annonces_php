<?php 
require_once 'Entity/Offer.php';

class OfferController {
    static function index($offerManager) {
        $_POST['all-offers'] = $offerManager->findAll();
        require_once 'templates/base.php';
    }

    static function admin($offerManager) {
        //lister les offres correspondant a l'user
        require_once 'templates/admin/index.php';
    }

    static function new() {

    }
}