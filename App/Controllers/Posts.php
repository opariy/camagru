<?php
namespace App\Controllers;

use \Core\View;
use App\Models\Post;

class Posts extends \Core\Controller
{
    public function indexAction()
    {

        $posts = Post::getAll();
        View::render('Posts/index.php', ['posts' => $posts]);
//        echo "Hello from the index action in the Posts Controller";
//        echo '<p>Query string parameters: <pre>'.htmlspecialchars(print_r($_GET, true)).'</pre></p>';
    }

    public function editAction()
    {
        echo "Hello from the edit action in the Posts Controller";
        echo '<p>Route parameters: <pre>'.htmlspecialchars(print_r($this->route_params, true)).'</pre></p>';
    }
}

