<?php
namespace App\Controllers;

class Posts
{
    public function index()
    {
        echo "Hello from the index action in the Posts Controller";
    }

    public function edit()
    {
        echo "Hello from the edit action in the Posts Controller";
//        echo '<p>Route parameters: <pre>'.htmlspecialchars(print_r($this->route_params, true)).'</pre></p>';
    }
}

