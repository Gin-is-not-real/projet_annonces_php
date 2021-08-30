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

    public function listByUser($id, $imageController, $option = null) {
        $_POST['user-offers'] = [];
        $offers = $this->manager->listOffers([' WHERE user_id =', $id]);

        // die(var_dump($offers->fetchAll()));

        while($data = $offers->fetch()) {
            // $images = $this->manager->findByIn('images', 'offer_id', $data['offerid']);
            $images = $imageController->manager->findBy('offer_id', $data['offerid']);

            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }
            array_push($_POST['user-offers'], $data);
        }

        $get = $option != null ? '' : '?own=true';

        require_once 'templates/admin/index.php' . $get;
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

    public function new($imageController) {
        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            //genere un id pour l'offer afin de pouvoir l'affecter directement a l'offer_id de l'image
            $generateOfferId = date('mdhis');

            $this->manager->add($_POST);

            foreach($_FILES as $file) {
                if(strlen($file['name']) != 0) {
                    $image = $imageController->uploadImageAndCreatePost($file, $generateOfferId);
                    $imageController->new($image);
                }
            }

            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    public function edit($offerId, $imageController) {
        $offers = $this->manager->find($offerId);
        //cherche en base les images liées a l'offre
        $images = $imageController->manager->findBy('offer_id', $offerId);

        //on verifie que le formulaire a été touché 
        if(isset($_POST['title'])) {
            $this->manager->update($offerId);

            $count = 0;
            foreach($_FILES as $file) {
                if(isset($file) AND strlen($file['name']) != 0) {
                    $image = $imageController->uploadImageAndCreatePost($file, $offerId);

                    if($_POST['hidden-img'.$count] == 'edit-img') {
                        $imageController->edit($_POST['hidden-id'.$count], $image);
                    }
                    else {
                        $imageController->new($image);
                    }
                }
            }

            header('Location: index.php?action=admin');
        }
        else {
            $_POST['offer'] = $offers;
            $_POST['images'] = $images;

            require 'templates/offer/_form.php';
        }
    }

    public function delete($id) {
        $this->manager->remove($id);
        header('Location: index.php?action=admin');
    }
}