<?php 
require_once 'Controller.php';
require_once 'Entity/Offer.php';
require_once 'Manager/OfferManager.php';
require_once 'ArrayPrint.php';


class OfferController extends Controller {
    public static $ENTITY = Offer::class;

    public function index() {
        $_POST['all-offers'] = [];
        $offers = $this->manager->listOffers();
        
        while($data = $offers->fetch()) {
            $images = $this->manager->findByIn('images', 'offer_id', $data['offerid']);

            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }
            array_push($_POST['all-offers'], $data);
        }
        require_once 'templates/offer/index.php';
    }

    public function listByUser($id, $imageManager) {
        $_POST['user-offers'] = [];
        $offers = $this->manager->listOffers([' WHERE user_id =', $id]);

        while($data = $offers->fetch()) {
            // $images = $this->manager->findByIn('images', 'offer_id', $data['offerid']);
            $images = $imageManager->findBy('offer_id', $data['offerid']);
            // die(var_dump($images->fetchAll(), $data['offerid']));

            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }
            // die(var_dump($data['images']));
            array_push($_POST['user-offers'], $data);
        }

        require_once 'templates/admin/index.php';
    }

    public function show($id) {
        $_POST['offer'] = [];
        $offer = $this->manager->listOffers([' WHERE offers.id= ', $id . '']);

        while($data = $offer->fetch()) {
            $images = $this->manager->findByIn('images', 'offer_id', $data['offerid']);

            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }
            array_push($_POST['offer'], $data);
        }
        require 'templates/offer/show.php';
    }


    public function new($imageManager) {
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            //genere un id pour l'offer afin de pouvoir l'affecter directement a l'offer_id de l'image
            $_POST['id'] = date('mdhis');
            //081 911 3657
            //UPLOAD
            $_POST['image'] = $this->manager->uploadImageAndCreatePost($_FILES['image'], $_POST['id']);

            $this->manager->add($_POST);
            $imageManager->add($_POST['image']);
            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    public function edit($id, $imageManager) {
        $_POST['offer'] = $this->manager->find($id);

        $_POST['images'] = $imageManager->findBy('offer_id', $id);
        
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            if(isset($_POST['title'])) {
                $this->manager->update($id);
            }
            if(!empty($_POST['images'])) {
                while($imgData = $_POST['images']->fetch()) {

                    foreach($_FILES as $file) {
                        $_POST['image'] = $this->manager->uploadImageAndCreatePost($file, $id);

                        $imageManager->update($imgData['id']);
                    }
                }
            }


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