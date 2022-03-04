<?php 
require_once 'Controller.php';
require_once 'src/Entity/User.php';
require_once 'src/Manager/LoginManager.php';

class LoginController extends Controller {
    public static $ENTITY = User::class;

    public function index() {
        require_once('templates/login/index.php');
    }

    public function sendMail() {
        if(!empty($_POST['mail-from']) AND !empty($_POST['mail-to']) AND !empty($_POST['mail-about']) AND !empty($_POST['mail-message'])) {
            $subject = 'Your offer n° ' . $_POST['mail-about'];
            $msg = $_POST['mail-message'];
            $header = 'From: ' . $_POST['mail-from'];
    
            $notice = 'Your message about the offer ' . $_POST['mail-about'];

            if(mail($_POST['mail-to'], $subject, $msg, $header)) {
                $notice .= ' has been sent';
            }
            else {
                $notice .= ' has not been sent';
            }
            header('Location: index.php?action=show&id='. $_POST['mail-about'].'&notice=' . $notice);
        }
        else {
            $this->index();
        }
    }

    public function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        session_destroy();
        $this->index();
    }

    public function login() {
        if(!empty($_POST['username']) AND !empty($_POST['pass'])) {
            $_POST = valid_data_array($_POST);

            $username = $_POST['username'];
            $pass = $_POST['pass'];

            $logs = $this->manager->findBy('username', $username);

            if($data = $logs->fetch()) {
                if(password_verify($pass, $data['pass'])) {
                    $_SESSION['username'] = htmlspecialchars($username);
                    $_SESSION['user_id'] = $data['id'];
                    setcookie('session', htmlspecialchars($username), time() + 1);
                    header('Location: index.php?action=admin');
                }
                else {
                    $_POST['login-error'] = 'Wrong password or username';
                    $this->index();
                }
            }
            else {
                $_POST['login-error'] = 'Wrong password or username';
                $this->index();
            }

        }
        else {
            $this->index();
        }
    }

    public function register() {
        if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['pass'])) {
            $_POST = valid_data_array($_POST);

            $username = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            if($data = $this->manager->findBy('username', $username)->fetch()) {
                $error = 'This username is not available';
            }
            elseif($data = $this->manager->findBy('email', $email)->fetch()) {
                $error = 'This email is not available';
            }

    
            if(isset($error)) {
                $_POST['login-error'] = $error;
                $this->index();
            }
            else {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $result = $this->manager->insert($username, $email, $hash);
                if($result) {
                    $this->login($username, $hash);
                    header('Location: index.php?action=admin');
                }
            }
        }
        else {
            $this->index();
        }
    }
}
