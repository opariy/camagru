<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\UserModel;

class Profile extends \Core\Controller
{
    public function indexAction()
    {
        $message = true;
        if (!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user'])) {
            header("Location: /Authorization/log-in");
        } else {
            $file = 'profile.php';
            $email = $_SESSION['logged_user']['email'];
            $user_name = $_SESSION['logged_user']['user_name'];
            $args = array('email' => $email);
            $args['user_name'] = $user_name;
            if (isset($_POST['submit'])) {
                if (isset($_POST['notify'])) {
                    UserModel::updateNotiications($user_name, 1);
                } else {
                    UserModel::updateNotiications($user_name, 0);
                }
                $new_user_name = htmlspecialchars(strtolower(trim($_POST['new_user_name'])));
                $new_email = htmlspecialchars(strtolower(trim($_POST['new_email'])));
                if ($_SESSION['logged_user']['email'] != $new_email) {


                    if (UserModel::getUserByEmail($new_email) !== false) {
                        $message = 'This email is already taken';
                    }

                }
                if ($_SESSION['logged_user']['user_name'] != $new_user_name) {

                    if (!$this->checkUserName($new_user_name)) {
                        $message = 'User Name may only contain 3-20 alphanumerical symbols or underscores.';
                    } elseif (UserModel::getUserByName($new_user_name) !== false) {
                        $message = 'This login is already taken';
                    }
                }
                if ($message === true) {
                    if (UserModel::updateNameEmail($user_name, $new_user_name, $new_email)) {
                        $_SESSION['logged_user']['email'] = $new_email;
                        $_SESSION['logged_user']['user_name'] = $new_user_name;
                    }
                }
                $args['message'] = $message;
                $file = 'profile.php';
            }
            $args['notify'] = UserModel::getUserByName($_SESSION['logged_user']['user_name'])['notifications'];
            $args['message'] = $message;
            View::render($file, $args);
        }
    }

    public function changePasswordAction()
    {
        $message = "";

        if (!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user'])) {
            header("Location: /Authorization/log-in");
        } else {
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
                    if (password_verify($old_password, UserModel::getUserByName($user_name)['password'])) {
                        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                        if (UserModel::updatePassword($user_name, $new_password)) {
                            $_SESSION['logged_user']['password'] = $new_password;
                            $message = 'Your password has been changed';
                            $file = 'profile.php';
                        }
                    } else {
                        $message = 'Wrong old password';
                    }
                } else {
                    $message = 'Passwords don\'t match';
                }
                $file = 'profile.php';
            }
            $args['message'] = $message;
//            var_dump($args);
            $args['notify'] = UserModel::getUserByName($user_name)['notifications'];
            View::render($file, $args);
        }
    }

    public function userAction()
    {

        if (array_key_exists('id', $this->route_params)) {

            $user_id = $this->route_params['id'];
            $data = array('user_id' => $user_id);
            View::render('UserPhotos.php', $data);
        } else {
            header("Location: /");
        }
    }
}