<?php 

class UserController {
    //constructor

    static function index() {
        require('templates/base.php');
        //envoi a la page de la liste
    }

    static function connect($userManager) {
        // var_dump($_POST);

        if(isset($_POST['username'])) {

        }
        //verifie si les infos entrées correspondent aux infos dans la base

        // require('templates/TEST.php');
    }

    public function new() {
        //recup les données de formulaire et les envoi en base, rend le template
    }

}