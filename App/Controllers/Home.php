<?php
namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller {

    public function indexAction() {
        if (isset($_SESSION['s_email'])) {
            unset ($_SESSION['s_email']);
        }
        if (isset($_SESSION['re_email'])) {
            unset ($_SESSION['re_email']);
        }
        if (isset($_SESSION['try_log_u_name'])) {
            unset ($_SESSION['try_log_u_name']);
        }
//        View::render('nav_bar_not_logged.php');
        View::render('home.php');
    }




    protected function before () {

//        View::render('Home/index.php', ['name' => 'Sasha', 'colours' => ['red', 'green', 'blue']]);
//        echo "=before= ";
    }

    protected function after () {
//        echo " =after= ";
    }
}