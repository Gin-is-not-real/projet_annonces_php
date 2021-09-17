<?php
require_once 'Controller/LoginController.php';
require_once 'Controller/OfferController.php';
require_once 'Controller/ImageController.php';
// require_once 'Manager/DatabaseManager.php';
require_once 'Manager/LoginManager.php';
require_once 'Manager/OfferManager.php';
require_once 'Manager/ImageManager.php';

$conInfos = getConnectionInformations();
$hostname = $conInfos['hostname'];
$basename = $conInfos['basename'];
$username = $conInfos['username'];
$password = $conInfos['password'];

$loginController = new LoginController();
$loginController->setManager(new LoginManager($conInfos, 'users'));

$offerController = new OfferController();
$offerController->setManager(new OfferManager($conInfos, 'offers'), 'Offer');
$offerController->pushRelation('users', 'users.id',  'offers.user_id');
$offerController->pushRelation('images', 'images.id', 'offers.image_id');

$imageController = new ImageController();
$imageController->setManager(new ImageManager($conInfos, 'images'), 'Image');

function getConnectionInformations() {
    if($_SERVER['HTTP_HOST'] == 'localhost') {
        $conInfos = [
            'hostname' => 'localhost',
            'basename' => 'projet_offers',
            'username' => 'admin',
            'password' => 'admin',
        ];
    }
    else {
        $conInfos = [
            'hostname' => 'promo-72.codeur.online',
            'basename' => 'ninap_bases',
            'username' => 'ninap',
            'password' => 'pXvu3qcH1Ry83Q==',
        ];
    }
    return $conInfos;
}
function clearSession() {
    if(isset($_SESSION['username'])) {
        if(session_id() !== '') {
            unset($_SESSION['username']);
            unset($_SESSION['user_id']);
            session_destroy();
        }
    }
}