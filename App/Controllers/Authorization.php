<?php
namespace App\Controllers;
use \Core\View;
use \App\Models\UserModel;

//DONE: bonuses -
//click on photo  - bigger photo
//ajaxify
//bonus see all photos of a selected user (needs to be tested)
//bonus- like -> notification
//bonus delete your comment


//MARKUP
//responsive canvas
//Responsive design
///display correctly on mobile devices and have an adapted layout on small resolutions.



class Authorization extends \Core\Controller
{

    public function logOutAction()
    {
        if (session_destroy()) {
            header("Location: /");
        }
    }

    public function resendMailAction()
    {
        if (isset($_SESSION['try_log_u_name']) || isset($_SESSION['s_email'])) {
            if (isset($_SESSION['try_log_u_name'])) {
                $user_name = $_SESSION['try_log_u_name'];
                $email = UserModel::getUserByName($user_name)['email'];
            } elseif (isset($_SESSION['s_email'])) {
                $email = $_SESSION['s_email'];
                $user_name = UserModel::getUserByEmail($email)['user_name'];
            }
            $this->sendMail($email, $user_name);
        } else {
            header("Location: /");
        }
    }

    public function logInAction()
    {
        $message = "";
        if (isset($_POST['submit-login'])) {
            $user_name = htmlspecialchars(strtolower(trim($_POST['user_name'])));
            if (UserModel::getUserByName($user_name)) {
                $_SESSION['try_log_u_name'] = $user_name;
                $password = htmlspecialchars($_POST['password']);
                if (UserModel::getUserByName($user_name)['activated'] == 1) {
                    if (password_verify($password, UserModel::getUserByName($user_name)['password'])) {
                        $_SESSION['logged_user'] = UserModel::getUserByName($user_name);
                        header('Location: /');
                    } else {
                        $message = 'Wrong password';
                        $args['message'] = $message;
                        View::render('login.php', $args);
                    }
                } else {
                    View::render('email_sent.php');
                }
            } else {
                $message =  'No account found for this user name. You can register a new one though.';
                $args['message'] = $message;
                View::render('login.php', $args);
            }
            unset($_POST['submit-login']);
        }
        else {
            $args['message'] = $message;
            View::render('login.php', $args);
        }
    }



    protected function sendMail($email, $user_name)
    {
        $hash = md5(rand(0, 1000));
        if (UserModel::updateHash($email, $hash)) {
            $this->sendVerificationLink($email, $user_name, $hash);
//            echo '/authorization/verification?action=registration&email=' . $email . '&hash=' . $hash ;
        }
        View::render('email_sent.php');
        View::render('login.php');
    }

    public function signUpAction()
    {
        $file = 'signup.php';
        $message = true;

        if (isset($_POST['submit'])) {

            $user_name = htmlspecialchars(strtolower(trim($_POST['user_name'])));
            $email = htmlspecialchars(strtolower(trim($_POST['email'])));
            $password = htmlspecialchars($_POST['psw']);
            $password_repeat = htmlspecialchars($_POST['psw-repeat']);
            $message = $this->validateCredentials($user_name, $email, $password, $password_repeat);

            if ($message === true) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                UserModel::addUser($user_name, $email, $password);

                $hash = md5(rand(0, 1000));
                if (UserModel::updateHash($email, $hash)) {
                    $this->sendVerificationLink($email, $user_name, $hash);
//                    echo '/authorization/verification?action=registration&email=' . $email . '&hash=' . $hash ;
                    $_SESSION['s_email'] = $email;
                    View::render('email_sent.php');
                    $file = 'login.php';
                }
            }
        }
        $args['message'] = $message;
        View::render($file, $args);
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
        $message = "";

        if (isset($_GET['action']) && $_GET['action'] == 'registration' && isset($_GET['email']) && isset($_GET['hash'])) {

            $row = UserModel::getUserByEmail($_GET['email']);
            if ($_GET['hash'] == $row['hash']) {
                if ($row['activated'] == 1) {
                    $message = 'You email has already been activated';
                    $args['message'] = $message;
                    View::render('login.php', $args);
                } else {
                    if (UserModel::Activate($_GET['email']))
                    header('Location: /authorization/log-in');
                }
            } else {
                $message = 'Sorry, wrong email-link combination.';
                $args['message'] = $message;
                View::render('login.php', $args);
                return false;
            }
        } else if (isset($_GET['action']) && $_GET['action'] == 'reinitialization' && isset($_GET['email']) && isset($_GET['hash'])) {

            $row = UserModel::getUserByEmail($_GET['email']);
            if ($_GET['hash'] == $row['hash']) {

                $args['email'] = $_GET['email'];
                View::render('new_password.php', $args);
            }
            else {
                $message = 'Sorry, wrong email-link combination.';
                $args['message'] = $message;
                View::render('enter_email.php', $args);
                return false;
            }
        }
        else {
            $message = 'Sorry, wrong link.';
            $args['message'] = $message;
            View::render('404.php', $args);

            return false;
        }
    }


    public function resetPasswordAction()
    {
        $message = "";

        if (isset($_POST['submit'])) {

            $email = htmlspecialchars(strtolower(trim($_POST['email'])));
            if (UserModel::getUserByEmail($email)) {
                $_SESSION['re_email'] = $email;
                $hash = md5(rand(0, 1000));
                if (UserModel::updateHash($email, $hash)) {
                    $user_name = UserModel::getUserByEmail($email)['user_name'];
                    $this->sendReinitializationLink($email, $user_name, $hash);
                    View::render('email_sent_reset_pass.php');
                }
            } else {
                $message =  'No account found for this user name. You can register a new one though.';
                $args['message'] = $message;
                View::render('signup.php', $args);
            }
        }
        elseif (isset($_POST['submit1'])) {

            $password = htmlspecialchars($_POST['psw']);
            $password_repeat = htmlspecialchars($_POST['psw-repeat']);

            if ($password == $password_repeat) {
                $password = password_hash($password, PASSWORD_DEFAULT);

                if (isset($_SESSION['re_email'])) {
                    $email = $_SESSION['re_email'];
                }
                else {
                    $email = $_POST['email'];
                }


                if (UserModel::updatePassword(UserModel::getUserByEmail($email)['user_name'], $password)) {
                    $message = 'Your password has been changed';
                    $args['message'] = $message;
                    View::render('login.php', $args);
                }
                else {
                    $message = 'an error occured. password wasn\'t updated';
                    $args['message'] = $message;
                    View::render('login.php', $args);
                    }
                }
                else {
                    $message = 'Passwords don\'t match.';
                    $args['message'] = $message;
                    View::render('change_password.php', $args);
                }
            }
        else {
            $args['message'] = $message;
            View::render('enter_email.php', $args);
        }
    }



    public function restorePassAction()
    {
        if (isset($_SESSION['re_email'])) {
            $email = $_SESSION['re_email'];
            $user_name = UserModel::getUserByEmail($email)['user_name'];
            $hash = md5(rand(0, 1000));
            if (UserModel::updateHash($email, $hash)) {
                $this->sendReinitializationLink($email, $user_name, $hash);
            }
            View::render('email_sent_reset_pass.php');
        }
        else {
            header("Location: /authorization/reset-password");
        }
    }
}
