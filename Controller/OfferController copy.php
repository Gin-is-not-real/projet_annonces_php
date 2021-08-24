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

            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }
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
            $this->manager->add($_POST);

            if(isset($_FILES['image-0'])) {
                $_POST['image'] = $imageManager->uploadImageAndCreatePost($_FILES['image-0'], $_POST['id']);
                $imageManager->add($_POST['image']);
            }


            header('Location: index.php?action=admin');
        }
        else {
            require 'templates/offer/_form.php';
        }
    }

    public function edit($offerId, $imageManager) {
        $offers = $this->manager->find($offerId);
        //cherche en base les images liées a l'offre
        $images = $imageManager->findBy('offer_id', $offerId);

        //on verifie que le formulaire a été touché -> il doit y avoir une fonction is_form_submit ??
        if(isset($_POST['title'])) {
            $this->manager->update($offerId);

            $imgFetched = $images->fetchAll();

            if(isset($_FILES['image-0'])) {
                var_dump('file0: ', $_FILES['image-0']);

                if(isset($imgFetched[0])) {
                    var_dump('img0: ', $imgFetched[0]['filename']);

                    $img = $imageManager->uploadImageAndCreatePost($_FILES['image-0'], $offerId);
                    $imageManager->update();
                }
            }
            header('Location: index.php?action=admin');
        }
        else {
            $offers = $this->manager->find($offerId);
            //cherche en base les images liées a l'offre
            $images = $imageManager->findBy('offer_id', $offerId);

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