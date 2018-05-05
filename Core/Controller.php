<?php
namespace Core;

use App\Models\UserModel;

abstract class Controller
{
    protected $route_params = [];
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    public function __call($name, $args)
    {
        $method = $name . 'Action';
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        }
        else {
            View::render('404.php');
//            throw new \Exception("Method $method not found in controller" . get_class($this));
        }

    }

    protected function validateCredentials($user_name, $email, $password, $password_repeat)
    {
        $message = true;
        if (!$this->checkUserName($user_name))
        {
            $message = 'User Name may only contain 3-20 alphanumerical symbols or underscores.';
        }
        elseif ($password != $password_repeat)
        {
            $message = 'Passwords don\'t match.';

        }
        elseif (UserModel::getUserByName($user_name) !== false) {
            $message = 'This login is already taken';
        }
        elseif (UserModel::getUserByEmail($email) !== false) {
            $message = 'This email is already taken';
        }
        return $message;
    }

    protected function checkUserName($user_name)
    {
        $pattern = '/^[a-z0-9_]{3,20}$/';
        if (preg_match($pattern, $user_name)) {
            return true;
        }
        return false;
    }


    protected function before () {

    }

    protected function after () {

    }

}


