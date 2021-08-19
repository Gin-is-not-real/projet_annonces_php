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

    static function show($offerManager, $loginManager, $id) {
        $_POST['offer'] = $offerManager->findRelationsBy($loginManager, 'offers.id', $id);
        require 'templates/offer/show.php';
    }

    static function new($offerManager) {
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            $offerManager->add($_POST);
            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    static function edit($offerManager, $id) {
        $_POST['offer'] = $offerManager->find($id);
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            $offerManager->update($id);

            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    static function delete($offerManager, $id) {
        $offerManager->remove($id);
        header('Location: index.php?action=admin');
    }
}