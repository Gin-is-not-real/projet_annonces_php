<?php 
require_once 'Controller.php';
require_once 'Entity/User.php';
require_once 'Manager/LoginManager.php';

class LoginController extends Controller {
    public static $ENTITY = User::class;

    public function index() {
        require_once('templates/login/index.php');
    }

    public function sendMail($from, $to, $about, $message) {
        $subject = 'Your offer n° ' . $about;
        $msg = $message;
        $header = 'From: ' . $from;

        mail($to, $subject, $msg, $header);

        $notice = 'Your message about the offer ' . $about . ' has been sent';
        header('Location: index.php?action=show&id='.$about.'&notice=' . $notice);
    }

    public function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        session_destroy();
        $this->index();
    }

    public function login($username, $pass) {
        $logs = $this->manager->findBy('username', $username);

        if($data = $logs->fetch()) {
            if(password_verify($pass, PASSWORD_DEFAULT) == password_verify($data['pass'], PASSWORD_DEFAULT)) {
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

    public function register($username, $email, $pass) {
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
}
