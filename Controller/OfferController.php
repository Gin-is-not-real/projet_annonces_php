<?php 
require_once 'Entity/Offer.php';

class OfferController {
    static function index($offerManager) {

        $_POST['all-offers'] = $offerManager->findAll();
        require_once 'templates/base.php';
    }

    static function new() {

    }
}