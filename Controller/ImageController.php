<?php 
require_once 'Controller.php';
require_once 'Manager/ImageManager.php';
require_once 'ArrayPrint.php';

class ImageController extends Controller {
    public static $ENTITY = Offer::class;
    public static $FILE_DEST = 'public/uploads/';

    public function uploadImageAndCreatePost($file, $offerId) {
        if(isset($file) AND !empty($file)) {
            $img = $file;
            //on verifie si c'est une image
            if(strpos($img['type'], 'image') !== '') {

                $tmpName = $file['tmp_name'];
                //C:\Users\acs\AppData\Local\Temp\php5F0E.tmp

                $filename = substr($offerId, 0, 3) . $img['name'];
                //user-shape_icon-64px.png

                $dest = 'public/uploads/';
                move_uploaded_file($tmpName, $dest . $filename);

                $image = [
                    'filename'=> $filename, 
                    'offer_id' => $offerId,
                    'id' => date('hismd') . substr($filename, -6, 3)
                ];

                return $image;
            }
        }
    }

    public function send($image) {
        die(var_dump($image));

        $search = $this->manager->find($image['id']);
        $fetched = $search->fetch();
        die(var_dump($fetched));
    }

    public function new($image) {
        $this->manager->add($image);
    }

    public function edit($id, $image) {
        $this->manager->update($id, $image);
    }

    public function delete($id) {
        $file = $this->manager->find($id);
        $fetched = $file->fetch();

        if(file_exists($this::$FILE_DEST . $fetched['filename'])) {
            unlink($this::$FILE_DEST . $fetched['filename']);
        }
        $this->manager->removeImage($id);

        header("Location: index.php?action=edit&id=" . $fetched['offer_id']);
    }
}