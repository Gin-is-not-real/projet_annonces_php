<?php 
require_once 'Controller.php';
require_once 'Entity/Offer.php';
require_once 'Manager/OfferManager.php';
require_once 'ArrayPrint.php';

class OfferController extends Controller {
    public static $ENTITY = Offer::class;

    public function isFavorite($offerId) {
        if(isset($_SESSION['user_id'])) {
            $isFavorite = $this->manager->isFavorite($_SESSION['user_id'], $offerId);
            if($data = $isFavorite->fetch()) {
                return $data['id'];
            }
            else {
                return false;
            }
        }
    }

    public function newFavorite($offerId) {
        $favoriteId = $this->isFavorite($offerId);

        if($favoriteId != null) {
            $this->manager->removeFavorite($favoriteId);
        }
        else {
            $this->manager->addFavorite($_SESSION['user_id'], $offerId);
        }
    }

    public function listFavorites($userId) {
        //recup les id des relations 
        $favoritesId = $this->manager->findByIn('users_favorites', 'user_id', $userId);
        $reqParam = '';

        while($fav = $favoritesId->fetch()) {
            $favid = $fav['offer_id'];
            $reqParam .= 'offers.id=' . $favid . ' OR ';
        }
        $reqParam = substr($reqParam, 0, strlen($reqParam) -3);

        if(strlen($reqParam) > 0) {
            $this->index([' WHERE ', $reqParam]);
        }
        else {
            $notice = 'No favorites yet !';
            header('Location: index.php?action=offer-index&notice=' . $notice);
        }
    }

    public function newCategory($category) {
        $error = null;
        if($data = $this->manager->findByIn('categories', 'name', $category)->fetch()) {
            $error = 'this category already exists';
        }

        if(isset($error)) {
            $_POST['add-cat-error'] = $error;
        } 
        else {
            $this->manager->addNewCategory($category);
        }
    }


    public function listOffersByCategory($category) {
        $offersId = $this->manager->findByIn('offers_categories', 'category', $category);
        $reqParam = '';

        while($offer = $offersId->fetch()) {
            $offerid = $offer['offer_id'];
            $reqParam .= 'offers.id =' . $offerid . ' OR ';
        }
        $reqParam = substr($reqParam, 0, strlen($reqParam) -3);

        $this->index([' WHERE ', $reqParam]);
    }

    public function index($option = null) {
        $_POST['all-offers'] = [];
        $offers = $this->manager->listOffers($option);

        while($data = $offers->fetch()) {
            $images = $this->manager->findByIn('images', 'offer_id', $data['offerid']);
            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }

            $categories = $this->manager->getCategoriesForOffer($data['offerid']);

            $data['categories'] = [];
            while($category = $categories->fetch()) {
                array_push($data['categories'], $category);
            }

            array_push($_POST['all-offers'], $data);
        }
        require_once 'templates/offer/index.php';
    }

    public function listByUser($id, $option = null) {
        $_POST['user-offers'] = [];
        $offers = $this->manager->listOffers([' WHERE user_id =', $id]);

        while($data = $offers->fetch()) {
            $images = $GLOBALS['imageController']->manager->findBy('offer_id', $data['offerid']);
            $data['images'] = [];
            while($image = $images->fetch()) {
                array_push($data['images'], $image);
            }

            $categories = $this->manager->getCategoriesForOffer($data['offerid']);
            $data['categories'] = [];
            while($category = $categories->fetch()) {
                array_push($data['categories'], $category);
            }
            array_push($_POST['user-offers'], $data);
        }
        $get = $option != null ? '' : '?own=true';
        require_once 'templates/admin/index.php' . $get;
    }
    public function listOwnOffers() {
        if(!empty($_SESSION['user_id'])) {
            $offers = $this->manager->listOffers([' WHERE user_id =', $_SESSION['user_id']]);
            while($data = $offers->fetch()) {
                $images = $GLOBALS['imageController']->manager->findBy('offer_id', $data['offerid']);
                $data['images'] = [];
                while($image = $images->fetch()) {
                    array_push($data['images'], $image);
                }
                $categories = $this->manager->getCategoriesForOffer($data['offerid']);
                $data['categories'] = [];
                while($category = $categories->fetch()) {
                    array_push($data['categories'], $category);
                }
                array_push($_POST['user-offers'], $data);
            }
            require_once 'templates/admin/index.php';
        }
        else {
            $GLOBALS['loginController']->index();
        }
    }

    public function show($id) {
        $_POST['offer'] = [];
        $offer = $this->manager->listOffers([' WHERE offers.id= ', $id . '']);

        $isFavorite = $this->isFavorite($id);
        $_POST['offer']['favorite'] = $isFavorite != null ? true : false;

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
        $categories = $this->manager->getCategoriesFields();
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

            if(isset($_POST['categories'])) {
                foreach($_POST['categories'] as $category) {
                    $this->manager->addNewCategory($category);
                    $this->manager->addCategory($category, $generateOfferId);
                }
            }

            header('Location: index.php?action=admin');
        }
        else {
            $_POST['categories'] = $categories;
            // var_dump($_POST['categories']->fetchAll());
            require 'templates/offer/_form.php';
        }
    }

    public function edit($offerId, $imageController) {
        $offers = $this->manager->find($offerId);
        //cherche en base les images liées a l'offre
        $images = $imageController->manager->findBy('offer_id', $offerId);
        $categories = $this->manager->getCategoriesFields();
        $offersCats = $this->manager->getCategoriesForOffer($offerId);

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
                $count ++;
            }

            if(isset($_POST['categories'])) {
                $this->manager->clearCategories($offerId);

                foreach($_POST['categories'] as $category) {
                    $this->manager->addNewCategory($category);
                    $this->manager->addCategory($category, $offerId);
                }
            }
            // die();
            $_POST['offer-categories'] = [];
            while($category = $offersCats->fetch()) {
                array_push($_POST['offer-categories'], $category['category']);
            }

            header('Location: index.php?action=admin');
        }
        else {
            $_POST['offer'] = $offers;
            $_POST['images'] = $images;
            $_POST['categories'] = $categories;
            $_POST['offer-categories'] = $offersCats;

            require 'templates/offer/_form.php';
        }
    }

    public function delete($id) {
        $this->manager->clearCategories($id);
        $this->manager->remove($id);
        header('Location: index.php?action=admin');
    }
}