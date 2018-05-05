<?php

namespace App\Controllers;

use Core\View;
class Error extends \Core\Controller
{
    public function error404Action()
    {
        View::render('404.php', ['title' => 'camagru | 404']);
    }
}