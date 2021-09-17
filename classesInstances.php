<?php
require_once 'Controller/LoginController.php';
require_once 'Controller/OfferController.php';
require_once 'Controller/ImageController.php';

// require_once 'Manager/DatabaseManager.php';
require_once 'Manager/LoginManager.php';
require_once 'Manager/OfferManager.php';
require_once 'Manager/ImageManager.php';

if($_SERVER['HTTP_HOST'] == 'localhost') {
    $hostname = 'localhost';
    $basename = 'projet_offers';
    $username = 'admin';
    $password = 'admin';
}
else {
    $hostname = 'promo-72.codeur.online';
    $basename = 'ninap_bases';
    $username = 'ninap';
    $password = 'pXvu3qcH1Ry83Q==';
}

$loginController = new LoginController();
// $loginController->setManager(new LoginManager('localhost', 'projet_offers', 'admin', 'admin', 'users'));
$loginController->setManager(new LoginManager($hostname, $basename, $username, $password, 'users'));


$offerController = new OfferController();
$offerController->setManager(new OfferManager($hostname, $basename, $username, $password, 'offers'), 'Offer');
// $offerController->pushRelation(User::$TABLE_NAME, User::$TABLE_NAME . User::$PRIMARY_KEY,  'user_id');
$offerController->pushRelation('users', 'users.id',  'offers.user_id');

$offerController->pushRelation('images', 'images.id', 'offers.image_id');

$imageController = new ImageController();
$imageController->setManager(new ImageManager($hostname, $basename, $username, $password, 'images'), 'Image');
// $imageManager = new ImageManager('localhost', 'projet_offers', 'admin', 'admin', 'images');