<?php
if(session_id() == '') {
    session_start();
}

require_once 'Controller/LoginController.php';
require_once 'Controller/OfferController.php';
require_once 'Controller/ImageController.php';
require_once 'Manager/DatabaseManager.php';
require_once 'Manager/LoginManager.php';
require_once 'Manager/OfferManager.php';
require_once 'Manager/ImageManager.php';

$GLOBALS = !empty($GLOBALS['loginController']) ? $GLOBALS : initControllers();

ini_set('sendmail_path', 'C:\MAMP\sendmail\sendmail.exe');

function getConnectionInformations() {
    require 'config.php';
    return $CON_INFOS;
}
function initControllers() {
    $conInfos = getConnectionInformations();

    $GLOBALS['loginController'] = new LoginController();
    $GLOBALS['loginController']->setManager(new LoginManager($conInfos, 'users'));

    $GLOBALS['offerController'] = new OfferController();
    $GLOBALS['offerController']->setManager(new OfferManager($conInfos, 'offers'), 'Offer');
    $GLOBALS['offerController']->pushRelation('users', 'users.id',  'offers.user_id');
    $GLOBALS['offerController']->pushRelation('images', 'images.id', 'offers.image_id');

    $GLOBALS['imageController'] = new ImageController();
    $GLOBALS['imageController']->setManager(new ImageManager($conInfos, 'images'), 'Image');

    return $GLOBALS;
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
function initNavigation() {
    clearSession();
    $GLOBALS['imageController']->clearFolder();
    $GLOBALS['offerController']->index();
}