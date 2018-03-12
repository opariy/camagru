<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 02.03.2018
 * Time: 15:04
 */

namespace App\Controllers;
use \Core\View;
use \Core\Model;

class Profile extends \Core\Controller
{
    public function indexAction() {
        $message = true;
        $file = 'profile.php';
        $email = $_SESSION['logged_user']['email'];
        $user_name = $_SESSION['logged_user']['user_name'];
        $args = array('email' => $email);
        $args['user_name'] = $user_name;
        if (isset($_POST['submit'])) {
            $new_user_name = htmlspecialchars(strtolower(trim($_POST['new_user_name'])));
            $new_email = htmlspecialchars(strtolower(trim($_POST['new_email'])));
            if ($_SESSION['logged_user']['email'] != $new_email) {
                if (Model::getUserByEmail($email) !== false) {
                $message = 'This email is already taken';
                }
            }
            if ($_SESSION['logged_user']['user_name'] != $new_user_name) {

                if (!$this->checkUserName($new_user_name))
                {
                    $message = 'User Name may only contain 3-20 alphanumerical symbols or underscores.';
                }
                elseif (Model::getUserByName($new_user_name) !== false) {
                    $message = 'This login is already taken';
                }
            }
            if ($message === true) {
                echo 'ye';
                if (Model::updateNameEmail($user_name, $new_user_name, $new_email)) {
                    $_SESSION['logged_user']['email'] = $new_email;
                    $_SESSION['logged_user']['user_name'] = $new_user_name;
                }
                //change password
            }
            else {
                echo $message;
            }
            $file = 'profile.php';

        }
//        View::render('nav_bar_logged.php');
        View::render($file, $args);

    }

    public function changePasswordAction() {

        $email = $_SESSION['logged_user']['email'];
        $user_name = $_SESSION['logged_user']['user_name'];
        $args = array('email' => $email);
        $args['user_name'] = $user_name;

        $file = 'change_password.php';
        if (isset($_POST['submit'])) {
            $old_password = htmlspecialchars($_POST['old-psw']);
            $new_password = htmlspecialchars($_POST['psw']);
            $password_repeat = htmlspecialchars($_POST['psw-repeat']);
            if ($new_password == $password_repeat) {
                echo 'sesion pass: ';
                var_dump($_SESSION['logged_user']['password']);
                echo 'input old pass: ';
                var_dump($old_password);
                if (password_verify($old_password, Model::getUserByName($user_name)['password'])) {
//                if (password_verify($old_password, $_SESSION['logged_user']['password'])) {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    if (Model::updatePassword($user_name, $new_password)) {
                        $_SESSION['logged_user']['password'] = $new_password;
                        echo 'Your password has been changed';
                        $file = 'profile.php';
                    }
                } else {
                    echo 'Wrong old password';
                }
            }
            else {
                $message = 'Passwords don\'t match';
            }
            $file = 'profile.php';
        }
//        View::render('nav_bar_logged.php');
        View::render($file, $args);
    }

    public function editUserNameAction() {

    }

    public function editEmailAction() {

    }

    public function editPasswordAction() {

    }
}
