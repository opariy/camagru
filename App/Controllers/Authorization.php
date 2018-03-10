<?php
namespace App\Controllers;
use \Core\View;
use \Core\Model;
//hash active time

class Authorization extends \Core\Controller
{


    public function logOutAction()
    {

        echo 'we are here after logout';
        echo '<pre>';
        var_dump($_SESSION);
        echo '<pre>';
        if (session_destroy()) {
            header("Location: /");
        }
    }

    public function resendMailAction()
    {
        if (isset($_SESSION['try_log_u_name'])) {
            $user_name = $_SESSION['try_log_u_name'];
            $email = Model::getUserByName($user_name)['email'];
        } elseif (isset($_SESSION['s_email'])) {
            $email = $_SESSION['s_email'];
            $user_name = Model::getUserByEmail($email)['user_name'];
        }

        $this->sendMail($email, $user_name);
    }

    public function logInAction()
    {
        if (isset($_POST['submit'])) {
            $user_name = htmlspecialchars(strtolower(trim($_POST['user_name'])));
            if (Model::getUserByName($user_name)) {
                $_SESSION['try_log_u_name'] = $user_name;
                $password = htmlspecialchars($_POST['password']);
                if (Model::getUserByName($user_name)['activated'] == 1) {
                    if (password_verify($password, Model::getUserByName($user_name)['password'])) {
                        $_SESSION['logged_user'] = Model::getUserByName($user_name);
                        View::render('home.php');
                    } else {
                        echo 'Wrong password';
                        View::render('login.php');
                    }
                } else {
                    View::render('email_sent.php');
                }
            } else {
                echo 'No account found for this user name. You can register a new one though.';
                View::render('login.php');
            }
        }
        else {
            View::render('login.php');
        }
    }


    protected function sendMail($email, $user_name)
    {
        $hash = md5(rand(0, 1000));
        if (Model::updateHash($email, $hash)) {
            $this->sendVerificationLink($email, $user_name, $hash);
        }
        View::render('email_sent.php');
        View::render('login.php');
    }

    public function signUpAction()
    {
        $file = 'signup.php';
        if (isset($_POST['submit'])) {

            $user_name = htmlspecialchars(strtolower(trim($_POST['user_name'])));
            $email = htmlspecialchars(strtolower(trim($_POST['email'])));
            $password = htmlspecialchars($_POST['psw']);
            $password_repeat = htmlspecialchars($_POST['psw-repeat']);
            $message = $this->validateCredentials($user_name, $email, $password, $password_repeat);
//            $message = true;
            if ($message === true) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                Model::addUser($user_name, $email, $password);

                $hash = md5(rand(0, 1000));
                if (Model::updateHash($email, $hash)) {
                    $this->sendVerificationLink($email, $user_name, $hash);
                    $_SESSION['s_email'] = $email;
                    View::render('email_sent.php');
                    $file = 'login.php';
                }
            } else {
                echo $message;
//                $args['message'] = $message;
            }

        }
        View::render($file);
    }


    public static function sendVerificationLink($email, $user_name, $hash)
    {
        $message = "
				<html lang='en'>
				<head>
					<title>Registration</title>
				</head>
				<body>
				<p>Hello, <b>@" . $user_name . "</b>!</p>
				<p>Help us secure your <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "' title='camagru'>camagru</a> account by verifying your email
					address (" . $email . "). This lets you access all of camagru's features.</p>
				<p><a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/authorization/verification?action=registration&email=" . $email . "&hash=" . $hash . "'>Verify email address</a></p>
				<hr>
				<p>Button not working? Paste the following link into your browser:
						" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/authorization/verification?action=registration&email=" . $email . "&hash=" . $hash . "</p>
				<p>You’re receiving this email because you recently created a new camagru account. If this wasn’t you, please ignore
					this email.</p>
				</body>
				</html> 
			";
        $headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
        mail($email, "[camagru] Signup | Verification", $message, $headers);
    }

    public static function sendReinitializationLink($email, $user_name, $hash)
    {
        $message = "
				<html lang='en'>
				<head>
					<title>Forgotten Password</title>
				</head>
				<body>
				<p>Hello, <b>@" . $user_name . "</b>!</p>
				<p>Help us restore your <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "' title='camagru'>camagru</a> password by clicking the link below.</p>
				<p><a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/authorization/verification?action=reinitialization&email=" . $email . "&hash=" . $hash . "'>Reset your password</a></p>
				<hr>
				<p>Button not working? Paste the following link into your browser:
						" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/authorization/verification?action=reinitialization&email=" . $email . "&hash=" . $hash . "</p>
				<p>You’re receiving this email because you recently tried to restore your password. If this wasn’t you, please ignore
					this email.</p>
				</body>
				</html> 
			";
        $headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
        mail($email, "[camagru] Forgotten Password | Verification", $message, $headers);
    }


    public function verification()
    {
        if (isset($_GET['action']) && $_GET['action'] == 'registration' && isset($_GET['email']) && isset($_GET['hash'])) {

            $row = Model::getUserByEmail($_GET['email']);
            if ($_GET['hash'] == $row['hash']) {
                if ($row['activated'] == 1) {
                    echo 'You email has already been activated';
                    View::render('login.php');
                } else {
                    if (Model::Activate($_GET['email']))
                        echo 'activated';
                    View::render('login.php');
                }
            } else {
                echo 'Sorry, wrong email-link combination.';
                View::render('home.php');
                return false;
            }
        } else if (isset($_GET['action']) && $_GET['action'] == 'reinitialization' && isset($_GET['email']) && isset($_GET['hash'])) {


            $row = Model::getUserByEmail($_GET['email']);
            echo $row;
            if ($_GET['hash'] == $row['hash']) {
                echo 'here i will add a form to restore a password';
                View::render('new_password.php');
            }
        } else {
            echo 'Sorry, wrong email-link combination.';
            //send again?
            View::render('home.php');
            return false;
        }
        //hahahahha
    }


    public function resetPasswordAction()
    {
        if (isset($_POST['submit'])) {
            $email = htmlspecialchars(strtolower(trim($_POST['email'])));
            if (Model::getUserByEmail($email)) {
                $_SESSION['re_email'] = $email;
                $hash = md5(rand(0, 1000));
                if (Model::updateHash($email, $hash)) {
                    $user_name = Model::getUserByEmail($email)['user_name'];
                    $this->sendReinitializationLink($email, $user_name, $hash);
                    $url = 'verification?action=reinitialization' . '&email=' . $email . '&hash=' . $hash;
                    echo 'this url ';
                    var_dump($url);
                    View::render('email_sent_reset_pass.php');
                }
            } else {
                echo 'No account found for this user name. You can register a new one though.';
                View::render('signup.php');
            }
        }
        elseif (isset($_POST['submit1'])) {
            $password = htmlspecialchars($_POST['psw']);
            $password_repeat = htmlspecialchars($_POST['psw-repeat']);
            if ($password == $password_repeat) {
                $new_password = password_hash($password, PASSWORD_DEFAULT);
                if (updatePassword(Model::getUserByEmail($_SESSION['re_email'])['user_name'], $password)) {
                    $_SESSION['logged_user']['password'] = $new_password;
                    echo 'Your password has been changed';
                    $file = 'profile.php';
                }
                else {
                    echo 'an erros occured. password wasn;t updated';
                }
                    $file = 'login.php';
                }
            else {
                $message = 'Passwords don\'t match.';
                echo $message;
            }
            }
        else {
            View::render('enter_email.php');
        }
    }



    public function restorePassAction()
    {
        if (isset($_SESSION['re_email'])) {
            $email = $_SESSION['re_email'];
            $user_name = Model::getUserByEmail($email)['user_name'];
        }
        $hash = md5(rand(0, 1000));
        if (Model::updateHash($email, $hash)) {
            $this->sendReinitializationLink($email, $user_name, $hash);
            $url = 'verification?action=reinitialization' . '&email=' . $email . '&hash=' . $hash;
        }
        View::render('email_sent_reset_pass.php');
    }
}
