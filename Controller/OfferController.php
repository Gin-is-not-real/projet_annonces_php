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

    // static function new($offerManager) {
    //     //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
    //     if(isset($_POST['title'])) {
    //         $offerManager->add($_POST);
    //         header('Location: index.php?action=admin');
    //     }
    //     else {
    //         require 'templates/offer/_form.php';
    //     }
    // }

    static function new($offerManager, $imageManager) {
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            //genere un id pour l'offer afin de pouvoir l'affecter directement a l'offer_id de l'image
            $_POST['id'] = date('mdhis');
            //081 911 3657

            //UPLOAD
            if(isset($_FILES['image']) AND !empty($_FILES['image'])) {
                $img = $_FILES['image'];
                var_dump($img, '</br>');

                //on verifie si c'est une image
                if(strpos($img['type'], 'image') !== '') {

                    $tmpName = $_FILES['image']['tmp_name'];
                    //C:\Users\acs\AppData\Local\Temp\php5F0E.tmp

                    $filename = $img['name'];
                    //user-shape_icon-64px.png

                    $dest = 'public/uploads/';
                    move_uploaded_file($tmpName, $dest . $filename);

                    $_POST['image'] = ['filename'=> $filename, 'offer_id' => $_POST['id']];

                }
            }
            $offerManager->add($_POST);
            $imageManager->add($_POST['image']);
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