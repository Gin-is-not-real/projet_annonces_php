<?php 
require_once 'Controller.php';
require_once 'Manager/ImageManager.php';
require_once 'ArrayPrint.php';

class ImageController extends Controller {
    public static $ENTITY = Offer::class;

    public function uploadImageAndCreatePost($file, $offerId) {
        if(isset($file) AND !empty($file)) {
            $img = $file;
            //on verifie si c'est une image
            if(strpos($img['type'], 'image') !== '') {

                $tmpName = $file['tmp_name'];
                //C:\Users\acs\AppData\Local\Temp\php5F0E.tmp

                $filename = $offerId . '-' . $img['name'];
                //user-shape_icon-64px.png

                $dest = 'public/uploads/';
                move_uploaded_file($tmpName, $dest . $filename);

                $image = ['filename'=> $filename, 'offer_id' => $offerId];

                return $image;
            }
        }
    }

    public function new($image) {
        $this->manager->add($image);
    }

    public function edit($id, $image) {
        $this->manager->update($id, $image);
    }
}