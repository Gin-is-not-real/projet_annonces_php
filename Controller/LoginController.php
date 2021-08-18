<?php 
require_once 'Entity/User.php';
// if(session_id() == '') {
//     session_start();
// }
class LoginController {

    static function index() {
        require_once('templates/login/index.php');
    }

    static function logout() {
        unset($_SESSION['username']);
        session_destroy();
        LoginController::index();
    }

    static function login($loginManager, $username, $pass) {
        $logs = $loginManager->findBy('username', $username);

        if($data = $logs->fetch()) {
            if($pass == $data['pass']) {
                $_SESSION['username'] = htmlspecialchars($username);
                setcookie('session', htmlspecialchars($username), time() + 1);

                header('Location: index.php?action=admin');
            }
            else {
                $_POST['login-error'] = 'Wrong password or username';
                LoginController::index();
            }
        }
        else {
            $_POST['login-error'] = 'Wrong password or username';
            LoginController::index();
        }
    }

    static function register($loginManager, $username, $email, $pass) {
        if($data = $loginManager->findBy('username', $username)->fetch()) {
            $error = 'This username is not available';
        }
        elseif($data = $loginManager->findBy('email', $email)->fetch()) {
            $error = 'This email is not available';
        }

        if(isset($error)) {
            $_POST['login-error'] = $error;
            LoginController::index();
        }
        else {
            $result = $loginManager->insert($username, $email, $pass);
            if($result) {
                $_SESSION['username'] = $username;
                setcookie('session', $username, time() + 1);
                
                header('Location: index.php?action=admin');
            }
        }
    }
}
