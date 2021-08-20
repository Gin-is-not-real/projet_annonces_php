<?php 
require_once 'Controller.php';
require_once 'Entity/Offer.php';
require_once 'Manager/OfferManager.php';

class OfferController extends Controller {
    
    public function index($loginManager) {
        $_POST['all-offers'] = $this->manager->findRelations($loginManager);
        require_once 'templates/offer/index.php';
    }

    public function admin($loginManager) {
        //lister les offres correspondant a l'user
        // $_POST['user-offers'] = $this->manager->findBy('user_id', 1);
        $_POST['user-offers'] = $this->manager->findByRelations($loginManager, $_SESSION['user_id']);

        require_once 'templates/admin/index.php';
    }

    public function show($loginManager, $id) {
        $_POST['offer'] = $this->manager->findRelationsBy($loginManager, 'offers.id', $id);
        require 'templates/offer/show.php';
    }

    public function new($imageManager) {
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            //genere un id pour l'offer afin de pouvoir l'affecter directement a l'offer_id de l'image
            $_POST['id'] = date('mdhis');
            //081 911 3657
            //UPLOAD
            $_POST['image'] = $this->manager->uploadImageAndCreatePost($_FILES['image']);

            $this->manager->add($_POST);
            $imageManager->add($_POST['image']);
            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    public function edit($id) {
        $_POST['offer'] = $this->manager->find($id);
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {

            $this->manager->update($id);

            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    public function delete($id) {
        $this->manager->remove($id);
        header('Location: index.php?action=admin');
    }
}